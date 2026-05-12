<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $table = 'quiz_questions';

    protected $fillable = [
        'quiz_id',
        'question',
        'options',
        'correct_answer',
        'position',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    /**
     * FORCE JSON decode
     */
    public function getOptionsAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        return json_decode($value, true) ?: [];
    }

    /**
     * FORCE JSON encode
     */
    public function setOptionsAttribute($value)
    {
        if (is_string($value)) {

            $decoded = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $value = $decoded;
            }
        }

        $this->attributes['options'] = json_encode($value);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
