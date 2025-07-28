<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">
            <table class="table table-stripped table-hover datatable" id="exportTable">
                <thead class="thead-light">
                    <tr>
                        <th>Sn no.</th>
                        <th>Tracking Id</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Warehouse</th>
                        <th>Hub</th>
                        <th>Driver</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th>Amount</th>
                        <th>Payment Mode</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($advanceOrderResports as $index => $report)
                        <tr>
                            <td>{{ $advanceOrderResports->firstItem() + $index }}</td>
                            <td>{{ $report->tracking_number ?? '-' }}</td>
                            <td>
                                {{ $report->full_name ?? '-' }}<br>
                                {{ $report->mobile_number ?? '-' }}
                            </td>
                            <td>
                                {{ $report->ship_full_name ?? '-' }}<br>
                                {{ $report->ship_mobile_number ?? '-' }}
                            </td>
                            <td>{{ $report->warehouse->warehouse_name ?? '-' }}</td>
                            <td>{{ $report->hub_name ?? '-' }}</td>
                            <td>{{ $report->driver_name ?? '-' }}</td>
                            <td>{{ $report->created_at ?? '-' }}</td>
                            @php
                                $status_class = $report->status ?? null;
                                $parcelStatus = $report->order_status ?? null;
                                $classValue = match ((string) $status_class) {
                                    '1' => 'new-badge-pending',
                                    '2' => 'new-badge-pickup',
                                    '3' => 'new-badge-picked-up',
                                    '4' => 'new-badge-arrived',
                                    '5' => 'new-badge-in-transit',
                                    '6' => 'new-badge-warehouse-load',
                                    '7' => 'new-badge-discharge',
                                    '8' => 'new-badge-arrived-final',
                                    '9' => 'new-badge-ready-pickup',
                                    '10' => 'new-badge-out-delivery',
                                    '11' => 'new-badge-delivered',
                                    '12' => 'new-badge-redelivery',
                                    '13' => 'new-badge-on-hold',
                                    '14' => 'new-badge-cancelled',
                                    '15' => 'new-badge-abandoned',
                                    '16' => 'new-badge-ready-transfer',
                                    '17' => 'new-badge-transfer-hub',
                                    '18' => 'new-badge-received',
                                    '19' => 'new-badge-hub-arrived',
                                    '20' => 'new-badge-loading',
                                    '21' => 'new-badge-self-pickup',
                                    '22' => 'new-badge-assign-driver',
                                    '23' => 'new-badge-reschedule',
                                    '24' => 'new-badge-hold',
                                    '25' => 'new-badge-gate-in',
                                    '26' => 'new-badge-in-custom-hold',
                                    '27' => 'new-badge-load-vessel',
                                    '28' => 'new-badge-departure',
                                    '29' => 'new-badge-arrived-vessel',
                                    '30' => 'new-badge-discharge-vessel',
                                    '33' => 'new-badge-hold-cleared',
                                    default => 'new-badge-pending',
                                };

                            @endphp
                            <td>
                                <label class="{{ $classValue }} new-comman-css" for="status">
                                    {{ $parcelStatus ?? '-' }}
                                </label>
                            </td>
                            <td>{{ $report->invoice_total_amount ?? '-' }}</td>
                            <td>{{ $report->payment_mode ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $report->is_paid ? 'success' : 'danger' }}-light">
                                    {{ $report->is_paid ? 'Paid' : 'Unpaid' }}
                                </span>
                            </td>
                            <td class="d-flex align-items-center">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item"
                                                    {{--href="{{ route('admin.orders.show', $report->id) }}" --}}>
                                                    <i class="far fa-eye me-2"></i>View Details
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    {{--href="{{ route('admin.orders.edit', $report->id) }}" --}}>
                                                    <i class="far fa-edit me-2"></i>Edit
                                                </a>
                                            </li>
                                            @if(isset($report->invoice_id))
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.invoices.details', $report->invoice_id) }}">
                                                        <i class="fas fa-file-invoice me-2"></i>View Invoice
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="px-4 py-4 text-center text-gray-500">No orders found.</td>
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
                {!! $advanceOrderResports->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>