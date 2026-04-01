<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'student_count',
        'total_amount',
        'payment_status',
        'certificate_status',
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }
}