<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'role',
        'company_name',
        'company_website',
        'company_size',
        'revenue',
        'budget',
        'services',
        'message',
    ];

    // Automatically cast services to array
    protected $casts = [
        'services' => 'array',
    ];
}
