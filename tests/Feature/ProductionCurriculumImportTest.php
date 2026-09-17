<?php

use Database\Seeders\ProductionCurriculumTransitionSeeder;
use Database\Seeders\ProductionFoundationIntermediateSeeder;
use Illuminate\Support\Facades\DB;

it('imports Foundation and Intermediate while preserving the existing Advanced curriculum and learner progress', function () {
    $now = now();

    DB::table('courses')->insert([
        'id' => ProductionCurriculumTransitionSeeder::COURSE_ID,
        'title' => ProductionCurriculumTransitionSeeder::COURSE_TITLE,
        'description' => 'Production curriculum import test fixture.',
        'image_url' => null,
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    $modules = ProductionCurriculumTransitionSeeder::expectedAdvancedModules();

    foreach ($modules as $moduleId => $module) {
        DB::table('modules')->insert([
            'id' => $moduleId,
            'course_id' => ProductionCurriculumTransitionSeeder::COURSE_ID,
            'course_stage_id' => null,
            'title' => $module['title'],
            'description' => null,
            'position' => $module['position'],
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        for ($i = 1; $i <= $module['episodes']; $i++) {
            DB::table('episodes')->insert([
                'module_id' => $moduleId,
                'position' => $i,
                'title' => "Fixture Episode {$moduleId}-{$i}",
                'description' => null,
                'video_url' => "https://example.test/video/{$moduleId}/{$i}",
                'pdf_path' => null,
                'type' => 'video',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        for ($i = 1; $i <= $module['quizzes']; $i++) {
            DB::table('quizzes')->insert([
                'module_id' => $moduleId,
                'title' => "Fixture Quiz {$moduleId}-{$i}",
                'description' => null,
                'position' => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        for ($i = 1; $i <= $module['assignments']; $i++) {
            DB::table('assignments')->insert([
                'module_id' => $moduleId,
                'title' => "Fixture Assignment {$moduleId}-{$i}",
                'instructions' => 'Fixture instructions.',
                'submission_type' => 'text',
                'position' => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    $advancedModuleIds = array_keys($modules);

    $advancedEpisodeIdsBefore = DB::table('episodes')
        ->whereIn('module_id', $advancedModuleIds)
        ->orderBy('id')
        ->pluck('id')
        ->map(fn ($id) => (int) $id)
        ->all();

    $advancedQuizIdsBefore = DB::table('quizzes')
        ->whereIn('module_id', $advancedModuleIds)
        ->orderBy('id')
        ->pluck('id')
        ->map(fn ($id) => (int) $id)
        ->all();

    $advancedAssignmentIdsBefore = DB::table('assignments')
        ->whereIn('module_id', $advancedModuleIds)
        ->orderBy('id')
        ->pluck('id')
        ->map(fn ($id) => (int) $id)
        ->all();

    $learnerId = DB::table('users')->insertGetId([
        'name' => 'Existing Production Learner',
        'email' => 'existing-learner@example.test',
        'password' => bcrypt('password'),
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    $watchedEpisodeId = $advancedEpisodeIdsBefore[0];
    $attemptedQuizId = $advancedQuizIdsBefore[0];

    $episodeProgressId = DB::table('episode_user')->insertGetId([
        'user_id' => $learnerId,
        'episode_id' => $watchedEpisodeId,
        'watched' => true,
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    $quizAttemptId = DB::table('quiz_attempts')->insertGetId([
        'user_id' => $learnerId,
        'quiz_id' => $attemptedQuizId,
        'score' => 80,
        'passed' => true,
        'status' => 'graded',
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    $this->seed(ProductionCurriculumTransitionSeeder::class);
    $this->seed(ProductionFoundationIntermediateSeeder::class);

    $stages = DB::table('course_stages')
        ->where('course_id', ProductionCurriculumTransitionSeeder::COURSE_ID)
        ->pluck('id', 'slug');

    $foundationStageId = (int) $stages['foundation'];
    $intermediateStageId = (int) $stages['intermediate'];
    $advancedStageId = (int) $stages['advanced'];

    $advancedModuleIdsExpected = $advancedModuleIds;
    sort($advancedModuleIdsExpected);

    $advancedModuleIdsAfter = DB::table('modules')
        ->where('course_id', ProductionCurriculumTransitionSeeder::COURSE_ID)
        ->where('course_stage_id', $advancedStageId)
        ->orderBy('id')
        ->pluck('id')
        ->map(fn ($id) => (int) $id)
        ->all();

    $advancedEpisodeIdsAfter = DB::table('episodes')
        ->whereIn('module_id', $advancedModuleIds)
        ->orderBy('id')
        ->pluck('id')
        ->map(fn ($id) => (int) $id)
        ->all();

    $advancedQuizIdsAfter = DB::table('quizzes')
        ->whereIn('module_id', $advancedModuleIds)
        ->orderBy('id')
        ->pluck('id')
        ->map(fn ($id) => (int) $id)
        ->all();

    $advancedAssignmentIdsAfter = DB::table('assignments')
        ->whereIn('module_id', $advancedModuleIds)
        ->orderBy('id')
        ->pluck('id')
        ->map(fn ($id) => (int) $id)
        ->all();

    $episodeProgress = DB::table('episode_user')
        ->where('id', $episodeProgressId)
        ->first();

    $quizAttempt = DB::table('quiz_attempts')
        ->where('id', $quizAttemptId)
        ->first();

    expect(DB::table('modules')
            ->where('course_id', ProductionCurriculumTransitionSeeder::COURSE_ID)
            ->count())->toBe(69)
        ->and(DB::table('modules')
            ->where('course_id', ProductionCurriculumTransitionSeeder::COURSE_ID)
            ->where('course_stage_id', $foundationStageId)
            ->count())->toBe(32)
        ->and(DB::table('modules')
            ->where('course_id', ProductionCurriculumTransitionSeeder::COURSE_ID)
            ->where('course_stage_id', $intermediateStageId)
            ->count())->toBe(20)
        ->and(DB::table('modules')
            ->where('course_id', ProductionCurriculumTransitionSeeder::COURSE_ID)
            ->where('course_stage_id', $advancedStageId)
            ->count())->toBe(17)
        ->and($advancedModuleIdsAfter)->toBe($advancedModuleIdsExpected)
        ->and($advancedEpisodeIdsAfter)->toBe($advancedEpisodeIdsBefore)
        ->and($advancedQuizIdsAfter)->toBe($advancedQuizIdsBefore)
        ->and($advancedAssignmentIdsAfter)->toBe($advancedAssignmentIdsBefore)
        ->and($episodeProgress)->not->toBeNull()
        ->and((int) $episodeProgress->user_id)->toBe($learnerId)
        ->and((int) $episodeProgress->episode_id)->toBe($watchedEpisodeId)
        ->and((bool) $episodeProgress->watched)->toBeTrue()
        ->and($quizAttempt)->not->toBeNull()
        ->and((int) $quizAttempt->user_id)->toBe($learnerId)
        ->and((int) $quizAttempt->quiz_id)->toBe($attemptedQuizId)
        ->and((int) $quizAttempt->score)->toBe(80)
        ->and((bool) $quizAttempt->passed)->toBeTrue()
        ->and($quizAttempt->status)->toBe('graded')
        ->and(config('curriculum.course_id'))->toBeNull();
});
