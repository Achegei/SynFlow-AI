<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unique(
                'payment_id',
                'payments_payment_id_unique'
            );

            $table->unique(
                'api_ref',
                'payments_api_ref_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropUnique('payments_payment_id_unique');
            $table->dropUnique('payments_api_ref_unique');
        });
    }
};
