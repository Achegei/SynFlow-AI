<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LearningAccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login page.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Authenticate user
        |--------------------------------------------------------------------------
        */

        $request->authenticate();

        $request->session()->regenerate();
        $request->session()->regenerateToken();

        /*
        |--------------------------------------------------------------------------
        | Get authenticated user
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | ONE-TIME INITIAL PASSWORD RESET
        |--------------------------------------------------------------------------
        |
        | Newly registered students are allowed to use the password they
        | created during registration.
        |
        | On their first subsequent login, the system sends a password
        | reset link and logs them out.
        |
        | After successfully resetting the password,
        | initial_password_reset_required becomes false.
        |
        */

        if (
            $user->role === 'student' &&
            (int) $user->initial_password_reset_required === 1
        ) {
            $status = Password::sendResetLink([
                'email' => $user->email,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Log the user out after sending reset link
            |--------------------------------------------------------------------------
            */

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            /*
            |--------------------------------------------------------------------------
            | Reset link sent successfully
            |--------------------------------------------------------------------------
            */

            if ($status === Password::RESET_LINK_SENT) {
                return redirect()
                    ->route('login')
                    ->with(
                        'status',
                        'For your security, we have sent a password reset link to your email address. Please use it to set your new password before logging in again.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Reset link failed
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => __($status),
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Update login information
        |--------------------------------------------------------------------------
        */

        $user->update([
            'last_login_at'    => now(),
            'last_activity_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | FORCE PASSWORD CHANGE
        |--------------------------------------------------------------------------
        |
        | This is the existing password-change mechanism.
        |
        | It remains available for accounts such as institution
        | administrators that were explicitly marked as requiring
        | a password change.
        |
        */

        if ((int) $user->must_change_password === 1) {

            session([
                'post_password_redirect' => match ($user->role) {

                    'institution_admin' =>
                        route('institution.dashboard'),

                    'sales_executive' =>
                        route('sales.dashboard'),

                    default =>
                        route('dashboard'),
                }
            ]);

            return redirect()
                ->route('profile.edit')
                ->with(
                    'warning',
                    'You must change your password before continuing.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            return redirect('/admin');
        }

        /*
        |--------------------------------------------------------------------------
        | SALES EXECUTIVE
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'sales_executive') {

            return redirect('/sales/dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | INSTITUTION ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'institution_admin') {

            return redirect('/institution/dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | STUDENT / LEARNER
        |--------------------------------------------------------------------------
        |
        | From this point we deal with normal learners.
        |
        | The system determines whether the learner is:
        |
        | 1. An active AI learner
        | 2. An institution learner
        | 3. An expired AI learner
        | 4. A learner with no active access
        |
        */

        if ($user->role === 'student') {

            /*
            |--------------------------------------------------------------------------
            | 1. CHECK ACTIVE AI LEARNING ACCESS
            |--------------------------------------------------------------------------
            |
            | AI access is controlled by LearningAccess.
            |
            | We do NOT check course_user here because AI subscriptions
            | are temporary and expire according to the selected package.
            |
            */

            $activeAiAccess = LearningAccess::where(
                    'user_id',
                    $user->id
                )
                ->where('status', 'active')
                ->where(function ($query) {

                    $query
                        ->whereNull('expires_at')
                        ->orWhere(
                            'expires_at',
                            '>',
                            now()
                        );
                })
                ->latest('expires_at')
                ->first();

            /*
            |--------------------------------------------------------------------------
            | ACTIVE AI LEARNER
            |--------------------------------------------------------------------------
            |
            | If the learner has an active package, take them directly
            | to the classroom.
            |
            */

            if ($activeAiAccess) {

                return redirect()
                    ->route(
                        'classroom.show',
                        $activeAiAccess->course_id
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | 2. CHECK INSTITUTION COURSE ACCESS
            |--------------------------------------------------------------------------
            |
            | Institution learners have permanent course access through
            | course_user.
            |
            */

            $institutionCourse = $user->courses()
                ->wherePivot(
                    'user_id',
                    $user->id
                )
                ->first();

            if ($institutionCourse) {

                return redirect()
                    ->route(
                        'classroom.show',
                        $institutionCourse->id
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | 3. NO ACTIVE ACCESS
            |--------------------------------------------------------------------------
            |
            | At this point the learner does not have:
            |
            | - an active AI package
            | - institution course access
            |
            | If they previously had AI access but it expired, they must
            | choose a new package.
            |
            */

            $hasPreviousAiAccess = LearningAccess::where(
                    'user_id',
                    $user->id
                )
                ->exists();

            if ($hasPreviousAiAccess) {

                return redirect()
                    ->route('ai.packages')
                    ->with(
                        'info',
                        'Your AI learning package has expired. Please choose a new package to continue learning.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | 4. BRAND NEW LEARNER WITH NO ACCESS
            |--------------------------------------------------------------------------
            |
            | This learner has no active AI access and no institution
            | enrollment.
            |
            | Send them to the classroom, where the appropriate paywall
            | can be displayed.
            |
            */

            return redirect()
                ->route('classroom.index');
        }

        /*
        |--------------------------------------------------------------------------
        | INVALID ROLE
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        abort(
            403,
            'Invalid role'
        );
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}