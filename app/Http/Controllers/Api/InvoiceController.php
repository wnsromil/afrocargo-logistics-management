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

            // $users = User::when($user->role_id != 1, function ($q) use ($user) {
            //     return $q->where('warehouse_id', $user->warehouse_id);
            // })->get();

            // $customers = $users->where('role_id', 3)->values();
            // $drivers = $users->where('role_id', 4)->values();

            // $parcelTypes = Category::get();
            $inventaries = Inventory::get();
            $containers = Vehicle::where('vehicle_type', '1')->get();

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'warehouses' => $warehouses,
                // 'customers' => $customers,
                // 'drivers' => $drivers,
                // 'parcelTypes' => $parcelTypes,
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
                'shipping_user_id' => 'required',
                'category_id' => 'required|exists:categories,id',
                'total_price' => 'required|numeric',
                'inventory_ids.*' => 'exists:inventories,id',
            ]);

            // Create New Invoice
            $invice = Invoice::create([
                'customer_id' => $validatedData['customer_id'],
                'shipping_user_id' => $validatedData['shipping_user_id'],
                'category_id' => $validatedData['category_id'],
                'total_price' => $validatedData['total_price'],
                'status' => $validatedData['status'],
                'created_by' => $user->id,
                'inventory_ids' => $validatedData['inventory_ids'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Invoice created successfully!',
                'invice' => $invice
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function inventaries()
    {
        $inventaries = Inventory::where('status', 'Active')->get();
        return response()->json([
            'status' => 'success',
            'inventaries' => $inventaries
        ], 200);
    }

    public function invoiceDetails($id)
    {
        $invoice = Invoice::select(['id', 'issue_date', 'invoice_no', 'parcel_id'])
            ->with('invoiceParcelData')->find($id);

        if (!$invoice) {
            return response()->json([
                'status' => false,
                'message' => 'Invoice not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Invoice details fetched successfully',
            'data' => $invoice
        ]);
    }

    public function invoicesGet($type)
    {
        $id = $this->user->id;
        $query = Invoice::where('user_id', $id)->select(['id', 'issue_date', 'invoice_no', 'parcel_id'])
            ->with(['parcel']); // Assuming relation name is 'parcel'

        if ($type !== 'All') {
            // Join with parcel and filter by parcel_type
            $query->whereHas('parcel', function ($q) use ($type) {
                $q->where('parcel_type', $type);
            });
        }

        $invoices = $query->get();

        return response()->json([
            'status' => true,
            'message' => 'Invoices fetched successfully',
            'data' => $invoices
        ]);
    }
}
