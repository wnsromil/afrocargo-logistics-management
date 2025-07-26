<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">Supply Order Management</p>
    </x-slot>
    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.supply_orders.index') }}" method="GET">
        <div class="row gx-3 inputheight40">
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
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search" value="{{ request('search') }}">
                </div>
            </div>
            {{-- ✅ Select Dropdown for Multiple Warehouses --}}
            <div class="col-md-3 mb-3">
                <label>Driver</label>
                <select class="js-example-basic-single select2 form-control" name="driver_id" id="driver_id_sreach">
                    <option value="">Select Driver</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ request()->input('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>

                    @endforeach
                </select>
                @error('driver_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>Status</label>
                <select class="js-example-basic-single select2" name="status_search" id="status_search">
                    <option value="">Select Status</option>
                    @foreach ($viewSupplyParcelStatus as $ParcelStatus)
                        <option value="{{ $ParcelStatus->id }}" {{ request()->input('status_search') == $ParcelStatus->id ? 'selected' : '' }}>
                            {{ $ParcelStatus->status }}
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="col-12 mb-3">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Tracking ID</th>
                                <th>From</th>
                                <th>Warehouse Name</th>
                                <th>Order Date</th>
                                <th>Estimate cost</th>
                                <th>Driver Name</th>
                                <th>Vehicle Type</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Status</th>
                                <th>Status update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($parcels as $index => $parcel)
                                <tr>
                                    <td> {{ $serialStart + $index + 1 }}</td>
                                    <td>{{ $parcel->tracking_number ?? "-"}}</td>
                                    <td>
                                        <div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="td"><i
                                                            class="me-2 ti ti-user"></i>{{$parcel->deliveryaddress->full_name ?? "--"}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="td"><i
                                                            class="me-2 ti ti-phone"></i>{{$parcel->deliveryaddress->mobile_number ?? "--"}}
                                                        <br> {{$parcel->deliveryaddress->alternative_mobile_number ?? "--"}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                        <p>{{$parcel->deliveryaddress->address ?? "--"}}<br>
                                                            {{$parcel->deliveryaddress->pincode ?? "--"}} <br>
                                                            {{$parcel->deliveryaddress->city->name ?? "--"}}
                                                            {{$parcel->deliveryaddress->state->name ?? "--"}}
                                                            {{$parcel->deliveryaddress->country->name ?? "--"}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $parcel->arrivedWarehouse->warehouse_name ?? "-"}}
                                    </td>
                                    <td>
                                        <div>{{ $parcel->created_at ? $parcel->created_at->format('m-d-Y') : '-' }}</div>
                                    </td>
                                    <td>
                                        <div>${{ number_format($parcel->total_amount ?? 0, 2)   }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $parcel->arrivedDriver->name ?? "-"}}</div>
                                    </td>
                                    <td>
                                        <div>{{ $parcel->arrivedDriverVehicle->vehicle_type ?? "-"}}</div>
                                    </td>
                                    @php
                                        $forValue = match ($parcel->payment_status) {
                                            'Unpaid' => 'unpaid_status',
                                            'Paid' => 'status',
                                            'Completed' => 'partial_status',
                                            default => 'unknown_status',
                                        }
                                    @endphp
                                    <td>
                                        <label class="labelstatusy" for="{{ $forValue }}">
                                            {{ $parcel->payment_status ?? '-' }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="row">${{ number_format($parcel->total_amount ?? 0, 2) }}</div>
                                        </div>
                                    </td>
                                    @php
                                        $classValue = match ((string) $parcel->status) {
                                            "1" => 'badge-pending',
                                            "2" => 'badge-pickup',
                                            "3" => 'badge-picked-up',
                                            "4" => 'badge-arrived-warehouse',
                                            "5" => 'badge-in-transit',
                                            "8" => 'badge-arrived-final',
                                            "9" => 'badge-ready-pickup',
                                            "10" => 'badge-out-delivery',
                                            "11" => 'badge-delivered',
                                            "12" => 'badge-re-delivery',
                                            "13" => 'badge-on-hold',
                                            "14" => 'badge-cancelled',
                                            "15" => 'badge-abandoned',
                                            "21" => 'badge-picked-up',
                                            "22" => 'badge-in-transit',
                                            default => 'badge-pending',
                                        };
                                    @endphp
                                    <td>
                                        <div>
                                            {{ $parcel->payment_type === 'COD' ? 'Cash' : ($parcel->payment_type ?? '-') }}
                                        </div>
                                    </td>
                                    <td>
                                        <label class="{{ $classValue }}" for="status">
                                            {{ $parcel->parcelStatus->status ?? '-' }}
                                        </label>
                                    </td>
                                    <td>
                                        <li class="nav-item dropdown">
                                            <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                                data-bs-toggle="dropdown">

                                                <span class="user-content"
                                                    style="background-color:#203A5F;border-radius:5px;width: 30px;
                                                                                                                                                                       height: 26px;align-content: center;">
                                                    <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                                                </span>
                                            </a>
                                            <div class="dropdown-menu menu-drop-user">
                                                <div class="profilemenu">
                                                    <div class="subscription-menu">
                                                        <ul>
                                                            @php
                                                                $statusSteps = [
                                                                    1 => 'Pending',
                                                                    35 => 'Order Received',
                                                                    36 => 'In Process',
                                                                    37 => 'Ready to Pick Up',
                                                                    38 => 'Picked Up'
                                                                ];
                                                            @endphp
                                                            @if ($parcel->delivery_type == 'self')
                                                                @foreach ($statusSteps as $key => $label)
                                                                    @if ($key > $parcel->status || $key == 38)
                                                                        <!-- Trigger Button -->
                                                                    <li>
                                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $key }}">
                                                                            {{ $label ?? '' }}
                                                                        </a>
                                                                    </li>
                                                                    @endif
                                                                @endforeach
                                                            @else

                                                            <li>
                                                                <a class="dropdown-item {{ $parcel->status == 1 ? '' : 'disabled-link-supply' }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delivery_with_driver"
                                                                    data-id="{{ $parcel->id }}" href="javascript:void(0);">
                                                                    Assign delivery with driver
                                                                </a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        </li>
                                    </td>
                                    <td class="btntext">
                                        <button onClick="redirectTo('{{route('admin.supply_orders.show', $parcel->id)}}')"
                                            class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-center text-gray-500">No order found.
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
                        {!! $parcels->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="parcel_id_input_hidden" name="parcel_id_hidden" class="form-control" readonly>
    <!-- delivery_with_driver -->
    <div class="modal custom-modal signature-add-modal fade" id="delivery_with_driver" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class=" modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Assign delivery with driver</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="deliveryForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class=" col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                        readonly>
                                    <input type="hidden" id="warehouse_id_input" name="warehouse_id"
                                        class="form-control" readonly>
                                    <input type="hidden" id="created_user_id_input" name="created_user_id"
                                        class="form-control" readonly value="{{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class=" col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Warehouse<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" name="warehouse_id"
                                        onchange="fetchDeliveryDriversBywarehouse(this.value)">
                                        <option selected="selected" value="">Select Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="deliverywarehouseError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Delivery Man<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" id="deliverywarehousedriverDropdown"
                                        name="driver_id">
                                        <option selected="selected" value="">Select delivery Man</option>
                                    </select>
                                    <div id="deliverydriverError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Note</label>
                                    <input type="text" name="notes" class="form-control inp Note"
                                        placeholder="Enter note">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- status change --}}
    <div class="modal custom-modal signature-add-modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="updateStatusModalLabel">Update Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.statusUpdate_self') }}" method="POST">
                @csrf
                <input type="hidden" name="parcel_id" id="modalParcelId">
                <input type="hidden" name="status" id="modalStatus">

                <div class="modal-body">
                <p>Are you sure you want to update the status to <b id="modalStatusLabel"></b>?</p>
                </div>

                <div class="modal-footer py-2">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary custom-btn ml-2">Cancel</button>
                    <button type="submit" class="btn btn-primary ml-2">Yes, Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    @section('script')
        <script>
            function resetForm() {
                window.location.href = "{{ route('admin.supply_orders.index') }}";
            }
            function fetchDeliveryDriversBywarehouse(warehouseId) {
                if (!warehouseId) {
                    // If nothing selected, clear dropdown
                    $('#warehousedriverDropdown').html('<option value="">Select Pickup Man</option>');
                    return;
                }

                $.ajax({
                    url: "/api/user-by-warehouse/" + warehouseId,
                    data: { role_id: 4 },
                    method: "GET",
                    success: function (response) {
                        // Clear existing options
                        let options = '<option value="">Select Pickup Man</option>';

                        // Loop through response (assuming it's an array of users)
                        response.users.forEach(function (driver) {
                            options += `<option value="${driver.id}">${driver.name}</option>`;
                        });

                        $('#deliverywarehousedriverDropdown').html(options);
                    },
                    error: function () {
                        alert("No driver found for the warehouse.");
                    }
                });
            }


            document.addEventListener('DOMContentLoaded', function () {
                var updateStatusModal = document.getElementById('updateStatusModal');

                updateStatusModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;

                    var parcelId = button.getAttribute('data-parcel_id');
                    var status = button.getAttribute('data-status');
                    var statusLabel = button.getAttribute('data-status_label');

                    updateStatusModal.querySelector('#modalParcelId').value = parcelId;
                    updateStatusModal.querySelector('#modalStatus').value = status;
                    updateStatusModal.querySelector('#modalStatusLabel').textContent = statusLabel;
                });
            });
        </script>
    @endsection
</x-app-layout>
