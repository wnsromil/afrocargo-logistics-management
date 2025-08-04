<div class="card-table">
    <div class="text-center" style="color: black;">
        <span class="fw-600 fs-5">Payments</span>
    </div>
    <div class="card-body">
        <div class="table-responsive smpadding mt-2">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Customer</th>
                        <th>Driver</th>
                        <th>Warehouse</th>
                        <th>Rec.No</th>
                        <th>P.Date</th>
                        <th>Inv.No</th>
                        <th>Inv.Amout</th>
                        <th>Inv.Date</th>
                        <th>Amt.In Doller</th>
                        <th>Local Currency</th>
                        <th>Currency</th>
                        <th>P.Type</th>
                        <th>Balance</th>
                    </tr>
                </thead>

                     <tbody>
                            @forelse ($payments as $key => $payment)
                                <tr>
                                    <td>{{ $payment->invoice->customer->name ?? '' }}
                                        {{ $payment->invoice->customer->last_name ?? '' }}
                                    </td>
                                    <td>{{ $payment->invoice->driver->name ?? '' }}
                                        {{ $payment->invoice->driver->last_name ?? '' }}
                                    </td>
                                    <td>{{ $payment->warehouse->warehouse_name ?? '--' }}</td>
                                    <td>{{ $payment->unique_id ?? '--' }}</td>
                                    <td>{{ \Carbon\Carbon::parse(time: $payment->payment_date)->format('m-d-Y') }}</td>
                                    <td>{{ $payment->invoice->invoice_no ?? '--' }}</td>
                                    <td>${{ isset($payment->invoice->grand_total) ? number_format($payment->invoice->grand_total, 2) : '--' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->invoice->issue_date)->format('m-d-Y') }}</td>
                                    <td>${{ isset($payment->payment_amount) ? number_format($payment->payment_amount, 2) : '--' }}</td>
                                    <td>{{$payment->local_currency ?? "--" }}</td>
                                    <td>{{ $payment->currency ?? '--' }}</td>
                                    <td>{{ $payment->payment_type ?? '--' }}</td>
                                    <td>${{ isset($payment->total_balance) ? number_format($payment->total_balance, 2) : '--' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
                                    </td>
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
        <select class="form-select input-width form-select-sm opacity-50" aria-label=" Small select example"
            id="pageSizeSelect">
            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10
            </option>
            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
        </select>
        <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
    </div>
    <div class="col-md-6">
        <div class="float-end">
            <div class="bottom-user-page mt-3">
                {!! $payments->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>