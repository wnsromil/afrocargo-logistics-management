<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{User, Menu, Container, Warehouse, Country, Vehicle};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Mail\RegistorMail;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);
        $type = $request->input('type');

        // Determine role_id based on type
        $roleId = 3; // default: customer
        if ($type === 'ShipTo') {
            $roleId = 5;
        }

        $customers = User::with(['warehouse.country', 'warehouse.state', 'warehouse.city'])
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->where('is_deleted', 'No')
            ->where('role_id', $roleId) // ✅ role_id based on type
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('unique_id', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%")
                        ->orWhere('phone', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%")
                        ->orWhere('status', 'LIKE', "%$search%");
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage, 'type' => $type]); // Include type in pagination

        $serialStart = ($currentPage - 1) * $perPage;

        if ($request->ajax() && $type == 'ShipTo') {
            return view('admin.customer.shipto.shiptoindextable', compact('customers', 'serialStart'))->render();
        }

        if ($request->ajax()) {
            return view('admin.customer.table', compact('customers', 'serialStart'))->render();
        }

        return view('admin.customer.index', compact('customers', 'search', 'perPage', 'serialStart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->where('status', 'Active')->get();
        $countries = Country::all();
        $containers = Vehicle::where('vehicle_type', 'Container')->select('id', 'container_no_1', 'container_no_2')->get();
        return view('admin.customer.create', compact('roles', 'warehouses', 'countries', 'containers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'mobile_number_code_id' => 'required',
            'mobile_number' => 'required|digits:10|unique:users,phone',
            'alternative_mobile_number_code_id' => 'required',
            'alternative_mobile_number' => 'nullable|max:10',
            'address_1' => 'required|string|max:255',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'nullable|string|max:10',
            'username' => 'required|string|max:255|unique:users,username',
            'latitude' => 'required|numeric', // Optional
            'longitude' => 'required|numeric', // Optional
        ]);


        try {

            $imagePaths = [];

            foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture'] as $imageType) {

                if ($request->hasFile($imageType)) {
                    $file = $request->file($imageType);
                    $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();

                    // 🔹 Agar profile_pics hai to alag folder me store kare
                    if ($imageType === 'profile_pics') {
                        $filePath = $file->storeAs('uploads/profile_pics', $fileName, 'public');
                        $imagePaths[$imageType] = 'uploads/profile_pics/' . $fileName; // Store path in DB
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
                'email'          => $validated['email'] ?? null,
                'phone'      => $validated['mobile_number'],
                'phone_code_id'        => (int) $validated['mobile_number_code_id'],
                'phone_2' => $validated['alternative_mobile_number'] ?? null,
                'phone_2_code_id_id' => !empty($validated['alternative_mobile_number'])
                    ? (int) ($validated['alternative_mobile_number_code_id'] ?? null)
                    : null,
                'address'        => $validated['address_1'],
                'address_2'        => $request->Address_2,
                'country_id'     => $validated['country'],
                'state_id'       => $validated['state'],
                'city_id'        => $validated['city'],
                'pincode'            => $validated['Zip_code'],
                'password'       => Hash::make(12345678),
                'status' => $request->status ?? 'Active',
                'company_name'        => $request->company_name ?? null,
                'apartment'        => $request->apartment ?? null,
                'username'      => $validated['username'],
                'latitude'       => $validated['latitude'] ?? null, // Optional Field
                'longitude'      => $validated['longitude'] ?? null, // Optional Field
                'website_url'        => $request->website_url ?? null,
                'write_comment'        => $request->write_comment ?? null,
                'read_comment'        => $request->read_comment ?? null,
                'language'        => $request->language ?? null,
                'year_to_date'        => $request->year_to_date ?? null,
                'license_number'        => $request->license_number ?? null,
                'warehouse_id'        => $request->warehouse_id ?? null,
                'signature_img' => $imagePaths['signature'] ?? null,
                'contract_signature_img' => $imagePaths['contract_signature'] ?? null,
                'license_document' => $imagePaths['license_picture'] ?? null,
                'profile_pic' => $imagePaths['profile_pics'] ?? null,
                'signup_type' => 'for_admin',
                'country_code'        => $request->country_code ?? null,
                'country_code_2'        => $request->country_code_2 ?? null,
                'vehicle_id'        => $request->container_id ?? null,
            ];
            if (!empty($request->license_expiry_date)) {
                $userData['license_expiry_date'] = Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d');
            }

            if (!empty($request->signature_date)) {
                $userData['signature_date'] = Carbon::createFromFormat('m/d/Y', $request->signature_date)->format('Y-m-d');
            }

            // 📌 Create User
            $user = User::create($userData);


            // Example dynamic data
            $userName = $validated['first_name'];
            $email = $validated['email'] ?? null;
            $mobileNumber = $validated['mobile_number'];
            $password = 12345678;
            $loginUrl = route('login');

            Mail::to($email)->send(new RegistorMail($userName, $email, $mobileNumber, $password, $loginUrl));

            return redirect()->route('admin.customer.index')
                ->with('success', 'User created successfully');
        } catch (\Throwable $th) {
            // Validation Errors dikhane ke liye
            return  $th;
            return back()->with('errors', $e->getMessage());
        }
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
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default pagination
        $currentPage = $request->input('page', 1);
        $type = $request->input('type');

        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->where('status', 'Active')->get();
        $countries = Country::all();
        $containers = Vehicle::where('vehicle_type', 'Container')->select('id', 'container_no_1', 'container_no_2')->get();
        $page_no = $request->page;
        $childUsers = User::where('parent_customer_id', $id)
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('unique_id', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%")
                        ->orWhere('phone', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%")
                        ->orWhere('status', 'LIKE', "%$search%");
                });
            })
            ->where('role_id', 5)
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);
        $serialStart = ($currentPage - 1) * $perPage;


        if ($request->ajax() && $type == "ShipTo") {
            return view('admin.customer.shipto.shiptotable', compact('user', 'childUsers', 'roles', 'userRole', 'warehouses', 'countries', 'page_no', 'containers'))->render();
        }
        return view('admin.customer.edit', compact('user', 'childUsers', 'roles', 'userRole', 'warehouses', 'countries', 'page_no', 'containers'));
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
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $id,
            ],
            'mobile_number_code_id' => 'required|exists:countries,id',
            'mobile_number' => 'required|digits:10|unique:users,phone,' . $id,
            'alternative_mobile_number_code_id' => 'nullable|exists:countries,id',
            'alternative_mobile_number' => 'nullable|digits:10',
            'address_1' => 'required|string|max:255',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'nullable|string|max:10',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            // 'password' => 'nullable|string|min:6|confirmed',
            // 'password_confirmation' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        $user = User::findOrFail($id);
        $imagePaths = [];
        // 🔹 File Upload Handling
        foreach (['profile_pic', 'signature_img', 'contract_signature_img', 'license_document'] as $imageType) {
            if ($request->hasFile($imageType)) {
                $file = $request->file($imageType);
                $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();

                if ($imageType === 'profile_pic') {
                    $filePath = $file->storeAs('uploads/profile_pics', $fileName, 'public');
                    $imagePaths[$imageType] = 'uploads/profile_pics/' . $fileName;
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
            'phone'      => $validated['mobile_number'],
            'phone_code_id'        => (int) $validated['mobile_number_code_id'],
            'phone_2' => $validated['alternative_mobile_number'] ?? null,
            'phone_2_code_id_id' => !empty($validated['alternative_mobile_number'])
                ? (int) ($validated['alternative_mobile_number_code_id'] ?? null)
                : null,
            'address'     => $validated['address_1'],
            'address_2'   => $request->Address_2,
            'country_id'  => $validated['country'],
            'state_id'    => $validated['state'],
            'city_id'     => $validated['city'],
            'pincode'     => $validated['Zip_code'],
            'status' => $request->status ?? 'Active',
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
            'vehicle_id'        => $request->container_id ?? null,
            'country_code'        => $request->country_code ?? null,
            'country_code_2'        => $request->country_code_2 ?? null,
            // 'signup_type'    => 'for_admin'
        ];

        // 🔹 File Path Update
        if (!empty($imagePaths['signature_img'])) {
            $userData['signature_img'] = $imagePaths['signature_img'] ?? $user->signature_img;
        }

        if (!empty($imagePaths['contract_signature_img'])) {
            $userData['contract_signature_img'] = $imagePaths['contract_signature_img'] ?? $user->contract_signature_img;
        }
        if (!empty($imagePaths['license_document'])) {
            $userData['license_document'] = $imagePaths['license_document'] ?? $user->license_document;
        }
        if (!empty($imagePaths['profile_pic'])) {
            $userData['profile_pic'] = $imagePaths['profile_pic'] ?? $user->profile_pic;
        }




        // 🔹 Date Format Conversion
        if (!empty($request->edit_license_expiry_date)) {
            $userData['license_expiry_date'] = Carbon::createFromFormat('m/d/Y', $request->edit_license_expiry_date)->format('Y-m-d');
        }

        if (!empty($request->edit_signature_date)) {
            $userData['signature_date'] = Carbon::createFromFormat('m/d/Y', $request->edit_signature_date)->format('Y-m-d');
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

    public function changeStatus(Request $request, $id)
    {
        $driver = User::find($id);

        if ($driver) {
            $driver->status = $request->status; // 1 = Active, 0 = Deactive
            $driver->save();

            return response()->json(['success' => 'Status Updated Successfully']);
        }

        return response()->json(['error' => 'Driver Not Found']);
    }

    public function viewShipTo($id)
    {
        $user = User::find($id);

        return view('admin.customer.shipto.createShipTo', compact('user', 'id'));
    }

    public function createShipTo(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|string',
            'company_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'mobile_number_code_id' => 'required',
            'mobile_number' => 'required|digits:10|unique:users,phone',
            'alternative_mobile_number_code_id' => 'required',
            'alternative_mobile_number' => 'nullable|max:10',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'address_1' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'language' => 'required|string',
        ]);
        try {

            $imagePaths = [];

            foreach (['license_picture'] as $imageType) {

                if ($request->hasFile($imageType)) {
                    $file = $request->file($imageType);
                    $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();

                    // 🔹 Agar profile_pics hai to alag folder me store kare
                    // 🔹 Baaki images customer folder me store ho
                    $filePath = $file->storeAs('uploads/customer', $fileName, 'public');
                    $imagePaths[$imageType] = 'uploads/customer/' . $fileName; // Store path in DB
                }
            }


            $userData = [
                'name'       => $validated['first_name'],
                'email'      => $validated['email'],
                'phone'      => $validated['mobile_number'], // Correct this as per actual phone structure
                'phone_2'    => $validated['alternative_mobile_number'] ?? null,
                'phone_code_id'        => (int) $validated['mobile_number_code_id'],
                'phone_2_code_id_id'   => (int) $validated['alternative_mobile_number_code_id'],
                'address'    => $validated['address_1'],
                'address_2'    => $validated['address_2'],
                'latitude'   => $validated['latitude'],
                'longitude'  => $validated['longitude'],
                'language'   => $validated['language'],
                'company_name' => $validated['company_name'],
                'country_id'   => $validated['country'],
                'password'     => Hash::make(12345678),
                'signup_type'  => 'for_admin',
                'role'  => 'ship_to_customer',
                'role_id'  => 5,

                // 🆕 Extra allowed fields (outside validation)
                'license_number'   => $request->license ?? null,
                'apartment' => $request->apartment ?? null,
                'parent_customer_id' => $request->parent_customer_id ?? null,
                'license_document' => $imagePaths['license_picture'] ?? null,
            ];

            // 📌 Create User
            $user = User::create($userData);
            return redirect()
                ->to(route('admin.customer.edit', $request->parent_customer_id) . '?type=ShipTo')
                ->with('success', 'Ship to user created successfully.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function updateShipTo($id)
    {
        $user = User::find($id);
        return view('admin.customer.shipto.updateShipTo', compact('user', 'id'));
    }

    public function editeShipTo(Request $request, $id)
    {
        // Validation
        $validated = $request->validate([
            'country' => 'required|string',
            'company_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'mobile_number_code_id' => 'required|exists:countries,id',
            'mobile_number' => 'required|digits:10|unique:users,phone,' . $id,
            'alternative_mobile_number_code_id' => 'nullable|exists:countries,id',
            'alternative_mobile_number' => 'nullable|digits:10',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $id,
            ],
            'address_1' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'language' => 'required|string',
        ]);

        try {
            $user = User::findOrFail($id);

            $imagePaths = [];

            foreach (['license_picture'] as $imageType) {
                if ($request->hasFile($imageType)) {
                    // Purani image delete karo agar hai
                    if ($user->{$imageType} && \Storage::exists('public/' . $user->{$imageType})) {
                        \Storage::delete('public/' . $user->{$imageType});
                    }

                    // Nई image upload karo
                    $file = $request->file($imageType);
                    $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('uploads/customer', $fileName, 'public');
                    $imagePaths[$imageType] = $filePath;
                }
            }

            $userData = [
                'name'       => $validated['first_name'],
                'email'      => $validated['email'],
                'phone'      => $validated['mobile_number'],
                'phone_2'    => $validated['alternative_mobile_number'] ?? null,
                'phone_code_id'        => (int) $validated['mobile_number_code_id'],
                'phone_2_code_id_id'   => (int) $validated['alternative_mobile_number_code_id'] ?? null,
                'address'    => $validated['address_1'],
                'address_2'    => $request->address_2,
                'latitude'   => $validated['latitude'],
                'longitude'  => $validated['longitude'],
                'language'   => $validated['language'],
                'company_name' => $validated['company_name'],
                'country_id'   => $validated['country'],

                // 🆕 Extra allowed fields
                'license_number'   => $request->license ?? null,
                'apartment' => $request->apartment ?? null,
                'parent_customer_id' => $request->parent_customer_id ?? null,
                'license_document' => $imagePaths['license_picture'] ?? $user->license_document,
            ];

            $user->update($userData);

            return redirect()
                ->to(route('admin.customer.edit', $user->parent_customer_id) . '?type=ShipTo')
                ->with('success', 'Ship To details updated successfully.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroyShipTo($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update(['is_deleted' => "Yes"]); // is_deleted ko 1 set kar rahe hain
            return redirect()
                ->to(route('admin.customer.edit', $user->parent_customer_id) . '?type=ShipTo')
                ->with('success', 'Ship To address delete successfully.');
        }
        return redirect()
            ->to(route('admin.customer.edit', $user->parent_customer_id) . '?type=ShipTo')
            ->with('error', 'Ship To address not found');
    }
}
