<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'module_id',
        'title',
        'description',
        'position',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}