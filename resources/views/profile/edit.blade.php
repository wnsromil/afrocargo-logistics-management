<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Profile') }}
        </h2>
        @section('style')
            <style>
                .card.mainCardGlobal:before {
                    display: none;
                }
            </style>
        @endsection
    </x-slot>

    <section>
        <div class="content-page-header">
            <h5 class="setting-menu textSize fw-semibold">Update Profile</h5>
        </div>
        <!-- <div class="col-md-12 d-flex justify-content-between">
            <div class="col-md-4">
            <div class="upload-profile me-2">
                    <div class="profile-img">
                        <img id="blah" class="avatar"
                            src="{{ asset('assets/img/profiles/Ellipse 14.png') }}"
                            alt="profile-img">
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-md-12 d-flex flex-row justify-content-between flex-wrap">

                <div class="col-md-4 px-3">
                    <form id="profileForm" action="{{ route('profile.upload_pic') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="upload-profile me-2 align-items-center mt-4">
                            <label class="profile-img avatar avatar-xxl profileImg profile-cover-avatar">
                                @if (!empty($user->profile_pic) && is_string($user->profile_pic))
                                    <img class="avatar-img" src="{{ asset($user->profile_pic) }}" alt="Profile Image"
                                        id="blah">
                                @else
                                    <img class="avatar-img" src="{{ asset('assets/img/profiles/avatar-icon.png') }}"
                                        alt="Profile Image" id="blah">
                                @endif

                                <!-- Only this icon will trigger input -->
                                <span class="avatar-edit iconResize">
                                    <label for="file-input" style="margin-bottom: 0; cursor: pointer;">
                                        <i class="fe fe-edit avatar-uploader-icon shadow-soft" id="profile_pic"></i>
                                    </label>
                                </span>
                                @if (!empty($user->profile_pic) && is_string($user->profile_pic))
                                    <span class="avatar-trash iconResize bg-danger" style="cursor: pointer;"
                                        onclick="deleteImage()">
                                        <i class="fe fe-trash-2 avatar-uploader-icon shadow-soft"></i>
                                    </span>
                                @endif
                            </label>

                            <!-- Hidden File Input -->
                            <input id="file-input" type="file" name="profile_pic" style="display:none;"
                                onchange="readURL(this);" accept="image/png, image/jpeg">

                        </div>
                    </form>
                </div>

                <div class="col-md-8 flex-item">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="email" value="{{ $user->email }}" class="form-control" readonly
                            placeholder="Enter Email Address">
                        <div class="row ">
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3 profileUpdateFont">
                                    <p class="profileUpdateFont required">First Name</p>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-control" placeholder="Enter First Name" required>
                                    <span class="error text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3 profileUpdateFont">
                                    <p class="profileUpdateFont required">Last Name</p>
                                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                        class="form-control" placeholder="Enter Last Name" required>
                                    <span class="error text-danger">
                                        @error('last_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Contact No. 1</p>
                                    <input type="text" id="edit_mobile_code" name="phone"
                                        value="{{ old('phone', $user->phone) }}" class="form-control" placeholder=""
                                        required maxlength="10" oninput="validatePhone(this)">
                                    <span class="error text-danger">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" id="country_code" name="country_code"
                                value="{{ old('country_code', $user->country_code) }}">

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont">Contact No. 2</p>
                                    <input type="number" name="phone_2" id="edit_mobile"
                                        value="{{ old('phone_2', $user->phone_2) }}" class="flagInput form-control"
                                        placeholder="">
                                    <span class="error text-danger">
                                        @error('phone_2')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <input type="hidden" id="country_code_2" name="country_code_2"
                                value="{{ old('country_code_2', $user->country_code_2) }}">

                            {{-- <div class="col-md-6">
                                <label>Email</label> <span class="text-danger">*</span>
                                <input type="text" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control" readonly placeholder="Enter Email Address">
                                <span class="error text-danger">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                    </spa n>
                            </div> --}}

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Address 1</p>
                                    <input type="text" name="address_1" value="{{ old('address_1', $user->address) }}"
                                        class="form-control" placeholder="Enter your Address">
                                    <span class="error text-danger">
                                        @error('address_1')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont">Address 2</p>
                                    <input type="text" name="address_2" value="{{ old('address_2', $user->address_2) }}"
                                        class="form-control" placeholder="Enter your Address">
                                    <span class="error text-danger">
                                        @error('address_2')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Country</p>
                                    <input type="text" name="country"
                                        value="{{ old('country', $user->country_id) }}" class="form-control inp"
                                        readonly style="background: #ececec;">
                                    @error('country')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">State</p>
                                    <input type="text" name="state" value="{{ old('country', $user->state_id) }}"
                                        class="form-control inp" readonly style="background: #ececec;">
                                    @error('state')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">City</p>
                                    <input type="text" name="city" value="{{ old('country', $user->city_id) }}"
                                        class="form-control inp" readonly style="background: #ececec;">
                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont Zip_code required">Zip Code</p>
                                    <input type="text" name="Zip_code" class="form-control" placeholder="Enter Zip Code"
                                        value="{{ $user->pincode ?? old('Zip_code') }}">
                                    @error('Zip_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>




                            <div class="col-lg-12">
                                <div class="btn-path text-end">
                                    <a href="{{ route('profile.index') }}"
                                        class="btn btn-cancel btn-outline-dark me-3">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function validatePhone(input) {
            // Sirf numbers allow kare aur max length 10 ho
            input.value = input.value.replace(/\D/g, '').slice(0, 10);
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('blah').src = e.target.result;
                    setTimeout(() => {
                        document.getElementById('profileForm').submit();
                    }, 1000);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function deleteImage() {
            // if (confirm('Are you sure you want to delete this image?')) {
            let form = document.getElementById('profileForm');
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_image';
            input.value = '1';
            form.appendChild(input);
            form.submit();
            // }
        }

        $(document).ready(function () {
            var selectedCountry = "{{ $user->country_id }}";
            var selectedState = "{{ $user->state_id }}";
            var selectedCity = "{{ $user->city_id }}";


            // Load States Automatically
            if (selectedCountry) {
                $.ajax({
                    url: "{{ url('api/get-states') }}/" + selectedCountry,
                    method: "GET",
                    success: function (response) {
                        // $('#state').append('<option value="">Select State</option>');
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

        $(document).ready(function () {
            function getIsoCodeFromDialCode(dialCode) {
                const allCountries = window.intlTelInputGlobals.getCountryData();
                dialCode = dialCode.replace('+', '');
                const match = allCountries.find(c => c.dialCode === dialCode);
                return match ? match.iso2 : 'us'; // fallback to India
            }

            function initializeIntlTelInput(inputId, hiddenInputId, userDialCode) {
                const isoCode = getIsoCodeFromDialCode(userDialCode);
                const input = document.querySelector(inputId);

                const iti = window.intlTelInput(input, {
                    initialCountry: isoCode,
                    separateDialCode: true,
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
                });

                // Update country code when country changes
                input.addEventListener("countrychange", function () {
                    const dialCode = iti.getSelectedCountryData().dialCode;
                    $(hiddenInputId).val("+" + dialCode);
                });

                // Also update immediately on page load
                const initialDialCode = iti.getSelectedCountryData().dialCode;
                $(hiddenInputId).val("+" + initialDialCode);
            }

            // Pass dial code like '+91' from Laravel
            initializeIntlTelInput("#edit_mobile_code", "#country_code", "{{ $user->country_code ?? '+1' }}");
            initializeIntlTelInput("#edit_mobile", "#country_code_2", "{{ $user->country_code_2 ?? '+1' }}");
        });
    </script>

</x-app-layout>