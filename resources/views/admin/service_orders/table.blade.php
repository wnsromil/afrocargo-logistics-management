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
                                        <div>{{$parcel->container->unique_id ?? "--"}} </div>
                                    </td>
                                    <td>
                                        <div>{{$parcel->warehouse->warehouse_name ?? "--"}} </div>
                                    </td>
                                    <td>
                                        <div>{{$parcel->arrivedWarehouse->warehouse_name ?? "--"}} </div>
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
                                                    <div class="row">
                                                        ${{ number_format($parcel->customer_estimate_cost ?? 0, 2) }}
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