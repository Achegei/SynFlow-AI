<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use App\Models\User;

class WebhookController extends Controller
{
    public function handle(Request $request, $provider)
    {
        Log::info("[Webhook] Received from {$provider}", $request->all());

        // Handle unknown provider
        if (strtolower($provider) !== 'intasend') {
            return response()->json(['error' => 'Unknown provider'], 400);
        }

        // Handle IntaSend challenge
        if ($request->has('challenge')) {
            Log::info("[Webhook] Challenge received: " . $request->challenge);
            return response($request->challenge, 200);
        }

        $invoiceState = $request->state ?? null;
        $apiRef       = $request->api_ref ?? null;

        if (!$apiRef) {
            Log::error("[Webhook] Missing api_ref. Cannot continue.");
            return response()->json(['error' => 'Missing api_ref'], 400);
        }

        // Only process final payment state
        if ($invoiceState === "COMPLETE") {
            Log::info("[Webhook] Payment COMPLETE. Starting verification...", [
                'api_ref' => $apiRef
            ]);

            return $this->verifyAndComplete($apiRef);
        }

        Log::info("[Webhook] Non-final state received: {$invoiceState}");
        return response()->json(['status' => 'ok']);
    }


    /**
     * Verify with IntaSend API using SECRET KEY, not session
     */
    private function verifyAndComplete($apiRef)
    {
        Log::info("[Complete] Verifying payment with api_ref: " . $apiRef);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('INTASEND_SECRET_KEY'),
                'Accept' => 'application/json'
            ])->get("https://payment.intasend.com/api/v1/checkout/{$apiRef}/payment_status/");

            $data = $response->json();
            Log::info("[Complete] Verification Response", $data);

        } catch (\Exception $e) {
            Log::error("[Complete] Verification exception: " . $e->getMessage());
            return response()->json(['error' => 'Verification failed'], 500);
        }

        // Handle API errors
        if (!$response->ok() || isset($data['type']) && $data['type'] === 'client_error') {
            Log::error("[Complete] Verification failed: ", $data);
            return response()->json(['error' => 'Failed to verify'], 400);
        }

        // Must be paid to unlock
        if (!isset($data['paid']) || $data['paid'] !== true) {
            Log::warning("[Complete] Transaction NOT paid");
            return response()->json(['error' => 'Not paid'], 400);
        }

        // Look up the matching purchase by api_ref
        $payment = Payment::where('api_ref', $apiRef)->first();

        if (!$payment) {
            Log::error("[Complete] Payment record not found for api_ref: $apiRef");
            return response()->json(['error' => 'Payment record missing'], 404);
        }

        // Prevent duplicates
        if ($payment->status === "paid") {
            Log::info("[Complete] Payment already processed. Skipping.");
            return response()->json(['status' => 'already_processed']);
        }

        // Mark payment completed
        $payment->status = "paid";
        $payment->save();

        // Unlock course for the user
        $this->unlockCourseForUser($payment);

        Log::info("[Complete] Course unlocked successfully for user {$payment->user_id}");

        return response()->json(['success' => true]);
    }


    private function unlockCourseForUser($payment)
    {
        $user = User::find($payment->user_id);

        if (!$user) {
            Log::error("[Complete] User does not exist: {$payment->user_id}");
            return;
        }

        // Example: store purchased course IDs in settings JSON
        $settings = json_decode($user->settings, true) ?? [];
        $purchased = $settings['purchased_courses'] ?? [];

        if (!in_array($payment->course_id, $purchased)) {
            $purchased[] = $payment->course_id;
        }

        $settings['purchased_courses'] = $purchased;
        $user->settings = json_encode($settings);
        $user->save();

        Log::info("[Complete] Updated user settings for course unlock", [
            "user_id" => $user->id,
            "courses" => $purchased
        ]);
    }
}
