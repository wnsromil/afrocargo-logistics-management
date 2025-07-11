<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Received by Warehouse</p>
    </x-slot>

    {{-- <div class="tabs mw-100">
        <input type="radio" id="tab1" name="tab" checked>
        <input type="radio" id="tab2" name="tab">
        <div class="tab-titles mt-1">
            <label for="tab1" class="tab-title">in transit</label>
            <label for="tab2" class="tab-title">History</label>
        </div> --}}

            @php
            $warehouseIdFromUrl = request()->query('warehouse_id');
            $fromWarehouseIdFromUrl = request()->query('from_warehouse_id');
            $authUser = auth()->user();
        @endphp

        <form id="expenseFilterForm" action="{{ route('admin.received.hub.list') }}" method="GET">
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
                                @forelse ($incoming_containers as $index => $incoming_container)
                                    <tr>
                                        <td>{{ $incoming_container->container->unique_id ?? '-' }}</td>
                                        <td>{{ $incoming_container->transfer_date ?? '-' }}</td>
                                        <td>{{ $incoming_container->container->vehicle_type ?? '-' }}</td>
                                        <td>{{ $incoming_container->container->seal_no ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($incoming_container->open_date)->format('m-d-Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($incoming_container->close_date)->format('m-d-Y') }}
                                        </td>
                                        <td>{{ $incoming_container->no_of_orders ?? 0 }}</td>
                                        <td>{{ $incoming_container->driver->name ?? '-' }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row fw-medium">Partial: </div>
                                                    <div class="row">Due: </div>
                                                    <div class="row">Total: </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        ${{ number_format($incoming_container->partial_payment ?? 0, 2) }}
                                                    </div>
                                                    <div class="row">
                                                        ${{ number_format($incoming_container->remaining_payment ?? 0, 2) }}
                                                    </div>
                                                    <div class="row">
                                                        ${{ number_format($incoming_container->total_amount ?? 0, 2) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @php
                                            $status_class = $incoming_container->status ?? null;
                                            $container_status_name = $incoming_container->containerStatus->status ?? null;

                                            $classValue = match ($status_class) {
                                                '16' => 'badge-ready_to_transfer',
                                                '17' => 'badge-transfer_to_hub',
                                                '5' => 'badge-in-transit',
                                                '20' => 'badge-re-delivery',
                                                '18' => 'badge-re-delivery',
                                                default => 'badge-pending',
                                            };
                                          @endphp

                                        <td>
                                            <label class="{{ $classValue }}" for="status">
                                                {{ $container_status_name ?? '-' }}
                                            </label>
                                            <br>

                                            <label class="badge-delivered" for="status">
                                                {{ $incoming_container->warehouse->warehouse_name . ' To ' . $incoming_container->arrived_warehouse->warehouse_name}}
                                            </label>

                                        </td>
                                        <td>
                                            <li class="nav-item dropdown">
                                                <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                                    data-bs-toggle="dropdown">

                                                    <span class="user-content"
                                                        style="background-color:#203A5F;border-radius:5px;width: 30px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   height: 26px;align-content: center;">
                                                        <div><img src="{{ asset('assets/img/downarrow.png') }}"></div>
                                                    </span>
                                                </a>
                                                @if ($incoming_container->status == 5 || $incoming_container->status == 7 || $incoming_container->status == 18)
                                                    <div class="dropdown-menu menu-drop-user">
                                                        <div class="profilemenu">
                                                            <div class="subscription-menu">
                                                                <ul>
                                                                    @php
                                                                        // Assuming $parcel->parcelStatus->id contains the ID of the current status
                                                                        $currentStatusId =
                                                                            $parcel->parcelStatus->id ?? null;
                                                                    @endphp
                                                                    <li>
                                                                        @if($incoming_container->status == 5)
                                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#received_to_hub"
                                                                                vehicle-id="{{ $incoming_container->container_id }}">Conatiner
                                                                                received by
                                                                                hub</a>
                                                                        @else
                                                                            <a class="dropdown-item text-muted disabled"
                                                                                href="javascript:void(0);">
                                                                                Conatiner
                                                                                received by
                                                                                hub
                                                                            </a>
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        @if($incoming_container->status == 18)
                                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#fullydischargecontainer"
                                                                                vehicle-id="{{ $incoming_container->container_id }}">Full
                                                                                discharge</a>
                                                                        @else
                                                                            <a class="dropdown-item text-muted disabled"
                                                                                href="javascript:void(0);">
                                                                                Full discharge
                                                                            </a>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </li>
                                        </td>
                                        <td class="btntext">
                                            <button
                                                onClick="redirectTo('{{route('admin.container.orders.percel.list', [$incoming_container->id ?? 0, 'Arrived'])}}')"
                                                class=orderbutton><img
                                                    src="{{ asset('assets/img/ordereye.png') }}"></button>
                                        </td>
                                    </tr>
                                    <input type="hidden" id="partial_payment_sum_input_hidden"
                                        name="partial_payment_sum_hidden"
                                        value="{{ $incoming_container->partial_payment_sum ?? '0' }}" class="form-control"
                                        readonly>
                                    <input type="hidden" id="remaining_payment_sum_input_hidden"
                                        name="remaining_payment_sum_hidden"
                                        value="{{ $incoming_container->remaining_payment_sum ?? '0' }}" class="form-control"
                                        readonly>
                                    <input type="hidden" id="total_amount_sum_input_hidden" name="total_amount_sum_hidden"
                                        value="{{ $incoming_container->total_amount_sum ?? '0' }}" class="form-control"
                                        readonly>
                                    <input type="hidden" id="no_of_orders_input_hidden" name="no_of_orders_sum_hidden"
                                        value="{{ $incoming_container->no_of_orders ?? 0 }}" class="form-control" readonly>
                                @empty
                                    <tr>
                                        <td colspan="11" class="px-4 py-4 text-center text-gray-500">No data found.</td>
                                    </tr>
                                @endforelse

                                @if (count($container_historys) > 0)
                                    <tr>
                                        <td colspan="12" class="fw-bold text-start py-3">History</td>
                                    </tr>
                                @endif

                                {{-- Historical Vehicles --}}
                                @foreach ($container_historys as $container_history)
                                    <tr class="historyTR" style="background-color: #e9f7e9;"> {{-- Halka green background
                                        --}}
                                        <td>{{ $container_history->container->unique_id ?? '-' }}</td>
                                        <td>{{ $container_history->transfer_date ?? '-' }}</td>
                                        <td>{{ $container_history->container->vehicle_type ?? '-' }}</td>
                                        <td>{{ $container_history->container->seal_no ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($container_history->container->open_date)->format('m-d-Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($container_history->container->close_date)->format('m-d-Y') }}
                                        </td>
                                        <td>{{ $container_history->no_of_orders ?? 0 }}</td>
                                        <td>{{ $container_history->driver->name ?? '-' }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row fw-medium">Partial: </div>
                                                    <div class="row">Due: </div>
                                                    <div class="row">Total: </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row"> ${{ $container_history->partial_payment ?? '0' }}
                                                    </div>
                                                    <div class="row">
                                                        ${{ $container_history->remaining_payment ?? '0' }}</div>
                                                    <div class="row"> ${{ $container_history->total_amount ?? '0' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        @php
                                            $status_class = $container_history->status ?? null;
                                            $container_status_name = $container_history->containerStatus->status ?? null;

                                            $classValue = match ($status_class) {
                                                '16' => 'badge-ready_to_transfer',
                                                '17' => 'badge-transfer_to_hub',
                                                '19' => 'badge-ready-pickup',
                                                '18' => 'badge-re-delivery',
                                                '5' => 'badge-in-transit',
                                                '20' => 'badge-re-delivery',
                                                default => 'badge-pending',
                                            };
                                        @endphp

                                        <td>
                                            <label class="{{ $classValue }}" for="status">
                                                {{ $container_status_name ?? '-' }}
                                            </label>
                                            <br>
                                            <label class="badge-delivered" for="status">
                                                {{ $container_history->warehouse->warehouse_name . ' To ' . $container_history->arrived_warehouse->warehouse_name }}
                                            </label>
                                        </td>

                                        <td>---</td> {{-- Dropdowns/history actions skip kar sakte ho agar zarurat nahi --}}
                                        <td class="btntext">
                                            <button
                                                onClick="redirectTo('{{route('admin.container.orders.percel.list', [$container_history->id ?? 0, 'Arrived'])}}')"
                                                class=orderbutton><img
                                                    src="{{ asset('assets/img/ordereye.png') }}"></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bottom-user-page mt-3">
                        {{-- {!! $incoming_containers->links('pagination::bootstrap-5') !!} --}}
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="vehicle_id_input_hidden" name="vehicle_id_input_hidden" class="form-control" readonly>

        <div class="modal custom-modal signature-add-modal fade" id="received_to_hub" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header pb-0">
                        <div class="form-header  text-start mb-0">
                            <div class="popuph">
                                <h4>Container Received by Hub</h4>
                            </div>
                        </div>
                        <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('assets/img/cross.png') }}">
                        </button>
                    </div>
                    <form method="POST" id="received_to_hub_form">
                        <div class="modal-body">
                            <div class="row">
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

        <div class="modal custom-modal signature-add-modal fade" id="fullydischargecontainer" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body confirmationpopup">
                        <div class="form-header">

                            <p class="popupc"> Has the container been fully discharged?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <button data-bs-dismiss="modal" type="button"
                                        onclick="updatestatusfullydischargecontainer()"
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

        <script>
            function updatestatusfullydischargecontainer() {
                let vehicleId = $("#vehicle_id_input_hidden").val();

                if (!vehicleId) {
                    alert("Parcel ID is required.");
                    return;
                }
                // Show Loading Indicator
                $(".btn-primary").html("Processing...").prop("disabled", true);

                // Make AJAX POST Request
                $.ajax({
                    url: "/api/update-status-fully-discharge-container", // API endpoint
                    type: "POST",
                    data: {
                        vehicleId: vehicleId,
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                    },
                    success: function (response) {
                        document
                            .querySelector("#fullydischargecontainer .custom-btn")
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
                    window.location.href = "{{ route('admin.received.hub.list') }}";
                }
            </script>


</x-app-layout>