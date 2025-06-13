<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    //

    public function profile()
    {
        $user = $this->user->load(['warehouse', 'vehicle', 'country', 'state', 'city']);
    
        // Get only active vehicles for the user's warehouse
        $activeVehicles = Vehicle::where('warehouse_id', $user->warehouse_id)
            ->where('status', 'Active')
            ->get();
    
        // Convert user to array and embed active vehicles inside
        $userData = $user->toArray();
        $userData['active_vehicles'] = $activeVehicles;
    
        return $this->sendResponse($userData, 'User profile data.');
    }
    
    
    public function update(Request $request)
    {
        $user = $this->user;
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $user->id, // Ignore current user ID
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:15|unique:users,phone,' . $user->id,
            'license_number' => 'nullable|string',
            'license_document' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'license_expiry_date' => 'nullable|date_format:Y-m-d',
            'status' => 'nullable|in:Active,Inactive',
            'country_id' => 'nullable',
            'state_id' => 'nullable',
            'city_id' => 'nullable',
            'pincode' => 'nullable',
        ]);

        // Update user with validated data
        if (!empty($request->name)) {
            $user->name = $request->name;
        }
        if (!empty($request->address)) {
            $user->address = $request->address;
        }
        if (!empty($request->country_id)) {
            $user->country_id = $request->country_id;
        }
        if (!empty($request->state_id)) {
            $user->state_id = $request->state_id;
        }
        if (!empty($request->city_id)) {
            $user->city_id = $request->city_id;
        }
        if (!empty($request->pincode)) {
            $user->pincode = $request->pincode;
        }
        if (!empty($request->phone)) {
            $user->phone = $request->phone;
        }
        if (!empty($request->email)) {
            $user->email = $request->email;
        }
        if (!empty($request->license_number)) {
            $user->license_number = $request->license_number;
        }
        if (!empty($request->license_expiry_date)) {
            $user->license_expiry_date = $request->license_expiry_date;
        }

        if ($request->hasFile('license_document')) {
            $file = $request->file('license_document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/licenses', $filename, 'public'); // Store in 'storage/app/public/uploads/licenses'
            $licenseDocumentPath = asset('storage/' . $filePath); // Get full URL
            $user->license_document = $licenseDocumentPath;
        }
        if (!empty($request->status)) {
            $user->status = $request->status;
        }

        $user->save();

        return $this->sendResponse($user, 'User updated successfully.');
    }
    public function changePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password.required' => 'The old password is required.',
            'current_password.current_password' => 'The old password is incorrect.',
            'password.required' => 'A new password is required.',
            'password.confirmed' => 'The new password and confirmation do not match.',
            'password.min' => 'The password must be at least 8 characters.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return $this->sendResponse(false, 'Password changed successfully.');
    }

    public function updateProfilePicture(Request $request)
    {
        $user = $this->user; // Currently authenticated user

        $request->validate([
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Only image files allowed
        ]);

        // Delete old profile picture if exists
        // if ($user->profile_pic) {
        //     $oldProfilePath = public_path($user->profile_pic); // Get full path
        //     if (file_exists($oldProfilePath)) {
        //         unlink($oldProfilePath); // Delete old file
        //     }
        // }

        // Upload new profile picture
        $file = $request->file('profile_pic');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/profile_pics', $filename, 'public');

        // Store new profile picture path
        $user->profile_pic = $filePath;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile picture updated successfully.',
            'profile_pic_url' => asset($user->profile_pic),
        ]);
    }
    public function deletUsers(Request $request)
    {
        User::whereIn(['id'=>$request->ids,'role'=>['customer','driver']])->delete();
        return response()->json([
            'success' => true,
            'message' => 'Users deleted successfully.'
        ]);
    }
}
