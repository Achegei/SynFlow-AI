<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('module_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('instructions');

            $table->string('submission_type')->default('file'); 
            // file | link | text

            $table->integer('position')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};