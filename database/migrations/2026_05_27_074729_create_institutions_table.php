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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();

            // Institution basic info
            $table->string('name');
            $table->string('slug')->unique();

            // Referral tracking
            $table->string('referral_code')->unique();

            // Contact information
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            // Institution status
            $table->enum('status', [
                'pending',
                'active',
                'suspended'
            ])->default('active');

            // Wallet balance (temporary for now)
            // Later we will build full wallet ledger
            $table->decimal('wallet_balance', 12, 2)
                ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};