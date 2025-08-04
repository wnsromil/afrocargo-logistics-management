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
                    {{-- Historical Vehicles --}}
                    @forelse ($container_historys as $container_history)
                        <tr class="historyTR" style="background-color: #e9f7e9;"> {{-- Halka green background
                            --}}
                            <td>{{ $container_history->container->unique_id ?? '-' }} ,
                                {{ $container_history->container->ship_to_country ?? "" }}
                            </td>
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
                                $container_status_name = $container_history->containerStatus->status ?? null;
                                $ClassStatus = $container_history->containerStatus->class_name ?? null;
                            @endphp
                            <td>
                                <label class="{{ $ClassStatus }}" for="status">
                                    {{ $container_status_name ?? '-' }}
                                </label>
                                <br>
                                <label class="badge-delivered" for="status">
                                    {{ ($container_history->warehouse->warehouse_name ?? '') . ' To ' . ($container_history->arrived_warehouse->warehouse_name ?? '') }}
                                </label>
                            </td>

                            <td>---</td> {{-- Dropdowns/history actions skip kar sakte ho agar zarurat nahi --}}
                            <td class="btntext">
                             @can('has-dynamic-permission', 'container_received_history_list.order_details')
                                  <button
                                    onClick="redirectTo('{{route('admin.container.orders.percel.list', [$container_history->id ?? 0, 'Arrived'])}}')"
                                    class=orderbutton><img src="{{ asset('assets/img/ordereye.png') }}"></button>
                                @else
                                    <button style="opacity: 0.6;" class=orderbutton><img
                                            src="{{asset('assets/img/ordereye.png')}}"></button>
                                @endcan
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
                {!! $container_historys->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>