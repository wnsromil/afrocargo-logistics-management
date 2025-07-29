<!-- ------------------- 2nd modal ---------------------------- -->

<div class="modal custom-modal fade glocation" id="addCustomerCreateModal" aria-labelledby="addCustomerCreateModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-size modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-dark-shade" id="addCustomerCreateModalLabel">Add Customer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form enctype="multipart/form-data" action="{{route('admin.saveInvoceCustomer')}}" id="CustomerCreate_Form" method="POST">
                @csrf
                <input type="hidden" name="address_type" value="pickup">
                <input type="hidden" name="address_id">
                <input type="hidden" name="user_id">
                <input type="hidden" name="invoice_custmore_type" value="from_to">

                <div class="row px-3">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="row align-items-center margin-top-top">
                            <div class="col-3 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label text-dark">Country<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-9 pe-0">
                                <select id="country" name="country" class="js-example-basic-single select2">
                                    <option value="" disabled hidden {{ old('country') ? '' : 'selected' }}>
                                        Select
                                        Country</option>

                                    @foreach (setting()->warehouseContries() as $country)
                                        <option value="{{ $country['name'] }}"
                                        {{ old('country') == $country['name'] ? 'selected' : '' }}
                                        data-country="{{$country->iso2}}"
                                        >
                                            {{ $country['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 px-0" id="location_button" style="display: none;">
                                <button class="btn btn-dark btn-sm" id="openLocationModal">Location</button>

                            </div>
                        </div>
                        <div class="row align-items-center margin-top-top">
                            <div class="col px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label text-dark">First
                                    Name<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="first_name" class="form-control inp"
                                    placeholder="Enter First Name" value="{{ old('first_name') }}">
                            </div>
                        </div>
                        <div class="row align-items-center margin-top-top">
                            <div class="col px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label text-dark">Last
                                    Name<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="last_name" class="form-control inp"
                                    placeholder="Enter Last Name" value="{{ old('last_name') }}">
                            </div>
                        </div>
                        <div class="row align-items-center margin-top-top">
                            <div class="col text-end px-0">
                                <label for="alternate_mobile_no" class="col-form-label text-dark">Cell
                                    Phone<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-9">
                                <div class="flaginputwrap">
                                    <div class="customflagselect">
                                        <select class="flag-select js-example-basic-single select2" name="mobile_number_code_id">
                                            @foreach ($coutry as $key => $item)
                                                <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                    data-name="{{ $item->name }}"
                                                    data-code="{{ $item->phonecode }}"
                                                    data-length="{{ $item->phone_length ?? 10 }}">
                                                    {{ $item->name }} +{{ $item->phonecode }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="number" class="form-control flagInput inp"
                                        placeholder="Enter Mobile No" name="mobile_number"
                                        value="{{ old('mobile_number') }}"
                                        >
                                </div>
                                @error('alternate_mobile_no')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center margin-top-top">
                            <div class="col text-end px-0">
                                <label for="mobile_code" class="col-form-label text-dark">TelePhone</label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <div class="flaginputwrap">
                                    <div class="customflagselect">
                                        <select class="flag-select js-example-basic-single select2" name="alternative_mobile_number_code_id">
                                            @foreach ($coutry as $key => $item)
                                                <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                    data-name="{{ $item->name }}"
                                                    data-code="{{ $item->phonecode }}"
                                                    data-length="{{ $item->phone_length ?? 10 }}">
                                                    {{ $item->name }} +{{ $item->phonecode }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="number" class="form-control flagInput inp"
                                        placeholder="Enter TelePhone" name="alternative_mobile_number"
                                        value="{{ old('alternative_mobile_number') }}"
                                        >
                                </div>
                                @error('alternate_mobile_no')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center margin-top-top">
                            <div class="col text-end px-0">
                                <label for="address" class="col-form-label text-dark">Address 1<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="address"
                                    value="{{ old('address') }}" class="form-control inp addressgl"
                                    placeholder="Enter Address 1">
                            </div>
                        </div>
                        <div class="row align-items-center margin-top-top">
                            <div class="col text-end px-0">
                                <label for="" class="col-form-label text-dark">Address
                                    2</label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="address_2" value="{{ old('address_2') }}"
                                    class="form-control inp" placeholder="Enter Address 2" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6">

                        <div class="row align-items-center margin-top-top">
                            <div class="col text-end px-0">
                                <label class="foncolor" for="State">State</label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="state" id="state"class="form-control inp" placeholder="state">
                            </div>
                        </div>

                        <div class="row align-items-center margin-top-top">
                            <div class="col text-end px-0">
                                <label class="foncolor" for="city">City</label>

                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="city" id="city" class="form-control inp" placeholder="city">
                            </div>
                        </div>

                        <div class="row align-items-center margin-top-top d-none">
                            <div class="col text-end px-0">
                                <label for="masterPickUpAddressId" class="col-form-label text-dark">Latitude<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="lat" value="{{ old('lat') }}"
                                    class="form-control inp inputbackground" placeholder="" readonly
                                    style="background: #ececec;">
                            </div>
                        </div>
                        <div class="row align-items-center margin-top-top d-none">
                            <div class="col text-end px-0">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label text-dark">Longitude</label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="lng"
                                    value="{{ old('lng') }}"
                                    class="form-control inp inputbackground" placeholder="" readonly
                                    style="background: #ececec;">
                            </div>
                        </div>

                        <div class="row align-items-center margin-top-top d-none">
                            <div class="col text-end px-0">
                                <label for="neighborhood" class="col-form-label text-dark">Neighborhood<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="neighborhood" class="form-control inp"
                                    placeholder="Enter Neighborhood" value="{{ old('neighborhood') }}">
                            </div>
                        </div>

                        <div class="row align-items-center margin-top-top">
                            <div class="col text-end px-0">
                                <label for="email" class="col-form-label text-dark">Email Id<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="email" name="email" class="form-control inp"
                                    placeholder="Enter Email ID" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row align-items-center margin-top-top">
                            <div class="col text-end px-0">
                                <label for="License_Id" class="col-form-label text-dark">License Id</label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <input type="text" name="license" class="form-control inp"
                                    placeholder="Enter License ID" value="{{ old('license') }}">
                            </div>
                        </div>
                        <div class="row align-items-center margin-top-top">
                            <div class="col text-end px-0">
                                <label for="License_Id" class="col-form-label text-dark">License Picture</label>
                            </div>
                            <div class="col-9 justify-content-end">
                                <div class="" style="position: relative; width: fit-content;">
                                    <!-- Image Preview -->
                                    <img id="preview_license_picture" class="avtars avtarc"
                                        src="{{ asset('assets/img/licenceID_placeholder.jpg') }}" alt="avatar">

                                    <!-- File Input (Hidden by Default) -->
                                    <input type="file" id="file_license_picture" name="license_picture"
                                        accept="image/png, image/jpeg" style="display: none;"
                                        onchange="previewImage(this, 'license_picture')">

                                    <div class="divedit" style="top: 0px !important;">
                                        <!-- Edit Button -->
                                        <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}"
                                            alt="edit" style="cursor: pointer;"
                                            onclick="document.getElementById('file_license_picture').click();">

                                        <!-- Delete Button -->
                                        <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}"
                                            alt="delete" style="cursor: pointer;"
                                            onclick="removeImage('license_picture')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="parent_customer_id" class="form-control inp"
                            placeholder="Enter License ID" value="">
                    </div>
                    <!-- #region -->
                    <div class="text-end mt-3">

                            <div id="add_ship_save_body">
                                <button type="button" class="btn btn-primary buttons" id="add_customer_modal_save">
                                    Save
                                </button>
                                <button type="button" class="btn btn-outline-secondary" id="add_cutomer_modal_cancel" data-bs-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>

                            </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
