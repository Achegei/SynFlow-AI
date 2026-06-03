<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    protected $fillable = [

        'requester_type',
        'requester_id',
        'amount',
        'status',
        'approved_by',
        'processed_at',
        'notes',
    ];
}