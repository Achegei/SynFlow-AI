@extends('layouts.public')

@section('title', 'Careers')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-lg p-8 sm:p-12">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Join the Moose Loon AI Team!</h1>
            <p class="text-lg text-gray-600">We hire through a training-based system that ensures our team is skilled, professional, and future-ready.</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Why Training-Based Recruitment -->
        <section class="prose max-w-none mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Why Moose Loon AI Uses a Training-Based Recruitment System</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li><strong>We filter out unserious applicants:</strong> Only applicants willing to invest in their own future join a professional AI team.</li>
                <li><strong>We create skilled internal staff:</strong> Our team learns to confidently speak about automation, RAG, workflows, and AI-powered business solutions.</li>
                <li><strong>We build a professional AI workforce in East Africa:</strong> Positioning Moose Loon AI as the leading AI automation brand in the region.</li>
                <li><strong>We develop strong, well-trained salespeople:</strong> Salespeople who understand AI can sell 10× better, close more deals, and support clients confidently.</li>
            </ul>
        </section>

        <!-- Training Programs & Prices -->
        <section class="prose max-w-none mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Moose Loon AI Sales Team – Training Structure</h2>
            <p>All recruits pay a 50% deposit to begin training and pay the balance after employment, based on a personal agreement.</p>

            <div class="space-y-6 mt-6">
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h3 class="font-bold text-indigo-700">1. AI Sales Foundation Program – KSh 1,900</h3>
                    <p>Deposit (50%): KSh 950<br>Balance After Employment: KSh 950</p>
                    <p class="mt-1 font-semibold">Title After Completion: AI Sales Associate</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h3 class="font-bold text-indigo-700">2. AI Sales Supervisory Program – KSh 2,900</h3>
                    <p>Deposit (50%): KSh 1,450<br>Balance After Employment: KSh 1,450</p>
                    <p class="mt-1 font-semibold">Title After Completion: AI Sales Supervisor</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h3 class="font-bold text-indigo-700">3. AI Sales Leadership Program – KSh 3,900</h3>
                    <p>Deposit (50%): KSh 1,950<br>Balance After Employment: KSh 1,950</p>
                    <p class="mt-1 font-semibold">Title After Completion: AI Sales Manager</p>
                </div>
            </div>
        </section>

        <hr class="my-8 border-t border-gray-200">

        <!-- Job Application Form -->
        <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Apply Now</h2>
            <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="position_slug" id="position_slug">

                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="full_name" id="full_name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    @error('full_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Select Training Program <span class="text-red-500">*</span></label>
                    <select id="position" name="position" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        <option value="" disabled selected>Select a program</option>
                        <option value="AI Sales Foundation Program">AI Sales Foundation Program</option>
                        <option value="AI Sales Supervisory Program">AI Sales Supervisory Program</option>
                        <option value="AI Sales Leadership Program">AI Sales Leadership Program</option>
                    </select>
                    @error('position_slug') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="cv_cover" class="block text-sm font-medium text-gray-700 mb-1">Upload CV & Cover Letter (PDF, max 5MB) <span class="text-red-500">*</span></label>
                    <input type="file" name="cv_cover" id="cv_cover" required accept=".pdf" class="w-full text-gray-700">
                    @error('cv_cover') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3 px-4 rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Submit Application
                </button>
            </form>
        </section>
    </div>
</div>

<!-- JS to populate position_slug -->
<script>
const positionSelect = document.getElementById('position');
const positionSlugInput = document.getElementById('position_slug');

function slugify(text) {
    return text.toString().toLowerCase().trim()
        .replace(/\s+/g, '-')           
        .replace(/[^\w-]+/g, '')       
        .replace(/--+/g, '-');          
}

positionSelect.addEventListener('change', function() {
    positionSlugInput.value = slugify(this.value);
});
</script>
@endsection
