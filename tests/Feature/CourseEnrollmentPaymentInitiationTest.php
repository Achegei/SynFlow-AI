<?php

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Payment;
use App\Models\User;
use IntaSend\IntaSendPHP\Wallet;

test('successful STK initiation creates payment linked to enrollment', function () {
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Payment Initiation Test Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);
    config()->set('enrollment.fee', 5500);
    config()->set('intasend.secret_key', 'test-secret');
    config()->set('intasend.publishable_key', 'test-public');
    config()->set('intasend.wallet_id', 'test-wallet');
    config()->set('intasend.test_mode', true);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'institution_id' => null,
        'sales_executive_id' => null,
        'status' => 'pending',
    ]);

    $wallet = Mockery::mock(Wallet::class);

    $wallet->shouldReceive('init')
        ->once()
        ->with(Mockery::on(function ($credentials) {
            return $credentials['token'] === 'test-secret'
                && $credentials['publishable_key'] === 'test-public'
                && $credentials['test'] === true;
        }));

    $wallet->shouldReceive('fund_mpesa_stk_push')
        ->once()
        ->with(
            'test-wallet',
            '254712345678',
            $student->email,
            5500,
            Mockery::on(function ($reference) {
                return is_string($reference)
                    && str_starts_with($reference, 'order-user');
            })
        )
        ->andReturn((object) [
            'invoice' => (object) [
                'invoice_id' => 'TEST-INVOICE-5500',
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

    expect((int) $payment->course_enrollment_id)->toBe($enrollment->id)
        ->and($payment->status)->toBe('pending')
        ->and($payment->payment_id)->toBe('TEST-INVOICE-5500')
        ->and($payment->provider)->toBe('intasend')
        ->and($payment->payment_type)->toBe('course')
        ->and($payment->currency)->toBe('KES')
        ->and((float) $payment->amount)->toBe(5500.0)
        ->and($payment->api_ref)->not->toBeNull();

    $this->assertDatabaseCount('payments', 1);
});


test('gateway exception preserves a local payment attempt', function () {
    $student = User::factory()->create(['role' => 'student']);

    $course = Course::create([
        'title' => 'Gateway Recovery Test Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);
    config()->set('enrollment.fee', 5500);
    config()->set('intasend.secret_key', 'test-secret');
    config()->set('intasend.publishable_key', 'test-public');
    config()->set('intasend.wallet_id', 'test-wallet');
    config()->set('intasend.test_mode', true);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $wallet = Mockery::mock(Wallet::class);
    $wallet->shouldReceive('init')->once();
    $wallet->shouldReceive('fund_mpesa_stk_push')
        ->once()
        ->andThrow(new RuntimeException('Gateway timeout'));

    app()->instance(Wallet::class, $wallet);

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '0712345678',
        ])
        ->assertRedirect();

    $payment = Payment::query()
        ->where('course_enrollment_id', $enrollment->id)
        ->first();

    expect($payment)->not->toBeNull()
        ->and($payment->status)->toBe('pending')
        ->and($payment->api_ref)->not->toBeNull()
        ->and($payment->payment_id)->toBeNull();
});

test('missing gateway invoice preserves a local payment attempt', function () {
    $student = User::factory()->create(['role' => 'student']);

    $course = Course::create([
        'title' => 'Missing Invoice Recovery Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);
    config()->set('enrollment.fee', 5500);
    config()->set('intasend.secret_key', 'test-secret');
    config()->set('intasend.publishable_key', 'test-public');
    config()->set('intasend.wallet_id', 'test-wallet');
    config()->set('intasend.test_mode', true);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $wallet = Mockery::mock(Wallet::class);
    $wallet->shouldReceive('init')->once();
    $wallet->shouldReceive('fund_mpesa_stk_push')
        ->once()
        ->andReturn((object) ['message' => 'Request received']);

    app()->instance(Wallet::class, $wallet);

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '0712345678',
        ])
        ->assertRedirect();

    $payment = Payment::query()
        ->where('course_enrollment_id', $enrollment->id)
        ->first();

    expect($payment)->not->toBeNull()
        ->and($payment->status)->toBe('pending')
        ->and($payment->api_ref)->not->toBeNull()
        ->and($payment->payment_id)->toBeNull();
});


test('existing pending enrollment payment does not initiate another STK push', function () {
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Duplicate Payment Protection Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);
    config()->set('enrollment.fee', 5500);
    config()->set('intasend.secret_key', 'test-secret');
    config()->set('intasend.publishable_key', 'test-public');
    config()->set('intasend.wallet_id', 'test-wallet');
    config()->set('intasend.test_mode', true);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $existingPayment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => $enrollment->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'EXISTING-PENDING-INVOICE',
        'api_ref' => 'EXISTING-PENDING-REFERENCE',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
    ]);

    $wallet = Mockery::mock(Wallet::class);

    $wallet->shouldNotReceive('fund_mpesa_stk_push');

    app()->instance(Wallet::class, $wallet);

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '0712345678',
        ])
        ->assertRedirect(
            route('payment.pending', $existingPayment->id)
        );

    expect(
        Payment::where(
            'course_enrollment_id',
            $enrollment->id
        )->count()
    )->toBe(1);
});


test('confirmed failed or cancelled enrollment payment permits a new attempt', function ($terminalStatus) {
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Payment Retry Test Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);
    config()->set('enrollment.fee', 5500);
    config()->set('intasend.secret_key', 'test-secret');
    config()->set('intasend.publishable_key', 'test-public');
    config()->set('intasend.wallet_id', 'test-wallet');
    config()->set('intasend.test_mode', true);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $previous = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => $enrollment->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'PREVIOUS-TERMINAL-INVOICE',
        'api_ref' => 'PREVIOUS-TERMINAL-REFERENCE',
        'status' => $terminalStatus,
        'amount' => 5500,
        'currency' => 'KES',
    ]);

    $wallet = Mockery::mock(Wallet::class);

    $wallet->shouldReceive('init')->once();

    $wallet->shouldReceive('fund_mpesa_stk_push')
        ->once()
        ->andReturn((object) [
            'invoice' => (object) [
                'invoice_id' => 'RETRY-TEST-INVOICE',
            ],
        ]);

    app()->instance(Wallet::class, $wallet);

    $response = $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '0712345678',
        ]);

    $newPayment = Payment::query()
        ->where('course_enrollment_id', $enrollment->id)
        ->whereKeyNot($previous->id)
        ->first();

    expect($newPayment)->not->toBeNull()
        ->and($newPayment->status)->toBe('pending')
        ->and($newPayment->payment_id)->toBe('RETRY-TEST-INVOICE')
        ->and($previous->fresh()->status)->toBe($terminalStatus);

    $response->assertRedirect(
        route('payment.pending', $newPayment->id)
    );

    $this->assertDatabaseCount('payments', 2);
})->with(['failed', 'cancelled']);


test('late STK response cannot overwrite an invoice already associated by a webhook', function () {
    $student = User::factory()->create(['role' => 'student']);

    $course = Course::create([
        'title' => 'Late STK Response Protection Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);
    config()->set('enrollment.fee', 5500);
    config()->set('intasend.secret_key', 'test-secret');
    config()->set('intasend.publishable_key', 'test-public');
    config()->set('intasend.wallet_id', 'test-wallet');
    config()->set('intasend.test_mode', true);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $wallet = Mockery::mock(Wallet::class);
    $wallet->shouldReceive('init')->once();

    $wallet->shouldReceive('fund_mpesa_stk_push')
        ->once()
        ->andReturnUsing(function () use ($enrollment) {
            $payment = Payment::query()
                ->where('course_enrollment_id', $enrollment->id)
                ->firstOrFail();

            expect($payment->payment_id)->toBeNull();

            // Simulate a verified webhook winning the race.
            Payment::query()
                ->whereKey($payment->id)
                ->update([
                    'payment_id' => 'WEBHOOK-VERIFIED-INVOICE',
                    'payload' => ['source' => 'verified-webhook'],
                ]);

            // The original STK call returns afterward with a conflicting ID.
            return (object) [
                'invoice' => (object) [
                    'invoice_id' => 'LATE-CONFLICTING-INVOICE',
                ],
            ];
        });

    app()->instance(Wallet::class, $wallet);

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '0712345678',
        ])
        ->assertRedirect();

    $payment = Payment::query()
        ->where('course_enrollment_id', $enrollment->id)
        ->firstOrFail();

    expect($payment->payment_id)
        ->toBe('WEBHOOK-VERIFIED-INVOICE')
        ->and($payment->payload)
        ->toBe(['source' => 'verified-webhook']);

    $this->assertDatabaseCount('payments', 1);
});
