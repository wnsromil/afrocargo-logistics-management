<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>


    <!-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="#" class="btn btn-primary buttons">
                    <i class="ti ti-circle-plus me-2 text-white"></i>
                    Add Inventory
                    </a>
                </div>
            </div>
        </div>
     -->
    <x-slot name="cardTitle">
        <p class="head">All Inventory</p>

        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form>
                    <input type="text" id="searchInput" class="form-control forms" placeholder="Search ">

                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters" href="javascript:void(0);" data-bs-placement="bottom" title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a></button>
            </div>
        </div>

    </x-slot>
    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.inventories.create') }}" class="btn btn-primary buttons" style="background:#203A5F">
                    <i class="ti ti-circle-plus me-2 text-white"></i>
                    Add Inventory
                </a>
            </div>
        </div>
    </div>

    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable" id="setBackground">
                        <thead class="thead-light">
                            <tr>
                                <th>Item No</th>
                                <th>Inventory Type</th>
                                <th>Supply Image</th>
                                <th>Inventory Name</th>
                                <th>Warehouse Name</th>
                                <th>Weight (kg)</th>
                                <th>Width(cm)</th>
                                <th>Height(cm)</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Low Stock Warning</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <!-- ------------------------------------------------------------------------------------------- -->

                        <tbody>
                            @forelse ($inventories as $inventory)
                            <tr class="background-instock text-center" style="
                                @if ($inventory->stock_status == 'In Stock') background-color: #B6FFD3;
                                @elseif($inventory->stock_status == 'Out of Stock') background-color: #FFB5AA;
                                @else background-color: #FFD6A5;
                                @endif
                            ">
                                <td>
                                    {{ $inventory->unique_id }}
                                </td>

                                <td class="text-dark">{{ ucfirst($inventory->inventory_type ?? '') }}</td>
                                <td class="product_img">
                                    @if (!empty($inventory->img))
                                    <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50" height="50">
                                    @else
                                    <span>-</span>
                                    @endif
                                </td>
                                <td class="text-dark">{{ ucfirst($inventory->name ?? '') }}</td>
                                <td class="text-dark">{{ ucfirst($inventory->warehouse->warehouse_name ?? '') }}</td>
                                <td class="text-dark"><span>{{ $inventory->weight ?? '-' }}</span></td>
                                <td class="text-dark"><span>{{ $inventory->width ?? '-' }}</span></td>
                                <td class="text-dark"><span>{{ $inventory->height ?? '-' }}</span></td>
                                <td class="text-dark"><span>{{ $inventory->in_stock_quantity ?? '-' }}</span></td>
                                <td class="text-dark"><span>
                                        @if (!empty($inventory->price))
                                        $
                                        @endif{{ $inventory->price ?? '-' }}
                                    </span>
                                </td>

                                <td class="text-dark"><span>{{ $inventory->low_stock_warning ?? '-' }}</span></td>
                                <td class="text-dark"><span>{{ $inventory->formatted_created_at ?? '-' }}</span></td>
                                <td class="text-dark"><span class=" @if ($inventory->stock_status == 'In Stock') bg-light text-success @elseif($inventory->stock_status == 'Out Of Stock')
                                    bg-light text-danger
                                    @else
                                    bg-light text-warning @endif  px-2 py-1 stock-font fw-medium">{{
                                        $inventory->stock_status ?? '-' }}</span>
                                </td>

                                <td class="align-items-center">

                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fe fe-more-vertical fs-4"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.inventories.edit', $inventory->id) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>

                                                <form action="{{ route('admin.inventories.destroy', $inventory->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item" onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory?')"><i class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.inventories.show', $inventory->id) }}"><i class="far fa-eye me-2"></i>View History</a>
                                            </li>

                                        </ul>
                                    </div>


                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No inventories found.
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
                        {!! $inventories->appends(['per_page' =>
                        request('per_page')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("#setBackground tbody tr").forEach(row => {
                let back = row.cells[12].querySelector('span').innerText.trim();

                if (back === 'Low Stock' || back === 'low stock') {
                    row.classList.add('bg-warning-bg');
                    row.cells[12].querySelector('span').classList.add('bg-set4');
                } else if (back === 'Out of Stock' || back === 'out of stock') {
                    row.classList.add('bg-danger-bg');
                    row.cells[12].querySelector('span').classList.add('bg-set3');
                } else if (back === 'In Stock' || back === 'in stock') {
                    row.classList.add('bg-success-bg');
                    row.cells[12].querySelector('span').classList.add('bg-set2');
                }
            });
        });

    </script>

</x-app-layout>
