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

    <form action="{{ route('admin.warehouses.update', $warehouse->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <label class="foncolor" for="company_name">Warehouse ID</label>
                    <input type="text" class="form-control inp" style="background: #ececec;" placeholder=""
                        value="{{ $warehouse->unique_id }}" readonly>
                </div>

                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name">Warehouse Name <i class="text-danger">*</i></label>
                        <input type="text" name="warehouse_name" class="form-control" placeholder="Enter Warehouse Name"
                            value="{{$warehouse->warehouse_name ?? old('warehouse_name') }}">
                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Warehouse Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_code">Warehouse Code <i class="text-danger">*</i></label>
                        <input type="text" name="warehouse_code" class="form-control" placeholder="Enter Warehouse Code"
                            value="{{ $warehouse->warehouse_code ?? old('warehouse_code') }}">
                        @error('warehouse_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="address">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address_1" class="form-control" placeholder="Enter Address"
                            value="{{ $warehouse->address ?? old('address_1') }}">
                        @error('address_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Country -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="country_id">Country <i class="text-danger">*</i></label>
                        <input type="text" name="country" value="{{ old('country', $warehouse->country_id) }}"
                            class="form-control inp" readonly style="background: #ececec;">
                        @error('country')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                </div>

                <!-- State -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="state_id">State <i class="text-danger">*</i></label>
                        <input type="text" name="state" value="{{ old('country', $warehouse->state_id) }}"
                            class="form-control inp" readonly style="background: #ececec;">
                        @error('state')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- City -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="city">City<i class="text-danger">*</i></label>
                        <input type="text" name="city" value="{{ old('country', $warehouse->city_id) }}"
                            class="form-control inp" readonly style="background: #ececec;">
                        @error('city')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Zip Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Zip_code">Zip Code</label>
                        <input type="text" name="Zip_code" class="form-control" placeholder="Enter Zip Code"
                            value="{{ $warehouse->zip_code ?? old('Zip_code') }}">
                        @error('Zip_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Contact Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone">Contact Number <i class="text-danger">*</i></label>
                        <input type="text" name="mobile_code" id="edit_mobile_code" class="form-control"
                            placeholder="Enter Contact Number" value="{{ $warehouse->phone ?? old('phone') }}">
                        @error('mobile_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <input type="hidden" id="country_code" name="country_code"
                    value="{{ old('country_code', $warehouse->country_code) }}">
                <!-- Status -->

                <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                    <div class="mb-3 float-end">
                        <label for="in_status">Status</label>
                        <div class="d-flex align-items-center text-dark">
                            <p class="profileUpdateFont" id="activeText">Active</p>
                            <div class="status-toggle px-2">
                                <input id="rating_6" class="check" type="checkbox" name="status" value="Active"
                                    @checked($warehouse->status === 'Inactive') onchange="updateStatusValue()">
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

            <button type="button" onclick="redirectTo('{{route('admin.warehouses.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>

            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>
    </form>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            var selectedCountry = "{{ $warehouse->country_id }}";
            var selectedState = "{{ $warehouse->state_id }}";
            var selectedCity = "{{ $warehouse->city_id }}";


            // Load States Automatically
            if (selectedCountry) {
                $.ajax({
                    url: "{{ url('api/get-states') }}/" + selectedCountry,
                    method: "GET",
                    success: function (response) {
                        //  $('#state').append('<option value="">Select State</option>');
                        $.each(response, function (key, value) {
                            let selected = (value.id == selectedState) ? 'selected' : '';
                            $('#state').append(
                                `<option value="${value.id}" ${selected}>${value.name}</option>`
                            );
                        });

                        // 🔥 Automatically Load Cities When State is Selected
                        if (selectedState) {
                            loadCities(selectedState);
                        }
                    }
                });
            }

            //  On State Change Load Cities
            $('#state').on('change', function () {
                var stateId = $(this).val();
                loadCities(stateId);
            });

            function loadCities(stateId) {
                $.ajax({
                    url: "{{ url('api/get-cities') }}/" + stateId,
                    method: "GET",
                    success: function (response) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(response, function (key, value) {
                            let selected = (value.id == selectedCity) ? 'selected' : '';
                            $('#city').append(
                                `<option value="${value.id}" ${selected}>${value.name}</option>`
                            );
                        });
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            function initializeIntlTelInput(inputId, hiddenInputId, defaultCountryCode) {
                const input = document.querySelector(inputId);

                const iti = window.intlTelInput(input, {
                    initialCountry: defaultCountryCode ? defaultCountryCode.toLowerCase() : "us",
                    separateDialCode: true,
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
                });

                // After plugin initializes, set the hidden input to the correct dial code
                setTimeout(() => {
                    const dialCode = iti.getSelectedCountryData().dialCode;
                    if (dialCode) {
                        $(hiddenInputId).val("+" + dialCode);
                    }
                }, 200);

                // Update hidden input on country change
                input.addEventListener("countrychange", function () {
                    const dialCode = iti.getSelectedCountryData().dialCode;
                    if (dialCode) {
                        $(hiddenInputId).val("+" + dialCode);
                    }
                });
            }

            // Laravel should pass 2-letter country code like 'IN', 'US', 'GB'
            initializeIntlTelInput("#edit_mobile_code", "#country_code", "{{ $warehouse->country_code ?? 'US' }}");
        });
    </script>
</x-app-layout>