<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use RuntimeException;
use Throwable;

class ImportAdvancedCurriculum extends Command
{
    protected $signature = 'curriculum:import-advanced
        {--course= : Local destination course ID}
        {--file= : Path to the exported JSON snapshot}
        {--apply : Insert records (default is validation only)}';

    protected $description = 'Validate or locally import the historical Advanced curriculum snapshot';

    private const EXPECTED_SHA256 = '55e833b4783ac4812e4bed013078e79f75b09f20a71e68938e7718a35f1e2c0c';
    private const COUNTS = [
        'modules' => 17,
        'episodes' => 43,
        'lesson_blocks' => 0,
        'quizzes' => 20,
        'quiz_questions' => 101,
        'assignments' => 20,
    ];

    public function handle(): int
    {
        try {
            $this->executeImport();
            return self::SUCCESS;
        } catch (Throwable $exception) {
            $this->error('Import stopped: ' . $exception->getMessage());
            return self::FAILURE;
        }
    }

    private function executeImport(): void
    {
        $courseOption = (string) $this->option('course');
        $this->requireCondition(ctype_digit($courseOption) && (int) $courseOption === 9, 'This snapshot may only be imported into local Course ID 9.');

        $config = config('database.connections.' . config('database.default'), []);
        $this->requireCondition(DB::getDriverName() === 'mysql', 'Expected a MySQL/MariaDB connection.');
        $this->requireCondition(in_array($config['host'] ?? null, ['127.0.0.1', 'localhost', '::1'], true), 'Database host must be local.');
        $this->requireCondition(DB::connection()->getDatabaseName() === 'ai_platform_db', 'Unexpected database name.');
        $identity = DB::selectOne('SELECT @@hostname AS hostname');
        $this->requireCondition($identity !== null && $identity->hostname === 'Ekitela.local', 'Unexpected database server identity.');
        $this->requireCondition(Schema::hasColumn('episodes', 'course_id'), 'Local episodes.course_id is missing.');

        $file = $this->option('file') ?: storage_path('app/imports/advanced-curriculum-20261021.json');
        $this->requireCondition(is_file($file) && is_readable($file), 'Snapshot file not readable: ' . $file);
        $this->requireCondition(hash_file('sha256', $file) === self::EXPECTED_SHA256, 'Snapshot checksum mismatch.');
        $data = json_decode(file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);
        $this->requireCondition(is_array($data), 'Invalid snapshot root.');
        $this->requireCondition(($data['schema_version'] ?? null) === 1 && ($data['source_course_id'] ?? null) === 1 && ($data['source_stage_id'] ?? null) === 3, 'Unexpected snapshot metadata.');

        foreach (self::COUNTS as $table => $expected) {
            $this->requireCondition(isset($data[$table]) && is_array($data[$table]) && count($data[$table]) === $expected, "Unexpected {$table} count.");
        }

        $moduleIds = $this->validateIds($data['modules'], 'modules');
        $episodeIds = $this->validateIds($data['episodes'], 'episodes');
        $quizIds = $this->validateIds($data['quizzes'], 'quizzes');
        foreach (['lesson_blocks', 'quiz_questions', 'assignments'] as $table) {
            $this->validateIds($data[$table], $table);
        }

        $positions = [];
        foreach ($data['modules'] as $module) {
            $this->requireCondition((int) ($module['course_id'] ?? 0) === 1 && (int) ($module['course_stage_id'] ?? 0) === 3, 'Unexpected source module parent.');
            $position = $module['position'] ?? null;
            $this->requireCondition(is_int($position) && $position >= 1 && $position <= 17 && !isset($positions[$position]), 'Invalid or duplicate module position.');
            $positions[$position] = true;
        }
        $this->requireCondition(count($positions) === 17, 'Incomplete module positions.');

        foreach ($data['episodes'] as $episode) {
            $this->requireCondition(isset($moduleIds[$episode['module_id'] ?? null]), 'Episode references missing module.');
        }
        foreach ($data['lesson_blocks'] as $block) {
            $this->requireCondition(isset($episodeIds[$block['episode_id'] ?? null]), 'Lesson block references missing episode.');
        }
        foreach ($data['quizzes'] as $quiz) {
            $this->requireCondition(isset($moduleIds[$quiz['module_id'] ?? null]), 'Quiz references missing module.');
        }
        foreach ($data['quiz_questions'] as $question) {
            $this->requireCondition(isset($quizIds[$question['quiz_id'] ?? null]), 'Question references missing quiz.');
        }
        foreach ($data['assignments'] as $assignment) {
            $this->requireCondition(isset($moduleIds[$assignment['module_id'] ?? null]), 'Assignment references missing module.');
        }

        $course = DB::table('courses')->where('id', 9)->first();
        $this->requireCondition($course !== null && $course->title === 'Artificial Intelligence & Automation Systems (AI & Workflow Automation)', 'Destination course does not match.');
        $stage = DB::table('course_stages')->where('id', 3)->where('course_id', 9)->where('slug', 'advanced')->first();
        $this->requireCondition($stage !== null, 'Destination Advanced stage not found.');
        $this->requireCondition(DB::table('modules')->where('course_stage_id', 3)->count() === 0, 'Destination Advanced stage is not empty.');
        $this->requireCondition(DB::table('modules')->where('course_id', 9)->count() === 52, 'Destination course does not have exactly 52 existing modules.');

        foreach (self::COUNTS as $table => $count) {
            $this->line("{$table}: {$count}");
        }
        $this->info('Snapshot checksum, relationships, destination, and local database identity verified.');
        if (!$this->option('apply')) {
            $this->warn('DRY RUN ONLY — no database writes.');
            return;
        }

        DB::transaction(function () use ($data): void {
            $this->requireCondition(DB::table('modules')->where('course_stage_id', 3)->lockForUpdate()->count() === 0, 'Advanced stage populated during import.');
            $this->requireCondition(DB::table('modules')->where('course_id', 9)->count() === 52, 'Destination course changed during import.');

            $moduleMap = [];
            foreach ($data['modules'] as $source) {
                $old = $source['id'];
                $row = $this->withoutId($source);
                $row['course_id'] = 9;
                $row['course_stage_id'] = 3;
                $moduleMap[$old] = DB::table('modules')->insertGetId($row);
            }
            $episodeMap = [];
            foreach ($data['episodes'] as $source) {
                $old = $source['id'];
                $row = $this->withoutId($source);
                $row['module_id'] = $moduleMap[$source['module_id']];
                $row['course_id'] = 9;
                $episodeMap[$old] = DB::table('episodes')->insertGetId($row);
            }
            foreach ($data['lesson_blocks'] as $source) {
                $row = $this->withoutId($source);
                $row['episode_id'] = $episodeMap[$source['episode_id']];
                DB::table('lesson_blocks')->insert($row);
            }
            $quizMap = [];
            foreach ($data['quizzes'] as $source) {
                $old = $source['id'];
                $row = $this->withoutId($source);
                $row['module_id'] = $moduleMap[$source['module_id']];
                $quizMap[$old] = DB::table('quizzes')->insertGetId($row);
            }
            foreach ($data['quiz_questions'] as $source) {
                $row = $this->withoutId($source);
                $row['quiz_id'] = $quizMap[$source['quiz_id']];
                DB::table('quiz_questions')->insert($row);
            }
            foreach ($data['assignments'] as $source) {
                $row = $this->withoutId($source);
                $row['module_id'] = $moduleMap[$source['module_id']];
                DB::table('assignments')->insert($row);
            }

            $newModuleIds = array_values($moduleMap);
            $newEpisodeIds = array_values($episodeMap);
            $newQuizIds = array_values($quizMap);
            $actual = [
                'modules' => DB::table('modules')->whereIn('id', $newModuleIds)->count(),
                'episodes' => DB::table('episodes')->whereIn('module_id', $newModuleIds)->count(),
                'lesson_blocks' => DB::table('lesson_blocks')->whereIn('episode_id', $newEpisodeIds)->count(),
                'quizzes' => DB::table('quizzes')->whereIn('module_id', $newModuleIds)->count(),
                'quiz_questions' => DB::table('quiz_questions')->whereIn('quiz_id', $newQuizIds)->count(),
                'assignments' => DB::table('assignments')->whereIn('module_id', $newModuleIds)->count(),
            ];
            foreach (self::COUNTS as $table => $expected) {
                $this->requireCondition($actual[$table] === $expected, "Post-insert {$table} count mismatch.");
            }
            $this->requireCondition(DB::table('modules')->where('course_id', 9)->count() === 69, 'Expected 69 total course modules.');
            $this->requireCondition(DB::table('episodes')->whereIn('id', $newEpisodeIds)->where('course_id', 9)->count() === 43, 'Episode course mapping mismatch.');
        }, 1);

        $this->info('APPLY SUCCEEDED — 201 records imported into local Advanced stage.');
        $this->warn('PDF files are NOT transferred by this command.');
    }

    private function validateIds(array $rows, string $table): array
    {
        $ids = [];
        foreach ($rows as $row) {
            $this->requireCondition(is_array($row) && isset($row['id']) && is_int($row['id']) && $row['id'] > 0, "Invalid {$table} record ID.");
            $this->requireCondition(!isset($ids[$row['id']]), "Duplicate {$table} record ID.");
            $ids[$row['id']] = true;
        }
        return $ids;
    }

    private function withoutId(array $source): array
    {
        unset($source['id']);
        return $source;
    }

    private function requireCondition(bool $condition, string $message): void
    {
        if (!$condition) {
            throw new RuntimeException($message);
        }
    }
}
