@extends('layouts.public')

@section('title', 'Leadership & Directors | Moose Loon AI Academy')

@section('content')
@php
    $leaders = [
        ['Jimale Moha', 'Executive Director & CEO', 'Edmonton, Alberta, Canada', 'Providing strategic leadership in advancing practical AI education, international partnerships, and workforce development.', 'jimale-moha.jpg'],
        ['Clide Ahmogah', 'Country Executive Director – Kenya', 'Nairobi, Kenya', 'Providing executive leadership in advancing AI education, strategic institutional partnerships, and national expansion across Kenya’s 47 counties.', 'clide-ahmogah.jpg'],
        ['Ann Torres', 'Chief Academic & Certification Officer (CACO)', 'Edmonton, Alberta, Canada', 'Provides executive leadership in AI curriculum development, professional certification, academic quality assurance, and instructor excellence, ensuring high-quality, industry-relevant AI education across the Academy’s programmes.', 'ann-torres.jpg'],
        ['Romi Anthony', 'Chief Technology Officer (CTO)', 'Edmonton, Alberta, Canada', 'Leads technology strategy, software engineering, systems architecture, and AI automation development, driving innovation and scalable digital solutions across the Academy’s operations.', 'romi-anthony.jpg'],
        ['Chloé Tremblay', 'Head of Institutional Partnerships & International Career Opportunities', 'Edmonton, Alberta, Canada', 'Builds strategic relationships with Canadian employers and international organizations to establish graduate career pathways, professional referrals, and potential employment opportunities for qualified Moose Loon AI Academy graduates, subject to confirmed employer partnerships.', 'chloe-tremblay.jpg'],
        ['Haji Ali', 'Director – Canada–Africa AI Education Expansion', 'Canada/Africa', 'Leading the Academy’s Canada–Africa expansion strategy, international education partnerships, and initiatives to advance practical AI education and workforce development across Africa.', 'haji-ali.jpg'],
        ['Martin Orina', 'AI Education & Corporate Partnerships Manager', 'Nairobi, Kenya', 'Manages strategic partnerships with educational institutions, corporations, and organizations across Kenya, promoting AI education, professional certification, and workforce development.', 'martin-orina.jpg'],
        ['Laban Ekitela', 'Program Director – East Africa', '', '', 'laban-ekitela.jpg'],
    ];
@endphp

<main class="min-h-screen bg-slate-50">
    <section class="bg-slate-950 px-6 py-24 text-white">
        <div class="mx-auto max-w-6xl">
            <p class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-sky-300">Our People</p>
            <h1 class="max-w-4xl text-4xl font-bold tracking-tight md:text-6xl">Leadership & Directors</h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                Meet the team guiding Moose Loon AI Academy's mission to advance practical AI education,
                responsible innovation, and international collaboration.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 py-16 md:py-24" aria-label="Leadership profiles">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($leaders as $leader)
                @php
                    [$name, $role, $location, $bio, $filename] = $leader;
                    $portrait = 'images/leadership/' . $filename;
                    $hasPortrait = file_exists(public_path($portrait));
                @endphp

                <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                    <div class="relative aspect-[4/5] overflow-hidden bg-slate-200">
                        @if($hasPortrait)
                            <img
                                src="{{ asset($portrait) }}"
                                alt="Portrait of {{ $name }}"
                                loading="lazy"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-800 to-slate-600 px-6 text-center">
                                <span class="text-6xl font-semibold tracking-tight text-white/80" aria-label="{{ $name }}">
                                    {{ collect(explode(' ', $name))->map(fn ($part) => mb_substr($part, 0, 1))->take(2)->implode('') }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="p-7">
                        <h2 class="text-xl font-bold tracking-tight text-slate-950">{{ $name }}</h2>
                        <p class="mt-2 text-sm font-semibold leading-6 text-sky-700">{{ $role }}</p>
                        @if($location)
                            <p class="mt-2 text-sm text-slate-500">{{ $location }}</p>
                        @endif
                        @if($bio)
                            <p class="mt-5 text-sm leading-7 text-slate-600">{{ $bio }}</p>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</main>
@endsection
