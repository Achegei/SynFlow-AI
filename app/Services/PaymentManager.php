<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Log;

class PaymentManager
{
    /**
     * Record or update a payment and auto-enroll the user upon success.
     *
     * @param string $provider - payment gateway name (e.g. lemonsqueezy, flutterwave)
     * @param array $data - normalized payment data
     * @return bool
     */
    public function recordPayment($provider, $data)
    {
        $user = User::where('email', $data['email'])->first();
        $course = Course::find($data['course_id']);

        if (!$user || !$course) {
            Log::warning('❌ Payment ignored: User or Course not found.', $data);
            return false;
        }

        // ✅ Save or update payment using relationship
        $payment = Payment::updateOrCreate(
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'provider' => $provider,
            ],
            [
                'payment_id' => $data['payment_id'] ?? null,
                'status' => $data['status'] ?? 'pending',
                'amount' => $data['amount'] ?? null,
                'payload' => $data,
            ]
        );

        Log::info("💾 Payment recorded for {$user->email} on {$course->title} via {$provider}. Status: {$payment->status}");

        // ✅ Auto-enroll user if payment successful
        $successStatuses = ['paid', 'completed', 'success'];
        if (in_array(strtolower($data['status'] ?? ''), $successStatuses)) {
            // Use the relationship to attach without duplication
            $user->courses()->syncWithoutDetaching([$course->id]);
            Log::info("✅ {$user->email} enrolled in {$course->title}");
        }

        return true;
    }
}
