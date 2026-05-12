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
        dd('CONTROLLER HIT');
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
            return redirect()->route('login');
        }

        $quiz->load('questions');

        $score = 0;
        $total = $quiz->questions->count();

        foreach ($quiz->questions as $question) {

            $answer = $request->input('answers.' . $question->id);

            // Normalize input (VERY IMPORTANT)
            $answer = strtoupper(trim($answer));

            if (!$answer) {
                continue;
            }

            if ($answer === $question->correct_answer) {
                $score++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | PASSING RULE (CHANGE IF YOU WANT)
        |--------------------------------------------------------------------------
        | Example: 70% pass mark instead of 100%
        */

        $percentage = $total > 0
            ? round(($score / $total) * 100)
            : 0;

        $passed = $percentage >= 70;

        /*
        |--------------------------------------------------------------------------
        | SAVE ATTEMPT
        |--------------------------------------------------------------------------
        */

        QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score'   => $percentage,
            'passed'  => $passed,
        ]);

        /*
        |--------------------------------------------------------------------------
        | AJAX RESPONSE
        |--------------------------------------------------------------------------
        */

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'score'   => $percentage,
                'passed'  => $passed,
                'correct' => $score,
                'total'   => $total,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT RESPONSE
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('quizzes.show', $quiz->id)
            ->with([
                'success' => true,
                'score'   => $score,
                'total'   => $total,
                'passed'  => $passed,
            ]);
    }
}