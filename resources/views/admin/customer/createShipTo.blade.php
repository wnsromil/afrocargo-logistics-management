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
    <form action="{{ route('admin.customer.createShipTo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 align-items-stretch">
            <div class="col-md-6 mb-2 align-items-stretch">
                <div class="borderset">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                            <div class="widthmannual">
                                <select id="country" name="country" class="js-example-basic-single select2">
                                    <option value="" disabled hidden {{ old('country') ? '' : 'selected' }}>Select
                                        Country</option>
                                    <option value="Bangladesh" {{ old('country') == 'Bangladesh' ? 'selected' : '' }}>
                                        Bangladesh</option>
                                    <option value="Belgium" {{ old('country') == 'Belgium' ? 'selected' : '' }}>Belgium
                                    </option>
                                    <option value="Kuwait" {{ old('country') == 'Kuwait' ? 'selected' : '' }}>Kuwait
                                    </option>
                                    <option value="Dominica" {{ old('country') == 'Dominica' ? 'selected' : '' }}>Dominica
                                    </option>
                                    <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                    <option value="Dominican Republic" {{ old('country') == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                    <option value="Andorra" {{ old('country') == 'Andorra' ? 'selected' : '' }}>Andorra
                                    </option>
                                    <option value="Chile" {{ old('country') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                    <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                    <option value="Greenland" {{ old('country') == 'Greenland' ? 'selected' : '' }}>
                                        Greenland</option>
                                    <option value="Cabo Verde" {{ old('country') == 'Cabo Verde' ? 'selected' : '' }}>Cabo
                                        Verde</option>
                                    <option value="Côte d'Ivoire" {{ old('country') == "Côte d'Ivoire" ? 'selected' : '' }}>Côte d'Ivoire</option>
                                    <option value="Mali" {{ old('country') == 'Mali' ? 'selected' : '' }}>Mali</option>
                                    <option value="European Union" {{ old('country') == 'European Union' ? 'selected' : '' }}>European Union</option>
                                </select>
                                <button class="btn btn-primary">Location</button>
                            </div>
                            @error('country')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="company_name"> Company </label>
                            <input type="text" name="company_name" class="form-control inp"
                                placeholder="Enter Company Name" value="{{ old('company_name') }}">
                            @error('company_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="fullName">Full Name <i class="text-danger">*</i></label>
                            <input type="text" name="first_name" class="form-control inp" placeholder="Enter Full Name"
                                value="{{ old('first_name') }}">
                            @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor">Mobile No.<span class="text-danger">*</span></label>
                            <div class="flaginputwrap">
                                <div class="customflagselect">
                                    <select class="flag-select" name="mobile_number_code_id">
                                        @foreach ($coutry as $key => $item)
                                            <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                {{ $item->name }} +{{ $item->phonecode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No"
                                    name="mobile_number" value="{{ old('mobile_number') }}"
                                    oninput="this.value = this.value.slice(0, 10)">
                            </div>
                            @error('mobile_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2 alternate_mobile_no">
                            <label class="foncolor">Mobile No. 2</label>
                            <div class="flaginputwrap">
                                <div class="customflagselect">
                                    <select class="flag-select" name="alternative_mobile_number_code_id">
                                        @foreach ($coutry as $key => $item)
                                            <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                {{ $item->name }} +{{ $item->phonecode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No. 2"
                                    name="alternative_mobile_number" value="{{ old('alternative_mobile_number') }}"
                                    oninput="this.value = this.value.slice(0, 10)">
                            </div>
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
                            <input type="text" name="address_2" value="{{ old('address_2') }}" class="form-control inp"
                                placeholder="Enter Address 2">
                        </div>


                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Apartment">Apartment </label>
                            <input type="text" name="apartment" value="{{ old('apartment') }}" class="form-control inp"
                                placeholder="Enter Apartment">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2 align-items-stretch">
                <div class="borderset">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Latitude"> Latitude</label>
                            <input type="text" name="latitude" value="{{ old('latitude') }}"
                                class="form-control inp inputbackground" placeholder="0" readonly
                                style="background: #ececec;">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Longitude"> Longitude</label>
                            <input type="text" name="longitude" value="{{ old('longitude') }}"
                                class="form-control inp inputbackground" placeholder="0" readonly
                                style="background: #ececec;">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="language">Language <i class="text-danger">*</i></label>
                            <select id="language" name="language" class="js-example-basic-single select2">
                                <option value="English" {{ old('language') == 'English' ? 'selected' : '' }}>English
                                </option>
                                <option value="French" {{ old('language') == 'French' ? 'selected' : '' }}>French</option>
                            </select>
                            @error('language')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="Email"> Email ID <i class="text-danger">*</i></label>
                            <input type="email" name="email" class="form-control inp" placeholder="Enter Email ID"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="foncolor" for="License"> License ID</label>
                            <input type="text" name="license" class="form-control inp" placeholder="Enter License ID"
                                value="{{ old('license') }}">
                        </div>
                        <div class="col-md-12 mt-4 mb-2">
                            <div class="d-flex align-items-center avtard">
                                <label class="foncolor me-2" for="license_picture">Licence Picture</label>
                                <div class="" style="position: relative;">
                                    <!-- Image Preview -->
                                    <img id="preview_license_picture" class="avtars avtarc"
                                        src="{{ asset('assets/img/licenceID_placeholder.jpg') }}" alt="avatar">

                                    <!-- File Input (Hidden by Default) -->
                                    <input type="file" id="file_license_picture" name="license_picture"
                                        accept="image/png, image/jpeg" style="display: none;"
                                        onchange="previewImage(this, 'license_picture')">

                                    <div class="divedit">
                                        <!-- Edit Button -->
                                        <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}" alt="edit"
                                            style="cursor: pointer;"
                                            onclick="document.getElementById('file_license_picture').click();">

                                        <!-- Delete Button -->
                                        <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}" alt="delete"
                                            style="cursor: pointer;" onclick="removeImage('license_picture')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="parent_customer_id" class="form-control inp"
                            placeholder="Enter License ID" value="{{ $id }}">
                        <div class="col-md-12">
                            <div class="add-customer-btns text-end">

                                <button type="button" onclick="redirectTo('{{route('admin.customer.index') }}')"
                                    class="btn btn-outline-primary custom-btn">Cancel</button>

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