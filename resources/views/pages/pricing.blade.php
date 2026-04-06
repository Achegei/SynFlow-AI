@extends('layouts.public')

@section('Pricing', 'Moose Loon AI Pricing')

@section('content')

<!-- HERO -->
<div class="container mx-auto px-4 py-16 text-center">
    <h1 class="text-4xl sm:text-5xl font-extrabold">
        Scale Your Business with AI
    </h1>
    <p class="mt-4 text-gray-600 max-w-xl mx-auto">
        Automate chats, capture leads, and never miss a customer.
    </p>
</div>

<!-- PRICING WITH CLICKABLE MONTHLY/YEARLY -->
<div class="bg-indigo-50 py-20" x-data="{ billing: 'monthly' }">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Pricing Plans</h2>
        <p class="mt-2 text-gray-600">Simple, transparent pricing — no hidden fees.</p>

        <!-- Clickable Labels -->
        <div class="mt-6 flex justify-center items-center space-x-4">
            <span @click="billing = 'monthly'" 
                  :class="billing === 'monthly' ? 'font-bold text-indigo-600 cursor-pointer' : 'text-gray-500 cursor-pointer'">
                  Monthly
            </span>
            <span @click="billing = 'yearly'" 
                  :class="billing === 'yearly' ? 'font-bold text-indigo-600 cursor-pointer' : 'text-gray-500 cursor-pointer'">
                  Yearly
            </span>
        </div>

        <!-- CLEAR PRICING EXPLANATION -->
        <div class="mt-6 max-w-2xl mx-auto text-sm text-gray-600 bg-white border border-gray-200 rounded-lg p-5 shadow-sm text-left">
    
    <p class="mb-3">
        💡 <strong>How Pricing Works:</strong>
    </p>

    <div class="mb-4 space-y-2">
        <p><strong>Your Business, Fully Automated</strong></p>

        <p>✔️ We build & deploy your AI Sales & Customer Support System</p>
        <p>✔️ Works 24/7 — captures leads, responds instantly, books customers</p>
        <p>✔️ Fully managed — you don’t lift a finger</p>

        <br>

        <p><strong>🌐 Website (Optional Upgrade)</strong></p>

        <p>• No website yet?<br>
        👉 We build you a conversion-focused AI website that turns visitors into customers<br>
        One-time investment — affordable & scalable</p>

        <p>• Already have one?<br>
        👉 We transform your existing website into an AI-powered sales system — FREE</p>
    </div>
</div>

        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">

    <!-- STARTER -->
    <div class="bg-white rounded-xl shadow p-8 flex flex-col relative">
        <h3 class="text-xl font-bold mb-2">🟢 Starter</h3>
        <p class="text-gray-500 mb-4">For small businesses getting started</p>

        <div class="mb-4">
            <p class="text-gray-400 text-sm">Typical Market Setup</p>
            <p class="line-through text-gray-800">KES 35,000 – 60,000</p>

            <p class="text-gray-800 text-sm mt-2">Moose Loon AI Setup</p>
            <p class="text-2xl font-extrabold text-gray-900">KES 6,250</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-800 text-sm">Market Monthly(Upfront Payment)</p>
            <p class="line-through text-gray-500">KES 20,000 – 30,000</p>

            <p class="text-gray-800 text-sm mt-2">Moose Loon AI (Post-Payment Investment)</p>

            <div class="flex items-center space-x-2">
                <span 
                    :class="billing === 'yearly' ? 'text-green-600 font-bold' : 'text-indigo-600 font-bold'"
                    x-text="billing === 'monthly' 
                        ? 'KES 12,500/month' 
                        : 'KES ' + Math.round(12500 * 12 * 0.8).toLocaleString() + '/year'">
                </span>

                <span x-show="billing === 'yearly'"
                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">
                    Save 20%
                </span>
            </div>
        </div>

        <ul class="text-gray-600 mb-6 space-y-1 text-left text-sm">
            <li>💡 Pay after value — not before</li>
            <li>💡 Less than half the cost of staff</li>
        </ul>

        <a href="{{route('contactus')}}"
           class="mt-auto inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700">
           Get Started
        </a>
    </div>

    <!-- STANDARD -->
    <div class="bg-indigo-100 rounded-xl shadow p-8 flex flex-col border-4 border-indigo-500 transform scale-105 relative">
        <div class="absolute -mt-10 -ml-6 bg-indigo-600 text-white px-4 py-1 rounded-full text-sm font-semibold uppercase">
            Most Popular
        </div>

        <h3 class="text-xl font-bold mb-2">🔵 Standard</h3>
        <p class="text-gray-600 mb-4">For growing businesses</p>

        <div class="mb-4">
            <p class="text-gray-400 text-sm">Typical Market Setup</p>
            <p class="line-through text-gray-800">KES 80,000 – 120,000</p>

            <p class="text-gray-400 text-sm mt-2">Moose Loon AI Setup</p>
            <p class="text-2xl font-extrabold">KES 7,250</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-400 text-sm">Market Monthly</p>
            <p class="line-through text-gray-800">KES 30,000 – 50,000</p>

            <p class="text-gray-400 text-sm mt-2">Moose Loon AI (Post-Payment Investment)</p>

            <div class="flex items-center space-x-2">
                <span 
                    :class="billing === 'yearly' ? 'text-green-600 font-bold' : 'text-indigo-600 font-bold'"
                    x-text="billing === 'monthly' 
                        ? 'KES 14,500/month' 
                        : 'KES ' + Math.round(14500 * 12 * 0.8).toLocaleString() + '/year'">
                </span>

                <span x-show="billing === 'yearly'"
                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">
                    Save 20%
                </span>
            </div>
        </div>

        <ul class="text-gray-700 mb-6 space-y-1 text-left text-sm">
            <li>💡 A fraction of hiring + tools combined</li>
            <li>💡 Performance-driven investment</li>
        </ul>

        <a href="{{route('contactus')}}"
           class="mt-auto inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700">
           Choose Plan
        </a>
    </div>

    <!-- PREMIUM -->
    <div class="bg-white rounded-xl shadow p-8 flex flex-col relative">
        <h3 class="text-xl font-bold mb-2">🟣 Premium</h3>
        <p class="text-gray-500 mb-4">For high-volume and scaling businesses</p>

        <div class="mb-4">
            <p class="text-gray-400 text-sm">Typical Market Setup</p>
            <p class="line-through text-gray-800">KES 180,000 – 220,000</p>

            <p class="text-gray-400 text-sm mt-2">Moose Loon AI Setup</p>
            <p class="text-2xl font-extrabold">KES 22,000</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-400 text-sm">Market Monthly</p>
            <p class="line-through text-gray-800">KES 80,000 – 150,000+</p>

            <p class="text-gray-400 text-sm mt-2">Moose Loon AI (Post-Payment Investment)</p>

            <div class="flex items-center space-x-2">
                <span 
                    :class="billing === 'yearly' ? 'text-green-600 font-bold' : 'text-indigo-600 font-bold'"
                    x-text="billing === 'monthly' 
                        ? 'KES 44,000/month' 
                        : 'KES ' + Math.round(44000 * 12 * 0.8).toLocaleString() + '/year'">
                </span>

                <span x-show="billing === 'yearly'"
                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">
                    Save 20%
                </span>
            </div>
        </div>

        <ul class="text-gray-600 mb-6 space-y-1 text-left text-sm">
            <li>💡 Replaces multiple roles</li>
            <li>💡 Enterprise system without enterprise cost</li>
        </ul>

        <a href="{{route('contactus')}}"
           class="mt-auto inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700">
           Contact Sales
        </a>
    </div>

</div>

<!-- VALUE HIGHLIGHT -->
<div class="py-16 bg-gray-50 text-center">
    <div class="container mx-auto px-6 max-w-4xl">

        <!-- HEADLINE -->
        <p class="text-lg font-semibold text-gray-800">
            No monthly salaries. No missed customers. AI works 24/7.
        </p>
        <p class="mt-2 text-gray-600 mb-10">
            Setup in a few days. Start seeing results immediately.
        </p>

        <img src="{{asset('images/comparison-table.png')}}" 
             alt="Comparison Table"
             class="mx-auto mb-12 rounded-lg shadow">

        <!-- CORE VALUE -->
        <div class="mb-12">
            <h3 class="text-xl font-bold mb-4">🔥 CORE VALUE POSITIONING</h3>
            <p class="font-semibold">Moose Loon AI</p>
            <div class="mt-3 space-y-1 text-gray-700">
                <p>✅ One-time setup</p>
                <p>✅ Post-payment monthly investment</p>
                <p>✅ Pay as the system delivers value</p>
            </div>

            <p class="mt-4 font-semibold text-indigo-600">
                👉 “Others charge you to start. We charge you as you grow.”
            </p>
        </div>

        <!-- BENEFITS -->
        <div class="mb-12">
            <h3 class="text-xl font-bold mb-4">⚡ TURN EVERY INQUIRY INTO REVENUE</h3>
            <div class="space-y-1 text-gray-700">
                <p>• No missed messages</p>
                <p>• No missed calls</p>
                <p>• No lost customers</p>
            </div>

            <p class="mt-4 font-semibold">
                👉 Your AI system works 24/7 — so your business never stops
            </p>
        </div>

        <!-- HOW IT WORKS -->
        <div class="mb-12 text-left md:text-center">
            <h3 class="text-xl font-bold mb-6 text-center">💡 HOW IT WORKS</h3>

            <div class="space-y-4 text-gray-700 max-w-2xl mx-auto">
                <p><strong>1.</strong> Start with 50% setup — lower upfront barrier</p>
                <p><strong>2.</strong> System goes live within 7 days</p>
                <p><strong>3.</strong> Start capturing leads immediately</p>
                <p><strong>4.</strong> Monthly investment begins after launch</p>
            </div>

            <p class="mt-6 font-semibold text-indigo-600 text-center">
                👉 “One-time setup. Then pay as your system works for you.”
            </p>
        </div>

        <!-- WHY -->
        <div class="mb-12">
            <h3 class="text-xl font-bold mb-4">🧠 WHY MOOSE LOON AI</h3>
            <div class="space-y-1 text-gray-700">
                <p>• Lower upfront entry</p>
                <p>• Monthly investment after launch</p>
                <p>• Faster response to every inquiry</p>
                <p>• 24/7 automated customer handling</p>
            </div>
        </div>

        <!-- FINAL -->
        <div>
            <h3 class="text-xl font-bold mb-4">⚡ SIMPLE MODEL</h3>
            <p class="text-gray-700">
                Start with 50% setup. Scale with monthly investment.
            </p>

            <p class="mt-4 font-semibold text-indigo-600">
                👉 Setup starts fast. Value starts immediately.
            </p>
        </div>

    </div>
</div>

<!-- SOCIAL PROOF -->
<div class="py-20 text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-extrabold">Businesses Are Automating</h2>
        <p class="mt-2 text-gray-600 max-w-xl mx-auto">
            Respond faster, convert more leads, and run 24/7.
        </p>

        <div class="mt-8 grid md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="font-bold text-xl">+40%</h3>
                <p class="text-gray-600 mt-1">Faster lead response</p>
            </div>
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="font-bold text-xl">24/7</h3>
                <p class="text-gray-600 mt-1">Customer engagement</p>
            </div>
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="font-bold text-xl">0</h3>
                <p class="text-gray-600 mt-1">Missed leads</p>
            </div>
        </div>
    </div>
</div>

<!--Other AI Services-->
<!-- HERO + AI Agents Accordion -->
<div class="container mx-auto px-4 py-16 text-center">
    <h1 class="text-4xl sm:text-5xl font-extrabold">
        Additional ways to Scale Your Business with AI
    </h1>
    <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
        Automate chats, capture leads, and never miss a customer.
    </p>
    <!-- Accordion Section -->
    <div class="mt-10 max-w-3xl mx-auto text-left space-y-2" x-data="{ openItem: null }">

        <!-- AI Email Assistant -->
        <div class="border rounded-lg">
            <button @click="openItem === 1 ? openItem = null : openItem = 1"
                    class="w-full text-left px-4 py-3 bg-indigo-50 font-semibold flex justify-between items-center hover:bg-indigo-100">
                <span>AI Email Assistant – Standard</span>
                <svg :class="{'rotate-180': openItem === 1}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openItem === 1" x-transition class="px-4 py-3 text-gray-700 bg-white">
                Handles email queries with tracking & simple logic. Logs responses or lead data to Sheets and applies qualification rules.
            </div>
        </div>

        <!-- Booking & Scheduling Agent -->
        <div class="border rounded-lg">
            <button @click="openItem === 2 ? openItem = null : openItem = 2"
                    class="w-full text-left px-4 py-3 bg-indigo-50 font-semibold flex justify-between items-center hover:bg-indigo-100">
                <span>Booking & Scheduling Agent – Standard</span>
                <svg :class="{'rotate-180': openItem === 2}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openItem === 2" x-transition class="px-4 py-3 text-gray-700 bg-white">
                Manages appointments via chat/email. Integrates with calendars/Sheets and confirms times.
            </div>
        </div>

        <!-- Lead Scraping & Enrichment -->
        <div class="border rounded-lg">
            <button @click="openItem === 3 ? openItem = null : openItem = 3"
                    class="w-full text-left px-4 py-3 bg-indigo-50 font-semibold flex justify-between items-center hover:bg-indigo-100">
                <span>Lead Scraping & Enrichment – Standard</span>
                <svg :class="{'rotate-180': openItem === 3}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openItem === 3" x-transition class="px-4 py-3 text-gray-700 bg-white">
                Pulls contacts from sites into CRM/Sheets. Goes beyond simple FAQ bots.
            </div>
        </div>

        <!-- Cold Email Outreach -->
        <div class="border rounded-lg">
            <button @click="openItem === 4 ? openItem = null : openItem = 4"
                    class="w-full text-left px-4 py-3 bg-indigo-50 font-semibold flex justify-between items-center hover:bg-indigo-100">
                <span>Cold Email Outreach System – Standard</span>
                <svg :class="{'rotate-180': openItem === 4}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openItem === 4" x-transition class="px-4 py-3 text-gray-700 bg-white">
                Automates outreach with logging of opens/replies. Integrates lead data and sequencing logic.
            </div>
        </div>

        <!-- E-commerce Automation -->
        <div class="border rounded-lg">
            <button @click="openItem === 5 ? openItem = null : openItem = 5"
                    class="w-full text-left px-4 py-3 bg-indigo-50 font-semibold flex justify-between items-center hover:bg-indigo-100">
                <span>E-commerce Automation Package – Standard</span>
                <svg :class="{'rotate-180': openItem === 5}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openItem === 5" x-transition class="px-4 py-3 text-gray-700 bg-white">
                Integrates with online stores for FAQs, order status, and basic automations & Data retrieval.
            </div>
        </div>

        <!-- RAG-Based Chatbot -->
        <div class="border rounded-lg">
            <button @click="openItem === 6 ? openItem = null : openItem = 6"
                    class="w-full text-left px-4 py-3 bg-indigo-50 font-semibold flex justify-between items-center hover:bg-indigo-100">
                <span>RAG-Based Chatbot (FAQ & Knowledge Assistant) – Starter</span>
                <svg :class="{'rotate-180': openItem === 6}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openItem === 6" x-transition class="px-4 py-3 text-gray-700 bg-white">
                Answers from a knowledge base, no external logging. Matches Starter tier WhatsApp FAQ use case.
            </div>
        </div>

        <!-- Virtual Assistant / Premium -->
        <div class="border rounded-lg">
            <button @click="openItem === 7 ? openItem = null : openItem = 7"
                    class="w-full text-left px-4 py-3 bg-indigo-50 font-semibold flex justify-between items-center hover:bg-indigo-100">
                <span>Virtual Assistant / Booking Agent – Premium</span>
                <svg :class="{'rotate-180': openItem === 7}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openItem === 7" x-transition class="px-4 py-3 text-gray-700 bg-white">
                Provides live assistance including voice, advanced interactions.
            </div>
        </div>

        <!-- AI Content & Marketing Assistant -->
        <div class="border rounded-lg">
            <button @click="openItem === 8 ? openItem = null : openItem = 8"
                    class="w-full text-left px-4 py-3 bg-indigo-50 font-semibold flex justify-between items-center hover:bg-indigo-100">
                <span>AI Content & Marketing Assistant – Starter</span>
                <svg :class="{'rotate-180': openItem === 8}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openItem === 8" x-transition class="px-4 py-3 text-gray-700 bg-white">
                Generates social posts, ad copy, etc., no back-end integration.
            </div>
        </div>

        <!-- Customer Feedback & Sentiment Analysis -->
        <div class="border rounded-lg">
            <button @click="openItem === 9 ? openItem = null : openItem = 9"
                    class="w-full text-left px-4 py-3 bg-indigo-50 font-semibold flex justify-between items-center hover:bg-indigo-100">
                <span>Customer Feedback & Sentiment Analysis – Standard</span>
                <svg :class="{'rotate-180': openItem === 9}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openItem === 9" x-transition class="px-4 py-3 text-gray-700 bg-white">
                Collects and analyzes feedback across channels. Logs results to analytics or Sheets.
            </div>
        </div>

    </div>
</div>

<!-- FINAL CTA -->
<div class="bg-indigo-600 text-white py-20 text-center">
    <h2 class="text-3xl font-extrabold">Ready to Automate?</h2>
    <p class="mt-2">Start today and see results fast.</p>
    <a href="{{route('contactus')}}"
       class="mt-4 inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
       Get Started Now
    </a>
</div>

@endsection