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

<!-- PRICING -->
<div class="bg-indigo-50 py-20">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Pricing Plans</h2>
        <p class="mt-2 text-gray-600">Simple, transparent pricing — no hidden fees.</p>

        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- STARTER -->
            <div class="bg-white rounded-xl shadow p-8 flex flex-col">
                <h3 class="text-xl font-bold mb-2">Starter</h3>
                <p class="text-gray-500 mb-4">Basic AI responder for WhatsApp.</p>
                <p class="text-3xl font-extrabold mb-4">KES 10,500</p>
                <ul class="text-gray-600 mb-6 space-y-1 text-left">
                    <li>• AI FAQ chatbot</li>
                    <li>• Instant replies</li>
                    <li>• Simple conversation flow</li>
                    <li>• Fallback messages</li>
                </ul>
                <a href="{{route('contactus')}}"
                   class="mt-auto inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700">
                   Get Started
                </a>
            </div>

            <!-- STANDARD (Most Popular) -->
            <div class="bg-indigo-100 rounded-xl shadow p-8 flex flex-col border-4 border-indigo-500 transform scale-105">
                <div class="absolute -mt-10 -ml-6 bg-indigo-600 text-white px-4 py-1 rounded-full text-sm font-semibold uppercase">
                    Most Popular
                </div>
                <h3 class="text-xl font-bold mb-2">Standard</h3>
                <p class="text-gray-500 mb-4">AI agent with lead tracking.</p>
                <p class="text-3xl font-extrabold mb-4">KES 14,500</p>
                <ul class="text-gray-600 mb-6 space-y-1 text-left">
                    <li>• Starter features</li>
                    <li>• Lead logging & qualification</li>
                    <li>• Automated follow-ups</li>
                    <li>• Basic analytics</li>
                </ul>
                <a href="{{route('contactus')}}"
                   class="mt-auto inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700">
                   Choose Plan
                </a>
            </div>

            <!-- PREMIUM -->
            <div class="bg-white rounded-xl shadow p-8 flex flex-col">
                <h3 class="text-xl font-bold mb-2">Premium</h3>
                <p class="text-gray-500 mb-4">Full AI system with voice.</p>
                <p class="text-3xl font-extrabold mb-4">KES 44,000</p>
                <ul class="text-gray-600 mb-6 space-y-1 text-left">
                    <li>• Standard features</li>
                    <li>• AI voice agent</li>
                    <li>• Call transcription & booking</li>
                    <li>• ~1000 call minutes included</li>
                </ul>
                <a href="{{route('contactus')}}"
                   class="mt-auto inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700">
                   Contact Sales
                </a>
            </div>

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