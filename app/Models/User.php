<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Services\GeocodingService;

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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
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

    // Hook into model events
    protected static function booted()
    {
        static::saving(function ($user) {
            if ($user->isDirty('location') && $user->location) {
                $coords = GeocodingService::geocode($user->location);
                if ($coords) {
                    $user->latitude = $coords['lat'];
                    $user->longitude = $coords['lng'];
                }
            }
        });
    }
}
