@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F5F7FC] px-4 py-8 sm:py-12">
    <div class="mx-auto max-w-[600px]">

        <div class="mb-7 text-center">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-[#EAF0FF] text-[#2459C5]">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 2.5 8 12 13l9.5-5L12 3ZM5 10v6c3.8 3.3 10.2 3.3 14 0v-6M21.5 9v7"/>
                </svg>
            </div>

            <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#315FC5]">
                Moose Loon AI Academy
            </p>

            <h1 class="mt-3 text-3xl font-bold tracking-tight text-[#101D35] sm:text-[34px]">
                Complete Your Enrollment
            </h1>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                One secure payment away from your AI learning journey.
            </p>
        </div>

        <div class="overflow-hidden rounded-[24px] border border-[#E4EAF4] bg-white shadow-[0_16px_48px_rgba(15,35,75,0.06)]">

            <div class="border-b border-[#EAF0F6] px-6 py-6 sm:px-8">
                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                    <span class="h-2 w-2 rounded-full bg-[#3676E8]"></span>
                    Your selected course
                </div>

                <h2 class="mt-3 text-lg font-bold leading-7 text-[#17243B]">
                    {{ $course->title }}
                </h2>

                <div class="mt-5 flex flex-wrap items-center justify-between gap-3 rounded-2xl bg-[#F3F6FC] px-4 py-4">
                    <div>
                        <p class="text-xs font-medium text-slate-500">One-time enrollment fee</p>
                        <p class="mt-1 text-xs text-slate-400">Pay once to activate access</p>
                    </div>

                    <p class="text-2xl font-extrabold tracking-tight text-[#102A5B]">
                        KES {{ number_format($amount, 2) }}
                    </p>
                </div>
            </div>

            <div class="px-6 py-6 sm:px-8">
                @if (session('error'))
                    <div role="alert" class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div role="alert" class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('purchase.course', $course->id) }}"
                    id="course-payment-form"
                >
                    @csrf

                    <label for="phone_number" class="block text-sm font-bold text-[#17243B]">
                        M-Pesa Phone Number
                    </label>

                    <p id="phone-help" class="mt-1 text-sm leading-6 text-slate-500">
                        Enter the Safaricom number that should receive the payment prompt.
                    </p>

                    <input
                        type="tel"
                        id="phone_number"
                        name="phone_number"
                        value="{{ old('phone_number') }}"
                        placeholder="0768282146"
                        inputmode="tel"
                        autocomplete="tel"
                        maxlength="20"
                        required
                        aria-describedby="phone-help"
                        aria-invalid="{{ $errors->has('phone_number') ? 'true' : 'false' }}"
                        class="mt-3 block w-full rounded-xl border border-[#D5DEEC] bg-white px-4 py-3.5 text-base text-[#17243B] placeholder:text-slate-400 shadow-sm transition focus:border-[#316BE2] focus:outline-none focus:ring-4 focus:ring-blue-100"
                    >

                    <button
                        type="submit"
                        id="course-pay-button"
                        class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-[#164BB6] px-5 py-4 text-base font-bold text-white shadow-[0_8px_20px_rgba(22,75,182,0.18)] transition hover:bg-[#103C96] focus:outline-none focus:ring-4 focus:ring-blue-200 disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="6" y="2.5" width="12" height="19" rx="2"/>
                            <path stroke-linecap="round" d="M10 18h4"/>
                        </svg>
                        <span id="course-pay-label">Pay KES {{ number_format($amount, 2) }} via M-Pesa</span>
                    </button>

                    <p class="mt-3 text-center text-xs leading-5 text-slate-500">
                        Your M-Pesa request will only be sent when you select Pay.
                    </p>
                </form>

                <div class="mt-6 flex gap-3 rounded-xl border border-[#DCE8FA] bg-[#F0F6FF] p-4">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#316BE2]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round" d="M12 11v5M12 8h.01"/>
                    </svg>

                    <div>
                        <p class="text-sm font-semibold text-[#173F85]">
                            What happens next?
                        </p>
                        <p class="mt-1 text-sm leading-6 text-[#365B94]">
                            After clicking Pay, check your phone for the M-Pesa prompt.
                            Enter your PIN on your phone. Your classroom will unlock
                            once IntaSend confirms the payment.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-center gap-2 text-xs text-slate-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="5" y="10" width="14" height="11" rx="2"/>
                        <path stroke-linecap="round" d="M8 10V7a4 4 0 0 1 8 0v3"/>
                    </svg>
                    Secure payments powered by IntaSend
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    const form = document.getElementById('course-payment-form');
    const button = document.getElementById('course-pay-button');
    const label = document.getElementById('course-pay-label');

    if (!form || !button) return;

    let submitting = false;

    form.addEventListener('submit', function (event) {
        if (submitting) {
            event.preventDefault();
            return;
        }

        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }

        submitting = true;
        button.disabled = true;

        if (label) {
            label.textContent = 'Sending M-Pesa Request...';
        }
    });
})();
</script>
@endsection
