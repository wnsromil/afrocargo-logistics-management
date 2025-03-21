<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>


    <!-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="#" class="btn btn-primary buttons">
                    <img class="imgs" src="assets/images/Vector.png">
                    Add Inventory
                    </a>
                </div>
            </div>
        </div>
     -->
    <x-slot name="cardTitle">
        <p class="head">All Inventory</p>

        <div class="usersearch d-flex">
            <div class="top-nav-search top-search">
                <form>
                    <input type="text" class="form-control forms-input" placeholder="Search ">
                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser">
                    <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Refresh"><span><i
                                class="fe fe-refresh-ccw"></i></span></a></button>
            </div>
        </div>

    </x-slot>
    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.inventories.create') }}" class="btn btn-primary buttons"
                    style="background:#203A5F">
                    <img src="assets/images/Vector.png" class="pe-3">
                    Add Inventory
                </a>
            </div>
        </div>
    </div>

    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Sn no.</th>
                                <th>Inventory Name</th>
                                <th>Image</th>
                                <th>Warehouse Name</th>
                                <th>Weight (kg)</th>
                                <th>Width(m)</th>
                                <th>height(m)</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Low Stock Warning</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        @forelse ($inventories as $inventory)
                        <tr style="
                            @if ($inventory->stock_status == 'In Stock') background-color: #B6FFD3;
                            @elseif($inventory->stock_status == 'Out of Stock') background-color: #FFB5AA;
                            @else background-color: #FFD6A5;
                            @endif
                          ">
                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>{{ ucfirst($inventory->category->name ?? '') }}</td>
                                <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>{{ ucfirst($inventory->warehouse->warehouse_name ?? '') }}</td>
                                <td><span>{{ $inventory->weight ?? '-' }}</span></td>
                                <td><span>{{ $inventory->width ?? '-' }}</span></td>
                                <td><span>{{ $inventory->height ?? '-' }}</span></td>
                                <td><span>{{ $inventory->in_stock_quantity ?? '-' }}</span></td>
                                <td><span>
                                        @if (!empty($inventory->price))
                                            $
                                        @endif{{ $inventory->price ?? '-' }}
                                    </span></td>

                                <td><span>{{ $inventory->low_stock_warning ?? '-' }}</span></td>
                                <td><span>{{ $inventory->formatted_created_at ?? '-' }}</span></td>
                                <td><span
                                        class=" @if ($inventory->stock_status == 'In Stock') bg-light text-success @elseif($inventory->stock_status == 'Out Of Stock')
                                    bg-light text-danger
                                    @else
                                    bg-light text-warning @endif  px-2 py-1 stock-font fw-medium">{{ $inventory->stock_status ?? '-' }}</span>
                                </td>
                                {{-- <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                        title="fe fe-more-vertical"></i></td> --}}
                                <td class="d-flex align-items-center">
                                    {{-- <a href="add-invoice.html" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> Invoice</a>  
                                        <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                                class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                                data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.inventories.edit', $inventory->id) }}"><i
                                                            class="far fa-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>

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
                                                        href="{{ route('admin.inventories.show', $inventory->id) }}"><i
                                                            class="far fa-eye me-2"></i>View History</a>
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
                                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No inventories found.
                                </td>
                            </tr>
                        @endforelse

                    </table>
                </div>
            </div>
        </div>


        <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">

            <div class="col-md-6 d-flex p-2 align-items-center">
                <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
                <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example">
                    <option selected>10</option>
                    <option value="1">5</option>
                    <option value="2">10</option>
                    <option value="3">15</option>
                </select>
                <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
            </div>

            <div class="col-md-6">
                <div class="float-end">
                    <button class="btn button-border">
                        <i class="fa fa-angle-left tooltipped" data-position="top" data-tooltip="fa fa-angle-left"></i>
                    </button>
                    <button class="btn paginate_button page-item button-border active" type="button"
                        data-bs-toggle="button">1</button>
                    <button class="btn button-border">2</button>
                    <button class="btn button-border" type="button">3</button>
                    <button class="btn button-border" type="button">4</button>
                    <button class="btn button-border" type="button">5</button>


                    <button class="btn button-border">
                        <i class="fa fa-angle-right tooltipped" data-position="top"
                            data-tooltip="fa fa-angle-right"></i>
                    </button>
                    <!--   <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a></li> -->
                </div>
            </div>
        </div>


    </div>



</x-app-layout>
