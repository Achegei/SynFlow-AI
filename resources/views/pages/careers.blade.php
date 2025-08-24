@extends('layouts.public')

@section('title', 'Careers')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg p-8 sm:p-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Join the SynFlow AI Team!</h1>
            <p class="text-lg text-gray-600">Find your place in a high-performance team that's shaping the future of AI.</p>
        </div>

        <div class="prose max-w-none mb-8">
            <p>At SynFlow AI, we are a high-performance, fast-moving ecosystem at the forefront of AI, automation, and business transformation. Based in Nairobi, we don't just talk about the future—we build it. Through our consulting and development teams and our network of experts, we empower businesses to implement AI, scale their operations, and stay ahead in a rapidly evolving, AI-driven world.</p>
            <p class="font-semibold text-gray-800">Ready to be part of something big? Apply now and join a team that is actively shaping the future of AI and business from the heart of Kenya.</p>
            <p class="text-sm italic text-gray-500">Note: Most positions can be remote, with some exceptions. An initial onboarding period in Nairobi or occasional travel may be required for certain roles, particularly leadership positions. Our company and core team are based in Nairobi, Kenya.</p>
        </div>
        
        <hr class="my-8 border-t border-gray-200">

        <h2 class="text-2xl font-bold text-gray-900 mb-6">Explore Our Current Job Openings</h2>

        <!-- Job Selection Form -->
        <form id="job-selection-form" class="space-y-6">
            @csrf
            <div>
                <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Select the position you are interested in <span class="text-red-500">*</span></label>
                <select id="position" name="position" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    <option value="" disabled selected>Select a position</option>
                    <option value="Talent Acquisition Specialist">Talent Acquisition Specialist</option>
                    <option value="Graphic Designer">Graphic Designer</option>
                    <option value="Fullstack Developer">Fullstack Developer</option>
                    <option value="Machine Learning Engineer">Machine Learning Engineer</option>
                    <option value="Video Editor - Youtube Vlogs">Video Editor - Youtube Vlogs</option>
                    <option value="AI Course Instructor (Remote)">AI Course Instructor (Remote)</option>
                    <option value="Chief Technology Officer (CTO)">Chief Technology Officer (CTO)</option>
                    <option value="Sales Representative">Sales Representative</option>
                    <option value="None, but I am interested in working with SynFlow AI">None, but I am interested in working with SynFlow AI</option>
                </select>
            </div>

            <!-- Next Button (Initially hidden) -->
            <div id="next-button-container" class="hidden">
                <button type="button" id="next-button" class="w-full py-3 px-4 rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Next
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const positionSelect = document.getElementById('position');
        const nextButtonContainer = document.getElementById('next-button-container');
        const nextButton = document.getElementById('next-button');

        // A robust slugify function to match Laravel's Str::slug()
        function slugify(text) {
            return text.toString().toLowerCase().trim()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w-]+/g, '')       // Remove all non-word chars
                .replace(/--+/g, '-');          // Replace multiple - with single -
        }

        // Show/hide the 'Next' button based on selection
        positionSelect.addEventListener('change', function() {
            if (this.value) {
                nextButtonContainer.classList.remove('hidden');
            } else {
                nextButtonContainer.classList.add('hidden');
            }
        });

        // Handle redirection to the job description page
        nextButton.addEventListener('click', function(e) {
            e.preventDefault();
            const selectedPosition = positionSelect.value;
            // Use the new slugify function
            const positionSlug = slugify(selectedPosition);
            
            // Check for the special case
            if (selectedPosition === 'None, but I am interested in working with SynFlow AI') {
                const redirectUrl = `{{ url('careers') }}/${slugify('none-but-i-am-interested-in-working-with-synflow-ai')}`;
                window.location.href = redirectUrl;
            } else {
                const redirectUrl = `{{ url('careers') }}/${positionSlug}`;
                window.location.href = redirectUrl;
            }
        });
    });
</script>
@endsection
