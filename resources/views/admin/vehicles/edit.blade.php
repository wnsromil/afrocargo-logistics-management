<x-app-layout>

    <x-slot name="header">
        Vehicle Management
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Update Vehicle</p>
        </div>
    </x-slot>

           @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    <form action="{{ route('admin.vehicle.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

         @php
            $role_id = Auth::user()->role_id;
         @endphp

        <div class="form-group-customer customer-additional-form">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <label class="foncolor" for="company_name"> Vehicle ID</label>
                    <input type="text" class="form-control inp" style="background: #ececec;"
                        placeholder="" value="{{ $vehicle->unique_id }}" readonly>
                </div>

                <!-- Warehouse Location -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_location" class="foncolor">Warehouse Location</label>
                        <select name="warehouse_id" class="js-example-basic-single select2">
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
              
                @if($role_id == 1)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="vehicle_type" class="foncolor">Vehicle Type <i class="text-danger">*</i></label>
                            <select id="vehicle_type" name="vehicle_type" class="profileUpdateFont">
                                <option value="">Select Vehicle Type</option>
                                @foreach($viewVehicleTypes as $viewVehicleType)
                                    <option {{ old('vehicle_type', $vehicle->vehicle_type) == $viewVehicleType->name ? 'selected' : '' }}
                                        value="{{ $viewVehicleType->name }}">
                                        {{ $viewVehicleType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_type')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                @else
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="vehicle_type" class="foncolor">Vehicle Type <i class="text-danger">*</i></label>
                            <select id="vehicle_types" name="vehicle_type"
                                class="js-example-basic-single select2 form-control profileUpdateFont">
                                <option value="">Select Vehicle Type</option>
                                @foreach($viewVehicleTypes as $viewVehicleType)
                                    <option {{ old('vehicle_type', $vehicle->vehicle_type) == $viewVehicleType->name ? 'selected' : '' }}
                                        value="{{ $viewVehicleType->name }}">
                                        {{ $viewVehicleType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
        
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

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="licence_plate_number" class="foncolor">Licence Plate Number<i
                                class="text-danger">*</i></label>
                        <input type="licence_plate_number" name="licence_plate_number" class="form-control inp"
                            placeholder=" Enter Vehicle Manufactured year" value="{{ old('licence_plate_number', $vehicle->licence_plate_number) }}">
                        @error('licence_plate_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                 <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="edit_license_expiry_date" class="foncolor">Licence Plate Expire Date<i
                                class="text-danger">*</i></label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input readonly style="cursor: pointer;" type="text" name="edit_license_expiry_date"
                                class="btn-filters  form-cs inp " 
                                value="{{ old('edit_license_expiry_date', $vehicle->licence_plate_exp_date ? \Carbon\Carbon::parse($vehicle->licence_plate_exp_date)->format('n/j/Y') : '') }}"
                                placeholder="mm-dd-yy" />
                        </div>
                        @error('edit_license_expiry_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

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

                  <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="input-block">
                     <label class="table-content col737 fw-medium">Vehicle Registration Document<i
                                class="text-danger">*</i></label>
                        <div class="input-block mb-3 service-upload img-size2 mb-0">
                    <!-- Preview Image -->
                    <img id="vehicle_registration_doc_img_preview"
                        src="{{ !empty($vehicle->vehicle_registration_doc) ? asset('storage/' . $vehicle->vehicle_registration_doc) : '' }}"
                        alt="vehicle_registration_doc Image"
                        class="img-thumbnail mb-2 {{ empty($vehicle->vehicle_registration_doc) ? 'd-none' : '' }}"
                        style="max-width: 150px; height: auto;">

                    <!-- Hidden File Input -->
                    <input type="file" name="vehicle_registration_doc" id="vehicle_registration_doc_image" class="d-none">

                    <!-- Action Icons -->
                    <div>
                        <img src="{{ asset('assets/img/edit (1).png') }}" alt="Edit" style="cursor: pointer;" onclick="openImagePicker()">
                        <img src="{{ asset('assets/img/dlt (1).png') }}" alt="Delete" style="cursor: pointer;" onclick="removeImage()">
                    </div>

                    <!-- Delete Flag -->
                    <input type="hidden" name="vehicle_registration_doc_delete_img" id="vehicle_registration_doc_delete_img" value="0">
                      </div>
                </div>
                  @error('vehicle_registration_doc')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                 </div>

                   <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="input-block">
                     <label class="table-content col737 fw-medium">Vehicle Insurance Document<i
                                class="text-danger">*</i></label>
                        <div class="input-block mb-3 service-upload img-size2 mb-0">
                    <!-- Preview Image -->
                    <img id="vehicle_insurance_doc_img_preview"
                        src="{{ !empty($vehicle->vehicle_insurance_doc) ? asset('storage/' . $vehicle->vehicle_insurance_doc)  : '' }}"
                        alt="vehicle_insurance_doc Image"
                        class="img-thumbnail mb-2 {{ empty($vehicle->vehicle_insurance_doc) ? 'd-none' : '' }}"
                        style="max-width: 150px; height: auto;">

                    <!-- Hidden File Input -->
                    <input type="file" name="vehicle_insurance_doc" id="vehicle_insurance_doc_image" class="d-none">

                    <!-- Action Icons -->
                    <div>
                        <img src="{{ asset('assets/img/edit (1).png') }}" alt="Edit" style="cursor: pointer;" onclick="openImagePickerVehicleInsurance()">
                        <img src="{{ asset('assets/img/dlt (1).png') }}" alt="Delete" style="cursor: pointer;" onclick="removeImageVehicleInsurance()">
                    </div>

                    <!-- Delete Flag -->
                    <input type="hidden" name="vehicle_insurance_doc_delete_img" id="vehicle_insurance_doc_delete_img" value="0">
                      </div>
                </div>
                  @error('vehicle_insurance_doc')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                 </div>

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

    @section('script')
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
     <script>
           $(document).ready(function () {
                $('#vehicle_type').select2({
                    tags: true,
                    placeholder: 'Select or type vehicle type',
                    allowClear: true
                });
            });
        function openImagePicker() {
            document.getElementById('vehicle_registration_doc_image').click();
        }

        document.getElementById('vehicle_registration_doc_image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('vehicle_registration_doc_img_preview');
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                preview.style.display = 'inline-block';
                preview.style.maxWidth = '150px';
                preview.style.height = 'auto';
            };
            reader.readAsDataURL(file);

            // Reset delete flag
            document.getElementById('vehicle_registration_doc_delete_img').value = '0';
         });

        function removeImage() {
            const preview = document.getElementById('vehicle_registration_doc_img_preview');
            const fileInput = document.getElementById('vehicle_registration_doc_image');
            const deleteInput = document.getElementById('vehicle_registration_doc_delete_img');

            preview.src = '';
            preview.classList.add('d-none');
            fileInput.value = '';
            deleteInput.value = '1';
          }

        function openImagePickerVehicleInsurance() {
            document.getElementById('vehicle_insurance_doc_image').click();
        }

           document.getElementById('vehicle_insurance_doc_image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('vehicle_insurance_doc_img_preview');
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                preview.style.display = 'inline-block';
                preview.style.maxWidth = '150px';
                preview.style.height = 'auto';
            };
            reader.readAsDataURL(file);

            // Reset delete flag
            document.getElementById('vehicle_insurance_doc_delete_img').value = '0';
         });

        

          function removeImageVehicleInsurance() {
            const preview = document.getElementById('vehicle_insurance_doc_img_preview');
            const fileInput = document.getElementById('vehicle_insurance_doc_image');
            const deleteInput = document.getElementById('vehicle_insurance_doc_delete_img');

            preview.src = '';
            preview.classList.add('d-none');
            fileInput.value = '';
            deleteInput.value = '1';
          }
          
     </script>
     @endsection
</x-app-layout>