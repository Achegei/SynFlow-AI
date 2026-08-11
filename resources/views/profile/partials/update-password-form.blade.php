{{-- ================================================================
    MOOSE LOON AI ACADEMY
    UPDATE PASSWORD SECTION
================================================================ --}}

<section>

    {{-- ============================================================
         CENTERED PASSWORD SECURITY CONTAINER
    ============================================================= --}}

    <div class="w-full max-w-2xl mx-auto">

        {{-- ========================================================
             MAIN PASSWORD CARD
        ========================================================= --}}

        <div
            class="bg-white
                   rounded-3xl
                   border border-slate-200
                   shadow-[0_20px_60px_-20px_rgba(11,31,58,0.18)]
                   overflow-hidden"
        >

            {{-- ====================================================
                 BRANDED HEADER
            ===================================================== --}}

            <div
                class="relative
                       overflow-hidden
                       bg-gradient-to-br
                       from-[#0B1F3A]
                       via-[#102B52]
                       to-[#163C70]
                       px-6 py-8
                       sm:px-10 sm:py-10"
            >

                {{-- Decorative blue glow --}}
                <div
                    class="absolute
                           -top-16
                           -right-16
                           w-40
                           h-40
                           rounded-full
                           bg-[#1E73BE]/20
                           blur-3xl
                           pointer-events-none"
                ></div>


                {{-- Decorative red glow --}}
                <div
                    class="absolute
                           -bottom-16
                           left-1/3
                           w-32
                           h-32
                           rounded-full
                           bg-[#E31837]/10
                           blur-3xl
                           pointer-events-none"
                ></div>


                {{-- Header Content --}}
                <div class="relative text-center">

                    {{-- ==================================================
                         BRAND MONOGRAM
                    =================================================== --}}

                    <div
                        class="mx-auto
                               flex items-center justify-center
                               w-14 h-14
                               rounded-2xl
                               bg-white
                               shadow-lg
                               ring-1 ring-white/20"
                    >

                        <span
                            class="text-xl
                                   font-black
                                   tracking-tight
                                   text-[#0B1F3A]"
                        >
                            ML
                        </span>

                    </div>


                    {{-- ==================================================
                         BRAND NAME
                    =================================================== --}}

                    <div
                        class="mt-5
                               text-[11px]
                               sm:text-xs
                               font-bold
                               uppercase
                               tracking-[0.22em]
                               text-blue-200"
                    >
                        Moose Loon AI Academy
                    </div>


                    {{-- ==================================================
                         PAGE TITLE
                    =================================================== --}}

                    <h2
                        class="mt-3
                               text-2xl
                               sm:text-3xl
                               font-bold
                               tracking-tight
                               text-white"
                    >
                        Update your password
                    </h2>


                    {{-- ==================================================
                         DESCRIPTION
                    =================================================== --}}

                    <p
                        class="mt-3
                               max-w-md
                               mx-auto
                               text-sm
                               sm:text-base
                               leading-relaxed
                               text-blue-100/80"
                    >
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>

                </div>

            </div>


            {{-- ========================================================
                 CARD BODY
            ========================================================= --}}

            <div
                class="px-6 py-7
                       sm:px-10 sm:py-9"
            >

                {{-- ====================================================
                     SECURITY NOTICE
                ===================================================== --}}

                <div
                    class="mb-8
                           rounded-2xl
                           border border-[#D9EAF7]
                           bg-[#F4FAFE]
                           p-4 sm:p-5"
                >

                    <div class="flex items-start gap-3">

                        {{-- Security Icon --}}
                        <div
                            class="flex-shrink-0
                                   flex items-center justify-center
                                   w-10 h-10
                                   rounded-xl
                                   bg-[#E5F2FC]
                                   text-[#1E73BE]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2V7a2 2 0 00-2-2h-1V4a3 3 0 00-6 0v1H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>

                        </div>


                        {{-- Security Message --}}
                        <div class="min-w-0">

                            <p
                                class="text-sm
                                       font-bold
                                       text-[#0B1F3A]"
                            >
                                Keep your account protected
                            </p>

                            <p
                                class="mt-1
                                       text-xs
                                       sm:text-sm
                                       leading-relaxed
                                       text-slate-500"
                            >
                                Use a strong password that you do not use
                                on other websites or services.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                     PASSWORD UPDATE FORM
                ===================================================== --}}

                <form
                    method="post"
                    action="{{ route('password.update') }}"
                    class="space-y-6"
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
                            class="!text-sm
                                   !font-semibold
                                   !text-[#0B1F3A]"
                        />

                        <div class="relative mt-2">

                            {{-- Lock Icon --}}
                            <div
                                class="pointer-events-none
                                       absolute
                                       inset-y-0
                                       left-0
                                       flex items-center
                                       pl-4
                                       text-slate-400"
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
                                        d="M16.5 10.5V7a4.5 4.5 0 10-9 0v3.5M6 10.5h12a1.5 1.5 0 011.5 1.5v7A1.5 1.5 0 0118 20.5H6A1.5 1.5 0 014.5 19v-7A1.5 1.5 0 016 10.5z"
                                    />
                                </svg>

                            </div>


                            <x-text-input
                                id="update_password_current_password"
                                name="current_password"
                                type="password"
                                class="block w-full
                                       !pl-12
                                       !pr-4
                                       !py-3.5
                                       !rounded-xl
                                       !border-slate-200
                                       !bg-slate-50
                                       text-sm
                                       shadow-sm
                                       transition
                                       focus:!border-[#1E73BE]
                                       focus:!bg-white
                                       focus:!ring-[#1E73BE]
                                       focus:!ring-1"
                                autocomplete="current-password"
                            />

                        </div>


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
                            class="!text-sm
                                   !font-semibold
                                   !text-[#0B1F3A]"
                        />

                        <div class="relative mt-2">

                            {{-- Lock Icon --}}
                            <div
                                class="pointer-events-none
                                       absolute
                                       inset-y-0
                                       left-0
                                       flex items-center
                                       pl-4
                                       text-slate-400"
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
                                        d="M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 10v4m-2 0h4m-9 6h14a2 2 0 002-2v-4a2 2 0 00-2-2h-1V9a6 6 0 10-12 0v3H5a2 2 0 00-2 2v4a2 2 0 002 2z"
                                    />
                                </svg>

                            </div>


                            <x-text-input
                                id="update_password_password"
                                name="password"
                                type="password"
                                class="block w-full
                                       !pl-12
                                       !pr-4
                                       !py-3.5
                                       !rounded-xl
                                       !border-slate-200
                                       !bg-slate-50
                                       text-sm
                                       shadow-sm
                                       transition
                                       focus:!border-[#1E73BE]
                                       focus:!bg-white
                                       focus:!ring-[#1E73BE]
                                       focus:!ring-1"
                                autocomplete="new-password"
                            />

                        </div>


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
                            class="!text-sm
                                   !font-semibold
                                   !text-[#0B1F3A]"
                        />

                        <div class="relative mt-2">

                            {{-- Check Icon --}}
                            <div
                                class="pointer-events-none
                                       absolute
                                       inset-y-0
                                       left-0
                                       flex items-center
                                       pl-4
                                       text-slate-400"
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
                                        d="M9 12l2 2 4-4"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 3a9 9 0 100 18 9 9 0 000-18z"
                                    />
                                </svg>

                            </div>


                            <x-text-input
                                id="update_password_password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="block w-full
                                       !pl-12
                                       !pr-4
                                       !py-3.5
                                       !rounded-xl
                                       !border-slate-200
                                       !bg-slate-50
                                       text-sm
                                       shadow-sm
                                       transition
                                       focus:!border-[#1E73BE]
                                       focus:!bg-white
                                       focus:!ring-[#1E73BE]
                                       focus:!ring-1"
                                autocomplete="new-password"
                            />

                        </div>


                        <x-input-error
                            :messages="$errors->updatePassword->get('password_confirmation')"
                            class="mt-2"
                        />

                    </div>


                    {{-- =================================================
                         SAVE ACTION
                    ================================================== --}}

                    <div
                        class="flex flex-col
                               sm:flex-row
                               sm:items-center
                               gap-4
                               pt-2"
                    >

                        <x-primary-button
                            class="w-full sm:w-auto
                                   !justify-center
                                   !rounded-xl
                                   !px-8
                                   !py-3.5
                                   !bg-[#0B1F3A]
                                   hover:!bg-[#12345C]
                                   active:!bg-[#08162A]
                                   focus:!ring-[#1E73BE]
                                   text-sm
                                   font-bold
                                   shadow-md
                                   hover:shadow-lg
                                   transition-all
                                   duration-200"
                        >
                            {{ __('Save Password') }}
                        </x-primary-button>


                        {{-- =================================================
                             SUCCESS MESSAGE
                        ================================================== --}}

                        @if (session('status') === 'password-updated')

                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2500)"
                                class="flex items-center
                                       justify-center
                                       sm:justify-start
                                       gap-2
                                       text-sm
                                       font-semibold
                                       text-emerald-600"
                            >

                                <span
                                    class="flex items-center
                                           justify-center
                                           w-5 h-5
                                           rounded-full
                                           bg-emerald-50"
                                >
                                    ✓
                                </span>

                                {{ __('Password updated successfully.') }}

                            </p>

                        @endif

                    </div>

                </form>

            </div>

        </div>


        {{-- ============================================================
             BRAND FOOTER
        ============================================================= --}}

        <div class="mt-5 text-center">

            <div
                class="inline-flex
                       items-center
                       gap-2
                       text-[11px]
                       font-medium
                       text-slate-400"
            >

                <span
                    class="w-1.5 h-1.5
                           rounded-full
                           bg-[#E31837]"
                ></span>

                <span>
                    Canadian Practical AI Skills
                </span>

            </div>

        </div>

    </div>

</section>