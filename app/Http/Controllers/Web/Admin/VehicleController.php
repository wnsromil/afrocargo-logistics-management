<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Warehouse,
    User,
    Role,
    Country,
    Vehicle
};

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vehicles = Vehicle::paginate(10);
        return view('admin.vehicles.index',compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $vehicle = Vehicle::get();
        $warehouses = Warehouse::get();
        return view('admin.vehicles.create',compact('vehicle','warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'warehouse_id'    => 'required|exists:warehouses,id',
            'vehicle_type'    => 'required|string|max:255',
            'vehicle_number'  => 'required|string|max:50|unique:vehicles,vehicle_number',
            'vehicle_model'   => 'required|string|max:255',
            'vehicle_year'    => 'required|digits:4',
            'vehicle_capacity'=> 'nullable|string|max:100',
            'status'          => 'in:Active,Inactive',
        ]);
    
        // Create a new vehicle
        Vehicle::create([
            'warehouse_id'    => $request->warehouse_id,
            'vehicle_type'    => $request->vehicle_type,
            'vehicle_number'  => $request->vehicle_number,
            'vehicle_model'   => $request->vehicle_model,
            'vehicle_year'    => $request->vehicle_year,
            'vehicle_capacity'=> $request->vehicle_capacity,
            'status'          => $request->status ?? 'Inactive',
        ]);
    
        // Redirect back with success message
        return redirect()->route('admin.vehicle.index')->with('success', 'Vehicle added successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::where('id',$id)->first();

        return view('admin.vehicles.show',compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $vehicle = Vehicle::where('id',$id)->first();
        $warehouses = Warehouse::get();
    
        return view('admin.vehicles.edit',compact('vehicle','warehouses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $request->validate([
            'warehouse_id'    => 'nullable|exists:warehouses,id',
            'vehicle_type'    => 'required|string|max:255',
            'vehicle_number'  => 'required|string|max:50|unique:vehicles,vehicle_number,' . $id,  // Exclude the current record's vehicle_number
            'vehicle_model'   => 'nullable|string|max:255',
            'vehicle_year'    => 'nullable|digits:4',
            'vehicle_capacity'=> 'nullable|string|max:100',
            'status'          => 'in:Active,Inactive',
        ]);

        // Update the vehicle record
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update([
            'warehouse_id'    => $request->warehouse_id,
            'vehicle_type'    => $request->vehicle_type,
            'vehicle_number'  => $request->vehicle_number,
            'vehicle_model'   => $request->vehicle_model,
            'vehicle_year'    => $request->vehicle_year,
            'vehicle_capacity'=> $request->vehicle_capacity,
            'status'          => $request->status ?? 'Inactive',
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
                        ->with('success','Vehicle deleted successfully');
    }
}
