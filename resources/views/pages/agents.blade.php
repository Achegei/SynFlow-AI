@extends('layouts.public')

@section('title', 'AI Agents - SailRizon AI')

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
            <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-indigo-700 sm:text-6xl">AI Agents</h1>
        </header>

        <!-- Intro -->
        <div class="mt-12 max-w-3xl mx-auto text-center">
            <p class="text-lg text-gray-600 leading-relaxed">
                Our AI agents are designed for practical use and easy integration. Each agent shares a common core of features, ensuring consistency across our product line while allowing for specialized functionality to meet your unique business needs.
            </p>
            <div class="mt-8 rounded-xl overflow-hidden shadow-lg bg-white">
                <img src="{{ asset('images/ai-agents.jpg') }}" alt="AI Agents" class="w-full h-auto object-cover">
            </div>
        </div>

        <hr class="my-12 border-gray-300">

        <!-- Agent Design Philosophy -->
        <section class="mt-16 px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-indigo-700">Agent Design Philosophy</h2>
                <p class="mt-4 text-lg text-gray-600">We believe in creating AI agents that are:</p>
            </div>

            <div class="grid gap-6 mt-8 max-w-2xl mx-auto">
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Autonomous yet Collaborative</h3>
                    <p class="mt-2 text-gray-600">Capable of operating independently while maintaining human oversight.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Context-Aware</h3>
                    <p class="mt-2 text-gray-600">Able to understand and adapt to your specific business environment.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Secure & Compliant</h3>
                    <p class="mt-2 text-gray-600">Built with robust enterprise-grade security.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Scalable & Maintainable</h3>
                    <p class="mt-2 text-gray-600">Designed for easy scaling and long-term optimization.</p>
                </div>
            </div>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Core Features -->
        <section class="text-center max-w-3xl mx-auto py-12 px-4">
            <h2 class="text-3xl font-bold text-indigo-700">Core Features</h2>
            <p class="mt-4 text-lg text-gray-600">
                All our agents include a standard set of features to ensure a consistent and powerful experience:
            </p>
            <div class="grid gap-6 mt-8 text-left">
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Natural Language Understanding</h3>
                    <p class="mt-2 text-gray-600">Advanced comprehension of context and user intent.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Multi-Modal Communication</h3>
                    <p class="mt-2 text-gray-600">Support for text, voice, and structured data.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Seamless Integration</h3>
                    <p class="mt-2 text-gray-600">Connects easily with your existing systems and workflows.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Analytics & Reporting</h3>
                    <p class="mt-2 text-gray-600">Provides detailed insights into performance and usage.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Flexible Customization</h3>
                    <p class="mt-2 text-gray-600">Adapts to your specific business needs.</p>
                </div>
            </div>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Available Templates -->
        <section class="max-w-4xl mx-auto px-6 py-12 text-center">
            <h2 class="text-3xl font-bold text-indigo-700">Available Templates</h2>
            <p class="mt-4 text-lg text-gray-600">
                Our pre-built agent templates offer ready-to-use solutions for common business needs, designed for quick deployment and easy customization.
            </p>
            <div class="grid gap-6 mt-8 text-left max-w-3xl mx-auto">
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <a href="{{route('assistant')}}">
                        <h3 class="text-xl font-semibold text-indigo-700">Ultimate Assistant</h3>
                    </a>
                    <p class="mt-2 text-gray-600">A versatile AI assistant for handling multiple tasks and workflows.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <a href="{{route('research')}}">
                        <h3 class="text-xl font-semibold text-indigo-700">Deep Research PDF Report</h3>
                    </a>
                    <p class="mt-2 text-gray-600">A specialized agent for in-depth research and comprehensive report generation.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <a href="{{route('newsletter')}}">
                        <h3 class="text-xl font-semibold text-indigo-700">Newsletter Creation</h3>
                    </a>
                    <p class="mt-2 text-gray-600">An automated system for creating and distributing newsletters.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <a href="{{route('rag')}}">
                        <h3 class="text-xl font-semibold text-indigo-700">RAG Pipeline</h3>
                    </a>
                    <p class="mt-2 text-gray-600">A Retrieval-Augmented Generation pipeline to enhance AI responses with your internal data.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <a href="{{route('shorts')}}">
                        <h3 class="text-xl font-semibold text-indigo-700">Faceless Shorts</h3>
                    </a>
                    <p class="mt-2 text-gray-600">An automated system for creating short-form video content.</p>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
