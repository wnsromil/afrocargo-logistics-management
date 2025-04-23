<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
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
    HubTracking,
    Expense,
};

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get input parameters
        $search = $request->input('search');
        $warehouse_id = $request->input('warehouse_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $category = $request->input('category');
        $perPage = $request->input('per_page', 10); // Default pagination
        $currentPage = $request->input('page', 1);

        // Start building the query
        $query = Expense::with(['creatorUser', 'warehouse'])
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            });

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'LIKE', "%$search%")
                    ->orWhere('category', 'LIKE', "%$search%")
                    ->orWhere('amount', 'LIKE', "%$search%");
            });
        }

        // Apply warehouse filter
        if ($warehouse_id) {
            $query->where('warehouse_id', $warehouse_id);
        }

        // Apply date range filter
        if ($start_date && $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        }

        // Apply category filter
        if ($category) {
            $query->where('category', $category);
        }

        // Paginate the results
        $expenses = $query->latest()->paginate($perPage)->appends([
            'search' => $search,
            'warehouse_id' => $warehouse_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'category' => $category,
            'per_page' => $perPage,
        ]);

        // Calculate serial number start
        $serialStart = ($currentPage - 1) * $perPage;

        // Return view or AJAX response
        if ($request->ajax()) {
            return view('admin.expenses.table', compact('expenses', 'serialStart'))->render();
        }

        return view('admin.expenses.index', compact('expenses', 'search', 'warehouse_id', 'start_date', 'end_date', 'category', 'perPage', 'serialStart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $warehouses = Warehouse::where('status', 'Active')->when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $users = collect(User::where('status', 'Active')
            ->whereIn('role_id', [1, 2, 4])
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get());

        $customers = $users->where('role_id', 3)->values();

        $drivers = $users->where('role_id', 4)->values();

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        $containers = Vehicle::where('vehicle_type', 'Container')->get();


        return view('admin.expenses.create', compact('warehouses', 'users', 'customers', 'containers', 'drivers', 'parcelTpyes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'warehouse' => 'required|exists:warehouses,id',
            'expense_date' => 'required|date_format:m/d/Y',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'creator_user_id' => 'required|exists:users,id',
        ]);

        $status  = !empty($request->status) ? $request->status : 'Active';
        $validatedData['status'] = $status;
        $validatedData['date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $request->expense_date)->format('Y-m-d');
        $validatedData['warehouse_id'] = $request->warehouse;
        $validatedData['time'] = "06:00 AM";
        $allData = $request->except('_token');
        $dataToStore = array_merge($allData, $validatedData);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/expenses', $filename, 'public'); // Store in 'storage/app/public/uploads/licenses'
            $dataToStore['img'] = 'storage/' . $filePath; // Get full URL
        }

        $expense = Expense::create($dataToStore);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ParcelHistories = ParcelHistory::where('parcel_id', $id)
            ->with(['warehouse', 'customer', 'createdByUser'])->paginate(10);

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        return view('admin.expenses.show', compact('ParcelHistories', 'parcelTpyes'));
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
        return view('admin.expenses.edit', compact('parcel', 'warehouses', 'customers', 'drivers', 'parcelTpyes'));
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


        return redirect()->route('admin.expenses.index')
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
        return redirect()->route('admin.expenses.index')
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
            $parcel = Parcel::when($ParcelId, function ($q) use ($ParcelId) {
                if (is_array($ParcelId)) {
                    return $q->whereIn('id', $ParcelId);
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
            $objParcel = Parcel::when($ParcelId, function ($q) use ($ParcelId) {
                if (is_array($ParcelId)) {
                    return $q->whereIn('id', $ParcelId);
                }
                return $q->where('id', $ParcelId);
            });




            $warehouse_id = null;
            if ($validatedData['status'] == "Received Warehouse") {
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

            if ($validatedData['status'] == "Received By Pickup Man") {

                $vehicles = Vehicle::when($this->user->role_id != 1, function ($q) {
                    return $q->where('warehouse_id', $this->user->warehouse_id);
                })->get();

                $warehouse_id =  $vehicles->first()->warehouse_id;

                // ready to hub
                $hubTrackings = HubTracking::where('status', 'pending')
                    ->withCount(['parcels'])
                    ->with('vehicle')
                    ->where(['from_warehouse_id' => $warehouse_id])
                    ->whereIn('vehicle_id', $vehicles->pluck('id')->toArray())->latest()->get();

                $hubTracking = collect($hubTrackings)->filter(function ($item) {
                    return $item->parcels_count < $item->vehicle->capacity;
                })->first();

                // return collect($hubTrackings)->pluck('vehicle_id')->toArray();

                if (empty($hubTracking)) {
                    $hubTracking = HubTracking::create([
                        'vehicle_id' => $vehicles->whereNotIn('id', collect($hubTrackings)->pluck('vehicle_id')->toArray())->first()->id ?? null,
                        'from_warehouse_id' => $warehouse_id,
                        'created_by' => $this->user->id
                    ]);
                }


                $validatedData['hub_tracking_id'] = $hubTracking->id;
            }

            $objParcel->update($validatedData);


            $history = $parcel->map(function ($item) use ($validatedData, $warehouse_id) {
                return [
                    'parcel_id' => $item->id,
                    'created_user_id' => $this->user->id,
                    'customer_id' => $item->customer_id,
                    'warehouse_id' => $warehouse_id ?? $item->warehouse_id,
                    'status' => 'Updated',
                    'parcel_status' => $validatedData['status'],
                    'description' => collect($item),
                    'note' => $request->note ?? null,
                    'created_at' => Carbon::now()
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
