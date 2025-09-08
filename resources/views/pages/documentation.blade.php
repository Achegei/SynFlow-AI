@extends('layouts.public')

@section('title', 'Documentation - SynFlow AI')

@section('content')

<div class="flex">
    <!-- Sidebar -->
    @include('pages.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-8 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
        <div class="max-w-6xl mx-auto">
            <!-- Hero -->
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl">
                <span class="block">SynFlow AI</span>
                <span class="block bg-gradient-to-r from-indigo-600 to-indigo-400 bg-clip-text text-transparent">
                    Documentation
                </span>
            </h1>
            <p class="mt-6 text-xl text-gray-600 dark:text-gray-400 max-w-3xl">
                Comprehensive documentation covering our AI solutions, implementation guides, best practices, and
                integration tutorials. Learn how to leverage our cutting-edge artificial intelligence services to drive
                your business needs.
            </p>

            <!-- Docs Grid -->
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Introduction -->
                <a href="{{route('introduction')}}"
                   class="group bg-gray-50 dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl border border-transparent hover:border-indigo-600 transition duration-300">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600">
                        Introduction
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                        Learn how to implement your AI agents and get started with our platform.
                    </p>
                </a>

                <!-- Technology Stack -->
                <a href="{{route('technology')}}"
                   class="group bg-gray-50 dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl border border-transparent hover:border-indigo-600 transition duration-300">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600">
                        Technology Stack
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                        Explore the technologies behind our solutions and how to implement and customize your agents.
                    </p>
                </a>

                <!-- SailRizon AI Agents -->
                <a href="#agents-overview"
                   class="group bg-gray-50 dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl border border-transparent hover:border-indigo-600 transition duration-300">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600">
                        SailRizon AI Agents
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                        Detailed guides on how to implement and customize our pre-built AI agents.
                    </p>
                </a>

                <!-- Customer Showcase -->
                <a href="#customer-showcase"
                   class="group bg-gray-50 dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl border border-transparent hover:border-indigo-600 transition duration-300">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600">
                        Customer Project Showcase
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                        Browse through our case studies and see real-world examples of our solutions in action.
                    </p>
                </a>

                <!-- Our Process -->
                <a href="{{route('processes')}}"
                   class="group bg-gray-50 dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl border border-transparent hover:border-indigo-600 transition duration-300">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600">
                        Our Process
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                        Documentation for using our code-based solutions and workflows.
                    </p>
                </a>

                <!-- Additional Resources -->
                <a href="#resources"
                   class="group bg-gray-50 dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl border border-transparent hover:border-indigo-600 transition duration-300">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600">
                        Additional Resources
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                        Additional resources for advanced use cases and support.
                    </p>
                </a>
            </div>
        </div>
    </main>
</div>

<script>
    // Collapsible AI Agents Dropdown
    const agentsBtn = document.getElementById('agents-dropdown-btn');
    const agentsMenu = document.getElementById('agents-dropdown-menu');
    const agentsIcon = document.getElementById('agents-dropdown-icon');

    if (agentsBtn) {
        agentsBtn.addEventListener('click', () => {
            const isHidden = agentsMenu.classList.toggle('hidden');
            agentsIcon.classList.toggle('rotate-180', !isHidden);
        });
    }

    // Dark Mode Toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark');
            localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
        });
    }

    // Set initial theme
    if (localStorage.getItem('theme') === 'dark' ||
        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        body.classList.add('dark');
    } else {
        body.classList.remove('dark');
    }
</script>
@endsection
