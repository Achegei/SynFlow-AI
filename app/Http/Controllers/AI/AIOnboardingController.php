<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\OnboardingProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\LeadTrackingService;

class AIOnboardingController extends Controller
{

    public function __construct(
    protected LeadTrackingService $tracking
) {
}
    /**
     * Start onboarding.
     */
    public function start()
    {
        session()->forget('ai_onboarding');

        return redirect()->route('ai.onboarding.step', 1);
    }

    /**
     * Display onboarding step.
     */
    public function step(Request $request, $step)
    {
        $steps = $this->steps();

        if (!isset($steps[$step])) {
            return redirect()->route('ai.onboarding.step', 1);
        }


        /*
    |--------------------------------------------------------------------------
    | Establish lead attribution
    |--------------------------------------------------------------------------
    |
    | The first onboarding page is the visitor's landing point.
    | Capture the visitor ID, original landing page and UTM parameters
    | BEFORE the JavaScript tracking request to /track/lead fires.
    |
    */

    if (!$request->session()->has('lead_visitor_id')) {
        $request->session()->put(
            'lead_visitor_id',
            (string) \Illuminate\Support\Str::uuid()
        );
    }

    \Log::info('BEFORE LANDING PAGE INIT', [
    'step' => $step,
    'session_id' => $request->session()->getId(),
    'has_landing_page' => $request->session()->has('lead_landing_page'),
    'existing_landing_page' => $request->session()->get('lead_landing_page'),
    'current_url' => $request->fullUrl(),
    'session_data' => $request->session()->all(),
]);
    if (!$request->session()->has('lead_landing_page')) {
        $request->session()->put(
            'lead_landing_page',
            $request->fullUrl()
        );
    }

    foreach ([
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
    ] as $utm) {
        $value = $request->query($utm);

        if ($value !== null && $value !== '') {
            $request->session()->put(
                'lead_' . $utm,
                $value
            );
        }
    }

    //test
    \Log::info('AFTER LANDING PAGE INIT', [
    'step' => $step,
    'url' => $request->fullUrl(),
    'session_id' => $request->session()->getId(),
    'visitor_id' => $request->session()->get('lead_visitor_id'),
    'landing_page' => $request->session()->get('lead_landing_page'),
    'utm_source' => $request->session()->get('lead_utm_source'),
    'utm_medium' => $request->session()->get('lead_utm_medium'),
    'utm_campaign' => $request->session()->get('lead_utm_campaign'),
]);

        $data = session('ai_onboarding', []);

        return view('ai.onboarding.step', [
            'step' => $step,
            'totalSteps' => count($steps),
            'stepData' => $steps[$step],
            'data' => $data,
        ]);
    }

    /**
     * Process onboarding step.
     */
    public function store(Request $request, $step)
    {
        $steps = $this->steps();

        if (!isset($steps[$step])) {
            abort(404);
        }

        $validationRules = $this->validationRules($step);

        $validated = $request->validate($validationRules);

        /*
        |--------------------------------------------------------------------------
        | Store onboarding information in session
        |--------------------------------------------------------------------------
        */

        $onboarding = session('ai_onboarding', []);

        $onboarding = array_merge(
            $onboarding,
            $validated
        );

        session([
            'ai_onboarding' => $onboarding
        ]);

        /*
        |--------------------------------------------------------------------------
        | Move to next step
        |--------------------------------------------------------------------------
        */

        $nextStep = $step + 1;

        if (isset($steps[$nextStep])) {
            return redirect()->route(
                'ai.onboarding.step',
                $nextStep
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Final onboarding step
        |--------------------------------------------------------------------------
        */

        return redirect()->route('ai.path');
    }

    /**
     * Save onboarding profile to database.
     */
    public function complete(Request $request)
    {
        $data = session('ai_onboarding', []);

        if (empty($data)) {
            return redirect()
                ->route('ai.onboarding.start')
                ->with('error', 'Please complete the onboarding process.');
        }

        /*
        |--------------------------------------------------------------------------
        | If user is already authenticated
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {

            OnboardingProfile::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                ],
                [
                    'profile_type' => $data['profile_type'] ?? null,
                    'main_goal' => $data['main_goal'] ?? null,
                    'industry' => $data['industry'] ?? null,
                    'ai_experience' => $data['ai_experience'] ?? null,
                    'skills_needed' => $data['skills_needed'] ?? null,
                    'income_interest' => $data['income_interest'] ?? null,
                    'name' => $data['name'] ?? null,
                    'email' => $data['email'] ?? null,
                    'whatsapp' => $data['whatsapp'] ?? null,
                ]
            );

            session()->forget('ai_onboarding');

            return redirect()->route('ai.path');
        }

        /*
        |--------------------------------------------------------------------------
        | Not authenticated
        |--------------------------------------------------------------------------
        |
        | We keep the onboarding information in session.
        | Registration/login can use it afterwards.
        |--------------------------------------------------------------------------
        */

        return redirect()->route('register');
    }

    /**
     * Onboarding questions.
     */
    private function steps(): array
    {
        return [

            1 => [
                'title' => 'What best describes you?',
                'subtitle' => 'This helps us personalize your AI learning path.',
                'field' => 'profile_type',
                'type' => 'single',
                'options' => [
                    'student' => 'Student',
                    'employed' => 'Employed Professional',
                    'business_owner' => 'Business Owner',
                    'job_seeker' => 'Job Seeker',
                    'freelancer' => 'Freelancer',
                    'other' => 'Other',
                ],
            ],

            2 => [
                'title' => 'What is your main goal with AI?',
                'subtitle' => 'What would you most like AI to help you achieve?',
                'field' => 'main_goal',
                'type' => 'single',
                'options' => [
                    'career_growth' => 'Career Growth',
                    'new_career' => 'Start a New Career',
                    'freelancing' => 'Build a Freelancing Career',
                    'business' => 'Grow a Business',
                    'income' => 'Create an Additional Income',
                    'productivity' => 'Improve Personal Productivity',
                ],
            ],

            3 => [
                'title' => 'What field are you in?',
                'subtitle' => 'We will use this to recommend practical AI applications.',
                'field' => 'industry',
                'type' => 'single',
                'options' => [
                    'education' => 'Education',
                    'finance' => 'Finance',
                    'healthcare' => 'Healthcare',
                    'marketing' => 'Marketing',
                    'technology' => 'Technology',
                    'legal' => 'Legal',
                    'business' => 'Business',
                    'other' => 'Other',
                ],
            ],

            4 => [
                'title' => 'How much experience do you have with AI?',
                'subtitle' => 'There is no wrong answer.',
                'field' => 'ai_experience',
                'type' => 'single',
                'options' => [
                    'beginner' => 'I am a complete beginner',
                    'some_experience' => 'I have some experience',
                    'regular_user' => 'I use AI regularly',
                    'advanced' => 'I am an advanced AI user',
                ],
            ],

            5 => [
                'title' => 'What would you most like AI to help you with?',
                'subtitle' => 'Choose the area that interests you most.',
                'field' => 'skills_needed',
                'type' => 'single',
                'options' => [
                    'content' => 'Content Creation',
                    'research' => 'Research & Documents',
                    'automation' => 'Workflow Automation',
                    'data' => 'Data & Analysis',
                    'marketing' => 'Marketing & Sales',
                    'agents' => 'AI Agents & Chatbots',
                    'productivity' => 'Everyday Productivity',
                    'other' => 'Something Else',
                ],
            ],

            6 => [
                'title' => 'Which AI income opportunity interests you?',
                'subtitle' => 'We will connect your interests to practical learning.',
                'field' => 'income_interest',
                'type' => 'single',
                'options' => [
                    'freelancing' => 'AI Freelancing',
                    'automation_services' => 'AI Automation Services',
                    'consulting' => 'AI Consulting',
                    'agents' => 'Building AI Agents & Chatbots',
                    'content_marketing' => 'Content & Digital Marketing',
                    'ai_business' => 'Starting an AI Business',
                    'opportunities' => 'I am not sure — Show Me the Opportunities',
                ],
            ],

            7 => [
                'title' => 'Let’s create your AI learning profile',
                'subtitle' => 'We need your details to create your account and learning profile.',
                'field' => 'personal',
                'type' => 'personal',
                'options' => [],
            ],
        ];
    }

    /**
     * Validation rules for each step.
     */
    private function validationRules($step): array
    {
        return match ((int) $step) {

            1 => [
                'profile_type' => [
                    'required',
                    'string',
                    'max:50',
                ],
            ],

            2 => [
                'main_goal' => [
                    'required',
                    'string',
                    'max:50',
                ],
            ],

            3 => [
                'industry' => [
                    'required',
                    'string',
                    'max:50',
                ],
            ],

            4 => [
                'ai_experience' => [
                    'required',
                    'string',
                    'max:50',
                ],
            ],

            5 => [
                'skills_needed' => [
                    'required',
                    'string',
                    'max:50',
                ],
            ],

            6 => [
                'income_interest' => [
                    'required',
                    'string',
                    'max:50',
                ],
            ],

            7 => [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'email' => [
                    'required',
                    'email',
                    'max:255',
                ],

                'whatsapp' => [
                    'nullable',
                    'string',
                    'max:30',
                ],
            ],

            default => [],
        };
    }
}