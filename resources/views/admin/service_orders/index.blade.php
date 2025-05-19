<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <!-- <x-slot name="cardTitle">
        All Parcels
        
        {{-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <p style="text-align: center;">
                        <span class="isSelected d-none">     
                            <button class="btn btn-primary" onclick="handlePickupAssign('selectArr', {{ json_encode($drivers) }},'{{ activeStatusKey('Pickup Assign')}}')">
                                <i class="fas fa-truck me-2"></i>Pickup Assign
                            </button>
                            <button class="btn btn-danger" onclick="handlePickupCancel([],,{{ activeStatusKey('Pickup Cancel') }})">
                                <i class="fas fa-times-circle me-2"></i>Pickup Cancel
                            </button>
                            
                            <button class="btn btn-warning" onclick="handlePickupReschedule([], {{ json_encode($drivers) }},{{ activeStatusKey('Pickup Cancel') }})">
                                <i class="fas fa-calendar-alt me-2"></i>Pickup Re-Schedule
                            </button>
                            <button class="btn btn-info" onclick="handleReceivedWarehouse([], {{json_encode($warehouses)}},{{ activeStatusKey('Pickup Cancel') }})">
                                <i class="fas fa-warehouse me-2"></i>Received Warehouse
                            </button>
                        </span>
                        <a href="{{route('admin.OrderShipment.create')}}" class="btn btn-primary">
                            Add Parcel
                        </a>
                    </p>
                </div>
            </div>

        </div> --}}

    </x-slot> -->

    <x-slot name="cardTitle">
        <p class="head">Service Order Management</p>

        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form>
                    <input type="text" id="searchInput" class="form-control forms" placeholder="Search ">

                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters"
                        href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a></button>
            </div>
        </div>
    </x-slot>
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
                                <th>Pickup Date</th>
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
                                                            <div>{{ $parcel->pickup_date ? $parcel->pickup_date->format('d-m-Y') : '-' }}</div>
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
                                                            <div>${{ $parcel->estimate_cost ?? "0"}}</div>
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
                                                                    <div class="row">${{ $parcel->partial_payment ?? "0"}}</div>
                                                                    <div class="row">${{ $parcel->remaining_payment ?? "0"}}</div>
                                                                    <div class="row">${{ $parcel->total_amount ?? "0"}}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>{{ $parcel->payment_type ?? "-"}}</div>
                                                        </td>
                                                        @php
                                                            $status_class = $parcel->status ?? null;
                                                            $parcelStatus = $parcel->parcelStatus->status ?? null;
                                                            $classValue = match ($status_class) {
                                                                1 => 'badge-pending',
                                                                2 => 'badge-pickup',
                                                                3 => 'badge-picked-up',
                                                                4 => 'badge-arrived-warehouse',
                                                                5 => 'badge-in-transit',
                                                                8 => 'badge-arrived-final',
                                                                9 => 'badge-ready-pickup',
                                                                10 => 'badge-out-delivery',
                                                                11 => 'badge-delivered',
                                                                12 => 'badge-re-delivery',
                                                                13 => 'badge-on-hold',
                                                                14 => 'badge-cancelled',
                                                                15 => 'badge-abandoned',
                                                                21 => 'badge-picked-up',
                                                                22 => 'badge-in-transit',
                                                                default => 'badge-pending', // Default class if no match found
                                                            };
                                                        @endphp
                                                        <td>
                                                            <label class="{{ $classValue }}" for="status">
                                                                {{ $parcelStatus ?? '-' }}
                                                            </label>
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
                                                                                    <a onclick="{{ $currentStatusId == 1 ? 'fetchDriversByParcelId(' . $parcel->id . ')' : '' }}"
                                                                                        class="dropdown-item {{ $currentStatusId == 2 ? 'active disabled-link-for-active-service' : ($currentStatusId == 1 ? '' : 'disabled-link') }}"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#Pick_up_with_driver"
                                                                                        href="javascript:void(0);">
                                                                                        Pick up with driver
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item {{ $currentStatusId == 3 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                                        href="javascript:void(0);">Picked up</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item 
                                                                                       {{ $currentStatusId == 4 ? 'active disabled-link-for-active-service' : ($currentStatusId == 3 ? '' : 'disabled-link') }}"
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
                                                                                    <a class="dropdown-item {{ $currentStatusId == 21 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                                        href="javascript:void(0);">Ready for self pick up</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a onclick="{{ $currentStatusId == 9 ? 'fetchDeliveryDriversByParcelId(' . $parcel->id . ')' : '' }}"
                                                                                        class="dropdown-item {{ $currentStatusId == 22 ? 'active disabled-link-for-active-service' : ($currentStatusId == 9 ? '' : 'disabled-link') }}"
                                                                                        data-bs-toggle="modal"
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
                                                                                    <a class="dropdown-item {{ $currentStatusId == 12 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                                        href="javascript:void(0);">Re-delivery</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item {{ $currentStatusId == 13 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                                        href="javascript:void(0);">On hold</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item {{ $currentStatusId == 14 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                                        href="javascript:void(0);">Cancelled</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item {{ $currentStatusId == 15 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                                        href="javascript:void(0);">Abandoned</a>
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
</x-app-layout>

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
                <!-- Parcel ID Input Field -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                    readonly>
                                <input type="hidden" id="warehouse_id_input" name="warehouse_id" class="form-control"
                                    readonly>
                                <input type="hidden" id="created_user_id_input" name="created_user_id"
                                    class="form-control" readonly value="
                                    {{ auth()->user()->id }}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <label class="foncolor">Pickup Man<i class="text-danger">*</i></label>
                                <select class="js-example-basic-single select2" id="driverDropdown" name="driver_id">
                                    <option selected="selected" value="">Select Pickup Man</option>
                                </select>
                                <div id="driverError" class="text-danger small mt-1"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block">
                                <label class="foncolor">Note</label>
                                <input type="text" name="notes" class="form-control inp Note" placeholder="Enter note">
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
        <div class="modal-content">
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
                <!-- Parcel ID Input Field -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                    readonly>
                                <input type="hidden" id="warehouse_id_input" name="warehouse_id" class="form-control"
                                    readonly>
                                <input type="hidden" id="created_user_id_input" name="created_user_id"
                                    class="form-control" readonly value="
                                    {{ auth()->user()->id }}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <label class="foncolor">Delivery Man<i class="text-danger">*</i></label>
                                <select class="js-example-basic-single select2" id="deliverydriverDropdown"
                                    name="driver_id">
                                    <option selected="selected" value="">Select delivery Man</option>
                                </select>
                                <div id="deliverydriverError" class="text-danger small mt-1"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block">
                                <label class="foncolor">Note</label>
                                <input type="text" name="notes" class="form-control inp Note" placeholder="Enter note">
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
                                class="w-100 btn btn-primary paid-continue-btn customerpopup"><a class="dropdown-items"
                                    href="javascript:void(0);" data-bs-toggle="modal"
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchDriversByParcelId(parcelId) {
        document.getElementById("parcel_id_input").value = parcelId;
        // Show loading indicator (optional)
        $("#driverDropdown").html('<option value="">Loading...</option>');

        // Make AJAX POST request
        $.ajax({
            url: "/api/get-drivers-by-assign-status", // API endpoint
            type: "POST",
            data: {
                parcel_id: parcelId, // Send parcel_id as parameter
            },
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
            },
            success: function (response) {
                // Clear existing options
                let dropdown = $("#driverDropdown");
                dropdown.empty();

                // Add default option
                dropdown.append('<option value="">Select Pickup Man</option>');

                // Populate dropdown with drivers from API response
                if (response.drivers && response.drivers.length > 0) {
                    document.getElementById("warehouse_id_input").value =
                        response.drivers[0].warehouse_id;
                    response.drivers.forEach(function (driver) {
                        dropdown.append(
                            `<option value="${driver.id}">${driver.name}</option>`
                        );
                    });
                } else {
                    dropdown.append(
                        '<option value="">No drivers available</option>'
                    );
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("Error fetching drivers:", error);
                $("#driverDropdown").html(
                    '<option value="">Error loading drivers</option>'
                );
            },
        });
    }
    function fetchDeliveryDriversByParcelId(parcelId) {
        document.getElementById("parcel_id_input").value = parcelId;
        // Show loading indicator (optional)
        $("#deliverydriverDropdown").html('<option value="">Loading...</option>');

        // Make AJAX POST request
        $.ajax({
            url: "/api/get-delivery-drivers-by-assign-status", // API endpoint
            type: "POST",
            data: {
                parcel_id: parcelId, // Send parcel_id as parameter
            },
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
            },
            success: function (response) {
                // Clear existing options
                let dropdown = $("#deliverydriverDropdown");
                dropdown.empty();

                // Add default option
                dropdown.append('<option value="">Select Delivery Man</option>');

                // Populate dropdown with drivers from API response
                if (response.drivers && response.drivers.length > 0) {
                    document.getElementById("warehouse_id_input").value =
                        response.drivers[0].warehouse_id;
                    response.drivers.forEach(function (driver) {
                        dropdown.append(
                            `<option value="${driver.id}">${driver.name}</option>`
                        );
                    });
                } else {
                    dropdown.append(
                        '<option value="">No drivers available</option>'
                    );
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("Error fetching drivers:", error);
                $("#driverDropdown").html(
                    '<option value="">Error loading drivers</option>'
                );
            },
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