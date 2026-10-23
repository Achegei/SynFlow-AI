<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commission_transactions', function (Blueprint $table) {
            $table->foreignId('course_enrollment_id')
                ->nullable()
                ->constrained('course_enrollments')
                ->restrictOnDelete();

            $table->unique(
                'course_enrollment_id',
                'commission_transactions_enrollment_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('commission_transactions', function (Blueprint $table) {
            $table->dropUnique(
                'commission_transactions_enrollment_unique'
            );

            $table->dropConstrainedForeignId(
                'course_enrollment_id'
            );
        });
    }
};
