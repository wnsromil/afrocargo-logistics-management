<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Container,
    Warehouse,
    User,
    Role,
    Country,
    Vehicle
};
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->search;
        $perPage = $request->input('per_page', 10); // ✅ Default per_page 10
        $currentPage = $request->input('page', 1); // ✅ Current page number

        $vehicles = Vehicle::with(['driver', 'warehouse'])->where('vehicle_type', '!=', 'Container')
            ->withCount('parcelsCount')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->when($query, function ($q) use ($query) {
                return $q->where('vehicle_type', 'like', '%' . $query . '%')
                ->orWhere('unique_id', 'like', '%' . $query . '%')
                    ->orWhereHas('driver', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    })
                    ->orWhereHas('warehouse', function ($q) use ($query) {
                        $q->where('warehouse_name', 'like', '%' . $query . '%');
                    });
            })
            ->latest()
            ->paginate($perPage)
            ->appends(['search' => $query, 'per_page' => $perPage]); // ✅ URL parameters add karega

        // ✅ Serial number start point
        $serialStart = ($currentPage - 1) * $perPage;

        if ($request->ajax()) {
            return view('admin.vehicles.table', compact('vehicles', 'serialStart'))->render();
        }

        return view('admin.vehicles.index', compact('vehicles', 'query', 'perPage', 'serialStart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $vehicle = Vehicle::where('status', 'Active')->when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get();
        $warehouses = Warehouse::where('status', 'Active')->when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();
        $drivers = User::where('status', 'Active')->where('role_id', '=', '4')
            ->Where('is_deleted', 'no')->select('id', 'name')->get();
        return view('admin.vehicles.create', compact('vehicle', 'warehouses', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        // Base rules
        $rules = [
            'warehouse_name' => 'required|exists:warehouses,id',
            'vehicle_type'   => 'required|string|max:255',
            'vehicle_model'  => 'required|string|max:255',
            'vehicle_year'   => 'required|digits:4',
            'driver_id'      => 'nullable|integer',
        ];

        // Conditional rules
        if ($request->vehicle_type === 'Container') {
            $rules['container_no_1'] = 'required|string|max:100';
            $rules['container_no_2'] = 'required|string|max:100';
            $rules['container_size'] = 'nullable|string|max:50';
            $rules['seal_no']        = 'required|string|max:100';
        } else {
            $rules['vehicle_number'] = 'required|string|max:50|unique:vehicles,vehicle_number';
        }

        // Run validation
        $validator = Validator::make($request->all(), $rules);

        // Redirect back if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create and save vehicle
        $vehicle = new Vehicle();
        $vehicle->warehouse_id   = $request->warehouse_name;
        $vehicle->vehicle_type   = $request->vehicle_type;
        $vehicle->vehicle_number = $request->vehicle_number;
        $vehicle->vehicle_model  = $request->vehicle_model;
        $vehicle->vehicle_year   = $request->vehicle_year;
        $vehicle->driver_id      = $request->driver_id;
        $vehicle->status         = $request->status ?? 'Active';

        if ($request->vehicle_type == 'Container') {
            $vehicle->container_no_1  = $request->container_no_1;
            $vehicle->container_no_2  = $request->container_no_2;
            $vehicle->container_size  = $request->container_size;
            $vehicle->seal_no         = $request->seal_no;
        }

        $vehicle->save();
        return redirect()->route('admin.vehicle.index')->with('success', 'Vehicle added successfully.');

        // if($request->vehicle_type === 'Container'){
        //     return redirect()->route('admin.container.index')->with('success', 'Container added successfully.');
        // }else{
        //     return redirect()->route('admin.vehicle.index')->with('success', 'Vehicle added successfully.');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::where('id', $id)->first();

        return view('admin.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $vehicle = Vehicle::where('id', $id)->first();
        $drivers = User::where('role_id', '=', '4')->get();

        $warehouses = Warehouse::where('status', 'Active')->when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        return view('admin.vehicles.edit', compact('vehicle', 'warehouses', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $request->validate([
            'warehouse_id'    => 'nullable|exists:warehouses,id',
            'vehicle_number'  => 'required|string|max:50|unique:vehicles,vehicle_number,' . $id,  // Exclude the current record's vehicle_number
            'vehicle_model'   => 'nullable|string|max:255',
            'vehicle_year'    => 'nullable|digits:4',
            'driver_id'    => 'nullable|integer',
            'status'          => 'in:Active,Inactive',
        ]);

        // Update the vehicle record
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update([
            'warehouse_id'    => $request->warehouse_id,
            'vehicle_number'  => $request->vehicle_number,
            'vehicle_model'   => $request->vehicle_model,
            'vehicle_year'    => $request->vehicle_year,
            'driver_id'       => $request->driver_id,
            'status'          => $request->status ?? 'Active',
        ]);

        // Redirect back with success message
        return redirect()->route('admin.vehicle.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Vehicle::find($id)->delete();
        return redirect()->route('admin.vehicle.index')
            ->with('success', 'Vehicle deleted successfully');
    }


    public function changeStatus(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle) {
            $vehicle->status = $request->status;
            $vehicle->save();

            return response()->json(['success' => 'Status Updated Successfully']);
        }

        return response()->json(['error' => 'Vehicle Not Found']);
    }
}
