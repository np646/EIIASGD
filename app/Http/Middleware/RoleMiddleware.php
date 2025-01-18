<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // If user is not authenticated, redirect to login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Skip role check if no roles are specified
        if (empty($roles)) {
            return $next($request);
        }

        // Check if user has any of the required roles
        $hasRole = collect($roles)->contains(function ($role) use ($request) {
            return $request->user()->hasRole($role);
        });

        if (!$hasRole) {
            // // For Inertia requests
            // if ($request->header('X-Inertia')) {
            //     return response()->json([
            //         'message' => 'You do not have permission to access this page.'
            //     ], 403);
            // }
            abort(403, 'Acceso no autorizado');
        }

        return $next($request);
    }
}
