<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;

class AIPathController extends Controller
{
    /**
     * Show the learner's recommended AI learning path.
     */
    public function index()
    {
        $data = session('ai_onboarding', []);

        return view('ai.path.index', compact('data'));
    }
}