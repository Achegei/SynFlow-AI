<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'module_id',
        'title',
        'description',
        'position',
    ];

    public function questions()
        {
            return $this->hasMany(QuizQuestion::class)
                ->orderBy('position');
        }

        public function attempts()
        {
            return $this->hasMany(QuizAttempt::class);
        }

        public function module()
        {
            return $this->belongsTo(Module::class);
        }
}