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
                            <th>Warehouse Name</th>
                            <th>Order Date</th>
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
                                <div>${{ number_format($parcel->total_amount ?? 0, 2) }}</div>
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
                                };
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

                            <td>
                                <div> {{ $parcel->payment_type === 'COD' ? 'Cash' : ($parcel->payment_type ?? '-') }}
                                </div>
                            </td>
                            <td>
                                <label class="{{ $parcel->parcelStatus->class_name }}" for="status">
                                    {{ $parcel->parcelStatus->status ?? '-' }}
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mt-4 ">
                <div class="col-md-12">
                    <p class="heading mb-3">Item List</p>
                    <div class="table-responsive notMinheight smallTDs">
                        <table class="table table-stripped table-hover datatable notposition border1">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sn no.</th>
                                    <th>Supply Image</th>
                                    <th>Supply Details</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Amt.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($parcelInventories as $index => $parcelInventorie)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td class="product_img justify-items-center">
                                            @if (!empty($parcelInventorie->inventorie->img))
                                                <img src="{{ asset($parcelInventorie->inventorie->img) }}" alt="Inventory Image"
                                                    class="itemImg">
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td>{{ucfirst($parcelInventorie->inventorie->name ?? '')}}</td>
                                        <td>{{$parcelInventorie->inventorie_item_quantity ?? "0"}}</td>
                                        <td>
                                            ${{ number_format($parcelInventorie->price ?? 0, 2) }}</td>
                                        <td>${{ number_format($parcelInventorie->total ?? 0, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">No Item found.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>

            @php
             if($parcel->delivery_type == 'self') {
                $statusSteps = [
                    1 => 'Pending',
                    35 => 'Order Received',
                    36 => 'In Process',
                    37 => 'Ready to Pick Up',
                    38 => 'Picked Up'
                ];

             }else{
                $statusSteps = [
                    1 => 'Pending',
                    22 => 'Assign delivery with driver',
                    10 => 'Out for delivery',
                    11 => 'Delivered'
                ];
             }


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
                                <div class="row justify-content-center">
                                    @foreach($statusSteps as $code => $label)
                                        @php
                                            $isCompleted = isset($completedStatusMap[$code]) && $completedStatusMap[$code] === true;
                                        @endphp
                                        @if($isCompleted)
                                        <div class="order-tracking {{ $isCompleted ? 'completed' : '' }}">
                                            <span class="is-complete"></span>
                                            <p>
                                                {{ $label }}<br>
                                                <span>{{ $statusDates[$code] ?? '' }}</span>
                                            </p>
                                        </div>
                                        @endif
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

</x-app-layout>
