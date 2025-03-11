<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Parcel;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        return response()->json('invoice index');
    }

    public function create(Request $request)
    {
        try {
            $user = auth()->user();

            $warehouses = Warehouse::when($user->role_id != 1, function ($q) use ($user) {
                return $q->where('id', $user->warehouse_id);
            })->get();

            $users = User::when($user->role_id != 1, function ($q) use ($user) {
                return $q->where('warehouse_id', $user->warehouse_id);
            })->get();

            $customers = $users->where('role_id', 3)->values();

            $drivers = $users->where('role_id', 4)->values();

            $parcelTypes = Category::get();
            $inventaries = Inventory::get();
            $containers = Vehicle::where('vehicle_type','Container')->get();

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'warehouses' => $warehouses,
                'customers' => $customers,
                'drivers' => $drivers,
                'parcelTypes' => $parcelTypes,
                'inventaries' => $inventaries,
                'containers' => $containers,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            $validatedData = $request->validate([
                'customer_id' => 'required|exists:users,id',
                'driver_id' => 'nullable|exists:users,id',
                'warehouse_id' => 'required|exists:warehouses,id',
                'category_id' => 'required|exists:categories,id',
                'inventory_id' => 'required|exists:inventories,id',
                'weight' => 'required|numeric|min:0',
                'price' => 'required|numeric|min:0',
                'status' => 'required|in:pending,shipped,delivered',
            ]);

            // Store new parcel
            $parcel = Invoice::create([
                'customer_id' => $validatedData['customer_id'],
                'driver_id' => $validatedData['driver_id'] ?? null,
                'warehouse_id' => $validatedData['warehouse_id'],
                'category_id' => $validatedData['category_id'],
                'inventory_id' => $validatedData['inventory_id'],
                'weight' => $validatedData['weight'],
                'price' => $validatedData['price'],
                'status' => $validatedData['status'],
                'created_by' => $user->id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Parcel created successfully!',
                'parcel' => $parcel
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $th->getMessage()
            ], 500);
        }
    }

}
