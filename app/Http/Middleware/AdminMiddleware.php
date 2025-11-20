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
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            // Redirect to login with a message
            return redirect()->route('login')->with('error', 'Please login to access admin panel.');
        }

        $user = Auth::user();
        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'User not found.'], 404);
            }
            abort(404, 'User not found.');
        }

        if ($user->usertype !== 'admin') {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized access.',
                    'your_usertype' => $user->usertype,
                    'required' => 'admin'
                ], 403);
            }
            // Show helpful error message - use 403 not 404
            abort(403, "Unauthorized. Your account type is '{$user->usertype}'. Admin access required. Contact administrator to upgrade your account.");
        }

        return $next($request);
    }
}
