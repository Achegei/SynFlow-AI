<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use IntaSend\IntaSendPHP\Checkout;
use IntaSend\IntaSendPHP\Customer;

class PurchaseController extends Controller
{
    /**
     * Start IntaSend checkout session
     */
    public function purchase($courseId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $course = Course::find($courseId);
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        if ($user->courses->contains($course->id)) {
            return redirect()
                ->route('classroom.show', $course->id)
                ->with('info', 'You already own this course.');
        }

        // Customer object for IntaSend
        $customer = new Customer();
        $customer->first_name = $user->name;
        $customer->last_name  = $user->name;
        $customer->email      = $user->email;
        $customer->country    = "KE";

        $amount   = $course->price;
        $currency = "KES";

        // Redirect after payment goes to our complete() route
        $redirectUrl = route('purchase.complete', ['course_id' => $courseId]);

        // Order reference
        $reference = "order-user{$user->id}-course{$courseId}-" . time();

        // Initialize IntaSend
        $checkout = new Checkout();
        $checkout->init([
            'token'           => env('INTASEND_SECRET_KEY'),
            'publishable_key' => env('INTASEND_PUBLISHABLE_KEY'),
            'test'            => false, // live environment
        ]);

        try {
            $response = $checkout->create(
                $amount,
                $currency,
                $customer,
                "https://mooseloonai.ca",
                $redirectUrl,
                $reference
            );

            // Save or update payment record
            Payment::updateOrCreate(
                [
                    'user_id'   => $user->id,
                    'course_id' => $course->id,
                ],
                [
                    'status'     => 'pending',
                    'provider'   => 'intasend',
                    'payment_id' => $response->id ?? null,
                    'amount'     => $amount,
                    'payload'    => json_encode($response),
                ]
            );

        } catch (\Exception $e) {
            \Log::error('IntaSend checkout failed: ' . $e->getMessage());
            return back()->with('error', "Failed to initiate payment: " . $e->getMessage());
        }

        return redirect($response->url);
    }

    /**
     * Complete URL after payment
     */
    public function complete(Request $request)
    {
        $user     = Auth::user();
        $courseId = $request->query('course_id');

        if (!$user || !$courseId) {
            abort(400, 'Invalid request.');
        }

        $course = Course::find($courseId);
        if (!$course) {
            return redirect()->route('classroom.index')->with('error', 'Course not found.');
        }

        // Check if payment was completed via webhook
        $payment = Payment::where([
            'user_id'   => $user->id,
            'course_id' => $courseId,
            'status'    => 'completed',
        ])->first();

        // If payment is not confirmed yet, still redirect to classroom.show
        $user->courses()->syncWithoutDetaching([$courseId]);

        $message = $payment
            ? 'Payment successful — course unlocked!'
            : 'Payment not confirmed yet. You still have access to the course.';

        return redirect()
            ->route('classroom.show', $courseId)
            ->with('success', $message);
    }
}
