<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->string('logo_path')->nullable();
            $table->string('website_url')->nullable();
            $table->text('public_description')->nullable();
            $table->boolean('show_on_homepage')->default(false);
            $table->unsignedInteger('display_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn([
                'logo_path',
                'website_url',
                'public_description',
                'show_on_homepage',
                'display_order',
            ]);
        });
    }
};
