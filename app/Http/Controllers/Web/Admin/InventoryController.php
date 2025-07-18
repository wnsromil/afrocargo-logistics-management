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
        $warehouse_id = $request->input('warehouse_id');
        $main_type = $request->input('main_type');

        $inventories = Inventory::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            // 🔹 Filter by warehouse_id if passed in request
            ->when($warehouse_id, function ($q) use ($warehouse_id) {
                return $q->where('warehouse_id', $warehouse_id);
            })
            // 🔹 Filter by main_type and sub_type logic
            // ->when($main_type, function ($q) use ($main_type) {
            //     if ($main_type === 'Supply') {
            //         return $q->where('inventary_sub_type', 'Supply');
            //     } elseif ($main_type === 'Service') {
            //         return $q->whereIn('inventary_sub_type', ['Ocean Cargo', 'Air Cargo']);
            //     }
            // })
            ->whereIn('inventary_sub_type', ['Ocean Cargo', 'Air Cargo'])
            // 🔹 Search Logic
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('unique_id', 'LIKE', '%' . $search . '%')
                        ->orWhere('inventory_type', 'like', "%$search%")
                        ->orWhereHas('warehouse', function ($q) use ($search) {
                            $q->where('warehouse_name', 'like', "%$search%");
                        });
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'warehouse_id' => $warehouse_id,
                'main_type' => $main_type,
            ]);

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->get();

        if ($request->ajax()) {
            return view('admin.inventories.table', compact('inventories', 'warehouses'))->render();
        }

        return view('admin.inventories.index', compact(
            'inventories',
            'search',
            'perPage',
            'warehouses',
            'warehouse_id',
            'main_type'
        ));
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
        // Common validation rules
        $rules = [
            'inventary_sub_type'         => 'required|string|in:Ocean Cargo,Air Cargo,Supply',
            'name'                  => 'required|string',
           // 'barcode'               => 'required|string',
            'warehouse_id'          => 'required|exists:warehouses,id',
            'in_stock_quantity'     => 'required|numeric',
            'package_type'          => 'required|string',
            'description'           => 'required|string',
           // 'driver_app_access'     => 'required|in:Yes,No',
            'status'                => 'required|in:Active,Inactive',
            'img'                   => 'nullable|image|mimes:jpg,png|max:2048',
            'country'               => 'required|string',
        ];

        $rules = array_merge($rules, [
            'retail_shipping_price' => 'required|numeric',
            'price' => 'nullable',
        ]);

        $validatedData = $request->validate($rules);

        // Store logic here
        $data = $request->only([
            'inventary_sub_type',
           // 'barcode',
            'warehouse_id',
            'name',
            'in_stock_quantity',
            'low_stock_warning',
            'package_type',
            'retail_shipping_price',
            'description',
           // 'driver_app_access',
            'status',
            'costprice',
            'country',
            'state_zone',
            'weight',
            'item_length_inch',
            'width',
            'height',
            'weight_price',
            'volume_total',
            'volume_price',
            'factor',
            'insurance_have',
            'insurance',
            'city',
            'state',
            'qty_on_hand',
            'retail_vaule_price',
            'value_price',
            'last_cost_received',
            'last_date_received',
            're_order_point',
            're_order_quantity',
            'tax_percentage',
            'color',
            'open',
            'capacity',
            'un_rating',
            'model_number',
            'minimum_order_limit',
            'price'

        ]);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'uploads/inventory/' . $image->getClientOriginalName();
            $image->move(public_path('uploads/inventory'), $imageName);
            $data['img'] = $imageName;
        }

        // Final store logic placeholder (you can insert to database here)
        // Example:
        Inventory::create($data);

        return redirect()->route('admin.inventories.index')
            ->with('success', 'Inventory add successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $inventories = Inventory::where('id', $id)->first();
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
        $editData = Inventory::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->where('id', $id)->first();
        return view('admin.inventories.edit', compact('editData', 'warehouses', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Common validation rules
        $rules = [
            'inventary_sub_type'     => 'required|string|in:Ocean Cargo,Air Cargo,Supply',
            'name'                   => 'required|string',
           // 'barcode'                => 'required|string',
            'warehouse_id'           => 'required|exists:warehouses,id',
            'in_stock_quantity'      => 'required|numeric',
            'package_type'           => 'required|string',
            'retail_shipping_price'  => 'required|numeric',
            'description'            => 'required|string',
           // 'driver_app_access'      => 'required|in:Yes,No',
            // 'status'              => 'required|in:Active,Inactive', // optional if not needed
            'img'                    => 'nullable|image|mimes:jpg,png|max:2048',
            'country'                => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        $inventory = Inventory::findOrFail($id);

        // Store logic here
        $data = $request->only([
            'inventary_sub_type',
           // 'barcode',
            'warehouse_id',
            'name',
            'in_stock_quantity',
            'low_stock_warning',
            'package_type',
            'retail_shipping_price',
            'description',
            //'driver_app_access',
            'status',
            'costprice',
            'country',
            'state_zone',
            'weight',
            'item_length_inch',
            'width',
            'height',
            'weight_price',
            'volume_total',
            'volume_price',
            'factor',
            'insurance_have',
            'insurance',
            'city',
            'state',
            'qty_on_hand',
            'retail_vaule_price',
            'value_price',
            'last_cost_received',
            'last_date_received',
            're_order_point',
            're_order_quantity',
            'tax_percentage',
            'color',
            'open',
            'capacity',
            'un_rating',
            'model_number',
            'minimum_order_limit',
            'price'

        ]);

        // Supply-specific fields
        if ($request->inventary_sub_type === 'Supply') {
            $data = array_merge($data, $request->only([
                'qty_on_hand',
                'retail_vaule_price',
                'value_price',
                'last_cost_received',
                'last_date_received',
                'tax_percentage',
                're_order_point',
                're_order_quantity',
                'color',
                'open',
                'capacity',
                'un_rating',
                'model_number',
                'minimum_order_limit'
            ]));
        }

        // Image handling
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'uploads/inventory/' . $image->getClientOriginalName();
            $image->move(public_path('uploads/inventory'), $imageName);
            $data['img'] = $imageName;
        }

        // If user wants to delete the image
        if ($request->delete_img == "1") {
            $data['img'] = null;
        }

        $inventory->update($data);

        return redirect()->route('admin.inventories.index')
            ->with('success', 'Inventory updated successfully.');
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
