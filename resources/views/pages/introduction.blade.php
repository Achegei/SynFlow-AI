@extends('layouts.public')

@section('title', 'Introduction - SynFlow AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')
<div class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <header class="text-center">
                <p class="text-sm font-semibold text-gray-500">
                    <span class="inline-block">Laban Ekitela</span> | Co-Founder | May 18th, 2025
                </p>
                <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">Introduction</h1>
            </header>

            <!-- Purpose & Vision -->
            <section class="mt-12">
                <h2 class="text-3xl font-bold text-gray-900">Purpose & Vision</h2>
                <p class="mt-4 text-lg text-gray-600">
                    SynFlow AI was founded to empower businesses by delivering tailored, self-governing AI systems. Our mission is to help you unlock growth by optimizing your operations and providing scalable solutions for the long term.
                </p>
                
                <!-- Video Section -->
                <div class="mt-8 rounded-lg overflow-hidden shadow-lg">
                    <div class="relative w-full aspect-w-16 aspect-h-9">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/placeholder" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <p class="mt-4 text-center text-sm text-gray-500">
                    A brief video from our team explaining our mission, vision, and unique approach to AI.
                </p>
            </section>
            
            <hr class="my-12 border-gray-300">

            <!-- Getting Started -->
            <section>
                <h2 class="text-3xl font-bold text-gray-900">Getting Started</h2>
                <p class="mt-4 text-lg text-gray-600">
                    Welcome to SynFlow AI's documentation! This is your starting point for getting familiar with our tools, services, and collaborative process. We've designed this documentation to be intuitive and straightforward, making it easy to integrate our solutions.
                </p>

                <h3 class="mt-8 text-xl font-semibold text-gray-800">Navigating the Documentation</h3>
                <p class="mt-4 text-gray-600">
                    You can browse the documentation using the sidebar menu, where each main category is a collapsible dropdown. Explore sections like **Technology Stack**, **Our Process**, and **AI Agents**. For specific information, use the built-in search bar or press <kbd class="px-2 py-1 text-xs font-mono text-gray-800 bg-gray-200 rounded-md">⌘K</kbd> to activate our AI search tool, which can answer questions and direct you to relevant pages.
                </p>

                <h3 class="mt-8 text-xl font-semibold text-gray-800">Who This Is For</h3>
                <p class="mt-4 text-gray-600">
                    This documentation is for developers, product managers, operations teams, and business leaders looking to understand and integrate AI into their workflows. Whether you're starting a new project or embedding one of our agents, this guide will show you what's possible and how to get there.
                </p>

                <h3 class="mt-8 text-xl font-semibold text-gray-800">How to Work With Us</h3>
                <p class="mt-4 text-gray-600">
                    To begin a partnership with SynFlow AI, please visit our **Contact Page** and fill out the form with details about your project. The more information you provide, the better we can align our solutions with your needs. Our partnership plans currently start at $20,000 per month.
                </p>
            </section>

            <hr class="my-12 border-gray-300">
            
            <!-- Documentation Tips & Feedback -->
            <section>
                <h2 class="text-3xl font-bold text-gray-900">Documentation Tips</h2>
                <p class="mt-4 text-gray-600">
                    Every page is designed for clarity and quick reference. You'll find headings, concise explanations, and helpful videos, diagrams, and code snippets. Use these as a reference to understand how our tools work in practice.
                </p>

                <h3 class="mt-8 text-xl font-semibold text-gray-800">Feedback Welcome</h3>
                <p class="mt-4 text-gray-600">
                    We are always working to keep our documentation up to date and as helpful as possible. If you notice anything missing or unclear, please let us know. We continuously iterate based on client feedback and new AI capabilities.
                </p>
            </section>
        </div>
    </div>
</div>
</div>
@endsection