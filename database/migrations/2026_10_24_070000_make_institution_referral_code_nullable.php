<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->string('referral_code')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        // Do not automatically restore NOT NULL.
        // Institutions created without referral codes would
        // otherwise cause the rollback to fail.
    }
};
