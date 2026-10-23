<?php

use App\Models\EmailLog;
use App\Models\User;
use App\Services\SmartEmailService;

test('payment confirmations are deduplicated by individual payment ID', function () {
    $student = User::factory()->create([
        'role' => 'student',
    ]);

    EmailLog::create([
        'user_id' => $student->id,
        'event' => 'payment_completed',
        'template' => 'payment_completed',
        'recipient' => $student->email,
        'subject' => 'Payment Successful',
        'status' => 'sent',
        'sent_at' => now(),
        'metadata' => [
            'payment_id' => 101,
            'course_id' => 9,
            'amount' => 5500,
        ],
    ]);

    $service = app(SmartEmailService::class);

    expect($service->alreadySent(
        $student,
        'payment_completed',
        ['payment_id' => 101]
    ))->toBeTrue();

    expect($service->alreadySent(
        $student,
        'payment_completed',
        ['payment_id' => 102]
    ))->toBeFalse();
});
