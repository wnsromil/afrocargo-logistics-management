<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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

class RoleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = $request->search;
        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);
        $role = $request->input('role');
        $warehouse_id = $request->input('warehouse_id');

        $roleMap = Role::where('name', '!=', 'admin')->pluck('name', 'id')->toArray();

        foreach ($roleMap as $id => $roleName) {
            $users = User::where('role_id', $id)->get();

            foreach ($users as $user) {
                if (!$user->hasRole($roleName)) {
                    $user->assignRole($roleName);
                }
            }
        }

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->select('id', 'warehouse_name')
            ->get();

        $permissions = Permission::orderBy('name')->get();
        $selectedPermission = $request->input('permission');

        // User Query with Search and Filter
        $users = User::with(['roles', 'permissions'])
            ->whereHas('roles', function ($q) {
                $q->whereIn('id', [4,2]); // Exclude admin
            })
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('name', 'like', "%{$query}%")
                        ->orWhere('last_name', 'like', "%{$query}%")
                        ->orWhere('unique_id', 'like', "%{$query}%")
                        ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$query}%"]);
                });
            })
            ->when($query, function ($q) use ($query) {
                $q->orWhereHas('permissions', function ($permQ) use ($query) {
                    $permQ->where('name', 'like', "%{$query}%");
                });
            })
            ->when($selectedPermission, function ($query) use ($selectedPermission) {
                $query->whereHas('permissions', function ($q) use ($selectedPermission) {
                    $q->where('name', $selectedPermission);
                });
            })
            ->when($role, function ($query) use ($role) {
                return $query->where('role_id', $role);
            })
            ->when($warehouse_id, function ($query) use ($warehouse_id) {
                return $query->where('warehouse_id', $warehouse_id);
            })
            ->latest('id')
            ->paginate($perPage, ['*'], 'page', $currentPage);

        if ($request->ajax()) {
            return view('admin.user_role.table', compact('users', 'warehouses', 'permissions', 'selectedPermission'));
        }

        return view('admin.user_role.index', compact('users', 'warehouses', 'permissions', 'selectedPermission'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user_role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        // Validate incoming request data
        // $validatedData = $request->validate([
        //     'tracking_number' => 'required|string|max:255|unique:parcels,tracking_number',
        //     'customer_id' => 'required|exists:users,id',
        //     'driver_id' => 'nullable|exists:users,id',
        //     'warehouse_id' => 'nullable|exists:warehouses,id',
        //     'weight' => 'required|numeric|min:0',
        //     'total_amount' => 'required|numeric|min:0',
        //     'partial_payment' => 'required|numeric|min:0',
        //     'remaining_payment' => 'required|numeric|min:0',
        //     'payment_type' => 'required|in:COD,Online',
        //     'descriptions' => 'nullable|string',
        //     'source_address' => 'required|string|max:255',
        //     'destination_address' => 'required|string|max:255',
        //     'status' => 'required|in:Pending,Pickup Assign,Pickup Re-Schedule,Received By Pickup Man,Received Warehouse,Transfer to hub,Received by hub,Delivery Man Assign,Return to Courier,Delivered,Cancelled',
        //     'parcel_car_ids' => 'required|array',
        // ]);

        // $inventory = Parcel::create($validatedData);

        // ParcelHistory::create([
        //     'parcel_id' => $inventory->id,
        //     'created_user_id' => $this->user->id,
        //     'customer_id' => $validatedData['customer_id'],
        //     'warehouse_id' => $validatedData['warehouse_id'],
        //     'status' => 'Created',
        //     'parcel_status' => $validatedData['status'],
        //     'description' => collect($validatedData)
        // ]);

        return redirect()->route('admin.user_role.index')
            ->with('success', 'Order added successfully.');
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

        return view('admin.user_role.show', compact('ParcelHistories', 'parcelTpyes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Group permissions by their resource (first part before dot)
        $groupedPermissions = Permission::all()->groupBy(function ($item) {
            return explode('.', $item->name)[0];
        });

        $userPermissions = $user->permissions->pluck('name')->toArray();

        return view('admin.user_role.edit', compact('user', 'groupedPermissions', 'userPermissions'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $user->syncPermissions($validated['permissions'] ?? []);

        return redirect()->back()->with('success', 'Permissions updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
}
