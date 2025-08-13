<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    StripeTransaction,
    Warehouse,
    User
};
use Carbon\Carbon;

class PaymentTransactionController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('search');
    $warehouse_id = $request->input('warehouse_id');
    $user_id = $request->input('user_id');
    $perPage = (int) $request->input('per_page', 10);
    $currentPage = (int) $request->input('page', 1);
    $dateRange = $request->input('daterangepicker');
    $payment_status = $request->input('payment_status');

    $start_date = null;
    $end_date = null;

    if ($dateRange) {
        try {
            [$start_date, $end_date] = explode(' - ', $dateRange);
            $start_date = \Carbon\Carbon::createFromFormat('m/d/Y', trim($start_date))->format('Y-m-d');
            $end_date = \Carbon\Carbon::createFromFormat('m/d/Y', trim($end_date))->format('Y-m-d');
        } catch (\Exception $e) {
            $start_date = null;
            $end_date = null;
        }
    }

    $query = StripeTransaction::with(['customer', 'parcel', 'warehouse']);

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('transaction_id', 'LIKE', "%$search%")
                ->orWhere('currency', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhereHas('customer', function ($q2) use ($search) {
                    $q2->where('name', 'LIKE', "%$search%")
                        ->orWhere('last_name', 'LIKE', "%$search%")
                        ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%$search%"]);
                })
                ->orWhereHas('parcel', function ($q3) use ($search) {
                    $q3->where('order_id', 'LIKE', "%$search%");
                });
        });
    }

    if ($warehouse_id) {
        $query->where('warehouse_id', $warehouse_id);
    }

    if ($user_id) {
        $query->where('user_id', $user_id);
    }

    if ($payment_status) {
        if ($payment_status == 'failed') {
            $query->whereNotIn('status', ['succeeded', 'canceled']);
        } else {
            $query->where('status', $payment_status);
        }
    }

    if (!empty($start_date) && !empty($end_date)) {
        $query->whereBetween('created_at', [$start_date, $end_date]);
    }

    $transactions = $query->latest()->paginate($perPage)->appends([
        'search' => $search,
        'warehouse_id' => $warehouse_id,
        'daterangepicker' => $dateRange,
        'per_page' => $perPage,
        'user_id' => $user_id,
        'payment_status' => $payment_status,
        'page' => $currentPage,
    ]);

    $serialStart = ($currentPage - 1) * $perPage;

    $warehouses = Warehouse::where('status', 'Active')->get();
    $users = User::whereIn('role_id', [3])->get();

    if ($request->ajax()) {
        return view('admin.payment_transaction.table', compact(
            'transactions',
            'warehouses',
            'users',
            'search',
            'warehouse_id',
            'dateRange',
            'perPage',
            'serialStart',
            'user_id',
            'payment_status'
        ))->render();
    }

    return view('admin.payment_transaction.index', compact(
        'transactions',
        'warehouses',
        'users',
        'search',
        'warehouse_id',
        'dateRange',
        'perPage',
        'serialStart',
        'user_id',
        'payment_status'
    ));
}

}
