<x-app-layout>

    <x-slot name="header">
        Vehicle Management
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Update Vehicle</p>
        </div>
    </x-slot>

    <form action="{{ route('admin.vehicle.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Location -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_location" class="foncolor">Warehouse Location</label>
                        <select name="warehouse_name" class="js-example-basic-single select2">
                            <option value="">Select Warehouse </option>
                            @foreach($warehouses as $warehouse)
                                <option {{ old('warehouse_id', $vehicle->warehouse_id) == $warehouse->id ? 'selected' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id">Warehouse Location <i class="text-danger">*</i></label>
                        <select name="warehouse_id" class="form-control">
                            <option value="">Select Warehouse</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}"
                                    {{ old('warehouse_id', $vehicle->warehouse_id) == $warehouse->id ? 'selected' : '' }}>
                                    {{ $warehouse->warehouse_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


                <!-- Vehicle Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type" class="foncolor">Vehicle Type</label>
                        <select name="vehicle_type" class="js-example-basic-single select2">
                            <option value="" disabled>Select Vehicle Type </option>
                            @foreach (['Truck', 'Van', 'Bike', 'Pickup', 'Mini Truck', 'Container Truck', 'Three-Wheeler', 'SUV', 'Sedan', 'Electric Scooter', 'Cargo Plane', 'Cargo Ship', 'Train Cargo'] as $type)
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
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Vehicle Type <i class="text-danger">*</i></label>
                        <select name="vehicle_type" class="form-control">
                            <option value="" disabled>Select Vehicle Type</option>
                            @foreach (['Truck', 'Van', 'Bike', 'Pickup', 'Mini Truck', 'Container Truck', 'Three-Wheeler', 'SUV', 'Sedan', 'Electric Scooter', 'Cargo Plane', 'Cargo Ship', 'Train Cargo'] as $type)
                                <option value="{{ $type }}"
                                    {{ old('vehicle_type', $vehicle->vehicle_type) == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


                <!-- Vehicle Model -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_model" class="foncolor">Vehicle Model</label>
                        <input type="text" name="vehicle_model" class="form-control inp"
                            placeholder="Enter Vehicle Model"
                            value="{{ old('vehicle_model', $vehicle->vehicle_model) }}">
                        @error('vehicle_model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_model">Vehicle Model <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_model" class="form-control"
                            placeholder="Enter Vehicle Model"
                            value="{{ old('vehicle_model', $vehicle->vehicle_model) }}">
                        @error('vehicle_model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


                <!-- Vehicle Manufactured Year -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_year" class="foncolor">Vehicle Manufactured year</label>
                        <input type="vehicle_year" name="vehicle_year" class="form-control inp"
                            placeholder=" Enter Vehicle Manufactured year"
                            value="{{ old('vehicle_year', $vehicle->vehicle_year) }}">
                        @error('vehicle_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_year">Manufactured Year <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_year" class="form-control"
                            placeholder="Enter Manufactured Year"
                            value="{{ old('vehicle_year', $vehicle->vehicle_year) }}">
                        @error('vehicle_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


                <!-- Vehicle Number (Plate No.) -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_number" class="foncolor">Vehicle Number(Plate No.)</label>
                        <input type="text" name="vehicle_number" class="form-control inp"
                            placeholder=" Enter Vehicle No."
                            value="{{ old('vehicle_number', $vehicle->vehicle_number) }}">
                        @error('vehicle_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_number">Vehicle Number (Plate No.) <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_number" class="form-control"
                            placeholder="Enter Vehicle Number"
                            value="{{ old('vehicle_number', $vehicle->vehicle_number) }}">
                        @error('vehicle_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="in_status">Status</label>
                        <div class="status-toggle d-flex align-items-center">
                            <span id="inactiveText" class="bold">Active</span>
                            <input id="cb-switch" class="check" type="checkbox" name="status" value="Active"
                            {{ old('status', $vehicle->status) == 'Inactive' ? 'checked' : '' }}>
                            <label for="cb-switch" class="checktoggle checkbox-bg togc"></label>
                            <!-- <input id="status" class="check d-none" type="checkbox" name="status" checked>
                            <label for="status" class="checktoggle checkbox-bg togc mx-2"></label> -->
                            <span id="activeText">Inactive</span>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status">Status <i class="text-danger">*</i></label>
                        <div class="toggle-switch">
                            <label for="cb-switch">
                                <input type="checkbox" id="cb-switch" name="status" value="Active"
                                    {{ old('status', $vehicle->status) == 'Active' ? 'checked' : '' }}>
                                <span>
                                    <small></small>
                                </span>
                            </label>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

            </div>
        </div>

        <!-- <div class="add-customer-btns text-end">
            <a href="{{ route('admin.vehicle.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save text-light">Update</button>
        </div> -->
        <div class="add-customer-btns text-end">
            <button type="button" onclick="redirectTo('{{route('admin.vehicle.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>
            <button type="submit" class="btn btn-primary ">Update</button>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let statusToggle = document.getElementById("cb-switch");
            let activeText = document.getElementById("activeText");
            let inactiveText = document.getElementById("inactiveText");
            function updateTextColor() {
                if (statusToggle.checked) {
                    activeText.classList.add("bold");
                    inactiveText.classList.remove("bold");
                } else {
                    activeText.classList.remove("bold");
                    inactiveText.classList.add("bold");
                }
            }
            updateTextColor();
            statusToggle.addEventListener("change", updateTextColor);
        });
    </script>
</x-app-layout>