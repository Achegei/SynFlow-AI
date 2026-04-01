<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('partner_applications')) {
            Schema::create('partner_applications', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('phone');
                $table->string('email');
                $table->string('location')->nullable();
                $table->string('current_student_population')->nullable();
                $table->text('additional_info')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_applications');
    }
};