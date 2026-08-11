<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('onboarding_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Step 1
            |--------------------------------------------------------------------------
            */
            $table->string('profile_type')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Step 2
            |--------------------------------------------------------------------------
            */
            $table->string('primary_goal')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Step 3
            |--------------------------------------------------------------------------
            */
            $table->string('income_interest')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Step 4
            |--------------------------------------------------------------------------
            */
            $table->string('industry')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Step 5
            |--------------------------------------------------------------------------
            */
            $table->json('skills_needed')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Step 6
            |--------------------------------------------------------------------------
            */
            $table->string('ai_experience')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Step 7
            |--------------------------------------------------------------------------
            */
            $table->string('financial_target')->nullable();

            $table->string('investment_readiness')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Recommendation
            |--------------------------------------------------------------------------
            */
            $table->string('recommended_path')->nullable();

            $table->foreignId('recommended_course_id')
                ->nullable()
                ->constrained('courses')
                ->nullOnDelete();

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onboarding_profiles');
    }
};