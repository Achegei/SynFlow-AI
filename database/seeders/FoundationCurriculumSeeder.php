<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\CourseStage;
use App\Models\Episode;
use App\Models\LessonBlock;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class FoundationCurriculumSeeder extends Seeder
{
    private const DEFAULT_COURSE_ID = 9;
    private const STAGE_SLUG = 'foundation';

    private ?int $resolvedCourseId = null;
    private ?int $resolvedStageId = null;

    public function run(): void
    {
        DB::transaction(function (): void {
            $this->createStructure();
            $this->importCoreModules();
            $this->validateStructure();
        });
    }

    private function courseId(): int
    {
        if ($this->resolvedCourseId !== null) {
            return $this->resolvedCourseId;
        }

        $configuredCourseId = config('curriculum.course_id');

        if ($configuredCourseId !== null) {
            $courseId = filter_var(
                $configuredCourseId,
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            );

            if ($courseId === false) {
                throw new RuntimeException(
                    'Invalid curriculum.course_id configuration. Expected a positive integer.'
                );
            }

            return $this->resolvedCourseId = $courseId;
        }

        if (app()->environment(['local', 'testing'])) {
            return $this->resolvedCourseId = self::DEFAULT_COURSE_ID;
        }

        throw new RuntimeException(
            'Curriculum target course is not configured. Refusing to use a production fallback.'
        );
    }

    private function stageId(): int
    {
        if ($this->resolvedStageId !== null) {
            return $this->resolvedStageId;
        }

        $stageId = CourseStage::query()
            ->where('course_id', $this->courseId())
            ->where('slug', self::STAGE_SLUG)
            ->value('id');

        if (! $stageId) {
            throw new RuntimeException(
                "Foundation stage was not found for course {$this->courseId()}."
            );
        }

        return $this->resolvedStageId = (int) $stageId;
    }

    private function createStructure(): void
    {
        $modules = [
            1 => [
                'title' => 'Understanding Artificial Intelligence',
                'description' => null,
            ],
            2 => [
                'title' => 'Generative AI and Prompting',
                'description' => 'Learn what Generative AI is, how to communicate with AI using prompts, how to structure stronger instructions, and how to improve AI responses through iteration.',
            ],
            3 => [
                'title' => 'Applying AI',
                'description' => 'Learn how to apply Artificial Intelligence practically in education, workplace tasks, career development, and business activities.',
            ],
            4 => [
                'title' => 'AI Accuracy, Privacy, and Responsibility',
                'description' => 'Learn how to recognize AI errors, verify AI-generated information, protect privacy, and use Artificial Intelligence responsibly.',
            ],
            5 => [
                'title' => 'Automating Tasks',
                'description' => 'Learn the foundations of automation, understand how workflows are structured, and explore when Artificial Intelligence should and should not be added to an automated process.',
            ],
            6 => [
                'title' => 'Building AI Assistants',
                'description' => 'Learn what an AI assistant is and how to define its purpose, users, knowledge, boundaries, and human escalation requirements.',
            ],
            7 => [
                'title' => 'Building AI Agents',
                'description' => 'Learn what an AI agent is, how agents work toward defined goals through multiple steps, the basic components of an agent, and why permissions and human control are essential.',
            ],
            8 => [
                'title' => 'Problem Solving with AI',
                'description' => 'Learn how to begin with a real problem, determine whether AI is actually needed, and design practical AI-powered solutions with clear roles for AI, automation, human oversight, safeguards, and success measures.',
            ],
            9 => [
                'title' => 'Final Capstone Project',
                'description' => 'Bring together the knowledge and practical skills developed throughout Artificial Intelligence Foundations by designing and presenting a complete practical AI-powered solution.',
            ],
            10 => [
                'title' => 'Beginner Readiness — Artificial Intelligence Foundations',
                'description' => 'Artificial Intelligence Beginner Readiness',
            ],
            11 => [
                'title' => 'Beginner Readiness — From AI User to AI Problem Solver',
                'description' => 'Artificial Intelligence Beginner Readiness',
            ],
            12 => [
                'title' => 'Beginner Readiness — Chatbot Readiness',
                'description' => 'Artificial Intelligence Beginner Readiness',
            ],
            13 => [
                'title' => 'Beginner Readiness — Automation Readiness',
                'description' => 'Artificial Intelligence Beginner Readiness',
            ],
            14 => [
                'title' => 'Beginner Readiness — API and Webhook Readiness',
                'description' => 'Artificial Intelligence Beginner Readiness',
            ],
            15 => [
                'title' => 'Beginner Readiness — LLM and Modern AI Applications',
                'description' => 'Artificial Intelligence Beginner Readiness',
            ],
            16 => [
                'title' => 'Technology & Terminology — Basic Artificial Intelligence Language',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            17 => [
                'title' => 'Technology & Terminology — Language AI & Generative AI',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            18 => [
                'title' => 'Technology & Terminology — Chatbot Technology',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            19 => [
                'title' => 'Technology & Terminology — Automation Technology',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            20 => [
                'title' => 'Technology & Terminology — Webhooks & APIs',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            21 => [
                'title' => 'Technology & Terminology — Structured Data',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            22 => [
                'title' => 'Technology & Terminology — Modern AI Application Terminology',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            23 => [
                'title' => 'Technology & Terminology — RAG & Knowledge Technology',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            24 => [
                'title' => 'Technology & Terminology — Multimodal & Vision AI',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            25 => [
                'title' => 'Technology & Terminology — Speech & Voice AI',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            26 => [
                'title' => 'Technology & Terminology — AI Agents & Agentic Systems',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            27 => [
                'title' => 'Technology & Terminology — Security & Responsible AI Terminology',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            28 => [
                'title' => 'Technology & Terminology — Testing & Evaluation',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            29 => [
                'title' => 'Technology & Terminology — System Operations',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            30 => [
                'title' => 'Technology & Terminology — Database & Application Terminology',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            31 => [
                'title' => 'Technology & Terminology — Training & Customization',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
            32 => [
                'title' => 'Technology & Terminology — Cloud & Deployment Technology',
                'description' => 'Artificial Intelligence Technology & Terminology — Beginner to Advanced',
            ],
        ];

        foreach ($modules as $position => $data) {
            Module::updateOrCreate(
                [
                    'course_id' => $this->courseId(),
                    'course_stage_id' => $this->stageId(),
                    'position' => $position,
                ],
                [
                    'title' => $data['title'],
                    'description' => $data['description'],
                ]
            );
        }

        $this->command?->info(
            'Foundation structure created: 32 modules.'
        );
    }

    private function importCoreModules(): void
    {
        $path = database_path('data/foundation-core-modules.json');

        if (! is_file($path)) {
            throw new RuntimeException(
                "Foundation core curriculum fixture was not found: {$path}"
            );
        }

        $data = json_decode(
            file_get_contents($path),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        if (! is_array($data) || count($data) !== 9) {
            throw new RuntimeException(
                'Foundation core curriculum fixture must contain exactly 9 modules.'
            );
        }

        foreach ($data as $moduleData) {
            $position = (int) ($moduleData['position'] ?? 0);

            if ($position < 1 || $position > 9) {
                throw new RuntimeException(
                    "Invalid Foundation core module position: {$position}."
                );
            }

            $module = Module::query()
                ->where('course_id', $this->courseId())
                ->where('course_stage_id', $this->stageId())
                ->where('position', $position)
                ->firstOrFail();

            $module->update([
                'title' => $moduleData['title'],
                'description' => $moduleData['description'] ?? null,
            ]);

            $this->importEpisodes(
                $module,
                $moduleData['episodes'] ?? []
            );

            $this->importQuizzes(
                $module,
                $moduleData['quizzes'] ?? []
            );

            $this->importAssignments(
                $module,
                $moduleData['assignments'] ?? []
            );
        }

        $this->command?->info(
            'Foundation core curriculum imported: modules 1–9.'
        );
    }

    private function importEpisodes(Module $module, array $episodes): void
    {
        foreach ($episodes as $episodeData) {
            $episode = Episode::updateOrCreate(
                [
                    'module_id' => $module->id,
                    'position' => $episodeData['position'],
                ],
                [
                    'title' => $episodeData['title'],
                    'description' => $episodeData['description'] ?? null,
                    'video_url' => $episodeData['video_url'] ?? null,
                    'pdf_path' => $episodeData['pdf_path'] ?? null,
                    'type' => $episodeData['type'] ?? 'lesson',

                ]
            );

            foreach ($episodeData['lesson_blocks'] ?? [] as $blockData) {
                LessonBlock::updateOrCreate(
                    [
                        'episode_id' => $episode->id,
                        'position' => $blockData['position'],
                    ],
                    [
                        'type' => $blockData['type'],
                        'title' => $blockData['title'] ?? null,
                        'content' => $blockData['content'] ?? null,
                        'metadata' => $this->decodeJsonArray(
                            $blockData['metadata'] ?? null
                        ),
                    ]
                );
            }
        }
    }

    private function importQuizzes(Module $module, array $quizzes): void
    {
        foreach ($quizzes as $quizData) {
            $quiz = Quiz::updateOrCreate(
                [
                    'module_id' => $module->id,
                    'position' => $quizData['position'],
                ],
                [
                    'title' => $quizData['title'],
                    'description' => $quizData['description'] ?? null,
                ]
            );

            foreach ($quizData['questions'] ?? [] as $questionData) {
                QuizQuestion::updateOrCreate(
                    [
                        'quiz_id' => $quiz->id,
                        'position' => $questionData['position'],
                    ],
                    [
                        'question' => $questionData['question'],
                        'type' => $questionData['type'],
                        'options' => $questionData['options'] ?? [],
                        'correct_answer' => $questionData['correct_answer'] ?? null,
                        'max_points' => $questionData['max_points'] ?? 1,
                    ]
                );
            }
        }
    }

    private function importAssignments(Module $module, array $assignments): void
    {
        foreach ($assignments as $assignmentData) {
            Assignment::updateOrCreate(
                [
                    'module_id' => $module->id,
                    'position' => $assignmentData['position'],
                ],
                [
                    'title' => $assignmentData['title'],
                    'instructions' => $assignmentData['instructions'] ?? null,
                    'submission_type' => $assignmentData['submission_type'],
                ]
            );
        }
    }

    private function decodeJsonArray(mixed $value): ?array
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_array($value)) {
            return $value;
        }

        if (! is_string($value)) {
            throw new RuntimeException(
                'Lesson block metadata must be JSON, an array, or null.'
            );
        }

        $decoded = json_decode($value, true, 512, JSON_THROW_ON_ERROR);

        if (! is_array($decoded)) {
            throw new RuntimeException(
                'Lesson block metadata JSON must decode to an array.'
            );
        }

        return $decoded;
    }

    private function validateStructure(): void
    {
        $count = Module::query()
            ->where('course_id', $this->courseId())
            ->where('course_stage_id', $this->stageId())
            ->whereBetween('position', [1, 32])
            ->count();

        if ($count !== 32) {
            throw new RuntimeException(
                "Expected 32 Foundation modules, found {$count}."
            );
        }

        $this->command?->info(
            'Foundation structure validated: 32 modules.'
        );
    }
}
