<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'video_url',
    ];

    /**
     * Relationship: Episode belongs to a Course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship: Episode belongs to many Users (progress tracking).
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('watched')
                    ->withTimestamps();
    }

    /**
     * Accessor: Convert normal YouTube links into embeddable URLs.
     *
     * Example:
     *  - https://www.youtube.com/watch?v=abcd123 → https://www.youtube.com/embed/abcd123
     *  - https://youtu.be/abcd123 → https://www.youtube.com/embed/abcd123
     */
    public function getIsCompletedAttribute()
        {
            $user = Auth::user();

            if (!$user) {
                return false;
            }

            return $this->users()
                        ->where('user_id', $user->id)
                        ->wherePivot('watched', true)
                        ->exists();
        }

    public function getYoutubeIdAttribute()
    {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $this->video_url, $matches)) {
            return $matches[1]; // return just the video ID
        }
        return null;
    }

}
