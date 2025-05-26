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
    Vehicle,
    VehicleType
};
use Carbon\Carbon;
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

        $vehicles = Vehicle::with(['driver', 'warehouse'])->where('vehicle_type', '!=', '1')
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
        // ✅ Base validation rules
        $rules = [
            'warehouse_name' => 'required|exists:warehouses,id',
            'vehicle_type'   => 'required|string|max:255',
            'vehicle_model'  => 'required|string|max:255',
            'vehicle_year'   => 'required|digits:4',
            'driver_id'      => 'nullable|integer',
            'license_expiry_date'      => 'required',
            'licence_plate_number'      => 'required',
            'vehicle_number' => 'required|string|max:50|unique:vehicles,vehicle_number',

            // ✅ Document validations
            'vehicle_registration_doc'         => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'vehicle_insurance_doc'             => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',

        ];

        // ✅ Run validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ✅ Find or Create Vehicle Type
        $vehicleType = VehicleType::firstOrCreate(
            ['name' => $request->vehicle_type],
            ['status' => 'Active']
        );

        // ✅ Save basic vehicle data
        $vehicle = new Vehicle();
        $vehicle->warehouse_id   = $request->warehouse_name;
        $vehicle->vehicle_type   = $vehicleType->id;
        $vehicle->vehicle_number = $request->vehicle_number;
        $vehicle->vehicle_model  = $request->vehicle_model;
        $vehicle->vehicle_year   = $request->vehicle_year;
        $vehicle->driver_id      = $request->driver_id;
        $vehicle->licence_plate_exp_date      = Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d');
        $vehicle->licence_plate_number      = $request->licence_plate_number;
        $vehicle->status         = $request->status ?? 'Active';

        // ✅ Handle image uploads
        $imageFields = [
            'vehicle_registration_doc',
            'vehicle_insurance_doc',
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads/customer', $fileName, 'public');

                // ✅ Save path in vehicle model (you need to have these columns in your DB table)
                $vehicle->{$field} = 'uploads/customer/' . $fileName;
            }
        }

        $vehicle->save();

        return redirect()->route('admin.vehicle.index')->with('success', 'Vehicle added successfully.');
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
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        // ✅ Check if images are marked for deletion
        $deleteRegistration = $request->input('vehicle_registration_doc_delete_img') == "1";
        $deleteInsurance = $request->input('vehicle_insurance_doc_delete_img') == "1";

        // ✅ Set validation rules dynamically
        $rules = [
            'warehouse_id' => 'required|exists:warehouses,id',
            'vehicle_type'   => 'required|string|max:255',
            'vehicle_model'  => 'required|string|max:255',
            'vehicle_year'   => 'required|digits:4',
            'driver_id'      => 'nullable|integer',
          //  'license_expiry_date' => 'required',
            'licence_plate_number' => 'required',
            'vehicle_number' => 'required|string|max:50|unique:vehicles,vehicle_number,' . $vehicle->id,
        ];

        // ✅ Conditional file validations
        if ($deleteRegistration && !$request->hasFile('vehicle_registration_doc')) {
            $rules['vehicle_registration_doc'] = 'required|file|mimes:jpeg,png,jpg,pdf|max:2048';
        } else {
            $rules['vehicle_registration_doc'] = 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048';
        }

        if ($deleteInsurance && !$request->hasFile('vehicle_insurance_doc')) {
            $rules['vehicle_insurance_doc'] = 'required|file|mimes:jpeg,png,jpg,pdf|max:2048';
        } else {
            $rules['vehicle_insurance_doc'] = 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048';
        }

        // ✅ Validate request
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ✅ Vehicle type update
        $vehicleType = VehicleType::firstOrCreate(
            ['name' => $request->vehicle_type],
            ['status' => 'Active']
        );

        $vehicle->warehouse_id = $request->warehouse_id;
        $vehicle->vehicle_type = $vehicleType->id;
        $vehicle->vehicle_number = $request->vehicle_number;
        $vehicle->vehicle_model = $request->vehicle_model;
        $vehicle->vehicle_year = $request->vehicle_year;
        $vehicle->driver_id = $request->driver_id;
       if ($request->filled('license_expiry_date')) {
       $vehicle->licence_plate_exp_date = Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d');
       }
        $vehicle->licence_plate_number = $request->licence_plate_number;
        $vehicle->status = $request->status ?? $vehicle->status;

        // ✅ Handle deletion and upload of documents
        $imageFields = [
            'vehicle_registration_doc' => $deleteRegistration,
            'vehicle_insurance_doc' => $deleteInsurance,
        ];

        foreach ($imageFields as $field => $shouldDelete) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads/customer', $fileName, 'public');
                $vehicle->{$field} = 'uploads/customer/' . $fileName;
            }
        }

        $vehicle->save();

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
