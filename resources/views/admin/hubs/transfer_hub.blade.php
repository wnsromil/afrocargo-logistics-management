<x-app-layout>
    <x-slot name="header">
        {{ __('Transfer to Warehouse') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Transfer to Warehouse</p>

        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control forms" placeholder="Search ">

                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters"
                        href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a></button>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Container ID</th>
                                <th>Transfer date</th>
                                <th>Vehicle Type</th>
                                <th>Seal Number</th>
                                <th>Open Date</th>
                                <th>Close Date</th>
                                <th>No. of orders</th>
                                <th>Driver Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Status Update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicles as $index => $vehicle)
                                                        <tr>
                                                            <td>{{ $vehicle->unique_id ?? "-" }}</td>
                                                            <td>---</td>
                                                            <td>{{ $vehicle->vehicle_type ?? "-" }}</td>
                                                            <td>{{ $vehicle->seal_no ?? "-" }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($vehicle->open_date)->format('m-d-Y') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($vehicle->close_date)->format('m-d-Y') }}</td>
                                                            <td>{{$vehicle->parcelsCount->first()->count ?? 0}}</td>
                                                            <td>{{ $vehicle->driver->name ?? "-" }}</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="row fw-medium">Partial: </div>
                                                                        <div class="row">Due: </div>
                                                                        <div class="row">Total: </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="row"> ${{ $vehicle->partial_payment_sum ?? '0' }}</div>
                                                                        <div class="row"> ${{ $vehicle->remaining_payment_sum ?? '0' }}</div>
                                                                        <div class="row"> ${{ $vehicle->total_amount_sum ?? '0' }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @php
                                                                $status = $vehicle->containerStatus->status ?? null;

                                                                $classValue = match ($status) {
                                                                    'Ready to transfer' => 'badge-ready_to_transfer',
                                                                    'Transfer to Hub' => 'badge-transfer_to_hub',
                                                                    'In transit' => 'badge-in-transit',
                                                                    default => 'badge-pending',
                                                                };
                                                            @endphp

                                                            <td>
                                                                <label class="{{ $classValue }}" for="status">
                                                                    {{ $status ?? '-' }}
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <li class="nav-item dropdown">
                                                                    <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                                                        data-bs-toggle="dropdown">

                                                                        <span class="user-content"
                                                                            style="background-color:#203A5F;border-radius:5px;width: 30px;
                                                                                                                                                                                                                               height: 26px;align-content: center;">
                                                                            <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                                                                        </span>
                                                                    </a>
                                                                    <div class="dropdown-menu menu-drop-user">
                                                                        <div class="profilemenu">
                                                                            <div class="subscription-menu">
                                                                                <ul>
                                                                                    @php
                                                                                        // Assuming $parcel->parcelStatus->id contains the ID of the current status
                                                                                        $currentStatusId = $parcel->parcelStatus->id ?? null;
                                                                                    @endphp

                                                                                    <li>
                                                                                        <a onclick="{{ $currentStatusId != 16 ? 'openTransferModal(' . $vehicle->id . ')' : '' }}"
                                                                                            class="dropdown-item" href="javascript:void(0);"
                                                                                            data-bs-toggle="modal" data-bs-target="#transfer_to_hub"
                                                                                            vehicle-id="{{ $vehicle->id }}">Transfer to Hub</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </td>
                                                            <td class="d-flex align-items-center">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul>
                                                                            <li>
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('admin.hubs.show', $vehicle->id) }}"><i
                                                                                        class="far fa-eye me-2"></i>View Parcels</a>
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

                <div class="bottom-user-page mt-3">
                    {!! $vehicles->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="vehicle_id_input_hidden" name="vehicle_id_hidden" class="form-control" readonly>
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
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                      
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">To Warehouse<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2"  name="to_warehouse_id" id="to_warehouse_id">
                                            <option selected="selected">Select Warehouse</option>
                                            <option >5646466</option>
                                            <option >5646466</option>
                                        </select>
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
    <script>
        function openTransferModal(vehicleId) {
            // $.ajax({
            //     url: "/api/fetch-transfer-to-hub-data",
            //     type: "POST",
            //     data: { vehicleId: vehicleId },
            //     headers: {
            //         "X-CSRF-TOKEN": "{{ csrf_token() }}"
            //     },
            //     success: function (response) {
            //         // Fill from_warehouse_id
            //         $('input[name="from_warehouse_id"]').val(response.vehicle.warehouse.warehouse_name);
        
            //         // Fill vehicle number
            //         $('input[name="vehicle_no"]').val(response.vehicle.vehicle_number);
        
            //         // Populate to_warehouse_id dropdown
            //         let warehouseDropdown = $('select[name="to_warehouse_id"]');
            //         warehouseDropdown.empty().append('<option value="">Select Warehouse</option>');
            //         response.warehouses.forEach(function (warehouse) {
            //             warehouseDropdown.append(
            //                 `<option value="${warehouse.id}">${warehouse.warehouse_name}</option>`
            //             );
            //         });
        
            //         // Populate delivery man dropdown
            //         let deliveryDropdown = $('select[name="delivery_man"]');
            //         deliveryDropdown.empty().append('<option value="">Select Delivery Man</option>');
            //         response.drivers.forEach(function (driver) {
            //             deliveryDropdown.append(
            //                 `<option value="${driver.id}">${driver.name}</option>`
            //             );
            //         });
            //     },
            //     error: function (xhr) {
            //         alert("Something went wrong while fetching data.");
            //         console.error(xhr.responseText);
            //     }
            // });
        }
        </script>
        
</x-app-layout>