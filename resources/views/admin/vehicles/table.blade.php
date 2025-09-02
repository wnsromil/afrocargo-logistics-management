<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">

            <table class="table table-stripped table-hover datatable vehicleTable">
                <thead class="thead-light">
                    <tr>
                        <th>Vehicle ID</th>
                        <th>Vehicle Type</th>
                        <th>Warehouse Name</th>
                        <th>Driver Name</th>
                        <th>Vehicle</th>
                        <th>Vehicle Model</th>
                        <th>Vehicle Year</th>
                        <th class="tabletext">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vehicles as $index => $vehicle)
                        @php
                            $result = checkVehicleExpiryStatus(
                                $vehicle->licence_plate_exp_date,
                                $vehicle->vehicle_registration_exp_date,
                                $vehicle->vehicle_insurance_exp_date,
                            );
                        @endphp

                        <tr class="{{ collect($result)->firstWhere('bg_class')['bg_class'] ?? '' }}">
                            <td>
                                {{ $vehicle->unique_id ?? '-' }}
                            </td>

                            <td><span>{{ $vehicle->vehicle_type ?? '-' }}</span></td>
                            <td>{{ ucfirst($vehicle->warehouse->warehouse_name ?? '') }}</td>
                            <td>{{ $vehicle->driver->name ?? '-' }}</td>
                            <td>{{ $vehicle->vehicle_number ?? '-' }}</td>
                            <td>{{ $vehicle->vehicle_model ?? '-' }}</td>
                            <td>{{ $vehicle->vehicle_year ?? '-' }}</td>
                            <td>
                                @if ($vehicle->status == 'Active')
                                    <div class="container">
                                        <img src="{{ asset('assets/img/checkbox.png') }}" alt="Image" />
                                        <p>Active</p>
                                    </div>
                                @else
                                    <div class="container">
                                        <img src="{{ asset('assets/img/inactive.png') }}" alt="Image" />
                                        <p>Inactive</p>
                                    </div>
                                @endif
                            </td>
                            <td class="">

                                <div class="dropdown dropdown-action">
                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.vehicle.edit', $vehicle->id) }}"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.vehicle.show', $vehicle->id) }}"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                            </li>
                                            @if ($vehicle->status == 'Active')
                                                <li>
                                                    <a class="dropdown-item deactivate" href="javascript:void(0)"
                                                        data-id="{{ $vehicle->id }}" data-status="Inactive">
                                                        <i class="far fa-bell-slash me-2"></i>Deactivate
                                                    </a>
                                                </li>
                                            @elseif($vehicle->status == 'Inactive')
                                                <li>
                                                    <a class="dropdown-item activate" href="javascript:void(0)"
                                                        data-id="{{ $vehicle->id }}" data-status="Active">
                                                        <i class="fa-solid fa-power-off me-2"></i>Activate
                                                    </a>
                                                </li>
                                            @endif

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
