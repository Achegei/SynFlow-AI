<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payout_requests', function (Blueprint $table) {

            $table->id();

            $table->enum('requester_type', [
                'institution',
                'sales_executive'
            ]);

            $table->unsignedBigInteger('requester_id');

            $table->decimal('amount', 12, 2);

            $table->string('status')
                ->default('pending');

            $table->unsignedBigInteger('approved_by')
                ->nullable();

            $table->timestamp('processed_at')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payout_requests');
    }
};