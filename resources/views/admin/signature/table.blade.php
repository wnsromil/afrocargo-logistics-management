<div class="card-table">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Warehouse Name</th>
                        <th>Signature Name</th>
                        <th>Signature</th>
                        <th>Status</th>
                        <th class="statusposition">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($signatures as $signature)
                        <tr>
                            <td>{{$signature->warehouse->warehouse_name}}</td>
                            <td>{{$signature->signature_name}}</td>
                            <td>
                                @if (!empty($signature->signature_file))
                                    <img src="{{ asset($signature->signature_file) }}" alt="Signature Image" width="100"
                                        height="100">
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                <label class="labelstatus {{ $signature->status == 'Active' ? 'Active' : 'Inactive' }}"
                                    for="{{ $signature->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                    {{ $signature->status == 'Active' ? 'Active' : 'Inactive' }}
                                </label>
                            </td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            @can('has-dynamic-permission', 'signature_list.edit')
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.signature.edit', $signature->id)}}"><i
                                                        class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            @endcan
                                            @can('has-dynamic-permission', 'signature_list.signature_status')
                                            @if($signature->status == 'Active')
                                                <li>
                                                    <a class="dropdown-item deactivate" href="javascript:void(0)"
                                                        data-id="{{ $signature->id }}" data-status="Inactive">
                                                        <i class="far fa-bell-slash me-2"></i>Deactivate
                                                    </a>
                                                </li>
                                            @elseif($signature->status == 'Inactive')
                                                <li>
                                                    <a class="dropdown-item activate" href="javascript:void(0)"
                                                        data-id="{{ $signature->id }}" data-status="Active">
                                                        <i class="fa-solid fa-power-off me-2"></i>Activate
                                                    </a>
                                                </li>
                                            @endif
                                            @endcan

                                             @can('has-dynamic-permission', 'signature_list.delete')
                                            <li>
                                                <form action="{{ route('admin.signature.destroy', $signature->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! Are you sure you want to remove this signature?')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            @endcan

                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-4 py-4 text-center text-gray-500">No signature found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="bottom-user-page mt-3">
            {!! $signatures->links('pagination::bootstrap-5') !!}
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
                {!! $signatures->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>