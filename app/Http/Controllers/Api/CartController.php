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
    Inventory,
    Address
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
                if (!empty($item->products)) {
                    $item->products->total_price = (!empty($item->products) ? $item->products->retail_shipping_price : 0) * $item->quantity;
                }
                $item->total_price = (!empty($item->products) ? $item->products->retail_shipping_price : 0) * $item->quantity; // Attach total_price to the cart item
                return $item;
            });

        $grand_total = $cart->sum('total_price'); // Now it correctly sums up total_price


        return response()->json([
            'success' => true,
            'message' => 'Cart fetch successfully.',
            'grand_total' => $grand_total,
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

        if (empty($request->quantity) || $request->quantity == 0) {
            $cart = Cart::where(['user_id' => auth()->id(), "product_id" => $request->product_id])->delete();
            return $this->sendResponse($cart, 'Product removed successfully.');
        }

        $cart = Cart::updateOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $validatedData['product_id']
        ], [
            'quantity' => $validatedData['quantity']
        ]);

        return $this->sendResponse($cart, 'Product added in Cart successfully.');
    }

    public function productList(Request $request)
    {
        $user = auth()->user();

        $deliveryAddress = Address::find($request->delivery_address_id);
        if (!$deliveryAddress) {
            return response()->json(['error' => 'Delivery address not found'], 404);
        }

        // Step 4: Find nearest warehouse
        $nearestWarehouse = $this->findNearestWarehouse($deliveryAddress->lat, $deliveryAddress->long);
        if (!$nearestWarehouse) {
            return response()->json(['error' => 'No warehouse found near the pickup address'], 404);
        }

        // Step 1: Warehouse IDs based on city_id, or fallback to single warehouse_id
        $warehouseIds = Warehouse::where('id', $nearestWarehouse->id)->pluck('id');

        // Step 2: Query Inventory with relationships and filters
        $inventories = Inventory::with(['cart' => function ($q) use ($user) {
            $q->where('user_id', $user->id);
        }])
            ->whereIn('warehouse_id', $warehouseIds)
            ->when($request->inventory_type, function ($q) use ($request) {
                return $q->where('inventary_sub_type', $request->inventory_type);
            })
            ->latest('id')
            ->paginate(10);

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
        if (empty($request->product_id)) {
            $cart = Cart::where('user_id', auth()->id())->delete();

            return $this->sendResponse('Products removed successfully.');
        }
        Cart::where(['user_id' => auth()->id(), "product_id" => $request->product_id])->delete();
        return $this->sendResponse('Product removed successfully.');
    }

    private function findNearestWarehouse($latitude, $longitude)
    {
        // Fetch all warehouses
        $warehouses = Warehouse::all();

        // Initialize variables to track the nearest warehouse
        $nearestWarehouse = null;
        $shortestDistance = PHP_FLOAT_MAX;

        // Loop through warehouses to calculate distance
        foreach ($warehouses as $warehouse) {
            $distance = $this->calculateDistance(
                $latitude,
                $longitude,
                $warehouse->lat,
                $warehouse->long
            );

            // Update nearest warehouse if current one is closer
            if ($distance < $shortestDistance) {
                $shortestDistance = $distance;
                $nearestWarehouse = $warehouse;
            }
        }

        return $nearestWarehouse;
    }
    
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Haversine formula to calculate distance in kilometers
        $earthRadius = 6371; // Radius of the Earth in km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Distance in km
    }
}
