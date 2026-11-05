<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('caption')->nullable();

            // photo, video_upload, youtube
            $table->string('media_type', 20)->default('photo');

            // Photograph or optional video thumbnail
            $table->string('image_path')->nullable();

            // Uploaded MP4 video
            $table->string('video_path')->nullable();

            // YouTube video URL
            $table->string('youtube_url', 500)->nullable();

            $table->string('category', 100);
            $table->string('alt_text')->nullable();

            $table->unsignedInteger('display_order')->default(0);

            $table->boolean('is_published')->default(false);
            $table->boolean('show_on_homepage')->default(false);

            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            $table->index(
                ['is_published', 'display_order'],
                'gallery_public_order_idx'
            );

            $table->index(
                ['is_published', 'show_on_homepage', 'display_order'],
                'gallery_homepage_idx'
            );

            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
    }
};
