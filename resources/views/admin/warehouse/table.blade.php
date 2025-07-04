<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">

            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Warehouse ID</th>
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
                                {{ $warehouse->unique_id ?? '-' }}
                            </td>

                            <td>{{ ucfirst($warehouse->warehouse_name ?? '') }}</td>
                            <td><span>{{ $warehouse->warehouse_code ?? '-' }}</span></td>
                            <td>{{ $warehouse->address ?? '-' }}</td>
                            <td>{{ $warehouse->city_id ?? '-' }}</td>
                            <td>{{ $warehouse->state_id ?? '-' }}</td>
                            <td>{{ $warehouse->country_id ?? '-' }}</td>
                            <td>{{ $warehouse->zip_code ?? '-' }}</td>
                            <td>+{{ $warehouse->phone_code->phonecode ?? '' }} {{ $warehouse->phone ?? '-' }}</td>
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
                                            @if($warehouse->status == 'Active')
                                            <li>
                                                <a class="dropdown-item deactivate" href="javascript:void(0)"
                                                    data-id="{{ $warehouse->id }}" data-status="Inactive">
                                                    <i class="far fa-bell-slash me-2"></i>Deactivate
                                                </a>
                                            </li>
                                        @elseif($warehouse->status == 'Inactive')
                                            <li>
                                                <a class="dropdown-item activate" href="javascript:void(0)"
                                                    data-id="{{ $warehouse->id }}" data-status="Active">
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