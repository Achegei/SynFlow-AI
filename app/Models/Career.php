<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'responsibilities',
        'requirements',
        'desirable',
        'we_offer',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'responsibilities' => 'array',
        'requirements' => 'array',
        'desirable' => 'array',
        'we_offer' => 'array',
    ];

    // Relationship
    public function applications()
    {
        return $this->hasMany(CareerApplication::class);
    }
}
