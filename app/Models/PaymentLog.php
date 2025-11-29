<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $fillable = [
        'payment_id',
        'invoice_id',
        'api_ref',
        'state',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array', // optional, if you want to store JSON
    ];
}
