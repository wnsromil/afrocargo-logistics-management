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
    HubTracking,
    Notification
};
use App\Jobs\SendFirebaseNotification;

class NotificationScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->search;
        $perPage = $request->input('per_page', 10); // Default 10
        $currentPage = $request->input('page', 1); // Current page number

        $notifications = Notification::where('type', 'System')->when($query, function ($q) use ($query) {
            return $q->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%$query%")
                    ->orWhere('message', 'LIKE', "%$query%")
                    ->orWhere('unique_id', 'LIKE', "%$query%")
                    ->orWhere('type', 'LIKE', "%$query%")
                    ->orWhere('status', 'LIKE', "%$query%");
            });
        })
            ->latest()
            ->paginate($perPage)
            ->appends(['search' => $query, 'per_page' => $perPage]);

        // Serial number calculation for pagination
        $serialStart = ($currentPage - 1) * $perPage;

        if ($request->ajax()) {
            return view('admin.notification_schedule.table', compact('notifications', 'serialStart'))->render();
        }

        return view('admin.notification_schedule.index', compact('notifications', 'query', 'perPage', 'serialStart'));
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


        return view('admin.notification_schedule.create', compact('warehouses', 'customers', 'drivers', 'parcelTpyes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'notification_title' => 'required|string|max:255',
            'notification_message' => 'required|string',
        ]);

        // Create notification
        Notification::create([
            'title' => $request->notification_title,
            'message' => $request->notification_message,
            'notification_for' => 'All',
            'type' => 'System',
        ]);

        $users = User::all();

        foreach ($users as $user) {
            if (!empty($user->firebase_token)) {
                SendFirebaseNotification::dispatch(
                    $user->id,
                    $user->firebase_token,
                    $request->notification_title,
                    $request->notification_message
                );
            }

            if ($user->role_id == 2) {
                User::where('id', $user->id)->increment('notification_read', 1);
            }
        }


        // Redirect with success message
        return redirect()->route('admin.notification_schedule.index')
            ->with('success', 'Notification created and sent to all users!');
    }
    

    public function warehouseManagerStore(Request $request)
    {

        // Validate request
        $request->validate([
            'notification_title' => 'required|string|max:255',
            'notification_message' => 'required|string',
            'warehouse_id' => 'required|exists:warehouses,id',
            'warehouse_manager_id' => 'required',
        ]);

        // Get users based on warehouse_manager_id
        if ($request->warehouse_manager_id === 'All Warehouse Managers') {
            // Role 2 means warehouse manager
            // $users = User::where('role_id', 2)->whereNotNull('firebase_token')->get();
            $users = User::where('role_id', 2)->where('warehouse_id', $request->warehouse_id)->get();
        } else {
            // Validate user exists
            $request->validate([
                'warehouse_manager_id' => 'exists:users,id',
            ]);

            $user = User::where('id', $request->warehouse_manager_id)->first();
            $users = $user ? collect([$user]) : collect(); // wrap in collection
        }

        // Create notifications and dispatch jobs

        Notification::create([
            'user_id' => is_numeric($request->warehouse_manager_id) ? $request->warehouse_manager_id : null,
            'warehouse_id' => $request->warehouse_id,
            'title' => $request->notification_title,
            'message' => $request->notification_message,
            'notification_for' => is_numeric($request->warehouse_manager_id) ? null : 'All Warehouse Managers',
            'role' => 'Warehouse Manager',
            'type' => 'System',
        ]);

        foreach ($users as $user) {
            User::where('id', $user->id)->increment('notification_read', 1);
        }

        // Redirect with success message
        return redirect()->route('admin.notification_schedule.index')
            ->with('success', 'Notification created and sent successfully!');
    }

    public function DriverStore(Request $request)
    {
        // Validate request
        $request->validate([
            'notification_title' => 'required|string|max:255',
            'notification_message' => 'required|string',
            'warehouse_id' => 'required|exists:warehouses,id',
            'driver_id' => 'required',
        ]);

        // Get users based on driver_id
        if ($request->driver_id === 'All Warehouse Drivers') {
            // Role 3 means driver (assuming role_id 3 is for drivers)
            $users = User::where('role_id', 4)->where('warehouse_id', $request->warehouse_id)->get();
        } else {
            // Validate user exists
            $request->validate([
                'driver_id' => 'exists:users,id',
            ]);

            $user = User::where('id', $request->driver_id)->first();
            $users = $user ? collect([$user]) : collect(); // wrap in collection
        }

        // Create notifications and dispatch jobs
        Notification::create([
            'user_id' => is_numeric($request->driver_id) ? $request->driver_id : null,
            'warehouse_id' => $request->warehouse_id,
            'title' => $request->notification_title,
            'message' => $request->notification_message,
            'notification_for' => is_numeric($request->driver_id) ? null : 'All Warehouse Drivers',
            'role' => 'Driver',
            'type' => 'System',
        ]);

        foreach ($users as $user) {
            // User::where('id', $user->id)->increment('notification_read', 1);
            SendFirebaseNotification::dispatch(
                $user->id,                 // 👈 user id
                $user->firebase_token,
                $request->notification_title,
                $request->notification_message
            );
        }

        // Redirect with success message
        return redirect()->route('admin.notification_schedule.index')
            ->with('success', 'Notification created and sent successfully!');
    }

    public function CustomerStore(Request $request)
    {
        // Validate request
        $request->validate([
            'notification_title' => 'required|string|max:255',
            'notification_message' => 'required|string',
            'warehouse_id' => 'required|exists:warehouses,id',
            'customer_id' => 'required',
            'customer_container_id' => 'nullable'
        ]);

        // Get users based on customer_id
        if ($request->customer_id === 'All Warehouse Customers') {
            // Role 4 means customer (assuming role_id 4 is for customers)
            $users = User::where('role_id', 3)->where('warehouse_id', $request->warehouse_id)->get();
        } else {
            // Validate user exists
            $request->validate([
                'customer_id' => 'exists:users,id',
            ]);

            $user = User::where('id', $request->customer_id)->first();
            $users = $user ? collect([$user]) : collect(); // wrap in collection
        }

        // Create notifications and dispatch jobs
        Notification::create([
            'user_id' => is_numeric($request->customer_id) ? $request->customer_id : null,
            'container_id' => $request->customer_container_id ?? null,
            'warehouse_id' => $request->warehouse_id,
            'title' => $request->notification_title,
            'message' => $request->notification_message,
            'notification_for' => is_numeric($request->customer_id) ? null : 'All Warehouse Customers',
            'role' => 'Customer',
            'type' => 'System',
        ]);

        foreach ($users as $user) {
            //  User::where('id', $user->id)->increment('notification_read', 1);
            SendFirebaseNotification::dispatch(
                $user->id,                 // 👈 user id
                $user->firebase_token,
                $request->notification_title,
                $request->notification_message
            );
        }

        // Redirect with success message
        return redirect()->route('admin.notification_schedule.index')
            ->with('success', 'Notification created and sent successfully!');
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

        return view('admin.notification_schedule.show', compact('ParcelHistories', 'parcelTpyes'));
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
        return view('admin.notification_schedule.edit', compact('parcel', 'warehouses', 'customers', 'drivers', 'parcelTpyes'));
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


        return redirect()->route('admin.notification_schedule.index')
            ->with('success', 'Inventory added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::find($id);

        $notification->delete();
        return redirect()->route('admin.notification_schedule.index')
            ->with('success', 'Notification deleted successfully');
    }
}
