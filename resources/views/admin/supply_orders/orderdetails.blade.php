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
                                <div>{{ $parcel->created_at ? $parcel->created_at->format('d-m-Y') : '-' }}</div>
                            </td>
                            <td>
                                <div>${{ $parcel->total_amount ?? "0"}}</div>
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
                                <div>{{ $parcel->payment_type ?? "-"}}</div>
                            </td>
                            <td>
                                <label class="{{ $classValue }}" for="status">
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
                                        <td>${{$parcelInventorie->price ?? "0"}}</td>
                                        <td>${{$parcelInventorie->total ?? "0"}}</td>
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
                $statusSteps = [
                    1 => 'Pending',
                    22 => 'Assign delivery with driver',
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
                                <div class="row justify-content-center">
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

</x-app-layout>