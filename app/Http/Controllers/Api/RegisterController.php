<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Role, VerifyAuthIp};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /**
     * Register API
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8', // Minimum of 8 characters
                // 'regex:/[a-z]/', // Must contain at least one lowercase letter
                // 'regex:/[A-Z]/', // Must contain at least one uppercase letter
                // 'regex:/[0-9]/', // Must contain at least one digit
            ],
            'c_password' => 'required|same:password',
            'user_type'=>'required|in:customer,driver',
            'phone' => 'required|string|max:15|unique:users,phone',
        ]);

        // Assign default role (customer)
        $userRole = Role::where('name',$request->user_type)->first(); // Assume role ID 3 is for customers
        if (!$userRole) {
            return $this->sendError('Role not found.', ['error' => 'Role with ID 3 does not exist.']);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $userRole->name,
            'role_id' => $userRole->id,
        ]);

        // Generate token
        $success['token'] = $user->createToken('MyApp')->accessToken;

        VerifyAuthIP::updateOrCreate(
            [
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
            ],
            [
                'otp' => 1234,
                'otp_expire_at' => Carbon::now()->addMinutes(2), // OTP expires in 2 minutes
                'otp_varify_at' => null,
            ]
        );

        return $this->sendResponse($success, 'User registered successfully.');
    }

    /**
     * Login API
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        // Validate login credentials
        $request->validate([
            'loginWith' => 'required|in:email,phone',
            'email' => 'required_if:loginWith,email|email',
            'phone' => 'required_if:loginWith,phone|numeric|min:10',
            'password' => 'required',
        ]);

        $auth = ['password' => $request->password];
        if ($request->loginWith == 'email') {
            $auth['email'] = $request->email;
        }
        if ($request->loginWith == 'phone') {
            $auth['phone'] = $request->phone;
        }

        // Attempt authentication
        if (Auth::attempt($auth)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            // $success['userData'] = $user->load('userRole');
            
            VerifyAuthIP::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                ],
                [
                    'otp' => 1234,
                    'otp_expire_at' => Carbon::now()->addMinutes(2), // OTP expires in 2 minutes
                    'otp_varify_at' => null,
                ]
            );

            return $this->sendResponse($success, 'Otp send successfully.');
        }

        return $this->sendError('Unauthorized.', ['error' => 'Invalid login attempt. Please check your credentials and try again.']);
    }

    public function resendOtp(Request $request): JsonResponse
    {
   
        if (auth()->check()) {
            $user = auth()->user();
    
            VerifyAuthIP::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                ],
                [
                    'otp' => 1234,
                    'otp_expire_at' => Carbon::now()->addMinutes(2), // OTP expires in 2 minutes
                    'otp_varify_at' => null,
                ]
            );
    
            return $this->sendResponse(false, 'Otp resend successfully.');
        }
    
        return $this->sendError('Unauthorized.', ['error' => 'Invalid login attempt.']);
    }

    public function verifyOtp(Request $request): JsonResponse
    {
        // Validate request
        $request->validate([
            'otp' => 'required|numeric',
        ]);
    
        if (auth()->check()) {
            $user = auth()->user();
    
            // Retrieve the IP verification record
            $data = VerifyAuthIP::where([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'otp' => $request->otp, // OTP should be dynamic
            ])->first();
    
            // Check if OTP exists and is still valid (within 2 minutes)
            if ($data && Carbon::now()->lte(Carbon::parse($data->otp_expire_at))) {
                // Generate access token
                
                $success['userData'] = $user->load('userRole');

                $data->otp = null;
                $data->otp_expire_at = null;
                $data->otp_varify_at = Carbon::now();

                $data->save();
                
    
                return $this->sendResponse($success, 'OTP verified successfully.');
            }
    
            return $this->sendError('Unauthorized.', ['error' => 'OTP expired or invalid. Please try again.']);
        }
    
        return $this->sendError('Unauthorized.', ['error' => 'Invalid login attempt.']);
    }

    

    /**
     * Logout API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // Revoke user's token
        if (Auth::check()) {
            $user = Auth::user();

            VerifyAuthIP::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                ],
                [
                    'otp' => null,
                    'otp_expire_at' => null,
                    'otp_varify_at' => null,
                ]
            );

            $user->token()->revoke();

            return $this->sendResponse([], 'User logged out successfully.');
        }

        return $this->sendError('Unauthorized.', ['error' => 'User is not logged in.'],422);
    }
}
