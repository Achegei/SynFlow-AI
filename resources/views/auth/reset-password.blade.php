<x-guest-layout>

    <div class="min-h-screen bg-[#F7F9FC] px-4 py-8 sm:px-6 lg:px-8">

        <div class="mx-auto flex min-h-[calc(100vh-4rem)] w-full max-w-6xl items-center justify-center">

            <div
                class="grid w-full max-w-5xl overflow-hidden rounded-[2rem] border border-[#DCE3EF] bg-white shadow-[0_20px_70px_rgba(7,25,61,0.12)] lg:grid-cols-2"
            >

                {{-- =========================================================
                     LEFT BRAND PANEL
                ========================================================== --}}

                <div
                    class="relative hidden overflow-hidden bg-[#071A3D] lg:flex lg:min-h-[680px] lg:flex-col lg:justify-between"
                >

                    {{-- Decorative background --}}
                    <div
                        class="absolute -left-24 -top-24 h-72 w-72 rounded-full bg-[#D71920]/20 blur-3xl"
                    ></div>

                    <div
                        class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-[#2563EB]/20 blur-3xl"
                    ></div>


                    {{-- Main brand content --}}
                    <div class="relative z-10 p-10 xl:p-12">

                        {{-- Logo --}}
                        <a
                            href="{{ url('/') }}"
                            class="inline-flex items-center"
                        >

                            <img
                                src="{{ asset('images/synflowlogo2.jpeg') }}"
                                alt="Moose Loon AI Academy"
                                class="h-16 w-auto rounded-xl bg-white object-contain p-1"
                            >

                        </a>


                        {{-- Brand message --}}
                        <div class="mt-14 max-w-md">

                            <div
                                class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.16em] text-white"
                            >

                                <span
                                    class="h-2 w-2 rounded-full bg-[#D71920]"
                                ></span>

                                AI-Powered Learning

                            </div>


                            <h1
                                class="mt-7 text-4xl font-extrabold leading-tight tracking-tight text-white xl:text-5xl"
                            >
                                Continue building
                                <span class="text-[#D71920]">
                                    practical AI skills.
                                </span>
                            </h1>


                            <p
                                class="mt-6 text-base leading-8 text-[#DCE5F5]"
                            >
                                Secure your Moose Loon AI Academy account and
                                continue your journey toward practical,
                                career-focused AI skills.
                            </p>

                        </div>


                        {{-- Trust points --}}
                        <div class="mt-12 space-y-5">

                            {{-- Security --}}
                            <div class="flex items-center gap-4">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/10 text-[#D71920]"
                                >

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2V7a2 2 0 00-2-2h-1V4a5 5 0 00-10 0v1H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <p class="font-semibold text-white">
                                        Secure account access
                                    </p>

                                    <p class="text-sm text-[#AEBBD1]">
                                        Your password is securely protected.
                                    </p>

                                </div>

                            </div>


                            {{-- Learning --}}
                            <div class="flex items-center gap-4">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/10 text-[#D71920]"
                                >

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.293 9 11.622C17.176 19.293 21 14.591 21 9c0-1.04-.133-2.049-.382-3.016z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <p class="font-semibold text-white">
                                        Continue your learning journey
                                    </p>

                                    <p class="text-sm text-[#AEBBD1]">
                                        Your learning progress stays connected
                                        to your account.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Bottom brand identity --}}
                    <div
                        class="relative z-10 border-t border-white/10 bg-black/10 px-10 py-6 xl:px-12"
                    >

                        <div class="flex items-center gap-3">

                            <span class="text-2xl">
                                🇨🇦
                            </span>

                            <div>

                                <p class="text-sm font-bold text-white">
                                    Moose Loon AI Academy
                                </p>

                                <p class="text-xs text-[#AEBBD1]">
                                    Canadian Practical AI Skills for the Modern Workforce
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =========================================================
                     RIGHT RESET PASSWORD PANEL
                ========================================================== --}}

                <div
                    class="flex min-h-[680px] items-center justify-center px-5 py-10 sm:px-10 lg:px-12 xl:px-16"
                >

                    <div class="w-full max-w-md">

                        {{-- Mobile Logo --}}
                        <div class="mb-8 flex justify-center lg:hidden">

                            <a href="{{ url('/') }}">

                                <img
                                    src="{{ asset('images/synflowlogo2.jpeg') }}"
                                    alt="Moose Loon AI Academy"
                                    class="h-16 w-auto rounded-xl object-contain"
                                >

                            </a>

                        </div>


                        {{-- Header --}}
                        <div class="text-center lg:text-left">

                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#071A3D] text-white shadow-sm lg:mx-0"
                            >

                                <svg
                                    class="h-7 w-7"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2V7a2 2 0 002-2h-1V4a5 5 0 00-10 0v1H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>

                            </div>


                            <p
                                class="mt-6 text-xs font-extrabold uppercase tracking-[0.18em] text-[#D71920]"
                            >
                                Account Security
                            </p>


                            <h2
                                class="mt-2 text-3xl font-extrabold tracking-tight text-[#071A3D] sm:text-4xl"
                            >
                                Create a new password
                            </h2>


                            <p
                                class="mt-3 text-sm leading-6 text-slate-500"
                            >
                                Choose a strong password to secure your
                                Moose Loon AI Academy account.
                            </p>

                        </div>


                        {{-- Validation Errors --}}
                        @if ($errors->any())

                            <div
                                class="mt-7 rounded-2xl border border-red-200 bg-red-50 p-4"
                            >

                                <div class="flex gap-3">

                                    <div class="mt-0.5 shrink-0 text-red-600">

                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"
                                            />
                                        </svg>

                                    </div>


                                    <div>

                                        <p
                                            class="text-sm font-bold text-red-800"
                                        >
                                            Please check the following:
                                        </p>

                                        <ul
                                            class="mt-1 space-y-1 text-sm text-red-700"
                                        >

                                            @foreach ($errors->all() as $error)

                                                <li>
                                                    {{ $error }}
                                                </li>

                                            @endforeach

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        @endif


                        {{-- =================================================
                             RESET FORM
                        ================================================== --}}

                        <form
                            method="POST"
                            action="{{ route('password.store') }}"
                            class="mt-8 space-y-5"
                        >

                            @csrf


                            {{-- Password Reset Token --}}
                            <input
                                type="hidden"
                                name="token"
                                value="{{ $request->route('token') }}"
                            >


                            {{-- Email --}}
                            <div>

                                <label
                                    for="email"
                                    class="mb-2 block text-sm font-bold text-[#071A3D]"
                                >
                                    Email Address
                                </label>


                                <div class="relative">

                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                                    >

                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                            />
                                        </svg>

                                    </div>


                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email', $request->email) }}"
                                        required
                                        autofocus
                                        autocomplete="username"
                                        placeholder="you@example.com"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-[#071A3D] outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                    >

                                </div>


                                @if ($errors->get('email'))

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $errors->first('email') }}
                                    </p>

                                @endif

                            </div>


                            {{-- New Password --}}
                            <div>

                                <label
                                    for="password"
                                    class="mb-2 block text-sm font-bold text-[#071A3D]"
                                >
                                    New Password
                                </label>


                                <div class="relative">

                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                                    >

                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2V7a2 2 0 002-2h-1V4a5 5 0 00-10 0v1H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>

                                    </div>


                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="new-password"
                                        placeholder="Enter your new password"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-12 text-sm text-[#071A3D] outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                    >


                                    <button
                                        type="button"
                                        onclick="togglePassword('password', 'passwordIcon')"
                                        class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-[#071A3D]"
                                        aria-label="Show or hide password"
                                    >

                                        <svg
                                            id="passwordIcon"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>

                                    </button>

                                </div>


                                @if ($errors->get('password'))

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $errors->first('password') }}
                                    </p>

                                @endif

                            </div>


                            {{-- Confirm Password --}}
                            <div>

                                <label
                                    for="password_confirmation"
                                    class="mb-2 block text-sm font-bold text-[#071A3D]"
                                >
                                    Confirm New Password
                                </label>


                                <div class="relative">

                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                                    >

                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.293 9 11.622C17.176 19.293 21 14.591 21 9c0-1.04-.133-2.049-.382-3.016z"
                                            />
                                        </svg>

                                    </div>


                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        name="password_confirmation"
                                        required
                                        autocomplete="new-password"
                                        placeholder="Confirm your new password"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-12 text-sm text-[#071A3D] outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                    >


                                    <button
                                        type="button"
                                        onclick="togglePassword('password_confirmation', 'confirmPasswordIcon')"
                                        class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-[#071A3D]"
                                        aria-label="Show or hide password"
                                    >

                                        <svg
                                            id="confirmPasswordIcon"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>

                                    </button>

                                </div>


                                @if ($errors->get('password_confirmation'))

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $errors->first('password_confirmation') }}
                                    </p>

                                @endif

                            </div>


                            {{-- Password Security Notice --}}
                            <div
                                class="rounded-xl border border-[#DCE3EF] bg-[#F7F9FC] p-4"
                            >

                                <div class="flex gap-3">

                                    <div
                                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#071A3D] text-white"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2V7a2 2 0 002-2h-1V4a5 5 0 00-10 0v1H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>

                                    </div>


                                    <div>

                                        <p
                                            class="text-xs font-bold uppercase tracking-wide text-[#071A3D]"
                                        >
                                            Password security
                                        </p>

                                        <p
                                            class="mt-1 text-xs leading-5 text-slate-500"
                                        >
                                            Use a strong password that you do
                                            not use on other websites.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- Submit --}}
                            <button
                                type="submit"
                                class="group flex w-full items-center justify-center gap-2 rounded-xl bg-[#D71920] px-5 py-3.5 text-sm font-extrabold text-white shadow-[0_8px_20px_rgba(215,25,32,0.18)] transition duration-200 hover:bg-[#B9141A] hover:shadow-[0_10px_25px_rgba(215,25,32,0.24)] focus:outline-none focus:ring-4 focus:ring-[#D71920]/20 active:scale-[0.99]"
                            >

                                <span>
                                    Reset Password
                                </span>

                                <svg
                                    class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-1"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 12h14M13 6l6 6-6 6"
                                    />
                                </svg>

                            </button>

                        </form>


                        {{-- Footer --}}
                        <div
                            class="mt-8 border-t border-slate-100 pt-6 text-center"
                        >

                            <p class="text-xs text-slate-400">
                                Moose Loon AI Academy
                            </p>

                            <p class="mt-1 text-[11px] text-slate-400">
                                Canadian Practical AI Skills for the Modern Workforce
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ================================================================
         PASSWORD VISIBILITY SCRIPT
    ================================================================= --}}

    <script>

        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (!input || !icon) {
                return;
            }

            if (input.type === 'password') {

                input.type = 'text';

                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.231-3.607M6.228 6.228A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.958 9.958 0 01-4.132 5.411M6.228 6.228L3 3m3.228 3.228l12.544 12.544M9.88 9.88a3 3 0 104.24 4.24"
                    />
                `;

            } else {

                input.type = 'password';

                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                `;
            }
        }

    </script>

</x-guest-layout>