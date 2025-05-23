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
                        ->orWhere('unique_id', 'LIKE', '%' . $search . '%')
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
        // Common validation rules
        $rules = [
            'inventary_sub_type'         => 'required|string|in:Cargo,Air,Supply',
            'name'                  => 'required|string',
            'barcode'               => 'required|string',
            'warehouse_id'          => 'required|exists:warehouses,id',
            'in_stock_quantity'     => 'required|numeric',
            'low_stock_warning'     => 'required|numeric',
            'package_type'          => 'required|string',
            'retail_shipping_price' => 'required|numeric',
            'description'           => 'required|string',
            'driver_app_access'     => 'required|in:Yes,No',
            'status'                => 'required|in:Active,Inactive',
            'img'                   => 'nullable|image|mimes:jpg,png|max:2048',
        ];

        // Conditional rules for Supply type
        if ($request->inventary_sub_type === 'Supply') {
            $rules = array_merge($rules, [
                'qty_on_hand'         => 'required|numeric',
                'retail_vaule_price'  => 'required|numeric',
                'value_price'         => 'required|numeric',
                'last_cost_received'  => 'required|numeric',
                'last_date_received'  => 'nullable|date',
                'tax_percentage'      => 'required|numeric',
                're_order_point'     => 'required|numeric',
                're_order_quantity'  => 'required|numeric',
            ]);
        }

        $validatedData = $request->validate($rules);

        // Store logic here
        $data = $request->only([
            'inventary_sub_type',
            'barcode',
            'warehouse_id',
            'name',
            'in_stock_quantity',
            'low_stock_warning',
            'package_type',
            'retail_shipping_price',
            'description',
            'driver_app_access',
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
        ]);
        $data['price'] = $request->costprice ?? null;
        if ($request->inventary_sub_type === 'Supply') {
            $data = array_merge($data, $request->only([
                'qty_on_hand',
                'retail_vaule_price',
                'value_price',
                'last_cost_received',
                'last_date_received',
                're_order_point',
                're_order_quantity',
                'tax_percentage',
            ]));
        }

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
            'inventary_sub_type'         => 'required|string|in:Cargo,Air,Supply',
            'name'                  => 'required|string',
            'barcode'               => 'required|string',
            'warehouse_id'          => 'required|exists:warehouses,id',
            'in_stock_quantity'     => 'required|numeric',
            'low_stock_warning'     => 'required|numeric',
            'package_type'          => 'required|string',
            'retail_shipping_price' => 'required|numeric',
            'description'           => 'required|string',
            'driver_app_access'     => 'required|in:Yes,No',
            //'status'                => 'required|in:Active,Inactive',
            'img'                   => 'nullable|image|mimes:jpg,png|max:2048',
        ];

        // Conditional rules for Supply type
        if ($request->inventary_sub_type === 'Supply') {
            $rules = array_merge($rules, [
                'qty_on_hand'         => 'required|numeric',
                'retail_vaule_price'  => 'required|numeric',
                'value_price'         => 'required|numeric',
                'last_cost_received'  => 'required|numeric',
                'last_date_received'  => 'nullable|date',
                'tax_percentage'      => 'nullable|numeric',
                're_order_point'     => 'nullable|numeric',
                're_order_quantity'  => 'nullable|numeric',
            ]);
        }

        $validatedData = $request->validate($rules);

        $inventory = Inventory::findOrFail($id);

        $data = $request->only([
            'inventary_sub_type',
            'barcode',
            'warehouse_id',
            'in_stock_quantity',
            'low_stock_warning',
            'package_type',
            'retail_shipping_price',
            'description',
            'driver_app_access',
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
            'name'
        ]);
        $data['price'] = $request->costprice ?? null;
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
            ]));
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'uploads/inventory/' . $image->getClientOriginalName();
            $image->move(public_path('uploads/inventory'), $imageName);
            $data['img'] = $imageName;
        }
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
