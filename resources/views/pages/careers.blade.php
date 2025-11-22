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

        <!-- North America Toggle -->
        <div class="mt-6 mb-6">
            <button 
                type="button"
                id="toggleNorthAmericaBtn"
                class="px-4 py-2 bg-orange-600 text-white font-semibold rounded-md shadow hover:bg-orange-700 transition">
                North America Sales Team Applicants Section
            </button>

            <div 
                id="northAmericaMessage"
                class="mt-3 p-4 bg-orange-50 border-l-4 border-orange-600 text-gray-900 rounded-md text-sm hidden">
                <strong class="text-orange-700">Important Notice:</strong><br>
                This option applies only to sales applicants located in 
                <strong>North America (Canada and the United States)</strong>.
                <br><br>
                If you are applying from Kenya or any other African country, please ignore this section and continue with the 
                East Africa Sales Team application form below.
            </div>
        </div>

        <!--Grow With Moose Loon AI -->
        <section class="bg-gradient-to-br from-indigo-50 to-purple-50 p-8 rounded-2xl shadow-inner border border-indigo-100 mb-12">
                <h2 class="text-3xl font-extrabold text-indigo-700 mb-4 text-center">
                    Grow With Moose Loon AI: AI Knowledge, Sales Skills, and Leadership Roles
                </h2>

                <p class="text-center text-gray-700 text-lg mb-8">
                    Both the <strong>AI Sales Foundation Program</strong> and the <strong>AI Sales Supervisory Program</strong> will train you in Artificial Intelligence (AI) and AI Sales Skills.
                    These programs give you the knowledge, confidence, and professional ability to succeed in the field.
                </p>

                <div class="prose max-w-none text-gray-800">

                    <p class="font-semibold text-indigo-700">The difference is simple:</p>
                    <p>👉 <strong>The Supervisory Program goes further</strong> — it prepares you for real leadership roles within Moose Loon AI.</p>

                    <hr class="my-6">

                    <!-- Journey Section -->
                    <h3 class="text-2xl font-bold text-gray-900">Your Journey Through Moose Loon AI Training</h3>

                    <h4 class="text-xl font-semibold text-indigo-700 mt-4">AI Sales Foundation Program</h4>
                    <p>Start your journey into AI — discover how AI transforms businesses and build essential AI sales skills that help you communicate confidently and professionally.</p>

                    <h4 class="text-xl font-semibold text-indigo-700 mt-6">AI Sales Supervisory Program</h4>
                    <p>Advance further by learning leadership, team influence, people management, and real supervisory skills that help you rise within Moose Loon AI.</p>

                    <p class="italic bg-white p-4 rounded-lg shadow border-l-4 border-indigo-400 mt-4">
                        This is more than training — it is your path to becoming a skilled AI professional and a future leader.
                    </p>

                    <hr class="my-6">

                    <!-- Why Two Fields -->
                    <h3 class="text-2xl font-bold text-gray-900">Why Moose Loon AI Trains Applicants in Two Fields</h3>

                    <ul class="list-disc list-inside">
                        <li>AI Knowledge</li>
                        <li>AI Sales Mastery</li>
                    </ul>
                    <p>This combination gives every recruit the confidence, skills, and long-term advantage required to excel in an AI-powered economy.</p>

                    <hr class="my-6">

                    <!-- AI Knowledge -->
                    <h3 class="text-2xl font-bold text-gray-900">1️⃣ Training in Artificial Intelligence (AI): Understanding What You Are Selling</h3>

                    <p>Moose Loon AI ensures you truly understand AI — because you cannot sell what you do not understand.</p>

                    <h4 class="text-xl font-semibold text-indigo-700 mt-4">What You Learn</h4>
                    <ul class="list-disc list-inside">
                        <li>What AI is and how it works</li>
                        <li>Why AI is transforming businesses in Kenya</li>
                        <li>How AI solves real business challenges</li>
                        <li>How global companies use AI to scale faster</li>
                    </ul>

                    <h4 class="text-xl font-semibold text-indigo-700 mt-4">Powered by Canadian Innovation</h4>
                    <p>Moose Loon AI brings North American AI standards directly to Kenya — giving you Canadian-level expertise and modern automation skills.</p>

                    <hr class="my-6">

                    <!-- Sales Skills -->
                    <h3 class="text-2xl font-bold text-gray-900">2️⃣ Training in AI Sales Skills: A Personal Investment in Every Applicant</h3>

                    <p>You gain a lifetime skillset in professional AI sales that helps you succeed in any career.</p>

                    <h4 class="text-xl font-semibold text-indigo-700 mt-4">Skills You Build</h4>
                    <ul class="list-disc list-inside">
                        <li>Confident communication</li>
                        <li>Professional business approach</li>
                        <li>AI solution presentations</li>
                        <li>Objection handling</li>
                        <li>Closing sales effectively</li>
                        <li>Lead management & reporting discipline</li>
                        <li>Team leadership (for Supervisory track)</li>
                    </ul>

                    <h4 class="text-xl font-semibold text-indigo-700 mt-4">Canadian Sales Excellence</h4>
                    <p>You learn communication and leadership standards used across Toronto, Vancouver, Calgary, and the North American tech industry.</p>

                    <hr class="my-6">

                    <!-- Combined Benefit -->
                    <h3 class="text-2xl font-bold text-gray-900">Why Moose Loon AI Combines Both Fields</h3>
                    <p>By mastering AI knowledge and sales mastery, you become:</p>

                    <ul class="list-disc list-inside">
                        <li>Confident</li>
                        <li>Professional</li>
                        <li>Knowledgeable</li>
                        <li>Leadership-ready</li>
                        <li>Prepared for the digital economy</li>
                    </ul>

                    <p class="italic bg-white p-4 rounded-lg shadow border-l-4 border-yellow-400 mt-6">
                        Canadian Innovation • Kenyan Opportunity • African Growth
                    </p>

                    <hr class="my-6">

                    <!-- Summary -->
                    <h3 class="text-2xl font-bold text-gray-900">Summary</h3>
                    <p>When you complete the Combo Program (Foundation + Supervisory), you become:</p>
                    <ul class="list-disc list-inside">
                        <li>A certified Moose Loon AI Supervisor</li>
                        <li>A trained leadership professional</li>
                        <li>Eligible for County, Regional, National, and East Africa leadership roles</li>
                        <li>A leader capable of shaping the future of Moose Loon AI</li>
                    </ul>

                </div>
            </section>


        <!-- REPLACED TRAINING SECTION -->
        <section class="prose max-w-none mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Moose Loon AI Sales Team – Training Structure</h2>

            <p class="text-gray-700">
                All recruits are required to pay a <strong>50% deposit</strong> to begin training.  
                The remaining balance is paid <strong>after employment</strong>, based on a personal agreement.
            </p>

            <hr class="my-6">

            <div class="space-y-6">

                <!-- Foundation Program -->
                <div class="bg-gray-50 p-6 rounded-lg shadow border border-indigo-200">
                    <h3 class="font-bold text-indigo-700 text-xl">✅ 1. AI Sales Foundation Program (Mandatory) – KSh 3,000</h3>
                    <ul class="mt-2 text-gray-700">
                        <li>• Access Deposit (50%): <strong>KSh 1,500</strong></li>
                        <li>• Balance After Employment: <strong>KSh 1,500</strong></li>
                    </ul>
                </div>

                <hr>

                <!-- Combo Package -->
                <div class="bg-yellow-50 p-6 rounded-lg shadow border border-yellow-300">
                    <h3 class="font-bold text-yellow-700 text-xl">🔥 Combo Package: Foundation + Supervisory Program – KSh 5,000</h3>
                    <ul class="mt-2 text-gray-700">
                        <li>• Access Deposit (50%): <strong>KSh 2,500</strong></li>
                        <li>• Balance After Employment: <strong>KSh 2,500</strong></li>
                    </ul>
                </div>

            </div>
        </section>

        <!-- NEW SECTION: Training Instructions and Leadership Development Path -->
        <section class="prose max-w-none mb-12">
            <h2 class="text-2xl font-bold text-gray-900">Moose Loon AI – Sales Training Instructions & Leadership Development Path</h2>

            <hr class="my-6">

            <h3 class="text-xl font-semibold text-indigo-700">1. Foundation Program – Mandatory for All Applicants</h3>
            <p>This program teaches the essential skills needed to start as a Sales Associate, including:</p>
            <ul class="list-disc list-inside space-y-1">
                <li>What AI is and how our solutions support Kenyan businesses</li>
                <li>Understanding customer needs and sales psychology</li>
                <li>Field preparation and professional conduct</li>
                <li>Approaching business owners with confidence</li>
                <li>Handling objections and closing techniques</li>
                <li>Lead collection, follow-up, and reporting</li>
            </ul>
            <p>This program ensures you can represent Moose Loon AI professionally and perform well in the field.</p>

            <hr class="my-6">

            <h3 class="text-xl font-semibold text-indigo-700">2. Interested in Leadership? Consider the Combo (Foundation + Supervisory Program)</h3>
            <p>
                Moose Loon AI’s Supervisory Program is designed for applicants who want to grow into leadership roles.
            </p>

            <h4 class="font-semibold text-gray-800 mt-4">Leadership Pathway – Roles You Can Grow Into</h4>
            <ul class="list-disc list-inside space-y-1">
                <li>AI Sales Supervisor</li>
                <li>County Manager</li>
                <li>Regional Manager</li>
                <li>Country Director (Kenya)</li>
                <li>East Africa Director</li>
            </ul>

            <p>
                These roles require leadership readiness, which is why completing the combo program is an advantage for anyone aiming for management.
            </p>

            <p class="mt-3">
                Many applicants choose the combo because it provides:
            </p>
            <ul class="list-disc list-inside space-y-1">
                <li>Strong leadership & communication skills</li>
                <li>Team management & coordination training</li>
                <li>Priority consideration for management roles</li>
                <li>Professional development for long-term career growth</li>
            </ul>

            <hr class="my-6">

            <h3 class="font-semibold text-indigo-700 text-xl">Choosing the Path That Fits Your Goals</h3>
            <ul class="list-none space-y-2">
                <li>✔ <strong>Foundation Only</strong> → Best for applicants starting as Sales Associates.</li>
                <li>✔ <strong>Foundation + Supervisory Combo</strong> → Ideal for leadership and long-term growth.</li>
            </ul>

            <p>
                While the combo is not mandatory, current leadership positions require the Combo certification.
            </p>

            <hr class="my-6">

            <h3 class="font-semibold text-indigo-700 text-xl">Final Guidance Before You Begin</h3>
            <p class="text-gray-700">
                As you begin your Foundation Program, consider:
            </p>
            <ul class="list-disc list-inside space-y-1">
                <li>Do you want to focus only on sales?</li>
                <li>Or do you want to grow into leadership and management in the future?</li>
            </ul>

            <p>
                Moose Loon AI is committed to developing future leaders across Kenya and East Africa.  
                Whichever path you choose, give the training your full effort — this is the beginning of your journey into the AI-powered business world.
            </p>
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
                    <input type="text" name="full_name" id="full_name" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Select Training Program <span class="text-red-500">*</span></label>
                    <select id="position" name="position" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option value="" disabled selected>Select a program</option>
                        <option value="AI Sales Foundation Program">AI Sales Foundation Program</option>
                        <option value="Combo Package: Foundation + Supervisory">Combo Package: Foundation + Supervisory</option>
                    </select>
                </div>

                <div>
                    <label for="cv_cover" class="block text-sm font-medium text-gray-700 mb-1">Upload CV & Cover Letter (PDF, max 5MB) <span class="text-red-500">*</span></label>
                    <input type="file" name="cv_cover" id="cv_cover" required accept=".pdf" class="w-full">
                </div>

                <button type="submit" class="w-full py-3 px-4 rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Submit Application
                </button>
            </form>
        </section>

    </div>
</div>

<!-- JS -->
<script>
const positionSelect = document.getElementById('position');
const positionSlugInput = document.getElementById('position_slug');

function slugify(text) {
    return text.toLowerCase().trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w-]+/g, '')
        .replace(/--+/g, '-');
}

positionSelect.addEventListener('change', function() {
    positionSlugInput.value = slugify(this.value);
});

document.addEventListener('DOMContentLoaded', () => {
    const toggleNA = document.getElementById('toggleNorthAmericaBtn');
    const naMsg = document.getElementById('northAmericaMessage');

    toggleNA.addEventListener('click', () => {
        naMsg.classList.toggle('hidden');
    });

});
</script>
@endsection
