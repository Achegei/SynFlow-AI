@extends('layouts.public')

@section('title', 'Ultimate Assistant - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')
<div class="max-w-4xl mx-auto">
    <header class="text-center">
        <p class="text-sm font-semibold text-gray-500">
            <span class="inline-block">Laban Ekitela, Founder</span> | May 18th, 2025
        </p>
        <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">Ultimate Assistant</h1>
        <div class="mt-6 flex justify-center space-x-4">
            <a href="#back" class="text-indigo-600 hover:underline">← Back to Agents</a>
        </div>
    </header>

    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-900">Overview</h2>
        <p class="mt-4 text-lg text-gray-600">
            The Ultimate Assistant is a powerful AI agent designed to efficiently handle a wide range of tasks and workflows. It combines advanced natural language understanding with robust automation to serve as your personal, all-in-one AI partner.
        </p>
    </div>

    <hr class="my-12 border-gray-300">

    <section>
        <h2 class="text-3xl font-bold text-gray-900">Core Capabilities</h2>
        <p class="mt-4 text-lg text-gray-600">
            This agent is built to simplify your work by automating key processes. Its core capabilities include:
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Advanced Task Management:</span> Handles a variety of tasks, from simple data entry to complex process automation.</li>
            <li><span class="font-semibold text-gray-800">Seamless Integration:</span> Connects with your existing systems for a smooth workflow.</li>
            <li><span class="font-semibold text-gray-800">Natural Language Interaction:</span> Understands your requests and responds conversationally.</li>
            <li><span class="font-semibold text-gray-800">Automated Reporting:</span> Generates and delivers detailed reports based on your data.</li>
        </ul>
    </section>

    <hr class="my-12 border-gray-300">

    <section>
        <h2 class="text-3xl font-bold text-gray-900">How It Works</h2>
        <p class="mt-4 text-lg text-gray-600">
            The Ultimate Assistant uses intelligent automation to interpret requests and execute tasks. It's designed to adapt to your unique needs and can be customized to work within your specific business context.
        </p>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="rounded-lg overflow-hidden shadow-lg">
                <img src="{{asset('images/WorkflowDiagram.png')}}" alt="A diagram illustrating the assistant's workflow." class="w-full h-auto">
            </div>
            <div class="rounded-lg overflow-hidden shadow-lg">
                <img src="{{asset('images/WorkflowDiagram2.png')}}" alt="An example of the assistant's user interface." class="w-full h-auto">
            </div>
        </div>
    </section>
</div>
</div>

@endsection
