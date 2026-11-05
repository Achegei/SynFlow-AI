<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'title',
        'caption',
        'media_type',
        'image_path',
        'video_path',
        'youtube_url',
        'category',
        'alt_text',
        'display_order',
        'is_published',
        'show_on_homepage',
        'published_at',
    ];

    protected $casts = [
        'display_order' => 'integer',
        'is_published' => 'boolean',
        'show_on_homepage' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function isVideo(): bool
    {
        return in_array(
            $this->media_type,
            ['video_upload', 'youtube'],
            true
        );
    }

    public function isPhoto(): bool
    {
        return $this->media_type === 'photo';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query
            ->published()
            ->where('show_on_homepage', true);
    }
}
