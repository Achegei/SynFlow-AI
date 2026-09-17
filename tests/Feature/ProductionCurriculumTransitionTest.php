<?php

use Database\Seeders\ProductionCurriculumTransitionSeeder;
use Illuminate\Support\Facades\DB;

it('transitions the existing production curriculum into Advanced without replacing existing records', function () {
    $now = now();

    DB::table('courses')->insert([
        'id' => 1,
        'title' => 'Artificial Intelligence & Automation Systems (AI & Workflow Automation)',
        'description' => 'Production curriculum test fixture.',
        'image_url' => null,
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    $modules = [
        1  => ['position' => 1,  'title' => 'Introduction to AI & Industry Context', 'episodes' => 8,  'quizzes' => 8, 'assignments' => 8],
        2  => ['position' => 2,  'title' => 'Understanding AI in Business', 'episodes' => 2, 'quizzes' => 2, 'assignments' => 2],
        3  => ['position' => 3,  'title' => 'Prompt Engineering Fundamentals', 'episodes' => 2, 'quizzes' => 2, 'assignments' => 2],
        4  => ['position' => 4,  'title' => 'Markdown for AI Communication', 'episodes' => 1, 'quizzes' => 1, 'assignments' => 1],
        5  => ['position' => 5,  'title' => 'Tools for AI Automation (No-Code)', 'episodes' => 17, 'quizzes' => 0, 'assignments' => 0],
        6  => ['position' => 6,  'title' => 'APIs & Integrations', 'episodes' => 1, 'quizzes' => 1, 'assignments' => 1],
        7  => ['position' => 7,  'title' => 'Large Language Models (LLMs)', 'episodes' => 1, 'quizzes' => 1, 'assignments' => 1],
        8  => ['position' => 8,  'title' => 'Full Course Building AI-Powered Automation Workflows n8n', 'episodes' => 1, 'quizzes' => 0, 'assignments' => 0],
        9  => ['position' => 9,  'title' => 'N8N Webhooks', 'episodes' => 1, 'quizzes' => 1, 'assignments' => 1],
        11 => ['position' => 10, 'title' => 'AI Chat Agents', 'episodes' => 3, 'quizzes' => 0, 'assignments' => 0],
        12 => ['position' => 11, 'title' => 'WhatsApp AI Agent', 'episodes' => 1, 'quizzes' => 1, 'assignments' => 1],
        13 => ['position' => 12, 'title' => 'AI Voice Receptionist', 'episodes' => 1, 'quizzes' => 1, 'assignments' => 0],
        14 => ['position' => 13, 'title' => 'Outbound Call AI Agent', 'episodes' => 1, 'quizzes' => 1, 'assignments' => 1],
        10 => ['position' => 14, 'title' => 'Agentic Workflows', 'episodes' => 1, 'quizzes' => 1, 'assignments' => 1],
        15 => ['position' => 15, 'title' => 'Final Project', 'episodes' => 0, 'quizzes' => 0, 'assignments' => 1],
        16 => ['position' => 16, 'title' => 'Pricing AI Automation & Workflow Systems', 'episodes' => 1, 'quizzes' => 0, 'assignments' => 0],
        17 => ['position' => 17, 'title' => 'How to Get Your First AI Automation Client', 'episodes' => 1, 'quizzes' => 0, 'assignments' => 0],
    ];

    $episodePosition = [];
    $quizPosition = [];
    $assignmentPosition = [];

    foreach ($modules as $moduleId => $module) {
        DB::table('modules')->insert([
            'id' => $moduleId,
            'course_id' => 1,
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

    $before = [
        'modules' => DB::table('modules')
            ->where('course_id', 1)
            ->orderBy('id')
            ->pluck('id')
            ->all(),

        'episodes' => DB::table('episodes')
            ->whereIn('module_id', array_keys($modules))
            ->orderBy('id')
            ->pluck('id')
            ->all(),

        'quizzes' => DB::table('quizzes')
            ->whereIn('module_id', array_keys($modules))
            ->orderBy('id')
            ->pluck('id')
            ->all(),

        'assignments' => DB::table('assignments')
            ->whereIn('module_id', array_keys($modules))
            ->orderBy('id')
            ->pluck('id')
            ->all(),
    ];

    expect($before['modules'])->toHaveCount(17)
        ->and($before['episodes'])->toHaveCount(43)
        ->and($before['quizzes'])->toHaveCount(20)
        ->and($before['assignments'])->toHaveCount(20);

    $this->seed(ProductionCurriculumTransitionSeeder::class);

    $stages = DB::table('course_stages')
        ->where('course_id', 1)
        ->orderBy('position')
        ->get();

    expect($stages)->toHaveCount(3)
        ->and($stages->pluck('slug')->all())
        ->toBe(['foundation', 'intermediate', 'advanced'])
        ->and($stages->pluck('title')->all())
        ->toBe(['Foundation', 'Intermediate', 'Advanced'])
        ->and($stages->pluck('position')->all())
        ->toBe([1, 2, 3]);

    $advancedStageId = DB::table('course_stages')
        ->where('course_id', 1)
        ->where('slug', 'advanced')
        ->value('id');

    expect(
        DB::table('modules')
            ->where('course_id', 1)
            ->where('course_stage_id', $advancedStageId)
            ->count()
    )->toBe(17);

    expect(
        DB::table('modules')
            ->where('course_id', 1)
            ->whereNull('course_stage_id')
            ->count()
    )->toBe(0);

    $after = [
        'modules' => DB::table('modules')
            ->where('course_id', 1)
            ->orderBy('id')
            ->pluck('id')
            ->all(),

        'episodes' => DB::table('episodes')
            ->whereIn('module_id', array_keys($modules))
            ->orderBy('id')
            ->pluck('id')
            ->all(),

        'quizzes' => DB::table('quizzes')
            ->whereIn('module_id', array_keys($modules))
            ->orderBy('id')
            ->pluck('id')
            ->all(),

        'assignments' => DB::table('assignments')
            ->whereIn('module_id', array_keys($modules))
            ->orderBy('id')
            ->pluck('id')
            ->all(),
    ];

    expect($after)->toBe($before)
        ->and($after['modules'])->toHaveCount(17)
        ->and($after['episodes'])->toHaveCount(43)
        ->and($after['quizzes'])->toHaveCount(20)
        ->and($after['assignments'])->toHaveCount(20);
});
