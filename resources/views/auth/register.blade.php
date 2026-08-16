<x-guest-layout>

    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">

        <div class="mx-auto w-full max-w-5xl">

            {{-- =========================================================
                 BRAND HEADER
            ========================================================== --}}

            <div class="mb-8 text-center">

                <a href="{{ url('/') }}"
                   class="inline-flex items-center justify-center">

                    <div class="flex items-center gap-3">

                        {{-- Logo --}}
                        <div class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                            <img
                                src="{{ asset('images/synflowlogo.jpeg') }}"
                                alt="Moose Loon AI Academy"
                                class="h-10 w-10 object-contain"
                            >
                        </div>

                        <div class="text-left">
                            <div class="text-lg font-bold tracking-tight text-slate-950">
                                Moose Loon AI
                            </div>

                            <div class="text-xs font-medium tracking-wide text-blue-600">
                                AI ACADEMY
                            </div>
                        </div>

                    </div>

                </a>

            </div>


            {{-- =========================================================
                 REGISTRATION CARD
            ========================================================== --}}

            <div class="overflow-hidden rounded-3xl bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-200">

                <div class="grid grid-cols-1 lg:grid-cols-5">


                    {{-- =================================================
                         LEFT BRAND / VALUE PANEL
                    ================================================== --}}

                    <div class="relative hidden overflow-hidden bg-slate-950 p-8 lg:col-span-2 lg:flex lg:flex-col lg:justify-between xl:p-10">

                        {{-- Decorative elements --}}
                        <div class="absolute -right-20 -top-20 h-56 w-56 rounded-full bg-blue-600/20 blur-3xl"></div>

                        <div class="absolute -bottom-24 -left-20 h-64 w-64 rounded-full bg-cyan-400/10 blur-3xl"></div>


                        <div class="relative">

                            <div class="mb-8 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5">

                                <span class="h-2 w-2 rounded-full bg-blue-500"></span>

                                <span class="text-xs font-semibold tracking-wide text-slate-300">
                                    AI-POWERED LEARNING
                                </span>

                            </div>


                            <h1 class="max-w-sm text-3xl font-bold leading-tight tracking-tight text-white xl:text-4xl">
                                Build practical AI skills for the real world.
                            </h1>


                            <p class="mt-5 max-w-sm text-sm leading-7 text-slate-400">
                                Create your account and begin your personalized
                                AI learning journey with Moose Loon AI Academy.
                            </p>

                        </div>


                        {{-- Benefits --}}
                        <div class="relative mt-10 space-y-4">

                            <div class="flex items-start gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 ring-1 ring-blue-500/20">
                                    <svg
                                        class="h-4 w-4 text-blue-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-white">
                                        Personalized learning
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-slate-400">
                                        Your learning experience is tailored to your goals.
                                    </p>
                                </div>

                            </div>


                            <div class="flex items-start gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 ring-1 ring-blue-500/20">
                                    <svg
                                        class="h-4 w-4 text-blue-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6v6l4 2"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-white">
                                        Learn at your pace
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-slate-400">
                                        Choose a learning plan that fits your schedule.
                                    </p>
                                </div>

                            </div>


                            <div class="flex items-start gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 ring-1 ring-blue-500/20">
                                    <svg
                                        class="h-4 w-4 text-blue-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-white">
                                        Practical AI skills
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-slate-400">
                                        Learn skills designed for real-world application.
                                    </p>
                                </div>

                            </div>

                        </div>


                        <div class="relative mt-10 border-t border-white/10 pt-5">

                            <p class="text-xs leading-5 text-slate-500">
                                Moose Loon AI Academy
                            </p>

                            <p class="mt-1 text-xs text-slate-600">
                                Learn AI. Build with AI. Grow with AI.
                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                         RIGHT REGISTRATION FORM
                    ================================================== --}}

                    <div class="lg:col-span-3">

                        <div class="px-5 py-7 sm:px-8 sm:py-9 lg:px-10 xl:px-12">


                            {{-- Mobile brand message --}}
                            <div class="mb-7 lg:hidden">

                                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1.5">

                                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>

                                    <span class="text-xs font-bold uppercase tracking-wide text-blue-700">
                                        AI Academy
                                    </span>

                                </div>

                                <h1 class="text-2xl font-bold tracking-tight text-slate-950">
                                    Create your account
                                </h1>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Start your personalized AI learning journey.
                                </p>

                            </div>


                            {{-- Desktop heading --}}
                            <div class="mb-8 hidden lg:block">

                                <p class="text-xs font-bold uppercase tracking-widest text-blue-600">
                                    Welcome to Moose Loon AI Academy
                                </p>

                                <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                                    Create your account
                                </h2>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Enter your details below to get started.
                                </p>

                            </div>


                            {{-- =================================================
                                 REGISTRATION FORM
                            ================================================== --}}

                            <form
                                method="POST"
                                action="{{ route('register') }}"
                                enctype="multipart/form-data"
                                class="space-y-5"
                            >

                                @csrf


                                {{-- =============================================
                                     NAME
                                ============================================== --}}

                                <div>

                                    <x-input-label
                                        for="name"
                                        :value="__('Full Name')"
                                        class="!font-semibold !text-slate-700"
                                    />

                                    <x-text-input
                                        id="name"
                                        class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                                        type="text"
                                        name="name"
                                        :value="old('name')"
                                        required
                                        autofocus
                                        autocomplete="name"
                                        placeholder="Enter your full name"
                                    />

                                    <x-input-error
                                        :messages="$errors->get('name')"
                                        class="mt-2"
                                    />

                                </div>


                                {{-- =============================================
                                     EMAIL
                                ============================================== --}}

                                <div>

                                    <x-input-label
                                        for="email"
                                        :value="__('Email Address')"
                                        class="!font-semibold !text-slate-700"
                                    />

                                    <x-text-input
                                        id="email"
                                        class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                                        type="email"
                                        name="email"
                                        :value="old('email')"
                                        required
                                        autocomplete="username"
                                        placeholder="you@example.com"
                                    />

                                    <x-input-error
                                        :messages="$errors->get('email')"
                                        class="mt-2"
                                    />

                                </div>


                                {{-- =============================================
                                     REFERRAL CODE
                                ============================================== --}}

                                <div>

                                    <div class="flex items-center justify-between gap-3">

                                        <x-input-label
                                            for="referral_code"
                                            value="Referral Code"
                                            class="!font-semibold !text-slate-700"
                                        />

                                        <span class="text-[11px] font-medium text-slate-400">
                                            Optional
                                        </span>

                                    </div>

                                    <x-text-input
                                        id="referral_code"
                                        class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm uppercase shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                                        type="text"
                                        name="referral_code"
                                        value="{{ old('referral_code', $referralCode ?? session('referral_code')) }}"
                                        placeholder="e.g. ML-X7P9QK"
                                        autocomplete="off"
                                    />

                                    <p class="mt-2 text-xs leading-5 text-slate-400">
                                        If someone referred you, enter their referral code here.
                                    </p>

                                    <x-input-error
                                        :messages="$errors->get('referral_code')"
                                        class="mt-2"
                                    />

                                </div>


                                {{-- =============================================
                                     PROFILE PHOTO
                                ============================================== --}}

                                <div>

                                    <x-input-label
                                        for="profile_photo"
                                        :value="__('Profile Photo')"
                                        class="!font-semibold !text-slate-700"
                                    />

                                    <div class="mt-2">

                                        <label
                                            for="profile_photo"
                                            class="flex cursor-pointer items-center gap-4 rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-4 transition hover:border-blue-400 hover:bg-blue-50/40"
                                        >

                                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-white shadow-sm ring-1 ring-slate-200">

                                                <svg
                                                    class="h-5 w-5 text-slate-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M15 7h.01M12 12a3 3 0 100-6 3 3 0 000 6zm6.5 8a6.5 6.5 0 00-13 0"
                                                    />
                                                </svg>

                                            </div>

                                            <div class="min-w-0">

                                                <p class="text-sm font-semibold text-slate-700">
                                                    Upload a profile photo
                                                </p>

                                                <p class="mt-0.5 text-xs text-slate-400">
                                                    JPG, PNG or WebP
                                                </p>

                                            </div>

                                            <input
                                                id="profile_photo"
                                                class="sr-only"
                                                type="file"
                                                name="profile_photo"
                                                accept="image/jpeg,image/png,image/webp"
                                            >

                                        </label>

                                    </div>

                                    <x-input-error
                                        :messages="$errors->get('profile_photo')"
                                        class="mt-2"
                                    />

                                </div>


                                {{-- =============================================
                                     PASSWORD
                                ============================================== --}}

                                <div>

                                    <x-input-label
                                        for="password"
                                        :value="__('Password')"
                                        class="!font-semibold !text-slate-700"
                                    />

                                    <x-text-input
                                        id="password"
                                        class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="new-password"
                                        placeholder="Create a strong password"
                                    />

                                    <x-input-error
                                        :messages="$errors->get('password')"
                                        class="mt-2"
                                    />

                                </div>


                                {{-- =============================================
                                     CONFIRM PASSWORD
                                ============================================== --}}

                                <div>

                                    <x-input-label
                                        for="password_confirmation"
                                        :value="__('Confirm Password')"
                                        class="!font-semibold !text-slate-700"
                                    />

                                    <x-text-input
                                        id="password_confirmation"
                                        class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                                        type="password"
                                        name="password_confirmation"
                                        required
                                        autocomplete="new-password"
                                        placeholder="Enter your password again"
                                    />

                                    <x-input-error
                                        :messages="$errors->get('password_confirmation')"
                                        class="mt-2"
                                    />

                                </div>


                                {{-- =============================================
                                     TERMS / TRUST
                                ============================================== --}}

                                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">

                                    <div class="flex items-start gap-3">

                                        <div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-blue-600">

                                            <svg
                                                class="h-3 w-3 text-white"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="3"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>

                                        </div>

                                        <p class="text-xs leading-5 text-slate-500">
                                            Your information is used to create and personalize
                                            your Moose Loon AI Academy learning experience.
                                        </p>

                                    </div>

                                </div>


                                {{-- =============================================
                                     ACTIONS
                                ============================================== --}}

                                <div class="pt-2">

                                    <button
                                        type="submit"
                                        class="flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 hover:shadow-blue-600/30 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 active:scale-[0.99]"
                                    >
                                        Create My Account
                                    </button>

                                </div>


                                {{-- Login --}}
                                <div class="pt-1 text-center">

                                    <p class="text-sm text-slate-500">

                                        Already have an account?

                                        <a
                                            href="{{ route('login') }}"
                                            class="font-bold text-blue-600 transition hover:text-blue-700 hover:underline"
                                        >
                                            Sign in
                                        </a>

                                    </p>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 FOOTER
            ========================================================== --}}

            <div class="mt-6 text-center">

                <p class="text-[11px] leading-5 text-slate-400">
                    © {{ date('Y') }} Moose Loon AI Academy.
                    All rights reserved.
                </p>

            </div>

        </div>

    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Lead Tracking Helper
    |--------------------------------------------------------------------------
    */

    function trackLeadEvent(event, metadata = {}) {

        try {

            fetch('{{ route('lead.track') }}', {
                method: 'POST',
                credentials: 'same-origin',
                keepalive: true,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    event: event,
                    metadata: {
                        ...metadata,

                        page_url: window.location.href,
                        landing_page: window.location.href,

                        referrer: document.referrer || null,

                        user_agent: navigator.userAgent,

                        timestamp: new Date().toISOString()
                    }
                })
            }).catch(function (error) {
                console.debug('Lead tracking failed:', error);
            });

        } catch (error) {
            console.debug('Lead tracking error:', error);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 1. Registration Page Viewed
    |--------------------------------------------------------------------------
    */

    trackLeadEvent('registration_viewed', {
        step: 8,
        stage: 'registration'
    });


    /*
    |--------------------------------------------------------------------------
    | Registration Form
    |--------------------------------------------------------------------------
    */

    const registrationForm = document.querySelector(
        'form[action="{{ route('register') }}"]'
    );


    if (!registrationForm) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | 2. User Started Registration
    |--------------------------------------------------------------------------
    */

    let registrationStarted = false;

    registrationForm.addEventListener('focusin', function (event) {

        if (!registrationStarted) {

            registrationStarted = true;

            trackLeadEvent('registration_started', {
                step: 8,
                stage: 'registration',
                field: event.target.name || event.target.id || null
            });

        }

    });


    /*
    |--------------------------------------------------------------------------
    | 3. Name Entered
    |--------------------------------------------------------------------------
    */

    const nameInput = document.getElementById('name');

    if (nameInput) {

        let nameTracked = false;

        nameInput.addEventListener('blur', function () {

            if (
                !nameTracked &&
                this.value.trim().length > 0
            ) {

                nameTracked = true;

                trackLeadEvent('registration_name_entered', {
                    step: 8,
                    stage: 'registration'
                });

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | 4. Email Entered
    |--------------------------------------------------------------------------
    */

    const emailInput = document.getElementById('email');

    if (emailInput) {

        let emailTracked = false;

        emailInput.addEventListener('blur', function () {

            if (
                !emailTracked &&
                this.value.trim().length > 0
            ) {

                emailTracked = true;

                trackLeadEvent('registration_email_entered', {
                    step: 8,
                    stage: 'registration'
                });

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | 5. Referral Code Entered
    |--------------------------------------------------------------------------
    */

    const referralInput = document.getElementById('referral_code');

    if (referralInput) {

        let referralTracked = false;

        referralInput.addEventListener('blur', function () {

            if (
                !referralTracked &&
                this.value.trim().length > 0
            ) {

                referralTracked = true;

                trackLeadEvent('registration_referral_entered', {
                    step: 8,
                    stage: 'registration'
                });

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | 6. Profile Photo Selected
    |--------------------------------------------------------------------------
    */

    const profilePhotoInput = document.getElementById('profile_photo');

    if (profilePhotoInput) {

        profilePhotoInput.addEventListener('change', function () {

            if (this.files && this.files.length > 0) {

                trackLeadEvent('registration_profile_photo_selected', {
                    step: 8,
                    stage: 'registration',
                    file_selected: true
                });

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | 7. Password Started
    |--------------------------------------------------------------------------
    */

    const passwordInput = document.getElementById('password');

    if (passwordInput) {

        let passwordTracked = false;

        passwordInput.addEventListener('input', function () {

            if (
                !passwordTracked &&
                this.value.length > 0
            ) {

                passwordTracked = true;

                trackLeadEvent('registration_password_started', {
                    step: 8,
                    stage: 'registration'
                });

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | 8. Registration Submitted
    |--------------------------------------------------------------------------
    */

    registrationForm.addEventListener('submit', function () {

        trackLeadEvent('registration_submitted', {
            step: 8,
            stage: 'registration',
            form_action: '{{ route('register') }}'
        });

    });

});
</script>

</x-guest-layout>