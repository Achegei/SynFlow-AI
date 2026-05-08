<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

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

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false
            ], 401);
        }

        return redirect()->route('login');
    }

    $quiz->load('questions');

    $score = 0;
    $total = $quiz->questions->count();

    foreach ($quiz->questions as $question) {

        $answer = $request->input('answers.' . $question->id);

        if ($answer === $question->correct_answer) {
            $score++;
        }
    }

    // Require all correct
    $passed = $score >= $total;

    // Percentage score
    $percentage = $total > 0
        ? round(($score / $total) * 100)
        : 0;

    QuizAttempt::create([
        'user_id' => $user->id,
        'quiz_id' => $quiz->id,
        'score' => $percentage,
        'passed' => $passed,
    ]);

    /*
    |--------------------------------------------------------------------------
    | CHECK MODULE COMPLETION
    |--------------------------------------------------------------------------
    */

    $module = $quiz->module;

    if ($module && $module->isCompletedBy($user)) {

        $user->modules()->syncWithoutDetaching([
            $module->id => [
                'completed' => true,
                'completed_at' => now(),
            ]
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX RESPONSE
    |--------------------------------------------------------------------------
    */

    if ($request->expectsJson()) {

        return response()->json([
            'success' => true,
            'score' => $percentage,
            'passed' => $passed,
            'correct' => $score,
            'total' => $total,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | NORMAL FORM RESPONSE
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('quizzes.show', $quiz->id)
        ->with([
            'success' => true,
            'score' => $score,
            'total' => $total,
            'passed' => $passed,
        ]);
}
}