<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get authenticated user
        $user = Auth::user();

        // Define allowed roles (can be moved to config/auth.php)
        $allowedRoles = [1, 2]; // Example: 1 = Admin, 2 = Manager

        if ($user && in_array($user->role_id, $allowedRoles)) {
            return $next($request);
        }
        // Logout user and redirect to login with error message
        Auth::logout();
        return redirect()->route('login')->with('error', 'Access denied. You do not have the necessary permissions.');
    }
}
