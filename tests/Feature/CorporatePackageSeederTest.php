<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Package;
use Database\Seeders\CorporatePackageSeeder;
use Database\Seeders\CorporateResponsibleAICourseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CorporatePackageSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_corporate_package_is_created_for_course_two(): void
    {
        $this->seed(CorporateResponsibleAICourseSeeder::class);
        $this->seed(CorporatePackageSeeder::class);

        $package = Package::where(
            'slug',
            'corporate-28-days-ai-access'
        )->first();

        $this->assertNotNull($package);

        $this->assertSame(2, $package->course_id);
        $this->assertSame('28 Days', $package->name);
        $this->assertSame(28, $package->duration_days);
        $this->assertEquals(1999.00, (float) $package->price);
        $this->assertTrue($package->active);
        $this->assertSame(30, $package->sort_order);
    }

    public function test_corporate_package_is_idempotent(): void
    {
        $this->seed(CorporateResponsibleAICourseSeeder::class);

        $this->seed(CorporatePackageSeeder::class);

        $firstCount = Package::where(
            'slug',
            'corporate-28-days-ai-access'
        )->count();

        $this->seed(CorporatePackageSeeder::class);

        $secondCount = Package::where(
            'slug',
            'corporate-28-days-ai-access'
        )->count();

        $this->assertSame(1, $firstCount);
        $this->assertSame(1, $secondCount);
    }

    public function test_corporate_package_is_active_and_makes_course_available(): void
    {
        $this->seed(CorporateResponsibleAICourseSeeder::class);
        $this->seed(CorporatePackageSeeder::class);

        $courseIds = Package::where('active', true)
            ->whereNotNull('course_id')
            ->pluck('course_id')
            ->map(fn ($id) => (int) $id)
            ->all();

        $this->assertContains(2, $courseIds);

        $course = Course::find(2);

        $this->assertNotNull($course);
        $this->assertSame(
            'Corporate AI Ethics, Governance & Responsible AI in the Workplace',
            $course->title
        );
    }

    public function test_existing_course_one_packages_are_not_modified(): void
    {
        $course = new Course();
        $course->id = 1;
        $course->title = 'Existing Course One';
        $course->description = 'Existing production course.';
        $course->save();

        Package::create([
            'course_id' => 1,
            'name' => 'Existing Test Package',
            'slug' => 'existing-course-one-test-package',
            'duration_days' => 1,
            'price' => 89.00,
            'description' => 'Existing Course 1 package.',
            'active' => true,
            'sort_order' => 1,
        ]);

        $this->seed(CorporateResponsibleAICourseSeeder::class);
        $this->seed(CorporatePackageSeeder::class);

        $courseOnePackage = Package::where(
            'slug',
            'existing-course-one-test-package'
        )->first();

        $this->assertNotNull($courseOnePackage);
        $this->assertSame(1, $courseOnePackage->course_id);
        $this->assertEquals(89.00, (float) $courseOnePackage->price);
        $this->assertTrue($courseOnePackage->active);

        $this->assertSame(
            1,
            Package::where('course_id', 1)
                ->where('slug', 'existing-course-one-test-package')
                ->count()
        );
    }
}
