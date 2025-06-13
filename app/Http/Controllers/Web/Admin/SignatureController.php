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
    Signature
};

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);

        $signatures = Signature::where('is_deleted', 'No')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('signature_name', 'like', '%' . $search . '%')
                        ->orWhereHas('warehouse', function ($q2) use ($search) {
                            $q2->where('warehouse_name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest()
            ->paginate($perPage, ['*'], 'page', $currentPage);

        if ($request->ajax()) {
            return view('admin.signature.table', compact('signatures'))->render();
        }

        return view('admin.signature.index', compact('signatures'));
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
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $customers = $user->where('role_id', 3)->values();

        $drivers = $user->where('role_id', 4)->values();

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();


        return view('admin.signature.create', compact('warehouses', 'customers', 'drivers', 'parcelTpyes'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Step 1: Validate input
        $request->validate([
            'warehouse_name'     => 'required|exists:warehouses,id',
            'signature_name'   => 'required|string|max:255',
            'img'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Step 2: Upload signature file
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'uploads/signature/' . $image->getClientOriginalName();
            $image->move(public_path('uploads/signature'), $imageName);
            $data['img'] = $imageName;
        }
        // Step 3: Create new signature record
        Signature::create([
            'warehouse_id'     => $request->warehouse_name,
            'signature_name'   => $request->signature_name,
            'signature_file'   => $data['img'],
            'creator_user_id'  => auth()->id(),
        ]);
        return redirect()->route('admin.signature.index')
            ->with('success', 'Signature added successfully');
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

        return view('admin.signature.show', compact('ParcelHistories', 'parcelTpyes'));
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

        $editData = Signature::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->where('id', $id)->first();
        return view('admin.signature.edit', compact('editData', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Step 1: Validate input
        $validated = $request->validate([
            'warehouse_name'   => 'required|exists:warehouses,id',
            'signature_name'   => 'required|string|max:255',
            'img'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Step 2: Find existing signature record
        $signature = Signature::findOrFail($id);

        // Step 3: Handle image upload if provided
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'uploads/signature/' . $image->getClientOriginalName();
            $image->move(public_path('uploads/signature'), $imageName);
            $signature->signature_file = $imageName;
        }

        // Step 4: Update other fields
        $signature->warehouse_id = $request->warehouse_name;
        $signature->signature_name = $request->signature_name;

        $signature->save();

        return redirect()->route('admin.signature.index')
            ->with('success', 'Signature updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $signature = Signature::find($id);

        if ($signature) {
            $signature->is_deleted = 'Yes'; // ya 0, agar status boolean/int ho
            $signature->save();
        }

        return redirect()->route('admin.signature.index')
            ->with('success', 'Signature deleted successfully');
    }

    public function changeSignatureStatus(Request $request, $id)
    {
        $driver = Signature::find($id);

        if ($driver) {
            $driver->status = $request->status; // 1 = Active, 0 = Deactive
            $driver->save();

            return response()->json(['success' => 'Status Updated Successfully']);
        }

        return response()->json(['error' => 'Driver Not Found']);
    }
}
