<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'options',
        'correct_answer',
        'position',
    ];

    protected $casts = [
        'options' => 'array', // 🔥 must stay like this
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}