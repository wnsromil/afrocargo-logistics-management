<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceJsonAcceptHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        // Check if the request is for an API and doesn't have the Accept header set to application/json
        if ($request->is('api/*') && !$request->expectsJson()) {
            return response()->json(['error' => 'Accept header must be application/json'], 406);
        }

        return $next($request);
    }
}


