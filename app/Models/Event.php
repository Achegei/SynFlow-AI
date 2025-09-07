<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
            protected $fillable = [
            'user_id',
            'event_date',
            'title',
            'description',
            'start_time',
            'end_time',
            'link',
            'is_live',
        ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
{
    static::creating(function ($event) {
        if (auth()->check()) {
            $event->user_id = auth()->id();
        }
    });
}

}
