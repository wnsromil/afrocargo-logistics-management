<x-app-layout>
    @section('style')
        <style>
            .tab-btn.active {
                background-color: #0d6efd;
                color: #fff;
                border: 2px solid #0a58ca;
            }
        </style>
    @endsection
    <x-slot name="header">
        {{ __('All End Of Day Report') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">All End Of Day Report</p>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.expenses.index') }}" method="GET">
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search" value="{{ request('search') }}">
                </div>
            </div>
            @php
                $isSingleWarehouse = count($warehouses) === 1;
                $warehouseIdFromUrl = request()->query('warehouse_id');
            @endphp

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

            <div class="col-md-3 mb-3">
                <label>Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info bordered">
                    <input type="text" name="daterangepicker" class="btn-filters form-cs inp Expensefillterdate"
                        value="{{ old('daterangepicker', request()->query('daterangepicker')) }}" />
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label>By Category</label>
                <select class="js-example-basic-single select2" name="category">
                    <option value="">Select Category</option>
                    <option value="Expense" {{ request()->query('category') == "Expense" ? 'selected' : '' }}>Expense
                    </option>
                    <option value="Deposit" {{ request()->query('category') == "Deposit" ? 'selected' : '' }}>Deposit
                    </option>
                </select>
            </div>

            <div class="col-md-3">
                <label>Type</label>
                <select class="js-example-basic-single select2" name="type">
                    <option value="">Select Type</option>
                    <option value="Expense" {{ request()->query('type') == "Expense" ? 'selected' : '' }}>Expense
                    </option>
                    <option value="Income" {{ request()->query('type') == "Income" ? 'selected' : '' }}>Income
                    </option>
                </select>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
    </form>

    <div class="d-flex flex-wrap gap-2 mb-2">
        <button class="btn btn-primary btnf tab-btn" value="Invoice">Invoice</button>
        <button class="btn btn-primary btnf tab-btn" value="Supply">Supply</button>
        <button class="btn btn-primary btnf tab-btn" value="Payments">Payments</button>
        <button class="btn btn-primary btnf tab-btn" value="Expenses">Expenses</button>
        <button class="btn btn-primary btnf tab-btn" value="Void">Void</button>
        <button class="btn btn-primary btnf tab-btn" value="Deposit">Deposit</button>
        <button class="btn btn-primary btnf tab-btn" value="Print">Print</button>
    </div>

    <hr>

    <div class="fw-600 mb-2 fs-6">
        Total Invoiced: $0 &nbsp; | &nbsp;
        Total Payments: $0 &nbsp; | &nbsp;
        Discounts: 0 &nbsp; | &nbsp;
        Total Service: 0 &nbsp; | &nbsp;
        Total Supplies: 0
    </div>

    <div class="fw-600 mb-3 fs-6">
        Cash: $0 &nbsp; | &nbsp;
        Credit: $0 &nbsp; | &nbsp;
        Cheque: $0 &nbsp; | &nbsp;
        BoxCredit: $0 &nbsp; | &nbsp;
        QuickPay: $0 &nbsp; | &nbsp;
        ManualCC: $0 &nbsp; | &nbsp;
        Deposit: $0
    </div>
    <hr>

    <div class="fw-600 fs-6 d-flex flex-wrap gap-3">
        <div>Total Cash: $0</div>
        <div>Expenses: $0</div>
        <div>Total Local Currency Cash: $0</div>
        <div>Expenses: $0</div>
        <div>Total Inv. Amt: $0</div>
        <div>Total Balance: $0</div>
    </div>
    <hr>

    <div id='Invoice' class="tab-content">
        <div class="card-table">
            <div class="text-center" style="color: black;">
                <span class="fw-600 fs-5">Invoice</span>
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
                                            <img src="{{ asset($expense->img) }}" alt=" Expense Image" style="max-width: 50px;">
                                        @else
                                            <img src="{{ asset('assets/img.png') }}" alt="Default Image"
                                                style="max-width: 50px;">
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
                                            <a href="#" class="btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false">
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
                                                    <form action="{{ route('admin.expenses.destroy', $expense->id) }}"
                                                        method="POST" class="d-inline">
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
                <select class="form-select input-width form-select-sm opacity-50" aria-label=" Small select example"
                    id="pageSizeSelect">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10
                    </option>
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
    </div>

    <div id='Supply' class="tab-content d-none">
        <div class="card-table">
            <div class="text-center" style="color: black;">
                <span class="fw-600 fs-5">Supply</span>
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
                                            <img src="{{ asset($expense->img) }}" alt=" Expense Image" style="max-width: 50px;">
                                        @else
                                            <img src="{{ asset('assets/img.png') }}" alt="Default Image"
                                                style="max-width: 50px;">
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
                                            <a href="#" class="btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false">
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
                                                    <form action="{{ route('admin.expenses.destroy', $expense->id) }}"
                                                        method="POST" class="d-inline">
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
                <select class="form-select input-width form-select-sm opacity-50" aria-label=" Small select example"
                    id="pageSizeSelect">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10
                    </option>
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
    </div>

    <div id='Payments' class="tab-content d-none">
        <div class="card-table">
            <div class="text-center" style="color: black;">
                <span class="fw-600 fs-5">Payments</span>
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
                                            <img src="{{ asset($expense->img) }}" alt=" Expense Image" style="max-width: 50px;">
                                        @else
                                            <img src="{{ asset('assets/img.png') }}" alt="Default Image"
                                                style="max-width: 50px;">
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
                                            <a href="#" class="btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false">
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
                                                    <form action="{{ route('admin.expenses.destroy', $expense->id) }}"
                                                        method="POST" class="d-inline">
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
                <select class="form-select input-width form-select-sm opacity-50" aria-label=" Small select example"
                    id="pageSizeSelect">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10
                    </option>
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
    </div>

    @section("script")
        <script>
            $(document).ready(function () {
                // Delegate click on dynamically updated table
                $('#ajexTable').on('click', '.activate, .deactivate', function () {
                    let id = $(this).data('id');
                    let status = $(this).data('status');

                    $.ajax({
                        url: "{{ route('admin.expenses.status', '') }}/" + id
                        , type: 'POST'
                        , data: {
                            _token: '{{ csrf_token() }}'
                            , status: status
                        }
                        , success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success'
                                    , title: 'Status Updated'
                                    , text: response.success
                                });

                                location.reload();
                            }
                        }
                    });
                });
            });

        </script>
        <script>
            // Function to reset the form fields
            function resetForm() {
                window.location.href = "{{ route('admin.expenses.index') }}";
            }
        </script>
        <script>
            function showTab(tabName) {
                const baseUrl = "{{ route('admin.end_of_day.index') }}";
                const fullUrl = `${baseUrl}?tab_active=${encodeURIComponent(tabName)}&per_page=10&page=1`;
                window.location.href = fullUrl;
            }

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        showTab(btn.value);
                    });
                });

                // Optional: highlight active tab button (no redirect here)
                const urlParams = new URLSearchParams(window.location.search);
                const activeTab = urlParams.get('tab_active') || 'Invoice';

                const activeBtn = document.querySelector(`.tab-btn[value="${activeTab}"]`);
                if (activeBtn) {
                    const tab = document.getElementById(activeTab);
                    tab.classList.remove('d-none');
                    tab.classList.add('d-block');
                    tab.classList.add('active');

                }
            });
        </script>

    @endsection

</x-app-layout>