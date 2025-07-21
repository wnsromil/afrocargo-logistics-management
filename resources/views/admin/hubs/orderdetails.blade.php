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
    <div class="card-table" id="ajexTable">
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
                                    data-id="{{ $parcel->id }}"
                                     data-bs-target="#ready_for_signature_pick_up">
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

    <input type="hidden" id="parcel_id_input_hidden" name="parcel_id_hidden" class="form-control" readonly>
    <input type="hidden" id="warehouse_id_input_hidden" name="warehouse_id_hidden" class="form-control" readonly>
    <input type="hidden" id="created_user_id_input_hidden" name="created_user_id_hidden" class="form-control" readonly
        value="{{ auth()->user()->id }}">

    </div>
    <div class="show">
        <div class="overlay"></div>
        <div class="img-show">
            <span><i class="fa-solid fa-rectangle-xmark"></i></span>
            <img src="">
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