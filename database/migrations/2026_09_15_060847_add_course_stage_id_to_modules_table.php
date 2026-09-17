<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->foreignId('course_stage_id')
                ->nullable()
                ->after('course_id')
                ->constrained('course_stages')
                ->nullOnDelete();

            $table->index(['course_stage_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropIndex(['course_stage_id', 'position']);
            $table->dropConstrainedForeignId('course_stage_id');
        });
    }
};
