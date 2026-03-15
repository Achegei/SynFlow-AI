<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'certificate_number',
        'course_id',
        'full_name',
        'issued_at',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];
}
