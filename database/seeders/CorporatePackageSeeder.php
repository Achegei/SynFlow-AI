<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorporatePackageSeeder extends Seeder
{
    private const COURSE_ID = 2;

    private const COURSE_TITLE =
        'Corporate AI Ethics, Governance & Responsible AI in the Workplace';

    private const PACKAGE_SLUG = 'corporate-28-days-ai-access';

    public function run(): void
    {
        DB::transaction(function () {
            $course = Course::find(self::COURSE_ID);

            if (!$course) {
                throw new \RuntimeException(
                    'Course 2 does not exist. Run CorporateResponsibleAICourseSeeder first.'
                );
            }

            if ($course->title !== self::COURSE_TITLE) {
                throw new \RuntimeException(
                    'Course 2 exists but is not the Corporate Responsible AI course. '
                    . 'Refusing to modify an unexpected course.'
                );
            }

            Package::updateOrCreate(
                [
                    'slug' => self::PACKAGE_SLUG,
                ],
                [
                    'course_id' => self::COURSE_ID,
                    'name' => '28 Days',
                    'duration_days' => 28,
                    'price' => 1999.00,
                    'description' =>
                        '28-day access to the Corporate AI Ethics, Governance & '
                        . 'Responsible AI in the Workplace programme.',
                    'active' => true,
                    'sort_order' => 30,
                ]
            );
        });
    }
}
