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
                            <td>{{ $vehicle->container->unique_id ?? "-" }} ,
                                {{ $vehicle->container->ship_to_country ?? "" }}
                            </td>
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
                                $container_status_name = $vehicle->containerStatus->status ?? null;
                                $ClassStatus = $vehicle->containerStatus->class_name ?? null;
                            @endphp
                            <td>
                                <label class="{{ $ClassStatus }}" for="status">
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
                                  <a class="amargin user-link nav-link" href="javascript:void(0)"
                                        @can('has-dynamic-permission', 'transfer_to_hub_list.order_status') data-bs-toggle="dropdown"
                                        @endcan>
                                        <span class="user-content droparrow droparrow"  @cannot('has-dynamic-permission', 'transfer_to_hub_list.order_status')
                                                    style="opacity: 0.6;" @endcannot>
                                            <div>
                                                <img src="{{ asset('assets/img/downarrow.png') }}">
                                            </div>
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
                                                                data-bs-toggle="modal" data-bs-target="#fullyloadedcontainer"
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
                                                                data-bs-toggle="modal" data-bs-target="#transfer_to_hub"
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
                                                                data-bs-toggle="modal" data-bs-target="#Custom_Cleared"
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
                                @can('has-dynamic-permission', 'transfer_to_hub_list.order_details')
                                <button
                                onClick="redirectTo('{{route('admin.container.orders.percel.list', [$vehicle->id ?? 0, 'OnLoading'])}}')"
                                class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                    @else
                                <button
                                style="opacity: 0.6;"
                                class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                @endcan                         
                            </td>
                        </tr>
                        <input type="hidden" id="partial_payment_sum_input_hidden" name="partial_payment_sum_hidden"
                            value="{{$vehicle->partial_payment ?? '0'}}" class="form-control" readonly>
                        <input type="hidden" id="remaining_payment_sum_input_hidden" name="remaining_payment_sum_hidden"
                            value="{{$vehicle->remaining_payment ?? '0'}}" class="form-control" readonly>
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