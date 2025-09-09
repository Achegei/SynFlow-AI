<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    use HasFactory;

    protected $table = 'user_scores'; // specify the table if it's not the plural of the model
    protected $fillable = [
        'user_id',
        'all_time_score',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true; // if you have created_at and updated_at
}
