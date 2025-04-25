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
            <div class="col-md-4">
                <!-- Moment.js (required for daterangepicker) -->
                <div class="mb-3">
                    <label>Driver</label>
                    <select name="driver_id" class="form-control select2">
                        <option value="">Select Driver</option>
                        @foreach($users as $user)
                            <option {{ old('driver_id') == $user->id ? 'selected' : '' }}
                                value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">

                    <label>Date</label>
                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                        <input type="text" name="daterangepicker" class="btn-filters form-cs inp Expensefillterdate"
                        value="{{ old('daterangepicker', request()->query('daterangepicker')) }}" />
                    </div>
                </div>
            </div>
            <div class="col-md-4  top-50 start-100 twobutton2">
                <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
            </div>
        </div>
    </form>
        <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive DriverInventoryTable notMinheight mt-3">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
                                <th>Date</th>
                                <th>Driver</th>
                                <th>Item Number</th>
                                <th>Item</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($items as $key => $item)
                                <tr>
                                    <td>{{ $serialStartItems + $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('m-d-Y') }}</td>
                                    <td>{{ $item->driver->name ?? '--' }}</td>
                                    <td>--</td>
                                    <td>{{ $item->items->name ?? '--' }}</td>
                                    <td>{{ $item->in_out ?? '--' }}</td>
                                    <td>{{ $item->quantity ?? '--' }}</td>
                                    <td>
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
       
        <div class="d-flex" style="border:1px solid #737B8B;height: 47px;justify-content: space-around;
    padding: 0 10px;">
            <div>
                <p class="inventory">Out Qty (1) - Sold Qty (3) = -2</p>
            </div>
            <div>
                <p class="inventory">Total Qty</p>
            </div>
            <div>
                <p class="inventory">Outs Qty (1) - Ins Qty (0) = 1</p>
            </div>
        </div>
        <h3 class="head">Detail Driver Supplies</h3>
       
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive DriverInventoryTable notMinheight mt-3">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Invoice No.</th>
                                <th>Item No.</th>
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
                                <td>{{ $serialStartSold + $key + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($driver_detail->date)->format('m-d-Y') }}</td>
                                <td>{{ $driver_detail->customer->name ?? '--' }}</td>
                                <td>{{ $driver_detail->invoice_no ?? '--' }}</td>
                                <td>--</td>
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
                <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example" id="pageSizeSelect">
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

       <script>
        // Function to reset the form fields
        function resetForm() {
            window.location.href = "{{ route('admin.driver_inventory.index') }}";
        }
    </script>

</x-app-layout>