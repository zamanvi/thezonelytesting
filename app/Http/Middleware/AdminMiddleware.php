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

        if ($user->type === 'admin') {
            return $next($request);
        }

        // COO — full panel access, restrictions handled per-controller
        if ($user->type === 'coo') {
            return $next($request);
        }

        // Managers pass through here; ManagerModule middleware handles per-route checks
        if ($user->type === 'manager' && $user->managerProfile?->status === 'active') {
            return $next($request);
        }

        return redirect()->route('dashboard');
    }
}
