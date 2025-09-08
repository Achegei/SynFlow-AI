@extends('layouts.public')

@section('title', 'Technology Stack - SailrHorizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')

    <article class="mx-auto max-w-5xl px-6 lg:px-8 py-12">

        <!-- Header -->
        <header class="text-center">
            <p class="text-sm font-semibold text-gray-500 flex items-center justify-center gap-2">
                <img src="{{ asset('images/laban.jpeg') }}" alt="Laban Ekitela" 
                     class="w-9 h-9 rounded-full object-cover shadow-sm">
                <span class="flex items-center space-x-2">
                    <span>Laban Ekitela</span>
                    <span class="text-gray-400 font-normal">|</span>
                    <span>Co-Founder</span>
                    <span class="text-gray-400 font-normal">|</span>
                    <span>May 18th, 2025</span>
                </span>
            </p>
            <h1 class="mt-6 text-5xl font-extrabold tracking-tight text-indigo-700 sm:text-6xl">
                Technology Stack
            </h1>
        </header>

        <!-- Intro -->
        <section class="mt-12 text-gray-700 leading-relaxed text-center max-w-3xl mx-auto">
            <p class="text-lg">
                At <span class="font-semibold text-gray-900">SynFlow AI</span>, we use a modular, forward-thinking 
                tech stack built for speed, agility, and robust scalability. 
                Our stack blends cloud infrastructure, developer tools, and proven AI frameworks—
                designed to make innovation accessible for both technical and non-technical stakeholders.
            </p>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Infrastructure -->
        <section>
            <h2 class="text-3xl font-bold text-indigo-700 text-center">Infrastructure</h2>
            <p class="mt-4 text-lg text-gray-600 text-center max-w-3xl mx-auto">
                Our systems primarily run on <span class="font-medium text-gray-600">AWS</span> and 
                support multi-cloud deployments across <span class="font-medium">Azure</span>, 
                <span class="font-medium">GCP</span>, and <span class="font-medium">DigitalOcean</span>.
            </p>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Supabase</h3>
                    <p class="mt-2 text-gray-600">Open-source backend for authentication and real-time updates.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">PostgreSQL</h3>
                    <p class="mt-2 text-gray-600">Primary database chosen for reliability and scalability.</p>
                </div>
               <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Vector Databases</h3>
                    <p class="mt-2 text-gray-600">Pinecone, Weaviate, and Qdrant enable semantic search & contextual AI.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">API Key Provisioning</h3>
                    <p class="mt-2 text-gray-600">Scoped permissions ensure secure access control for every client.</p>
                </div>
            </div>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Programming & Integrations -->
        <section>
            <h2 class="text-3xl font-bold text-indigo-700 text-center">Programming & Integrations</h2>
            <p class="mt-4 text-lg text-gray-600 text-center max-w-3xl mx-auto">
                We prioritize rapid iteration, automation, and deep integration with modern tools.
            </p>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Languages</h3>
                    <p class="mt-2 text-gray-600">Python for AI/backends, JavaScript & TypeScript for frontends.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Developer Tools</h3>
                    <p class="mt-2 text-gray-600">Replit and Cursor support collaboration and prototyping.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Integration Layer</h3>
                    <p class="mt-2 text-gray-600">n8n connects to 850+ SaaS tools, databases, and webhooks.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Voice AI</h3>
                    <p class="mt-2 text-gray-600">ElevenLabs powers natural, human-like speech synthesis.</p>
                </div>
            </div>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Artificial Intelligence -->
        <section>
            <h2 class="text-3xl font-bold text-indigo-700 text-center">Artificial Intelligence</h2>
            <p class="mt-4 text-lg text-gray-600 text-center max-w-3xl mx-auto">
                We are <span class="font-medium">model-agnostic</span>, integrating with all major LLMs 
                and benchmarking for client-specific needs—speed, accuracy, or cost.
            </p>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">RAG (Retrieval-Augmented Generation)</h3>
                    <p class="mt-2 text-gray-600">Enhances LLMs with your data for context-aware, accurate responses.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Embedding Models</h3>
                    <p class="mt-2 text-gray-600">We experiment with strategies to improve semantic understanding.</p>
                </div>
               <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">Agent Frameworks</h3>
                    <p class="mt-2 text-gray-600">Our AI agents search, summarize, and trigger workflows in real time.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-600 transition-colors duration-300">
                    <h3 class="text-xl font-semibold text-indigo-700">LLM Evaluation</h3>
                    <p class="mt-2 text-gray-600">Continuous scoring ensures requests route to the best model.</p>
                </div>
            </div>
        </section>
    </article>
</div>
@endsection
