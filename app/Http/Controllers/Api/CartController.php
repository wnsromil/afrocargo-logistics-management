<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Cart,
    User,
    Category,
    Warehouse,
    Stock,
    Inventory
};

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $cart = Cart::where('user_id',auth()->id())->with('products:id,description,category_id,price,in_stock_quantity')->get()
        ->map(function($item){
                $item->products->total_price = $item->products->price * $item->quantity;
                return $item;
            });

        return $this->sendResponse($cart, 'Cart fetch successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validate incoming request data
        $validatedData = $request->validate([
            'id' => 'nullable|numeric|min:1',
            'product_id' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:0'
        ]);

        $cart = Cart::updateOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $validatedData['product_id']
        ],[
            'quantity' => $validatedData['quantity']
        ]);

        return $this->sendResponse($cart, 'Product added in Cart successfully.');
    }

    public function productList(Request $request){
        $warehouseIds = Warehouse::where('state_id',auth()->user()->state)->get()->pluck('id');
        $inventories = Inventory::whereIn('warehouse_id', $warehouseIds)->when($request->inventory_type,function($q){
            return $q->where('inventory_type',$request->inventory_type);
        })->latest('id')->paginate(10);
        return $this->sendResponse($inventories, 'Fetch Product list successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
