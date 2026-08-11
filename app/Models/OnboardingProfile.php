<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnboardingProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_type',
        'primary_goal',
        'income_interest',
        'industry',
        'skills_needed',
        'ai_experience',
        'financial_target',
        'investment_readiness',
        'recommended_path',
        'recommended_course_id',
        'completed_at',
    ];

    protected $casts = [
        'skills_needed' => 'array',
        'completed_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recommendedCourse()
    {
        return $this->belongsTo(Course::class, 'recommended_course_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isComplete(): bool
    {
        return !is_null($this->completed_at);
    }
}