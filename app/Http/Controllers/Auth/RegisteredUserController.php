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
     * Show registration page
     */
    public function create(Request $request): View
    {
        $referralCode = $request->query('ref');

        if ($referralCode) {
            session(['referral_code' => $referralCode]);
        }

        $institution = null;

        if ($referralCode) {
            $institution = Institution::where('referral_code', $referralCode)->first();
        }

        return view('auth.register', [
            'referralCode' => $referralCode ?? session('referral_code'),
            'institution' => $institution,
        ]);
    }

    /**
     * Handle registration
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
        | Profile Photo
        |--------------------------------------------------------------------------
        */
        $profilePhotoUrl = null;

        if ($request->hasFile('profile_photo')) {
            $profilePhotoUrl = $request->file('profile_photo')
                ->store('profile-photos', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Referrer
        |--------------------------------------------------------------------------
        */
        $referrer = null;

        if ($request->filled('referral_code')) {
            $referrer = User::where('referral_code', $request->referral_code)->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Institution Resolution (FIXED + SAFE)
        |--------------------------------------------------------------------------
        */
        $institutionId = session('selected_institution_id');

        $institution = $institutionId
            ? Institution::find($institutionId)
            : null;

        if (!$institution) {
            return back()->withErrors([
                'institution' => 'Please select a valid institution before registering.'
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

            'referred_by' => $referrer?->id,

            // ✅ ALWAYS GUARANTEED
            'institution_id' => $institution->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Prevent self referral
        |--------------------------------------------------------------------------
        */
        if ($user->referred_by === $user->id) {
            $user->update(['referred_by' => null]);
        }

        event(new Registered($user));

        Auth::login($user);

        session()->forget('selected_institution_id');

        return redirect(route('classroom', absolute: false));
    }
}