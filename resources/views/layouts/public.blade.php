<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="csrf-token" content="{{ csrf_token() }}">


       <title>@yield('title', 'MooseLoon AI')</title>


       <link rel="preconnect" href="https://fonts.bunny.net">
       <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


       @vite(['resources/css/app.css', 'resources/js/app.js'])
   </head>
   <style>
    @keyframes slideIn {
        0% {
            opacity: 0;
            transform: translateX(-30px) scale(0.95);
        }
        60% {
            opacity: 1;
            transform: translateX(4px) scale(1.02);
        }
        100% {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        100% {
            opacity: 0;
            transform: translateY(6px) scale(0.96);
        }
    }

    /* Entry animation */
    .animate-slide-in {
        animation: slideIn 0.45s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: transform, opacity;
    }

    /* Exit animation */
    .animate-fade-out {
        animation: fadeOut 0.4s ease-in forwards;
        will-change: transform, opacity;
    }
    </style>


   <body class="font-sans antialiased bg-gray-50 text-gray-800">
       <div class="min-h-screen flex flex-col">
        <!-- Social Proof Toast Container -->
         <div
            id="social-proof-container"
            class="fixed bottom-5 left-5 z-50 pointer-events-none">
        </div>
           <header class="bg-white shadow-sm sticky top-0 z-50">
               <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                   <nav class="flex justify-between items-center h-16">
                       <div class="flex items-center">
                           <a href="{{ route('home') }}" class="flex items-center">
                               <img src="{{ asset('images/synflowlogo2.jpeg') }}" alt="SailRizon AI Logo" class="h-16 w-40 object-contain">
                           </a>
                       </div>




                       <div class="hidden md:flex space-x-8">
                           <a href="{{ route('home') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Home</a>
                           <a href="{{ route('about') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Our Team</a>
                           <a href="{{ route('services') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Services</a>
                           <a href="{{ route('pricing') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Pricing</a>
                           <a href="{{ route('careers') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Careers</a>
                        <!--<a href="{{ route('documentation') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Documentation</a>. -->
                           <a href="{{ route('contact') }}" class="text-indigo-700 hover:text-gray-700 transition-colors">Contact</a>
                       </div>


                       <!--<div class="hidden md:flex items-center space-x-4">
                           <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">Log in</a>
                           <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                               Register
                           </a>
                       </div> -->
                       <!--<div class="hidden md:flex items-center">

                            Canadian Phone
                            <a href="tel:+17808001824" class="flex items-center text-sm text-gray-700 hover:text-indigo-600">
            
                                🇨🇦 +1 (780) 800-1824
                            </a>

                            WhatsApp
                            <a href="https://wa.me/254768282146" target="_blank" class="flex items-center text-sm text-green-600 hover:text-green-700 ml-8">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 mr-1 fill-current">
                                    <path d="M256.064 0C114.844 0 0 114.836 0 256.064c0 45.16 11.656 89.3 33.792 128.248L0 512l132.78-34.732c37.42 20.46 79.62 31.248 123.284 31.248h.004C397.288 508.516 512 393.772 512 256.064 512 114.836 397.284 0 256.064 0zm149.956 362.676c-6.16 17.344-30.62 31.74-50.16 35.88-13.36 2.828-30.78 5.08-89.524-19.18-75.172-31.16-123.612-107.62-127.276-112.62-3.664-5-30.38-40.5-30.38-77.32s18.74-54.84 26.34-62.52c6.16-6.308 16.34-9.08 26.34-9.08 3.184 0 6.04.156 8.62.296 7.56.32 11.34.78 16.28 12.66 6.16 14.82 21.04 51.42 22.84 55.16 1.8 3.74 3.6 8.86 1.08 13.86-2.52 5-4.74 7.22-8.72 11.54-3.98 4.32-7.7 7.66-11.62 12.32-3.62 4.3-7.7 8.92-3.3 16.96 4.4 7.98 19.58 32.2 42 52.1 28.94 25.52 52.84 33.42 61.26 36.94 8.42 3.52 13.3 2.94 18.28-1.78 5.72-5.32 13.1-15.5 20.58-25.02 5.24-6.82 11.86-7.66 18.88-5.26 7.98 2.78 50.32 23.72 58.94 28.06 8.62 4.32 14.36 6.46 16.48 10.14 2.14 3.66 2.14 20.78-4.02 38.12z"/>
                                </svg>
                            </a>

                        </div> -->

                      
                       <!-- Mobile Hamburger Menu -->
<div class="md:hidden" x-data="{ open: false }">
    <!-- Hamburger button -->
    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-indigo-600 focus:outline-none">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

                <!-- Mobile Menu -->
                <div x-show="open" @click.away="open = false" class="absolute top-full left-0 w-full bg-white shadow-md flex flex-col space-y-2 py-4 px-4 z-40">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-indigo-600">Our Team</a>
                    <a href="{{ route('services') }}" class="text-gray-700 hover:text-indigo-600">Services</a>
                    <a href="{{ route('pricing') }}" class="text-gray-700 hover:text-indigo-600">Pricing</a>
                    <a href="{{ route('careers') }}" class="text-gray-700 hover:text-indigo-600">Careers</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-indigo-600">Contact</a>

                    <!-- Optional Contact Info -->
                    <!--<div class="flex flex-col space-y-2 mt-2">
                        <a href="tel:+17808001824" class="flex items-center text-gray-700 hover:text-indigo-600">
                            🇨🇦 +1 (780) 800-1824
                        </a>
                        <a href="https://wa.me/254768282146" target="_blank" class="flex items-center text-green-600 hover:text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 mr-1 fill-current">
                                <path d="M256.064 0C114.844 0 0 114.836 0 256.064c0 45.16 11.656 89.3 33.792 128.248L0 512l132.78-34.732c37.42 20.46 79.62 31.248 123.284 31.248h.004C397.288 508.516 512 393.772 512 256.064 512 114.836 397.284 0 256.064 0zm149.956 362.676c-6.16 17.344-30.62 31.74-50.16 35.88-13.36 2.828-30.78 5.08-89.524-19.18-75.172-31.16-123.612-107.62-127.276-112.62-3.664-5-30.38-40.5-30.38-77.32s18.74-54.84 26.34-62.52c6.16-6.308 16.34-9.08 26.34-9.08 3.184 0 6.04.156 8.62.296 7.56.32 11.34.78 16.28 12.66 6.16 14.82 21.04 51.42 22.84 55.16 1.8 3.74 3.6 8.86 1.08 13.86-2.52 5-4.74 7.22-8.72 11.54-3.98 4.32-7.7 7.66-11.62 12.32-3.62 4.3-7.7 8.92-3.3 16.96 4.4 7.98 19.58 32.2 42 52.1 28.94 25.52 52.84 33.42 61.26 36.94 8.42 3.52 13.3 2.94 18.28-1.78 5.72-5.32 13.1-15.5 20.58-25.02 5.24-6.82 11.86-7.66 18.88-5.26 7.98 2.78 50.32 23.72 58.94 28.06 8.62 4.32 14.36 6.46 16.48 10.14 2.14 3.66 2.14 20.78-4.02 38.12z"/>
                            </svg>
                            WhatsApp
                        </a>
                    </div> -->
                </div>
            </div>

                           <!-- Dark Mode Toggle -->
        <!--<div class="hidden md:flex items-center space-x-4">
            <button id="dark-mode-toggle" class="w-full text-left py-2 px-3 rounded-lg text-gray-700 hover:bg-gray-200">
                Dark Mode
            </button>
        </div> -->
                   </nav>
               </div>
           </header>


           <main class="flex-grow">
               @yield('content')
           </main>


           <!-- A modern, professional footer with multiple sections for links and contact info. -->
           <!-- Modern Footer -->
            <footer class="bg-gray-900 text-gray-300 mt-12 py-10 sm:py-16">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                    <!-- Footer Grid Sections -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                        <!-- Company Info Section -->
                        <div>
                            
                            <h5 class="text-sm font-semibold text-white mb-1">North America</h5>
                            <h3 class="text-sm leading-relaxed mt-3">Moose Loon AI Business Solutions – Toronto Office (Canada HQ)</h3>

                            <p class="text-sm font-semibold mb-1 mt-3">🇨🇦 Toronto Headquarters</p>
                            <ul class="text-sm space-y-1">
                                <li class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>Executive, Technology & North American Division Serving Canada & the United States
                                    📍 Moose Loon AI Solutions – Canada HQ Toronto, Ontario, Canada <br>
                                    Website: www.mooseloonai.ca</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-4">Quick Links</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                                <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Our Team</a></li>
                                <li><a href="{{ route('services') }}" class="hover:text-white transition-colors">Services</a></li>
                                <li><a href="{{ route('pricing') }}" class="hover:text-white transition-colors">Pricing</a></li>
                                <li><a href="{{ route('careers') }}" class="hover:text-white transition-colors">Careers</a></li>
                                <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                                <li><a href="{{ route('faqs') }}" class="hover:text-white transition-colors">FAQ's</a></li>
                            </ul>
                        </div>

                        <!-- Legal -->
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-4">Legal</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms of Service</a></li>
                                <li><a href="{{ route('policy') }}" class="hover:text-white transition-colors">Privacy Policy</a></li>
                                <li><a href="{{ route('contactus') }}" class="hover:text-white transition-colors">Get in Touch&#8599;</a></li>
                                <li><a href="{{ route('careers') }}" class="hover:text-white transition-colors">Careers&#8599;</a></li>
                                <li><a href="https://www.youtube.com/@MooseLoonAI" class="hover:text-white transition-colors">Watch our Content&#8599;</a></li>
                            </ul>
                        </div>

                        <!-- Kenya Office -->
                        <div>
                            <h5 class="text-sm font-semibold text-white mb-1">East Africa</h5>

                            <h3 class="text-sm leading-relaxed mt-3">🇰🇪 Moose Loon AI Solutions – Nairobi Office (Kenya HQ)</h3>
                            <p class="text-sm mt-1">
                               Delta Corner Tower 2 – Westlands
                                14th Floor, Delta Corner Tower 2
                                Waiyaki Way, Westlands
                                Nairobi, Kenya
                            </p>
                        </div>

                    </div>

                    <!-- Divider Line -->
                    <div class="border-t border-gray-700 mt-10"></div>

                    <!-- Centered Copyright -->
                    <div class="mt-6 text-center w-full">
                        <p class="text-sm text-gray-400">&copy; {{ date('Y') }} MooseLoon AI. All Rights Reserved.</p>
                    </div>

                </div>
            </footer>

       </div>
   </body>
</html>
 <script>
document.addEventListener('DOMContentLoaded', () => {
    let toastActive = false;

    async function showSocialProofToast() {
        if (toastActive) return;

        try {
            const response = await fetch('/social-proof', {
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) return;

            const data = await response.json();
            if (!data.name || !data.county) return;

            const toast = document.createElement('div');
            toast.className = `
                relative
                bg-gradient-to-r from-green-500 to-emerald-600
                text-white
                shadow-2xl shadow-green-500/40
                rounded-2xl
                px-4 py-3
                max-w-xs
                animate-slide-in
            `;

            toast.innerHTML = `
                <div class="flex items-start gap-3">
                    <!-- Icon -->
                    <div class="flex-shrink-0">
                        <div class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center animate-pulse">
                            ✅
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="text-sm leading-snug">
                        <p class="font-semibold">
                            ${data.name}
                            <span class="font-normal text-green-100">
                                from ${data.county} County
                            </span>
                        </p>

                        <p class="text-green-50 text-xs mt-1">
                            ${data.message}
                        </p>

                        <p class="text-[11px] text-green-200 mt-1">
                            Moose Loon AI · Just now
                        </p>
                    </div>
                </div>
            `;

            const container = document.getElementById('social-proof-container');
            if (!container) return;

            container.appendChild(toast);
            toastActive = true;

            // Auto-dismiss
            setTimeout(() => {
                toast.classList.add('animate-fade-out');
                setTimeout(() => {
                    toast.remove();
                    toastActive = false;
                }, 400);
            }, 5000);

        } catch (error) {
            console.error('Social proof error:', error);
        }
    }

    // First toast after short delay
    setTimeout(showSocialProofToast, 4000);

    // Then randomly every 15–30 seconds
    setInterval(showSocialProofToast, Math.random() * 15000 + 15000);
});
</script>
