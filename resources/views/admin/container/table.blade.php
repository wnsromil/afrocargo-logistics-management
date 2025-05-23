<div class="card-table">
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Container ID</th>
                        <th>Warehouse</th>
                        <th>Size</th>
                        <th>Container No. 1</th>
                        <th>Container No. 2</th>
                        <th>Booking Number</th>
                        <th>Seal No.</th>
                        <th>Bill Of Lading</th>
                        <th>Open Date</th>
                        <th>Close Date</th>
                        <th>Close Invoice</th>
                        <th>Close Warehouse</th>
                        <th>Driver Name</th>
                        <th>Transfer Date</th>
                        <th>Total Orders</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Status Change</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vehicles as $index => $vehicle)
                        <tr>
                            <td>
                                {{ $vehicle->unique_id ?? '-' }}
                            </td>
                            <td>{{ ucfirst($vehicle->warehouse->warehouse_name ?? '') }}</td>
                            <td>{{ $vehicle->container_size ?? '-' }}</td>
                            <td>{{ $vehicle->container_no_1 ?? '-' }}</td>
                            <td>{{ $vehicle->container_no_2 ?? '-' }}</td>
                            <td>{{ $vehicle->booking_number ?? '-' }}</td>
                            <td>{{ $vehicle->seal_no ?? '-' }}</td>
                            <td>{{ $vehicle->bill_of_lading ?? '-' }}</td>
                          
                            <td>{{ $vehicle->open_date ? \Carbon\Carbon::parse($vehicle->open_date)->format('m-d-Y') : '-' }}</td>
                            <td>{{ $vehicle->close_date ? \Carbon\Carbon::parse($vehicle->close_date)->format('m-d-Y') : '-' }}</td>                            
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td>{{ ucfirst($vehicle->driver->name ?? '-') }}</td>
                            <td>-</td>
                            <td>{{$vehicle->parcelsCount->first()->count ?? 0}}</td>
                            <td>
                                <p><label class="amountfont">Recieved:</label> $0</p>
                                <p><label class="amountfont">Due:</label> $0</p>
                                <p><label class="amountfont">Total:</label> $0</p>
                            </td>
                            <td>
                                <label
                                    class="labelstatus {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}"
                                    for="{{ $vehicle->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                    {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}
                                </label>
                            </td>
                            <td>
                                <div class="status-toggle toggles togglep">
                                    <input
                                        onclick="handleContainerClick('{{ $vehicle->id }}', '{{ $vehicle->container_no_1 }}')"
                                        id="rating_{{$index}}" class="check" type="checkbox"
                                        value="{{$vehicle->status}}" {{$vehicle->status == 'Active' ? 'checked' : '' }}>
                                    <label for="rating_{{$index}}"
                                        class="checktoggle log checkbox-bg">checkbox</label>
                                </div>
                            </td>
                            {{-- <td class="d-flex align-items-center"> -->
                                <a href="add-invoice.html" class="btn btn-greys me-2"><i
                                        class="fa fa-plus-circle me-1"></i> Invoice</a>
                                <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                        class="fa-regular fa-eye me-1"></i> Ledger</a>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
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
                                            <li>
                                                <a class="dropdown-item" href="active-customers.html"><i
                                                        class="fa-solid fa-power-off me-2"></i>Activate</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="deactive-customers.html"><i
                                                        class="far fa-bell-slash me-2"></i>Deactivate</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td> --}}
                            <td class="btntext">
                                <button class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-4 py-4 text-center text-gray-500">No data found.</td>
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
                {!! $vehicles->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>