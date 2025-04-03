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
use App\Mail\RegistorMail;


class WarehouseManagerController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default is 10

        $warehouses = User::when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->with('warehouse')
            ->where('role_id', 2)
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
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

        if ($request->ajax()) {
            return view('admin.warehouse_manager.table', compact('warehouses'));
        }

        return view('admin.warehouse_manager.index', compact('warehouses', 'search', 'perPage'));
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
            'warehouse_name' => 'required',
            'manager_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:15|unique:users,phone',
            'status' => 'nullable|in:Active,Inactive',
            'country_code' => 'required|string',
        ]);
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)  // Send errors to the session
                ->withInput();  // Keep old input data
        }

        $status  = !empty($request->status) ? $request->status : 'Inactive';

        // Store validated data
        User::create([
            'warehouse_id' => $request->warehouse_name,
            'name' => $request->manager_name,
            'address' => $request->address,
            'email' => $request->email,
            'password' => \Hash::make('12345678'),
            'phone' => $request->phone,
            'country_code' => $request->country_code,
            'status' => $request->status ?? 'Active',
            'role_id' => 2,
            'role' => "warehouse_manager",
            
        ]);

        // Example dynamic data
        $userName = $request->warehouse_name ?? null;
        $email = $request->email ?? null;
        $mobileNumber = $request->phone ?? null;
        $password = '12345678';
        $loginUrl = route('login');

         if(!empty($email)){
            // Send the email
            Mail::to($email)->send(new RegistorMail($userName, $email, $mobileNumber, $password,$loginUrl));
         }
         

        // Redirect with success message
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
        $warehouses = Warehouse::select('id', 'warehouse_name')->get();
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
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:15',
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
            'name' => $request->manager_name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
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
}
