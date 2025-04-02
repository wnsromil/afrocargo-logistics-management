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
        <div class="d-flex topnavs" >
            <p class="head">All Warehouses</p>
            <div class="usersearch d-flex usersserach">
            <div class="top-nav-search">
                <form>
                <input type="text" class="form-control forms" placeholder="Search ">
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
    <div>

        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th >S. No.</th>
                                <th >Warehouse Name</th>
                                <th >Warehouse Code</th>
                                <th >Address</th>
                                <th >City</th>
                                <th >State</th>
                                <th >Zip Code</th>
                                <th >Country</th> 
                                <th >Phone</th>
                                <th >Status</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($warehouses as $index => $warehouse)
                                <tr>
                                    <td>
                                        {{ ++$index }}
                                    </td>

                                    <td>{{ ucfirst($warehouse->warehouse_name ?? '') }}</td>
                                    <td><span>{{ $warehouse->warehouse_code ?? '-' }}</span></td>
                                    <td>{{ $warehouse->address ?? '-' }}</td>
                                    <td>{{ $warehouse->city->name ?? '-' }}</td>
                                    <td>{{ $warehouse->state->name ?? '-' }}</td>
                                    <td>{{ $warehouse->country->name ?? '-' }}</td>
                                    <td>{{ $warehouse->zip_code ?? '-' }}</td>
                                    <td>{{ $warehouse->country_code ?? '' }} {{ $warehouse->phone ?? '-' }}</td>
                                    <td>
                                        @if ($warehouse->status == 'Active')
                                            <div class="container">
                                                <img src="{{ asset('assets/img/checkbox.png')}}" alt="Image" />
                                                <p>Active</p>
                                            </div>
                                        @else
                                            <div class="container">
                                                <img src="{{ asset('assets/img/inactive.png')}}" alt="Image" />
                                                <p>Inactive</p>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.warehouses.edit', $warehouse->id) . '?page=' . request()->page ?? 1 }}"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.warehouses.show', $warehouse->id) }}"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

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
    </div>
    <div class="bottom-user-page mt-3">
        {!! $warehouses->links('pagination::bootstrap-5') !!}
    </div>

</x-app-layout>