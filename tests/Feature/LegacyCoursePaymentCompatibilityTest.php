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

test('ordinary course gateway exception does not create a payment', function () {
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

    $this->assertDatabaseCount('payments', 0);
});

test('ordinary course missing invoice does not create a payment', function () {
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

    $this->assertDatabaseCount('payments', 0);
});
