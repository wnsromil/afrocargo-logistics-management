<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    Warehouse,
    User,
    Role,
    Country
};
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WarehousemangerMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WarehouseManagerController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default is 10
        $currentPage = $request->input('page', 1);
        $warehouses = User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })
            ->with('warehouse')
            ->where('role_id', 2)
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('unique_id', 'LIKE', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                })
                    ->orWhereHas('warehouse', function ($query) use ($search) {
                        $query->where('warehouse_name', 'like', "%$search%"); // 🔹 Search by Warehouse Name
                    });
            })
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);
        $serialStart = ($currentPage - 1) * $perPage;
        if ($request->ajax()) {
            return view('admin.warehouse_manager.table', compact('warehouses', 'serialStart'));
        }

        return view('admin.warehouse_manager.index', compact('warehouses', 'serialStart', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $countries = Country::get();
        $warehouses = Warehouse::select('id', 'warehouse_name')->where('status', 'Active')->get();
        return view('admin.warehouse_manager.create', compact('roles', 'countries', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'warehouse_name' => 'required|exists:warehouses,id', // Ensure ID exists
            'manager_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'address_1' => 'required|string|max:500',
            'mobile_number' => 'required|string|max:15',
            'mobile_number_code_id' => 'required|exists:countries,id',
            'status' => 'nullable|in:Active,Inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $status = !empty($request->status) ? $request->status : 'Inactive';

        // Warehouse ki ID se warehouse_code nikalna
        $warehouse = Warehouse::find($request->warehouse_name);

        if (!$warehouse) {
            return redirect()->back()->with('error', 'Warehouse not found.');
        }

        $warehouse_code = $warehouse->warehouse_code; // Warehouse Code get karna
        $randomPassword = Str::random(8); // Random password of 8 characters
        $hashedPassword = Hash::make($randomPassword); // Hashing password
        // User Create
        $user = User::create([
            'warehouse_id' => $request->warehouse_name,
            'name' => $request->manager_name,
            'address' => $request->address_1,
            'country_id' => $request->country,
            'email' => $request->email,
            'password' => $hashedPassword,
            'phone' => $request->mobile_number,
            'phone_code_id'  => $request->mobile_number_code_id,
            'country_code' => +0,
            'status' => $status,
            'role_id' => 2,
            'role' => "warehouse_manager",
        ]);

        // Email Data Prepare Karna
        $manager_name = $request->manager_name;
        $email = $request->email;
        $mobileNumber = $request->mobile_number;
        $password = $randomPassword;
        $loginUrl = route('login');

        if (!empty($email)) {
            // Email Send Karna
            Mail::to($email)->send(new WarehousemangerMail($manager_name, $email, $mobileNumber, $password, $loginUrl, $warehouse_code));
        }


        return redirect()->route('admin.warehouse_manager.index')
            ->with('success', 'Manager created successfully.');
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

        return view('admin.warehouse_manager.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $manager_data = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $countries = Country::get();
        $warehouses = Warehouse::select('id', 'warehouse_name')->where('status', 'Active')->get();
        return view('admin.warehouse_manager.edit', compact('manager_data', 'roles', 'countries', 'warehouses'));
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

        // Custom validation rules
        $validator = Validator::make($request->all(), [
            'warehouse_name' => 'required',
            'manager_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id, // Ignore current user ID
            'address_1' => 'required|string|max:500',
            'mobile_number' => 'required|string|max:15',
            'mobile_number_code_id' => 'required|exists:countries,id',
            'status' => 'in:Active,Inactive',

        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)  // Send errors to the session
                ->withInput();  // Keep old input data
        }

        // Find the warehouse by ID
        $warehouse = User::find($id);

        // Update warehouse with validated data
        $warehouse->update([
            'warehouse_id' => $request->warehouse_name,
            'unique_id' => $request->unique_id,
            'name' => $request->manager_name,
            'address' => $request->address_1,
            'email' => $request->email,
             'phone' => $request->mobile_number,
            'phone_code_id'  => $request->mobile_number_code_id,
            'country_code' => +0,
            'status' => $request->status ?? 'Active', // Status ko handle karna
        ]);


        // Redirect to the warehouse index page with a success message
        return redirect()->route('admin.warehouse_manager.index')
            ->with('success', 'Manager updated successfully');
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
            $user->delete();
            return redirect()->route('admin.warehouse_manager.index')
                ->with('success', 'Manager marked as deleted successfully');
        }

        return redirect()->route('admin.warehouse_manager.index')
            ->with('error', 'Manager not found');
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
}
