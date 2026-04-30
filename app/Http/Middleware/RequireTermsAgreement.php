<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireTermsAgreement
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && !$user->agreed_terms_at && $user->type !== 'admin') {
            return redirect()->route('terms.agree');
        }

        return $next($request);
    }
}
