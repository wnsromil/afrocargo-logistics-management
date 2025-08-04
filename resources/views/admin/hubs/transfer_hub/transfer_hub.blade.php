<x-app-layout>
    <x-slot name="header">
        {{ __('Container Transfer to Warehouse') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Container Transfer to Warehouse</p>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $fromWarehouseIdFromUrl = request()->query('from_warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.transfer.hub.list') }}" method="GET">
        <div class="row gx-3 mb-3 inputheight40">
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
                <label>To Warehouse</label>
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
                <label>From Warehouse</label>
                @if ($authUser->role_id == 1)
                    <select class="js-example-basic-single select2 form-control" name="from_warehouse_id">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $fromWarehouseIdFromUrl == $warehouse->id || old('from_warehouse_id') == $warehouse->id ? 'selected' : '' }}>
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
                    <input type="hidden" name="from_warehouse_id" value="{{ $singleWarehouse->id }}">
                @endif
                @error('from_warehouse_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
    </form>

    <div id="ajexTable">
        @include('admin.hubs.transfer_hub.transfer_hub_table')
    </div>
    <input type="hidden" id="vehicle_id_input_hidden" name="vehicle_id_hidden" class="form-control" readonly>
    <input type="hidden" id="container_history_id_input_hidden" name="container_history_id_hidden" class="form-control"
        readonly>

    <div class="modal custom-modal signature-add-modal fade" id="transfer_to_hub" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Transfer to hub</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">
                    </button>
                </div>
                <form method="POST" id="transfer_to_hub_form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">From Warehouse<i class="text-danger">*</i></label>
                                    <div class="input-block mb-0">
                                        <input type="text" id="from_warehouse_name" class="form-control inp"
                                            placeholder="" readonly>

                                        <!-- Hidden input (submits warehouse ID) -->
                                        <input type="hidden" name="from_warehouse_id" id="from_warehouse_id">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">To Warehouse<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2" name="to_warehouse_id"
                                            id="to_warehouse_id">
                                            <option selected="selected">Select Warehouse</option>
                                        </select>
                                        <div id="to_warehouse_idError" class="text-danger small mt-1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Vehicle No</label>
                                    <div class="input-block mb-0">
                                        <input type="text" name="vehicle_no" id="vehicle_no" class="form-control inp"
                                            placeholder="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">Delivery Man</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2" id="delivery_man"
                                            name="delivery_man">
                                            <option selected="selected">Select Delivery Man</option>
                                        </select>
                                        <div id="delivery_manError" class="text-danger small mt-1"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="note" id="Note" class="form-control inp Note"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal custom-modal signature-add-modal fade" id="fullyloadedcontainer" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body confirmationpopup">
                    <div class="form-header">

                        <p class="popupc"> Has the container been fully loaded?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button data-bs-dismiss="modal" type="button"
                                    onclick="updatestatusfullyloadedcontainer()"
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

    <div class="modal custom-modal signature-add-modal fade" id="Custom_Hold" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body confirmationpopup">
                    <div class="form-header">

                        <p class="popupc"> Is The Cargo Currently Under Customs Hold?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button data-bs-dismiss="modal" type="button" onclick="updatestatusCustom_Hold()"
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

    <div class="modal custom-modal signature-add-modal fade" id="Custom_Cleared" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body confirmationpopup">
                    <div class="form-header">

                        <p class="popupc"> Customs Clearance Completed?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button data-bs-dismiss="modal" type="button" onclick="updatestatusCustom_Cleared()"
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

    @section("script")
        <script>
            function openTransferModal(vehicleId, containerHistoryId) {
                $.ajax({
                    url: "/api/fetch-transfer-to-hub-data",
                    type: "POST",
                    data: {
                        vehicleId: vehicleId,
                        containerHistoryId: containerHistoryId
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        // Fill from_warehouse_id
                        $('input#from_warehouse_name').val(response.vehicle.warehouse.warehouse_name); // Show name
                        $('input#from_warehouse_id').val(response.vehicle.warehouse.id); // Submit ID


                        // Fill vehicle number
                        $('input[name="vehicle_no"]').val(response.vehicle.vehicle_number);

                        // Populate to_warehouse_id dropdown
                        let warehouseDropdown = $('select[name="to_warehouse_id"]');
                        warehouseDropdown.empty().append('<option value="">Select Warehouse</option>');
                        response.warehouses.forEach(function (warehouse) {
                            warehouseDropdown.append(
                                `<option value="${warehouse.id}">${warehouse.warehouse_name}</option>`
                            );
                        });

                        // Populate delivery man dropdown
                        let deliveryDropdown = $('select[name="delivery_man"]');
                        deliveryDropdown.empty().append('<option value="">Select Delivery Man</option>');
                        response.drivers.forEach(function (driver) {
                            deliveryDropdown.append(
                                `<option value="${driver.id}">${driver.name}</option>`
                            );
                        });
                    },
                    error: function (xhr) {
                        alert("Something went wrong while fetching data.");
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
        <script>
            function updatestatusfullyloadedcontainer() {
                let vehicleId = $("#vehicle_id_input_hidden").val();
                let containerhistoryid = $("#container_history_id_input_hidden").val();

                if (!vehicleId) {
                    alert("Parcel ID is required.");
                    return;
                }
                // Show Loading Indicator
                $(".btn-primary").html("Processing...").prop("disabled", true);

                // Make AJAX POST Request
                $.ajax({
                    url: "/api/update-status-fully-loaded-container", // API endpoint
                    type: "POST",
                    data: {
                        vehicleId: vehicleId,
                        containerHistoryId: containerhistoryid
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                    },
                    success: function (response) {
                        document
                            .querySelector("#fullyloadedcontainer .custom-btn")
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
            function updatestatusCustom_Hold() {
                let vehicleId = $("#vehicle_id_input_hidden").val();
                let containerhistoryid = $("#container_history_id_input_hidden").val();

                if (!vehicleId) {
                    alert("Parcel ID is required.");
                    return;
                }
                // Show Loading Indicator
                $(".btn-primary").html("Processing...").prop("disabled", true);

                // Make AJAX POST Request
                $.ajax({
                    url: "/api/update-status-custom-hold", // API endpoint
                    type: "POST",
                    data: {
                        vehicleId: vehicleId,
                        containerHistoryId: containerhistoryid
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                    },
                    success: function (response) {
                        document
                            .querySelector("#Custom_Hold .custom-btn")
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
            function updatestatusCustom_Cleared() {
                let vehicleId = $("#vehicle_id_input_hidden").val();
                let containerhistoryid = $("#container_history_id_input_hidden").val();

                if (!vehicleId) {
                    alert("Parcel ID is required.");
                    return;
                }
                // Show Loading Indicator
                $(".btn-primary").html("Processing...").prop("disabled", true);

                // Make AJAX POST Request
                $.ajax({
                    url: "/api/update-status-custom-cleared", // API endpoint
                    type: "POST",
                    data: {
                        vehicleId: vehicleId,
                        containerHistoryId: containerhistoryid
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                    },
                    success: function (response) {
                        document
                            .querySelector("#Custom_Cleared .custom-btn")
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
            function resetForm() {
                window.location.href = "{{ route('admin.transfer.hub.list') }}";
            }
        </script>
    @endsection

</x-app-layout>