<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
    ];

    /**
     * Get the episodes for the course.
     */
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
