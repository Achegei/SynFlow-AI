{{-- ================================================================
    MOOSE LOON AI ACADEMY
    UPDATE PASSWORD
================================================================ --}}

<section>

    <div class="w-full max-w-2xl mx-auto">

        {{-- =========================================================
             HEADER
        ========================================================== --}}

        <header class="mb-7">

            <p class="text-xs font-bold uppercase tracking-widest text-blue-600">
                Account Security
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">
                Update your password
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Choose a strong password to keep your account secure.
            </p>

        </header>


        {{-- =========================================================
             PASSWORD CARD
        ========================================================== --}}

        <div class="overflow-hidden rounded-3xl bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-200">

            <div class="px-5 py-7 sm:px-8 sm:py-9">

                {{-- =====================================================
                     PASSWORD FORM
                ====================================================== --}}

                <form
                    method="post"
                    action="{{ route('password.update') }}"
                    class="space-y-5"
                >

                    @csrf

                    @method('put')


                    {{-- =================================================
                         CURRENT PASSWORD
                    ================================================== --}}

                    <div>

                        <x-input-label
                            for="update_password_current_password"
                            :value="__('Current Password')"
                            class="!font-semibold !text-slate-700"
                        />

                        <x-text-input
                            id="update_password_current_password"
                            name="current_password"
                            type="password"
                            class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                            autocomplete="current-password"
                            placeholder="Enter your current password"
                        />

                        <x-input-error
                            :messages="$errors->updatePassword->get('current_password')"
                            class="mt-2"
                        />

                    </div>


                    {{-- =================================================
                         NEW PASSWORD
                    ================================================== --}}

                    <div>

                        <x-input-label
                            for="update_password_password"
                            :value="__('New Password')"
                            class="!font-semibold !text-slate-700"
                        />

                        <x-text-input
                            id="update_password_password"
                            name="password"
                            type="password"
                            class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                            autocomplete="new-password"
                            placeholder="Enter your new password"
                        />

                        <x-input-error
                            :messages="$errors->updatePassword->get('password')"
                            class="mt-2"
                        />

                    </div>


                    {{-- =================================================
                         CONFIRM PASSWORD
                    ================================================== --}}

                    <div>

                        <x-input-label
                            for="update_password_password_confirmation"
                            :value="__('Confirm Password')"
                            class="!font-semibold !text-slate-700"
                        />

                        <x-text-input
                            id="update_password_password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="mt-2 block w-full rounded-xl !border-slate-300 !bg-white px-4 py-3 text-sm shadow-sm transition focus:!border-blue-600 focus:!ring-blue-600"
                            autocomplete="new-password"
                            placeholder="Enter your new password again"
                        />

                        <x-input-error
                            :messages="$errors->updatePassword->get('password_confirmation')"
                            class="mt-2"
                        />

                    </div>


                    {{-- =================================================
                         SAVE ACTION
                    ================================================== --}}

                    <div class="pt-2">

                        <button
                            type="submit"
                            class="flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 hover:shadow-blue-600/30 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 active:scale-[0.99] sm:w-auto"
                        >
                            Save Password
                        </button>

                    </div>


                    {{-- =================================================
                         SUCCESS MESSAGE
                    ================================================== --}}

                    @if (session('status') === 'password-updated')

                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2500)"
                            class="text-sm font-medium text-green-600"
                        >
                            {{ __('Password updated successfully.') }}
                        </p>

                    @endif

                </form>

            </div>

        </div>

    </div>

</section>