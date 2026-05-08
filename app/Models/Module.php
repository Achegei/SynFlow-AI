<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'position',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class)
            ->orderBy('position');
    }

    /**
     * NEW: Module → Quizzes
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class)
            ->orderBy('position');
    }

    /**
     * NEW: Module → Assignments
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class)
            ->orderBy('position');
    }

    /*
    |--------------------------------------------------------------------------
    | PROGRESS LOGIC
    |--------------------------------------------------------------------------
    */

    public function isCompletedBy($user)
{
    /*
    |--------------------------------------------------------------------------
    | LESSON COMPLETION
    |--------------------------------------------------------------------------
    */

    $totalEpisodes = $this->episodes()->count();

    $completedEpisodes = $user->episodes()
        ->wherePivot('watched', true)
        ->whereIn('episode_id', $this->episodes()->pluck('id'))
        ->count();

    $episodesComplete =
        $totalEpisodes === 0
        ? true
        : $completedEpisodes >= $totalEpisodes;

    /*
    |--------------------------------------------------------------------------
    | QUIZ COMPLETION
    |--------------------------------------------------------------------------
    */

    $totalQuizzes = $this->quizzes()->count();

    $completedQuizzes = \App\Models\QuizAttempt::where('user_id', $user->id)
        ->whereIn('quiz_id', $this->quizzes()->pluck('id'))
        ->where('passed', true)
        ->distinct('quiz_id')
        ->count();

    $quizzesComplete =
        $totalQuizzes === 0
        ? true
        : $completedQuizzes >= $totalQuizzes;

    /*
    |--------------------------------------------------------------------------
    | ASSIGNMENT COMPLETION
    |--------------------------------------------------------------------------
    | Future-ready placeholder
    |--------------------------------------------------------------------------
    */

    $assignmentsComplete = true;

    /*
    |--------------------------------------------------------------------------
    | FINAL MODULE COMPLETION
    |--------------------------------------------------------------------------
    */

    return
        $episodesComplete &&
        $quizzesComplete &&
        $assignmentsComplete;
}
}