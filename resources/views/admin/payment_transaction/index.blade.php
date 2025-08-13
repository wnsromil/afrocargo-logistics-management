<x-app-layout>
    <x-slot name="header">
        {{ __('All Payment Transaction') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">All Payment Transaction</p>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.payment_transaction.index') }}" method="GET">
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
                $warehouseIdFromUrl = request()->query('warehouse_id');
                $authUser = auth()->user();
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
                <label>Payment Status</label>
                <select class="js-example-basic-single select2" name="payment_status">
                    <option value="">Select Payment Status</option>
                    <option value="succeeded" {{ request()->query('payment_status') == "succeeded" ? 'selected' : '' }}>
                        Succeeded
                    </option>
                    <option value="canceled" {{ request()->query('payment_status') == "canceled" ? 'selected' : '' }}>
                        Canceled
                    </option>
                    <option value="failed" {{ request()->query('payment_status') == "failed" ? 'selected' : '' }}>Failed
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
        @include("admin.payment_transaction.table")
    </div>

    @section("script")
        <script>
            // Function to reset the form fields
            function resetForm() {
                window.location.href = "{{ route('admin.payment_transaction.index') }}";
            }
        </script>
    @endsection

</x-app-layout>