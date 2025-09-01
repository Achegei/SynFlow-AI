@extends('layouts.public')

@section('title', 'About Us - SynFlow AI')

@section('content')

<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- About SynFlow AI Section -->
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">About SynFlow AI</h2>
            <p class="mt-4 text-xl text-gray-600">
                At SynFlow AI, we design, deploy, and maintain custom AI solutions to drive your business growth, seamlessly integrating with over 850 systems.
            </p>
            <div class="mt-8">
                <a href="#" class="inline-block px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700">
                    We're hiring!
                </a>
            </div>
        </div>

        <!-- Meet Our Team Section -->
        <div class="mt-20">
            <h3 class="text-3xl font-bold text-center text-gray-900">Meet Our Team</h3>
            
            <!-- Founders -->
<!-- Founders -->
            <div class="mt-12 text-center">
                <h4 class="text-2xl font-semibold text-gray-700">Founders</h4>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8 justify-items-center">
                    <!-- Laban Ekitela -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center w-64">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                            <img src="{{ asset('images/laban.jpeg') }}" alt="Laban Ekitela" class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-lg font-bold text-gray-900">Laban Ekitela</h5>
                        <p class="mt-1 text-sm text-gray-500">Co-Founder & CEO</p>
                        <a href="#" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium inline-block">LinkedIn</a>
                    </div>
                    <!-- Ali Mohammed -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center w-64">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                            <img src="{{ asset('images/Ali.jpeg') }}" alt="Ali Mohammed" class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-lg font-bold text-gray-900">Ali Mohammed</h5>
                        <p class="mt-1 text-sm text-gray-500">Co-Founder & CGO</p>
                        <a href="#" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium inline-block">LinkedIn</a>
                    </div>
                </div>
            </div>

            <!-- Team -->
    <div class="mt-12 text-center">
        <h4 class="text-2xl font-semibold text-gray-700">Team</h4>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
            <!-- John Doe -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center w-64">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/laban.jpeg') }}" alt="John Doe" class="w-full h-full object-cover">
                </div>
                <h5 class="text-lg font-bold text-gray-900">John Doe</h5>
                <p class="mt-1 text-sm text-gray-500">Vice President of Engineering</p>
                <a href="#" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium inline-block">LinkedIn</a>
            </div>
            <!-- Jane Smith -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center w-64">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/laban.jpeg') }}" alt="Jane Smith" class="w-full h-full object-cover">
                </div>
                <h5 class="text-lg font-bold text-gray-900">Jane Smith</h5>
                <p class="mt-1 text-sm text-gray-500">Technical Account Executive</p>
                <a href="#" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium inline-block">LinkedIn</a>
            </div>
            <!-- Foo Baz -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center w-64">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/laban.jpeg') }}" alt="Foo Baz" class="w-full h-full object-cover">
                </div>
                <h5 class="text-lg font-bold text-gray-900">Foo Baz</h5>
                <p class="mt-1 text-sm text-gray-500">AI Project Manager</p>
                <a href="#" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium inline-block">LinkedIn</a>
            </div>
            <!-- Placeholder 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center w-64">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/laban.jpeg') }}" alt="Placeholder 1" class="w-full h-full object-cover">
                </div>
                <h5 class="text-lg font-bold text-gray-900">Alice Johnson</h5>
                <p class="mt-1 text-sm text-gray-500">AI Engineer</p>
                <a href="#" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium inline-block">LinkedIn</a>
            </div>
            <!-- Placeholder 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center w-64">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/laban.jpeg') }}" alt="Placeholder 2" class="w-full h-full object-cover">
                </div>
                <h5 class="text-lg font-bold text-gray-900">Bob Williams</h5>
                <p class="mt-1 text-sm text-gray-500">AI Engineer</p>
                <a href="#" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium inline-block">LinkedIn</a>
            </div>
        </div>
    </div>

        <!-- Section Heading -->
        <div class="text-center mt-16">
            <h2 class="text-3xl font-extrabold text-gray-900">
                What Our Team Does
            </h2>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                Our team specializes in designing, implementing, and managing AI solutions that transform business operations, improve efficiency, and drive measurable results.
            </p>
        </div>
        <!-- Service Descriptions Section -->
        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Custom AI Agent Engineering -->
            <div class="bg-indigo-700 rounded-lg shadow-md p-8">
                <h4 class="text-xl font-bold text-white">Custom AI Agent Engineering</h4>
                <p class="mt-4 text-white">
                    We architect, deploy, and maintain AI systems tailored to your specific business operations—designed to drive measurable outcomes and long-term scalability.
                </p>
            </div>
            <!-- Fully Managed -->
            <div class="bg-indigo-700 rounded-lg shadow-md p-8">
                <h4 class="text-xl font-bold text-white">Fully Managed</h4>
                <p class="mt-4 text-white">
                    Our team builds and manages end-to-end automation systems that integrate seamlessly into your workflows, unlocking efficiency and reducing manual overhead.
                </p>
            </div>

            <div class="bg-indigo-700 rounded-lg shadow-md p-8">
                <h4 class="text-xl font-bold text-white">AI Partner</h4>
                <p class="mt-4 text-white">
                    We partner with your team to assess opportunities for AI implementation, align solutions with business goals, and ensure successful adoption across departments.
                </p>
            </div>
        </div>
    </div>
</div>
  

    <div class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
            <span class="block text-indigo-600">Our Three Pillars</span>
        </h1>
        <P>At SynFlow AI, we're more than just AI developers; we're dedicated partners. Our mission is to help your business achieve measurable growth with custom, scalable, and efficient AI solutions that are perfectly aligned with your strategic goals.

We serve as your strategic partner on your transformation journey, whether you're aiming to optimize operations, automate tasks, or find new ways to connect with customers. By combining our deep technical expertise with a business-first approach, we focus on delivering real, impactful results.</P>
    </div>


            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Step 1: Identify -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 2m0 0l-2-2m2 2V9m6 6h-2M9 9h2m2-2h-2m2 2h2m0 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-2xl font-bold text-gray-900">Identify</h3>
                    <p class="mt-2 text-gray-500">
                        We begin by helping you pinpoint high-impact AI opportunities within your organization. We work with you to develop a strategic, step-by-step roadmap to bring these transformative ideas to life.
                    </p>
                </div>

                <!-- Step 2: Educate -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.433 9.356 5 8 5c-2.432 0-4.417 1.229-5.188 3.018A6.832 6.832 0 002 9c0 1.954.753 3.734 1.944 5L12 22 20.056 14C21.247 12.266 22 10.485 22 9c0-1.282-.572-2.417-1.47-3.267C19.583 5.229 17.568 5 15.188 5c-1.356 0-2.832.433-4.004 1.253z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-2xl font-bold text-gray-900">Educate</h3>
                    <p class="mt-2 text-gray-500">
                        We empower your team with the knowledge and tools they need to embed AI across your entire organization. Our training and support ensure your people are equipped for the future of work.
                    </p>
                </div>

                <!-- Step 3: Develop -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-2xl font-bold text-gray-900">Develop</h3>
                    <p class="mt-2 text-gray-500">
                        Leveraging our extensive experience and network, we build custom AI solutions that are designed to deliver tangible results and move the needle for your business.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Closing Statement -->
    <div class="container mx-auto px-4 py-16 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Ready to Become an AI-First Company?
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Let's start your transformation journey together. Whether you're just starting out or ready to build your next-generation AI system, SynFlow AI is here to guide you every step of the way.
            </p>
            <div class="mt-8">
                <a href="{{ route('contactus') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Contact Us Today
                </a>
            </div>
        </div>
    </div>
@endsection
