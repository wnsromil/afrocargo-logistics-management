<x-app-layout>
    <x-slot name="header">
        {{ __('Container List') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">All Containers</p>
        <div class="">
            @can('has-dynamic-permission', 'container_list.create')
                <a href="{{ route('admin.container.create') }}" class="btn btn-primary buttons">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Container
                    </div>
                </a>
            @endcan
        </div>
    </x-slot>

    <form id="expenseFilterForm" action="{{ route('admin.container.index') }}" method="GET">
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search" value="{{ request('search') }}">
                </div>
            </div>
            @php
                $isSingleWarehouse = count($warehouses) === 1;
                $warehouseIdFromUrl = request()->query('warehouse_id');
            @endphp

            @if($isSingleWarehouse)
                {{-- ✅ Readonly Input for Single Warehouse --}}
                <div class="col-md-3 mb-3">
                    <label>By Warehouse</label>
                    <input type="text" class="form-control" value="{{ $warehouses[0]->warehouse_name }}" readonly
                        style="background-color: #e9ecef; color: #6c757d;">
                    <input type="hidden" name="warehouse_id" value="{{ $warehouses[0]->id }}">
                </div>
            @else
                {{-- ✅ Select Dropdown for Multiple Warehouses --}}
                <div class="col-md-3 mb-3">
                    <label>By Warehouse</label>
                    <select class="js-example-basic-single select2 form-control" name="warehouse_id">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $warehouseIdFromUrl == $warehouse->id || old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('warehouse_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endif


            <div class="col-md-3 mb-3">
                <label>Open Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info bordered">
                    <input type="text" name="open_date" class="btn-filters form-cs inp Expensefillterdate"
                        value="{{ old('open_date', request()->query('open_date')) }}" />
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label>Close Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info bordered">
                    <input type="text" name="close_date" class="btn-filters form-cs inp Expensefillterdate"
                        value="{{ old('close_date', request()->query('close_date')) }}" />
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label>Container Status</label>
                <select class="js-example-basic-single select2" name="status_search" id="status_search">
                    <option value="">Select Status</option>
                    @foreach ($containerParcelStatus as $ParcelStatus)
                        <option value="{{ $ParcelStatus->id }}" {{ request()->input('status_search') == $ParcelStatus->id ? 'selected' : '' }}>
                            {{ $ParcelStatus->status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
    </form>

    <div class="usersearch d-flex align-items-center justify-content-between">
        <div class="lablewrap d-flex text-dark">
            <label class="me-sm-4 me-2 mb-0">Total Billed: $<b>{{number_format(0)}}</b></label>
            <label class="me-sm-4 me-2 mb-0">Total Collected: $<b>{{number_format(0)}}</b></label>
            <label class="me-sm-4 me-2 mb-0">Total Balance: $<b>{{number_format(0)}}</b></label>
        </div>
    </div>


    <div id='ajexTable'>
        @include("admin.container.table")
    </div>

    <!-- Container In time model -->
    <div class="modal custom-modal signature-add-modal fade" id="In_time_model" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Container In time</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="In_time_form" method="POST">
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="container_id_input" name="container_id"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor mt-0 pt-0">In Date & Time</label>
                                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                        <input type="text" name="container_in_date_time" style="cursor: pointer;"
                                            id="container_in_date_time" class="btn-filters  form-cs inp"
                                            value="{{ old('container_in_date_time') }}" placeholder="M/DD/YYYY hh:mm A"
                                            readonly style="background: #ececec;" />
                                    </div>
                                    <div id="container_in_date_time_error" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mx-2">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Container Out time model -->
    <div class="modal custom-modal signature-add-modal fade" id="Out_time_model" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Container Out time</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="Out_time_form" method="POST">
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="container_id_input" name="container_id"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor mt-0 pt-0">Out Date & Time</label>
                                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                        <input type="text" name="container_out_date_time" style="cursor: pointer;"
                                            id="container_out_date_time" class="btn-filters  form-cs inp"
                                            value="{{ old('container_out_date_time') }}" placeholder="M/DD/YYYY hh:mm A"
                                            readonly style="background: #ececec;" />
                                    </div>
                                    <div id="container_out_date_time_error" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mx-2">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('script')
        <!-- Axios CDN -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            function handleContainerClick(containerId, containerNumber, warehouseId) {
                const checkbox = document.getElementById(`rating_${containerId}`);
                const isChecked = checkbox.checked;
                // Step 1: Fetch current active container
                axios.post('/api/vehicle/getAdminActiveContainer', {
                    warehouse_id: warehouseId
                }).then(response => {
                    const activeContainer = response.data.container;

                    let message = '';
                    let checkbox_status = '';

                    if (isChecked) {
                        message = `You are about to <b>OPEN</b> the container <b>${containerNumber}</b>`;
                        checkbox_status = "only_open";
                    } else {
                        message = `You are about to <b>CLOSE</b> the container <b>${containerNumber}</b>`;
                        checkbox_status = "only_close";
                    }

                    Swal.fire({
                        title: 'Are you sure?',
                        html: message,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, confirm',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.post('/api/vehicle/toggle-status', {
                                open_id: isChecked ? containerId : null,
                                close_id: !isChecked ? containerId : (activeContainer?.id ?? null),
                                checkbox_status: checkbox_status,
                                warehouseId: warehouseId,
                            })
                                .then((res) => {
                                    console.log(res.data.success);
                                    if (res.data.success) {
                                        Swal.fire('Success', 'Container status updated.', 'success').then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            html: `This route <strong>${res.data.message}</strong> container is already open.`,
                                        }).then(() => {
                                            location.reload();
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire('Error', 'Failed to update container status.', 'error');
                                });
                        } else {
                            location.reload(); // rollback visual state
                        }
                    });
                })
                    .catch(error => {
                        Swal.fire('Error', 'Failed to fetch current active container.', 'error');
                    });
            }

            function resetForm() {
                window.location.href = "{{ route('admin.container.index') }}";
            }
        </script>
        <script>
            function setContainerId(id) {
                document.getElementById('container_id_input').value = id;
            }
        </script>
        <!-- In Container -->
        <script>
            // Bootstrap modal open hone ke baad initialize karo
            $('#In_time_model').on('shown.bs.modal', function () {
                $('input[name="container_in_date_time"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    timePicker: true, // ✅ Enable time
                    timePicker24Hour: false, // ✅ Use 12-hour format
                    timePickerSeconds: false, // Optional: hide seconds
                    autoUpdateInput: false,
                    locale: {
                        format: "M/DD/YYYY hh:mm A", // ✅ Date + Time format
                    },
                });

                $('input[name="container_in_date_time"]').on(
                    "apply.daterangepicker",
                    function (ev, picker) {
                        $(this).val(picker.startDate.format("M/DD/YYYY hh:mm A")); // ✅ Set full date-time
                    }
                );
            });
        </script>
        <script>
            $(document).ready(function () {
                $("#In_time_form").on("submit", function (e) {
                    e.preventDefault(); // Prevent default form submission
                    // Clear previous error messages
                    $("#container_in_date_time_error").text("");

                    // Get Form Data
                    let container_id = $("#container_id_input").val();
                    let container_in_date_time = $("#container_in_date_time").val();
                    // Client-Side Validation
                    let hasError = false;

                    if (!container_in_date_time) {
                        $("#container_in_date_time_error").text("Please choose date & time.");
                        hasError = true;
                    }

                    // If there are validation errors, stop further execution
                    if (hasError) {
                        return;
                    }

                    // Show Loading Indicator
                    $(".btn-primary").html("Processing...").prop("disabled", true);

                    // Make AJAX POST Request
                    $.ajax({
                        url: "/api/update-in-container-time", // API endpoint
                        type: "POST",
                        data: {
                            container_id: container_id,
                            container_in_date_time: container_in_date_time,
                        },
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                        },
                        success: function (response) {
                            document
                                .querySelector("#In_time_model .custom-btn")
                                .click();
                            Swal.fire({
                                title: "Good job!",
                                text: "Date & time update successfully!",
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
                            if (errors.driver_id) {
                                $("#container_in_date_time_error").text(errors.driver_id[0]);
                            }
                        },
                        complete: function () {
                            // Re-enable Save Button
                            $(".btn-primary").html("Save").prop("disabled", false);
                        },
                    });
                });

                $("#ajexTable").on("click", "input[name='close_invoice'], input[name='close_warehouse']", function (e) {
                    let container_id = $(this).closest("tr").data("container-id");

                    let close_invoice = $(this).closest("tr").find("input[name='close_invoice']").is(":checked") ? 'yes' : 'no';
                    let close_warehouse = $(this).closest("tr").find("input[name='close_warehouse']").is(":checked") ? 'yes' : 'no';

                    // 👇 Figure out which checkbox was clicked
                    let clickedName = $(this).attr("name");
                    let message = "";

                    if (clickedName === "close_invoice") {
                        message = close_invoice === "yes"
                            ? "Invoice closed successfully!"
                            : "Invoice reopened successfully!";
                    } else if (clickedName === "close_warehouse") {
                        message = close_warehouse === "yes"
                            ? "Warehouse closed successfully!"
                            : "Warehouse reopened successfully!";
                    }

                    $.ajax({
                        url: "{{ route('updateCloseInvoiceWarehouse') }}",
                        type: "POST",
                        data: {
                            container_id: container_id,
                            close_invoice: close_invoice,
                            close_warehouse: close_warehouse,
                        },
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Success",
                                text: message,   // 👈 dynamic message
                                icon: "success",
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire("Error", "Failed to update container.", "error");
                        },
                    });
                });

            });

        </script>
        <!-- Out Container -->
        <script>
            // Bootstrap modal open hone ke baad initialize karo
            $('#Out_time_model').on('shown.bs.modal', function () {
                $('input[name="container_out_date_time"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    timePicker: true, // ✅ Enable time
                    timePicker24Hour: false, // ✅ Use 12-hour format
                    timePickerSeconds: false, // Optional: hide seconds
                    autoUpdateInput: false,
                    locale: {
                        format: "M/DD/YYYY hh:mm A", // ✅ Date + Time format
                    },
                });

                $('input[name="container_out_date_time"]').on(
                    "apply.daterangepicker",
                    function (ev, picker) {
                        $(this).val(picker.startDate.format("M/DD/YYYY hh:mm A")); // ✅ Set full date-time
                    }
                );
            });
        </script>
        <script>
            $(document).ready(function () {
                $("#Out_time_form").on("submit", function (e) {
                    e.preventDefault(); // Prevent default form submission
                    // Clear previous error messages
                    $("#container_out_date_time_error").text("");

                    // Get Form Data
                    let container_id = $("#container_id_input").val();
                    let container_out_date_time = $("#container_out_date_time").val();
                    // Client-Side Validation
                    let hasError = false;

                    if (!container_out_date_time) {
                        $("#container_out_date_time_error").text("Please choose date & time.");
                        hasError = true;
                    }

                    // If there are validation errors, stop further execution
                    if (hasError) {
                        return;
                    }

                    // Show Loading Indicator
                    $(".btn-primary").html("Processing...").prop("disabled", true);

                    // Make AJAX POST Request
                    $.ajax({
                        url: "/api/update-out-container-time", // API endpoint
                        type: "POST",
                        data: {
                            container_id: container_id,
                            container_out_date_time: container_out_date_time,
                        },
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                        },
                        success: function (response) {
                            document
                                .querySelector("#Out_time_model .custom-btn")
                                .click();
                            Swal.fire({
                                title: "Good job!",
                                text: "Date & time update successfully!",
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
                            if (errors.driver_id) {
                                $("#container_out_date_time_error").text(errors.driver_id[0]);
                            }
                        },
                        complete: function () {
                            // Re-enable Save Button
                            $(".btn-primary").html("Save").prop("disabled", false);
                        },
                    });
                });
            });

        </script>
    @endsection
</x-app-layout>
