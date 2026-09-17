<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseStage;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class ProductionCurriculumTransitionSeeder extends Seeder
{
    public const COURSE_ID = 1;

    public const COURSE_TITLE = 'Artificial Intelligence & Automation Systems (AI & Workflow Automation)';

    /**
     * Exact Advanced curriculum currently present in production.
     *
     * These records must be preserved in place. The transition must never
     * recreate, delete, or replace them.
     */
    private const EXPECTED_ADVANCED_MODULES = [
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

    public static function expectedAdvancedModules(): array
    {
        return self::EXPECTED_ADVANCED_MODULES;
    }

    public function run(): void
    {
        $this->preflight();

        DB::transaction(function (): void {
            $stages = $this->createStages();

            $advancedStageId = $stages['advanced']->id;

            $updated = Module::query()
                ->where('course_id', self::COURSE_ID)
                ->whereNull('course_stage_id')
                ->whereIn('id', array_keys(self::EXPECTED_ADVANCED_MODULES))
                ->update([
                    'course_stage_id' => $advancedStageId,
                ]);

            if ($updated !== count(self::EXPECTED_ADVANCED_MODULES)) {
                throw new RuntimeException(
                    "Production curriculum transition aborted: expected to assign "
                    .count(self::EXPECTED_ADVANCED_MODULES)
                    ." modules to Advanced, but {$updated} rows were updated."
                );
            }

            $assignedIds = Module::query()
                ->where('course_id', self::COURSE_ID)
                ->where('course_stage_id', $advancedStageId)
                ->orderBy('id')
                ->pluck('id')
                ->all();

            $expectedIds = array_keys(self::EXPECTED_ADVANCED_MODULES);
            sort($expectedIds);

            if ($assignedIds !== $expectedIds) {
                throw new RuntimeException(
                    'Production curriculum transition aborted: Advanced module assignment validation failed.'
                );
            }
        });

        $this->command?->info(
            'Production curriculum transition completed: stages created and the 17 existing modules assigned to Advanced in place.'
        );
    }

    private function createStages(): array
    {
        $definitions = [
            'foundation' => [
                'title' => 'Foundation',
                'description' => 'Artificial Intelligence foundations and beginner readiness.',
                'position' => 1,
            ],
            'intermediate' => [
                'title' => 'Intermediate',
                'description' => 'AI automation, troubleshooting, testing, and problem-solving.',
                'position' => 2,
            ],
            'advanced' => [
                'title' => 'Advanced',
                'description' => 'Advanced AI automation systems and professional implementation.',
                'position' => 3,
            ],
        ];

        $stages = [];

        foreach ($definitions as $slug => $attributes) {
            $stages[$slug] = CourseStage::updateOrCreate(
                [
                    'course_id' => self::COURSE_ID,
                    'slug' => $slug,
                ],
                $attributes
            );
        }

        return $stages;
    }

    private function preflight(): void
    {
        $requiredTables = [
            'course_stages',
            'lesson_blocks',
            'quiz_attempt_answers',
        ];

        foreach ($requiredTables as $table) {
            if (! Schema::hasTable($table)) {
                throw new RuntimeException(
                    "Production curriculum transition aborted: required table {$table} does not exist. Run the curriculum migrations first."
                );
            }
        }

        $requiredColumns = [
            ['modules', 'course_stage_id'],
            ['quiz_questions', 'type'],
            ['quiz_questions', 'max_points'],
            ['quiz_attempts', 'status'],
            ['quiz_attempt_answers', 'points_awarded'],
            ['quiz_attempt_answers', 'review_feedback'],
            ['quiz_attempt_answers', 'reviewed_at'],
            ['quiz_attempt_answers', 'reviewed_by'],
        ];

        foreach ($requiredColumns as [$table, $column]) {
            if (! Schema::hasColumn($table, $column)) {
                throw new RuntimeException(
                    "Production curriculum transition aborted: required column {$table}.{$column} does not exist. Run the curriculum migrations first."
                );
            }
        }

        $course = Course::find(self::COURSE_ID);

        if (! $course) {
            throw new RuntimeException(
                'Production curriculum transition aborted: Course ID 1 was not found.'
            );
        }

        if (trim($course->title) !== self::COURSE_TITLE) {
            throw new RuntimeException(
                "Production curriculum transition aborted: Course ID 1 title does not match. Found: {$course->title}"
            );
        }

        $modules = Module::query()
            ->where('course_id', self::COURSE_ID)
            ->orderBy('position')
            ->get();

        if ($modules->count() !== count(self::EXPECTED_ADVANCED_MODULES)) {
            throw new RuntimeException(
                'Production curriculum transition aborted: expected exactly '
                .count(self::EXPECTED_ADVANCED_MODULES)
                ." existing modules, found {$modules->count()}."
            );
        }

        foreach (self::EXPECTED_ADVANCED_MODULES as $moduleId => $expected) {
            $module = $modules->firstWhere('id', $moduleId);

            if (! $module) {
                throw new RuntimeException(
                    "Production curriculum transition aborted: expected module ID {$moduleId} was not found."
                );
            }

            if ((int) $module->position !== $expected['position']) {
                throw new RuntimeException(
                    "Production curriculum transition aborted: module ID {$moduleId} has position {$module->position}; expected {$expected['position']}."
                );
            }

            if (trim($module->title) !== $expected['title']) {
                throw new RuntimeException(
                    "Production curriculum transition aborted: module ID {$moduleId} title mismatch. Found: {$module->title}"
                );
            }

            if ($module->course_stage_id !== null) {
                throw new RuntimeException(
                    "Production curriculum transition aborted: module ID {$moduleId} is already assigned to course stage {$module->course_stage_id}."
                );
            }

            $actualCounts = [
                'episodes' => $module->episodes()->count(),
                'quizzes' => $module->quizzes()->count(),
                'assignments' => $module->assignments()->count(),
            ];

            foreach (['episodes', 'quizzes', 'assignments'] as $relation) {
                if ($actualCounts[$relation] !== $expected[$relation]) {
                    throw new RuntimeException(
                        "Production curriculum transition aborted: module ID {$moduleId} "
                        ."has {$actualCounts[$relation]} {$relation}; "
                        ."expected {$expected[$relation]}."
                    );
                }
            }
        }
    }
}
