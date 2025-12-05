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
        'cv_cover_letter',
        'cv_cover_path',
        'certificate_path',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
