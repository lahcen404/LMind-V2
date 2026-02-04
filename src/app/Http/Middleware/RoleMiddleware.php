<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{


    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page! pleaaase login!');
        }

        if (Auth::user()->role->name !== $role) {
            return redirect()->route('login')->with('error', 'You do not have permission to access this page!!!');
        }

        return $next($request);
    }
}
