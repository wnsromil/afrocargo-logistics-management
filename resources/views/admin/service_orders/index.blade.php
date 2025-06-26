<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Service Order Management</p>
    </x-slot>

    <form id="expenseFilterForm" action="{{ route('admin.service_orders.index') }}" method="GET">
        <div class="row gx-3 inputheight40">
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
                <label>Shipping Type</label>
                <select class="js-example-basic-single select2" name="shipping_type" id="shipping_type">
                    <option value="">Select Shipping Type</option>
                    <option value="Air Cargo" {{ request()->query('shipping_type') == "Air Cargo" ? 'selected' : '' }}>Air
                        Cargo
                    </option>
                    <option value="Ocean Cargo" {{ request()->query('shipping_type') == "Ocean Cargo" ? 'selected' : '' }}>Ocean Cargo
                    </option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>Status</label>
                <select class="js-example-basic-single select2" name="status_search" id="status_search">
                    <option value="">Select Status</option>
                    @foreach ($viewParcelStatus as $ParcelStatus)
                        <option value="{{ $ParcelStatus->id }}" {{ request()->input('status_search') == $ParcelStatus->id ? 'selected' : '' }}>
                            {{ $ParcelStatus->status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>Pickups</label>
                <select class="js-example-basic-single select2" name="days_pickup_type" id="days_pickup_type">
                    <option value="">Select Pickups</option>
                    <option value="Yesterdays_pickups" {{ request()->query('days_pickup_type') == "Yesterdays_pickups" ? 'selected' : '' }}>Yesterdays Pickups
                    </option>
                    <option value="Today_pickups" {{ request()->query('days_pickup_type') == "Today_pickups" ? 'selected' : '' }}>Today Pickups
                    </option>
                    <option value="Tomorrows_pickup" {{ request()->query('days_pickup_type') == "Tomorrows_pickup" ? 'selected' : '' }}>Tomorrows Pickup
                    </option>
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
                                {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                <th>S.No</th>
                                <th>Tracking ID</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Shipping Type</th>
                                <th>Pickup Date</th>
                                <th>Delivery Date</th>
                                <th>Capture Image</th>
                                <th>Items</th>
                                <th>Estimate cost</th>
                                <th>Driver Name</th>
                                <th>Vehicle Type</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                {{-- <th>Warehouse</th> --}}
                                <th>Status</th>
                                <th>Pickup Type</th>
                                <th>Delivery Type</th>
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
                                                            class="me-2 ti ti-user"></i>{{$parcel->pickupaddress->full_name ?? "--"}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="td"><i
                                                            class="me-2 ti ti-phone"></i>{{$parcel->pickupaddress->mobile_number ?? "--"}}
                                                        <br> {{$parcel->pickupaddress->alternative_mobile_number ?? "--"}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                        <p>{{$parcel->pickupaddress->address ?? "--"}}<br>
                                                            {{$parcel->pickupaddress->pincode ?? "--"}} <br>
                                                            {{$parcel->pickupaddress->city->name ?? "--"}}
                                                            {{$parcel->pickupaddress->state->name ?? "--"}}
                                                            {{$parcel->pickupaddress->country->name ?? "--"}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
                                        <div>{{ ucfirst($parcel->transport_type) ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $parcel->pickup_date ? \Carbon\Carbon::parse($parcel->pickup_date)->format('m-d-Y') : '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $parcel->delivery_date ? \Carbon\Carbon::parse($parcel->delivery_date)->format('m-d-Y') : '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div><img src="{{asset('assets/img/Rectangle 25.png')}}" alt="image"></div>
                                    </td>
                                    <td>
                                        <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{  $parcel->descriptions ?? '-' }}">
                                            {{  $parcel->descriptions ?? '-' }}
                                        </p>
                                    </td>
                                      <td>
                                        <div>
                                             <div class="row">
                                            <div class="col-6">
                                                <div class="row">Customer:</div>
                                                <div class="row">Driver:</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">${{ number_format($parcel->customer_estimate_cost ?? 0, 2) }}
                                                </div>
                                                <div class="row">${{ number_format($parcel->estimate_cost ?? 0, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>{{ $parcel->driver->name ?? "-"}}</div>
                                    </td>
                                    <td>
                                        <div>{{ $parcel->driver_vehicle->vehicle_type ?? "-"}}</div>
                                    </td>
                                    @php
                                        $forValue = match ($parcel->payment_status) {
                                            'Unpaid' => 'unpaid_status',
                                            'Paid' => 'status',
                                            'Completed' => 'partial_status',
                                            'Partial' => 'partial_status',
                                        };
                                    @endphp
                                    <td>
                                        <label class="labelstatusy" for="{{ $forValue }}">
                                            {{ $parcel->payment_status ?? '-' }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row">Partial:</div>
                                                <div class="row">Due:</div>
                                                <div class="row">Total:</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">${{ number_format($parcel->partial_payment ?? 0, 2) }}
                                                </div>
                                                <div class="row">${{ number_format($parcel->remaining_payment ?? 0, 2) }}
                                                </div>
                                                <div class="row">${{ number_format($parcel->total_amount ?? 0, 2) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $parcel->payment_type === 'COD' ? 'Cash' : ($parcel->payment_type ?? '-') }}
                                        </div>
                                    </td>
                                    @php
                                        $status_class = $parcel->status ?? null;
                                        $parcelStatus = $parcel->parcelStatus->status ?? null;
                                        $classValue = match ((string) $status_class) {
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
                                            "23" => 'badge-pickup_re-schedule',
                                            default => 'badge-pending',
                                        };

                                    @endphp
                                    <td>
                                        <label class="{{ $classValue }}" for="status">
                                            {{ $parcelStatus ?? '-' }}
                                        </label>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $parcel->pickup_type === 'self' ? 'In Person' : ($parcel->pickup_type === 'driver' ? 'Driver' : '-') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $parcel->delivery_type === 'self' ? 'In Person' : ($parcel->delivery_type === 'driver' ? 'Driver' : '-') }}
                                        </div>
                                    </td>
                                    <td>
                                        <li class="nav-item dropdown">
                                            <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                                data-bs-toggle="dropdown">

                                                <span class="user-content droparrow droparrow">
                                                    <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                                                </span>
                                            </a>
                                            <div class="dropdown-menu menu-drop-user">
                                                <div class="profilemenu">
                                                    <div class="subscription-menu">
                                                        <ul>
                                                            @php
                                                                // Assuming $parcel->parcelStatus->id contains the ID of the current status
                                                                $currentStatusId = $parcel->parcelStatus->id ?? null;
                                                            @endphp
                                                            <li>
                                                                <a class="dropdown-item {{ $currentStatusId == 1 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                    href="javascript:void(0);">Pending</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item {{ $currentStatusId == 2 ? 'active disabled-link-for-active-service' : ($currentStatusId == 1 || $currentStatusId == 23 ? '' : 'disabled-link') }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#Pick_up_with_driver"
                                                                    data-id="{{ $parcel->id }}" href="javascript:void(0);">
                                                                    Pick up with driver
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item {{ $currentStatusId == 3 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                    href="javascript:void(0);">Picked up</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item  {{ $currentStatusId == 4 ? 'active disabled-link-for-active-service' : ($currentStatusId == 3 ? '' : 'disabled-link') }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#arrived_warehouse"
                                                                    data-id="{{ $parcel->id }}" href="javascript:void(0);">
                                                                    Arrived at warehouse
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a class="dropdown-item {{ $currentStatusId == 5 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                    href="javascript:void(0);">In transit</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item {{ $currentStatusId == 8 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                    href="javascript:void(0);">Arrived at final destination
                                                                    warehouse</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item {{ $currentStatusId == 9 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                    href="javascript:void(0);">Ready for pick up</a>
                                                            </li>
                                                            <li>
                                                                <a onclick="{{ $currentStatusId == 9 ? 'fetchDeliveryDriversByParcelId(' . $parcel->id . ')' : '' }}"
                                                                    class="dropdown-item {{ $currentStatusId == 21 ? 'active disabled-link-for-active-service' : ($currentStatusId == 9 ? '' : 'disabled-link') }}"
                                                                    data-bs-toggle="modal" data-id="{{ $parcel->id }}"
                                                                    data-bs-target="#ready_for_signature_pick_up"
                                                                    href="javascript:void(0);">
                                                                    Ready for self pick up
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a onclick="{{ $currentStatusId == 9 ? 'fetchDeliveryDriversByParcelId(' . $parcel->id . ')' : '' }}"
                                                                    class="dropdown-item {{ $currentStatusId == 22 ? 'active disabled-link-for-active-service' : ($currentStatusId == 9 ? '' : 'disabled-link') }}"
                                                                    data-bs-toggle="modal" data-id="{{ $parcel->id }}"
                                                                    data-bs-target="#delivery_with_driver"
                                                                    href="javascript:void(0);">
                                                                    Assign delivery with driver
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item {{ $currentStatusId == 10 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                    href="javascript:void(0);">Out for delivery</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item  {{ $currentStatusId == 11 ? 'active disabled-link-for-active-service' : ($currentStatusId == 21 ? '' : 'disabled-link') }}"
                                                                    href="javascript:void(0);">Delivered</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item {{ $currentStatusId == 13 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                    href="javascript:void(0);">Custom hold</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item open-reschedule-pickup-modal {{ $currentStatusId == 11 || $currentStatusId == 14 ? 'disabled-link' : '' }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#Re_schedule_pickup"
                                                                    data-id="{{ $parcel->id }}"
                                                                    data-date="{{ $parcel->pickup_date ? \Carbon\Carbon::parse($parcel->pickup_date)->format('m/d/Y') : '' }}"
                                                                    href="javascript:void(0);">
                                                                    Re-schedule pickup
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item open-reschedule-delivery-modal {{ $currentStatusId == 11 || $currentStatusId == 14 ? 'disabled-link' : '' }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#Re_schedule_delivery"
                                                                    data-id="{{ $parcel->id }}"
                                                                    data-date="{{ $parcel->delivery_date ? \Carbon\Carbon::parse($parcel->delivery_date)->format('m/d/Y') : '' }}"
                                                                    href="javascript:void(0);">
                                                                    Re-schedule delivery
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item {{ $currentStatusId == 11 || $currentStatusId == 14 ? 'disabled-link' : '' }}"
                                                                    data-bs-toggle="modal" data-bs-target="#Cancelled"
                                                                    data-id="{{ $parcel->id }}" href="javascript:void(0);">
                                                                    Cancelled
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </td>
                                    <td class="btntext">
                                        <a href="{{ route('admin.service_orders.show', $parcel->id) }}"> <button
                                                class=orderbutton><img
                                                    src="{{asset(path: 'assets/img/ordereye.png')}}"></button></a>
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
    <input type="hidden" id="warehouse_id_input_hidden" name="warehouse_id_hidden" class="form-control" readonly>
    <input type="hidden" id="created_user_id_input_hidden" name="created_user_id_hidden" class="form-control" readonly
        value="{{ auth()->user()->id }}">

    <!-- Re-schedule delivery -->
    <div class="modal custom-modal signature-add-modal fade" id="Re_schedule_delivery" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Re-Schedule Delivery</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="Re_schedule_deliveryForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="Re_schedule_type" name="Re_schedule_type"
                                        class="form-control" readonly value="delivery">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Delivery date</label>
                                    <input type="text" name="percel_date" readonly style="cursor: pointer;"
                                        class="form-control inp" id="percel_delivery_date_input"
                                        placeholder="MM/DD/YYYY" />
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

    <!-- Re-schedule pickup -->
    <div class="modal custom-modal signature-add-modal fade" id="Re_schedule_pickup" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Re-Schedule Pickup</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="Re_schedule_pickupForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="Re_schedule_type" name="Re_schedule_type"
                                        class="form-control" readonly value="pickup">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Pickup date</label>
                                    <input type="text" name="percel_date" readonly style="cursor: pointer;"
                                        class="form-control inp" id="percel_pickup_date_input"
                                        placeholder="MM/DD/YYYY" />
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

    <!-- Cancelled -->
    <div class="modal custom-modal signature-add-modal fade" id="Cancelled" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Cancelled</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="cancelledForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                        readonly>
                                    <input type="hidden" id="warehouse_id_input" name="warehouse_id"
                                        class="form-control" readonly>
                                    <input type="hidden" id="created_user_id_input" name="created_user_id"
                                        class="form-control" readonly value="
                                    {{ auth()->user()->id }}">
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

    <!-- Pick_up_with_driver -->
    <div class="modal custom-modal signature-add-modal fade" id="Pick_up_with_driver" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Pickup With Driver</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="pickupForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                        readonly>
                                    <input type="hidden" id="warehouse_id_input" name="warehouse_id"
                                        class="form-control" readonly>
                                    <input type="hidden" id="created_user_id_input" name="created_user_id"
                                        class="form-control" readonly value="{{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Warehouse<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" name="warehouse_id"
                                        onchange="fetchDriversBywarehouse(this.value)">
                                        <option selected="selected" value="">Select Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="warehouseError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Pickup Man<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" id="warehousedriverDropdown"
                                        name="driver_id">
                                        <option selected="selected" value="">Select Pickup Man</option>
                                    </select>
                                    <div id="driverError" class="text-danger small mt-1"></div>
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

    <!-- ready_for_signature_pick_up -->
    <div class="modal custom-modal signature-add-modal fade" id="ready_for_signature_pick_up" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class=" modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Ready for self pick up</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="signaturedeliveryForm" method="POST">
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
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="table-content col737 fw-medium">Signature Image </label>
                                    <div class="input-block mb-3 service-upload img-size2 mb-0">
                                        <span id="upload_signature_pickup_img">
                                            <svg width="65" height="37" viewBox="0 0 65 37" fill="none"
                                                style="color:black;" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="65" height="37" fill="url(#pattern0_2250_39084)"
                                                    style="mix-blend-mode:luminosity" />
                                                <defs>
                                                    <pattern id="pattern0_2250_39084"
                                                        patternContentUnits="objectBoundingBox" width="1" height="1">
                                                        <use xlink:href="#image0_2250_39084"
                                                            transform="matrix(0.00877193 0 0 0.0154101 0 -0.000829777)" />
                                                    </pattern>
                                                    <image id="image0_2250_39084" width="114" height="65"
                                                        preserveAspectRatio="none"
                                                        xlink:href="data:image/png;base64,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" />
                                                </defs>
                                            </svg>
                                            <h6 class="drop-browse align-center">Upload Image</h6>
                                        </span>

                                        <input type="file" id="self_pickup_img" name="img" class="form-control"
                                            accept="image/*">
                                        <div id="preview" class="mt-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Amount</label>
                                    <input type="number" name="amount" class="form-control inp"
                                        placeholder="Enter amount">
                                    <div id="amountError" class="text-danger small mt-1"></div>
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


    <!-- cancel model -->
    <div class="modal custom-modal signature-add-modal fade" id="arrived_warehouse" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body confirmationpopup">
                    <div class="form-header">

                        <p class="popupc">Has the order successfully arrived at the warehouse?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button data-bs-dismiss="modal" type="button" onclick="updatestatusarrivedwarehouse()"
                                    class="w-100 btn btn-primary paid-continue-btn customerpopup">
                                    Yes
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" data-bs-dismiss="modal"
                                    class=" w-100 btn btn-outline-primary custom-btn">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- re-schedule  pickup-->
    <div class="modal custom-modal signature-add-modal fade" id="reschedule_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Pickup Re-Schedule</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">

                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">Pickup Man<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2">
                                            <option selected="selected">Select Delivery Man</option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="colordate"> Date <i class="text-danger">*</i></label>
                                        <div class="daterangepicker-wrap cal-icon cal-icon-info popdate">
                                            <input type="text" class="btn-filters form-control form-cs inp "
                                                name="datetimes" placeholder="From Date - To Date" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- reasonofaction  -->
    <div class="modal custom-modal signature-add-modal fade" id="reason_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Reason for Action</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">

                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">Select Reason<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2">
                                            <option selected="selected">Select Reason</option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- recieved warehouse -->
    <div class="modal custom-modal signature-add-modal fade" id="receivedwarehouse_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Recieved Warehouse</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">


                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">Warehouse Name<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2">
                                            <option selected="selected">Select Warehouse</option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- cancel container recieved -->
    <div class="modal custom-modal signature-add-modal fade" id="cancelcontainer_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body confirmationpopup">
                    <div class="form-header">

                        <p class="popupc">Do you want to cancel the Container Recieved by Hub?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">

                                <button type="submit" data-bs-dismiss="modal"
                                    class=" w-100 btn btn-outline-primary custom-btn">No</button>
                            </div>
                            <div class="col-6">
                                <button data-bs-dismiss="modal"
                                    class="w-100 btn btn-primary paid-continue-btn customerpopup"><a
                                        class="dropdown-items" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#reason_modal">Yes</a>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- delivery reschedule -->
    <div class="modal custom-modal signature-add-modal fade" id="reschedule_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Delivery Re-Schedule</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">



                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">Delivery Man<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2">
                                            <option selected="selected">Select Delivery Man</option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="colordate"> Date <i class="text-danger">*</i></label>
                                        <div class="daterangepicker-wrap cal-icon cal-icon-info popdate">
                                            <input type="text" class="btn-filters form-control form-cs inp "
                                                name="datetimes" placeholder="From Date - To Date" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- return courier -->
    <div class="modal custom-modal signature-add-modal fade" id="returncourier_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Return to Courier</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">

                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">

                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- delivered courier -->
    <div class="modal custom-modal signature-add-modal fade" id="deliveredcourier_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Delivered</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">

                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">

                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            // Function to initialize daterangepicker on any input by ID
            function initDatePicker(inputId) {
                const input = $('#' + inputId);

                input.daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoUpdateInput: false,
                    locale: {
                        format: 'MM/DD/YYYY'
                    },
                    minDate: moment().startOf("day") // prevent past date
                });

                input.on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY'));
                });
            }

            // Pickup modal open handler
            $(document).on('click', '.open-reschedule-pickup-modal', function () {
                const pickupDate = $(this).data('date'); // MM/DD/YYYY expected
                const input = $('#percel_pickup_date_input');

                if (pickupDate) {
                    input.val(pickupDate);
                    input.data('daterangepicker').setStartDate(moment(pickupDate, 'MM/DD/YYYY'));
                } else {
                    input.val('');
                    input.data('daterangepicker').setStartDate(moment()); // fallback to today only if date is null
                }
            });

            // Delivery modal open handler
            $(document).on('click', '.open-reschedule-delivery-modal', function () {
                const deliveryDate = $(this).data('date'); // MM/DD/YYYY expected
                const input = $('#percel_delivery_date_input');

                if (deliveryDate) {
                    input.val(deliveryDate);
                    input.data('daterangepicker').setStartDate(moment(deliveryDate, 'MM/DD/YYYY'));
                } else {
                    input.val('');
                    input.data('daterangepicker').setStartDate(moment()); // fallback to today only if date is null
                }
            });

            // Initialize both inputs on page load
            $(function () {
                initDatePicker('percel_pickup_date_input');
                initDatePicker('percel_delivery_date_input');
            });
        </script>
        <script>
            function resetForm() {
                window.location.href = "{{ route('admin.service_orders.index') }}";
            }

            $(document).ready(function () {
                $('#shipping_type').select2({
                    tags: false,
                    placeholder: 'Select shipping type',
                    allowClear: true,
                });

                $('#driver_id_sreach').select2({
                    tags: false,
                    placeholder: 'Select driver',
                    allowClear: true,
                });
            });
        </script>
        <script>
            function fetchDriversBywarehouse(warehouseId) {
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

                        $('#warehousedriverDropdown').html(options);
                    },
                    error: function () {
                        alert("No driver found for the warehouse.");
                    }
                });
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
            function updatestatusarrivedwarehouse() {
                let parcelId = $("#parcel_id_input_hidden").val();
                let created_user_id = $("#created_user_id_input_hidden").val();

                if (!parcelId) {
                    alert("Parcel ID is required.");
                    return;
                }
                // Show Loading Indicator
                $(".btn-primary").html("Processing...").prop("disabled", true);

                // Make AJAX POST Request
                $.ajax({
                    url: "/api/update-status-arrived-warehouse", // API endpoint
                    type: "POST",
                    data: {
                        parcel_id: parcelId,
                        created_user_id: created_user_id,
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                    },
                    success: function (response) {
                        document
                            .querySelector("#arrived_warehouse .custom-btn")
                            .click();
                        Swal.fire({
                            title: "Good job!",
                            text: "Status changed successfully!",
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        // Handle Server-Side Validation Errors
                        let errors = xhr.responseJSON?.errors || {};
                    },
                    complete: function () {
                        // Re-enable Save Button
                        $(".btn-primary").html("Save").prop("disabled", false);
                    },
                });
            }
        </script>
        <script>
            document.getElementById('self_pickup_img').addEventListener('change', function (event) {
                const preview = document.getElementById('preview');
                preview.innerHTML = ''; // Clear previous previews
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%';
                        img.style.height = 'auto';
                        img.classList.add('mt-2', 'img-thumbnail');
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                    $('#upload_signature_pickup_img').hide();
                }
            });

        </script>
    @endsection
</x-app-layout>