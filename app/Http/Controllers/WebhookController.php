<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\UserCourse;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request, $provider)
    {
        Log::info("[Webhook] Received from {$provider}", $request->all());

        // Only accept IntaSend for now
        if (strtolower($provider) !== 'intasend') {
            return response()->json(['error' => 'Unknown provider'], 400);
        }

        $data = $request->all();

        // Validate required IntaSend fields
        if (!isset($data['api_ref'], $data['state'], $data['invoice_id'])) {
            Log::error("[Webhook] Invalid payload", $data);
            return response()->json(['error' => 'Invalid payload'], 422);
        }

        // Example api_ref: order-user28-course1-1763927547
        $refParts = explode('-', $data['api_ref']);

        if (count($refParts) < 4) {
            Log::error("[Webhook] Invalid api_ref format");
            return response()->json(['error' => 'Invalid api_ref format'], 422);
        }

        // Extract user and course
        $userId   = intval(str_replace('user', '', $refParts[1]));
        $courseId = intval(str_replace('course', '', $refParts[2]));

        Log::info("[Webhook] Parsed user_id={$userId}, course_id={$courseId}");

        // Find matching payment record
        $payment = Payment::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->where('payment_id', $data['invoice_id'])
            ->first();

        if (!$payment) {
            Log::warning("[Webhook] Payment record not found for invoice_id: {$data['invoice_id']}");

            return response()->json(['error' => 'Payment record not found'], 404);
        }

        // Update payment status
        if (strtolower($data['state']) === 'complete') {
            $payment->status  = 'paid';
        } else {
            $payment->status  = strtolower($data['state']);
        }

        $payment->payload = $data;
        $payment->save();

        Log::info("[Webhook] Payment updated successfully", [
            'payment_id' => $payment->id,
            'status' => $payment->status
        ]);

        // If payment is paid, unlock the course
        if ($payment->status === 'paid') {
            UserCourse::firstOrCreate([
                'user_id'   => $userId,
                'course_id' => $courseId,
            ]);

            Log::info("[Webhook] Course unlocked for user {$userId}");
        }

        return response()->json(['message' => 'Webhook processed'], 200);
    }
}
