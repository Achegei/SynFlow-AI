<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->restrictOnDelete();

            $table->string('registration_context', 20);

            $table->foreignId('institution_id')
                ->nullable()
                ->constrained('institutions')
                ->restrictOnDelete();

            $table->foreignId('sales_executive_id')
                ->nullable()
                ->constrained('sales_executives')
                ->restrictOnDelete();

            $table->string('status', 20)->default('pending');

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->unique(
                ['user_id', 'course_id'],
                'course_enrollments_user_course_unique'
            );

            $table->index(
                ['registration_context', 'status'],
                'course_enrollments_context_status_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_enrollments');
    }
};
