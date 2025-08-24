@extends('layouts.public')

@section('title', 'Application')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden p-8 sm:p-12">
        <div class="flex justify-between items-center mb-6">
            <a href="javascript:history.back()" class="flex items-center text-gray-600 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
            <div class="text-center flex-grow">
                <h1 class="text-3xl font-bold text-gray-900">Apply for a Position</h1>
            </div>
        </div>

        <form action="#" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf

            <!-- Personal Information Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">What's your first name? <span class="text-red-500">*</span></label>
                    <input type="text" id="first_name" name="first_name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
                <div>
                    <label for="surname" class="block text-sm font-medium text-gray-700 mb-1">What's your surname? <span class="text-red-500">*</span></label>
                    <input type="text" id="surname" name="surname" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <!-- Email & LinkedIn Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">What's your email? <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
                <div>
                    <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL <span class="text-red-500">*</span></label>
                    <input type="url" id="linkedin_url" name="linkedin_url" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <!-- AI Experience & Location -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="ai_experience" class="block text-sm font-medium text-gray-700 mb-1">Years of experience in AI <span class="text-red-500">*</span></label>
                    <input type="number" id="ai_experience" name="ai_experience" min="0" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location (Country) <span class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <!-- Resume & Files Upload -->
            <div>
                <label for="resume_files" class="block text-sm font-medium text-gray-700 mb-1">Upload your latest resume and any other files relevant for the role you're applying for <span class="text-red-500">*</span></label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m-4-4l5.172 5.172a4 4 0 005.656 0L40 32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Click to choose a file or drag here</span>
                                <input id="file-upload" name="resume_files[]" type="file" class="sr-only" multiple required>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loom Video Link -->
            <div>
                <label for="loom_url" class="block text-sm font-medium text-gray-700 mb-1">Link to a 2-Minute Loom Video <span class="text-red-500">*</span></label>
                <input type="url" id="loom_url" name="loom_url" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                <p class="mt-2 text-sm text-gray-500">In the Loom, please answer the following question: <br><strong>What motivates you to join SynFlow AI, and why do you believe you're the best fit for both the role and the company culture?</strong></p>
            </div>
            
            <!-- Relevant Skills Checkboxes -->
            <fieldset>
                <legend class="block text-sm font-medium text-gray-700 mb-2">Select all relevant skills you have you think would contribute to SynFlow's vision? <span class="text-red-500">*</span></legend>
                <div class="mt-2 grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div class="flex items-center">
                        <input id="skill-a" name="skills[]" type="checkbox" value="Sales" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-a" class="ml-2 block text-sm text-gray-900">A. Sales</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-b" name="skills[]" type="checkbox" value="Marketing" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-b" class="ml-2 block text-sm text-gray-900">B. Marketing</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-c" name="skills[]" type="checkbox" value="Operations" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-c" class="ml-2 block text-sm text-gray-900">C. Operations</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-d" name="skills[]" type="checkbox" value="AI Development" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-d" class="ml-2 block text-sm text-gray-900">D. AI Development</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-e" name="skills[]" type="checkbox" value="Front-end Development" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-e" class="ml-2 block text-sm text-gray-900">E. Front-end Development</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-f" name="skills[]" type="checkbox" value="Back-end Development" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-f" class="ml-2 block text-sm text-gray-900">F. Back-end Development</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-g" name="skills[]" type="checkbox" value="Videography & Editing" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-g" class="ml-2 block text-sm text-gray-900">G. Videography & Editing</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-h" name="skills[]" type="checkbox" value="Data" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-h" class="ml-2 block text-sm text-gray-900">H. Data</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-i" name="skills[]" type="checkbox" value="UI/UX Design" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-i" class="ml-2 block text-sm text-gray-900">I. UI/UX Design</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-j" name="skills[]" type="checkbox" value="Copywriting" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-j" class="ml-2 block text-sm text-gray-900">J. Copywriting</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-k" name="skills[]" type="checkbox" value="Product Management" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-k" class="ml-2 block text-sm text-gray-900">K. Product Management</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-l" name="skills[]" type="checkbox" value="Leadership" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-l" class="ml-2 block text-sm text-gray-900">L. Leadership</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-m" name="skills[]" type="checkbox" value="Graphic Design" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-m" class="ml-2 block text-sm text-gray-900">M. Graphic Design</label>
                    </div>
                    <div class="flex items-center">
                        <input id="skill-n" name="skills[]" type="checkbox" value="Other" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="skill-n" class="ml-2 block text-sm text-gray-900">N. Other</label>
                    </div>
                </div>
            </fieldset>

            <!-- Anything Else & Sales Rep Note -->
            <div>
                <label for="anything_else" class="block text-sm font-medium text-gray-700 mb-1">Anything else you'd like us to know (link to your website, portfolio, motivation behind applying etc.)</label>
                <textarea id="anything_else" name="anything_else" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"></textarea>
                <p class="mt-2 text-sm text-gray-500">Note: If you're applying for a **Sales Representative** role, please describe your sales experience with numbers in 5 sentences.</p>
            </div>

            <!-- Referral Section -->
            <div class="space-y-4 p-4 border border-gray-200 rounded-md">
                <p class="text-sm text-gray-600">If anyone has referred you, please make sure to submit their details below (full name, email). Keep in mind that your application will stand out more if it’s referred by someone within our network or who is connected to us in some way.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="referee_name" class="block text-sm font-medium text-gray-700 mb-1">Referee's full name (if applicable)</label>
                        <input type="text" id="referee_name" name="referee_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                    <div>
                        <label for="referee_email" class="block text-sm font-medium text-gray-700 mb-1">Referee's email (if applicable)</label>
                        <input type="email" id="referee_email" name="referee_email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                </div>
            </div>

            <!-- Data Processing Consent -->
            <div>
                <p class="text-sm text-gray-600 mb-2">By submitting your information and video, you agree that we’ll store and review it for recruitment purposes. We’ll keep it for up to 12 months and only share it internally with our hiring team. You can request access or deletion anytime.</p>
                <div class="flex items-center">
                    <input id="data_consent" name="data_consent" type="checkbox" required class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <label for="data_consent" class="ml-2 block text-sm font-medium text-gray-900">
                        I agree to the processing of my data and video for hiring purposes, as described above. <span class="text-red-500">*</span>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-3 px-4 rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
