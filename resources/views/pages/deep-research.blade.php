@extends('layouts.public')

@section('title', 'Deep Research PDF Report - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')
<div class="max-w-4xl mx-auto">
    <header class="text-center">
        <p class="text-sm font-semibold text-gray-500">
            <span class="inline-block">Ali, Co-Founder</span> | May 18th, 2025
        </p>
        <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">Deep Research PDF Report</h1>
        <div class="mt-6 flex justify-center space-x-4">
            <a href="#back" class="text-indigo-600 hover:underline">← Back to Agents</a>
            <a href="/path/to/your/resource_file.pdf" download class="text-indigo-600 hover:underline">Download Resource File</a>
        </div>
    </header>

    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-900">Overview</h2>
        <p class="mt-4 text-lg text-gray-600">
            This specialized AI agent is designed to conduct in-depth research and compile its findings into comprehensive, well-structured PDF reports. It is ideal for tasks requiring detailed analysis and clear, professional output.
        </p>
    </div>

    <hr class="my-12 border-gray-300">

    <section>
        <h2 class="text-3xl font-bold text-gray-900">Core Functionality</h2>
        <p class="mt-4 text-lg text-gray-600">
            The agent's key features include:
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Advanced Research:</span> Gathers and analyzes information from multiple sources.</li>
            <li><span class="font-semibold text-gray-800">Automated Report Generation:</span> Converts research data into professional PDF documents.</li>
            <li><span class="font-semibold text-gray-800">Google Sheets Integration:</span> Uses a pre-defined Google Sheets template to manage and organize data for reporting.</li>
        </ul>
    </section>

    <hr class="my-12 border-gray-300">

    <section>
        <h2 class="text-3xl font-bold text-gray-900">How to Use</h2>
        <p class="mt-4 text-lg text-gray-600">
            To get started, you can use our pre-built Google Sheets template. Simply populate the sheet with your research parameters, and the agent will handle the rest.
        </p>
        <div class="mt-8">
            <a href="https://docs.google.com/spreadsheets/d/123456789/edit" class="inline-block px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">View Google Sheet Template</a>
        </div>

        <div class="mt-12 rounded-lg overflow-hidden shadow-lg">
            <img src="{{asset('images/deep-research.png')}}" alt="An example of a deep research report." class="w-full h-auto">
        </div>
    </section>
</div>
</div>

@endsection
