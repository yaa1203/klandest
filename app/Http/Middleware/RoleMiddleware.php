<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized - User not authenticated');
        }
        
        // Debug: Check user role
        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized - User role is ' . Auth::user()->role . ' but required role is ' . $role);
        }
        
        return $next($request);
    }
}
