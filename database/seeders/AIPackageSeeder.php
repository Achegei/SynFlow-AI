<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Package;
use Illuminate\Database\Seeder;

class AIPackageSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Find the consumer AI course
        |--------------------------------------------------------------------------
        |
        | CHANGE THIS after we identify the actual course ID.
        |
        */

        $course = Course::findOrFail(8);

        Package::updateOrCreate(
            ['slug' => 'daily-ai-access'],
            [
                'course_id' => $course->id,
                'name' => 'Daily',
                'duration_days' => 1,
                'price' => 0,
                'description' => '24-hour access to the AI learning programme.',
                'active' => true,
                'sort_order' => 1,
            ]
        );

        Package::updateOrCreate(
            ['slug' => 'weekly-ai-access'],
            [
                'course_id' => $course->id,
                'name' => 'Weekly',
                'duration_days' => 7,
                'price' => 0,
                'description' => '7-day access to the AI learning programme.',
                'active' => true,
                'sort_order' => 2,
            ]
        );

        Package::updateOrCreate(
            ['slug' => 'monthly-ai-access'],
            [
                'course_id' => $course->id,
                'name' => 'Monthly',
                'duration_days' => 30,
                'price' => 0,
                'description' => '30-day access to the AI learning programme.',
                'active' => true,
                'sort_order' => 3,
            ]
        );
    }
}