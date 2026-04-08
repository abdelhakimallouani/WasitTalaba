<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // dd(auth()->user()->role, $role);
        if (! auth()->check()) {
            abort(403);
        }

        if (auth()->user()->role !== $role) {
            // dd(auth()->user()->role);
            // dd(auth()->id());
            abort(403, 'mochkil d role');
        }

        

        // if (!auth()->check() || auth()->user()->role !== $role) {
        //     dd($request->user()->role, $role);
        //     abort(403, 'mochkil d role');
        // }
        return $next($request);
    }
}
