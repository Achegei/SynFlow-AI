<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutions', function (Blueprint $table) {

            $table->foreignId('institution_admin_id')
                ->nullable()
                ->after('sales_executive_id')
                ->constrained('users')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {

            $table->dropForeign(['institution_admin_id']);
            $table->dropColumn('institution_admin_id');

        });
    }
};