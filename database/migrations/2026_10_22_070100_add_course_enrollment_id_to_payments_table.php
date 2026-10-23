<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('course_enrollment_id')
                ->nullable()
                ->constrained('course_enrollments')
                ->restrictOnDelete();

            $table->index(
                ['course_enrollment_id', 'status'],
                'payments_enrollment_status_index'
            );
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex('payments_enrollment_status_index');
            $table->dropConstrainedForeignId('course_enrollment_id');
        });
    }
};
