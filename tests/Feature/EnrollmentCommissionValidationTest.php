<?php

use App\Models\CommissionTransaction;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\Payment;
use App\Models\User;
use App\Services\CommissionService;

function makeEnrollmentValidationFixture(string $context = 'other'): array
{
    $student = User::factory()->create(['role' => 'student']);

    $course = Course::create([
        'title' => 'Enrollment Validation Test Course',
        'price' => 5500,
    ]);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => $context,
        'status' => 'pending',
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => $enrollment->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'VALIDATION-' . $enrollment->id,
        'status' => 'paid',
        'amount' => 5500,
        'currency' => 'KES',
        'payload' => ['value' => 5500],
    ]);

    return [$student, $course, $enrollment, $payment];
}

test('independent enrollment generates no institutional commission', function () {
    [$student, $course, $enrollment, $payment] =
        makeEnrollmentValidationFixture();

    app(CommissionService::class)->process($payment);

    expect(
        CommissionTransaction::where(
            'course_enrollment_id',
            $enrollment->id
        )->count()
    )->toBe(0);
});

test('payment with mismatched student is rejected', function () {
    [$student, $course, $enrollment, $payment] =
        makeEnrollmentValidationFixture();

    $otherStudent = User::factory()->create(['role' => 'student']);

    $payment->user_id = $otherStudent->id;
    $payment->save();

    expect(fn () => app(CommissionService::class)->process($payment))
        ->toThrow(\DomainException::class);

    expect(CommissionTransaction::count())->toBe(0);
});

test('payment with mismatched course is rejected', function () {
    [$student, $course, $enrollment, $payment] =
        makeEnrollmentValidationFixture();

    $otherCourse = Course::create([
        'title' => 'Different Enrollment Course',
        'price' => 5500,
    ]);

    $payment->course_id = $otherCourse->id;
    $payment->save();

    expect(fn () => app(CommissionService::class)->process($payment))
        ->toThrow(\DomainException::class);

    expect(CommissionTransaction::count())->toBe(0);
});

test('institutional enrollment without attribution is rejected', function () {
    [$student, $course, $enrollment, $payment] =
        makeEnrollmentValidationFixture('institution');

    expect(fn () => app(CommissionService::class)->process($payment))
        ->toThrow(\DomainException::class);

    expect(CommissionTransaction::count())->toBe(0);
});

test('independent enrollment with institution attribution is rejected', function () {
    [$student, $course, $enrollment, $payment] =
        makeEnrollmentValidationFixture();

    $institution = Institution::create([
        'name' => 'Invalid Attribution Institution',
        'slug' => 'invalid-attribution-institution',
        'referral_code' => 'INVALID-ATTRIBUTION-001',
        'status' => 'active',
    ]);

    $enrollment->institution_id = $institution->id;
    $enrollment->save();

    expect(fn () => app(CommissionService::class)->process($payment))
        ->toThrow(\DomainException::class);

    expect(CommissionTransaction::count())->toBe(0);
});

test('pending payment cannot generate enrollment commission', function () {
    [$student, $course, $enrollment, $payment] =
        makeEnrollmentValidationFixture('institution');

    $payment->status = 'pending';
    $payment->save();

    expect(fn () => app(CommissionService::class)->process($payment))
        ->toThrow(\DomainException::class);

    expect(CommissionTransaction::count())->toBe(0);
});
