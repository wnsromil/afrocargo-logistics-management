<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Received Orders</p>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.received.orders.hub.list') }}" method="GET">
        <div class="row gx-3 inputheight40">

            <div class="col-md-3 mb-3">
                <label>By Warehouse</label>
                @if ($authUser->role_id == 1)
                    <select class="js-example-basic-single select2 form-control" name="warehouse_id">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $warehouseIdFromUrl == $warehouse->id || old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                @else
                    @php
                        $singleWarehouse = $warehouses->first();
                    @endphp

                    <input type="text" class="form-control" value="{{ $singleWarehouse->warehouse_name }}" readonly
                        style="background-color: #e9ecef; color: #6c757d;">
                    <input type="hidden" name="warehouse_id" value="{{ $singleWarehouse->id }}">
                @endif
                @error('warehouse_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

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
      @include("admin.hubs.received_table_orders")
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
                                <label class="fw-bold mb-2">Choose Signature Type</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="signature_type" id="selectImage"
                                        value="image" checked>
                                    <label class="form-check-label" for="selectImage">Select Image</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="signature_type"
                                        id="drawSignature" value="draw">
                                    <label class="form-check-label" for="drawSignature">Draw Signature</label>
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div id="imageUploadSection">
                                <div class="col-lg-12 col-md-12 me-sm-2">
                                    <div class="input-block">
                                        <label class="table-content col737 fw-medium">Signature Image <i
                                                class="text-danger">*</i></label>
                                        <div class="input-block mb-3 service-upload img-size2 mb-0">
                                            <span id="upload_self_pickup_img">
                                                <svg width="65" height="37" viewBox="0 0 65 37" fill="none"
                                                    style="color:black;" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <rect width="65" height="37" fill="url(#pattern0_2250_39084)"
                                                        style="mix-blend-mode:luminosity" />
                                                    <defs>
                                                        <pattern id="pattern0_2250_39084"
                                                            patternContentUnits="objectBoundingBox" width="1"
                                                            height="1">
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
                                        @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @error('signature_drawn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Signature Canvas -->
                            <div id="drawSignatureSection" style="display:none;">
                                <div class="col-lg-12 col-md-12 me-sm-2">
                                    <canvas id="signaturePad" width="600" height="200"
                                        style="border:1px dashed #ccc; width:100%;"></canvas>
                                    <input type="hidden" name="signature_drawn" id="signatureDrawnData">

                                    <br>
                                    <button type="button" class="btn btn-sm btn-secondary mt-2"
                                        onclick="clearCanvas()">Clear</button>
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
            document.querySelector('.signatureBtn').addEventListener('click', function (e) {
                const checkedItems = document.querySelectorAll('.itemCheckbox:checked:not([disabled])');

                if (checkedItems.length === 0) {
                    toastr["error"]("Please select at least one item to signature.");
                    return; // Don't open modal
                }

                const parcelId = this.getAttribute('data-id');

                // Set hidden input value
                document.getElementById("parcel_id_input_hidden").value = parcelId;

                // If at least one checkbox is checked, open modal manually
                const modal = new bootstrap.Modal(document.getElementById('ready_for_signature_pick_up'));
                modal.show();
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const imageUploadSection = document.getElementById("imageUploadSection");
                const drawSignatureSection = document.getElementById("drawSignatureSection");
                const signaturePadCanvas = document.getElementById("signaturePad");
                const signatureDrawnData = document.getElementById("signatureDrawnData");
                const ctx = signaturePadCanvas.getContext("2d");

                let drawing = false;

                // Toggle between image and draw options
                document.querySelectorAll('input[name="signature_type"]').forEach(input => {
                    input.addEventListener("change", function () {
                        if (this.value === "image") {
                            imageUploadSection.style.display = "block";
                            drawSignatureSection.style.display = "none";
                        } else {
                            imageUploadSection.style.display = "none";
                            drawSignatureSection.style.display = "block";
                        }
                    });
                });

                // Drawing on canvas
                signaturePadCanvas.addEventListener("mousedown", e => {
                    drawing = true;
                    const rect = signaturePadCanvas.getBoundingClientRect();

                    const scaleX = signaturePadCanvas.width / rect.width;
                    const scaleY = signaturePadCanvas.height / rect.height;

                    ctx.beginPath();
                    ctx.moveTo((e.clientX - rect.left) * scaleX, (e.clientY - rect.top) * scaleY);
                });

                signaturePadCanvas.addEventListener("mousemove", e => {
                    if (drawing) {
                        const rect = signaturePadCanvas.getBoundingClientRect();

                        const scaleX = signaturePadCanvas.width / rect.width;
                        const scaleY = signaturePadCanvas.height / rect.height;

                        ctx.lineTo((e.clientX - rect.left) * scaleX, (e.clientY - rect.top) * scaleY);
                        ctx.stroke();
                    }
                });


                signaturePadCanvas.addEventListener("mouseup", () => {
                    drawing = false;
                    updateSignatureData();
                });

                signaturePadCanvas.addEventListener("mouseleave", () => {
                    drawing = false;
                });

                function updateSignatureData() {
                    const dataURL = signaturePadCanvas.toDataURL("image/png");
                    signatureDrawnData.value = dataURL;
                }

                // Clear canvas button function
                window.clearCanvas = function () {
                    ctx.clearRect(0, 0, signaturePadCanvas.width, signaturePadCanvas.height);
                    signatureDrawnData.value = "";
                };
            });
        </script>
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
                window.location.href = "{{ route('admin.received.orders.hub.list') }}";
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