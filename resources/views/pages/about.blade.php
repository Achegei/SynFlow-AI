@extends('layouts.public')

@section('title', 'About Us - MooseLoon AI')

@section('content')

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-indigo-700 to-indigo-900 text-white py-20">
    <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h1 class="text-5xl font-extrabold leading-tight">About MooseLoon AI</h1>
            <p class="mt-6 text-lg text-indigo-100">
               We design, deploy, and maintain custom AI solutions that cut costs, reduce waste, and boost efficiency — seamlessly
            </p>
            <div class="mt-8">
                <a href="{{route('careers')}}" class="px-8 py-4 bg-white text-indigo-700 font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition">
                    Join Our Team
                </a>
            </div>
        </div>
        <div class="hidden md:block">
            <img src="{{ asset('images/ai-illustration.png') }}" alt="AI Illustration" class="w-full max-w-md mx-auto">
        </div>
    </div>
</section>

<!-- Meet Our Team -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-extrabold text-gray-900">The People Behind MooseLoon AI</h2>
        
        <!-- Founders -->
        <div class="mt-12">
            <h3 class="text-2xl font-semibold text-indigo-700">Our Founders</h3>
            <div class="mt-8 grid md:grid-cols-2 gap-12">
                @foreach ([['name'=>'Laban Ekitela','role'=>'Developer and Strategic Partner','img'=>'laban.jpeg'],['name'=>'Ali Mohammed','role'=>'Director & Founder','img'=>'Ali.jpeg']] as $founder)
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition transform hover:-translate-y-1">
                    <div class="w-32 h-32 mx-auto rounded-full ring-4 ring-indigo-700 overflow-hidden">
                        <img src="{{ asset('images/'.$founder['img']) }}" alt="{{ $founder['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <h4 class="mt-4 text-xl font-bold text-gray-900">{{ $founder['name'] }}</h4>
                    <p class="text-sm text-gray-500">{{ $founder['role'] }}</p>
                    <a href="#" class="mt-4 inline-flex items-center text-indigo-700 hover:text-indigo-900 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5C4.98 4.88..."/></svg>
                        <!--LinkedIn -->
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Team Members -->
        <div class="mt-16">
            <h3 class="text-2xl font-semibold text-indigo-700">Our Team Members</h3>
            <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- repeat member card structure here -->
                <!-- Example: -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition transform hover:-translate-y-1">
                    <div class="w-28 h-28 mx-auto rounded-full ring-2 ring-indigo-600 overflow-hidden">
                        <img src="{{ asset('images/laban.jpeg') }}" alt="John Doe" class="w-full h-full object-cover">
                    </div>
                    <h4 class="mt-4 text-lg font-bold text-gray-900">Laban Ekitela</h4>
                    <p class="text-sm text-gray-500">Developer and Strategic Partner</p>
                    <!-- <a href="#" class="mt-3 inline-flex items-center text-indigo-700 hover:text-indigo-900 font-medium">LinkedIn</a> -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What Our Team Does -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-extrabold text-indigo-700">What We Do</h2>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
            We design and manage AI solutions that simplify operations, reduce costs, and deliver measurable impact.
        </p>
        <div class="mt-12 grid md:grid-cols-3 gap-8">
            <div class="p-8 bg-indigo-700 text-white rounded-xl shadow-lg hover:shadow-xl transition">
                <h4 class="text-xl font-bold">Custom AI Agent Engineering</h4>
                <p class="mt-3">We build tailored AI systems that align with your industry needs and growth goals.</p>
            </div>
            <div class="p-8 bg-indigo-700 text-white rounded-xl shadow-lg hover:shadow-xl transition">
                <h4 class="text-xl font-bold">Fully Managed</h4>
                <p class="mt-3">We handle everything — from design to management — so your automation just works.</p>
            </div>
            <div class="p-8 bg-indigo-700 text-white rounded-xl shadow-lg hover:shadow-xl transition">
                <h4 class="text-xl font-bold">AI Partner</h4>
                <p class="mt-3">We act as your long-term AI partner, uncovering opportunities and scaling solutions with you.</p>
            </div>
        </div>
    </div>
</section>

<!-- Three Pillars -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-extrabold text-indigo-700">Our Three Pillars</h2>
        <p class="mt-6 max-w-3xl mx-auto text-gray-600">At MooseLoon AI, we're more than developers — we’re your partners in creating future-proof business solutions</p>
        <div class="mt-12 grid md:grid-cols-3 gap-10">
            @foreach ([['step'=>'01','title'=>'Identify','desc'=>'We begin by helping you pinpoint high-impact AI opportunities.'],['step'=>'02','title'=>'Educate','desc'=>'We empower your team with the knowledge and tools.'],['step'=>'03','title'=>'Develop','desc'=>'Leveraging our extensive experience and network, We build intelligent AI solutions that solve your problems to cut costs, boost productivity, and drive measurable growth']] as $pillar)
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition">
                <div class="flex items-center justify-center w-14 h-14 rounded-full bg-indigo-700 text-white text-xl font-bold mx-auto">{{ $pillar['step'] }}</div>
                <h3 class="mt-6 text-2xl font-bold text-gray-900">{{ $pillar['title'] }}</h3>
                <p class="mt-3 text-gray-500">{{ $pillar['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Closing -->
<section class="py-20 bg-indigo-700 text-white">
    <div class="container mx-auto px-6 text-center max-w-3xl">
        <h2 class="text-3xl font-extrabold sm:text-4xl">Ready to Become an AI-First Company?</h2>
        <p class="mt-6 text-lg text-indigo-100">
           Let’s start your AI journey together — and make your company future-ready
        </p>
        <div class="mt-8">
            <a href="{{ route('contactus') }}" class="px-10 py-4 bg-white text-indigo-700 font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition">
                Talk to Us Today
            </a>
        </div>
    </div>
</section>

@endsection
