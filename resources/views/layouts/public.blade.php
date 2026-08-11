{{-- ================================================================
     MOOSE LOON AI ACADEMY
     MAIN APPLICATION / PUBLIC LAYOUT
     BRAND-REFINED VERSION
================================================================ --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'MooseLoon AI')</title>


    {{-- ============================================================
         FONTS
    ============================================================= --}}

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800"
        rel="stylesheet"
    />


    {{-- ============================================================
         APPLICATION ASSETS
    ============================================================= --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- ============================================================
         MOOSE LOON BRAND / SOCIAL PROOF ANIMATIONS
    ============================================================= --}}

    <style>

        /* ==========================================================
           BRAND COLORS

           Navy  : #0B1F3A
           Blue  : #1E73BE
           Red   : #E31837
        ========================================================== */


        @keyframes slideIn {

            0% {
                opacity: 0;
                transform: translateY(16px) scale(0.96);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

        }


        @keyframes fadeOut {

            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

            100% {
                opacity: 0;
                transform: translateY(10px) scale(0.96);
            }

        }


        .animate-slide-in {
            animation: slideIn 0.4s ease-out;
        }


        .animate-fade-out {
            animation: fadeOut 0.35s ease-in forwards;
        }


        /* ==========================================================
           SOCIAL PROOF CONTAINER
           FIXED BOTTOM
        ========================================================== */

        .social-proof-container {

            position: fixed;

            bottom: 16px;

            left: 16px;

            z-index: 99999;

            pointer-events: none;

        }


        /* ==========================================================
           SOCIAL PROOF TOAST
        ========================================================== */

        .social-toast {

            background:
                linear-gradient(
                    135deg,
                    #22c55e,
                    #16a34a
                );

            color: #ffffff;

            box-shadow:
                0 12px 28px rgba(34, 197, 94, 0.45),
                0 0 18px rgba(34, 197, 94, 0.55);

            border-radius: 14px;

            padding: 12px 14px;

            max-width: 320px;

            font-size: 13px;

            line-height: 1.35;

        }


        /* ==========================================================
           SOCIAL PROOF TITLE
        ========================================================== */

        .social-toast-title {

            font-size: 14px;

            font-weight: 600;

        }


        /* ==========================================================
           SOCIAL PROOF META
        ========================================================== */

        .social-toast-meta {

            font-size: 11px;

            opacity: 0.8;

        }


        /* ==========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 640px) {

            .social-proof-container {

                left: 50%;

                transform: translateX(-50%);

                bottom: 12px;

            }


            .social-toast {

                max-width: calc(100vw - 24px);

            }

        }

    </style>

</head>


<body
    class="font-sans antialiased
           text-[#0B1F3A]
           bg-[#F7FAFC]"
>


<div class="min-h-screen flex flex-col">


    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <header
        class="sticky top-0 z-50
               bg-white/95
               backdrop-blur-md
               border-b border-slate-200/80
               shadow-[0_4px_20px_rgba(11,31,58,0.05)]"
    >

        <div class="relative">


            {{-- ====================================================
                 NAVIGATION
            ===================================================== --}}

            <nav
                x-data="{ open: false }"
                class="bg-white"
            >

                <div
                    class="max-w-7xl
                           mx-auto
                           px-4
                           sm:px-6
                           lg:px-8"
                >

                    <div
                        class="flex
                               justify-between
                               items-center
                               min-h-[80px]"
                    >


                        {{-- ==================================================
                             LEFT SIDE
                             LOGO + NAVIGATION
                        =================================================== --}}

                        <div class="flex items-center min-w-0">


                            {{-- ==================================================
                                 LOGO AREA

                                 Existing logo markup should remain in the
                                 surrounding layout if present.
                            =================================================== --}}

                            <div class="flex items-center flex-shrink-0">

                                {{-- Existing logo/content remains here --}}

                            </div>


                            {{-- ==================================================
                                 DESKTOP NAVIGATION
                            =================================================== --}}

                            <div
                                class="hidden
                                       md:flex
                                       items-center
                                       space-x-8
                                       ml-10"
                            >

                                <a
                                    href="{{ route('home') }}"
                                    class="relative
                                           text-sm
                                           font-semibold
                                           text-[#0B1F3A]
                                           hover:text-[#1E73BE]
                                           transition-colors
                                           duration-200
                                           py-2
                                           after:absolute
                                           after:left-0
                                           after:right-0
                                           after:-bottom-1
                                           after:h-0.5
                                           after:scale-x-0
                                           hover:after:scale-x-100
                                           after:bg-[#E31837]
                                           after:transition-transform
                                           after:duration-200"
                                >
                                    Home
                                </a>


                                <!--<a href="{{ route('about') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Our Team</a>-->


                                <a
                                    href="{{ route('services') }}"
                                    class="relative
                                           text-sm
                                           font-semibold
                                           text-[#0B1F3A]
                                           hover:text-[#1E73BE]
                                           transition-colors
                                           duration-200
                                           py-2
                                           after:absolute
                                           after:left-0
                                           after:right-0
                                           after:-bottom-1
                                           after:h-0.5
                                           after:scale-x-0
                                           hover:after:scale-x-100
                                           after:bg-[#E31837]
                                           after:transition-transform
                                           after:duration-200"
                                >
                                    Services
                                </a>


                                <a
                                    href="{{ route('pricing') }}"
                                    class="relative
                                           text-sm
                                           font-semibold
                                           text-[#0B1F3A]
                                           hover:text-[#1E73BE]
                                           transition-colors
                                           duration-200
                                           py-2
                                           after:absolute
                                           after:left-0
                                           after:right-0
                                           after:-bottom-1
                                           after:h-0.5
                                           after:scale-x-0
                                           hover:after:scale-x-100
                                           after:bg-[#E31837]
                                           after:transition-transform
                                           after:duration-200"
                                >
                                    Curriculum
                                </a>


                                <a
                                    href="{{ route('certificate.verify') }}"
                                    class="inline-flex
                                           items-center
                                           gap-2
                                           text-sm
                                           font-bold
                                           text-[#E31837]
                                           hover:text-[#C4122D]
                                           transition-colors
                                           duration-200"
                                >

                                    <span
                                        class="w-1.5 h-1.5
                                               rounded-full
                                               bg-[#E31837]"
                                    ></span>

                                    Verify Certificate

                                </a>


                                <!-- <a href="{{ route('careers') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Careers</a> -->


                                <a
                                    href="{{ route('partners.page') }}"
                                    class="relative
                                           text-sm
                                           font-semibold
                                           text-[#0B1F3A]
                                           hover:text-[#1E73BE]
                                           transition-colors
                                           duration-200
                                           py-2
                                           after:absolute
                                           after:left-0
                                           after:right-0
                                           after:-bottom-1
                                           after:h-0.5
                                           after:scale-x-0
                                           hover:after:scale-x-100
                                           after:bg-[#E31837]
                                           after:transition-transform
                                           after:duration-200"
                                >
                                    Partners
                                </a>


                                <!--<a href="{{ route('documentation') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Documentation</a>. -->


                                <a
                                    href="{{ route('contact') }}"
                                    class="relative
                                           text-sm
                                           font-semibold
                                           text-[#0B1F3A]
                                           hover:text-[#1E73BE]
                                           transition-colors
                                           duration-200
                                           py-2
                                           after:absolute
                                           after:left-0
                                           after:right-0
                                           after:-bottom-1
                                           after:h-0.5
                                           after:scale-x-0
                                           hover:after:scale-x-100
                                           after:bg-[#E31837]
                                           after:transition-transform
                                           after:duration-200"
                                >
                                    Contact
                                </a>

                            </div>

                        </div>


                        {{-- ==================================================
                             RIGHT SIDE
                             WHATSAPP + VOICE
                        =================================================== --}}

                        <div
                            class="hidden
                                   md:flex
                                   items-center
                                   gap-5"
                        >

                            WhatsApp

                            <a
                                href="https://wa.me/254119066667"
                                target="_blank"
                                class="flex
                                       items-center
                                       justify-center
                                       w-10
                                       h-10
                                       rounded-full
                                       bg-[#E9F9EF]
                                       text-green-600
                                       hover:bg-green-100
                                       hover:text-green-700
                                       transition-all
                                       duration-200
                                       shadow-sm"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"
                                    class="w-5 h-5 fill-current"
                                >

                                    <path d="M256.064 0C114.844 0 0 114.836 0 256.064c0 45.16 11.656 89.3 33.792 128.248L0 512l132.78-34.732c37.42 20.46 79.62 31.248 123.284 31.248h.004C397.288 508.516 512 393.772 512 256.064 512 114.836 397.284 0 256.064 0zm149.956 362.676c-6.16 17.344-30.62 31.74-50.16 35.88-13.36 2.828-30.78 5.08-89.524-19.18-75.172-31.16-123.612-107.62-127.276-112.62-3.664-5-30.38-40.5-30.38-77.32s18.74-54.84 26.34-62.52c6.16-6.308 16.34-9.08 26.34-9.08 3.184 0 6.04.156 8.62.296 7.56.32 11.34.78 16.28 12.66 6.16 14.82 21.04 51.42 22.84 55.16 1.8 3.74 3.6 8.86 1.08 13.86-2.52 5-4.74 7.22-8.72 11.54-3.98 4.32-7.7 7.66-11.62 12.32-3.62 4.3-7.7 8.92-3.3 16.96 4.4 7.98 19.58 32.2 42 52.1 28.94 25.52 52.84 33.42 61.26 36.94 8.42 3.52 13.3 2.94 18.28-1.78 5.72-5.32 13.1-15.5 20.58-25.02 5.24-6.82 11.86-7.66 18.88-5.26 7.98 2.78 50.32 23.72 58.94 28.06 8.62 4.32 14.36 6.46 16.48 10.14 2.14 3.66 2.14 20.78-4.02 38.12z"/>

                                </svg>

                            </a>


                            {{-- ==================================================
                                 VOICE CALL BUTTON
                            =================================================== --}}

                            <button
                                id="voice-call-btn"
                                class="flex
                                       items-center
                                       gap-2
                                       px-5
                                       py-2.5
                                       bg-[#0B1F3A]
                                       hover:bg-[#12345C]
                                       text-white
                                       rounded-full
                                       font-semibold
                                       text-sm
                                       shadow-md
                                       hover:shadow-lg
                                       transition-all
                                       duration-200
                                       border
                                       border-[#1E73BE]/30"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 10l4.553-2.276a1 1 0 011.447.894v5.764a1 1 0 01-1.447.894L15 14M15 10v4m0-4L9 8v8l6-2v-4z"
                                    />

                                </svg>

                                Talk

                            </button>

                        </div>


                        {{-- ==================================================
                             MOBILE HAMBURGER MENU
                        =================================================== --}}

                        <div class="-me-2 flex items-center md:hidden">

                            <button
                                @click="open = !open"
                                class="inline-flex
                                       items-center
                                       justify-center
                                       p-2.5
                                       rounded-xl
                                       text-[#0B1F3A]
                                       hover:text-[#1E73BE]
                                       hover:bg-[#F4FAFE]
                                       focus:outline-none
                                       transition
                                       duration-200"
                            >

                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        :class="{'hidden': open, 'inline-flex': !open}"
                                        class="inline-flex"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />

                                    <path
                                        :class="{'hidden': !open, 'inline-flex': open}"
                                        class="hidden"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />

                                </svg>

                            </button>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                     MOBILE MENU
                ===================================================== --}}

                <div
                    x-show="open"
                    @click.away="open = false"
                    class="absolute
                           top-full
                           left-0
                           w-full
                           bg-white
                           border-t
                           border-slate-100
                           shadow-xl
                           flex
                           flex-col
                           space-y-1
                           py-4
                           px-4
                           z-40"
                >

                    <a
                        href="{{ route('home') }}"
                        class="px-4 py-3
                               rounded-xl
                               text-[#0B1F3A]
                               font-semibold
                               hover:bg-[#F4FAFE]
                               hover:text-[#1E73BE]
                               transition"
                    >
                        Home
                    </a>


                    <!--<a href="{{ route('about') }}" class="text-gray-700 hover:text-indigo-600">Our Team</a>-->


                    <a
                        href="{{ route('services') }}"
                        class="px-4 py-3
                               rounded-xl
                               text-[#0B1F3A]
                               font-semibold
                               hover:bg-[#F4FAFE]
                               hover:text-[#1E73BE]
                               transition"
                    >
                        Services
                    </a>


                    <a
                        href="{{ route('certificate.verify') }}"
                        class="px-4 py-3
                               rounded-xl
                               text-[#E31837]
                               font-bold
                               hover:bg-red-50
                               transition"
                    >
                        Verify Certificate
                    </a>


                    <a
                        href="{{ route('pricing') }}"
                        class="px-4 py-3
                               rounded-xl
                               text-[#0B1F3A]
                               font-semibold
                               hover:bg-[#F4FAFE]
                               hover:text-[#1E73BE]
                               transition"
                    >
                        Curriculum
                    </a>


                    <!-- <a href="{{ route('careers') }}" class="text-gray-700 hover:text-indigo-600">Careers</a> -->


                    <a
                        href="{{ route('partners.page') }}"
                        class="px-4 py-3
                               rounded-xl
                               text-[#0B1F3A]
                               font-semibold
                               hover:bg-[#F4FAFE]
                               hover:text-[#1E73BE]
                               transition"
                    >
                        Partners
                    </a>


                    <a
                        href="{{ route('contact') }}"
                        class="px-4 py-3
                               rounded-xl
                               text-[#0B1F3A]
                               font-semibold
                               hover:bg-[#F4FAFE]
                               hover:text-[#1E73BE]
                               transition"
                    >
                        Contact
                    </a>


                    {{-- ==================================================
                         OPTIONAL CONTACT INFO
                    =================================================== --}}

                    <div
                        class="flex
                               flex-col
                               space-y-2
                               mt-3
                               pt-4
                               border-t
                               border-slate-100"
                    >

                        <a
                            href="https://wa.me/254119066667"
                            target="_blank"
                            class="flex
                                   items-center
                                   gap-2
                                   px-4
                                   py-3
                                   rounded-xl
                                   text-green-600
                                   font-semibold
                                   hover:bg-green-50
                                   transition"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"
                                class="w-5 h-5 fill-current"
                            >

                                <path d="M256.064 0C114.844 0 0 114.836 0 256.064c0 45.16 11.656 89.3 33.792 128.248L0 512l132.78-34.732c37.42 20.46 79.62 31.248 123.284 31.248h.004C397.288 508.516 512 393.772 512 256.064 512 114.836 397.284 0 256.064 0zm149.956 362.676c-6.16 17.344-30.62 31.74-50.16 35.88-13.36 2.828-30.78 5.08-89.524-19.18-75.172-31.16-123.612-107.62-127.276-112.62-3.664-5-30.38-40.5-30.38-77.32s18.74-54.84 26.34-62.52c6.16-6.308 16.34-9.08 26.34-9.08 3.184 0 6.04.156 8.62.296 7.56.32 11.34.78 16.28 12.66 6.16 14.82 21.04 51.42 22.84 55.16 1.8 3.74 3.6 8.86 1.08 13.86-2.52 5-4.74 7.22-8.72 11.54-3.98 4.32-7.7 7.66-11.62 12.32-3.62 4.3-7.7 8.92-3.3 16.96 4.4 7.98 19.58 32.2 42 52.1 28.94 25.52 52.84 33.42 61.26 36.94 8.42 3.52 13.3 2.94 18.28-1.78 5.72-5.32 13.1-15.5 20.58-25.02 5.24-6.82 11.86-7.66 18.88-5.26 7.98 2.78 50.32 23.72 58.94 28.06 8.62 4.32 14.36 6.46 16.48 10.14 2.14 3.66 2.14 20.78-4.02 38.12z"/>

                            </svg>

                            WhatsApp

                        </a>

                    </div>


                    {{-- ==================================================
                         MOBILE VOICE CALL
                    =================================================== --}}

                    <button
                        id="voice-call-btn-mobile"
                        class="flex
                               items-center
                               mt-2
                               px-4
                               py-3
                               bg-[#0B1F3A]
                               hover:bg-[#12345C]
                               text-white
                               rounded-xl
                               w-full
                               justify-center
                               font-bold
                               shadow-md
                               transition-all
                               duration-200"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 10l4.553-2.276a1 1 0 011.447.894v5.764a1 1 0 01-1.447.894L15 14M15 10v4m0-4L9 8v8l6-2v-4z"
                            />

                        </svg>

                        Talk

                    </button>

                </div>


                {{-- ====================================================
                     DARK MODE TOGGLE
                ===================================================== --}}

                <!--<div class="hidden md:flex items-center space-x-4">
                    <button id="dark-mode-toggle" class="w-full text-left py-2 px-3 rounded-lg text-gray-700 hover:bg-gray-200">
                        Dark Mode
                    </button>
                </div> -->

            </nav>

        </div>

    </header>


    {{-- ============================================================
         MAIN CONTENT
    ============================================================= --}}

    <main class="flex-grow">

        @yield('content')

    </main>


    {{-- ============================================================
         FOOTER
    ============================================================= --}}

    <footer
        class="mt-16
               bg-[#0B1F3A]
               text-slate-300
               py-12
               sm:py-16
               border-t
               border-[#1E73BE]/20"
    >

        <div
            class="container
                   mx-auto
                   px-4
                   sm:px-6
                   lg:px-8"
        >


            {{-- ====================================================
                 FOOTER BRAND ACCENT
            ===================================================== --}}

            <div
                class="flex
                       items-center
                       justify-center
                       gap-2
                       mb-10"
            >

                <span
                    class="w-10
                           h-1
                           rounded-full
                           bg-[#1E73BE]"
                ></span>

                <span
                    class="w-3
                           h-1
                           rounded-full
                           bg-[#E31837]"
                ></span>

                <span
                    class="text-xs
                           font-bold
                           uppercase
                           tracking-[0.2em]
                           text-blue-200"
                >
                    Moose Loon AI
                </span>

            </div>


            {{-- ====================================================
                 FOOTER GRID
            ===================================================== --}}

            <div
                class="grid
                       grid-cols-1
                       md:grid-cols-4
                       gap-10
                       lg:gap-12"
            >


                {{-- ==================================================
                     COMPANY INFO
                =================================================== --}}

                <div>

                    <h5
                        class="text-xs
                               font-bold
                               uppercase
                               tracking-[0.15em]
                               text-blue-300
                               mb-2"
                    >
                        North America
                    </h5>


                    <h3
                        class="text-sm
                               leading-relaxed
                               mt-3
                               font-semibold
                               text-white"
                    >
                        Moose Loon AI Business Solutions – Canada Office (Canada HQ)
                    </h3>


                    <p
                        class="text-sm
                               font-semibold
                               mb-2
                               mt-4
                               text-white"
                    >
                        🇨🇦 Edmonton Headquarters
                    </p>


                    <ul class="text-sm space-y-2">

                        <li class="flex items-start space-x-2">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5
                                       text-blue-300
                                       flex-shrink-0
                                       mt-0.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />

                            </svg>


                            <span class="leading-relaxed">

                                Executive, Technology & North American Division Serving Canada & the United States

                                📍 Moose Loon AI Solutions – Canada HQ, Edmonton
                                <br>

                                Website: www.mooseloonai.ca

                            </span>

                        </li>

                    </ul>

                </div>


                {{-- ==================================================
                     QUICK LINKS
                =================================================== --}}

                <div>

                    <h4
                        class="text-sm
                               font-bold
                               uppercase
                               tracking-[0.12em]
                               text-white
                               mb-5"
                    >
                        Quick Links
                    </h4>


                    <ul class="space-y-3">

                        <li>
                            <a
                                href="{{ route('home') }}"
                                class="hover:text-white
                                       hover:translate-x-1
                                       inline-block
                                       transition-all
                                       duration-200"
                            >
                                Home
                            </a>
                        </li>


                        <!--<li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Our Team</a></li>-->


                        <li>
                            <a
                                href="{{ route('services') }}"
                                class="hover:text-white
                                       hover:translate-x-1
                                       inline-block
                                       transition-all
                                       duration-200"
                            >
                                Services
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ route('pricing') }}"
                                class="hover:text-white
                                       hover:translate-x-1
                                       inline-block
                                       transition-all
                                       duration-200"
                            >
                                Curriculum
                            </a>
                        </li>


                        <!-- <li><a href="{{ route('careers') }}" class="hover:text-white transition-colors">Careers</a></li> -->


                        <li>
                            <a
                                href="{{ route('contact') }}"
                                class="hover:text-white
                                       hover:translate-x-1
                                       inline-block
                                       transition-all
                                       duration-200"
                            >
                                Contact
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ route('faqs') }}"
                                class="hover:text-white
                                       hover:translate-x-1
                                       inline-block
                                       transition-all
                                       duration-200"
                            >
                                FAQ's
                            </a>
                        </li>

                    </ul>

                </div>


                {{-- ==================================================
                     LEGAL
                =================================================== --}}

                <div>

                    <h4
                        class="text-sm
                               font-bold
                               uppercase
                               tracking-[0.12em]
                               text-white
                               mb-5"
                    >
                        Legal
                    </h4>


                    <ul class="space-y-3">

                        <li>
                            <a
                                href="{{ route('terms') }}"
                                class="hover:text-white
                                       hover:translate-x-1
                                       inline-block
                                       transition-all
                                       duration-200"
                            >
                                Terms of Service
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ route('policy') }}"
                                class="hover:text-white
                                       hover:translate-x-1
                                       inline-block
                                       transition-all
                                       duration-200"
                            >
                                Privacy Policy
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ route('contactus') }}"
                                class="hover:text-white
                                       hover:translate-x-1
                                       inline-block
                                       transition-all
                                       duration-200"
                            >
                                Get in Touch&#8599;
                            </a>
                        </li>


                        <!-- <li><a href="{{ route('careers') }}" class="hover:text-white transition-colors">Careers&#8599;</a></li> -->


                        <li>
                            <a
                                href="https://www.youtube.com/@MooseLoonAI"
                                class="hover:text-white
                                       hover:translate-x-1
                                       inline-block
                                       transition-all
                                       duration-200"
                            >
                                Watch our Content&#8599;
                            </a>
                        </li>

                    </ul>

                </div>


                {{-- ==================================================
                     KENYA OFFICE
                =================================================== --}}

                <div>

                    <h5
                        class="text-xs
                               font-bold
                               uppercase
                               tracking-[0.15em]
                               text-blue-300
                               mb-2"
                    >
                        East Africa
                    </h5>


                    <h3
                        class="text-sm
                               leading-relaxed
                               mt-3
                               font-semibold
                               text-white"
                    >
                        🇰🇪 Moose Loon AI Solutions – Nairobi Office (Kenya HQ)
                    </h3>


                    <p
                        class="text-sm
                               mt-2
                               leading-relaxed
                               text-slate-400"
                    >
                        Kipro Centre – WestLands, Nairobi, Kenya
                        <br>
                    </p>

                </div>

            </div>


            {{-- ====================================================
                 DIVIDER
            ===================================================== --}}

            <div
                class="border-t
                       border-white/10
                       mt-12"
            ></div>


            {{-- ====================================================
                 COPYRIGHT
            ===================================================== --}}

            <div
                class="mt-7
                       text-center
                       w-full"
            >

                <p
                    class="text-xs
                           sm:text-sm
                           text-slate-400"
                >
                    &copy; {{ date('Y') }} MooseLoon AI. All Rights Reserved.
                </p>

            </div>

        </div>

    </footer>


</div>


{{-- ================================================================
     TALK TO MOOSE LOON AI
================================================================ --}}

<div
    id="voice-call-modal"
    class="hidden"
>

    <div
        class="bg-white
               rounded-2xl
               shadow-2xl
               border
               border-slate-200
               p-6"
    >

        <h2
            class="text-xl
                   font-bold
                   mb-4
                   text-[#0B1F3A]"
        >
            Talk to Moose Loon AI
        </h2>


        <p
            id="status"
            class="mb-4
                   text-gray-600"
        >
            Click Start and speak.
        </p>


        <div class="flex justify-center space-x-2">

            <button
                id="start-btn"
                class="bg-[#0B1F3A]
                       hover:bg-[#12345C]
                       text-white
                       px-5
                       py-2.5
                       rounded-xl
                       font-semibold
                       shadow-sm
                       transition"
            >
                Start
            </button>


            <button
                id="stop-btn"
                class="bg-slate-100
                       hover:bg-slate-200
                       text-[#0B1F3A]
                       px-5
                       py-2.5
                       rounded-xl
                       font-semibold
                       transition"
                disabled
            >
                Stop
            </button>

        </div>

    </div>

</div>


</body>

</html>