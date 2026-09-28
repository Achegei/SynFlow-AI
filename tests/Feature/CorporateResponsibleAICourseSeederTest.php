<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\CourseStage;
use App\Models\Episode;
use App\Models\LessonBlock;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Database\Seeders\CorporateResponsibleAICourseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CorporateResponsibleAICourseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_corporate_course_is_created_with_complete_curriculum(): void
    {
        $this->seed(CorporateResponsibleAICourseSeeder::class);

        $course = Course::find(2);

        $this->assertNotNull($course);

        $this->assertSame(
            'Corporate AI Ethics, Governance & Responsible AI in the Workplace',
            $course->title
        );

        $this->assertSame(6, CourseStage::where('course_id', 2)->count());
        $this->assertSame(30, Module::where('course_id', 2)->count());
        $this->assertSame(30, Episode::whereHas('module', fn ($q) =>
            $q->where('course_id', 2)
        )->count());

        $this->assertSame(30, Quiz::whereHas('module', fn ($q) =>
            $q->where('course_id', 2)
        )->count());

        $this->assertSame(90, QuizQuestion::whereHas('quiz.module', fn ($q) =>
            $q->where('course_id', 2)
        )->count());

        $this->assertSame(30, Assignment::whereHas('module', fn ($q) =>
            $q->where('course_id', 2)
        )->count());

        $this->assertGreaterThan(
            0,
            LessonBlock::whereHas('episode.module', fn ($q) =>
                $q->where('course_id', 2)
            )->count()
        );
    }

    public function test_every_corporate_module_has_stage_episode_quiz_and_assignment(): void
    {
        $this->seed(CorporateResponsibleAICourseSeeder::class);

        $modules = Module::where('course_id', 2)
            ->with(['stage', 'episodes', 'quizzes', 'assignments'])
            ->orderBy('position')
            ->get();

        $this->assertCount(30, $modules);

        foreach ($modules as $module) {
            $this->assertNotNull($module->stage);
            $this->assertSame(2, $module->stage->course_id);

            $this->assertCount(1, $module->episodes);
            $this->assertCount(1, $module->quizzes);
            $this->assertCount(1, $module->assignments);

            $this->assertGreaterThan(
                0,
                $module->episodes->first()->blocks()->count()
            );

            $this->assertCount(
                3,
                $module->quizzes->first()->questions
            );
        }
    }

    public function test_corporate_course_is_idempotent(): void
    {
        $this->seed(CorporateResponsibleAICourseSeeder::class);

        $firstCounts = [
            'stages' => CourseStage::where('course_id', 2)->count(),
            'modules' => Module::where('course_id', 2)->count(),
            'episodes' => Episode::whereHas('module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
            'quizzes' => Quiz::whereHas('module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
            'questions' => QuizQuestion::whereHas('quiz.module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
            'assignments' => Assignment::whereHas('module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
            'blocks' => LessonBlock::whereHas('episode.module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
        ];

        $this->seed(CorporateResponsibleAICourseSeeder::class);

        $secondCounts = [
            'stages' => CourseStage::where('course_id', 2)->count(),
            'modules' => Module::where('course_id', 2)->count(),
            'episodes' => Episode::whereHas('module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
            'quizzes' => Quiz::whereHas('module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
            'questions' => QuizQuestion::whereHas('quiz.module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
            'assignments' => Assignment::whereHas('module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
            'blocks' => LessonBlock::whereHas('episode.module', fn ($q) =>
                $q->where('course_id', 2)
            )->count(),
        ];

        $this->assertSame($firstCounts, $secondCounts);
    }

    public function test_corporate_course_uses_six_expected_stages(): void
    {
        $this->seed(CorporateResponsibleAICourseSeeder::class);

        $stages = CourseStage::where('course_id', 2)
            ->orderBy('position')
            ->pluck('slug')
            ->all();

        $this->assertSame([
            'ai-foundations',
            'responsible-workplace-ai',
            'ai-systems-and-risk',
            'ai-governance',
            'leadership-and-culture',
            'implementation',
        ], $stages);
    }

    public function test_corporate_multiple_choice_answers_use_option_keys(): void
{
    $this->seed(CorporateResponsibleAICourseSeeder::class);

    $questions = QuizQuestion::whereHas('quiz.module', function ($query) {
        $query->where('course_id', 2);
    })->get();

    $this->assertCount(90, $questions);

    foreach ($questions as $question) {
        $this->assertIsArray($question->options);

        $this->assertNotEmpty($question->options);

        foreach ($question->options as $key => $option) {
            $this->assertMatchesRegularExpression('/^[A-Z]$/', $key);
            $this->assertIsString($option);
        }

        $this->assertArrayHasKey(
            $question->correct_answer,
            $question->options
        );
    }
}
}
