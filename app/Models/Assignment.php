<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'module_id',
        'title',
        'instructions',
        'submission_type',
        'position',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}