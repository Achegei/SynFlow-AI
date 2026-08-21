<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Institution;
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
        protected SmartEmailEventService $emailEvents
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

        $selectedPackageId = session('selected_ai_package_id');
        $selectedAiCourseId = session('selected_ai_course_id');

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

        $institutionId = session('selected_institution_id');

        $institution = $institutionId
            ? Institution::find($institutionId)
            : null;

        /*
        |--------------------------------------------------------------------------
        | If this is NOT an AI registration, institution remains mandatory.
        |--------------------------------------------------------------------------
        */

        if (!$institution && !$selectedPackageId) {
            return back()
                ->withInput()
                ->withErrors([
                    'institution' =>
                        'Please select a valid institution before registering.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_url' => $profilePhotoUrl,
            'role' => 'student',
            'referred_by' => $referrer?->id,

            /*
            | AI learners can register without an institution.
            */
            'institution_id' => $institution?->id,
        ]);

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
                'registration_type' => $selectedPackageId
                    ? 'ai_package'
                    : 'institution',

                'user_id' => $user->id,

                'package_id' => $selectedPackageId,

                'ai_course_id' => $selectedAiCourseId,

                'institution_id' => $institution?->id,
            ],
            $request
        );

        $this->emailEvents->handle(
            'registration_completed',
            $user,
            [
                'registration_type' => $selectedPackageId
                    ? 'ai_package'
                    : 'institution',
                'package_id' => $selectedPackageId,
                'ai_course_id' => $selectedAiCourseId,
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

        if ($selectedPackageId) {

            /*
            |--------------------------------------------------------------------------
            | Make sure we know which AI course this package unlocks.
            |--------------------------------------------------------------------------
            */

            if (!$selectedAiCourseId) {

                Auth::logout();

                return redirect()
                    ->route('ai.packages')
                    ->with('error', 'Please select an AI package again.');
            }

            /*
            |--------------------------------------------------------------------------
            | Preserve the AI selection for the payment controller.
            |--------------------------------------------------------------------------
            */

            session()->put([
                'selected_ai_package_id' => $selectedPackageId,
                'selected_ai_course_id' => $selectedAiCourseId,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Institution selection is no longer needed.
            |--------------------------------------------------------------------------
            */

            session()->forget('selected_institution_id');

            /*
            |--------------------------------------------------------------------------
            | Continue to AI payment.
            |--------------------------------------------------------------------------
            */

            return redirect()->route('ai.payment.create', [
                'package' => $selectedPackageId,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | NORMAL INSTITUTION REGISTRATION FLOW
        |--------------------------------------------------------------------------
        */

        session()->forget('selected_institution_id');

        return redirect()->route('classroom');
    }
}