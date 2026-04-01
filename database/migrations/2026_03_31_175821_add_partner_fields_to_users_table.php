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
        Schema::table('users', function (Blueprint $table) {
             $table->string('role')->default('client'); // client, partner, admin
            $table->string('institution_name')->nullable(); // Only for partners
            $table->string('contact_phone')->nullable();   // Only for partners
            $table->enum('partnership_status', ['pending', 'active', 'suspended'])->nullable();
            $table->timestamp('joining_fee_paid_at')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
                $table->dropColumn('institution_name');
                $table->dropColumn('contact_phone');
                $table->dropColumn('partnership_status');
                $table->dropColumn('joining_fee_paid_at');
        });
    }
};
