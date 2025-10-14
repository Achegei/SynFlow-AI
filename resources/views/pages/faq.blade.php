@extends('layouts.public')

@section('title', 'FAQ')

@section('content')
    <div class="container my-5">
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
                                    We work with businesses of all sizes, from startups to large enterprises. We Also offer AI Education and Training for individuals and teams looking to upskill in AI technologies.
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
                                    For those ideas that came from client, you the client, own all the intellectual property rights and licensing for the software we build, including custom code, workflows, and infrastructure. Upon completion or termination of our partnership, we provide a full, well-documented handoff with all necessary training and user guides. The IP is yours from day one. However those originating from us, we retain the rights.
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
                                    Yes! We provide free resources through our community and our weekly tutorials and walkthroughs on our YouTube channel.
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
                                    Our team has experience with a wide variety of industries, including SaaS, Education, Retail, Finance, Real Estate, and E-commerce. Our consultative approach to AI is industry-agnostic, and we'd be happy to discuss your specific industry needs.
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
@endsection
<script>
    function toggleAccordion(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById(`icon-${id}`);
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-45');
        }
</script>
