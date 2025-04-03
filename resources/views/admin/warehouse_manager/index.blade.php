<x-app-layout>
    <x-slot name="header">
        {{ __('Warehouse Managers') }}
    </x-slot>








    <x-slot name="cardTitle">
        <div class="d-flex topnavs">
            <p class="head">All Warehouse Managers</p>
            <div class="usersearch d-flex usersserach">
                <div class="top-nav-search">
                    <form>
                        <input id="searchInput" type="text" class="form-control forms" placeholder="Search ">
                    </form>
                </div>

                <div class="mt-2">
                    <button type="button"
                        class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                        <a class="btn-filters d-flex justify-content-center align-items-center"
                            href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Refresh">
                            <span><i class="fe fe-refresh-ccw"></i></span>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.warehouse_manager.create') }}" class="btn btn-primary buttons">
                    <img class="imgs" src="assets/images/Vector.png">
                    Add Manager
                </a>
            </div>
        </div>
    </div>
    <div id='ajexTable'>

        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
                                <th>Manager Name</th>
                                <th>Warehouse Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($warehouses as $index => $warehouse)
                            <tr>
                                <td>
                                    {{ ++$index }}
                                </td>
                                <td><span>{{$warehouse->name ?? '-'}}</span></td>
                                <td>{{ ucfirst($warehouse->warehouse->warehouse_name ?? '')}}</td>
                                <td>{{$warehouse->email ?? '-'}}</td>
                                <td>{{$warehouse->address ?? '-'}}</td>
                                <td>{{$warehouse->phone ?? '-'}}</td>
                                <td>
                                    @if ($warehouse->status == 'Active')
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    @else
                                        <div class="container">
                                            <img src="../assets/img/inactive.png" alt="Image" />
                                            <p>Inactive</p>
                                        </div>
                                    @endif
                                </td>

                                <td class="d-flex align-items-center">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{route('admin.warehouse_manager.edit', $warehouse->id)}}"><i
                                                            class="far fa-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{route('admin.warehouse_manager.show', $warehouse->id)}}"><i
                                                            class="far fa-eye me-2"></i>View</a>
                                                </li>
                                                <!-- <li>
                                                    <a class="dropdown-item" href="active-customers.html"><i
                                                            class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="deactive-customers.html"><i
                                                            class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No manager found.</td>
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
                <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example" id="pageSizeSelect">
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
                        {!! $warehouses->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>