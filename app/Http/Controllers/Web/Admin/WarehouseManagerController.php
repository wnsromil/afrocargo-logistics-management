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

class WarehouseManagerController extends Controller
{
    //
    public function index()
    {
        $warehouses = User::when($this->user->role_id!=1,function($q){
            return $q->where('warehouse_id',$this->user->warehouse_id);
        })->where('role_id', 2)->paginate(10);
        return view('admin.warehouse_manager.index', compact('warehouses'));
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
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:warehouse,email',
        //     'password' => 'required|same:confirm-password',
        //     'roles' => 'required'
        // ]);

        // Validation rules
        $validator = Validator::make($request->all(), [
            'warehouse_name' => 'required',
            'manager_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'confirm-password' => 'required',
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

        $status  = !empty($request->status) ? $request->status : 'Inactive';

        // Store validated data
        User::create([
            'warehouse_id' => $request->warehouse_name,
            'name' => $request->manager_name,
            'address' => $request->address,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'status' => $status,
            'role_id' => 2,
            'role' => "warehouse_manager",
        ]);

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
            'status' => $request->status, // Status ko handle karna
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
