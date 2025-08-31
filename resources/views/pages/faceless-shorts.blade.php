@extends('layouts.public')

@section('title', 'Faceless Shorts - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')

<div class="max-w-4xl mx-auto">
    <header class="text-center">
        <p class="text-sm font-semibold text-gray-500">
            <span class="inline-block">Laban Ekitela, Co-Founder</span> | May 18th, 2025
        </p>
        <p class="text-sm font-semibold text-gray-500">
            <span class="inline-block">Ali, Co-Founder</span> | May 18th, 2025
        </p>
        <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">Faceless Shorts</h1>
        <div class="mt-6 flex justify-center space-x-4">
            <a href="#back" class="text-indigo-600 hover:underline">← Back to Agents</a>
            <a href="/path/to/your/resource_file.pdf" download class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                Download Resource File
            </a>
        </div>
    </header>

    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-900">Overview</h2>
        <p class="mt-4 text-lg text-gray-600">
            This agent is an automated short-form video content creation system designed to help you produce high-volume video content without the need for on-camera talent. It automates the entire production process from script generation to final video export.
        </p>
    </div>

    <hr class="my-12 border-gray-300">

    <section>
        <h2 class="text-3xl font-bold text-gray-900">Key Features</h2>
        <p class="mt-4 text-lg text-gray-600">
            The Faceless Shorts agent streamlines your video production workflow with a range of powerful capabilities:
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Automated Scripting:</span> Generates engaging video scripts based on your topic and key points.</li>
            <li><span class="font-semibold text-gray-800">AI-Powered Voiceovers:</span> Creates natural-sounding voiceovers using our advanced voice AI.</li>
            <li><span class="font-semibold text-gray-800">Dynamic Visuals:</span> Automatically selects and syncs relevant video clips, images, and B-roll footage.</li>
            <li><span class="font-semibold text-gray-800">Seamless Integration:</span> Uses a simple Google Sheets template to manage all aspects of your video creation queue.</li>
        </ul>
    </section>

    <div class="mt-12 rounded-lg overflow-hidden shadow-lg">
        <img src="{{asset('images/Faceless-Shorts.png')}}" alt="A mockup of a short-form video template." class="w-full h-auto">
    </div>

    <hr class="my-12 border-gray-300">

    <section>
        <h2 class="text-3xl font-bold text-gray-900">How to Get Started</h2>
        <p class="mt-4 text-lg text-gray-600">
            Simply fill out our pre-formatted Google Sheets template with your video ideas, topics, and any specific content requirements. Our system will then automatically process the entries and generate a queue of completed short-form videos.
        </p>
        <div class="mt-8">
            <a href="https://docs.google.com/spreadsheets/d/123456789/edit" class="inline-block px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">View Google Sheet Template</a>
        </div>
    </section>
</div>
</div>

@endsection
