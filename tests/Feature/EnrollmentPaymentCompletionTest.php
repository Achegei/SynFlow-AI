<?php

use App\Models\CommissionTransaction;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\Payment;
use App\Models\SalesExecutive;
use App\Models\User;
use App\Services\PaymentCompletionService;
use App\Services\SmartEmailEventService;

test('verified enrollment payment activates enrollment and remains idempotent', function () {
    $salesUser = User::factory()->create([
        'role' => 'sales_executive',
    ]);

    $salesExecutive = SalesExecutive::create([
        'user_id' => $salesUser->id,
        'wallet_balance' => 0,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);

    $institution = Institution::create([
        'name' => 'Completion Test Institution',
        'slug' => 'completion-test-institution',
        'referral_code' => 'COMPLETION-001',
        'sales_executive_id' => $salesExecutive->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $course = Course::create([
        'title' => 'Completion Test Course',
        'price' => 5500,
    ]);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'institution',
        'institution_id' => $institution->id,
        'sales_executive_id' => $salesExecutive->id,
        'status' => 'pending',
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => $enrollment->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'COMPLETION-INVOICE-001',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
        'payload' => ['value' => 5500],
    ]);

    // Isolate email side effects. The completion service is invoked
    // directly, representing the post-verification application boundary.
    $emailEvents = Mockery::mock(SmartEmailEventService::class);
    $emailEvents->shouldReceive('handle')->once();
    app()->instance(SmartEmailEventService::class, $emailEvents);

    $service = app(PaymentCompletionService::class);

    $service->complete($payment);

    expect($payment->fresh()->status)->toBe('paid')
        ->and($enrollment->fresh()->status)->toBe('paid')
        ->and($enrollment->fresh()->paid_at)->not->toBeNull();

    expect($student->fresh()->courses()
        ->whereKey($course->id)->exists())->toBeTrue();

    expect(CommissionTransaction::where(
        'course_enrollment_id',
        $enrollment->id
    )->count())->toBe(1);

    expect((float) $institution->fresh()->wallet_balance)->toBe(2200.0)
        ->and((float) $salesExecutive->fresh()->wallet_balance)->toBe(1000.0);

    $service->complete($payment->fresh());

    expect(CommissionTransaction::where(
        'course_enrollment_id',
        $enrollment->id
    )->count())->toBe(1);

    expect((float) $institution->fresh()->wallet_balance)->toBe(2200.0)
        ->and((float) $salesExecutive->fresh()->wallet_balance)->toBe(1000.0);
});


test('enrollment payment rollback suppresses confirmation email', function () {
    $student = User::factory()->create(['role' => 'student']);

    $course = Course::create([
        'title' => 'Rollback Payment Test Course',
        'price' => 5500,
    ]);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => $enrollment->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'ROLLBACK-INVOICE-001',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
        'payload' => ['value' => 5500],
    ]);

    $emailEvents = Mockery::mock(SmartEmailEventService::class);
    $emailEvents->shouldNotReceive('handle');
    app()->instance(SmartEmailEventService::class, $emailEvents);

    $commissions = Mockery::mock(\App\Services\CommissionService::class);
    $commissions->shouldReceive('process')
        ->once()
        ->andThrow(new RuntimeException('Simulated commission failure'));

    app()->instance(\App\Services\CommissionService::class, $commissions);

    try {
        app(PaymentCompletionService::class)->complete($payment);
        test()->fail('Expected commission failure was not thrown.');
    } catch (RuntimeException $exception) {
        expect($exception->getMessage())
            ->toBe('Simulated commission failure');
    }

    expect($payment->fresh()->status)->toBe('pending')
        ->and($payment->fresh()->paid_at)->toBeNull()
        ->and($enrollment->fresh()->status)->toBe('pending')
        ->and($enrollment->fresh()->paid_at)->toBeNull();

    expect(CommissionTransaction::where(
        'course_enrollment_id',
        $enrollment->id
    )->count())->toBe(0);
});


test('successful payment sends confirmation once after commit', function () {
    $student = User::factory()->create(['role' => 'student']);

    $course = Course::create([
        'title' => 'After Commit Confirmation Course',
        'price' => 5500,
    ]);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => $enrollment->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'AFTER-COMMIT-INVOICE-001',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
        'payload' => ['value' => 5500],
    ]);

    $events = [];

    $emailEvents = Mockery::mock(SmartEmailEventService::class);

    $emailEvents->shouldReceive('handle')
        ->once()
        ->withArgs(function ($event, $user, $metadata) use (
            &$events,
            $student,
            $payment
        ) {
            $events[] = 'confirmation';

            return $event === 'payment_completed'
                && (int) $user->id === (int) $student->id
                && (int) $metadata['payment_id'] === (int) $payment->id;
        });

    app()->instance(SmartEmailEventService::class, $emailEvents);

    $service = app(PaymentCompletionService::class);

    \Illuminate\Support\Facades\DB::transaction(function () use (
        $service,
        $payment,
        &$events
    ) {
        $service->complete($payment);

        expect($events)->toBe([]);
    });

    expect($events)->toBe(['confirmation'])
        ->and($payment->fresh()->status)->toBe('paid')
        ->and($enrollment->fresh()->status)->toBe('paid');

    $service->complete($payment->fresh());

    expect($events)->toBe(['confirmation']);
});


test('already paid enrollment payment recovers missing commission', function () {
    $salesUser = User::factory()->create([
        'role' => 'sales_executive',
    ]);

    $salesExecutive = SalesExecutive::create([
        'user_id' => $salesUser->id,
        'wallet_balance' => 0,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);

    $institution = Institution::create([
        'name' => 'Recovery Test Institution',
        'slug' => 'recovery-test-institution',
        'referral_code' => 'RECOVERY-001',
        'sales_executive_id' => $salesExecutive->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $course = Course::create([
        'title' => 'Recovery Test Course',
        'price' => 5500,
    ]);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'institution',
        'institution_id' => $institution->id,
        'sales_executive_id' => $salesExecutive->id,
        'status' => 'pending',
    ]);

    // Simulate a previously completed local payment whose enrollment
    // and commission were not finalized. No provider API is called.
    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => $enrollment->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'RECOVERY-INVOICE-001',
        'status' => 'paid',
        'paid_at' => now(),
        'amount' => 5500,
        'currency' => 'KES',
        'payload' => ['value' => 5500],
    ]);

    $emailEvents = Mockery::mock(SmartEmailEventService::class);
    $emailEvents->shouldNotReceive('handle');
    app()->instance(SmartEmailEventService::class, $emailEvents);

    $service = app(PaymentCompletionService::class);

    $service->complete($payment);

    expect($enrollment->fresh()->status)->toBe('paid')
        ->and($enrollment->fresh()->paid_at)->not->toBeNull();

    expect(CommissionTransaction::where(
        'course_enrollment_id',
        $enrollment->id
    )->count())->toBe(1);

    expect((float) $institution->fresh()->wallet_balance)->toBe(2200.0)
        ->and((float) $salesExecutive->fresh()->wallet_balance)->toBe(1000.0);

    $service->complete($payment->fresh());

    expect(CommissionTransaction::where(
        'course_enrollment_id',
        $enrollment->id
    )->count())->toBe(1);

    expect((float) $institution->fresh()->wallet_balance)->toBe(2200.0)
        ->and((float) $salesExecutive->fresh()->wallet_balance)->toBe(1000.0);
});


test('enrollment payment with package is rejected atomically', function () {
    $student = User::factory()->create(['role' => 'student']);

    $course = Course::create([
        'title' => 'Malformed Enrollment Payment Course',
        'price' => 5500,
    ]);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $package = \App\Models\Package::create([
        'course_id' => $course->id,
        'name' => 'Malformed Enrollment Test Package',
        'slug' => 'malformed-enrollment-test-package',
        'duration_days' => 7,
        'price' => 1049,
        'active' => true,
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => $enrollment->id,
        'package_id' => $package->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'MALFORMED-ENROLLMENT-PACKAGE-001',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
    ]);

    $emailEvents = Mockery::mock(SmartEmailEventService::class);
    $emailEvents->shouldNotReceive('handle');
    app()->instance(SmartEmailEventService::class, $emailEvents);

    expect(fn () => app(PaymentCompletionService::class)->complete($payment))
        ->toThrow(\DomainException::class);

    expect($payment->fresh()->status)->toBe('pending')
        ->and($payment->fresh()->paid_at)->toBeNull()
        ->and($enrollment->fresh()->status)->toBe('pending')
        ->and($enrollment->fresh()->paid_at)->toBeNull()
        ->and($student->fresh()->courses()
            ->whereKey($course->id)->exists())->toBeFalse();

    expect(CommissionTransaction::where(
        'course_enrollment_id',
        $enrollment->id
    )->count())->toBe(0);
});
