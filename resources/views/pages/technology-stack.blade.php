@extends('layouts.public')

@section('title', 'Technology Stack - SailrHorizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')
<div class="max-w-4xl mx-auto">
    <header class="text-center">
        <p class="text-sm font-semibold text-gray-500">
            <span class="inline-block">Laban Ekitela</span> | Co-Founder | May 18th, 2025
        </p>
        <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">Technology Stack</h1>
    </header>

    <div class="mt-12">
        <p class="text-lg text-gray-600">
            At SynFlow AI, we use a modular, forward-thinking tech stack built for speed, agility, and robust scalability. Our tools are a strategic mix of cutting-edge cloud infrastructure, developer-centric platforms, and proven AI frameworks. We choose technologies based on their performance, ease of integration, and alignment with your specific project goals. We've designed our stack to make innovation accessible and reliable for both technical and non-technical stakeholders.
        </p>
        <div class="mt-8 rounded-lg overflow-hidden shadow-lg">
            
        </div>
    </div>

    <hr class="my-12 border-gray-300">

    <!-- Infrastructure Section -->
    <section>
        <h2 class="text-3xl font-bold text-gray-900">Infrastructure</h2>
        <p class="mt-4 text-lg text-gray-600">
            Our systems primarily run on a full **AWS** cloud environment, a highly secure and scalable platform. We also have expertise in multi-cloud environments, supporting deployments on **Azure**, **Google Cloud Platform (GCP)**, and **DigitalOcean** to meet diverse client needs and regulatory requirements.
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Supabase:</span> We use this open-source backend for streamlined authentication and real-time updates.</li>
            <li><span class="font-semibold text-gray-800">PostgreSQL:</span> Our primary database for structured data, chosen for its reliability and precision.</li>
            <li><span class="font-semibold text-gray-800">Vector Databases:</span> We utilize specialized databases like **Pinecone**, **Weaviate**, and **Qdrant** to power semantic search and contextual understanding.</li>
            <li><span class="font-semibold text-gray-800">API Key Provisioning:</span> We provide dedicated keys with scoped permissions to ensure your data remains secure and access is tightly controlled.</li>
        </ul>
    </section>

    <hr class="my-12 border-gray-300">

    <!-- Programming & Integrations Section -->
    <section>
        <h2 class="text-3xl font-bold text-gray-900">Programming & Integrations</h2>
        <p class="mt-4 text-lg text-gray-600">
            Our development approach is driven by tools that enable fast iterations, intelligent automation, and deep integration.
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Languages:</span> We rely on **Python** for our AI and backend systems, and **JavaScript/TypeScript** for front-end development.</li>
            <li><span class="font-semibold text-gray-800">Developer Tools:</span> We use platforms such as **Replit** and **Cursor** for collaborative, real-time code generation and rapid prototyping.</li>
            <li><span class="font-semibold text-gray-800">Integration Layer:</span> Thanks to our partnership with **n8n**, we offer seamless integration with over 850+ SaaS tools, databases, and webhook services.</li>
            <li><span class="font-semibold text-gray-800">Voice AI:</span> We use **ElevenLabs** for high-quality voice synthesis to build natural and responsive conversational agents.</li>
        </ul>
    </section>

    <hr class="my-12 border-gray-300">

    <!-- Artificial Intelligence Section -->
    <section>
        <h2 class="text-3xl font-bold text-gray-900">Artificial Intelligence</h2>
        <p class="mt-4 text-lg text-gray-600">
            We are **model-agnostic**, meaning our systems are designed to work with all major LLM providers. We benchmark models to select the best one for your specific needs, whether that's for speed, accuracy, or cost-efficiency.
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Retrieval-Augmented Generation (RAG):</span> We enhance LLM responses with relevant context from your internal data, ensuring accuracy and reducing hallucinations.</li>
            <li><span class="font-semibold text-gray-800">Embedding Model Selection:</span> We conduct small-scale experiments to fine-tune embedding strategies, which helps our AI systems better understand and compare information.</li>
            <li><span class="font-semibold text-gray-800">Agent Frameworks:</span> Our agents are built to go beyond simple chat, capable of searching, summarizing, and triggering automated workflows based on real-time input.</li>
            <li><span class="font-semibold text-gray-800">LLM Evaluation:</span> We continuously assess response quality using internal scoring and dynamically route requests to the best-performing model for each task.</li>
        </ul>
    </section>
</div>
</div>
@endsection
