@extends('layouts.public')

@section('title', 'Technology Stack - SailrHorizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')

    <article class="prose prose-lg mx-auto max-w-4xl px-6 lg:px-8">

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
            <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">
                Technology Stack
            </h1>
        </header>

        <!-- Intro -->
        <section class="mt-12 text-gray-700 leading-relaxed">
            <p class="text-lg">
                At <span class="font-semibold text-gray-900">SynFlow AI</span>, we use a modular, forward-thinking 
                tech stack built for speed, agility, and robust scalability. 
                Our tools are a strategic mix of cutting-edge cloud infrastructure, 
                developer-centric platforms, and proven AI frameworks. We choose 
                technologies based on performance, ease of integration, and alignment 
                with your specific goals. The stack is designed to make innovation 
                accessible and reliable for both technical and non-technical stakeholders.
            </p>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Infrastructure Section -->
        <section>
            <h2 class="text-3xl font-bold text-gray-900">Infrastructure</h2>
            <p class="mt-4 text-lg text-gray-700">
                Our systems primarily run on a full 
                <span class="font-medium text-indigo-600">AWS</span> cloud environment, 
                a highly secure and scalable platform. We also support multi-cloud deployments 
                across <span class="font-medium">Azure</span>, 
                <span class="font-medium">Google Cloud Platform (GCP)</span>, and 
                <span class="font-medium">DigitalOcean</span> to meet diverse client needs 
                and regulatory requirements.
            </p>
            <ul class="mt-4 list-disc list-inside space-y-2 text-gray-700">
                <li><span class="font-semibold text-gray-900">Supabase:</span> open-source backend for auth and real-time updates.</li>
                <li><span class="font-semibold text-gray-900">PostgreSQL:</span> our primary database, chosen for reliability.</li>
                <li><span class="font-semibold text-gray-900">Vector Databases:</span> Pinecone, Weaviate, and Qdrant for semantic search and contextual understanding.</li>
                <li><span class="font-semibold text-gray-900">API Key Provisioning:</span> scoped permissions for secure access control.</li>
            </ul>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Programming & Integrations Section -->
        <section>
            <h2 class="text-3xl font-bold text-gray-900">Programming & Integrations</h2>
            <p class="mt-4 text-lg text-gray-700">
                Our development approach prioritizes rapid iteration, intelligent automation, 
                and deep integration.
            </p>
            <ul class="mt-4 list-disc list-inside space-y-2 text-gray-700">
                <li><span class="font-semibold text-gray-900">Languages:</span> Python for AI/backends; JavaScript/TypeScript for frontends.</li>
                <li><span class="font-semibold text-gray-900">Developer Tools:</span> Replit and Cursor for real-time collaboration and prototyping.</li>
                <li><span class="font-semibold text-gray-900">Integration Layer:</span> n8n enables seamless connections to 850+ SaaS tools, databases, and webhooks.</li>
                <li><span class="font-semibold text-gray-900">Voice AI:</span> ElevenLabs powers natural and responsive speech synthesis.</li>
            </ul>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- Artificial Intelligence Section -->
        <section>
            <h2 class="text-3xl font-bold text-gray-900">Artificial Intelligence</h2>
            <p class="mt-4 text-lg text-gray-700">
                We are <span class="font-medium">model-agnostic</span>, meaning our systems are 
                designed to integrate with all major LLM providers. Models are benchmarked 
                for each client use case — optimizing for speed, accuracy, or cost-efficiency.
            </p>
            <ul class="mt-4 list-disc list-inside space-y-2 text-gray-700">
                <li><span class="font-semibold text-gray-900">Retrieval-Augmented Generation (RAG):</span> combines LLMs with your data for accurate, context-aware responses.</li>
                <li><span class="font-semibold text-gray-900">Embedding Model Selection:</span> experiments optimize vectorization strategies for smarter data understanding.</li>
                <li><span class="font-semibold text-gray-900">Agent Frameworks:</span> agents can search, summarize, and trigger workflows in real time.</li>
                <li><span class="font-semibold text-gray-900">LLM Evaluation:</span> continuous scoring ensures each request is routed to the best model.</li>
            </ul>
        </section>

    </article>
</div>
@endsection
