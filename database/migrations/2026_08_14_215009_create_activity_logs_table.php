<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            /*
             * Anonymous visitor identity.
             *
             * This allows us to track activity before registration
             * and later associate the activity with a user.
             */
            $table->string('visitor_id', 100)->nullable()->index();

            /*
             * Authenticated learner.
             *
             * Nullable because anonymous visitors do not have a user_id yet.
             */
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            /*
             * The meaningful commercial/application event.
             *
             * Examples:
             * pathway_viewed
             * pathway_selected
             * package_viewed
             * package_selected
             * registration_completed
             * payment_started
             * payment_completed
             */
            $table->string('event', 100)->index();

            /*
             * Optional route/page associated with the event.
             */
            $table->string('route_name', 150)->nullable();

            /*
             * Flexible event-specific information.
             *
             * Example:
             * {
             *   "package_id": 3,
             *   "package": "monthly",
             *   "price": 4179,
             *   "currency": "KES"
             * }
             */
            $table->json('metadata')->nullable();

            /*
             * Marketing attribution.
             */
            $table->string('utm_source', 150)->nullable()->index();
            $table->string('utm_medium', 150)->nullable();
            $table->string('utm_campaign', 150)->nullable()->index();
            $table->string('utm_term', 150)->nullable();
            $table->string('utm_content', 150)->nullable();

            $table->text('referrer')->nullable();

            /*
             * Landing page associated with the visitor journey.
             */
            $table->text('landing_page')->nullable();

            /*
             * Basic technical context.
             *
             * We deliberately do not store unnecessary sensitive data.
             */
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            /*
             * Prevent excessive duplicate events where appropriate.
             *
             * This is not a global uniqueness constraint because
             * legitimate repeated events are possible.
             */
            $table->string('event_key', 100)->nullable()->index();

            $table->timestamps();

            /*
             * Useful for chronological lead timelines.
             */
            $table->index(['user_id', 'created_at']);
            $table->index(['visitor_id', 'created_at']);
            $table->index(['event', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};