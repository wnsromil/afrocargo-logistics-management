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
use Illuminate\Support\Facades\File;

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
        $warehouse_id = $request->input('warehouse_id');

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->select('id', 'warehouse_name')
            ->get();

        $signatures = Signature::where('is_deleted', 'No')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->when($warehouse_id, function ($q) use ($warehouse_id) {
                return $q->where('warehouse_id', $warehouse_id);
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
            return view('admin.signature.table', compact('signatures', 'warehouses'))->render();
        }

        return view('admin.signature.index', compact('signatures', 'warehouses'));
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
        // Step 1: Validate common fields
        $request->validate([
            'warehouse_name'   => 'required|exists:warehouses,id',
            'signature_name'   => 'required|string|max:255',
            'signature_type'   => 'required|in:image,draw',
        ]);

        $data = [];

        if ($request->signature_type === 'image') {
            $request->validate([
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = 'uploads/signature/' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/signature'), $imageName);
                $data['signature_file'] = $imageName;
            }
        } else {
            $request->validate([
                'signature_drawn' => 'required|string',
            ]);

            $drawnData = $request->signature_drawn;
            $imageName = 'uploads/signature/drawn_' . uniqid() . '.png';
            $drawnData = str_replace('data:image/png;base64,', '', $drawnData);
            $drawnData = str_replace(' ', '+', $drawnData);
            \File::put(public_path($imageName), base64_decode($drawnData));
            $data['signature_file'] = $imageName;
        }

        // Step 2: Check if record already exists
        $existing = Signature::where('warehouse_id', $request->warehouse_name)
            ->where('is_deleted', 'No')
            ->first();

        if ($existing) {
            $existing->update([
                'signature_file' => $data['signature_file'],
            ]);

            return redirect()->route('admin.signature.index')
                ->with('success', 'Signature image updated successfully.');
        }

        // Step 3: Create new signature
        Signature::create([
            'warehouse_id'     => $request->warehouse_name,
            'signature_name'   => $request->signature_name,
            'signature_type'   => $request->signature_type,
            'signature_file'   => $data['signature_file'],
            'creator_user_id'  => auth()->id(),
        ]);

        return redirect()->route('admin.signature.index')
            ->with('success', 'Signature added successfully.');
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

        // Step 1: Validate base fields
        $request->validate([
            'warehouse_name'   => 'required|exists:warehouses,id',
            'signature_name'   => 'required|string|max:255',
            'signature_type'   => 'required|in:image,draw',
        ]);

        $signature = Signature::findOrFail($id);

        $filePath = $signature->signature_file; // Default existing path

        // Step 2: Check for deletion
        if ($request->delete_img == '1') {
            if ($filePath && file_exists(public_path($filePath))) {
                unlink(public_path($filePath));
            }
            $filePath = null;
            $request->validate([
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'signature_drawn' => 'required|string',
            ]);
        }

        // Step 3: New image upload
        if ($request->signature_type === 'image' && $request->hasFile('img')) {
            $request->validate([
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $request->file('img');
            $filePath = 'uploads/signature/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/signature'), $filePath);
        }

        // Step 4: Handle drawn signature
        if ($request->signature_type === 'draw') {
            $request->validate([
                'signature_drawn' => 'required|string',
            ]);
            $drawnData = $request->signature_drawn;
            $drawnData = str_replace('data:image/png;base64,', '', $drawnData);
            $drawnData = str_replace(' ', '+', $drawnData);
            $filePath = 'uploads/signature/drawn_' . uniqid() . '.png';
            \File::put(public_path($filePath), base64_decode($drawnData));
        }

        // Step 5: Save all data
        $signature->update([
            'warehouse_id'     => $request->warehouse_name,
            'signature_name'   => $request->signature_name,
            'signature_file'   => $filePath,
            'signature_type'   => $request->signature_type,
        ]);

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
