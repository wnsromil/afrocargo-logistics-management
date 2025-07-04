<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">Driver Inventory List</p>

        <div class="d-flex align-items-center justify-content-end mb-0">
            <div class="usersearch d-flex">
                <div class="">
                    <a href="{{ route('admin.driver_inventory.create') }}" class="btn btn-primary buttons"
                        style="background:#203A5F">
                        <img src="assets/images/Vector.png" class="pe-3">
                        Add Driver Inventory
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <form>
        <div class="row">
            <!-- Warehouse Name -->
            <div class="col-md-3">
                <div class="input-block fwNormal mb-3">
                    <label for="warehouse_location" class="foncolor">Warehouse<i class="text-danger">*</i></label>
                    <select name="warehouse_name" id="warehouseSelect" class="js-example-basic-single select2">
                        <option value="">Select Warehouse </option>
                        @foreach($warehouses as $warehouse)
                        <option {{ old('warehouse_name') == $warehouse->id ? 'selected' : '' }} value="{{
                            $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                        @endforeach
                    </select>
                    @error('warehouse_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <!-- Moment.js (required for daterangepicker) -->
                <div class="mb-3">
                    <label>Driver</label>
                    <select name="driver_id" class="form-control select2" id="gateOutDriver">
                        <option value="">Select Driver</option>
                        {{--@foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request()->query('driver_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach--}}
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">

                    <label>Date</label>
                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                        <input type="text" name="daterangepicker" class="btn-filters form-cs inp Expensefillterdate"
                            value="{{ old('daterangepicker', request()->query('daterangepicker')) }}" />
                    </div>
                </div>
            </div>
            <div class="col-md-3  top-50 start-100 twobutton2">
                <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
            </div>
        </div>
    </form>
    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive DriverInventoryTable notMinheight mt-3">
                    <table class="table table-stripped table-hover datatable notposition"
                        style="border: 1px solid #000; width: 100%; text-align: center; font-size: 14px;">
                        <thead style="background-color: #f8f9fa; border: 1px solid #000;">
                            <tr>
                                <th style="border: 1px solid #000;">S. No.</th>
                                <th style="border: 1px solid #000;">Date</th>
                                <th style="border: 1px solid #000;">Driver</th>
                                <th style="border: 1px solid #000;">Item Number</th>
                                <th style="border: 1px solid #000;">Item</th>
                                <th style="border: 1px solid #000;">Type</th>
                                <th style="border: 1px solid #000;">Quantity</th>
                                <th style="border: 1px solid #000;">Action</th>
                            </tr>
                        </thead>

                              <tbody>
                                    @forelse ($items as $key => $item)
                                        <tr>
                                            <td style="border: 1px solid #000;">{{ $serialStartItems + $key + 1 }}</td>
                                            <td style="border: 1px solid #000;">
                                                {{ \Carbon\Carbon::parse($item->date)->format('m-d-Y') }}</td>
                                            <td style="border: 1px solid #000;">{{ $item->driver->name ?? '--' }}</td>
                                            <td style="border: 1px solid #000;">{{ $item->items->unique_id ?? '--' }}</td>
                                            <td style="border: 1px solid #000;">{{ $item->items->name ?? '--' }}</td>
                                            <td style="border: 1px solid #000;">{{ $item->in_out ?? '--' }}</td>
                                            <td style="border: 1px solid #000;">{{ $item->quantity ?? '--' }}</td>
                                            <td style="border: 1px solid #000;">
                                                <form action="{{ route('admin.driver_inventory.destroy', $item->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        style="background:none; border:none; padding:0; cursor:pointer;">
                                                        <img src="{{ asset('assets/img/Vector (13).png') }}" alt="Delete Icon">
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                         <tr style="background-color: #fff;">
                                           @php
                                                    $result = calculateDriverInventoryDetails($item->id);
                                                @endphp

                                                <td colspan="8" style="padding: 0px !important; border: none;">
                                                    <table style="width: 100%; border-collapse: collapse;">
                                                        <tr>
                                                            <td style="width: 33.33%; text-align: center; border: 1px solid #000;">
                                                                <p style="margin: 8px 0; color: red; font-weight: bold;">
                                                                    Out Qty ({{ $result['DriverInventory_quantity_out'] }}) - Sold Qty ({{ $result['DriverInventoriesSolde_quantity'] }}) = {{ $result['remaining_quantity'] }}
                                                                </p>
                                                            </td>
                                                            <td style="width: 33.33%; text-align: center; border: 1px solid #000;">
                                                                <p style="margin: 8px 0; color: red; font-weight: bold;">
                                                                    Total Qty
                                                                </p>
                                                            </td>
                                                            <td style="width: 33.33%; text-align: center; border: 1px solid #000;">
                                                                <p style="margin: 8px 0; color: red; font-weight: bold;">
                                                                    Outs Qty ({{ $result['DriverInventory_quantity_out'] }}) - Ins Qty ({{ $result['DriverInventory_quantity_in'] }}) = {{ $result['DriverInventory_quantity_total'] }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                         </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" style="border: 1px solid #000; padding: 10px; text-align: center;">No Data found.</td>
                                        </tr>
                                    @endforelse

                                    {{-- ✅ Summary Row --}}
                                   
                                </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Inline styled footer row like image -->
        <h3 class="head">Detail Driver Supplies</h3>

        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive DriverInventoryTable soldItems notMinheight mt-3">
                    <table class="table table-stripped table-hover datatable notposition">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th>S. No.</th> --}}
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Invoice No.</th>
                                <th>Item Number</th>
                                <th>Item</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($driver_details as $key => $driver_detail)
                                <tr>
                                    {{-- <td>{{ $serialStartSold + $key + 1 }}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($driver_detail->date)->format('m-d-Y') }}</td>
                                    <td>{{ $driver_detail->customer->name ?? '--' }}</td>
                                    <td>{{ $driver_detail->invoice_no ?? '--' }}</td>
                                    <td>{{ $item->items->unique_id ?? '--' }}</td>
                                    <td>{{ $driver_detail->items->items->name ?? '--' }}</td>
                                    <td>{{ $driver_detail->type ?? '--' }}</td>
                                    <td>{{ $driver_detail->quantity ?? '--' }}</td>
                                    <td>{{ $driver_detail->price ?? '--' }}</td>
                                    <td>{{ $driver_detail->total ?? '--' }}</td>
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
        <div class="d-flex pe-sm-3" style="border:1px solid #737B8B;height: 47px; justify-content: end;">
            <div class="px_3"></div>
            <div class="px_3"></div>
            <div class="px_3"></div>
            <div class="px_3"></div>
            <div class="px_3"></div>
            <div class="px_3"></div>
            <div class="px_3">
                <p class="inventory">Total</p>
            </div>
            <div class="px_3">
                <p class="inventory">3</p>
            </div>
            <div class="px_3 me-5 ms-4"></div>
            <div class="px_3">
                <p class="inventory">110</p>
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
                        {!! $driver_details->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
<script>
    // Function to reset the form fields
    function resetForm() {
        window.location.href = "{{ route('admin.driver_inventory.index') }}";
    }

    $(document).ready(function () {
        // Initialize Select2
        $('.select2').select2();
        
        $('#warehouseSelect').on('change', function () {
            var warehouseId = $(this).val();
            var driverSelect = $('#gateOutDriver');

            if (warehouseId) {
                $.ajax({
                    url: '/api/warehouse-drivers/' + warehouseId,
                    type: 'GET',
                    success: function (data) {
                        // Clear existing options
                        driverSelect.empty().append('<option value="">Select Driver</option>');

                        // Add new driver options
                        if (data.data && data.data.length > 0) {
                            $.each(data.data, function (key, driver) {
                                driverSelect.append('<option value="' + driver.id + '">' + driver.name + '</option>');
                            });
                        }

                        // Refresh Select2
                        driverSelect.trigger('change');
                    },
                    error: function (xhr) {
                        console.error('Error fetching drivers:', xhr.responseText);
                        driverSelect.empty().append('<option value="">Select Driver</option>');
                        driverSelect.trigger('change');
                    }
                });
            } else {
                // Reset if no warehouse selected
                driverSelect.empty().append('<option value="">Select Driver</option>');
                driverSelect.trigger('change');
            }
        });

        // Trigger change on page load if warehouse is already selected
        @if(request()->has('warehouse_name'))
            $('#warehouseSelect').trigger('change');
        @endif
    });
</script>
@endsection

</x-app-layout>