<x-app-layout>
    @section('style')
        <style>
            .content-page-header {
                margin-top: -10px;
            }
        </style>
    @endsection

    <x-slot name="header">
        {{ __('Invoices') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head" style="color:black">Invoices </p>
        <div class="d-flex align-items-center justify-content-end">
            <div class="usersearch d-flex">
                <div class="mt-0">
                    <a href="{{route('admin.invoices.create')}}" class="btn btn-primary buttons">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Invoice
                    </a>
                </div>
            </div>
        </div>
    </x-slot>
    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form class="invoice" method="GET" action="{{ route('admin.invoices.index') }}">
        <div class="row g-3">
            <div class="col-md-3 dposition">
                <label for="searchInput">Search</label>
                <i class="ti ti-search"></i>
                <input type="text" id="searchInput" name="search" class="form-control form-cs" placeholder="Search"
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-3 dposition">
                <label for="invoice_id">By Invoice #ID</label>
                <i class="ti ti-search"></i>
                <input type="text" id="invoice_id" name="invoice_id" class="form-control form-cs"
                    placeholder="Enter Invoice #ID" value="{{ request('invoice_id') }}">
            </div>
            {{-- <div class="col-md-3 dposition">
                <label for="datetrange">Invoice Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                    <input type="text" id="datetrange" class="btn-filters form-control bookingrange form-cs info"
                        name="datetrange" placeholder="From Date - To Date" value="{{ request('datetrange') ?? '' }}"
                        autocomplete="off" />
                </div>
            </div> --}}

            <div class="col-md-3 dposition">
                <label>Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info bordered">
                    <input type="text" name="datetrange" class="btn-filters form-cs inp Expensefillterdate"
                        value="{{ old('datetrange', request()->query('datetrange')) }}" />
                </div>
            </div>

            <div class="col-md-3 dposition">
                <label for="container_seal">By Container</label>
                <i class="ti ti-search"></i>
                <input type="text" id="container_seal" name="container_seal" class="form-control form-cs"
                    placeholder="Enter Container Seal No." value="{{ request('container_seal') }}">
            </div>

            <div class="col-md-3">
                <label for="warehouse_id">By Warehouse</label>
                <select id="warehouse_id" name="warehouse_id" class="js-example-basic-single select2 form-cs">
                    <option value="">Select Warehouse</option>
                    @foreach ($warehouses as $warehouse)
                    <option value="{{$warehouse->id}}" {{ request('warehouse_id') == $warehouse->id ? 'selected' : '' }}>{{$warehouse->warehouse_name ?? ''}}, {{$warehouse->address ?? ''}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="driver_id">By Driver</label>
                <select id="driver_id" name="driver_id" class="js-example-basic-single select2 form-cs">
                    <option value="">Select Driver</option>
                    @foreach ($drivers as $driver)
                        <option value="{{$driver->id}}" {{ request('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{$driver->name ?? ''}} {{$driver->last_name ?? ''}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 dposition">
                <label for="invoice_item">By Invoice Item</label>
                <i class="ti ti-search"></i>
                <input type="text" id="invoice_item" name="invoice_item" class="form-control form-cs"
                    placeholder="Enter Invoice Item" value="{{ request('invoice_item') }}">
            </div>

            <div class="col-md-3 dposition">
                <label for="transport_type">Invoice Type</label>
                <select id="transport_type" name="transport_type" class="js-example-basic-single select2 form-cs">
                    <option value="">Select Invoice Type</option>
                    <option value="Supply" {{ request('transport_type') == 'Supply' ? 'selected' : '' }}>Supply</option>
                    <option value="Air Cargo" {{ request('transport_type') == 'Air Cargo' ? 'selected' : '' }}>Air Cargo
                    </option>
                    <option value="Ocean Cargo" {{ request('transport_type') == 'Ocean Cargo' ? 'selected' : '' }}>Ocean
                        Cargo</option>
                </select>
            </div>

            <div class="col-md-3 {{--text-end align-content-end--}}">
                <button type="submit" class="btn px-4 btn-primary me-2">Filter</button>
                <a href="{{ route('admin.invoices.index') }}" class="btn px-4 btn-outline-danger">Reset</a>
            </div>
        </div>
    </form>

    <div id='ajexTable'>
        @include('admin.Invoices.table')
    </div>

    @section('script')
        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script src="{{asset('js/invoice.js')}}"></script>
        <script>
            var supplyItems = null;
            var currentRow = null;

            // Function to initialize popovers
            function initInvoicePopovers() {
                $('[data-bs-toggle="popover"]').popover({
                    container: 'body',
                    html: true,
                    trigger: 'hover focus'
                });
            }

            // Initialize popovers on page load
            $(document).ready(function () {
                // Initialize the date range picker
                setTimeout(() => {
                    // console.log("Initializing popovers after 2 seconds delay");
                    initInvoicePopovers();
                }, 3000);

                // If you use a custom AJAX call for pagination, call initInvoicePopovers() after updating the table
                // Example:
                $('#ajexTable').on('click', function () {
                    initInvoicePopovers();
                });
            });
        </script>
    @endsection
</x-app-layout>