<x-app-layout>
    <x-slot name="header">
        {{ __('Container List') }}
    </x-slot>

    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.container.create') }}" class="btn btn-primary buttons">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Container
                    </div>
                </a>
            </div>
        </div>
    </div>

    <x-slot name="cardTitle">
        <p class="head">All Containers</p>

        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control forms" id="searchInput" placeholder="Search ">

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
    </x-slot>

    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
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
                                        {{ ++$index }}
                                    </td>
                                    <td>{{ ucfirst($vehicle->warehouse->warehouse_name ?? '') }}</td>
                                    <td>{{ $vehicle->container_size ?? '-' }}</td>
                                    <td>{{ $vehicle->container_no_1 ?? '-' }}</td>
                                    <td>{{ $vehicle->container_no_2 ?? '-' }}</td>
                                    <td>{{ $vehicle->booking_number ?? '-' }}</td>
                                    <td>{{ $vehicle->seal_no ?? '-' }}</td>
                                    <td>{{ $vehicle->bill_of_lading ?? '-' }}</td>
                                  
                                    <td>-</td>
                                    <td>-</td>
                                    <td class="tabletext"><input type="checkbox"></td>
                                    <td class="tabletext"><input type="checkbox"></td>
                                    <td>{{ ucfirst($vehicle->driver->name ?? '-') }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>
                                        <p><label class="amountfont">Recieved:</label> $0</p>
                                        <p><label class="amountfont">Due:</label> $0</p>
                                        <p><label class="amountfont">Total:</label> $0</p>
                                    </td>
                                    <td>
                                        <label class="labelstatus"
                                            for="{{ $vehicle->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                            {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="status-toggle toggles togglep">
                                            <input id="rating_8" class="check" type="checkbox" value="Inactive">
                                            <label for="rating_8" class="checktoggle log checkbox-bg">checkbox</label>
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
                            {{-- <tr>
                                <td>1</td>
                                <td>Container</td>
                                <td>Location ABC</td>
                                <td>2E 5777</td>
                                <td>5855</td>
                                <td>887</td>
                                <td>40”</td>
                                <td>5-12-2024</td>
                                <td>6-12-2024</td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td>-</td>
                                <td>12-12-2024</td>
                                <td>120</td>
                                <td>
                                    <p><label class="amountfont">Recieved:</label> $1500</p>
                                    <p><label class="amountfont">Due:</label> $120</p>
                                    <p><label class="amountfont">Total:</label> $2120</p>

                                </td>
                                <td><label class="labelstatus" for="unpaid_status">Inactive</label></td>
                                <td>

                                    <div class="status-toggle toggles togglep">
                                        <input id="rating_8" class="check" type="checkbox" value="Inactive">
                                        <label for="rating_8" class="checktoggle log checkbox-bg">checkbox</label>
                                    </div>



                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{ asset('assets/img/ordereye.png')}}"></button>
                                </td>

                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Container</td>
                                <td>Location CSA</td>
                                <td>5T 789</td>
                                <td>4555</td>
                                <td>474</td>
                                <td>20 feet</td>
                                <td>6-12-2024</td>
                                <td>7-12-2024</td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td>Don John</td>
                                <td>02-21-2024</td>
                                <td>555</td>
                                <td>
                                    <p><label class="amountfont">Recieved:</label> $5000</p>
                                    <p><label class="amountfont">Due:</label> $555</p>
                                    <p><label class="amountfont">Total:</label> $5555</p>
                                </td>
                                <td><label class="labelstatusw" for="partial_status"> Active</label></td>
                                <td>
                                    <div class="status-toggle toggles togglep">
                                        <input id="rating_9" class="check" type="checkbox" value="Inactive">
                                        <label for="rating_9" class="checktoggle log checkbox-bg">checkbox</label>
                                    </div>

                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{ route('admin.container.show', 1) }}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Container</td>
                                <td>Location QWQ</td>
                                <td>2E 577</td>
                                <td>585</td>
                                <td>442</td>
                                <td>20 feet</td>
                                <td>5-12-2024</td>
                                <td>6-12-2024</td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td>-</td>
                                <td>06-16-2024</td>
                                <td>200</td>
                                <td>
                                    <p><label class="amountfont">Recieved:</label> $900</p>
                                    <p><label class="amountfont">Due:</label> $300</p>
                                    <p><label class="amountfont">Total:</label> $1200</p>
                                </td>
                                <td><label class="labelstatus" for="unpaid_status">Inactive</label></td>
                                <td>
                                    <div class="status-toggle toggles togglep">
                                        <input id="rating_1" class="check" type="checkbox" value="Inactive">
                                        <label for="rating_1" class="checktoggle log checkbox-bg">checkbox</label>
                                    </div>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{ route('admin.container.show', 1) }}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>Container</td>
                                <td>Location TTT</td>
                                <td>5T 739</td>
                                <td>658</td>
                                <td>2100</td>
                                <td>40”</td>
                                <td>5-12-2024</td>
                                <td>6-12-2024</td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td>-</td>
                                <td>06-16-2024</td>
                                <td>300</td>
                                <td>
                                    <p><label class="amountfont">Recieved:</label> $100</p>
                                    <p><label class="amountfont">Due:</label> $300</p>
                                    <p><label class="amountfont">Total:</label> $1300</p>
                                </td>
                                <td><label class="labelstatus" for="unpaid_status">Inactive</label></td>
                                <td>
                                    <div class="status-toggle toggles togglep">
                                        <input id="rating_2" class="check" type="checkbox" value="Inactive">
                                        <label for="rating_2" class="checktoggle log checkbox-bg">checkbox</label>
                                    </div>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{ route('admin.container.show', 1) }}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>Container</td>
                                <td>Location GGG</td>
                                <td>2E 5757</td>
                                <td>485</td>
                                <td>125</td>
                                <td>40”</td>
                                <td>5-12-2024</td>
                                <td>6-12-2024</td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td>Peter Duke</td>
                                <td>12-4-2024</td>
                                <td>450</td>
                                <td>
                                    <p><label class="amountfont">Recieved:</label> $1500</p>
                                    <p><label class="amountfont">Due:</label> $120</p>
                                    <p><label class="amountfont">Total:</label> $2120</p>
                                </td>
                                <td><label class="labelstatus" for="unpaid_status">Inactive</label></td>
                                <td>
                                    <div class="status-toggle toggles togglep">
                                        <input id="rating_3" class="check" type="checkbox" value="Inactive">
                                        <label for="rating_3" class="checktoggle log checkbox-bg">checkbox</label>
                                    </div>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{ route('admin.container.show', 1) }}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>Container</td>
                                <td>Location DDD </td>
                                <td>5T 7319</td>
                                <td>474</td>
                                <td>555</td>
                                <td>20 feet</td>
                                <td>12-4-2024</td>
                                <td>12-4-2024</td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td>-</td>
                                <td>12-4-2024</td>
                                <td>110</td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row amountfont">Received:</div>
                                            <div class="row amountfont">Due:</div>
                                            <div class="row amountfont">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$5000</div>
                                            <div class="row">$555</div>
                                            <div class="row">$5555</div>
                                        </div>
                                    </div>
                                </td>
                                <td><label class="labelstatus" for="unpaid_status">Inactive</label></td>
                                <td>
                                    <div class="status-toggle toggles togglep">
                                        <input id="rating_4" class="check" type="checkbox" value="Inactive">
                                        <label for="rating_4" class="checktoggle log checkbox-bg">checkbox</label>
                                    </div>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{ route('admin.container.show', 1) }}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td>Container</td>
                                <td>Location SSSS</td>
                                <td>2E 56777</td>
                                <td>658</td>
                                <td>450</td>
                                <td>20 feet</td>
                                <td>8-12-2024</td>
                                <td>9-12-2024</td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td class="tabletext"><input type="checkbox"></td>
                                <td>-</td>
                                <td>12-4-2024</td>
                                <td>554</td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row amountfont">Received:</div>
                                            <div class="row amountfont">Due:</div>
                                            <div class="row amountfont">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$900</div>
                                            <div class="row">$300</div>
                                            <div class="row">$1200</div>
                                        </div>
                                    </div>
                                </td>
                                <td><label class="labelstatus" for="unpaid_status">Inactive</label></td>
                                <td>
                                    <div class="status-toggle toggles togglep">
                                        <input id="rating_5" class="check" type="checkbox" value="Inactive">
                                        <label for="rating_5" class="checktoggle log checkbox-bg">checkbox</label>
                                    </div>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{ route('admin.container.show', 1) }}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
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
</x-app-layout>