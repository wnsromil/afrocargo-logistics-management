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

    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        // Optionally, delete related records (e.g., InvoiceHistory, IndividualPayment, ParcelInventorie)
        // InvoiceHistory::where('invoice_id', $id)->delete();
        IndividualPayment::where('invoice_id', $id)->delete();
        ParcelInventorie::where('invoice_id', $id)->update(['invoice_id'=>null]);

        $invoice->delete();

        return response()->json([
            'status' => true,
            'message' => 'Invoice deleted successfully',
        ]);
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

    public function invoicesGet(Request $request,$type)
    {
        $search = $request->input('search');
        $query = Invoice::
        when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->
        with(['invoiceParcelData','deliveryAddress','pickupAddress','createdByUser','container','driver','invoiceParcelData','comments','individualPayment','barcodes','warehouse','claims']);

        if ($type !== 'All') {
            // Join with parcel and filter by parcel_type
            $query->when($type, function ($q) use ($type) {
                $q->where('invoce_type', $type);
            });
        }
        $query->when($request->input('customer_id'), function ($q) use ($request) {
            
            return $q->whereHas('pickupAddress', function ($q) use ($request) {
                        $q->where('user_id', $request->input('customer_id'));
                    })
            ->orWhereHas('deliveryAddress', function ($q) use ($request) {
                        $q->where('user_id', $request->input('customer_id'));
                    });
            

        })->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('invoice_no', 'like', "%$search%")
                    ->orWhere('total_amount', 'like', "%$search%")
                    ->orWhere('invoce_type', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    // 🔹 Search in related tables
                    ->orWhereHas('pickupAddress', function ($q) use ($search) {
                        $q->where('full_name', 'like', "%$search%")
                        ->orWhere('address', 'like', "%$search%")
                        ->orWhere('mobile_number', 'like', "%$search%");
                    })
                    ->orWhereHas('deliveryAddress', function ($q) use ($search) {
                        $q->where('full_name', 'like', "%$search%")
                        ->orWhere('address', 'like', "%$search%")
                        ->orWhere('mobile_number', 'like', "%$search%");
                    })
                    // ->orWhereHas('driver', function ($q) use ($search) {
                    //     $q->where('name', 'like', "%$search%");
                    // })
                    ->orWhereHas('warehouse', function ($q) use ($search) {
                        $q->where('warehouse_name', 'like', "%$search%");
                    });
                });
            });

        $invoices = $query->paginate(5);

        return response()->json($invoices);
    }

    public function invoices_download(Request $request, $b64id)
    {
        // Check if $b64id is a base64-encoded string or a simple integer ID
        if (is_numeric($b64id)) {
            $id = (int)$b64id;
        } else {
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
        }
        $invoice = Invoice::with(['invoiceParcelData','deliveryAddress','pickupAddress','createdByUser','container','driver','invoiceParcelData','comments','individualPayment','barcodes','warehouse','claims'])->where('id',$id)->first();
        $invoiceHistory = InvoiceHistory::with('createdByUser')->where('invoice_id', $id)->latest()->get();
        if($request->type == 'page'){
            return view('admin.Invoices.pdf.labels', compact('invoice', 'invoiceHistory'));
        }
        if($request->type == 'pagenew'){
            return view('admin.Invoices.pdf.labels_new', compact('invoice', 'invoiceHistory'));
        }
        if($request->type == 'labels'){
            if(empty($invoice->barcodes)){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Barcode not generated yet.',
                ]);
            }
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
        $pdf->setPaper('A4', 'portrait');

        // $pdf->setPaper('A4', 'landscape');

        // First return the PDF as a response to load it
        // Then you can call download() on the client side if needed
        return $pdf->stream($filename);
        
        // Alternatively, if you want to force download immediately:
        // return $pdf->download($filename);

        // return view('admin.Invoices.pdf.labels', compact('invoice', 'invoiceHistory'));
    }


    public function sendInvoice(Request $request)
    {
        $validator = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'send_type' => 'required|string',
        ]);
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

    public function invoiceOrderCreateService(Request $request)
    {
        // return $request->all();
        
        $validated = $request->validate([
            'invoce_type' => 'required|in:services,supplies',
            'customer_id' => 'required|exists:users,id',
            'ship_customer_id' => 'nullable|required_if:invoce_type,services|exists:users,id',
            'container_id' => 'nullable|numeric',
            'warehouse_id' => 'nullable|numeric',
            'ins' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'balance' => 'nullable|numeric',
            'service_fee' => 'nullable|numeric',
            'total_price' => 'required|numeric',
            'total_qty' => 'required|numeric',
            'customer_subcategories_data' => 'nullable|array',
            'duedaterange' => 'nullable|string',
            'pickup_date' => 'nullable|date_format:Y-m-d',
            'pickup_time' => 'nullable',
            'invoice_no' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'payment' => 'required|numeric',
            'status' => 'nullable|string',
            'is_paid' => 'nullable|boolean'
        ]);
        $invoiceItems = $request->input('customer_subcategories_data');
        // $invoiceItems = is_array($request->input('customer_subcategories_data')) ? $request->input('customer_subcategories_data'):json_decode($request->input('customer_subcategories_data'), true);
        $invoice = null;
        if(!empty($request->parcel_id)){
            $invoice = Invoice::where('parcel_id',$request->parcel_id)->first();
        }
        if(empty($invoice)){
            $invoice = new Invoice();
        }
        if(!empty($request->parcel_id)){
            $invoice->invoice_no = $request->parcel_id;
        }
        $delivery_address = Address::where('user_id',$request->ship_customer_id)->where('default_address','Yes')->first();

        if(empty($delivery_address)){
            $delivery_user = User::where('id',$request->ship_customer_id)->first();
            if(!empty($delivery_user)){
                $delivery_address = Address::create([
                'user_id' =>  $delivery_user->id,
                'address' =>  $delivery_user->address,
                'name' =>  $delivery_user->name,
                'last_name' =>  $delivery_user->name.' '.$delivery_user->last_name,
                'full_name' =>  $delivery_user->last_name,
                'city_id' =>  $delivery_user->city_id ?? null,
                'state_id' =>  $delivery_user->state_id ?? null,
                'country_id' =>  $delivery_user->country_id,
                'pincode' =>  $delivery_user->pincode ?? null,
                'mobile_number'=>  $delivery_user->phone ?? null,
                'mobile_number_code_id'=>  $delivery_user->phone_code_id ?? null,
                'alternative_mobile_number_code_id'=>  $delivery_user->phone_2_code_id_id ?? null,
                'alternative_mobile_number'=>  $delivery_user->phone_2 ?? null,
                'address_2' =>  $delivery_user->address_2,
                'default_address' => 'Yes',
            ]);
            }
            
        }

        $pickup_address = Address::where('user_id',$request->customer_id)->where('default_address','Yes')->first(); 

        if(empty($pickup_address)){
            $pickup_user = User::where('id',$request->customer_id)->first();
            if(!empty($pickup_user)){
                $pickup_address = Address::create([
                    'user_id' =>  $pickup_user->id,
                    'address' =>  $pickup_user->address,
                    'name' =>  $pickup_user->name,
                    'last_name' =>  $pickup_user->name.' '.$pickup_user->last_name,
                    'full_name' =>  $pickup_user->last_name,
                    'city_id' =>  $pickup_user->city_id ?? null,
                    'state_id' =>  $pickup_user->state_id ?? null,
                    'country_id' =>  $pickup_user->country_id ?? null,
                    'pincode' =>  $pickup_user->pincode ?? null,
                    'mobile_number'=>  $delivery_user->phone ?? null,
                    'mobile_number_code_id'=>  $delivery_user->phone_code_id ?? null,
                    'alternative_mobile_number_code_id'=>  $delivery_user->phone_2_code_id_id ?? null,
                    'alternative_mobile_number'=>  $delivery_user->phone_2 ?? null,
                    'address_2' =>  $delivery_user->address_2,
                    'default_address' => 'Yes',
                ]);
            }
        }
        
        
        $invoice->generated_by = \Auth::user()->role ?? 'admin';
        // $invoice->generated_by = auth()->user()->role ?? 'admin';
        $invoice->invoce_type = $request->invoce_type;
        $invoice->delivery_address_id = $delivery_address ? $delivery_address->id : null; 
        $invoice->pickup_address_id = $pickup_address ? $pickup_address->id : null; 
        $invoice->ins = $request->ins ?? 0;
        $invoice->discount = $request->discount ?? 0;
        $invoice->tax = $request->tax ?? 0;
        $invoice->weight = $request->weight ?? 0;
        $invoice->price = $request->value ?? 0;
        $invoice->balance = $request->balance ?? 0;
        $invoice->service_fee = $request->service_fee ?? 0;
        $invoice->total_price = $request->total_price;
        $invoice->total_qty = $request->total_qty ?? 0;
        $invoice->descrition = $request->descrition ?? null;
        $invoice->invoce_item = $invoiceItems; // should be already JSON from frontend
        $invoice->duedaterange = $request->pickup_time;
        $invoice->currentdate = $request->pickup_date; 
        $invoice->warehouse_id = $this->user->warehouse_id;
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

        $this->saveInvoiceHistory($invoice->id,"updated");

        return $this->sendResponse($invoice, 'Invoice saved successfully.');
   
    }

    public function invoiceUpdate(Request $request, $id)
    {
        // return $request->all();
        
        $validated = $request->validate([
            'invoce_type' => 'required|in:services,supplies',
            'customer_id' => 'required|exists:users,id',
            'ship_customer_id' => 'nullable|required_if:invoce_type,services|exists:users,id',
            'container_id' => 'nullable|numeric',
            'warehouse_id' => 'nullable|numeric',
            'ins' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'balance' => 'nullable|numeric',
            'service_fee' => 'nullable|numeric',
            'total_price' => 'required|numeric',
            'total_qty' => 'required|numeric',
            'customer_subcategories_data' => 'nullable|array',
            'duedaterange' => 'nullable|string',
            'pickup_date' => 'nullable|date_format:Y-m-d',
            'pickup_time' => 'nullable',
            'invoice_no' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'payment' => 'required|numeric',
            'status' => 'nullable|string',
            'is_paid' => 'nullable|boolean'
        ]);

        $invoiceItems = $request->input('customer_subcategories_data');
        
        $invoice = Invoice::findOrFail($id);
        $invoice->generated_by = \Auth::user()->role ?? $invoice->generated_by;
        $invoice->invoce_type = $request->invoce_type;
        

        // $invoice->generated_by = auth()->user()->role ?? 'admin';
        $invoice->invoce_type = $request->invoce_type;
        $invoice->delivery_address_id = Address::where('user_id',$request->ship_customer_id)->where('default_address','Yes')->first()->id ?? null;
        $invoice->pickup_address_id = Address::where('user_id',$request->customer_id)->where('default_address','Yes')->first()->id ?? null; 
        $invoice->ins = $request->ins ?? 0;
        $invoice->discount = $request->discount ?? 0;
        $invoice->tax = $request->tax ?? 0;
        $invoice->weight = $request->weight ?? 0;
        $invoice->price = $request->value ?? 0;
        $invoice->balance = $request->balance ?? 0;
        $invoice->service_fee = $request->service_fee ?? 0;
        $invoice->total_price = $request->total_price;
        $invoice->total_qty = $request->total_qty ?? 0;
        $invoice->descrition = $request->descrition ?? null;
        $invoice->invoce_item = $invoiceItems; // should be already JSON from frontend
        $invoice->duedaterange = $request->pickup_time;
        $invoice->currentdate = $request->pickup_date; 
        $invoice->warehouse_id = $this->user->warehouse_id;
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
        if ($request->invoice_no) {
            $invoice->invoice_no = $request->invoice_no;
        }
        if($request->transport_type){
            $invoice->transport_type = $request->transport_type;
        }

        $invoice->save();

        $this->saveInvoiceHistory($invoice->id,"updated");

        return $this->sendResponse($invoice, 'Invoice updated successfully.');
   
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
        $invoice = Invoice::with(['barcodes','deliveryAddress', 'pickupAddress'])->findOrFail($invoice_id);

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
            'pickup_address_id' => optional($invoice->deliveryAddress)->id,
            'delivery_address_id' => optional($invoice->pickupAddress)->id, 
            'pickup_time' => $invoice->duedaterange ?? null,
            'pickup_date' => $invoice->currentdate ?? now()->format('Y-m-d'),
            'customer_id' => $invoice->customer_id ?? auth()->id(),
            'payment_status' => ($invoice->total_amount > 0) ? 'Partial' : 'Paid',
            'invoice_id'=>$invoice_id,
            'transport_type' => $invoice->transport_type ?? 'null',
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
                if(!empty($item['inventory_id'])){
                    $cp = [
                                'parcel_id' => $invoice->parcel_id,
                                'id' => $item['inventory_id'],
                            ];
                }else{
                    $cp = [
                                'parcel_id' => $invoice->parcel_id,
                                'invoice_id' => $invoice->id,
                                'inventorie_id' => $item['supply_id'],
                            ];
                }
                $supply =  ParcelInventorie::updateOrCreate(
                            $cp,
                            [
                                'invoice_id' => $invoice->id,
                                'inventorie_item_quantity' => $item['qty'],
                                'inventory_name' => $item['supply_name'],
                                'label_qty' => $item['label_qty'],
                                'price' => $item['price'] ?? 0,
                                'volume' => $item['volume'] ?? 0,
                                'value' => $item['value'] ?? 0,
                                'ins' => $item['ins'] ?? 0,
                                'tax' => $item['tax'] ?? 0,
                                'discount' => $item['discount'] ?? 0,
                                'total' => $item['total'],
                            ]
                        );
                if(!empty($invoice->barcodes)){
                    for ($i=0; $i < $item['qty']; $i++) { 
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
