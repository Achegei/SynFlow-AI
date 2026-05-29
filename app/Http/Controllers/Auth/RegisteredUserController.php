<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | Capture Referral Code
        |--------------------------------------------------------------------------
        |
        | Example:
        | /register?ref=UON
        |
        */

        $referralCode = $request->query('ref');

        // Persist in session
        if ($referralCode) {
            session(['referral_code' => $referralCode]);
        }

        /*
        |--------------------------------------------------------------------------
        | Detect Institution
        |--------------------------------------------------------------------------
        */

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
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'max:2048'
            ],

            'referral_code' => [
                'nullable',
                'string'
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Handle Profile Photo
        |--------------------------------------------------------------------------
        */

        $profilePhotoUrl = null;

        if ($request->hasFile('profile_photo')) {

            $profilePhotoUrl = $request->file('profile_photo')
                ->store('profile-photos', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Resolve User Referrer
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
        | Resolve Institution From Session
        |--------------------------------------------------------------------------
        */

        $institution = null;

        if (session()->has('selected_institution_id')) {

            $institution = Institution::find(
                session('selected_institution_id')
            );
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

            // Existing referral system
            'referred_by' => $referrer?->id,

            // NEW institution system
            'institution_id' => $institution?->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Prevent Self Referral
        |--------------------------------------------------------------------------
        */

        if ($user->referred_by === $user->id) {

            $user->update([
                'referred_by' => null
            ]);
        }

        event(new Registered($user));

        Auth::login($user);
        session()->forget('selected_institution_id');

        return redirect(route('classroom', absolute: false));
    }
}