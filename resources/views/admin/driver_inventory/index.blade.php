<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">Driver Inventory List</p>

        <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{ route('admin.inventories.create') }}" class="btn btn-primary buttons"
                        style="background:#203A5F">
                        <img src="assets/images/Vector.png" class="pe-3">
                        Add Driver Inventory
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <form>
        <div class="row">
            <div class="col-md-4">
                <!-- Moment.js (required for daterangepicker) -->
                <label>Driver</label>
                <select class="js-example-basic-single select2">
                    <option selected="selected" style="color:#737B8B">Select Driver</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="input-block mb-3">

                    <label>Date</label>
                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text" name="date" class="btn-filters form-cs inp" 
                                placeholder="02-21-2024 - 02-21-2024" />
                            </div>
                    <!-- <div class="daterangepicker-wrap cal-icon cal-icon-info">
                        <input type="datetimes" class="btn-filters form-control ps-5" name="datetimes"
                            placeholder="02-21-2024 - 02-21-2024" style="border:none" />
                    </div> -->
                </div>
            </div>
            <div class="col-md-4  top-50 start-100 twobutton2">
                <button class="btn btn-primary btnf">Search</button>
                <button class="btn btn-outline-danger btnr ">Reset</button>
            </div>
        </div>
        <!-- ----------------------------------------------------------------------------------------------- -->

        <!-- <div class="col-md-3 dposition">
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
        </div>
    </form> -->


        <div>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-stripped table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                <th>S No.</th>
                                    <th>Date</th>
                                    <th>Driver</th>
                                    <th>Item Number</th>
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Action</th>

                                    <!-- <th>Sn no.</th>
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
                                    <th>Action</th> -->
                                </tr>
                            </thead>

        <!-- ---------------------------------------------------------------------------------------------------------- -->

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
                                        <td><span
                                                class="badge {{$inventory->in_stock_quantity >= $inventory->low_stock_warning ? 'bg-success-light' : 'bg-danger-light'}}">{{$inventory->stock_status ?? '-'}}</span>
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
                                                                href="{{route('admin.inventories.edit', $inventory->id)}}"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <!-- Delete form -->
                                                            <form
                                                                action="{{ route('admin.inventories.destroy', $inventory->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="dropdown-item"
                                                                    onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{route('admin.inventories.show', $inventory->id)}}"><i
                                                                    class="far fa-eye me-2"></i>View History</a>
                                                        </li>
                                                        {{-- <li>
                                                            <a class="dropdown-item" href="active-customers.html"><i
                                                                    class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="deactive-customers.html"><i
                                                                    class="far fa-bell-slash me-2"></i>Deactivate</a>
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

        <!-- ------------------------------------------------------------------------------------------------------ -->
                            <!-- <tbody>
                                @forelse ($inventoriesas $index => $inventory)
                                    <tr>
                                        <td>
                                            {{ ++$index }}
                                        </td>

                                        <td>{{ ucfirst($inventory->category->name ?? '')}}</td>
                                        <td>{{ ucfirst($inventory->warehouse->warehouse_name ?? '')}}</td>
                                        <td><span>{{$inventory->in_stock_quantity ?? '-'}}</span></td>
                                        <td><span>{{$inventory->low_stock_warning ?? '-'}}</span></td>
                                        <td><span
                                                class="badge {{$inventory->in_stock_quantity >= $inventory->low_stock_warning ? 'bg-success-light' : 'bg-danger-light'}}">{{$inventory->stock_status ?? '-'}}</span>
                                        </td>
                                        <td class="d-flex align-items-center"> -->
                                            {{-- <a href="add-invoice.html" class="btn btn-greys me-2"><i
                                                    class="fa fa-plus-circle me-1"></i> Invoice</a>
                                            <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                                    class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                            <!-- <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{route('admin.inventories.edit', $inventory->id)}}"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li> -->
                                                            <!-- Delete form -->
                                                            <!-- <form
                                                                action="{{ route('admin.inventories.destroy', $inventory->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="dropdown-item"
                                                                    onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{route('admin.inventories.show', $inventory->id)}}"><i
                                                                    class="far fa-eye me-2"></i>View History</a>
                                                        </li> -->
                                                        {{-- <li>
                                                            <a class="dropdown-item" href="active-customers.html"><i
                                                                    class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="deactive-customers.html"><i
                                                                    class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                        </li> --}}
                                                    <!-- </ul>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                                    </tr>
                                @endforelse

                            </tbody> -->

                        </table>

                        <div class="bottom-user-page mt-3">
                            {!! $inventories->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>