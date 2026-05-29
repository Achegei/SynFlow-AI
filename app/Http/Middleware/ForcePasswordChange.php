<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | Force password change
        |--------------------------------------------------------------------------
        */

        if ($user->must_change_password == 1) {

            $allowedRoutes = [

                // Profile page
                'profile.edit',
                'profile.update',

                // Password update route
                'password.update',

                // Logout
                'logout',
            ];

            if (!in_array(
                $request->route()?->getName(),
                $allowedRoutes
            )) {

                return redirect()
                    ->route('profile.edit')
                    ->with(
                        'warning',
                        'You must change your password before proceeding.'
                    );
            }
        }

        return $next($request);
    }
}