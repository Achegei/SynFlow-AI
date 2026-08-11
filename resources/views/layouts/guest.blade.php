<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Moose Loon AI Academy') }}
    </title>

    {{-- ============================================================
         FONTS
    ============================================================= --}}

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap"
        rel="stylesheet"
    />

    {{-- ============================================================
         VITE
    ============================================================= --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body
    class="
        min-h-screen
        font-sans
        antialiased
        text-slate-900
        bg-[#061638]
    "
>

    {{-- ============================================================
         BRANDED AUTHENTICATION ENVIRONMENT
    ============================================================= --}}

    <div
        class="
            min-h-screen
            relative
            overflow-hidden
            flex
            flex-col
        "
    >

        {{-- ========================================================
             BACKGROUND BRAND ELEMENTS
        ========================================================= --}}

        <div
            class="absolute inset-0 pointer-events-none overflow-hidden"
            aria-hidden="true"
        >

            {{-- Blue glow --}}
            <div
                class="
                    absolute
                    -top-48
                    -left-48
                    w-[550px]
                    h-[550px]
                    rounded-full
                    bg-[#123A78]
                    opacity-50
                    blur-3xl
                "
            ></div>


            {{-- Red glow --}}
            <div
                class="
                    absolute
                    top-1/3
                    -right-48
                    w-[500px]
                    h-[500px]
                    rounded-full
                    bg-[#D71920]
                    opacity-20
                    blur-3xl
                "
            ></div>


            {{-- Bottom blue glow --}}
            <div
                class="
                    absolute
                    -bottom-64
                    left-1/3
                    w-[650px]
                    h-[650px]
                    rounded-full
                    bg-[#0B2554]
                    opacity-70
                    blur-3xl
                "
            ></div>

        </div>


        {{-- ========================================================
             HEADER
        ========================================================= --}}

        <header
            class="
                relative
                z-10
                w-full
                border-b
                border-white/10
                bg-[#061638]/95
                backdrop-blur-md
            "
        >

            <div
                class="
                    w-full
                    max-w-7xl
                    mx-auto
                    px-4
                    sm:px-6
                    lg:px-8
                    py-4
                    sm:py-5
                "
            >

                <div
                    class="
                        flex
                        items-center
                        justify-between
                        gap-4
                    "
                >

                    {{-- =================================================
                         LOGO / BRAND
                    ================================================== --}}

                    <a
                        href="{{ url('/') }}"
                        class="
                            flex
                            items-center
                            gap-3
                            min-w-0
                            group
                        "
                    >

                        {{-- Logo container --}}
                        <div
                            class="
                                flex
                                items-center
                                justify-center
                                w-11
                                h-11
                                sm:w-12
                                sm:h-12
                                flex-shrink-0
                                rounded-xl
                                bg-white
                                shadow-lg
                                overflow-hidden
                                ring-1
                                ring-white/20
                            "
                        >

                            {{-- 
                                Moose Loon AI Academy Logo

                                IMPORTANT:
                                This assumes the logo is located at:

                                public/images/moose-loon-ai-logo.png

                                If your actual logo filename is different,
                                change only the asset path below.
                            --}}

                            <img
                                src="{{ asset('images/moose-loon-ai-logo.png') }}"
                                alt="Moose Loon AI Academy"
                                class="
                                    w-full
                                    h-full
                                    object-contain
                                    p-1
                                "
                                onerror="
                                    this.style.display='none';
                                    this.nextElementSibling.style.display='flex';
                                "
                            >


                            {{-- Logo fallback --}}
                            <div
                                class="
                                    hidden
                                    w-full
                                    h-full
                                    items-center
                                    justify-center
                                    bg-white
                                    text-[#061638]
                                    font-extrabold
                                    text-lg
                                "
                            >
                                ML
                            </div>

                        </div>


                        {{-- Brand name --}}
                        <div
                            class="
                                min-w-0
                                leading-tight
                            "
                        >

                            <div
                                class="
                                    text-white
                                    font-extrabold
                                    tracking-tight
                                    text-base
                                    sm:text-lg
                                    truncate
                                "
                            >
                                MOOSE LOON
                                <span class="text-[#D71920]">
                                    AI
                                </span>
                            </div>


                            <div
                                class="
                                    mt-0.5
                                    text-[#2F6BFF]
                                    text-[9px]
                                    sm:text-[10px]
                                    font-bold
                                    tracking-[0.2em]
                                "
                            >
                                ACADEMY
                            </div>

                        </div>

                    </a>


                    {{-- =================================================
                         RIGHT SIDE BRAND MESSAGE
                    ================================================== --}}

                    <div
                        class="
                            hidden
                            sm:flex
                            items-center
                            gap-2
                            text-xs
                            font-medium
                            text-white/60
                        "
                    >

                        <span
                            class="
                                w-2
                                h-2
                                rounded-full
                                bg-[#D71920]
                            "
                        ></span>

                        Canadian Practical AI Skills

                    </div>

                </div>

            </div>

        </header>


        {{-- ========================================================
             MAIN AUTHENTICATION AREA
        ========================================================= --}}

        <main
            class="
                relative
                z-10
                flex-1
                w-full
                px-4
                sm:px-6
                lg:px-8
                py-8
                sm:py-10
                lg:py-14
            "
        >

            <div
                class="
                    w-full
                    max-w-6xl
                    mx-auto
                "
            >

                {{-- =================================================
                     AUTH CARD
                ================================================== --}}

                <div
                    class="
                        w-full
                        bg-white
                        rounded-2xl
                        sm:rounded-3xl
                        shadow-2xl
                        overflow-hidden
                        border
                        border-white/20
                    "
                >

                    {{-- 
                        DO NOT REMOVE THIS.

                        Laravel Breeze / Blade authentication views
                        render their content through $slot.
                    --}}

                    {{ $slot }}

                </div>

            </div>

        </main>


        {{-- ========================================================
             FOOTER
        ========================================================= --}}

        <footer
            class="
                relative
                z-10
                w-full
                border-t
                border-white/10
            "
        >

            <div
                class="
                    w-full
                    max-w-7xl
                    mx-auto
                    px-4
                    sm:px-6
                    lg:px-8
                    py-5
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        sm:flex-row
                        items-center
                        justify-between
                        gap-2
                        text-center
                        sm:text-left
                    "
                >

                    <p
                        class="
                            text-[11px]
                            sm:text-xs
                            text-white/45
                        "
                    >
                        © {{ date('Y') }}
                        Moose Loon AI Academy.
                        All rights reserved.
                    </p>


                    <p
                        class="
                            text-[11px]
                            sm:text-xs
                            text-white/45
                        "
                    >
                        Canadian Practical AI skills for the modern workforce
                    </p>

                </div>

            </div>

        </footer>

    </div>

</body>

</html>