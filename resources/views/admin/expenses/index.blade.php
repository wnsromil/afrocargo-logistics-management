<x-app-layout>
    <x-slot name="header">
        {{ __('All Expenses') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">All Expenses</p>

        <div class="d-flex align-items-center justify-content-end mb-0">
            <div class="usersearch d-flex">
                <div class="">
                    <a href="{{ route('admin.expenses.create') }}" class="btn btn-primary buttons"
                        style="background:#203A5F">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Expense
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

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

            @if($isSingleWarehouse)
                {{-- ✅ Readonly Input for Single Warehouse --}}
                <div class="col-md-3 mb-3">
                    <label>By Warehouse</label>
                    <input type="text" class="form-control" value="{{ $warehouses[0]->warehouse_name }}" readonly
                        style="background-color: #e9ecef; color: #6c757d;">
                    <input type="hidden" name="warehouse_id" value="{{ $warehouses[0]->id }}">
                </div>
            @else
                {{-- ✅ Select Dropdown for Multiple Warehouses --}}
                <div class="col-md-3 mb-3">
                    <label>By Warehouse</label>
                    <select class="js-example-basic-single select2 form-control" name="warehouse_id">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $warehouseIdFromUrl == $warehouse->id || old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('warehouse_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endif


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
                <div class="table-responsive smpadding mt-5">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
                                <th>User</th>
                                <th>Warehouse Name</th>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($expenses as $key => $expense)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $expense->creatorUser->name ?? '--' }}</td>
                                <td>{{ $expense->warehouse->warehouse_name ?? '--' }}</td>
                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('m-d-Y') }}</td>
                                <td>{{ $expense->category ?? '--' }}</td>
                                <td>${{ $expense->amount ?? '--' }}</td>
                                <td>
                                    @if ($expense->img)
                                        <img src="{{ asset($expense->img) }}" alt="Expense Image" style="max-width: 50px;">
                                    @else
                                        <img src="../assets/images/userPlaceholderImg.png" alt="Default Image"
                                            style="max-width: 50px;">
                                    @endif
                                </td>
                                <td>{{ $expense->description ?? '--' }}</td>
                                <td>
                                    <div class="statusFor {{ $expense->status == 'Active' ? 'active' : 'inactive' }}">
                                        <p>{{ $expense->status }}</p>
                                    </div>
                                </td>
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
                                                @if($expense->status == 'Active')
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
                                                @endif
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
        <div class="row mt-4 p-2 input-box align-items-center">
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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

</x-app-layout>