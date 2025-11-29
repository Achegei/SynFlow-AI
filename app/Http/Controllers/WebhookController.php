<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentLog;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Handle IntaSend Webhook (MPESA / Card / Wallet)
     */
    public function handleIntaSend(Request $request)
    {
        $data = $request->all();
        Log::info("[Webhook] Incoming payload", $data);

        // 1️⃣ Determine invoice_id and API reference
        $invoiceId = $data['invoice_id'] ?? $data['id'] ?? null;
        $apiRef    = $data['api_ref'] ?? null;
        $paid      = $data['paid'] ?? false;
        $state     = strtolower($data['state'] ?? '');

        // 2️⃣ Save webhook log for auditing
        $log = PaymentLog::create([
            'invoice_id' => $invoiceId,
            'api_ref'    => $apiRef,
            'state'      => $state,
            'payload'    => json_encode($data),
        ]);
        Log::info("[Webhook] PaymentLog saved", ['id' => $log->id]);

        // 3️⃣ Validate required fields
        if (!$invoiceId || !$apiRef) {
            Log::error("[Webhook] Missing invoice_id or api_ref.");
            return response()->json(['success' => true]); // always return 200
        }

        // 4️⃣ Parse user_id and course_id from api_ref (expected format: order-user{userId}-course{courseId}-timestamp)
        if (!preg_match('/order-user(\d+)-course(\d+)-/', $apiRef, $matches)) {
            Log::error("[Webhook] Invalid api_ref format: {$apiRef}");
            return response()->json(['success' => true]);
        }

        $userId   = intval($matches[1]);
        $courseId = intval($matches[2]);

        // 5️⃣ Find or create payment record
        $payment = Payment::firstOrCreate(
            ['payment_id' => $invoiceId],
            [
                'user_id'   => $userId,
                'course_id' => $courseId,
                'status'    => 'pending',
                'provider'  => 'intasend',
                'api_ref'   => $apiRef,
                'amount'    => $data['amount'] ?? 0,
                'payload'   => json_encode($data),
            ]
        );

        // 6️⃣ Only process if payment is complete
        if (!$paid && $state !== 'complete') {
            Log::info("[Webhook] Payment not complete yet (paid={$paid}, state={$state})");
            return response()->json(['success' => true]);
        }

        // 7️⃣ Prevent duplicate processing
        if ($payment->status === 'paid') {
            Log::info("[Webhook] Payment already processed for invoice {$invoiceId}");
            return response()->json(['success' => true]);
        }

        // 8️⃣ Update payment status
        $payment->status  = 'paid';
        $payment->payload = json_encode($data);
        $payment->save();
        Log::info("[Webhook] Payment updated → PAID", ['payment_id' => $payment->id]);

        // 9️⃣ Unlock course for user using pivot table
        $user = User::find($userId);
        $course = Course::find($courseId);

        if ($user && $course) {
            $user->courses()->syncWithoutDetaching([$course->id]);
            Log::info("[Webhook] Course {$courseId} unlocked for User {$userId}");
        } else {
            Log::error("[Webhook] User or Course not found. user_id={$userId}, course_id={$courseId}");
        }

        return response()->json(['success' => true]);
    }
}
