<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Ship to Address') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <div class="d-flex innertopnav w-100 justify-content-between">
            <p class="subhead pheads">Add Ship to Address</p>
            <div class="btnwrapper">
                <a href="{{ route('admin.addPickups') }}" class="btn btn-primary buttons me-1"> Pickup </a>
                <a href="{{route('admin.invoices.create')}}" class="btn btn-primary buttons"> Invoice </a>
            </div>
        </div>
    </x-slot>
    <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 align-items-stretch">
            <div class="col-md-6 mb-2 align-items-stretch">
                <div class="borderset">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                            <div class="widthmannual">
                                <select id="country" name="country" class="js-example-basic-single select2">
                                    <option value="" disabled hidden selected>Select Country</option>
                                    <option value="">United State</option>
                                    <option value="">Canada</option>
                                    <option value="">South Africa</option>
                                </select>
                                <button class="btn btn-primary">Location</button>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="company_name"> Company </label>
                            <input type="text" name="company_name" class="form-control inp" placeholder="Enter Company Name" value="{{ old('company_name') }}">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="fullName">Full Name <i class="text-danger">*</i></label>
                            <input type="text" name="fullName" class="form-control inp" placeholder="Enter Full Name" value="{{ old('fullName') }}">
                            @error('fullName')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2 mobile_code">
                            <label class="foncolor">Mobile No.<span class="text-danger">*</span></label>
                            <input type="tel" id="mobile_code" name="mobile_code" class="form-control inp" placeholder="Enter Mobile No." value="{{ old('mobile_code') }}" oninput="this.value = this.value.slice(0, 10)">
                            @error('mobile_code')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="hidden" id="country_code" name="country_code">

                        <div class="col-md-12 mb-2 alternate_mobile_no">
                            <label class="foncolor" for="alternate_mobile_no">Alternate Mobile No.</label>
                            <input type="tel" id="alternate_mobile_no" name="alternate_mobile_no" class="form-control inp" value="{{ old('alternate_mobile_no') }}" placeholder="Enter Alternate Mobile No." oninput="this.value = this.value.slice(0, 10)">
                        </div>
                        <input type="hidden" id="country_code_2" name="country_code_2">

                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="address_1">Address 1 <i class="text-danger">*</i></label>
                            <input type="text" name="address_1" value="{{ old('address_1') }}" class="form-control inp" placeholder="Enter Address 1">
                            @error('address_1')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Address_2">Address 2 </label>
                            <input type="text" name="Address_2" value="{{ old('Address_2') }}" class="form-control inp" placeholder="Enter Address 2">
                        </div>


                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Apartment">Apartment </label>
                            <input type="text" name="Apartment" value="{{ old('Apartment') }}" class="form-control inp" placeholder="Enter Apartment">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2 align-items-stretch">
                <div class="borderset">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Latitude"> Latitude</label>
                            <input type="text" name="Latitude" class="form-control inp" placeholder="Enter Latitude" value="{{ old('Latitude') }}">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Longitude"> Longitude</label>
                            <input type="text" name="Longitude" class="form-control inp" placeholder="Enter Longitude" value="{{ old('Longitude') }}">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Language">Language <i class="text-danger">*</i></label>
                            <select id="Language" name="Language" class="js-example-basic-single select2">
                                <option value="" disabled hidden selected>Select Language</option>
                                <option value="">India - English</option>
                                <option value="">Spain - Castalian</option>
                                <option value="">Kuwait - Arabian</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Email"> Email ID</label>
                            <input type="email" name="Email" class="form-control inp" placeholder="Enter Email ID" value="{{ old('Email') }}">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="License"> License ID</label>
                            <input type="email" name="License" class="form-control inp" placeholder="Enter License ID" value="{{ old('License') }}">
                        </div>
                        <div class="col-md-12 mt-4 mb-2">
                            <div class="d-flex align-items-center avtard">
                                <label class="foncolor me-2" for="licencePicture">Licence Picture</label>
                                <div class="" style="position: relative;">
                                    <!-- Image Preview -->
                                    <img id="preview_licencePicture" class="avtars avtarc" src="{{ asset('assets/img/licenceID_placeholder.jpg') }}" alt="avatar">

                                    <!-- File Input (Hidden by Default) -->
                                    <input type="file" id="file_licencePicture" name="licencePicture" accept="image/png, image/jpeg" style="display: none;" onchange="previewImage(this, 'licencePicture')">

                                    <div class="divedit">
                                        <!-- Edit Button -->
                                        <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}" alt="edit" style="cursor: pointer;" onclick="document.getElementById('file_licencePicture').click();">

                                        <!-- Delete Button -->
                                        <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}" alt="delete" style="cursor: pointer;" onclick="removeImage('licencePicture')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="add-customer-btns text-end">

                                <button type="button" onclick="redirectTo('{{route('admin.customer.index') }}')" class="btn btn-outline-primary custom-btn">Cancel</button>

                                <button type="submit" class="btn btn-primary ">Submit</button>

                            </div>
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
                reader.onload = function(e) {
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
    $(document).ready(function() {
        var oldState = "{{ old('state') }}"; // Laravel old value
        var oldCity = "{{ old('city') }}";

        // ✅ Agar old state available hai toh state ke cities load kare
        if (oldState) {
            $('#state').html('<option selected="selected">Loading...</option>');
            $.ajax({
                url: '/api/get-states/' + $('#country').val()
                , type: 'GET'
                , success: function(states) {
                    $('#state').html('<option selected="selected">Select State</option>');
                    $.each(states, function(key, state) {
                        var selected = (state.id == oldState) ? 'selected' : ''; // ✅ Old value match kare
                        $('#state').append('<option value="' + state.id + '" ' + selected + '>' + state.name + '</option>');
                    });

                    // ✅ Agar old city available hai, toh cities load kare
                    if (oldCity) {
                        $('#city').html('<option selected="selected">Loading...</option>');
                        $.ajax({
                            url: '/api/get-cities/' + oldState
                            , type: 'GET'
                            , success: function(cities) {
                                $('#city').html('<option selected="selected">Select City</option>');
                                $.each(cities, function(key, city) {
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
        $('#country').change(function() {
            var country_id = $(this).val();
            $('#state').html('<option selected="selected">Loading...</option>');
            $('#city').html('<option selected="selected">Select City</option>');

            $.ajax({
                url: '/api/get-states/' + country_id
                , type: 'GET'
                , success: function(states) {
                    $('#state').html('<option selected="selected" value="">Select State</option>');
                    $.each(states, function(key, state) {
                        $('#state').append('<option value="' + state.id + '">' +
                            state.name + '</option>');
                    });
                }
            });
        });

        // State Change Event
        $('#state').change(function() {
            var state_id = $(this).val();
            $('#city').html('<option selected="selected">Loading...</option>');

            $.ajax({
                url: '/api/get-cities/' + state_id
                , type: 'GET'
                , success: function(cities) {
                    $('#city').html('<option selected="selected" value="">Select City</option>');
                    $.each(cities, function(key, city) {
                        $('#city').append('<option value="' + city.id + '">' + city
                            .name + '</option>');
                    });
                }
            });
        });
    });

</script>
