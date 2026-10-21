<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AuditStudentContent extends Command
{
    protected $signature = 'curriculum:audit-student-content
        {--course= : Restrict the audit to one course ID}
        {--output= : CSV output path}';

    protected $description = 'Read-only editorial audit of student-facing curriculum content';

    private array $rules = [
        'Third-person learner instruction' => [
            'high',
            '/\b(?:the\s+)?learners?\s+(?:should|must|will|needs?\s+to|is\s+expected\s+to|are\s+expected\s+to)\b/iu',
        ],
        'Third-person student instruction' => [
            'high',
            '/\b(?:the\s+)?students?\s+(?:should|must|will|needs?\s+to|is\s+expected\s+to|are\s+expected\s+to)\b/iu',
        ],
        'Teacher-facing instruction' => [
            'high',
            '/\b(?:the\s+)?(?:teacher|facilitator|instructor|trainer|educator)\s+(?:should|must|will|shall|needs?\s+to|is\s+expected\s+to|demonstrates?|explains?|guides?|asks?|instructs?)\b/iu',
        ],
        'Instruction to direct learners' => [
            'high',
            '/\b(?:ask|tell|instruct|guide|encourage|remind|have)\s+(?:the\s+)?(?:students?|learners?|participants?)\s+to\b/iu',
        ],
        'Third-person participant instruction' => [
            'medium',
            '/\bparticipants?\s+(?:should|must|will|are\s+expected\s+to|is\s+expected\s+to)\b/iu',
        ],
        'Instructor-only material' => [
            'high',
            '/\b(?:teachers?[’\']?\s+notes?|facilitators?[’\']?\s+notes?|instructors?[’\']?\s+guide|teaching\s+methodology|expected\s+(?:learner|student)\s+(?:response|answer)|marking\s+scheme|answer\s+key)\b/iu',
        ],
        'Curriculum planning language' => [
            'medium',
            '/\b(?:teaching\s+and\s+learning\s+activities|suggested\s+teaching\s+approach|assessment\s+strategy|facilitator\s+discussion\s+points|learning\s+outcomes\s+for\s+learners)\b/iu',
        ],
        'Unfinished or placeholder content' => [
            'high',
            '/\b(?:content\s+coming\s+soon|to\s+be\s+added|insert\s+(?:content|video|image|text)\s+here|lorem\s+ipsum|placeholder\s+content|todo\s*:\s*(?:write|add|insert)|tbd)\b/iu',
        ],
    ];

    public function handle(): int
    {
        $course = $this->option('course');

        if ($course !== null && (!ctype_digit((string) $course) || (int) $course < 1)) {
            $this->error('Course ID must be a positive integer.');
            return self::FAILURE;
        }

        $output = $this->option('output')
            ?: storage_path('app/reports/student-content-audit-v2.csv');

        $directory = dirname($output);

        if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
            $this->error("Cannot create directory: {$directory}");
            return self::FAILURE;
        }

        $file = fopen($output, 'w');

        if ($file === false) {
            $this->error("Cannot open report: {$output}");
            return self::FAILURE;
        }

        fputcsv($file, [
            'course_id', 'course_title', 'source', 'record_id',
            'field', 'category', 'severity', 'matched_phrase', 'excerpt'
        ]);

        $findings = 0;
        $scanned = 0;
        $seen = [];

        $scan = function ($row, string $source, array $fields) use (
            $file, &$findings, &$scanned, &$seen
        ): void {
            foreach ($fields as $field) {
                $value = $row->{$field} ?? null;

                if ($value === null) {
                    continue;
                }

                if (is_string($value) && in_array($field, ['metadata', 'options'], true)) {
                    $decoded = json_decode($value, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $value = $decoded;
                    }
                }

                $flatten = function ($value, string $path) use (&$flatten): array {
                    if (is_array($value) || is_object($value)) {
                        $results = [];
                        foreach ($value as $key => $item) {
                            $results = array_merge(
                                $results,
                                $flatten($item, $path . '.' . $key)
                            );
                        }
                        return $results;
                    }

                    return is_string($value) ? [[$path, $value]] : [];
                };

                foreach ($flatten($value, $field) as [$path, $text]) {
                    $scanned++;

                    foreach ($this->rules as $category => [$severity, $regex]) {
                        preg_match_all($regex, $text, $matches, PREG_OFFSET_CAPTURE);

                        foreach ($matches[0] as [$phrase, $offset]) {
                            $key = implode(':', [
                                $source, $row->id, $path, $offset
                            ]);

                            if (isset($seen[$key])) {
                                continue;
                            }

                            $seen[$key] = true;
                            $start = max(0, $offset - 100);
                            $excerpt = substr($text, $start, 300);
                            $excerpt = preg_replace('/\s+/u', ' ', $excerpt);

                            fputcsv($file, [
                                $row->course_id,
                                $row->course_title,
                                $source,
                                $row->id,
                                $path,
                                $category,
                                $severity,
                                $phrase,
                                $excerpt,
                            ]);

                            $findings++;
                        }
                    }
                }
            }
        };

        $sources = [
            [
                'course_stages as s',
                's',
                's.course_id',
                ['title', 'description'],
                [],
            ],
            [
                'modules as m',
                'm',
                'm.course_id',
                ['title', 'description'],
                [],
            ],
            [
                'episodes as e',
                'e',
                'm.course_id',
                ['title', 'description'],
                [['modules as m', 'e.module_id', 'm.id']],
            ],
            [
                'lesson_blocks as b',
                'b',
                'm.course_id',
                ['title', 'content', 'metadata'],
                [
                    ['episodes as e', 'b.episode_id', 'e.id'],
                    ['modules as m', 'e.module_id', 'm.id'],
                ],
            ],
            [
                'quizzes as q',
                'q',
                'm.course_id',
                ['title', 'description'],
                [['modules as m', 'q.module_id', 'm.id']],
            ],
            [
                'quiz_questions as qq',
                'qq',
                'm.course_id',
                ['question', 'options'],
                [
                    ['quizzes as q', 'qq.quiz_id', 'q.id'],
                    ['modules as m', 'q.module_id', 'm.id'],
                ],
            ],
            [
                'assignments as a',
                'a',
                'm.course_id',
                ['title', 'instructions'],
                [['modules as m', 'a.module_id', 'm.id']],
            ],
        ];

        foreach ($sources as [$table, $alias, $courseColumn, $fields, $joins]) {
            $query = DB::table($table);

            foreach ($joins as [$joinTable, $left, $right]) {
                $query->join($joinTable, $left, '=', $right);
            }

            $query->join('courses as c', $courseColumn, '=', 'c.id')
                ->select(
                    "{$alias}.id",
                    "{$courseColumn} as course_id",
                    'c.title as course_title',
                    ...array_map(fn ($field) => "{$alias}.{$field}", $fields)
                );

            if ($course !== null) {
                $query->where($courseColumn, (int) $course);
            }

            if ($alias === 'b') {
                $query->whereNotIn('b.type', ['code']);
            }

            $query->orderBy("{$alias}.id")->chunk(200, function ($rows) use (
                $scan, $table, $fields
            ) {
                foreach ($rows as $row) {
                    $scan($row, explode(' ', $table)[0], $fields);
                }
            });
        }

        fclose($file);

        $this->info('Student-facing curriculum audit completed.');
        $this->line("Text fields scanned: {$scanned}");
        $this->line("Unique findings: {$findings}");
        $this->line("Report: {$output}");
        $this->line('Database modifications: NONE');

        return self::SUCCESS;
    }
}
