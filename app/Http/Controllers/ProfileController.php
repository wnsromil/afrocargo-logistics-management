<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(): View
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }

    public function change(Request $request): View
    {
        return view('profile.update-password', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'nullable|string|max:10',
            'mobile_number_code_id' => 'required|exists:countries,id',
            'mobile_number' => 'required|digits:10|unique:users,phone,' . auth()->id(),
            'alternative_mobile_number_code_id' => 'nullable|exists:countries,id',
            'alternative_mobile_number' => 'nullable|digits:10',
            'address_2' => 'nullable|string|max:255',
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        //  // Find the warehouse by ID
        $profile = User::find(auth()->id());

        // Update profile with validated data
        $profile->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone'      => $request->mobile_number ?? null,
            'phone_code_id'        => $request->mobile_number_code_id ?? null,
            'phone_2' => $request->alternative_mobile_number ?? null,
            'phone_2_code_id_id' => !empty($request->alternative_mobile_number)
                ? (int) ($request->alternative_mobile_number_code_id ?? null)
                : null,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'pincode' => $request->Zip_code,
            'address' => $request->address_1,
            'address_2' => $request->address_2,
        ]);
        return Redirect::route('profile.index')->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function uploadProfilePic(Request $request)
    {
        $request->validate([
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();
        if ($request->input('delete_image') == "1") {
            // Delete the existing image file if it exists
            if (!empty($user->profile_pic)) {
                $imagePath = public_path($user->profile_pic);
                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }

            $user->profile_pic = null;
            $user->save();

            return redirect()->back()->with('success', 'Profile picture deleted successfully!');
        }

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '_profile_pic.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/profile_pics', $filename, 'public');

            $user->profile_pic = $filePath;
            $user->save();

            return back()->with('success', 'Profile picture updated successfully!');
        }

        return back()->with('error', 'No image uploaded.');
    }
}
