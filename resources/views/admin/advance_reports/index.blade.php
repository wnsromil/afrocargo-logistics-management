<x-app-layout>
    <x-slot name="header">
        {{ __('Advanced Order Reports') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Advance Reports</p>
        <div class="usersearch d-flex">
            <div>
                <button class="btn buttons btn-primary" id="AdvanceprintBtn"><i class="ti ti-printer me-1"></i>
                    Print</button>
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
                            placeholder="From Date - To Date" value="{{ request('logs_datetimes') }}" readonly
                            style="background-color:white;cursor:pointer;" />
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
                        <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Unpaid" {{ request('payment_status') == 'Unpaid' ? 'selected' : '' }}>Unpaid
                        </option>
                         <option value="Partial" {{ request('payment_status') == 'Partial' ? 'selected' : '' }}>Partial</option>
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
        @include('admin.advance_reports.table')
    </div>

    @section('script')
        <script>
            document.getElementById('AdvanceprintBtn').addEventListener('click', function () {
                const currentParams = new URLSearchParams(window.location.search);
                const apiUrl = '/api/admin/advance-orders/print-data?' + currentParams.toString();

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        let tableHtml = `
                        <html>
                        <head>
                            <style>
                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }
                                th, td {
                                    border: 1px solid #ccc;
                                    padding: 8px;
                                    text-align: left;
                                }
                                th {
                                    background-color: #f5f5f5;
                                }
                            </style>
                        </head>
                        <body>
                        <table>
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Tracking ID</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Shipping Type</th>
                                <th>Pickup Date</th>
                                <th>Delivery Date</th>
                                <th>Container ID</th>
                                <th>From Warehouse</th>
                                <th>To Warehouse</th>
                                <th>Items</th>
                                <th>Estimate cost</th>
                                <th>Driver Name</th>
                                <th>Vehicle Type</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Status</th>
                                <th>Pickup Type</th>
                                <th>Delivery Type</th>
                                <th>Parcel Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                        `;

                        data.forEach((report, index) => {
                            tableHtml += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${report.tracking_number ?? '-'}</td>
                                    <td>${report.pickupaddress?.full_name ?? '-'}<br>
                                        ${report.pickupaddress?.mobile_number ?? '-'}<br>
                                        ${report.pickupaddress?.address ?? '-'}<br></td>
                                       <td>${report.deliveryaddress?.full_name ?? '-'}<br>
                                        ${report.deliveryaddress?.mobile_number ?? '-'}<br>
                                        ${report.deliveryaddress?.address ?? '-'}<br></td>
                                    <td>${report.parcel_type === 'Supply' ? report.parcel_type : (report.transport_type ?? '-')}</td>
                                    <td>${report.pickup_date ?? '-'}</td>
                                    <td>${report.delivery_date ?? '-'}</td>
                                    <td>${report.container?.unique_id ?? '--'}</td>
                                    <td>${report.warehouse?.warehouse_name ?? '--'}</td>
                                    <td>${report.arrivedWarehouse?.warehouse_name ?? '--'}</td>
                                    <td>${report.descriptions ?? '-'}</td>
                                    <td>$${parseFloat(report.customer_estimate_cost ?? 0).toFixed(2)}</td>
                                    <td>${report.driver?.name ?? '-'}</td>
                                    <td>${report.driver_vehicle?.vehicle_type ?? '-'}</td>
                                    <td>${report.payment_status ?? '-'}</td>
                                    <td>
                                        Partial: $${parseFloat(report.partial_payment ?? 0).toFixed(2)}<br>
                                        Due: $${parseFloat(report.remaining_payment ?? 0).toFixed(2)}<br>
                                        Total: $${parseFloat(report.total_amount ?? 0).toFixed(2)}
                                    </td>
                                    <td>${report.payment_type === 'COD' ? 'Cash' : (report.payment_type ?? '-')}</td>
                                    <td>${report.parcelStatus?.status ?? '-'}</td>
                                    <td>${report.pickup_type === 'self' ? 'In Person' : report.pickup_type}</td>
                                    <td>${report.delivery_type === 'self' ? 'In Person' : report.delivery_type}</td>
                                    <td>${report.weight ?? '-'}</td>
                                </tr>
                            `;
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