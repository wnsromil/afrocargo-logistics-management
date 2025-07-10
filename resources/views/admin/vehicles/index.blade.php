<x-app-layout>
    <x-slot name="header">
        {{ __('Vehicle List') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">All Vehicle</p>

        <div class="d-flex align-items-center justify-content-end mb-1 mtop-20">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{ route('admin.vehicle.create') }}" class="btn btn-primary buttons">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle-plus me-2 text-white"></i>
                            Add Vehicle
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.vehicle.index') }}" method="GET">
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
                            <option value="{{ $warehouse->id }}"
                                {{ $warehouseIdFromUrl == $warehouse->id || old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
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

    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Vehicle ID</th>
                                <th>Vehicle Type</th>
                                <th>Warehouse Name</th>
                                <th>Driver Name</th>
                                <th>Vehicle No</th>
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
                                        {{-- {{ $vehicle->id ?? '-' }} --}}
                                    </td>

                                    <td><span>{{ $vehicle->vehicle_type ?? '-' }}</span></td>
                                    <td>{{ ucfirst($vehicle->warehouse->warehouse_name ?? '') }}</td>
                                    <td>{{ $vehicle->driver->name ?? '-' }}</td>
                                    <td>{{ $vehicle->vehicle_number ?? '-' }}</td>
                                    <td>{{ $vehicle->vehicle_model ?? '-' }}</td>
                                    <td>{{ $vehicle->vehicle_year ?? '-' }}</td>
                                    <td>
                                        <label
                                            class="labelstatus {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}"
                                            for="{{ $vehicle->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                            {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td class="text-center">

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon profileBg"
                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                    class="fas fa-ellipsis-v"></i></a>
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
                                                            <a class="dropdown-item deactivate"
                                                                href="javascript:void(0)" data-id="{{ $vehicle->id }}"
                                                                data-status="Inactive">
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
                            {{-- <tr>
                                <td>1</td>
                                <td>Two Wheeler</td>
                                <td>Location ABC</td>
                                <td>Jelene Largan</td>
                                <td class="tabletext">2E 5777</td>
                                <td>Sedan</td>
                                <td>2000</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />
                                        <p>Active</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Van</td>
                                <td>Location CSA</td>
                                <td>Alysig Tremblett</td>
                                <td class="tabletext">5T 789</td>
                                <td>Truck</td>
                                <td>2025</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/inactive.png')}}" alt="Image" />
                                        <p>Inactive</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Two Wheeler</td>
                                <td>Location QWQ</td>
                                <td>Norma McLarens</td>
                                <td class="tabletext">2E 5777</td>
                                <td>Sedan</td>
                                <td>2025</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />

                                        <p>Active</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Van</td>
                                <td>Location TTT</td>
                                <td>Berting Dominico</td>
                                <td class="tabletext">5T 789</td>
                                <td>Truck</td>
                                <td>2025</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />
                                        <p>Active</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Container</td>
                                <td>Location GGG</td>
                                <td>Amalie McLachlan</td>
                                <td class="tabletext">2E 5777</td>
                                <td>Sedan</td>
                                <td>2025</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />
                                        <p>Active</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Container</td>
                                <td>Location DDD </td>
                                <td>Peterus Simondson</td>
                                <td class="tabletext">5T 789</td>
                                <td>Truck</td>
                                <td>2025</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />
                                        <p>Active</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Two Wheeler</td>
                                <td>Location SSSS</td>
                                <td>Gar Delagnes</td>
                                <td class="tabletext">2E 5777</td>
                                <td>Sedan</td>
                                <td>2025</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />
                                        <p>Active</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Van</td>
                                <td>Location FDFDF</td>
                                <td>Bartlet Rayworth</td>
                                <td class="tabletext">5T 789</td>
                                <td>Truck</td>
                                <td>2025</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />
                                        <p>Active</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Van</td>
                                <td>Location DBGD</td>
                                <td>Saxe Fegres</td>
                                <td class="tabletext">2E 5777</td>
                                <td>Sedan</td>
                                <td>2025</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />
                                        <p>Active</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Container</td>
                                <td>Location WWW</td>
                                <td>Lock Gillbanks</td>
                                <td class="tabletext">5T 789</td>
                                <td>Truck</td>
                                <td>2025</td>
                                <td>
                                    <div class="container">
                                        <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />
                                        <p>Active</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="edit-customer.html"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr> --}}

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
    </div>

    {{-- jqury cdn --}}
    @section('script')
        <script>
            $(document).ready(function() {
                // Delegate click on dynamically updated table
                $('#ajexTable').on('click', '.activate, .deactivate', function() {
                    let id = $(this).data('id');
                    let status = $(this).data('status');

                    $.ajax({
                        url: "{{ route('admin.vehicle.status', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: status
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Status Updated',
                                    text: response.success
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
                window.location.href = "{{ route('admin.vehicle.index') }}";
            }
        </script>
    @endsection

</x-app-layout>
