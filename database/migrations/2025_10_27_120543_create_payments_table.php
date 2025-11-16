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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('provider'); // e.g. "lemonsqueezy", "flutterwave", "intasend"
            $table->string('payment_id')->nullable(); // gateway transaction ID
            $table->string('status')->default('pending'); // pending, paid, failed
            $table->decimal('amount', 10, 2)->nullable();
            $table->json('payload')->nullable(); // raw webhook data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
