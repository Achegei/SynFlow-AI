<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'user_id',
        'event',
        'route_name',
        'metadata',

        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',

        'referrer',
        'landing_page',

        'ip_address',
        'user_agent',

        'event_key',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * The user associated with this activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}