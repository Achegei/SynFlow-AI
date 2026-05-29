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
        | Redirect user by role
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'institution_admin') {

            return redirect()
                ->route('institution.dashboard')
                ->with('status', 'Password updated successfully.');
        }

        if ($user->role === 'sales_executive') {

            return redirect()
                ->route('sales.dashboard')
                ->with('status', 'Password updated successfully.');
        }

        if ($user->role === 'student') {

            return redirect()
                ->route('classroom')
                ->with('status', 'Password updated successfully.');
        }

        return redirect()
            ->route('dashboard')
            ->with('status', 'Password updated successfully.');
    }
}