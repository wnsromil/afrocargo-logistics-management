<x-app-layout>
    @section('style')
    <style>
        .content-page-header {
            margin-top: -10px;
        }
    </style>
    @endsection

    <x-slot name="header">
        {{ __('Invoices') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head" style="color:black">Invoices </p>
        <div class="d-flex align-items-center justify-content-end">
            <div class="usersearch d-flex">
                <div class="mt-0">
                    <a href="{{route('admin.invoices.create')}}" class="btn btn-primary buttons">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Invoice
                    </a>
                </div>
            </div>
        </div>
    </x-slot>




    <form class="invoice">
        <div class="row g-3">
            <div class="col-md-3 dposition">
                <label for="searchInput">Search</label>
                <i class="ti ti-search"></i>
                <input type="text" id="searchInput" class="form-control form-cs" placeholder="Search">
            </div>

            <div class="col-md-3 dposition">
                <label>By Invoice #ID</label>
                <i class="ti ti-search"></i>
                <input type="text" class="form-control form-cs" placeholder="Enter Invoice #ID">
            </div>
            <div class="col-md-3 dposition">
                <label>Invoice Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                    <input type="text" class="btn-filters form-control bookingrange form-cs info" name="datetrange"
                        placeholder="From Date - To Date" />
                </div>
            </div>


            <div class="col-md-3 dposition">
                <label>By Container</label>
                <i class="ti ti-search"></i>
                <input type="text" class="form-control form-cs" placeholder="Enter Container Seal No.">
            </div>

            <div class="col-md-3">

                <label>By Warehouse</label>
                <select class="js-example-basic-single select2 ">
                    <option selected="selected " class="form-cs">Select Warehouse</option>
                    <option>white</option>
                    <option>purple</option>
                </select>
            </div>

            <div class="col-md-3">
                <label>By Driver</label>
                <select class="js-example-basic-single select2  form-cs">
                    <option selected="selected">Select Drive</option>
                    <option>white</option>
                    <option>purple</option>
                </select>
            </div>


            <div class="col-md-3 dposition">
                <label>By Invoice Item</label>
                <i class="ti ti-search"></i>
                <input type="text" class="form-control form-cs" placeholder="Enter Invoice Item">
            </div>

            <div class="col-md-3 text-end align-content-end">
                <button class="btn px-4 btn-primary me-2">Filter</button>
                <button class="btn px-4 btn-outline-danger">Reset</button>
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
                                    <th>S. No.</th>
                                    <th>Invoice ID</th>
                                    <th>Tracking ID</th>
                                    <th>Seal Number</th>
                                    <th>Item List</th>
                                    <th>Value</th>
                                    <th>Driver Name</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    {{-- <th>Warehouse</th> --}}
                                    <th>Due</th>
                                    <th>Payment Mode</th>
                                    <th>Status</th>
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
                                        <div>#{{ $invoice->invoice_no ?? 'INV-001' }}</div>
                                    </td>
                                    <td>
                                        {{ $invoice->parcel_id ?? '-' }}
                                    </td>
                                    <td>
                                        <div>2E 5777</div>
                                    </td>
                                    <td>
                                        <div>
                                            @foreach($invoice->invoce_item as $item)
                                                {{ $item['supply_name'] ?? '-' }} ({{ $item['qty'] ?? '-' }}), 
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div>$ {{ number_format($invoice->total_price, 2) }}</div>
                                    </td>
                                    <td>
                                        <div>Driver Name</div>
                                    </td>
                                    <td>
                                        <div>
                                            <p>
                                                <i class="fe fe-user"></i>{{ $invoice->pickup_address->full_name ?? '-' }}
                                            </p>
                                            <p>
                                                <i class="fe fe-phone"></i>{{ $invoice->pickup_address->mobile_number ?? '-' }}
                                            </p>
                                            <p>
                                                <i class="fe fe-map-pin"></i>{{ $invoice->pickup_address->address ?? '-' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p>
                                                <i class="fe fe-user"></i>{{ $invoice->delivery_address->full_name ?? '-' }}
                                            </p>
                                            <p>
                                                <i class="fe fe-phone"></i>{{ $invoice->delivery_address->mobile_number ?? '-' }}
                                            </p>
                                            <p>
                                                <i class="fe fe-map-pin"></i>{{ $invoice->delivery_address->address ?? '-' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <span>${{ number_format($invoice->grand_total, 2) }}</span>
                                    </td>
                                    <td>
                                        <span>${{ number_format($invoice->payment, 2) }}</span>
                                    </td>
                                    <td>
                                        <span>${{ number_format($invoice->balance, 2) }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $invoice->invoce_type ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <label class="labelstatus" for="{{ $invoice->status }}">{{ $invoice->status }}</label>
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas " data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('admin.invoices.edit',$invoice->id)}}"><i
                                                                class="far fa-edit me-2"></i>Edit Invoice</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('admin.invoices.details',$invoice->id)}}"><i
                                                                class="far fa-eye me-2"></i>View Invoice</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('admin.invoices.show',$invoice->id)}}"><i
                                                                class="far fa-eye me-2"></i>View Delivery Challans</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="15" class="px-4 py-4 text-center text-gray-500">No invoices found.</td>
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

        const Input_Fields = [{
                id: "pickup-man"
                , label: "Pickup Man"
                , type: "select"
                , options: options
                , required: true
            }
            , {
                id: "note"
                , label: "Note"
                , type: "textarea"
                , required: false
            }
        ];

        let selectedUsers = [];
        $(".selectCheckbox:checked").each(function() {
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

        const Input_Fields = [{
                id: "pickup-man"
                , label: "Pickup Man"
                , type: "select"
                , options: options
                , required: true
            }
            , {
                id: "pickup_date"
                , label: "Pickup Date"
                , type: "date"
                , required: true
            }
            , {
                id: "note"
                , label: "Note"
                , type: "textarea"
                , required: false
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

        const Input_Fields = [{
                id: "warehouse_id"
                , label: "Warehouse"
                , type: "select"
                , options: options
                , required: true
            }
            , {
                id: "note"
                , label: "Note"
                , type: "textarea"
                , required: false
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
        const {
            value: formValues
        } = await Swal.fire({
            title: "Update Status"
            , html: formHtml
            , showCancelButton: true
            , confirmButtonText: "Change"
            , showCloseButton: true
            , preConfirm: () => {
                let formData = {
                    ParcelId: ParcelId
                    , status: status
                    , _token: _token
                };
                let isValid = true;

                // Validate and collect data
                Input_Fields.forEach(field => {
                    let inputValue = document.getElementById(field.id) ? .value.trim() || "";
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
                url: "{{ route('parcel.status_update') }}"
                , type: "POST"
                , data: formValues, // Dynamic data object
                success: function(response) {
                    if (response.status === true) {
                        Swal.fire({
                            title: "Good job!"
                            , text: "Status change successfully!"
                            , icon: "success"
                        }).then(() => {
                            location.reload(); // Page reload after OK click
                        });
                    } else {
                        Swal.fire({
                            title: "Oops..."
                            , text: "Something went to wrong!"
                            , icon: "error"
                        });
                    }
                }
                , error: function(xhr) {
                    Swal.fire('Error!', 'An error occurred while processing your request.', 'error');
                    console.log(xhr.responseJSON);
                }
            });
        }
    }

</script>