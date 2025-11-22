<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Handle incoming webhook requests from payment providers
     */
    public function handle(Request $request, $provider)
    {
        Log::info("Webhook received from {$provider}", $request->all());

        if (strtolower($provider) === 'intasend') {

            // Step 1: Handle challenge verification
            if ($request->has('challenge')) {
                Log::info("[Webhook] Challenge verification received: " . $request->input('challenge'));
                return response()->json(['challenge' => $request->input('challenge')]);
            }

            // Step 2: Map payload
            $state = $request->input('state'); // e.g., PENDING, PROCESSING, COMPLETE, FAILED
            $apiRef = $request->input('api_ref'); // your unique order reference
            $courseId = $request->input('meta.course_id'); // optional if you sent it in meta

            if (!$apiRef) {
                return response()->json(['error' => 'Missing api_ref'], 400);
            }

            $payment = Payment::where('payment_id', $apiRef)->first();

            if (!$payment) {
                return response()->json(['error' => 'Payment not found'], 404);
            }

            // Step 3: Update payment status
            if (strtoupper($state) === 'COMPLETE') {
                $payment->status = 'completed';
                $payment->payload = json_encode($request->all());
                $payment->save();

                // Grant course access
                $user = User::find($payment->user_id);
                if ($user) {
                    $user->courses()->syncWithoutDetaching([$payment->course_id]);
                    Log::info("[Webhook] Course unlocked for user {$user->id}");
                }

            } else {
                $payment->status = strtolower($state); // pending, processing, failed
                $payment->payload = json_encode($request->all());
                $payment->save();
            }

            return response()->json(['message' => 'Payment recorded']);
        }

        return response()->json(['error' => 'Unknown provider'], 400);
    }
}
