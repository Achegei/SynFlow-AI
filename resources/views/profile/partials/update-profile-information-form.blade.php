<section>

    {{-- =========================================================
         PROFILE INFORMATION
    ========================================================== --}}

    <header>

        <p class="text-xs font-bold uppercase tracking-widest text-blue-600">
            Account
        </p>

        <h2 class="mt-2 text-xl font-bold tracking-tight text-slate-950">
            Profile Information
        </h2>

        <p class="mt-2 text-sm leading-6 text-slate-500">
            Update your name and email address.
        </p>

    </header>


    {{-- =========================================================
         EMAIL VERIFICATION FORM
    ========================================================== --}}

    <form
        id="send-verification"
        method="post"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>


    {{-- =========================================================
         PROFILE FORM
    ========================================================== --}}

    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-7 space-y-5"
    >

        @csrf
        @method('patch')


        {{-- =====================================================
             NAME
        ====================================================== --}}

        <div>

            <x-input-label
                for="name"
                :value="__('Name')"
                class="!font-semibold !text-slate-700"
            />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />

        </div>


        {{-- =====================================================
             EMAIL
        ====================================================== --}}

        <div>

            <x-input-label
                for="email"
                :value="__('Email Address')"
                class="!font-semibold !text-slate-700"
            />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />


            {{-- =================================================
                 EMAIL VERIFICATION
            ================================================== --}}

            @if (
                $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&
                ! $user->hasVerifiedEmail()
            )

                <div class="mt-3 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3">

                    <p class="text-sm leading-6 text-amber-800">
                        {{ __('Your email address is unverified.') }}
                    </p>

                    <button
                        form="send-verification"
                        type="submit"
                        class="mt-1 text-sm font-semibold text-blue-600 hover:text-blue-700 hover:underline"
                    >
                        {{ __('Resend verification email') }}
                    </button>


                    @if (session('status') === 'verification-link-sent')

                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>

                    @endif

                </div>

            @endif

        </div>


        {{-- =====================================================
             SAVE
        ====================================================== --}}

        <div class="flex items-center gap-4 pt-2">

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 active:scale-[0.99]"
            >
                Save Changes
            </button>


            @if (session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600"
                >
                    {{ __('Saved.') }}
                </p>

            @endif

        </div>

    </form>

</section>