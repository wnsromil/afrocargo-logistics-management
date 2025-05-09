<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add pickup Address') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <div class="d-flex innertopnav w-100 justify-content-between">
            <p class="subhead pheads">Add pickup Address</p>

        </div>
    </x-slot>
    <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="masterPickUpAddressId">Customer Pickup ID<span class="text-danger">*</span> </label>
                    <input type="text" name="masterPickUpAddressId" class="form-control inp" readonly placeholder="Enter ID" value="PUA-001888">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="Company">Company </label>
                    <input type="text" name="CompanyName" class="form-control inp" placeholder="Enter Company Name">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="address1">First Name<i class="text-danger">*</i></label>
                    <input type="text" name="firstname" class="form-control inp" placeholder="Enter First Name" Value="Noura">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="address1">Last Name<i class="text-danger">*</i></label>
                    <input type="text" name="lastname" class="form-control inp" placeholder="Enter Last Name" Value="Traore">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor">Telephone</label>
                    <input type="tel" id="mobile_code" name="mobile_code" class="form-control inp" placeholder="Enter Telephone" value="2125252525" oninput="this.value = this.value.slice(0, 10)">
                    @error('mobile_code')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <input type="hidden" id="country_code" name="country_code">

            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="alternate_mobile_no">Cellphone<span class="text-danger">*</span></label>
                    <input type="tel" id="alternate_mobile_no" name="alternate_mobile_no" class="form-control inp" placeholder="Enter Cellphone No." value="2125252525" oninput="this.value = this.value.slice(0, 10)">
                    @error('alternate_mobile_no')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <input type="hidden" id="country_code_2" name="country_code_2">
            </div>

            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="address2">Address<span class="text-danger">*</span> </label>
                    <input type="text" name="address2" class="form-control inp" placeholder="Select Address 1">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="Apartment">Apartment </label>
                    <input type="text" name="Apartment" class="form-control inp" placeholder="Enter Apartment">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="Latitude">Latitude<i class="text-danger">*</i></label>
                    <input type="text" name="Latitude" class="form-control inp" readonly placeholder="Enter Latitude" value="0">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="Longitude">Longitude<i class="text-danger">*</i></label>
                    <input type="text" name="Longitude" class="form-control inp" readonly placeholder="Enter Longitude" value="0">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="address1">Country<i class="text-danger">*</i> </label>
                    <input type="text" name="CountryName" class="form-control inp" placeholder="Enter Country">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="address1">City<i class="text-danger">*</i> </label>
                    <input type="text" name="cityName" class="form-control inp" placeholder="Enter City">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="State">State<i class="text-danger">*</i> </label>
                    <input type="text" name="State" class="form-control inp" placeholder="Enter State">
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="input-block mb-2">
                    <label class="foncolor" for="zipcode">Zip Code</label>
                    <input type="text" name="zipcode" class="form-control inp" placeholder="Enter Zip Code">
                </div>
            </div>
            <div class="col-md-12">
                <div class="add-customer-btns text-end">

                    <button type="button" onclick="redirectTo('{{route('admin.customer.index') }}')" class="btn btn-outline-primary custom-btn">Cancel</button>

                    <button type="submit" class="btn btn-primary ">Submit</button>

                </div>
            </div>
        </div>
    </form>
</x-app-layout>
<script>
    $(document).ready(function() {
        $("#customBackWarning").on("click", function() {
            Swal.fire({
                title: "Cambios No han Sido Registrado </br> Changes have not been saved"
                , html: "* Si Continuas se pierden Los Cambios* </br> If you continue you will loose your changes"
                , type: "warning"
                , allowOutsideClick: !1
                , imageUrl: "{{ asset('assets/img/stopIcon.png') }}"
                , imageWidth: 80
                , imageAlt: "warning"
                , confirmButtonClass: "btn btn-primary"
                , showCancelButton: !0
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: "Continue"
                , cancelButtonText: "OK"
                , cancelButtonClass: "btn btn-outline-danger ml-1"
                , buttonsStyling: !1
                , customClass: {
                    popup: 'customBackWarning'
                , }
            })
        })
    })

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
