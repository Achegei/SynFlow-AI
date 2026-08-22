{{-- ================================================================
     MOOSE LOON AI ACADEMY
     MAIN APPLICATION / PUBLIC LAYOUT
     CLEAN CORPORATE VERSION
================================================================ --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @yield('title', 'MooseLoon AI Academy')
    </title>


    {{-- ============================================================
         META
    ============================================================= --}}

    <meta
        name="description"
        content="@yield('description', 'Moose Loon AI Academy — practical artificial intelligence, automation and digital technology training.')"
    >


    {{-- ============================================================
         FONTS
    ============================================================= --}}

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800"
        rel="stylesheet"
    >


    {{-- ============================================================
         APPLICATION ASSETS
    ============================================================= --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    {{-- ============================================================
         GLOBAL STYLES
    ============================================================= --}}

    <style>

        :root {

            --ml-navy: #0B1F3A;

            --ml-blue: #1E73BE;

            --ml-red: #E31837;

            --ml-soft: #F7FAFC;

        }


        html {

            scroll-behavior: smooth;

        }


        body {

            overflow-x: hidden;

        }


        [x-cloak] {

            display: none !important;

        }


        /* ==========================================================
           MOBILE MENU
        ========================================================== */

        .mobile-menu {

            border-top:
                1px solid
                #e2e8f0;

        }


        /* ==========================================================
           HEADER
        ========================================================== */

        .site-header {

            box-shadow:
                0 4px 20px
                rgba(11, 31, 58, 0.05);

        }


        /* ==========================================================
           NAVIGATION
        ========================================================== */

        .nav-link {

            position: relative;

        }


        .nav-link::after {

            content: "";

            position: absolute;

            left: 0;

            right: 0;

            bottom: -8px;

            height: 2px;

            background:
                var(--ml-red);

            transform:
                scaleX(0);

            transform-origin:
                center;

            transition:
                transform
                200ms
                ease;

        }


        .nav-link:hover::after {

            transform:
                scaleX(1);

        }


        /* ==========================================================
           ACCESSIBILITY
        ========================================================== */

        :focus-visible {

            outline:
                3px solid
                rgba(30, 115, 190, 0.35);

            outline-offset: 3px;

        }


        /* ==========================================================
           VOICE MODAL
        ========================================================== */

        #voice-call-modal {

            position: fixed;

            inset: 0;

            z-index: 99998;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background:
                rgba(11, 31, 58, 0.60);

            backdrop-filter:
                blur(8px);

        }


        #voice-call-modal.hidden {

            display: none;

        }

    </style>


    @stack('styles')

</head>


<body
    class="
        font-sans
        antialiased
        text-[#0B1F3A]
        bg-[#F7FAFC]
    "
>


<div class="min-h-screen flex flex-col">


    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <header
        class="
            site-header
            sticky
            top-0
            z-50
            bg-white
            border-b
            border-slate-200
        "
    >

        <nav
            x-data="{ open: false }"
            class="relative bg-white"
        >

            <div
                class="
                    max-w-7xl
                    mx-auto
                    px-4
                    sm:px-6
                    lg:px-8
                "
            >

                <div
                    class="
                        flex
                        items-center
                        justify-between
                        min-h-[78px]
                    "
                >


                    {{-- ==================================================
                         BRAND
                    =================================================== --}}

                    <div class="flex items-center min-w-0">

                        <a
                            href="{{ route('home') }}"
                            class="
                                flex
                                items-center
                                flex-shrink-0
                                group
                            "
                        >

                            <div>

                                <div
                                    class="
                                        text-base
                                        sm:text-lg
                                        font-extrabold
                                        tracking-tight
                                        text-[#0B1F3A]
                                        group-hover:text-[#1E73BE]
                                        transition-colors
                                        duration-200
                                    "
                                >
                                    Moose Loon AI
                                </div>


                                <div
                                    class="
                                        text-[9px]
                                        sm:text-[10px]
                                        uppercase
                                        tracking-[0.18em]
                                        font-bold
                                        text-slate-400
                                        mt-1
                                    "
                                >
                                    Academy
                                </div>

                            </div>

                        </a>


                        {{-- ==================================================
                             DESKTOP NAVIGATION
                        =================================================== --}}

                        <div
                            class="
                                hidden
                                lg:flex
                                items-center
                                gap-7
                                ml-10
                            "
                        >

                            <a
                                href="{{ route('home') }}"
                                class="
                                    nav-link
                                    py-2
                                    text-sm
                                    font-semibold
                                    text-[#0B1F3A]
                                    hover:text-[#1E73BE]
                                    transition-colors
                                    duration-200
                                "
                            >
                                Home
                            </a>


                            <a
                                href="{{ route('services') }}"
                                class="
                                    nav-link
                                    py-2
                                    text-sm
                                    font-semibold
                                    text-[#0B1F3A]
                                    hover:text-[#1E73BE]
                                    transition-colors
                                    duration-200
                                "
                            >
                                Services
                            </a>


                            <a
                                href="{{ route('pricing') }}"
                                class="
                                    nav-link
                                    py-2
                                    text-sm
                                    font-semibold
                                    text-[#0B1F3A]
                                    hover:text-[#1E73BE]
                                    transition-colors
                                    duration-200
                                "
                            >
                                Curriculum
                            </a>


                            <a
                                href="{{ route('ai.onboarding.step', ['step' => 1]) }}"
                                class="
                                    inline-flex
                                    items-center
                                    px-4
                                    py-2
                                    rounded-full
                                    text-sm
                                    font-bold
                                    text-white
                                    bg-[#1E73BE]
                                    hover:bg-[#175D9A]
                                    shadow-sm
                                    hover:shadow-md
                                    transition-all
                                    duration-200
                                "
                            >
                                Start Learning
                            </a>


                            <a
                                href="{{ route('certificate.verify') }}"
                                class="
                                    nav-link
                                    py-2
                                    text-sm
                                    font-bold
                                    text-[#E31837]
                                    hover:text-[#C4122D]
                                    transition-colors
                                    duration-200
                                "
                            >
                                Verify Certificate
                            </a>


                            <a
                                href="{{ route('partners.page') }}"
                                class="
                                    nav-link
                                    py-2
                                    text-sm
                                    font-semibold
                                    text-[#0B1F3A]
                                    hover:text-[#1E73BE]
                                    transition-colors
                                    duration-200
                                "
                            >
                                Partner With Us
                            </a>


                            <a
                                href="{{ route('contact') }}"
                                class="
                                    nav-link
                                    py-2
                                    text-sm
                                    font-semibold
                                    text-[#0B1F3A]
                                    hover:text-[#1E73BE]
                                    transition-colors
                                    duration-200
                                "
                            >
                                Contact
                            </a>

                        </div>

                    </div>


                    {{-- ==================================================
                         LOGIN
                    =================================================== --}}

                    <div
                        class="
                            hidden
                            md:flex
                            items-center
                        "
                    >

                        <a
                            href="{{ route('login') }}"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                px-6
                                py-2.5
                                rounded-full
                                bg-[#0B1F3A]
                                text-white
                                text-sm
                                font-bold
                                shadow-md
                                hover:bg-[#12345C]
                                hover:shadow-lg
                                transition-all
                                duration-200
                            "
                        >
                            Login
                        </a>

                    </div>


                    {{-- ==================================================
                         MOBILE MENU BUTTON
                    =================================================== --}}

                    <div
                        class="
                            flex
                            lg:hidden
                            items-center
                        "
                    >

                        <button
                            @click="open = !open"
                            type="button"
                            aria-label="Toggle navigation menu"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                w-11
                                h-11
                                rounded-xl
                                text-[#0B1F3A]
                                hover:text-[#1E73BE]
                                hover:bg-[#F4FAFE]
                                transition-all
                                duration-200
                            "
                        >

                            <span
                                x-show="!open"
                                class="
                                    text-xl
                                    leading-none
                                    font-semibold
                                "
                            >
                                ☰
                            </span>


                            <span
                                x-show="open"
                                x-cloak
                                class="
                                    text-xl
                                    leading-none
                                    font-semibold
                                "
                            >
                                ×
                            </span>

                        </button>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                 MOBILE NAVIGATION
            ========================================================= --}}

            <div
                x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                @click.away="open = false"
                class="
                    mobile-menu
                    absolute
                    top-full
                    left-0
                    right-0
                    bg-white
                    shadow-xl
                    lg:hidden
                "
            >

                <div
                    class="
                        max-w-7xl
                        mx-auto
                        px-4
                        py-5
                    "
                >

                    <div class="space-y-1">


                        <a
                            href="{{ route('home') }}"
                            @click="open = false"
                            class="
                                flex
                                items-center
                                px-4
                                py-3
                                rounded-xl
                                text-[#0B1F3A]
                                font-semibold
                                hover:bg-[#F4FAFE]
                                hover:text-[#1E73BE]
                                transition
                            "
                        >
                            Home
                        </a>


                        <a
                            href="{{ route('services') }}"
                            @click="open = false"
                            class="
                                flex
                                items-center
                                px-4
                                py-3
                                rounded-xl
                                text-[#0B1F3A]
                                font-semibold
                                hover:bg-[#F4FAFE]
                                hover:text-[#1E73BE]
                                transition
                            "
                        >
                            Services
                        </a>


                        <a
                            href="{{ route('pricing') }}"
                            @click="open = false"
                            class="
                                flex
                                items-center
                                px-4
                                py-3
                                rounded-xl
                                text-[#0B1F3A]
                                font-semibold
                                hover:bg-[#F4FAFE]
                                hover:text-[#1E73BE]
                                transition
                            "
                        >
                            Curriculum
                        </a>


                        <a
                            href="{{ route('ai.onboarding.step', ['step' => 1]) }}"
                            @click="open = false"
                            class="
                                flex
                                items-center
                                justify-center
                                px-4
                                py-3
                                mt-2
                                rounded-xl
                                bg-[#1E73BE]
                                text-white
                                font-bold
                                shadow-sm
                                hover:bg-[#175D9A]
                                transition
                            "
                        >
                            Start Learning
                        </a>


                        <a
                            href="{{ route('certificate.verify') }}"
                            @click="open = false"
                            class="
                                flex
                                items-center
                                px-4
                                py-3
                                rounded-xl
                                text-[#E31837]
                                font-bold
                                hover:bg-red-50
                                transition
                            "
                        >
                            Verify Certificate
                        </a>


                        <a
                            href="{{ route('partners.page') }}"
                            @click="open = false"
                            class="
                                flex
                                items-center
                                px-4
                                py-3
                                rounded-xl
                                text-[#0B1F3A]
                                font-semibold
                                hover:bg-[#F4FAFE]
                                hover:text-[#1E73BE]
                                transition
                            "
                        >
                            Partner With Us
                        </a>


                        <a
                            href="{{ route('contact') }}"
                            @click="open = false"
                            class="
                                flex
                                items-center
                                px-4
                                py-3
                                rounded-xl
                                text-[#0B1F3A]
                                font-semibold
                                hover:bg-[#F4FAFE]
                                hover:text-[#1E73BE]
                                transition
                            "
                        >
                            Contact
                        </a>

                    </div>


                    <div class="mt-4 pt-4 border-t border-slate-100">

                        <a
                            href="{{ route('login') }}"
                            @click="open = false"
                            class="
                                block
                                w-full
                                px-4
                                py-3
                                rounded-xl
                                bg-[#0B1F3A]
                                text-white
                                font-bold
                                text-center
                                hover:bg-[#12345C]
                                transition
                            "
                        >
                            Login
                        </a>

                    </div>

                </div>

            </div>

        </nav>

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
        class="
            mt-16
            bg-[#0B1F3A]
            text-slate-300
            border-t
            border-[#1E73BE]/20
        "
    >

        <div
            class="
                max-w-7xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8
                py-12
                sm:py-16
            "
        >


            {{-- ====================================================
                 FOOTER BRAND
            ===================================================== --}}

            <div
                class="
                    text-center
                    mb-12
                "
            >

                <div
                    class="
                        text-lg
                        font-extrabold
                        tracking-tight
                        text-white
                    "
                >
                    Moose Loon AI
                </div>


                <div
                    class="
                        mt-2
                        text-xs
                        font-semibold
                        uppercase
                        tracking-[0.18em]
                        text-blue-200
                    "
                >
                    Academy
                </div>

            </div>


            {{-- ====================================================
                 FOOTER GRID
            ===================================================== --}}

            <div
                class="
                    grid
                    grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4
                    gap-10
                    lg:gap-12
                "
            >


                {{-- ==================================================
                     NORTH AMERICA
                =================================================== --}}

                <div>

                    <div
                        class="
                            text-xs
                            font-bold
                            uppercase
                            tracking-[0.15em]
                            text-blue-300
                            mb-3
                        "
                    >
                        North America
                    </div>


                    <h3
                        class="
                            text-sm
                            leading-relaxed
                            font-bold
                            text-white
                        "
                    >
                        Moose Loon AI Business Solutions
                    </h3>


                    <p
                        class="
                            text-sm
                            font-semibold
                            text-white
                            mt-4
                            mb-3
                        "
                    >
                        Canada Office
                    </p>


                    <p
                        class="
                            text-sm
                            leading-relaxed
                            text-slate-400
                        "
                    >
                        Executive, Technology & North American Division
                        serving Canada and the United States.
                    </p>


                    <p
                        class="
                            text-sm
                            leading-relaxed
                            text-slate-400
                            mt-3
                        "
                    >
                        Moose Loon AI Solutions – Canada HQ, Edmonton
                    </p>


                    <p
                        class="
                            text-sm
                            text-blue-200
                            mt-3
                        "
                    >
                        www.mooseloonai.ca
                    </p>

                </div>


                {{-- ==================================================
                     QUICK LINKS
                =================================================== --}}

                <div>

                    <h4
                        class="
                            text-sm
                            font-bold
                            uppercase
                            tracking-[0.12em]
                            text-white
                            mb-5
                        "
                    >
                        Quick Links
                    </h4>


                    <ul class="space-y-3">


                        <li>

                            <a
                                href="{{ route('home') }}"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Home
                            </a>

                        </li>


                        <li>

                            <a
                                href="{{ route('services') }}"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Services
                            </a>

                        </li>


                        <li>

                            <a
                                href="{{ route('pricing') }}"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Curriculum
                            </a>

                        </li>


                        <li>

                            <a
                                href="{{ route('ai.onboarding.step', ['step' => 1]) }}"
                                class="
                                    inline-block
                                    text-blue-300
                                    font-semibold
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Start Learning
                            </a>

                        </li>


                        <li>

                            <a
                                href="{{ route('certificate.verify') }}"
                                class="
                                    inline-block
                                    text-red-300
                                    font-semibold
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Verify Certificate
                            </a>

                        </li>


                        <li>

                            <a
                                href="{{ route('partners.page') }}"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Partner with Us
                            </a>

                        </li>


                        <li>

                            <a
                                href="{{ route('contact') }}"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Contact
                            </a>

                        </li>


                        <li>

                            <a
                                href="{{ route('faqs') }}"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                FAQs
                            </a>

                        </li>

                    </ul>

                </div>


                {{-- ==================================================
                     LEGAL
                =================================================== --}}

                <div>

                    <h4
                        class="
                            text-sm
                            font-bold
                            uppercase
                            tracking-[0.12em]
                            text-white
                            mb-5
                        "
                    >
                        Legal
                    </h4>


                    <ul class="space-y-3">


                        <li>

                            <a
                                href="{{ route('terms') }}"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Terms of Service
                            </a>

                        </li>


                        <li>

                            <a
                                href="{{ route('policy') }}"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Privacy Policy
                            </a>

                        </li>


                        <li>

                            <a
                                href="{{ route('contactus') }}"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Get in Touch
                            </a>

                        </li>


                        <!--<li>

                            <a
                                href="https://www.youtube.com/@MooseLoonAI"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="
                                    inline-block
                                    hover:text-white
                                    hover:translate-x-1
                                    transition-all
                                    duration-200
                                "
                            >
                                Watch our Content
                            </a>

                        </li>-->

                    </ul>

                </div>


                {{-- ==================================================
                     EAST AFRICA
                =================================================== --}}

                <div>

                    <div
                        class="
                            text-xs
                            font-bold
                            uppercase
                            tracking-[0.15em]
                            text-blue-300
                            mb-3
                        "
                    >
                        East Africa
                    </div>


                    <h3
                        class="
                            text-sm
                            leading-relaxed
                            font-bold
                            text-white
                        "
                    >
                        Moose Loon AI Solutions
                    </h3>


                    <p
                        class="
                            text-sm
                            font-semibold
                            text-white
                            mt-3
                        "
                    >
                        Nairobi Office
                    </p>


                    <p
                        class="
                            text-sm
                            leading-relaxed
                            text-slate-400
                            mt-3
                        "
                    >
                        Kipro Centre – Westlands,
                        Nairobi, Kenya
                    </p>


                    <a
                        href="{{ route('contact') }}"
                        class="
                            inline-flex
                            items-center
                            mt-5
                            px-4
                            py-2
                            rounded-full
                            border
                            border-[#1E73BE]/50
                            text-blue-200
                            text-sm
                            font-semibold
                            hover:bg-[#1E73BE]
                            hover:text-white
                            transition-all
                            duration-200
                        "
                    >
                        Contact Our Team
                    </a>

                </div>

            </div>


            {{-- ====================================================
                 FOOTER DIVIDER
            ===================================================== --}}

            <div
                class="
                    border-t
                    border-white/10
                    mt-12
                    pt-7
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        sm:flex-row
                        items-center
                        justify-between
                        gap-4
                    "
                >

                    <p
                        class="
                            text-xs
                            sm:text-sm
                            text-slate-400
                            text-center
                            sm:text-left
                        "
                    >
                        &copy; {{ date('Y') }}
                        MooseLoon AI.
                        All Rights Reserved.
                    </p>


                    <p
                        class="
                            text-xs
                            text-slate-500
                            text-center
                            sm:text-right
                        "
                    >
                        Artificial Intelligence · Automation · Digital Skills
                    </p>

                </div>

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
        class="
            w-full
            max-w-md
            bg-white
            rounded-3xl
            shadow-2xl
            border
            border-slate-200
            p-7
        "
    >

        <div
            class="
                flex
                items-start
                justify-between
                gap-4
                mb-5
            "
        >

            <div>

                <div
                    class="
                        text-xs
                        font-bold
                        uppercase
                        tracking-[0.15em]
                        text-[#1E73BE]
                        mb-2
                    "
                >
                    Voice Assistant
                </div>


                <h2
                    class="
                        text-xl
                        sm:text-2xl
                        font-extrabold
                        text-[#0B1F3A]
                    "
                >
                    Talk to Moose Loon AI
                </h2>

            </div>

        </div>


        <p
            id="status"
            class="
                mb-6
                text-sm
                leading-relaxed
                text-slate-600
                bg-slate-50
                rounded-xl
                px-4
                py-3
            "
        >
            Click Start and speak.
        </p>


        <div
            class="
                flex
                justify-center
                gap-3
            "
        >

            <button
                id="start-btn"
                type="button"
                class="
                    bg-[#0B1F3A]
                    hover:bg-[#12345C]
                    text-white
                    px-6
                    py-2.5
                    rounded-xl
                    font-bold
                    shadow-sm
                    hover:shadow-md
                    transition-all
                    duration-200
                "
            >
                Start
            </button>


            <button
                id="stop-btn"
                type="button"
                class="
                    bg-slate-100
                    hover:bg-slate-200
                    text-[#0B1F3A]
                    px-6
                    py-2.5
                    rounded-xl
                    font-bold
                    transition
                "
                disabled
            >
                Stop
            </button>

        </div>

    </div>

</div>


@stack('scripts')

</body>

</html>