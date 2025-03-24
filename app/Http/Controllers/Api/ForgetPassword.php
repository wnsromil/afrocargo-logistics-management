<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Role, VerifyAuthIp};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class ForgetPassword extends Controller
{
    //
    public function forgetPassword(Request $request)
    {
        // Validate login credentials
        $request->validate([
            'loginWith' => 'required|in:email,phone',
            'email' => 'required_if:loginWith,email|email',
            'phone' => 'required_if:loginWith,phone|numeric|digits:10',
            'role'=>'required|in:driver,customer,warehouse_manager,admin'
        ]);

        $credentials = [];
        if ($request->loginWith == 'email') {
            $credentials['email'] = $request->email;
        } elseif ($request->loginWith == 'phone') {
            $credentials['phone'] = $request->phone;
        }
        $credentials['role'] = $request->role;
        $userData = User::where($credentials)->first();

        if (!$userData) {
            return $this->sendError('Unauthorized.', ['error' => 'User not found.']);
        }

        // Log in the user
        Auth::login($userData);

        // Generate access token
        $token = $userData->createToken('MyApp')->accessToken;
        $success['token'] = $token;

        // Update or create OTP record
        VerifyAuthIP::updateOrCreate(
            [
                'user_id' => $userData->id,
                'ip_address' => $request->ip(),
            ],
            [
                'otp' => 1234,
                'otp_expire_at' => Carbon::now()->addMinutes(2), // OTP expires in 2 minutes
                'otp_varify_at' => null,
                'verify_type' => 'forget'
            ]
        );

        return $this->sendResponse($success, 'Otp resend successfully.');
    }
    public function resetPassword(Request $request)
    {
        $checkVerify = VerifyAuthIP::where([
            'user_id' => $this->user->id,
            'ip_address' => $request->ip(),
            'verify_type'=>'forget'
        ])->whereNotNull('otp_varify_at')->whereNull('otp_expire_at')
        ->first();

        if(empty($checkVerify)){
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validateWithBag('updatePassword', [
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        VerifyAuthIP::updateOrCreate(
            [
                'user_id' => $this->user->id,
                'ip_address' => $request->ip(),
            ],
            [
                'otp' => null,
                'otp_expire_at' => null,
                'otp_varify_at' => null,
                'verify_type'=>null
            ]
        );

        $user = Auth::user();
        $user->token()->revoke();

        return $this->sendResponse(false, 'Password changed successfully.');
    }
}
