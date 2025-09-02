<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warehouse;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->search;
        $perPage = $request->input('per_page', 10); // Default 10
        $currentPage = $request->input('page', 1); // Current page number

        $notifications = Notification::when($query, function ($q) use ($query) {
            $q->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%$query%")
                    ->orWhere('description', 'LIKE', "%$query%")
                    ->orWhere('type', 'LIKE', "%$query%")
                    ->orWhere('status', 'LIKE', "%$query%");
            });
        })
            ->when($this->user->role_id != 1, function ($q) {
                $q->where(function ($q) {
                    $q->where('user_id', $this->user->id)
                        ->orWhereIn('notification_for', ['All', 'All Warehouse Managers']);
                });
            })
            ->latest()
            ->paginate($perPage)
            ->appends(['search' => $query, 'per_page' => $perPage]);

        // Serial number calculation for pagination
        $serialStart = ($currentPage - 1) * $perPage;

        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->select('id', 'warehouse_name')
            ->get();

        if ($request->ajax()) {
            return view('admin.notification.table', compact('notifications', 'serialStart', 'warehouses'))->render();
        }

        return view('admin.notification.index', compact('notifications', 'query', 'perPage', 'serialStart', 'warehouses'));
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
        $user = User::find($id);

        return view('admin.notification.show', compact('user'));
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
