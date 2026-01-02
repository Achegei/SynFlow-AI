@extends('layouts.public')

@section('title', 'Careers')

@section('content')
<div class="relative min-h-[80vh] flex items-center justify-center px-4 sm:px-6 lg:px-8 py-20 overflow-hidden">

    <!-- Background Accent -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-emerald-50"></div>

    <!-- Glow Orbs -->
    <div class="absolute -top-24 -left-24 w-72 h-72 bg-indigo-300/30 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-emerald-300/30 rounded-full blur-3xl"></div>

    <!-- Card -->
    <div class="relative max-w-3xl w-full bg-white/90 backdrop-blur-xl shadow-2xl rounded-3xl border border-gray-200 p-8 sm:p-12">

        <!-- Badge -->
        <div class="flex justify-center mb-6">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold
                         bg-gradient-to-r from-indigo-600 to-emerald-600 text-white shadow-md">
                Careers Update
            </span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                Careers Notice
            </h1>
            <p class="text-gray-600 text-lg">
                Official update from Moose Loon AI
            </p>
        </div>

        <!-- Notice Content -->
        <div class="space-y-6 text-gray-800 text-lg leading-relaxed">

            <div class="flex items-start gap-3">
                <span class="text-emerald-600 text-xl">✔</span>
                <p>
                    <strong>Applications closed on December 31, 2025.</strong>
                </p>
            </div>

            <div class="flex items-start gap-3">
                <span class="text-indigo-600 text-xl">⏳</span>
                <p>
                    Onboarding for selected Sales Associates is currently in progress.
                    <span class="font-semibold">No new applications</span> are being accepted at this time.
                </p>
            </div>

            <div class="flex items-start gap-3">
                <span class="text-orange-600 text-xl">📢</span>
                <p>
                    Information regarding upcoming <strong>managerial opportunities</strong> will be communicated on
                    <span class="font-semibold text-gray-900">January 20, 2026</span>.
                    These roles will be advertised internally and will be available to
                    <strong>selected Sales Associates only</strong>.
                </p>
            </div>

        </div>

        <!-- Divider -->
        <div class="my-10 border-t border-gray-200"></div>

        <!-- Footer -->
        <div class="text-center">
            <span class="inline-block bg-gray-900 text-white text-sm font-medium px-6 py-2 rounded-full shadow">
                Moose Loon AI Solutions
            </span>
        </div>

    </div>
</div>
@endsection
