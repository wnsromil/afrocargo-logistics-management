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
    Address,
    InvoiceComment,
    Claim,
    NotificationParcelMessage,
    Notification
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
        // return $request->all();
        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $drivers = $user->where('role_id', 4)->values();


        $invoices = Invoice::
            //    with(['invoiceParcelData','user','deliveryAddress','pickupAddress','createdByUser','container','driver','invoiceParcelData','comments','individualPayment','barcodes','warehouse','claims'])->
            when($this->user->role_id != 1, function ($q) {
                // Uncomment if warehouse filtering is required
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->when($request->input('warehouse_id'), function ($q) use ($request) {
                return $q->where('warehouse_id', $request->input('warehouse_id'));
            })
            ->when($request->input('driver_id'), function ($q) use ($request) {
                return $q->where('driver_id', $request->input('driver_id'));
            })
            ->when($request->input('invoice_id'), function ($q) use ($request) {
                return $q->where('invoice_no', $request->input('invoice_id'));
            })
            ->when($request->input('transport_type'), function ($q) use ($request) {
                if ($request->input('transport_type') == 'Supply') {
                    return $q->whereNull('transport_type');
                }
                return $q->where('transport_type', $request->input('transport_type'));
            })
            ->when($request->input('datetrange'), function ($q) use ($request) {
                $dates = explode(' - ', $request->input('datetrange'));
                if (count($dates) === 2) {
                    try {
                        $start = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
                        $end = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();
                        // dd($start!=$end,$start,$end);
                        if ($start->format('Y-m-d') != $end->format('Y-m-d')) {
                            $q->whereBetween('created_at', [
                                $start->format('Y-m-d H:i:s'),
                                $end->format('Y-m-d H:i:s')
                            ]);
                        }
                    } catch (\Exception $e) {
                        // Invalid date format, do not apply filter
                    }
                }
            })
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('invoice_no', 'like', "%$search%")
                        ->orWhere('total_amount', 'like', "%$search%")
                        ->orWhere('invoce_type', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        // 🔹 Search in related tables
                        // ->orWhereHas('customer', function ($q) use ($search) {
                        //     $q->where('name', 'like', "%$search%")
                        //     ->orWhere('email', 'like', "%$search%");
                        // })
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
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'warehouse_id' => $request->input('warehouse_id'),
                'driver_id' => $request->input('driver_id'),
                'invoice_id' => $request->input('invoice_id'),
                'datetrange' => $request->input('datetrange'),
            ]);

        if ($request->ajax() && $request->isAjaxPagination == 1) {
            // dd($request);
            return view('admin.Invoices.table', compact('invoices', 'drivers', 'warehouses', 'search', 'perPage'));
        }

        return view('admin.Invoices.index', compact('invoices', 'drivers', 'warehouses', 'search', 'perPage'));
    }

    public function trashed(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default pagination
        // return $request->all();
        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $drivers = $user->where('role_id', 4)->values();


        $invoices = Invoice::
            //    with(['invoiceParcelData','user','deliveryAddress','pickupAddress','createdByUser','container','driver','invoiceParcelData','comments','individualPayment','barcodes','warehouse','claims'])->
            when($this->user->role_id != 1, function ($q) {
                // Uncomment if warehouse filtering is required
                // return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->when($request->input('warehouse_id'), function ($q) use ($request) {
                return $q->where('warehouse_id', $request->input('warehouse_id'));
            })
            ->when($request->input('driver_id'), function ($q) use ($request) {
                return $q->where('driver_id', $request->input('driver_id'));
            })
            ->when($request->input('invoice_id'), function ($q) use ($request) {
                return $q->where('invoice_no', $request->input('invoice_id'));
            })
            ->when($request->input('transport_type'), function ($q) use ($request) {
                if ($request->input('transport_type') == 'Supply') {
                    return $q->whereNull('transport_type');
                }
                return $q->where('transport_type', $request->input('transport_type'));
            })
            ->when($request->input('datetrange'), function ($q) use ($request) {
                $dates = explode(' - ', $request->input('datetrange'));
                if (count($dates) === 2) {
                    try {
                        $start = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
                        $end = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();
                        // dd($start!=$end,$start,$end);
                        if ($start->format('Y-m-d') != $end->format('Y-m-d')) {
                            $q->whereBetween('created_at', [
                                $start->format('Y-m-d H:i:s'),
                                $end->format('Y-m-d H:i:s')
                            ]);
                        }
                    } catch (\Exception $e) {
                        // Invalid date format, do not apply filter
                    }
                }
            })
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('invoice_no', 'like', "%$search%")
                        ->orWhere('total_amount', 'like', "%$search%")
                        ->orWhere('invoce_type', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        // 🔹 Search in related tables
                        ->orWhereHas('pickupAddress', function ($q) use ($search) {
                            $q->where('full_name', 'like', "%$search%");
                        })
                        ->orWhereHas('deliveryAddress', function ($q) use ($search) {
                            $q->where('full_name', 'like', "%$search%");
                        })
                        ->orWhereHas('driver', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        })
                        ->orWhereHas('warehouse', function ($q) use ($search) {
                            $q->where('warehouse_name', 'like', "%$search%");
                        });
                });
            })
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'warehouse_id' => $request->input('warehouse_id'),
                'driver_id' => $request->input('driver_id'),
                'invoice_id' => $request->input('invoice_id'),
                'datetrange' => $request->input('datetrange'),
            ]);

        if ($request->ajax() && $request->isAjaxPagination == 1) {
            // dd($request);
            return view('admin.Invoices.trashed-table', compact('invoices', 'drivers', 'warehouses', 'search', 'perPage'));
        }

        return view('admin.Invoices.trashedIndex', compact('invoices', 'drivers', 'warehouses', 'search', 'perPage'));
    }


    public function invoices_details($id)
    {
        $getInvoice = Invoice::where('id', $id)->first();
        return view('admin.Invoices.invoicesdetails', compact('getInvoice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $customerId = $request->customerId ?? null;
        $type = $request->type ?? null;
        $pickup_address = null;
        $delivery_address = null;

        if ($customerId) {
            $customer = User::join('addresses', function ($join) {
                $join->on('addresses.user_id', '=', 'users.id');
            })->whereIn('users.role', [3, 5])->where('users.id',$customerId)
            ->select('users.*', 'addresses.id as address_id', 'addresses.user_id', 'addresses.full_name', 'addresses.mobile_number', 'addresses.alternative_mobile_number', 'addresses.address', 'addresses.pincode', 'addresses.address_type')
            ->first();


            $pickup_address = $this->formatAddress($customer, null, 'pickup');

            $delivery_address = $this->shipToAddress($customer, null, 'delivery');
        }

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $containers = Vehicle::where('vehicle_type', 1)->when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            // return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $customers = $user->where('role_id', 3)->values();

        $drivers = $user->where('role_id', 4)->values();

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        $countries = Country::get();

        $nextInvoiceNo = Invoice::getNextInvoiceNumber();

        $inventories = Inventory::whereIn('inventary_sub_type', ["Supply", "Service", 'Ocean Cargo', 'Air Cargo'])
            ->where('status', 'Active')
            ->get()
            ->groupBy(function ($item) {
                if ($item->inventary_sub_type != "Supply") {
                    return "Service";
                }
                return ucfirst($item->inventary_sub_type);
            });



        return view('admin.Invoices.create', compact('warehouses', 'customers', 'drivers', 'parcelTpyes', 'countries', 'nextInvoiceNo', 'containers', 'inventories','pickup_address', 'delivery_address','type'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // return $request->all();

        $validated = $request->validate([
            'invoce_type' => 'required|in:services,supplies',
            'arrived_warehouse_id' => 'nullable|numeric',
            'transport_type' => 'nullable|required_if:invoce_type,services|in:Air Cargo,Ocean Cargo',
            'delivery_address_id' => 'required|exists:addresses,id',
            'pickup_address_id' => 'nullable|required_if:invoce_type,services|exists:addresses,id',
            // 'container_id' => 'nullable|required_if:invoce_type,services|required_if:transport_type,cargo|numeric',
            'container_id' => 'nullable|numeric',
            // 'driver_id' => [
            //     'nullable',
            //     'numeric',
            //     function ($attribute, $value, $fail) use ($request) {
            //         if (
            //             isset($request->container_id) &&
            //             is_numeric($request->container_id) &&
            //             $request->container_id > 0 &&
            //             empty($value)
            //         ) {
            //             $fail('The driver field is required when container is selected.');
            //         }
            //     },
            // ],
            'driver_id' => 'nullable|numeric',
            'warehouse_id' => 'required|numeric',
            'ins' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'balance' => 'nullable|numeric',
            'total_price' => 'required|numeric',
            'total_qty' => 'required|numeric',
            'invoce_item' => 'nullable|string',
            'duedaterange' => 'nullable|string',
            'currentdate' => 'nullable|date',
            'currentTime' => 'nullable',
            'invoice_no' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'payment' => 'required|numeric',
            'status' => 'required',
            'is_paid' => 'nullable|boolean'
        ]);
        $invoiceItems = json_decode($request->input('invoce_item'), true);
        $invoice = null;
        if (!empty($request->parcel_id)) {
            $invoice = Invoice::where('parcel_id', $request->parcel_id)->first();
        }
        if (empty($invoice)) {
            $invoice = new Invoice();
        }

        $invoice->generated_by = \Auth::user()->role ?? 'admin';
        $invoice->invoce_type = $request->invoce_type;
        // $invoice->delivery_address_id = $request->delivery_address_id;
        // $invoice->pickup_address_id = $request->pickup_address_id ?? null;
        $invoice->delivery_address_id = $request->pickup_address_id ?? null;
        $invoice->pickup_address_id = $request->delivery_address_id ?? null;

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
        $invoice->duedaterange = $request->currentdate;
        if ($request->currentdate) {
            try {
                $invoice->currentdate = Carbon::parse($request->currentdate)->format('Y-m-d');
            } catch (\Exception $e) {
                $invoice->currentdate = Carbon::now()->format('Y-m-d');
            }
        }
        $invoice->warehouse_id = $request->warehouse_id;
        if ($request->arrived_warehouse_id) {
            $invoice->arrived_warehouse_id = $request->arrived_warehouse_id;
        }

        $invoice->driver_id = $request->driver_id ?? null;
        if ($request->container_id) {
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
        if ($request->transport_type && $request->invoce_type == 'services') {
            $invoice->transport_type = $request->transport_type;
        }
        if ($request->payment_type) {
            $invoice->payment_type = $request->payment_type;
        }
        if ($request->parcel_id) {
            $invoice->parcel_id = $request->parcel_id;
        }
        if ($request->service_fee) {
            $invoice->service_fee = $request->service_fee;
        }

        $invoice->save();

        $validated = [
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
        if ($invoice->payment > 0) {
            $data = $this->individualPayment($validated);
        }

        setting()->saveInvoiceHistory($invoice->id, "created");
        return redirect()->route('admin.invoices.edit',$invoice->id)->with('success', 'Invoice saved successfully.');
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
        $invoice = Invoice::with(['ParcelInventory', 'invoiceParcelData', 'deliveryAddress', 'pickupAddress', 'createdByUser', 'container', 'driver', 'invoiceParcelData', 'comments', 'individualPayment', 'barcodes', 'warehouse', 'claims'])->findOrFail($id);

        $invoiceHistory = InvoiceHistory::with('createdByUser')->where('invoice_id', $id)->latest('id')->first();

        $deliveryAddress = $this->formatAddress($invoice->deliveryAddress, null, 'delivery');
        $pickupAddress  = $this->formatAddress($invoice->pickupAddress, null, 'pickup');
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

        $containers = Vehicle::where('vehicle_type', 1)->when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $nextInvoiceNo = Invoice::getNextInvoiceNumber();

        $inventories = Inventory::whereIn('inventary_sub_type', ["Supply", "Service", 'Ocean Cargo', 'Air Cargo'])
            ->where('status', 'Active')
            ->get()
            ->groupBy(function ($item) {
                if ($item->inventary_sub_type != "Supply") {
                    return "Service";
                }
                return ucfirst($item->inventary_sub_type);
            });

        return view('admin.Invoices.edit', compact(
            'invoice',
            'warehouses',
            'customers',
            'drivers',
            'parcelTpyes',
            'countries',
            'nextInvoiceNo',
            'containers',
            'inventories',
            'deliveryAddress',
            'pickupAddress',
            'invoiceHistory'
        ));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $validated = $request->validate([
            'invoce_type' => 'required|in:services,supplies',
            'arrived_warehouse_id' => 'nullable|numeric',
            'transport_type' => 'nullable|required_if:invoce_type,services|in:Air Cargo,Ocean Cargo',
            'delivery_address_id' => 'required|exists:addresses,id',
            'pickup_address_id' => 'nullable|required_if:invoce_type,services|exists:addresses,id',
            // 'container_id' => 'nullable|required_if:invoce_type,services|required_if:transport_type,cargo|numeric',
            'container_id' => 'nullable|numeric',
            'driver_id' => 'nullable|numeric',
            'warehouse_id' => 'required|numeric',
            'ins' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'balance' => 'nullable|numeric',
            'total_price' => 'required|numeric',
            'invoce_item' => 'nullable|string',
            'duedaterange' => 'nullable|string',
            'currentdate' => 'nullable|date',
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
        // $invoice->delivery_address_id = $request->delivery_address_id ?? null;
        // $invoice->pickup_address_id = $request->pickup_address_id ?? null;

        $invoice->delivery_address_id = $request->pickup_address_id ?? null;
        $invoice->pickup_address_id = $request->delivery_address_id ?? null;
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
        if ($request->parcel_id) {
            $invoice->parcel_id = $request->parcel_id;
        }
        if ($request->service_fee) {
            $invoice->service_fee = $request->service_fee;
        }
        if ($request->currentdate) {
            try {
                $invoice->currentdate = Carbon::parse($request->currentdate)->format('Y-m-d');
            } catch (\Exception $e) {
                $invoice->currentdate = Carbon::now()->format('Y-m-d');
            }
        }
        if ($request->currentTime) {
            $invoice->currentTime = $request->currentTime;
        }
        $invoice->warehouse_id = $request->warehouse_id;
        if ($request->arrived_warehouse_id) {
            $invoice->arrived_warehouse_id = $request->arrived_warehouse_id;
        }
        $invoice->driver_id = $request->driver_id ?? null;
        // if ($request->container_id) {
        //     $invoice->container_id = $request->container_id;
        // }
        $invoice->container_id = $request->container_id ?? null;
        $invoice->generated_status = $request->generated_status ?? $invoice->generated_status;
        $invoice->total_amount = $request->total_amount;
        $invoice->grand_total = $request->grand_total;
        $invoice->payment = $request->payment;
        $invoice->status = $request->status;
        $invoice->is_paid = $request->is_paid ?? 0;

        if ($request->invoice_no) {
            $invoice->invoice_no = $request->invoice_no;
        }
        if ($request->transport_type && $request->invoce_type == 'services') {
            $invoice->transport_type = $request->transport_type;
        }
        if ($request->payment_type) {
            $invoice->payment_type = $request->payment_type;
        }

        $invoice->save();

        setting()->saveInvoiceHistory($invoice->id, "updated");

        return back()->with('success', 'Invoice updated successfully.');
    }

    public function updateNote(Request $request)
    {
        // return $request->all();

        InvoiceComment::updateOrCreate(
            ['id' => $request->id],
            [
                'notes' => $request->notes,
                'invoice_id' => $request->invoice_id,
                'type' => $request->type ?? 'note',
                'created_by_id' => auth()->id(),
                'is_deleted' => false,
                'is_active' => true
            ]
        );

        return redirect()->back()->with('success', 'Note updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        // Optionally, delete related records (e.g., InvoiceHistory, IndividualPayment, ParcelInventorie)
        // InvoiceHistory::where('invoice_id', $id)->delete();
        // IndividualPayment::where('invoice_id', $id)->delete();
        // ParcelInventorie::where('invoice_id', $id)->update(['invoice_id' => null]);

        $invoice->deleted_by = auth()->id();
        $invoice->save();

        $invoice->delete();

        if (auth()->user()->role_id != 1) {
            $notificationInvoiceDelete = NotificationParcelMessage::find(35);

            $managerData = User::where('id', auth()->id())->with('warehouse')->first();

            $titleInvoiceDelete = str_replace(
                '{invoice_id}',
                $invoice->invoice_no ?? '',
                $notificationInvoiceDelete->title
            );

            $bodyInvoiceDelete = str_replace(
                ['{manager_name}', '{warehouse_name}', '{invoice_id}'],
                [
                    $managerData->name ?? '',
                    $managerData->warehouse->warehouse_name ?? '',
                    $invoice->invoice_no ?? ''
                ],
                $notificationInvoiceDelete->message
            );

            Notification::create([
                'user_id' => 1,
                'warehouse_id' => auth()->user()->warehouse_id,
                'title' => $titleInvoiceDelete,
                'message' => $bodyInvoiceDelete,
                'notification_for' => 'Admin',
                'role' => 'Admin',
                'type' => 'Invoice Delete',
            ]);

            User::where('role_id', 1)->increment('notification_read', 1);
        }

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    public function customerSearch(Request $request)
    {
        if (!$request->search) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a search term'
            ], 400);
        }
        // $u = User::get();
        // foreach ($u as $user) {
        //     $saveAd = [
        //         'name' => $user->name,
        //         'last_name' => $user->last_name ?? null,
        //         'full_name' => trim(($user->name ?? '') . ' ' . ($user->last_name ?? '')),
        //         'alternative_mobile_number_code_id' => $user->phone_2_code_id_id ?? null,
        //         'mobile_number_code_id' => $user->phone_code_id ?? null,
        //         'alternative_mobile_number' => $user->phone_2 ?? null,
        //         'address_2' => $user->address_2 ?? null,
        //         'country_id' => $user->country_id ?? null,
        //         'state_id' => $user->state_id ?? null,
        //         'city_id' => $user->city_id ?? null,
        //         'pincode' => $user->pincode ?? null,
        //         'neighborhood' => $user->neighborhood ?? null,
        //         'lat' => $user->latitude ?? null,
        //         'long' => $user->longitude ?? null,
        //         'mobile_number' => $user->phone ?? null,
        //         'address' => $user->address ?? null,
        //         'address_type' => $user->invoice_custmore_type =='delivery' ? 'delivery':'pickup',
        //         'default_address' => 'Yes',
        //         'user_id' => $user->id,
        //     ];
        //     if(Address::where('user_id', $user->id)->where(['default_address'=>'Yes'])->exists()){
        //         continue;

        //     }
        //     // Address::create(
        //     //     $saveAd
        //     // );
        // }
        // if (strlen($request->search) < 2) {
        //     return response()->json([
        //     'success' => false,
        //     'message' => 'Search term must be at least 2 characters'
        //     ], 400);
        // }
        $parcelType = ['services' => 'Service', 'supplies' => 'Supply'];
        $searchTerm = '%' . $request->search . '%';
        $invoice_type = $parcelType[$request->invoice_type] ?? 'Service';

        $parcels = Parcel::with([
            'pickupaddress',
            'deliveryaddress',
            'ParcelInventory'
        ])
            ->where('parcel_type', $invoice_type)
            ->whereNotNull('delivery_address_id')
            ->whereHas('pickupaddress', function ($query) use ($searchTerm) {
                $query
                    ->where('full_name', 'like', $searchTerm)
                    ->orWhere('mobile_number', 'like', $searchTerm)
                    ->orWhere('alternative_mobile_number', 'like', $searchTerm)
                    ->orWhere('address', 'like', $searchTerm)
                    ->orWhere('pincode', 'like', $searchTerm);
            })
            ->orWhereHas('deliveryaddress', function ($query) use ($searchTerm) {
                $query
                    ->where('full_name', 'like', $searchTerm)
                    ->orWhere('mobile_number', 'like', $searchTerm)
                    ->orWhere('alternative_mobile_number', 'like', $searchTerm)
                    ->orWhere('address', 'like', $searchTerm)
                    ->orWhere('pincode', 'like', $searchTerm);
            })
            ->get()->filter(fn($it) => $it->parcel_type == $invoice_type && !empty($it->delivery_address_id))->values();
        $parcelsHold =  $parcels;
        $pickupIds = $parcelsHold->pluck('pickup_address_id');
        $deliveryIds = $parcelsHold->pluck('delivery_address_id');

        $addressUserIds = $pickupIds->merge($deliveryIds)->unique()
            ->values();


        // -----------------------------------------------

        $users = User::join('addresses', function ($join) {
            $join->on('addresses.user_id', '=', 'users.id');
            //  ->where('addresses.address_type', request()->address_type);
        })
            ->whereIn('users.role', [3, 5])
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query
                    ->where('users.name', 'like', $searchTerm)
                    ->orWhere('users.unique_id', 'like', $searchTerm)
                    ->orWhere('users.last_name', 'like', $searchTerm)
                    ->orWhere('users.phone', 'like', $searchTerm)
                    ->orWhere('users.phone_2', 'like', $searchTerm)
                    ->orWhere('users.address', 'like', $searchTerm)
                    ->orWhere('users.pincode', 'like', $searchTerm)
                    ->orWhere('addresses.address', 'like', $searchTerm)
                    ->orWhere('addresses.full_name', 'like', $searchTerm);
            })
            ->when(!empty(request()->ship_country), function ($query) {
                $query->where('users.country_id', request()->ship_country['name']);
            })
            ->select('users.*', 'addresses.id as address_id', 'addresses.user_id', 'addresses.full_name', 'addresses.mobile_number', 'addresses.alternative_mobile_number', 'addresses.address', 'addresses.pincode', 'addresses.address_type')
            ->get()
            ->filter(fn($i) => !empty($i->address_id))
            ->filter(function ($item) {
                if (!empty(request()->invoice_custmore_id)) {
                    return $item->invoice_custmore_id == request()->invoice_custmore_id;
                }
                if (!empty(request()->ship_country)) {
                    return $item->country_id == request()->ship_country['name'];
                }
                return $item;
            })
            ->map(function ($user, $id) use ($invoice_type) {
                return [
                    "id" => 'user_' . $user->id,
                    "parcel_id" => null,
                    "transport_type" => null,
                    "status" => 1,
                    "unique_id" => null,
                    "parcel_type" => $invoice_type,
                    "add_order" => null,
                    "container_id" => null,
                    "arrived_warehouse_id" => null,
                    "arrived_driver_id" => null,
                    "percel_comment" => null,
                    "hub_tracking_id" => null,
                    "tracking_number" => null,
                    "customer_id" => null,
                    "ship_customer_id" => null,
                    "driver_id" => null,
                    "warehouse_id" => null,
                    "parcel_car_ids" => [],
                    "customer_subcategories_data" => null,
                    "driver_subcategories_data" => null,
                    "driver_parcel_image" => [],
                    "length" => null,
                    "width" => null,
                    "height" => null,
                    "update_role" => null,
                    "weight" => 0,
                    "total_amount" => 0,
                    "estimate_cost" => null,
                    "partial_payment" => 0,
                    "remaining_payment" => 0,
                    "payment_type" => "COD",
                    "descriptions" => null,
                    "source_address" => null,
                    "destination_user_name" => null,
                    "destination_user_phone" => null,
                    "destination_address" => null,
                    "payment_status" => null,
                    "amount" => null,
                    "source_let" => null,
                    "source_long" => null,
                    "dest_let" => null,
                    "dest_long" => null,
                    "created_at" => null,
                    "updated_at" => null,
                    "pickup_date" => null,
                    "delivery_date" => null,
                    "pickup_address_id" => null,
                    "delivery_address_id" => null,
                    "pickup_time" => null,
                    "pickup_type" => null,
                    "delivery_type" => null,
                    "invoice_type" => $invoice_type,
                    "address_type" => request()->address_type,
                    "invoice_custmore_type" => $user->invoice_custmore_type ?? 'ship_to',
                    "invoice_custmore_id" => $user->invoice_custmore_id ?? null,
                    "role_id" => $user->role_id ?? 3,
                    "pickup_address" => $this->formatAddress($user, null, 'pickup'),
                    "delivery_address" => $this->shipToAddress($user, null, 'delivery'),
                    "category_names" => [],
                    "pickupaddress" => null,
                    "deliveryaddress" => null,
                    "parcel_inventory" => null
                ];
            })
            // ->filter(function ($user) use ($request) {
            //     return (!empty($user['pickup_address']) || !empty($user['delivery_address']))
            //     && $user['address_type'] == $request->address_type;
            // })
            ->values();


        if ($request->address_type == 'delivery') {
            return response()->json([
                'success' => true,
                'data' => $users->toArray(),
            ]);
        }


        // Format parcel addresses
        $formattedParcels = [];

        // $parcels->map(function ($parcel) use ($invoice_type) {
        //     $parcel->invoice_type = $invoice_type;
        //     $parcel->address_type = request()->address_type;
        //     $parcel->parcel_id = $parcel->id ?? null;
        //     $parcel->invoice_custmore_type = $parcel->deliveryaddress->user ? $parcel->deliveryaddress->user->invoice_custmore_type : 'ship_to';
        //     $parcel->invoice_custmore_id = $parcel->deliveryaddress->user ? $parcel->deliveryaddress->user->invoice_custmore_id : null;
        //     $parcel->pickup_address = $this->formatAddress($parcel->pickupaddress, $parcel);
        //     $parcel->delivery_address = $this->formatAddress($parcel->deliveryaddress, $parcel);
        //     return $parcel;
        // })->toArray();

        if (count($formattedParcels) > 0) {
            // Merge users + parcels
            $results = array_merge($formattedParcels, $users->toArray());
        } else {
            // Merge users + parcels
            $results = array_merge($users->toArray(), $formattedParcels);
        }

        $resultsData = collect($results)
            // ->when(!empty(request()->invoice_custmore_id),function($query) {
            //     $query->where('invoice_custmore_id', request()->invoice_custmore_id);
            // })
            // ->when(!empty(request()->ship_country),function($query) {
            //     $query->where('country_id', request()->ship_country->name);
            // })
            // ->when(empty(request()->invoice_custmore_id),function($query) {
            //     $query->where('invoice_custmore_type', '!=', 'ship_to');
            // })
            ->values()->all();

        if (collect($results)->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No results found'
            ], 404);
        }

        // $results = $formattedParcels;


        return response()->json([
            'success' => true,
            'data' => $resultsData,
        ]);
    }

    public function getOrderList(Request $request)
    {
        $request->validate([
            'invoice_type' => 'required|in:services,supplies',
            'delivery_address_id' => 'required|numeric',
            'delivery_address_id' => 'nullable|numeric'
        ]);

        $parcelType = ['services' => 'Service', 'supplies' => 'Supply'];
        $invoice_type = $parcelType[$request->invoice_type] ?? 'Service';

        $parcels = Parcel::with([
            'pickupaddress',
            'deliveryaddress',
            'ParcelInventory'
        ])
        ->whereNull('invoice_id')
        ->when($invoice_type != 'Supply', function ($query) use ($request) {
            return $query->where('delivery_address_id', $request->pickup_address_id)
            ->where('pickup_address_id', $request->delivery_address_id);
            //note delivery_address_id is as pickup_address
        })
        ->when($invoice_type == 'Supply' && !empty($request->delivery_address_id), function ($query) use ($request) {
            return $query->where('delivery_address_id', $request->delivery_address_id);
        })
        ->latest('id')
        ->get();



        $resultsData = $parcels->map(function ($parcel) use ($invoice_type) {
            $parcel->invoice_type = $invoice_type;
            $parcel->address_type = request()->address_type;
            $parcel->parcel_id = $parcel->id ?? null;
            $parcel->invoice_custmore_type = optional($parcel->deliveryaddress)->user ? optional($parcel->deliveryaddress->user)->invoice_custmore_type : 'ship_to';
            $parcel->invoice_custmore_id = optional($parcel->deliveryaddress)->user ? optional($parcel->deliveryaddress->user)->invoice_custmore_id : null;
            $parcel->pickup_address = $this->formatAddress($parcel->pickupaddress, $parcel);
            $parcel->delivery_address = $this->formatAddress($parcel->deliveryaddress, $parcel);
            $parcel->source_address =optional($parcel->pickupaddress)->address ?? optional($parcel->deliveryaddress)->address;
            return $parcel;
        })->filter(function($i) use ($request) {
            if($request->invoice_type == 'supplies'){
                return (empty($i->transport_type) || $i->transport_type == 'null') && !empty($i->ParcelInventory) && empty($i->invoice_id);
            }
            return !empty($i->ParcelInventory) && empty($i->invoice_id);
        })->toArray();


        if (collect($resultsData)->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No results found'
            ], 404);
        }

        // $results = $formattedParcels;


        return response()->json([
            'success' => true,
            'data' => $resultsData,
        ]);
    }


    public function saveInvoceCustomer(Request $request)
    {
        $phoneLength = getPhoneLengthById($request->mobile_number_code_id);
        $altPhoneLength = getPhoneLengthById($request->alternative_mobile_number_code_id);

        // Validate incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => "required|digits:$phoneLength|unique:users,phone",
            'alternative_mobile_number' => "nullable|digits:$altPhoneLength|unique:users,phone_2",
            'mobile_number_code_id' => 'required|integer',
            'alternative_mobile_number_code_id' => 'required|integer',
            'address' => 'required|string|max:500',
            'address_2' => 'nullable|string|max:500',
            'country' => 'required',
            'state' => 'required',
            'city' => 'nullable',
            'zip_code' => 'nullable|string|max:10',
            'address_type' => 'required|in:pickup,delivery',
            'user_id' => 'nullable|integer',
            'invoice_custmore_id' => 'nullable|required_if:address_type,delivery|integer',
        ]);

        if ($request->email) {
            $useCheck['email'] = $request->email;
        } else {
            $useCheck = ['phone' => $validatedData['mobile_number']];
        }

        $saveAd = [
            'name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'full_name' => $validatedData['first_name'] . " " . $validatedData['last_name'],
            'alternative_mobile_number_code_id' => $validatedData['alternative_mobile_number_code_id'] ?? null,
            'mobile_number_code_id' => $validatedData['mobile_number_code_id'] ?? null,
            'alternative_mobile_number' => $validatedData['alternative_mobile_number'] ?? null,
            'address_2' => $validatedData['address_2'] ?? null,
            'country_id' => $validatedData['country'],
            'state_id' => $validatedData['state'],
            'city_id' => $validatedData['city'] ?? null,
            'pincode' => $validatedData['zip_code'] ?? null,
            'neighborhood' => $validatedData['neighborhood'] ?? null,
            'lat' => $request->lat ?? null,
            'long' => $request->lng ?? null,
            'default_address' => 'Yes'
        ];


        if (!empty($request->address_id) && !empty($request->user_id)) {
            $check['id'] =  $request->address_id;
            $saveAd['mobile_number'] = $validatedData['mobile_number'];
            $saveAd['address'] = $validatedData['address'];
            $saveAd['address_type'] = $validatedData['address_type'];
        } else {
            $check = [
                'mobile_number' => $validatedData['mobile_number'],
                'address_type' => $validatedData['address_type'],
                'address' => $validatedData['address']
            ];
        }
        $storeUser = [
            'name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['mobile_number'],
            'phone_code_id' => $validatedData['mobile_number_code_id'],
            'phone_2' => $validatedData['alternative_mobile_number'] ?? null,
            'phone_2_code_id_id' => $validatedData['alternative_mobile_number_code_id'] ?? null,
            'phone_code_id' => $validatedData['mobile_number_code_id'] ?? null,
            'address' => $validatedData['address'],
            'address_2' => $validatedData['address_2'],
            'country_id' => $validatedData['country'],
            'state_id' => $validatedData['state'],
            'city_id' => $validatedData['city'] ?? null,
            'neighborhood' => $validatedData['neighborhood'] ?? null,
            'pincode' => $validatedData['zip_code'] ?? null,
            'email' => $request->email ?? 'user' . time() . '@example.com', // Dummy email if required
            'password' => bcrypt('password'), // Set a default password
            'invoice_custmore_type' => $request->invoice_custmore_type ?? 'from_to',
            'invoice_custmore_id' => $request->invoice_custmore_id ?? null,
            'parent_customer_id' => $request->invoice_custmore_id ?? null,
            'role_id' => 3, // Assuming role_id 3 is for customers
            'role' => 'customer', // Assuming role_id 3 is for customers
        ];

        if (!empty($request->invoice_custmore_id)) {
            $storeUser['role_id'] = 5;
            $storeUser['role'] = 'ship_to_customer';
        }

        // Find or create the user based on mobile number
        $user = User::firstOrCreate(
            $useCheck,
            $storeUser
        );



        if ($request->let && $request->lng) {
            $user->latitude = $request->let;
            $user->longitude = $request->lng;
            $user->save();
        }

        if ($request->license_number) {
            foreach (['license_picture'] as $imageType) {
                if ($request->hasFile($imageType)) {
                    // Purani image delete karo agar hai
                    if ($user->{$imageType} && \Storage::exists('public/' . $user->{$imageType})) {
                        \Storage::delete('public/' . $user->{$imageType});
                    }

                    // Nई image upload karo
                    $file = $request->file($imageType);
                    $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('uploads/customer', $fileName, 'public');
                    $imagePaths[$imageType] = 'storage/uploads/customer/' . $fileName;

                    if (isset($imagePaths['license_picture'])) {
                        $user->license_document = $imagePaths['license_picture'];
                    }
                }
            }

            $user->license_number = $request->license_number;
            $user->save();
        }

        $check['user_id'] =  $user->id;


        $address = Address::updateOrCreate(
            $check,
            $saveAd
        );


        return response()->json([
            'success' => true,
            'message' => 'Customer and address saved successfully.',
            'user_id' => $user->id,
            'data' => [
                'id' => $address->id,
                'user_id' => $address->user_id,
                'role_id' => $user->role_id,
                'text' => ($address->full_name ?? $user->name) . ", " . $address->address,
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
                'country' => $address->country_id,
                'state' => $address->state_id,
                'city' => $address->city_id,
                'neighborhood' => $address->neighborhood,
                'address_type' => $address->address_type,
                'license_number' => $user->license_number ?? null,
                'license_document' => $user->license_document ?? null,
                'lat' => $user->lat,
                'long' => $user->long
            ]
        ]);
    }

    public function saveIndividualPayment(Request $request)
    {

        $validated = $request->validate([
            'invoice_id' => 'nullable|exists:invoices,id',
            'created_by' => 'nullable|exists:users,id',
            'personal' => 'nullable|string',
            'local_currency' => 'required|string',
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
            'currentTime' => 'nullable',
        ]);

        $data = $this->individualPayment($validated);
        return redirect()->back()->with('success', 'Payment saved successfully!');
    }

    public function updateClaim(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'description' => 'required|string',
            // Add validation for images if needed
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image uploads if present
        $imagePaths = [];
        foreach (['image1', 'image2', 'image3'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $imagePaths[$imgField] = $request->file($imgField)->store('claims', 'public');
            }
        }

        $claim = Claim::updateOrCreate(
            ['id' => $request->id],
            [
                'description' => $request->description,
                'invoice_id' => $request->invoice_id,
                'user_id' => auth()->id(),
                'image1' => $imagePaths['image1'] ?? null,
                'image2' => $imagePaths['image2'] ?? null,
                'image3' => $imagePaths['image3'] ?? null,
            ]
        );

        return redirect()->back()->with('success', 'Claim updated successfully.');
    }

    protected function individualPayment($validated)
    {
        // Save individual payment
        $payment = IndividualPayment::create($validated);

        // Update the associated invoice
        if ($validated['invoice_id']) {
            $invoice = Invoice::find($validated['invoice_id']);
            $payment->warehouse_id = $invoice->warehouse_id;
            if ($invoice && empty($validated['current_balance']) && !isset($validated['current_balance'])) {
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

            if (isset($validated['current_balance'])) {

                $newBalance = $validated['current_balance'];
                $paymentAmount = $invoice->balance - $validated['current_balance'];

                $invoice->balance = $validated['current_balance'];

                $invoice->balance = $newBalance;

                // Optional: update payment field (total paid so far)
                $invoice->payment = ($invoice->payment ?? 0) + $paymentAmount;

                $payment->payment_amount = $paymentAmount; //usd amont

                $payment->save();

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

    protected function formatAddress($address, $parcel = null, $type = null)
    {
        if ((empty($address) || empty($address->user)) && empty($address->role_id)) return null;
        // if(!empty($type) && $type != $address->address_type){
        //     return null;
        // }

        if (!empty($address->user)) {
            return [
                'id' => $address->id,
                'user_id' => $address->user_id ?? '',
                'text' => ($address->full_name ?? ($address->name . " " . $address->last_name)) . " " . ($parcel->tracking_number ?? null) . ", " . $address->address,
                'name' => $address->user->name ?? $address->name ?? '',
                'last_name' => $address->user->last_name ?? $address->last_name ?? '',
                'phone' => $address->user->mobile_number ?? $address->mobile_number ?? '',
                'full_name' => $address->full_name ?? '',
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
                'country' => $address->country_id,
                'state' => $address->state_id,
                'city' => $address->city_id,
                // 'address_type' => request()->address_type ?? $type ?? $address->address_type,
                'address_type' => $type ?? $address->address_type,
                'license_number' => $address->user->license_number ?? null,
                'license_document' => $address->user->license_document ?? null,
            ];
        }

        return [
            'id' => $address->address_id,
            'user_id' => $address->id,
            'default_address' => $address->defaultAddress ?? '',
            'text' => $address->unique_id . ", " . $address->name . " " . $address->last_name . ", " . $address->address . " " . $address->name,
            'name' => $address->name ?? '',
            'last_name' => $address->last_name ?? '',
            'phone' => $address->phone ?? '',
            'full_name' => $address->name . " " . $address->last_name,
            'mobile_number' => $address->phone,
            'alternative_mobile_number' => $address->phone_2,
            'mobile_number_code_id' => $address->phone_code_id ?? 1,
            'alternative_mobile_number_code_id' => $address->phone_2_code_id_id ?? 1,
            'address1' => $address->address,
            'address2' => $address->address_2,
            'pincode' => $address->pincode,
            'country_id' => $address->country_id,
            'state_id' => $address->state_id,
            'city_id' => $address->city_id,
            'country' => $address->country_id,
            'state' => $address->state_id,
            'city' => $address->city_id,
            'address_type' => $type,
            'address_type_t' => $type ?? $address->address_type,
            'license_number' => $address->license_number ?? null,
            'license_document' => $address->license_document ?? null,
        ];
    }


    protected function shipToAddress($user, $parcel = null, $type = null)
    {
        // $user = User::with(['shipToAddress'])->find($user->id);

        $users = User::with('addresses')
        // ->where('invoice_custmore_id', $user->id)
        // ->orWhere('parent_customer_id', $user->id)
        ->where('parent_customer_id', $user->id)
        ->get();

        // if (empty($user) || empty($user->shipToAddress) || $user->shipToAddress->isEmpty()) return null;
        // $users = $user->shipToAddress;
        // if ($users->isEmpty()) return null;
        return $users->map(function ($usr) use ($type, $parcel) {
            return $this->formatAddress($usr->addresses, $parcel, $type);
        })->filter(fn($i) => $i)->values();
    }

    // Restore a soft-deleted invoice
    public function restore($id)
    {
        $invoice = Invoice::onlyTrashed()->findOrFail($id);
        $invoice->restore();

        if (auth()->user()->role_id != 1) {
            $notificationInvoiceDelete = NotificationParcelMessage::find(36);

            $managerData = User::where('id', auth()->id())->with('warehouse')->first();

            $titleInvoiceDelete = str_replace(
                '{invoice_id}',
                $invoice->invoice_no ?? '',
                $notificationInvoiceDelete->title
            );

            $bodyInvoiceDelete = str_replace(
                ['{manager_name}', '{warehouse_name}', '{invoice_id}'],
                [
                    $managerData->name ?? '',
                    $managerData->warehouse->warehouse_name ?? '',
                    $invoice->invoice_no ?? ''
                ],
                $notificationInvoiceDelete->message
            );

            Notification::create([
                'user_id' => 1,
                'warehouse_id' => auth()->user()->warehouse_id,
                'title' => $titleInvoiceDelete,
                'message' => $bodyInvoiceDelete,
                'notification_for' => 'Admin',
                'role' => 'Admin',
                'type' => 'Invoice Delete',
            ]);

            User::where('role_id', 1)->increment('notification_read', 1);
        }

        return back()->with('success', 'Invoice restored successfully.');
    }

    // Permanently delete an invoice
    public function delete($id)
    {
        $invoice = Invoice::onlyTrashed()->findOrFail($id);

        // Optionally, delete related records (e.g., InvoiceHistory, IndividualPayment, ParcelInventorie)
        IndividualPayment::where('invoice_id', $id)->delete();
        ParcelInventorie::where('invoice_id', $id)->update(['invoice_id' => null]);
        Parcel::where('invoice_id', $id)->update(['invoice_id' => null]);

        $invoice->forceDelete();

          if (auth()->user()->role_id != 1) {
            $notificationInvoiceDelete = NotificationParcelMessage::find(37);

            $managerData = User::where('id', auth()->id())->with('warehouse')->first();

            $titleInvoiceDelete = str_replace(
                '{invoice_id}',
                $invoice->invoice_no ?? '',
                $notificationInvoiceDelete->title
            );

            $bodyInvoiceDelete = str_replace(
                ['{manager_name}', '{warehouse_name}', '{invoice_id}'],
                [
                    $managerData->name ?? '',
                    $managerData->warehouse->warehouse_name ?? '',
                    $invoice->invoice_no ?? ''
                ],
                $notificationInvoiceDelete->message
            );

            Notification::create([
                'user_id' => 1,
                'warehouse_id' => auth()->user()->warehouse_id,
                'title' => $titleInvoiceDelete,
                'message' => $bodyInvoiceDelete,
                'notification_for' => 'Admin',
                'role' => 'Admin',
                'type' => 'Invoice Delete',
            ]);

            User::where('role_id', 1)->increment('notification_read', 1);
        }

        return back()->with('success', 'Invoice permanently deleted.');
    }
}
