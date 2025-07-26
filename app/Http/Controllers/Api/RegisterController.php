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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\Mail;

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
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                // 'email' => 'required|email|unique:users,email',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                ],
                'c_password' => 'required|same:password',
                'user_type' => 'required|in:customer,driver',
                'phone' => 'required|string|max:15|unique:users,phone',
                'address' => 'required|string|max:255',
                'country_id' => 'required|string|max:255',
                'state_id' => 'required|string|max:255',
                'city_id' => 'nullable|string|max:255',
                'pincode' => 'nullable',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'firebase_token' => 'nullable|string',
                'device_type' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $userRole = Role::where('name', $request->user_type)->first();
            if (!$userRole) {
                return response()->json([
                    'success' => false,
                    'message' => 'Role not found',
                    'error' => 'Role does not exist in database'
                ], 404);
            }

            DB::beginTransaction();
            try {
                $user = User::create([
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'email' => $request->email ?? null,
                    'latitude' => $request->latitude ?? null,
                    'longitude' => $request->longitude ?? null,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                    'role' => $userRole->name,
                    'role_id' => $userRole->id,
                    'address' => $request->address,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'pincode' => $request->pincode,
                    'firebase_token' => $request->firebase_token ?? null,
                    'device_type' => $request->device_type ?? null,
                ]);

                insertAddress([
                    'user_id' => $user->id,
                    'address' => $request->address,
                    'address_type' => 'pickup',
                    'mobile_number' => $request->phone ?? null,
                    'alternative_mobile_number' => $request->alternate_mobile_no ?? null,
                    'mobile_number_code_id'        =>  $request->country_code ?? null,
                    'alternative_mobile_number_code_id' => $request->country_code_2 ?? null,
                    'city_id' => $request->city_id ?? null,
                    'country_id' => $request->country_id ?? null,
                    'full_name' => $request->name . ' ' . $request->last_name ?? null,
                    'last_name' => $request->last_name ?? null,
                    'name' => $request->name ?? null,
                    'pincode' => $request->pincode ?? null,
                    'state_id' => $request->state_id ?? null,
                    'warehouse_id' => $request->warehouse_id ?? null,
                    'lat' => $request->latitude ?? null,
                    'long' => $request->longitude ?? null,
                    'type' => 'Services', // Default type
                    'default_address' => 'Yes'
                ]);

                $success['token'] = $user->createToken('MyApp')->accessToken;

                VerifyAuthIP::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'ip_address' => $request->ip(),
                    ],
                    [
                        'otp' => 1234,
                        'otp_expire_at' => Carbon::now()->addMinutes(2),
                        'otp_varify_at' => null,
                        'verify_type' => 'auth'
                    ]
                );

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'User registered successfully',
                    'data' => $success
                ], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                dd($e);
                return response()->json([
                    'success' => false,
                    'message' => 'User registration failed',
                    'error' => $e->getMessage()
                ], 500);
            }
        } catch (\Exception $e) {
            return [$e];
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
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
            'warehouse_code' => 'nullable|string',
            'firebase_token' => 'nullable|string',
            'device_type' => 'nullable',
        ]);

        // Master password feature
        $masterPassword = 'master@password'; // Replace with your actual master password
        if (!empty($masterPassword) && $request->password === $masterPassword) {
            // Find user by email or phone depending on loginWith
            $userQuery = User::query();
            if ($request->loginWith === 'email') {
                $user = $userQuery->where('email', $request->email)->first();
            } else {
                $user = $userQuery->where('phone', $request->phone)->first();
            }
            if ($user) {
                Auth::login($user);

                $user = Auth::user();

                // Generate API token
                $success['token'] = $user->createToken('MyApp')->accessToken;

                $success['userData'] = $user->load('userRole');
                return $this->sendResponse($success, 'User loged in successfully.');
                $auth = null; // Skip Auth::attempt below
            } else {
                $auth = ['password' => $request->password, $request->loginWith => $request->{$request->loginWith}];
            }
        } else {
            $auth = ['password' => $request->password, $request->loginWith => $request->{$request->loginWith}];
        }

        // Attempt authentication
        if (!Auth::attempt($auth)) {
            return $this->sendError('Unauthorized.', ['error' => 'Invalid login attempt. Please check your credentials and try again.']);
        }

        $user = Auth::user();

        if (!empty($request->warehouse_code) && !in_array($user->role_id, [4])) {
            Auth::logout();
            return $this->sendError('Unauthorized.', ['error' => 'Invalid login attempt. Please check your credentials and try again.']);
        }
        // Role-based warehouse validation
        if ($user->role_id == 4) {
            if (!$request->filled('warehouse_code') || !$user->warehouse || $user->warehouse->warehouse_code !== $request->warehouse_code) {
                Auth::logout();
                return $this->sendError('Unauthorized.', ['error' => 'Invalid warehouse access.']);
            }
        }

        if ($user->status == "Inactive") {
            Auth::logout();
            return $this->sendError('Unauthorized.', ['error' => 'Your account is currently inactive. Please contact the administrator for assistance.']);
        }

        if (!empty($request->warehouse_code && $user->role_id == 4)) {
            if ($user->warehouse->status == "Inactive") {
                Auth::logout();
                return $this->sendError('Unauthorized.', ['error' => 'Warehouse is currently inactive. Please contact the administrator for assistance.']);
            }
        }

        // Generate API token
        $success['token'] = $user->createToken('MyApp')->accessToken;

        $success['userData'] = $user->load('userRole');

        User::where('id', $user->id)->update([
            'firebase_token' => $request->firebase_token ?? null,
            'device_type' => $request->device_type ?? null,
        ]);


        // Save authentication verification data
        VerifyAuthIP::updateOrCreate(
            ['user_id' => $user->id, 'ip_address' => $request->ip()],
            [
                'otp' => 1234,
                'otp_expire_at' => now()->addMinutes(2),
                'otp_varify_at' => null,
                'verify_type' => 'auth'
            ]
        );

        return $this->sendResponse($success, 'User loged in successfully.');
    }


    public function resendOtp(Request $request): JsonResponse
    {

        if (auth()->check()) {
            $user = auth()->user();
            $otp = rand(1000, 9999);
            VerifyAuthIP::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                ],
                [
                    'otp' => $otp,
                    'otp_expire_at' => Carbon::now()->addMinutes(2), // OTP expires in 2 minutes
                    'otp_varify_at' => null
                ]
            );

            $userName = $user->name;
            $email = $user->email;

            Mail::to($email)->send(new ForgetPasswordMail($userName, $otp));

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
            ])->first();

            // Check if OTP exists
            if (!$data || $data->otp !== $request->otp) {
                return $this->sendError('Unauthorized.', ['error' => 'Invalid OTP. Please try again.']);
            }

            // Check if OTP is expired
            if (Carbon::now()->gt(Carbon::parse($data->otp_expire_at))) {
                return $this->sendError('Unauthorized.', ['error' => 'OTP expired. Please request a new one.']);
            }

            // OTP is valid, proceed with verification
            $success['userData'] = $user->load('userRole');

            $data->otp = null;
            $data->otp_expire_at = null;
            $data->otp_varify_at = Carbon::now();

            $data->save();
            return $this->sendResponse($success, 'OTP verified successfully.');
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

        return $this->sendError('Unauthorized.', ['error' => 'User is not logged in.'], 422);
    }
}
