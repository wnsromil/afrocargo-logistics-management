<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>
    
    <x-slot name="cardTitle">
        <p class="head">Driver Inventory List</p>
        <div class="d-flex align-items-center justify-content-end mb-0">
            <div class="usersearch d-flex">
                <div class="">
                @can('has-dynamic-permission', 'driver_inventory.create')
                    <a href="{{ route('admin.driver_inventory.create') }}" class="btn btn-primary buttons"
                        style="background:#203A5F">
                        <img src="assets/images/Vector.png" class="pe-3">
                        Add Driver Inventory
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

    <form>
        <div class="row">
            <!-- Warehouse Name -->
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

            <div class="col-md-3">
                <!-- Moment.js (required for daterangepicker) -->
                <div class="mb-3">
                    <label>Driver</label>
                    <select name="driver_id" class="form-control select2" id="gateOutDriver">
                        <option value="">Select Driver</option>
                        {{--@foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request()->query('driver_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach--}}
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">

                    <label>Date</label>
                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                        <input type="text" name="daterangepicker" class="btn-filters form-cs inp Expensefillterdate"
                            value="{{ old('daterangepicker', request()->query('daterangepicker')) }}" />
                    </div>
                </div>
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
     @include("admin.driver_inventory.table")
    </div>
    @section('script')
   <script>
    // Function to reset the form fields
    function resetForm() {
        window.location.href = "{{ route('admin.driver_inventory.index') }}";
    }

    $(document).ready(function () {
        // Initialize Select2
        $('.select2').select2();
        
        $('#warehouseSelect').on('change', function () {
            var warehouseId = $(this).val();
            var driverSelect = $('#gateOutDriver');

            if (warehouseId) {
                $.ajax({
                    url: '/api/warehouse-drivers/' + warehouseId,
                    type: 'GET',
                    success: function (data) {
                        // Clear existing options
                        driverSelect.empty().append('<option value="">Select Driver</option>');

                        // Add new driver options
                        if (data.data && data.data.length > 0) {
                            $.each(data.data, function (key, driver) {
                                driverSelect.append('<option value="' + driver.id + '">' + driver.name + '</option>');
                            });
                        }

                        // Refresh Select2
                        driverSelect.trigger('change');
                    },
                    error: function (xhr) {
                        console.error('Error fetching drivers:', xhr.responseText);
                        driverSelect.empty().append('<option value="">Select Driver</option>');
                        driverSelect.trigger('change');
                    }
                });
            } else {
                // Reset if no warehouse selected
                driverSelect.empty().append('<option value="">Select Driver</option>');
                driverSelect.trigger('change');
            }
        });

        // Trigger change on page load if warehouse is already selected
        @if(request()->has('warehouse_name'))
            $('#warehouseSelect').trigger('change');
        @endif
    });
</script>
@endsection

</x-app-layout>