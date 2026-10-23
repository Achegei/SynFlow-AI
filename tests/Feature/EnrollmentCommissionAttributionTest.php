<?php

use App\Models\CommissionTransaction;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\Payment;
use App\Models\SalesExecutive;
use App\Models\User;
use App\Services\CommissionService;

test('enrollment attribution is preserved and commission is awarded once', function () {
    $originalSalesUser = User::factory()->create([
        'role' => 'sales_executive',
    ]);

    $originalSalesExecutive = SalesExecutive::create([
        'user_id' => $originalSalesUser->id,
        'wallet_balance' => 0,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);

    $replacementSalesUser = User::factory()->create([
        'role' => 'sales_executive',
    ]);

    $replacementSalesExecutive = SalesExecutive::create([
        'user_id' => $replacementSalesUser->id,
        'wallet_balance' => 0,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);

    $institution = Institution::create([
        'name' => 'Attribution Test Institution',
        'slug' => 'attribution-test-institution',
        'referral_code' => 'ATTRIBUTION-001',
        'sales_executive_id' => $originalSalesExecutive->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $course = Course::create([
        'title' => 'Attribution Test Course',
        'price' => 5500,
    ]);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'institution',
        'institution_id' => $institution->id,
        'sales_executive_id' => $originalSalesExecutive->id,
        'status' => 'pending',
    ]);

    // Reassignment must not change existing enrollment attribution.
    $institution->sales_executive_id = $replacementSalesExecutive->id;
    $institution->save();

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

    $firstPayment = $makePayment('ATTRIBUTION-PAYMENT-001');
    $secondPayment = $makePayment('ATTRIBUTION-PAYMENT-002');

    $service = app(CommissionService::class);

    $service->process($firstPayment);
    $service->process($secondPayment);

    expect(
        CommissionTransaction::where(
            'course_enrollment_id',
            $enrollment->id
        )->count()
    )->toBe(1);

    $transaction = CommissionTransaction::where(
        'course_enrollment_id',
        $enrollment->id
    )->firstOrFail();

    expect($transaction->sales_executive_id)
        ->toBe($originalSalesExecutive->id);

    expect((float) $institution->fresh()->wallet_balance)
        ->toBe(2200.0);

    expect((float) $originalSalesExecutive->fresh()->wallet_balance)
        ->toBe(1000.0);

    expect((float) $replacementSalesExecutive->fresh()->wallet_balance)
        ->toBe(0.0);
});
