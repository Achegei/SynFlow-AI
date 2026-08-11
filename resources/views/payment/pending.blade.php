@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-12">

    <div class="w-full max-w-lg">

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-8 text-center border-b border-gray-100">

                <div
                    id="status-icon"
                    class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-yellow-100"
                >
                    {{-- Pending Icon --}}
                    <svg
                        id="pending-icon"
                        class="h-10 w-10 text-yellow-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>

                    {{-- Success Icon --}}
                    <svg
                        id="success-icon"
                        class="hidden h-10 w-10 text-green-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    {{-- Failed Icon --}}
                    <svg
                        id="failed-icon"
                        class="hidden h-10 w-10 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </div>


                <h1
                    id="page-title"
                    class="text-2xl font-bold text-gray-900"
                >
                    Payment Pending
                </h1>


                <p
                    id="page-description"
                    class="mt-2 text-gray-600"
                >
                    Your M-Pesa payment is being processed.
                </p>

            </div>


            {{-- Payment Information --}}
            <div class="px-6 py-6">

                <div class="rounded-xl bg-gray-50 p-5 space-y-4">

                    {{-- Payment Status --}}
                    <div class="flex items-center justify-between">

                        <span class="text-sm text-gray-500">
                            Payment Status
                        </span>

                        <span
                            id="payment-status-badge"
                            class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-sm font-semibold text-yellow-700"
                        >
                            Pending
                        </span>

                    </div>


                    {{-- Amount --}}
                    <div class="flex items-center justify-between">

                        <span class="text-sm text-gray-500">
                            Amount
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $payment->currency ?? 'KES' }}
                            {{ number_format((float) $payment->amount, 2) }}
                        </span>

                    </div>


                    {{-- Payment Reference --}}
                    @if($payment->payment_id)

                        <div class="flex items-center justify-between gap-4">

                            <span class="text-sm text-gray-500">
                                Payment Reference
                            </span>

                            <span class="text-sm font-medium text-gray-900 break-all text-right">
                                {{ $payment->payment_id }}
                            </span>

                        </div>

                    @endif


                    {{-- Transaction Reference --}}
                    @if($payment->api_ref)

                        <div class="flex items-center justify-between gap-4">

                            <span class="text-sm text-gray-500">
                                Transaction Reference
                            </span>

                            <span class="text-xs font-medium text-gray-700 break-all text-right">
                                {{ $payment->api_ref }}
                            </span>

                        </div>

                    @endif

                </div>


                {{-- Instructions --}}
                <div
                    id="instructions"
                    class="mt-6 rounded-xl border border-yellow-200 bg-yellow-50 p-5"
                >

                    <div class="flex gap-3">

                        <svg
                            class="h-6 w-6 flex-shrink-0 text-yellow-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"
                            />
                        </svg>


                        <div>

                            <h2 class="font-semibold text-yellow-800">
                                Check your phone
                            </h2>

                            <p class="mt-1 text-sm leading-6 text-yellow-700">
                                An M-Pesa payment request has been sent to your phone.
                                Enter your M-Pesa PIN to complete the payment.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Automatic Status Checking --}}
                <div
                    id="payment-status-container"
                    class="mt-6 text-center"
                >

                    <div class="flex items-center justify-center gap-2 text-sm text-gray-500">

                        <svg
                            class="h-5 w-5 animate-spin"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 2v4m0 12v4m10-10h-4M6 12H2m17.07-7.07l-2.83 2.83M7.76 16.24l-2.83 2.83m14.14 0l-2.83-2.83M7.76 7.76L4.93 4.93"
                            />
                        </svg>

                        <span id="checking-message">
                            Waiting for payment confirmation...
                        </span>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="mt-6 flex flex-col gap-3">

                    <a
                        href="{{ url('/classroom') }}"
                        class="w-full rounded-xl bg-gray-900 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-gray-800"
                    >
                        Return to Classroom
                    </a>


                    <button
                        id="refresh-button"
                        type="button"
                        onclick="checkPaymentStatus()"
                        class="w-full rounded-xl border border-gray-300 bg-white px-5 py-3 text-center text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                    >
                        Check Payment Status
                    </button>

                </div>

            </div>


            {{-- Footer --}}
            <div class="border-t border-gray-100 px-6 py-4 text-center">

                <p
                    id="footer-message"
                    class="text-xs text-gray-500"
                >
                    Please complete the M-Pesa payment on your phone.
                </p>

            </div>

        </div>

    </div>

</div>


<script>

    const paymentStatusUrl = @json(
        route('payment.status', $payment->id)
    );

    let checkingPayment = false;
    let paymentFinished = false;


    /**
     * Check payment status.
     */
    async function checkPaymentStatus() {

        if (checkingPayment || paymentFinished) {
            return;
        }

        checkingPayment = true;

        const button = document.getElementById('refresh-button');

        if (button) {
            button.disabled = true;
            button.innerText = 'Checking...';
        }


        try {

            const response = await fetch(paymentStatusUrl, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });


            const data = await response.json();


            console.log('Payment status:', data);


            /*
            |--------------------------------------------------------------------------
            | Unauthenticated
            |--------------------------------------------------------------------------
            */

            if (data.status === 'unauthenticated') {

                window.location.href = data.redirect || '/login';

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Forbidden
            |--------------------------------------------------------------------------
            */

            if (data.status === 'forbidden') {

                paymentFinished = true;

                updateFailedState(
                    'You are not authorized to view this payment.'
                );

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Payment successful
            |--------------------------------------------------------------------------
            */

            if (data.status === 'paid') {

                paymentFinished = true;

                updateSuccessState();

                /*
                 * Give the user a moment to see the
                 * confirmation before redirecting.
                 */

                setTimeout(function () {

                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }

                }, 1500);

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Payment failed
            |--------------------------------------------------------------------------
            */

            if (data.status === 'failed') {

                paymentFinished = true;

                updateFailedState(
                    'The M-Pesa payment was not completed.'
                );

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Still pending
            |--------------------------------------------------------------------------
            */

            updatePendingState();


        } catch (error) {

            console.error(
                'Payment status check failed:',
                error
            );

            document.getElementById(
                'checking-message'
            ).innerText =
                'Unable to check payment status. Retrying...';

        } finally {

            checkingPayment = false;

            if (button && !paymentFinished) {
                button.disabled = false;
                button.innerText = 'Check Payment Status';
            }

        }

    }


    /**
     * Pending state.
     */
    function updatePendingState() {

        const badge =
            document.getElementById('payment-status-badge');

        if (badge) {

            badge.className =
                'inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-sm font-semibold text-yellow-700';

            badge.innerText = 'Pending';

        }


        document.getElementById(
            'checking-message'
        ).innerText =
            'Waiting for payment confirmation...';

    }


    /**
     * Successful payment state.
     */
    function updateSuccessState() {

        const badge =
            document.getElementById('payment-status-badge');

        badge.className =
            'inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700';

        badge.innerText = 'Paid';


        document.getElementById(
            'page-title'
        ).innerText =
            'Payment Confirmed!';


        document.getElementById(
            'page-description'
        ).innerText =
            'Your payment has been successfully confirmed.';


        document.getElementById(
            'checking-message'
        ).innerText =
            'Payment successful. Redirecting you to your classroom...';


        document.getElementById(
            'footer-message'
        ).innerText =
            'Your course access has been activated.';


        /*
         * Hide pending icon.
         */

        document.getElementById(
            'pending-icon'
        ).classList.add('hidden');


        /*
         * Show success icon.
         */

        document.getElementById(
            'success-icon'
        ).classList.remove('hidden');


        /*
         * Change icon background.
         */

        document.getElementById(
            'status-icon'
        ).className =
            'mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-green-100';


        /*
         * Change instructions.
         */

        const instructions =
            document.getElementById('instructions');

        instructions.className =
            'mt-6 rounded-xl border border-green-200 bg-green-50 p-5';

        instructions.innerHTML = `
            <div class="flex gap-3">

                <svg
                    class="h-6 w-6 flex-shrink-0 text-green-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                <div>

                    <h2 class="font-semibold text-green-800">
                        Payment Successful
                    </h2>

                    <p class="mt-1 text-sm leading-6 text-green-700">
                        Your M-Pesa payment has been confirmed.
                        Your course access is now active.
                    </p>

                </div>

            </div>
        `;

    }


    /**
     * Failed payment state.
     */
    function updateFailedState(message) {

        const badge =
            document.getElementById('payment-status-badge');

        badge.className =
            'inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700';

        badge.innerText = 'Failed';


        document.getElementById(
            'page-title'
        ).innerText =
            'Payment Failed';


        document.getElementById(
            'page-description'
        ).innerText =
            'Your M-Pesa payment could not be completed.';


        document.getElementById(
            'checking-message'
        ).innerText =
            message;


        document.getElementById(
            'footer-message'
        ).innerText =
            'You can return to the payment page and try again.';


        document.getElementById(
            'pending-icon'
        ).classList.add('hidden');


        document.getElementById(
            'failed-icon'
        ).classList.remove('hidden');


        document.getElementById(
            'status-icon'
        ).className =
            'mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-red-100';


        const instructions =
            document.getElementById('instructions');

        instructions.className =
            'mt-6 rounded-xl border border-red-200 bg-red-50 p-5';

        instructions.innerHTML = `
            <div class="flex gap-3">

                <svg
                    class="h-6 w-6 flex-shrink-0 text-red-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

                <div>

                    <h2 class="font-semibold text-red-800">
                        Payment Not Completed
                    </h2>

                    <p class="mt-1 text-sm leading-6 text-red-700">
                        ${message}
                    </p>

                </div>

            </div>
        `;


        const button =
            document.getElementById('refresh-button');

        if (button) {
            button.disabled = false;
            button.innerText = 'Try Again';
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Initial status check
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            /*
             * Check immediately.
             */

            checkPaymentStatus();


            /*
             * Then check every 5 seconds.
             */

            setInterval(function () {

                if (!paymentFinished) {
                    checkPaymentStatus();
                }

            }, 5000);

        }
    );

</script>

@endsection