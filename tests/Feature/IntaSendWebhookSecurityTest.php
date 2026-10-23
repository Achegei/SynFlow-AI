<?php

use App\Models\Payment;
use App\Models\CourseEnrollment;
use App\Models\Course;
use App\Models\User;
use App\Services\IntaSendPaymentService;
use IntaSend\IntaSendPHP\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a forged successful webhook cannot directly complete a payment', function () {
    $user = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Webhook Security Test Course',
        'price' => 5500,
    ]);

    $payment = new Payment();

    $payment->user_id = $user->id;
    $payment->course_id = $course->id;
    $payment->provider = 'intasend';
    $payment->payment_type = 'course';
    $payment->payment_id = 'WEBHOOK-TEST-INVOICE';
    $payment->api_ref = 'WEBHOOK-TEST-ORDER';
    $payment->status = 'pending';
    $payment->amount = 5500;
    $payment->currency = 'KES';
    $payment->save();

    $reconciliation = Mockery::mock(IntaSendPaymentService::class);

    $reconciliation
        ->shouldReceive('synchronize')
        ->once()
        ->andReturnUsing(function (Payment $received) use ($payment) {
            expect($received->id)->toBe($payment->id);

            return $received->fresh();
        });

    app()->instance(IntaSendPaymentService::class, $reconciliation);

    $response = $this->postJson('/api/webhook/intasend', [
        'invoice_id' => 'WEBHOOK-TEST-INVOICE',
        'api_ref' => 'WEBHOOK-TEST-ORDER',
        'state' => 'COMPLETE',
        'paid' => true,
    ]);

    $response->assertOk();

    expect($payment->fresh()->status)->toBe('pending');
    expect($payment->fresh()->payment_id)->toBe('WEBHOOK-TEST-INVOICE');
    expect($payment->fresh()->api_ref)->toBe('WEBHOOK-TEST-ORDER');
});

test('a webhook with mismatched payment references is rejected before reconciliation', function () {
    $user = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Webhook Security Test Course',
        'price' => 5500,
    ]);

    $payment = new Payment();

    $payment->user_id = $user->id;
    $payment->course_id = $course->id;
    $payment->provider = 'intasend';
    $payment->payment_type = 'course';
    $payment->payment_id = 'WEBHOOK-MISMATCH-INVOICE';
    $payment->api_ref = 'WEBHOOK-MISMATCH-ORDER';
    $payment->status = 'pending';
    $payment->amount = 5500;
    $payment->currency = 'KES';
    $payment->save();

    $reconciliation = Mockery::mock(IntaSendPaymentService::class);

    $reconciliation
        ->shouldNotReceive('synchronize');

    app()->instance(IntaSendPaymentService::class, $reconciliation);

    $response = $this->postJson('/api/webhook/intasend', [
        'invoice_id' => 'WEBHOOK-MISMATCH-INVOICE',
        'api_ref' => 'WRONG-ORDER',
        'state' => 'COMPLETE',
        'paid' => true,
    ]);

    $response->assertOk();

    expect($payment->fresh()->status)->toBe('pending');
    expect($payment->fresh()->api_ref)->toBe('WEBHOOK-MISMATCH-ORDER');
});


test('early webhook cannot attach an unverified invoice to an enrollment payment', function () {
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Early Webhook Security Course',
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
        'payment_id' => null,
        'api_ref' => 'EARLY-WEBHOOK-REFERENCE',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
    ]);

    $reconciliation = Mockery::mock(IntaSendPaymentService::class);

    $reconciliation->shouldNotReceive('synchronize');

    app()->instance(IntaSendPaymentService::class, $reconciliation);

    $this->postJson('/api/webhook/intasend', [
        'invoice_id' => 'UNVERIFIED-EARLY-INVOICE',
        'api_ref' => 'EARLY-WEBHOOK-REFERENCE',
        'state' => 'COMPLETE',
        'paid' => true,
    ])->assertOk();

    expect($payment->fresh()->payment_id)->toBeNull()
        ->and($payment->fresh()->status)->toBe('pending')
        ->and($enrollment->fresh()->status)->toBe('pending');
});


test('verified early webhook can associate a matching provider invoice', function () {
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Verified Early Webhook Course',
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
        'payment_id' => null,
        'api_ref' => 'VERIFIED-EARLY-REFERENCE',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
    ]);

    config()->set('intasend.secret_key', 'test-secret');
    config()->set('intasend.publishable_key', 'test-public');
    config()->set('intasend.test_mode', true);

    $collection = Mockery::mock(Collection::class);

    $collection->shouldReceive('init')->twice();

    $collection->shouldReceive('status')
        ->twice()
        ->with('VERIFIED-EARLY-INVOICE')
        ->andReturn((object) [
            'invoice' => (object) [
                'invoice_id' => 'VERIFIED-EARLY-INVOICE',
                'api_ref' => 'VERIFIED-EARLY-REFERENCE',
                'value' => 5500,
                'currency' => 'KES',
                'state' => 'PENDING',
            ],
        ]);

    app()->instance(Collection::class, $collection);

    $this->postJson('/api/webhook/intasend', [
        'invoice_id' => 'VERIFIED-EARLY-INVOICE',
        'api_ref' => 'VERIFIED-EARLY-REFERENCE',
        'state' => 'PENDING',
    ])->assertOk();

    expect($payment->fresh()->payment_id)
        ->toBe('VERIFIED-EARLY-INVOICE')
        ->and($payment->fresh()->status)->toBe('pending')
        ->and($enrollment->fresh()->status)->toBe('pending');
});
