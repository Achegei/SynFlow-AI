<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use IntaSend\IntaSendPHP\Wallet;
use App\Services\IntaSendPaymentService;

class PurchaseController extends Controller
{
    /**
     * Show institution purchase/payment page.
     */
    public function show(string $courseId): View|RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->with('error', 'Please log in to continue.');
        }

        $course = Course::findOrFail($courseId);

        abort_if(
            (int) $course->id === 2,
            403,
            'This course is available exclusively through corporate training enquiries.'
        );

        if ((int) $course->id === (int) config('enrollment.course_id')) {
            $enrollment = CourseEnrollment::query()
                ->where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->first();

            if (!$enrollment) {
                abort(403, 'A valid course enrollment is required.');
            }

            if ($enrollment->isPaid()) {
                return redirect()->route(
                    'classroom.show',
                    $course->id
                );
            }

            if ($enrollment->status !== 'pending') {
                abort(403, 'This enrollment cannot be purchased.');
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Verify course is active
        |--------------------------------------------------------------------------
        */

        if (isset($course->active) && !$course->active) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Course price
        |--------------------------------------------------------------------------
        */

        $amount = (int) $course->id === (int) config('enrollment.course_id')
            ? (float) config('enrollment.fee')
            : (float) $course->price;

        if ($amount < 0.10) {
            Log::error('[Institution Payment] Invalid course price', [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'course_title' => $course->title ?? null,
                'price' => $course->price,
            ]);

            return redirect()
                ->back()
                ->with('error', 'This course does not have a valid price.');
        }

        return view('purchase', [
            'course' => $course,
            'amount' => $amount,
        ]);
    }


    /**
     * Start Institution M-Pesa STK Push.
     *
     * IMPORTANT:
     *
     * Institution payments are sent directly into the configured
     * IntaSend WORKING wallet.
     *
     * We therefore use:
     *
     *     IntaSend\IntaSendPHP\Wallet
     *
     * and:
     *
     *     fund_mpesa_stk_push()
     *
     * instead of Collection::create().
     */
    public function purchase(
        Request $request,
        string $courseId
    ): RedirectResponse {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        */

        if (!$user) {
            return redirect()
                ->route('login')
                ->with('error', 'Please log in first.');
        }

        /*
        |--------------------------------------------------------------------------
        | Find course
        |--------------------------------------------------------------------------
        */

        $course = Course::findOrFail($courseId);

        abort_if(
            (int) $course->id === 2,
            403,
            'This course is available exclusively through corporate training enquiries.'
        );

        $enrollment = null;

        if ((int) $course->id === (int) config('enrollment.course_id')) {
            $enrollment = CourseEnrollment::query()
                ->where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->first();

            if (!$enrollment) {
                abort(403, 'A valid course enrollment is required.');
            }

            if ($enrollment->isPaid()) {
                return redirect()->route(
                    'classroom.show',
                    $course->id
                );
            }

            if ($enrollment->status !== 'pending') {
                abort(403, 'This enrollment cannot be purchased.');
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Verify course is active
        |--------------------------------------------------------------------------
        */

        if (isset($course->active) && !$course->active) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Course ID
        |--------------------------------------------------------------------------
        */

        $courseId = $course->id;

        /*
        |--------------------------------------------------------------------------
        | Validate course price
        |--------------------------------------------------------------------------
        */

        $amount = (int) $course->id === (int) config('enrollment.course_id')
            ? (float) config('enrollment.fee')
            : (float) $course->price;
        $currency = 'KES';

        if ($amount < 0.10) {
            Log::error('[Institution STK] Invalid course price', [
                'user_id' => $user->id,
                'course_id' => $courseId,
                'course_title' => $course->title ?? null,
                'database_price' => $course->price,
                'amount' => $amount,
            ]);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'This course does not have a valid payment amount.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate M-Pesa phone number
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'phone_number' => [
                'required',
                'string',
                'max:20',
            ],
        ], [
            'phone_number.required' =>
                'Please enter your M-Pesa phone number.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Normalize Kenyan phone number
        |--------------------------------------------------------------------------
        */

        $phone = $this->normalizeKenyanPhone(
            $request->phone_number
        );

        if (!$phone) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Please enter a valid Kenyan M-Pesa number, for example 254768282146.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | IntaSend credentials
        |--------------------------------------------------------------------------
        */

        $secretKey = config('intasend.secret_key');
        $publishableKey = config('intasend.publishable_key');

        /*
        |--------------------------------------------------------------------------
        | Environment
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | The wallet MUST belong to the same IntaSend environment as
        | the API credentials.
        |
        | If test_mode = true:
        |     use SANDBOX keys + SANDBOX wallet
        |
        | If test_mode = false:
        |     use LIVE keys + LIVE wallet
        |
        |--------------------------------------------------------------------------
        */

        $testMode = (bool) config(
            'intasend.test_mode',
            false
        );

        /*
        |--------------------------------------------------------------------------
        | Wallet ID
        |--------------------------------------------------------------------------
        */

        $walletId = trim(
            (string) config('intasend.wallet_id')
        );

        /*
        |--------------------------------------------------------------------------
        | Verify configuration
        |--------------------------------------------------------------------------
        */

        if (
            empty($secretKey) ||
            empty($publishableKey)
        ) {
            Log::error(
                '[Institution STK] IntaSend credentials missing',
                [
                    'user_id' => $user->id,
                    'course_id' => $courseId,
                    'test_mode' => $testMode,
                    'wallet_id_configured' => !empty($walletId),
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payment service is temporarily unavailable. Please try again later.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Wallet is mandatory for Institution payments
        |--------------------------------------------------------------------------
        */

        if (empty($walletId)) {
            Log::error(
                '[Institution STK] Wallet ID missing',
                [
                    'user_id' => $user->id,
                    'course_id' => $courseId,
                    'test_mode' => $testMode,
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payment wallet is not configured. Please contact support.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Unique API reference
        |--------------------------------------------------------------------------
        */

        $apiRef =
            'order-user' .
            $user->id .
            '-course' .
            $courseId .
            '-' .
            now()->format('YmdHis') .
            '-' .
            uniqid();

        /*
        |--------------------------------------------------------------------------
        | Log payment preparation
        |--------------------------------------------------------------------------
        */

        Log::info(
            '[Institution STK] Preparing M-Pesa STK Push',
            [
                'user_id' => $user->id,
                'course_id' => $courseId,
                'course_title' => $course->title ?? null,
                'database_price' => $course->price,
                'amount' => number_format($amount, 2, '.', ''),
                'currency' => $currency,
                'phone' => $phone,
                'api_ref' => $apiRef,
                'wallet_id_configured' => true,

                /*
                 * Do not log the complete wallet ID unnecessarily
                 * in production.
                 */
                'wallet_id' => $walletId,

                'test_mode' => $testMode,

                /*
                 * Helpful when diagnosing sandbox/live mismatch.
                 */
                'intasend_environment' => $testMode
                    ? 'SANDBOX'
                    : 'LIVE',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Initialize IntaSend Wallet
        |--------------------------------------------------------------------------
        */

        if ($enrollment) {
            // Reconcile the latest pending attempt before deciding whether
            // another STK push is safe. Never infer failure from elapsed time.
            $previousPayment = Payment::query()
                ->where('course_enrollment_id', $enrollment->id)
                ->where('provider', 'intasend')
                ->where('status', 'pending')
                ->latest('id')
                ->first();

            if ($previousPayment) {
                try {
                    app(IntaSendPaymentService::class)
                        ->synchronize($previousPayment);
                } catch (\Throwable $e) {
                    Log::warning(
                        '[Institution STK] Existing payment reconciliation unavailable',
                        [
                            'payment_id' => $previousPayment->id,
                            'error' => $e->getMessage(),
                        ]
                    );
                }

                // Synchronization may have completed the enrollment.
                $enrollment->refresh();

                if ($enrollment->isPaid()) {
                    return redirect()->route(
                        'classroom.show',
                        $courseId
                    );
                }

                if ($enrollment->status !== 'pending') {
                    abort(403, 'This enrollment cannot be purchased.');
                }
            }

            $result = DB::transaction(function () use (
                $enrollment,
                $user,
                $courseId,
                $apiRef,
                $amount,
                $currency
            ) {
                $lockedEnrollment = CourseEnrollment::query()
                    ->whereKey($enrollment->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($lockedEnrollment->status !== 'pending') {
                    abort(403, 'This enrollment cannot be purchased.');
                }

                $existing = Payment::query()
                    ->where('course_enrollment_id', $lockedEnrollment->id)
                    ->where('provider', 'intasend')
                    ->where('status', 'pending')
                    ->latest('id')
                    ->first();

                if ($existing) {
                    return [
                        'existing' => true,
                        'payment' => $existing,
                    ];
                }

                return [
                    'existing' => false,
                    'payment' => Payment::create([
                        'user_id' => $user->id,
                        'course_id' => $courseId,
                        'course_enrollment_id' => $lockedEnrollment->id,
                        'package_id' => null,
                        'provider' => 'intasend',
                        'payment_type' => 'course',
                        'status' => 'pending',
                        'payment_id' => null,
                        'api_ref' => $apiRef,
                        'amount' => $amount,
                        'currency' => $currency,
                        'payload' => null,
                    ]),
                ];
            });

            if ($result['existing']) {
                return redirect()
                    ->route('payment.pending', $result['payment']->id)
                    ->with(
                        'info',
                        'An earlier M-Pesa payment is still pending. Please check its status before trying again.'
                    );
            }

            $payment = $result['payment'];
        } else {
            // Ordinary courses retain the historical invoice-first flow.
            $payment = null;
        }

        $wallet = app(Wallet::class);

        $credentials = [
            'token' => $secretKey,
            'publishable_key' => $publishableKey,
            'test' => $testMode,
        ];

        $wallet->init($credentials);

        /*
        |--------------------------------------------------------------------------
        | Send M-Pesa STK Push directly to the working wallet
        |--------------------------------------------------------------------------
        |
        | This is the critical change.
        |
        | DO NOT use:
        |
        |     $collection->create(..., $walletId)
        |
        | for this institution-wallet flow.
        |
        | Instead use IntaSend's documented:
        |
        |     $wallet->fund_mpesa_stk_push()
        |
        |--------------------------------------------------------------------------
        */

        try {
            $response = $wallet->fund_mpesa_stk_push(
                $walletId,
                $phone,
                $user->email,
                $amount,
                $apiRef
            );
        } catch (\Throwable $e) {
            Log::error(
                '[Institution STK] IntaSend STK Push failed',
                [
                    'user_id' => $user->id,
                    'course_id' => $courseId,
                    'phone' => $phone,
                    'amount' => $amount,
                    'currency' => $currency,
                    'api_ref' => $apiRef,
                    'wallet_id' => $walletId,
                    'test_mode' => $testMode,
                    'intasend_environment' => $testMode
                        ? 'SANDBOX'
                        : 'LIVE',
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Detect wallet/environment mismatch
            |--------------------------------------------------------------------------
            */

            $errorMessage = $e->getMessage();

            if (
                str_contains(
                    strtolower($errorMessage),
                    'invalid wallet id'
                )
            ) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        $testMode
                            ? 'The configured wallet does not belong to the IntaSend sandbox account being used. Please use the sandbox wallet ID.'
                            : 'The configured wallet does not belong to the IntaSend live account being used. Please verify the live wallet ID.'
                    );
            }

            return back()
                ->withInput()
                ->with(
                    'error',
                    'We could not start the M-Pesa payment. Please check the number and try again.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Convert response to array for logging/storage
        |--------------------------------------------------------------------------
        */

        $responseArray = [];

        try {
            $responseArray = json_decode(
                json_encode($response),
                true
            ) ?? [];
        } catch (\Throwable $e) {
            $responseArray = [];
        }

        /*
        |--------------------------------------------------------------------------
        | Extract invoice ID
        |--------------------------------------------------------------------------
        */

        $invoiceId =
            $response->invoice->invoice_id
            ?? $response->invoice->id
            ?? $response->invoice_id
            ?? $response->id
            ?? ($responseArray['invoice']['invoice_id'] ?? null)
            ?? ($responseArray['invoice']['id'] ?? null)
            ?? ($responseArray['invoice_id'] ?? null)
            ?? ($responseArray['id'] ?? null);

        /*
        |--------------------------------------------------------------------------
        | Log IntaSend response
        |--------------------------------------------------------------------------
        */

        Log::info(
            '[Institution STK] IntaSend response received',
            [
                'user_id' => $user->id,
                'course_id' => $courseId,
                'api_ref' => $apiRef,
                'invoice_id' => $invoiceId,
                'wallet_id' => $walletId,
                'test_mode' => $testMode,
                'response' => $responseArray,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Make sure IntaSend returned an invoice/payment reference
        |--------------------------------------------------------------------------
        */

        if (!$invoiceId) {
            Log::error(
                '[Institution STK] IntaSend response missing invoice ID',
                [
                    'user_id' => $user->id,
                    'course_id' => $courseId,
                    'api_ref' => $apiRef,
                    'wallet_id' => $walletId,
                    'response' => $responseArray,
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payment could not be started. Please try again.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create local payment record
        |--------------------------------------------------------------------------
        */

        /*
         * An independently verified webhook may have associated the
         * invoice before the original STK request returned.
         *
         * Lock and reload the payment to avoid overwriting provider-
         * verified information with a stale initiation response.
         */
        if ($payment === null) {
            // Ordinary course: create a record only after IntaSend
            // returns a valid invoice.
            $payment = Payment::create([
                'user_id' => $user->id,
                'course_id' => $courseId,
                'course_enrollment_id' => null,
                'package_id' => null,
                'provider' => 'intasend',
                'payment_type' => 'course',
                'status' => 'pending',
                'payment_id' => $invoiceId,
                'api_ref' => $apiRef,
                'amount' => $amount,
                'currency' => $currency,
                'payload' => $responseArray,
            ]);
        }

        $invoiceAccepted = DB::transaction(
            function () use ($payment, $invoiceId, $responseArray) {
                $locked = Payment::query()
                    ->whereKey($payment->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if (
                    $locked->payment_id !== null &&
                    $locked->payment_id !== $invoiceId
                ) {
                    return false;
                }

                if ($locked->payment_id === null) {
                    if ($locked->status !== 'pending') {
                        return false;
                    }

                    $claimed = Payment::query()
                        ->where('payment_id', $invoiceId)
                        ->whereKeyNot($locked->id)
                        ->exists();

                    if ($claimed) {
                        return false;
                    }

                    $locked->payment_id = $invoiceId;
                    $locked->payload = $responseArray;
                    $locked->save();
                }

                return true;
            }
        );

        if (!$invoiceAccepted) {
            Log::warning(
                '[Institution STK] Conflicting late invoice response rejected',
                ['payment_id' => $payment->id]
            );
        }

        $payment->refresh();

        /*
        |--------------------------------------------------------------------------
        | Log local payment
        |--------------------------------------------------------------------------
        */

        Log::info(
            '[Institution STK] Payment attempt created',
            [
                'payment_id' => $payment->id,
                'user_id' => $user->id,
                'course_id' => $courseId,
                'invoice_id' => $invoiceId,
                'amount' => $amount,
                'phone' => $phone,
                'api_ref' => $apiRef,
                'wallet_id' => $walletId,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Save pending payment in session
        |--------------------------------------------------------------------------
        */

        session([
            'institution_pending_payment_id' => $payment->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Redirect to pending page
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'payment.pending',
                $payment->id
            )
            ->with(
                'success',
                'M-Pesa payment request sent. Please check your phone and enter your M-Pesa PIN.'
            );
    }


    /**
 * Show payment pending page.
 */
public function pending(Payment $payment): View|RedirectResponse
{
    $user = Auth::user();

    if (!$user) {
        return redirect()
            ->route('login')
            ->with('error', 'Please log in to continue.');
    }

    // Make sure the payment belongs to the logged-in user
    if ((int) $payment->user_id !== (int) $user->id) {
        abort(403);
    }

    // Payment already completed
    if ($payment->status === 'paid') {
        return redirect()
            ->route('purchase.complete', $payment->course_id)
            ->with(
                'success',
                '🎉 Payment confirmed! Your course access has been activated.'
            );
    }

    return view('payment.pending', [
        'payment' => $payment,
    ]);
}

    /**
     * Check payment status.
     *
     * The IntaSendPaymentService should query IntaSend and synchronize
     * the local Payment record.
     */
    public function status(
        Payment $payment,
        IntaSendPaymentService $paymentService
    ) {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'unauthenticated',
                'redirect' => route('login'),
            ], 401);
        }

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        if ($payment->user_id !== $user->id) {
            return response()->json([
                'status' => 'forbidden',
                'redirect' => null,
            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Synchronize with IntaSend
        |--------------------------------------------------------------------------
        */

        try {
            $payment = $paymentService->synchronize(
                $payment
            );
        } catch (\Throwable $e) {
            Log::error(
                '[Institution PAYMENT STATUS] Synchronization failed',
                [
                    'payment_id' => $payment->id,
                    'user_id' => $user->id,
                    'error' => $e->getMessage(),
                ]
            );

            return response()->json([
                'status' => 'pending',
                'redirect' => null,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Payment successful
        |--------------------------------------------------------------------------
        */

        if ($payment->status === 'paid') {
            return response()->json([
                'status' => 'paid',
                'redirect' => route(
                    'classroom.show',
                    $payment->course_id
                ),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Payment failed
        |--------------------------------------------------------------------------
        */

        if (in_array($payment->status, ['failed', 'cancelled'], true)) {
            return response()->json([
                'status' => $payment->status,
                'redirect' => null,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Still pending
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'status' => 'pending',
            'redirect' => null,
            'has_provider_invoice' => !empty($payment->payment_id),
        ]);
    }


    /**
     * Complete payment / fallback return route.
     */
    public function complete(
        string $courseId
    ): RedirectResponse|View {
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login');
        }

        $course = Course::findOrFail($courseId);

        abort_if(
            (int) $course->id === 2,
            403,
            'This course is available exclusively through corporate training enquiries.'
        );

        /*
        |--------------------------------------------------------------------------
        | Find latest payment
        |--------------------------------------------------------------------------
        */

        $payment = Payment::query()
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('provider', 'intasend')
            ->where('payment_type', 'course')
            ->latest('id')
            ->first();

        if (!$payment) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'No payment attempt was found.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Payment not complete
        |--------------------------------------------------------------------------
        */

        if ($payment->status !== 'paid') {
            return redirect()
                ->route(
                    'payment.pending',
                    $payment->id
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Clear payment session
        |--------------------------------------------------------------------------
        */

        session()->forget([
            'institution_pending_payment_id',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Give access
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'classroom.show',
                $course->id
            )
            ->with(
                'success',
                '🎉 Payment confirmed! Your course access has been activated.'
            );
    }


    /**
     * Normalize Kenyan phone number.
     */
    private function normalizeKenyanPhone(
        string $phone
    ): ?string {
        /*
        |--------------------------------------------------------------------------
        | Remove spaces, hyphens and brackets
        |--------------------------------------------------------------------------
        */

        $phone = preg_replace(
            '/[\s\-\(\)]/',
            '',
            trim($phone)
        );

        /*
        |--------------------------------------------------------------------------
        | +254...
        |--------------------------------------------------------------------------
        */

        if (str_starts_with($phone, '+254')) {
            $phone = substr($phone, 1);
        }

        /*
        |--------------------------------------------------------------------------
        | 07XXXXXXXX / 01XXXXXXXX
        |--------------------------------------------------------------------------
        */

        if (
            str_starts_with($phone, '07') ||
            str_starts_with($phone, '01')
        ) {
            $phone = '254' . substr($phone, 1);
        }

        /*
        |--------------------------------------------------------------------------
        | 7XXXXXXXX / 1XXXXXXXX
        |--------------------------------------------------------------------------
        */

        if (
            preg_match('/^[17]\d{8}$/', $phone)
        ) {
            $phone = '254' . $phone;
        }

        /*
        |--------------------------------------------------------------------------
        | Final validation
        |--------------------------------------------------------------------------
        */

        if (
            !preg_match(
                '/^254[17]\d{8}$/',
                $phone
            )
        ) {
            return null;
        }

        return $phone;
    }
}
