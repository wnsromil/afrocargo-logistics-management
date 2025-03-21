<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate input fields
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password_confirmation' => ['required', 'password_confirmation'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password.required' => 'Current password is required.',
            'current_password.current_password' => 'The current password is incorrect.',
            'password.required' => 'New password is required.',
            'password_confirmation.required' => 'Confirmation password is required.',
            'password.confirmed' => 'New password and confirm password do not match.',
        ]);
    

        // Update user password
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Return back with success message
        return back()->with('success', 'Password updated successfully!');
    }
}
