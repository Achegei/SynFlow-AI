<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commission_transactions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('payment_id')->constrained();

            $table->foreignId('student_id')
                ->constrained('users');

            $table->foreignId('institution_id')
                ->constrained();

            $table->foreignId('sales_executive_id')
                ->constrained();

            $table->foreignId('course_id')
                ->constrained();

            $table->decimal('total_amount', 12, 2);

            $table->decimal('institution_amount', 12, 2);

            $table->decimal('sales_amount', 12, 2);

            $table->decimal('company_amount', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commission_transactions');
    }
};