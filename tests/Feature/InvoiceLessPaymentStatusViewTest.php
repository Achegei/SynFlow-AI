<?php

use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use IntaSend\IntaSendPHP\Collection;

test('invoice-less payment does not claim an STK request was delivered', function () {
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Invoice-Less Status View Test',
        'price' => 5500,
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => null,
        'api_ref' => 'TEST-UNRESOLVED-STK',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
    ]);

    $response = $this->actingAs($student)
        ->get(route('payment.pending', $payment->id));

    $response->assertOk()
        ->assertSee('Payment verification is pending')
        ->assertDontSee('An M-Pesa payment request has been sent to your phone.')
        ->assertDontSee('Please complete the M-Pesa payment on your phone.');
});


test('payment status reports whether a provider invoice is available', function () {
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Payment Invoice Availability Test',
        'price' => 5500,
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => null,
        'api_ref' => 'TEST-INVOICE-AVAILABILITY',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
    ]);

    /*
     * The invoice-less request must not call the provider.
     * The subsequent invoice-backed request must use this mock.
     */
    $collection = Mockery::mock(Collection::class);

    $collection->shouldReceive('init')->once();

    $collection->shouldReceive('status')
        ->once()
        ->with('TEST-PROVIDER-INVOICE')
        ->andReturn((object) [
            'invoice' => (object) [
                'invoice_id' => 'TEST-PROVIDER-INVOICE',
                'api_ref' => 'TEST-INVOICE-AVAILABILITY',
                'value' => 5500,
                'currency' => 'KES',
                'state' => 'PENDING',
            ],
        ]);

    app()->instance(Collection::class, $collection);

    $this->actingAs($student)
        ->getJson(route('payment.status', $payment->id))
        ->assertOk()
        ->assertJsonPath('status', 'pending')
        ->assertJsonPath('has_provider_invoice', false);

    $payment->update([
        'payment_id' => 'TEST-PROVIDER-INVOICE',
    ]);

    $this->actingAs($student)
        ->getJson(route('payment.status', $payment->id))
        ->assertOk()
        ->assertJsonPath('status', 'pending')
        ->assertJsonPath('has_provider_invoice', true);
});

test('verified cancelled M-Pesa payment returns a retryable cancelled status', function () {
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    $course = Course::create([
        'title' => 'Cancelled Payment Status Test',
        'price' => 5500,
    ]);

    $payment = Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'payment_id' => 'TEST-CANCELLED-INVOICE',
        'api_ref' => 'TEST-CANCELLED-REF',
        'status' => 'pending',
        'amount' => 5500,
        'currency' => 'KES',
    ]);

    $collection = Mockery::mock(Collection::class);

    $collection->shouldReceive('init')->once();

    $collection->shouldReceive('status')
        ->once()
        ->with('TEST-CANCELLED-INVOICE')
        ->andReturn((object) [
            'invoice' => (object) [
                'invoice_id' => 'TEST-CANCELLED-INVOICE',
                'api_ref' => 'TEST-CANCELLED-REF',
                'value' => 5500,
                'currency' => 'KES',
                'state' => 'CANCELLED',
            ],
        ]);

    app()->instance(Collection::class, $collection);

    $this->actingAs($student)
        ->getJson(route('payment.status', $payment->id))
        ->assertOk()
        ->assertJsonPath('status', 'cancelled')
        ->assertJsonPath('redirect', null);

    expect($payment->fresh()->status)->toBe('cancelled');
});
