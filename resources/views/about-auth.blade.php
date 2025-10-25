{{-- resources/views/about.blade.php --}}

@extends('layouts.app')

@section('title', 'About Us - SynFlow AI')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row lg:items-start gap-8">

        <!-- Left: Main Card -->
        <div class="flex-1">
            <div class="bg-white shadow-lg rounded-2xl p-8">
                <!-- Video Slot -->
                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden mb-6">
                    <iframe class="w-full h-full"
                            src="https://www.youtube.com/embed/UdE-W30oOXo?si=HsA_rjR_e5Drsz3w"
                            frameborder="0"
                            allowfullscreen>
                    </iframe>
                </div>

                <!-- Horizontal Links -->
                <div class="flex flex-wrap items-center justify-center gap-6 mb-8">
                    <a href="#" class="text-indigo-600 font-semibold">Private</a>
                    <span class="text-gray-500">{{ $members }} Members</span>
                    <a href="#" class="text-indigo-600 font-semibold">Free</a>
                    <span class="text-gray-700">By Laban Ekitela - Founder ⭐</span>
                </div>

                <!-- About Content -->
                <div class="space-y-4 text-gray-700 text-base leading-relaxed">
                    <p><strong>Interested in starting an AI business?</strong> If so, you're in the right place.</p>
                    <p>I'm <strong>Laban Ekitela</strong>, the #1 AI business expert on YouTube and creator of the AI Automation Agency model.</p>
                    <p>1 year ago, I started with zero generative AI knowledge. Now I've built multiple AI businesses generating millions in revenue with a team of 10+ people.</p>
                    <p>Just like every business needed a website in the 90s, today they need AI to stay competitive. I've created this community to teach you how to capitalize on this opportunity — even with zero coding experience.</p>

                    <p class="font-semibold">Join now to get:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>📚 Complete AI Automation Agency Course</li>
                        <li>🎯 Weekly Live Q&As with Me</li>
                        <li>💼 Proven contracts, proposals, and guides</li>
                        <li>🤝 Elite Network access of AI professionals</li>
                    </ul>

                    <div class="mt-6">
                        <a href="#"
                           class="inline-flex px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                           Join Now
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Sidebar Card -->
        <div class="w-full lg:w-96">
            <div class="bg-white shadow-lg rounded-2xl p-6 space-y-4">
                <!-- Image Slot -->
               <div class="w-full h-36 bg-gray-200 rounded-lg overflow-hidden">
                    <img src="{{ asset('images/uson.png') }}" 
                        alt="User Icon" 
                        class="w-full h-full object-cover rounded-lg">
                </div>
                    <a href="#"
                       target="_blank"
                       class="block text-indigo-600 font-bold">
                       AI Automation Agency Hub
                    </a>
                    <p class="text-gray-500">Start Your AI Automation Agency - Created by Laban Ekitela</p>
                </div>

                <ul class="space-y-2 mt-10">
                    <li>⚡ First 10 Clients Guaranteed</li>
                    <li>📹 Subscribe To YouTube</li>
                </ul>

                <!-- Stats -->
                <div class="grid grid-cols-2 gap-4 text-center pt-4 mt-10">
                    <div class="bg-gray-100 rounded-lg p-2">
                        👤 <span class="font-semibold">{{ $members }}</span><br>
                        <span class="text-gray-500 text-xs">Members</span>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-2">
                        🟢 <span class="font-semibold">{{ $online }}</span><br>
                        <span class="text-gray-500 text-xs">Online</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-12 text-center text-sm text-gray-500">
        <a href="#" class="hover:text-indigo-600">Privacy</a> ·
        <a href="#" class="hover:text-indigo-600">Terms</a>
    </div>
</div>
@endsection
