<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Handle incoming IntaSend webhook
     */
    public function handleIntaSend(Request $request)
    {
        // 1️⃣ Verify HMAC signature
        $payload   = $request->getContent();
        $signature = $request->header('X-IntaSend-Signature');

        $expected = hash_hmac('sha256', $payload, config('intasend.secret_key'));

        if (!hash_equals($expected, $signature)) {
            Log::warning("[Webhook] Invalid signature detected", [
                'received' => $signature,
                'expected' => $expected,
                'payload'  => $request->all()
            ]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        Log::info("[Webhook] Valid payload received", $request->all());

        // 2️⃣ Extract invoice
        $invoice = $request->input('invoice');

        if (!$invoice || !isset($invoice['api_ref'])) {
            Log::error("[Webhook] Missing api_ref", $request->all());
            return response()->json(['error' => 'Missing api_ref'], 400);
        }

        // 3️⃣ Find corresponding Payment
        $payment = Payment::where('api_ref', $invoice['api_ref'])->first();

        if (!$payment) {
            Log::warning("[Webhook] Payment not found for api_ref: ".$invoice['api_ref']);
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // 4️⃣ Map status
        $state = strtoupper($invoice['state']); // e.g., PAID, PENDING, FAILED

        // Idempotent update: only change if status differs
        if ($payment->status !== $state) {
            $payment->status  = $state;
            $payment->payload = json_encode($request->all());
            $payment->save();

            Log::info("[Webhook] Payment updated", [
                'payment_id' => $payment->id,
                'status'     => $state
            ]);
        } else {
            Log::info("[Webhook] Payment status unchanged", [
                'payment_id' => $payment->id,
                'status'     => $state
            ]);
        }

        // 5️⃣ Unlock course if PAID
        if ($state === 'PAID') {
            $user = $payment->user;
            $courseId = $payment->course_id;

            if (!$user->courses->contains($courseId)) {
                $user->courses()->attach($courseId);
                Log::info("[Webhook] Course unlocked", [
                    'user_id'   => $user->id,
                    'course_id' => $courseId
                ]);
            } else {
                Log::info("[Webhook] Course already unlocked", [
                    'user_id'   => $user->id,
                    'course_id' => $courseId
                ]);
            }
        }

        return response()->json(['ok' => true]);
    }
}
