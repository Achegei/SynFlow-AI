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
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_login_at')->nullable();

        $table->timestamp('last_activity_at')->nullable();

        $table->unsignedInteger('study_minutes')
            ->default(0);

        $table->unsignedInteger('lessons_completed')
            ->default(0);

        $table->unsignedInteger('videos_watched')
            ->default(0);

        $table->unsignedInteger('quizzes_completed')
            ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'last_login_at',
                'last_activity_at',
                'study_minutes',
                'lessons_completed',
                'videos_watched',
                'quizzes_completed'
            ]);
        });
    }
};
