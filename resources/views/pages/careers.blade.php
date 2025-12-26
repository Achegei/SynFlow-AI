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

        <!-- Sales Team Image -->
        <div class="mb-10 flex justify-center">
            <img 
                src="{{ asset('images/mooseloonsalesteam.jpg') }}" 
                alt="Moose Loon AI Sales Team"
                class="w-full max-w-5xl rounded-2xl shadow-xl object-cover"
            >
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

        <!-- Beginner-Friendly AI Sales Course Section -->
            <section class="mb-12 bg-gray-50 p-8 rounded-2xl shadow-inner border border-gray-200">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">
                    🌍 Moose Loon AI – Building an AI Sales Team Empire for Ordinary People
                </h2>
                <p class="text-gray-800 font-semibold mb-2">At Moose Loon AI, we are creating an AI Sales Team Empire designed for ordinary people, making it easy to participate in the new AI-era economy.</p>

                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">🚫 What You Do NOT Need</h3>
                    <ul class="list-disc list-inside text-gray-800 space-y-1">
                        <li>❌ Coding</li>
                        <li>❌ Mathematics</li>
                        <li>❌ Computer science</li>
                        <li>❌ Prior AI knowledge</li>
                        <li>❌ University degree</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">✅ What You DO Need</h3>
                    <ul class="list-disc list-inside text-gray-800 space-y-1">
                        <li>✔ Ability to read and listen</li>
                        <li>✔ Willingness to learn</li>
                    </ul>
                </div>
            </section>


        <!-- Moose Loon AI – Sales Associate Application & Onboarding Process -->
        <section class="mb-12 bg-white p-8 rounded-2xl shadow-lg border border-gray-200">

            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">
                Moose Loon AI – Sales Associate Application & Onboarding Process
            </h2>

            <p class="text-gray-700 mb-6 italic">
                A Message from Alexandre Bouchard, Founder & Chief Executive Officer (CEO), on How We Select and Prepare AI-Era Sales Professionals
            </p>

            <p class="text-gray-800 mb-4">
                At Moose Loon AI, we don’t just recruit salespeople — we build future-ready AI professionals.
                Our onboarding process is designed to identify motivated individuals and equip them with Canadian-standard AI business and sales skills that remain valuable across any AI-enabled industry worldwide.
            </p>

            <p class="text-gray-800 mb-4">
                Whether a Sales Associate is based in North America, South America, Europe, Africa, Asia, Australia, or Antarctica, our selection, training, and onboarding process remains the same.
                This consistency is essential to our mission and vision of building a trusted, world-class AI business solutions company.
            </p>

            <p class="text-gray-800 mb-8">
                Below is our transparent, step-by-step selection and onboarding process.
            </p>

            <hr class="my-6 border-gray-300">

            <!-- STEP 1 -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-indigo-700 mb-2">🧭 STEP 1: Apply Online</h3>

                <p class="text-gray-800 mb-2">Submit your application through our official website.</p>

                <p class="text-gray-800 mb-2">Applications are reviewed based on:</p>
                <ul class="list-disc list-inside text-gray-800 space-y-1 mb-2">
                    <li>Learning mindset and professionalism</li>
                    <li>Interest in AI-powered business solutions</li>
                    <li>Alignment with Moose Loon AI values and ethics</li>
                </ul>

                <p class="text-gray-700 font-semibold">📌 Only shortlisted applicants proceed to the next stage.</p>
            </div>

            <hr class="my-6 border-gray-300">

            <!-- STEP 2 -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-indigo-700 mb-2">🧠 STEP 2: Step 2 : Free Access AI Sales Skill Program( Shortlisted Applicants)- No technical background required.</h3>
                <p class="text-gray-800 mb-2 font-semibold">
                    Sales Skills Program – you Learn practical skills to sell AI-powered business solutions professionally in the AI era. No technical background required.
                </p>

                <p class="text-gray-800 mb-2">
                    Shortlisted candidates receive free access to the AI Sales Skills Program, fully covered by Moose Loon AI.
                </p>

                <p class="text-gray-800 mb-4">
                    This stage introduces candidates to global-standard, future-ready sales skills designed for the AI era.
                </p>

                <h4 class="font-semibold text-gray-900 mb-1">🌍 Global-Standard Sales Training</h4>
                <ul class="list-disc list-inside text-gray-800 mb-3">
                    <li>Training aligned with international best practices</li>
                    <li>Skills transferable across countries, industries, and markets</li>
                </ul>

                <h4 class="font-semibold text-gray-900 mb-1">🚀 Future-Proof Career Skills</h4>
                <ul class="list-disc list-inside text-gray-800 mb-3">
                    <li>Practical sales skills designed specifically for AI-driven environments</li>
                    <li>Preparation for modern sales roles across multiple industries</li>
                </ul>

                <h4 class="font-semibold text-gray-900 mb-1">🤖 AI Business Communication Skills</h4>
                <ul class="list-disc list-inside text-gray-800 mb-3">
                    <li>Explain AI benefits and solutions clearly (non-technical)</li>
                    <li>Handle real client scenarios with confidence</li>
                    <li>Respond to common client questions accurately and professionally</li>
                </ul>

                <h4 class="font-semibold text-gray-900 mb-1">💬 Professional Sales Techniques</h4>
                <ul class="list-disc list-inside text-gray-800 mb-3">
                    <li>Objection handling</li>
                    <li>Consultative selling approach</li>
                    <li>Professional presentation and follow-up</li>
                </ul>

                <h4 class="font-semibold text-gray-900 mb-1">🧭 Ethical & Trust-Based Selling</h4>
                <ul class="list-disc list-inside text-gray-800 mb-3">
                    <li>Commitment to ethical sales practices</li>
                    <li>Focus on long-term customer value, not short-term sales</li>
                    <li>Skills applicable across multiple AI-enabled careers</li>
                </ul>

                <p class="text-gray-800">
                    This overview ensures candidates understand the foundations, expectations, and real-world application of AI-powered sales before moving forward.
                </p>
            </div>

            <hr class="my-6 border-gray-300">

            <!-- STEP 3 -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-indigo-700 mb-2">✍️ STEP 3: Short Essay Submission (250–400 Words)</h3>

                <p class="text-gray-800 mb-2">Candidates are required to submit a short essay on the following topic:</p>
                <p class="font-semibold text-gray-900 mb-2">“How Does Moose Loon AI Transform Businesses Through AI Solutions?”</p>

                <p class="text-gray-800 mb-2">This helps us evaluate:</p>
                <ul class="list-disc list-inside text-gray-800 mb-2">
                    <li>Written communication ability</li>
                    <li>Understanding of our mission and offerings</li>
                    <li>Passion for selling modern AI and digital solutions</li>
                    <li>Critical thinking around business transformation</li>
                </ul>

                <p class="font-semibold text-gray-700">📌 This is a key evaluation stage in the selection process.</p>
            </div>

            <hr class="my-6 border-gray-300">

            <!-- STEP 4 -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-indigo-700 mb-2">✅ STEP 4: Sales Associate Selection Decision</h3>
                <p class="text-gray-800">
                    Candidates who successfully pass the evaluation receive a Congratulations & Offer Email, officially confirming acceptance into the Moose Loon AI Sales Associate role.
                </p>
            </div>

            <hr class="my-6 border-gray-300">

            <!-- STEP 5 -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-indigo-700 mb-2">🎓 STEP 5: Official Invitation to Training & Certification on AI Business Solutions Program</h3>
                <p class="text-gray-800 mb-2">
                    Accepted candidates are formally invited to begin the:
                </p>
                <p class="font-semibold text-gray-900 mb-4">
                    Moose Loon AI Business Solutions Training & Certification Program
                </p>

                <ul class="list-disc list-inside text-gray-800 mb-3">
                    <li>High-performance AI-powered sales roles</li>
                    <li>Ethical, consultative client engagement</li>
                    <li>Long-term career growth in the global AI economy</li>
                </ul>
            </div>

            <hr class="my-6 border-gray-300">

            <!-- STEP 6 -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-indigo-700 mb-2">🔐 STEP 6: Candidate Selection & Training Activation Notice</h3>

                <p class="text-gray-800 mb-2">
                    Selected candidates are required to complete a small, fully refundable commitment to activate access to training and certification resources.
                </p>

                <p class="text-gray-800 mb-2">
                    Full details are shared during the onboarding process.
                </p>
            </div>


            <hr class="my-6 border-gray-300">

            <!-- STEP 7 -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-indigo-700 mb-2">🏆 STEP 7: Certification, Tracking, Welcome & Contract</h3>

                <p class="text-gray-800 mb-2">
                    Upon successful completion of the program:
                </p>

                <ul class="list-disc list-inside text-gray-800 mb-3">
                    <li>You print your AI Business Solutions Certificate and send it back for secure record-keeping, allowing Moose Loon AI to track training history, skill progression, eligibility for advanced roles or leadership opportunities, and future verification when requested by a third party (e.g., employer or institution)</li>
                    <li>You receive an official welcome message from: <br>
                        <span class="font-semibold">Alexandre Bouchard, Founder & Chief Executive Officer (CEO), Moose Loon AI</span>
                    </li>
                    <li>You receive your Sales Associate Contract Agreement</li>
                    <li>You officially begin your role as a Moose Loon AI Sales Associate</li>
                </ul>
            </div>

            <hr class="my-6 border-gray-300">

            <!-- Commitment -->
            <div class="mt-10 border-t pt-6">
                <h3 class="text-xl font-bold text-gray-900 mb-3">🌍 Our Commitment</h3>
                <p class="text-gray-800">
                    At Moose Loon AI, we invest in people before expecting performance.
                </p>
                <p class="text-gray-800 font-semibold mt-1">
                    We don’t just offer sales roles — we build AI-powered careers.
                </p>
            </div>

        </section>


        <!-- Structured Training Info -->
        <section class="mb-10 bg-gray-50 p-6 rounded-lg border border-gray-200 shadow-sm">
            <h2 class="text-xl font-bold text-gray-900 mb-4">CERTIFICATE VERIFICATION</h2>
            <p class="text-gray-800 mb-2">
                For Employers, Government Partners & Institutions. <br>

                The certificate is valid only if verified through the official Moose Loon AI Certificate Verification System or formally confirmed in writing by Moose Loon AI Solutions.

                The Moose Loon AI Certificate Verification System is maintained in accordance with international best practices for transparency, accountability, data integrity, and auditability.
                </p>
            <!-- Application Notice -->
            <section class="mb-8">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">
                        Applicant Notice
                    </h2>

                    <p class="text-gray-800 mb-4">
                        This opportunity is for candidates who are seeking employment with Moose Loon AI. If your goal is only to obtain an AI Sales Business Solutions certificate<span class="font-semibold"> please do not apply, as positions are limited and reserved for employment-focused applicants.</span> 
                         We have received certificate verification requests from employers.
                        <span class="font-semibold text-red-600"> AI Sales Skills and AI Business Solutions certificate training are provided as part of employment.</span>
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
