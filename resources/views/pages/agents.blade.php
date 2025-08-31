@extends('layouts.public')

@section('title', 'AI Agents - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')
<div class="max-w-4xl mx-auto">
    <header class="text-center">
        <p class="text-sm font-semibold text-gray-500">
            <span class="inline-block">Nate, Co-Founder</span> | May 18th, 2025
        </p>
        <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">AI Agents</h1>
    </header>

    <div class="mt-12">
        <p class="text-lg text-gray-600">
            Our AI agents are designed for practical use and easy integration. Each agent shares a common core of features, ensuring consistency across our product line while allowing for specialized functionality to meet your unique business needs.
        </p>
        <div class="mt-8 rounded-lg overflow-hidden shadow-lg">
            
        </div>
    </div>

    <hr class="my-12 border-gray-300">

    <!-- Agent Design Philosophy Section -->
    <section>
        <h2 class="text-3xl font-bold text-gray-900">Agent Design Philosophy</h2>
        <p class="mt-4 text-lg text-gray-600">
            We believe in creating AI agents that are:
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Autonomous yet Collaborative:</span> Capable of operating independently while maintaining human oversight.</li>
            <li><span class="font-semibold text-gray-800">Context-Aware:</span> Able to understand and adapt to your specific business environment.</li>
            <li><span class="font-semibold text-gray-800">Secure & Compliant:</span> Built with robust enterprise-grade security.</li>
            <li><span class="font-semibold text-gray-800">Scalable & Maintainable:</span> Designed for easy scaling and long-term optimization.</li>
        </ul>
    </section>

    <hr class="my-12 border-gray-300">

    <!-- Core Features Section -->
    <section>
        <h2 class="text-3xl font-bold text-gray-900">Core Features</h2>
        <p class="mt-4 text-lg text-gray-600">
            All our agents include a standard set of features to ensure a consistent and powerful experience:
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Natural Language Understanding:</span> Advanced comprehension of context and user intent.</li>
            <li><span class="font-semibold text-gray-800">Multi-Modal Communication:</span> Support for text, voice, and structured data.</li>
            <li><span class="font-semibold text-gray-800">Seamless Integration:</span> Connects easily with your existing systems and workflows.</li>
            <li><span class="font-semibold text-gray-800">Analytics & Reporting:</span> Provides detailed insights into performance and usage.</li>
            <li><span class="font-semibold text-gray-800">Flexible Customization:</span> Adapts to your specific business needs.</li>
        </ul>
    </section>

    <hr class="my-12 border-gray-300">
    
    <!-- Available Templates Section -->
    <section>
        <h2 class="text-3xl font-bold text-gray-900">Available Templates</h2>
        <p class="mt-4 text-lg text-gray-600">
            Our pre-built agent templates offer ready-to-use solutions for common business needs, designed for quick deployment and easy customization.
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Ultimate Assistant:</span> A versatile AI assistant for handling multiple tasks and workflows.</li>
            <li><span class="font-semibold text-gray-800">Deep Research PDF Report:</span> A specialized agent for in-depth research and comprehensive report generation.</li>
            <li><span class="font-semibold text-gray-800">Newsletter Creation:</span> An automated system for creating and distributing newsletters.</li>
            <li><span class="font-semibold text-gray-800">RAG Pipeline:</span> A Retrieval-Augmented Generation pipeline to enhance AI responses with your internal data.</li>
            <li><span class="font-semibold text-gray-800">Faceless Shorts:</span> An automated system for creating short-form video content.</li>
        </ul>
    </section>
</div>
</div>
@endsection
