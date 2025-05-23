<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    Address
};
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default pagination

        $invoices = Invoice::with(['customer', 'driver', 'warehouse']) // ✅ Include relationships
            ->when($this->user->role_id != 1, function ($q) {
                // Uncomment if warehouse filtering is required
                // return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('tracking_number', 'like', "%$search%")
                        ->orWhere('total_amount', 'like', "%$search%")
                        ->orWhere('partial_payment', 'like', "%$search%")
                        ->orWhere('remaining_payment', 'like', "%$search%")
                        ->orWhere('payment_type', 'like', "%$search%")
                        ->orWhere('source_address', 'like', "%$search%")
                        ->orWhere('destination_address', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        // 🔹 Search in related tables
                        ->orWhereHas('customer', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%")
                                ->orWhere('email', 'like', "%$search%");
                        })
                        ->orWhereHas('driver', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        })
                        ->orWhereHas('warehouse', function ($q) use ($search) {
                            $q->where('warehouse_name', 'like', "%$search%");
                        });
                });
            })
            ->latest()
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);

        if ($request->ajax()) {
            return view('admin.Invoices.table', compact('invoices'));
        }

        return view('admin.Invoices.index', compact('invoices', 'search', 'perPage'));
    }


    public function invoices_details($id)
    {
        $getInvoice = Invoice::where('id', $id)->first();
        return view('admin.Invoices.invoicesdetails', compact('getInvoice'));
    }

    public function invoices_download(Request $request, $id)
    {
        $invoice = Invoice::with(['deliveryAddress', 'pickupAddress'])->findOrFail($id);
        $invoiceHistory = InvoiceHistory::with('createdByUser')->where('invoice_id', $id)->latest()->get();
        return view('admin.Invoices.pdf.labels', compact('invoice', 'invoiceHistory'));
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            // return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $customers = $user->where('role_id', 3)->values();

        $drivers = $user->where('role_id', 4)->values();

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        $countries = Country::get();

        $containers = Vehicle::where('vehicle_type','Container')->get();

        $nextInvoiceNo = Invoice::getNextInvoiceNumber();

        $inventories = Inventory::whereIn('inventory_type', ["Supply", "Service"])
        ->get()
        ->groupBy(function ($item) {
            return ucfirst($item->inventory_type);
        });
    


        return view('admin.Invoices.create', compact('warehouses', 'customers', 'drivers', 'parcelTpyes','countries','nextInvoiceNo','containers','inventories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // return $request->all();
        
        $validated = $request->validate([
            'invoce_type' => 'required|in:services,supplies',
            'delivery_address_id' => 'required|exists:addresses,id',
            'pickup_address_id' => 'nullable|required_if:invoce_type,services|exists:addresses,id',
            'container_id' => 'nullable|required_if:invoce_type,services|numeric',
            'driver_id' => 'nullable|numeric',
            'warehouse_id' => 'nullable|numeric',
            'ins' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'balance' => 'nullable|numeric',
            'total_price' => 'required|numeric',
            'total_qty' => 'required|numeric',
            'invoce_item' => 'nullable|string',
            'duedaterange' => 'nullable|string',
            'currentdate' => 'nullable|date_format:m-d-Y',
            'currentTime' => 'nullable',
            'invoice_no' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'payment' => 'required|numeric',
            'status' => 'required',
            'is_paid' => 'nullable|boolean'
        ]);
        $invoiceItems = json_decode($request->input('invoce_item'), true);
        $invoice = new Invoice();
        $invoice->generated_by = \Auth::user()->role ?? 'admin';
        $invoice->invoce_type = $request->invoce_type;
        $invoice->delivery_address_id = $request->delivery_address_id;
        $invoice->pickup_address_id = $request->pickup_address_id ?? null;
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
        $invoice->duedaterange = Carbon::createFromFormat('m-d-Y', $request->currentdate)->format('Y-m-d');
        $invoice->currentdate = Carbon::createFromFormat('m-d-Y', $request->currentdate)->format('Y-m-d'); 
        $invoice->warehouse_id = $request->warehouse_id;
        $invoice->driver_id = $request->driver_id;
        if($request->container_id){
            $invoice->container_id = $request->container_id;
        }
        $invoice->currentTime = $request->currentTime;
        $invoice->generated_status = $request->generated_status ?? 'generated';
        $invoice->issue_date = now();
        $invoice->user_id = auth()->id();
        $invoice->total_amount = $request->total_amount;
        $invoice->grand_total = $request->grand_total;
        $invoice->payment = $request->payment;
        $invoice->status = $request->status;
        $invoice->is_paid = $request->is_paid ?? 0;
        if($request->invoice_no){
            $invoice->invoice_no = $request->invoice_no;
        }
    
        $invoice->save();

        $validated =[
            'invoice_id' => $invoice->id,
            'created_by' => auth()->id,
            'personal' => 'Yes',
            'currency' => 'USD',
            'payment_type' => 'boxcredit',
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

        $this->saveInvoiceHistory($invoice->id,"created");
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice saved successfully.');
   
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ParcelHistories = ParcelHistory::where('parcel_id', $id)
            ->with(['warehouse', 'customer', 'createdByUser'])->paginate(10);

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        return view('admin.Invoices.show', compact('ParcelHistories', 'parcelTpyes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $invoice = Invoice::with(['deliveryAddress','pickupAddress','createdByUser'])->findOrFail($id);

        $invoiceHistory = InvoiceHistory::with('createdByUser')->where('invoice_id',$id)->latest()->first();

        $deliveryAddress = $this->formatAddress($invoice->deliveryAddress);
        $pickupAddress  = $this->formatAddress($invoice->pickupAddress);
        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            // return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $customers = $user->where('role_id', 3)->values();

        $drivers = $user->where('role_id', 4)->values();

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        $countries = Country::get();

        $containers = Vehicle::where('vehicle_type','Container')->get();

        $nextInvoiceNo = Invoice::getNextInvoiceNumber();

        $inventories = Inventory::whereIn('inventory_type', ["Supply", "Service"])
        ->get()
        ->groupBy(function ($item) {
            return ucfirst($item->inventory_type);
        });

        return view('admin.Invoices.edit', compact(
            'invoice','warehouses', 'customers', 'drivers', 
            'parcelTpyes','countries','nextInvoiceNo',
            'containers','inventories','deliveryAddress',
            'pickupAddress','invoiceHistory'));
    }

    protected function formatAddress($address) {
        if (!$address || !$address->user) return null;

        return [
            'id' => $address->id,
            'text' => $address->full_name . ", " . $address->address,
            'name' => $address->user->name,
            'last_name' => $address->user->last_name,
            'phone' => $address->user->mobile_number,
            'full_name' => $address->full_name,
            'mobile_number' => $address->mobile_number,
            'alternative_mobile_number' => $address->alternative_mobile_number,
            'mobile_number_code_id' => $address->mobile_number_code_id ?? 1,
            'alternative_mobile_number_code_id' => $address->alternative_mobile_number_code_id ?? 1,
            'address1' => $address->address,
            'address2' => $address->address_2,
            'pincode' => $address->pincode,
            'country_id' => $address->country_id,
            'state_id' => $address->state_id,
            'city_id' => $address->city_id,
            'address_type' => $address->address_type,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $validated = $request->validate([
            'invoce_type' => 'required|in:services,supplies',
            'delivery_address_id' => 'required|exists:addresses,id',
            'pickup_address_id' => 'nullable|required_if:invoce_type,services|exists:addresses,id',
            'container_id' => 'nullable|required_if:invoce_type,services|numeric',
            'driver_id' => 'nullable|numeric',
            'warehouse_id' => 'nullable|numeric',
            'ins' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'balance' => 'nullable|numeric',
            'total_price' => 'required|numeric',
            'invoce_item' => 'nullable|string',
            'duedaterange' => 'nullable|string',
            'currentdate' => 'nullable|date_format:m-d-Y',
            'currentTime' => 'nullable',
            'invoice_no' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'payment' => 'required|numeric',
            'is_paid' => 'nullable|boolean',
            'status' => 'required'
        ]);

        $invoiceItems = json_decode($request->input('invoce_item'), true);

        $invoice = Invoice::findOrFail($id);
        $invoice->generated_by = \Auth::user()->role ?? $invoice->generated_by;
        $invoice->invoce_type = $request->invoce_type;
        $invoice->delivery_address_id = $request->delivery_address_id ?? null;
        $invoice->pickup_address_id = $request->pickup_address_id ?? null;
        $invoice->ins = $request->ins ?? 0;
        $invoice->discount = $request->discount ?? 0;
        $invoice->tax = $request->tax ?? 0;
        $invoice->weight = $request->weight ?? 0;
        $invoice->price = $request->value ?? 0;
        $invoice->balance = $request->balance ?? 0;
        $invoice->total_price = $request->total_price;
        $invoice->total_qty = $request->total_qty ?? 0;
        $invoice->descrition = $request->descrition ?? null;
        $invoice->invoce_item = $invoiceItems;
        $invoice->duedaterange = $request->duedaterange;
        if($request->currentdate){
            $invoice->currentdate = Carbon::createFromFormat('m-d-Y', $request->currentdate)->format('Y-m-d');
        }
        if($request->currentTime){
            $invoice->currentTime = $request->currentTime;
        }
        $invoice->warehouse_id = $request->warehouse_id;
        $invoice->driver_id = $request->driver_id;
        if($request->container_id){
            $invoice->container_id = $request->container_id;
        }
        $invoice->generated_status = $request->generated_status ?? $invoice->generated_status;
        $invoice->total_amount = $request->total_amount;
        $invoice->grand_total = $request->grand_total;
        $invoice->payment = $request->payment;
        $invoice->status = $request->status;
        $invoice->is_paid = $request->is_paid ?? 0;

        if ($request->invoice_no) {
            $invoice->invoice_no = $request->invoice_no;
        }

        $invoice->save();

        $this->saveInvoiceHistory($invoice->id,"updated");

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function updateNote(Request $request)
    {
        // return $request->all();

        Invoice::where('id',$request->invoice_id)->update([
            'notes'=>$request->notes,
            'created_by'=>auth()->id()
        ]);
        
        return redirect()->back()->with('success', 'Note updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parcel = Parcel::find($id);

        ParcelHistory::create([
            'parcel_id' => $inventory->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel['customer_id'],
            'warehouse_id' => $parcel['warehouse_id'],
            'status' => 'Deleted',
            'parcel_status' => 'Deleted',
            'description' => collect($parcel)
        ]);

        $parce->delete();
        return redirect()->route('admin.Invoices.index')
            ->with('success', 'Order deleted successfully');
    }

    public function customerSearch(Request $request)
    {
        if (!$request->search) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a search term'
            ], 400);
        }

        $searchTerm = '%' . $request->search . '%';

        $users = User::leftJoin('addresses', 'users.id', '=', 'addresses.user_id')
            ->where('users.role_id', 2)
            ->where(function($query) use ($searchTerm) {
                $query->where('users.name', 'like', $searchTerm)
                    ->orWhere('users.email', 'like', $searchTerm)
                    ->orWhere('users.phone', 'like', $searchTerm)
                    ->orWhere('addresses.full_name', 'like', $searchTerm)
                    ->orWhere('addresses.mobile_number', 'like', $searchTerm)
                    ->orWhere('addresses.alternative_mobile_number', 'like', $searchTerm)
                    ->orWhere('addresses.address', 'like', $searchTerm)
                    ->orWhere('addresses.pincode', 'like', $searchTerm);
            })->when($request->address_type,function($q)use($request){
                return $q->where('addresses.address_type',$request->address_type);
            })
            ->select('users.*', 'addresses.*') // if needed, alias fields to avoid collisions
            ->get()->map(function ($user) {
                $user->parcels = Parcel::with()->leftJoin('invoices', 'parcels.id', '=', 'invoices.parcel_id')
                    ->where('parcels.customer_id', $user->id)
                    ->whereNull('invoices.id')
                    ->select('parcels.*', 'invoices.id as invoice_id')
                    ->get();

                return $user;
            });

            

        if ($users->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No results found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'role_id' => $user->role_id,
                    'text' => ($user->full_name ?? $user->name).", ".$user->address,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'full_name' => $user->full_name,
                    'mobile_number' => $user->mobile_number,
                    'alternative_mobile_number' => $user->alternative_mobile_number,
                    'mobile_number_code_id' => $user->mobile_number_code_id ?? 1,
                    'alternative_mobile_number_code_id' => $user->alternative_mobile_number_code_id ?? 1,
                    'address1' => $user->address,
                    'address2' => $user->address_2,
                    'pincode' => $user->pincode,
                    'country_id' => $user->country_id,
                    'state_id' => $user->state_id,
                    'city_id' => $user->city_id,
                    'address_type' => $user->address_type,
                    'lat' => $user->lat,
                    'long' => $user->long
                ];
            })
        ]);
    }

    public function saveInvoceCustomer(Request $request)
    {
        
        // Validate incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'alternative_mobile_number' => 'nullable|string|max:20',
            'mobile_number_code_id' => 'required|integer',
            'alternative_mobile_number_code_id' => 'required|integer',
            'address' => 'required|string|max:500',
            'address_2' => 'required|string|max:500',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'nullable|integer',
            'zip_code' => 'nullable|string|max:10',
            'address_type' => 'required|in:pickup,delivery',
        ]);

        // Find or create the user based on mobile number
        $user = User::firstOrCreate(
            ['phone' => $validatedData['mobile_number']],
            [
                'name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone_2' => $validatedData['alternative_mobile_number'] ?? null,
                'phone_2_code_id_id' => $validatedData['alternative_mobile_number_code_id'] ?? null,
                'phone_code_id' => $validatedData['mobile_number_code_id'] ?? null,
                'address' => $validatedData['address'],
                'address_2' => $validatedData['address_2'],
                'country_id' => $validatedData['country_id'],
                'state_id' => $validatedData['state_id'],
                'city_id' => $validatedData['city_id'] ?? null,
                'pincode' => $validatedData['zip_code'] ?? null,
                'email' => 'user' . time() . '@example.com', // Dummy email if required
                'password' => bcrypt('password'), // Set a default password
            ]
        );
        if(!empty($request->address_id)){
           $check['id'] =  $request->address_id;
        }else{
            $check = [
                'mobile_number' => $validatedData['mobile_number'],
                'address_type' => $validatedData['address_type'],
            ];
        }

        $address = Address::updateOrCreate(
            $check,
            [
                'full_name' => $validatedData['first_name'] . " " . $validatedData['last_name'],
                'alternative_mobile_number_code_id' => $validatedData['alternative_mobile_number_code_id'] ?? null,
                'mobile_number_code_id' => $validatedData['mobile_number_code_id'] ?? null,
                'alternative_mobile_number' => $validatedData['alternative_mobile_number'] ?? null,
                'address' => $validatedData['address'],
                'address_2' => $validatedData['address_2'] ?? null,
                'country_id' => $validatedData['country_id'],
                'state_id' => $validatedData['state_id'],
                'city_id' => $validatedData['city_id'] ?? null,
                'pincode' => $validatedData['zip_code'] ?? null,
            ]
        );
        

        return response()->json([
            'success' => true,
            'message' => 'Customer and address saved successfully.',
            'user_id' => $user->id,
            'data'=>[
                'id' => $address->id,
                'role_id' => $user->role_id,
                'text' => ($address->full_name ?? $user->name).", ".$address->address,
                'name' => $user->name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'full_name' => $address->full_name,
                'mobile_number' => $address->mobile_number,
                'alternative_mobile_number' => $address->alternative_mobile_number,
                'alternative_mobile_number_code_id' => $address->alternative_mobile_number_code_id,
                'mobile_number_code_id' => $address->mobile_number_code_id,
                'address1' => $address->address,
                'address2' => $address->address_2,
                'pincode' => $user->pincode,
                'country_id' => $address->country_id,
                'state_id' => $address->state_id,
                'city_id' => $address->city_id,
                'address_type' => $address->address_type,
                'lat' => $user->lat,
                'long' => $user->long
            ]
        ]);
    }

    public function saveIndividualPayment(Request $request)
    {
        
        $validated =$request->validate([
            'invoice_id' => 'nullable|exists:invoices,id',
            'created_by' => 'nullable|exists:users,id',
            'personal' => 'nullable|string',
            'currency' => 'required|string',
            'payment_type' => 'required|in:boxcredit,cash,cheque,CreditCard',
            'payment_amount' => 'required|numeric',
            'reference' => 'nullable|string',
            'comment' => 'nullable|string',
            'invoice_amount' => 'required|numeric',
            'total_balance' => 'required|numeric',
            'exchange_rate_balance' => 'nullable|numeric',
            'applied_payments' => 'nullable|numeric',
            'applied_total_usd' => 'nullable|numeric',
            'current_balance' => 'nullable|numeric',
            'exchange_rate' => 'nullable|numeric',
            'balance_after_exchange_rate' => 'nullable|numeric',
            'payment_date' => 'required|date',
        ]);

        $data = $this->individualPayment($validated);
        return redirect()->back()->with('success', 'Payment saved successfully!');
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
            'pickup_time' => now(),
            'pickup_date' => now(),
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
                ParcelInventorie::updateOrCreate(
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
                        'total' => $item['total'],
                    ]
                );
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

