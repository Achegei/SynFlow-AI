<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionTransaction extends Model
{
    protected $fillable = [

        'payment_id',
        'student_id',
        'institution_id',
        'sales_executive_id',
        'course_id',

        'total_amount',
        'institution_amount',
        'sales_amount',
        'company_amount',
    ];
}