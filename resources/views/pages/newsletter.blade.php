@extends('layouts.public')

@section('title', 'Newsletter Creation - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')

<div class="max-w-4xl mx-auto">
    <header class="text-center">
        <p class="text-sm font-semibold text-gray-500 flex items-center justify-center gap-2">
                    <img src="{{ asset('images/laban.jpeg') }}" alt="Laban Ekitela" class="w-8 h-8 rounded-full object-cover shadow-sm">
                    <span class="flex items-center space-x-2">
                        <span>Laban Ekitela</span>
                        <span class="text-gray-400 font-normal">|</span>
                        <span>Co-Founder</span>
                        <span class="text-gray-400 font-normal">|</span>
                        <span>May 19th, 2025</span>
                    </span>
        </p>
        <div class="text-center mt-8">
    <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">
        Newsletter Creation
    </h1>

    <div class="mt-6 flex justify-center space-x-4">
        <!-- Back button -->
            <a href="#back"
            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-100">
                ← Back to Agents
            </a>

            <!-- Download button -->
            <a href="/path/to/your/resource_file.pdf" download
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                Download Resource File
            </a>
        </div>
    </div>

    </header>

    <div class="mt-12 text-center">
        <h2 class="text-3xl font-bold text-gray-900">Overview</h2>
        <p class="mt-4 text-lg text-gray-600">
            This AI-powered agent is a fully automated system for creating, formatting, and distributing newsletters. It streamlines your entire content workflow, allowing you to generate engaging content and manage your subscriber lists from a single, intuitive platform.
        </p>
    </div>

    <hr class="my-12 border-gray-300">

    <section class="mt-12 text-center">
        <h2 class="text-3xl font-bold text-gray-900">Key Features</h2>
        <p class="mt-4 text-lg text-gray-600">
            The Newsletter Creation agent is built to handle the entire process with these core capabilities:
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Automated Content Generation:</span> Uses AI to write articles, summaries, headlines, and calls-to-action based on your prompts or a curated list of sources.</li>
            <li><span class="font-semibold text-gray-800">Template Customization:</span> Choose from a library of professional templates and customize them to match your brand's style and visual identity.</li>
            <li><span class="font-semibold text-gray-800">Scheduled Distribution:</span> Automate your publishing schedule and manage your subscriber list for seamless delivery.</li>
            <li><span class="font-semibold text-gray-800">Performance Analytics:</span> Gain insights into key metrics, such as open rates and click-through rates, to optimize future campaigns.</li>
        </ul>
    </section>

    <div class="mt-12 rounded-lg overflow-hidden shadow-lg">
        <img src="{{asset('images/Newsletter-Mockup.png')}}" alt="A mockup of a clean, professional newsletter template." class="w-full h-auto">
    </div>
</div>
</div>
@endsection
