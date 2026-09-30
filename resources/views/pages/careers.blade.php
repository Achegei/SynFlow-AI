@extends('layouts.public')

@section('title', 'Senior Education & Corporate Partnerships Executive – Nairobi')

@section('content')

<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">

            <section class="px-6 py-12 sm:px-10 lg:px-14 lg:py-16 border-b border-gray-200">
                <p class="text-sm font-semibold tracking-widest uppercase text-indigo-700 mb-4">
                    Careers at Moose Loon AI Academy
                </p>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-gray-900 leading-tight mb-5">
                    Senior Education &amp; Corporate Partnerships Executive
                </h1>

                <div class="flex flex-wrap gap-x-6 gap-y-2 text-gray-600 mb-7">
                    <span>Nairobi, Kenya</span>
                    <span>Partnerships &amp; Business Development</span>
                </div>

                <p class="text-lg leading-8 text-gray-700 max-w-3xl">
                    Moose Loon AI Academy, a Canadian AI Academy with operations in Kenya, is seeking a highly experienced professional with established networks and a proven track record of developing strategic partnerships across Kenya.
                </p>

                <div class="mt-8">
                    <a href="#appy"
                       class="inline-flex items-center justify-center bg-gray-900 text-white px-7 py-3 rounded-md font-semibold hover:bg-gray-800 transition">
                        Apply for this position
                    </a>
                </div>
            </section>

            <div class="px-6 py-10 sm:px-10 lg:px-14 lg:py-14 space-y-12">

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-5">Required Networks</h2>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Education</h3>
                            <p class="text-gray-700 leading-7">
                                Universities, colleges, schools and training institutions.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Corporate &amp; Institutional</h3>
                            <p class="text-gray-700 leading-7">
                                Corporates, healthcare organizations, insurance institutions, government, NGOs, businesses and other institutions.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="border-t border-gray-200 pt-10">
                    <h2 class="text-2xl font-bold text-gray-900 mb-5">Your Role</h2>

                    <ul class="list-disc pl-6 text-gray-700 space-y-3 leading-7">
                        <li>Introduce Moose Loon AI Academy to potential education, corporate and institutional partners.</li>
                        <li>Develop strategic education, corporate and institutional partnerships.</li>
                        <li>Champion practical AI education and workforce development.</li>
                        <li>Build, manage and strengthen long-term partner relationships.</li>
                    </ul>
                </section>

                <section class="border-t border-gray-200 pt-10">
                    <h2 class="text-2xl font-bold text-gray-900 mb-5">Who Should Apply?</h2>

                    <p class="text-gray-700 leading-7 mb-5">
                        We are looking for senior professionals with experience in one or more of the following areas:
                    </p>

                    <ul class="list-disc pl-6 text-gray-700 space-y-3 leading-7">
                        <li>Business Development</li>
                        <li>Institutional Partnerships</li>
                        <li>Corporate Relations</li>
                        <li>Education Partnerships</li>
                        <li>Strategic Partnerships</li>
                    </ul>

                    <p class="text-gray-700 leading-7 mt-6">
                        Candidates should have strong existing professional connections and demonstrated success in developing and managing partnerships.
                    </p>
                </section>

                <section class="border-t border-gray-200 pt-10">
                    <h2 class="text-2xl font-bold text-gray-900 mb-5">Competitive Compensation Package</h2>

                    <p class="text-gray-700 leading-7">
                        Competitive compensation package with performance-based incentives.
                    </p>
                </section>

                <section class="border-t border-gray-200 pt-10">
                    <h2 class="text-2xl font-bold text-gray-900 mb-5">How to Apply</h2>

                    <p class="text-gray-700 leading-7 mb-4">
                        Submit your CV or professional profile, relevant experience, and examples of partnerships you have successfully developed.
                    </p>

                    <p class="text-gray-700 leading-7">
                        Applications may also be sent by email to
                        <a href="mailto:careers@mooseloonai.ca"
                           class="font-semibold text-indigo-700 hover:text-indigo-900 underline underline-offset-2">
                            careers@mooseloonai.ca
                        </a>.
                    </p>

                    <div class="mt-7 p-5 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="font-semibold text-gray-900">
                            Application Deadline
                        </p>
                        <p class="text-gray-700 mt-1">
                            Sunday, October 11, 2026 at Midnight
                        </p>
                    </div>
                </section>

                <section class="border-t border-gray-200 pt-10">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">Moose Loon AI Academy</h2>
                    <p class="text-gray-700 leading-7">
                        Kipro Centre, Westlands, Nairobi, Kenya
                    </p>
                    <p class="text-gray-600 leading-7 mt-2">
                        Building strategic partnerships for practical AI education and workforce development.
                    </p>
                </section>

            </div>
        </div>
    </div>
</div>

<section id="appy" class="bg-white py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Apply Now</h2>
                <p class="text-gray-600 leading-7">
                    Complete the form below, or send your application directly to
                    <a href="mailto:careers@mooseloonai.ca"
                       class="font-semibold text-indigo-700 hover:text-indigo-900 underline underline-offset-2">
                        careers@mooseloonai.ca
                    </a>.
                </p>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('careers.submit') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf

                <input type="hidden" name="position_slug" id="position_slug">

                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Full Name *
                    </label>
                    <input type="text"
                           id="full_name"
                           name="full_name"
                           required
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email *
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           required
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-1">
                        Select Position *
                    </label>
                    <select id="position"
                            name="position"
                            required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled>Select a position</option>
                        <option value="Senior Education & Corporate Partnerships Executive" selected>
                            Senior Education &amp; Corporate Partnerships Executive
                        </option>
                    </select>
                </div>

                <div>
                    <label for="cv_cover" class="block text-sm font-medium text-gray-700 mb-2">
                        Upload CV / Professional Profile and Supporting Application (PDF, max 5MB) *
                    </label>
                    <input type="file"
                           id="cv_cover"
                           name="cv_cover"
                           required
                           accept=".pdf"
                           class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:font-semibold file:bg-gray-100 file:text-gray-800 hover:file:bg-gray-200">
                </div>

                <button type="submit"
                        class="w-full py-3 px-4 rounded-md text-white bg-gray-900 font-semibold hover:bg-gray-800 transition">
                    Submit Application
                </button>

            </form>
        </div>
    </div>
</section>

<script>
const positionSelect = document.getElementById('position');
const positionSlugInput = document.getElementById('position_slug');

function slugify(text) {
    return text.toLowerCase().trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w-]+/g, '')
        .replace(/--+/g, '-');
}

function updatePositionSlug() {
    positionSlugInput.value = slugify(positionSelect.value);
}

positionSelect.addEventListener('change', updatePositionSlug);
updatePositionSlug();
</script>

@endsection
