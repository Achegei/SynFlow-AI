<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_stages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('slug', 50);
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('position')->default(0);

            $table->timestamps();

            $table->unique(['course_id', 'slug']);
            $table->index(['course_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_stages');
    }
};
