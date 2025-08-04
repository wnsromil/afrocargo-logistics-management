<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\VerifyAuthIp;
use Illuminate\Support\Facades\Auth;

class ApiAuthUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!in_array($user->role_id, [4, 3])) {
            Auth::logout();
            return response()->json(['error' => 'You have been logged out. Please log in again.'], 401);
        }

        // $check = VerifyAuthIp::where([
        //     'user_id' => auth()->id(),
        //     'ip_address' => $request->ip(),
        //     'verify_type'=>'auth'
        // ])
        // ->whereNotNull('otp_varify_at')  // OTP was verified before
        // ->whereNull('otp')               // OTP should be null
        // ->whereNull('otp_expire_at');      // OTP expiry should be null
        // // ->first();


        // if (!$check->exists()) {

        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        return $next($request);
    }
}
