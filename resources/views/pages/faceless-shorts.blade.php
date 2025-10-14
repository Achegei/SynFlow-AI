@extends('layouts.public')

@section('title', 'Faceless Shorts - SailRizon AI')

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
                Faceless Shorts
            </h1>

            <div class="mt-6 flex justify-center space-x-4">
                <!-- Back Button -->
                <a href="#back"
                   class="px-6 py-2 bg-white text-indigo-600 font-semibold rounded-lg shadow-md border border-indigo-600 hover:bg-indigo-50 transition">
                    ← Back to Agents
                </a>

                <!-- Download Button -->
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
                This agent is an automated short-form video content creation system designed to help you produce
                high-volume video content without the need for on-camera talent. It automates the entire production
                process from script generation to final video export.
            </p>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Key Features -->
        <section class="mt-12 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-indigo-700">Key Features</h2>
            <p class="mt-4 text-lg text-gray-600">
                The Faceless Shorts agent streamlines your video production workflow with a range of powerful capabilities:
            </p>
            <ul class="mt-6 list-disc list-inside space-y-3 text-gray-600 text-left inline-block">
                <li><span class="font-semibold text-gray-800">Automated Scripting:</span> Generates engaging video scripts based on your topic and key points.</li>
                <li><span class="font-semibold text-gray-800">AI-Powered Voiceovers:</span> Creates natural-sounding voiceovers using our advanced voice AI.</li>
                <li><span class="font-semibold text-gray-800">Dynamic Visuals:</span> Automatically selects and syncs relevant video clips, images, and B-roll footage.</li>
                <li><span class="font-semibold text-gray-800">Seamless Integration:</span> Uses a simple Google Sheets template to manage all aspects of your video creation queue.</li>
            </ul>
        </section>

        <!-- Mockup -->
        <div class="mt-12 rounded-lg overflow-hidden shadow-lg">
            <img src="{{ asset('images/Faceless-Shorts.png') }}" 
                 alt="A mockup of a short-form video template." 
                 class="w-full h-auto">
        </div>

        <hr class="my-12 border-gray-300">

        <!-- How to Get Started -->
        <section class="mt-12 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-indigo-700">How to Get Started</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                Simply fill out our pre-formatted Google Sheets template with your video ideas, topics, and any specific content requirements. 
                Our system will then automatically process the entries and generate a queue of completed short-form videos.
            </p>
            
        </section>
    </div>
</div>
@endsection
