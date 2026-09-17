<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Show quiz page
     */
    public function show(Quiz $quiz)
    {
        $quiz->load('questions');

        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Submit quiz answers
     */
    public function submit(Request $request, Quiz $quiz)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to submit this quiz.',
            ], 401);
        }

        $quiz->load('questions');

        $submittedAnswers = $request->input('answers', []);

        if (!is_array($submittedAnswers)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid quiz answers.',
            ], 422);
        }

        $unansweredQuestions = $quiz->questions->filter(function ($question) use ($submittedAnswers) {
            $answer = $submittedAnswers[$question->id] ?? null;

            return !is_string($answer) || trim($answer) === '';
        });

        if ($unansweredQuestions->isNotEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Please answer every question before submitting.',
                'unanswered_questions' => $unansweredQuestions->pluck('id')->values(),
            ], 422);
        }

        $hasWrittenQuestions = $quiz->questions->contains(function ($question) {
            return in_array($question->type, ['short_answer', 'practical'], true);
        });

        if ($hasWrittenQuestions) {
            $pendingAttempt = QuizAttempt::query()
                ->where('user_id', $user->id)
                ->where('quiz_id', $quiz->id)
                ->where('status', 'pending_review')
                ->latest()
                ->first();

            if ($pendingAttempt) {
                return response()->json([
                    'success' => false,
                    'status' => 'pending_review',
                    'requires_review' => true,
                    'message' => 'This examination has already been submitted and is awaiting instructor review.',
                ], 409);
            }
        }

        [
            'attempt' => $attempt,
            'objectiveCorrect' => $objectiveCorrect,
            'objectiveTotal' => $objectiveTotal,
            'objectivePercentage' => $objectivePercentage,
        ] = DB::transaction(function () use (
            $user,
            $quiz,
            $submittedAnswers,
            $hasWrittenQuestions
        ) {
            $objectiveCorrect = 0;
            $objectiveTotal = 0;

            $attempt = QuizAttempt::create([
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
                'score' => 0,
                'passed' => false,
                'status' => $hasWrittenQuestions ? 'pending_review' : 'graded',
            ]);

            foreach ($quiz->questions as $question) {
                $rawAnswer = $submittedAnswers[$question->id] ?? null;

                $answer = is_string($rawAnswer)
                    ? trim($rawAnswer)
                    : '';

                $isCorrect = null;
                $autoGraded = false;

                if ($question->type === 'multiple_choice') {
                    $objectiveTotal++;
                    $autoGraded = true;

                    $normalizedAnswer = strtoupper($answer);
                    $normalizedCorrectAnswer = strtoupper(
                        trim((string) $question->correct_answer)
                    );

                    $isCorrect = $normalizedAnswer !== ''
                        && $normalizedAnswer === $normalizedCorrectAnswer;

                    if ($isCorrect) {
                        $objectiveCorrect++;
                    }
                }

                $attempt->answers()->create([
                    'quiz_question_id' => $question->id,
                    'answer' => $answer,
                    'is_correct' => $isCorrect,
                    'auto_graded' => $autoGraded,
                    'points_awarded' => $autoGraded
                        ? ($isCorrect ? $question->max_points : 0)
                        : null,
                    'reviewed_at' => $autoGraded ? now() : null,
                ]);
            }

            $objectivePercentage = $objectiveTotal > 0
                ? round(($objectiveCorrect / $objectiveTotal) * 100)
                : 0;

            if (!$hasWrittenQuestions) {
                $attempt->update([
                    'score' => $objectivePercentage,
                    'passed' => $objectivePercentage >= 70,
                    'status' => 'graded',
                ]);
            }

            return [
                'attempt' => $attempt->fresh(),
                'objectiveCorrect' => $objectiveCorrect,
                'objectiveTotal' => $objectiveTotal,
                'objectivePercentage' => $objectivePercentage,
            ];
        });

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'status' => $attempt->status,
                'requires_review' => $hasWrittenQuestions,
                'score' => $hasWrittenQuestions ? null : $attempt->score,
                'passed' => $hasWrittenQuestions ? null : $attempt->passed,
                'objective_correct' => $objectiveCorrect,
                'objective_total' => $objectiveTotal,
                'objective_score' => $objectivePercentage,
                'total' => $quiz->questions->count(),
                'message' => $hasWrittenQuestions
                    ? 'Your examination has been submitted and is awaiting instructor review.'
                    : 'Your quiz has been graded.',
            ]);
        }

        if ($hasWrittenQuestions) {
            return redirect()
                ->route('quizzes.show', $quiz->id)
                ->with('success', 'Your examination has been submitted and is awaiting instructor review.');
        }

        return redirect()
            ->route('quizzes.show', $quiz->id)
            ->with([
                'success' => true,
                'score' => $attempt->score,
                'total' => $objectiveTotal,
                'passed' => $attempt->passed,
            ]);
    }
}