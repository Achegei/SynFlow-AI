<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $duplicate = DB::table('sales_executives')
            ->select('user_id')
            ->groupBy('user_id')
            ->havingRaw('COUNT(*) > 1')
            ->first();

        if ($duplicate !== null) {
            throw new RuntimeException(
                'Cannot enforce unique Sales Executive users: duplicate assignments exist.'
            );
        }

        Schema::table('sales_executives', function (Blueprint $table) {
            $table->unique(
                'user_id',
                'sales_executives_user_id_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('sales_executives', function (Blueprint $table) {
            $table->dropUnique('sales_executives_user_id_unique');
        });
    }
};
