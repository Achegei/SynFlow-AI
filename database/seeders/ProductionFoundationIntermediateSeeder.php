<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseStage;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ProductionFoundationIntermediateSeeder extends Seeder
{
    public function run(): void
    {
        $this->preflight();

        $previousCourseId = config('curriculum.course_id');

        try {
            // Production targeting is explicit and exists only for this run.
            config([
                'curriculum.course_id' => ProductionCurriculumTransitionSeeder::COURSE_ID,
            ]);

            DB::transaction(function (): void {
                $this->call([
                    FoundationCurriculumSeeder::class,
                    BeginnerReadinessSeeder::class,
                    TechnologyTerminologySeeder::class,
                    IntermediateProblemSolvingSeeder::class,
                ]);

                $this->validateFinalStructure();
            });
        } finally {
            // Do not leak the production target into later seeders in the same process.
            config([
                'curriculum.course_id' => $previousCourseId,
            ]);
        }

        $this->command?->info(
            'Production Foundation and Intermediate curriculum import completed and validated.'
        );
    }

    private function preflight(): void
    {
        $courseId = ProductionCurriculumTransitionSeeder::COURSE_ID;

        $course = Course::find($courseId);

        if (! $course) {
            throw new RuntimeException(
                'Production curriculum import aborted: Course ID 1 was not found.'
            );
        }

        if (trim($course->title) !== ProductionCurriculumTransitionSeeder::COURSE_TITLE) {
            throw new RuntimeException(
                "Production curriculum import aborted: Course ID 1 title does not match. Found: {$course->title}"
            );
        }

        $stages = CourseStage::query()
            ->where('course_id', $courseId)
            ->get()
            ->keyBy('slug');

        foreach ([
            'foundation' => 1,
            'intermediate' => 2,
            'advanced' => 3,
        ] as $slug => $position) {
            $stage = $stages->get($slug);

            if (! $stage) {
                throw new RuntimeException(
                    "Production curriculum import aborted: {$slug} stage was not found. Run ProductionCurriculumTransitionSeeder first."
                );
            }

            if ((int) $stage->position !== $position) {
                throw new RuntimeException(
                    "Production curriculum import aborted: {$slug} stage has position {$stage->position}; expected {$position}."
                );
            }
        }

        $this->validateAdvancedModules($stages['advanced']);

        $allowedStageIds = [
            (int) $stages['foundation']->id,
            (int) $stages['intermediate']->id,
            (int) $stages['advanced']->id,
        ];

        $unexpectedModules = Module::query()
            ->where('course_id', $courseId)
            ->where(function ($query) use ($allowedStageIds): void {
                $query->whereNull('course_stage_id')
                    ->orWhereNotIn('course_stage_id', $allowedStageIds);
            })
            ->count();

        if ($unexpectedModules !== 0) {
            throw new RuntimeException(
                "Production curriculum import aborted: found {$unexpectedModules} module(s) outside the expected course stages."
            );
        }
    }

    private function validateAdvancedModules(CourseStage $advancedStage): void
    {
        $courseId = ProductionCurriculumTransitionSeeder::COURSE_ID;
        $expectedModules = ProductionCurriculumTransitionSeeder::expectedAdvancedModules();

        $advancedModules = Module::query()
            ->where('course_id', $courseId)
            ->where('course_stage_id', $advancedStage->id)
            ->get();

        if ($advancedModules->count() !== count($expectedModules)) {
            throw new RuntimeException(
                'Production curriculum import aborted: expected exactly '
                .count($expectedModules)
                ." Advanced modules, found {$advancedModules->count()}."
            );
        }

        foreach ($expectedModules as $moduleId => $expected) {
            $module = $advancedModules->firstWhere('id', $moduleId);

            if (! $module) {
                throw new RuntimeException(
                    "Production curriculum import aborted: Advanced module ID {$moduleId} was not found."
                );
            }

            if ((int) $module->position !== $expected['position']) {
                throw new RuntimeException(
                    "Production curriculum import aborted: Advanced module ID {$moduleId} "
                    ."has position {$module->position}; expected {$expected['position']}."
                );
            }

            if (trim($module->title) !== $expected['title']) {
                throw new RuntimeException(
                    "Production curriculum import aborted: Advanced module ID {$moduleId} title mismatch. Found: {$module->title}"
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
                        "Production curriculum import aborted: Advanced module ID {$moduleId} "
                        ."has {$actualCounts[$relation]} {$relation}; "
                        ."expected {$expected[$relation]}."
                    );
                }
            }
        }
    }

    private function validateFinalStructure(): void
    {
        $courseId = ProductionCurriculumTransitionSeeder::COURSE_ID;

        $stages = CourseStage::query()
            ->where('course_id', $courseId)
            ->whereIn('slug', ['foundation', 'intermediate', 'advanced'])
            ->get()
            ->keyBy('slug');

        $expectedCounts = [
            'foundation' => 32,
            'intermediate' => 20,
            'advanced' => 17,
        ];

        foreach ($expectedCounts as $slug => $expectedCount) {
            $stage = $stages->get($slug);

            if (! $stage) {
                throw new RuntimeException(
                    "Production curriculum validation failed: {$slug} stage is missing."
                );
            }

            $actualCount = Module::query()
                ->where('course_id', $courseId)
                ->where('course_stage_id', $stage->id)
                ->count();

            if ($actualCount !== $expectedCount) {
                throw new RuntimeException(
                    "Production curriculum validation failed: {$slug} has {$actualCount} modules; expected {$expectedCount}."
                );
            }
        }

        $totalModules = Module::query()
            ->where('course_id', $courseId)
            ->count();

        if ($totalModules !== 69) {
            throw new RuntimeException(
                "Production curriculum validation failed: Course ID 1 has {$totalModules} modules; expected 69."
            );
        }

        // Revalidate the original production curriculum after the import.
        $this->validateAdvancedModules($stages['advanced']);
    }
}
