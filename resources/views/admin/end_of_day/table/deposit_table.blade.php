<div class="card-table">
    <div class="text-center" style="color: black;">
        <span class="fw-600 fs-5">Deposit</span>
    </div>
    <div class="card-body">
        <div class="table-responsive smpadding mt-2">
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
                            <td>${{ number_format($expense->amount, 2) ?? '--' }}</td>
                            <td>
                                @if ($expense->img)
                                    <img src="{{ asset($expense->img) }}" alt="Expense Image" style="max-width: 50px;">
                                @else
                                    <img src="{{ asset('assets/img.png') }}" alt="Default Image" style="max-width: 50px;">
                                @endif
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