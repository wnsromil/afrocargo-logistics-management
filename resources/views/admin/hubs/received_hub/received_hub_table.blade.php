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
                            <td>{{ $vehicle->container->unique_id ?? "-" }} ,
                                {{ $vehicle->container->ship_to_country ?? "" }}
                            </td>
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
                                $container_status_name = $incoming_container->containerStatus->status ?? null;
                                $ClassStatus = $incoming_container->containerStatus->class_name ?? null;
                            @endphp
                            <td>
                                <label class="{{ $ClassStatus }}" for="status">
                                    {{ $container_status_name ?? '-' }}
                                </label>
                                <br>
                                <label class="badge-delivered" for="status">
                                    {{ ($incoming_container->warehouse->warehouse_name ?? '') . ' To ' . ($incoming_container->arrived_warehouse->warehouse_name ?? '') }}
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
                                    @if ($incoming_container->status == 5 || $incoming_container->status == 7 || $incoming_container->status == 18 || $incoming_container->status == 24 || $incoming_container->status == 33)
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
                                                            @if($incoming_container->status == 5 || $incoming_container->status == 33)
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#received_to_hub"
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
                                                                    data-bs-toggle="modal" data-bs-target="#fullydischargecontainer"
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
                                    class=orderbutton><img src="{{ asset('assets/img/ordereye.png') }}"></button>
                            </td>
                        </tr>
                        <input type="hidden" id="partial_payment_sum_input_hidden" name="partial_payment_sum_hidden"
                            value="{{ $incoming_container->partial_payment_sum ?? '0' }}" class="form-control" readonly>
                        <input type="hidden" id="remaining_payment_sum_input_hidden" name="remaining_payment_sum_hidden"
                            value="{{ $incoming_container->remaining_payment_sum ?? '0' }}" class="form-control" readonly>
                        <input type="hidden" id="total_amount_sum_input_hidden" name="total_amount_sum_hidden"
                            value="{{ $incoming_container->total_amount_sum ?? '0' }}" class="form-control" readonly>
                        <input type="hidden" id="no_of_orders_input_hidden" name="no_of_orders_sum_hidden"
                            value="{{ $incoming_container->no_of_orders ?? 0 }}" class="form-control" readonly>
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
                {!! $incoming_containers->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>