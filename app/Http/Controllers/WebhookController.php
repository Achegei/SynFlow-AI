<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\UserCourse;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleIntaSend(Request $request)
    {
        Log::info("[IntaSend Webhook] Received:", $request->all());

        $data = $request->all();

        // Validate required fields
        if (!isset($data['api_ref'], $data['state'], $data['invoice_id'])) {
            Log::error("[IntaSend Webhook] Invalid payload", $data);
            return response()->json(['error' => 'Invalid payload'], 422);
        }

        // Parse api_ref: order-user{userId}-course{courseId}-timestamp
        $refParts = explode('-', $data['api_ref']);
        if (count($refParts) < 4) {
            Log::error("[IntaSend Webhook] Invalid api_ref format: {$data['api_ref']}");
            return response()->json(['error' => 'Invalid api_ref format'], 422);
        }

        $userId   = intval(str_replace('user', '', $refParts[1]));
        $courseId = intval(str_replace('course', '', $refParts[2]));

        Log::info("[IntaSend Webhook] Parsed user_id={$userId}, course_id={$courseId}");

        // Find payment
        $payment = Payment::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->where('payment_id', $data['invoice_id'])
            ->first();

        if (!$payment) {
            Log::warning("[IntaSend Webhook] Payment record not found for invoice_id: {$data['invoice_id']}");
            return response()->json(['error' => 'Payment record not found'], 404);
        }

        // Update status
        $state = strtolower($data['state']);
        $payment->status = ($state === 'complete') ? 'paid' : $state;
        $payment->payload = json_encode($data);
        $payment->save();

        Log::info("[IntaSend Webhook] Payment updated", ['payment_id' => $payment->id, 'status' => $payment->status]);

        // Unlock course if paid
        if ($payment->status === 'paid') {
            UserCourse::firstOrCreate([
                'user_id' => $userId,
                'course_id' => $courseId,
            ]);

            Log::info("[IntaSend Webhook] Course unlocked for user {$userId}");
        }

        return response()->json(['message' => 'Webhook processed'], 200);
    }
}
