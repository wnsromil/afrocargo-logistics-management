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
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}

    <div class="">
        <div class="authTabDiv">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3 active" href="#customerDetails"
                        data-bs-toggle="tab">Customer Details</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3 disabled-tab" href="#"
                        data-bs-toggle="tab">Invoice</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3 disabled-tab" href="#"
                        data-bs-toggle="tab">Payments</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3 disabled-tab" href="#"
                        data-bs-toggle="tab">ShipTo</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3 disabled-tab" href="#"
                        data-bs-toggle="tab">Pickups</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3 disabled-tab" href="#"
                        data-bs-toggle="tab">Pickup Address</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light disabled-tab" href="#"
                        data-bs-toggle="tab">Deposite</a></li>
            </ul>
        </div>
        <div class="tab-content bg-transparent px-0 d-block">
            <div class="tab-pane show active" id="customerDetails">
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
                                        <label class="foncolor" for="first_name">Full Name <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="first_name" class="form-control inp"
                                            placeholder="Enter Full Name" value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-2 mobile_code">
                                        <label class="foncolor" for="alternate_mobile_no">Mobile No.</label>
                                        <div class="flaginputwrap">
                                            <div class="customflagselect">
                                                <select class="flag-select" name="mobile_number_code_id">
                                                    @foreach ($coutry as $key => $item)
                                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                            data-name="{{ $item->name }}"
                                                            data-code="{{ $item->phonecode }}">
                                                            {{ $item->name }} +{{ $item->phonecode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control flagInput inp"
                                                placeholder="Enter Mobile No" name="mobile_number"
                                                value="{{ old('mobile_number') }}"
                                                oninput="this.value = this.value.slice(0, 10)">
                                        </div>
                                        @error('mobile_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <input type="hidden" id="country_code" name="country_code">

                                    <div class="col-md-12 mb-2 alternate_mobile_no">
                                        <label class="foncolor" for="alternate_mobile_no">Alternate Mobile No.</label>
                                        <div class="flaginputwrap">
                                            <div class="customflagselect">
                                                <select class="flag-select" name="alternative_mobile_number_code_id">
                                                    @foreach ($coutry as $key => $item)
                                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                            data-name="{{ $item->name }}"
                                                            data-code="{{ $item->phonecode }}">
                                                            {{ $item->name }} +{{ $item->phonecode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control flagInput inp"
                                                placeholder="Enter Mobile No. 2" name="alternative_mobile_number"
                                                value="{{ old('alternative_mobile_number') }}"
                                                oninput="this.value = this.value.slice(0, 10)">
                                        </div>
                                    </div>

                                    <input type="hidden" id="country_code_2" name="country_code_2">
                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="address_1">Address 1 <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="address_1" class="form-control inp"
                                            placeholder="Enter Address" value="{{ old('address_1') }}">
                                        @error('address_1')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="Address_2">Address 2 </label>
                                        <input type="text" name="Address_2" value="{{ old('Address_2') }}"
                                            class="form-control inp" placeholder="Enter Address 2">
                                    </div>


                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor" for="Apartment">Apartment </label>
                                        <input type="text" name="Apartment" value="{{ old('Apartment') }}"
                                            class="form-control inp" placeholder="Enter Apartment">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor" for="country">Country <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="country" value="{{ old('country') }}"
                                            class="form-control inp" readonly style="background: #ececec;">
                                        @error('country')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label class="foncolor" for="state">State <i class="text-danger">*</i></label>
                                        <input type="text" name="state" value="{{ old('state') }}"
                                            class="form-control inp" placeholder="" readonly
                                            style="background: #ececec;">
                                        @error('state')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                                        <input type="text" name="city" value="{{ old('city') }}"
                                            class="form-control inp" placeholder="" readonly
                                            style="background: #ececec;">
                                        @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label class="foncolor" for="Zip_code">Zipcode</label>
                                        <input type="text" name="Zip_code" value="{{ old('Zip_code') }}"
                                            class="form-control inp" placeholder="Enter Zip">
                                        @error('Zip_code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor " for="username">Username <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="username" value="{{ old('username') }}"
                                            class="form-control inp inputbackground" placeholder="Enter User Name">
                                        @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="password">Password <i
                                                class="text-danger">*</i></label>
                                        <div class="d-flex position-relative"
                                            style="border: 1px solid #00000042 !important; border-radius: 4px;">
                                            <input type="password" id="password" name="password"
                                                class="form-control pass-input inp" style="border: none !important"
                                                placeholder="Enter Password">
                                            <span toggle="#password"
                                                class="ti ti-eye field-icon toggle-password1"></span>
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
                                            <span toggle="#password1"
                                                class="ti ti-eye field-icon toggle-password1"></span>
                                        </div>
                                        @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div> --}}


                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor " for="latitude">Latitude <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="latitude" value="{{ old('latitude') }}"
                                            class="form-control inp inputbackground" placeholder="0" readonly
                                            style="background: #ececec;">
                                        @error('latitude')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor " for="longitude">Longitude <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="longitude" value="{{ old('longitude') }}"
                                            class="form-control inp inputbackground" placeholder="0" readonly
                                            style="background: #ececec;">
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
                                        <input type="text" name="email" class="form-control inp"
                                            placeholder="Enter Email ID" value="{{ old('email') }}">
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
                                            <input type="text" class="form-control"
                                                value="{{ $warehouses[0]->warehouse_name }}" readonly
                                                style="background-color: #e9ecef; color: #6c757d;">
                                            <input type="hidden" name="warehouse_id" value="{{ $warehouses[0]->id }}">
                                        </div>
                                    @else
                                        {{-- ✅ Select Dropdown for Multiple Warehouses --}}
                                        <div class="col-md-12 mb-2">
                                            <label class="foncolor" for="warehouse"> Warehouse </label>
                                            <select class="js-example-basic-single select2 form-control" name="warehouse_id"
                                                style="">
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
                                            <input type="text" name="signature_date" readonly style="cursor: pointer;"
                                                class="btn-filters  form-cs inp  inputbackground"
                                                value="{{ old('signature_date') }}" placeholder="mm-dd-yy" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor " for="Year_to_Date">Year to Date</label>
                                        <input type="text" name="year_to_date" id="Year_to_Date"
                                            class="form-control inp inputbackground" placeholder="0" maxlength="4"
                                            pattern="\d*" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);"
                                            value="{{ old('year_to_date') }}" />
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
                                            <input readonly style="cursor: pointer;" type="text"
                                                name="license_expiry_date" class="btn-filters  form-cs inp "
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
                                        <textarea id="Write_Comment" name="write_comment"
                                            class="form-control inp commenth" rows="3"
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

                    <div class="">
                        <div class="row mx-0 custodis">
                            @foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture'] as $imageType)
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center justify-content-center  avtard">
                                        <label class="foncolor set"
                                            for="{{ $imageType }}">{{ ucfirst(str_replace('_', ' ', $imageType)) }}</label>
                                        <div class="avtarset" style="position: relative;">
                                            <!-- Image Preview -->
                                            <img id="preview_{{ $imageType }}" class="avtars avtarc"
                                                src="{{ asset('assets/img.png') }}" alt="avatar">

                                            <!-- File Input (Hidden by Default) -->
                                            <input type="file" id="file_{{ $imageType }}" name="{{ $imageType }}"
                                                accept="image/png, image/jpeg" style="display: none;"
                                                onchange="previewImage(this, '{{ $imageType }}')">

                                            <div class="divedit">
                                                <!-- Edit Button -->
                                                <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}"
                                                    alt="edit" style="cursor: pointer;"
                                                    onclick="document.getElementById('file_{{ $imageType }}').click();">

                                                <!-- Delete Button -->
                                                <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}"
                                                    alt="delete" style="cursor: pointer;"
                                                    onclick="removeImage('{{ $imageType }}')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="contract">Contract</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="contract">Yes
                                            </label>
                                            <input class="form-check-input mt-0" type="radio" value="Yes"
                                                name="contract">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="contract">No
                                            </label>
                                            <input class="form-check-input mt-0" checked type="radio" value="No"
                                                name="contract">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="text_cust">Text Cust</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="text_cust">Yes</label>
                                            <input class="form-check-input mt-0" type="radio" value="Yes"
                                                name="text_cust">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="text_cust">No</label>
                                            <input class="form-check-input mt-0" checked type="radio" value="No"
                                                name="text_cust">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="voice_call">Voice Call</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="voice_call">Yes</label>
                                            <input class="form-check-input mt-0" type="radio" value="Yes"
                                                name="voice_call">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="voice_call">No</label>
                                            <input class="form-check-input mt-0" checked type="radio" value="No"
                                                name="voice_call">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="cash_cust">Cash Cust</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="cash_cust">Yes</label>
                                            <input class="form-check-input mt-0" type="radio" value="Yes"
                                                name="cash_cust">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="cash_cust">No</label>
                                            <input class="form-check-input mt-0" checked type="radio" value="No"
                                                name="cash_cust">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="is_license_pic">Is License Pic</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A"
                                                for="is_license_pic">Yes</label>
                                            <input class="form-check-input mt-0" type="radio" value="Yes"
                                                name="is_license_pic">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="is_license_pic">No</label>
                                            <input class="form-check-input mt-0" checked type="radio" value="No"
                                                name="is_license_pic">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="no_service">No Service</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="no_service">Yes</label>
                                            <input class="form-check-input mt-0" type="radio" value="Yes"
                                                name="no_service">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="no_service">No</label>
                                            <input class="form-check-input mt-0" checked type="radio" value="No"
                                                name="no_service">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="call">Call</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="call">Yes</label>
                                            <input class="form-check-input mt-0" type="radio" value="Yes" name="call">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="call">No</label>
                                            <input class="form-check-input mt-0" checked type="radio" value="No"
                                                name="call">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="sales_call">Sales Call</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="sales_call">Yes</label>
                                            <input class="form-check-input mt-0" type="radio" value="Yes"
                                                name="sales_call">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="sales_call">No</label>
                                            <input class="form-check-input mt-0" checked type="radio" value="No"
                                                name="sales_call">
                                        </div>
                                    </div>
                                </div>
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
                </form>
            </div>
        </div>
    </div>

    <!-- Individual Payment Modal -->
    <div class="modal custom-modal invoiceSModel fade" id="individualPayment" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0 border-bottom py-3">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">individual Payment</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body pt-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row pb-2">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Date<i class="text-danger">*</i></label>
                                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                        <input type="text" name="driverInventoryDate" class="btn-filters  form-cs inp"
                                            placeholder="MM/DD/YYYY" />
                                        <input type="text"
                                            class="form-control inp inputs text-center timeOnlyInput inputbackground"
                                            readonly value="09:20 AM" name="currentTIme">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label for="driver_id">Personal</label>
                                    <select class="js-example-basic-single select2  form-cs">
                                        <option selected="selected">Select Drive</option>
                                        <option>white</option>
                                        <option>purple</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>User<i class="text-danger">*</i></label>
                                    <input type="text" name="userName" class="form-control inp inputbackground" readonly
                                        value="Abigel Miyagi" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label for="driver_id">Currency<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2  form-cs">
                                        <option selected="selected" disabled hidden>Select Currency</option>
                                        <option value="USD">United States - USD</option>
                                        <option value="DKK">Greenland - DKK</option>
                                        <option value="EUR">European Union - EUR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label for="driver_id">Payment Type<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2  form-cs">
                                        <option selected="selected" disabled hidden>Select Type</option>
                                        <option value="boxcredit">Box Credit</option>
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="CreditCard">Credit Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Payment Amount<i class="text-danger">*</i></label>
                                    <input type="text" name="PaymentAmount" class="form-control inp"
                                        placeholder="Enter Payment Amount" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Reference</label>
                                    <input type="text" name="PaymentAmount" class="form-control inp"
                                        placeholder="Enter Reference" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Comment</label>
                                    <textarea name="PaymentAmount" class="form-control inp"
                                        placeholder="Enter Comment"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Invoice Amount<i class="text-danger">*</i></label>
                                    <input type="text" name="userName" class="form-control inp inputbackground" readonly
                                        value="600.00" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Total Balance<i class="text-danger">*</i></label>
                                    <input type="text" name="userName" class="form-control inp inputbackground" readonly
                                        value="300.00" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Exchange Rate Balance<i class="text-danger">*</i></label>
                                    <input type="text" name="userName" class="form-control inp inputbackground" readonly
                                        placeholder="Exchange Rate Balance" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Applied Payments<i class="text-danger">*</i></label>
                                    <input type="text" name="userName" class="form-control inp inputbackground" readonly
                                        placeholder="Applied Payments" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Applied Payment Total In USD<i class="text-danger">*</i></label>
                                    <input type="text" name="userName" class="form-control inp inputbackground" readonly
                                        placeholder="Applied Payment Total In USD" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Current Balance<i class="text-danger">*</i></label>
                                    <input type="text" name="userName" class="form-control inp inputbackground" readonly
                                        placeholder="Current Balance" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Exchange Rate<i class="text-danger">*</i></label>
                                    <input type="text" name="userName" class="form-control inp inputbackground" readonly
                                        placeholder="Exchange Rate" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Current Balance After Ex.Rate<i class="text-danger">*</i></label>
                                    <input type="text" name="userName" class="form-control inp inputbackground" readonly
                                        placeholder="Current Balance After Ex.Rate" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <p class="subhead">Payment Receipts</p>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive lesspadding border mt-3">
                                    <table class="table table-stripped table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Invoice ID</th>
                                                <th>User</th>
                                                <th>Payment Type</th>
                                                <th>Payment Date</th>
                                                <th>Amt. In Dollar</th>
                                                <th>Local Currency</th>
                                                <th>Currency</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>TIP-000710</td>
                                                <td>
                                                    <p class="overflow-ellpise" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Abijan Cargo Sacko">Abijan Cargo
                                                        Sacko</p>
                                                </td>
                                                <td>Cash</td>
                                                <td>04/28/2025, 03:21</td>
                                                <td>200.00</td>
                                                <td>-</td>
                                                <td>USD</td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti ti-file-type-pdf me-2"></i>PDF</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="add-customer-btns text-end">
                                    <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                                    <button type="submit" class="btn btn-primary ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Individual Payment Modal -->

    <!-- Send Invoice Pdf Modal -->
    <div class="modal custom-modal invoiceSModel fade" id="sendinvoicepdf" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 border-bottom py-3">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Send Invoice Pdf</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body pt-3 pb-2">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row pb-2">
                            <div class="col-12">
                                <div class="input-block mb-1">
                                    <label class="foncolor" for="templateTitle">Send Invoice from<i
                                            class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Email</label>
                                    <input class="form-check-input mt-0" checked type="radio" value="email"
                                        name="sentInvoicePdf">
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Text/SMS</label>
                                    <input class="form-check-input mt-0" type="radio" value="textorsms"
                                        name="sentInvoicePdf">
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="emailDiv">
                                    <div class="input-block mb-3">
                                        <label class="foncolor" for="emailId">Email Id<i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="emailId" class="form-control inp"
                                            placeholder="Enter Email ID">
                                    </div>
                                </div>

                                <div id="textorsmsDiv" style="display:none;">
                                    <div class="input-block mb-3">
                                        <label class="foncolor" for="alternate_mobile_no">Alternate Mobile No.</label>
                                        <input type="tel" id="alternate_mobile_no" name="alternate_mobile_no"
                                            class="form-control inp" placeholder="Enter Alternate Mobile No.">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="add-customer-btns text-end">
                                    <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                                    <button type="submit" class="btn btn-primary ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/Send Invoice Pdf Modal -->

    <!-- Deposit Modal -->
    <div class="modal custom-modal invoiceSModel fade" id="depositModel" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 border-bottom py-3">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Deposit</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body pt-3 pb-2">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row pb-2">
                            <div class="col-md-12">
                                <div class="input-block mb-2">
                                    <label class="foncolor" for="date">Date<i class="text-danger">*</i></label>
                                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                        <input type="text" name="driverInventoryDate" class="btn-filters form-cs inp"
                                            placeholder="MM/DD/YYYY" />
                                        <input type="text"
                                            class="form-control inp inputs text-center timeOnlyInput absolute" readonly
                                            name="currentTIme" value="10:45 AM">
                                        @error('driverInventoryDate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-block mb-2">
                                    <label class="foncolor" for="PaymentType">Payment Type <i
                                            class="text-danger">*</i></label>
                                    <select id="PaymentType" name="PaymentType" class="js-example-basic-single select2">
                                        <option value="" disabled hidden selected>Select Payment Type</option>
                                        <option value="Box Credit">Box Credit</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Quick Pay">Quick Pay</option>
                                        <option value="Mannual CC">Mannual CC</option>
                                        <option value="Deposit">Deposit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="input-block mb-2">
                                    <label class="foncolor" for="Amount">Amount<span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="Amount" class="form-control inp"
                                        placeholder="Enter Amount">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="add-customer-btns text-end">
                                    <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                                    <button type="submit" class="btn btn-primary ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/Send Invoice Pdf Modal -->

    <!-- labels Modal -->
    <div class="modal custom-modal invoiceSModel fade" id="InvoiceLabel" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 border-bottom py-3">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body px-0">

                    <body
                        style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; font-size: 12px; color: #000;">
                        <table width="100%" cellpadding="0" cellspacing="0"
                            style="border-collapse: collapse; max-width:400px; margin: 0 auto; background: #fff; border: 1px solid #ffffff;">
                            <tr>
                                <td>
                                    <table aria-describedby="table-description"
                                        style="width: 100%; table-layout: fixed;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                Afro Cargo Express Llc NY<br> 366 Concord Ave<br>
                                                                <!----> NY The Bronx
                                                                <br>
                                                                646-468-4135<br> 718-954-9093
                                                            </td>
                                                        </tr>
                                                    </table>

                                                <td style="text-align: right;">
                                                    <img style="width: 70px; margin-right: 5px;"
                                                        src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px;"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"
                                                    style="font-weight: bold; font-size: 30px; color: #000; text-align: center;">
                                                    TIV-000982
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table aria-describedby="table-description"
                                        style="width: 100%; table-layout: fixed; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 13px;">
                                                    04/11/2025</td>
                                                <td
                                                    style="padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 13px; text-align: right;">
                                                    User: Dra Sacko </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table aria-describedby="table-description"
                                        style="width: 100%; table-layout: fixed; border-bottom: 1px solid #000;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                            <tr>
                                                <td colspan="3"><b style="font-size: 13px;">Customer:</b><br> Fatoumata
                                                    <br> 2366 Grand Concourse New York
                                                    Bronx 10458
                                                    <br>
                                                    <b>cell:</b> 347-431-6992
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:5px;"></td>
                                            </tr>
                                            <tr>
                                                <td><b>Payment Number:</b> TIP-000288</td>
                                                <td style="text-align: center;"><b>Ref:</b> 1222</td>
                                                <td style="text-align: end;"><b>Inv Amt:</b> $ 800</td>
                                            </tr>
                                            <tr>
                                                <td style="height:0px;"></td>
                                            </tr>
                                            <tr></tr>

                                        </tbody>
                                    </table>
                                    <table>
                                        <tr>
                                            <td style="height:5px;"></td>
                                        </tr>
                                    </table>
                                    <table aria-describedby="table-description" style="width: 100%;">
                                        <thead>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table style="width: 100%; border-collapse: collapse;"
                                                        cellpadding="0" cellspacing="0">
                                                        <thead style="background-color: #E7E9F6;">
                                                            <th
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px; font-weight: 500;">
                                                                P.Type</th>
                                                            <th
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px; font-weight: 500;">
                                                                Dollar</th>
                                                            <th
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px; font-weight: 500;">
                                                                L.Currency</th>
                                                            <th
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px; font-weight: 500;">
                                                                Payment</th>
                                                            <th
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px; font-weight: 500;">
                                                                Balance</th>
                                                        </thead>
                                                        <tbody>
                                                            <td
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px;">
                                                                Cash</td>
                                                            <td
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px;">
                                                                $ 30 </td>
                                                            <td
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px;">
                                                                --</td>
                                                            <td
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px;">
                                                                $ 30</td>
                                                            <td
                                                                style="border: 1px solid #3a3a3a; border-collapse: collapse; padding: 5px;">
                                                                $ 500.00</td>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px;"><b>Local Currency Payment</b> --</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px;"><b>Dollar Payment:</b> $ 30</td>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </body>
                </div>
            </div>
        </div>
    </div>
    <!--/labels Modal -->
    @section('script')
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
                        url: '/api/get-states/' + $('#country').val()
                        , type: 'GET'
                        , success: function (states) {
                            $('#state').html('<option selected="selected">Select State</option>');
                            $.each(states, function (key, state) {
                                var selected = (state.id == oldState) ? 'selected' : ''; // ✅ Old value match kare
                                $('#state').append('<option value="' + state.id + '" ' + selected + '>' + state.name + '</option>');
                            });

                            // ✅ Agar old city available hai, toh cities load kare
                            if (oldCity) {
                                $('#city').html('<option selected="selected">Loading...</option>');
                                $.ajax({
                                    url: '/api/get-cities/' + oldState
                                    , type: 'GET'
                                    , success: function (cities) {
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
    @endsection
</x-app-layout>