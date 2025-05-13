<x-app-layout>
    <x-slot name="header">
        {{ __('Role Management') }}
    </x-slot>

    <!-- <x-slot name="cardTitle">
        All Parcels
        
        {{-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <p style="text-align: center;">
                        <span class="isSelected d-none">     
                            <button class="btn btn-primary" onclick="handlePickupAssign('selectArr', {{ json_encode($drivers) }},'{{ activeStatusKey('Pickup Assign')}}')">
                                <i class="fas fa-truck me-2"></i>Pickup Assign
                            </button>
                            <button class="btn btn-danger" onclick="handlePickupCancel([],,{{ activeStatusKey('Pickup Cancel') }})">
                                <i class="fas fa-times-circle me-2"></i>Pickup Cancel
                            </button>
                            
                            <button class="btn btn-warning" onclick="handlePickupReschedule([], {{ json_encode($drivers) }},{{ activeStatusKey('Pickup Cancel') }})">
                                <i class="fas fa-calendar-alt me-2"></i>Pickup Re-Schedule
                            </button>
                            <button class="btn btn-info" onclick="handleReceivedWarehouse([], {{json_encode($warehouses)}},{{ activeStatusKey('Pickup Cancel') }})">
                                <i class="fas fa-warehouse me-2"></i>Received Warehouse
                            </button>
                        </span>
                        <a href="{{route('admin.OrderShipment.create')}}" class="btn btn-primary">
                            Add Parcel
                        </a>
                    </p>
                </div>
            </div>

        </div> --}}

    </x-slot> -->

    <x-slot name="cardTitle">
        <div class="d-flex topnavs justify-content-between">
            <p class="head">Role Management</p>
            <a href="{{ route('admin.user_role.create') }}" class="btn btn-primary buttons">
                <i class="ti ti-circle-plus me-2 text-white"></i>
                Add Roles
            </a>
        </div>
    </x-slot>

    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex align-items-center w-auto mb-3">
                            <label for="searchbyPermission" class="col3a fw_600 mb-0 col-md-5">Search By Permission </label>
                            <select name="searchbyPermission" class="form-control inp select2 ">
                                <option value="" disabled hidden selected>Select Permission </option>
                                <option>Accounting Report</option>
                                <option>Invoice Report</option>
                                <option>Administration</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S No.</th>
                                <th>Role Name</th>
                                <th>Created Date</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start">1</td>
                                <td>Driver</td>
                                <td>02-15-2025</td>
                                <td class="text-end">
                                    <div class="dropdown dropdown-action container justify-content-end">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href=""><i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start">2</td>
                                <td>Warehouse Manager</td>
                                <td>03-15-2025</td>
                                <td class="text-end">
                                    <div class="dropdown dropdown-action container justify-content-end">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href=""><i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bottom-user-page mt-3">
                    {!! $parcels->links('pagination::bootstrap-5') !!}
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
