<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    CustomReport,
    CustomInvoiceReport,
    Warehouse,
    Vehicle
};

class CustomReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return $request->all();
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $totalAmount = CustomReport::selectRaw('SUM(invoiced + expense) as total_sum')->value('total_sum');
        $totalInvoiced = CustomReport::selectRaw('SUM(invoiced) as total_invoiced')->value('total_invoiced');
        $totalExpense = CustomReport::selectRaw('SUM(expense) as total_expense')->value('total_expense');
        
        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $containers = Vehicle::where('vehicle_type','Container')->get();


        $query = CustomReport::query()
        ->when($request->input('warehouse_id'), function ($q) use ($request) {
            return $q->where('warehouse_id', $request->input('warehouse_id'));
        })
        ->when($request->input('container_id'), function ($q) use ($request) {
            return $q->where('container_id', $request->input('container_id'));
        })
        ->when($request->input('report_date'), function ($q) use ($request) {
            return $q->where('report_date', $request->input('report_date'));
        })
        ->when($request->input('report_type'), function ($q) use ($request) {
            return $q->where('report_type', $request->input('report_type'));
        });

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('doc_id', 'like', "%{$search}%")
                  ->orWhere('report_type', 'like', "%{$search}%")
                  ->orWhere('report_date', 'like', "%{$search}%");
            });
        }

        $customReports = $query->latest()
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);

        if ($request->ajax()) {
            return view('admin.customReport.ajex.index_table', compact('customReports','warehouses','containers',));
        }

        return view('admin.customReport.index', compact('customReports','warehouses','containers','totalAmount','totalInvoiced','totalExpense'));
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
        // return $request->all();
        $validated = $request->validate([
            'doc_id'         => 'nullable|string|max:255',
            'warehouse_id'   => 'required|integer|exists:warehouses,id',
            'container_id'   => 'required|integer|exists:vehicles,id',
            'created_by'     => 'nullable|integer|exists:users,id',
            'invoiced'       => 'nullable|numeric',
            'expense'        => 'nullable|numeric',
            'expense_income' => 'nullable|numeric',
            'report_date'    => 'required|date',
            'report_type'    => 'required|string|max:255',
        ]);

        $validated['created_by'] = auth()->id();

        $customReport = CustomReport::create($validated);

        return back()
            ->with('success', 'Custom report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        return view('admin.customReportEdit.edit');
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
        $validated = $request->validate([
            'doc_id'         => 'nullable|string|max:255',
            'warehouse_id'   => 'required|integer|exists:warehouses,id',
            'container_id'   => 'required|integer|exists:vehicles,id',
            'invoiced'       => 'nullable|numeric',
            'expense'        => 'nullable|numeric',
            'expense_income' => 'nullable|numeric',
            'report_date'    => 'required|date',
            'report_type'    => 'required|string|max:255',
        ]);

        $customReport = CustomReport::findOrFail($id);
        $customReport->update($validated);

        return back()
            ->with('success', 'Custom report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customReport = CustomReport::findOrFail($id);
        $customReport->delete();

        return back()
            ->with('success', 'Custom report deleted successfully.');
    }

    public function updateCustomReportContainer(Request $request){
        // Validate input
        $request->validate([
            'container_id' => 'required|exists:vehicles,id',
            'container_number' => 'nullable|string|max:255',
            'container_type' => 'nullable|string|max:255',
            'container_capacity' => 'nullable|numeric|min:0',
            'container_status' => 'nullable|integer',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'doc_id' => 'nullable|string|max:255',
            'bill_of_lading' => 'nullable|string|max:255',
        ]);

        // Vehicle model se record find karo
        $vehicle = Vehicle::find($request->container_id);

        // Update fields
        if ($request->container_number) {
            $vehicle->container_number = $request->container_number;
        }
        if($request->container_in_date || $request->container_in_time) {
            $vehicle->container_in_date = $request->container_in_date ?? null;
            $vehicle->container_in_time = $request->container_in_time ?? null;
        }
        if($request->container_type){
            $vehicle->container_type = $request->container_type;
        }
        if($request->container_capacity) {
            $vehicle->container_capacity = $request->container_capacity;
        }
        if($request->warehouse_id) {
            $vehicle->warehouse_id = $request->warehouse_id;
        }
        if($request->container_status) {
            $vehicle->container_status = $request->container_status;
        }
        if($request->doc_id) {
            $vehicle->doc_id = $request->doc_id;
        }
        if($request->bill_of_lading) {
            $vehicle->bill_of_lading = $request->bill_of_lading;
        }
        

        // Save changes
        $vehicle->save();

        return back()->with('success', 'Container updated successfully.');
    }
}
