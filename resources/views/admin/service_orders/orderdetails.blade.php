<x-app-layout>
    <x-slot name="header">
        Parcel Management
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Order details</p>
    </x-slot>
    <div class="card-table">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="thead-light">
                        <tr>
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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
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
                                    default => 'badge-pending',
                                };

                            @endphp
                            <td>
                                <label class="{{ $classValue }}" for="status">
                                    {{ $parcelStatus ?? '-' }}
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>

                @php
                    $statusSteps = [
                        1 => 'Pending',
                        3 => 'Pickup order',
                        4 => 'Arrived warehouse',
                        5 => 'In transit',
                        8 => 'Arrived at final destination warehouse',
                        9 => 'Ready for pick up',
                        //21 => 'Ready for self pick up',
                        10 => 'Out for delivery',
                        11 => 'Delivered'

                    ];

                    $statusDates = [];
                    $completedStatusMap = [];

                    foreach ($ParcelHistories as $history) {
                        $status = (int) $history->parcel_status;
                        $statusDates[$status] = \Carbon\Carbon::parse($history->created_at)->format('D, M d - h:i A');
                        $completedStatusMap[$status] = true;
                    }
                @endphp
                <p class="heading mt-4">Order History</p>
                <!-- Timeline -->
                <div class="col-md-12">
                    <div class="timeline-card px-3">
                        <div class="card-body">
                            <div class="">
                                <div class="hh-grayBox pt45 pb20">
                                    <div class="row">
                                        @foreach($statusSteps as $code => $label)
                                            @php
                                                $isCompleted = isset($completedStatusMap[$code]) && $completedStatusMap[$code] === true;
                                            @endphp
                                            <div class="order-tracking {{ $isCompleted ? 'completed' : '' }}">
                                                <span class="is-complete"></span>
                                                <p>
                                                    {{ $label }}<br>
                                                    <span>{{ $statusDates[$code] ?? '' }}</span>
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Timeline -->
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

</x-app-layout>