@extends('layouts.public')

@section('title', 'Home - MooseLoon AI')
<style>
/* CSS for the sliding animation */
@keyframes slide {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.animate-slide {
    animation: slide 30s linear infinite;
}

/* Accordion transition */
.accordion-content {
    transition: max-height 0.3s ease-in-out;
}
</style>

@section('content')
    <section class="relative min-h-screen bg-gray-900 flex items-center justify-center text-center px-4 sm:px-6 lg:px-8">
        <div class="absolute inset-0">
            <img src="{{ asset('images/aiherobg.jpg') }}" alt="AI background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/25"></div>
        </div>

        <div class="relative max-w-3xl">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white">
                <span class="block">We build intelligent AI solutions that solve real-world problems</span>
                <span class="block text-indigo-500 mt-2">to cut costs, boost productivity, and drive measurable growth.</span>
            </h1>
            <p class="mt-6 text-lg sm:text-xl text-gray-300">
                Turn repetitive workflows into smart, automated systems that save time and reduce costs.
            </p>
            <div class="mt-8 flex justify-center gap-4 flex-wrap">
                <a href="{{ route('careers') }}" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg shadow-lg hover:bg-indigo-700 transition">
                    Explore Sales Programs
                </a>
                <a href="{{ route('register') }}" class="px-6 py-3 bg-indigo-100 text-indigo-700 font-medium rounded-lg hover:bg-indigo-200 transition">
                    Ready to Start Your AI Sales Training? Begin Journey
                </a>
            </div>
        </div>
    </section>

    <!-- Moose Loon AI — Income Skills Section -->
        <section class="bg-white py-16">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="mx-auto max-w-4xl text-center">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">
                        Moose Loon AI — We Teach You How to Make Money With AI
                    </h2>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        At Moose Loon AI, we don’t teach theory — we teach <span class="font-semibold text-indigo-600">income-generating skills.</span>
                        You can skip the traditional university path completely and still build a high-income future because:
                    </p>

                    <div class="bg-indigo-50 border-l-4 border-indigo-600 p-6 rounded-lg mb-10">
                        <p class="text-lg text-gray-800">
                            <span class="font-bold text-indigo-700">All our instructors and AI Sales Professors</span> have already made
                            millions using AI skills.  
                            They teach the exact systems they used to transform their own lives — no theory,
                            no guesswork, only real-world income strategies.
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="my-12">
                        <div class="border-t border-gray-300 w-24 mx-auto"></div>
                    </div>

                    <!-- Truth -->
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">The Truth About the Future of Work</h3>
                    <p class="text-gray-700 mb-8">
                        AI will not replace you — but people who know how to use AI <span class="font-semibold text-indigo-600">will.</span>
                        This is the new reality.
                    </p>

                    <!-- Only Time in History -->
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">The Only Time in History</h3>
                    <p class="text-gray-700 mb-8">
                        For the first time ever, a single skill can outperform a university degree.
                        In the AI era, the person who masters automation, AI tools, and digital systems will earn more,
                        advance faster, and become more valuable — <span class="font-semibold text-indigo-600">regardless of academic background.</span>
                    </p>

                    <p class="text-lg font-semibold text-gray-800 italic mb-12">
                        This is why Moose Loon AI exists.
                    </p>

                    <!-- Your Future Starts Here -->
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Your Future Starts Here</h3>
                    <p class="text-gray-700 mb-6">
                        Universities teach you how to study.  
                        <span class="font-bold text-indigo-700">We teach you how to earn.</span>
                    </p>

                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left max-w-2xl mx-auto mb-12">
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600 font-bold">•</span> AI business solutions
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600 font-bold">•</span> AI sales mastery
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600 font-bold">•</span> Workflow automation
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600 font-bold">•</span> Digital communication
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600 font-bold">•</span> Customer support AI
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600 font-bold">•</span> Modern productivity systems
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600 font-bold">•</span> AI-powered entrepreneurship
                        </li>
                    </ul>

                    <!-- Shortcut -->
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">🌍 Your Shortcut to Success</h3>
                    <p class="text-gray-700 mb-6">
                        When you join Moose Loon AI, you gain:
                    </p>

                    <ul class="text-left max-w-2xl mx-auto space-y-3 text-gray-800 mb-12">
                        <li>• Access to professors who already earned millions from AI</li>
                        <li>• Real, practical, income-producing skills</li>
                        <li>• A fast career path without needing a degree</li>
                        <li>• Opportunities in sales, automation, business solutions, and global AI jobs</li>
                    </ul>

                    <p class="text-xl font-semibold text-gray-900">
                        This is education for the AI generation.  
                        <br>This is your chance to succeed faster than ever before.
                    </p>
                </div>
            </div>
        </section>



    <!-- New Section: Impact & Results -->
    
                <!-- Collaborating Brands Slider -->
        <div class="container mx-auto px-4 text-center py-12">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl mb-6">
                Trusted by Leading Platforms and Partners
            </h2>
            <div class="relative overflow-hidden h-20">
                <div class="absolute inset-0 flex items-center justify-start space-x-12">
                    <div class="flex-shrink-0 flex items-center space-x-12 animate-slide">
                        <img class="h-16 w-auto" src="{{asset('images/N8n-logo-new.png')}}" alt="n8n">
                        <img class="h-16 w-auto" src="{{asset('images/Make-Logo.png')}}" alt="Make.com">
                        <img class="h-16 w-auto" src="{{asset('images/Zapier_Logo.png')}}" alt="Zapier">
                        <img class="h-16 w-auto" src="{{asset('images/Canva_Logo.png')}}" alt="Canva">
                        <img class="h-16 w-auto" src="{{asset('images/Amazon_Web_Services_Logo.png')}}" alt="AWS">
                        <img class="h-16 w-auto" src="{{asset('images/Relevance_AI_Logo.png')}}" alt="Relevance AI">
                    </div>
                    <div class="flex-shrink-0 flex items-center space-x-12 animate-slide">
                        <img class="h-16 w-auto" src="{{asset('images/N8n-logo-new.png')}}" alt="n8n">
                        <img class="h-16 w-auto" src="{{asset('images/Make-Logo.png')}}" alt="Make.com">
                        <img class="h-16 w-auto" src="{{asset('images/Zapier_Logo.png')}}" alt="Zapier">
                        <img class="h-16 w-auto" src="{{asset('images/Canva_Logo.png')}}" alt="Canva">
                        <img class="h-16 w-auto" src="{{asset('images/Amazon_Web_Services_Logo.png')}}" alt="AWS">
                        <img class="h-16 w-auto" src="{{asset('images/Relevance_AI_Logo.png')}}" alt="Relevance AI">
                    </div>
                </div>
            </div>
        </div>


    <div class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="md:grid md:grid-cols-2 md:gap-12 md:items-center">
                    <!-- Left Text & Features -->
                    <div class="md:text-left">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            All-in-One AI & Automation Hub
                        </h2>
                        <p class="mt-4 text-xl text-gray-500">
                            Tools and features designed to simplify, automate, and scale your business operations
                        </p>

                        <div class="mt-8 space-y-6">
                            <!-- Feature Item -->
                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Tailored AI Agents for Your Business
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        We design and maintain AI agents that directly support your growth goals—cutting costs, improving speed, and driving results.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Fully Managed automation pipelines
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        Robust data infrastructure and ingestion processes are a critical component in how we build out our systems.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v.01M16 12v.01M16 16v.01M12 8v.01M12 12v.01M12 16v.01M8 8v.01M8 12v.01M8 16v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Performance analytic dashboard
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        Easily track ROI and efficiency gains with custom metrics on your AI agent's performance.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Intelligent access control
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        Manage agent permissions with your teams to ensure secure operations across your organization.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 flex items-center justify-center bg-indigo-100 rounded-full group-hover:bg-indigo-600 transition">
                                        <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                        Secure and compliant protocols
                                    </h3>
                                    <p class="mt-1 text-gray-600">
                                        Technology architecture that is fully hosted in the cloud, ensuring compliance with SOC-2, ISO, and other industry standards.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="mt-12 md:mt-0">
                        <img class="rounded-lg shadow-xl hover:scale-105 transition-transform duration-500" src="{{asset('images/AI-Solutions.png')}}" alt="A visual representation of an all-in-one platform with various icons.">
                    </div>
                </div>
            </div>
    </div>


                <div class="py-16">
                    <div class="container mx-auto px-4">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 text-center sm:text-4xl">
                            How We Build AI That Works
                        </h2>

                        <div class="mt-12 md:mt-16 md:grid md:grid-cols-2 md:gap-12 md:items-center">
                            <div class="md:text-left">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-500 text-white text-xl font-bold">1</span>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-bold text-gray-900">Discovery</h3>
                                        <p class="mt-1 text-gray-600">
                                            We begin by understanding your vision, goals, and requirements. Through collaborative discussions and research, we lay the foundation for your project's success.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 md:mt-0">
                                <img class="w-full rounded-lg shadow-xl" src="{{asset('images/Discovery-Phase.png')}}" alt="A team collaborating and brainstorming during the discovery phase.">
                            </div>
                        </div>

                        <div class="mt-12 md:mt-16 md:grid md:grid-cols-2 md:gap-12 md:items-center">
                            <div class="md:text-left">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-500 text-white text-xl font-bold">2</span>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-bold text-gray-900">Development</h3>
                                        <p class="mt-1 text-gray-600">
                                            Our team transforms ideas into reality through agile development. We build, test, and iterate, ensuring your solution meets the highest standards of quality and performance.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 md:mt-0">
                                <img class="w-full rounded-lg shadow-xl" src="{{asset('images/Development-Process.png')}}" alt="A team of developers working on code and building a solution.">
                            </div>
                        </div>

                        <div class="mt-12 md:mt-16 md:grid md:grid-cols-2 md:gap-12 md:items-center">
                            <div class="md:text-left">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-500 text-white text-xl font-bold">3</span>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-bold text-gray-900">Deployment</h3>
                                        <p class="mt-1 text-gray-600">
                                            We carefully launch your solution, ensuring a smooth transition to production. Our team provides ongoing support and optimization to keep your system running at its best.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 md:mt-0">
                                <img class="w-full rounded-lg shadow-xl" src="{{asset('images/Deployment.png')}}" alt="A visual representation of a successful software deployment.">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AI Agent Components Section -->
                <div class="py-16 bg-gray-50">
                    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
                        <!-- Text Content -->
                        <div>
                            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                                What Makes an AI Agent Work
                            </h2>
                            <p class="mt-4 text-lg text-gray-600">
                                Behind every AI agent are three building blocks working together
                            </p>

                            <div class="mt-8 space-y-6">
                                <!-- Brain -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-xl">
                                        🧠
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-800">Brain</h3>
                                        <p class="text-gray-600">The decision-making core—powered by AI models that understand, analyze, and reason.</p>
                                    </div>
                                </div>

                                <!-- Memory -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-green-100 text-green-600 rounded-xl">
                                        💾
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-800">Memory</h3>
                                        <p class="text-gray-600">Stores past interactions and knowledge, enabling context-aware and consistent responses.</p>
                                    </div>
                                </div>

                                <!-- Tools -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-xl">
                                        🛠️
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-800">Tools</h3>
                                        <p class="text-gray-600">External APIs, databases, and integrations that extend the agent’s real-world capabilities.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="flex justify-center">
                            <img src="{{asset('images/agent.jpg')}}" alt="AI Agent Components" class="rounded-xl shadow-lg max-h-120 object-contain">
                        </div>
                    </div>
                </div>

                <!-- Good Prompt Section -->
                    <div class="py-16 bg-gray-50">
                        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
                            
                            <!-- Left Content -->
                            <div class="md:w-1/2 text-center md:text-left">
                                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                                    Great AI Starts with the Right Instruction
                                </h2>
                                <p class="mt-4 text-lg text-gray-600">
                                    Clear instructions make AI smarter. The better the prompt, the better the outcomes.
                                </p>
                            </div>

                            <!-- Right Image -->
                            <div class="md:w-1/2">
                                <img src="{{asset('images/prompt.jpg')}}" alt="Good Prompt Illustration" class="rounded-lg shadow-lg w-full">
                            </div>
                        </div>
                    </div>
                    <!-- End Good Prompt Section -->



                
            <!-- <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                Metric 1
                <div class="bg-white rounded-lg shadow-lg p-6">
                    The data-target attribute holds the final number to count to.
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="17000">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        Professionals upskilled in AI via our platforms
                    </p>
                </div>

                Metric 2 
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="435">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        AI Opportunities identified for businesses
                    </p>
                </div>

                 Metric 3 
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="15">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        Bespoke AI solutions developed
                    </p>
                </div>
            </div> -->
        </div>
    </div> 

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Select all elements with the 'data-counter' class.
            const counters = document.querySelectorAll('.data-counter');

            // Set up a new IntersectionObserver to watch for elements entering the viewport.
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    // Check if the element is currently visible.
                    if (entry.isIntersecting) {
                        const counterElement = entry.target;
                        // Get the target number from the 'data-target' attribute.
                        const target = parseInt(counterElement.dataset.target, 10);
                        const duration = 2000; // Animation duration in milliseconds.
                        const startTimestamp = performance.now();
                        
                        // Define the update function for the animation frame.
                        const updateCount = (timestamp) => {
                            const elapsed = timestamp - startTimestamp;
                            const progress = Math.min(elapsed / duration, 1);
                            const currentValue = Math.floor(progress * target);
                            
                            // Format the number based on its size and add the appropriate suffix.
                            let formattedValue;
                            if (target >= 1000) {
                                formattedValue = (currentValue / 1000).toFixed(1) + 'K+';
                            } else {
                                formattedValue = currentValue + '+';
                            }
                            
                            counterElement.textContent = formattedValue;
                            
                            // Continue the animation until progress is 1.
                            if (progress < 1) {
                                requestAnimationFrame(updateCount);
                            }
                        };
                        
                        // Start the animation.
                        requestAnimationFrame(updateCount);

                        // Stop observing the element after the animation has started.
                        observer.unobserve(counterElement);
                    }
                });
            }, {
                // The threshold determines how much of the element needs to be visible to trigger the observer.
                threshold: 0.5
            });

            // Tell the observer to watch each counter element.
            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
         function toggleAccordion(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById(`icon-${id}`);
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-45');
        }
    </script>
@endsection