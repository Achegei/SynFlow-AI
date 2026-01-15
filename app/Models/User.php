<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Services\GeocodingService;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'is_admin', 
        'location',
        'bio',
        'latitude',  
        'longitude',
        'profile_photo_url',
        'referral_code',     // ✅ added
        'referred_by'        // ✅ added
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getProfilePhotoUrlAttribute($value)
    {
        if ($value) {
            return asset('storage/' . ltrim($value, '/'));
        }

        return asset('images/default-avatar.png');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* ============================
       RELATIONSHIPS
    ============================ */

    public function episodes()
    {
        return $this->belongsToMany(Episode::class)
                    ->withPivot('watched')
                    ->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user')->withTimestamps();
    }

    public function hasCourse($courseId)
    {
        return $this->courses()->where('course_id', $courseId)->exists();
    }

    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }

    /* ============================
       REFERRAL RELATIONSHIPS ✅
    ============================ */

    // Who referred this user
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    // Users referred by this user
    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    /* ============================
       MODEL EVENTS
    ============================ */

    protected static function booted()
    {
        // Existing geocoding logic
        static::saving(function ($user) {
            if ($user->isDirty('location') && $user->location) {
                $coords = GeocodingService::geocode($user->location);
                if ($coords) {
                    $user->latitude = $coords['lat'];
                    $user->longitude = $coords['lng'];
                }
            }
        });

        // ✅ Auto-generate referral code on create
        static::creating(function ($user) {
            if (empty($user->referral_code)) {
                $user->referral_code = 'ML-' . strtoupper(Str::random(4)); // 4 characters
            }
        });
    }
}
