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

    <div>
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
                                    @endforeach
                                </td>
                                <td>
                                    {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') : '-' }}
                                </td>
                                <td class="text-end">
                                    <div class="dropdown dropdown-action container justify-content-end">
                                        <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('user-permissions.edit', $user) }}">
                                                        <i class="far fa-edit me-2"></i>Update
                                                    </a>
                                                </li>
                                                <li>
                                                    {{-- <a class="dropdown-item" href="#" onclick="confirmDelete('{{ route('admin.user_role.destroy', $user) }}')">
                                                        <i class="far fa-trash-alt me-2"></i>Delete
                                                    </a> --}}
                                                </li>
                                            </ul>
                                        </div>
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
                <div class="bottom-user-page mt-3">
                    {!! $users->appends(['permission' => $selectedPermission])->links('pagination::bootstrap-5') !!}
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
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Permission",
            allowClear: true
        });
    });
</script>
@endsection
