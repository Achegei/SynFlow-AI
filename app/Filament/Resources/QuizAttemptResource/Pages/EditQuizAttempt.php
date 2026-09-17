<?php

namespace App\Filament\Resources\QuizAttemptResource\Pages;

use App\Filament\Resources\QuizAttemptResource;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EditQuizAttempt extends EditRecord
{
    protected static string $resource = QuizAttemptResource::class;

    protected ?bool $hasDatabaseTransactions = true;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var QuizAttempt $attempt */
        $attempt = $this->getRecord();

        $attempt->load([
            'user',
            'quiz.module.course',
            'answers.question',
        ]);

        $data['review_answers'] = $attempt->answers
            ->sortBy(fn (QuizAttemptAnswer $answer) => $answer->question?->position ?? 0)
            ->values()
            ->map(function (QuizAttemptAnswer $answer): array {
                $question = $answer->question;
                $type = $question?->type ?? 'multiple_choice';
                $maxPoints = (float) ($question?->max_points ?? 0);

                return [
                    'answer_id' => $answer->id,
                    'auto_graded' => (bool) $answer->auto_graded,
                    'max_points' => $maxPoints,
                    'question' => $question?->question ?? 'Question unavailable',
                    'question_type' => match ($type) {
                        'multiple_choice' => 'Multiple Choice',
                        'short_answer' => 'Short Answer',
                        'practical' => 'Practical',
                        default => ucfirst(str_replace('_', ' ', $type)),
                    },
                    'maximum_points_display' => number_format($maxPoints, 2),
                    'learner_answer' => $answer->answer,
                    'points_awarded' => $answer->points_awarded,
                    'review_feedback' => $answer->review_feedback,
                ];
            })
            ->all();

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        /** @var QuizAttempt $record */
        $record->load([
            'quiz.questions',
            'answers.question',
        ]);

        $submittedRows = collect($data['review_answers'] ?? []);

        $submittedByAnswerId = $submittedRows
            ->filter(fn ($row) => isset($row['answer_id']))
            ->keyBy(fn ($row) => (int) $row['answer_id']);

        $answers = $record->answers;

        if ($answers->isEmpty()) {
            throw ValidationException::withMessages([
                'review_answers' => 'This examination attempt has no submitted answers to review.',
            ]);
        }

        $quizQuestionIds = $record->quiz->questions
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->sort()
            ->values();

        $answeredQuestionIds = $answers
            ->pluck('quiz_question_id')
            ->map(fn ($id) => (int) $id)
            ->sort()
            ->values();

        if ($quizQuestionIds->all() !== $answeredQuestionIds->all()) {
            throw ValidationException::withMessages([
                'review_answers' => 'The submitted answers do not match the examination questions. Review cannot be finalized.',
            ]);
        }

        foreach ($answers as $answer) {
            $question = $answer->question;

            if (! $question) {
                throw ValidationException::withMessages([
                    'review_answers' => 'One of the submitted answers is missing its examination question.',
                ]);
            }

            if ($answer->auto_graded) {
                continue;
            }

            $submitted = $submittedByAnswerId->get((int) $answer->id);

            if (! $submitted) {
                throw ValidationException::withMessages([
                    'review_answers' => 'Every written and practical response must be reviewed before finalizing.',
                ]);
            }

            $points = $submitted['points_awarded'] ?? null;

            if ($points === null || $points === '') {
                throw ValidationException::withMessages([
                    'review_answers' => 'Enter points for every written and practical response.',
                ]);
            }

            if (! is_numeric($points)) {
                throw ValidationException::withMessages([
                    'review_answers' => 'Awarded points must be numeric.',
                ]);
            }

            $points = (float) $points;
            $maxPoints = (float) $question->max_points;

            if ($points < 0 || $points > $maxPoints) {
                throw ValidationException::withMessages([
                    'review_answers' => "Awarded points must be between 0 and {$maxPoints}.",
                ]);
            }

            $feedback = $submitted['review_feedback'] ?? null;

            $answer->update([
                'points_awarded' => $points,
                'review_feedback' => filled($feedback) ? trim((string) $feedback) : null,
                'reviewed_at' => now(),
                'reviewed_by' => Auth::id(),
            ]);
        }

        $record->refresh()->load([
            'quiz.questions',
            'answers.question',
        ]);

        $totalAvailable = $record->quiz->questions->sum(
            fn ($question): float => (float) $question->max_points
        );

        if ($totalAvailable <= 0) {
            throw ValidationException::withMessages([
                'review_answers' => 'This examination has no available grading points.',
            ]);
        }

        $totalAwarded = $record->answers->sum(
            fn (QuizAttemptAnswer $answer): float => (float) ($answer->points_awarded ?? 0)
        );

        $score = (int) round(($totalAwarded / $totalAvailable) * 100);

        $record->update([
            'score' => $score,
            'passed' => $score >= 70,
            'status' => 'reviewed',
        ]);

        return $record->refresh();
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Examination review finalized';
    }
}
