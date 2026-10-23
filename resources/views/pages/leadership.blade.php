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

    $levels = [
        ['haji'],
        ['laban', 'clide'],
        ['evans', 'florida', 'martin', 'erastus'],
    ];
@endphp

<main class="min-h-screen bg-[#F5F8FC]">
    <section class="bg-[#071832] px-6 py-16 text-white md:py-20">
        <div class="mx-auto max-w-7xl">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-300">
                Our People
            </p>

            <h1 class="mt-4 text-4xl font-bold tracking-tight md:text-5xl">
                Leadership & Directors
            </h1>

            <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
                Meet the leadership team advancing practical AI education,
                responsible innovation, institutional partnerships, and
                international collaboration across Canada and Africa.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 md:py-20" aria-label="Leadership organizational chart">
        <div class="mb-10 text-center">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-600">
                Our Leadership Structure
            </p>
            <h2 class="mt-3 text-2xl font-bold tracking-tight text-[#10203B] sm:text-3xl">
                The People Behind Our Mission
            </h2>
        </div>

        @foreach($levels as $levelIndex => $level)
            @if($levelIndex > 0)
                <div class="flex justify-center" aria-hidden="true">
                    <div class="h-8 w-px bg-blue-300"></div>
                </div>
            @endif

            @if(count($level) > 1)
                <div class="mx-auto hidden h-px bg-blue-300 md:block {{ count($level) === 2 ? 'w-[50%]' : 'w-[75%]' }}" aria-hidden="true"></div>
            @endif

            <div class="grid items-stretch gap-5 {{ count($level) === 1 ? 'mx-auto max-w-xl grid-cols-1' : (count($level) === 2 ? 'mx-auto max-w-5xl grid-cols-1 md:grid-cols-2' : 'grid-cols-1 sm:grid-cols-2 xl:grid-cols-4') }}">
                @foreach($level as $key)
                    @php
                        $leader = $leaders[$key];
                        $portrait = 'images/leadership/' . $leader['photo'];
                        $hasPortrait = is_file(public_path($portrait));
                    @endphp

                    <article class="relative flex h-full flex-col rounded-2xl border border-[#E0E8F2] bg-white p-5 shadow-[0_10px_30px_rgba(15,35,75,0.05)] transition duration-200 hover:-translate-y-1 hover:shadow-lg sm:p-6">
                        @if($levelIndex > 0)
                            <span class="absolute -top-2 left-1/2 hidden h-2 w-2 -translate-x-1/2 rounded-full border-2 border-blue-500 bg-white md:block" aria-hidden="true"></span>
                        @endif

                        <div class="flex items-start gap-4">
                            <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-full border-4 border-[#E9F0FA] bg-[#DCE7F6] sm:h-24 sm:w-24">
                                @if($hasPortrait)
                                    <img
                                        src="{{ asset($portrait) }}"
                                        alt="Portrait of {{ $leader['name'] }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover"
                                    >
                                @else
                                    <svg viewBox="0 0 100 100" class="h-full w-full text-[#819ABF]" fill="currentColor" aria-hidden="true">
                                        <circle cx="50" cy="35" r="19"/>
                                        <path d="M14 96c2-25 16-39 36-39s34 14 36 39z"/>
                                    </svg>
                                @endif
                            </div>

                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg font-bold leading-6 tracking-tight text-[#11213D]">
                                    {{ $leader['name'] }}
                                </h3>

                                <p class="mt-2 text-sm font-semibold leading-5 text-[#2161C3]">
                                    {{ $leader['role'] }}
                                </p>

                                <p class="mt-2 text-xs font-medium uppercase tracking-wide text-slate-400">
                                    Moose Loon AI Academy
                                </p>

                                <p class="mt-2 text-sm text-slate-500">
                                    {{ $leader['location'] }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 flex-1 rounded-xl bg-[#F2F6FC] p-4">
                            <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-[#2764C1]">
                                Professional Profile
                            </p>

                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                {{ $leader['bio'] }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        @endforeach
    </section>
</main>
@endsection
