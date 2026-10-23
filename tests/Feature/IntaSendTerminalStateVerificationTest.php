<?php

use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use App\Services\IntaSendPaymentService;
use IntaSend\IntaSendPHP\Collection;

function terminalVerificationPayment(): Payment
{
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Terminal Verification Test Course',
        'price' => 5500,
    ]);

    return Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'EXPECTED-INVOICE',
        'api_ref' => 'EXPECTED-REFERENCE',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
    ]);
}

function mockTerminalInvoice(
    string $state,
    array $overrides = []
): void {
    $invoice = array_merge([
        'invoice_id' => 'EXPECTED-INVOICE',
        'api_ref' => 'EXPECTED-REFERENCE',
        'value' => 5500,
        'currency' => 'KES',
        'state' => $state,
    ], $overrides);

    $collection = Mockery::mock(Collection::class);

    $collection->shouldReceive('init')->once();

    $collection->shouldReceive('status')
        ->once()
        ->with('EXPECTED-INVOICE')
        ->andReturn((object) [
            'invoice' => (object) $invoice,
        ]);

    app()->instance(Collection::class, $collection);
}

test('mismatched failed invoice cannot release pending payment', function () {
    $payment = terminalVerificationPayment();

    mockTerminalInvoice('FAILED', [
        'api_ref' => 'WRONG-REFERENCE',
    ]);

    app(IntaSendPaymentService::class)->synchronize($payment);

    expect($payment->fresh()->status)->toBe('pending')
        ->and($payment->fresh()->payload)->toBeNull();
});

test('mismatched cancelled invoice cannot release pending payment', function () {
    $payment = terminalVerificationPayment();

    mockTerminalInvoice('CANCELLED', [
        'value' => 5000,
    ]);

    app(IntaSendPaymentService::class)->synchronize($payment);

    expect($payment->fresh()->status)->toBe('pending')
        ->and($payment->fresh()->payload)->toBeNull();
});

test('verified failed invoice transitions payment to failed', function () {
    $payment = terminalVerificationPayment();

    mockTerminalInvoice('FAILED');

    app(IntaSendPaymentService::class)->synchronize($payment);

    expect($payment->fresh()->status)->toBe('failed');
});

test('verified cancelled invoice transitions payment to cancelled', function () {
    $payment = terminalVerificationPayment();

    mockTerminalInvoice('FAILED', [
        'failed_code' => '1032',
        'failed_reason' => 'Request Cancelled by user.',
    ]);

    app(IntaSendPaymentService::class)->synchronize($payment);

    expect($payment->fresh()->status)->toBe('cancelled');
});


test('pending payment without invoice ID never queries IntaSend', function () {
    $payment = terminalVerificationPayment();

    $payment->update([
        'payment_id' => null,
    ]);

    $collection = Mockery::mock(Collection::class);

    $collection->shouldNotReceive('init');
    $collection->shouldNotReceive('status');

    app()->instance(Collection::class, $collection);

    $result = app(IntaSendPaymentService::class)
        ->synchronize($payment);

    expect($result->status)->toBe('pending')
        ->and($result->payment_id)->toBeNull()
        ->and($result->payload)->toBeNull()
        ->and($payment->fresh()->status)->toBe('pending');
});
