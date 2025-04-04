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
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block fwNormal mb-3">
                        <label for="warehouse_location" class="foncolor">Warehouse Location <i
                                class="text-danger">*</i></label>
                        <select name="warehouse_name" class="js-example-basic-single select2">
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

                <!-- Vehicle Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type" class="foncolor">Vehicle Type <i class="text-danger">*</i></label>
                        <select id="vehicle_type" name="vehicle_type"
                            class="js-example-basic-single select2 profileUpdateFont">
                            <option value="" class="fw-normal">Select Vehicle Type</option>
                            <option value="2 Wheeler" {{ old('vehicle_type') == 'wheeler' ? 'selected' : '' }}>2 Wheeler
                            </option>
                            <option value="Van" {{ old('vehicle_type') == 'van' ? 'selected' : '' }}>Van</option>
                            <option value="Container" {{ old('vehicle_type') == 'Container' ? 'selected' : '' }}>Container
                            </option>
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

                {{-- Vehicle Number --}}
                <div class="col-lg-4 col-md-6 col-sm-12 vehicle-number-field">
                    <div class="input-block mb-3">
                        <label for="vehicle_number" class="foncolor">Vehicle Number (Plate No.) <i
                                class="text-danger">*</i></label>
                        <input type="text" name="vehicle_number" id="vehicle_number" class="form-control inp"
                            placeholder="Enter Vehicle No." value="{{ old('vehicle_number') }}">
                        @error('vehicle_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Seal Number --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field" style="display: none;">
                    <div class="input-block mb-3">
                        <label for="seal_no" class="foncolor">Seal Number <i class="text-danger">*</i></label>
                        <input type="text" name="seal_no" id="seal_no" class="form-control inp"
                            placeholder="Enter Seal Number" value="{{ old('seal_no') }}">
                        @error('seal_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Container No.1 -->

                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-no-1-field" style="display:none">
                    <div class="input-block mb-3">
                        <label for="container_no_1" class="foncolor">Container No.1<i class="text-danger">*</i></label>
                        <input type="text" name="container_no_1" id="container_no_1" class="form-control inp"
                            placeholder=" Enter Vehicle No." value="{{ old('container_no_1') }}">
                        @error('container_no_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Container No.2 -->

                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-no-2-field" style="display:none">
                    <div class="input-block mb-3">
                        <label for="container_no_2" class="foncolor">Container No.2<i class="text-danger">*</i></label>
                        <input type="text" name="container_no_2" id="container_no_1" class="form-control inp"
                            placeholder=" Enter Vehicle No." value="{{ old('container_no_2') }}">
                        @error('container_no_2')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Container Size -->
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-size-field" style="display:none">
                    <div class="input-block mb-3">
                        <label for="container_size" class="foncolor">Container Size <i class="text-danger">*</i></label>
                        <select name="container_size" id="container_size" class="js-example-basic-single select2">
                            <option value="">Select Container Size</option>
                            <option>40 feet</option>
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
    <script>
        $(document).ready(function () {
            function toggleContainerFields() {
                let selectedValue = $('#vehicle_type').val();

                if (selectedValue === 'Container') {
                    $('.seal-no-field').show();
                    $('.container-no-1-field').show();
                    $('.container-no-2-field').show();
                    $('.container-size-field').show();
                    $('.vehicle-number-field').hide();
                } else {
                    $('.seal-no-field').hide();
                    $('.container-no-1-field').hide();
                    $('.container-no-2-field').hide();
                    $('.container-size-field').hide();
                    $('.vehicle-number-field').show();
                }
            }

            toggleContainerFields(); // On page load
            $('#vehicle_type').on('change', toggleContainerFields); // On dropdown change
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