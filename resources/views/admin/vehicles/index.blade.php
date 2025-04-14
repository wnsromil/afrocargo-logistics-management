<x-app-layout>
    <x-slot name="header">
        {{ __('Vehicle List') }}
    </x-slot>


    <div class="d-flex align-items-center justify-content-end mb-1">
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




    {{-- <x-slot name="cardTitle">
        <p class="head">All Vehicle</p>

        <div class="usersearch d-flex">
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
    </x-slot> --}}




    <x-slot name="cardTitle">
        <p class="head">All Vehicle</p>
        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form action="{{ url()->current() }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control forms" placeholder="Search" id="searchInput"
                            name="search" value="{{ request()->search }}">
                        {{-- <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button> --}}
                    </div>
                </form>
            </div>
            <div class="mt-2">
                <button type="button"
                    class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                    <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                        <span><i class="fe fe-refresh-ccw"></i></span>
                    </a>
                </button>
            </div>
        </div>
        <!-- <div class="usersearch d-flex">
            <div class="top-nav-search">
                <form action="{{ url()->current() }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control forms" placeholder="Search" id="search"
                            name="search" value="{{ request()->search }}">
                        {{-- <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button> --}}
                    </div>
                </form>
            </div>
            <div class="mt-2 ms-2">
                <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters"
                        href="{{ route('admin.vehicle.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a></button>
            </div>
        </div> -->
    </x-slot>


    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
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
                                <tr>
                                    <td>
                                        {{ $serialStart + $index + 1 }}
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
                                                <img src="{{asset('assets/img/checkbox.png')}}" alt="Image" />
                                                <p>Active</p>
                                            </div>
                                        @else
                                            <div class="container">
                                                <img src="{{asset('assets/img/inactive.png')}}" alt="Image" />
                                                <p>Inactive</p>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="d-flex align-items-center">

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon profileBg" data-bs-toggle="dropdown"
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
                                                    @if($vehicle->status == 'Active')
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function () {
                // Delegate click on dynamically updated table
                $('#ajexTable').on('click', '.activate, .deactivate', function () {
            let id = $(this).data('id');
            let status = $(this).data('status');

            $.ajax({
                url: "{{ route('admin.vehicle.status', '') }}/" + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function (response) {
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
</x-app-layout>