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

class WarehouseController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default pagination
        $currentPage = $request->input('page', 1);
        $warehouses = Warehouse::with(['country', 'state', 'city']) // ✅ Include relationships
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('warehouse_name', 'like', "%$search%")
                        ->orWhere('warehouse_code', 'like', "%$search%")
                        ->orWhere('address', 'like', "%$search%")
                        ->orWhere('zip_code', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%")

                        ->orWhereHas('country', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        })
                        ->orWhereHas('state', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        })
                        ->orWhereHas('city', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        });
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);
        $serialStart = ($currentPage - 1) * $perPage;
        if ($request->ajax()) {
            return view('admin.warehouse.table', compact('warehouses', 'serialStart'))->render();
        }

        return view('admin.warehouse.index', compact('warehouses', 'serialStart', 'search', 'perPage'));
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
        return view('admin.warehouse.create', compact('roles', 'countries'));
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
            'warehouse_name' => 'required|string|max:255',
            'warehouse_code' => 'required|string|max:50|unique:warehouses,warehouse_code',
            'address_1' => 'required|string|max:500',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'nullable|string',
            'Zip_code' => 'nullable|string|max:20',
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

        $status  = !empty($request->status) ? $request->status : 'Active';
        // Store validated data
        Warehouse::create([
            'warehouse_name' => $request->warehouse_name,
            'warehouse_code' => $request->warehouse_code,
            'address' => $request->address_1,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'zip_code' => $request->Zip_code,
            'phone' => $request->mobile_number,
            'phone_code_id'  => $request->mobile_number_code_id,
            'country_code' => +0,
            'status' => $status,
            'lat' => $request->latitude,
            'long' => $request->longitude,
        ]);

        // Redirect with success message
        return redirect()->route('admin.warehouses.index')
            ->with('success', 'Warehouse created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warehouse = Warehouse::find($id);

        return view('admin.warehouse.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $countries = Country::get();

        return view('admin.warehouse.edit', compact('warehouse', 'roles', 'countries'));
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
            'warehouse_name' => 'string|max:255',
            'warehouse_code' => 'string|max:50|unique:warehouses,warehouse_code,' . $id,
            'address_1' => 'string|max:500',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'nullable|string',
            'Zip_code' => 'nullable|string|max:20',
            'mobile_number' => 'required|string|max:15',
            'mobile_number_code_id' => 'required|exists:countries,id',
            'status' => 'nullable|in:Active,Inactive',  // Nullable kiya
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the warehouse by ID
        $warehouse = Warehouse::find($id);



        // Update warehouse with validated data
        $warehouse->update([
            'warehouse_name' => $request->warehouse_name,
            'unique_id' => $request->unique_id,
            'warehouse_code' => $request->warehouse_code,
            'address' => $request->address_1,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'zip_code' => $request->Zip_code,
            'phone' => $request->mobile_number,
            'phone_code_id'  => $request->mobile_number_code_id,
            'country_code' => +0,
            'status' => $request->status ?? 'Active', // Default 'Inactive' agar request me na ho
        ]);

        // Redirect to the warehouse index page with a success message
        return redirect()->route('admin.warehouses.index')
            ->with('success', 'Warehouse updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warehouse::find($id)->delete();
        return redirect()->route('admin.warehouses.index')
            ->with('success', 'Warehouse deleted successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $driver = Warehouse::find($id);

        if ($driver) {
            $driver->status = $request->status; // 1 = Active, 0 = Deactive
            $driver->save();

            return response()->json(['success' => 'Status Updated Successfully']);
        }

        return response()->json(['error' => 'Driver Not Found']);
    }
}
