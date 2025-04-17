<x-app-layout>
    <x-slot name="header">
        Drivers Management
    </x-slot>

    <x-slot name="cardTitle">
        <p class="subhead">Edit Driver</p>
    </x-slot>

    <form action="{{ route('admin.drivers.update', $manager_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name">Warehouse Name<i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                                <option {{ $manager_data->warehouse_id ?? old('warehouse_name') == $warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
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
                            value="{{$manager_data->name ?? old('driver_name') }}">
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
                            value="{{$manager_data->email ?? old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}

                <!-- Contact Number -->
                <div class="col-lg-4 col-md-6 col-sm-12 edit_mobile_code_driver">
                    <div class="input-block mb-3">
                        <label for="phone">Contact Number <i class="text-danger">*</i></label>
                        <input type="text" id="edit_mobile_code" name="edit_mobile_code" class="form-control" placeholder="Enter Contact Number"
                        value="{{$manager_data->phone ?? old('edit_mobile_code') }}">
                        @error('edit_mobile_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" id="country_code" name="country_code"
                        value="{{ old('country_code', $manager_data->country_code) }}">

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="address">Address </label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address"
                            value="{{$manager_data->address ?? old('address') }}">
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
                        <select name="vehicle_type" class="form-control">
                            <option value="">Select Vehicle</option>
                            @foreach($Vehicle_data as $Vehicle)
                                <option {{ $manager_data->vehicle_id == $Vehicle->id ? 'selected' : '' }}
                                    value="{{ $Vehicle->id }}">{{ $Vehicle->vehicle_type }}</option>
                            @endforeach
                        </select>
                        @error('vehicle_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="license_number">License Number</label>
                        <input type="text" name="license_number" class="form-control" placeholder="Enter Address"
                            value="{{ $manager_data->license_number }}">
                        @error('license_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="license_expiry_date">License Expiry Date</label>
                        <input type="date" name="license_expiry_date" class="form-control" placeholder="Enter Address"
                            value="{{ $manager_data->license_expiry_date  }}">
                        @error('license_expiry_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="license_document">License Document</label>
                        <input type="file" name="license_document" class="form-control" placeholder="Enter Address"
                            value="{{ old('license_document') }}" accept=".png, .jpg, .jpeg">
                        @error('license_document')
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
                            {{ old('status', $manager_data->status) == 'Inactive' ? 'checked' : '' }}>
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
                                <input type="checkbox" id="cb-switch" name="status" value="Active" @checked($manager_data->status === 'Active')>
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

        <div class="add-customer-btns text-end">
            <button type="button" onclick="redirectTo('{{route('admin.drivers.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        <!-- <div class="add-customer-btns text-end">
            <a href="{{ route('admin.drivers.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save">Update</button>
        </div> -->
    </form>
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
                initializeIntlTelInput("#edit_mobile_code", "#country_code", "{{ $manager_data->country_code }}");
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
</x-app-layout>