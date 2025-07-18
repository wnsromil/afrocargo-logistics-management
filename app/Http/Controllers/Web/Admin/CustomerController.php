<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{User, Menu, Container, Warehouse, Country, Vehicle, UserPickupDetail, Address};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Mail\RegistorMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
        $shipTosearch = $request->input('ShipTosearch');
        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);
        $type = $request->input('type');
        $warehouse_id = $request->input('warehouse_id');

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->select('id', 'warehouse_name')
            ->get();

        // Set role_id based on ShipTosearch
        $roleId = $shipTosearch ? 5 : 3;

        $customers = User::with(['warehouse.country', 'warehouse.state', 'warehouse.city'])
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->where('is_deleted', 'No')
            ->where('role_id', $roleId)
            ->when($search || $shipTosearch, function ($q) use ($search, $shipTosearch) {
                $q->where(function ($query) use ($search, $shipTosearch) {
                    if ($search) {
                        $query->where('name', 'LIKE', "%$search%")
                            ->orWhere('unique_id', 'LIKE', "%$search%")
                            ->orWhere('username', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('address', 'LIKE', "%$search%")
                            ->orWhere('status', 'LIKE', "%$search%")
                            ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                    }

                    if ($shipTosearch) {
                        $query->orWhere('name', 'LIKE', "%$shipTosearch%")
                            ->orWhere('unique_id', 'LIKE', "%$shipTosearch%")
                            ->orWhere('username', 'LIKE', "%$shipTosearch%")
                            ->orWhere('email', 'LIKE', "%$shipTosearch%")
                            ->orWhere('phone', 'LIKE', "%$shipTosearch%")
                            ->orWhere('address', 'LIKE', "%$shipTosearch%")
                            ->orWhere('status', 'LIKE', "%$shipTosearch%")
                            ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$shipTosearch%"]);
                    }
                });
            })
            ->when($warehouse_id, function ($q) use ($warehouse_id) {
                return $q->where('warehouse_id', $warehouse_id);
            })
            ->latest('id')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'ShipTosearch' => $shipTosearch,
                'per_page' => $perPage,
                'type' => $type,
            ]);

        $serialStart = ($currentPage - 1) * $perPage;

        if ($shipTosearch) {
            if ($request->ajax()) {
                return view('admin.customer.shipto.shiptotable', compact('customers', 'serialStart', 'warehouses'))->render();
            } else {
                return view('admin.customer.shipto.shiptoindextable', compact('customers', 'search', 'perPage', 'serialStart', 'warehouses'));
            }
        }

        if ($request->ajax()) {
            return view('admin.customer.table', compact('customers', 'serialStart', 'warehouses'))->render();
        }

        return view('admin.customer.index', compact('customers', 'search', 'perPage', 'serialStart', 'warehouses'));
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
        $containers = Vehicle::where('vehicle_type', '1')->select('id', 'container_no_1', 'container_no_2')->get();
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
        $phoneLength = getPhoneLengthById($request->mobile_number_code_id);
        $altPhoneLength = getPhoneLengthById($request->alternative_mobile_number_code_id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'mobile_number_code_id' => 'required',
            'mobile_number' => "required|digits:$phoneLength|unique:users,phone",
            'alternative_mobile_number_code_id' => 'required',
            'alternative_mobile_number' => "nullable|digits:$altPhoneLength",
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

            $randomPassword = Str::random(8); // Random password of 8 characters
            $hashedPassword = Hash::make($randomPassword); // Hashing password


            // 🛠 Mapping Request Fields to Database Fields
            $userData = [
                'name'          => $validated['first_name'],
                'last_name'  => $validated['last_name'],
                'email'          => $validated['email'] ?? null,
                'phone'      => $validated['mobile_number'],
                'phone_code_id'        => (int) $validated['mobile_number_code_id'],
                'phone_2' => $validated['alternative_mobile_number'] ?? null,
                'phone_2_code_id_id' => !empty($validated['alternative_mobile_number'])
                    ? (int) ($validated['alternative_mobile_number_code_id'] ?? null)
                    : null,
                'address'        => $validated['address_1'],
                'role' => 'customer',
                'address_2'        => $request->Address_2,
                'country_id'     => $validated['country'],
                'state_id'       => $validated['state'],
                'city_id'        => $validated['city'],
                'pincode'            => $validated['Zip_code'],
                'password'       => $hashedPassword,
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
                'contract'          => $request->contract ?? 'No',
                'text_cust'         => $request->text_cust ?? 'No',
                'voice_call'        => $request->voice_call ?? 'No',
                'cash_cust'         => $request->cash_cust ?? 'No',
                'is_license_pic'    => $request->is_license_pic ?? 'No',
                'no_service'        => $request->no_service ?? 'No',
                'call'              => $request->call ?? 'No',
                'sales_call'        => $request->sales_call ?? 'No',
            ];
            if (!empty($request->license_expiry_date)) {
                $userData['license_expiry_date'] = Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d');
            }

            if (!empty($request->signature_date)) {
                $userData['signature_date'] = Carbon::createFromFormat('m/d/Y', $request->signature_date)->format('Y-m-d');
            }

            // 📌 Create User
            $user = User::create($userData);

            insertAddress([
                'user_id' => $user->id,
                'address' => $validated['address_1'],
                'address_type' => 'pickup',
                'mobile_number' => $validated['mobile_number'] ?? null,
                'alternative_mobile_number' => $validated['alternative_mobile_number'] ?? null,
                'mobile_number_code_id'        => (int) $validated['mobile_number_code_id'],
                'alternative_mobile_number_code_id' => !empty($validated['alternative_mobile_number'])
                    ? (int) ($validated['alternative_mobile_number_code_id'] ?? null)
                    : null,
                'city_id' => $validated['city'] ?? null,
                'country_id' => $validated['country'] ?? null,
                'full_name' => $validated['first_name'] . ' ' . $validated['last_name'] ?? null,
                'last_name' => $validated['last_name'] ?? null,
                'name' => $validated['first_name'] ?? null,
                'pincode' => $validated['Zip_code'] ?? null,
                'state_id' => $validated['state'] ?? null,
                'warehouse_id' => $request->warehouse_id ?? null,
                'lat' => $validated['latitude'] ?? null,
                'long' => $validated['longitude'] ?? null,
                'type' => 'Services', // Default type
                'default_address' => 'Yes'
            ]);

            // Example dynamic data
            $userName = $validated['first_name'];
            $email = $validated['email'] ?? null;
            $mobileNumber = $validated['mobile_number'];
            $password = $randomPassword;
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
        $containers = Vehicle::where('vehicle_type', '1')->select('id', 'container_no_1', 'container_no_2')->get();
        $page_no = $request->page;
        $ShipToCustomer = User::where('parent_customer_id', $id)
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('unique_id', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%")
                        ->orWhere('phone', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%")
                        ->orWhere('status', 'LIKE', "%$search%")
                        ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                });
            })
            ->where('role_id', 5)
            ->where('is_deleted', 'No')
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);


        $PickupCustomer = User::where('parent_customer_id', $id)
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('unique_id', 'LIKE', "%$search%")
                        ->orWhere('phone', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%")
                        ->orWhere('status', 'LIKE', "%$search%")
                        ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                });
            })
            ->where('role_id', 6)
            ->where('is_deleted', 'No')
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);

        $PickupAddress = Address::where('user_id', $id)
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('unique_id', 'LIKE', "%$search%")
                        ->orWhere('mobile_number', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%")
                        ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                });
            })
            ->where('address_type', 'pickup')
            ->where('is_deleted', 'No')
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);



        $Pickups = UserPickupDetail::where('parent_customer_id', $id)
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('Item1', 'LIKE', "%$search%")
                        ->orWhere('Item2', 'LIKE', "%$search%");
                    // ->orWhere('phone', 'LIKE', "%$search%")
                    // ->orWhere('address', 'LIKE', "%$search%")
                    // ->orWhere('status', 'LIKE', "%$search%");
                });
            })
            ->where('status', 'Active')
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);

        $serialStart = ($currentPage - 1) * $perPage;


        if ($request->ajax() && $type == "ShipTo") {
            return view('admin.customer.shipto.shiptotable', compact('user', 'ShipToCustomer', 'PickupCustomer', 'PickupAddress', 'roles', 'userRole', 'warehouses', 'countries', 'page_no', 'containers'))->render();
        }

        if ($request->ajax() && $type == "PickupAddresss") {
            return view('admin.customer.pickups.pickup_addresstable', compact('user', 'ShipToCustomer', 'PickupCustomer', 'PickupAddress', 'roles', 'userRole', 'warehouses', 'countries', 'page_no', 'containers'))->render();
        }
        return view('admin.customer.edit', compact('user', 'ShipToCustomer', 'PickupCustomer', 'PickupAddress', 'Pickups', 'roles', 'userRole', 'warehouses', 'countries', 'page_no', 'containers'));
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
        $phoneLength = getPhoneLengthById($request->mobile_number_code_id);
        $altPhoneLength = getPhoneLengthById($request->alternative_mobile_number_code_id);
        // 🔹 Validation
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $id,
            ],
            'mobile_number_code_id' => 'required|exists:countries,id',
            'mobile_number' => 'required|digits:' . $phoneLength . '|unique:users,phone,' . $id,
            'alternative_mobile_number_code_id' => 'nullable|exists:countries,id',
            'alternative_mobile_number' => 'nullable|digits:' . $altPhoneLength,
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
            'last_name'  => $validated['last_name'],
            'email'       => $validated['email'],
            'phone'      => $validated['mobile_number'],
            'unique_id' => $request->unique_id,
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
            'contract'          => $request->contract ?? 'No',
            'text_cust'         => $request->text_cust ?? 'No',
            'voice_call'        => $request->voice_call ?? 'No',
            'cash_cust'         => $request->cash_cust ?? 'No',
            'is_license_pic'    => $request->is_license_pic ?? 'No',
            'no_service'        => $request->no_service ?? 'No',
            'call'              => $request->call ?? 'No',
            'sales_call'        => $request->sales_call ?? 'No',
            // 'signup_type'    => 'for_admin'
        ];

        if ($request->delete_signature_img == 1) {
            $userData['signature_img'] = null;
        }
        if ($request->delete_contract_signature_img == 1) {
            $userData['contract_signature_img'] = null;
        }
        if ($request->delete_license_document == 1) {
            $userData['license_document'] = null;
        }
        if ($request->delete_profile_pic == 1) {
            $userData['profile_pic'] = null;
        }

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

        updateAddress($id, [
            'user_id' => $user->id,
            'address' => $validated['address_1'] ?? $user->address,
            'mobile_number' => $validated['mobile_number'] ?? $user->phone,
            'alternative_mobile_number' => $validated['alternative_mobile_number'] ?? $user->phone_2,
            'mobile_number_code_id' => (int) ($validated['mobile_number_code_id'] ?? $user->phone_code_id),
            'alternative_mobile_number_code_id' => !empty($validated['alternative_mobile_number'])
                ? (int) ($validated['alternative_mobile_number_code_id'] ?? $user->phone_2_code_id_id)
                : $user->phone_2_code_id_id,
            'city_id' => $validated['city'] ?? $user->city_id,
            'country_id' => $validated['country'] ?? $user->country_id,
            'full_name' => $validated['first_name'] . ' ' . $validated['last_name'] ?? $user->full_name,
            'last_name' => $validated['last_name'] ?? $user->last_name,
            'name' => $validated['first_name'] ?? $user->name,
            'pincode' => $validated['Zip_code'] ?? $user->pincode,
            'state_id' => $validated['state'] ?? $user->state_id,
            'warehouse_id' => $request->warehouse_id ?? $user->warehouse_id,
            'lat' => $validated['latitude'] ?? $user->latitude,
            'long' => $validated['longitude'] ?? $user->longitude,
        ]);

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
        $phoneLength = getPhoneLengthById($request->mobile_number_code_id);
        $altPhoneLength = getPhoneLengthById($request->alternative_mobile_number_code_id);

        $validated = $request->validate([
            'country' => 'required|string',
            'company_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number_code_id' => 'required',
            'mobile_number' => "required|digits:$phoneLength|unique:users,phone",
            'alternative_mobile_number_code_id' => 'required',
            'alternative_mobile_number' => "nullable|digits:$altPhoneLength|unique:users,phone_2",
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
            'zip_code' => 'nullable|string|max:10',
            'state_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
        ], [
            'mobile_number.required' => 'Cellphone is required.',
            'mobile_number.digits' => 'Cellphone must be exactly ' . $phoneLength . ' digits.',
            'mobile_number.unique' => 'This cellphone is already in use.',

            'alternative_mobile_number.digits' => 'Telephone number must be exactly ' . $altPhoneLength . ' digits.',
            'alternative_mobile_number.unique' => 'This telephone number is already in use.',
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
                    $imagePaths[$imageType] = 'storage/uploads/customer/' . $fileName; // Store path in DB
                }
            }

            $randomPassword = Str::random(8); // Random password of 8 characters
            $hashedPassword = Hash::make($randomPassword); // Hashing password


            $userData = [
                'name'       => $validated['first_name'],
                'last_name' => $request->last_name ?? null,
                'email'      => $validated['email'],
                'phone'      => $validated['mobile_number'], // Correct this as per actual phone structure
                'phone_2'    => $validated['alternative_mobile_number'] ?? null,
                'phone_code_id'        => (int) $validated['mobile_number_code_id'],
                'phone_2_code_id_id'   => (int) $validated['alternative_mobile_number_code_id'],
                'address'    => $validated['address_1'],
                'address_2'    => $request->address_2,
                'latitude'   => $validated['latitude'],
                'longitude'  => $validated['longitude'],
                'language'   => $validated['language'],
                'company_name' => $validated['company_name'],
                'country_id'   => $validated['country'],
                'password'     => $hashedPassword,
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

            insertAddress([
                'user_id' => $user->id,
                'address' => $validated['address_1'],
                'address_type' => 'delivery',
                'mobile_number' => $validated['mobile_number'] ?? null,
                'alternative_mobile_number' => $validated['alternative_mobile_number'] ?? null,
                'mobile_number_code_id' => (int) $validated['mobile_number_code_id'],
                'alternative_mobile_number_code_id' => (int) $validated['alternative_mobile_number_code_id'],
                'city_id' => $request->city_id ?? null, // 🟡 city_id from request
                'country_id' => $validated['country'] ?? null,
                'name' => $validated['first_name'],
                'last_name' => $request->last_name ?? null, // 🟡 last_name from request (not validated)
                'full_name' => $validated['first_name'] . ' ' . ($request->last_name ?? ''),
                'pincode' => $request->zip_code ?? null, // 🟡 Zip_code from request
                'state_id' => $request->state_id ?? null, // 🟡 state from request
                'warehouse_id' => (int) $request->warehouse_id ?? null,
                'lat' => $validated['latitude'] ?? null, // 🟢 matching with validated
                'long' => $validated['longitude'] ?? null, // 🟢 matching with validated
                'type' => 'Services',
                'default_address' => 'Yes',
            ]);


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
        $phoneLength = getPhoneLengthById($request->mobile_number_code_id);
        $altPhoneLength = getPhoneLengthById($request->alternative_mobile_number_code_id);

        // Validation
        $validated = $request->validate([
            'country' => 'required|string',
            'company_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number_code_id' => 'required|exists:countries,id',
            'mobile_number' => "required|digits:$phoneLength|unique:users,phone," . $id,
            'alternative_mobile_number_code_id' => 'nullable|exists:countries,id',
            'alternative_mobile_number' => "nullable|digits:$altPhoneLength|unique:users,phone_2," . $id,
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
        ], [
            'mobile_number.required' => 'Cellphone is required.',
            'mobile_number.digits' => 'Cellphone must be exactly ' . $phoneLength . ' digits.',
            'mobile_number.unique' => 'This cellphone is already in use.',

            'alternative_mobile_number.digits' => 'Telephone number must be exactly ' . $altPhoneLength . ' digits.',
            'alternative_mobile_number.unique' => 'This telephone number is already in use.',
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
                    $imagePaths[$imageType] = 'storage/uploads/customer/' . $fileName;
                }
            }

            $userData = [
                'name'       => $validated['first_name'],
                'last_name' => $request->last_name ?? null,
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

            updateAddress($id, [
                'user_id' => $user->id,
                'address' => $validated['address_1'],
                'address_type' => 'delivery',
                'mobile_number' => $validated['mobile_number'] ?? null,
                'alternative_mobile_number' => $validated['alternative_mobile_number'] ?? null,
                'mobile_number_code_id' => (int) $validated['mobile_number_code_id'],
                'alternative_mobile_number_code_id' => (int) $validated['alternative_mobile_number_code_id'],
                'city_id' => $request->city_id ?? null, // 🟡 city_id from request
                'country_id' => $validated['country'] ?? null,
                'name' => $validated['first_name'],
                'last_name' => $request->last_name ?? null, // 🟡 last_name from request (not validated)
                'full_name' => $validated['first_name'] . ' ' . ($request->last_name ?? ''),
                'pincode' => $request->zip_code ?? null, // 🟡 Zip_code from request
                'state_id' => $request->state_id ?? null, // 🟡 state from request
                'warehouse_id' => (int) $request->warehouse_id ?? null,
                'lat' => $validated['latitude'] ?? null, // 🟢 matching with validated
                'long' => $validated['longitude'] ?? null, // 🟢 matching with validated
                'type' => 'Services',
                'default_address' => 'Yes',
            ]);

            return redirect()
                ->to(route('admin.customer.edit', $user->parent_customer_id) . '?type=ShipTo')
                ->with('success', 'Ship To address updated successfully.');
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

    public function viewPickups($id)
    {
        $user = User::find($id);

        $drivers = User::where('status', 'Active')->where('role_id', '=', '4')
            ->Where('is_deleted', 'no')->select('id', 'name')->get();

        return view('admin.customer.pickups.addPickups', compact('user', 'drivers', 'id'));
    }

    public function viewPickupAddress($id)
    {
        $user = User::find($id);

        return view('admin.customer.pickups.createpickup_address', compact('user', 'id'));
    }

    public function createPickupAddress(Request $request)
    {
        $phoneLength = getPhoneLengthById($request->mobile_number_code_id);
        $altPhoneLength = getPhoneLengthById($request->alternative_mobile_number_code_id);

        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number_code_id' => 'required',
            'mobile_number' => "required|digits:$phoneLength|unique:users,phone",
            'alternative_mobile_number_code_id' => 'required',
            'alternative_mobile_number' => "nullable|digits:$altPhoneLength|unique:users,phone_2",
            'address_1' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'nullable|string|max:10',
        ],[
            'mobile_number.required' => 'Cellphone is required.',
            'mobile_number.digits' => 'Cellphone must be exactly ' . $phoneLength . ' digits.',
            'mobile_number.unique' => 'This cellphone is already in use.',

            'alternative_mobile_number.digits' => 'Telephone number must be exactly ' . $altPhoneLength . ' digits.',
            'alternative_mobile_number.unique' => 'This telephone number is already in use.',
        ]);
        try {
            $randomPassword = Str::random(8); // Random password of 8 characters
            $hashedPassword = Hash::make($randomPassword); // Hashing password

            // $userData = [
            //     'name'       => $validated['first_name'],
            //     'last_name'        => $validated['last_name'],
            //     'phone'      => $validated['mobile_number'], // Correct this as per actual phone structure
            //     'phone_2'    => $validated['alternative_mobile_number'] ?? null,
            //     'phone_code_id'        => (int) $validated['mobile_number_code_id'],
            //     'phone_2_code_id_id'   => (int) $validated['alternative_mobile_number_code_id'],
            //     'address'    => $validated['address_1'],
            //     'address_2'    => $request->address_2,
            //     'latitude'   => $validated['latitude'],
            //     'longitude'  => $validated['longitude'],
            //     'company_name' => $validated['company_name'],
            //     'country_id'   => $validated['country'],
            //     'state_id'   => $validated['city'],
            //     'city_id'   => $validated['state'],
            //     'pincode'   => $validated['Zip_code'],
            //     'password'     => $hashedPassword,
            //     'signup_type'  => 'for_admin',
            //     'role'  => 'pickup_to_customer',
            //     'role_id'  => 6,
            //     'apartment' => $request->apartment ?? null,
            //     'parent_customer_id' => $request->parent_customer_id ?? null,

            // ];

            $userAddressData = [
                'address'        => $validated['address_1'],
                'address_type' => 'pickup',
                'alternative_mobile_number' => $validated['alternative_mobile_number'] ?? null,
                'city_id' => $validated['city'],
                'country_id' => $validated['country'],
                'mobile_number' => $validated['mobile_number'],
                'pincode' => $validated['Zip_code'],
                'state_id' => $validated['state'],
                'lat' => $validated['latitude'],
                'long' => $validated['longitude'],
                'mobile_number_code_id'        => (int) $validated['mobile_number_code_id'],
                'alternative_mobile_number_code_id'   => (int) $validated['alternative_mobile_number_code_id'],
                'apartment' => $request->apartment ?? null,
            ];

            $userAddressData['user_id'] = $request->parent_customer_id;

            $userAddressData['name'] = trim($validated['first_name'] ?? '');
            $userAddressData['last_name'] = trim($validated['last_name'] ?? '');
            $userAddressData['full_name'] = $validated['first_name'] . ' ' . ($validated['last_name'] ?? '');

            // 📌 Create User
            // $user = User::create($userData);
            $address = Address::create($userAddressData);

            return redirect()
                ->to(route('admin.customer.edit', $request->parent_customer_id) . '?type=PickupAddresss')
                ->with('success', 'Pickup to user created successfully.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function updatePickupAddress($id)
    {
        $user = Address::find($id);
        return view('admin.customer.pickups.updatepickup_address', compact('user', 'id'));
    }

    public function destroyPickupAddress($id)
    {

        $user = Address::find($id);

        if ($user) {
            $user->update(['is_deleted' => "Yes"]); // is_deleted ko 1 set kar rahe hain
            return redirect()
                ->to(route('admin.customer.edit', $user->user_id) . '?type=PickupAddresss')
                ->with('success', 'Pickup address delete successfully.');
        }
        return redirect()
            ->to(route('admin.customer.edit', $user->user_id) . '?type=PickupAddresss')
            ->with('error', 'Pickup address not found');
    }

    public function editPickupAddress(Request $request, $id)
    {
        $phoneLength = getPhoneLengthById($request->mobile_number_code_id);
        $altPhoneLength = getPhoneLengthById($request->alternative_mobile_number_code_id);
        // Validation
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number_code_id' => 'required|exists:countries,id',
            'mobile_number' => 'required|digits:' . $phoneLength . '|unique:users,phone,' . $id,
            'alternative_mobile_number_code_id' => 'nullable|exists:countries,id',
            'alternative_mobile_number' => 'nullable|digits:' . $altPhoneLength . '|unique:users,phone,' . $id,
            'address_1' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'nullable|string|max:10',
        ],[
            'mobile_number.required' => 'Cellphone is required.',
            'mobile_number.digits' => 'Cellphone must be exactly ' . $phoneLength . ' digits.',
            'mobile_number.unique' => 'This cellphone is already in use.',

            'alternative_mobile_number.digits' => 'Telephone number must be exactly ' . $altPhoneLength . ' digits.',
            'alternative_mobile_number.unique' => 'This telephone number is already in use.',
        ]);

        try {
            //$user = User::findOrFail($id);
            $address = Address::findOrFail($id);

            // $userData = [
            //     'name'       => $validated['first_name'],
            //     'phone'      => $validated['mobile_number'], // Correct this as per actual phone structure
            //     'phone_2'    => $validated['alternative_mobile_number'] ?? null,
            //     'phone_code_id'        => (int) $validated['mobile_number_code_id'],
            //     'phone_2_code_id_id'   => (int) $validated['alternative_mobile_number_code_id'],
            //     'address'    => $validated['address_1'],
            //     'address_2'    => $request->address_2,
            //     'latitude'   => $validated['latitude'],
            //     'longitude'  => $validated['longitude'],
            //     'company_name' => $validated['company_name'],
            //     'country_id'   => $validated['country'],
            //     'state_id'   => $validated['city'],
            //     'city_id'   => $validated['state'],
            //     'pincode'   => $validated['Zip_code'],
            //     'signup_type'  => 'for_admin',
            //     'apartment' => $request->apartment ?? null,
            //     'parent_customer_id' => $request->parent_customer_id ?? null,

            // ];

            $userAddressData = [
                'address'        => $validated['address_1'],
                'address_type' => 'pickup',
                'alternative_mobile_number' => $validated['alternative_mobile_number'] ?? null,
                'city_id' => $validated['city'],
                'country_id' => $validated['country'],
                'mobile_number' => $validated['mobile_number'],
                'pincode' => $validated['Zip_code'],
                'state_id' => $validated['state'],
                'lat' => $validated['latitude'],
                'long' => $validated['longitude'],
                'mobile_number_code_id'        => (int) $validated['mobile_number_code_id'],
                'alternative_mobile_number_code_id'   => (int) $validated['alternative_mobile_number_code_id'],
                'apartment' => $request->apartment ?? null,
            ];

            $userAddressData['name'] = trim($validated['first_name'] ?? '');
            $userAddressData['last_name'] = trim($validated['last_name'] ?? '');
            $userAddressData['full_name'] = $validated['first_name'] . ' ' . ($validated['last_name'] ?? '');

            $address->update($userAddressData);

            return redirect()
                ->to(route('admin.customer.edit', $address->user_id) . '?type=PickupAddresss')
                ->with('success', 'Pickup address updated successfully.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function Pickupstore(Request $request)
    {
        $rules = [
            'pickup_name' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string|max:10',
            'Pickup_cell_phone' => 'required|digits:10',
            'item1' => 'required|string',
            'pickup_date' => 'required|date',
            'pickup_status_type' => 'required|string|max:255',
            'zone' => 'required',
            'pickup_type' => 'required|string', // pickup_type validate karna zaroori hai
            'shipto_country' => 'required_if:pickup_type,Pickup|string|max:255',
            'shipto_name' => 'required_if:pickup_type,Pickup|string|max:255',
            'shipto_address_1' => 'required_if:pickup_type,Pickup|string|max:255',
            'shipto_cell_phone' => 'required_if:pickup_type,Pickup|digits:10',
        ];
        $message = [
            'pickup_name.required' => 'Full name is required.',
            'address_1.required' => 'Address 1 is required.',
            'city.required' => 'City is required.',
            'state.required' => 'State is required.',
            'zipcode.max' => 'Zipcode is required.',
            'Pickup_cell_phone.required' => 'Cell Phone is required.',
            'Pickup_cell_phone.digits' => 'Cell Phone must be 10 digits.',
            'item1.required' => 'Item 1 is required.',
            'pickup_date.required' => 'Date is required.',
            'pickup_status_type.required' => 'Status is required.',
            'zone.required' => 'Zone is required.',
            'pickup_type.required' => 'Pickup Type is required.',
            'shipto_country.required' => 'Country is required for No Shipto.',
            'shipto_name.required_if' => 'Shipto full name is required.',
            'shipto_address_1.required_if' => 'Shipto address  is required.',
            'shipto_cell_phone.required_if' => 'Cell Phone is required.',
            'shipto_cell_phone.digits' => 'Cell Phone must be 10 digits.',
        ];
        $validated = $request->validate(
            $rules,
            $message,
        );



        // 1. Pickup Address Update (users table)
        $pickupUser = Address::find($request->pickup_address_id);
        if ($pickupUser) {
            $pickupUser->update([
                'name' => $request->pickup_name,
                'last_name' => $request->pickup_last_name,
                'full_name' => $request->pickup_name . ' ' . $request->pickup_last_name,
                'lat' => $request->Pickup_latitude,
                'long' => $request->Pickup_longitude,
                'address' => $request->address_1,
                'apartment' => $request->pickup_apartment,
                'city_id' => $request->city,
                'state_id' => $request->state,
                'pincode' => $request->zipcode,
                'mobile_number_code_id' => $request->phone_code_id,
                'mobile_number' => $request->Pickup_cell_phone,
                'alternative_mobile_number_code_id' => $request->phone_2_code_id_id,
                'alternative_mobile_number' => $request->Pickup_telePhone,
            ]);
        }

        // 2. Shipto Address Update (users table)
        if ($request->pickup_type == "Pickup") {
            $shiptoUser = User::find($request->shipto_address_id);
            if ($shiptoUser) {
                $shiptoUser->update([
                    'country_id' => $request->shipto_country,
                    'name' => $request->shipto_name,
                    'address' => $request->shipto_address_1,
                    'address_2' => $request->shipto_address_2,
                    'phone_code_id' => $request->shipto_phone_code_id,
                    'phone' => $request->shipto_cell_phone,
                    'phone_2_code_id_id' => $request->shipto_phone_2_code_id_id,
                    'phone_2' => $request->shipto_telePhone,
                    'latitude' => $request->Shipto_latitude,
                    'longitude' => $request->Shipto_longitude,
                ]);
            }
        }
        // 3. UserPickupDetail Create
        $pickupDetail = UserPickupDetail::create([
            'parent_customer_id' => $request->parent_customer_id,
            'pickup_address_id' => $request->pickup_address_id,
            'shipto_address_id' => $request->shipto_address_id,
            'Item1' => $request->item1,
            'Item2' => $request->item2,
            'pickup_delivery' => $request->inlineRadioOptions,
            'Date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->pickup_date)->format('Y-m-d'),
            'Time' => $request->pickup_time,
            'Done_Date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->done_date)->format('Y-m-d'),
            'Zone' => $request->zone,
            'Driver_id' => $request->Driver_id, // update later if needed
            'Note' => $request->note,
            'Box_quantity' => $request->Box_quantity,
            'Barrel_quantity' => $request->Barrel_quantity,
            'Tapes_quantity' => $request->Tapes_quantity,
            'pickup_type' => $request->pickup_type,
            'pickup_status_type' => $request->pickup_status_type,
        ]);

        return redirect()
            ->to(route('admin.customer.edit', $request->parent_customer_id) . '?type=Pickups')
            ->with('success', 'Pickup address updated successfully.');
    }

    public function updatePickup($id)
    {
        $user = User::find($id);

        $UserPickupDetail = UserPickupDetail::with('pickupAddress', 'shiptoAddress')->find($id);

        $drivers = User::where('status', 'Active')->where('role_id', '=', '4')
            ->Where('is_deleted', 'no')->select('id', 'name')->get();

        return view('admin.customer.pickups.updatePickups', compact('user', 'UserPickupDetail', 'id', 'drivers'));
    }

    public function Editupdate(Request $request, $id)
    {
        $rules = [
            'pickup_name' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string|max:10',
            'Pickup_cell_phone' => 'required|digits:10',
            'item1' => 'required|string',
            'pickup_date' => 'required|date',
            'pickup_status_type' => 'required|string|max:255',
            'zone' => 'required',
            'pickup_type' => 'required|string',
            'shipto_country' => 'required_if:pickup_type,Pickup|string|max:255',
            'shipto_name' => 'required_if:pickup_type,Pickup|string|max:255',
            'shipto_address_1' => 'required_if:pickup_type,Pickup|string|max:255',
            'shipto_cell_phone' => 'required_if:pickup_type,Pickup|digits:10',
        ];

        $message = [ /* Same messages as in your store method */];

        $validated = $request->validate($rules, $message);

        // 1. Pickup Address Update
        $pickupUser = User::find($request->pickup_address_id);
        if ($pickupUser) {
            $pickupUser->update([
                'unique_id' => $request->unique_id,
                'name' => $request->pickup_name,
                'longitude' => $request->Pickup_longitude,
                'address' => $request->address_1,
                'address_2' => $request->pickup_address_2,
                'apartment' => $request->pickup_apartment,
                'city_id' => $request->city,
                'state_id' => $request->state,
                'pincode' => $request->zipcode,
                'phone_code_id' => $request->phone_code_id,
                'phone' => $request->Pickup_cell_phone,
                'phone_2_code_id_id' => $request->phone_2_code_id_id,
                'phone_2' => $request->Pickup_telePhone,
                'latitude' => $request->Pickup_latitude,
            ]);
        }

        // 2. Shipto Address Update
        if ($request->pickup_type == "Pickup") {
            $shiptoUser = User::find($request->shipto_address_id);
            if ($shiptoUser) {
                $shiptoUser->update([
                    'country_id' => $request->shipto_country,
                    'name' => $request->shipto_name,
                    'address' => $request->shipto_address_1,
                    'address_2' => $request->shipto_address_2,
                    'phone_code_id' => $request->shipto_phone_code_id,
                    'phone' => $request->shipto_cell_phone,
                    'phone_2_code_id_id' => $request->shipto_phone_2_code_id_id,
                    'phone_2' => $request->shipto_telePhone,
                    'latitude' => $request->Shipto_latitude,
                    'longitude' => $request->Shipto_longitude,
                ]);
            }
        }

        // 3. UserPickupDetail Update
        $pickupDetail = UserPickupDetail::find($id);
        if ($pickupDetail) {
            $pickupDetail->update([
                'parent_customer_id' => $request->parent_customer_id,
                'pickup_address_id' => $request->pickup_address_id,
                'shipto_address_id' => $request->shipto_address_id,
                'Item1' => $request->item1,
                'Item2' => $request->item2,
                'pickup_delivery' => $request->inlineRadioOptions,
                'Date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->pickup_date)->format('Y-m-d'),
                'Time' => $request->pickup_time,
                'Done_Date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->done_date)->format('Y-m-d'),
                'Zone' => $request->zone,
                'Driver_id' => $request->Driver_id,
                'Note' => $request->note,
                'Box_quantity' => $request->Box_quantity,
                'Barrel_quantity' => $request->Barrel_quantity,
                'Tapes_quantity' => $request->Tapes_quantity,
                'pickup_type' => $request->pickup_type,
                'pickup_status_type' => $request->pickup_status_type,
            ]);
        }

        return redirect()
            ->to(route('admin.customer.edit', $request->parent_customer_id) . '?type=Pickups')
            ->with('success', 'Pickup address updated successfully.');
    }
}
