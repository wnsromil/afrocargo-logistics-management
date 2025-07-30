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
    HubTracking,
    Expense,
    Invoice,
    IndividualPayment
};

class EODController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Invoice_index(Request $request)
    {
        $search = $request->input('search');
        $warehouse_id = $request->input('warehouse_id');
        $driver_id = $request->input('driver_id');
        $customer_id = $request->input('customer_id');

        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);

        $start_date = null;
        $end_date = null;
        $dateRange = $request->input('eod_datetimes');


        if ($dateRange) {
            try {
                [$start_date, $end_date] = explode(' - ', $dateRange);
                $start_date = $start_date;
                $end_date = $end_date;
            } catch (\Exception $e) {
                $start_date = null;
                $end_date = null;
            }
        }

        // Invoice Query
        $query = Invoice::with(['warehouse', 'driver', 'customer'])
            ->where('deleted_at', Null)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            });

        // 🔍 Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('invoce_type', 'LIKE', "%$search%")
                    ->orWhere('invoice_no', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('driver', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%")
                            ->orWhere('last_name', 'LIKE', "%$search%")
                            ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                    })
                    ->orWhereHas('customer', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%")
                            ->orWhere('last_name', 'LIKE', "%$search%")
                            ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                    });
            });
        }

        // 🚚 Driver filter
        if ($driver_id) {
            $query->where('driver_id', $driver_id);
        }

        if ($customer_id) {
            $query->where('customer_id', $customer_id);
        }

        // 🏭 Warehouse filter
        if ($warehouse_id) {
            $query->where('warehouse_id', $warehouse_id);
        }

        // 📅 Date filter
        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('issue_date', [$start_date, $end_date]);
        }

        // ⏳ Paginate
        $invoices = $query->latest()->paginate($perPage)->appends([
            'search' => $search,
            'warehouse_id' => $warehouse_id,
            'daterangepicker' => $dateRange,
            'driver_id' => $driver_id,
            'per_page' => $perPage,
        ]);

        $serialStart = ($currentPage - 1) * $perPage;

        // 📦 Warehouses
        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->get();

        // 🚚 Drivers
        $drivers = User::where('role_id', 4)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        // 👥 Customers
        $customers = User::where('role_id', 3)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        $totalsQuery = clone $query;

        $totalInvoiced   = $totalsQuery->sum('grand_total') ?? 0;
        $totalBalance   = $totalsQuery->sum('balance') ?? 0;
        $totalPayment   = $totalsQuery->sum('payment') ?? 0;
        $totalDiscount   = $totalsQuery->sum('discount') ?? 0;
        $totalService    = (clone $query)->where('invoce_type', 'services')->sum('grand_total') ?? 0;
        $totalSupplies   = (clone $query)->where('invoce_type', 'supplies')->sum('grand_total') ?? 0;

        $invoiceIds = $query->pluck('id')->toArray();

        $paymentTotals = IndividualPayment::whereIn('invoice_id', $invoiceIds)
            ->selectRaw("
        SUM(CASE WHEN payment_type = 'cash' THEN payment_amount ELSE 0 END) as totalCash,
        SUM(CASE WHEN payment_type = 'cheque' THEN payment_amount ELSE 0 END) as totalCheque,
        SUM(CASE WHEN payment_type = 'CreditCard' THEN payment_amount ELSE 0 END) as totalCreditCard
    ")->first();

        $totalCash       = $paymentTotals->totalCash ?? 0;
        $totalCheque     = $paymentTotals->totalCheque ?? 0;
        $totalCreditCard = $paymentTotals->totalCreditCard ?? 0;


        if ($request->ajax()) {
            return view('admin.end_of_day.table.invoice_table', compact(
                'invoices',
                'drivers',
                'customers',
                'serialStart',
                'warehouses',
                'totalInvoiced',
                'totalBalance',
                'totalPayment',
                'totalDiscount',
                'totalService',
                'totalSupplies',
                'totalCash',
                'totalCheque',
                'totalCreditCard'
            ))->render();
        }

        return view('admin.end_of_day.index.invoice_index', compact(
            'drivers',
            'customers',
            'invoices',
            'warehouses',
            'search',
            'warehouse_id',
            'dateRange',
            'driver_id',
            'perPage',
            'serialStart',
            'totalInvoiced',
            'totalBalance',
            'totalPayment',
            'totalDiscount',
            'totalService',
            'totalSupplies',
            'totalCash',
            'totalCheque',
            'totalCreditCard'
        ));
    }

    public function Supply_index(Request $request)
    {
        $search = $request->input('search');
        $warehouse_id = $request->input('warehouse_id');
        $driver_id = $request->input('driver_id');
        $customer_id = $request->input('customer_id');

        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);

        $start_date = null;
        $end_date = null;
        $dateRange = $request->input('eod_datetimes');
        if ($dateRange) {
            try {
                [$start_date, $end_date] = explode(' - ', $dateRange);
                $start_date = $start_date;
                $end_date = $end_date;
            } catch (\Exception $e) {
                $start_date = null;
                $end_date = null;
            }
        }

        // Invoice Query
        $query = Invoice::with(['warehouse', 'driver', 'customer'])
            ->where('deleted_at', Null)
            ->where('invoce_type', "supplies")
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            });

        // 🔍 Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('invoce_type', 'LIKE', "%$search%")
                    ->orWhere('invoice_no', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('driver', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%")
                            ->orWhere('last_name', 'LIKE', "%$search%")
                            ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                    })
                    ->orWhereHas('customer', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%")
                            ->orWhere('last_name', 'LIKE', "%$search%")
                            ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                    });
            });
        }

        // 🚚 Driver filter
        if ($driver_id) {
            $query->where('driver_id', $driver_id);
        }

        if ($customer_id) {
            $query->where('customer_id', $customer_id);
        }

        // 🏭 Warehouse filter
        if ($warehouse_id) {
            $query->where('warehouse_id', $warehouse_id);
        }

        // 📅 Date filter
        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('issue_date', [$start_date, $end_date]);
        }

        // ⏳ Paginate
        $invoices = $query->latest()->paginate($perPage)->appends([
            'search' => $search,
            'warehouse_id' => $warehouse_id,
            'daterangepicker' => $dateRange,
            'driver_id' => $driver_id,
            'per_page' => $perPage,
        ]);

        $serialStart = ($currentPage - 1) * $perPage;

        // 📦 Warehouses
        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->get();

        // 🚚 Drivers
        $drivers = User::where('role_id', 4)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        // 👥 Customers
        $customers = User::where('role_id', 3)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        $totalsQuery = clone $query;

        $totalInvoiced   = $totalsQuery->sum('grand_total') ?? 0;
        $totalBalance   = $totalsQuery->sum('balance') ?? 0;
        $totalPayment   = $totalsQuery->sum('payment') ?? 0;
        $totalDiscount   = $totalsQuery->sum('discount') ?? 0;
        $totalService    = (clone $query)->where('invoce_type', 'services')->sum('grand_total') ?? 0;
        $totalSupplies   = (clone $query)->where('invoce_type', 'supplies')->sum('grand_total') ?? 0;

        $invoiceIds = $query->pluck('id')->toArray();

        $paymentTotals = IndividualPayment::whereIn('invoice_id', $invoiceIds)
            ->selectRaw("
        SUM(CASE WHEN payment_type = 'cash' THEN payment_amount ELSE 0 END) as totalCash,
        SUM(CASE WHEN payment_type = 'cheque' THEN payment_amount ELSE 0 END) as totalCheque,
        SUM(CASE WHEN payment_type = 'CreditCard' THEN payment_amount ELSE 0 END) as totalCreditCard
    ")->first();

        $totalCash       = $paymentTotals->totalCash ?? 0;
        $totalCheque     = $paymentTotals->totalCheque ?? 0;
        $totalCreditCard = $paymentTotals->totalCreditCard ?? 0;


        if ($request->ajax()) {
            return view('admin.end_of_day.table.supply_table', compact(
                'invoices',
                'drivers',
                'customers',
                'serialStart',
                'warehouses',
                'totalInvoiced',
                'totalBalance',
                'totalPayment',
                'totalDiscount',
                'totalService',
                'totalSupplies',
                'totalCash',
                'totalCheque',
                'totalCreditCard'
            ))->render();
        }

        return view('admin.end_of_day.index.supply_index', compact(
            'drivers',
            'customers',
            'invoices',
            'warehouses',
            'search',
            'warehouse_id',
            'dateRange',
            'driver_id',
            'perPage',
            'serialStart',
            'totalInvoiced',
            'totalBalance',
            'totalPayment',
            'totalDiscount',
            'totalService',
            'totalSupplies',
            'totalCash',
            'totalCheque',
            'totalCreditCard'
        ));
    }

    public function Payments_index(Request $request)
    {
        $search = $request->input('search');
        $warehouse_id = $request->input('warehouse_id');
        $driver_id = $request->input('driver_id');
        $customer_id = $request->input('customer_id');

        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);

        $start_date = null;
        $end_date = null;
        $dateRange = $request->input('eod_datetimes');

        if ($dateRange) {
            try {
                [$start_date, $end_date] = explode(' - ', $dateRange);
            } catch (\Exception $e) {
                $start_date = null;
                $end_date = null;
            }
        }

        $query = IndividualPayment::with(['invoice', 'invoice.driver', 'invoice.customer', 'warehouse'])
            ->whereHas('invoice', function ($q) use ($driver_id, $customer_id, $warehouse_id, $start_date, $end_date) {
                if ($driver_id) {
                    $q->where('driver_id', $driver_id);
                }
                if ($customer_id) {
                    $q->where('customer_id', $customer_id);
                }
                if ($warehouse_id) {
                    $q->where('warehouse_id', $warehouse_id);
                }
                if (!empty($start_date) && !empty($end_date)) {
                    $q->whereDate('payment_date', '>=', $start_date)->whereDate('payment_date', '<=', $end_date);
                }
            })
            ->when($this->user->role_id != 1, function ($q) {
                $q->whereHas('invoice', function ($q2) {
                    $q2->where('warehouse_id', $this->user->warehouse_id);
                });
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('unique_id', 'LIKE', "%$search%")
                    ->orWhereHas('invoice.driver', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%")
                            ->orWhere('last_name', 'LIKE', "%$search%")
                            ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                    })
                    ->orWhereHas('invoice.customer', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%")
                            ->orWhere('last_name', 'LIKE', "%$search%")
                            ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                    });
            });
        }

        $payments = $query->latest()->paginate($perPage)->appends([
            'search' => $search,
            'warehouse_id' => $warehouse_id,
            'daterangepicker' => $dateRange,
            'driver_id' => $driver_id,
            'per_page' => $perPage,
        ]);

        $serialStart = ($currentPage - 1) * $perPage;

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->get();

        $drivers = User::where('role_id', 4)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        $customers = User::where('role_id', 3)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        $totalsQuery = clone $query;
        $totals = $totalsQuery->get()->pluck('invoice')->filter();

        $totalInvoiced  = $totals->sum('grand_total');
        $totalBalance   = $totals->sum('balance');
        $totalPayment   = $totals->sum('payment');
        $totalDiscount  = $totals->sum('discount');
        $totalService   = $totals->where('invoce_type', 'services')->sum('grand_total');
        $totalSupplies  = $totals->where('invoce_type', 'supplies')->sum('grand_total');

        $invoiceIds = $query->pluck('id')->toArray();

        $paymentTotals = IndividualPayment::whereIn('invoice_id', $invoiceIds)
            ->selectRaw("
            SUM(CASE WHEN payment_type = 'cash' THEN payment_amount ELSE 0 END) as totalCash,
            SUM(CASE WHEN payment_type = 'cheque' THEN payment_amount ELSE 0 END) as totalCheque,
            SUM(CASE WHEN payment_type = 'CreditCard' THEN payment_amount ELSE 0 END) as totalCreditCard
        ")->first();

        $totalCash       = $paymentTotals->totalCash ?? 0;
        $totalCheque     = $paymentTotals->totalCheque ?? 0;
        $totalCreditCard = $paymentTotals->totalCreditCard ?? 0;

        if ($request->ajax()) {
            return view('admin.end_of_day.table.payment_table', compact(
                'payments',
                'drivers',
                'customers',
                'serialStart',
                'warehouses',
                'totalInvoiced',
                'totalBalance',
                'totalPayment',
                'totalDiscount',
                'totalService',
                'totalSupplies',
                'totalCash',
                'totalCheque',
                'totalCreditCard'
            ))->render();
        }

        return view('admin.end_of_day.index.payment_index', compact(
            'drivers',
            'customers',
            'payments',
            'warehouses',
            'search',
            'warehouse_id',
            'dateRange',
            'driver_id',
            'perPage',
            'serialStart',
            'totalInvoiced',
            'totalBalance',
            'totalPayment',
            'totalDiscount',
            'totalService',
            'totalSupplies',
            'totalCash',
            'totalCheque',
            'totalCreditCard'
        ));
    }

    public function Expenses_index(Request $request)
    {
        $search = $request->input('search');
        $warehouse_id = $request->input('warehouse_id');
        $category = $request->input('category');
        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);
        $dateRange = $request->input('eod_datetimes');
        $driver_id = $request->input('driver_id');
        $customer_id = $request->input('customer_id');
        $start_date = null;
        $end_date = null;
        if ($dateRange) {
            try {
                [$start_date, $end_date] = explode(' - ', $dateRange);
                $start_date = $start_date;
                $end_date = $end_date;
            } catch (\Exception $e) {
                $start_date = null;
                $end_date = null;
            }
        }
        // Expense Query
        $query = Expense::with(['creatorUser', 'warehouse'])->where('status', 'Active')->where('category', 'Expense')
            ->when($this->user->role_id != 1, fn($q) => $q->where('warehouse_id', $this->user->warehouse_id));

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'LIKE', "%$search%")
                    ->orWhere('unique_id', 'LIKE', "%$search%")
                    ->orWhere('amount', 'LIKE', "%$search%")
                    ->orWhereHas('creatorUser', fn($q) => $q->where('name', 'LIKE', "%$search%"));
            });
        }

        if ($warehouse_id) {
            $query->where('warehouse_id', $warehouse_id);
        }

        if ($driver_id) {
            $query->where('creator_user_id', $driver_id);
        }

        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('date', [$start_date, $end_date]);
        }

        if ($category) {
            $query->where('category', $category);
        }

        $expenses = $query->latest()->paginate($perPage)->appends([
            'search' => $search,
            'warehouse_id' => $warehouse_id,
            'daterangepicker' => $dateRange,
            'category' => $category,
            'per_page' => $perPage,
        ]);

        $serialStart = ($currentPage - 1) * $perPage;

        $totalExpensesamount   = (clone $query)->sum('amount') ?? 0;

        // Invoice Summary Query (Independent from Expense)
        $invoiceQuery = Invoice::query()
            ->when($this->user->role_id != 1, fn($q) => $q->where('warehouse_id', $this->user->warehouse_id))
            ->when($warehouse_id, fn($q) => $q->where('warehouse_id', $warehouse_id))
            ->when(!empty($driver_id), fn($q) => $q->where('driver_id', $driver_id))
            ->when(!empty($customer_id), fn($q) => $q->where('customer_id', $customer_id))
            ->when(!empty($start_date) && !empty($end_date), fn($q) => $q->whereBetween('issue_date', [$start_date, $end_date]));


        $totalInvoiced   = $invoiceQuery->sum('grand_total') ?? 0;
        $totalBalance    = $invoiceQuery->sum('balance') ?? 0;
        $totalPayment    = $invoiceQuery->sum('payment') ?? 0;
        $totalDiscount   = $invoiceQuery->sum('discount') ?? 0;
        $totalService    = (clone $invoiceQuery)->where('invoce_type', 'services')->sum('grand_total') ?? 0;
        $totalSupplies   = (clone $invoiceQuery)->where('invoce_type', 'supplies')->sum('grand_total') ?? 0;

        $invoiceIds = $invoiceQuery->pluck('id')->toArray();

        $paymentTotals = IndividualPayment::whereIn('invoice_id', $invoiceIds)->selectRaw("
        SUM(CASE WHEN payment_type = 'cash' THEN payment_amount ELSE 0 END) as totalCash,
        SUM(CASE WHEN payment_type = 'cheque' THEN payment_amount ELSE 0 END) as totalCheque,
        SUM(CASE WHEN payment_type = 'CreditCard' THEN payment_amount ELSE 0 END) as totalCreditCard
    ")->first();

        $totalCash       = $paymentTotals->totalCash ?? 0;
        $totalCheque     = $paymentTotals->totalCheque ?? 0;
        $totalCreditCard = $paymentTotals->totalCreditCard ?? 0;

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, fn($q) => $q->where('id', $this->user->warehouse_id))
            ->get();

        $drivers = User::where('role_id', 4)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        $customers = User::where('role_id', 3)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        if ($request->ajax()) {
            return view('admin.end_of_day.table.expenses_table', compact(
                'expenses',
                'warehouses',
                'drivers',
                'customers',
                'search',
                'warehouse_id',
                'dateRange',
                'category',
                'perPage',
                'serialStart',
                'totalInvoiced',
                'totalBalance',
                'totalPayment',
                'totalDiscount',
                'totalService',
                'totalSupplies',
                'totalCash',
                'totalCheque',
                'totalCreditCard',
                'totalExpensesamount'
            ))->render();
        }

        return view('admin.end_of_day.index.expenses_index', compact(
            'expenses',
            'warehouses',
            'drivers',
            'customers',
            'search',
            'warehouse_id',
            'dateRange',
            'category',
            'perPage',
            'serialStart',
            'totalInvoiced',
            'totalBalance',
            'totalPayment',
            'totalDiscount',
            'totalService',
            'totalSupplies',
            'totalCash',
            'totalCheque',
            'totalCreditCard',
            'totalExpensesamount'
        ));
    }

    public function Void_index(Request $request)
    {
        // Get input parameters
        $search = $request->input('search');
        $warehouse_id = $request->input('warehouse_id');
        $category = $request->input('category');
        $type = $request->input('type');

        $perPage = $request->input('per_page', 10); // Default pagination
        $currentPage = $request->input('page', 1);

        // Date range handling from frontend date picker (class: Expensefillterdate)
        $start_date = null;
        $end_date = null;
        $dateRange = $request->input('daterangepicker'); // input name in the form

        if ($dateRange) {
            try {
                [$start_date, $end_date] = explode(' - ', $dateRange);
                $start_date = \Carbon\Carbon::createFromFormat('m/d/Y', trim($start_date))->format('Y-m-d');
                $end_date = \Carbon\Carbon::createFromFormat('m/d/Y', trim($end_date))->format('Y-m-d');
            } catch (\Exception $e) {
                // Invalid format handling (optional)
                $start_date = null;
                $end_date = null;
            }
        }

        // Start building the query
        $query = Expense::with(['creatorUser', 'warehouse'])->where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            });

        // Apply search filter
        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'LIKE', "%$search%")
                    ->orWhere('unique_id', 'LIKE', '%' . $search . '%')
                    ->orWhere('amount', 'LIKE', "%$search%")
                    ->orWhereHas('creatorUser', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    });
            });
        }

        // Apply category filter
        if ($category) {
            $query->where('category', $category);
        }

        // Apply type filter
        if ($type) {
            $query->where('type', $type);
        }


        // Apply warehouse filter
        if ($warehouse_id) {
            $query->where('warehouse_id', $warehouse_id);
        }

        // Apply date range filter
        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('date', [$start_date, $end_date]);
        }

        // Apply category filter
        if ($category) {
            $query->where('category', $category);
        }

        // Paginate the results
        $expenses = $query->latest()->paginate($perPage)->appends([
            'search' => $search,
            'warehouse_id' => $warehouse_id,
            'daterangepicker' => $dateRange,
            'category' => $category,
            'per_page' => $perPage,
        ]);

        // Calculate serial number start
        $serialStart = ($currentPage - 1) * $perPage;

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->get();

        // Return view or AJAX response
        if ($request->ajax()) {
            return view('admin.end_of_day.table.invoice_table', compact('expenses', 'serialStart', 'warehouses'))->render();
        }

        return view('admin.end_of_day.index.invoice_index', compact(
            'expenses',
            'warehouses',
            'search',
            'warehouse_id',
            'dateRange',
            'category',
            'perPage',
            'serialStart'
        ));
    }

    public function Deposit_index(Request $request)
    {
        $search = $request->input('search');
        $warehouse_id = $request->input('warehouse_id');
        $category = $request->input('category');
        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);
        $dateRange = $request->input('eod_datetimes');
        $driver_id = $request->input('driver_id');
        $customer_id = $request->input('customer_id');
        $start_date = null;
        $end_date = null;
        if ($dateRange) {
            try {
                [$start_date, $end_date] = explode(' - ', $dateRange);
                $start_date = $start_date;
                $end_date = $end_date;
            } catch (\Exception $e) {
                $start_date = null;
                $end_date = null;
            }
        }
        // Expense Query
        $query = Expense::with(['creatorUser', 'warehouse'])->where('status', 'Active')->where('category', 'Deposit')
            ->when($this->user->role_id != 1, fn($q) => $q->where('warehouse_id', $this->user->warehouse_id));

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'LIKE', "%$search%")
                    ->orWhere('unique_id', 'LIKE', "%$search%")
                    ->orWhere('amount', 'LIKE', "%$search%")
                    ->orWhereHas('creatorUser', fn($q) => $q->where('name', 'LIKE', "%$search%"));
            });
        }

        if ($warehouse_id) {
            $query->where('warehouse_id', $warehouse_id);
        }

        if ($driver_id) {
            $query->where('creator_user_id', $driver_id);
        }

        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('date', [$start_date, $end_date]);
        }

        if ($category) {
            $query->where('category', $category);
        }

        $expenses = $query->latest()->paginate($perPage)->appends([
            'search' => $search,
            'warehouse_id' => $warehouse_id,
            'daterangepicker' => $dateRange,
            'category' => $category,
            'per_page' => $perPage,
        ]);

        $serialStart = ($currentPage - 1) * $perPage;

        $totalExpensesamount   = (clone $query)->sum('amount') ?? 0;

        // Invoice Summary Query (Independent from Expense)
        $invoiceQuery = Invoice::query()
            ->when($this->user->role_id != 1, fn($q) => $q->where('warehouse_id', $this->user->warehouse_id))
            ->when($warehouse_id, fn($q) => $q->where('warehouse_id', $warehouse_id))
            ->when(!empty($driver_id), fn($q) => $q->where('driver_id', $driver_id))
            ->when(!empty($customer_id), fn($q) => $q->where('customer_id', $customer_id))
            ->when(!empty($start_date) && !empty($end_date), fn($q) => $q->whereBetween('issue_date', [$start_date, $end_date]));


        $totalInvoiced   = $invoiceQuery->sum('grand_total') ?? 0;
        $totalBalance    = $invoiceQuery->sum('balance') ?? 0;
        $totalPayment    = $invoiceQuery->sum('payment') ?? 0;
        $totalDiscount   = $invoiceQuery->sum('discount') ?? 0;
        $totalService    = (clone $invoiceQuery)->where('invoce_type', 'services')->sum('grand_total') ?? 0;
        $totalSupplies   = (clone $invoiceQuery)->where('invoce_type', 'supplies')->sum('grand_total') ?? 0;

        $invoiceIds = $invoiceQuery->pluck('id')->toArray();

        $paymentTotals = IndividualPayment::whereIn('invoice_id', $invoiceIds)->selectRaw("
        SUM(CASE WHEN payment_type = 'cash' THEN payment_amount ELSE 0 END) as totalCash,
        SUM(CASE WHEN payment_type = 'cheque' THEN payment_amount ELSE 0 END) as totalCheque,
        SUM(CASE WHEN payment_type = 'CreditCard' THEN payment_amount ELSE 0 END) as totalCreditCard")->first();

        $totalCash       = $paymentTotals->totalCash ?? 0;
        $totalCheque     = $paymentTotals->totalCheque ?? 0;
        $totalCreditCard = $paymentTotals->totalCreditCard ?? 0;

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, fn($q) => $q->where('id', $this->user->warehouse_id))
            ->get();

        $drivers = User::where('role_id', 4)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        $customers = User::where('role_id', 3)
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        if ($request->ajax()) {
            return view('admin.end_of_day.table.deposit_table', compact(
                'expenses',
                'warehouses',
                'drivers',
                'customers',
                'search',
                'warehouse_id',
                'dateRange',
                'category',
                'perPage',
                'serialStart',
                'totalInvoiced',
                'totalBalance',
                'totalPayment',
                'totalDiscount',
                'totalService',
                'totalSupplies',
                'totalCash',
                'totalCheque',
                'totalCreditCard',
                'totalExpensesamount'
            ))->render();
        }

        return view('admin.end_of_day.index.deposit_index', compact(
            'expenses',
            'warehouses',
            'drivers',
            'customers',
            'search',
            'warehouse_id',
            'dateRange',
            'category',
            'perPage',
            'serialStart',
            'totalInvoiced',
            'totalBalance',
            'totalPayment',
            'totalDiscount',
            'totalService',
            'totalSupplies',
            'totalCash',
            'totalCheque',
            'totalCreditCard',
            'totalExpensesamount'
        ));
    }

    public function Print_index(Request $request)
    {
        // Get input parameters
        $search = $request->input('search');
        $warehouse_id = $request->input('warehouse_id');
        $category = $request->input('category');
        $type = $request->input('type');

        $perPage = $request->input('per_page', 10); // Default pagination
        $currentPage = $request->input('page', 1);

        // Date range handling from frontend date picker (class: Expensefillterdate)
        $start_date = null;
        $end_date = null;
        $dateRange = $request->input('daterangepicker'); // input name in the form

        if ($dateRange) {
            try {
                [$start_date, $end_date] = explode(' - ', $dateRange);
                $start_date = \Carbon\Carbon::createFromFormat('m/d/Y', trim($start_date))->format('Y-m-d');
                $end_date = \Carbon\Carbon::createFromFormat('m/d/Y', trim($end_date))->format('Y-m-d');
            } catch (\Exception $e) {
                // Invalid format handling (optional)
                $start_date = null;
                $end_date = null;
            }
        }

        // Start building the query
        $query = Expense::with(['creatorUser', 'warehouse'])->where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            });

        // Apply search filter
        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'LIKE', "%$search%")
                    ->orWhere('unique_id', 'LIKE', '%' . $search . '%')
                    ->orWhere('amount', 'LIKE', "%$search%")
                    ->orWhereHas('creatorUser', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    });
            });
        }

        // Apply category filter
        if ($category) {
            $query->where('category', $category);
        }

        // Apply type filter
        if ($type) {
            $query->where('type', $type);
        }


        // Apply warehouse filter
        if ($warehouse_id) {
            $query->where('warehouse_id', $warehouse_id);
        }

        // Apply date range filter
        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('date', [$start_date, $end_date]);
        }

        // Apply category filter
        if ($category) {
            $query->where('category', $category);
        }

        // Paginate the results
        $expenses = $query->latest()->paginate($perPage)->appends([
            'search' => $search,
            'warehouse_id' => $warehouse_id,
            'daterangepicker' => $dateRange,
            'category' => $category,
            'per_page' => $perPage,
        ]);

        // Calculate serial number start
        $serialStart = ($currentPage - 1) * $perPage;

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->get();

        // Return view or AJAX response
        if ($request->ajax()) {
            return view('admin.end_of_day.table.invoice_table', compact('expenses', 'serialStart', 'warehouses'))->render();
        }

        return view('admin.end_of_day.index.invoice_index', compact(
            'expenses',
            'warehouses',
            'search',
            'warehouse_id',
            'dateRange',
            'category',
            'perPage',
            'serialStart'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(string $id)
    {
        //
    }
}
