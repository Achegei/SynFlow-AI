<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseApplication extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'city',
        'education',
        'has_laptop',
        'motivation',
        'payment_option',
    ];
}
