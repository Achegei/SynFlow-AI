<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use IntaSend\IntaSendPHP\Checkout;
use IntaSend\IntaSendPHP\Customer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    /**
     * Start payment
     */
    public function purchase($courseId)
    {
        Log::info("[Purchase] Started for course {$courseId}");

        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $course = Course::findOrFail($courseId);

        // Already purchased
        if ($user->courses->contains($courseId)) {
            return redirect()->route('classroom.show', $courseId)
                ->with('info', 'You already own this course.');
        }

        $currency = "KES";

        // Customer object
        $customer = new Customer();
        $customer->first_name = $user->first_name ?? $user->name;
        $customer->last_name  = $user->last_name ?? $user->name;
        $customer->email      = $user->email;
        $customer->country    = "KE";

        $amount = $course->price;
        $reference = "order-{$user->id}-{$courseId}-" . time();
        $redirectUrl = url("/purchase/complete/{$courseId}");

        Log::info("[Purchase] Redirect URL = {$redirectUrl}");

        // Initialize IntaSend Checkout
        $checkout = new Checkout();
        $checkout->init([
            'token'           => config('intasend.secret_key'),
            'publishable_key' => config('intasend.publishable_key'),
            'test'            => false, // LIVE mode
        ]);

        try {
            $response = $checkout->create(
                $amount,
                $currency,
                $customer,
                config('app.url'),          // Host URL
                $redirectUrl,               // Redirect URL after payment
                $reference,                 // API reference
                "course_id:{$courseId}",    // Comment
                null,                       // Method (optional)
                'BUSINESS-PAYS',            // Card tariff
                'BUSINESS-PAYS'             // Mobile tariff
            );

            Log::info("[Purchase] IntaSend Response:", json_decode(json_encode($response), true));

            // Save or update pending payment
            Payment::updateOrCreate(
                [
                    'user_id'   => $user->id,
                    'course_id' => $courseId,
                    'status'    => 'pending'
                ],
                [
                    'payment_id' => $response->api_ref,
                    'status'     => 'pending',
                    'provider'   => 'intasend',
                    'amount'     => $amount,
                    'payload'    => json_encode($response)
                ]
            );

        } catch (\Exception $e) {
            Log::error("[Purchase] Error: {$e->getMessage()}");
            return back()->with('error', 'Payment failed to start.');
        }

        // Redirect user to IntaSend checkout page
        return redirect($response->url);
    }

    /**
     * Complete / Verify payment
     */
    public function complete(Course $course)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        // Get latest pending payment for this course
        $payment = Payment::where([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'pending'
        ])->latest()->first();

        if (!$payment) {
            return redirect()->route('classroom')->with('error', 'Pending payment not found.');
        }

        $apiRef = $payment->payment_id;
        Log::info("[Complete] Verifying payment with api_ref: {$apiRef}");

        try {
            // Verify payment via IntaSend API
            $response = Http::withToken(config('intasend.secret_key'))
                ->post('https://api.intasend.com/api/v1/checkout/verify', [
                    'api_ref' => $apiRef
                ]);

            if (!$response->ok()) {
                Log::error("[Complete] Verification failed: " . $response->body());
                return redirect()->route('classroom')->with('error', 'Payment verification failed.');
            }

            $data = $response->json();
            Log::info("[Complete] IntaSend Verification:", $data);

            if (!empty($data['paid']) && $data['paid'] === true) {
                $payment->update(['status' => 'completed']);
                $user->courses()->syncWithoutDetaching([$course->id]);

                Log::info("[Complete] COURSE UNLOCKED for user {$user->id}");

                return redirect()->route('classroom.show', $course->id)
                    ->with('success', 'Payment confirmed! Course unlocked.');
            }

            return redirect()->route('classroom')->with('error', 'Payment not completed yet.');

        } catch (\Exception $e) {
            Log::error("[Complete] Exception during verification: " . $e->getMessage());
            return redirect()->route('classroom.show')->with('error', 'Payment verification failed.');
        }
    }
}
