<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Allow non-video lesson types to exist without a video URL.
     */
    public function up(): void
    {
        Schema::table('episodes', function (Blueprint $table) {
            $table->string('video_url')->nullable()->change();
        });
    }

    /**
     * Restore the original episodes schema.
     */
    public function down(): void
    {
        Schema::table('episodes', function (Blueprint $table) {
            $table->string('video_url')->nullable(false)->change();
        });
    }
};
