<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
        ]);

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Update password + disable force password change
        |--------------------------------------------------------------------------
        */

        $user->password = Hash::make($validated['password']);
        $user->must_change_password = 0;
        $user->save();

        /*
        |--------------------------------------------------------------------------
        | SMART REDIRECT (SESSION-FIRST, ROLE FALLBACK)
        |--------------------------------------------------------------------------
        */

        $redirect = session()->pull('post_password_redirect');

        if ($redirect) {
            return redirect($redirect)
                ->with('status', 'Password updated successfully.');
        }

        /*
        |--------------------------------------------------------------------------
        | ROLE FALLBACK (SAFETY NET)
        |--------------------------------------------------------------------------
        */

        return match ($user->role) {

            'institution_admin' => redirect()
                ->route('institution.dashboard')
                ->with('status', 'Password updated successfully.'),

            'sales_executive' => redirect()
                ->route('sales.dashboard')
                ->with('status', 'Password updated successfully.'),

            'student' => redirect()
                ->route('classroom')
                ->with('status', 'Password updated successfully.'),

            default => redirect()
                ->route('dashboard')
                ->with('status', 'Password updated successfully.'),
        };
    }
}