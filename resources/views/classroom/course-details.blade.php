<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use IntaSend\IntaSendPHP\Checkout;
use IntaSend\IntaSendPHP\Customer;
use Illuminate\Support\Facades\Http;

class PurchaseController extends Controller
{
    /**
     * Start IntaSend checkout session
     */
    public function purchase($courseId)
    {
        \Log::info("Purchase triggered for course: {$courseId}");

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $course = Course::find($courseId);
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        // Prevent duplicate purchases
        if ($user->courses->contains($courseId)) {
            return redirect()
                ->route('courses.show', $courseId)
                ->with('info', 'You already own this course.');
        }

        // Create IntaSend Customer Object
        $customer = new Customer();
        $customer->first_name = $user->name;
        $customer->last_name  = $user->name;
        $customer->email      = $user->email;
        $customer->country    = "KE";

        $amount    = $course->price;
        $currency  = "KES";
        $reference = "order-user{$user->id}-course{$courseId}-" . time();

        // Dynamically detect host (ngrok in dev, otherwise production)
        $host = request()->getSchemeAndHttpHost();
        $redirectUrl = $host . route('purchase.complete', ['course' => $courseId], false);

        // Initialize Checkout
        $checkout = new Checkout();
        $checkout->init([
            'token' => config('intasend.secret_key'),
            'publishable_key' => config('intasend.publishable_key'),
            'test' => filter_var(config('intasend.test'), FILTER_VALIDATE_BOOLEAN),
        ]);

        try {
            $response = $checkout->create(
                $amount,
                $currency,
                $customer,
                config('app.url'),
                $redirectUrl,
                $reference,
                null,
                "M-PESA"
            );

            \Log::info("IntaSend checkout created", (array) $response);
        } catch (\Exception $e) {
            \Log::error("IntaSend checkout failed: " . $e->getMessage());
            return back()->with('error', "Failed to initiate payment: " . $e->getMessage());
        }

        // Save pending payment
        Payment::updateOrCreate(
            [
                'user_id' => $user->id,
                'course_id' => $courseId,
            ],
            [
                'status' => 'pending',
                'provider' => 'intasend',
                'payment_id' => $response->id,
                'amount' => $amount,
                'payload' => json_encode($response),
            ]
        );

        // Redirect user to IntaSend hosted checkout page
        return redirect($response->url);
    }

    /**
     * Complete the payment and unlock the course
     */
    public function complete(Course $course)
    {
        $user = auth()->user();
        if (!$user) return redirect()->route('login');

        $payment = Payment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', 'pending')
            ->first();

        if (!$payment) {
            return redirect()->route('courses.index')
                ->with('error', 'No pending payment found.');
        }

        // Retry payment verification for up to 5 seconds
        $attempts = 5;
        $data = null;

        while ($attempts > 0) {
            $response = Http::withToken(config('intasend.secret_key'))
                ->get("https://payment.intasend.com/api/v1/payment/transactions/{$payment->payment_id}/");

            if ($response->ok()) {
                $data = $response->json();
                \Log::info("IntaSend Verify Response", $data);

                if (isset($data['state']) && $data['state'] === 'SUCCESS') {
                    break;
                }
            }

            sleep(1); // wait 1 second before retry
            $attempts--;
        }

        if (!$data || !isset($data['state']) || $data['state'] !== 'SUCCESS') {
            return redirect()->route('courses.index')
                ->with('error', 'Payment is still processing. Please wait a few seconds and refresh.');
        }

        // Mark payment as complete
        $payment->update(['status' => 'completed']);

        // Unlock course for user
        $user->courses()->syncWithoutDetaching([$course->id]);

        // Reload user's courses to reflect change immediately
        $user->load('courses');

        return redirect()->route('courses.index')
            ->with('success', "Payment confirmed! '{$course->title}' unlocked.");
    }
}
