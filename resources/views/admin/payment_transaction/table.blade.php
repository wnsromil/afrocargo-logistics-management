<div class="card-table mt-2">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Transaction ID</th>
                        <th>User</th>
                        <th>Warehouse</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_id ?? '--' }}</td>
                            <td>{{ $transaction->customer->name ?? '' }} {{ $transaction->customer->last_name ?? '--' }}</td>
                            <td>{{ $transaction->warehouse->warehouse_name ?? '--' }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('m-d-Y H:i:s') }}</td>
                            <td>
                                @php
                                    $status = $transaction->status ?? '';

                                    if ($status === 'succeeded') {
                                        $badgeClass = 'new-badge-delivered';
                                        $displayStatus = 'Succeeded';
                                    } elseif ($status === 'canceled') {
                                        $badgeClass = 'new-badge-cancelled';
                                        $displayStatus = 'Canceled';
                                    } else {
                                        $badgeClass = 'new-badge-pending';
                                        $displayStatus = 'Failed';  // static "Failed" show karna hai
                                    }
                                @endphp
                                <label class="{{ $badgeClass }} new-comman-css" for="status">{{ $displayStatus }}</label>
                            </td>
                            <td>${{ number_format($transaction->amount, 2) ?? '--' }}</td>
                            <td>{{ strtoupper($transaction->currency) ?? '--' }}</td>
                            <td>{{ ucfirst($transaction->payment_method ?? '--')  }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-4 text-center text-gray-500">No Data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
    <div class="col-md-6 d-flex p-2 align-items-center">
        <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
        <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example"
            id="pageSizeSelect">
            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
        </select>
        <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
    </div>
    <div class="col-md-6">
        <div class="float-end">
            <div class="bottom-user-page mt-3">
                {!! $transactions->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>