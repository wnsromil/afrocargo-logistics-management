<x-app-layout>

    <x-slot name="header">
        Vehicle Management
    </x-slot>

    <x-slot name="cardTitle">
        Create Vehicle
    </x-slot>

    <form action="{{ route('admin.vehicle.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Vehicle Type  -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Vehicle Type <i class="text-danger">*</i></label>
                        <select name="vehicle_type" class="form-control">
                            <option value="" disabled selected>Select Vehicle Type</option>
                            <option value="Truck" {{ old('vehicle_type') == 'Truck' ? 'selected' : '' }}>Truck</option>
                            <option value="Van" {{ old('vehicle_type') == 'Van' ? 'selected' : '' }}>Van</option>
                            <option value="Bike" {{ old('vehicle_type') == 'Bike' ? 'selected' : '' }}>Bike</option>
                            <option value="Pickup" {{ old('vehicle_type') == 'Pickup' ? 'selected' : '' }}>Pickup</option>
                            <option value="Mini Truck" {{ old('vehicle_type') == 'Mini Truck' ? 'selected' : '' }}>Mini Truck</option>
                            <option value="Container Truck" {{ old('vehicle_type') == 'Container Truck' ? 'selected' : '' }}>Container Truck</option>
                            <option value="Three-Wheeler" {{ old('vehicle_type') == 'Three-Wheeler' ? 'selected' : '' }}>Three-Wheeler</option>
                            <option value="SUV" {{ old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Sedan" {{ old('vehicle_type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="Electric Scooter" {{ old('vehicle_type') == 'Electric Scooter' ? 'selected' : '' }}>Electric Scooter</option>
                            <option value="Cargo Plane" {{ old('vehicle_type') == 'Cargo Plane' ? 'selected' : '' }}>Cargo Plane</option>
                            <option value="Cargo Ship" {{ old('vehicle_type') == 'Cargo Ship' ? 'selected' : '' }}>Cargo Ship</option>
                            <option value="Train Cargo" {{ old('vehicle_type') == 'Train Cargo' ? 'selected' : '' }}>Train Cargo</option>
                        </select>
                        @error('vehicle_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Vehicle Number (Plate No.)  -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_number">Vehicle Number (Plate No.)  <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_number" class="form-control" placeholder="Enter Vehicle Number (Plate No.) "
                            value="{{ old('vehicle_number') }}">
                        @error('vehicle_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vehicle Model  -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_model">Vehicle Model  <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_model" class="form-control" placeholder="Enter Vehicle Model "
                            value="{{ old('vehicle_model') }}">
                        @error('vehicle_model')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vehicle Manufactured year -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_year">Vehicle Manufactured year <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_year" class="form-control" placeholder="Enter Vehicle Manufactured year"
                            value="{{ old('vehicle_year') }}">
                        @error('vehicle_year')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vehicle Capacity -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Vehicle Capacity <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_capacity" class="form-control" placeholder="Enter Vehicle Capacity"
                            value="{{ old('vehicle_capacity') }}">
                        @error('vehicle_capacity')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Warehouse Location -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id">Warehouse Location <i class="text-danger">*</i></label>

                        <select name="warehouse_id" id="warehouse" class="form-control">
                            <option value="">Select Warehouse Location</option>
                            @foreach($warehouses as $warehouse)
                            <option {{ old('warehouse_id') == $warehouse->id ? 'selected':'' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status">Status <i class="text-danger">*</i></label>
                        <div class="toggle-switch">
                            <label for="cb-switch">
                                <input type="checkbox" id="cb-switch" name="status" value="Active">
                                <span>
                                    <small></small>
                                </span>
                            </label>
                        </div>


                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="add-customer-btns text-end">
            <a href="{{ route('admin.warehouses.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save">Submit</button>
        </div>
    </form>
</x-app-layout>