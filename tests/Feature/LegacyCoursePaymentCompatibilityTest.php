<?php

use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use IntaSend\IntaSendPHP\Wallet;

function prepareLegacyCoursePaymentScenario(): array
{
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Legacy Course Payment Compatibility',
        'price' => 3200,
    ]);

    // Ensure this is NOT the special enrollment course.
    config()->set('enrollment.course_id', -1);

    config()->set('intasend.secret_key', 'test-secret');
    config()->set('intasend.publishable_key', 'test-public');
    config()->set('intasend.wallet_id', 'test-wallet');
    config()->set('intasend.test_mode', true);

    return [$student, $course];
}

test('ordinary course creates a payment after receiving an invoice', function () {
    [$student, $course] = prepareLegacyCoursePaymentScenario();

    $wallet = Mockery::mock(Wallet::class);

    $wallet->shouldReceive('init')->once();

    $wallet->shouldReceive('fund_mpesa_stk_push')
        ->once()
        ->andReturn((object) [
            'invoice' => (object) [
                'invoice_id' => 'LEGACY-COURSE-INVOICE-001',
            ],
        ]);

    app()->instance(Wallet::class, $wallet);

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '0712345678',
        ])
        ->assertRedirect();

    $payment = Payment::query()
        ->where('user_id', $student->id)
        ->where('course_id', $course->id)
        ->firstOrFail();

    expect($payment->payment_id)->toBe('LEGACY-COURSE-INVOICE-001')
        ->and($payment->course_enrollment_id)->toBeNull()
        ->and($payment->status)->toBe('pending')
        ->and((float) $payment->amount)->toBe(3200.0);

    $this->assertDatabaseCount('payments', 1);
});

test('ordinary course gateway exception retains a pending reservation', function () {
    [$student, $course] = prepareLegacyCoursePaymentScenario();

    $wallet = Mockery::mock(Wallet::class);

    $wallet->shouldReceive('init')->once();

    $wallet->shouldReceive('fund_mpesa_stk_push')
        ->once()
        ->andThrow(new RuntimeException('Simulated gateway timeout'));

    app()->instance(Wallet::class, $wallet);

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '0712345678',
        ])
        ->assertRedirect();

    $payment = Payment::query()
        ->where('user_id', $student->id)
        ->where('course_id', $course->id)
        ->firstOrFail();

    expect($payment->status)->toBe('pending')
        ->and($payment->payment_id)->toBeNull()
        ->and($payment->api_ref)->not->toBeEmpty()
        ->and($payment->course_enrollment_id)->toBeNull();

    $this->assertDatabaseCount('payments', 1);
});

test('ordinary course missing invoice retains a pending reservation', function () {
    [$student, $course] = prepareLegacyCoursePaymentScenario();

    $wallet = Mockery::mock(Wallet::class);

    $wallet->shouldReceive('init')->once();

    $wallet->shouldReceive('fund_mpesa_stk_push')
        ->once()
        ->andReturn((object) [
            'message' => 'Request received',
        ]);

    app()->instance(Wallet::class, $wallet);

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '0712345678',
        ])
        ->assertRedirect();

    $payment = Payment::query()
        ->where('user_id', $student->id)
        ->where('course_id', $course->id)
        ->firstOrFail();

    expect($payment->status)->toBe('pending')
        ->and($payment->payment_id)->toBeNull()
        ->and($payment->api_ref)->not->toBeEmpty()
        ->and($payment->course_enrollment_id)->toBeNull();

    $this->assertDatabaseCount('payments', 1);
});


test('existing pending ordinary course payment blocks another STK push', function () {
    [$student, $course] = prepareLegacyCoursePaymentScenario();

    $existing = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => null,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => null,
        'api_ref' => 'LEGACY-PENDING-REFERENCE',
        'status' => 'pending',
        'amount' => 3200,
        'currency' => 'KES',
    ]);

    $wallet = Mockery::mock(Wallet::class);
    $wallet->shouldReceive('init')->zeroOrMoreTimes();
    $wallet->shouldNotReceive('fund_mpesa_stk_push');
    app()->instance(Wallet::class, $wallet);

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '0712345678',
        ])
        ->assertRedirect(route('payment.pending', $existing->id));

    $this->assertDatabaseCount('payments', 1);
});
