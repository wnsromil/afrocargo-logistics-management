<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Category,
    Warehouse,
    Stock,
    Inventory,
    Parcel,ParcelHistory
};

class OrderShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $parcels = Parcel::when($this->user->role_id!=1,function($q){
            return $q->where('warehouse_id',$this->user->warehouse_id);
        })->when($this->user->role_id==3,function($q){
            return $q->where('customer_id',$this->user->id);
        })->when($this->user->role_id==4,function($q){
            return $q->where('driver_id',$this->user->id);
        })
        ->when(!empty($request->status),function($q)use($request){
            return $q->whereIn('status',explode(',',$request->status));
        })
        ->with(['warehouse','customer','driver'])->latest()->paginate(10);
        return $this->sendResponse($parcels, 'Parcel data fetch successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        // Validate incoming request data
        $validatedData = $request->validate([
            'weight' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'partial_payment' => 'required|numeric|min:0',
            'remaining_payment' => 'required|numeric|min:0',
            'payment_type' => 'required|in:COD,Online',
            'descriptions' => 'nullable|string',
            'source_address' => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'destination_user_name' => 'required|string|max:255',
            'destination_user_phone' => 'required||numeric|min:10',
            'parcel_card_ids' => 'required|array',
            'source_let' => 'required|numeric|min:0',
            'source_long' => 'required|numeric|min:0',
            'dest_let' => 'nullable|numeric|min:0',
            'dest_long' => 'nullable|numeric|min:0',
        ]);

        if($request->remaining_payment && $request->remaining_payment > 0 && $request->remaining_payment && $request->remaining_payment > 0){
            $validatedData['payment_status'] = 'Partial';
        }
        $validatedData['customer_id'] = $this->user->id;
        $validatedData['parcel_car_ids'] = $validatedData['parcel_card_ids'];
        unset($validatedData['parcel_card_ids']);

        $Parcel = Parcel::create($validatedData);

        ParcelHistory::create([
            'parcel_id' => $Parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $validatedData['customer_id'],
            // 'warehouse_id' => $validatedData['warehouse_id'],
            'status' => 'Created',
            'parcel_status' => 'Pending',
            'description'=>collect($validatedData)
        ]);

        return $this->sendResponse($Parcel, 'Order added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ParcelHistories = Parcel::where('id',$id)
        ->with(['warehouse','customer','driver'])->first();

        return $this->sendResponse($ParcelHistories, 'Order data fetch  successfully.');
    }

    public function OrderHistory(string $id)
    {
        //
        $ParcelHistories = ParcelHistory::where('parcel_id',$id)
        ->with(['warehouse','customer','createdByUser'])->paginate(10);

        return $this->sendResponse($ParcelHistories, 'Order histories fetch  successfully.');
    }

    public function OrderShipmentStatus(Request $request){
        $validatedData = $request->validate([
            'order_id'=>'required|exists:parcels,id',
            'status' => 'required|in:Pending,Pickup Assign,Pickup Re-Schedule,Received By Pickup Man,Received Warehouse,Transfer to hub,Received by hub,Delivery Man Assign,Return to Courier,Delivered,Cancelled',
        ]);

        $parcel = Parcel::where('id',$validatedData['order_id'])
        ->when($this->user->role_id!=1,function($q){
            return $q->where('warehouse_id',$this->user->warehouse_id);
        })->when($this->user->role_id==3,function($q){
            return $q->where('customer_id',$this->user->id);
        })->when($this->user->role_id==4,function($q){
            return $q->where('driver_id',$this->user->id);
        })
        ->first();

        if(empty($parcel)){
            return $this->sendError('Data not fund.',['error'=>'Data not fund.']);
        }

        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel->customer_id,
            'warehouse_id' => $parcel->warehouse_id ?? null,
            'status' => 'Updated',
            'parcel_status' => $validatedData['status'],
            'description'=>collect($parcel)
        ]);

        $parcel->status = $validatedData['status'];
        $parcel->save();
        
        return $this->sendResponse($parcel, 'Order status updated successfully.');
    }

    public function inventoryOrderCategories(){
        $categories = Category::whereIn('name',['box','bag','barrel'])->get();

        return $this->sendResponse($categories, 'Order  categories fetch successfully.');
    }
}
