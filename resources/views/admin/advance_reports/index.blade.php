<x-app-layout>
    <x-slot name="header">
        {{ __('Advanced Order Reports') }}
    </x-slot>

    {{-- <x-slot name="cardTitle">
        <p class="head">Advanced Reports</p>
        <div class="usersearch d-flex">
            <div>
                <a href="{{ route('admin.advance_reports.export', request()->query()) }}"
                    class="btn buttons btn-primary btn-success">
                    <i class="ti ti-file-arrow-right me-1"></i> Export
                </a>
                <button class="btn buttons btn-primary" onclick="window.print()">
                    <i class="ti ti-printer me-1"></i> Print
                </button>
            </div>
        </div>
    </x-slot> --}}

    <x-slot name="cardTitle">
        <p class="head">Advance Reports</p>
        <div class="usersearch d-flex">
            <div>
                <button class="btn buttons btn-primary" id="printBtn"><i class="ti ti-printer me-1"></i> Print</button>
                <a href="{{ route('admin.advance.reports.export', request()->query()) }}"
                    class="btn buttons btn-primary btn-success">
                    <i class="ti ti-file-arrow-right me-1"></i> Export
                </a>
            </div>
        </div>
    </x-slot>

    <div class="row">
        <form method="GET" action="{{ route('admin.advance_reports.index') }}" class="p-0">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 gx-2 searchFilters smallInputs">
                <div class="col mb-3">
                    <label>Search</label>
                    <img class="imgc" src="assets/img/icons/search.svg" alt="img">
                    <input type="text" name="search" class="form-control form-cs" placeholder="Search"
                        value="{{ request('search') }}">
                </div>

                <div class="col mb-3">
                    <label>Order Date</label>
                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                        <input type="text" class="btn-filters form-control form-cs info" name="logs_datetimes"
                            placeholder="From Date - To Date" value="{{ request('logs_datetimes') }}" readonly style="background-color:white;cursor:pointer;"/>
                    </div>
                </div>

                <div class="col mb-3">
                    <label>By Warehouse</label>
                    <select name="warehouse" class="js-example-basic-single select2 form-cs">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ request('warehouse') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label>By Tracking ID</label>
                    <img class="imgc" src="assets/img/icons/search.svg" alt="img">
                    <input type="text" name="tracking_id" class="form-control form-cs" placeholder="Enter Tracking ID"
                        value="{{ request('tracking_id') }}">
                </div>

                <div class="col mb-3">
                    <label>By Customer</label>
                    <img class="imgc" src="assets/img/icons/search.svg" alt="img">
                    <input type="text" name="customer" class="form-control form-cs" placeholder="Enter Customer Name"
                        value="{{ request('customer') }}">
                </div>

                <div class="col mb-3">
                    <label>By Driver</label>
                    <select name="driver" class="js-example-basic-single select2 form-cs">
                        <option value="">Select Driver</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ request('driver') == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label>By Container</label>
                    <select name="container" class="js-example-basic-single select2 form-cs">
                        <option value="">Select Container</option>
                        @foreach ($containers as $container)
                            <option value="{{ $container->id }}" {{ request('container') == $container->id ? 'selected' : '' }}>
                                {{ $container->unique_id ?? '-' }}
                                {{ $container->ship_to_country ? ', ' . $container->ship_to_country : ''}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label>By Order Status</label>
                    <select name="status" class="js-example-basic-single select2 form-cs">
                        <option value="">Select Order Status</option>
                        @foreach (setting()->statusList() as $list)
                            <option value="{{ $list->id }}" {{ request('status') == $list->id ? 'selected' : '' }}>
                                {{ $list->status ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label>Payment Status</label>
                    <select name="payment_status" class="js-example-basic-single select2 form-cs">
                        <option value="">Select Payment Status</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-end align-items-end">
                <button type="submit" class="btn btn-primary btnf" style="margin-right: 10px;">Filter</button>
                <a href="{{ route('admin.advance_reports.index') }}"
                    class="btn btn-outline-danger btnr me-sm-2">Reset</a>
            </div>
        </form>
    </div>

    <div id="ajexTable">
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
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
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
    </div>

    @section('script')

        <script>
            document.getElementById('printBtn').addEventListener('click', function () {
                // 1. Get current URL search params
                const currentParams = new URLSearchParams(window.location.search);

                // 2. Construct API URL with same params
                // Replace /advance_reports with your API endpoint for data
                const apiUrl = '/api/admin/advance-orders/print-data?' + currentParams.toString();

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        let tableHtml = `
                    <html>
                    <head>
                        <title>Advance Orders Print</title>
                        <style>
                            body { font-family: Arial, sans-serif; font-size: 12px; }
                            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                            th, td { border: 1px solid #ccc; padding: 6px; text-align: left; vertical-align: top; }
                            th { background-color: #f2f2f2; }
                            .badge-success-light { background-color: #d4edda; color: #155724; padding: 2px 6px; border-radius: 4px; }
                            .badge-danger-light { background-color: #f8d7da; color: #721c24; padding: 2px 6px; border-radius: 4px; }
                            .thead-light th { background-color: #f8f9fa; }
                        </style>
                    </head>
                    <body>
                        <h3>Advance Orders Report</h3>
                        <table>
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
                                </tr>
                            </thead>
                            <tbody>`;

                        data.forEach((report, index) => {
                            const status = report.order_status ?? '-';
                            const isPaid = report.is_paid ? 'Paid' : 'Unpaid';
                            const badgeClass = report.is_paid ? 'badge-success-light' : 'badge-danger-light';

                            tableHtml += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${report.tracking_number ?? '-'}</td>
                            <td>${report.full_name ?? '-'}<br>${report.mobile_number ?? '-'}</td>
                            <td>${report.ship_full_name ?? '-'}<br>${report.ship_mobile_number ?? '-'}</td>
                            <td>${report.warehouse?.warehouse_name ?? '-'}</td>
                            <td>${report.hub_name ?? '-'}</td>
                            <td>${report.driver_name ?? '-'}</td>
                            <td>${report.created_at ?? '-'}</td>
                            <td>${status}</td>
                            <td>${report.invoice_total_amount ?? '-'}</td>
                            <td>${report.payment_mode ?? '-'}</td>
                            <td><span class="${badgeClass}">${isPaid}</span></td>
                        </tr>`;
                        });

                        tableHtml += `
                            </tbody>
                        </table>
                    </body>
                    </html>`;

                        const printWindow = window.open('', '', 'width=1000,height=800');
                        printWindow.document.write(tableHtml);
                        printWindow.document.close();
                        printWindow.focus();
                        printWindow.print();
                        printWindow.close();
                    })
                    .catch(error => {
                        alert('Error fetching data');
                        console.error(error);
                    });
            });

        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize date range picker
                $('input[name="orderDate"]').daterangepicker({
                    locale: {
                        format: 'DD/MM/YYYY',
                        applyLabel: 'Apply',
                        cancelLabel: 'Clear',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    },
                    autoUpdateInput: false,
                    showDropdowns: true,
                    opens: 'right'
                });

                // Update the input when dates are selected
                $('input[name="orderDate"]').on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                });

                // Clear the input when cleared
                $('input[name="orderDate"]').on('cancel.daterangepicker', function (ev, picker) {
                    $(this).val('');
                });

                // Set initial value if coming back with filters
                @if(request('orderDate'))
                    var dates = '{{ request('orderDate') }}'.split(' - ');
                    if (dates.length === 2) {
                        $('input[name="orderDate"]').data('daterangepicker').setStartDate(dates[0].trim());
                        $('input[name="orderDate"]').data('daterangepicker').setEndDate(dates[1].trim());
                    }
                @endif
                            });
        </script>
    @endsection
</x-app-layout>