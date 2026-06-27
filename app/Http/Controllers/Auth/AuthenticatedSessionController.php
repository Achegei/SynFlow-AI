<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login page
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
 * Handle login request
 */
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();
    $request->session()->regenerateToken();

    $user = Auth::user();
    $user->update([

        'last_login_at' => now(),

        'last_activity_at' => now(),

    ]);

    /*
    |--------------------------------------------------------------------------
    | FORCE PASSWORD CHANGE
    |--------------------------------------------------------------------------
    */

    if ($user->must_change_password == 1) {

    session([
        'post_password_redirect' => match ($user->role) {
            'institution_admin' => route('institution.dashboard'),
            'sales_executive' => route('sales.dashboard'),
            default => route('dashboard'),
        }
    ]);

    return redirect()->route('profile.edit')
            ->with('warning', 'You must change your password before continuing.');
    }

    /*
    |--------------------------------------------------------------------------
    | NORMAL ROLE REDIRECTS
    |--------------------------------------------------------------------------
    */

    return match ($user->role) {

        'admin' => redirect('/admin'),

        'sales_executive' => redirect('/sales/dashboard'),

        'institution_admin' => redirect('/institution/dashboard'),

        'student' => redirect('/classroom'),

        default => tap(Auth::logout(), function () {
            abort(403, 'Invalid role');
        }),
    };
}
    /**
     * Logout user
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}