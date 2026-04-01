<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
            // Option 1: Add 'issued' to ENUM
            $table->enum('certificate_status', ['pending', 'printing', 'shipped', 'issued'])
                  ->default('pending')
                  ->change();

            // Option 2 (alternative): Change to VARCHAR
            // $table->string('certificate_status', 50)->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
            // Revert to original ENUM
            $table->enum('certificate_status', ['pending', 'printing', 'shipped'])
                  ->default('pending')
                  ->change();

            // If you used VARCHAR in up(), revert here instead
            // $table->enum('certificate_status', ['pending', 'printing', 'shipped'])->default('pending')->change();
        });
    }
};