<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">

            <table class="table tables table-stripped table-hover datatable ">
                <thead class="thead-light">

                    <tr>
                        <th>S. No.</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Warehouse</th>
                        <th>Group Container</th>
                        <th>License ID</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th style="text-align: center;">Status</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $index => $customer)
                        <tr>
                            <td> {{ $serialStart + $index + 1 }}</td>
                            <td>
                                <h2 {{-- class="table-avatar" --}}>
                                    <a href="{{ route('admin.customer.show', $customer->id) }}"
                                        class="avatar avatar-sm me-2">
                                        @if ($customer->profile_pic)
                                            <img class="avatar-img rounded-circle"
                                                src="{{ asset($customer->profile_pic) }}" alt="license">
                                        @else
                                            <p>No Image</p>
                                        @endif
                                    </a>
                                </h2>
                            </td>
                            <td>{{ ucfirst($customer->name ?? '') }}</td>
                            <td>{{ $customer->username ?? '' }}</td>
                            <td>{{ $customer->email ?? '-' }}</td>
                            <td>{{ $customer->warehouse->warehouse_name ?? '-' }}</td>
                            <td>{{ $customer->vehicle->container_no_1 ?? '-' }}</td>
                            <td>{{ $customer->license_number ?? '-' }}</td>
                            <td>{{ $customer->country_code ?? '' }} {{ $customer->phone ?? '-' }}<br>
                                {{ $customer->country_code_2 ?? '' }} {{ $customer->phone_2 ?? '-' }}
                            </td>
                            <td>{{ $customer->address ?? '-' }}<br>
                                {{ $customer->address_2 ?? '-' }}
                            </td>
                            <td>
                                @if ($customer->status == 'Active')
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
                                                    href="{{ route('admin.customer.edit', $customer->id) . '?page=' . request()->page ?? 1 }}"><i
                                                        class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.customer.show', $customer->id) }}"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                            </li>
                                            @if($customer->status == 'Active')
                                                            <li>
                                                                <a class="dropdown-item deactivate" href="javascript:void(0)"
                                                                    data-id="{{ $customer->id }}" data-status="Inactive">
                                                                    <i class="far fa-bell-slash me-2"></i>Deactivate
                                                                </a>
                                                            </li>
                                                        @elseif($customer->status == 'Inactive')
                                                            <li>
                                                                <a class="dropdown-item activate" href="javascript:void(0)"
                                                                    data-id="{{ $customer->id }}" data-status="Active">
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
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">No users found.
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
                {!! $customers->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>