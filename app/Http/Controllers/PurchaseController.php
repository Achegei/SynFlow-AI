<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Redirect user to the course's payment page
     */
    public function purchase($courseId)
    {
        $user = Auth::user();
        $course = Course::findOrFail($courseId);

        // If user already owns course, skip purchase
        if ($user->courses->contains($course->id)) {
            return redirect()->route('classroom.show', $course->id)
                ->with('info', 'You already have access to this course.');
        }

        // Universal payment URL (update per course or per provider)
        $paymentUrl = $course->payment_link ?? config('services.payment.link');

        // Build a redirect URL after successful payment
        $redirectUrl = route('purchase.complete', [
            'course_id' => $course->id,
            'user_id' => $user->id,
        ]);

        // Track this payment as pending (optional but good practice)
        $provider = parse_url($paymentUrl, PHP_URL_HOST) ?? 'custom';

            if (empty($provider)) {
                $provider = 'custom';
            }

            Payment::updateOrCreate(
                [
                    'user_id'   => $user->id,
                    'course_id' => $course->id,
                ],
                [
                    'status'   => 'pending',
                    'provider' => $provider,
                ]
            );


        // Add metadata for your payment provider
        $query = http_build_query([
            'user_id'      => $user->id,
            'course_id'    => $course->id,
            'redirect_url' => $redirectUrl,
        ]);

        return redirect("$paymentUrl?$query");
    }

    /**
     * Payment redirect after success
     */
    public function complete(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->query('course_id');

        if (!$user || !$courseId) {
            abort(400, 'Invalid payment confirmation.');
        }

        $course = Course::findOrFail($courseId);

        // Optional: Verify transaction from provider API before granting access
        // e.g. $verified = app(PaymentVerifier::class)->verify($request);
        // if (!$verified) abort(403, 'Payment not verified.');

        // Update payment status
        Payment::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->update(['status' => 'completed']);

        // Grant access if not yet enrolled
        $user->courses()->syncWithoutDetaching([$course->id]);

        return redirect()->route('classroom.show', $course->id)
            ->with('success', 'Payment successful! Course unlocked.');
    }
}
