<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Allow only admin to proceed
        if ($user->type === 'admin') {
            return $next($request);
        }

        // Redirect vendors
        if ($user->type === 'vendor') {
            return redirect()->route('vendor.dashboard');
        }

        // Redirect normal users
        if ($user->type === 'user') {
            return redirect()->route('dashboard');
        }

        // Default (in case type is missing)
        return redirect()->route('login');
    }
}
