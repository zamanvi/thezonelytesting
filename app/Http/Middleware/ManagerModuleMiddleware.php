<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ManagerModuleMiddleware
{
    public function handle(Request $request, Closure $next, string $module): Response
    {
        $user = Auth::user();

        // Admins always pass
        if ($user?->type === 'admin') {
            return $next($request);
        }

        // Managers: check module permission
        if ($user?->type === 'manager') {
            $profile = $user->managerProfile;
            if ($profile && $profile->status === 'active' && $profile->hasModule($module)) {
                return $next($request);
            }
        }

        abort(403, 'You do not have access to this section.');
    }
}
