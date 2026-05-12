<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'video_url',
        'pdf_path',
        'type',
        'position',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // Episode belongs to a Module
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // Episode progress tracking (many-to-many with users)
    public function users()
    {
        return $this->belongsToMany(User::class, 'episode_user')
                    ->withPivot('watched')
                    ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    // Check if episode is completed by logged-in user
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

    // Extract YouTube video ID
    public function getYoutubeIdAttribute()
    {
        if (!$this->video_url) {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $this->video_url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}