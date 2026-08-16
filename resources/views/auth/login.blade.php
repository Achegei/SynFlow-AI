<x-guest-layout>

    <div class="w-full max-w-md mx-auto">

        {{-- ============================================================
             BRAND / HEADER
        ============================================================= --}}

        <div class="text-center mb-8">

            {{-- Academy Logo --}}
            <div class="flex justify-center mb-5">

                <a href="/" class="inline-flex items-center justify-center">

                    <img
                        src="{{ asset('images/synflowlogo2.jpeg') }}"
                        alt="Moose Loon AI Academy"
                        class="w-20 h-20 sm:w-24 sm:h-24 object-contain rounded-2xl shadow-sm"
                    >

                </a>

            </div>


            {{-- Brand Name --}}
            <div
                class="text-xs sm:text-sm
                       font-bold
                       uppercase
                       tracking-[0.22em]
                       text-blue-600"
            >
                Moose Loon AI Academy
            </div>


            {{-- Heading --}}
            <h1
                class="mt-3
                       text-3xl
                       sm:text-4xl
                       font-bold
                       tracking-tight
                       text-[#07163D]"
            >
                Welcome back
            </h1>


            {{-- Supporting Text --}}
            <p
                class="mt-3
                       text-sm
                       sm:text-base
                       leading-relaxed
                       text-gray-500"
            >
                Sign in to continue your AI learning journey.
            </p>

        </div>


        {{-- ============================================================
             LOGIN CARD
        ============================================================= --}}

        <div
            class="w-full
                   bg-white
                   rounded-2xl
                   sm:rounded-3xl
                   border
                   border-gray-100
                   shadow-xl
                   p-5
                   sm:p-7"
        >

            {{-- Session Status --}}
            @if (session('status'))

                <div
                    class="mb-6
                           rounded-xl
                           border border-blue-100
                           bg-blue-50
                           px-4 py-3
                           text-sm
                           text-blue-700"
                >
                    {{ session('status') }}
                </div>

            @endif


            {{-- Validation Errors --}}
            @if ($errors->any())

                <div
                    class="mb-6
                           rounded-xl
                           border border-red-100
                           bg-red-50
                           px-4 py-3"
                >

                    <div class="text-sm font-semibold text-red-700">
                        Please check the following:
                    </div>

                    <ul class="mt-2 space-y-1 text-sm text-red-600">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ========================================================
                 LOGIN FORM
            ========================================================= --}}

            <form method="POST" action="{{ route('login') }}">

                @csrf


                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="block
                               text-sm
                               font-semibold
                               text-[#07163D]
                               mb-2"
                    >
                        Email Address
                    </label>


                    <div class="relative">

                        {{-- Email Icon --}}
                        <div
                            class="pointer-events-none
                                   absolute
                                   inset-y-0
                                   left-0
                                   flex
                                   items-center
                                   pl-4
                                   text-gray-400"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />
                            </svg>

                        </div>


                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="you@example.com"
                            class="block
                                   w-full
                                   rounded-xl
                                   border
                                   border-gray-200
                                   bg-gray-50
                                   py-3.5
                                   pl-12
                                   pr-4
                                   text-sm
                                   text-gray-900
                                   placeholder-gray-400
                                   shadow-sm
                                   outline-none
                                   transition
                                   duration-200
                                   focus:border-blue-600
                                   focus:bg-white
                                   focus:ring-4
                                   focus:ring-blue-100"
                        >

                    </div>


                    @if ($errors->get('email'))

                        <p class="mt-2 text-sm text-red-600">
                            {{ $errors->first('email') }}
                        </p>

                    @endif

                </div>


                {{-- Password --}}
                <div class="mt-5">

                    <div class="flex items-center justify-between mb-2">

                        <label
                            for="password"
                            class="block
                                   text-sm
                                   font-semibold
                                   text-[#07163D]"
                        >
                            Password
                        </label>


                        @if (Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm
                                       font-semibold
                                       text-blue-600
                                       hover:text-blue-700
                                       transition"
                            >
                                Forgot password?
                            </a>

                        @endif

                    </div>


                    <div class="relative">

                        {{-- Lock Icon --}}
                        <div
                            class="pointer-events-none
                                   absolute
                                   inset-y-0
                                   left-0
                                   flex
                                   items-center
                                   pl-4
                                   text-gray-400"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2V9a2 2 0 00-2-2h-1V5a3 3 0 00-6 0v2H6a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />
                            </svg>

                        </div>


                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="block
                                   w-full
                                   rounded-xl
                                   border
                                   border-gray-200
                                   bg-gray-50
                                   py-3.5
                                   pl-12
                                   pr-4
                                   text-sm
                                   text-gray-900
                                   placeholder-gray-400
                                   shadow-sm
                                   outline-none
                                   transition
                                   duration-200
                                   focus:border-blue-600
                                   focus:bg-white
                                   focus:ring-4
                                   focus:ring-blue-100"
                        >

                    </div>


                    @if ($errors->get('password'))

                        <p class="mt-2 text-sm text-red-600">
                            {{ $errors->first('password') }}
                        </p>

                    @endif

                </div>


                {{-- Remember Me --}}
                <div class="mt-5">

                    <label
                        for="remember_me"
                        class="inline-flex
                               items-center
                               cursor-pointer
                               select-none"
                    >

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4
                                   rounded
                                   border-gray-300
                                   text-blue-600
                                   focus:ring-blue-500"
                        >

                        <span
                            class="ms-2
                                   text-sm
                                   text-gray-600"
                        >
                            Remember me
                        </span>

                    </label>

                </div>


                {{-- Login Button --}}
                <div class="mt-7">

                    <button
                        type="submit"
                        class="w-full
                               inline-flex
                               items-center
                               justify-center
                               gap-2
                               rounded-xl
                               bg-[#07163D]
                               px-5
                               py-3.5
                               text-sm
                               font-bold
                               text-white
                               shadow-lg
                               shadow-blue-900/10
                               transition
                               duration-200
                               hover:bg-blue-700
                               focus:outline-none
                               focus:ring-4
                               focus:ring-blue-100
                               active:scale-[0.99]"
                    >

                        <span>
                            Log in
                        </span>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linecap="round"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"
                            />
                        </svg>

                    </button>

                </div>

            </form>


            {{-- ========================================================
                 REGISTER
            ========================================================= --}}

            @if (Route::has('register'))

                <div class="mt-6 text-center">

                    <p class="text-sm text-gray-500">

                        Don't have an account?

                        <a
                            href="{{ route('register') }}"
                            class="font-bold
                                   text-blue-600
                                   hover:text-blue-700
                                   transition"
                        >
                            Create an account
                        </a>

                    </p>

                </div>

            @endif

        </div>


        {{-- ============================================================
             TRUST / BRAND MESSAGE
        ============================================================= --}}

        <div class="mt-6 text-center">

            <div
                class="inline-flex
                       items-center
                       gap-2
                       text-xs
                       text-gray-400"
            >

                <span
                    class="w-2 h-2
                           rounded-full
                           bg-[#E31B23]"
                ></span>

                Canadian Practical AI Skills for Modern Work

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
    | 1. Existing User Reached Login Page
    |--------------------------------------------------------------------------
    */

    trackLeadEvent('login_viewed', {
        stage: 'login'
    });


    /*
    |--------------------------------------------------------------------------
    | Login Form
    |--------------------------------------------------------------------------
    */

    const loginForm = document.querySelector(
        'form[action="{{ route('login') }}"]'
    );


    if (!loginForm) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | 2. User Started Login
    |--------------------------------------------------------------------------
    */

    let loginStarted = false;

    loginForm.addEventListener('focusin', function (event) {

        if (!loginStarted) {

            loginStarted = true;

            trackLeadEvent('login_started', {
                stage: 'login',
                field: event.target.name || event.target.id || null
            });

        }

    });


    /*
    |--------------------------------------------------------------------------
    | 3. Email Entered
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

                trackLeadEvent('login_email_entered', {
                    stage: 'login'
                });

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | 4. Password Entered
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

                trackLeadEvent('login_password_started', {
                    stage: 'login'
                });

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | 5. Remember Me
    |--------------------------------------------------------------------------
    */

    const rememberMe = document.getElementById('remember_me');

    if (rememberMe) {

        rememberMe.addEventListener('change', function () {

            trackLeadEvent('login_remember_me_changed', {
                stage: 'login',
                remember: this.checked
            });

        });

    }


    /*
    |--------------------------------------------------------------------------
    | 6. Login Submitted
    |--------------------------------------------------------------------------
    */

    loginForm.addEventListener('submit', function () {

        trackLeadEvent('login_submitted', {
            stage: 'login'
        });

    });

});
</script>
</x-guest-layout>