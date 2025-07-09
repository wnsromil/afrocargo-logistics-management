<x-app-layout>
    <x-slot name="header">
        {{ __('Driver Management') }}
    </x-slot>
    <div class="d-flex align-items-center justify-content-end mt-n4">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{route('admin.drivers.create')}}" class="btn btn-primary buttons">
                    <i class="ti ti-circle-plus me-2 text-white"></i>
                    Add Driver
                </a>
            </div>
        </div>
    </div>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.drivers.index') }}" method="GET">
        <div class="row gx-3 inputheight40">
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
                <label>By Warehouse</label>
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

            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div id='ajexTable'>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive mt-3">

                        <table class="table table-stripped table-hover datatable driverTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Driver ID</th>
                                    <th>Warehouse Name</th>
                                    <th>Driver Name</th>
                                    <th>Phone</th>
                                    <th>Vehicle Info</th>
                                    <th>Address</th>
                                    <th>License Number</th>
                                    <th>License Expiry Date</th>
                                    <th>License Doc</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($drivers as $index => $driver)
                                                                @php
                                                                    $result = checkExpiryStatus($driver->license_expiry_date);
                                                                @endphp

                                                                <tr class="{{ $result['bg_class'] ?? '' }}">
                                                                    <td>
                                                                        {{ $driver->unique_id }}
                                                                    </td>
                                                                    <td>{{ ucfirst($driver->warehouse->warehouse_name ?? '--') }}</td>
                                                                    <td><span>{{ ucfirst($driver->name ?? '--') }}</span></td>
                                                                    <td>+{{ $driver->phone_code->phonecode ?? '' }} {{ $driver->phone ?? '-' }}
                                                                    </td>
                                                                    <td>
                                                                    @if($driver->vehicle)
                                                                        <span>{{ $driver->vehicle->vehicle_type ?? 'N/A' }}</span>
                                                                        <span>(
                                                                            {{
                                                                                $driver->vehicle->vehicle_type === 'Container'
                                                                                    ? ($driver->vehicle->container_no_1 ?? 'N/A')
                                                                                    : ($driver->vehicle->vehicle_number ?? 'N/A')
                                                                            }}
                                                                        )</span>
                                                                    @else
                                                                        <span>N/A</span>
                                                                    @endif
                                                                    </td>
                                                                    <td>
                                                                        <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="{{ $driver->address ?? '-' }}">{{ $driver->address ?? '-' }}
                                                                    </td>
                                                                    <td>{{ $driver->license_number ?? '--' }}</td>
                                                                    <td>{{ $driver->license_expiry_date ?? '--' }}</td>
                                                                    <td>
                                                                        @if (!empty($driver->license_document))
                                                                            <a href="{{ asset($driver->license_document) }}" target="_blank"
                                                                                class="justify-content-center downloadbtn" download>
                                                                                <i class="fa fa-download"></i>
                                                                            </a>
                                                                        @else
                                                                            <p class="text-center">--</p>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-primary icon_btn"
                                                                            href="{{ route('admin.drivers.schedule', $driver->id) }}">
                                                                            <i class="ti ti-calendar-clock"></i></a>
                                                                    </td>
                                                                    <td>
                                                                        <label
                                                                            class="labelstatus {{ $driver->status == 'Active' ? 'Active' : 'Inactive' }}"
                                                                            for="{{ $driver->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                                                            {{ $driver->status == 'Active' ? 'Active' : 'Inactive' }}
                                                                        </label>
                                                                    </td>
                                                                    <td class="d-flex align-items-center">
                                                                        {{-- <a href="add-invoice.html" class="btn btn-greys me-2"><i
                                                                                class="fa fa-plus-circle me-1"></i> Invoice</a>
                                                                        <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                                                                class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                                                        <div class="dropdown dropdown-action">
                                                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul>
                                                                                    <li>
                                                                                        <a class="dropdown-item"
                                                                                            href="{{ route('admin.drivers.edit', $driver->id) }}"><i
                                                                                                class="far fa-edit me-2"></i>Edit</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a class="dropdown-item"
                                                                                            href="{{ route('admin.drivers.show', $driver->id) }}"><i
                                                                                                class="far fa-eye me-2"></i>View</a>
                                                                                    </li>
                                                                                    @if($driver->status == 'Active')
                                                                                        <li>
                                                                                            <a class="dropdown-item deactivate" href="javascript:void(0)"
                                                                                                data-id="{{ $driver->id }}" data-status="Inactive">
                                                                                                <i class="far fa-bell-slash me-2"></i>Deactivate
                                                                                            </a>
                                                                                        </li>
                                                                                    @elseif($driver->status == 'Inactive')
                                                                                        <li>
                                                                                            <a class="dropdown-item activate" href="javascript:void(0)"
                                                                                                data-id="{{ $driver->id }}" data-status="Active">
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
                                        <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
                                        </td>
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
                            {!! $drivers->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @section("script")
            <script>
                $(document).ready(function () {
                    // Delegate click on dynamically updated table
                    $('#ajexTable').on('click', '.activate, .deactivate', function () {
                        let id = $(this).data('id');
                        let status = $(this).data('status');

                        $.ajax({
                            url: "{{ route('admin.drivers.status', '') }}/" + id
                            , type: 'POST'
                            , data: {
                                _token: '{{ csrf_token() }}'
                                , status: status
                            }
                            , success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success'
                                        , title: 'Status Updated'
                                        , text: response.success
                                    });

                                    location.reload();
                                }
                            }
                        });
                    });
                });
            </script>
            <script>
                function resetForm() {
                    window.location.href = "{{ route('admin.drivers.index') }}";
                }
            </script>
        @endsection
    </div>

</x-app-layout>
