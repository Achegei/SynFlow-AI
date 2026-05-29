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
        Schema::create('sales_executives', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Linked User Account
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Wallet
            |--------------------------------------------------------------------------
            */
            $table->decimal('wallet_balance', 12, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Commission Percentage
            |--------------------------------------------------------------------------
            */
            $table->decimal('commission_percentage', 5, 2)
                ->default(10);

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'active',
                'inactive',
                'suspended',
            ])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_executives');
    }
};