<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <div class="d-flex innertopnav w-100 justify-content-between">
            <p class="subhead pheads">Edit Customer</p>
            <div class="btnwrapper">
                <a
                {{-- href="{{ route('admin.customer.viewPickups', $user->id) }}"  --}}
                href="{{route('admin.invoices.create').'?type=supplies&customerId='.$user->id}}"
                class="btn btn-primary buttons me-1">
                    Pickup </a>
                <a href="{{route('admin.invoices.create').'?type=services&customerId='.$user->id}}" class="btn btn-primary buttons"> Invoice </a>
            </div>
        </div>
    </x-slot>
    <div class="">
        <div class="authTabDiv">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3 active" href="#customerDetails"
                        data-bs-toggle="tab">Customer Details</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3" href="#Invoice"
                        data-bs-toggle="tab">Invoice</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3" href="#Payments"
                        data-bs-toggle="tab">Payments</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3" href="#ShipTo"
                        data-bs-toggle="tab">ShipTo</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3" href="#Pickups"
                        data-bs-toggle="tab">Pickups</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light me-3" href="#PickupAddresss"
                        data-bs-toggle="tab">Pickup Address</a></li>
                <li class="nav-item"><a class="btnBorder th-font col737 bg-light" href="#Deposite"
                        data-bs-toggle="tab">Deposite</a></li>
            </ul>
        </div>
        <div class="tab-content bg-transparent px-0 d-block">
            <div class="tab-pane" id="customerDetails">
                <form action="{{ route('admin.customer.update', $user->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row gx-3" style="justify-content: space-between;">
                        <div class="col-md-6 mb-2">
                            <div class="borderset">
                                <div class="row gx-3">
                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="company_name"> Customer ID</label>
                                        <input type="text" class="form-control inp" id="unique_id" name="unique_id"
                                            style="background: #ececec;" placeholder="" value="{{ $user->unique_id }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="company_name"> Company </label>
                                        <input type="text" name="company_name" class="form-control inp"
                                            placeholder="Enter Company Name"
                                            value="{{ old('company_name', $user->company_name) }}">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="first_name">Full Name <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="first_name" class="form-control inp"
                                            placeholder="Enter Full Name" value="{{ old('first_name', $user->name) }}">
                                        @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="last_name">Last Name <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="last_name" class="form-control inp"
                                            placeholder="Enter Last Name" value="{{ old('last_name', $user->last_name) }}">
                                        @error('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 edit_mobile_code_class mb-2" style="display: grid;">
                                        <label class="foncolor" for="edit_mobile_code">Mobile No. <i
                                                class="text-danger">*</i></label>

                                        <div class="flaginputwrap">
                                            <div class="customflagselect">
                                                <select class="flag-select" name="mobile_number_code_id">
                                                    @foreach ($coutry as $key => $item)
                                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                            data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                                             data-length="{{ $item->phone_length ?? 10 }}"
                                                            {{ $item->id == old('mobile_number_code_id', $user->phone_code_id) ? 'selected' : '' }}>
                                                            {{ $item->name }} +{{ $item->phonecode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control flagInput inp"
                                                placeholder="Enter Mobile No" name="mobile_number"
                                                value="{{ old('mobile_number', $user->phone) }}"
                                                >
                                        </div>
                                        @error('mobile_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>

                                    <div class="col-md-12 alternate_mobile_no_class" style="display: grid;">
                                        <label class="foncolor" for="alternate_mobile_no">Alternate Mobile No.</label>
                                        <div class="flaginputwrap">
                                            <div class="customflagselect">
                                                <select class="flag-select" name="alternative_mobile_number_code_id">
                                                    @foreach ($coutry as $key => $item)
                                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                            data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                                            data-length="{{ $item->phone_length ?? 10 }}"
                                                            {{ $item->id == old('alternative_mobile_number_code_id', $user->phone_2_code_id_id) ? 'selected' : '' }}>
                                                            {{ $item->name }} +{{ $item->phonecode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control flagInput inp"
                                                placeholder="Enter Mobile No. 2" name="alternative_mobile_number"
                                                value="{{ old('alternative_mobile_number', $user->phone_2) }}"
                                                >
                                        </div>
                                         @error('alternative_mobile_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="address_1">Address 1 <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="address_1"
                                            value="{{ old('address_1', $user->address) }}" class="form-control inp"
                                            placeholder="Enter Address 1">
                                        @error('address_1')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="Address_2">Address 2 </label>
                                        <input type="text" name="Address_2"
                                            value="{{ old('Address_2', $user->address_2) }}" class="form-control inp"
                                            placeholder="Enter Address 2">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor" for="country">Country <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="country"
                                            value="{{ old('country', $user->country_id) }}" class="form-control inp"
                                            readonly style="background: #ececec;">
                                        @error('country')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor" for="state">State <i class="text-danger">*</i></label>
                                        <input type="text" name="state" value="{{ old('country', $user->state_id) }}"
                                            class="form-control inp" readonly style="background: #ececec;">
                                        @error('state')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                                        <input type="text" name="city" value="{{ old('country', $user->city_id) }}"
                                            class="form-control inp" readonly style="background: #ececec;">
                                        @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor" for="Apartment">Apartment </label>
                                        <input type="text" name="Apartment"
                                            value="{{ old('apartment', $user->apartment) }}" class="form-control inp"
                                            placeholder="Enter Apartment">
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="Zip_code">Zip code</label>
                                        <input type="text" name="Zip_code" value="{{ old('Zip_code', $user->pincode) }}"
                                            class="form-control inp" placeholder="Enter Zip">
                                        @error('Zip_code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="username">Username <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="username"
                                            value="{{ old('Username', $user->username) }}" class="form-control inp"
                                            placeholder="Enter User Name">
                                        @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor" for="latitude">Latitude <i
                                                class="text-danger">*</i></label>
                                        <input type="number" name="latitude"
                                            value="{{ old('latitude', $user->latitude) }}" class="form-control inp"
                                            placeholder="0" readonly style="background: #ececec;">
                                        @error('latitude')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="foncolor" for="longitude">Longitude <i
                                                class="text-danger">*</i></label>
                                        <input type="number" name="longitude"
                                            value="{{ old('longitude', $user->longitude) }}" class="form-control inp"
                                            placeholder="0" readonly style="background: #ececec;">
                                        @error('longitude')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- first left side form clouser div is next  -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="borderset">
                                <div class="row gx-3">
                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="website_url">Website</label>
                                        <input type="text" name="website_url" class="form-control inp"
                                            value="{{ old('website_url', $user->website_url) }}"
                                            placeholder="Enter Website ID">

                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="email">Email</label>
                                        <input type="text" name="email" class="form-control inp"
                                            placeholder="Enter Email ID" value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="warehouse"> Warehouse </label>
                                        <select class="js-example-basic-single select2" name="warehouse_id">
                                            <option disabled>Select Warehouse</option>
                                            @foreach ($warehouses as $warehouse)
                                                                                    <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $user->warehouse_id ?? '') ==
                                                $warehouse->id ? 'selected' : '' }}>
                                                                                        {{ $warehouse->warehouse_name }}
                                                                                    </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="container">Group Container </label>
                                        <select class="js-example-basic-single select2" name="container_id"
                                            value="{{ old('container_id') }}">
                                            <option value="">Select Container</option>
                                            @foreach ($containers as $container)
                                                                                    <option value="{{ $container->id }}" {{ old('country', $user->vehicle_id) == $container->id ?
                                                'selected' : '' }}>
                                                                                        {{ $container->container_no_1 }}
                                                                                    </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor">Signature Date </label>
                                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                            <input type="text" name="edit_signature_date"
                                                class="btn-filters  form-cs inp" readonly style="cursor: pointer;"
                                                placeholder="MM-DD-YYYY"
                                                value="{{ old('edit_signature_date', $user->signature_date ? \Carbon\Carbon::parse($user->signature_date)->format('n/j/Y') : '') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="Year_to_Date">Year to Date</label>
                                        <input type="text" name="year_to_date" id="Year to Date"
                                            class="form-control inp" maxlength="4" pattern="\d*" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);"
                                            placeholder="0" value="{{ old('year_to_date', $user->year_to_date) }}">
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="License_ID">License ID</label>
                                        <input type="text" id="License_ID" name="license_number"
                                            class="form-control inp"
                                            value="{{ old('license_number', $user->license_number) }}"
                                            placeholder="Enter License ID">
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor">License Expiry Date </label>
                                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                            <input type="text" name="edit_license_expiry_date"
                                                class="btn-filters form-cs inp" readonly style="cursor: pointer;"
                                                value="{{ old('edit_license_expiry_date', $user->license_expiry_date ? \Carbon\Carbon::parse($user->license_expiry_date)->format('n/j/Y') : '') }}"
                                                placeholder="MM-DD-YYYY" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="warehouse"> Language </label>
                                        <select class="js-example-basic-single select2" name="language">
                                            <option value="English" {{ (old('language', $user->language ?? 'English') == 'English') ? 'selected' : '' }}>English</option>
                                            <option value="Hindi" {{ (old('language', $user->language ?? 'English') == 'Hindi') ? 'selected' : '' }}>Hindi</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="Write_Comment">Write Comment</label>
                                        <textarea id="Write_Comment" name="write_comment"
                                            class="form-control inp commenth" rows="3"
                                            placeholder="Enter Write Comment">{{ old('write_comment', $user->write_comment) }}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="foncolor" for="Read_Comment">Read Comment</label>
                                        <textarea id="Read_Comment" name="read_comment"
                                            class="form-control inp commenth" rows="3"
                                            placeholder="Enter Read Comment">{{ old('read_comment', $user->read_comment) }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row custodis">
                        @php
                            $imglabel = ['profile_pic' => 'Profile pics', 'signature_img' => 'Signature', 'contract_signature_img' => 'Contract signature', 'license_document' => 'License picture'];
                        @endphp
                        @foreach (['profile_pic', 'signature_img', 'contract_signature_img', 'license_document'] as $imageType)
                            <input type="hidden" id="delete_{{ $imageType }}" name="delete_{{ $imageType }}" />
                            <div class="col-md-3">
                                <div class="d-flex align-items-center justify-content-center avtard">
                                    <label class="foncolor set"
                                        for="{{ $imageType }}">{{ ucfirst($imglabel[$imageType])
                                                                                                                                                                            }}</label>
                                    <div class="avtarset" style="position: relative;">
                                        <!-- Image Preview -->
                                        <img id="preview_{{ $imageType }}" class="avtars avtarc"
                                            src="{{ $user->{$imageType} ? (Str::startsWith($user->{$imageType}, 'http') ? $user->{$imageType} : asset("storage/" . $user->{$imageType})) : asset('assets/img.png') }}"
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
                                                style="cursor: pointer;" @if (!empty($user->{$imageType}))
                                                onclick="removeImage('{{ $imageType }}')" @endif>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
                                                name="contract" {{ old('contract', $user->contract ?? '') == 'Yes' ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="contract">No
                                            </label>
                                            <input class="form-check-input mt-0" {{ old('contract', $user->contract ?? '') == 'No' ? 'checked' : '' }} type="radio" value="No" name="contract">
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
                                                name="text_cust" {{ old('text_cust', $user->text_cust ?? '') == 'Yes' ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="text_cust">No</label>
                                            <input class="form-check-input mt-0" type="radio" value="No"
                                                name="text_cust" {{ old('text_cust', $user->text_cust ?? '') == 'No' ? 'checked' : '' }}>
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
                                                name="voice_call" {{ old('voice_call', $user->voice_call ?? '') == 'Yes' ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="voice_call">No</label>
                                            <input class="form-check-input mt-0" {{ old('voice_call', $user->voice_call ?? '') == 'No' ? 'checked' : '' }}  type="radio" value="No"
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
                                                name="cash_cust" {{ old('cash_cust', $user->cash_cust ?? '') == 'Yes' ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="cash_cust">No</label>
                                            <input class="form-check-input mt-0" {{ old('cash_cust', $user->cash_cust ?? '') == 'No' ? 'checked' : '' }} type="radio" value="No"
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
                                                name="is_license_pic" {{ old('is_license_pic', $user->is_license_pic ?? '') == 'Yes' ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="is_license_pic">No</label>
                                            <input class="form-check-input mt-0" type="radio" value="No"
                                                name="is_license_pic" {{ old('is_license_pic', $user->is_license_pic ?? '') == 'No' ? 'checked' : '' }}>
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
                                                name="no_service" {{ old('no_service', $user->no_service ?? '') == 'Yes' ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="no_service">No</label>
                                            <input class="form-check-input mt-0" {{ old('no_service', $user->no_service ?? '') == 'No' ? 'checked' : '' }} type="radio" value="No"
                                                name="no_service" >
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
                                            <input class="form-check-input mt-0" type="radio" value="Yes" name="call"
                                            {{ old('call', $user->call ?? '') == 'Yes' ? 'checked' : '' }}
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="call">No</label>
                                            <input class="form-check-input mt-0" {{ old('call', $user->call ?? '') == 'No' ? 'checked' : '' }} type="radio" value="No"
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
                                                name="sales_call" {{ old('sales_call', $user->sales_call ?? '') == 'Yes' ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-block mb-3 d-flex align-items-center">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A" for="sales_call">No</label>
                                            <input class="form-check-input mt-0" {{ old('sales_call', $user->sales_call ?? '') == 'No' ? 'checked' : '' }} type="radio" value="No"
                                                name="sales_call">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- ---------- -->

                    <div class="ptop d-flex">
                        <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                            <div class="mb-3 float-end">
                                <label for="in_status">Status</label>
                                <div class="d-flex align-items-center text-dark">
                                    <p class="profileUpdateFont" id="activeText">Active</p>
                                    <div class="status-toggle px-2">
                                        <input id="rating_6" class="check" type="checkbox" name="status" value="Active"
                                            @checked($user->status === 'Inactive') onchange="updateStatusValue()">
                                        <label for="rating_6" class="checktoggle log checkbox-bg">checkbox</label>
                                    </div>
                                    <p class="profileUpdateFont faded" id="inactiveText">Inactive</p>
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

                        <input id="state_id_defult" type="hidden" name="state_id_defult"
                            value="{{ ($user->state_id) }}">
                        <input id="city_id_defult" type="hidden" name="city_id_defult" value="{{ ($user->city_id) }}">
                        <input id="page_no" type="hidden" name="page_no" value="{{ ($page_no) }}">
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="Invoice">
                <div>
                    <form class="invoice">
                        <div class="row justify-content-between g-3">
                            <div class="col-md-4 dposition">
                                <div class="d-flex align-items-center">
                                    <label for="searchInput" class="foncolor p-0 mb-0 me-3">Search</label>
                                    <div class="inputgroups relative">
                                        <i class="ti ti-search"></i>
                                        <input type="text" id="searchInput" class="form-control form-cs"
                                            placeholder="Search">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-end align-content-end">
                                <button class="btn px-4 btn-primary me-2">Search</button>
                                <button class="btn px-4 btn-outline-danger">Reset</button>
                            </div>
                        </div>
                        <div class="card-table">
                            <div class="card-body">
                                <div class="table-responsive mt-3">
                                    <table class="table table-stripped table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                                <th>S. No.</th>
                                                <th>Invoice ID</th>
                                                <th>Date</th>
                                                <th>I Amount</th>
                                                <th>Balance</th>
                                                <th>Container</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>TIV0021</td>
                                                <td>04-08-2025</td>
                                                <td>2550</td>
                                                <td>2000</td>
                                                <td>NYC01425</td>
                                                <td>Unpaid</td>
                                                <td>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon fas"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti ti-edit fs_18 me-2"></i>Update</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                                        data-bs-target="#individualPayment"><i
                                                                            class="ti ti-cash fs_18 me-2"></i>Payment</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti ti-printer fs_18 me-2"></i>PDF</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                                        data-bs-target="#sendinvoicepdf"><i
                                                                            class="ti ti-mail fs_18 me-2"></i>Send</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti ti-trash fs_18 me-2"></i>Delete</a>
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
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane" id="Payments">
                <form class="invoice">
                    <div class="row justify-content-between g-3">
                        <div class="col-md-4 dposition">
                            <div class="d-flex align-items-center">
                                <label for="searchInput" class="foncolor p-0 mb-0 me-3">Search</label>
                                <div class="inputgroups relative">
                                    <i class="ti ti-search"></i>
                                    <input type="text" id="searchInput" class="form-control form-cs"
                                        placeholder="Search">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-end align-content-end">
                            <button class="btn px-4 btn-primary me-2">Search</button>
                            <button class="btn px-4 btn-outline-danger">Reset</button>
                        </div>
                    </div>
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive mt-3">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>User</th>
                                            <th>Receipt No</th>
                                            <th>Payment</th>
                                            <th>Balance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-start">TIV0021</td>
                                            <td>04-08-2025</td>
                                            <td>--</td>
                                            <td>TIP-00288</td>
                                            <td>30</td>
                                            <td>200</td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#InvoiceLabel"><i
                                                                        class="ti ti-printer fs_18 me-2"></i>PDF</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#sendinvoicepdf"><i
                                                                        class="ti ti-mail fs_18 me-2"></i>Send</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i
                                                                        class="ti ti-trash fs_18 me-2"></i>Delete</a>
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
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="ShipTo">
                <form class="invoice">
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-6">
                            <p class="mainheading">ShipTo Address List</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.customer.viewShipTo', $user->id) }}"
                                class="btn btn-primary buttons">
                                <i class="ti ti-circle-plus me-2 text-white"></i>
                                Add ShipTo Address
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-between g-3">
                        <form action="{{ route('admin.customer.edit', $user->id) }}" method="GET">
                            <div class="col-md-4 dposition">
                                <div class="d-flex align-items-center">
                                    <label for="searchInput" class="foncolor p-0 mb-0 me-3">Search</label>
                                    <div class="inputgroups relative">
                                        <i class="ti ti-search"></i>
                                        <input type="text" name="search" class="form-control form-cs"
                                            placeholder="Search" value="{{ request('search') }}">
                                        <input type="hidden" name="type" class="form-control form-cs"
                                            placeholder="Search" value="ShipTo">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-end align-content-end">
                                <button type="submit" class="btn px-4 btn-primary me-2">Search</button>
                                <button id="shipto_reset" type="button"
                                    class="btn px-4 btn-outline-danger">Reset</button>
                            </div>
                        </form>
                    </div>
                    <div id='ShipToTable'>
                        <div class="card-table">
                            <div class="card-body">
                                <div class="table-responsive mt-3">
                                    <table class="table table-stripped table-hover lessPadding datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ShipTo Id</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Cellphone</th>
                                                <th>Telephone</th>
                                                <th>Licence ID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ShipToCustomer as $child)
                                                <tr>
                                                    <td>{{ $child->unique_id ?? '-' }}</td>
                                                    <td>{{ ucfirst($child->name ?? '')}} {{ $child->last_name ?? ''}}</td>
                                                    <td>{{ $child->address ?? '-' }}</td>
                                                  <td>
                                                    @if($child->phone)
                                                        +{{ $child->phone_code->phonecode ?? '' }} {{ $child->phone }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($child->phone_2)
                                                        +{{ $child->phone_2_code->phonecode ?? '' }} {{ $child->phone_2 }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                    <td>{{ $child->license_number ?? '-' }}</td>
                                                    <td>
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon fas"
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul>
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('admin.customer.updateShipTo', $child->id) }}"><i
                                                                                class="ti ti-edit fs_18 me-2"></i>Update</a>
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('admin.customer.destroyShipTo', $child->id) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            <button type="button" class="dropdown-item"
                                                                                onclick="deleteData(this,'Wait! Are you sure you want to remove this ship to address?')"><i
                                                                                    class="far fa-trash-alt me-2"></i>Delete</button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
                            <div class="col-md-6 d-flex p-2 align-items-center">
                                <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
                                <select class="form-select input-width form-select-sm opacity-50"
                                    aria-label="Small select example" id="ShipTopageSizeSelect">
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="float-end">
                                    <div class="bottom-user-page mt-3">
                                        {!! $ShipToCustomer->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="Pickups">
                <form class="invoice">
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-6">
                            <p class="mainheading">Pickup List</p>
                        </div>
                    </div>
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive mt-3">
                                <table class="table table-stripped table-hover lessPadding littleMore datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>P.Name</th>
                                            <th>P.Address</th>
                                            <th>P.City</th>
                                            <th>P.Cell.No</th>
                                            <th>Zone</th>
                                            <th>Pickup Type</th>
                                            <th>Pickup Date</th>
                                            <th>Zipcode</th>
                                            <th>Driver</th>
                                            <th>Last Modified Date & Time</th>
                                            <th>Pickup ID</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Pickups as $child)
                                            <tr>
                                                <td class="text-start">{{ucfirst($child->pickupAddress->name ?? "")}} {{$child->pickupAddress->last_name ?? ""}}</td>
                                                <td>{{$child->pickupAddress->address ?? "-"}}</td>
                                                <td>{{$child->pickupAddress->city_id ?? "-"}}</td>
                                                <td>
                                                    @if($child->pickupAddress && $child->pickupAddress->phone)
                                                        +{{ $child->pickupAddress->phone_code->phonecode ?? '' }} {{ $child->pickupAddress->phone }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{$child->Zone ?? "-"}}</td>
                                                <td>{{$child->pickup_type ?? "-"}}</td>
                                                <td>{{ \Carbon\Carbon::parse($child->Date)->format('m-d-Y') }}</td>
                                                <td>{{$child->pickupAddress->pincode ?? "-"}}</td>
                                                <td>{{ucfirst($child->driver->name ?? "")}} {{($child->driver->last_name ?? "")}}</td>
                                                <td>{{ \Carbon\Carbon::parse($child->updated_at)->format('m-d-Y') }}</td>
                                                <td>{{$child->pickupAddress->unique_id ?? "-"}}</td>
                                                <td>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.customer.updatePickup', $child->id) }}"><i
                                                                            class="ti ti-edit fs_18 me-2"></i>Update</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti ti-trash fs_18 me-2"></i>Delete</a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="PickupAddresss">
                <form class="invoice">
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-6">
                            <p class="mainheading">Pickup Address List</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.customer.viewPickupAddress', $user->id) }}"
                                class="btn btn-primary buttons">
                                <i class="ti ti-circle-plus me-2 text-white"></i>
                                Add Pickup Address
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-between g-3">
                        <form action="{{ route('admin.customer.edit', $user->id) }}" method="GET">
                            <div class="col-md-4 dposition">
                                <div class="d-flex align-items-center">
                                    <label for="searchInput" class="foncolor p-0 mb-0 me-3">Search</label>
                                    <div class="inputgroups relative">
                                        <i class="ti ti-search"></i>
                                        <input type="text" name="search" class="form-control form-cs"
                                            placeholder="Search" value="{{ request('search') }}">
                                        <input type="hidden" name="type" class="form-control form-cs"
                                            placeholder="Search" value="PickupAddresss">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-end align-content-end">
                                <button type="submit" class="btn px-4 btn-primary me-2">Search</button>
                                <button id="pickup_addresss_reset" type="button"
                                    class="btn px-4 btn-outline-danger">Reset</button>
                            </div>
                        </form>
                    </div>
                    <div id='ShipToTable'>
                        <div class="card-table">
                            <div class="card-body">
                                <div class="table-responsive mt-3">
                                    <table class="table table-stripped table-hover lessPadding datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Pickup Id</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Cellphone</th>
                                                <th>Telephone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($PickupAddress as $child)
                                                <tr>
                                                    <td>{{ $child->unique_id ?? '-' }}</td>
                                                    <td>{{ ucfirst($child->name ?? '')}} {{ $child->last_name ?? ''}}</td>
                                                    <td>{{ $child->address ?? '-' }}</td>
                                                    <td>
                                                    @if($child->mobile_number)
                                                        +{{ $child->mobile_number_code->phonecode ?? '' }} {{ $child->mobile_number }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($child->alternative_mobile_number)
                                                        +{{ $child->alternative_mobile_number_code->phonecode ?? '' }} {{ $child->alternative_mobile_number }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                    <td>
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon fas"
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul>
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('admin.customer.updatePickupAddress', $child->id) }}"><i
                                                                                class="ti ti-edit fs_18 me-2"></i>Update</a>
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('admin.customer.destroyPickupAddress', $child->id) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            <button type="button" class="dropdown-item"
                                                                                onclick="deleteData(this,'Wait! Are you sure you want to remove this pickup address?')"><i
                                                                                    class="far fa-trash-alt me-2"></i>Delete</button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
                            <div class="col-md-6 d-flex p-2 align-items-center">
                                <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
                                <select class="form-select input-width form-select-sm opacity-50"
                                    aria-label="Small select example" id="ShipTopageSizeSelect">
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="float-end">
                                    <div class="bottom-user-page mt-3">
                                        {!! $PickupCustomer->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="Deposite">
                <form class="invoice">
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-6">
                            <p class="mainheading">Deposit</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <a class="btn btn-primary buttons" data-bs-toggle="modal" data-bs-target="#depositModel">
                                <i class="ti ti-circle-plus me-2 text-white"></i>
                                Add Deposit
                            </a>
                        </div>
                    </div>
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive mt-3">
                                <table class="table table-stripped table-hover lessPadding datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Creation Date</th>
                                            <th>Creation User</th>
                                            <th>Creation Branch</th>
                                            <th>Used User</th>
                                            <th>Used Branch</th>
                                            <th>Invoice No</th>
                                            <th>Amt Deposit</th>
                                            <th>Amt Used</th>
                                            <th>Used Date</th>
                                            <th>IsUsed</th>
                                            <th>P.Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-start">05/08/2025</td>
                                            <td>Abijan Cargo Sacko</td>
                                            <td>Afro Cargo NYC USA</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>2500</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>No</td>
                                            <td>Cheque</td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#InvoiceLabel"><i
                                                                        class="ti ti-pdf fs_18 me-2"></i>Update</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i
                                                                        class="ti ti-trash fs_18 me-2"></i>Delete</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">05/08/2025</td>
                                            <td>Abijan Cargo Sacko</td>
                                            <td>Afro Cargo NYC USA</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>3500</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>Yes</td>
                                            <td>Cash</td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#InvoiceLabel"><i
                                                                        class="ti ti-pdf fs_18 me-2"></i>Update</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i
                                                                        class="ti ti-trash fs_18 me-2"></i>Delete</a>
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
                    </div>
                </form>
            </div>

        </div>
    </div>
    @section('script')
        <script>
            paginate({
                searchIn: 'ShipTosearchInput',
                ajexTable: 'ShipToTable',
                pageSizeSlt: 'ShipTopageSizeSelect',
                type: 'ShipTo'
            })
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
                let title;
                if (imageType == 'profile_pic') {
                    title = "Are you sure you want to remove this profile pic?";
                } else if (imageType == 'contract_signature_img') {
                    title = "Are you sure you want to remove this contract signature?";
                } else if (imageType == 'signature_img') {
                    title = "Are you sure you want to remove this signature?";
                } else if (imageType == 'license_document') {
                    title = "Are you sure you want to remove this license document?";
                }
                Swal.fire({
                    title: title,
                    icon: 'warning',
                    showCancelButton: true,
                    showCloseButton: true, // ✅ this line adds the "X" close button
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('preview_' + imageType).src = "{{ asset('assets/img.png') }}";
                        document.getElementById('file_' + imageType).value = "";
                        document.getElementById('delete_' + imageType).value = 1;
                    }
                });
            }

        </script>
        <script>
            $(document).ready(function () {
                loadStatesAndCitiesOnEdit();
                // Country Change Event
                $('#country').change(function () {
                    var country_id = $(this).val();
                    $('#state').html('<option selected="selected">Loading...</option>');
                    $('#city').html('<option selected="selected">Select City</option>');

                    $.ajax({
                        url: '/api/get-states/' + country_id
                        , type: 'GET'
                        , success: function (states) {
                            $('#state').html('<option selected="selected">Select State</option>');
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
                            $('#city').html('<option selected="selected">Select City</option>');
                            $.each(cities, function (key, city) {
                                $('#city').append('<option value="' + city.id + '">' + city
                                    .name + '</option>');
                            });
                        }
                    });
                });

                function loadStatesAndCitiesOnEdit() {
                    var country_id = $('#country').val();
                    var state_id_defult = $('#state_id_defult').val();
                    var city_id_defult = $('#city_id_defult').val();
                    var selected_state = "{{ $user->state ?? '' }}"; // Backend se state ka ID le rahe hain
                    var selected_city = "{{ $user->city ?? '' }}"; // Backend se city ka ID le rahe hain

                    if (country_id) {
                        $('#state').html('<option selected="selected">Loading...</option>');
                        $.ajax({
                            url: '/api/get-states/' + country_id
                            , type: 'GET'
                            , success: function (states) {
                                $('#state').html('<option selected="selected">Select State</option>');
                                $.each(states, function (key, state) {
                                    var selected = state.id == state_id_defult ? 'selected' : '';
                                    $('#state').append('<option value="' + state.id + '" ' + selected + '>' +
                                        state.name + '</option>');
                                });

                                // Call city API only if state is selected
                                if (state_id_defult) {
                                    $('#city').html('<option selected="selected">Loading...</option>');
                                    $.ajax({
                                        url: '/api/get-cities/' + state_id_defult
                                        , type: 'GET'
                                        , success: function (cities) {
                                            $('#city').html('<option selected="selected">Select City</option>');
                                            $.each(cities, function (key, city) {
                                                var selected = city.id == city_id_defult ? 'selected' : '';
                                                $('#city').append('<option value="' + city.id + '" ' + selected + '>' +
                                                    city.name + '</option>');
                                            });
                                        }
                                    });
                                }
                            }
                        });
                    }
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
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const tabs = document.querySelectorAll('.nav-tabs .nav-item a');
                const tabContentPanes = document.querySelectorAll('.tab-pane');
                const url = new URL(window.location.href);
                const urlParams = url.searchParams;
                let activeTab = urlParams.get('type');

                // If 'type' is missing in URL, default to 'customerDetails'
                if (!activeTab) {
                    activeTab = 'customerDetails';
                    urlParams.set('type', activeTab);
                    window.history.replaceState(null, '', url.toString());
                }

                // ✅ Always show the correct tab and tab-pane
                const tabTrigger = document.querySelector(`.nav-tabs a[href="#${activeTab}"]`);
                const activePane = document.getElementById(activeTab);

                if (tabTrigger && activePane) {
                    new bootstrap.Tab(tabTrigger).show();

                    // ✅ Always update tab-pane classes (even on refresh)
                    tabContentPanes.forEach(pane => pane.classList.remove('show', 'active'));
                    activePane.classList.add('show', 'active');
                }

                // On tab switch: update URL + activate content pane
                tabs.forEach(tab => {
                    tab.addEventListener('shown.bs.tab', function (e) {
                        const newTabId = e.target.getAttribute('href').replace('#', '');

                        tabContentPanes.forEach(pane => pane.classList.remove('show', 'active'));
                        const newPane = document.getElementById(newTabId);
                        if (newPane) newPane.classList.add('show', 'active');

                        const updatedUrl = new URL(window.location.href);
                        updatedUrl.searchParams.set('type', newTabId);
                        window.history.replaceState(null, '', updatedUrl.toString());
                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const resetBtn = document.getElementById('shipto_reset'); // Reset button by ID
                const form = resetBtn.closest('form'); // Closest form
                const searchInput = form.querySelector('input[name="search"]'); // Search input field

                resetBtn.addEventListener('click', function () {
                    searchInput.value = ''; // Clear the search input
                    form.submit(); // Submit the form
                });
            });
            document.addEventListener('DOMContentLoaded', function () {
                const resetBtn = document.getElementById('pickup_addresss_reset'); // Reset button by ID
                const form = resetBtn.closest('form'); // Closest form
                const searchInput = form.querySelector('input[name="search"]'); // Search input field

                resetBtn.addEventListener('click', function () {
                    searchInput.value = ''; // Clear the search input
                    form.submit(); // Submit the form
                });
            });
        </script>

    @endsection
</x-app-layout>
