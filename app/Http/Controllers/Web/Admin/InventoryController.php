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
    public function index()
    {
        //
        
        $inventories = Inventory::when($this->user->role_id!=1,function($q){
            return $q->where('warehouse_id',$this->user->warehouse_id);
        })->paginate(10);
        return view('admin.inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        $warehouses = Warehouse::when($this->user->role_id!=1,function($q){
            return $q->where('id',$this->user->warehouse_id);
        })->get();
        $categories = Category::get();
        return view('admin.inventories.create', compact('warehouses','categories'));
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
            'in_stock_quantity' => 'required|numeric',
            'low_stock_warning' => 'required|numeric',
            // 'status'           => 'in:Active,Inactive',
        ]);

        $category_id = $this->getCategoryIdByName($request->inventory_name);

        $inventory = Inventory::firstOrCreate(
            [
                'warehouse_id' => $request->warehouse_id,
                'category_id'  => $category_id,
            ],
            [
                'total_quantity'    => 0,
                'in_stock_quantity' => 0,
                'low_stock_warning' => $request->low_stock_warning
            ]
        );

        $inventory->update([
            'total_quantity'      => $inventory->total_quantity + $request->in_stock_quantity,
            'in_stock_quantity'   => $inventory->in_stock_quantity + $request->in_stock_quantity,
            'low_stock_warning'   => $request->low_stock_warning
        ]);

        // Create a new stock entry
        Stock::create([
            'warehouse_id'    => $request->warehouse_id,
            'category_id'     => $category_id,
            'inventory_id'    => $inventory->id,
            'user_id'         => auth()->id(),
            'in_stock_quantity' => $request->in_stock_quantity,
            'low_stock_warning' => $request->low_stock_warning
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
        $inventories = Stock::where('inventory_id',$id)->paginate(10);
        return view('admin.inventories.show',compact('inventories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
        $warehouses = Warehouse::when($this->user->role_id!=1,function($q){
            return $q->where('id',$this->user->warehouse_id);
        })->get();
        $categories = Category::get();
        $inventory = Inventory::when($this->user->role_id!=1,function($q){
            return $q->where('warehouse_id',$this->user->warehouse_id);
        })->where('id',$id)->first();
        return view('admin.inventories.edit',compact('inventory','warehouses','categories'));
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
            'id'=>$id
        ])->first();

        $inventory->update([
            'total_quantity'      => $request->in_stock_quantity,
            'in_stock_quantity'   => $request->in_stock_quantity,
            'low_stock_warning'   => $request->low_stock_warning
        ]);

        // Create a new stock entry
        Stock::create([
            'warehouse_id'    => $request->warehouse_id,
            'category_id'     => $category_id,
            'inventory_id'    => $inventory->id,
            'user_id'         => auth()->id(),
            'in_stock_quantity' => $request->in_stock_quantity,
            'low_stock_warning' => $request->low_stock_warning,
            'status'=>'updated'
        ]);

        return redirect()->route('admin.inventories.index')
        ->with('success', 'Inventory added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Inventory::find($id)->delete();
        return redirect()->route('admin.inventories.index')
                        ->with('success','Inventory deleted successfully');
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
