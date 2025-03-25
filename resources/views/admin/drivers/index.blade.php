<x-app-layout>
    <x-slot name="header">
        {{ __('Driver Management') }}
    </x-slot>

    <x-slot name="cardTitle">

        <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{route('admin.drivers.create')}}" class="btn btn-primary buttons"
                    >
                    <i class="ti ti-circle-plus me-2 text-white"></i>  
                    Add Driver
                    </a>
                </div>
            </div>
        </div>

        <x-slot name="cardTitle">
            <p class="head">All Driver</p>

            <div class="usersearch d-flex usersserach">
        
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
        <div class="mt-2">
        <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters"
                            href="{{ route('admin.drivers.index') }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Refresh"><span><i
                                    class="fe fe-refresh-ccw"></i></span></a></button>
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
                            href="{{ route('admin.drivers.index') }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Refresh"><span><i
                                    class="fe fe-refresh-ccw"></i></span></a></button>
                </div>
        </div> -->
    </x-slot>
    
    
   

    <div>
        <div>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive mt-3">

                        <table class="table table-stripped table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sn no.</th>
                                    <th>Warehouse Name</th>
                                    <th>Driver Name</th>
                                    <th>Phone</th>
                                    <th>Vehicle Info</th>
                                    <th>Address</th>
                                    <th>License Number</th>
                                    <th>License Expiry Date</th>
                                    <th>License Doc</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($warehouses as $index => $warehouse)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ ucfirst($warehouse->warehouse->warehouse_name ?? '--') }}</td>
                                        <td><span>{{ ucfirst($warehouse->name ?? '--') }}</span></td>
                                        <td>{{ $warehouse->phone ?? '--' }}</td>
                                        <td>
                                            <span>{{ $warehouse->vehicle->vehicle_type ?? '--' }}</span>
                                            <span> ({{ $warehouse->vehicle->vehicle_number ?? '--' }})</span>
                                        </td>
                                        <td>{{ $warehouse->address ?? '--' }}</td>
                                        <td>{{ $warehouse->license_number ?? '--' }}</td>
                                        <td>{{ $warehouse->license_expiry_date ?? '--' }}</td>
                                        <td>
                                            @if (!empty($warehouse->license_document))
                                                <a href="{{ asset($warehouse->license_document) }}" target="_blank"
                                                    class="justify-content-center" download>
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            @else
                                                <p class="text-center">--</p>
                                            @endif
                                        </td>
                                        <td><span
                                                class="badge {{ $warehouse->status == 'Active' ? 'bg-success-light' : 'bg-danger-light' }}">{{ $warehouse->status ?? '--' }}</span>
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
                                                                href="{{ route('admin.drivers.edit', $warehouse->id) }}"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <!-- Delete form -->
                                                            <form
                                                                action="{{ route('admin.drivers.destroy', $warehouse->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="dropdown-item"
                                                                    onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this manager? This action can’t be undone! 🚀')"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.drivers.show', $warehouse->id) }}"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item activate" href="javascript:void(0)"
                                                                data-id="{{ $warehouse->id }}" data-status="Active">
                                                                <i class="fa-solid fa-power-off me-2"></i>Activate
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item deactivate"
                                                                href="javascript:void(0)"
                                                                data-id="{{ $warehouse->id }}" data-status="Inactive">
                                                                <i class="far fa-bell-slash me-2"></i>Deactivate
                                                            </a>
                                                        </li>
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

                        <div class="bottom-user-page mt-3">
                            {!! $warehouses->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- jqury cdn --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('.activate, .deactivate').on('click', function() {
                let id = $(this).data('id');
                let status = $(this).data('status');

                $.ajax({
                    url: "{{ route('admin.drivers.status', '') }}/" + id,
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
        </script>

</x-app-layout>
