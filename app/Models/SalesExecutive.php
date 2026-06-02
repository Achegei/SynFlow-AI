<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesExecutive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_balance',
        'commission_percentage',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Linked User Account
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Institutions
    |--------------------------------------------------------------------------
    */
    public function institutions()
    {
        return $this->hasMany(Institution::class);
    }

    public function commissionTransactions()
    {
        return $this->hasMany(
            CommissionTransaction::class
        );
    }
}