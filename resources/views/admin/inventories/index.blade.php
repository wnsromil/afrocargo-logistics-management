<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Service Inventorys</p>
        <div class="d-flex align-items-center justify-content-end mb-0">
            <div class="usersearch d-flex">
                <div class="">
                    @can('has-dynamic-permission', 'service_inventory_list.create')
                        <a href="{{ route('admin.inventories.create') }}" class="btn btn-primary buttons"
                            style="background:#203A5F">
                            <i class="ti ti-circle-plus me-2 text-white"></i>
                            Add Inventory
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp
    {{-- ✅ Select Dropdown for Multiple Warehouses --}}
    <form id="expenseFilterForm" action="{{ route('admin.inventories.index') }}" method="GET">
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search" value="{{ request('search') }}">
                </div>
            </div>
            {{-- ✅ Select Dropdown for Multiple Warehouses --}}
            <div class="col-md-3 mb-3">
                <label>By Warehouse</label>
                @if ($authUser->role_id == 1)
                    <select class="js-example-basic-single select2 form-control" name="warehouse_id">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $warehouseIdFromUrl == $warehouse->id || old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                @else
                    @php
                        $singleWarehouse = $warehouses->first();
                    @endphp

                    <input type="text" class="form-control" value="{{ $singleWarehouse->warehouse_name }}" readonly
                        style="background-color: #e9ecef; color: #6c757d;">
                    <input type="hidden" name="warehouse_id" value="{{ $singleWarehouse->id }}">
                @endif
                @error('warehouse_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-12">

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
    </form>

    <div id='ajexTable'>
        @include("admin.inventories.table")
    </div>

    @section('script')
        {{--
        <script>
            document.addEventListener("DOMContentLoaded", function () {
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

        </script> --}}
        <script>
            // Function to reset the form fields
            function resetForm() {
                window.location.href = "{{ route('admin.inventories.index') }}";
            }
        </script>
    @endsection

</x-app-layout>