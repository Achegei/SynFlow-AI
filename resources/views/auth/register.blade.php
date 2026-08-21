<x-guest-layout>

    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">

        <div class="mx-auto w-full max-w-5xl">

            {{-- =========================================================
                 BRAND HEADER
            ========================================================== --}}

            <div class="mb-8 text-center">

                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center justify-center"
                >

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
                                Create your account and begin your AI learning
                                journey with Moose Loon AI Academy.
                            </p>

                        </div>


                        {{-- =================================================
                             BENEFITS
                        ================================================== --}}

                        <div class="relative mt-10 space-y-4">

                            {{-- Benefit 1 --}}
                            <div class="flex items-start gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 ring-1 ring-blue-500/20">

                                    <span class="text-sm font-bold text-blue-400">
                                        .
                                    </span>

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


                            {{-- Benefit 2 --}}
                            <div class="flex items-start gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 ring-1 ring-blue-500/20">

                                    <span class="text-sm font-bold text-blue-400">
                                        .
                                    </span>

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


                            {{-- Benefit 3 --}}
                            <div class="flex items-start gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 ring-1 ring-blue-500/20">

                                    <span class="text-sm font-bold text-blue-400">
                                        .
                                    </span>

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


                        {{-- =================================================
                             BRAND FOOTER
                        ================================================== --}}

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


                            {{-- =================================================
                                 MOBILE BRAND MESSAGE
                            ================================================== --}}

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
                                    Start your AI learning journey.
                                </p>

                            </div>


                            {{-- =================================================
                                 DESKTOP HEADING
                            ================================================== --}}

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
                                class="space-y-5"
                            >

                                @csrf


                                {{-- =============================================
                                     FULL NAME
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
                                     EMAIL ADDRESS
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
                                     INFORMATION / TRUST
                                ============================================== --}}

                                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">

                                    <div class="flex items-start gap-3">

                                        <div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-blue-600">

                                            <span class="text-xs font-bold leading-none text-white">
                                                ✓
                                            </span>

                                        </div>


                                        <p class="text-xs leading-5 text-slate-500">
                                            Your information is used to create and
                                            personalize your Moose Loon AI Academy
                                            learning experience.
                                        </p>

                                    </div>

                                </div>


                                {{-- =============================================
                                     CREATE ACCOUNT
                                ============================================== --}}

                                <div class="pt-2">

                                    <button
                                        type="submit"
                                        class="flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 hover:shadow-blue-600/30 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 active:scale-[0.99]"
                                    >
                                        Create My Account
                                    </button>

                                </div>


                                {{-- =============================================
                                     LOGIN
                                ============================================== --}}

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


    {{-- =============================================================
        LEAD TRACKING
        DO NOT REMOVE
    ============================================================= --}}

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

                    console.debug(
                        'Lead tracking failed:',
                        error
                    );

                });

            } catch (error) {

                console.debug(
                    'Lead tracking error:',
                    error
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | 1. REGISTRATION PAGE VIEWED
        |--------------------------------------------------------------------------
        */

        trackLeadEvent('registration_viewed', {

            step: 8,

            stage: 'registration'

        });


        /*
        |--------------------------------------------------------------------------
        | REGISTRATION FORM
        |--------------------------------------------------------------------------
        */

        const registrationForm =
            document.querySelector(
                'form[action="{{ route('register') }}"]'
            );


        if (!registrationForm) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | 2. USER STARTED REGISTRATION
        |--------------------------------------------------------------------------
        */

        let registrationStarted = false;


        registrationForm.addEventListener(
            'focusin',
            function (event) {

                if (!registrationStarted) {

                    registrationStarted = true;


                    trackLeadEvent(
                        'registration_started',
                        {
                            step: 8,

                            stage: 'registration',

                            field:
                                event.target.name ||
                                event.target.id ||
                                null
                        }
                    );

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | 3. NAME ENTERED
        |--------------------------------------------------------------------------
        */

        const nameInput =
            document.getElementById('name');


        if (nameInput) {

            let nameTracked = false;


            nameInput.addEventListener(
                'blur',
                function () {

                    if (
                        !nameTracked &&
                        this.value.trim().length > 0
                    ) {

                        nameTracked = true;


                        trackLeadEvent(
                            'registration_name_entered',
                            {
                                step: 8,
                                stage: 'registration'
                            }
                        );

                    }

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | 4. EMAIL ENTERED
        |--------------------------------------------------------------------------
        */

        const emailInput =
            document.getElementById('email');


        if (emailInput) {

            let emailTracked = false;


            emailInput.addEventListener(
                'blur',
                function () {

                    if (
                        !emailTracked &&
                        this.value.trim().length > 0
                    ) {

                        emailTracked = true;


                        trackLeadEvent(
                            'registration_email_entered',
                            {
                                step: 8,
                                stage: 'registration'
                            }
                        );

                    }

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | 5. PASSWORD STARTED
        |--------------------------------------------------------------------------
        */

        const passwordInput =
            document.getElementById('password');


        if (passwordInput) {

            let passwordTracked = false;


            passwordInput.addEventListener(
                'input',
                function () {

                    if (
                        !passwordTracked &&
                        this.value.length > 0
                    ) {

                        passwordTracked = true;


                        trackLeadEvent(
                            'registration_password_started',
                            {
                                step: 8,
                                stage: 'registration'
                            }
                        );

                    }

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | 6. REGISTRATION SUBMITTED
        |--------------------------------------------------------------------------
        */

        registrationForm.addEventListener(
            'submit',
            function () {

                trackLeadEvent(
                    'registration_submitted',
                    {
                        step: 8,

                        stage: 'registration',

                        form_action:
                            '{{ route('register') }}'
                    }
                );

            }
        );

    });

    </script>

</x-guest-layout>