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
};

class EODController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
        // if ($request->ajax()) {
        //     return view('admin.end_of_day.table', compact('expenses', 'serialStart', 'warehouses'))->render();
        // }

        return view('admin.end_of_day.index', compact(
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
