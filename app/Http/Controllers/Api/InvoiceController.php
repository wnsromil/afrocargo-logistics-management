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

    public function invoiceOrderCreateServiceold(Request $request)
    {
        // return $request->all();
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                // 'customer_id' => 'required',
                // 'ship_customer_id' => 'required',
                // 'container_id' => 'required',
                'customer_subcategories_data' => 'nullable', // JSON format required
                'driver_subcategories_data' => 'nullable',   // JSON format required
                'total_amount' => 'required|numeric|min:0',
                'parcel_card_ids' => 'required|array',
                'payment_type' => 'required|in:COD,Online,Cash',
                // 'status' => 'required|in:Pending',
                'pickup_time' => 'required|string',
                'pickup_date' => 'required|date',
            ]);

            // Assign customer ID
            $validatedData['driver_id'] = $this->user->id;
            $validatedData['parcel_type'] = 'Service';
            $validatedData['add_order'] = 'driver';
            $validatedData['estimate_cost'] = $request->estimate_cost ?? null;
            // Convert parcel_card_ids to parcel_car_ids
            $validatedData['parcel_car_ids'] = $validatedData['parcel_card_ids'];
            unset($validatedData['parcel_card_ids']);

            // **JSON Encode Arrays Properly**
            if (!empty($request->customer_subcategories_data)) {
                // Ensure it's an array before encoding
                $customerData = is_string($request->customer_subcategories_data) ? json_decode($request->customer_subcategories_data, true) : $request->customer_subcategories_data;
                $validatedData['customer_subcategories_data'] = json_encode($customerData, JSON_UNESCAPED_UNICODE);
            }

            if (!empty($request->driver_subcategories_data)) {
                // Ensure it's an array before encoding
                $driverData = is_string($request->driver_subcategories_data) ? json_decode($request->driver_subcategories_data, true) : $request->driver_subcategories_data;
                $validatedData['driver_subcategories_data'] = json_encode($driverData, JSON_UNESCAPED_UNICODE);
            }

            // Create Parcel
            $Parcel = Parcel::create($validatedData);

            // Create Parcel History
            ParcelHistory::create([
                'parcel_id' => $Parcel->id,
                'created_user_id' => $this->user->id,
                'customer_id' => $validatedData['customer_id'],
                'status' => 'Created',
                'parcel_status' => 1,
                'description' => json_encode($validatedData, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);

            Invoice::create([
                'generated_by' => 'driver',
                'generated_status' => 'view_only',
                'issue_date' => now()->format('Y-m-d'),
                'parcel_id' => $Parcel->id,
                'user_id' => $this->user->id,
                'total_amount' => $request->total_amount,
                'is_paid' => $request->payment_status === 'Paid' ? 1 : 0,
                'invoice_no' => 'INV-' . rand(1000000, 9999999),
            ]);

            return $this->sendResponse($Parcel, 'Order added successfully.');
        } catch (Exception $e) {
            // Log the error
            Log::error('Parcel Store Error: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the parcel.',
                'error' => $e->getMessage(),
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
        $query = Invoice::where('user_id', $id)->with(['invoiceParcelData','deliveryAddress','pickupAddress','createdByUser','container','driver','invoiceParcelData','comments','individualPayment','barcodes','warehouse','claims']);
        
        // Invoice::where('user_id', $id)->select(['id', 'issue_date', 'invoice_no', 'parcel_id'])
        //     ->with(['parcel']); // Assuming relation name is 'parcel'

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


    public function invoiceOrderCreateService(Request $request)
    {
        // return $request->all();
        
        $validated = $request->validate([
            'invoce_type' => 'required|in:services,supplies',
            'customer_id' => 'required|exists:addresses,id',
            'ship_customer_id' => 'nullable|required_if:invoce_type,services|exists:addresses,id',
            'container_id' => 'nullable|required_if:invoce_type,services|required_if:transport_type,cargo|numeric',
            'warehouse_id' => 'nullable|numeric',
            'ins' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'balance' => 'nullable|numeric',
            'total_price' => 'required|numeric',
            'total_qty' => 'required|numeric',
            'customer_subcategories_data' => 'nullable|string',
            'duedaterange' => 'nullable|string',
            'pickup_date' => 'nullable|date_format:Y-m-d',
            'pickup_time' => 'nullable',
            'invoice_no' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'payment' => 'required|numeric',
            'status' => 'required',
            'is_paid' => 'nullable|boolean'
        ]);
        $invoiceItems = json_decode($request->input('customer_subcategories_data'), true);
        $invoice = null;
        if(!empty($request->parcel_id)){
            $invoice = Invoice::where('parcel_id',$request->parcel_id)->first();
        }
        if(empty($invoice)){
            $invoice = new Invoice();
        }
        
        $invoice->generated_by = 'admin';
        // $invoice->generated_by = auth()->user()->role ?? 'admin';
        $invoice->invoce_type = $request->invoce_type;
        $invoice->delivery_address_id = $request->customer_id;
        $invoice->pickup_address_id = $request->ship_customer_id ?? null;
        $invoice->ins = $request->ins ?? 0;
        $invoice->discount = $request->discount ?? 0;
        $invoice->tax = $request->tax ?? 0;
        $invoice->weight = $request->weight ?? 0;
        $invoice->price = $request->value ?? 0;
        $invoice->balance = $request->balance ?? 0;
        $invoice->total_price = $request->total_price;
        $invoice->total_qty = $request->total_qty ?? 0;
        $invoice->descrition = $request->descrition ?? null;
        $invoice->invoce_item = $invoiceItems; // should be already JSON from frontend
        $invoice->duedaterange = $request->pickup_time;
        $invoice->currentdate = $request->pickup_date; 
        $invoice->warehouse_id = $request->warehouse_id;
        $invoice->driver_id = auth()->id();
        if($request->container_id){
            $invoice->container_id = $request->container_id;
        }
        $invoice->currentTime = $request->currentTime;
        $invoice->generated_status = $request->generated_status ?? 'generated';
        $invoice->issue_date = now();
        $invoice->user_id = auth()->id();
        // $invoice->create_by = auth()->id();
        $invoice->total_amount = $request->total_amount;
        $invoice->grand_total = $request->grand_total;
        $invoice->payment = $request->payment;
        $invoice->status = $request->status;
        $invoice->is_paid = $request->is_paid ?? 0;
        if($request->invoice_no){
            $invoice->invoice_no = $request->invoice_no;
        }
        if($request->transport_type){
            $invoice->transport_type = $request->transport_type;
        }
    
        $invoice->save();

        $validated =[
            'invoice_id' => $invoice->id,
            'created_by' => auth()->id(),
            'personal' => 'Yes',
            'currency' => 'USD',
            'payment_type' => $request->payment_type ?? 'Cash',
            'payment_amount' => $invoice->payment,
            'reference' => 'NA',
            'comment' => 'NA',
            'invoice_amount' => $invoice->grand_total,
            'total_balance' => $invoice->balance,
            'exchange_rate_balance' => '0',
            'applied_payments' => '0',
            'applied_total_usd' => '0',
            'current_balance' => '0',
            'exchange_rate' => '0',
            'balance_after_exchange_rate' => '0',
            'payment_date' => now(),
        ];
        if($invoice->payment>0){
            $data = $this->individualPayment($validated);
        }

        return $this->sendResponse($invoice, 'Invoice saved successfully.');
   
    }
    
    protected function individualPayment($validated){
        // Save individual payment
        $payment = IndividualPayment::create($validated);

        // Update the associated invoice
        if ($validated['invoice_id']) {
            $invoice = Invoice::find($validated['invoice_id']);
            if ($invoice) {
                // Subtract payment from invoice balance
                $newBalance = $invoice->balance - $validated['payment_amount'];

                $invoice->balance = $newBalance;

                // Optional: update payment field (total paid so far)
                $invoice->payment = ($invoice->payment ?? 0) + $validated['payment_amount'];

                // If fully paid, update is_paid and status
                if ($newBalance <= 0) {
                    $invoice->is_paid = 1;
                    $invoice->status = 'paid'; // or whatever status indicates payment completion
                }

                $invoice->save();
            }
        }

        return $payment;
    }

    protected function saveInvoiceHistory($invoice_id, $status, $orderData = [])
    {
        $invoice = Invoice::with(['deliveryAddress', 'pickupAddress'])->findOrFail($invoice_id);

        // Create invoice history
        InvoiceHistory::create([
            'invoice_id' => $invoice_id,
            'status' => $status,
            'created_by' => auth()->id(),
            'histry_info' => $invoice // Typo fixed from 'histry_info'
        ]);

        $parcel = null;
        $typeMap = ['services' => 'Service', 'supplies' => 'Supply'];

        $validatedData = [
            'parcel_type' => $typeMap[strtolower($invoice->invoce_type ?? 'service')] ?? 'Service',
            'total_amount' => $invoice->total_amount,
            'partial_payment' => $invoice->total_amount,
            'remaining_payment' => $invoice->total_amount,
            'descriptions' => $invoice->descrition ?? null,
            'weight' => $invoice->weight ?? null,
            'destination_address' => optional($invoice->deliveryAddress)->address,
            'destination_user_name' => optional($invoice->deliveryAddress)->full_name,
            'destination_user_phone' => optional($invoice->deliveryAddress)->mobile_number,
            'pickup_address_id' => optional($invoice->pickupAddress)->id,
            'delivery_address_id' => optional($invoice->deliveryAddress)->id,
            'pickup_time' => $invoice->duedaterange ?? null,
            'pickup_date' => $invoice->currentdate ?? now()->format('Y-m-d'),
            'customer_id' => $invoice->customer_id ?? auth()->id(),
            'payment_status' => ($invoice->total_amount > 0) ? 'Partial' : 'Paid'
        ];

        if (empty($invoice->parcel_id)) {
    
            $validatedData['weight'] = $orderData['weight'] ?? 0;
            $validatedData['estimate_cost'] = $orderData['estimate_cost'] ?? null;
            $validatedData['source_address'] = $orderData['source_address'] ?? optional($invoice->pickupAddress)->address;

            $parcel = Parcel::create($validatedData);

            $invoice->update(['parcel_id' => $parcel->id]);
        } else {
            $parcel = Parcel::find($invoice->parcel_id);
            $parcel->update($validatedData);
        }
        

        // Save inventory items to ParcelInventorie
        foreach ($invoice->invoce_item ?? [] as $item) {
            if(!empty($item['supply_id'])){
                $supply =  ParcelInventorie::updateOrCreate(
                            [
                                'parcel_id' => $invoice->parcel_id,
                                'invoice_id' => $invoice->id,
                                'inventorie_id' => $item['supply_id'],
                            ],
                            [
                                'inventorie_item_quantity' => $item['qty'],
                                'inventory_name' => $item['supply_name'],
                                'label_qty' => $item['label_qty'],
                                'price' => $item['price'],
                                'ins' => $item['ins'],
                                'tax' => $item['tax'],
                                'discount' => $item['discount'] ?? 0,
                                'total' => $item['total'],
                            ]
                        );
                if($status != 'updated'){
                    for ($i=0; $i < $item['label_qty']; $i++) { 
                        store_barcode([
                            'parcel_id' => $invoice->parcel_id,
                            'invoice_id' => $invoice->id,
                            'supply_id' => $supply->id,
                        ]);
                    }
                }

            }
        }

        // Create parcel history (if parcel was created or exists)
        if ($parcel) {
            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => auth()->id(),
                'customer_id' => $invoice->customer_id ?? optional($invoice->deliveryAddress)->user_id,
                'warehouse_id' => $invoice->warehouse_id,
                'status' => $status,
                'description' => $parcel
            ]);
        }

        return $parcel;
    }

}
