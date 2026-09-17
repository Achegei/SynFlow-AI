<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonBlock extends Model
{
    protected $fillable = [
        'episode_id',
        'type',
        'title',
        'content',
        'metadata',
        'position',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }
}
