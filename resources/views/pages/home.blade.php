@extends('layouts.public')

@section('title', 'Home - SynFlow AI')
<style>
/* CSS for the sliding animation */
@keyframes slide {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-100%);
    }
}
.animate-slide {
    animation: slide 30s linear infinite;
}
.accordion-content {
            transition: max-height 0.3s ease-in-out;
        }
</style>

@section('content')
    <div class="container mx-auto px-4 py-16 text-center">
    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
        <span class="block">We build intelligent AI Solutions</span>
        <span class="block text-indigo-600">designed for business growth.</span>
    </h1>
    <p class="mt-4 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
        Unlock untapped potential with safe, responsible, and powerful AI solutions.
    </p>
    <div class="mt-8 flex justify-center">
        <img src="{{asset('images/Business-Growth-Graph.png')}}" alt="A line graph showing significant business growth over time." class="w-full max-w-2xl rounded-lg shadow-xl">
    </div>
    <div class="mt-8 flex justify-center space-x-4">
        <a href="{{ route('services') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
            Explore Services
        </a>
        <a href="{{route('contactus')}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
            Get Started
        </a>
    </div>
</div>

    <!-- New Section: Impact & Results -->
    
                <div class="container mx-auto px-4 text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Collaborating with Leading Brands
                    </h2>
                    <div class="mt-8 relative overflow-hidden h-24">
                        <div class="absolute inset-0 flex items-center justify-start brand-slide-container">
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
            </div>

            <div class="py-16">
                    <div class="container mx-auto px-4">
                        <div class="md:grid md:grid-cols-2 md:gap-12 md:items-center">
                            <div class="md:text-left">
                                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                                    Everything You Need In One Place
                                </h2>
                                <p class="mt-4 text-xl text-gray-500">
                                    Powerful features designed to make your business seamless.
                                </p>
                                <div class="mt-8 space-y-8">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Custom AI agent engineering</h3>
                                            <p class="mt-1 text-gray-600">
                                                We design, deploy, and maintain custom AI agents specifically tailored to your business growth goals.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Fully Managed automation pipelines</h3>
                                            <p class="mt-1 text-gray-600">
                                                Robust data infrastructure and ingestion processes are a critical component in how we build out our systems.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v.01M16 12v.01M16 16v.01M12 8v.01M12 12v.01M12 16v.01M8 8v.01M8 12v.01M8 16v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Performance analytic dashboard</h3>
                                            <p class="mt-1 text-gray-600">
                                                Easily track ROI and efficiency gains with custom metrics on your AI agent's performance.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Intelligent access control</h3>
                                            <p class="mt-1 text-gray-600">
                                                Manage agent permissions with your teams to ensure secure operations across your organization.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Secure and compliant protocols</h3>
                                            <p class="mt-1 text-gray-600">
                                                Technology architecture that is fully hosted in the cloud, ensuring compliance with SOC-2, ISO, and other industry standards.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 md:mt-0">
                                <img class="rounded-lg shadow-xl" src="{{asset('images/AI-Solutions.png')}}" alt="A visual representation of an all-in-one platform with various icons.">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="py-16">
                    <div class="container mx-auto px-4">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 text-center sm:text-4xl">
                            Our Process
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

                <!-- FAQ Section -->
                <div class="py-16">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 text-center sm:text-4xl">
                        Frequently Asked Questions
                    </h2>
                    <p class="mt-4 text-xl text-gray-500 text-center">
                        Find answers to the most common questions about our services.
                    </p>

                    <div class="mt-12 max-w-4xl mx-auto space-y-6">
                        <!-- FAQ Item 1 -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <button class="w-full flex justify-between items-center text-left" onclick="toggleAccordion('faq1')">
                                <span class="text-lg font-medium text-gray-800">What types of businesses do you partner with?</span>
                                <!-- Plus/Minus Icon -->
                                <svg id="icon-faq1" class="w-6 h-6 transform transition-transform duration-300 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div id="faq1" class="accordion-content hidden">
                                <p class="mt-4 text-gray-600">
                                    We work with businesses of all sizes, from startups to large enterprises. However, we currently only accept partnerships with companies who have a minimum AI budget of $20,000 per month.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <button class="w-full flex justify-between items-center text-left" onclick="toggleAccordion('faq2')">
                                <span class="text-lg font-medium text-gray-800">How long does implementation usually take?</span>
                                <svg id="icon-faq2" class="w-6 h-6 transform transition-transform duration-300 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div id="faq2" class="accordion-content hidden">
                                <p class="mt-4 text-gray-600">
                                    To ensure maximum value, we recommend an engagement of at least three months. This period allows for sufficient time for consulting and strategic roadmapping. However, to provide continuous value and get your feedback, we aim to deliver an initial proof of concept (POC) within the first three weeks of our partnership.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <button class="w-full flex justify-between items-center text-left" onclick="toggleAccordion('faq3')">
                                <span class="text-lg font-medium text-gray-800">Who owns the intellectual property of the AI you build?</span>
                                <svg id="icon-faq3" class="w-6 h-6 transform transition-transform duration-300 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div id="faq3" class="accordion-content hidden">
                                <p class="mt-4 text-gray-600">
                                    You, the client, own all the intellectual property rights and licensing for the software we build, including custom code, workflows, and infrastructure. Upon completion or termination of our partnership, we provide a full, well-documented handoff with all necessary training and user guides. The IP is yours from day one.
                                </p>
                            </div>
                        </div>
                        
                        <!-- FAQ Item 4 -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <button class="w-full flex justify-between items-center text-left" onclick="toggleAccordion('faq4')">
                                <span class="text-lg font-medium text-gray-800">How is your pricing structured?</span>
                                <svg id="icon-faq4" class="w-6 h-6 transform transition-transform duration-300 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div id="faq4" class="accordion-content hidden">
                                <p class="mt-4 text-gray-600">
                                    Our pricing is based on a fixed monthly rate tied to clear deliverables and a defined timeline. In the initial discovery phase, we'll work with you to establish success criteria and a technical mutual action plan (TMAP). The final pricing is then determined by these agreed-upon outcomes.
                                </p>
                            </div>
                        </div>
                        
                        <!-- FAQ Item 5 -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <button class="w-full flex justify-between items-center text-left" onclick="toggleAccordion('faq5')">
                                <span class="text-lg font-medium text-gray-800">Do you offer any free training or resources?</span>
                                <svg id="icon-faq5" class="w-6 h-6 transform transition-transform duration-300 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div id="faq5" class="accordion-content hidden">
                                <p class="mt-4 text-gray-600">
                                    Yes! We provide free resources through our community of over 40,000 members and our weekly tutorials and walkthroughs on our YouTube channel.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ Item 6 -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <button class="w-full flex justify-between items-center text-left" onclick="toggleAccordion('faq6')">
                                <span class="text-lg font-medium text-gray-800">What industries do you specialize in?</span>
                                <svg id="icon-faq6" class="w-6 h-6 transform transition-transform duration-300 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div id="faq6" class="accordion-content hidden">
                                <p class="mt-4 text-gray-600">
                                    Our team has experience with a wide variety of industries, including SaaS, Retail, Finance, Real Estate, and E-commerce. Our consultative approach to AI is industry-agnostic, and we'd be happy to discuss your specific industry needs.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ Item 7 -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <button class="w-full flex justify-between items-center text-left" onclick="toggleAccordion('faq7')">
                                <span class="text-lg font-medium text-gray-800">Do you build custom solutions or use existing tools?</span>
                                <svg id="icon-faq7" class="w-6 h-6 transform transition-transform duration-300 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div id="faq7" class="accordion-content hidden">
                                <p class="mt-4 text-gray-600">
                                    Our approach is flexible and depends on the project's scope. We will either build a solution from scratch or leverage existing tools and frameworks if it's more efficient. We'll present you with all the data you need during our discovery process to make a well-informed decision together.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ Item 8 -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <button class="w-full flex justify-between items-center text-left" onclick="toggleAccordion('faq8')">
                                <span class="text-lg font-medium text-gray-800">How can I tell if AI is a good fit for my business?</span>
                                <svg id="icon-faq8" class="w-6 h-6 transform transition-transform duration-300 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <div id="faq8" class="accordion-content hidden">
                                <p class="mt-4 text-gray-600">
                                    If your business involves handling large amounts of data, repetitive tasks, complex customer interactions, or operational bottlenecks, AI can likely provide significant value. During our discovery process, we'll conduct a tailored assessment to identify the best AI use cases and estimate the potential return on investment (ROI) for your business.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Metric 1 -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <!-- The data-target attribute holds the final number to count to. -->
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="17000000">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        Professionals upskilled in AI via our platforms
                    </p>
                </div>

                <!-- Metric 2 -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="435">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        AI Opportunities identified for businesses
                    </p>
                </div>

                <!-- Metric 3 -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="55">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        Bespoke AI solutions developed
                    </p>
                </div>
            </div>
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
                            if (target >= 1000000) {
                                formattedValue = (currentValue / 1000000).toFixed(1) + 'M+';
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
