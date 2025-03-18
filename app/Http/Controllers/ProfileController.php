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
        $countries = Country::get();
        $states = State::get();
        $cities = City::get();
        return view('profile.edit', [
            'user' => $request->user(),
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities
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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

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
             'phone' => $request->phone,
             'phone_2' => $request->phone_2,
             'country_id' => $request->country_id,
             'state_id' => $request->state_id,
             'city_id' => $request->city_id,
             'pincode' => $request->pincode,
             'address' => $request->address,
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

        if ($request->has('delete_image')) {
            if (!empty($user->profile_pic) && file_exists(public_path($request->user()->profile_pic))) {
                unlink(public_path($request->user()->profile_pic));
            }
            $request->user()->profile_pic = null;
            $request->user()->save();
            return redirect()->back()->with('success', 'Profile image deleted successfully!');
        }

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Unique filename
            $file->move(public_path('uploads/profile_pics'), $filename); // Public folder me move karein

            // Directly user ka profile_pic update karein
            $request->user()->profile_pic = 'uploads/profile_pics/' . $filename;
            $request->user()->save(); // Save user record
            return back()->with('success', 'Profile picture updated successfully!');
        }
    }
}
