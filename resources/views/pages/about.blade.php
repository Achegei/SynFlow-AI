@extends('layouts.public')

@section('title', 'Meet the Team – Moose Loon AI Leadership')

@section('content')

<!-- HEADER -->
<section class="relative bg-gradient-to-r from-indigo-700 to-indigo-900 text-white py-20">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-extrabold leading-tight">Meet the Team Behind Moose Loon AI</h1>
        <p class="mt-6 text-lg text-indigo-100 max-w-2xl mx-auto">
            A global team of innovators driving the future of AI training and business automation.
        </p>
    </div>
</section>

<!-- EXECUTIVE TEAM -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-indigo-700 text-center">Executive Team</h2>
        <p class="text-center text-gray-600 mt-3">
            Moose Loon AI is led by experienced and internationally diverse leaders from Canada.
        </p>

        <div class="mt-12 grid md:grid-cols-3 lg:grid-cols-3 gap-10">
            @foreach([
                ['name'=>'Alexandre Bouchard','role'=>'Founder & Chief Executive Officer (CEO)','img'=>'team1.jpg','desc'=>'Leads the global strategy and vision of Moose Loon AI, guiding innovation and expansion across Canada, East Africa, and beyond.'],
                ['name'=>'Daniel McArthur','role'=>'Chief Operating Officer (COO)','img'=>'team2.jpg','desc'=>'Oversees operations, ensuring smooth execution and service excellence across all departments.'],
                ['name'=>'Olivia Bennett','role'=>'Chief Marketing Officer (CMO)','img'=>'team3.jpg','desc'=>'Leads global marketing, brand development, and community growth across international markets.'],
                ['name'=>'William Fraser','role'=>'Chief Technology Officer (CTO)','img'=>'team4.jpg','desc'=>'Directs engineering, system architecture, and AI automation development.'],
                ['name'=>'Amélie Gagnon','role'=>'Chief Financial Officer (CFO)','img'=>'team5.jpg','desc'=>'Manages corporate finance, budgeting, and international compliance.'],
                ['name'=>'Nathan Clarke','role'=>'Chief Sales Officer (CSO)','img'=>'team6.jpg','desc'=>'Leads sales teams, partnerships, and revenue expansion globally.']
            ] as $member)
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="w-32 h-32 mx-auto rounded-full ring-4 ring-indigo-700 overflow-hidden">
                    <img src="{{ asset('images/'.$member['img']) }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover">
                </div>
                <h4 class="mt-4 text-xl font-bold text-gray-900 text-center">{{ $member['name'] }}</h4>
                <p class="text-sm text-gray-500 text-center">{{ $member['role'] }}</p>
                <p class="mt-3 text-gray-600 text-center text-sm">{{ $member['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SENIOR LEADERSHIP -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-indigo-700 text-center">Senior Leadership</h2>
        <p class="text-center text-gray-600 mt-3">Our directors lead strategic operations worldwide.</p>

        <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach([
                ['name'=>'Michael Anderson','role'=>'Director of AI Business Solutions','img'=>'team7.jpg','desc'=>'Leads delivery of automation, chatbots, and enterprise AI workflows.'],
                ['name'=>'Chloé Tremblay','role'=>'Director of AI Training & Curriculum','img'=>'team8.jpg','desc'=>'Oversees AI courses, certifications, and instructor quality.'],
                ['name'=>'Logan Marshall','role'=>'Director of Operations & Compliance','img'=>'team9.jpg','desc'=>'Ensures smooth coordination, compliance, and internal processes.'],
                ['name'=>'Sophie Parker','role'=>'Director of International Expansion','img'=>'team10.jpg','desc'=>'Leads African, European, and Middle Eastern expansion strategies.'],
                ['name'=>'Ethan Brooks','role'=>'Director of Community & Student Success','img'=>'team11.jpg','desc'=>'Manages student communities, support systems, and engagement.'],
                ['name'=>'Isabelle Roy','role'=>'Director of Digital Strategy & Media','img'=>'team12.jpg','desc'=>'Leads content creation, digital media, and online brand strategy.']
            ] as $director)
            <div class="bg-gray-50 rounded-xl shadow-md p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="w-28 h-28 mx-auto rounded-full ring-2 ring-indigo-600 overflow-hidden">
                    <img src="{{ asset('images/'.$director['img']) }}" alt="{{ $director['name'] }}" class="w-full h-full object-cover">
                </div>
                <h4 class="mt-4 text-lg font-bold text-gray-900 text-center">{{ $director['name'] }}</h4>
                <p class="text-sm text-gray-500 text-center">{{ $director['role'] }}</p>
                <p class="mt-3 text-gray-600 text-center text-sm">{{ $director['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- GLOBAL OFFICES -->
<section class="py-20 bg-gray-100">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-extrabold text-indigo-700">Global Offices</h2>

        <div class="mt-12 grid md:grid-cols-2 gap-10">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold text-gray-900">🇨🇦 Canada Headquarters</h3>
                <p class="mt-3 text-gray-600">Executive & Technology Division</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold text-gray-900">🇰🇪 Nairobi Headquarters</h3>
                <p class="mt-3 text-gray-600">AI Business Solutions & Sales Division</p>
            </div>
        </div>

    </div>
</section>

@endsection
