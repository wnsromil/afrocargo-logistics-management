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
    Vehicle,
    ContainerSize,
    TruckingCompany
};
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
        $status_search = $request->input('status_search');
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
            ->when($status_search, fn($q) => $q->where('container_status', $status_search))
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

        $containerSizes = ContainerSize::take(2)->get(['id', 'container_name', 'volume']);

        return view('admin.container.create', compact('vehicle', 'warehouses', 'drivers', 'containerSizes'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Base rules
        $rules = [
            'warehouse_name' => 'required|exists:warehouses,id',
            'container_no_1' => 'required|string|max:100',
            'container_size' => 'required|string|max:50',
            'seal_no' => 'required|string|max:100',
            'booking_number' => 'required|string|max:100',
            'bill_of_lading' => 'required|string|max:100',
            'broker' => 'required|string|max:100',
            'ship_to_country' => 'required|string|max:100',
            'doc_id' => 'required|string|max:100',
            'company_for_container' => 'required|string|max:100',
            // 'container_date_time' => 'required|string',
            'trucking_company' => 'required|string',
            'chassis_number' => 'required|string',

            'gate_in_driver_id'     => 'nullable|integer|exists:users,id',
            'gate_out_driver_id'    => 'nullable|integer|exists:users,id',
            'port_of_loading'       => 'required|string|max:255',
            'port_of_discharge'     => 'required|string|max:255',
            'celliling_date'        => 'required|date',
            'eta_date'              => 'required|date',
            'transit_country'       => 'required|string|max:255',
        ];

        $messages = [
            'warehouse_name.required' => 'The warehouse field is required.',
            'warehouse_name.exists'   => 'The selected warehouse is invalid.',
            //'container_date_time.date_format' => 'Date/Time format must be like 5/30/2025 06:00 AM',
            'eta_date.required' => 'The ETA date field is required.',
            'transit_country.required' => 'The transit field is required.',
            'company_for_container.required' => 'Shipping line field is required.',
        ];

        // Run validation
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $containerInDate = null;
        $containerInTime = null;

        // Parse container date and time
        if ($request->container_date_time) {
            $dateTime = \Carbon\Carbon::createFromFormat('m/d/Y h:i A', $request->container_date_time);
            $containerInDate = $dateTime->format('Y-m-d');
            $containerInTime = $dateTime->format('H:i:s');
        }


        // Create broker and container company if not exist
        $broker = Broker::firstOrCreate(
            ['name' => $request->broker],
            ['status' => 'Active']
        );

        $containerCompany = ContainerCompany::firstOrCreate(
            ['name' => $request->company_for_container],
            ['status' => 'Active']
        );

        $truckingCompany = TruckingCompany::firstOrCreate(
            ['name' => $request->trucking_company],
            ['status' => 'Active']
        );


        // Create and save vehicle
        $vehicleStore = new Vehicle();
        $vehicleStore->warehouse_id   = $request->warehouse_name;
        $vehicleStore->vehicle_type   = '1';
        $vehicleStore->vehicle_number = $request->vehicle_number;
        $vehicleStore->status         = 'Inactive';
        $vehicleStore->container_no_1 = $request->container_no_1;
        $vehicleStore->container_size = $request->container_size;
        $vehicleStore->seal_no        = $request->seal_no;
        $vehicleStore->booking_number = $request->booking_number;
        $vehicleStore->bill_of_lading = $request->bill_of_lading;
        $vehicleStore->broker         = $broker->id;
        $vehicleStore->ship_to_country = $request->ship_to_country;
        $vehicleStore->doc_id         = $request->doc_id;
        $vehicleStore->volume         = $request->volume;
        $vehicleStore->container_company_id = $containerCompany->id;
        $vehicleStore->trucking_company = $truckingCompany->id;
        $vehicleStore->chassis_number = $request->chassis_number;
        $vehicleStore->vessel_voyage = $request->vessel_voyage;
        $vehicleStore->tir_number = $request->tir_number;
        $vehicleStore->container_in_date = $containerInDate;
        $vehicleStore->container_in_time = $containerInTime;
        $vehicleStore->gate_in_driver_id = $request->gate_in_driver_id ?? null;
        $vehicleStore->gate_out_driver_id = $request->gate_out_driver_id ?? null;
        $vehicleStore->port_of_loading = $request->port_of_loading;
        $vehicleStore->port_of_discharge = $request->port_of_discharge;
        $vehicleStore->celliling_date = Carbon::createFromFormat('m/d/Y', $request->celliling_date)->format('Y-m-d');
        $vehicleStore->eta_date = Carbon::createFromFormat('m/d/Y', $request->eta_date)->format('Y-m-d');
        $vehicleStore->transit_country = $request->transit_country;
        $vehicleStore->save();

        $insertedId = $vehicleStore->id;
        $vehicle = Vehicle::find($insertedId);

        return redirect()->route('admin.container.show', ['container' => $vehicle->id])->with('success', 'Container added successfully.');
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

        $containerSizes = ContainerSize::take(2)->get(['id', 'container_name', 'volume']);

        return view('admin.container.edit', compact('vehicle', 'warehouses', 'drivers', 'containerSizes'));
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
            'ship_to_country' => 'required|string|max:100',
            'doc_id' => 'required|string|max:100',
            'company_for_container' => 'required|string|max:100',
            //'edit_container_date_time' => 'required|string',
            'trucking_company' => 'required|string',
            'chassis_number' => 'required|string',
            'vessel_voyage' => 'required|string',
            'gate_in_driver_id'     => 'nullable|integer|exists:users,id',
            'gate_out_driver_id'    => 'nullable|integer|exists:users,id',
            'port_of_loading'       => 'required|string|max:255',
            'port_of_discharge'     => 'required|string|max:255',
            'edit_celliling_date'        => 'required|date',
            'edit_eta_date'              => 'required|date',
            'transit_country'       => 'required|string|max:255',
        ];

        $messages = [
            'warehouse_name.required' => 'The warehouse field is required.',
            'warehouse_name.exists'   => 'The selected warehouse is invalid.',
            'company_for_container.required' => 'Shipping line field is required.',
            //   'edit_container_date_time.date_format' => 'Date/Time format must be like 5/30/2025 06:00 AM'
            'edit_eta_date.required' => 'The ETA date field is required.',
            'transit_country.required' => 'The transit field is required.',
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

        $truckingCompany = TruckingCompany::firstOrCreate(
            ['name' => $request->trucking_company],
            ['status' => 'Active']
        );

        $containerInDate = null;
        $containerInTime = null;

        // Parse container date and time
        // if ($request->edit_container_date_time) {
        //     $dateTime = \Carbon\Carbon::createFromFormat('m/d/Y h:i A', $request->edit_container_date_time);
        //     $containerInDate = $dateTime->format('Y-m-d');
        //     $containerInTime = $dateTime->format('H:i:s');
        // }

        // Update the vehicle record
        $vehicle->warehouse_id   = $request->warehouse_name;
        $vehicle->vehicle_type   = '1';
        $vehicle->vehicle_number = $request->vehicle_number;
        $vehicle->status         = 'Inactive';
        $vehicle->container_no_1 = $request->container_no_1;
        $vehicle->container_size = $request->container_size;
        $vehicle->seal_no        = $request->seal_no;
        $vehicle->booking_number = $request->booking_number;
        $vehicle->bill_of_lading = $request->bill_of_lading;
        $vehicle->broker         = $broker->id;
        $vehicle->ship_to_country = $request->ship_to_country;
        $vehicle->doc_id         = $request->doc_id;
        $vehicle->volume         = $request->volume;
        $vehicle->container_company_id = $containerCompany->id;
        $vehicle->trucking_company = $truckingCompany->id;
        $vehicle->chassis_number = $request->chassis_number;
        $vehicle->vessel_voyage = $request->vessel_voyage;
        $vehicle->tir_number = $request->tir_number;
        // $vehicle->container_in_date = $containerInDate;
        // $vehicle->container_in_time = $containerInTime;
        $vehicle->gate_in_driver_id = $request->gate_in_driver_id ?? null;
        $vehicle->gate_out_driver_id = $request->gate_out_driver_id ?? null;
        $vehicle->port_of_loading = $request->port_of_loading;
        $vehicle->port_of_discharge = $request->port_of_discharge;
        $vehicle->celliling_date = Carbon::createFromFormat('m/d/Y', $request->edit_celliling_date)->format('Y-m-d');
        $vehicle->eta_date = Carbon::createFromFormat('m/d/Y', $request->edit_eta_date)->format('Y-m-d');
        $vehicle->transit_country = $request->transit_country;
        $vehicle->save();

        return redirect()->route('admin.container.show', ['container' => $id])->with('success', 'Container added successfully.');
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
