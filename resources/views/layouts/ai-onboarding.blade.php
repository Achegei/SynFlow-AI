<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'AI Learning Assessment | Moose Loon AI Academy')
    </title>

    <meta
        name="description"
        content="Discover your personalized AI learning path with Moose Loon AI Academy."
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');

    fbq('init', '1055122183931015');
    fbq('track', 'PageView');
</script>

<noscript>
    <img
        height="1"
        width="1"
        style="display:none"
        src="https://www.facebook.com/tr?id=1055122183931015&ev=PageView&noscript=1"
    />
</noscript>
<!-- End Meta Pixel Code -->
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    {{-- =========================================================
         AI ONBOARDING HEADER
    ========================================================== --}}

    <header class="bg-white border-b border-gray-100">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="h-20 flex items-center justify-between">

                {{-- Logo / Brand --}}

                <a href="{{ url('/') }}" class="flex items-center">

                    <div class="text-xl sm:text-2xl font-bold tracking-tight">
                        Moose Loon
                        <span class="text-blue-600">AI</span>
                    </div>

                </a>


                {{-- Secure / Minimal Header --}}

                <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm10-11V7a4 4 0 00-8 0v3h8z"
                        />
                    </svg>

                    Personalized AI Learning

                </div>

            </div>

        </div>

    </header>


    {{-- =========================================================
         MAIN ONBOARDING CONTENT
    ========================================================== --}}

    <main>

        @yield('content')

    </main>


    {{-- =========================================================
         FOOTER
    ========================================================== --}}

    <footer class="py-8">

        <div class="max-w-6xl mx-auto px-4 text-center">

            <p class="text-xs text-gray-400">
                © {{ date('Y') }} Moose Loon AI Academy.
                All rights reserved.
            </p>

        </div>

    </footer>


    @stack('scripts')

</body>

</html>