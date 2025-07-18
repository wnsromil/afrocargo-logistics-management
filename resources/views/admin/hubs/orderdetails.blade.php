<x-app-layout>
    <x-slot name="header">
        Parcel Management
    </x-slot>
    @section('style')
        <style>
            .show {
                z-index: 999;
                display: none;
            }

            .show .overlay {
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, .66);
                position: absolute;
                top: 0;
                left: 0;
            }

            .show .img-show {
                width: 600px;
                height: 400px;
                background: #FFF;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                overflow: hidden
            }

            .img-show span {
                position: absolute;
                top: 10px;
                right: 10px;
                z-index: 99;
                cursor: pointer;
            }

            .img-show img {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
            }

            .order-tracking.cancelled .is-complete {
                background-color: red !important;
                border-color: red;
            }

            .order-tracking.cancelled p {
                color: red;
            }
        </style>
    @endsection

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
                            <th>Status</th>
                            <th>Pickup Type</th>
                            <th>Delivery Type</th>
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
                                <div>
                                    @if(isset($parcel) && $parcel->pickup_date)
                                        {{ \Carbon\Carbon::parse($parcel->pickup_date)->format('m-d-Y') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div>
                                    @if(isset($parcel) && $parcel->delivery_date)
                                        {{ \Carbon\Carbon::parse($parcel->delivery_date)->format('m-d-Y') }}
                                    @else
                                        -
                                    @endif
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
                                    default => 'partial_status',
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
                                        <div class="row">${{ number_format($parcel->partial_payment ?? 0, 2) }}</div>
                                        <div class="row">${{ number_format($parcel->remaining_payment ?? 0, 2) }}</div>
                                        <div class="row">${{ number_format($parcel->total_amount ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div> {{ $parcel->payment_type === 'COD' ? 'Cash' : ($parcel->payment_type ?? '-') }}
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
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mt-4 ">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="heading mb-0">Item List</p>
                        <div class="d-flex">
                            <button type="button"
                                    class="btn btn-primary btnf me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="">
                                <i class="ti ti-signature me-1"></i>Signature
                            </button>                    
                            <button type="button"
                                    class="btn btn-primary btnf me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#individualPayment{{ $parcel->invoice_id ?? '' }}">
                                <i class="ti ti-credit-card me-1"></i>Payment
                            </button>                                
                            @if($parcel->invoice_id)
                             <a href="{{ route('invoices.invoicesdownload', encrypt($parcel->invoice_id)) }}"
                            class="btn btn-primary btnf me-2"
                            target="_blank"
                            title="Invoice PDF">
                            <i class="ti ti-file-invoice"></i> Invoice PDF
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive notMinheight smallTDs">
                        <table class="table table-stripped table-hover datatable notposition">
                            <thead class="thead-light">
                                <tr>
                                    <th> <input type="checkbox" id="selectAll"></th>
                                    <th>S.No</th>
                                    <th>Container ID</th>
                                    <th>Item Image</th>
                                    <th>Item Name</th>
                                    <th>Item Price</th>
                                    <th>Quantity</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($parcelItems as $index => $parcelItem)
                                    <tr>
                                      <td>
                                        <input
                                                type="checkbox"
                                                class="itemCheckbox"
                                                value="{{ $parcelItem->id }}"
                                                {{ $parcelItem->invoice_id ? 'checked disabled' : '' }}
                                            >
                                        </td>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$parcelItem->container->unique_id ?? "-"}}</td>
                                        <td class="product_img justify-items-center popup" style="justify-items: center;">
                                            @if (!empty($parcelItem->img))
                                                <img style="cursor: pointer;" src="{{ asset($parcelItem->img) }}"
                                                    alt="Inventory Image" class="itemImg">
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td>{{ucfirst($parcelItem->inventory_name ?? '')}}</td>
                                        <td>{{$parcelItem->inventorie_item_quantity ?? "0"}}</td>
                                        <td>${{ number_format($parcelItem->price ?? 0, 2)}}</td>
                                        <td>{{ucfirst(string: $parcelItem->quantity_type ?? "-")}}</td>
                                        @php
                                            $classValue = match ((string) $parcelItem->status) {
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
                                                {{ $parcelItem->parcelStatus->status ?? '-' }}
                                            </label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">No Item found.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        @if ($parcel->invoice_id)
                        @include('admin.Invoices.modals.individual_payment_modal')
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-4 ">
                <div class="col-md-12">
                    <div class="mb-3">
                        <p class="heading mb-0">Payment History</p>
                        <div class="table-responsive notMinheight smallTDs">
                           <table class="table table-stripped table-hover datatable notposition">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Invoice ID</th>
                                            <th>User</th>
                                            <th>Payment Type</th>
                                            <th>Payment Date</th>
                                            <th>Local Currency</th>
                                            <th>Local Amount</th>
                                            <th>Currency</th>
                                            <th>Amt. In Dollar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($invoice)
                                        @forelse($invoice->individualPayment as $payment)
                                        <tr>
                                            <td>{{ $invoice->invoice_no ?? '' }}</td>
                                            <td>
                                                <span data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{ $payment->createdByUser->name ?? '' }} {{ $payment->createdByUser->last_name ?? '' }}">
                                                    {{ $payment->createdByUser->name ?? '' }} {{
                                                    $payment->createdByUser->last_name ?? '' }}
                                                </span>
                                            </td>
                                            <td>{{ ucfirst($payment->payment_type ?? '-') }}</td>
                                            <td>{{ $payment->payment_date ?
                                                \Carbon\Carbon::parse($payment->payment_date)->format('m/d/Y, h:i a') :
                                                '-' }}</td>
                                            <td>{{ $payment->local_currency ?? '-' }}</td>
                                            <td>{{ number_format($payment->applied_payments ?? 0, 2) }}</td>
                                            <td>{{ $payment->currency ?? '-' }}</td>
                                            <td>{{ number_format($payment->payment_amount ?? 0, 2) }}</td>
            
                                            
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{route('invoices.invoicesdownload',encrypt($invoice->id))}}"><i
                                                                        class="ti ti-file-type-pdf me-2"></i>PDF</a>
                                                            </li>
                                                            {{-- <li>
                                                                <a class="dropdown-item" href="#"><i
                                                                        class="ti ti-trash me-2"></i>Delete</a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No Payments Found</td>
                                        </tr>
                                        @endforelse
                                        @else
                                           <tr>
                                            <td colspan="8" class="text-center">No Payments Found</td>
                                        </tr>
                                         @endif
                                    </tbody>
                           </table>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        @php
            $currentStatusId = $parcel->status ?? null;

            $statusSteps = [
                1 => 'Pending',
                3 => 'Pickup order',
                4 => 'Arrived warehouse',
                5 => 'In transit',
                8 => 'Arrived at final destination warehouse',
                9 => 'Ready for pick up',
                10 => 'Out for delivery',
                11 => 'Delivered',
            ];

            $statusDates = [];
            $completedStatusMap = [];

            foreach ($ParcelHistories as $history) {
                $status = (int) $history->parcel_status;
                $statusDates[$status] = \Carbon\Carbon::parse($history->created_at)->format('D, M d - h:i A');
                $completedStatusMap[$status] = true;
            }

            $cancelFound = $currentStatusId == 14;
        @endphp

        <p class="heading mt-4">Order History</p>
        <div class="col-md-12">
            <div class="timeline-card px-3">
                <div class="card-body">
                    <div class="hh-grayBox pt45 pb20">
                        <div class="row">
                            @if ($cancelFound)
                                @php $cancelInserted = false; @endphp
                                @foreach ($statusSteps as $code => $label)
                                    @if (isset($completedStatusMap[$code]))
                                        <div class="order-tracking completed">
                                            <span class="is-complete"></span>
                                            <p>
                                                {{ $label }}<br>
                                                <span>{{ $statusDates[$code] ?? '' }}</span>
                                            </p>
                                        </div>
                                    @elseif (!$cancelInserted)
                                        <div class="order-tracking cancelled">
                                            <span class="is-complete"></span>
                                            <p>
                                                Cancelled<br>
                                                <span>{{ $statusDates[14] ?? now()->format('D, M d - h:i A') }}</span>
                                            </p>
                                        </div>
                                        @php $cancelInserted = true; @endphp
                                        @break
                                    @endif
                                @endforeach
                            @else
                                @foreach ($statusSteps as $code => $label)
                                    @php $isCompleted = isset($completedStatusMap[$code]); @endphp
                                    <div class="order-tracking {{ $isCompleted ? 'completed' : '' }}">
                                        <span class="is-complete"></span>
                                        <p>
                                            {{ $label }}<br>
                                            <span>{{ $statusDates[$code] ?? '' }}</span>
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="show">
        <div class="overlay"></div>
        <div class="img-show">
            <span><i class="fa-solid fa-rectangle-xmark"></i></span>
            <img src="">
        </div>
    </div>
      
    @section('script')
        <script>
            $(function () {
                "use strict";

                $(".popup img").click(function () {
                    var $src = $(this).attr("src");
                    $(".show").fadeIn();
                    $(".img-show img").attr("src", $src);
                });

                $("span, .overlay").click(function () {
                    $(".show").fadeOut();
                });

            });
        </script>
      <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const selectAll = document.getElementById('selectAll');
                    const checkboxes = document.querySelectorAll('.itemCheckbox');

                    selectAll.addEventListener('change', function () {
                        checkboxes.forEach(cb => {
                            if (!cb.disabled) { // ✅ Skip disabled checkboxes
                                cb.checked = selectAll.checked;
                            }
                        });
                    });

                    // Optional: Update header checkbox based on enabled checkboxes
                    checkboxes.forEach(cb => {
                        cb.addEventListener('change', function () {
                            const enabledCheckboxes = Array.from(checkboxes).filter(c => !c.disabled);
                            const allChecked = enabledCheckboxes.every(c => c.checked);
                            selectAll.checked = allChecked;
                        });
                    });
                });
            </script>
    @endsection

</x-app-layout>