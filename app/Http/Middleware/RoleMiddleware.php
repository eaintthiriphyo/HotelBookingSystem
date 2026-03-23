<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // If user is not logged in, redirect to welcome page
        if (! $request->user()) {
            return redirect()->route('/');
        }

        // If user is logged in but role doesn't match
        if ($request->user()->role !== $role) {
            if ($request->user()->role === 'admin') {
                return redirect()->route('admin.viewDashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // If role matches, allow access
        return $next($request);
    }
}
