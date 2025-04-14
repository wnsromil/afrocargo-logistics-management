<x-app-layout>
    @section('style')
    <style>

    </style>

    @endsection
    <x-slot name="header">
        Warehouse
    </x-slot>

    <x-slot name="cardTitle">
        Edit Warehouse
    </x-slot>

    <form action="{{ route('admin.warehouse_manager.update',$manager_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name">Warehouse Name <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                                <option {{ $manager_data->warehouse_id ?? old('warehouse_name')  == $warehouse->id ? 'selected' :'' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
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
                        <label for="manager_name">Warehouse Manage Name<i class="text-danger">*</i></label>
                        <input type="text" name="manager_name" class="form-control" placeholder="Enter Warehouse Code"  value="{{$manager_data->name ?? old('manager_name') }}">
                        @error('manager_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="email">E-mail <i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Contact Number"
                            value="{{$manager_data->email ?? old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Contact Number -->
                <div class="col-lg-4 col-md-6 col-sm-12 edit_mobile_code_manger">
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
                        <label for="address">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address"
                        value="{{$manager_data->address ?? old('address') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Status -->

                <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                    <div class="mb-3 float-end">
                        <label for="in_status">Status</label>
                        <div class="d-flex align-items-center text-dark">
                            <p class="profileUpdateFont" id="activeText">Active</p>
                            <div class="status-toggle px-2">
                                <input id="rating_6" class="check" type="checkbox" name="status" 
                                    value="Active" @checked($manager_data->status === 'Inactive') 
                                    onchange="updateStatusValue()">
                                <label for="rating_6" class="checktoggle log checkbox-bg">checkbox</label>
                            </div>
                            <p class="profileUpdateFont faded" id="inactiveText">Inactive</p>
                        </div>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="add-customer-btns text-end">

            <button type="button" onclick="redirectTo('{{route('admin.warehouse_manager.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>

            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>
    </form>
    <script>
        $('#country_code').val($('.edit_mobile_code_manger').find('.iti__selected-dial-code').text());
        $('.col-md-12').on('click', () => {            
            $('#country_code').val($('.edit_mobile_code_manger').find('.iti__selected-dial-code').text());
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
</x-app-layout>