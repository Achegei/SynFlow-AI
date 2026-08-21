<x-guest-layout>

    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">

        <div class="mx-auto flex min-h-[calc(100vh-4rem)] w-full max-w-md flex-col justify-center">

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
                 PASSWORD RESET CARD
            ========================================================== --}}

            <div class="rounded-3xl bg-white px-5 py-7 shadow-xl shadow-slate-200/60 ring-1 ring-slate-200 sm:px-8 sm:py-9">

                {{-- Heading --}}
                <div class="mb-7">

                    <p class="text-xs font-bold uppercase tracking-widest text-blue-600">
                        Account Recovery
                    </p>

                    <h1 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">
                        Reset your password
                    </h1>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Enter the email address associated with your account and we’ll send you a link to reset your password.
                    </p>

                </div>


                {{-- Session Status --}}
                <x-auth-session-status
                    class="mb-5"
                    :status="session('status')"
                />


                {{-- =====================================================
                     FORM
                ====================================================== --}}

                <form
                    method="POST"
                    action="{{ route('password.email') }}"
                    class="space-y-5"
                >

                    @csrf


                    {{-- Email --}}
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
                            autofocus
                            autocomplete="email"
                            placeholder="you@example.com"
                        />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />

                    </div>


                    {{-- =================================================
                         ACTION
                    ================================================== --}}

                    <div class="pt-2">

                        <button
                            type="submit"
                            class="flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 hover:shadow-blue-600/30 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 active:scale-[0.99]"
                        >
                            Send Password Reset Link
                        </button>

                    </div>


                    {{-- =================================================
                         BACK TO LOGIN
                    ================================================== --}}

                    <div class="pt-1 text-center">

                        <p class="text-sm text-slate-500">

                            Remember your password?

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

</x-guest-layout>