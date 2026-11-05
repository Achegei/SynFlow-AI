@extends('layouts.public')

@section('title', 'Gallery | Moose Loon AI Academy')

@section('content')
<div class="bg-white text-slate-900 overflow-x-hidden">

    {{-- GALLERY HERO --}}
    <section class="bg-[#00104B]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 lg:py-20">
            <div class="max-w-4xl">
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-red-300">
                    Moose Loon AI Academy
                </p>

                <h1 class="mt-5 text-4xl md:text-5xl lg:text-[3.5rem] font-bold tracking-tight text-white">
                    Our Gallery
                </h1>

                <p class="mt-6 text-lg leading-8 text-blue-100 max-w-3xl">
                    Discover moments from our AI training programmes,
                    institutional partnerships, orientations, workshops
                    and academy events.
                </p>
            </div>
        </div>
    </section>

    {{-- GALLERY CONTENT --}}
    <section class="py-16 lg:py-20 bg-[#F7F9FC]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- GALLERY MEDIA FILTERS --}}
            <nav class="mb-12 flex flex-wrap items-center justify-center gap-3"
                 aria-label="Filter gallery media">

                @foreach([
                    'all' => 'All',
                    'photos' => 'Photos',
                    'videos' => 'Videos',
                ] as $type => $label)

                    <a
                        href="{{ $type === 'all' ? route('gallery') : route('gallery', ['type' => $type]) }}"
                        @if($galleryType === $type) aria-current="page" @endif
                        class="inline-flex min-w-28 items-center justify-center rounded-full px-6 py-3 text-sm font-bold transition
                            {{ $galleryType === $type
                                ? 'bg-[#00104B] text-white shadow-md'
                                : 'bg-white text-[#00104B] border border-slate-200 hover:border-[#C90000] hover:text-[#C90000]' }}"
                    >
                        {{ $label }}
                    </a>

                @endforeach
            </nav>

            @if($galleryImages->count() > 0)

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">

                    @foreach($galleryImages as $photo)
                        <article class="overflow-hidden rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-lg transition-shadow duration-300">

                            <div class="aspect-[4/3] overflow-hidden bg-slate-100">

                                @if($photo->media_type === 'photo')
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photo->image_path) }}"
                                        alt="{{ $photo->alt_text ?: $photo->title }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                    >

                                @elseif($photo->media_type === 'video_upload')
                                    <video
                                        controls
                                        preload="none"
                                        playsinline
                                        poster="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photo->image_path) }}"
                                        aria-label="{{ $photo->title }}"
                                        class="w-full h-full object-contain bg-black"
                                    >
                                        <source
                                            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photo->video_path) }}"
                                            type="video/mp4"
                                        >
                                        Your browser does not support HTML5 video.
                                    </video>

                                @elseif($photo->media_type === 'youtube')
                                    @php
                                        $youtubeId = \App\Support\GalleryMediaValidator::youtubeVideoId(
                                            $photo->youtube_url ?? ''
                                        );
                                    @endphp

                                    @if($youtubeId)
                                        <iframe
                                            src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                            title="{{ $photo->title }}"
                                            loading="lazy"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen
                                            class="w-full h-full border-0"
                                        ></iframe>
                                    @else
                                        <div class="flex h-full items-center justify-center p-6 text-center text-sm text-slate-600">
                                            Video unavailable.
                                        </div>
                                    @endif

                                @endif

                            </div>

                            <div class="p-6">

                                <p class="text-xs font-bold uppercase tracking-wider text-[#C90000]">
                                    {{ $photo->category }}
                                </p>

                                <h2 class="mt-3 text-xl font-bold text-[#00104B]">
                                    {{ $photo->title }}
                                </h2>

                                @if($photo->caption)
                                    <p class="mt-3 text-sm text-slate-600 leading-7">
                                        {{ $photo->caption }}
                                    </p>
                                @endif

                            </div>
                        </article>
                    @endforeach

                </div>

                @if($galleryImages->hasPages())
                    <div class="mt-12">
                        {{ $galleryImages->links() }}
                    </div>
                @endif

            @else

                <div class="max-w-2xl mx-auto text-center bg-white border border-slate-200 rounded-2xl p-10 sm:p-14">

                    <h2 class="text-2xl font-bold text-[#00104B]">
                        Our Gallery Is Coming Soon
                    </h2>

                    <p class="mt-4 text-slate-600 leading-7">
                        We're preparing photographs from our training sessions,
                        institutional collaborations and academy activities.
                        Please check back soon.
                    </p>

                    <a
                        href="{{ route('home') }}"
                        class="inline-flex mt-8 items-center justify-center rounded-lg bg-[#C90000] px-6 py-3 text-sm font-semibold text-white hover:bg-[#A90000] transition"
                    >
                        Return to Homepage
                    </a>

                </div>

            @endif

        </div>
    </section>

</div>
@endsection
