@extends('layouts.public')

@section('title', 'Leadership & Directors | Moose Loon AI Academy')

@section('content')
@php
    $leaders = [
        'haji' => [
            'name' => 'Haji Ali',
            'role' => 'Director – Canada–Africa AI Education Expansion',
            'location' => 'Canada | Africa',
            'bio' => 'Leading the Academy’s Canada–Africa expansion strategy, international education partnerships, and initiatives to advance practical AI education and workforce development across Africa.',
            'photo' => 'haji-ali.jpg',
        ],
        'laban' => [
            'name' => 'Laban Ekitela',
            'role' => 'Regional Director – East Africa | Technology, Academic & Certification Leadership',
            'location' => 'Nairobi, Kenya',
            'bio' => 'Provides executive leadership in regional operations, institutional partnerships, and strategic expansion across East Africa. Oversees technology strategy, software engineering, AI automation, curriculum development, professional certification, and academic quality assurance. Drives digital innovation, institutional collaboration, and the delivery of high-quality, industry-relevant AI education and workforce development programmes.',
            'photo' => 'laban-ekitela.jpg',
        ],
        'patrick' => [
            'name' => 'Mr. Patrick Koech',
            'role' => 'Country Deputy Director – Kenya | AI Education Partnerships & Corporate Training',
            'location' => 'Nairobi, Kenya',
            'bio' => 'Leads strategic partnerships with county governments, schools, colleges, and universities across Kenya. Coordinates corporate training in Responsible AI, Ethics & Governance while advancing the Academy’s national expansion, institutional partnerships, digital transformation, and AI workforce development initiatives.',
            'photo' => 'patrick-koech.jpg',
        ],
        'clide' => [
            'name' => 'Clide Ahmogah',
            'role' => 'Country Executive Director – Kenya | Media & Communications',
            'location' => 'Nairobi, Kenya',
            'bio' => 'Provides executive leadership in advancing AI education, strategic institutional partnerships, and national expansion across Kenya’s 47 counties. Oversees media relations, corporate communications, public relations, brand visibility, and stakeholder engagement, strengthening the Academy’s national presence and promoting its AI education and workforce development initiatives.',
            'photo' => 'clide-ahmogah.jpg',
        ],
        'evans' => [
            'name' => 'Evans Aloo',
            'role' => 'Chief Financial Officer (CFO)',
            'location' => 'Nairobi, Kenya',
            'bio' => 'Provides strategic financial leadership, overseeing corporate finance, budgeting, financial planning, and regulatory compliance. Manages financial operations, financial reporting, and resource allocation to ensure transparency, accountability, and sustainable growth across the Academy’s local and international operations.',
            'photo' => 'evans-aloo.jpg',
        ],
        'florida' => [
            'name' => 'Florida Jeruto',
            'role' => 'Head of Institutional Partnerships & International Career Opportunities',
            'location' => 'Nairobi, Kenya',
            'bio' => 'Leads strategic partnerships with educational institutions, Canadian employers, and international organizations to expand AI education and graduate career opportunities. Develops institutional collaborations, international employment pathways, professional referrals, and potential job placement opportunities for qualified Moose Loon AI Academy graduates, connecting AI talent with global workforce opportunities.',
            'photo' => 'florida-jeruto.jpg',
        ],
        'martin' => [
            'name' => 'Martin Orina',
            'role' => 'AI Education & Corporate Partnerships Manager',
            'location' => 'Nairobi, Kenya',
            'bio' => 'Manages strategic partnerships with educational institutions, corporations, and organizations across Kenya, promoting AI education, professional certification, and workforce development.',
            'photo' => 'martin-orina.jpg',
        ],
        'erastus' => [
            'name' => 'Erastus Kipkemei',
            'role' => 'Director of Digital Strategy & Social Media',
            'location' => 'Nairobi, Kenya',
            'bio' => 'Leads the Academy’s digital strategy, social media management, content creation, and online brand development. Oversees digital marketing campaigns, website presence, and social media engagement to strengthen brand visibility and expand the Academy’s online reach.',
            'photo' => 'erastus-kipkemei.jpg',
        ],
    ];

    $displayOrder = [
        'haji',
        'laban',
        'patrick',
        'clide',
        'evans',
        'florida',
        'martin',
        'erastus',
    ];
@endphp

<main class="min-h-screen bg-[#F5F8FC]">
    <section class="bg-[#071832] px-6 py-16 text-white md:py-20">
        <div class="mx-auto max-w-7xl">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-300">
                Our People
            </p>

            <h1 class="text-[2rem] md:text-[3rem] mt-4 font-bold tracking-tight">
                Leadership & Directors
            </h1>

            <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
                Meet the leadership team advancing practical AI education,
                responsible innovation, institutional partnerships, and
                international collaboration across Canada and Africa.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 md:py-20" aria-label="Academy leadership team">
        <div class="mb-10 text-center">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-600">
                Our Leadership Team
            </p>
            <h2 class="mt-3 text-[1.75rem] font-bold tracking-tight text-[#10203B] sm:text-[2rem] lg:text-[2.125rem]">
                The People Behind Our Mission
            </h2>
        </div>

        <div class="grid grid-cols-1 gap-y-16 sm:grid-cols-2 sm:gap-x-8 sm:gap-y-20 lg:grid-cols-3 lg:gap-x-10 lg:gap-y-24">
            @foreach($displayOrder as $key)
                @php
                    $leader = $leaders[$key];
                    $portrait = 'images/leadership/' . $leader['photo'];
                    $hasPortrait = is_file(public_path($portrait));
                @endphp

                <article class="flex min-w-0 flex-col">
                    <div class="aspect-[4/5] overflow-hidden rounded-2xl bg-[#E5ECF5] sm:rounded-3xl">
                        @if($hasPortrait)
                            <img
                                src="{{ asset($portrait) }}"
                                alt="Portrait of {{ $leader['name'] }}"
                                loading="lazy"
                                class="h-full w-full object-cover object-top"
                            >
                        @else
                            <div class="flex h-full items-center justify-center text-slate-400">
                                <span class="text-sm font-semibold">Portrait unavailable</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-1 flex-col pt-6">
                        <h3 class="text-lg font-bold leading-snug tracking-tight text-[#10203B] sm:text-xl">
                            {{ $leader['name'] }}
                        </h3>

                        <p class="mt-2 text-sm font-semibold leading-relaxed text-[#2161C3] sm:text-base">
                            {{ $leader['role'] }}
                        </p>

                        <p class="mt-2 text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Moose Loon AI Academy
                        </p>

                        <p class="mt-2 text-sm text-slate-500">
                            {{ $leader['location'] }}
                        </p>

                        <div class="mt-8 border-t border-slate-200 pt-5">
                            <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-[#2764C1]">
                                Professional Profile
                            </p>
                            <p class="mt-2 text-sm leading-6 text-slate-600 sm:text-base sm:leading-7">
                                {{ $leader['bio'] }}
                            </p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</main>
@endsection
