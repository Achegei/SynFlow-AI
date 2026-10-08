<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_education_ambassador_applications', function (Blueprint $table) {
            $table->id();

            $table->string('application_reference')->nullable();

            $table->unique('application_reference', 'aea_application_reference_unique');

            // Applicant information
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_whatsapp');

            // Employment / institution
            $table->boolean('employed_by_educational_institution');
            $table->string('institution_type')->nullable();
            $table->string('institution_name')->nullable();

            // Location
            $table->string('city')->nullable();
            $table->string('county')->nullable();

            // Professional information
            $table->string('current_position')->nullable();
            $table->string('tenure')->nullable();

            // Institutional access
            $table->string('leadership_access')->nullable();
            $table->json('leadership_types')->nullable();
            $table->text('decision_maker_details')->nullable();

            // Partnership approach
            $table->text('introduction_plan')->nullable();

            // Internal recruitment management
            $table->string('status')->default('new')->index();
            $table->text('admin_notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();

            $table->index('email');
            $table->index('institution_name');
            $table->index('county');
            $table->index('institution_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_education_ambassador_applications');
    }
};
