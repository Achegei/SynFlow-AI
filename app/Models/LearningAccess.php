<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LearningAccess extends Model
{
    use HasFactory;

    protected $table = 'learning_access';

    protected $fillable = [
        'user_id',
        'course_id',
        'package_id',
        'payment_id',
        'starts_at',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Access Status
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->status === 'active'
            && $this->starts_at <= now()
            && $this->expires_at > now();
    }

    public function isExpired(): bool
    {
        return $this->expires_at <= now();
    }

    /*
    |--------------------------------------------------------------------------
    | Automatically determine status
    |--------------------------------------------------------------------------
    */

    public function refreshStatus(): self
    {
        if ($this->expires_at <= now()) {
            $this->status = 'expired';
            $this->save();
        }

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Remaining time
    |--------------------------------------------------------------------------
    */

    public function remainingSeconds(): int
    {
        if (!$this->isActive()) {
            return 0;
        }

        return max(
            0,
            now()->diffInSeconds($this->expires_at)
        );
    }
}