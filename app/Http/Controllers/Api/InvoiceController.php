<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\{
    User,
    Category,
    Warehouse,
    Stock,
    Inventory,
    Parcel,
    Vehicle,
    ParcelHistory,
    InvoiceHistory,
    IndividualPayment,
    ParcelInventorie,
    HubTracking,
    Invoice,
    Country,
    Address,
    InvoiceComment
};
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceSend;

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

    public function invoices_download(Request $request, $b64id)
    {
        // Validate that $b64id is a non-empty string
        if (empty($b64id) || !is_string($b64id)) {
            return response()->json([
            'status' => 'error',
            'message' => 'Invalid invoice identifier.',
            ], 400);
        }

        try {
            $id = decrypt($b64id); // Decrypt the ID from base64
        } catch (\Exception $e) {
            return response()->json([
            'status' => 'error',
            'message' => 'Failed to decrypt invoice identifier.',
            ], 400);
        }
        $invoice = Invoice::with(['deliveryAddress', 'pickupAddress','individualPayment'])->findOrFail($id);
        $invoiceHistory = InvoiceHistory::with('createdByUser')->where('invoice_id', $id)->latest()->get();
        // return view('admin.Invoices.pdf.labels', compact('invoice', 'invoiceHistory'));
        if($request->type == 'labels'){
            $pdf = Pdf::loadView('admin.Invoices.pdf.labels', [
                'invoice' => $invoice,
                'invoiceHistory' => $invoiceHistory
            ]);
            // Generate a filename
            $filename = 'invoice-' . $invoice->invoice_no . '.pdf';
        }else{
            // Load the PDF first
            $pdf = Pdf::loadView('admin.Invoices.pdf.invoicepdf', [
                'invoice' => $invoice,
                'invoiceHistory' => $invoiceHistory
            ]);

            // Generate a filename
            $filename = 'labels-' . $invoice->invoice_no . '.pdf';
        }
        


        // Set paper options
        // $pdf->setPaper('A4', 'portrait');

        $pdf->setPaper('A4', 'landscape');

        // First return the PDF as a response to load it
        // Then you can call download() on the client side if needed
        return $pdf->stream($filename);
        
        // Alternatively, if you want to force download immediately:
        // return $pdf->download($filename);

        // return view('admin.Invoices.pdf.labels', compact('invoice', 'invoiceHistory'));
    }

    public function sendInvoice(Request $request)
    {
        $id = $request->invoice_id;
        $invoice = Invoice::with(['deliveryAddress', 'pickupAddress','individualPayment'])->findOrFail($id);
        $email = $request->email;

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Invalid email address.');
        }

        // Send email logic here (e.g., using a Mailable class)
        Mail::to($email)->send(new InvoiceSend($invoice));

        return response()->json([
            'status' => 'success',
            'message' => 'Invoice sent to ' . $email
        ]);
    }

    public function barcode(Request $request)
    {
        $validator = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'action' => 'required|in:get,generate',
            'qty' => 'required_if:action,generate|integer|min:1|max:100',
            'description' => 'nullable|string|max:255',
            'supply_id' => 'nullable|exists:supplies,id'
        ]);
        $id = $request->invoice_id;
        $action = $request->action ?? 'get';
        $qty = $request->qty ?? 1;

        $invoice = Invoice::with('barcodes')->findOrFail($id);

        $barcodeData = [
                    'parcel_id' => $invoice->parcel_id,
                    'invoice_id' => $invoice->id
                ];

        if(isset($request->description)) {
            $barcodeData['description'] = $request->description;
        }

        if(isset($request->supply_id)) {
            $barcodeData['supply_id'] = $request->supply_id;
        }

        if($action == 'generate') {
            for ($i=0; $i < $qty; $i++) { 
                store_barcode($barcodeData);
            }
        }
        

        return response()->json([
            'status' => 'success',
            'message' => 'Barcode generated successfully',
            'invoice'=>$invoice
        ]);
    }

    public function getContainersByWarehouse(Request $request)
    {
        $containers = Vehicle::when($request->warehouse_id,function(){
            return Vehicle::where('warehouse_id', request()->warehouse_id);
        })->where('vehicle_type','Container')->get();

        return response()->json([
            'status' => 'success',
            'containers' => $containers
        ]);
    }

}
