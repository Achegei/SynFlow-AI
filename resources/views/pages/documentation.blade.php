@extends('layouts.public')

@section('title', 'Documentation - SynFlow AI')

@section('content')

<style>
    /* Dark mode classes for Tailwind */
    .dark .text-gray-900 {
        color: #e5e7eb;
    }
    .dark .text-gray-600 {
        color: #9ca3af;
    }
    .dark .bg-white {
        background-color: #1f2937;
    }
    .dark .bg-gray-50 {
        background-color: #111827;
    }
    .dark .bg-gray-100 {
        background-color: #1f2937;
    }
    .dark .bg-gray-800 {
        background-color: #1f2937;
    }
</style>

<div class="flex">
    <!-- Sidebar -->
        @include('pages.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-8 bg-white text-gray-900">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl">SynFlow AI Documentation</h1>
            <p class="mt-4 text-xl text-gray-600">
                Comprehensive documentation covering our AI solutions, implementation guides, best practices, and integration tutorials. Learn how to leverage our cutting-edge artificial intelligence services to drive your business needs.
            </p>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Introduction Card -->
                <a href="{{route('introduction')}}" class="block p-6 bg-gray-100 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-semibold text-gray-800">Introduction</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Learn how to implement your AI agents and get started with our platform.
                    </p>
                </a>
                <!-- Technology Stack Card -->
                <a href="{{route('technology')}}" class="block p-6 bg-gray-100 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-semibold text-gray-800">Technology Stack</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Explore the technologies behind our solutions and how to implement and customize your agents.
                    </p>
                </a>
                <!-- True Horizon AI Agents Card -->
                <a href="#agents-overview" class="block p-6 bg-gray-100 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-semibold text-gray-800">SailRizon AI Agents</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Detailed guides on how to implement and customize our pre-built AI agents.
                    </p>
                </a>
                <!-- Customer Project Showcase Card -->
                <a href="#customer-showcase" class="block p-6 bg-gray-100 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-semibold text-gray-800">Customer Project Showcase</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Browse through our case studies and see real-world examples of our solutions in action.
                    </p>
                </a>
                <!-- Our Process Card -->
                <a href="{{route('processes')}}" class="block p-6 bg-gray-100 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-semibold text-gray-800">Our Process</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Documentation for using our code-based solutions and workflows.
                    </p>
                </a>
                <!-- Additional Resources Card -->
                <a href="#resources" class="block p-6 bg-gray-100 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-semibold text-gray-800">Additional Resources</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Additional resources for advanced use cases and support.
                    </p>
                </a>
            </div>
        </div>
    </main>

    <script>
        // Collapsible AI Agents Dropdown
        const agentsBtn = document.getElementById('agents-dropdown-btn');
        const agentsMenu = document.getElementById('agents-dropdown-menu');
        const agentsIcon = document.getElementById('agents-dropdown-icon');

        agentsBtn.addEventListener('click', () => {
            const isHidden = agentsMenu.classList.toggle('hidden');
            if (isHidden) {
                agentsIcon.classList.remove('rotate-180');
            } else {
                agentsIcon.classList.add('rotate-180');
            }
        });
        
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const body = document.body;

        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark');
            if (body.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });

        // Set initial theme based on localStorage
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            body.classList.add('dark');
        } else {
            body.classList.remove('dark');
        }
    </script>
</div>

@endsection