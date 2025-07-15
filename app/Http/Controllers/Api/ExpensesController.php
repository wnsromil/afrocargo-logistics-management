<?php

namespace App\Http\Controllers\Api;

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

class ExpensesController extends Controller
{
    //

    public function getExpensesByUser(Request $request)
    {
        $userId = auth()->id();

        // Query start karo user ID ke saath
        $query = Expense::where('creator_id', $userId)->where('status', 'Active');

        // Agar request me date di gayi ho to usi date ke expenses filter karo
        if ($request->has('date')) {
            $query->whereDate('date', $request->date);
        }

        $expenses = $query->get();

        if ($expenses->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No expenses found for this user.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Expenses fetched successfully.',
            'data' => $expenses
        ], 200);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'warehouse' => 'required|exists:warehouses,id',
            'expense_date' => 'required|date_format:m/d/Y',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'type' => 'required|string',
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

        return response()->json([
            'status' => 'success',
            'message' => 'Expense added successfully.',
            'data' => $expense
        ], 201); // 201 for created response
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'edit_expense_date' => 'required|date',
            'warehouse' => 'required|exists:warehouses,id',
            'description' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'container_id' => 'nullable|exists:vehicles,id',
            'amount' => 'required|numeric',
            'category' => 'required|in:Expense,Deposit',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'type' => 'required|string',
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
        $expense->type = $request->type;
        $expense->status = !empty($request->status) ? $request->status : 'Active';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/expenses', $filename, 'public'); // Store in 'storage/app/public/uploads/expenses'
            $expense->img = 'storage/' . $filePath;
        }

        $expense->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Expense updated successfully.',
            'data' => $expense
        ], 200); // 200 OK status code
    }
}
