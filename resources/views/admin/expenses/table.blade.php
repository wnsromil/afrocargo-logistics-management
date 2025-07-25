<div class="card-table">
    <div class="card-body">
        <div class="table-responsive smpadding mt-5">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Expense ID</th>
                        <th>User</th>
                        <th>Warehouse Name</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Image</th>
                        <th>Description</th>
                        {{-- <th>Status</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($expenses as $key => $expense)
                        <tr>
                            <td>{{ $expense->unique_id ?? '--' }}</td>
                            <td>{{ $expense->creatorUser->name ?? '--' }}</td>
                            <td>{{ $expense->warehouse->warehouse_name ?? '--' }}</td>
                            <td>{{ \Carbon\Carbon::parse($expense->date)->format('m-d-Y') }}</td>
                            <td>{{ $expense->category ?? '--' }}</td>
                            <td>${{ $expense->amount ?? '--' }}</td>
                            <td>
                                @if ($expense->img)
                                    <img src="{{ asset($expense->img) }}" alt="Expense Image" style="max-width: 50px;">
                                @else
                                    <img src="{{ asset('assets/img.png') }}" alt="Default Image" style="max-width: 50px;">
                                @endif
                            </td>
                            <td>
                                <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{  $expense->description ?? '--' }}">
                                    {{  $expense->description ?? '--' }}
                                </p>
                            </td>
                            {{-- <td>
                                <div class="statusFor {{ $expense->status == 'Active' ? 'active' : 'inactive' }}">
                                    <p>{{ $expense->status }}</p>
                                </div>
                            </td> --}}
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.expenses.edit', $expense->id) }}">
                                                    <i class="far fa-edit me-2"></i>Update
                                                </a>
                                            </li>
                                            {{-- <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.expenses.show', $expense->id) }}">
                                                    <i class="far fa-eye me-2"></i>View
                                                </a>
                                            </li> --}}
                                            {{-- @if($expense->status == 'Active')
                                            <li>
                                                <a class="dropdown-item deactivate" href="javascript:void(0)"
                                                    data-id="{{ $expense->id }}" data-status="Inactive">
                                                    <i class="far fa-bell-slash me-2"></i>Deactivate
                                                </a>
                                            </li>
                                            @elseif($expense->status == 'Inactive')
                                            <li>
                                                <a class="dropdown-item activate" href="javascript:void(0)"
                                                    data-id="{{ $expense->id }}" data-status="Active">
                                                    <i class="fa-solid fa-power-off me-2"></i>Activate
                                                </a>
                                            </li>
                                            @endif --}}
                                            <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="dropdown-item"
                                                    onclick="deleteData(this,'Wait! Are you sure you want to remove this expense?')"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</button>
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
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
                {!! $expenses->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>