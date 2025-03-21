<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{User, Menu, Container, Warehouse, Country};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $customers = User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->where('is_deleted', 'No')->where('role_id', 3)->latest()->paginate(5);


        return view('admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $warehouses = Warehouse::where('status', 'Active')->get();
        $countries = Country::all();
        return view('admin.customer.create', compact('roles', 'warehouses', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'contact_no1' => 'required|digits:10',
            'email' => 'required|string|max:255|unique:users,email',
            'alternate_mobile_no' => 'nullable|digits:10',
            'address_1' => 'required|string|max:255',
            'country' => 'required|string|exists:countries,id',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'required|string|max:10',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string',
            'latitude' => 'required|numeric', // Optional
            'longitude' => 'required|numeric' // Optional
        ]);

        $imagePaths = [];

        foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture'] as $imageType) {
           
            if ($request->hasFile($imageType)) {
                $file = $request->file($imageType);
                $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();
                
                // 🔹 Agar profile_pics hai to alag folder me store kare
                if ($imageType === 'profile_pics') {
                    $filePath = $file->storeAs('uploads/profile_pics', $fileName, 'public');
                    $imagePaths[$imageType] = 'storage/uploads/profile_pics/' . $fileName; // Store path in DB
                } else {
                    // 🔹 Baaki images customer folder me store ho
                    $filePath = $file->storeAs('uploads/customer', $fileName, 'public');
                    $imagePaths[$imageType] = 'uploads/customer/' . $fileName; // Store path in DB
                }
            }
        }
      

        // 🛠 Mapping Request Fields to Database Fields
        $userData = [
            'name'          => $validated['first_name'],
            'email'          => $validated['email'],
            'phone'   => $validated['contact_no1'],
            'phone_2'      => $validated['alternate_mobile_no'] ?? null, // Optional Field
            'address'        => $validated['address_1'],
            'address_2'        => $request->Address_2,
            'country_id'     => $validated['country'],
            'state_id'       => $validated['state'],
            'city_id'        => $validated['city'],
            'pincode'            => $validated['Zip_code'],
            'password'       => Hash::make($validated['password']),
            'status'      => ($request->status === 'on') ? 'Inactive' : 'Active',
            'company_name'        => $request->company_name,
            'apartment'        => $request->apartment,
            'username'      => $validated['username'],
            'latitude'       => $validated['latitude'] ?? null, // Optional Field
            'longitude'      => $validated['longitude'] ?? null, // Optional Field
            'website_url'        => $request->website_url,
            'write_comment'        => $request->write_comment,
            'read_comment'        => $request->read_comment,
            'language'        => $request->language,
            'year_to_date'        => $request->year_to_date,
            'license_number'        => $request->license_number,
            'warehouse_id'        => $request->warehouse_id,
            'signature_img' => $imagePaths['signature'] ?? null,
            'contract_signature_img' => $imagePaths['contract_signature'] ?? null,
            'license_document' => $imagePaths['license_picture'] ?? null,
            'profile_pic' => $imagePaths['profile_pics'] ?? null,
            'signup_type' => 'for_admin'
        ];
        if (!empty($request->license_expiry_date)) {
            $userData['license_expiry_date'] = Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d');
        }

        if (!empty($request->signature_date)) {
            $userData['signature_date'] = Carbon::createFromFormat('m/d/Y', $request->signature_date)->format('Y-m-d');
        }

        // 📌 Create User
        $user = User::create($userData);

        return redirect()->route('admin.customer.index')
            ->with('success', 'User created successfully');
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     // Validation Errors dikhane ke liye
        //     return response()->json(['errors' => $e->errors()], 422);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.customer.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $warehouses = Warehouse::where('status', 'Active')->get();
        $countries = Country::all();
        $page_no = $request->page;
        return view('admin.customer.edit', compact('user', 'roles', 'userRole','warehouses', 'countries','page_no'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 🔹 Validation
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'contact_no1' => 'required|digits:10',
            'email' => 'required|string|max:255|unique:users,email,' . $id,
            'alternate_mobile_no' => 'nullable|digits:10',
            'address_1' => 'required|string|max:255',
            'country' => 'required|string|exists:countries,id',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'required|string|max:10',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'password_confirmation' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);
    
        $user = User::findOrFail($id);
        $imagePaths = [];
    
        // 🔹 File Upload Handling
        foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture'] as $imageType) {
            if ($request->hasFile($imageType)) {
                $file = $request->file($imageType);
                $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();
                
                if ($imageType === 'profile_pics') {
                    $filePath = $file->storeAs('uploads/profile_pics', $fileName, 'public');
                    $imagePaths[$imageType] = 'storage/uploads/profile_pics/' . $fileName;
                } else {
                    $filePath = $file->storeAs('uploads/customer', $fileName, 'public');
                    $imagePaths[$imageType] = 'uploads/customer/' . $fileName;
                }
            }
        }
    
        // 🔹 Updating User Data
        $userData = [
            'name'        => $validated['first_name'],
            'email'       => $validated['email'],
            'phone'       => $validated['contact_no1'],
            'phone_2'     => $validated['alternate_mobile_no'] ?? null,
            'address'     => $validated['address_1'],
            'address_2'   => $request->Address_2,
            'country_id'  => $validated['country'],
            'state_id'    => $validated['state'],
            'city_id'     => $validated['city'],
            'pincode'     => $validated['Zip_code'],
            'status'      => ($request->status === 'on') ? 'Inactive' : 'Active',
            'company_name' => $request->company_name,
            'apartment'   => $request->apartment,
            'username'    => $validated['username'],
            'latitude'    => $validated['latitude'] ?? null,
            'longitude'   => $validated['longitude'] ?? null,
            'website_url' => $request->website_url,
            'write_comment' => $request->write_comment,
            'read_comment' => $request->read_comment,
            'language'    => $request->language,
            'year_to_date' => $request->year_to_date,
            'license_number' => $request->license_number,
            'warehouse_id'   => $request->warehouse_id,
            'signup_type'    => 'for_admin'
        ];
    
        // 🔹 File Path Update
        $userData['signature_img'] = $imagePaths['signature'] ?? $user->signature_img;
        $userData['contract_signature_img'] = $imagePaths['contract_signature'] ?? $user->contract_signature_img;
        $userData['license_document'] = $imagePaths['license_picture'] ?? $user->license_document;
        $userData['profile_pic'] = $imagePaths['profile_pics'] ?? $user->profile_pic;
    
        // 🔹 Date Format Conversion
        if (!empty($request->edit_license_expiry_date)) {
            $userData['edit_license_expiry_date'] = Carbon::createFromFormat('m/d/Y', $request->edit_license_expiry_date)->format('Y-m-d');
        }
    
        if (!empty($request->edit_signature_date)) {
            $userData['edit_signature_date'] = Carbon::createFromFormat('m/d/Y', $request->edit_signature_date)->format('Y-m-d');
        }
    
        // 🔹 Password Handling (Agar diya gaya hai tabhi update karo)
        // if (!empty($validated['password'])) {
        //     $userData['password'] = Hash::make($validated['password']);
        // }
    
        // 🛠 Update User Data
        $user->update($userData);
    
        return redirect()->route('admin.customer.index', ['page' => $request->page_no])
        ->with('success', 'User updated successfully');
    
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update(['is_deleted' => "Yes"]); // is_deleted ko 1 set kar rahe hain
            return redirect()->route('admin.customer.index')
                ->with('success', 'User marked as deleted successfully');
        }

        return redirect()->route('admin.customer.index')
            ->with('error', 'User not found');
    }

    public function deleteCustomer(Request $request)
    {
        $user = User::find($request->id);
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }
    
        $user->update(['is_deleted' => "Yes"]); // is_deleted ko "Yes" update kar rahe hain
    
        return response()->json([
            'success' => true,
            'message' => 'User marked as deleted successfully',
            'user' => $user
        ], 200);
    }
}
