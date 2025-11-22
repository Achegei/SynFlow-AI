@extends('layouts.public')

@section('title', 'Moose Loon AI — Corporate AI Packages & Pricing')

@section('content')

<!-- HERO / INTRO -->
<div class="container mx-auto px-4 py-16 text-center">
    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight text-indigo-600">
        MOOSE LOON AI — CORPORATE AI PACKAGES & PRICING STRUCTURE
    </h1>
    <p class="mt-6 max-w-3xl mx-auto text-lg text-gray-700">
        Moose Loon AI uses a <span class="font-semibold text-indigo-600">three-tier pricing model</span> for SMEs, professional businesses, and corporate clients.
        Packages include automation tools, setup, and support. Pricing placeholders will be finalized after field research.
    </p>
</div>

<!-- PACKAGES SECTION -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Basic Business Packages -->
        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-8 text-center">
            Basic Business Packages
        </h2>
        <p class="text-gray-700 mb-8 text-center">For small businesses: salons, boutiques, barbers, mini-shops.</p>

        <div class="grid md:grid-cols-2 gap-8">

            <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4">Starter Automation Package</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>WhatsApp Auto-Responder</li>
                    <li>FAQ Assistant</li>
                    <li>Price List Automation</li>
                    <li>Business Info Bot</li>
                    <li>Basic customer tracking</li>
                </ul>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4">Customer Support Package</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>AI 24/7 Customer Support (WhatsApp/Facebook/Instagram)</li>
                    <li>Auto-reply system</li>
                    <li>Basic analytics</li>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- Professional Business Packages -->
<div class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-8 text-center">
            Professional Business Packages
        </h2>
        <p class="text-gray-700 mb-8 text-center">For clinics, hotels, car dealers, schools, pharmacies.</p>

        <div class="grid md:grid-cols-2 gap-8">

            <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4">Full Customer Experience Package</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>WhatsApp AI Assistant</li>
                    <li>AI Email Assistant</li>
                    <li>Booking Automation</li>
                    <li>Follow-Up System</li>
                    <li>Review Analyzer</li>
                    <li>Inventory Alerts (Lite)</li>
                </ul>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4">Business Productivity Package</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>Report Summarizer</li>
                    <li>Workflow Automation</li>
                    <li>File/Document Assistant</li>
                    <li>Staff Automation Tools</li>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- Corporate & Enterprise Packages -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-8 text-center">
            Corporate & Enterprise Packages
        </h2>
        <p class="text-gray-700 mb-8 text-center">For banks, telcos, hospitals, SACCOs, NGOs.</p>

        <div class="grid md:grid-cols-2 gap-8">

            <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4">Enterprise Automation Suite</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>Full chat automation</li>
                    <li>Email assistant</li>
                    <li>Document intelligence</li>
                    <li>Analytics dashboard</li>
                    <li>Staff onboarding automation</li>
                    <li>Workflow setup</li>
                </ul>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4">Corporate Intelligence Suite</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>AI customer support center</li>
                    <li>Financial report analysis</li>
                    <li>Document drafting</li>
                    <li>Multi-branch automation</li>
                    <li>ERP-level integrations</li>
                    <li>Corporate training</li>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- Optional Upgrades -->
<div class="py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6">
            Optional Upgrades
        </h2>
        <p class="text-gray-700 space-y-2">
            Social Media Content Engine<br>
            Custom n8n Workflows<br>
            Voicebot/Call Center AI<br>
            API Integrations<br>
            Dashboards<br>
            Digital staff training
        </p>
    </div>
</div>

<!-- Price Structure -->
<div class="py-16 bg-indigo-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-indigo-600 mb-8">Price Structure</h2>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4">Basic</h3>
                <p class="text-gray-700 mb-2">KSh 2,500 – 5,000 / month</p>
                <p class="text-gray-700">Setup Fee: KSh 3,000 – 5,000</p>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4">Professional</h3>
                <p class="text-gray-700 mb-2">KSh 10,000 – 25,000 / month</p>
                <p class="text-gray-700">Setup Fee: KSh 5,000 – 15,000</p>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4">Corporate</h3>
                <p class="text-gray-700 mb-2">KSh 50,000 – 350,000+ / month</p>
                <p class="text-gray-700">Setup Fee: KSh 15,000 – 20,000</p>
            </div>

        </div>
    </div>
</div>

<!-- Sales Pitch / CTA -->
<div class="py-16 bg-indigo-100">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-indigo-600 mb-6">
            Ready to Transform Your Business with AI?
        </h2>
        <p class="text-gray-700 max-w-2xl mx-auto mb-6">
            Moose Loon AI gives your business a digital employee that works 24/7, improves customer experience, and saves time and money.
        </p>
        <a href="#contact" class="inline-block bg-indigo-600 text-white font-semibold px-8 py-3 rounded-xl shadow hover:bg-indigo-700 transition duration-300">
            Get Started Today
        </a>
    </div>
</div>

@endsection
