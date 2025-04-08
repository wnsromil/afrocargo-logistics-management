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
        $perPage = $request->input('per_page', 10); // Default pagination
        $currentPage = $request->input('page', 1);

        $customers = User::with(['warehouse.country', 'warehouse.state', 'warehouse.city']) // ✅ Include relationships
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->where('is_deleted', 'No')
            ->where('role_id', 3)
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%")
                        ->orWhere('phone', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%")
                        ->orWhere('status', 'LIKE', "%$search%");
                    // ->orWhereHas('warehouse.country', function ($q) use ($search) {
                    //     $q->where('name', 'LIKE', "%$search%");
                    // })
                    // ->orWhereHas('warehouse.state', function ($q) use ($search) {
                    //     $q->where('name', 'LIKE', "%$search%");
                    // })
                    // ->orWhereHas('warehouse.city', function ($q) use ($search) {
                    //     $q->where('name', 'LIKE', "%$search%");
                    // });
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);
        $serialStart = ($currentPage - 1) * $perPage;
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
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
           'mobile_code' => 'required|digits:10|unique:users,phone',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'alternate_mobile_no' => 'nullable|max:13',
            'address_1' => 'required|string|max:255',
            'country' => 'required|string|exists:countries,id',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'required|string|max:10',
            'username' => 'required|string|max:255|unique:users,username',
            // 'password' => 'required|string|min:6|confirmed',
            // 'password_confirmation' => 'required|string',
            'latitude' => 'required|numeric', // Optional
            'longitude' => 'required|numeric', // Optional
            'country_code' => 'required',
            'country_code_2' => 'required|string',
            // 'signature_date' => 'nullable|date_format:m/d/Y',
            // 'license_expiry_date' => 'nullable|date_format:m/d/Y'

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
                'email'          => $validated['email'] ?? null,
                'phone'   => $validated['mobile_code'],
                'phone_2'      => $validated['alternate_mobile_no'] ?? null, // Optional Field
                'address'        => $validated['address_1'],
                'address_2'        => $request->Address_2,
                'country_id'     => $validated['country'],
                'state_id'       => $validated['state'],
                'city_id'        => $validated['city'],
                'pincode'            => $validated['Zip_code'],
                'password'       => Hash::make(1235678),
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
            $mobileNumber = $validated['mobile_code'];
            $password = 12345678;
            $loginUrl = route('login');

            // Send the email
            
            // Mail::to($email)->send(
            //     (new RegistorMail($userName, $email, $mobileNumber, $password, $loginUrl))
            //         ->from('no-reply@afrocargo.com', 'Afro Cargo')   
            //     );
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
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->where('status', 'Active')->get();
        $countries = Country::all();
        $page_no = $request->page;
        return view('admin.customer.edit', compact('user', 'roles', 'userRole', 'warehouses', 'countries', 'page_no'));
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
            'mobile_code' => 'required|digits:10',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $id,
            ],
            'alternate_mobile_no' => 'nullable',
            'address_1' => 'required|string|max:255',
            'country' => 'required|string|exists:countries,id',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'required|string|max:10',
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
            'phone'       => $validated['mobile_code'],
            'phone_2'     => $validated['alternate_mobile_no'] ?? null,
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
           // 'signup_type'    => 'for_admin'
        ];

        // 🔹 File Path Update
        if (!empty($imagePaths['signature_img'])) {
            $userData['signature_img'] = $imagePaths['signature_img'] ?? $user->signature_img;
        }

        if (!empty($userData['contract_signature_img'])) {
            $userData['contract_signature_img'] = $imagePaths['contract_signature_img'] ?? $user->contract_signature_img;
        }
        if (!empty($userData['license_document'])) {
            $userData['license_document'] = $imagePaths['license_document'] ?? $user->license_document;
        }
        if (!empty($userData['profile_pic'])) {
            $userData['profile_pic'] = $imagePaths['profile_pic'] ?? $user->profile_pic;
        }




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
