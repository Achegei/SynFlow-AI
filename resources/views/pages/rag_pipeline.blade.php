@extends('layouts.public')

@section('title', 'RAG Pipeline - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <header class="text-center">
            <p class="text-sm font-semibold text-gray-500 flex items-center justify-center gap-2">
                <img src="{{ asset('images/laban.jpeg') }}" alt="Laban Ekitela" 
                     class="w-8 h-8 rounded-full object-cover shadow-sm">
                <span class="flex items-center space-x-2">
                    <span>Laban Ekitela</span>
                    <span class="text-gray-400 font-normal">|</span>
                    <span>Co-Founder</span>
                    <span class="text-gray-400 font-normal">|</span>
                    <span>May 19th, 2025</span>
                </span>
            </p>

            <h1 class="mt-6 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">
                RAG Pipeline
            </h1>

            <div class="mt-6 flex justify-center space-x-4">
                <!-- Back button -->
                <a href="#back"
                   class="px-6 py-2 bg-white text-gray-700 font-semibold rounded-lg shadow-md border border-gray-300 hover:bg-gray-100 transition">
                    ← Back to Agents
                </a>

                <!-- Download button -->
                <a href="/path/to/your/resource_file.pdf" download
                   class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">
                    ⬇ Download Resource File
                </a>
            </div>
        </header>

        <!-- Overview -->
        <section class="mt-12 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-indigo-700">Overview</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                Our Retrieval-Augmented Generation (RAG) pipeline is a powerful tool designed to enhance the accuracy and reliability of AI responses. 
                By pulling context from your own data sources, the RAG pipeline ensures that the AI's answers are grounded in up-to-date and relevant information, 
                significantly reducing the risk of "hallucinations."
            </p>
        </section>

        <hr class="my-12 border-gray-300">

        <!-- How It Works -->
        <section class="mt-12 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-indigo-700">How It Works</h2>
            <p class="mt-4 text-lg text-gray-600">
                The RAG process is divided into two main stages:
            </p>
            <ul class="mt-6 list-disc list-inside space-y-3 text-gray-600 text-left inline-block">
                <li>
                    <span class="font-semibold text-gray-800">Retrieval:</span> 
                    When a user asks a question, the pipeline first searches through your private, unstructured data 
                    (like PDFs, documents, and web pages) to find the most relevant information. 
                    This ensures the AI has the right context before generating a response.
                </li>
                <li>
                    <span class="font-semibold text-gray-800">Augmented Generation:</span> 
                    The retrieved information is then provided to the large language model as part of the prompt. 
                    The model uses this context to generate a precise and accurate answer that is directly based on your knowledge base.
                </li>
            </ul>
        </section>

        <!-- Diagram -->
        <div class="mt-12 rounded-lg overflow-hidden shadow-lg">
            <img src="{{ asset('images/Pipeline-Diagram.png') }}" 
                 alt="A diagram illustrating a retrieval-augmented generation pipeline." 
                 class="w-full h-auto">
        </div>
    </div>
</div>
@endsection
