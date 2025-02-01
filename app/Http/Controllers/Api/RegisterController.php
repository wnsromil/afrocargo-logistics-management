<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Role};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

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
        $validator = Validator::make($request->all(), [
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
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Assign default role (customer)
        $userRole = Role::find(3); // Assume role ID 3 is for customers
        if (!$userRole) {
            return $this->sendError('Role not found.', ['error' => 'Role with ID 3 does not exist.']);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $userRole->name,
            'role_id' => $userRole->id,
        ]);

        // Generate token
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['userData'] = $user->load('userRole');

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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Attempt authentication
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['userData'] = $user->load('userRole');

            return $this->sendResponse($success, 'User logged in successfully.');
        }

        return $this->sendError('Unauthorized.', ['error' => 'Invalid email or password.']);
    }

    /**
     * Logout API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        // Revoke user's token
        if (Auth::check()) {
            $user = Auth::user();
            $user->token()->revoke();

            return $this->sendResponse([], 'User logged out successfully.');
        }

        return $this->sendError('Unauthorized.', ['error' => 'User is not logged in.']);
    }
}
