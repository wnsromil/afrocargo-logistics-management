<x-app-layout>
    @section("style")
        <style>
            .summary-text {
                color: #000;
                /* black */
            }

            .summary-amount {
                font-weight: bold;
            }
        </style>
    @endsection
    <x-slot name="header">
        {{ __('All End Of Day Report') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">All End Of Day Report</p>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.end_of_day.Payments_index') }}" method="GET">
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search" value="{{ request('search') }}">
                </div>
            </div>
            @php
                $isSingleWarehouse = count($warehouses) === 1;
                $warehouseIdFromUrl = request()->query('warehouse_id');
            @endphp

            <div class="col-md-3 mb-3">
                <label>By Warehouse</label>
                @if ($authUser->role_id == 1)
                    <select class="js-example-basic-single select2 form-control" name="warehouse_id">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $warehouseIdFromUrl == $warehouse->id || old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                @else
                    @php
                        $singleWarehouse = $warehouses->first();
                    @endphp

                    <input type="text" class="form-control" value="{{ $singleWarehouse->warehouse_name }}" readonly
                        style="background-color: #e9ecef; color: #6c757d;">
                    <input type="hidden" name="warehouse_id" value="{{ $singleWarehouse->id }}">
                @endif
                @error('warehouse_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info bordered">
                      <input type="text" name="eod_datetimes" placeholder="Select Date Range"
                        value="{{ request('eod_datetimes', request()->query('eod_datetimes')) }}"
                        class="btn-filters form-control form-cs info" readonly
                        style="background-color:white;cursor:pointer;" />
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label>By Driver</label>
                <select class="js-example-basic-single select2 form-control" name="driver_id">
                    <option value="">Select Driver</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ request()->get('driver_id') == $driver->id || old('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->name ?? '' }} {{ $driver->last_name ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>By Customer</label>
                <select class="js-example-basic-single select2 form-control" name="customer_id">
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request()->get('customer_id') == $customer->id || old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name ?? '' }} {{ $customer->last_name ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
    </form>

    <div class="d-flex flex-wrap gap-2 mb-2">
        <a href="{{ route('admin.end_of_day.Invoice_index') }}" class="btn btn-primary btnf">Invoice</a>
        <a href="{{ route('admin.end_of_day.Supply_index') }}" class="btn btn-primary btnf">Supply</a>
        <a href="{{ route('admin.end_of_day.Payments_index') }}" class="btn btn-primary btnf">Payments</a>
        <a href="{{ route('admin.end_of_day.Expenses_index') }}" class="btn btn-primary btnf">Expenses</a>
        {{-- <a href="{{ route('admin.end_of_day.Void_index') }}" class="btn btn-primary btnf">Void</a> --}}
        <a href="{{ route('admin.end_of_day.Deposit_index') }}" class="btn btn-primary btnf">Deposit</a>
        <a href="#" class="btn btn-primary btnf" onclick="openPrintInNewTab()">Print</a>
    </div>

    <hr>

    <div class="fw-600 mb-2 fs-6 summary-text">
        Total Invoiced: <span class="summary-amount">${{ number_format($totalInvoiced, 2) }}</span> &nbsp; | &nbsp;
        Total Payments: <span class="summary-amount">${{ number_format($totalPayment, 2) }}</span> &nbsp; | &nbsp;
        Discounts: <span class="summary-amount">{{ number_format($totalDiscount, 2) }}</span> &nbsp; | &nbsp;
        Total Service: <span class="summary-amount">${{ number_format($totalService, 2) }}</span> &nbsp; | &nbsp;
        Total Supplies: <span class="summary-amount">${{ number_format($totalSupplies, 2) }}</span>
    </div>

    <div class="fw-600 mb-3 fs-6 summary-text">
        Cash: <span class="summary-amount">${{ number_format($totalCash, 2) }}</span> &nbsp; | &nbsp;
        Credit: <span class="summary-amount">${{ number_format($totalCreditCard, 2) }}</span> &nbsp; | &nbsp;
        Cheque: <span class="summary-amount">${{ number_format($totalCheque, 2) }}</span> &nbsp; | &nbsp;
        BoxCredit: <span class="summary-amount">${{ number_format(0, 2) }}</span> &nbsp; | &nbsp;
        QuickPay: <span class="summary-amount">${{ number_format(0, 2) }}</span> &nbsp; | &nbsp;
        ManualCC: <span class="summary-amount">${{ number_format(0, 2) }}</span> &nbsp; | &nbsp;
        Deposit: <span class="summary-amount">${{ number_format(0, 2) }}</span>
    </div>
    <hr>

    <div class="fw-600 fs-6 d-flex flex-wrap gap-3 summary-text">
        <div>Total Cash In Dollar: <span class="summary-amount">${{ number_format($totalCash, 2) }}</span></div>
        <div>Total Expenses In Dollar: <span class="summary-amount">${{ number_format(0, 2) }}</span></div>
        <div>Total Local Currency Cash: <span class="summary-amount">${{ number_format(0, 2) }}</span></div>
        <div>Total Local Currency Expenses: <span class="summary-amount">${{ number_format(0, 2) }}</span></div>
    </div>
    <hr>


    <div id='ajexTable'>
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
                                    <td style="text-align: left;">{{ $payment->invoice->customer->name ?? '' }}
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
    </div>

    @section("script")
        <script>
            // Function to reset the form fields
            function resetForm() {
                window.location.href = "{{ route('admin.end_of_day.Payments_index') }}";
            }
        </script>
          <script>
            function openPrintInNewTab() {
                // Get current URL search params (after ?)
                const params = window.location.search; // eg: ?date=2023-08-01&warehouse=5

                // Base route URL (without params)
                const baseUrl = "{{ route('admin.end_of_day.Print_index') }}";

                // Construct full URL with params
                const fullUrl = baseUrl + params;

                // Open in new tab
                window.open(fullUrl, '_blank');
            }

        </script>
    @endsection

</x-app-layout>