@extends('layouts.public')

@section('title', 'Careers')

@section('content')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-lg p-8 sm:p-12">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">NOW HIRING — Nationwide in Kenya 🇰🇪🇨🇦</h1>
            <p class="text-lg text-indigo-600">Moose Loon AI, a Canadian Artificial Intelligence company, is expanding across Kenya and inviting applications from qualified and motivated individuals to join our growing team.</p>
             <h1 class="text-4xl font-bold text-gray-900 mb-4">Application Deadline: December 31, 2025</h1>
             <p class="text-lg text-indigo-600">Moose Loon AI, reserves the right to close applications earlier once the required number of successful candidates has been reached.</p>
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
                    <li>High School Diploma (KCSE)</li>
                    <li>Fluency in English & Kiswahili</li>
                    <li>Ability to communicate clearly with customers</li>
                </ul>
                <h4 class="font-semibold text-gray-900 mt-3">Core Competencies:</h4>
                <ul class="list-disc list-inside text-gray-800 space-y-1">
                    <li>Professional and reliable</li>
                    <li>Goal-oriented and self-motivated</li>
                    <li>Positive attitude and willingness to learn</li>
                    <li>Strong customer service mindset</li>
                </ul>
            </div>

         <!-- Important Notice: Supervisors & Management -->
            <div class="bg-gradient-to-r from-yellow-50 to-yellow-200 p-6 rounded-xl shadow-lg border-l-8 border-yellow-400 flex flex-col md:flex-row md:items-start gap-4 mb-6">
                <div class="flex-shrink-0">
                    <!-- Attention Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-yellow-900 mb-3">Supervisors & Management Position Update</h3>
                    <p class="text-gray-800 mb-2">
                        At this time, all Supervisor positions have been filled. This reflects the strong growth of Moose Loon AI and the high performance of our current leadership team.
                    </p>
                    <p class="text-gray-800 mb-2">
                        Management positions are scheduled to open on <span class="font-semibold">February 05, 2026</span>. These roles will be filled primarily through internal promotion, with priority consideration given to:
                    </p>
                    <ul class="list-disc list-inside text-gray-800 space-y-1 mb-2">
                        <li>Moose Loon AI pioneer Sales Associates</li>
                        <li>Current Supervisors in good standing</li>
                    </ul>
                    <p class="text-gray-800 mb-2">
                        Leadership is earned through commitment, ownership, and consistent results. The effort you put in today builds the opportunities you step into tomorrow.
                    </p>
                    <p class="text-gray-800 mb-2">
                        All management opportunities will be communicated and posted internally when they become available.
                    </p>
                    <p class="text-gray-800 italic mb-2">
                        “Growth is not given — it is built through consistency, ownership, and the courage to lead.” — Moose Loon AI Leadership Principle
                    </p>
                    <p class="text-gray-800">
                        We encourage every team member to stay focused, keep learning, and take pride in being part of a company that believes in developing leaders from within.
                    </p>
                </div>
            </div>


        </section>

        <!-- Structured Training Info -->
        <section class="mb-10 bg-gray-50 p-6 rounded-lg border border-gray-200 shadow-sm">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Structured Training Program</h2>
            <p class="text-gray-800 mb-2">
                All selected applicants will undergo the <span class="font-semibold text-indigo-600">Moose Loon AI Structured Training Program</span>.
            </p>
            <!-- Application Notice -->
            <section class="mb-8">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">
                        Important Application Guidelines
                    </h2>

                    <p class="text-gray-800 mb-4">
                        Applicants are <span class="font-semibold">required to apply for only one role.</span> 
                        Submitting applications for both the <span class="font-semibold">Sales Associate</span> 
                        and any management role will result in 
                        <span class="font-semibold text-red-600">automatic disqualification</span>.
                    </p>

                    <p class="text-gray-800 mb-4">
                        Moose Loon AI reserves the right to evaluate strong candidates and may upgrade them to a higher role during the selection process.
                    </p>

                    <p class="text-gray-800 font-semibold">
                        The Company reserves the right to close this recruitment process earlier upon receiving the required number of suitable applications.
                    </p>
                </div>
            </section>

            <p class="text-gray-800 mb-2">
                This program equips you with the knowledge and tools required to represent our AI business solutions professionally.
            </p>
            <p class="text-gray-800">
                <span class="font-semibold">No prior AI experience needed</span> — structured training will be provided.
            </p>


        <!-- Job Application Form -->
        <h2 class="text-2xl font-bold text-orange-900 mb-6">
            Email Submission Send CV and cover letter to 
            <span class="font-semibold text-blue-900 !text-blue-900">
                careers@mooseloonai.ca
            </span> 
            or apply via below submission
        </h2>
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
