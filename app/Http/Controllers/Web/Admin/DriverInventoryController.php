<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\InventoryHelper;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Category,
    Warehouse,
    Stock,
    Inventory,
    DriverInventory,
    DriverInventoriesSolde
};
use Carbon\Carbon;

class DriverInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $driver_id = $request->input('driver_id');
        $perPage = $request->input('per_page', 10); // same per page for both
        $currentPage = $request->input('page', 1); // shared page number

        // Date Range
        $start_date = null;
        $end_date = null;
        $dateRange = $request->input('daterangepicker');

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        if ($dateRange) {
            try {
                [$start_date, $end_date] = explode(' - ', $dateRange);
                $start_date = \Carbon\Carbon::createFromFormat('m/d/Y', trim($start_date))->format('Y-m-d');
                $end_date = \Carbon\Carbon::createFromFormat('m/d/Y', trim($end_date))->format('Y-m-d');
            } catch (\Exception $e) {
                $start_date = null;
                $end_date = null;
            }
        }

        // Items
        $itemsQuery = DriverInventory::where('status', 'Active');

        if ($driver_id) {
            $itemsQuery->where('driver_id', $driver_id);
        }

        if ($start_date && $end_date) {
            $itemsQuery->whereBetween('date', [$start_date, $end_date]);
        }

        $items = $itemsQuery->latest()->paginate($perPage)
            ->appends([
                'driver_id' => $driver_id,
                'daterangepicker' => $dateRange,
                'per_page' => $perPage,
            ]);

        $serialStartItems = ($items->currentPage() - 1) * $perPage;

        // Sold Items
        $soldQuery = DriverInventoriesSolde::query();

        if ($driver_id) {
            $soldQuery->where('driver_id', $driver_id);
        }

        if ($start_date && $end_date) {
            $soldQuery->whereBetween('date', [$start_date, $end_date]);
        }

        $driver_details = $soldQuery->latest()->paginate($perPage)
            ->appends([
                'driver_id' => $driver_id,
                'daterangepicker' => $dateRange,
                'per_page' => $perPage,
            ]);

        $serialStartSold = ($driver_details->currentPage() - 1) * $perPage;

        $users = User::where('role_id', 4)
            ->where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        if ($request->ajax()) {
            return view('admin.driver_inventory.table', compact(
                'items',
                'driver_details',
                'users',
                'driver_id',
                'dateRange',
                'perPage',
                'serialStartItems',
                'serialStartSold',
                'warehouses'
            ))->render();
        }

        return view('admin.driver_inventory.index', compact(
            'items',
            'driver_details',
            'users',
            'driver_id',
            'dateRange',
            'perPage',
            'serialStartItems',
            'serialStartSold',
            'warehouses'
        ));
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

        $users = User::where('role_id', 4)
            ->where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        $items = Inventory::where('inventary_sub_type', 'Supply')
            ->where('status', 'Active')
            ->get();
        $time = Carbon::now()->format('h:i A');
        return view('admin.driver_inventory.create', compact('warehouses', 'time', 'users', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Basic Validation
        $request->validate([
            'driverInventoryDate' => 'required|date',
            'currentTIme' => 'required',
            'driver_id' => 'required|exists:users,id',
            'InOutType' => 'required|in:In,Out',
            'item_id' => 'required|array',
            'item_id.*' => 'required|exists:inventories,id',
            'in_stock_quantity' => 'required|array',
            'in_stock_quantity.*' => 'required|numeric|min:1',
        ]);

        // ✅ Format Date
        $formattedDate = \Carbon\Carbon::createFromFormat('m/d/Y', $request->driverInventoryDate)->format('Y-m-d');

        // ✅ Custom Manual Validation
        foreach ($request->item_id as $index => $itemId) {
            $driverId = $request->driver_id;
            $inOutType = $request->InOutType;
            $quantity = $request->in_stock_quantity[$index];

            // Total Out - Total In = Available
            $totalOut = \App\Models\DriverInventory::where('driver_id', $driverId)
                ->where('items_id', $itemId)
                ->where('in_out', 'Out')
                ->sum('quantity');

            $totalIn = \App\Models\DriverInventory::where('driver_id', $driverId)
                ->where('items_id', $itemId)
                ->where('in_out', 'In')
                ->sum('quantity');

            $availableQty = $totalOut - $totalIn;

            if ($inOutType === 'In' && $totalOut == 0) {
                return back()->withErrors([
                    "item_id.$index" => "Please take the item out first before bringing it back in.",
                ])->withInput();
            }

            if ($inOutType === 'In' && $quantity > $availableQty) {
                return back()->withErrors([
                    "in_stock_quantity.$index" => "Oops! Only $availableQty of this item (ID: $itemId) is available, but you tried to add $quantity.",
                ])->withInput();
            }
        }

        // ✅ Save All Items
        foreach ($request->item_id as $index => $itemId) {
            \App\Models\DriverInventory::create([
                'date' => $formattedDate,
                'warehouse_id' => $request->warehouse_id,
                'time' => $request->currentTIme,
                'driver_id' => $request->driver_id,
                'in_out' => $request->InOutType,
                'items_id' => $itemId,
                'quantity' => $request->in_stock_quantity[$index],
                'creator_id' => auth()->id(),
            ]);
        }

        return redirect()->route('admin.driver_inventory.index')
            ->with('success', 'Driver Inventory saved successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $inventories = Stock::where('inventory_id', $id)->paginate(10);
        return view('admin.driver_inventory.show', compact('inventories'));
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
        $categories = Category::get();
        $inventory = Inventory::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->where('id', $id)->first();
        return view('admin.driver_inventory.edit', compact('inventory', 'warehouses', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Validate incoming request data
        $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'inventory_name' => 'required|string',
            'in_stock_quantity' => 'required|numeric',
            'low_stock_warning' => 'required|numeric',
            // 'status'           => 'in:Active,Inactive',
        ]);

        $category_id = $this->getCategoryIdByName($request->inventory_name);

        $inventory = Inventory::where([
            'id' => $id
        ])->first();

        $inventory->update([
            'total_quantity' => $request->in_stock_quantity,
            'in_stock_quantity' => $request->in_stock_quantity,
            'low_stock_warning' => $request->low_stock_warning
        ]);

        // Create a new stock entry
        Stock::create([
            'warehouse_id' => $request->warehouse_id,
            'category_id' => $category_id,
            'inventory_id' => $inventory->id,
            'user_id' => auth()->id(),
            'in_stock_quantity' => $request->in_stock_quantity,
            'low_stock_warning' => $request->low_stock_warning,
            'status' => 'updated'
        ]);

        return redirect()->route('admin.driver_inventory.index')
            ->with('success', 'Driver Inventory added successfully.')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $driverInventory = DriverInventory::find($id);

        if ($driverInventory) {
            $driverInventory->status = 'Inactive'; // 1 = Active, 0 = Deactive
            $driverInventory->save();

            return redirect()->route('admin.driver_inventory.index')
                ->with('success', 'Inventory deleted successfully.')
                ->withInput();
        }

        return redirect()->route('admin.driver_inventory.index')
            ->with('error', 'Inventory not found.');
    }


    public function getCategoryIdByName($name)
    {
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($name)])->first();

        if ($category) {
            return $category->id;
        }

        $category = Category::create([
            'name' => strtolower($name)
        ]);

        return $category->id;
    }
}