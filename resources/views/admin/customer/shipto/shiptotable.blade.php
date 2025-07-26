<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">
            <table class="table tables table-stripped table-hover datatable ">
                <thead class="thead-light">
                    <tr>
                        <th>Ship To ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>License ID</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Customer ID</th>
                        <th style="text-align: center;">Status</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $index => $customer)
                        <tr>
                            <td> {{ $customer->unique_id ?? "--" }}</td>
                            <td>{{ ucfirst($customer->name ?? '') }} {{$customer->last_name ?? ""}}</td>
                            <td>{{ $customer->email ?? '-' }}</td>
                            <td>{{ $customer->license_number ?? '-' }}</td>
                            <td>+{{ $customer->phone_code->phonecode ?? '' }} {{ $customer->phone ?? '-' }}<br>
                                +{{ $customer->phone_2_code->phonecode ?? '' }} {{ $customer->phone_2 ?? '-' }}
                            </td>
                            <td>{{ $customer->address ?? '-' }}<br>
                                {{ $customer->address_2 ?? '-' }}
                            </td>
                            <td>
                                @if($customer->parent_customer)
                                    <a href="{{ route('admin.customer.show', $customer->parent_customer_id) }}">
                                        {{ $customer->parent_customer->unique_id }}
                                    </a>
                                @else
                                    -
                                @endif

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
                                                    href="{{ route('admin.customer.updateShipTo', $customer->id) }}"><i
                                                        class="ti ti-edit fs_18 me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.customer.destroyShipTo', $customer->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! Are you sure you want to remove this ship to customer?')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
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
                {!! $customers->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>