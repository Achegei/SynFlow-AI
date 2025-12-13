@extends('layouts.public')

@section('title', 'FAQ')

@section('content')
<div class="container my-5">
    <!-- FAQ Section -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 text-center sm:text-4xl">
                Moose Loon AI – Sales Team FAQ
            </h2>
            <p class="mt-4 text-xl text-gray-500 text-center">
                Kenya Nationwide Recruitment – Frequently Asked Questions
            </p>

            <div class="mt-12 max-w-4xl mx-auto space-y-6">

                @php
                    $faqs = [
                        ['q' => 'What positions are currently open?', 
                         'a' => 'We are hiring for a nationwide role across Kenya:<br>• AI Sales Associate'],

                        ['q' => 'Do I need prior AI experience to apply?', 
                         'a' => 'No. Moose Loon AI provides full training for all applicants, regardless of background.'],

                        ['q' => 'Is training mandatory?', 
                         'a' => 'YES. All applicants MUST complete:<br>• AI Sales Foundation Program — Mandatory for all applicants<br>Applicants without certificates will not be considered.'],

                        ['q' => 'Why is the training mandatory?', 
                         'a' => 'Because you will be presenting AI solutions to companies. Training ensures you:<br>• Understand our products<br>• Present professionally<br>• Close sales confidently<br>• Represent the brand at a high standard'],

                        ['q' => 'How long does the training take?', 
                         'a' => 'Training is fully online:<br>• 1–2 days for Foundation Program<br>• 1 day for Supervisory Program<br>Study at your own pace.'],

                        ['q' => 'Will I receive a certificate after training?', 
                         'a' => 'Yes. You will receive an official Moose Loon AI Certification, which is required when applying.'],

                        ['q' => 'How do I submit my job application?', 
                         'a' => 'Submit via:<br>1. Email: careers@mooseloonai.ca<br>2. Website Career Section: www.mooseloonai.ca'],

                        ['q' => 'What documents must I submit?', 
                         'a' => '• CV<br>• Short Cover Letter<br>• Training Certificate(s)<br>Applications without certificates cannot be processed.'],

                        ['q' => 'What are the duties of a Sales Associate?', 
                         'a' => '• Approach businesses<br>• Present AI Solutions<br>• Explain automation benefits<br>• Build leads & close sales<br>• Submit weekly digital reports'],

                        ['q' => 'What are the duties of a Sales Supervisor?', 
                         'a' => '• Lead & mentor Associates<br>• Review reports<br>• Support operations<br>• Train recruits<br>• Ensure productivity'],

                        ['q' => 'Is this job remote or field-based?', 
                         'a' => '• Associates: Field-based in your local area<br>• Supervisors: Field + remote admin tasks'],

                        ['q' => 'Do I need to physically report to the Nairobi office?', 
                         'a' => 'No. Reports are submitted digitally to the Nairobi HQ.'],

                        ['q' => 'What is the orientation process?', 
                         'a' => '• Nairobi recruits: In-person orientation<br>• Other regions: Digital onboarding'],

                        ['q' => 'What does Moose Loon AI offer to sales members?', 
                         'a' => '• Full AI training<br>• Sales scripts & tools<br>• Commissions + bonuses<br>• Career growth<br>• Access to AI tools<br>• Ongoing development'],

                        ['q' => 'Is there an application deadline?', 
                         'a' => 'Yes. Application Deadline: December 31, 2025 — Midnight. Recruitment may close early if positions fill up.'],

                        ['q' => 'Who can apply?', 
                         'a' => '• Students<br>• Jobseekers<br>• Freelancers<br>• Working professionals<br>• Small business owners<br>Anyone confident and disciplined may apply.'],

                        ['q' => 'Is this a nationwide recruitment?', 
                         'a' => 'YES — We are expanding into all 47 counties across Kenya by 2026.'],

                        ['q' => 'Are there opportunities for promotion?', 
                         'a' => 'Yes. Top performers can grow into:<br>• County Manager<br>• Regional Manager<br>• National Oversight Roles'],

                        ['q' => 'When do selected applicants start?', 
                         'a' => 'Immediately after completing training and onboarding.'],

                        ['q' => 'How can I contact Moose Loon AI?', 
                         'a' => 'Nairobi HQ:<br>14th Floor, Delta Corner Tower 2, Westlands<br>Email: careers@mooseloonai.ca<br>Website: www.mooseloonai.ca'],

                        ['q' => 'Where are Moose Loon AI’s North America Headquarters located?', 
                         'a' => 'Toronto, Canada — Executive, Technology & North American Division'],

                        ['q' => 'What does the Canada Headquarters do?', 
                         'a' => '• Global AI R&D<br>• Design of enterprise AI systems<br>• Training & Certification Standards<br>All Moose Loon AI training programs are developed and quality controlled here.'],

                        ['q' => 'Where is the East Africa Headquarters located?', 
                         'a' => '14th Floor, Delta Corner Tower 2, Waiyaki Way, Westlands — Regional Operations & Africa Division'],

                        ['q' => 'What does the East Africa Headquarters do?', 
                         'a' => '• Regional leadership<br>• Sales workforce management<br>• Oversight across Kenya and neighboring East African countries'],
                    ];
                @endphp

                @foreach($faqs as $index => $faq)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <button class="w-full flex justify-between items-center text-left" onclick="toggleAccordion('faq{{ $index }}')">
                        <span class="text-lg font-medium text-gray-800">{{ $faq['q'] }}</span>
                        <svg id="icon-faq{{ $index }}" class="w-6 h-6 transform transition-transform duration-300 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                    <div id="faq{{ $index }}" class="accordion-content hidden">
                        <p class="mt-4 text-gray-600">{!! $faq['a'] !!}</p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection

<script>
function toggleAccordion(id) {
    const content = document.getElementById(id);
    const icon = document.getElementById(`icon-${id}`);
    content.classList.toggle('hidden');
    icon.classList.toggle('rotate-45');
}
</script>
