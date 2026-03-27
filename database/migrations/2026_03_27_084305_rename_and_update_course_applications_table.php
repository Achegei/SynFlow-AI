<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Rename table only if it exists and the target doesn't exist
        if (Schema::hasTable('course_applications') && !Schema::hasTable('partner_applications')) {
            Schema::rename('course_applications', 'partner_applications');
        }

        // Only modify columns if table exists
        if (Schema::hasTable('partner_applications')) {
            Schema::table('partner_applications', function (Blueprint $table) {
                // Rename columns if they exist
                if (Schema::hasColumn('partner_applications', 'full_name')) {
                    $table->renameColumn('full_name', 'name');
                }
                if (Schema::hasColumn('partner_applications', 'city')) {
                    $table->renameColumn('city', 'location');
                }

                // Drop unnecessary columns if they exist
                foreach (['education', 'has_laptop', 'motivation', 'payment_option'] as $col) {
                    if (Schema::hasColumn('partner_applications', $col)) {
                        $table->dropColumn($col);
                    }
                }

                // Add new columns if they don't exist
                if (!Schema::hasColumn('partner_applications', 'current_student_population')) {
                    $table->string('current_student_population')->nullable();
                }
                if (!Schema::hasColumn('partner_applications', 'additional_info')) {
                    $table->text('additional_info')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('partner_applications')) {
            Schema::table('partner_applications', function (Blueprint $table) {
                // Rename columns back if they exist
                if (Schema::hasColumn('partner_applications', 'name')) {
                    $table->renameColumn('name', 'full_name');
                }
                if (Schema::hasColumn('partner_applications', 'location')) {
                    $table->renameColumn('location', 'city');
                }

                // Add back old columns if missing
                foreach (['education', 'has_laptop', 'motivation', 'payment_option'] as $col) {
                    if (!Schema::hasColumn('partner_applications', $col)) {
                        switch ($col) {
                            case 'education':
                            case 'has_laptop':
                            case 'payment_option':
                                $table->string($col)->nullable();
                                break;
                            case 'motivation':
                                $table->text($col)->nullable();
                                break;
                        }
                    }
                }

                // Drop newly added columns if they exist
                foreach (['current_student_population', 'additional_info'] as $col) {
                    if (Schema::hasColumn('partner_applications', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });

            // Rename table back only if it exists
            if (Schema::hasTable('partner_applications') && !Schema::hasTable('course_applications')) {
                Schema::rename('partner_applications', 'course_applications');
            }
        }
    }
};