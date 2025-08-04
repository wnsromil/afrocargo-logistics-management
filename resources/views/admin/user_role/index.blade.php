<x-app-layout>
    <x-slot name="header">
        {{ __('Role Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex topnavs justify-content-between">
            <p class="head">Role Management</p>
            {{-- <a href="{{ route('admin.user_role.create') }}" class="btn btn-primary buttons">
                <i class="ti ti-circle-plus me-2 text-white"></i>
                Add Roles
            </a> --}}
        </div>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.user_role.index') }}" method="GET">
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
                            <option value="{{ $warehouse->id }}" {{ $warehouseIdFromUrl == $warehouse->id || request()->warehouse_id== $warehouse->id ? 'selected' : '' }}>
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


            <div class="col-md-3 mb-3">
                <label>Role Name</label>
                <select class="form-control inp select2" name="role" onchange="this.form.submit()">
                    <option>Select Role</option>
                    <option value="2" {{request()->role == "2" ? 'selected' : '' }}>Warehouse Manager</option>
                    <option value="4" {{request()->role == "4" ? 'selected' : '' }}>Driver</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>By Permissions</label>
                <select class="js-example-basic-single select2 form-control" name="permission">
                    <option value="">All Permissions</option>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->name }}" {{ $selectedPermission == $permission->name ? 'selected' : '' }}>
                            {{ ucwords(str_replace(['.', '_'], ' ', $permission->name)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="window.location.href='/user_role'">Reset</button>
                </div>
            </div>
        </div>
    </form>


    <div id='ajexTable'>
        @include('admin.user_role.table')
    </div>

</x-app-layout>

@section('scripts')
    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create a form and submit it
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.innerHTML = `
                                        @csrf
                                        @method('DELETE')
                                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Initialize select2 if needed
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Select Permission",
                allowClear: true
            });
        });
</script>
@endsection
