<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_logs', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('activity_log_id')
                ->nullable()
                ->constrained('activity_logs')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Email Identity
            |--------------------------------------------------------------------------
            */

            $table->string('event')->index();

            $table->string('template')->nullable();

            $table->string('recipient')->index();

            $table->string('subject')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Delivery
            |--------------------------------------------------------------------------
            */

            $table->string('status')
                ->default('pending')
                ->index();

            $table->string('provider')
                ->nullable();

            $table->string('provider_message_id')
                ->nullable()
                ->index();

            /*
            |--------------------------------------------------------------------------
            | Email Lifecycle
            |--------------------------------------------------------------------------
            */

            $table->timestamp('sent_at')->nullable();

            $table->timestamp('opened_at')->nullable();

            $table->timestamp('clicked_at')->nullable();

            $table->timestamp('failed_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Additional Information
            |--------------------------------------------------------------------------
            */

            $table->json('metadata')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index([
                'user_id',
                'event',
            ]);

            $table->index([
                'user_id',
                'template',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_logs');
    }
};