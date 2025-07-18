<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Ship to Address') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <div class="d-flex innertopnav w-100 justify-content-between">
            <p class="subhead pheads">Update Pickup Address</p>
        </div>
    </x-slot>
       {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)sss
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
   <form action="{{ route('admin.customer.editPickupAddress', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row g-3 align-items-stretch">
        <div class="col-md-6 mb-2 align-items-stretch">
            <div class="borderset">
                <div class="row">
                    <div class="col-md-12 mb-2">
                      <label class="foncolor" for="company_name"> Pickup ID</label>
                        <input type="text" class="form-control inp" style="background: #ececec;"
                            placeholder="" value="{{ $user->unique_id }}" readonly>    
                    </div>
                    {{-- <div class="col-md-12 mb-2">
                        <label class="foncolor" for="company_name">Company</label>
                        <input type="text" name="company_name" class="form-control inp" placeholder="Enter Company Name"
                               value="{{ old('company_name', $user->company_name) }}">
                        @error('company_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <div class="col-md-12 mb-2">
                        <label class="foncolor" for="fullName">First Name <i class="text-danger">*</i></label>
                        <input type="text" name="first_name" class="form-control inp" placeholder="Enter First Name"
                               value="{{ old('first_name', $user->name) }}">
                        @error('first_name')
                             <small class="text-danger">The first name field is required.</small>
                        @enderror
                    </div>
                     <div class="col-md-12 mb-2">
                        <label class="foncolor" for="fullName">Last Name <i class="text-danger">*</i></label>
                        <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name"
                               value="{{ old('last_name', $user->last_name) }}">
                        @error('last_name')
                             <small class="text-danger">The last name field is required.</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="foncolor">Cellphone<span class="text-danger">*</span></label>
                        <div class="flaginputwrap">
                            <div class="customflagselect">
                                <select class="flag-select" name="mobile_number_code_id">
                                    @foreach ($coutry as $key => $item)
                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                            data-length="{{ $item->phone_length ?? 10 }}"
                                                {{ $item->id == old('mobile_number_code_id', $user->mobile_number_code_id) ? 'selected' : '' }}>
                                            {{ $item->name }} +{{ $item->phonecode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No"
                                   name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}"
                                   >
                        </div>
                        @error('mobile_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2 alternate_mobile_no">
                        <label class="foncolor">Telephone</label>
                        <div class="flaginputwrap">
                            <div class="customflagselect">
                                <select class="flag-select" name="alternative_mobile_number_code_id">
                                    @foreach ($coutry as $key => $item)
                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                           data-length="{{ $item->phone_length ?? 10 }}"
                                                {{ $item->id == old('alternative_mobile_number_code_id', $user->alternative_mobile_number_code_id) ? 'selected' : '' }}>
                                            {{ $item->name }} +{{ $item->phonecode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No. 2"
                                   name="alternative_mobile_number" value="{{ old('alternative_mobile_number', $user->alternative_mobile_number) }}"
                                   >
                        </div>
                        @error('alternative_mobile_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="hidden" id="country_code_2" name="country_code_2">
                    <div class="col-md-12 mb-2">
                        <label class="foncolor" for="address_1">Address 1 <i class="text-danger">*</i></label>
                        <input type="text" name="address_1" value="{{ old('address_1', $user->address) }}" class="form-control inp" placeholder="Enter Address 1">
                        @error('address_1')
                           <small class="text-danger">The address field is required.</small>
                        @enderror
                    </div>
                    {{-- <div class="col-md-12 mb-2">
                        <label class="foncolor" for="Address_2">Address 2</label>
                        <input type="text" name="address_2" value="{{ old('address_2', $user->address_2) }}" class="form-control inp" placeholder="Enter Address 2">
                    </div> --}}
                    <div class="col-md-12 mb-2">
                        <label class="foncolor" for="Apartment">Apartment</label>
                        <input type="text" name="apartment" value="{{ old('apartment', $user->apartment) }}" class="form-control inp" placeholder="Enter Apartment">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2 align-items-stretch">
            <div class="borderset">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label class="foncolor" for="Latitude">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude', $user->lat) }}"
                               class="form-control inp inputbackground" placeholder="0" readonly
                               style="background: #ececec;">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="foncolor" for="Longitude">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude', $user->long) }}"
                               class="form-control inp inputbackground" placeholder="0" readonly
                               style="background: #ececec;">
                    </div>
                    <div class="col-md-12 mb-2">
                            <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                            <input type="text" name="country" value="{{ old('country' , $user->country_id) }}" class="form-control inp"
                                readonly style="background: #ececec;">
                            @error('country')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                            <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                            <input type="text" name="city" value="{{ old('city', $user->city_id) }}" class="form-control inp"
                                placeholder="Enter City">
                            @error('city')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                            <label class="foncolor" for="state">State <i class="text-danger">*</i></label>
                            <input type="text" name="state" value="{{ old('state', $user->state_id) }}" class="form-control inp"
                                placeholder="Enter State">
                            @error('state')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                            <label class="foncolor" for="zip_code">Zip Code</label>
                            <input type="text" name="Zip_code" value="{{ old('Zip_code', $user->pincode) }}" class="form-control inp"
                                placeholder="Enter Zip Code">
                            @error('zip_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <input type="hidden" name="parent_customer_id" value="{{ $user->parent_customer_id }}">
                    <div class="col-md-12">
                        <div class="add-customer-btns text-end">
                            <button type="button" onclick="redirectTo('{{ route('admin.customer.index') }}')"
                                    class="btn btn-outline-primary custom-btn">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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