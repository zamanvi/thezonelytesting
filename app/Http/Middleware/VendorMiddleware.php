<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $user = Auth::user();

        if ($user->type === 'vendor') {
            if (!$user->status) {
                return redirect()->route('vendor.blockedlist');
            }
            if (empty($user->phone) || empty($user->address) || empty($user->shop_name)) {
                if (!$request->routeIs('vendor.profile.first')) {
                    return redirect()->route('vendor.profile.first')->with('warning', 'Please complete your profile before proceeding.');
                }
            }
            return $next($request);
        }
        if ($user->type === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($user->type === 'profile') {
            return redirect()->route('dashboard');
        }
        if ($user->type === 'customer') {
            return redirect()->route('dashboard');
        }
        return redirect()->route('user.login');
    }
}
