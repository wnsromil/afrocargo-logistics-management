<x-app-layout>
    <x-slot name="header">
        {{ __('All Expenses') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">All Expenses</p>

        <div class="d-flex align-items-center justify-content-end mb-0">
            <div class="usersearch d-flex">
                <div class="">
                    @can('has-dynamic-permission', 'expenses.create')
                        <a href="{{ route('admin.expenses.create') }}" class="btn btn-primary buttons"
                            style="background:#203A5F">
                            <i class="ti ti-circle-plus me-2 text-white"></i>
                            Add Expense
                        </a>
                    @endcan
                </div>
            </div>
        </div>
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

            <div class="col-md-3 mb-3">
                <label>Type</label>
                <select class="js-example-basic-single select2" name="type">
                    <option value="">Select Type</option>
                    <option value="Expense" {{ request()->query('type') == "Expense" ? 'selected' : '' }}>Expense
                    </option>
                    <option value="Income" {{ request()->query('type') == "Income" ? 'selected' : '' }}>Income
                    </option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>By User</label>
                <select name="user_id" class="js-example-basic-single select2 form-cs">
                    <option value="">Select User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ request()->query('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name ?? '' }} {{ $user->last_name ?? '' }}
                        </option>
                    @endforeach
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
        @include("admin.expenses.table")
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