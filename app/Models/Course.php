<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'payment_link',
        'price',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function modules()
    {
        return $this->hasMany(Module::class)
            ->orderBy('position');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user')
            ->withTimestamps();
    }

    public function packages()
    {
        return $this->hasMany(Package::class)
            ->where('active', true)
            ->orderBy('sort_order');
    }

    public function learningAccess()
    {
        return $this->hasMany(LearningAccess::class);
    }

    public function onboardingProfiles()
    {
        return $this->hasMany(
            OnboardingProfile::class,
            'recommended_course_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return Storage::url($value);
    }

    /*
    |--------------------------------------------------------------------------
    | USER COURSE ACCESS
    |--------------------------------------------------------------------------
    |
    | A user can access this course through either pathway:
    |
    | 1. Institution pathway
    |    - User is attached to the course through course_user.
    |
    | 2. AI pathway
    |    - User has an active LearningAccess record.
    |
    | The course does NOT need to know which pathway the user used.
    |
    | It simply asks:
    |
    | "Does this logged-in user currently have access to me?"
    |
    |--------------------------------------------------------------------------
    */

    public function hasAccessForUser(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | 1. Institution / Permanent Access
        |--------------------------------------------------------------------------
        |
        | If the user has been enrolled through the institution pathway,
        | they will exist in the course_user pivot table.
        |
        */

        $institutionAccess = $this->users()
            ->where('users.id', $user->id)
            ->exists();

        if ($institutionAccess) {
            return true;
        }

        /*
        |--------------------------------------------------------------------------
        | 2. AI Subscription Access
        |--------------------------------------------------------------------------
        |
        | AI users do not need to be permanently attached to course_user.
        |
        | Their access is controlled through LearningAccess.
        |
        | Access is valid only when:
        |
        | - It belongs to this user.
        | - It belongs to this course.
        | - Status is active.
        | - It has not expired.
        |
        */

        return $this->learningAccess()
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->where(function ($query) {
                $query
                    ->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK AI LEARNING ACCESS
    |--------------------------------------------------------------------------
    |
    | This specifically checks whether the user currently has an
    | active AI subscription for this course.
    |
    */

    public function hasActiveLearningAccess(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->learningAccess()
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->where(function ($query) {
                $query
                    ->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK INSTITUTION ACCESS
    |--------------------------------------------------------------------------
    |
    | This specifically checks whether the user has permanent
    | institution/course enrollment.
    |
    */

    public function hasInstitutionAccess(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->users()
            ->where('users.id', $user->id)
            ->exists();
    }
}