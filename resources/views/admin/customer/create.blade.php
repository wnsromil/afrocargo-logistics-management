<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Customer') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Customer</p>
        </div>
    </x-slot>
    <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 align-items-stretch">
            <div class="col-md-6 mb-2 align-items-stretch">
                <div class="borderset">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="company_name"> Company </label>
                            <input type="text" name="company_name" class="form-control inp"
                                placeholder="Enter Company Name" value="{{ old('company_name') }}">

                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="first_name">Full Name <i class="text-danger">*</i></label>
                            <input type="text" name="first_name" class="form-control inp" placeholder="Enter Full Name"
                                value="{{ old('first_name') }}">
                            @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2 mobile_code">
                            <label class="foncolor">Mobile No.<span class="text-danger">*</span></label>
                            <input type="tel" id="mobile_code" name="mobile_code" class="form-control inp"
                                placeholder="Enter Mobile No." value="{{ old('mobile_code') }}"
                                oninput="this.value = this.value.slice(0, 10)">
                            @error('mobile_code')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <input type="hidden" id="country_code" name="country_code">

                        <div class="col-md-12 mb-2 alternate_mobile_no">
                            <label class="foncolor" for="alternate_mobile_no">Alternate Mobile No.</label>
                            <input type="tel" id="alternate_mobile_no" name="alternate_mobile_no" class="form-control inp"
                                value="{{ old('alternate_mobile_no') }}" placeholder="Enter Alternate Mobile No."
                                oninput="this.value = this.value.slice(0, 10)">
                        </div>

                        <input type="hidden" id="country_code_2" name="country_code_2">
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="address_1">Address 1 <i class="text-danger">*</i></label>
                            <input type="text" name="address_1" value="{{ old('address_1') }}" class="form-control inp"
                                placeholder="Enter Address 1">
                            @error('address_1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Address_2">Address 2 </label>
                            <input type="text" name="Address_2" value="{{ old('Address_2') }}" class="form-control inp"
                                placeholder="Enter Address 2">
                        </div>


                        <div class="col-md-6 mb-2">
                            <label class="foncolor" for="Apartment">Apartment </label>
                            <input type="text" name="Apartment" value="{{ old('Apartment') }}" class="form-control inp"
                                placeholder="Enter Apartment">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                            <select id="country" name="country" class="js-example-basic-single select2">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="foncolor" for="state">State <i class="text-danger">*</i></label>
                            <select id="state" name="state" class="js-example-basic-single select2">
                                <option value="">Select State</option>
                                @if (old('state'))
                                    <option value="{{ old('state') }}" selected>{{ old('state') }}</option>
                                @endif
                            </select>
                            @error('state')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                            <select id="city" name="city" class="js-example-basic-single select2">
                                <option value="">Select City</option>
                                @if (old('city'))
                                    <option value="{{ old('city') }}" selected>{{ old('city') }}</option>
                                @endif
                            </select>
                            @error('city')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="foncolor" for="Zip_code">Zipcode <i class="text-danger">*</i></label>
                            <input type="text" name="Zip_code" value="{{ old('Zip_code') }}" class="form-control inp"
                                placeholder="Enter Zip">
                            @error('Zip_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor " for="username">Username <i class="text-danger">*</i></label>
                            <input type="text" name="username" value="{{ old('username') }}"
                                class="form-control inp inputbackground" placeholder="Enter User Name">
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- <div class="col-md-12 mb-2">
                            <label class="foncolor" for="password">Password <i class="text-danger">*</i></label>
                            <div class="d-flex position-relative"
                                style="border: 1px solid #00000042 !important; border-radius: 4px;">
                                <input type="password" id="password" name="password" class="form-control pass-input inp"
                                    style="border: none !important" placeholder="Enter Password">
                                <span toggle="#password" class="ti ti-eye field-icon toggle-password1"></span>
                            </div>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="password_confirmation">Confirm New Password <i
                                    class="text-danger">*</i></label>
                            <div class="d-flex position-relative"
                                style="border: 1px solid #00000042 !important; border-radius: 4px;">
                                <input id="password1" type="password" name="password_confirmation"
                                    class="form-control pass-input inp" style="border: none !important"
                                    placeholder="Enter Confirm New Password">
                                <span toggle="#password1" class="ti ti-eye field-icon toggle-password1"></span>
                            </div>
                            @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}


                        <div class="col-md-6 mb-2">
                            <label class="foncolor " for="latitude">Latitude <i class="text-danger">*</i></label>
                            <input type="number" name="latitude" value="{{ old('latitude') }}"
                                class="form-control inp inputbackground" placeholder="0">
                            @error('latitude')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="foncolor " for="longitude">Longitude <i class="text-danger">*</i></label>
                            <input type="number" name="longitude" value="{{ old('longitude') }}"
                                class="form-control inp inputbackground" placeholder="0">
                            @error('longitude')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="foncolor mt-0 pt-0" for="website_url">Website</label>
                            <input type="text" name="website_url" class="form-control inp"
                                value="{{ old('website_url') }}" placeholder="Enter Website ID">

                        </div>

                        <!-- first left side form clouser div is next  -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2 align-items-stretch">
                <div class="borderset">
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="email">Email<i class="text-danger">*</i></label>
                            <input type="text" name="email" class="form-control inp" placeholder="Enter Email ID"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @php
                            $isSingleWarehouse = count($warehouses) === 1;
                        @endphp

                        @if($isSingleWarehouse)
                            {{-- ✅ Readonly Input for Single Warehouse --}}
                            <div class="col-md-12 mb-2">
                                <label class="foncolor" for="warehouse"> Warehouse </label>
                                <input type="text" class="form-control" value="{{ $warehouses[0]->warehouse_name }}"
                                    readonly style="background-color: #e9ecef; color: #6c757d;">
                                <input type="hidden" name="warehouse_id" value="{{ $warehouses[0]->id }}">
                            </div>
                        @else
                            {{-- ✅ Select Dropdown for Multiple Warehouses --}}
                            <div class="col-md-12 mb-2">
                                <label class="foncolor" for="warehouse"> Warehouse </label>
                                <select class="js-example-basic-single select2 form-control" name="warehouse_id" style="">
                                    <option value="">Select Warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                            {{ $warehouse->warehouse_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif


                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="container">Group Container </label>
                            <select class="js-example-basic-single select2" name="container_id"
                                value="{{ old('container_id') }}">
                                <option value="">Select Container</option>
                                @foreach ($containers as $container)
                                <option value="{{ $container->id }}" {{ old('container_id') == $container->id ? 'selected' : '' }}>
                                    {{ $container->container_no_1 }}
                                </option>
                              @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="foncolor mt-0 pt-0">Signature Date </label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text" name="signature_date"  readonly style="cursor: pointer;"
                                    class="btn-filters  form-cs inp  inputbackground"
                                    value="{{ old('signature_date') }}" placeholder="mm-dd-yy" />
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor " for="Year_to_Date">Year to Date</label>
                            <input type="text" name="year_to_date" id="Year to Date"
                                class="form-control inp inputbackground" placeholder="0"
                                value="{{ old('year_to_date') }}">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="foncolor " for="License_ID">License ID</label>
                            <input type="text" id="License_ID" name="license_number"
                                class="form-control inp inputbackground" value="{{ old('license_number') }}"
                                placeholder="Enter License ID">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="foncolor mt-0 pt-0">License Expiry Date </label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input  readonly style="cursor: pointer;" type="text" name="license_expiry_date" class="btn-filters  form-cs inp "
                                    value="{{ old('license_expiry_date') }}" placeholder="mm-dd-yy" />
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="warehouse"> Language </label>
                            <select class="js-example-basic-single select2" name="language"
                                value="{{ old('language') }}">
                                <option selected="selected">English</option>
                                <option>French</option>
                            </select>
                        </div>


                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Write_Comment">Write Comment</label>
                            <textarea id="Write_Comment" name="write_comment" class="form-control inp commenth" rows="3"
                                placeholder="Enter Write Comment">{{ old('write_comment') }}</textarea>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Read_Comment">Read Comment</label>
                            <textarea id="Read_Comment" name="read_comment"
                                class="form-control inp commenth inputbackground" rows="3"
                                placeholder="Enter Read Comment">{{ old('read_comment') }}</textarea>
                        </div>

                    </div>
                </div>
            </div>
            <!-- second form right side closer div is next -->
        </div>


        <div class="row custodis">
            @foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture'] as $imageType)
                <div class="col-md-3">
                    <div class="d-flex align-items-center justify-content-center  avtard">
                        <label class="foncolor set"
                            for="{{ $imageType }}">{{ ucfirst(str_replace('_', ' ', $imageType)) }}</label>
                        <div class="avtarset" style="position: relative;">
                            <!-- Image Preview -->
                            <img id="preview_{{ $imageType }}" class="avtars avtarc" src="{{ asset('assets/img.png') }}"
                                alt="avatar">

                            <!-- File Input (Hidden by Default) -->
                            <input type="file" id="file_{{ $imageType }}" name="{{ $imageType }}"
                                accept="image/png, image/jpeg" style="display: none;"
                                onchange="previewImage(this, '{{ $imageType }}')">

                            <div class="divedit">
                                <!-- Edit Button -->
                                <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}" alt="edit"
                                    style="cursor: pointer;"
                                    onclick="document.getElementById('file_{{ $imageType }}').click();">

                                <!-- Delete Button -->
                                <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}" alt="delete"
                                    style="cursor: pointer;" onclick="removeImage('{{ $imageType }}')">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        </div>
        </div>


        <div class="ptop d-flex">
            <div>
                <div class="input-block mb-3">
                    <label class="foncolor" for="status">Status</label>

                    <div class="status-toggle">
                        <span>Active</span>
                        <input id="status" class="check" type="checkbox" name="status">
                        <label for="status" class="checktoggle checkbox-bg togc"></label>
                        <span class="">Inactive</span>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
            </div>

            <div style="margin-top:22px;">
                <div class="add-customer-btns ">

                    <button type="button" onclick="redirectTo('{{route('admin.customer.index') }}')"
                        class="btn btn-outline-primary custom-btn">Cancel</button>

                    <button type="submit" class="btn btn-primary ">Submit</button>

                </div>
            </div>

        </div>
        </div>



        </div>
    </form>

</x-app-layout>
<script>
    // 🖼 Image Preview Function
    function previewImage(input, imageType) {
        if (input.files && input.files[0]) {
            let file = input.files[0];

            // ✅ Sirf PNG ya JPG Allow Hai
            if (file.type === "image/png" || file.type === "image/jpeg") {
                let reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview_' + imageType).src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert("Only PNG & JPG images are allowed!");
                input.value = ""; // Invalid file ko remove karna
            }
        }
    }

    // ❌ Remove Image Function
    function removeImage(imageType) {
        document.getElementById('preview_' + imageType).src = "{{ asset('../assets/img.png') }}";
        document.getElementById('file_' + imageType).value = "";
    }
    $('#country_code').val($('.mobile_code').find('.iti__selected-dial-code').text());
    $('.col-md-12').on('click', () => {
        $('#country_code').val($('.mobile_code').find('.iti__selected-dial-code').text());
    })

    $('#country_code_2').val($('.alternate_mobile_no').find('.iti__selected-dial-code').text());
    $('.col-md-12').on('click', () => {
        $('#country_code_2').val($('.alternate_mobile_no').find('.iti__selected-dial-code').text());
    })

</script>
<script>
    $(document).ready(function () {
        var oldState = "{{ old('state') }}"; // Laravel old value
        var oldCity = "{{ old('city') }}";

        // ✅ Agar old state available hai toh state ke cities load kare
        if (oldState) {
            $('#state').html('<option selected="selected">Loading...</option>');
            $.ajax({
                url: '/api/get-states/' + $('#country').val(),
                type: 'GET',
                success: function (states) {
                    $('#state').html('<option selected="selected">Select State</option>');
                    $.each(states, function (key, state) {
                        var selected = (state.id == oldState) ? 'selected' : ''; // ✅ Old value match kare
                        $('#state').append('<option value="' + state.id + '" ' + selected + '>' + state.name + '</option>');
                    });

                    // ✅ Agar old city available hai, toh cities load kare
                    if (oldCity) {
                        $('#city').html('<option selected="selected">Loading...</option>');
                        $.ajax({
                            url: '/api/get-cities/' + oldState,
                            type: 'GET',
                            success: function (cities) {
                                $('#city').html('<option selected="selected">Select City</option>');
                                $.each(cities, function (key, city) {
                                    var selected = (city.id == oldCity) ? 'selected' : ''; // ✅ Old value match kare
                                    $('#city').append('<option value="' + city.id + '" ' + selected + '>' + city.name + '</option>');
                                });
                            }
                        });
                    }
                }
            });
        }
        // Country Change Event
        $('#country').change(function () {
            var country_id = $(this).val();
            $('#state').html('<option selected="selected">Loading...</option>');
            $('#city').html('<option selected="selected">Select City</option>');

            $.ajax({
                url: '/api/get-states/' + country_id
                , type: 'GET'
                , success: function (states) {
                    $('#state').html('<option selected="selected" value="">Select State</option>');
                    $.each(states, function (key, state) {
                        $('#state').append('<option value="' + state.id + '">' +
                            state.name + '</option>');
                    });
                }
            });
        });

        // State Change Event
        $('#state').change(function () {
            var state_id = $(this).val();
            $('#city').html('<option selected="selected">Loading...</option>');

            $.ajax({
                url: '/api/get-cities/' + state_id
                , type: 'GET'
                , success: function (cities) {
                    $('#city').html('<option selected="selected" value="">Select City</option>');
                    $.each(cities, function (key, city) {
                        $('#city').append('<option value="' + city.id + '">' + city
                            .name + '</option>');
                    });
                }
            });
        });
    });

</script>