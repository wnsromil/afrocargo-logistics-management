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
                        <input type="text" name="address" class="form-control" placeholder="Enter Address"
                            value="{{ $warehouse->address ?? old('address') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Country -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="country_id">Country <i class="text-danger">*</i></label>

                        <select name="country_id" id="country" class="form-control select2">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option {{$warehouse->country_id == $country->id ? 'selected' : ''}} value="{{ $country->id }}">
                                    {{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- State -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="state_id">State <i class="text-danger">*</i></label>
                        <select name="state_id" id="state" class="form-control select2">
                            <option value="">Select State</option>
                        </select>
                        @error('state_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- City -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="city_id">City <i class="text-danger">*</i></label>
                        <select name="city_id" id="city" class="form-control select2">
                            <option value="">Select City</option>
                        </select>
                        @error('city_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Zip Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="zip_code">Zip Code <i class="text-danger">*</i></label>
                        <input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code"
                            value="{{ $warehouse->zip_code ?? old('zip_code') }}">
                        @error('zip_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 edit_mobile_code_class mb-2" style="display: grid;">
                    <label class="foncolor" for="edit_mobile_code">Contact Number <i class="text-danger">*</i></label>
                    <input type="tel" id="edit_mobile_code" value="{{ old('mobile_code', $warehouse->phone) }}"
                        class="form-control inp" placeholder="Enter Mobile Number" name="mobile_code"
                        oninput="this.value = this.value.slice(0, 10)">
                    @error('mobile_code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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