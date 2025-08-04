<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">

            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Bill Id</th>
                        <th>Type</th>
                        <th>Company</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($billOfLadings as $billOfLading)
                        <tr>
                            <td>{{$billOfLading->unique_id ?? ''}}</td>
                            <td>{{$billOfLading->type ?? ''}}</td>
                            <td>{{$billOfLading->company ?? ''}}</td>
                            <td>{{$billOfLading->name ?? ''}}</td>
                            <td>
                                <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Rue 17 Avenue 21">
                                    {{$billOfLading->address ?? ''}}
                                </p>
                            </td>
                            <td>{{$billOfLading->phone_code ?? ''}} {{$billOfLading->phone ?? ''}} <br>
                                {{$billOfLading->cellphone_code ?? ''}} {{$billOfLading->cellphone ?? ''}}
                            </td>
                            <td>{{$billOfLading->city ?? ''}}</td>

                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            @can('has-dynamic-permission', 'bill_of_landing_list.edit')
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{route('admin.bill_of_lading.edit', $billOfLading->id)}}"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                            @endcan
                                            @can('has-dynamic-permission', 'bill_of_landing_list.delete')
                                                <li>
                                                    <form
                                                        action="{{ route('admin.bill_of_lading.destroy', $billOfLading->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item">
                                                            <i class="far fa-trash-alt me-2"></i>Delete
                                                        </button>
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
                            <td colspan="8" class="text-center">No Bill of Lading records found.</td>
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
                {!! $billOfLadings->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>