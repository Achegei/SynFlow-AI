<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'full_name',
        'email',
        'cv_cover_letter',  // keep if used
        'cv_cover_path',
        'position',         // <-- add this
        'position_slug',    // <-- add this
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
