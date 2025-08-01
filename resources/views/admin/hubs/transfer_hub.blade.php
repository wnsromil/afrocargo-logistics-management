<x-app-layout>
    <x-slot name="header">
        {{ __('Transfer to Warehouse') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Transfer to Warehouse</p>
    </x-slot>

    {{-- <div class="tabs mw-100">
        <input type="radio" id="tab1" name="tab" checked>
        <input type="radio" id="tab2" name="tab">
        <div class="tab-titles mt-1">
            <label for="tab1" class="tab-title">Active</label>
            <label for="tab2" class="tab-title">History</label>
        </div> --}}

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

        <div>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover transfertoHub datatable">
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
                                        <td>{{ $vehicle->container->unique_id ?? "-" }}</td>
                                        <td>{{ $vehicle->transfer_date ? \Carbon\Carbon::parse($vehicle->transfer_date)->format('m-d-Y') : '-' }}
                                        </td>
                                        <td>{{ $vehicle->container->vehicle_type ?? "-" }}</td>
                                        <td>{{ $vehicle->container->seal_no ?? "-" }}</td>
                                        <td>{{ $vehicle->open_date ? \Carbon\Carbon::parse($vehicle->open_date)->format('m-d-Y') : '-' }}
                                        </td>
                                        <td>{{ $vehicle->close_date ? \Carbon\Carbon::parse($vehicle->close_date)->format('m-d-Y') : '-' }}
                                        </td>
                                        <td>{{$vehicle->no_of_orders ?? 0}}</td>
                                        <td>{{ $vehicle->driver->name ?? "-" }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row fw-medium">Partial: </div>
                                                    <div class="row">Due: </div>
                                                    <div class="row">Total: </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">${{ number_format($vehicle->partial_payment ?? 0, 2) }}
                                                    </div>
                                                    <div class="row">
                                                        ${{ number_format($vehicle->remaining_payment ?? 0, 2) }}</div>
                                                    <div class="row">${{ number_format($vehicle->total_amount ?? 0, 2) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @php
                                            $status_class = $vehicle->container->container_status ?? null;
                                            $container_status_name = $vehicle->container->containerStatus->status ?? null;

                                            $classValue = match ($status_class) {
                                                "1" => 'new-badge-pending',
                                                "2" => 'new-badge-pickup',
                                                "3" => 'new-badge-picked-up',
                                                "4" => 'new-badge-arrived',
                                                "5" => 'new-badge-in-transit',
                                                "6" => 'new-badge-warehouse-load',
                                                "7" => 'new-badge-discharge',
                                                "8" => 'new-badge-arrived-final',
                                                "9" => 'new-badge-ready-pickup',
                                                "10" => 'new-badge-out-delivery',
                                                "11" => 'new-badge-delivered',
                                                "12" => 'new-badge-redelivery',
                                                "13" => 'new-badge-on-hold',
                                                "14" => 'new-badge-cancelled',
                                                "15" => 'new-badge-abandoned',
                                                "16" => 'new-badge-ready-transfer',
                                                "17" => 'new-badge-transfer-hub',
                                                "18" => 'new-badge-received',
                                                "19" => 'new-badge-hub-arrived',
                                                "20" => 'new-badge-loading',
                                                "21" => 'new-badge-self-pickup',
                                                "22" => 'new-badge-assign-driver',
                                                "23" => 'new-badge-reschedule',
                                                "24" => 'new-badge-hold',
                                                "25" => 'new-badge-gate-in',
                                                "26" => 'new-badge-in-custom-hold',
                                                "27" => 'new-badge-load-vessel',
                                                "28" => 'new-badge-departure',
                                                "29" => 'new-badge-arrived-vessel',
                                                "30" => 'new-badge-discharge-vessel',
                                                "33" => 'new-badge-hold-cleared',
                                                default => 'badge-pending',
                                            };
                                          @endphp

                                        <td>
                                            <label class="{{ $classValue }} new-comman-css" for="status">
                                                {{ $container_status_name ?? '-' }}
                                            </label>
                                            <br>
                                            @if($vehicle->container->container_status == 17 || $vehicle->container->container_status == 24 || $vehicle->container->container_status == 33)
                                                <label class="badge-delivered" for="status">
                                                    {{ ($vehicle->warehouse->warehouse_name ?? '') . ' To ' . ($vehicle->arrived_warehouse->warehouse_name ?? '') }}
                                                </label>
                                            @endif
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
                                                {{-- @if($vehicle->container->container_status == 20 ||
                                                $vehicle->container->container_status == 16) --}}
                                                <div class="dropdown-menu menu-drop-user">
                                                    <div class="profilemenu">
                                                        <div class="subscription-menu">
                                                            <ul>
                                                                <li>
                                                                    @if($vehicle->container->container_status == 20)
                                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#fullyloadedcontainer"
                                                                            vehicle-id="{{ $vehicle->container->id }}"
                                                                            container-history-id="{{ $vehicle->id }}">
                                                                            Container Full load at warehouse
                                                                        </a>
                                                                    @else
                                                                        <a class="dropdown-item text-muted disabled"
                                                                            href="javascript:void(0);">
                                                                            Container Full load at warehouse
                                                                        </a>
                                                                    @endif
                                                                </li>

                                                                <li>
                                                                    @if($vehicle->container->container_status == 16)
                                                                        <a onclick="openTransferModal({{ $vehicle->container->id }}, {{ $vehicle->id }})"
                                                                            class="dropdown-item" href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#transfer_to_hub"
                                                                            vehicle-id="{{ $vehicle->container->id }}"
                                                                            container-history-id="{{ $vehicle->id }}">
                                                                            Transfer to Hub
                                                                        </a>
                                                                    @else
                                                                        <a class="dropdown-item text-muted disabled"
                                                                            href="javascript:void(0);">
                                                                            Transfer to Hub
                                                                        </a>
                                                                    @endif
                                                                </li>

                                                                <li>
                                                                    @if($vehicle->container->container_status == 17)
                                                                        <a onclick="openTransferModal({{ $vehicle->container->id }}, {{ $vehicle->id }})"
                                                                            class="dropdown-item" href="javascript:void(0);"
                                                                            data-bs-toggle="modal" data-bs-target="#Custom_Hold"
                                                                            vehicle-id="{{ $vehicle->container->id }}"
                                                                            container-history-id="{{ $vehicle->id }}">
                                                                            Custom hold
                                                                        </a>
                                                                    @else
                                                                        <a class="dropdown-item text-muted disabled"
                                                                            href="javascript:void(0);">
                                                                            Custom hold
                                                                        </a>
                                                                    @endif
                                                                </li>

                                                                <li>
                                                                    @if($vehicle->container->container_status == 24)
                                                                        <a onclick="openTransferModal({{ $vehicle->container->id }}, {{ $vehicle->id }})"
                                                                            class="dropdown-item" href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#Custom_Cleared"
                                                                            vehicle-id="{{ $vehicle->container->id }}"
                                                                            container-history-id="{{ $vehicle->id }}">
                                                                            Custom cleared
                                                                        </a>
                                                                    @else
                                                                        <a class="dropdown-item text-muted disabled"
                                                                            href="javascript:void(0);">
                                                                            Custom cleared
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- @endif --}}

                                            </li>
                                        </td>
                                        <td class="btntext">
                                            <button
                                                onClick="redirectTo('{{route('admin.container.orders.percel.list', [$vehicle->id ?? 0, 'OnLoading'])}}')"
                                                class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                        </td>
                                    </tr>
                                    <input type="hidden" id="partial_payment_sum_input_hidden"
                                        name="partial_payment_sum_hidden" value="{{$vehicle->partial_payment ?? '0'}}"
                                        class="form-control" readonly>
                                    <input type="hidden" id="remaining_payment_sum_input_hidden"
                                        name="remaining_payment_sum_hidden" value="{{$vehicle->remaining_payment ?? '0'}}"
                                        class="form-control" readonly>
                                    <input type="hidden" id="total_amount_sum_input_hidden" name="total_amount_sum_hidden"
                                        value="{{$vehicle->total_amount ?? '0'}}" class="form-control" readonly>
                                    <input type="hidden" id="no_of_orders_input_hidden" name="no_of_orders_sum_hidden"
                                        value="{{$vehicle->no_of_orders ?? 0}}" class="form-control" readonly>
                                    <input type="hidden" id="containerHistoryId_input_hidden" name="containerHistoryId"
                                        value="{{$vehicle->id ?? 0}}" class="form-control" readonly>
                                @empty
                                    <tr>
                                        <td colspan="11" class="px-4 py-4 text-center text-gray-500">No data found.</td>
                                    </tr>
                                @endforelse

                                @if(count($historyVehicles) > 0)
                                    <tr>
                                        <td colspan="12" class="fw-bold text-start py-3">History</td>
                                    </tr>
                                @endif

                                {{-- Historical Vehicles --}}
                                @foreach ($historyVehicles as $historyVehicle)
                                    <tr class="historyTR" style="background-color: #e9f7e9;"> {{-- Halka green background
                                        --}}
                                        <td>{{ $historyVehicle->container->unique_id ?? "-" }}</td>
                                        <td>{{ $historyVehicle->transfer_date ?? "-" }}</td>
                                        <td>{{ $historyVehicle->container->vehicle_type ?? "-" }}</td>
                                        <td>{{ $historyVehicle->container->seal_no ?? "-" }}</td>
                                        <td>{{ \Carbon\Carbon::parse($historyVehicle->open_date)->format('m-d-Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($historyVehicle->close_date)->format('m-d-Y') }}
                                        </td>
                                        <td>{{ $historyVehicle->no_of_orders ?? 0 }}</td>
                                        <td>{{ $historyVehicle->driver->name ?? "-" }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row fw-medium">Partial: </div>
                                                    <div class="row">Due: </div>
                                                    <div class="row">Total: </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        ${{ number_format($historyVehicle->partial_payment ?? 0, 2) }}</div>
                                                    <div class="row">
                                                        ${{ number_format($historyVehicle->remaining_payment ?? 0, 2) }}
                                                    </div>
                                                    <div class="row">
                                                        ${{ number_format($historyVehicle->total_amount ?? 0, 2) }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        @php
                                            $status_class = $historyVehicle->status ?? null;
                                            $container_status_name = $historyVehicle->containerStatus->status ?? null;

                                            $classValue = match ($status_class) {
                                                "1" => 'new-badge-pending',
                                                "2" => 'new-badge-pickup',
                                                "3" => 'new-badge-picked-up',
                                                "4" => 'new-badge-arrived',
                                                "5" => 'new-badge-in-transit',
                                                "6" => 'new-badge-warehouse-load',
                                                "7" => 'new-badge-discharge',
                                                "8" => 'new-badge-arrived-final',
                                                "9" => 'new-badge-ready-pickup',
                                                "10" => 'new-badge-out-delivery',
                                                "11" => 'new-badge-delivered',
                                                "12" => 'new-badge-redelivery',
                                                "13" => 'new-badge-on-hold',
                                                "14" => 'new-badge-cancelled',
                                                "15" => 'new-badge-abandoned',
                                                "16" => 'new-badge-ready-transfer',
                                                "17" => 'new-badge-transfer-hub',
                                                "18" => 'new-badge-received',
                                                "19" => 'new-badge-hub-arrived',
                                                "20" => 'new-badge-loading',
                                                "21" => 'new-badge-self-pickup',
                                                "22" => 'new-badge-assign-driver',
                                                "23" => 'new-badge-reschedule',
                                                "24" => 'new-badge-hold',
                                                "25" => 'new-badge-gate-in',
                                                "26" => 'new-badge-in-custom-hold',
                                                "27" => 'new-badge-load-vessel',
                                                "28" => 'new-badge-departure',
                                                "29" => 'new-badge-arrived-vessel',
                                                "30" => 'new-badge-discharge-vessel',
                                                "33" => 'new-badge-hold-cleared',
                                                default => 'badge-pending',
                                            };
                                          @endphp

                                        <td>
                                            <label class="{{ $classValue }}" for="status">
                                                {{ $container_status_name ?? '-' }}
                                            </label>
                                            <br>
                                            <label class="badge-delivered" for="status">
                                                {{ ($historyVehicle->warehouse->warehouse_name ?? '') . ' To ' . ($historyVehicle->arrived_warehouse->warehouse_name ?? '') }}
                                            </label>
                                        </td>

                                        <td>---</td> {{-- Dropdowns/history actions skip kar sakte ho agar zarurat nahi --}}
                                        <td class="btntext">
                                            <button
                                                onClick="redirectTo('{{route('admin.container.orders.percel.list', [$historyVehicle->id ?? 0, 'Transfer'])}}')"
                                                class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="bottom-user-page mt-3">
                        {!! $vehicles->links('pagination::bootstrap-5') !!}
                    </div> --}}
                </div>
            </div>
        </div>
        <input type="hidden" id="vehicle_id_input_hidden" name="vehicle_id_hidden" class="form-control" readonly>
        <input type="hidden" id="container_history_id_input_hidden" name="container_history_id_hidden"
            class="form-control" readonly>

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
                                            <input type="text" name="vehicle_no" id="vehicle_no"
                                                class="form-control inp" placeholder="" readonly>
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