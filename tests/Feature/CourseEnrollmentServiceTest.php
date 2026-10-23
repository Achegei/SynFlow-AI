<?php

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\SalesExecutive;
use App\Models\User;
use App\Services\CourseEnrollmentService;

beforeEach(function () {
    $course = Course::create([
        'title' => 'Enrollment Service Test Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);
});

function createEnrollmentTestInstitution(
    ?SalesExecutive $executive = null,
    string $status = 'active'
): Institution {
    static $sequence = 0;
    $sequence++;

    return Institution::create([
        'name' => 'Enrollment Test Institution ' . $sequence,
        'slug' => 'enrollment-test-' . $sequence,
        'referral_code' => 'ENROLL-' . $sequence,
        'sales_executive_id' => $executive?->id,
        'wallet_balance' => 0,
        'status' => $status,
    ]);
}

function createEnrollmentTestExecutive(): SalesExecutive
{
    $user = User::factory()->create([
        'role' => 'sales_executive',
    ]);

    return SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 0,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);
}

test('institutional enrollment captures attribution', function () {
    $student = User::factory()->create(['role' => 'student']);

    $executive = createEnrollmentTestExecutive();
    $institution = createEnrollmentTestInstitution($executive);

    $enrollment = app(CourseEnrollmentService::class)->create(
        $student,
        'institution',
        $institution
    );

    expect($enrollment->registration_context)->toBe('institution')
        ->and($enrollment->institution_id)->toBe($institution->id)
        ->and($enrollment->sales_executive_id)->toBe($executive->id)
        ->and($enrollment->status)->toBe('pending')
        ->and($enrollment->course_id)->toBe(
            (int) config('enrollment.course_id')
        );
});

test('independent enrollment has no institutional attribution', function () {
    $student = User::factory()->create(['role' => 'student']);

    $enrollment = app(CourseEnrollmentService::class)->create(
        $student,
        'other'
    );

    expect($enrollment->registration_context)->toBe('other')
        ->and($enrollment->institution_id)->toBeNull()
        ->and($enrollment->sales_executive_id)->toBeNull()
        ->and($enrollment->status)->toBe('pending');
});

test('repeated enrollment does not overwrite original attribution', function () {
    $student = User::factory()->create(['role' => 'student']);

    $firstExecutive = createEnrollmentTestExecutive();
    $secondExecutive = createEnrollmentTestExecutive();

    $institution = createEnrollmentTestInstitution($firstExecutive);

    $service = app(CourseEnrollmentService::class);

    $original = $service->create(
        $student,
        'institution',
        $institution
    );

    $institution->sales_executive_id = $secondExecutive->id;
    $institution->save();

    $repeated = $service->create(
        $student,
        'institution',
        $institution->fresh()
    );

    expect($repeated->id)->toBe($original->id)
        ->and($repeated->sales_executive_id)->toBe($firstExecutive->id)
        ->and(CourseEnrollment::where(
            'user_id',
            $student->id
        )->count())->toBe(1);
});

test('inactive institution cannot create an enrollment', function () {
    $student = User::factory()->create(['role' => 'student']);

    $executive = createEnrollmentTestExecutive();

    $institution = createEnrollmentTestInstitution(
        $executive,
        'suspended'
    );

    expect(fn () => app(CourseEnrollmentService::class)->create(
        $student,
        'institution',
        $institution
    ))->toThrow(\InvalidArgumentException::class);

    expect(CourseEnrollment::count())->toBe(0);
});

test('institution without sales executive cannot create an enrollment', function () {
    $student = User::factory()->create(['role' => 'student']);

    $institution = createEnrollmentTestInstitution();

    expect(fn () => app(CourseEnrollmentService::class)->create(
        $student,
        'institution',
        $institution
    ))->toThrow(\InvalidArgumentException::class);

    expect(CourseEnrollment::count())->toBe(0);
});
