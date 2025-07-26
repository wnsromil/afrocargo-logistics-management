<x-app-layout>
    <x-slot name="header">
        {{ __('Role Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex topnavs justify-content-between">
            <p class="head">Role Management</p>
            <a href="{{ route('admin.user_role.create') }}" class="btn btn-primary buttons">
                <i class="ti ti-circle-plus me-2 text-white"></i>
                Add Roles
            </a>
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
        <div class="card-table">
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row mb-2">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label class="col3a fw_600 mb-0">Role Name</label>
                            <select class="form-control inp select2" name="role" onchange="this.form.submit()">
                                <option>Select Role</option>
                                <option value="warehouse_manager" {{request()->role == "warehouse_manager" ? 'selected' : '' }}>Warehouse Manager</option>
                                <option value="driver" {{request()->role == "driver" ? 'selected' : '' }}>Driver</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="permission" class="col3a fw_600 mb-0">Filter By Permission</label>
                            <select name="permission" class="form-control inp select2" onchange="this.form.submit()">
                                <option value="">All Permissions</option>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->name }}"
                                        {{ $selectedPermission == $permission->name ? 'selected' : '' }}>
                                        {{ ucwords(str_replace(['.', '_'], ' ', $permission->name)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 text-end mt-3">
                                <button type="button" class="btn btn-primary refeshuser ">
                                    <a class="btn-filters" href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a>
                                </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Created Date</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index=>$user)
                            <tr>
                                <td class="text-start">{{ $index + 1 }}</td>
                                <td>{{ $user->name ?? '-' }}</td>
                                <td>{{ $user->last_name ?? '-' }}</td>
                                <td>{{ $user->role ?? '-' }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <div class="mb-1">
                                            <strong>{{ $role->name }}:</strong>
                                            @foreach($role->permissions->take(3) as $permission)
                                                <span class="badge bg-primary me-1">
                                                    {{ ucwords(str_replace('.', ' ', $permission->name)) }}
                                                </span>
                                            @endforeach
                                            @if($role->permissions->count() > 3)
                                                <span class="badge bg-secondary">
                                                    +{{ $role->permissions->count() - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                            {!! $users->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    });
</script>
@endsection
