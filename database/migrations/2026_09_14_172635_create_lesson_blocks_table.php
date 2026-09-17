<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_blocks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('episode_id')
                ->constrained('episodes')
                ->cascadeOnDelete();

            $table->string('type', 50);

            $table->string('title')->nullable();

            $table->longText('content')->nullable();

            $table->json('metadata')->nullable();

            $table->unsignedInteger('position')->default(0);

            $table->timestamps();

            $table->index(['episode_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_blocks');
    }
};
