<!-- Sidebar -->
    <aside class="w-64 bg-gray-100 dark:bg-gray-800 p-6 h-screen overflow-y-auto sticky top-0">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Documentation</h3>
        
        <div class="mb-6">
            <label for="search" class="sr-only">Search documentation</label>
            <div class="relative rounded-md shadow-sm">
                <input type="text" id="search" name="search" class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2" placeholder="Search documentation...">
            </div>
        </div>

        <nav class="space-y-2">
            <a href="{{route('introduction')}}" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Introduction</a>
            <a href="{{route('technology')}}" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Technology Stack</a>
            <a href="{{route('processes')}}" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Our Process</a>
            <a href="#resources" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Resources</a>
            
            <!-- AI Agents Dropdown -->
            <div>
                <button id="agents-dropdown-btn" class="w-full flex justify-between items-center py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                    AI Agents
                    <svg class="w-4 h-4 transform transition-transform duration-200" id="agents-dropdown-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="agents-dropdown-menu" class="space-y-1 pl-4 mt-2 hidden">
                    <a href="{{route('agents')}}" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Overview</a>
                    <a href="{{route('assistant')}}" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Ultimate Assistant</a>
                    <a href="{{route('research')}}" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Deep Research PDF Report</a>
                    <a href="{{route('newsletter')}}" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Newsletter Creation</a>
                    <a href="{{route('rag')}}" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">RAG Pipeline</a>
                    <a href="{{route('shorts')}}" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Faceless Shorts</a>
                </div>
            </div>
            
            <!-- <a href="#customer-showcase" class="block py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Customer Showcase</a>-->
        </nav>
        
        <div class="mt-8 pt-8 border-t border-gray-300 dark:border-gray-700">
            <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Connect With Us</h4>
            <ul class="mt-2 space-y-1">
                <li><a href="#" class="text-indigo-600 hover:underline dark:text-indigo-400">YouTube</a></li>
                <li><a href="#" class="text-indigo-600 hover:underline dark:text-indigo-400">LinkedIn</a></li>
                <li><a href="#" class="text-indigo-600 hover:underline dark:text-indigo-400">Book a Call</a></li>
            </ul>
        </div>
        
        <!-- Dark Mode Toggle -->
        <div class="mt-8 pt-8 border-t border-gray-300 dark:border-gray-700">
            <button id="dark-mode-toggle" class="w-full text-left py-2 px-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                Dark Mode
            </button>
        </div>
    </aside>

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