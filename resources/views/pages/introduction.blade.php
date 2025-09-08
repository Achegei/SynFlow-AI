@extends('layouts.public')

@section('title', 'Introduction - SynFlow AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-8 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
        <div class="max-w-5xl mx-auto">
            <!-- Header Section -->
            <header class="text-center">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center justify-center gap-2">
                    <img src="{{ asset('images/laban.jpeg') }}" 
                         alt="Laban Ekitela" 
                         class="w-8 h-8 rounded-full object-cover shadow-sm">
                    <span class="flex items-center space-x-2">
                        <span>Laban Ekitela</span>
                        <span class="text-gray-400 font-normal">|</span>
                        <span>Co-Founder</span>
                        <span class="text-gray-400 font-normal">|</span>
                        <span>May 18th, 2025</span>
                    </span>
                </p>
            </header>

            <!-- Purpose & Vision -->
            <section class="mt-12 text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-indigo-700 dark:text-gray-100">
                    Our Purpose & Vision
                </h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                    SynFlow AI was founded to empower businesses with tailored, self-governing AI systems. 
                    Our mission is to help you unlock growth by optimizing operations and providing scalable, 
                    long-term solutions.
                </p>
            </section>

            <!-- Video Section -->
            <div class="mt-8 relative max-w-3xl mx-auto aspect-video rounded-2xl shadow-xl overflow-hidden">
                <iframe 
                    class="absolute top-0 left-0 w-full h-full" 
                    src="https://www.youtube.com/embed/pFnEnYKczTA" 
                    title="SynFlow AI Introduction" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
            <p class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
                A brief video from our team explaining our mission, vision, and unique approach to AI.
            </p>

            <hr class="my-12 border-gray-200 dark:border-gray-700">

            <!-- Getting Started Cards -->
            <section class="mt-12 text-center max-w-5xl mx-auto">
                <h2 class="text-3xl font-bold text-indigo-700 dark:text-gray-100">Getting Started</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                    We've designed this documentation to be intuitive and straightforward, making it easy to integrate our solutions. Here's what you need to know to begin.
                </p>

                <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
                    <!-- Navigating Docs -->
                    <div class="group p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl shadow hover:shadow-xl border border-transparent hover:border-indigo-600 transition duration-300">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                            <h3 class="text-xl font-semibold text-indigo-700 dark:text-gray-100 group-hover:text-gray-900">
                                Navigating the Docs
                            </h3>
                        </div>
                        <p class="mt-4 text-gray-600 dark:text-gray-400">
                            Use the sidebar to browse categories like <strong>Technology Stack</strong> and <strong>AI Agents</strong>. 
                            For specific information, use the <kbd class="px-2 py-1 text-xs font-mono bg-gray-200 dark:bg-gray-700 rounded">search bar</kbd>.
                        </p>
                    </div>

                    <!-- Who This Is For -->
                    <div class="group p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl shadow hover:shadow-xl border border-transparent hover:border-indigo-600 transition duration-300">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a3 3 0 015.356-1.857M2 20h2v-2a3 3 0 015.356-1.857M20 10a5 5 0 00-10 0v5h5a5 5 0 0010 0v-5zm-5 0a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-indigo-700 dark:text-gray-100 group-hover:text-gray-900">
                                Who This Is For
                            </h3>
                        </div>
                        <p class="mt-4 text-gray-600 dark:text-gray-400">
                            This documentation is for developers, product managers, operations teams, and business leaders who want to understand and integrate AI into their workflows.
                        </p>
                    </div>

                    <!-- How to Work With Us -->
                    <div class="group p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl shadow hover:shadow-xl border border-transparent hover:border-indigo-600 transition duration-300">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M8 12h.01M12 12h.01M16 12h.01M21 12c.552 0 1 .448 1 1v7c0 .552-.448 1-1 1H3c-.552 0-1-.448-1-1v-7c0-.552.448-1 1-1h18zM4 12v-6a2 2 0 012-2h12a2 2 0 012 2v6" />
                            </svg>
                            <h3 class="text-xl font-semibold text-indigo-700 dark:text-gray-100 group-hover:text-gray-900">
                                How to Work With Us
                            </h3>
                        </div>
                        <p class="mt-4 text-gray-600 dark:text-gray-400">
                            Our partnership plans start at <strong>Kes 100,000</strong> per month. 
                            To begin, visit our <a href="{{ route('contact') }}" class="text-indigo-600 hover:underline">Contact Page</a> and fill out the form with details about your project.
                        </p>
                    </div>
                </div>
            </section>

            <hr class="my-12 border-gray-200 dark:border-gray-700">

            <!-- Tips & Feedback -->
            <section class="mt-12 text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-indigo-700 dark:text-gray-100">Tips & Feedback</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                    Every page is designed for clarity and quick reference. You'll find concise explanations, helpful videos, and code snippets. We're always working to improve this documentation, so if you notice anything missing or unclear, please let us know.
                </p>
            </section>
        </div>
    </div>
</div>
@endsection
