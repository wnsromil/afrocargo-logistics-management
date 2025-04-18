<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Advance Reports</p>
        <div class="usersearch d-flex">
            <div>
                <button class="btn btn-primary" style="background:#33B469;border-color:#203A5F!important; font-weight:300; height:37px;text-color:white;"><img style="width:10px; margin-right:5px;" src="../assets/images/Export.png">Export</button>
                <button class="btn btn-primary" style="background:#203A5F; font-weight:300;"><img style="margin-right:5px;" src="../assets/images/Print.png">Print</button>
            </div>
        </div>
    </x-slot>

    <form>
        <div class="row gx-3 searchFilters">
            <div class="col-md-3 dposition">
                <label>Invoice Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                    <input type="text" class="btn-filters form-control form-cs" name="datetimes" placeholder="From Date - To Date" />
                </div>
            </div>

            <div class="col-md-3 dposition">
                <label>By warehouse</label>
                <select class="js-example-basic-single select2 form-cs">
                    <option selected="selected " style="color:#737B8B">Select Warehouse</option>
                    <option>white</option>
                    <option>purple</option>



                </select>
            </div>
            <div class="col-md-3 dposition">
                <label>By Tracking ID</label>
                <img class="imgc" src="assets/img/icons/search.svg" alt="img">
                <input type="text" class="form-control form-cs" placeholder="Enter Tracking ID">
            </div>

            <div class="col-md-3 dposition">
                <label>By Customer </label>
                <img class="imgc" src="assets/img/icons/search.svg" alt="img">
                <input type="text" class="form-control form-cs" placeholder="Enter Customer Name">
            </div>

            <div class="col-md-3 dmargin">
                <!-- Moment.js (required for daterangepicker) -->
                <label>By Driver</label>
                <select class="js-example-basic-single select2">
                    <option selected="selected" style="color:#737B8B">Select Driver</option>
                    <option>white</option>
                    <option>purple</option>
                </select>
            </div>

            <div class="col-md-3 dmargin">
                <label>By Hub</label>
                <select class="js-example-basic-single select2">
                    <option selected="selected">Select Hub</option>
                    <option>white</option>
                    <option>purple</option>
                </select>
            </div>


            <div class="col-md-3 dmargin">
                <label>By Order Status</label>
                <select class="js-example-basic-single select2">
                    <option selected="selected">Select Order Status</option>
                    <option>white</option>
                    <option>purple</option>
                </select>
            </div>

            <div class="col-md-3 twobutton">
                <button class="btn btn-primary btnf">Filter</button>
                <button class="btn btn-outline-danger btnr ">Reset</button>
            </div>
        </div>

    </form>


    <div>

        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Sn no.</th>
                                <th>Tracking Id</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Warehouse </th>
                                <th>Hub</th>
                                <th>Driver</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventories as $index => $inventory)
                            <tr>
                                <td>
                                    {{ ++$index }}
                                </td>

                                <td>{{ ucfirst($inventory->category->name ?? '')}}</td>
                                <td>{{ ucfirst($inventory->warehouse->warehouse_name ?? '')}}</td>
                                <td><span>{{$inventory->in_stock_quantity ?? '-'}}</span></td>
                                <td><span>{{$inventory->low_stock_warning ?? '-'}}</span></td>
                                <td><span class="badge {{$inventory->in_stock_quantity >= $inventory->low_stock_warning ? 'bg-success-light':'bg-danger-light'}}">{{$inventory->stock_status ?? '-'}}</span>
                                </td>
                                <td class="d-flex align-items-center">
                                    {{-- <a href="add-invoice.html" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> Invoice</a>  
                                    <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                            class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('admin.inventories.edit',$inventory->id)}}"><i class="far fa-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <!-- Delete form -->
                                                    <form action="{{ route('admin.inventories.destroy', $inventory->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item" onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i class="far fa-trash-alt me-2"></i>Delete</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('admin.inventories.show',$inventory->id)}}"><i class="far fa-eye me-2"></i>View History</a>
                                                </li>
                                                {{-- <li>
                                                    <a class="dropdown-item" href="active-customers.html"><i class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="deactive-customers.html"><i class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                </li> --}}
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

                    <div class="bottom-user-page mt-3">
                        {!! $inventories->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
