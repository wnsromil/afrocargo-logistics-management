<x-app-layout>

    <x-slot name="header">
        Vehicle Management
    </x-slot>


    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Vehicle</p>
        </div>
    </x-slot>

    <form action="{{ route('admin.vehicle.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- <div class="form-group-customer customer-additional-form">
            <div class="row"> -->
        <!-- Warehouse Location -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id">Warehouse Location <i class="text-danger">*</i></label>

                        <select name="warehouse_id" id="warehouse" class="form-control select2">
                            <option value="">Select Warehouse Location</option>
                            @foreach ($warehouses as $warehouse)
                                <option {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3"> -->
        <!-- <label for="warehouse_location" class="foncolor">Warehouse Location<i class="text-danger">*</i></label> -->
        <!-- <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse </option>
                            @foreach($warehouses as $warehouse)
                                <option {{ old('warehouse_name') == $warehouse->id ? 'selected' :'' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select> -->
        <!-- <select class="js-example-basic-single select2">
												<option selected="selected">Select Warehouse</option>
												<option></option>
												<option></option>
											</select>

                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->
        <!-- Vehicle Type  -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Vehicle Type <i class="text-danger">*</i></label>
                        <select name="vehicle_type" class="form-control select2" id="vehicle_type">
                            <option value="" disabled selected>Select Vehicle</option>
                            <option value="2 Wheeler" {{ old('vehicle_type') == '2 Wheeler' ? 'selected' : '' }}>2
                                Wheeler</option>
                            <option value="Van" {{ old('vehicle_type') == 'Van' ? 'selected' : '' }}>Van</option>
                            <option value="Container" {{ old('vehicle_type') == 'Container' ? 'selected' : '' }}>
                                Container
                            </option>
                            {{-- <option value="Truck" {{ old('vehicle_type') == 'Truck' ? 'selected' : '' }}>Truck</option>
                            <option value="Bike" {{ old('vehicle_type') == 'Bike' ? 'selected' : '' }}>Bike</option>
                            <option value="Pickup" {{ old('vehicle_type') == 'Pickup' ? 'selected' : '' }}>Pickup
                            </option>
                            <option value="Mini Truck" {{ old('vehicle_type') == 'Mini Truck' ? 'selected' : '' }}>Mini
                                Truck</option>
                            <option value="Three-Wheeler"
                                {{ old('vehicle_type') == 'Three-Wheeler' ? 'selected' : '' }}>Three-Wheeler</option>
                            <option value="SUV" {{ old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Sedan" {{ old('vehicle_type') == 'Sedan' ? 'selected' : '' }}>Sedan
                            </option>
                            <option value="Electric Scooter"
                                {{ old('vehicle_type') == 'Electric Scooter' ? 'selected' : '' }}>Electric Scooter
                            </option>
                            <option value="Cargo Plane" {{ old('vehicle_type') == 'Cargo Plane' ? 'selected' : '' }}>
                                Cargo Plane</option>
                            <option value="Cargo Ship" {{ old('vehicle_type') == 'Cargo Ship' ? 'selected' : '' }}>
                                Cargo Ship</option>
                            <option value="Train Cargo" {{ old('vehicle_type') == 'Train Cargo' ? 'selected' : '' }}>
                                Train Cargo</option> --}}
                        </select>
                        @error('vehicle_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_location" class="foncolor">Vehicle Type<i class="text-danger">*</i></label> -->
        <!-- <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse </option>
                            @foreach($warehouses as $warehouse)
                                <option {{ old('warehouse_name') == $warehouse->id ? 'selected' :'' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select> -->
        <!-- <select class="js-example-basic-single select2">
												<option selected="selected">Select Vehicle</option>
												<option></option>
												<option></option>
											</select>

                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->
        <!-- Vehicle Model  -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_model" class="foncolor">Vehicle Model <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_model" class="form-control"
                            placeholder="Enter Vehicle Model " value="{{ old('vehicle_model') }}">
                        @error('vehicle_model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

        <!-- Vehicle Manufactured year -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_year">Vehicle Manufactured year <i class="text-danger">*</i></label>
                        <input type="number" name="vehicle_year" class="form-control"
                            placeholder="Enter Vehicle Manufactured year" value="{{ old('vehicle_year') }}">
                        @error('vehicle_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

        <!-- Vehicle Number (Plate No.)  -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12 vehicle_number_input">
                    <div class="input-block mb-3">
                        <label for="vehicle_number">Vehicle Number (Plate No.) <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_number" class="form-control"
                            placeholder="Enter Vehicle Number (Plate No.) " value="{{ old('vehicle_number') }}">
                        @error('vehicle_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

        <!-- contaainer 1 -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12 container-inputs" style="display: none;">
                    <div class="input-block mb-3">
                        <label for="container_no_1">Container No.1 <i class="text-danger">*</i></label>
                        <input type="text" name="container_no_1" class="form-control" placeholder="Enter Container No.1"
                            value="{{ old('container_no_1') }}">
                        @error('container_no_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

        <!-- continer 2 -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12 container-inputs" style="display: none;">
                    <div class="input-block mb-3">
                        <label for="container_no_2">Container No.2 <i class="text-danger">*</i></label>
                        <input type="text" name="container_no_2" class="form-control" placeholder="Enter Container No.2"
                            value="{{ old('container_no_2') }}">
                        @error('container_no_2')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

        {{-- container size --}}
        <!-- <div class="col-lg-4 col-md-6 col-sm-12 container-inputs" style="display: none;">
                    <div class="input-block mb-3">
                        <label for="container_size">Container Size</label>
                        <select name="container_size" class="form-control select2" id="container_size">
                            <option value="" disabled selected>Select Container Size</option>
                            <option value="40" {{ old('container_size') == '40' ? 'selected' : '' }}>40</option>
                            <option value="20 feet" {{ old('container_size') == '20 feet' ? 'selected' : '' }}>20 feet</option>
                        
                        </select>
                        @error('container_size')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                 -->

        <!-- Vehicle Capacity -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="driver_id">Assigned Driver </label>
                        <select name="driver_id" id="driver_id" class="form-control select2">
                            <option value="" readonly>Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                        @error('vehicle_capacity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


        <!-- Status -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status">Status</label>
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
        </div> -->




        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="warehouse_location" class="foncolor">Warehouse Location <i
                                class="text-danger">*</i></label>
                        <select name="warehouse_name" class="js-example-basic-single select2" style="font-weight:400px !important">
                            <option value="">Select Warehouse </option>
                            @foreach($warehouses as $warehouse)
                                                    <option {{ old('warehouse_name') == $warehouse->id ? 'selected' : '' }} value="{{
                                $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>

                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Warehouse Code -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type" class="foncolor">Vehicle Type<i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_type" class="form-control inp" placeholder="Select Vehicle" >
                        @error('manager_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


                <!-- Vehicle Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="vehicle_type" class="foncolor">Vehicle Type <i class="text-danger">*</i></label>
                        <select id="vehicle_type" name="vehicle_type"
                            class="js-example-basic-single select2">
                            <option value="" class="fw-normal">Select Vehicle Type </option>
                            <option value="wheeler">2 Wheeler</option>
                            <option value="van">Van</option>
                            <option value="container">Container</option>

                        </select>

                        @error('vehicle_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vehicle Model -->

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_model" class="foncolor">Vehicle Model <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_model" class="form-control inp"
                            placeholder="Enter Vehicle Model" value="{{ old('vehicle_model') }}">
                        @error('vehicle_model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Vehicle Manufactured year -->

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_year" class="foncolor">Vehicle Manufactured year<i
                                class="text-danger">*</i></label>
                        <input type="vehicle_year" name="vehicle_year" class="form-control inp"
                            placeholder=" Enter Vehicle Manufactured year" value="{{ old('vehicle_year') }}">
                        @error('vehicle_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Vehicle Number -->

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_number" class="foncolor">Vehicle Number(Plate No.)<i
                                class="text-danger">*</i></label>
                        <input type="text" name="vehicle_number" id="vehicle_number" class="form-control inp"
                            placeholder=" Enter Vehicle No." value="{{ old('vehicle_number') }}">
                        @error('vehicle_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Container No.1 -->

                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs" style="display:none">
                    <div class="input-block mb-3">
                        <label for="container_no_1" class="foncolor">Container No.1<i class="text-danger">*</i></label>
                        <input type="text" name="container_no_1" id="container_no_1" class="form-control inp"
                            placeholder=" Enter Vehicle No." value="{{ old('vehicle_number') }}">
                        @error('vehicle_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Container No.2 -->

                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs" style="display:none">
                    <div class="input-block mb-3">
                        <label for="container_no_2" class="foncolor">Container No.2<i class="text-danger">*</i></label>
                        <input type="text" name="container_no_2" id="container_no_1" class="form-control inp"
                            placeholder=" Enter Vehicle No." value="{{ old('vehicle_number') }}">
                        @error('vehicle_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Container Size -->
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs" style="display:none">
                    <div class="mb-3">
                        <label for="container_size" class="foncolor">Container Size <i class="text-danger">*</i></label>
                        <select name="container_size" id="container_size" class="js-example-basic-single select2">
                            <option value="">Select Container Size</option>
                            <option>40"</option>
                            <option>20 feet</option>
                        </select>
                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12 ps-5">
                    <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                        <div class="mb-3 float-end">
                            <label for="in_status">Status</label>
                            <div class="status-toggle d-flex align-items-center">
                                <span id="inactiveText" class="bold">Active</span>
                                <input id="status" class="check" type="checkbox" name="status">
                                <label for="status" class="checktoggle checkbox-bg togc"></label>
                                <span id="activeText">Inactive</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="add-customer-btns text-end">
                <button type="button" onclick="redirectTo('{{route('admin.warehouses.index') }}')"
                    class="btn btn-outline-primary custom-btn">Cancel</button>
                <button type="submit" class="btn btn-primary ">Submit</button>

            </div>

    </form>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#vehicle_type').change(function() {
                let selectedValue = $(this).val();
                if (selectedValue === 'Container') {
                    $('.container-inputs').show(); // Show inputs
                    
                    $('label[for="vehicle_number"]').html('Seal Number <i class="text-danger">*</i>');
                    $('input[name="vehicle_number"]').attr('placeholder', 'Enter Seal Number');
                } else {
                    $('.container-inputs').hide(); // Hide inputs

                    $('label[for="vehicle_number"]').html('Vehicle Number (Plate No.) <i class="text-danger">*</i>');
                    $('input[name="vehicle_number"]').attr('placeholder', 'Enter Vehicle Number');
                }
            });

            // On Page Load (for validation errors)
            if ($('#vehicle_type').val() === 'Container') {
                $('.container-inputs').show();
                $('.vehicle_number_input').hide();
            } else {
                $('.container-inputs').hide();
            }
        });
    </script> -->


    <script>
        $(document).ready(function () {
            function toggleContainerFields() {
                let selectedValue = $('select[name="vehicle_type"]').val();

                if (selectedValue === 'container') {
                    $('.container-inputs').show();
                    $('label[for="vehicle_number"]').html('Seal Number <i class="text-danger">*</i>');
                    $('input[name="vehicle_number"]').attr('placeholder', 'Enter Seal Number');
                } else {
                    $('.container-inputs').hide();
                    $('label[for="vehicle_number"]').html('Vehicle Number (Plate No.) <i class="text-danger">*</i>');
                    $('input[name="vehicle_number"]').attr('placeholder', 'Enter Vehicle No.');
                }
            }
            toggleContainerFields();
            $('#vehicle_type').on('change', toggleContainerFields);
        });

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let statusToggle = document.getElementById("status");
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