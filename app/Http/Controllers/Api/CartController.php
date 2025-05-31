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

        $cart = Cart::where('user_id', auth()->id())
        ->with('products:id,name,description,category_id,price,in_stock_quantity,img,retail_shipping_price')
        ->latest('id')
        ->get()
        ->map(function ($item) {
            if(!empty($item->products)){
                $item->products->total_price = (!empty($item->products) ? $item->products->retail_shipping_price:0) * $item->quantity;
            }
            $item->total_price = (!empty($item->products) ? $item->products->retail_shipping_price :0) * $item->quantity; // Attach total_price to the cart item
            return $item;
        });

        $grand_total = $cart->sum('total_price'); // Now it correctly sums up total_price


        return response()->json([
            'success' => true,
            'message'=>'Cart fetch successfully.',
            'grand_total'=> $grand_total,
            'data' => $cart
        ]);
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

        if(empty($request->quantity) || $request->quantity == 0){
            $cart = Cart::where(['user_id'=>auth()->id(),"product_id"=>$request->product_id])->delete();
            return $this->sendResponse($cart,'Product removed successfully.');
        }

        $cart = Cart::updateOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $validatedData['product_id']
        ],[
            'quantity' => $validatedData['quantity']
        ]);

        return $this->sendResponse($cart, 'Product added in Cart successfully.');
    }

    public function productList(Request $request){

        $warehouseIds = Warehouse::where('state_id',auth()->user()->state_id)->get()->pluck('id');
        $inventories = Inventory::with(['cart'=>function($q){
            return $q->where('user_id',auth()->id());
        }])->whereIn('warehouse_id', $warehouseIds)->when($request->inventory_type,function($q)use($request){
            return $q->where('inventary_sub_type',$request->inventory_type);
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
    public function destroyProduct(Request $request)
    {
        if(empty($request->product_id)){
            $cart = Cart::where('user_id',auth()->id())->delete();

            return $this->sendResponse('Products removed successfully.');
        }
        Cart::where(['user_id'=>auth()->id(),"product_id"=>$request->product_id])->delete();
        return $this->sendResponse('Product removed successfully.');
    }
}
