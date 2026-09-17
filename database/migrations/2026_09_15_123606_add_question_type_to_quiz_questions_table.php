<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->string('type', 50)
                ->default('multiple_choice')
                ->after('question');

            $table->json('options')
                ->nullable()
                ->change();

            $table->text('correct_answer')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->dropColumn('type');

            $table->json('options')
                ->nullable(false)
                ->change();

            $table->string('correct_answer')
                ->nullable(false)
                ->change();
        });
    }
};
