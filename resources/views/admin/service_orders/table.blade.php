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
                                                                <br> {{$parcel->pickupaddress->alternative_mobile_number ?? "--"}}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                                <p>{{$parcel->pickupaddress->address ?? "--"}}<br>
                                                                    {{$parcel->pickupaddress->pincode ?? "--"}} <br>
                                                                    {{$parcel->pickupaddress->city->name ?? "--"}}
                                                                    {{$parcel->pickupaddress->state->name ?? "--"}}
                                                                    {{$parcel->pickupaddress->country->name ?? "--"}}</p>
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
                                                                <br> {{$parcel->deliveryaddress->alternative_mobile_number ?? "--"}}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                                <p>{{$parcel->deliveryaddress->address ?? "--"}}<br>
                                                                    {{$parcel->deliveryaddress->pincode ?? "--"}} <br>
                                                                    {{$parcel->deliveryaddress->city->name ?? "--"}}
                                                                    {{$parcel->deliveryaddress->state->name ?? "--"}}
                                                                    {{$parcel->deliveryaddress->country->name ?? "--"}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                            <div>{{ ucfirst($parcel->transport_type) ?? '-' }}</div>
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
                                                {{  $parcel->descriptions ?? '-' }}</p>
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
                                            @php
                                                $classValue = match ($parcel->parcelStatus->status) {
                                                    'Pickup Assign' => 'labelstatusp',
                                                    'Pending' => 'labelstatusp',
                                                    'Pickup Re-Schedule' => 'labelstatuspi',
                                                    default => 'labelstatusp',
                                                };
                                            @endphp
                                            <td>
                                                <div> {{ $parcel->payment_type === 'COD' ? 'Cash' : ($parcel->payment_type ?? '-') }}</div>
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

                                                        <span class="user-content droparrow droparrow">
                                                            <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                                                        </span>
                                                    </a>
                                                    <div class="dropdown-menu menu-drop-user">
                                                        <div class="profilemenu">
                                                            <div class="subscription-menu">
                                                                <ul>
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                                            data-bs-toggle="modal" data-bs-target="#cancel_modal">Schedule
                                                                            Pickup Cancel</a>


                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                                            data-bs-toggle="modal" data-bs-target="#reschedule_modal">
                                                                            Pickup
                                                                            Re-schedule</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                                            data-bs-toggle="modal" data-bs-target="#recieved_modal">Recieved
                                                                            by
                                                                            Pickup Man</a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                            </td>
                                            <td class="btntext">
                                                <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                                                        src="{{asset('assets/img/ordereye.png')}}"></button>
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