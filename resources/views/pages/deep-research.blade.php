@extends('layouts.public')

@section('title', 'Deep Research PDF Report - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
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
            <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-indigo-700 sm:text-6xl">
                Deep Research PDF Report
            </h1>

            <div class="mt-6 flex justify-center space-x-4">
                <a href="#back"
                   class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">
                    ← Back to Agents
                </a>
                <a href="/path/to/your/resource_file.pdf" download
                   class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition">
                    ⬇ Download Resource File
                </a>
            </div>
        </header>

        <!-- Overview -->
        <section class="mt-12 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-indigo-700">Overview</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                This specialized AI agent is designed to conduct in-depth research and compile its findings into comprehensive, well-structured PDF reports. 
                It is ideal for tasks requiring detailed analysis and clear, professional output.
            </p>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Core Functionality -->
        <section class="mt-12 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-indigo-700">Core Functionality</h2>
            <p class="mt-4 text-lg text-gray-600">
                The agent's key features include:
            </p>
            <ul class="mt-6 list-disc list-inside space-y-3 text-gray-600 text-left inline-block">
                <li><span class="font-semibold text-gray-800">Advanced Research:</span> Gathers and analyzes information from multiple sources.</li>
                <li><span class="font-semibold text-gray-800">Automated Report Generation:</span> Converts research data into professional PDF documents.</li>
                <li><span class="font-semibold text-gray-800">Google Sheets Integration:</span> Uses a pre-defined Google Sheets template to manage and organize data for reporting.</li>
            </ul>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- How to Use -->
        <section class="mt-12 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-indigo-700">How to Use</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                To get started, you can use our pre-built Google Sheets template. 
                Simply populate the sheet with your research parameters, and the agent will handle the rest.
            </p>

            <div class="mt-8">
                <a href="https://docs.google.com/spreadsheets/d/123456789/edit"
                   class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">
                    View Google Sheet Template
                </a>
            </div>

            <div class="mt-12 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('images/deep-research.png') }}" 
                     alt="An example of a deep research report." 
                     class="w-full h-auto">
            </div>
        </section>
    </div>
</div>
@endsection
