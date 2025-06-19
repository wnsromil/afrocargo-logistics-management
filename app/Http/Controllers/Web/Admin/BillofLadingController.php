<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    BillOfLanding
};

class BillofLadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default to 10 per page

        $billOfLadings = BillOfLanding::query()
            // 🔹 Search Logic
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query
                        ->where('unique_id', 'like', "%$search%")
                        ->orWhere('company', 'like', "%$search%")
                        ->orWhere('type', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%")
                        ->orWhere('address', 'like', "%$search%")
                        ->orWhere('address2', 'like', "%$search%")
                        ->orWhere('city', 'like', "%$search%")
                        ->orWhere('state', 'like', "%$search%")
                        ->orWhere('zip', 'like', "%$search%")
                        ->orWhere('country', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%")
                        ->orWhere('cellphone', 'like', "%$search%")
                        ->orWhere('carrier', 'like', "%$search%");
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
            ]);

        if ($request->ajax()) {
            return view('admin.bill_of_lading.table', compact('billOfLadings'))->render();
        }

        return view('admin.bill_of_lading.index', compact(
            'billOfLadings',
            'search',
            'perPage'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.bill_of_lading.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            // 'country' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'phone_code' => 'nullable|string|max:10',
            'cellphone' => 'nullable|string|max:50',
            'cellphone_code' => 'nullable|string|max:10',
            'carrier' => 'nullable|string|max:255',
            // Add other fields as needed
        ]);

        $billOfLading = BillOfLanding::create($validated);

        return redirect()
            ->route('admin.bill_of_lading.index')
            ->with('success', 'Bill of Lading created successfully.');
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
        $billOfLading = BillOfLanding::findOrFail($id);
        return view('admin.bill_of_lading.edit', compact('billOfLading'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            // 'country' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'phone_code' => 'nullable|string|max:10',
            'cellphone' => 'nullable|string|max:50',
            'cellphone_code' => 'nullable|string|max:10',
            'carrier' => 'nullable|string|max:255',
            // Add other fields as needed
        ]);

        $billOfLading = BillOfLanding::findOrFail($id);
        $billOfLading->update($validated);

        return redirect()
            ->route('admin.bill_of_lading.index')
            ->with('success', 'Bill of Lading updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $billOfLading = BillOfLanding::findOrFail($id);
        $billOfLading->delete();

        return redirect()
            ->route('admin.bill_of_lading.index')
            ->with('success', 'Bill of Lading deleted successfully.');
    }

}
