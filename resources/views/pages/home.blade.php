@extends('layouts.public')

@section('title', 'Home - MooseLoon AI')
<style>
/* CSS for the sliding animation */
@keyframes slide {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.animate-slide {
    animation: slide 30s linear infinite;
}

/* Accordion transition */
.accordion-content {
    transition: max-height 0.3s ease-in-out;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}
/* Floating card */
@keyframes float {
    0%,100% { transform: translateY(-50%) translateX(-50%); }
    50% { transform: translateY(calc(-50% - 8px)) translateX(-50%); }
}
.animate-float {
    animation: float 4s ease-in-out infinite;
}

/* Dashboard zoom */
@keyframes zoomGlow {
    0%,100% { transform: scale(1); }
    50% { transform: scale(1.04); }
}
.animate-zoom-glow {
    animation: zoomGlow 6s ease-in-out infinite;
}

/* Glow pulse */
@keyframes glow {
    0%,100% { opacity: 0.2; }
    50% { opacity: 0.5; }
}
.animate-glow {
    animation: glow 4s ease-in-out infinite;
}

@keyframes floatSlow {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

.animate-float-slow {
    animation: floatSlow 6s ease-in-out infinite;
}
</style>

@section('content')
        <section class="relative min-h-screen bg-gray-950 flex items-center justify-center px-4 sm:px-6 lg:px-8 overflow-hidden">

            <!-- Background -->
            <div class="absolute inset-0">
                <img src="{{ asset('images/aiherobg.jpg') }}" 
                    class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/60 to-black"></div>
            </div>

            <div class="relative z-10 max-w-5xl text-center">

                <!-- Headline -->
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight">
                    Customers message. Call for details. Confirm later.
                    <span class="block text-indigo-500 mt-2">
                        Can your business keep up?
                    </span>
                </h1>

                <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto">
                    MooseLoon AI unifies your conversations, automates responses, and captures every lead —
                    so you never lose a customer across WhatsApp, calls, or chat.
                </p>

                <!-- CTA -->
                <div class="mt-8 flex justify-center gap-4 flex-wrap">
                    <a href="{{route('contactus')}}" class="px-6 py-3 bg-gray-800 text-white rounded-lg border border-gray-600 hover:bg-gray-700 transition">
                        Talk to Sales
                    </a>

                    <a href="{{route('contactus')}}" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:bg-indigo-700 transition">
                        Start Free Trial
                    </a>
                </div>

                <p class="mt-6 text-sm text-gray-400">
                    ⭐⭐⭐⭐⭐ Helping businesses automate & increase bookings
                </p>

                <!-- PRODUCT -->
                <div class="mt-16 relative flex justify-center">

                    <!-- Animated Dashboard -->
                    <div class="relative">
                        <img src="{{ asset('images/dashboard.png') }}" 
                            class="rounded-xl border border-gray-800 shadow-2xl animate-zoom-glow">

                        <!-- Glow layer -->
                        <div class="absolute inset-0 rounded-xl blur-2xl opacity-30 bg-indigo-500 animate-glow"></div>
                    </div>

                    <!-- FLOATING CARD -->
                    <div class="absolute top-[45%] left-[40%] 
                                -translate-x-1/2 -translate-y-1/2
                                bg-white/95 backdrop-blur-md rounded-xl shadow-2xl p-6 
                                w-[90%] sm:w-[420px] animate-float">

                        <div class="text-left">

                            <!-- 🔥 FIXED WORKFLOW ANIMATION -->
                            <div class="flex items-center justify-center gap-4 mb-4">

                                <div class="flex gap-2">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-xs">W</div>
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs">C</div>
                                </div>

                                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold animate-pulse">
                                    AI
                                </div>

                                <div class="flex gap-2">
                                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white text-xs">CRM</div>
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white text-xs">B</div>
                                </div>

                            </div>

                            <!-- TEXT -->
                            <h3 class="text-lg font-bold text-gray-900">
                                Explore MooseLoon AI
                            </h3>

                            <p class="mt-2 text-sm text-gray-600">
                                Explore the Power of Moose Loon AI
                            </p>

                            <p class="mt-2 text-sm text-gray-600">
                                Sell smarter, strengthen relationships, and respond faster. All from one inbox. Experience it instantly, no sign-up needed.
                            </p>

                            <button class="mt-4 w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition">
                                <a href="{{ route('contactus') }}" class="text-white no-underline">✨ Start Interactive Demo</a>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Scale Business Growth Section -->
    <section class="py-20 bg-gray-950 text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- LEFT CONTENT -->
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold leading-tight">
                    Scale business growth with every customer conversation
                </h2>

                <p class="mt-6 text-gray-300 text-lg">
                    As chats and calls multiply, old inboxes and workflows break. MooseLoon AI helps you manage the entire customer journey across every channel in one place — even at high volume.
                </p>

                <!-- FEATURES -->
                <div class="mt-8 space-y-6">

                    <div>
                        <h4 class="font-semibold text-indigo-400">Capture</h4>
                        <p class="text-gray-300">Unify customer touch points to drive revenue</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-indigo-400">Convert</h4>
                        <p class="text-gray-300">Sell more with AI and analytics</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-indigo-400">Retain</h4>
                        <p class="text-gray-300">Build recurring revenue, not just one-time sales</p>
                    </div>

                </div>

                <p class="mt-8 text-gray-400">
                    Acquiring customers is costly — keeping them fuels sustainable growth. With full context at your fingertips, every follow-up feels personal, from targeted broadcasts and renewal reminders to in-chat CSAT surveys. Earn a reputation for reliability that turns one-time buyers into repeat customers.
                </p>
            </div>

            <!-- RIGHT IMAGE ROTATOR -->
            <div class="relative w-full h-[350px] sm:h-[400px] lg:h-[450px]">

                <!-- Images -->
                <img src="{{ asset('images/feature1.png') }}" 
                     class="absolute inset-0 w-full h-full object-cover rounded-xl shadow-2xl transition-opacity duration-1000 opacity-100 image-slide">

                <img src="{{ asset('images/feature2.png') }}" 
                     class="absolute inset-0 w-full h-full object-cover rounded-xl shadow-2xl transition-opacity duration-1000 opacity-0 image-slide">

                <img src="{{ asset('images/feature3.png') }}" 
                     class="absolute inset-0 w-full h-full object-cover rounded-xl shadow-2xl transition-opacity duration-1000 opacity-0 image-slide">

                <!-- Glow -->
                <div class="absolute inset-0 rounded-xl blur-2xl bg-indigo-500 opacity-20"></div>

            </div>

        </div>
    </div>
</section>

<!-- Unified Inbox Section -->
<section class="relative py-24 bg-gray-900">

    <!-- FLOATING CONTAINER -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-gray-950 rounded-2xl shadow-2xl border border-gray-800 p-8 sm:p-12 
                    -mt-32 z-10">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- LEFT IMAGE -->
                <div class="relative">
                    <img src="{{ asset('images/unified-inbox.png') }}" 
                         class="rounded-xl shadow-2xl border border-gray-800 animate-float-slow">

                    <!-- subtle glow -->
                    <div class="absolute inset-0 rounded-xl blur-2xl bg-indigo-500 opacity-20"></div>
                </div>

                <!-- RIGHT TEXT -->
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight">
                        Chats, calls and emails in one thread
                    </h2>

                    <p class="mt-6 text-gray-300 text-lg">
                        MooseLoon AI unifies WhatsApp Business Calls, Messenger Calls and VoIP in the same thread as your messages and emails.
                    </p>

                    <p class="mt-6 text-gray-400">
                        No more silos or juggling multiple platforms — just one reliable record for every customer, no matter the channel.
                    </p>
                </div>

            </div>

        </div>
    </div>
</section>

    <!-- AI Automation for Fast Business Growth Section -->
<section class="bg-white py-20">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Header -->
<div class="text-center mb-16">
    <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
        AI AUTOMATION FOR FAST BUSINESS GROWTH
    </h2>

    <p class="text-xl font-semibold text-indigo-600 mb-4">
        Turn Every Inquiry Into Revenue — 24/7
    </p>

    <!-- NEW: Hot Offer -->
    <p class="text-gray-600 max-w-3xl mx-auto text-lg mb-4">
        We install your AI system in 7 days. You start capturing leads and customers immediately — then pay monthly as it works for you.
    </p>

    <!-- NEW: Guarantee -->
    <p class="text-sm text-green-600 font-semibold">
        ✅ Go Live Guarantee: If your system is not live within 7 days, your setup is refunded.
    </p>
</div>

    <!-- Benefits -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">

        <div class="bg-gray-50 p-6 rounded-xl shadow-sm">
            ✔ We handle your customer inquiries 24/7
        </div>

        <div class="bg-gray-50 p-6 rounded-xl shadow-sm">
            ✔ Turn conversations into paying customers
        </div>

        <div class="bg-gray-50 p-6 rounded-xl shadow-sm">
            ✔ AI agents on WhatsApp, voice, email & website chat
        </div>

        <div class="bg-gray-50 p-6 rounded-xl shadow-sm">
            ✔ Automated lead capture, bookings & follow-ups
        </div>

        <div class="bg-gray-50 p-6 rounded-xl shadow-sm">
            ✔ No need to hire extra staff
        </div>

        <div class="bg-gray-50 p-6 rounded-xl shadow-sm">
            ✔ System setup and launch within 7 days
        </div>

    </div>

    <!-- OPTIONAL: Industry Hook (HIGH CONVERSION) -->
    <div class="text-center mb-16">
        <p class="text-gray-700 text-lg font-semibold">
            Built for high-demand businesses:
        </p>
        <div class="mt-4">
            <a href="#industries"
            class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                Explore Industries We Serve →
            </a>
        </div>
    </div>

        <!-- AI Agents Included -->
        <div class="mb-20">
            <h3 class="text-3xl font-bold text-gray-900 mb-10 text-center">
                AI AGENTS INCLUDED
            </h3>

            <div class="space-y-6">
                <div class="bg-indigo-500 border rounded-xl p-6 shadow-sm text-white">
                    <strong>WhatsApp AI Agent</strong><br>
                    Handles customer inquiries, captures leads, schedules bookings, and sends automated follow-ups on WhatsApp.
                </div>

                <div class="bg-indigo-500 border rounded-xl p-6 shadow-sm text-white">
                    <strong>Website Chat Agent</strong><br>
                    Instantly responds to website visitors and converts traffic into qualified leads.
                </div>

                <div class="bg-indigo-500 border rounded-xl p-6 shadow-sm text-white">
                    <strong>Voice Call AI Agent</strong><br>
                    Answers incoming calls, handles FAQs, captures customer details, and schedules appointments automatically.
                </div>

                <div class="bg-indigo-500 border rounded-xl p-6 shadow-sm text-white">
                    <strong>Email AI Agent</strong><br>
                    Manages inbox responses, professional replies, and automated customer follow-ups.
                </div>

                <div class="bg-indigo-500 border rounded-xl p-6 shadow-sm text-white">
                    <strong>Booking & Scheduling Automation</strong><br>
                    Manages appointment bookings and calendar scheduling automatically.
                </div>

                <div class="bg-indigo-500 border rounded-xl p-6 shadow-sm text-white">
                    <strong>AI Sales & Support Assistants</strong><br>
                    Automate customer engagement, ensuring every inquiry receives an instant professional response while helping businesses convert more leads into paying customers.
                </div>
            </div>
        </div>

        <!-- Why Businesses Lose Customers -->
        <div class="mb-20">
            <h3 class="text-3xl font-bold text-gray-900 mb-6 text-center">
                WHY BUSINESSES LOSE CUSTOMERS
            </h3>

            <p class="text-center text-gray-600 mb-8">
                Every day, businesses lose opportunities because:
            </p>

            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-3xl mx-auto text-gray-700">
                <li>• Customers wait too long for responses</li>
                <li>• Inquiries are missed after working hours</li>
                <li>• Follow-ups are inconsistent</li>
                <li>• Sales opportunities slip away</li>
                <li>• Staff become overwhelmed handling repetitive inquiries</li>
            </ul>

            <p class="text-center font-semibold text-indigo-600 mt-8">
                In today’s market, speed wins customers.
            </p>
        </div>

        <!-- Industries -->
        <div id="industries" class="mb-20">
            <h3 class="text-3xl font-bold text-gray-900 mb-10 text-center">
                INDUSTRIES ALREADY BENEFITING FROM AI AUTOMATION
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-indigo-700">
                <div>🏘️ Real estate agencies & property developers</div>
                <div>🚗  Car dealerships & auto service centers</div>
                <div>🏨 Hotels, resorts & travel agencies</div>
                <div>🏥 Clinics, hospitals & medical centers</div>
                <div>🛍️ Retail stores & e-commerce businesses</div>
                <div>🚚 Logistics, courier & delivery companies</div>
                <div>🏦  Banks, SACCOs & financial services</div>
                <div>🛡️ Insurance companies & brokers</div>
                <div>🎓 Schools, colleges & training institutions</div>
                <div>👥 Recruitment agencies & HR firms</div>
                <div>🍽️ Restaurants, cafés & food delivery businesses</div>
                <div>🏗️ Construction & contracting companies</div>
                <div>⚖️ Law firms & professional service providers</div>
                <div>💆 Beauty salons, spas & wellness centers</div>
                <div>🏋️ Gyms & fitness centers</div>
                <div>🎉 Event planners & entertainment businesses</div>
                <div>🦁  Tour operators & safari companies</div>
                <div>📡  Telecommunications & internet providers</div>
                <div>🤝 NGOs & customer-facing organizations</div>
                <div>🏛️ Government-facing service providers & agencies</div>
                <div>🏪  SMEs & growing local businesses</div>
                <div>🏪  Any business that deals with customers or client inquiries</div>
            </div>
        </div>

        <!-- Quote -->
        <div class="bg-indigo-50 p-10 rounded-2xl text-center mb-16">
            <p class="text-2xl font-semibold text-gray-900 mb-4">
                “Your best salesperson and support agent working 24/7 without salary or breaks.”
            </p>
            <p class="text-gray-700 max-w-4xl mx-auto">
                Studies consistently show that many businesses struggle or fail due to poor customer engagement and slow response times. Customers often leave not because of price or product quality, but because they choose companies that respond faster and engage them better.
            </p>
        </div>

        <!-- CTA -->
        <div class="text-center">
            <p class="text-xl font-semibold mb-6">
                Book your FREE AI demo today and see how automation grows your revenue.
            </p>
            <a href="{{route('contactus')}}" class="inline-block px-8 py-4 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition">
                👉 BOOK FREE AI DEMO TODAY
            </a>
        </div>
    </div>
</section>


    <!-- New Section: Impact & Results -->
    
                <!-- Collaborating Brands Slider -->
        <div class="container mx-auto px-4 text-center py-12">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl mb-6">
                Trusted by Leading Platforms and Partners
            </h2>
            <div class="relative overflow-hidden h-20">
                <div class="absolute inset-0 flex items-center justify-start space-x-12">
                    <div class="flex-shrink-0 flex items-center space-x-12 animate-slide">
                        <img class="h-16 w-auto" src="{{asset('images/N8n-logo-new.png')}}" alt="n8n">
                        <img class="h-16 w-auto" src="{{asset('images/Make-Logo.png')}}" alt="Make.com">
                        <img class="h-16 w-auto" src="{{asset('images/Zapier_Logo.png')}}" alt="Zapier">
                        <img class="h-16 w-auto" src="{{asset('images/Canva_Logo.png')}}" alt="Canva">
                        <img class="h-16 w-auto" src="{{asset('images/Amazon_Web_Services_Logo.png')}}" alt="AWS">
                        <img class="h-16 w-auto" src="{{asset('images/Relevance_AI_Logo.png')}}" alt="Relevance AI">
                    </div>
                    <div class="flex-shrink-0 flex items-center space-x-12 animate-slide">
                        <img class="h-16 w-auto" src="{{asset('images/N8n-logo-new.png')}}" alt="n8n">
                        <img class="h-16 w-auto" src="{{asset('images/Make-Logo.png')}}" alt="Make.com">
                        <img class="h-16 w-auto" src="{{asset('images/Zapier_Logo.png')}}" alt="Zapier">
                        <img class="h-16 w-auto" src="{{asset('images/Canva_Logo.png')}}" alt="Canva">
                        <img class="h-16 w-auto" src="{{asset('images/Amazon_Web_Services_Logo.png')}}" alt="AWS">
                        <img class="h-16 w-auto" src="{{asset('images/Relevance_AI_Logo.png')}}" alt="Relevance AI">
                    </div>
                </div>
            </div>
        </div>

        <!-- Kenyan Partners Section -->
        <div class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h3 class="text-center text-2xl font-extrabold text-gray-900 mb-8">
                    Trusted by Companies We Work With in Kenya
                </h3>

                <div class="flex flex-wrap items-center justify-center gap-10">
                    <!-- Company 1 -->
                    <a href="https://www.briwnet.co.ke/" target="_blank" rel="noopener noreferrer">
                        <img class="h-16 w-auto hover:scale-105 transition-transform duration-300"
                            src="{{ asset('images/Briwnet.png') }}"
                            alt="Company 1">
                    </a>

                    <!-- Company 2 -->
                    <a href="https://izzyitdigital.co.ke/" target="_blank" rel="noopener noreferrer">
                        <img class="h-16 w-auto hover:scale-105 transition-transform duration-300"
                            src="{{ asset('images/izzyt.png') }}"
                            alt="Company 2">
                    </a>

                    <!-- Company 3 -->
                    <a href="https://spacetaxi.ca/" target="_blank" rel="noopener noreferrer">
                        <img class="h-16 w-auto hover:scale-105 transition-transform duration-300"
                            src="{{ asset('images/spacetaxi.png') }}"
                            alt="Company 3">
                    </a>

                    <!-- Company 4 -->
                    <a href="https://iqracanadatestprep.ca/" target="_blank" rel="noopener noreferrer">
                        <img class="h-16 w-auto hover:scale-105 transition-transform duration-300"
                            src="{{ asset('images/IQRA.png') }}"
                            alt="Company 4">
                    </a>
                </div>
            </div>
        </div>


    <div class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="md:grid md:grid-cols-2 md:gap-12 md:items-center">
                    <!-- Left Text & Features -->
                    <div class="md:text-left">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            All-in-One AI & Automation Hub
                        </h2>
                        <p class="mt-4 text-xl text-gray-500">
                            Tools and features designed to simplify, automate, and scale your business operations
                        </p>

                        <div class="mt-8 space-y-6">
                            <!-- Feature Item -->
                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Tailored AI Agents for Your Business
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        We design and maintain AI agents that directly support your growth goals—cutting costs, improving speed, and driving results.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Fully Managed automation pipelines
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        Robust data infrastructure and ingestion processes are a critical component in how we build out our systems.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v.01M16 12v.01M16 16v.01M12 8v.01M12 12v.01M12 16v.01M8 8v.01M8 12v.01M8 16v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Performance analytic dashboard
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        Easily track ROI and efficiency gains with custom metrics on your AI agent's performance.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Intelligent access control
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        Manage agent permissions with your teams to ensure secure operations across your organization.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Secure and compliant protocols
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        Technology architecture that is fully hosted in the cloud, ensuring compliance with SOC-2, ISO, and other industry standards.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="mt-12 md:mt-0">
                        <img class="rounded-lg shadow-xl hover:scale-105 transition-transform duration-500" src="{{asset('images/AI-Solutions.png')}}" alt="A visual representation of an all-in-one platform with various icons.">
                    </div>
                </div>
            </div>
    </div>


                <div class="py-16">
                    <div class="container mx-auto px-4">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 text-center sm:text-4xl">
                            How We Build AI That Works
                        </h2>

                        <div class="mt-12 md:mt-16 md:grid md:grid-cols-2 md:gap-12 md:items-center">
                            <div class="md:text-left">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-500 text-white text-xl font-bold">1</span>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-bold text-gray-900">Discovery</h3>
                                        <p class="mt-1 text-gray-600">
                                            We begin by understanding your vision, goals, and requirements. Through collaborative discussions and research, we lay the foundation for your project's success.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 md:mt-0">
                                <img class="w-full rounded-lg shadow-xl" src="{{asset('images/Discovery-Phase.png')}}" alt="A team collaborating and brainstorming during the discovery phase.">
                            </div>
                        </div>

                        <div class="mt-12 md:mt-16 md:grid md:grid-cols-2 md:gap-12 md:items-center">
                            <div class="md:text-left">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-500 text-white text-xl font-bold">2</span>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-bold text-gray-900">Development</h3>
                                        <p class="mt-1 text-gray-600">
                                            Our team transforms ideas into reality through agile development. We build, test, and iterate, ensuring your solution meets the highest standards of quality and performance.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 md:mt-0">
                                <img class="w-full rounded-lg shadow-xl" src="{{asset('images/Development-Process.png')}}" alt="A team of developers working on code and building a solution.">
                            </div>
                        </div>

                        <div class="mt-12 md:mt-16 md:grid md:grid-cols-2 md:gap-12 md:items-center">
                            <div class="md:text-left">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-500 text-white text-xl font-bold">3</span>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-bold text-gray-900">Deployment</h3>
                                        <p class="mt-1 text-gray-600">
                                            We carefully launch your solution, ensuring a smooth transition to production. Our team provides ongoing support and optimization to keep your system running at its best.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 md:mt-0">
                                <img class="w-full rounded-lg shadow-xl" src="{{asset('images/Deployment.png')}}" alt="A visual representation of a successful software deployment.">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AI Agent Components Section -->
                <div class="py-16 bg-gray-50">
                    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
                        <!-- Text Content -->
                        <div>
                            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                                What Makes an AI Agent Work
                            </h2>
                            <p class="mt-4 text-lg text-gray-600">
                                Behind every AI agent are three building blocks working together
                            </p>

                            <div class="mt-8 space-y-6">
                                <!-- Brain -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-xl">
                                        🧠
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-800">Brain</h3>
                                        <p class="text-gray-600">The decision-making core—powered by AI models that understand, analyze, and reason.</p>
                                    </div>
                                </div>

                                <!-- Memory -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-green-100 text-green-600 rounded-xl">
                                        💾
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-800">Memory</h3>
                                        <p class="text-gray-600">Stores past interactions and knowledge, enabling context-aware and consistent responses.</p>
                                    </div>
                                </div>

                                <!-- Tools -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-xl">
                                        🛠️
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-800">Tools</h3>
                                        <p class="text-gray-600">External APIs, databases, and integrations that extend the agent’s real-world capabilities.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="flex justify-center">
                            <img src="{{asset('images/agent.jpg')}}" alt="AI Agent Components" class="rounded-xl shadow-lg max-h-120 object-contain">
                        </div>
                    </div>
                </div>

                <!-- Good Prompt Section -->
                    <div class="py-16 bg-gray-50">
                        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
                            
                            <!-- Left Content -->
                            <div class="md:w-1/2 text-center md:text-left">
                                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                                    Great AI Starts with the Right Instruction
                                </h2>
                                <p class="mt-4 text-lg text-gray-600">
                                    Clear instructions make AI smarter. The better the prompt, the better the outcomes.
                                </p>
                            </div>

                            <!-- Right Image -->
                            <div class="md:w-1/2">
                                <img src="{{asset('images/prompt.jpg')}}" alt="Good Prompt Illustration" class="rounded-lg shadow-lg w-full">
                            </div>
                        </div>
                    </div>
                    <!-- End Good Prompt Section -->



                
            <!-- <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                Metric 1
                <div class="bg-white rounded-lg shadow-lg p-6">
                    The data-target attribute holds the final number to count to.
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="17000">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        Professionals upskilled in AI via our platforms
                    </p>
                </div>

                Metric 2 
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="435">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        AI Opportunities identified for businesses
                    </p>
                </div>

                 Metric 3 
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="15">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        Bespoke AI solutions developed
                    </p>
                </div>
            </div> -->
        </div>
    </div> 

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Select all elements with the 'data-counter' class.
            const counters = document.querySelectorAll('.data-counter');

            // Set up a new IntersectionObserver to watch for elements entering the viewport.
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    // Check if the element is currently visible.
                    if (entry.isIntersecting) {
                        const counterElement = entry.target;
                        // Get the target number from the 'data-target' attribute.
                        const target = parseInt(counterElement.dataset.target, 10);
                        const duration = 2000; // Animation duration in milliseconds.
                        const startTimestamp = performance.now();
                        
                        // Define the update function for the animation frame.
                        const updateCount = (timestamp) => {
                            const elapsed = timestamp - startTimestamp;
                            const progress = Math.min(elapsed / duration, 1);
                            const currentValue = Math.floor(progress * target);
                            
                            // Format the number based on its size and add the appropriate suffix.
                            let formattedValue;
                            if (target >= 1000) {
                                formattedValue = (currentValue / 1000).toFixed(1) + 'K+';
                            } else {
                                formattedValue = currentValue + '+';
                            }
                            
                            counterElement.textContent = formattedValue;
                            
                            // Continue the animation until progress is 1.
                            if (progress < 1) {
                                requestAnimationFrame(updateCount);
                            }
                        };
                        
                        // Start the animation.
                        requestAnimationFrame(updateCount);

                        // Stop observing the element after the animation has started.
                        observer.unobserve(counterElement);
                    }
                });
            }, {
                // The threshold determines how much of the element needs to be visible to trigger the observer.
                threshold: 0.5
            });

            // Tell the observer to watch each counter element.
            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
         function toggleAccordion(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById(`icon-${id}`);
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-45');
        }

        document.addEventListener("DOMContentLoaded", function () {
            const slides = document.querySelectorAll(".image-slide");
            let index = 0;

            setInterval(() => {
                slides[index].classList.remove("opacity-100");
                slides[index].classList.add("opacity-0");

                index = (index + 1) % slides.length;

                slides[index].classList.remove("opacity-0");
                slides[index].classList.add("opacity-100");
            }, 3000); // change every 3s
        });
    </script>
@endsection