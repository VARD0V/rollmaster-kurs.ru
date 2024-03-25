<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiUserHasRole
{
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (Auth::check() && Auth::user()->hasRole($roles)) {
            return $next($request);
        }

        return response()->json(['error' => 'У вас нет прав'], 403);
    }
}
