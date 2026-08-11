<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            // Number of days the package grants access
            $table->unsignedInteger('duration_days');

            // Price in KES
            $table->decimal('price', 10, 2);

            $table->text('description')->nullable();

            $table->boolean('active')->default(true);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['course_id', 'active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};