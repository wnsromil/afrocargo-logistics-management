<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    //

    public function profile(){
        $user = $this->user->load(['warehouse','vehicle','country','state','city']);
        return $this->sendResponse($user, 'User updated successfully.');
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
            'country_id'=>'nullable',
            'state_id'=>'nullable',
            'city_id'=>'nullable',
        ]);
    
        // Update user with validated data
        if(!empty($request->name)){
            $user->name =$request->name;
        }
        if(!empty($request->address)){
            $user->address =$request->address;
        }
        if(!empty($request->phone)){
            $user->phone =$request->phone;
        }
        if(!empty($request->email)){
            $user->email =$request->email;
        }
        if(!empty($request->license_number)){
            $user->license_number =$request->license_number;
        }
        if(!empty($request->license_expiry_date)){
            $user->license_expiry_date =$request->license_expiry_date;
        }

        if ($request->hasFile('license_document')) {
            $file = $request->file('license_document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/licenses', $filename, 'public'); // Store in 'storage/app/public/uploads/licenses'
            $licenseDocumentPath = asset('storage/' . $filePath); // Get full URL
            $user->license_document =$licenseDocumentPath;
        }
        if(!empty($request->status)){
            $user->status =$request->status;
        }
        
        $user->save();

        return $this->sendResponse($user, 'User updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return $this->sendResponse(false, 'Password changed successfully.');
    }
    
}
