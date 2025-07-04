<x-app-layout>
    <x-slot name="header">
        {{ __('Warehouse') }}
    </x-slot>

    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.warehouses.create') }}" class="btn btn-primary buttons">
                    <i class="ti ti-circle-plus me-2 text-white"></i>
                    Add Warehouse
                </a>
            </div>
        </div>
    </div>






    <x-slot name="cardTitle">
        <div class="d-flex topnavs">
            <p class="head">All Warehouses</p>
            <div class="usersearch d-flex usersserach">
                <div class="top-nav-search">
                    <form>
                        <input type="text" id="searchInput" class="form-control forms" placeholder="Search" name="search" value="{{ request()->search }}">
                    </form>
                </div>

                <div class="mt-2">
                    <button type="button" class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                        <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                            <span><i class="fe fe-refresh-ccw"></i></span>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </x-slot>
    <div id='ajexTable'>

        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Warehouse ID</th>
                                <th>Warehouse Name</th>
                                <th>Warehouse Code</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip Code</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($warehouses as $index => $warehouse)
                            <tr>
                                <td>
                                    {{ $warehouse->unique_id ?? '-' }}
                                </td>
                                <td>{{ ucfirst($warehouse->warehouse_name ?? '') }}</td>
                                <td><span>{{ $warehouse->warehouse_code ?? '-' }}</span></td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $warehouse->address ?? '-' }}">{{ $warehouse->address ?? '-' }}</p>
                                </td>
                                <td>{{ $warehouse->city_id ?? '-' }}</td>
                                <td>{{ $warehouse->state_id ?? '-' }}</td>
                                <td>{{ $warehouse->country_id ?? '-' }}</td>
                                <td>{{ $warehouse->zip_code ?? '-' }}</td>
                                <td>+{{ $warehouse->phone_code->phonecode ?? '' }} {{ $warehouse->phone ?? '-' }}</td>
                                <td>
                                    <label class="labelstatus {{ $warehouse->status == 'Active' ? 'Active' : 'Inactive' }}" for="{{ $warehouse->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                        {{ $warehouse->status == 'Active' ? 'Active' : 'Inactive' }}
                                    </label>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.warehouses.edit', $warehouse->id) . '?page=' . request()->page ?? 1 }}"><i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.warehouses.show', $warehouse->id) }}"><i class="far fa-eye me-2"></i>View</a>
                                                </li>
                                                @if($warehouse->status == 'Active')
                                                <li>
                                                    <a class="dropdown-item deactivate" href="javascript:void(0)" data-id="{{ $warehouse->id }}" data-status="Inactive">
                                                        <i class="far fa-bell-slash me-2"></i>Deactivate
                                                    </a>
                                                </li>
                                                @elseif($warehouse->status == 'Inactive')
                                                <li>
                                                    <a class="dropdown-item activate" href="javascript:void(0)" data-id="{{ $warehouse->id }}" data-status="Active">
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
                                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                            </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
        <x-pagination-toolbar 
            :pagination="$warehouses" 
            :perPageOptions="[5, 10, 25, 50]" 
            defaultPerPage="10" 
            queryKey="per_page" 
        />

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Delegate click on dynamically updated table
            $('#ajexTable').on('click', '.activate, .deactivate', function() {
                let id = $(this).data('id');
                let status = $(this).data('status');

                $.ajax({
                    url: "{{ route('admin.warehouses.status', '') }}/" + id
                    , type: 'POST'
                    , data: {
                        _token: '{{ csrf_token() }}'
                        , status: status
                    }
                    , success: function(response) {
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
</x-app-layout>
