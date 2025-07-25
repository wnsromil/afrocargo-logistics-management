<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">
            <table class="table tables table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>S No.</th>
                        <th>User Name</th>
                        <th>User Role</th>
                        <th>Permissions</th>
                        <th>Created Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td class="text-start">{{ $index + 1 }}</td>
                            <td>{{ $user->name ?? '' }} {{ $user->last_name ?? '' }}</td>
                            <td>
                                @if($user->role == 'driver')
                                    Driver
                                @elseif($user->role == 'customer')
                                    Customer
                                @elseif($user->role == 'warehouse_manager')
                                    Warehouse Manager
                                @elseif($user->role == 'ship_to_customer')
                                    Ship To Customer
                                @else
                                    {{ $user->role ?? '' }}
                                @endif
                            </td>
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
                                                {{-- <a class="dropdown-item" href="#"
                                                    onclick="confirmDelete('{{ route('admin.user_role.destroy', $user) }}')">
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