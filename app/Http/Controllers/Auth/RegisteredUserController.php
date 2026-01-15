<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
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
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'profile_photo' => ['nullable', 'image', 'max:2048'],
        'referral_code' => ['nullable', 'string'],
    ]);

    // ✅ Handle profile photo
    $profilePhotoUrl = null;
    if ($request->hasFile('profile_photo')) {
        $profilePhotoUrl = $request->file('profile_photo')
            ->store('profile-photos', 'public');
    }

    // ✅ Resolve referrer (if any)
    $referrer = null;
    if ($request->filled('referral_code')) {
        $referrer = User::where('referral_code', $request->referral_code)->first();
    }

    // ✅ Create user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'profile_photo_url' => $profilePhotoUrl,
        'referral_code' => strtoupper(uniqid('ML-')), // auto-generated
        'referred_by' => $referrer?->id,
    ]);

    // 🚫 Block self-referral (extra safety)
    if ($user->referred_by === $user->id) {
        $user->update(['referred_by' => null]);
    }

    event(new Registered($user));
    Auth::login($user);

    return redirect(route('classroom', absolute: false));
}

}
