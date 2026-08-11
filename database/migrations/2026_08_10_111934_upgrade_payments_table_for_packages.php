<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->foreignId('package_id')
                ->nullable()
                ->after('course_id')
                ->constrained('packages')
                ->nullOnDelete();

            $table->string('payment_type')
                ->default('course')
                ->after('provider');

            $table->timestamp('paid_at')
                ->nullable()
                ->after('status');

            $table->string('currency')
                ->default('KES')
                ->after('amount');

            $table->index('api_ref');
            $table->index('payment_id');
            $table->index([
                'user_id',
                'course_id',
                'package_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->dropForeign(['package_id']);
            $table->dropColumn([
                'package_id',
                'payment_type',
                'paid_at',
                'currency',
            ]);
        });
    }
};