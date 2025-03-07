<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>

        <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{route('admin.inventories.create')}}"  class="btn btn-primary buttons">
                    <img class="imgs" src="assets/images/Vector.png">  
                    Add Inventory
                </a>
            </div>
        </div>
    </div>

    <x-slot name="cardTitle">
        <p class="head">All Inventory</p>

        <div class="usersearch d-flex">
            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control forms" placeholder="Search ">

                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters"
                        href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a></button>
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
                                <th>Sn no.</th>
                                <th>Inventory Name</th>
                                <th>Warehouse Name</th>
                                <th>In Stock Quantity</th>
                                <th>Price</th>
                                <th>Weight(kg)</th>
                                <th>Height(m)</th>
                                <th>Width(m)</th>
                                <th>Low Stock Warning</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventories as $index => $inventory)
                                <tr>
                                    <td>
                                        {{ ++$index }}
                                    </td>

                                    <td>{{ ucfirst($inventory->category->name ?? '') }}</td>
                                    <td>{{ ucfirst($inventory->warehouse->warehouse_name ?? '') }}</td>
                                    <td><span>{{ $inventory->in_stock_quantity ?? '-' }}</span></td>
                                    <td><span>{{ $inventory->price ?? '-' }}</span></td>
                                    <td><span>{{ $inventory->weight ?? '-' }}</span></td>
                                    <td><span>{{ $inventory->height ?? '-' }}</span></td>
                                    <td><span>{{ $inventory->width ?? '-' }}</span></td>
                                    <td><span>{{ $inventory->low_stock_warning ?? '-' }}</span></td>
                                    <td><span>{{ $inventory->formatted_created_at ?? '-' }}</span></td>
                                    <td><span
                                            class="badge {{ $inventory->in_stock_quantity >= $inventory->low_stock_warning ? 'bg-success-light' : 'bg-danger-light' }}">{{ $inventory->stock_status ?? '-' }}</span>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        {{-- <a href="add-invoice.html" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> Invoice</a>  
                                    <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                            class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.inventories.edit', $inventory->id) }}"><i
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
