<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the logged-in user is admin
        if (!auth()->check() || auth()->user()->is_admin != 1) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}