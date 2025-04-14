<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    Warehouse,
    User,
    Role,
    Country,
    Vehicle
};
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\DriverMail;


class DriversController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = $request->search;
        $perPage = $request->input('per_page', 10); // ✅ Default per_page 10
        $currentPage = $request->input('page', 1); // ✅ Current page number
    
        $warehouses = User::when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->where('role_id', 4)
            ->when($query, function ($q) use ($query) {
                return $q->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%$query%")
                        ->orWhere('email', 'LIKE', "%$query%")
                        ->orWhere('phone', 'LIKE', "%$query%")
                        ->orWhere('address', 'LIKE', "%$query%")
                        ->orWhere('status', 'LIKE', "%$query%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->appends(['search' => $query, 'per_page' => $perPage]);
    
        // ✅ Serial number start point
        $serialStart = ($currentPage - 1) * $perPage;
    
        if ($request->ajax()) {
            return view('admin.drivers.table', compact('warehouses', 'serialStart'))->render();
        }
    
        return view('admin.drivers.index', compact('warehouses', 'query', 'perPage', 'serialStart'));
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
        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->select('id', 'warehouse_name')->get();
        $Vehicle_data = Vehicle::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->select('id', 'vehicle_type','vehicle_number','container_no_1')->get();
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
        $validated = $request->validate([
            'warehouse_name' => 'required',
            'driver_name' => 'required|string',
            'mobile_code' => 'required|string|max:15|unique:users,phone',
            'address' => 'required|string|max:500',
            'email' => 'required|email|unique:users,email',
            'vehicle_type' => 'required',
            'license_number' => 'required',
            'license_document' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'license_expiry_date' => 'required',
            'status' => 'in:Active,Inactive',
            'country_code' => 'required|string',
        ]);
       
        $status  = !empty($request->status) ? $request->status : 'Inactive';

        // Handle License Document Upload
        $licenseDocumentPath = null;
        if ($request->hasFile('license_document')) {
            $file = $request->file('license_document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/licenses', $filename, 'public'); // Store in 'storage/app/public/uploads/licenses'
            $licenseDocumentPath = 'storage/' . $filePath; // Get full URL
        }
  
        $randomPassword = Str::random(8); // Random password of 8 characters
        $hashedPassword = Hash::make($randomPassword); // Hashing password

        // Store validated data
        $driver = User::create([
            'warehouse_id' => $request->warehouse_name,
            'vehicle_id' => $request->vehicle_type,
            'name' => $request->driver_name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->mobile_code,
            'status' => $status,
            'role_id' => 4,
            'role' => "driver",
            'password' => $hashedPassword,
            'country_code' => $request->country_code,
            'license_number' => $request->license_number,
            'license_expiry_date' => Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d'),
            'license_document' => $licenseDocumentPath,
        ]);

        Vehicle::where('id', $request->vehicle_type)->update([
            'driver_id' => $driver->id,
        ]);

        $driver_name = $request->driver_name;
        $email = $request->email;
        $mobileNumber = $request->mobile_code;
        $password = $randomPassword;
        $loginUrl = route('login');

        if (!empty($email)) {
            // Email Send Karna
            Mail::to($email)->send(new DriverMail($driver_name, $email, $mobileNumber, $password, $loginUrl));
        }

        // Redirect with success message
        return redirect()->route('admin.drivers.index')
            ->with('success', 'Driver created successfully.');
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


    public function schedule($id)
    {
        $user = User::find($id);

        return view('admin.drivers.schedule', compact('user'));
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
        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->select('id', 'warehouse_name')->get();
        $Vehicle_data = Vehicle::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->select('id', 'vehicle_type')->get();
        return view('admin.drivers.edit', compact('manager_data', 'roles', 'countries', 'warehouses', 'Vehicle_data'));
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
            'driver_name' => 'required|string',
            'edit_mobile_code' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'country_code' => 'required|string',
            // 'vehicle_type' => 'required',
            // 'email' => 'nullable|email|unique:users,email,' . $id, // Ignore current user ID
            // 'license_number' => 'required',
            // 'license_document' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            // 'license_expiry_date' => 'required',
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
            'phone' => $request->edit_mobile_code,
            'license_number' => $request->license_number,
            'license_expiry_date' => $request->license_expiry_date,
            // 'license_document' => $licenseDocumentPath, // Store Image URL
            'status' => $request->status, // Status ko handle karna
            'country_code' => $request->country_code,
        ]);


        // Redirect to the warehouse index page with a success message
        return redirect()->route('admin.drivers.index')
            ->with('success', 'Driver updated successfully');
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
