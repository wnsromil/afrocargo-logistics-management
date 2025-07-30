<div class="card-table">
    <div class="text-center" style="color: black;">
        <span class="fw-600 fs-5">Invoice</span>
    </div>
    <div class="card-body">
        <div class="table-responsive smpadding mt-2">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Customer</th>
                        <th>Driver</th>
                        <th>TT</th>
                        <th>Inv No</th>
                        <th>Inv Date</th>
                        <th>Inv.Amout</th>
                        <th>Payment</th>
                        <th>Balance</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($invoices as $key => $invoice)
                        <tr>
                            <td>{{ $invoice->customer->name ?? '' }} {{ $invoice->customer->last_name ?? '' }}</td>
                            <td>{{ $invoice->driver->name ?? '' }} {{ $invoice->driver->last_name ?? '' }}</td>
                            <td>
                                @if ($invoice->invoce_type === 'services')
                                    Service
                                @elseif ($invoice->invoce_type === 'supplies')
                                    Supply
                                @else
                                    --
                                @endif
                            </td>
                            <td>{{ $invoice->invoice_no ?? '--' }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->created_at)->format('m-d-Y') }}</td>
                            <td>${{ number_format($invoice->grand_total, 2) }}</td>
                            <td>${{ number_format($invoice->payment, 2) }}</td>
                            <td>${{ number_format($invoice->balance, 2) }}</td>
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
                {!! $invoices->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>