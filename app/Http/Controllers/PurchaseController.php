<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use IntaSend\IntaSendPHP\Checkout;
use IntaSend\IntaSendPHP\Customer;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    /**
     * Start M-PESA payment
     */
    public function purchase($courseId)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login')->with('error', 'Please log in first.');

        $course = Course::find($courseId);
        if (!$course) return redirect()->back()->with('error', 'Course not found.');

        // Prevent duplicate purchases
        if ($user->courses->contains($courseId)) {
            return redirect()->route('courses.show', $courseId)
                ->with('info', 'You already own this course.');
        }

        // Create IntaSend customer
        $customer = new Customer();
        $customer->first_name = $user->name;
        $customer->last_name  = $user->name;
        $customer->email      = $user->email;
        $customer->country    = "KE";

        $amount    = $course->price;
        $currency  = "KES";
        $reference = "order-user{$user->id}-course{$courseId}-" . time();

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
                null, // no redirect needed for M-PESA
                $reference,
                null,
                "M-PESA" // only M-PESA
            );

            Log::info("M-PESA checkout created", (array) $response);
        } catch (\Exception $e) {
            Log::error("M-PESA checkout failed: " . $e->getMessage());
            return back()->with('error', "Failed to initiate M-PESA payment: " . $e->getMessage());
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

        // Redirect to IntaSend M-PESA page
        return redirect($response->url)
            ->with('info', 'Follow the M-PESA prompts to complete your payment. Your course will unlock automatically.');
    }
}
