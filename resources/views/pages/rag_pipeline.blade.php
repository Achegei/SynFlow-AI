@extends('layouts.public')

@section('title', 'RAG Pipeline - SailRizon AI')

@section('content')
<div class="flex">
    @include('pages.sidebar')

<div class="max-w-4xl mx-auto">
    <header class="text-center">
        <p class="text-sm font-semibold text-gray-500">
            <span class="inline-block">Laban Ekitela, Co-Founder</span> | May 18th, 2025
        </p>
        <p class="text-sm font-semibold text-gray-500">
            <span class="inline-block">Ali, Co-Founder</span> | May 18th, 2025
        </p>
        <h1 class="mt-4 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">RAG Pipeline</h1>
        <div class="mt-6 flex justify-center space-x-4">
            <a href="#back" class="text-indigo-600 hover:underline">← Back to Agents</a>
            <a href="/path/to/your/resource_file.pdf" download class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                Download Resource File
            </a>
        </div>
    </header>

    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-900">Overview</h2>
        <p class="mt-4 text-lg text-gray-600">
            Our Retrieval-Augmented Generation (RAG) pipeline is a powerful tool designed to enhance the accuracy and reliability of AI responses. By pulling context from your own data sources, the RAG pipeline ensures that the AI's answers are grounded in up-to-date and relevant information, significantly reducing the risk of "hallucinations."
        </p>
    </div>

    <hr class="my-12 border-gray-300">

    <section>
        <h2 class="text-3xl font-bold text-gray-900">How It Works</h2>
        <p class="mt-4 text-lg text-gray-600">
            The RAG process is divided into two main stages:
        </p>
        <ul class="mt-4 list-disc list-inside space-y-2 text-gray-600">
            <li><span class="font-semibold text-gray-800">Retrieval:</span> When a user asks a question, the pipeline first searches through your private, unstructured data (like PDFs, documents, and web pages) to find the most relevant information. This ensures the AI has the right context before generating a response.</li>
            <li><span class="font-semibold text-gray-800">Augmented Generation:</span> The retrieved information is then provided to the large language model as part of the prompt. The model uses this context to generate a precise and accurate answer that is directly based on your knowledge base.</li>
        </ul>
    </section>
    
    <div class="mt-12 rounded-lg overflow-hidden shadow-lg">
        <img src="{{asset('images/Pipeline-Diagram.png')}}" alt="A diagram illustrating a retrieval-augmented generation pipeline." class="w-full h-auto">
    </div>
</div>
</div>

@endsection
