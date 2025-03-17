<x-app-layout>
    <x-slot name="header">
        {{ __('Invoices') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head" style="color:black">Invoices </p>
        <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{route('admin.invoices.create')}}" class="btn btn-primary buttons">
                        <img class="imgs" src="assets/images/Vector.png">
                        Add Invoice
                    </a>
                </div>
            </div>
        </div>


    </x-slot>




    <form>
        <div class="row">
            <div class="col-md-3 dposition">
                <label for="searchInput">Search</label>
                <img class="imgc" src="assets/img/icons/search.svg" alt="img">
                <input type="text" id="searchInput" class="form-control form-cs" placeholder="Search">
            </div>

            <div class="col-md-3 dposition">
                <label>By Invoice #ID</label>
                <img class="imgc" src="assets/img/icons/search.svg" alt="img">
                <input type="text" class="form-control form-cs" placeholder="Enter Invoice #ID">
            </div>
            <div class="col-md-3 dposition">
                <label>Invoice Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                    <input type="text" class="btn-filters form-control form-cs info" name="datetimes"
                        placeholder="From Date - To Date" style="border:none" />
                </div>
            </div>


            <div class="col-md-3 dposition">
                <label>By Container</label>
                <img class="imgi" src="assets/img/icons/search.svg" alt="img">
                <input type="text" class="form-control form-cs" placeholder="Enter Container Seal No.">
            </div>

            <div class="col-md-3 dmargin">

                <label>By Warehouse</label>
                <select class="js-example-basic-single select2 ">
                    <option selected="selected " class="form-cs">Select Warehouse</option>
                    <option>white</option>
                    <option>purple</option>
                </select>
            </div>

            <div class="col-md-3 dmargin">
                <label>By Driver</label>
                <select class="js-example-basic-single select2  form-cs">
                    <option selected="selected">Select Drive</option>
                    <option>white</option>
                    <option>purple</option>
                </select>
            </div>


            <div class="col-md-3 dmargin">
                <label>By Invoice Item</label>
                <img src="assets/img/icons/search.svg" alt="img" class="search-icon imgc">
                <input type="text" class="form-control form-cs" placeholder="Enter Invoice Item">
            </div>

              <div class="col-md-3 twobutton">
                <button class="btn btn-primary btnf">Filter</button>
                <button class="btn btn-outline-danger btnr">Reset</button>
            </div>
        </div>

        <div>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-stripped table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                    <th>Sn no.</th>
                                    <th>Invoice No</th>
                                    <th>Tracking ID</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    {{-- <th>Warehouse</th> --}}
                                    <th>Due</th>
                                    <th>Payment Mode</th>
                                    <th>Status</th>
                                    <th>Status update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $index => $invoice)
                                                            <tr>

                                                                {{-- <td><input type="checkbox"
                                                                        class="form-check-input selectCheckbox checkbox-{{ activeStatusKey($invoice->status) }}"
                                                                        value="{{ $invoice->id }}"></td> --}}
                                                                <td>{{ ++$index }}</td>
                                                                <td>
                                                                    {{ ucfirst($invoice->invoice_no ?? '-') }}
                                                                </td>
                                                                <td>
                                                                    {{ ucfirst($invoice->parcel->tracking_number ?? '-') }}
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <p>
                                                                            <i class="fe fe-user"></i>{{ ucfirst($invoice->parcel->customer->name ??
                                    '-') }}
                                                                        </p>
                                                                        <p>
                                                                            <i
                                                                                class="fe fe-phone"></i>{{ $invoice->parcel->customer->phone ?? '-' }}
                                                                        </p>
                                                                        <p>
                                                                            <i class="fe fe-map-pin"></i>{{ $invoice->parcel->customer->address ?? '-'
                                                                        }}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <p>
                                                                            <i class="fe fe-user"></i>{{ ucfirst($invoice->parcel->destination_user_name
                                    ?? '-') }}
                                                                        </p>
                                                                        <p>
                                                                            <i class="fe fe-phone"></i>{{ $invoice->parcel->destination_user_phone ??
                                    '-' }}
                                                                        </p>
                                                                        <p>
                                                                            <i class="fe fe-map-pin"></i>{{ $invoice->parcel->destination_address ?? '-'
                                                                        }}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                {{-- <td>{{ ucfirst($invoice->warehouse->warehouse_name ?? '-') }}</td> --}}
                                                                {{-- <td><span>{{ $invoice->weight ?? '-' }}</span></td> --}}
                                                                <td>
                                                                    <span>${{ $invoice->parcel->total_amount ?? '-' }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>${{ $invoice->parcel->remaining_payment ?? '-' }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>${{ $invoice->parcel->remaining_payment ?? '-' }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $invoice->parcel->payment_type ?? '-' }}</span>
                                                                </td>
                                                                <td>

                                                                    <span class="badge-{{ activeStatusKey($invoice->parcel->payment_status) }}">{{
                                    $invoice->parcel->payment_status ?? '-' }}</span>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <div class="dropdown">
                                                                        <span class="dropdown-icon-status" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="fas fa-chevron-down"></i>
                                                                        </span>
                                                                        <ul class="dropdown-menu">
                                                                            @if($invoice->status == 'Pending')
                                                                                <li>
                                                                                    <span class="dropdown-item"
                                                                                        onclick="handlePickupAssign({{ $invoice->id }}, {{ json_encode($drivers) }})">
                                                                                        <i class="fas fa-truck me-2"></i>Pickup Assign
                                                                                    </span>
                                                                                </li>
                                                                            @elseif($invoice->status == 'Pickup Assign')
                                                                                <li>
                                                                                    <span class="dropdown-item"
                                                                                        onclick="handlePickupCancel({{ $invoice->id }})">
                                                                                        <i class="fas fa-times-circle me-2"></i>Pickup Cancel
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="dropdown-item"
                                                                                        onclick="handlePickupReschedule({{ $invoice->id }}, {{ json_encode($drivers) }})">
                                                                                        <i class="fas fa-calendar-alt me-2"></i>Pickup Re-Schedule
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="dropdown-item"
                                                                                        onclick="handleReceivedByPickupMan({{ $invoice->id }})">
                                                                                        <i class="fas fa-box-open me-2"></i>Received By Pickup Man
                                                                                    </span>
                                                                                </li>
                                                                            @elseif($invoice->status == 'Pickup Re-Schedule')
                                                                                <li>
                                                                                    <span class="dropdown-item"
                                                                                        onclick="handlePickupReschedule({{ $invoice->id }}, {{ json_encode($drivers) }})">
                                                                                        <i class="fas fa-calendar-alt me-2"></i>Pickup Re-Schedule
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="dropdown-item"
                                                                                        onclick="handleReceivedWarehouse({{ $invoice->id }}, {{json_encode($warehouses)}})">
                                                                                        <i class="fas fa-warehouse me-2"></i>Received Warehouse
                                                                                    </span>
                                                                                </li>
                                                                            @elseif($invoice->status == 'Received Warehouse')
                                                                                <li>
                                                                                    <span class="dropdown-item"
                                                                                        onclick="handleTransferToHub({{ $invoice->id }}, {{ json_encode($drivers) }})">
                                                                                        <i class="fas fa-calendar-alt me-2"></i>Transfer To Hub
                                                                                    </span>
                                                                                </li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </td>

                                                                <td class="align-items-center">
                                                                    <span class="dropdown-icon-status">
                                                                        <a href="{{ route('admin.invoices.details', $invoice->id) }}">
                                                                            <i class="far fa-eye my-1 text-white"></i>

                                                                        </a>
                                                                    </span>
                                                                    {{-- <div class="dropdown dropdown-action">
                                                                        <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                                        <div>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('admin.OrderShipment.edit', $invoice->id) }}"><i
                                                                                            class="far fa-edit me-2"></i>Edit</a>
                                                                                </li>
                                                                                <li>
                                                                                    <form
                                                                                        action="{{ route('admin.OrderShipment.destroy', $invoice->id) }}"
                                                                                        method="POST" class="d-inline">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="button" class="dropdown-item"
                                                                                            onclick="deleteData(this, 'Are you sure you want to remove this parcel? This action can’t be undone!')"><i
                                                                                                class="far fa-trash-alt me-2"></i>Delete</button>
                                                                                    </form>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('admin.OrderShipment.show', $invoice->id) }}"><i
                                                                                            class="far fa-eye me-2"></i>View History</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div> --}}
                                                                </td>
                                                            </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-4 py-4 text-center text-gray-500">No parcels found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="bottom-user-page mt-3">
                        {!! $invoices->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
<script>
    function handlePickupAssign(ParcelId, drivers) {
        let options = `<option value="">Select Pickup Man</option>`;
        drivers.forEach(driver => {
            options += `<option value="${driver.id}">${driver.name}</option>`;
        });

        const Input_Fields = [
            {
                id: "pickup-man",
                label: "Pickup Man",
                type: "select",
                options: options,
                required: true
            },
            {
                id: "note",
                label: "Note",
                type: "textarea",
                required: false
            }
        ];

        let selectedUsers = [];
        $(".selectCheckbox:checked").each(function () {
            selectedUsers.push($(this).val());
        });

        if (ParcelId == "selectArr") {
            ParcelId = selectedUsers;
        }

        const status = "Pickup Assign";
        DynmicModel(ParcelId, status, Input_Fields);
    }

    function handlePickupReschedule(ParcelId, drivers) {
        let options = `<option value="">Select Pickup Man</option>`;
        drivers.forEach(driver => {
            options += `<option value="${driver.id}">${driver.name}</option>`;
        });

        const Input_Fields = [
            {
                id: "pickup-man",
                label: "Pickup Man",
                type: "select",
                options: options,
                required: true
            },
            {
                id: "pickup_date",
                label: "Pickup Date",
                type: "date",
                required: true
            },
            {
                id: "note",
                label: "Note",
                type: "textarea",
                required: false
            }

        ];

        const status = "Pickup Re-Schedule";
        DynmicModel(ParcelId, status, Input_Fields);
    }

    function handlePickupCancel(ParcelId) {
        const status = "Cancelled";
        DynmicModel(ParcelId, status, []);
        console.log("❌ Pickup Cancel Clicked");
    }

    function handleReceivedByPickupMan(ParcelId = false) {
        const status = "Received By Pickup Man";
        DynmicModel(ParcelId, status, []);
    }

    function handleReceivedWarehouse(ParcelId, warehouses) {
        let options = `<option value="">Select Warehouse</option>`;
        warehouses.forEach(warehouse => {
            options += `<option value="${warehouse.id}">${warehouse.warehouse_name}</option>`;
        });

        const Input_Fields = [
            {
                id: "warehouse_id",
                label: "Warehouse",
                type: "select",
                options: options,
                required: true
            },
            {
                id: "note",
                label: "Note",
                type: "textarea",
                required: false
            }
        ];

        const status = "Received Warehouse";
        DynmicModel(ParcelId, status, Input_Fields);
        console.log("🏢 Received Warehouse Clicked");
    }

    async function DynmicModel(ParcelId, status, Input_Fields) {
        var _token = '{{ csrf_token() }}';

        // Generate Dynamic HTML Inputs
        let formHtml = "";
        Input_Fields.forEach(field => {
            if (field.type === "select") {
                formHtml += `
                <label for="${field.id}" style="display:block; text-align:left; font-weight:bold; margin-top: 10px;">${field.label}</label>
                <select id="${field.id}" class="swal2-input">${field.options}</select>`;
            } else if (field.type === "textarea") {
                formHtml += `
                <label for="${field.id}" style="display:block; text-align:left; font-weight:bold; margin-top: 10px;">${field.label}</label>
                <textarea id="${field.id}" class="swal2-input textarea-swal2-input" rows="4" cols="50"></textarea>`;
            } else if (field.type === "date") {
                formHtml += `
                <label for="${field.id}" style="display:block; text-align:left; font-weight:bold; margin-top: 10px;">${field.label}</label>
                <input type="date" id="${field.id}" class="swal2-input">`;
            }
        });

        // Show SweetAlert
        const { value: formValues } = await Swal.fire({
            title: "Update Status",
            html: formHtml,
            showCancelButton: true,
            confirmButtonText: "Change",
            showCloseButton: true,
            preConfirm: () => {
                let formData = { ParcelId: ParcelId, status: status, _token: _token };
                let isValid = true;

                // Validate and collect data
                Input_Fields.forEach(field => {
                    let inputValue = document.getElementById(field.id)?.value.trim() || "";
                    if (field.required && !inputValue) {
                        Swal.showValidationMessage(`Please fill ${field.label}!`);
                        isValid = false;
                    }
                    formData[field.id] = inputValue; // Add to data object
                });

                return isValid ? formData : false;
            }
        });

        if (formValues) {
            // Send AJAX Request
            $.ajax({
                url: "{{ route('parcel.status_update') }}",
                type: "POST",
                data: formValues, // Dynamic data object
                success: function (response) {
                    if (response.status === true) {
                        Swal.fire({
                            title: "Good job!",
                            text: "Status change successfully!",
                            icon: "success"
                        }).then(() => {
                            location.reload(); // Page reload after OK click
                        });
                    } else {
                        Swal.fire({
                            title: "Oops...",
                            text: "Something went to wrong!",
                            icon: "error"
                        });
                    }
                },
                error: function (xhr) {
                    Swal.fire('Error!', 'An error occurred while processing your request.', 'error');
                    console.log(xhr.responseJSON);
                }
            });
        }
    }

</script>