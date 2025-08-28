<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'video_url',
    ];

    /**
     * Get the course that owns the episode.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
