<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Category,
    Warehouse,
    Stock,
    Inventory
};

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default to 10 per page

        $inventories = Inventory::where('status', 'Active')->when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })
            ->when($search, function ($q) use ($search) { // 🔹 Search Query
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('inventory_type', 'like', "%$search%")
                        ->orWhereHas('warehouse', function ($q) use ($search) { // 🔹 Search by Warehouse Name
                            $q->where('warehouse_name', 'like', "%$search%");
                        });
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]); // Maintain query params

        if ($request->ajax()) {
            return view('admin.inventories.table', compact('inventories'));
        }

        return view('admin.inventories.index', compact('inventories', 'search', 'perPage'));
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

        $categories = collect([
            (object) ["id" => "Supply", "name" => "Supply"],
            (object) ["id" => "Service", "name" => "Service"]
        ]);


        return view('admin.inventories.create', compact('warehouses', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate incoming request data
        $request->validate([
            'warehouse_id'      => 'required|exists:warehouses,id',
            'inventory_name'    => 'required|string',
            'inventory_type'    => 'required|string',
            'in_stock_quantity' => 'required|numeric',
            'low_stock_warning' => 'required|numeric',
            'status'           => 'in:Active,Inactive',
            'weight' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'price' => 'required|numeric',
            'img' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);


        $category_id = $this->getCategoryIdByName($request->inventory_name);

        $inventory = Inventory::firstOrCreate(
            [
                'warehouse_id' => $request->warehouse_id,
                'category_id'  => $category_id,
                'inventory_type' => $request->inventory_type
            ],
            [
                'total_quantity'    => 0,
                'in_stock_quantity' => 0,
                'low_stock_warning' => $request->low_stock_warning,
                'weight' => $request->weight ?? null,
                'width' => $request->width ?? null,
                'height' => $request->height ?? null,
                'price' => $request->price ?? null,
                'status' => $request->status ?? 'Active',
                // 'img'    => $imageName,
                'name' => $request->inventory_name,
                'inventory_type' => $request->inventory_type
            ]
        );

        $inventory->update([
            'total_quantity'      => $inventory->total_quantity + $request->in_stock_quantity,
            'in_stock_quantity'   => $inventory->in_stock_quantity + $request->in_stock_quantity,
            'low_stock_warning'   => $request->low_stock_warning
        ]);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'uploads/inventory/' . $image->getClientOriginalName(); // Generate unique name
            $image->move(public_path('uploads/inventory'), $imageName); // Move image to the desired folder

            $inventory->update([
                'img'    => $imageName,
            ]);
        }

        // Create a new stock entry
        Stock::create([
            'warehouse_id'    => $request->warehouse_id,
            'category_id'     => $category_id,
            'inventory_id'    => $inventory->id,
            'name'    => $inventory->item_name,
            'user_id'         => auth()->id(),
            'in_stock_quantity' => $request->in_stock_quantity,
            'low_stock_warning' => $request->low_stock_warning,
        ]);

        return redirect()->route('admin.inventories.index')
            ->with('success', 'Inventory added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $inventories = Stock::where('inventory_id', $id)->latest('id')->paginate(10);
        return view('admin.inventories.show', compact('inventories'));
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
        $categories = collect([
            (object) ["id" => "Supply", "name" => "Supply"],
            (object) ["id" => "Service", "name" => "Service"]
        ]);
        $inventory = Inventory::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->where('id', $id)->first();
        return view('admin.inventories.edit', compact('inventory', 'warehouses', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Validate incoming request data
        $request->validate([
            'warehouse_id'      => 'required|exists:warehouses,id',
            'inventory_name'    => 'required|string',
            'in_stock_quantity' => 'required|numeric',
            'low_stock_warning' => 'required|numeric',
            // 'status'           => 'in:Active,Inactive',
        ]);

        $category_id = $this->getCategoryIdByName($request->inventory_name);

        $inventory = Inventory::where([
            'id' => $id
        ])->first();

        if ($request->in_stock_quantity == 0) {
            $stock_status = 'Out of Stock';
        } elseif ($request->in_stock_quantity > $request->low_stock_warning) {
            $stock_status = 'In Stock';
        } else {
            $stock_status = 'Low Stock';
        }


        $inventory->update([
            'total_quantity'      => $request->in_stock_quantity,
            'in_stock_quantity'   => $request->in_stock_quantity,
            'low_stock_warning'   => $request->low_stock_warning,
            'stock_status'        => $stock_status,
            'weight' => $request->weight,
            'width' => $request->width,
            'height' => $request->height,
            'price' => $request->price,
            'status' => $request->status ?? 'Active',
            // 'img'    => $imageName,
            'name' => $request->inventory_name,
            'inventory_type' => $request->inventory_type,
            'warehouse_id'    => $request->warehouse_id,
        ]);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'uploads/inventory/' . $image->getClientOriginalName(); // Generate unique name
            $image->move(public_path('uploads/inventory'), $imageName);

            $inventory->update([
                'img' => $imageName
            ]);
        }

        // Create a new stock entry
        Stock::create([
            'warehouse_id'    => $request->warehouse_id,
            'category_id'     => $category_id,
            'inventory_id'    => $inventory->id,
            'user_id'         => auth()->id(),
            'in_stock_quantity' => $request->in_stock_quantity,
            'low_stock_warning' => $request->low_stock_warning,
            'status' => 'updated'
        ]);

        return redirect()->route('admin.inventories.index')
            ->with('success', 'Inventory update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(string $id)
    {
        $inventory = Inventory::find($id);

        if ($inventory) {
            $inventory->status = 'Inactive'; // ya 0, agar status boolean/int ho
            $inventory->save();
        }

        return redirect()->route('admin.inventories.index')
            ->with('success', 'Inventory deleted successfully');
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
