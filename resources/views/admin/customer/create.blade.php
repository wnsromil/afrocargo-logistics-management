<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <p class="subhead">Add Customer</p>
    </x-slot>
    <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex" style="justify-content: space-between;">
            <div class="col-6"style="padding-right: 20px;">
                <div class="row borderset">
                    <div class="col-md-12">
                        <label class="foncolor" for="company_name"> Company </label>
                        <input type="text" name="company_name" class="form-control inp"
                            placeholder="Enter Company Name" value="{{ old('company_name')}}">

                    </div>
                    <div class="col-md-12">
                        <label class="foncolor" for="first_name">First Name <i class="text-danger">*</i></label>
                        <input type="text" name="first_name" class="form-control inp" placeholder="Enter Last Name"
                            value="{{ old('first_name') }}">
                        @error('first_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="foncolor" for="contact_no1">Mobile No. <i class="text-danger">*</i></label>
                        <input type="number" id="contact_no1" value="{{ old('contact_no1') }}" class="form-control inp"
                            placeholder="Enter Mobile Number" name="contact_no1"
                            oninput="this.value = this.value.slice(0, 10)">
                        @error('contact_no1')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="foncolor" for="alternate_mobile_no">Alternate Mobile No.</label>
                        <input type="number" id="alternate_mobile_no" name="alternate_mobile_no"
                            value="{{ old('alternate_mobile_no') }}" class="form-control inp"
                            placeholder="Enter Mobile Number" oninput="this.value = this.value.slice(0, 10)">
                    </div>
                    <div class="col-md-12">
                        <label class="foncolor" for="address_1">Address 1 <i class="text-danger">*</i></label>
                        <input type="text" name="address_1" value="{{ old('address_1') }}" class="form-control inp"
                            placeholder="Enter Address 1">
                        @error('address_1')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="foncolor" for="Address_2">Address 2 </label>
                        <input type="text" name="Address_2" value="{{ old('Address_2') }}" class="form-control inp"
                            placeholder="Enter Address 2">
                    </div>
                    

                    <div class="col-md-6">
                        <label class="foncolor" for="Apartment">Apartment </label>
                        <input type="text" name="Apartment" value="{{ old('Apartment') }}" class="form-control inp"
                            placeholder="Enter Apartment">
                    </div>

                    <div class="col-md-6">
                        <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                        <select id="country" name="country" class="js-example-basic-single select2">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ old('country') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('country')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4">
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

                    <div class="col-md-4">
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

                    <div class="col-md-4">
                        <label class="foncolor" for="Zip_code">Zipcode <i class="text-danger">*</i></label>
                        <input type="text" name="Zip_code" value="{{ old('Zip_code') }}"
                            class="form-control inp" placeholder="Enter Zip">
                        @error('Zip_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="foncolor" for="username">Username <i class="text-danger">*</i></label>
                        <input type="text" name="username" value="{{ old('Username') }}"
                            class="form-control inp" placeholder="Enter User Name">
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="foncolor" for="password">Password <i class="text-danger">*</i></label>
                        <div class="d-flex" style="border: 1px solid #00000042 !important; border-radius: 4px;">
                            <input type="password" name="password" class="form-control inp"
                                style="border: none !important" placeholder="Enter Password">
                            <i class="fe fe-eye passeye" data-bs-toggle="tooltip" title="Show/Hide Password"></i>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="foncolor" for="password_confirmation">Confirm New Password <i
                                class="text-danger">*</i></label>
                        <div class="d-flex" style="border: 1px solid #00000042 !important; border-radius: 4px;">
                            <input type="password" name="password_confirmation" class="form-control inp"
                                style="border: none !important" placeholder="Enter Confirm New Password">
                            <i class="fe fe-eye passeye" data-bs-toggle="tooltip" title="Show/Hide Password"></i>
                        </div>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label class="foncolor" for="latitude">Latitude <i class="text-danger">*</i></label>
                        <input type="number" name="latitude" value="{{ old('latitude') }}"
                            class="form-control inp" placeholder="0">
                        @error('latitude')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="foncolor" for="longitude">Longitude <i class="text-danger">*</i></label>
                        <input type="number" name="longitude" value="{{ old('longitude') }}"
                            class="form-control inp" placeholder="0">
                        @error('longitude')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- first left side form clouser div is next  -->
                </div>
            </div>
            <div class="col-6" style="padding-left: 20px;">
                <div class="row borderset">
                    <div class="col-md-12">
                        <label class="foncolor" for="website_url">Website</label>
                        <input type="text" name="website_url" class="form-control inp"
                            value="{{ old('longitude') }}" placeholder="Enter Website ID">

                    </div>
                    <div class="col-md-12">
                        <label class="foncolor" for="email">Email</label>
                        <input type="text" name="email" class="form-control inp" placeholder="Enter Email ID"
                            value="{{ old('longitude') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="foncolor" for="warehouse"> Warehouse </label>
                        <select class="js-example-basic-single select2" name="warehouse_id"
                            value="{{ old('warehouse_id') }}">
                            <option selected="selected">Select Warehouse</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-12">
                        <label class="foncolor" for="container"> Container </label>
                        <select class="js-example-basic-single select2" name="warehouse_id"
                            value="{{ old('warehouse_id') }}">
                            <option selected="selected" value="">Select Container</option>
                            <option></option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label>Signature Date </label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" name="signature_date" class="btn-filters  form-cs inp "
                                value="{{ old('signature_date') }}" placeholder="mm-dd-yy" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="foncolor" for="Year_to_Date">Year to Date</label>
                        <input type="text" name="year_to_date" id="Year to Date" class="form-control inp bgcolorcustomer"
                            placeholder="0" value="{{ old('year_to_date') }}">
                    </div>

                    <div class="col-md-12">
                        <label class="foncolor" for="License_ID">License ID</label>
                        <input type="text" id="License_ID" name="license_number" class="form-control inp"
                            value="{{ old('license_number') }}" placeholder="Enter License ID">
                    </div>

                    <div class="col-md-12">
                        <label>License Expiry Date </label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" name="license_expiry_date" class="btn-filters  form-cs inp bgcolorcustomer"
                                name="expire_date" value="{{ old('license_expiry_date') }}"
                                placeholder="mm-dd-yy" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="foncolor" for="warehouse"> Language </label>
                        <select class="js-example-basic-single select2" name="language"
                            value="{{ old('language') }}">
                            <option selected="selected">India - English</option>
                            <option>Hindi</option>
                        </select>
                    </div>


                    <div class="col-md-12">
                        <label class="foncolor" for="Write_Comment">Write Comment</label>
                        <input type="text" id="Write_Comment" name="write_comment"
                            class="form-control inp commenth" value="{{ old('write_comment') }}"
                            placeholder="Enter Write Comment">
                    </div>

                    <div class="col-md-12">
                        <label class="foncolor " for="Read_Comment">Read Comment</label>
                        <input type="text" class="bgcolorcustomer" id="Read_Comment" name="read_comment"
                            class="form-control inp commenth" value="{{ old('read_comment') }}"
                            placeholder="Enter Read Comment">
                    </div>
                </div>
                <!-- second form right side closer div is next -->
            </div>

            <div class="row custodis">
              @foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture'] as $imageType)
                  <div class="col-md-3 d-flex">
                      <label class="foncolor set" for="{{ $imageType }}">{{ ucfirst(str_replace('_', ' ', $imageType)) }}</label>
                      <div class="avtarset">
                          <!-- Image Preview -->
                          <img id="preview_{{ $imageType }}" class="avtars" src="{{ asset('../assets/img.png') }}" alt="avatar">
                          
                          <!-- File Input (Hidden by Default) -->
                          <input type="file" id="file_{{ $imageType }}" name="{{ $imageType }}" accept="image/png, image/jpeg" 
                              style="display: none;" onchange="previewImage(this, '{{ $imageType }}')">
          
                          <div style="position: absolute; left: 120px; display: flex; flex-direction: row;">
                              <!-- Edit Button -->
                              <img src="{{ asset('assets/img/edit (1).png') }}" alt="edit" style="margin-bottom: 5px; cursor: pointer;"
                                  onclick="document.getElementById('file_{{ $imageType }}').click();">
                              
                              <!-- Delete Button -->
                              <img src="{{ asset('assets/img/dlt (1).png') }}" alt="delete" style="cursor: pointer;"
                                  onclick="removeImage('{{ $imageType }}')">
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>


            <!-- ------------ --> l
            <!-- <div class="row custodis">
    <div class="col-md-4">
        <div class="d-flex">
        <label class="foncolor" for="Read_Comment">Signature</label>
     <div>
      <img  src="../assets/img.png" alt="avtar">
      <div style="position: absolute;  left: 120px; display: flex; flex-direction: row;">
        <img src="../assets/img/edit (1).png" alt="edit" style="margin-bottom: 5px;">
        <img src="../assets/img/dlt (1).png" alt="delete">
      </div>
     </div>
        </div>
    </div>
    <div></div>
    <div></div>
</div>

 -->



            <!-- ---------- -->

            <div class="ptop d-flex">
                <div>
                    <div class="input-block mb-3">
                        <label class="foncolor" for="status">Status</label>

                        <div class="status-toggle">
                            <span>Active</span>
                            <input id="status" class="check" type="checkbox" name="status" checked>
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

                        <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>

                        <button type="submit" class="btn btn-primary ">Submit</button>

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
</script>
<script>
    $(document).ready(function() {
        // Country Change Event
        $('#country').change(function() {
            var country_id = $(this).val();
            $('#state').html('<option selected="selected">Loading...</option>');
            $('#city').html('<option selected="selected">Select City</option>');

            $.ajax({
                url: '/api/get-states/' + country_id,
                type: 'GET',
                success: function(states) {
                    $('#state').html('<option selected="selected">Select State</option>');
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
                url: '/api/get-cities/' + state_id,
                type: 'GET',
                success: function(cities) {
                    $('#city').html('<option selected="selected">Select City</option>');
                    $.each(cities, function(key, city) {
                        $('#city').append('<option value="' + city.id + '">' + city
                            .name + '</option>');
                    });
                }
            });
        });
    });
</script>
