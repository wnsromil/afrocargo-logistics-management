<x-app-layout>
    <x-slot name="header">
        Drivers Management
    </x-slot>

    <x-slot name="cardTitle">
        <p class="subhead">Edit Driver</p>
    </x-slot>

    <form action="{{ route('admin.drivers.update', $driver_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
             
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="company_name"> Driver ID</label>
                        <input type="text" class="form-control inp" id="unique_id" name="unique_id" style="background: #ececec;" placeholder=""
                            value="{{ $driver_data->unique_id }}" readonly>
                    </div>
                </div>
                    
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name">Warehouse Name<i class="text-danger">*</i></label>
                        <select name="warehouse_name" id="warehouseSelect" class="form-control inp select2">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                                <option {{ $driver_data->warehouse_id == $warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Warehouse Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="driver_name">Driver Name<i class="text-danger">*</i></label>
                        <input type="text" name="driver_name" class="form-control" placeholder="Enter Warehouse Code"
                            value="{{$driver_data->name ?? old('driver_name') }}">
                        @error('driver_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- <!-- Email -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="email">E-mail <i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Contact Number"
                            value="{{$driver_data->email ?? old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}

                <!-- Contact Number -->
                <div class="col-lg-4 col-md-6 col-sm-12 edit_mobile_code_driver">
                    <div class="input-block mb-3">
                        <label for="phone">Contact Number <i class="text-danger">*</i></label>
                        <div class="flaginputwrap">
                        <div class="customflagselect">
                            <select class="flag-select" name="mobile_number_code_id">
                                @foreach ($coutry as $key => $item)
                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                        data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                        data-length="{{ $item->phone_length ?? 10 }}"
                                        {{ $item->id == old('mobile_number_code_id', $driver_data->phone_code_id) ? 'selected' : '' }}>
                                        {{ $item->name }} +{{ $item->phonecode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="number" class="form-control flagInput inp"
                            placeholder="Enter Contact Number" name="mobile_number"
                            value="{{ old('mobile_number', $driver_data->phone) }}"
                            >
                        </div>
                        @error('mobile_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                   <div class="col-lg-4 col-md-6 col-sm-12 edit_mobile_code_driver">
                    <div class="input-block mb-3">
                        <label for="phone">Office Contact Number <i class="text-danger">*</i></label>
                        <div class="flaginputwrap">
                        <div class="customflagselect">
                            <select class="flag-select" name="alternative_mobile_number_code_id">
                                @foreach ($coutry as $key => $item)
                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                        data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                        data-length="{{ $item->phone_length ?? 10 }}"
                                        {{ $item->id == old('alternative_mobile_number_code_id', $driver_data->phone_2_code_id_id) ? 'selected' : '' }}>
                                        {{ $item->name }} +{{ $item->phonecode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="number" class="form-control flagInput inp"
                            placeholder="Enter Office Contact Number" name="alternative_mobile_number"
                            value="{{ old('alternative_mobile_number', $driver_data->phone_2) }}"
                            >
                        </div>
                        @error('alternative_mobile_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                
                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="address">Address<i class="text-danger">*</i> </label>
                        <input type="text" name="address_1" class="form-control" placeholder="Enter Address"
                            value="{{$driver_data->address ?? old('address_1') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone">Password </label>
                        <input type="text" name="password" class="form-control" placeholder="Enter Contact Number"
                            value="{{ old('password') }}">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone">Confirm Password </label>
                        <input type="text" name="confirm-password" class="form-control"
                            placeholder="Enter Contact Number" value="{{ old('confirm-password') }}">
                        @error('confirm-password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Vehicle</label>
                     <select name="vehicle_type" id="vehicleSelect" class="form-control select2">
                      <option value="">Select Vehicle</option>
                                {{-- Options will be loaded via JS --}}
                      </select>
                        @error('vehicle_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="license_number">License Number<i class="text-danger">*</i></label>
                        <input type="text" name="license_number" class="form-control" placeholder="Enter Address"
                            value="{{ $driver_data->license_number }}">
                        @error('license_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="edit_license_expiry_date">License Expiry Date<i class="text-danger">*</i></label>
                        <input type="text" name="edit_license_expiry_date" class="form-control" placeholder="MM-DD-YYYY" readonly style="cursor: pointer;"
                             value="{{ old('edit_license_expiry_date', $driver_data->license_expiry_date ? \Carbon\Carbon::parse($driver_data->license_expiry_date)->format('n/j/Y') : '') }}">
                        @error('edit_license_expiry_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- License Document -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="license_document">License Document <i class="text-danger">*</i></label>
                        <input type="file" name="license_document" id="license_document" class="form-control"
                            accept=".png, .jpg, .jpeg">
                
                        @error('license_document')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                
                        {{-- Image Preview Area --}}
                        <div id="license_preview_area" class="mt-2" style="{{ $driver_data->license_document ? '' : 'display:none;' }}">
                            <img id="license_preview_img"
                                src="{{ $driver_data->license_document ? asset($driver_data->license_document) : '' }}"
                                alt="Preview"
                                style="max-width: 200px; max-height: 150px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            <button type="button" class="btn btn-sm btn-danger ms-2" id="remove_license_btn">✕</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="license_image_removed" id="license_image_removed" value="0">
                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="in_status">Status</label>
                        <div class="status-toggle d-flex align-items-center">
                            <span id="inactiveText" class="bold">Active</span>
                            <input id="cb-switch" class="check" type="checkbox" name="status" value="Active"
                            {{ old('status', $driver_data->status) == 'Inactive' ? 'checked' : '' }}>
                            <label for="cb-switch" class="checktoggle checkbox-bg togc"></label>
                            <span id="activeText">Inactive</span>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status">Status</label>
                        <div class="toggle-switch">
                            <label for="cb-switch">
                                <input type="checkbox" id="cb-switch" name="status" value="Active" @checked($driver_data->status === 'Active')>
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

            <input type="hidden" name="vehicle_id_hidden"
            value="{{ old('vehicle_id_hidden', $driver_data->vehicle_id) }}" class="form-control inp"
            placeholder="0" readonly style="background: #ececec;">

          <input type="hidden" name="latitude"
            value="{{ old('latitude', $driver_data->latitude) }}" class="form-control inp"
            placeholder="0" readonly style="background: #ececec;">

          <input type="hidden" name="longitude"
            value="{{ old('longitude', $driver_data->longitude) }}" class="form-control inp"
            placeholder="0" readonly style="background: #ececec;">

        <div class="add-customer-btns text-end">
            <button type="button" onclick="redirectTo('{{route('admin.drivers.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>
            @can('has-dynamic-permission', 'drivers.edit')
            <button type="submit" class="btn btn-primary">Update</button>
            @endcan
        </div>
        <!-- <div class="add-customer-btns text-end">
            <a href="{{ route('admin.drivers.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save">Update</button>
        </div> -->
    </form>

    @section('script')
    <script>
        const fileInput = document.querySelector('input[name="license_document"]');
        const previewArea = document.getElementById('license_preview_area');
        const previewImg = document.getElementById('license_preview_img');
        const removeBtn = document.getElementById('remove_license_btn');
        const imageRemovedInput = document.getElementById('license_image_removed'); // Hidden input
    
        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewArea.style.display = 'block';
                };
                reader.readAsDataURL(file);
    
                // Nayi file aayi to imageRemovedInput reset karo
                imageRemovedInput.value = '0';
            }
        });
    
        removeBtn.addEventListener('click', function () {
            fileInput.value = ''; // Remove selected file
            previewImg.src = '';
            previewArea.style.display = 'none';
            imageRemovedInput.value = '1'; // Mark image as removed
        });
    </script>
    <script>
        $('#country_code').val($('.edit_mobile_code_driver').find('.iti__selected-dial-code').text());
        $('.col-md-12').on('click', () => {            
            $('#country_code').val($('.edit_mobile_code_driver').find('.iti__selected-dial-code').text());
        })
    </script>
    <script>
         $(document).ready(function () {
                function initializeIntlTelInput(inputId, hiddenInputId, defaultCountry) {
                    let input = document.querySelector(inputId);
                    let iti = window.intlTelInput(input, {
                        initialCountry: defaultCountry ? defaultCountry.toLowerCase() : "us", // Default 'IN' (India)
                        separateDialCode: true,
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
                    });

                    // Set hidden input value on load
                    if (defaultCountry) {
                        let dialCode = iti.getSelectedCountryData().dialCode;
                        $(hiddenInputId).val("+" + dialCode);
                    }

                    // Update country code when user selects a different country
                    input.addEventListener("countrychange", function () {
                        let dialCode = iti.getSelectedCountryData().dialCode;
                        $(hiddenInputId).val("+" + dialCode);
                    });
                }
                // Initialize for both mobile fields
                initializeIntlTelInput("#edit_mobile_code", "#country_code", "{{ $driver_data->country_code }}");
            });
     </script>
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
        let selectedWarehouseId = '{{ old("warehouse_name", $driver_data->warehouse_id) }}';
        let selectedVehicleId = '{{ old("vehicle_type", $driver_data->vehicle_id) }}';

        function loadVehicles(warehouseId, selectedVehicle = null) {
            if (warehouseId) {
                $.ajax({
                    url: '/api/warehouse-vehicles/' + warehouseId,
                    type: 'GET',
                    success: function (response) {
                        let vehicles = response.data || [];
                        $('#vehicleSelect').empty().append('<option value="">Select Vehicle</option>');

                        $.each(vehicles, function (key, vehicle) {
                            let vehicleLabel = vehicle.vehicle_type.id == 1
                                ? vehicle.container_no_1
                                : (vehicle.vehicle_number ?? 'N/A');

                            let vehicleTypeText = vehicle.vehicle_type.id == 1 ? 'Container' : vehicle.vehicle_type.name;
                            let selected = (vehicle.id == selectedVehicle) ? 'selected' : '';

                            let option = '<option value="' + vehicle.id + '" ' + selected + '>' +
                                vehicleTypeText + ' (' + vehicleLabel + ')' +
                                '</option>';

                            $('#vehicleSelect').append(option);
                        });

                        $('#vehicleSelect').trigger('change.select2');
                    },
                    error: function () {
                        $('#vehicleSelect').empty().append('<option value="">No Vehicle Found</option>');
                    }
                });
            } else {
                $('#vehicleSelect').empty().append('<option value="">Select Vehicle</option>');
            }
        }

        // 1. Load vehicles on page load if warehouse already selected
        if (selectedWarehouseId) {
            loadVehicles(selectedWarehouseId, selectedVehicleId);
        }

        // 2. On warehouse change (manual)
        $('#warehouseSelect').on('change', function () {
            let warehouseId = $(this).val();
            loadVehicles(warehouseId, null); // reset vehicle select
        });
    });
    </script>
    @endsection

</x-app-layout>