<x-app-layout>

    <x-slot name="header">
        Vehicle Management
    </x-slot>

    <x-slot name="cardTitle">
        Edit Vehicle
    </x-slot>

    <form action="{{ route('admin.vehicle.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Vehicle Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Vehicle Type <i class="text-danger">*</i></label>
                        <select name="vehicle_type" class="form-control">
                            <option value="" disabled>Select Vehicle Type</option>
                            @foreach(['Truck', 'Van', 'Bike', 'Pickup', 'Mini Truck', 'Container Truck', 'Three-Wheeler', 'SUV', 'Sedan', 'Electric Scooter', 'Cargo Plane', 'Cargo Ship', 'Train Cargo'] as $type)
                                <option value="{{ $type }}" {{ old('vehicle_type', $vehicle->vehicle_type) == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vehicle Number (Plate No.) -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_number">Vehicle Number (Plate No.) <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_number" class="form-control" placeholder="Enter Vehicle Number"
                            value="{{ old('vehicle_number', $vehicle->vehicle_number) }}">
                        @error('vehicle_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vehicle Model -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_model">Vehicle Model <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_model" class="form-control" placeholder="Enter Vehicle Model"
                            value="{{ old('vehicle_model', $vehicle->vehicle_model) }}">
                        @error('vehicle_model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vehicle Manufactured Year -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_year">Manufactured Year <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_year" class="form-control" placeholder="Enter Manufactured Year"
                            value="{{ old('vehicle_year', $vehicle->vehicle_year) }}">
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
                            value="{{ old('vehicle_capacity', $vehicle->vehicle_capacity) }}">
                        @error('vehicle_capacity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Warehouse Location -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id">Warehouse Location <i class="text-danger">*</i></label>
                        <select name="warehouse_id" class="form-control">
                            <option value="">Select Warehouse</option>
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $vehicle->warehouse_id) == $warehouse->id ? 'selected' : '' }}>
                                    {{ $warehouse->warehouse_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status">Status <i class="text-danger">*</i></label>
                        <div class="toggle-switch">
                            <label for="cb-switch">
                                <input type="checkbox" id="cb-switch" name="status" value="Active" {{ old('status', $vehicle->status) == 'Active' ? 'checked' : '' }}>
                                <span>
                                    <small></small>
                                </span>
                            </label>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}

            </div>
        </div>

        <div class="add-customer-btns text-end">
            <a href="{{ route('admin.vehicle.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save">Update</button>
        </div>
    </form>

</x-app-layout>
