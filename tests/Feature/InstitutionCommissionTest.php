<?php

use App\Models\CommissionTransaction;
use App\Models\Course;
use App\Models\Institution;
use App\Models\Payment;
use App\Models\SalesExecutive;
use App\Models\User;
use App\Services\CommissionService;

test('one time institutional enrollment allocates commissions correctly', function () {
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
        'name' => 'Commission Test School',
        'slug' => 'commission-test-school',
        'referral_code' => 'COMM-TEST-001',
        'sales_executive_id' => $salesExecutive->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $course = Course::create([
        'title' => 'Commission Test Course',
        'price' => 5500,
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'COMMISSION-TEST-001',
        'status' => 'paid',
        'amount' => 5500,
        'currency' => 'KES',
        'payload' => ['value' => 5500],
    ]);

    app(CommissionService::class)->process($payment);

    expect((float) $institution->fresh()->wallet_balance)->toBe(2200.0)
        ->and((float) $salesExecutive->fresh()->wallet_balance)->toBe(1000.0);

    $transaction = CommissionTransaction::where('payment_id', $payment->id)->firstOrFail();

    expect((float) $transaction->institution_amount)->toBe(2200.0)
        ->and((float) $transaction->sales_amount)->toBe(1000.0)
        ->and((float) $transaction->company_amount)->toBe(2300.0);

    app(CommissionService::class)->process($payment);

    expect(CommissionTransaction::where('payment_id', $payment->id)->count())->toBe(1)
        ->and((float) $institution->fresh()->wallet_balance)->toBe(2200.0)
        ->and((float) $salesExecutive->fresh()->wallet_balance)->toBe(1000.0);
});

test('database prevents duplicate commission transactions for one payment', function () {
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
        'name' => 'Duplicate Commission Test School',
        'slug' => 'duplicate-commission-test-school',
        'referral_code' => 'COMM-DUP-001',
        'sales_executive_id' => $salesExecutive->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $course = Course::create([
        'title' => 'Duplicate Commission Test Course',
        'price' => 5500,
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'COMMISSION-DUP-001',
        'status' => 'paid',
        'amount' => 5500,
        'currency' => 'KES',
        'payload' => ['value' => 5500],
    ]);

    app(CommissionService::class)->process($payment);

    $original = CommissionTransaction::where('payment_id', $payment->id)
        ->firstOrFail();

    expect(fn () => CommissionTransaction::create(
        collect($original->getAttributes())
            ->except(['id', 'created_at', 'updated_at'])
            ->all()
    ))->toThrow(\Illuminate\Database\QueryException::class);

    expect(
        CommissionTransaction::where('payment_id', $payment->id)->count()
    )->toBe(1);
});

test('separate payments for the same enrollment do not generate duplicate commissions', function () {
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
        'name' => 'One Time Enrollment School',
        'slug' => 'one-time-enrollment-school',
        'referral_code' => 'ONE-TIME-001',
        'sales_executive_id' => $salesExecutive->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $course = Course::create([
        'title' => 'One Time Enrollment Course',
        'price' => 5500,
    ]);

    $enrollment = \App\Models\CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'institution',
        'institution_id' => $institution->id,
        'sales_executive_id' => $salesExecutive->id,
        'status' => 'pending',
    ]);

    $makePayment = function (string $reference) use ($student, $course, $enrollment) {
        return Payment::create([
            'user_id' => $student->id,
            'course_id' => $course->id,
            'course_enrollment_id' => $enrollment->id,
            'provider' => 'intasend',
            'payment_type' => 'course',
            'payment_id' => $reference,
            'status' => 'paid',
            'amount' => 5500,
            'currency' => 'KES',
            'payload' => ['value' => 5500],
        ]);
    };

    $firstPayment = $makePayment('FIRST-ENROLLMENT-PAYMENT');
    $secondPayment = $makePayment('SECOND-ENROLLMENT-PAYMENT');

    $service = app(CommissionService::class);

    $service->process($firstPayment);
    $service->process($secondPayment);

    expect(
        CommissionTransaction::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->count()
    )->toBe(1);

    expect((float) $institution->fresh()->wallet_balance)->toBe(2200.0)
        ->and((float) $salesExecutive->fresh()->wallet_balance)->toBe(1000.0);
});
