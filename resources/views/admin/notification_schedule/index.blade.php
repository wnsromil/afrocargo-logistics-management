<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
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

    <x-slot name="cardTitle" >
       <p class="head">Send Notification List</p>

       <div class="usersearch d-flex usersserach">
        
        <div class="top-nav-search">
            <form>
                <input type="text" class="form-control forms" placeholder="Search ">

            </form>
        </div>
        <div class="mt-2">
        <button type="button" class="btn btn-primary refeshuser " ><a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Refresh"><span><i
                                            class="fe fe-refresh-ccw"></i></span></a></button>
        </div>
    </div>
    </x-slot>


    <div class="d-flex align-items-end justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{ route('admin.notification.create') }}" class="btn btn-primary buttons">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Notification
                    </a>
                </div>
            </div>
        </div>


    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                <th>Sn no.</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Notification For</th>
                                <th>Date/Time</th>
                                <th>Status</th>
                                 <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="alignt">
                                <td>1</td>
                                <td>Notification #41</td>
                                <td>Message Notification #41</td>
                                <td>All</td>
                                <td>02-12-2025 11:40 AM</td>
                                <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}">Active</div></td>
                                <td>  <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div></td>
                            </tr>
                            <tr class="alignt">
                                <td>2</td>
                                <td>Notification #42</td>
                                <td>Message Notification #42</td>
                                <td>Warehouse</td>
                                <td>02-11-2025 11:50 AM</td>
                                <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}"><p>Active</p></div></td>
                                <td>  <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div></td>
                                
                            </tr>
                            <tr class="alignt">
                            <td>3</td>
                            <td>Notification #43</td>
                            <td>Message Notification #43</td>
                            <td>Users</td>
                            <td>02-10-2025 10:40 AM</td>
                            <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}">Active</div></td>
                            <td>  <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div></td>
                            
                        </tr>
                        <tr class="alignt">
                            <td>4</td>
                            <td>Notification #44</td>
                            <td>Message Notification #44</td>
                            <td>Drivers</td>
                            <td>02-09-2025 10:40 AM</td>
                            <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}">Active</div></td>
                            <td>  <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div></td>
                           
                        </tr>
                        <tr class="alignt">
                            <td>5</td>
                            <td>Notification #45</td>
                            <td>Message Notification #45</td>
                            <td>Drivers</td>
                            <td>02-15-2025 11:40 AM</td>
                            <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}">Active</div></td>
                            <td>  <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div></td>
                           
                        </tr>
                        <tr class="alignt">
                            <td>6</td>
                            <td>Notification #46</td>
                            <td>Message Notification #46</td>
                            <td>Warehouse</td>
                            <td>02-14-2025 11:40 AM</td>
                            <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}">Active</div></td>
                            <td>  <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div></td>
                           
                        </tr>
                        <tr class="alignt">
                            <td>7</td>
                            <td>Notification #47</td>
                            <td>Message Notification #47</td>
                            <td>User</td>
                            <td>02-02-2025 11:40 AM</td>
                            <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}">Active</div></td>
                            <td>  <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div></td>
                            
                        </tr>
                        <tr class="alignt">
                            <td>8</td>
                            <td>Notification #48</td>
                            <td>Message Notification #48</td>
                            <td>Drivers</td>
                            <td>02-03-2025 11:40 AM</td>
                            <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}">Active</div></td>
                            <td>  <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div></td>
                            
                        </tr>
                        <tr class="alignt">
                            <td>9</td>
                            <td>Notification #49</td>
                            <td>Message Notification #40</td>
                            <td>Drivers</td>
                            <td>02-14-2025 11:40 PM</td>
                            <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}">Active</div></td>
                            <td>
                            <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div>
                            </td>
                            
                        </tr>
                        <tr class="alignt">
                            <td>10</td>
                            <td>Notification #50</td>
                            <td>Message Notification #50</td>
                            <td>All</td>
                            <td>02-22-2025 10:10 PM</td>
                            <td><div class="container"><img src="{{asset('assets/img/checkbox.png')}}">Active</div></td>
                            <td>
                            <div class="dropdown dropdown-action container">
															<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																</ul>
															</div>
														</div>
                            </td>
                        </tr>
                            <!-- @forelse ($parcels as $index => $parcel)
                                <tr>
                                    {{-- <td><input type="checkbox" class="form-check-input selectCheckbox checkbox-{{ activeStatusKey($parcel->status) }}" value="{{ $parcel->id }}"></td> --}}
                                    <td>{{ ++$index }}</td>
                                    <td>
                                        {{ ucfirst($parcel->tracking_number ?? '-') }}
                                    </td>
                                    <td>
                                        <div>
                                            <p>
                                                <i class="fe fe-user"></i>{{ ucfirst($parcel->customer->name ?? '-') }}
                                            </p>
                                            <p>
                                                <i class="fe fe-phone"></i>{{ $parcel->customer->phone ?? '-' }}
                                            </p>
                                            <p>
                                                <i class="fe fe-map-pin"></i>{{ $parcel->customer->address ?? '-' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p>
                                                <i class="fe fe-user"></i>{{ ucfirst($parcel->destination_user_name ?? '-') }}
                                            </p>
                                            <p>
                                                <i class="fe fe-phone"></i>{{ $parcel->destination_user_phone ?? '-' }}
                                            </p>
                                            <p>
                                                <i class="fe fe-map-pin"></i>{{ $parcel->destination_address ?? '-' }}
                                            </p>
                                        </div>
                                    </td>
                                    {{-- <td>{{ ucfirst($parcel->warehouse->warehouse_name ?? '-') }}</td> --}}
                                    {{-- <td><span>{{ $parcel->weight ?? '-' }}</span></td> --}}
                                    <td>
                                        <div>
                                            <p>
                                                <span class="fw-bold">Partial:</span>
                                                <span>${{ $parcel->partial_payment ?? '-' }}</span>
                                            </p>
                                            <p>
                                                <span class="fw-bold">Due:</span>
                                                <span>${{ $parcel->remaining_payment ?? '-' }}</span>
                                            </p>
                                            <p>
                                                <span class="fw-bold">Total:</span>
                                                <span>${{ $parcel->total_amount ?? '-' }}</span>
                                            </p>
                                        </div>
                                        
                                    </td>
                                    <td><span>{{ ucfirst($parcel->payment_type ?? '-') }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $parcel->pickup_date ? \Carbon\Carbon::parse($parcel->pickup_date)->format('d/m/Y') : '-' }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $parcel->delivery_date ? \Carbon\Carbon::parse($parcel->delivery_date)->format('d/m/Y') : '-' }}</span>
                                    </td>
                                    <td><span
                                            class="badge-{{ activeStatusKey($parcel->status) }}">{{ $parcel->status ?? '-' }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="dropdown">
                                            <span class="dropdown-icon-status" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fas fa-chevron-down"></i>
                                            </span>
                                            <ul class="dropdown-menu">
                                                @if($parcel->status == 'Pending')
                                                    <li>
                                                        <span class="dropdown-item"
                                                            onclick="handlePickupAssign({{ $parcel->id }}, {{ json_encode($drivers) }})">
                                                            <i class="fas fa-truck me-2"></i>Pickup Assign
                                                        </span>
                                                    </li>
                                                @elseif($parcel->status == 'Pickup Assign')
                                                    <li>
                                                        <span class="dropdown-item" onclick="handlePickupCancel({{ $parcel->id }})">
                                                            <i class="fas fa-times-circle me-2"></i>Pickup Cancel
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="dropdown-item" onclick="handlePickupReschedule({{ $parcel->id }}, {{ json_encode($drivers) }})">
                                                            <i class="fas fa-calendar-alt me-2"></i>Pickup Re-Schedule
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="dropdown-item" onclick="handleReceivedByPickupMan({{ $parcel->id }})">
                                                            <i class="fas fa-box-open me-2"></i>Received By Pickup Man
                                                        </span>
                                                    </li>
                                                @elseif($parcel->status == 'Pickup Re-Schedule')
                                                    <li>
                                                        <span class="dropdown-item" onclick="handlePickupReschedule({{ $parcel->id }}, {{ json_encode($drivers) }})">
                                                            <i class="fas fa-calendar-alt me-2"></i>Pickup Re-Schedule
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="dropdown-item" onclick="handleReceivedWarehouse({{ $parcel->id }}, {{json_encode($warehouses)}})">
                                                            <i class="fas fa-warehouse me-2"></i>Received Warehouse
                                                        </span>
                                                    </li>
                                                @elseif($parcel->status == 'Received Warehouse')
                                                    <li>
                                                        <span class="dropdown-item" onclick="handleTransferToHub({{ $parcel->id }}, {{ json_encode($drivers) }})">
                                                            <i class="fas fa-calendar-alt me-2"></i>Transfer To Hub
                                                        </span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>

                                    <td class="align-items-center">
                                        <span class="dropdown-icon-status">
                                            <a href="{{ route('admin.OrderShipment.show', $parcel->id) }}">
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
                                                            href="{{ route('admin.OrderShipment.edit', $parcel->id) }}"><i
                                                                class="far fa-edit me-2"></i>Edit</a>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('admin.OrderShipment.destroy', $parcel->id) }}"
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
                                                            href="{{ route('admin.OrderShipment.show', $parcel->id) }}"><i
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
                            @endforelse -->
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

        if(ParcelId=="selectArr"){
            ParcelId =selectedUsers;
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

    function handleReceivedByPickupMan(ParcelId=false) {
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
        DynmicModel(ParcelId, status, Input_Fields );
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