<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Institution;
use App\Services\CourseEnrollmentService;
use App\Services\LeadTrackingService;
use App\Services\SmartEmailEventService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{


    public function __construct(
        protected LeadTrackingService $tracking,
        protected SmartEmailEventService $emailEvents,
        protected CourseEnrollmentService $enrollments
    ) {
    }
    /**
     * Show registration page.
     */
    public function create(Request $request): View
    {
        $referralCode = $request->query('ref');

        if ($referralCode) {
            session(['referral_code' => $referralCode]);
        }

        $institution = null;

        if ($referralCode) {
            $institution = Institution::where(
                'referral_code',
                $referralCode
            )->first();
        }

        return view('auth.register', [
            'referralCode' => $referralCode ?? session('referral_code'),
            'institution' => $institution,
        ]);
    }

    /**
     * Handle registration.
     */
    public function store(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Validate registration
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'max:2048',
            ],

            'referral_code' => [
                'nullable',
                'string',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Capture AI purchase selection BEFORE creating the user
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Profile Photo
        |--------------------------------------------------------------------------
        */

        $profilePhotoUrl = null;

        if ($request->hasFile('profile_photo')) {
            $profilePhotoUrl = $request
                ->file('profile_photo')
                ->store('profile-photos', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Referrer
        |--------------------------------------------------------------------------
        */

        $referrer = null;

        if ($request->filled('referral_code')) {
            $referrer = User::where(
                'referral_code',
                $request->referral_code
            )->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Institution Resolution
        |--------------------------------------------------------------------------
        |
        | There are now TWO registration paths:
        |
        | 1. Institution registration
        |    → institution is required.
        |
        | 2. Direct AI registration
        |    → institution is NOT required.
        |
        */

        $registrationContext = session('registration_context');

        if (!in_array($registrationContext, ['institution', 'other'], true)) {
            return redirect()
                ->route('choose.university')
                ->withErrors([
                    'registration_context' => 'Please select your enrollment pathway.',
                ]);
        }

        $institution = null;

        if ($registrationContext === 'institution') {
            $institution = Institution::query()
                ->whereKey(session('selected_institution_id'))
                ->where('status', 'active')
                ->first();

            if (!$institution) {
                return redirect()
                    ->route('choose.university')
                    ->withErrors([
                        'institution_id' => 'Please select an active institution.',
                    ]);
            }
        }

        if (
            $registrationContext === 'institution'
            && !$institution->sales_executive_id
        ) {
            return redirect()
                ->route('choose.university')
                ->withErrors([
                    'institution_id' =>
                        'This institution is not yet configured for enrollment. Please contact support.',
                ]);
        }

        /*
         |--------------------------------------------------------------------------
         | Create User
         |--------------------------------------------------------------------------
         */

        [$user, $enrollment] = \Illuminate\Support\Facades\DB::transaction(
            function () use (
                $request,
                $profilePhotoUrl,
                $referrer,
                $institution,
                $registrationContext
            ) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'profile_photo_url' => $profilePhotoUrl,
                    'role' => 'student',
                    'referred_by' => $referrer?->id,
                    'institution_id' => $institution?->id,
                    'must_change_password' => false,
                    'initial_password_reset_required' => true,
                ]);

                $enrollment = $this->enrollments->create(
                    $user,
                    $registrationContext,
                    $institution
                );

                return [$user, $enrollment];
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Prevent self referral
        |--------------------------------------------------------------------------
        */

        if ($user->referred_by === $user->id) {
            $user->update([
                'referred_by' => null,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Fire Registered Event
        |--------------------------------------------------------------------------
        */

        event(new Registered($user));

        /*
        |--------------------------------------------------------------------------
        | Log the user in
        |--------------------------------------------------------------------------
        */

        Auth::login($user);

        /*
            |--------------------------------------------------------------------------
            | Attach anonymous lead activity to the newly registered user
            |--------------------------------------------------------------------------
        */

            $visitorId = session('lead_visitor_id');

            if ($visitorId) {
                \App\Models\ActivityLog::where('visitor_id', $visitorId)
                    ->whereNull('user_id')
                    ->update([
                        'user_id' => $user->id,
                    ]);
            }

            /*
|--------------------------------------------------------------------------
| Record registration completed
|--------------------------------------------------------------------------
|
| This is the point where an anonymous lead becomes
| a known user in our funnel.
|
*/

        $this->tracking->track(
            'registration_completed',
            [
                'registration_type' => $registrationContext,

                'user_id' => $user->id,

                'institution_id' => $institution?->id,
            ],
            $request
        );

        $this->emailEvents->handle(
            'registration_completed',
            $user,
            [
                'registration_type' => $registrationContext,
                'institution_id' => $institution?->id,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | AI PACKAGE FLOW
        |--------------------------------------------------------------------------
        |
        | If the learner came through:
        |
        | AI Packages
        |     ↓
        | Select Package
        |     ↓
        | Register
        |
        | send them to AI payment.
        |
        */

        session()->forget([
            'selected_institution_id',
            'registration_context',
            'selected_ai_package_id',
            'selected_ai_course_id',
        ]);

        return redirect()->route(
            'purchase.show',
            $enrollment->course_id
        );
    }
}