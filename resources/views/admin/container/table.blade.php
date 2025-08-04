<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">

            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Container ID</th>
                        <th>Warehouse</th>
                        <th>Container</th>
                        <th>Container Status</th>
                        <th>Open Date</th>
                        <th>Close Date</th>
                        <th>Close Invoice</th>
                        <th>Close Warehouse</th>
                        <th>Volume</th>
                        <th>Total Billed</th>
                        <th>Total Collected</th>
                        <th>Total Balance</th>
                        <th>Status</th>
                        <th>Status Change</th>
                        <th Class="no-sort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vehicles as $index => $vehicle)
                        <tr>
                            <td>
                                {{ $vehicle->unique_id ?? '-' }}
                                {{ $vehicle->ship_to_country ? ', ' . $vehicle->ship_to_country : ''}}
                            </td>
                            <td>{{ ucfirst($vehicle->warehouse->warehouse_name ?? '') }}</td>
                            <td>{{ $vehicle->container_no_1 ?? '-' }}</td>
                            @php
                                $statusId = (string) ($vehicle->container_status ?? '');
                                $vehicleStatus = $vehicle->containerStatus->status ?? 'New';
                                 $ClassStatus = $vehicle->containerStatus->class_name ?? "new-badge-pending new-comman-css";
                            @endphp

                            <td>
                                <label class="{{ $ClassStatus }}">
                                    {{ $vehicleStatus ?? 'New' }}
                                </label>
                            </td>

                            <td>{{ $vehicle->open_date ? \Carbon\Carbon::parse($vehicle->open_date)->format('m-d-Y') : '-' }}
                            </td>
                            <td>{{ $vehicle->close_date ? \Carbon\Carbon::parse($vehicle->close_date)->format('m-d-Y') : '-' }}
                            </td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td>{{ ucfirst($vehicle->volume ?? '-') }}</td>
                            <td>${{number_format(0)}}</td>
                            <td>${{number_format(0)}}</td>
                            <td>${{number_format(0)}}</td>
                            <td>
                                <label class="labelstatus {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}"
                                    for="{{ $vehicle->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                    {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}
                                </label>
                            </td>
                            <td>
                                <div class="status-toggle toggles togglep">
                                    <input
                                        onclick="handleContainerClick('{{ $vehicle->id }}', '{{ $vehicle->container_no_1 }}', '{{ $vehicle->warehouse_id }}')"
                                        id="rating_{{$vehicle->id}}" class="check" type="checkbox"
                                        value="{{$vehicle->status}}" {{$vehicle->status == 'Active' ? 'checked' : '' }}>
                                    <label for="rating_{{$vehicle->id}}"
                                        class="checktoggle log checkbox-bg">checkbox</label>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                             @can('has-dynamic-permission', 'container_list.edit')
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.container.edit', $vehicle->id)}}"><i
                                                        class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            @endcan
                                            @can('has-dynamic-permission', 'container_list.show')
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.container.show', $vehicle->id) }}"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                            </li>
                                             @endcan
                                            @can('has-dynamic-permission', 'container_list.in_time')
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#In_time_model" href="javascript:void(0);"
                                                    onclick="setContainerId({{ $vehicle->id }})">
                                                    <i class="fa-solid fa-truck fa-flip-horizontal me-2"></i>Container
                                                    In Time
                                                </a>
                                            </li>
                                            @endcan
                                            @can('has-dynamic-permission', 'container_list.out_time')
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#Out_time_model" href="javascript:void(0);"
                                                    onclick="setContainerId({{ $vehicle->id }})">
                                                    <i class="fa-solid fa-truck me-2"></i>Container
                                                    Out Time
                                                </a>
                                            </li>
                                            @endcan
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