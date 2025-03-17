<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{
    User,
    Category,
    Warehouse,
    Stock,
    Inventory,
    Parcel,
    Vehicle,
    ParcelHistory,
    HubTracking
};

class OrderShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $parcels = Parcel::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->latest()->paginate(10);
        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $drivers = $user->where('role_id', 4)->values();
        return view('admin.OrderShipment.index', compact('parcels', 'drivers', 'warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $customers = $user->where('role_id', 3)->values();

        $drivers = $user->where('role_id', 4)->values();

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();


        return view('admin.OrderShipment.create', compact('warehouses', 'customers', 'drivers', 'parcelTpyes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        // Validate incoming request data
        $validatedData = $request->validate([
            'tracking_number' => 'required|string|max:255|unique:parcels,tracking_number',
            'customer_id' => 'required|exists:users,id',
            'driver_id' => 'nullable|exists:users,id',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'weight' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'partial_payment' => 'required|numeric|min:0',
            'remaining_payment' => 'required|numeric|min:0',
            'payment_type' => 'required|in:COD,Online',
            'descriptions' => 'nullable|string',
            'source_address' => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'status' => 'required|in:Pending,Pickup Assign,Pickup Re-Schedule,Received By Pickup Man,Received Warehouse,Transfer to hub,Received by hub,Delivery Man Assign,Return to Courier,Delivered,Cancelled',
            'parcel_car_ids' => 'required|array',
        ]);

        $inventory = Parcel::create($validatedData);

        ParcelHistory::create([
            'parcel_id' => $inventory->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $validatedData['customer_id'],
            'warehouse_id' => $validatedData['warehouse_id'],
            'status' => 'Created',
            'parcel_status' => $validatedData['status'],
            'description' => collect($validatedData)
        ]);

        return redirect()->route('admin.OrderShipment.index')
            ->with('success', 'Order added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $ParcelHistories = ParcelHistory::where('parcel_id', $id)
            ->with(['warehouse', 'customer', 'createdByUser'])->paginate(10);

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        return view('admin.OrderShipment.show', compact('ParcelHistories', 'parcelTpyes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $customers = $user->where('role_id', 3)->values();

        $drivers = $user->where('role_id', 4)->values();

        $parcel = Parcel::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->where('id', $id)->first();

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();
        return view('admin.OrderShipment.edit', compact('parcel', 'warehouses', 'customers', 'drivers', 'parcelTpyes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'tracking_number' => 'required|string|max:255|unique:parcels,tracking_number,' . $id,
            'customer_id' => 'required|exists:users,id',
            'driver_id' => 'nullable|exists:users,id',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'weight' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'partial_payment' => 'nullable|numeric|min:0',
            'remaining_payment' => 'nullable|numeric|min:0',
            'payment_type' => 'required|in:COD,Online',
            'descriptions' => 'nullable|string',
            'source_address' => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'parcel_car_ids' => 'required|array',
            'status' => 'required|in:Pending,Pickup Assign,Pickup Re-Schedule,Received By Pickup Man,Received Warehouse,Transfer to hub,Received by hub,Delivery Man Assign,Return to Courier,Delivered,Cancelled',
        ]);

        Parcel::where([
            'id' => $id
        ])->update($validatedData);

        ParcelHistory::create([
            'parcel_id' => $id,
            'created_user_id' => $this->user->id,
            'customer_id' => $validatedData['customer_id'],
            'warehouse_id' => $validatedData['warehouse_id'],
            'status' => 'Updated',
            'parcel_status' => $validatedData['status'],
            'description' => collect($validatedData)
        ]);


        return redirect()->route('admin.OrderShipment.index')
            ->with('success', 'Inventory added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parcel = Parcel::find($id);

        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel['customer_id'],
            'warehouse_id' => $parcel['warehouse_id'],
            'status' => 'Deleted',
            'parcel_status' => 'Deleted',
            'description' => collect($parcel)
        ]);

        $parcel->delete();
        return redirect()->route('admin.OrderShipment.index')
            ->with('success', 'Order deleted successfully');
    }

    public function status_update(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'ParcelId' => 'required',
                'status' => 'required|in:Pending,Pickup Assign,Pickup Re-Schedule,Received By Pickup Man,Received Warehouse,Transfer to hub,Received by hub,Delivery Man Assign,Return to Courier,Delivered,Cancelled',
                'driver_id' => 'nullable|exists:users,id', // Ensure driver_id is valid if provided
            ]);

            $ParcelId = $validatedData['ParcelId'];
            unset($validatedData['ParcelId']);

            // Fetch the parcel record
            $parcel = Parcel::when($ParcelId,function($q)use($ParcelId){
                if(is_array($ParcelId)){
                    return $q->whereIn('id',$ParcelId);
                }
                return $q->where('id', $ParcelId);
            })->get();

            if (!$parcel) {
                return response()->json([
                    'status' => false,
                    'message' => 'Parcel not found.'
                ], 404);
            }

            // Update parcel status and driver_id if provided
            $objParcel = Parcel::when($ParcelId,function($q)use($ParcelId){
                if(is_array($ParcelId)){
                    return $q->whereIn('id',$ParcelId);
                }
                return $q->where('id', $ParcelId);
            });




            $warehouse_id = null;
            if($validatedData['status'] == "Received Warehouse"){
                $warehouse_id =  $request->warehouse_id;

                // $vehicles = Vehicle::when($this->user->role_id!=1,function($q){
                //     return $q->where('warehouse_id',$this->user->warehouse_id);
                // })->get();


                // // ready to hub
                // $hubTracking = collect(HubTracking::where('status','pending')
                // ->withCount(['parcels'])
                // ->where(['from_warehouse_id'=>$warehouse_id])
                // ->whereIn('vehicle_id',$vehicles->pluck('id')->toArray())->latest()->get())
                // ->filter(function($item){
                //     return $item->parcels_count < $item->vehicle->capacity;
                // })->first();

                // if(empty($hubTracking)){
                //     $hubTracking = HubTracking::create([
                //         'vehicle_id' => $vehicles->first()->id,
                //         'from_warehouse_id' => $warehouse_id,
                //         'created_by' => $this->user->id
                //     ]);
                // }


                // $validatedData['hub_tracking_id'] = $hubTracking->id;
            }

            if($validatedData['status'] == "Received By Pickup Man"){

                $vehicles = Vehicle::when($this->user->role_id!=1,function($q){
                    return $q->where('warehouse_id',$this->user->warehouse_id);
                })->get();

                $warehouse_id =  $vehicles->first()->warehouse_id;

                // ready to hub
                $hubTrackings = HubTracking::where('status','pending')
                ->withCount(['parcels'])
                ->with('vehicle')
                ->where(['from_warehouse_id'=>$warehouse_id])
                ->whereIn('vehicle_id',$vehicles->pluck('id')->toArray())->latest()->get();

                $hubTracking = collect($hubTrackings)->filter(function($item){
                    return $item->parcels_count < $item->vehicle->capacity;
                })->first();

                // return collect($hubTrackings)->pluck('vehicle_id')->toArray();

                if(empty($hubTracking)){
                    $hubTracking = HubTracking::create([
                        'vehicle_id' => $vehicles->whereNotIn('id',collect($hubTrackings)->pluck('vehicle_id')->toArray())->first()->id ?? null,
                        'from_warehouse_id' => $warehouse_id,
                        'created_by' => $this->user->id
                    ]);
                }


                $validatedData['hub_tracking_id'] = $hubTracking->id;
            }

            $objParcel->update($validatedData);


            $history = $parcel->map(function($item) use($validatedData,$warehouse_id){
                return [
                    'parcel_id' => $item->id,
                    'created_user_id' => $this->user->id,
                    'customer_id' => $item->customer_id,
                    'warehouse_id' => $warehouse_id ?? $item->warehouse_id,
                    'status' => 'Updated',
                    'parcel_status' => $validatedData['status'],
                    'description' => collect($item),
                    'note' => $request->note ?? null,
                    'created_at'=> Carbon::now()
                ];
            });



            // Store history in ParcelHistory table
            ParcelHistory::insert(collect($history)->toArray());

            return response()->json([
                'status' => true,
                'message' => 'Order updated successfully.',
                'data' => [
                    // 'parcel_id' => $parcel->id,
                    // 'status' => $validatedData['status'],
                    // 'driver_id' => $request->driver_id ?? null,
                    // 'note' => $request->note ?? null
                ]
            ], 200);
        } catch (\Exception $e) {
            return $e;
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
