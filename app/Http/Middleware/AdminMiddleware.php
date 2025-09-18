<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated AND is admin
        if (Auth::check() && Auth::user()->user_type === 'admin') {
            return $next($request);
        }

        // Redirect non-admin users to home page (or 403 page)
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}
