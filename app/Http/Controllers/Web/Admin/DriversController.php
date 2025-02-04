<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    Warehouse,
    User,
    Role,
    Country,
    Vehicle
};
use DB;

class DriversController extends Controller
{
    //
    public function index()
    {
        $warehouses = User::where('role_id', 4)->paginate(10);
        return view('admin.drivers.index', compact('warehouses'));
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
        $warehouses = Warehouse::select('id', 'warehouse_name')->get();
        $Vehicle_data = Vehicle::select('id', 'vehicle_type')->get();
        return view('admin.drivers.create', compact('roles', 'countries', 'warehouses', 'Vehicle_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'warehouse_name' => 'required',
            'vehicle_type' => 'required',
            'license_number' => 'required',
            'license_document' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'license_expiry_date' => 'required',
            'driver_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'confirm-password' => 'required',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:15|unique:users,phone',
            'status' => 'in:Active,Inactive',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $status  = !empty($request->status) ? $request->status : 'Inactive';

        // Handle License Document Upload
        $licenseDocumentPath = null;
        if ($request->hasFile('license_document')) {
            $file = $request->file('license_document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/licenses', $filename, 'public'); // Store in 'storage/app/public/uploads/licenses'
            $licenseDocumentPath = asset('storage/' . $filePath); // Get full URL
        }

        // Store validated data
        User::create([
            'warehouse_id' => $request->warehouse_name,
            'vehicle_id' => $request->vehicle_type,
            'name' => $request->driver_name,
            'address' => $request->address,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'status' => $status,
            'role_id' => 4,
            'role' => "driver",
            'license_number' => $request->license_number,
            'license_expiry_date' => $request->license_expiry_date,
            'license_document' => $licenseDocumentPath, // Store Image URL
        ]);

        // Redirect with success message
        return redirect()->route('admin.drivers.index')
            ->with('success', 'Drivers created successfully.');
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

        return view('admin.drivers.show', compact('user'));
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
        $warehouses = Warehouse::select('id', 'warehouse_name')->get();
        $Vehicle_data = Vehicle::select('id', 'vehicle_type')->get();
        return view('admin.drivers.edit', compact('manager_data', 'roles', 'countries', 'warehouses','Vehicle_data'));
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
            'vehicle_type' => 'required',
            'driver_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id, // Ignore current user ID
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:15',
            'license_number' => 'required',
            // 'license_document' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'license_expiry_date' => 'required',
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
            'vehicle_id' => $request->vehicle_type,
            'name' => $request->driver_name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'license_number' => $request->license_number,
            'license_expiry_date' => $request->license_expiry_date,
            // 'license_document' => $licenseDocumentPath, // Store Image URL
            'status' => $request->status, // Status ko handle karna
        ]);


        // Redirect to the warehouse index page with a success message
        return redirect()->route('admin.drivers.index')
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
            $user->update(['is_deleted' => 'Yes']); // is_deleted ko 'Yes' update karna
            return redirect()->route('admin.drivers.index')
                ->with('success', 'Manager marked as deleted successfully');
        }

        return redirect()->route('admin.drivers.index')
            ->with('error', 'Manager not found');
    }
}
