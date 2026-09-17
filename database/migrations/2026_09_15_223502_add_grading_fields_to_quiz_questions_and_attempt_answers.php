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
        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->decimal('max_points', 8, 2)
                ->default(1)
                ->after('correct_answer');
        });

        Schema::table('quiz_attempt_answers', function (Blueprint $table) {
            $table->decimal('points_awarded', 8, 2)
                ->nullable()
                ->after('auto_graded');

            $table->text('review_feedback')
                ->nullable()
                ->after('points_awarded');

            $table->timestamp('reviewed_at')
                ->nullable()
                ->after('review_feedback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_attempt_answers', function (Blueprint $table) {
            $table->dropColumn([
                'points_awarded',
                'review_feedback',
                'reviewed_at',
            ]);
        });

        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->dropColumn('max_points');
        });
    }
};
