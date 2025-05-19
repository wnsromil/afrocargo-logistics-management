<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">
            <table class="table table-stripped table-hover lessPadding datatable">
                <thead class="thead-light">
                    <tr>
                        <th>ShipTo Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Cellphone</th>
                        <th>Telephone</th>
                        <th>Licence ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($childUsers as $child)
                        <tr>
                            <td>{{ $child->unique_id ?? '-' }}</td>
                            <td>{{ $child->name ?? '-'}}</td>
                            <td>{{ $child->address ?? '-' }}</td>
                            <td>+{{ $child->phone_code->phonecode ?? '' }}
                                {{ $child->phone ?? '-' }}
                            </td>
                            <td>+{{ $child->phone_2_code->phonecode ?? '' }}
                                {{ $child->phone_2 ?? '-' }}
                            </td>
                            <td>{{ $child->license_number ?? '-' }}</td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="btn-action-icon fas" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href="href="{{ route('admin.customer.updateShipTo', $child->id) }}""><i
                                                        class="ti ti-edit fs_18 me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"><i
                                                        class="ti ti-trash fs_18 me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
    <div class="col-md-6 d-flex p-2 align-items-center">
        <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
        <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example"
            id="ShipTopageSizeSelect">
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
                {!! $childUsers->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>