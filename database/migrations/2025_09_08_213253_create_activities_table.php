<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // e.g. post_create, comment_create, post_like_received, ...
            $table->string('target_type')->nullable(); // e.g. Post, Comment, Event
            $table->unsignedBigInteger('target_id')->nullable();
            $table->integer('points')->default(0);
            $table->json('meta')->nullable(); // optional metadata (title, ip, etc)
            $table->timestamps();
            $table->index(['type']);
            $table->index(['user_id']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
