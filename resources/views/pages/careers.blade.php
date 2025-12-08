@extends('layouts.public')

@section('title', 'Careers')

@section('content')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-lg p-8 sm:p-12">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">NOW HIRING — Nationwide in Kenya 🇰🇪🇨🇦</h1>
            <p class="text-lg text-gray-600">Moose Loon AI, a Canadian Artificial Intelligence company, is expanding across Kenya and inviting applications from qualified and motivated individuals to join our growing team.</p>
        </div>

        <!-- Open Positions / Job Descriptions -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            <!-- Sales Associates -->
            <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-6 rounded-xl shadow-lg border border-blue-300">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4.978 4.978 0 016 16h12a4.978 4.978 0 01.879 1.804M12 14a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                    <h3 class="text-xl font-bold text-blue-900">Sales Associate</h3>
                </div>
                <p class="text-gray-800 mb-2">💰 Estimated Monthly Earnings: 40,000 – 60,000 KES</p>
                <h4 class="font-semibold text-gray-900 mt-3">Qualifications:</h4>
                <ul class="list-disc list-inside text-gray-800 space-y-1">
                    <li>Minimum 12 months of sales experience</li>
                    <li>High School Diploma (KCSE)</li>
                    <li>Fluency in English & Kiswahili</li>
                </ul>
                <h4 class="font-semibold text-gray-900 mt-3">Core Competencies:</h4>
                <ul class="list-disc list-inside text-gray-800 space-y-1">
                    <li>Professional and reliable</li>
                    <li>Goal-oriented and self-motivated</li>
                </ul>
            </div>

            <!-- Sales Supervisors -->
            <div class="bg-gradient-to-r from-orange-100 to-orange-200 p-6 rounded-xl shadow-lg border border-orange-300">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-orange-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0l-7-4.041A2 2 0 015 16v-5m14 5v-5a2 2 0 00-.595-1.436L12 14z" />
                    </svg>
                    <h3 class="text-xl font-bold text-orange-900">Sales Supervisor</h3>
                </div>
                <p class="text-gray-800 mb-2">💰 Estimated Monthly Earnings: 80,000 – 120,000 KES</p>
                <h4 class="font-semibold text-gray-900 mt-3">Qualifications:</h4>
                <ul class="list-disc list-inside text-gray-800 space-y-1">
                    <li>Minimum 2 years of sales experience</li>
                    <li>High School Diploma (KCSE)</li>
                    <li>Fluency in English & Kiswahili</li>
                </ul>
                <h4 class="font-semibold text-gray-900 mt-3">Core Competencies:</h4>
                <ul class="list-disc list-inside text-gray-800 space-y-1">
                    <li>Reliability & leadership ability</li>
                    <li>Strong communication skills</li>
                </ul>
            </div>

        </section>

        <!-- Structured Training Info -->
<section class="mb-10 bg-gray-50 p-6 rounded-lg border border-gray-200 shadow-sm">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Structured Training Program</h2>
    <p class="text-gray-800 mb-2">
        All selected applicants will undergo the <span class="font-semibold text-indigo-600">Moose Loon AI Structured Training Program</span>.
    </p>
    <p class="text-gray-800 mb-2">
        This program equips you with the knowledge and tools required to represent our AI business solutions professionally.
    </p>
    <p class="text-gray-800">
        <span class="font-semibold">No prior AI experience needed</span> — structured training will be provided.
    </p>
</section>


        <!-- Job Application Form -->
        <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Apply Now</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Hidden Slug Field -->
                <input type="hidden" name="position_slug" id="position_slug">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                    <input type="text" name="full_name" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Position *</label>
                    <select id="position" name="position" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option value="" disabled selected>Select a position</option>
                        <option value="Sales Associate">Sales Associate</option>
                        <option value="Sales Supervisor">Sales Supervisor</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-indigo-700 mb-1">
                        Upload CV (PDF, max 5MB) *
                    </label>
                    <input type="file" name="cv_cover" required accept=".pdf" class="w-full">
                </div>

                <button type="submit" class="w-full py-3 px-4 rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Submit Application
                </button>
            </form>
        </section>

    </div>
</div>

<script>
const positionSelect = document.getElementById('position');
const positionSlugInput = document.getElementById('position_slug');

function slugify(text) {
    return text.toLowerCase().trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w-]+/g, '')
        .replace(/--+/g, '-');
}

positionSelect.addEventListener('change', function () {
    positionSlugInput.value = slugify(this.value);
});
</script>

@endsection
