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
        Schema::create('certificate_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('users')->onDelete('cascade');
            $table->integer('student_count');
            $table->decimal('total_amount', 10, 2); // $2,000 * student_count
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->enum('certificate_status', ['pending', 'printing', 'shipped'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_requests');
    }
};
