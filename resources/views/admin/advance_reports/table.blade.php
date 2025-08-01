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
                        <th>View</th>
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
                                <div>
                                    {{ $parcel->parcel_type === 'Supply' ? ucfirst($parcel->parcel_type) : (ucfirst($parcel->transport_type) ?? '-') }}
                                </div>
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
                                $ClassStatus = $parcel->parcelStatus->class_name ?? null;
                            @endphp
                            <td>
                                <label class="{{ $ClassStatus }}" for="status">
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