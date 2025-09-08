@extends('layouts.public')

@section('title', 'Newsletter Creation - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <header class="text-center">
            <p class="text-sm font-semibold text-gray-500 flex items-center justify-center gap-2">
                <img src="{{ asset('images/laban.jpeg') }}" alt="Laban Ekitela" 
                     class="w-8 h-8 rounded-full object-cover shadow-sm">
                <span class="flex items-center space-x-2">
                    <span>Laban Ekitela</span>
                    <span class="text-gray-400 font-normal">|</span>
                    <span>Co-Founder</span>
                    <span class="text-gray-400 font-normal">|</span>
                    <span>May 19th, 2025</span>
                </span>
            </p>

            <h1 class="mt-6 text-5xl font-extrabold tracking-tight text-indigo-700 sm:text-6xl">
                Newsletter Creation
            </h1>

            <div class="mt-6 flex justify-center space-x-4">
                <!-- Back button -->
                <a href="#back"
                   class="px-6 py-2 bg-white text-gray-700 font-semibold rounded-lg shadow-md border border-gray-300 hover:bg-gray-100 transition">
                    ← Back to Agents
                </a>

                <!-- Download button -->
                <a href="/path/to/your/resource_file.pdf" download
                   class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">
                    ⬇ Download Resource File
                </a>
            </div>
        </header>

        <!-- Overview -->
        <section class="mt-12 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-indigo-700">Overview</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                This AI-powered agent is a fully automated system for creating, formatting, and distributing newsletters. 
                It streamlines your entire content workflow, allowing you to generate engaging content and manage your subscriber lists from a single, intuitive platform.
            </p>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Key Features -->
        <section class="mt-12 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-indigo-700">Key Features</h2>
            <p class="mt-4 text-lg text-gray-600">
                The Newsletter Creation agent is built to handle the entire process with these core capabilities:
            </p>
            <ul class="mt-6 list-disc list-inside space-y-3 text-gray-600 text-left inline-block">
                <li><span class="font-semibold text-gray-800">Automated Content Generation:</span> Uses AI to write articles, summaries, headlines, and calls-to-action based on your prompts or a curated list of sources.</li>
                <li><span class="font-semibold text-gray-800">Template Customization:</span> Choose from a library of professional templates and customize them to match your brand's style and visual identity.</li>
                <li><span class="font-semibold text-gray-800">Scheduled Distribution:</span> Automate your publishing schedule and manage your subscriber list for seamless delivery.</li>
                <li><span class="font-semibold text-gray-800">Performance Analytics:</span> Gain insights into key metrics, such as open rates and click-through rates, to optimize future campaigns.</li>
            </ul>
        </section>

        <!-- Image Mockup -->
        <div class="mt-12 rounded-lg overflow-hidden shadow-lg">
            <img src="{{ asset('images/Newsletter-Mockup.png') }}" 
                 alt="A mockup of a clean, professional newsletter template." 
                 class="w-full h-auto">
        </div>
    </div>
</div>
@endsection
