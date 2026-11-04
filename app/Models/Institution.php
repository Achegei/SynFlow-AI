<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\SalesExecutive;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'referral_code',
        'contact_person',
        'email',
        'phone',
        'status',
        'wallet_balance',
        'sales_executive_id',
        'institution_admin_id',
        'logo_path',
        'website_url',
        'public_description',
        'show_on_homepage',
        'display_order',
    ];

    protected $casts = [
        'show_on_homepage' => 'boolean',
        'display_order' => 'integer',
    ];

    public function students()
    {
        return $this->hasMany(User::class, 'institution_id');
    }

    public function salesExecutive()
    {
        return $this->belongsTo(SalesExecutive::class);
    }

   public function admin()
{
    return $this->belongsTo(User::class, 'institution_admin_id');
}

public function commissionTransactions()
{
    return $this->hasMany(
        CommissionTransaction::class
    );
}
}