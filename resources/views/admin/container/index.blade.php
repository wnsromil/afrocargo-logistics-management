<x-app-layout>
    <x-slot name="header">
        {{ __('Container List') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">All Containers</p>
        <div class="">
            <a href="{{ route('admin.container.create') }}" class="btn btn-primary buttons">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle-plus me-2 text-white"></i>
                    Add Container
                </div>
            </a>
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
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Container ID</th>
                                <th>Warehouse</th>
                                <th>Container</th>
                                <th>Container Status</th>
                                <th>Open Date</th>
                                <th>Close Date</th>
                                <th>Close Invoice</th>
                                <th>Close Warehouse</th>
                                <th>Volume</th>
                                <th>Total Billed</th>
                                <th>Total Collected</th>
                                <th>Total Balance</th>
                                <th>Status</th>
                                <th>Status Change</th>
                                <th Class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicles as $index => $vehicle)
                                <tr>
                                    <td>
                                        {{ $vehicle->unique_id ?? '-' }}
                                        {{ $vehicle->ship_to_country ? ', ' . $vehicle->ship_to_country : ''}}
                                    </td>
                                    <td>{{ ucfirst($vehicle->warehouse->warehouse_name ?? '') }}</td>
                                    <td>{{ $vehicle->container_no_1 ?? '-' }}</td>
                                    @php
                                        $statusId = (string) ($vehicle->container_status ?? '');
                                        $vehicleStatus = $vehicle->containerStatus->status ?? 'New';
                                        $ClassStatus = $vehicle->containerStatus->class_name ?? "new-badge-pending new-comman-css";
                                    @endphp
                                    <td>
                                        <label class="{{ $ClassStatus }}">
                                            {{ $vehicleStatus ?? 'New' }}
                                        </label>
                                    </td>

                                    <td>{{ $vehicle->open_date ? \Carbon\Carbon::parse($vehicle->open_date)->format('m-d-Y') : '-' }}
                                    </td>
                                    <td>{{ $vehicle->close_date ? \Carbon\Carbon::parse($vehicle->close_date)->format('m-d-Y') : '-' }}
                                    </td>
                                    <td class="tabletext"><input type="checkbox"></td>
                                    <td class="tabletext"><input type="checkbox"></td>
                                    <td>{{ ucfirst($vehicle->volume ?? '-') }}</td>
                                    <td>${{number_format(0)}}</td>
                                    <td>${{number_format(0)}}</td>
                                    <td>${{number_format(0)}}</td>
                                    <td>
                                        <label
                                            class="labelstatus {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}"
                                            for="{{ $vehicle->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                            {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="status-toggle toggles togglep">
                                            <input
                                                onclick="handleContainerClick('{{ $vehicle->id }}', '{{ $vehicle->container_no_1 }}' , '{{ $vehicle->warehouse_id }}')"
                                                id="rating_{{$vehicle->id}}" class="check" type="checkbox"
                                                value="{{$vehicle->status}}" {{$vehicle->status == 'Active' ? 'checked' : '' }}>
                                            <label for="rating_{{$vehicle->id}}"
                                                class="checktoggle log checkbox-bg">checkbox</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.container.edit', $vehicle->id)}}"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.container.show', $vehicle->id) }}"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#In_time_model" href="javascript:void(0);"
                                                            onclick="setContainerId({{ $vehicle->id }})">
                                                            <i
                                                                class="fa-solid fa-truck fa-flip-horizontal me-2"></i>Container
                                                            In Time
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#Out_time_model" href="javascript:void(0);"
                                                            onclick="setContainerId({{ $vehicle->id }})">
                                                            <i class="fa-solid fa-truck me-2"></i>Container
                                                            Out Time
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-4 text-center text-gray-500">No data found.</td>
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
                        {!! $vehicles->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
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