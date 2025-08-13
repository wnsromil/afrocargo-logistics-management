<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Category,
    Warehouse,
    Stock,
    Inventory,
    Vehicle,
    AdvancedOrderReport,
    Parcel
};
use \Carbon\Carbon;
use App\Exports\AdvanceOrderReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class AdvanceReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $currentPage = $request->input('page', 1);

        $query = Parcel::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;

                // Find user IDs based on search match
                $userIds = User::where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere(DB::raw("CONCAT(name, ' ', last_name)"), 'like', "%$search%");
                })->pluck('id')->toArray();

                $q->where(function ($query) use ($search, $userIds) {
                    $query->where('tracking_number', 'like', "%$search%");

                    if (!empty($userIds)) {
                        $query->orWhereIn('pickup_address_id', $userIds)
                            ->orWhereIn('delivery_address_id', $userIds)
                            ->orWhereIn('driver_id', $userIds)
                            ->orWhereIn('customer_id', $userIds)
                            ->orWhereIn('ship_customer_id', $userIds);
                    }
                });
            })
            ->when($request->filled('warehouse'), function ($q) use ($request) {
                $q->where('warehouse_id', $request->warehouse);
            })
            ->when($request->filled('tracking_id'), function ($q) use ($request) {
                $q->where('tracking_number', $request->tracking_id);
            })
            ->when($request->filled('customer'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            })
            ->when($request->filled('driver'), function ($q) use ($request) {
                $q->where('driver_id', $request->driver);
            })
            ->when($request->filled('container'), function ($q) use ($request) {
                $q->where('container_id', $request->container);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('payment_status'), function ($q) use ($request) {
                $q->where('payment_status', $request->payment_status);
            })
            ->when($request->filled('logs_datetimes'), function ($q) use ($request) {
                $dates = explode(' - ', $request->logs_datetimes);
                if (count($dates) == 2) {
                    try {
                        $startDate = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->startOfDay();
                        $endDate = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->endOfDay();
                        $q->whereBetween('created_at', [$startDate, $endDate]);
                    } catch (\Exception $e) {
                        try {
                            $startDate = Carbon::parse(trim($dates[0]))->startOfDay();
                            $endDate = Carbon::parse(trim($dates[1]))->endOfDay();
                            $q->whereBetween('created_at', [$startDate, $endDate]);
                        } catch (\Exception $e) {
                            logger()->error('Date filter error: ' . $e->getMessage());
                        }
                    }
                }
            });

        $parcels = $query->orderBy('id', 'desc')->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $drivers = User::where('role_id', 4)
            ->where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        $containers = Vehicle::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->where('vehicle_type', '1')->get();

        $serialStart = ($currentPage - 1) * $perPage;



        if ($request->ajax()) {
            return view('admin.advance_reports.table', compact('parcels', 'warehouses', 'drivers', 'containers', 'search', 'perPage', 'serialStart'));
        }

        return view('admin.advance_reports.index', compact('parcels', 'warehouses', 'drivers', 'containers', 'search', 'perPage', 'serialStart'));
    }

    public function exportReports(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $currentPage = $request->input('page', 1);

        $query = Parcel::with('pickupaddress', 'deliveryaddress')->when($request->filled('search'), function ($q) use ($request) {
            $search = $request->search;

            // Find user IDs based on search match
            $userIds = User::where(function ($query) use ($search) {
                $query->where('username', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere(DB::raw("CONCAT(name, ' ', last_name)"), 'like', "%$search%");
            })->pluck('id')->toArray();

            $q->where(function ($query) use ($search, $userIds) {
                $query->where('tracking_number', 'like', "%$search%");

                if (!empty($userIds)) {
                    $query->orWhereIn('pickup_address_id', $userIds)
                        ->orWhereIn('delivery_address_id', $userIds)
                        ->orWhereIn('driver_id', $userIds)
                        ->orWhereIn('customer_id', $userIds)
                        ->orWhereIn('ship_customer_id', $userIds);
                }
            });
        })
            ->when($request->filled('warehouse'), function ($q) use ($request) {
                $q->where('warehouse_id', $request->warehouse);
            })
            ->when($request->filled('tracking_id'), function ($q) use ($request) {
                $q->where('tracking_number', $request->tracking_id);
            })
            ->when($request->filled('customer'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            })
            ->when($request->filled('driver'), function ($q) use ($request) {
                $q->where('driver_id', $request->driver);
            })
            ->when($request->filled('container'), function ($q) use ($request) {
                $q->where('container_id', $request->container);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('payment_status'), function ($q) use ($request) {
                $q->where('is_paid', $request->payment_status == 'paid');
            })
            ->when($request->filled('logs_datetimes'), function ($q) use ($request) {
                $dates = explode(' - ', $request->logs_datetimes);
                if (count($dates) == 2) {
                    try {
                        $startDate = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->startOfDay();
                        $endDate = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->endOfDay();
                        $q->whereBetween('created_at', [$startDate, $endDate]);
                    } catch (\Exception $e) {
                        try {
                            $startDate = Carbon::parse(trim($dates[0]))->startOfDay();
                            $endDate = Carbon::parse(trim($dates[1]))->endOfDay();
                            $q->whereBetween('created_at', [$startDate, $endDate]);
                        } catch (\Exception $e) {
                            logger()->error('Date filter error: ' . $e->getMessage());
                        }
                    }
                }
            });

        $advanceOrderReports = $query->orderBy('id', 'desc')->get();

        return Excel::download(
            new AdvanceOrderReportsExport($advanceOrderReports),
            Carbon::now()->format('d-m-y') . '_Advance_reports.xlsx'
        );
    }

    public function printData(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $currentPage = $request->input('page', 1);

        $query = Parcel::with('pickupaddress', 'deliveryaddress')->when($request->filled('search'), function ($q) use ($request) {
            $search = $request->search;

            // Find user IDs based on search match
            $userIds = User::where(function ($query) use ($search) {
                $query->where('username', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere(DB::raw("CONCAT(name, ' ', last_name)"), 'like', "%$search%");
            })->pluck('id')->toArray();

            $q->where(function ($query) use ($search, $userIds) {
                $query->where('tracking_number', 'like', "%$search%");

                if (!empty($userIds)) {
                    $query->orWhereIn('pickup_address_id', $userIds)
                        ->orWhereIn('delivery_address_id', $userIds)
                        ->orWhereIn('driver_id', $userIds)
                        ->orWhereIn('customer_id', $userIds)
                        ->orWhereIn('ship_customer_id', $userIds);
                }
            });
        })
            ->when($request->filled('warehouse'), function ($q) use ($request) {
                $q->where('warehouse_id', $request->warehouse);
            })
            ->when($request->filled('tracking_id'), function ($q) use ($request) {
                $q->where('tracking_number', $request->tracking_id);
            })
            ->when($request->filled('customer'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            })
            ->when($request->filled('driver'), function ($q) use ($request) {
                $q->where('driver_id', $request->driver);
            })
            ->when($request->filled('container'), function ($q) use ($request) {
                $q->where('container_id', $request->container);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('payment_status'), function ($q) use ($request) {
                $q->where('is_paid', $request->payment_status == 'paid');
            })
            ->when($request->filled('logs_datetimes'), function ($q) use ($request) {
                $dates = explode(' - ', $request->logs_datetimes);
                if (count($dates) == 2) {
                    try {
                        $startDate = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->startOfDay();
                        $endDate = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->endOfDay();
                        $q->whereBetween('created_at', [$startDate, $endDate]);
                    } catch (\Exception $e) {
                        try {
                            $startDate = Carbon::parse(trim($dates[0]))->startOfDay();
                            $endDate = Carbon::parse(trim($dates[1]))->endOfDay();
                            $q->whereBetween('created_at', [$startDate, $endDate]);
                        } catch (\Exception $e) {
                            logger()->error('Date filter error: ' . $e->getMessage());
                        }
                    }
                }
            });

        $advanceOrderReports = $query->orderBy('id', 'desc')->get();

        return response()->json($advanceOrderReports);
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
        $categories = Category::get();
        return view('admin.advance_reports.create', compact('warehouses', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate incoming request data
        $request->validate([
            'warehouse_id'      => 'required|exists:warehouses,id',
            'inventory_name'    => 'required|string',
            'in_stock_quantity' => 'required|numeric',
            'low_stock_warning' => 'required|numeric',
            // 'status'           => 'in:Active,Inactive',
        ]);

        $category_id = $this->getCategoryIdByName($request->inventory_name);

        $inventory = Inventory::firstOrCreate(
            [
                'warehouse_id' => $request->warehouse_id,
                'category_id'  => $category_id,
            ],
            [
                'total_quantity'    => 0,
                'in_stock_quantity' => 0,
                'low_stock_warning' => $request->low_stock_warning
            ]
        );

        $inventory->update([
            'total_quantity'      => $inventory->total_quantity + $request->in_stock_quantity,
            'in_stock_quantity'   => $inventory->in_stock_quantity + $request->in_stock_quantity,
            'low_stock_warning'   => $request->low_stock_warning
        ]);

        // Create a new stock entry
        Stock::create([
            'warehouse_id'    => $request->warehouse_id,
            'category_id'     => $category_id,
            'inventory_id'    => $inventory->id,
            'user_id'         => auth()->id(),
            'in_stock_quantity' => $request->in_stock_quantity,
            'low_stock_warning' => $request->low_stock_warning
        ]);

        return redirect()->route('admin.advance_reports.index')
            ->with('success', 'Inventory added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $inventories = Stock::where('inventory_id', $id)->paginate(10);
        return view('admin.advance_reports.show', compact('inventories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();
        $categories = Category::get();
        $inventory = Inventory::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->where('id', $id)->first();
        return view('admin.advance_reports.edit', compact('inventory', 'warehouses', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Validate incoming request data
        $request->validate([
            'warehouse_id'      => 'required|exists:warehouses,id',
            'inventory_name'    => 'required|string',
            'in_stock_quantity' => 'required|numeric',
            'low_stock_warning' => 'required|numeric',
            // 'status'           => 'in:Active,Inactive',
        ]);

        $category_id = $this->getCategoryIdByName($request->inventory_name);

        $inventory = Inventory::where([
            'id' => $id
        ])->first();

        $inventory->update([
            'total_quantity'      => $request->in_stock_quantity,
            'in_stock_quantity'   => $request->in_stock_quantity,
            'low_stock_warning'   => $request->low_stock_warning
        ]);

        // Create a new stock entry
        Stock::create([
            'warehouse_id'    => $request->warehouse_id,
            'category_id'     => $category_id,
            'inventory_id'    => $inventory->id,
            'user_id'         => auth()->id(),
            'in_stock_quantity' => $request->in_stock_quantity,
            'low_stock_warning' => $request->low_stock_warning,
            'status' => 'updated'
        ]);

        return redirect()->route('admin.advance_reports.index')
            ->with('success', 'Inventory added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Inventory::find($id)->delete();
        return redirect()->route('admin.advance_reports.index')
            ->with('success', 'Inventory deleted successfully');
    }

    public function getCategoryIdByName($name)
    {
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($name)])->first();

        if ($category) {
            return $category->id;
        }

        $category = Category::create([
            'name' => strtolower($name)
        ]);

        return $category->id;
    }
}
