<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseStage extends Model
{
    protected $fillable = [
        'course_id',
        'slug',
        'title',
        'description',
        'position',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // Stage belongs to one certification/course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Stage contains ordered modules
    public function modules()
    {
        return $this->hasMany(Module::class)
            ->orderBy('position');
    }
}
