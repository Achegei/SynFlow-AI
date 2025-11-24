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
    public function purchase(Request $request, $courseId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $course = Course::find($courseId);
        if (!$course) {
            return back()->with('error', 'Course not found.');
        }

        if ($user->courses->contains($courseId)) {
            return redirect()->route('classroom.show', $courseId)
                ->with('info', 'You already own this course.');
        }

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
            'token'           => config('intasend.secret_key'),
            'publishable_key' => config('intasend.publishable_key'),
            'test'            => false,
        ]);

        try {
            $response = $checkout->create(
                $amount,
                $currency,
                $customer,
                route('purchase.complete', $courseId), // correct redirect
                null,
                $reference,
                null,
                "M-PESA"
            );

            Log::info("M-PESA checkout created", (array)$response);

        } catch (\Exception $e) {
            Log::error("Checkout failed: " . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }

        Payment::updateOrCreate(
            [
                'user_id'   => $user->id,
                'course_id' => $courseId,
            ],
            [
                'status'     => 'pending',
                'provider'   => 'intasend',
                'payment_id' => $response->id,
                'api_ref'    => $response->api_ref,
                'amount'     => $amount,
                'payload'    => json_encode($response),
            ]
        );

        return redirect($response->url);
    }

    public function complete($courseId)
    {
        $user = Auth::user();
        $payment = Payment::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->latest()
            ->first();

        return view('purchase.complete', compact('payment'));
    }
}
