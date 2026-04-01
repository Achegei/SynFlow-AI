<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerApplication extends Model
{
    // Explicitly tell Eloquent which table to use
    protected $table = 'partner_applications';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'location',
        'current_student_population',
        'additional_info',
    ];
}