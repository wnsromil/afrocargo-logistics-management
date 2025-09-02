<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
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

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get input parameters
        $search = $request->input('search');
        $warehouse_id = $request->input('warehouse_id');
        $user_id = $request->input('user_id');
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

         if ($user_id) {
            $query->where('creator_user_id', $user_id);
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

        $users = User::whereIn('role_id', [4, 2])
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        // Return view or AJAX response
        if ($request->ajax()) {
            return view('admin.expenses.table', compact('expenses', 'serialStart', 'warehouses', 'users'))->render();
        }

        return view('admin.expenses.index', compact(
            'expenses',
            'warehouses',
            'search',
            'warehouse_id',
            'dateRange',
            'category',
            'perPage',
            'serialStart',
            'users'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Warehouses list with role check
        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })->get();

        // Users list with role check
        $users = User::where('status', 'Active')
            ->whereIn('role_id', [2, 4])
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })->get();

        // Containers list with role check
        $containers = Vehicle::where('vehicle_type', '1')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })->get();
        $time = Carbon::now()->format('h:i A');
        return view('admin.expenses.create', compact('time', 'warehouses', 'users', 'containers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'warehouse' => 'required|exists:warehouses,id',
            'expense_date' => 'required|date_format:m/d/Y',
            'description' => 'required|string',
            'type' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'currency' => 'required|string',
        ]);

        $status  = !empty($request->status) ? $request->status : 'Active';
        $validatedData['status'] = $status;
        $validatedData['date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $request->expense_date)->format('Y-m-d');
        $validatedData['warehouse_id'] = $request->warehouse;
        $validatedData['creator_user_id'] = $request->user_id;
        $validatedData['creator_id'] = $request->creator_id;
        $validatedData['container_id'] = $request->container_id;
        $validatedData['time'] = $request->currentTIme;
        $validatedData['currency'] = $request->currency;
        $validatedData['type'] = $request->type;
        $allData = $request->except('_token');
        $dataToStore = array_merge($allData, $validatedData);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/expenses', $filename, 'public'); // Store in 'storage/app/public/uploads/licenses'
            $dataToStore['img'] = 'storage/' . $filePath; // Get full URL
        }

        $expense = Expense::create($dataToStore);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense added successfully.');
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

        return view('admin.expenses.show', compact('ParcelHistories', 'parcelTpyes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);

        $warehouses = Warehouse::where('status', 'Active')->when(auth()->user()->role_id != 1, function ($q) {
            return $q->where('id', auth()->user()->warehouse_id);
        })->get();

        $users = User::where('status', 'Active')
            ->whereIn('role_id', [2, 4])
            ->when(auth()->user()->role_id != 1, function ($q) {
                return $q->where('warehouse_id', auth()->user()->warehouse_id);
            })->get();

        $containers = Vehicle::where('vehicle_type', '1')
            ->when(auth()->user()->role_id != 1, function ($q) {
                return $q->where('warehouse_id', auth()->user()->warehouse_id);
            })->get();

        return view('admin.expenses.edit', compact('expense', 'warehouses', 'users', 'containers'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'edit_expense_date' => 'required|date',
            'warehouse' => 'required|exists:warehouses,id',
            'description' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'container_id' => 'nullable|exists:vehicles,id',
            'amount' => 'required|numeric',
            'category' => 'required|in:Expense,Deposit',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'type' => 'required|string', // Uncomment if 'type' is required  
            'currency' => 'required|string',
            // 'status' => 'nullable|in:Active'
        ]);

        $expense = Expense::findOrFail($id);

        $expense->date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->edit_expense_date)->format('Y-m-d');
        $expense->description = $request->description;
        $expense->creator_user_id = $request->user_id;
        $expense->container_id = $request->container_id;
        $expense->amount = $request->amount;
        $expense->category = $request->category;
        $expense->currency = $request->currency;
        $expense->warehouse_id = $request->warehouse;
        $expense->type = $request->type; // Ensure 'type' is set if required
        $expense->status = !empty($request->status) ? $request->status : 'Active';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/expenses', $filename, 'public'); // Store in 's
            $expense->img = 'storage/' . $filePath;
        }
        if ($request->delete_img == "Yes") {
            $expense->img = null;
        }

        $expense->save();

        return redirect()->route('admin.expenses.index')->with('success', 'Expense updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $signature = Expense::find($id);

        if ($signature) {
            $signature->status = 'Inactive'; // ya 0, agar status boolean/int ho
            $signature->save();
        }

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense deleted successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $expense = Expense::find($id);

        if ($expense) {
            $expense->status = $request->status; // 1 = Active, 0 = Deactive
            $expense->save();

            return response()->json(['success' => 'Status Updated Successfully']);
        }

        return response()->json(['error' => 'Expense Not Found']);
    }
}
