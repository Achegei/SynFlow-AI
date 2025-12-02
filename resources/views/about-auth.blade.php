{{-- resources/views/about.blade.php --}}

@extends('layouts.app')

@section('title', 'About Us - MooseLoon AI')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">

        <!-- Tagline -->
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 leading-snug">
                We build intelligent AI solutions that solve real-world problems
            </h2>
            <p class="text-gray-600 mt-3 text-lg">
                to cut costs, boost productivity, and drive measurable growth.<br>
                Turn repetitive workflows into smart, automated systems that save time and reduce costs.
            </p>
        </div>

        <!-- Video Only -->
        <div class="bg-white shadow-lg rounded-2xl p-8">
            <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                <iframe class="w-full h-full"
                        src="https://www.youtube.com/embed/UdE-W30oOXo?si=HsA_rjR_e5Drsz3w"
                        frameborder="0"
                        allowfullscreen>
                </iframe>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 text-center text-sm text-gray-500">
            <a href="{{ route('policy') }}" class="hover:text-indigo-600">Privacy</a> ·
            <a href="{{ route('terms') }}" class="hover:text-indigo-600">Terms</a>
        </div>
    </div>
</div>
@endsection
