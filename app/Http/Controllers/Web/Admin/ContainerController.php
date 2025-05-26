<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Broker,
    Container,
    ContainerCompany,
    Warehouse,
    User,
    Role,
    Country,
    Vehicle
};
use Illuminate\Support\Facades\Validator;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->search;
        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);

        $openDateRange = $request->input('open_date');
        $closeDateRange = $request->input('close_date');
        $warehouseId = $request->input('warehouse_id');

        $vehicles = Vehicle::with(['driver', 'warehouse'])
            ->where('vehicle_type', '1')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->when($warehouseId, function ($q) use ($warehouseId) {
                return $q->where('warehouse_id', $warehouseId);
            })
            ->when($query, function ($q) use ($query) {
                return $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('container_no_1', 'like', '%' . $query . '%')
                        ->orWhere('unique_id', 'like', '%' . $query . '%')
                        ->orWhere('container_no_2', 'like', '%' . $query . '%')
                        ->orWhere('seal_no', 'like', '%' . $query . '%')
                        ->orWhereHas('driver', function ($q) use ($query) {
                            $q->where('name', 'like', '%' . $query . '%');
                        })
                        ->orWhereHas('warehouse', function ($q) use ($query) {
                            $q->where('warehouse_name', 'like', '%' . $query . '%');
                        });
                });
            })
            ->when($openDateRange, function ($q) use ($openDateRange) {
                [$start, $end] = explode(' - ', $openDateRange);
                $q->whereBetween('open_date', [
                    \Carbon\Carbon::createFromFormat('m/d/Y', trim($start))->format('Y-m-d'),
                    \Carbon\Carbon::createFromFormat('m/d/Y', trim($end))->format('Y-m-d')
                ]);
            })
            ->when($closeDateRange, function ($q) use ($closeDateRange) {
                [$start, $end] = explode(' - ', $closeDateRange);
                $q->whereBetween('close_date', [
                    \Carbon\Carbon::createFromFormat('m/d/Y', trim($start))->format('Y-m-d'),
                    \Carbon\Carbon::createFromFormat('m/d/Y', trim($end))->format('Y-m-d')
                ]);
            })
            ->latest()
            ->paginate($perPage)
            ->appends($request->all());

        $serialStart = ($currentPage - 1) * $perPage;

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->get();

        if ($request->ajax()) {
            return view('admin.container.table', compact('warehouses', 'vehicles', 'serialStart'))->render();
        }

        return view('admin.container.index', compact('warehouses', 'vehicles', 'query', 'perPage', 'serialStart'));
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
        })->where('status', 'Active')->get();
        $drivers = User::where('status', 'Active')->where('role_id', '=', '4')
            ->Where('is_deleted', 'no')->select('id', 'name')->get();
        return view('admin.container.create', compact('vehicle', 'warehouses', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        // Base rules
        $rules = [
            'warehouse_name' => 'required|exists:warehouses,id',
            'container_no_1'      => 'required|string|max:100',
            'container_size'      => 'required|string|max:50',
            'seal_no'      => 'required|string|max:100',
            'booking_number'      => 'required|string|max:100',
            'bill_of_lading'      => 'required|string|max:100',
            'broker'      => 'required||string|max:100',
            'ship_to_country'      => 'required|string|max:100',
            'doc_id'      => 'required|string|max:100',
            // 'volume'      => 'required|string|max:100',
            'company_for_container'      => 'required||string|max:100'
        ];

        $messages = [
            'warehouse_name.required' => 'The warehouse field is required.',
            'warehouse_name.exists'   => 'The selected warehouse is invalid.',
        ];
        // Run validation
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $broker = Broker::firstOrCreate(
            ['name' => $request->broker],
            ['status' => 'Active'] // optional default status
        );

        $containerCompany = ContainerCompany::firstOrCreate(
            ['name' => $request->company_for_container],
            ['status' => 'Active'] // optional default status
        );
        // Create and save vehicle
        $vehicle = new Vehicle();
        $vehicle->warehouse_id   = $request->warehouse_name;
        $vehicle->vehicle_type   = '1';
        $vehicle->vehicle_number = $request->vehicle_number;
        $vehicle->status         = 'Inactive';
        $vehicle->container_no_1  = $request->container_no_1;
        $vehicle->container_size  = $request->container_size;
        $vehicle->seal_no         = $request->seal_no;
        $vehicle->booking_number         = $request->booking_number;
        $vehicle->bill_of_lading         = $request->bill_of_lading;
        $vehicle->broker         = $broker->id;
        $vehicle->ship_to_country         = $request->ship_to_country;
        $vehicle->doc_id         = $request->doc_id;
        $vehicle->volume         = $request->volume;
        $vehicle->container_company_id         = $containerCompany->id;
        $vehicle->save();
        return redirect()->route('admin.container.index')->with('success', 'Container added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::where('id', $id)->first();

        return view('admin.container.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $vehicle = Vehicle::where('id', $id)->first();
        $drivers = User::where('role_id', '=', '4')->get();

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->where('status', 'Active')->get();

        return view('admin.container.edit', compact('vehicle', 'warehouses', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the existing vehicle record
        $vehicle = Vehicle::findOrFail($id);

        // Validation rules
        $rules = [
            'warehouse_name' => 'required|exists:warehouses,id',
            'container_no_1' => 'required|string|max:100',
            'container_size' => 'required|string|max:50',
            'seal_no' => 'required|string|max:100',
            'booking_number' => 'required|string|max:100',
            'bill_of_lading' => 'required|string|max:100',
            'broker' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'doc_id' => 'required|string|max:100',
            // 'volume' => 'required|string|max:100', // uncomment if required
            'company_for_container' => 'required|string|max:100'
        ];

        $messages = [
            'warehouse_name.required' => 'The warehouse field is required.',
            'warehouse_name.exists'   => 'The selected warehouse is invalid.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create or find broker
        $broker = Broker::firstOrCreate(
            ['name' => $request->broker],
            ['status' => 'Active']
        );

        // Create or find container company
        $containerCompany = ContainerCompany::firstOrCreate(
            ['name' => $request->company_for_container],
            ['status' => 'Active']
        );

        // Update the vehicle record
        $vehicle->warehouse_id = $request->warehouse_name;
        $vehicle->vehicle_type = '1';
        $vehicle->vehicle_number = $request->vehicle_number;
        $vehicle->status = 'Inactive'; // or keep previous status if needed
        $vehicle->container_no_1 = $request->container_no_1;
        $vehicle->container_size = $request->container_size;
        $vehicle->seal_no = $request->seal_no;
        $vehicle->booking_number = $request->booking_number;
        $vehicle->bill_of_lading = $request->bill_of_lading;
        $vehicle->broker = $broker->id;
        $vehicle->ship_to_country = $request->country;
        $vehicle->doc_id = $request->doc_id;
        $vehicle->volume = $request->volume;
        $vehicle->container_company_id = $containerCompany->id;

        $vehicle->save();

        return redirect()->route('admin.container.index')->with('success', 'Container updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Vehicle::find($id)->delete();
        return redirect()->route('admin.container.index')
            ->with('success', 'Container deleted successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle) {
            $vehicle->status = $request->status;
            $vehicle->save();

            return response()->json(['success' => 'Status Updated Successfully']);
        }

        return response()->json(['error' => 'Container Not Found']);
    }
}
