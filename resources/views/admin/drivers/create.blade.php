<x-app-layout>
    <x-slot name="header">
        Drivers Management
    </x-slot>

    <x-slot name="cardTitle">
        <p class="subhead">Add Driver</p>
    </x-slot>

    <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="warehouse_name">Warehouse Name <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                                <option {{ old('warehouse_name') == $warehouse->id ? 'selected' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Driver Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="driver_name">Driver Name<i class="text-danger">*</i></label>
                        <input type="text" name="driver_name" class="form-control inp" placeholder="Enter Full Name"
                            value="{{ old('driver_name') }}">
                        @error('driver_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="email">E-mail <i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Contact Number"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

                <!-- Contact Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="phone">Contact Number <i class="text-danger">*</i></label>
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
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="email" class="foncolor">Email ID<i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control inp" placeholder="Enter Email Id"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="address_1">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address_1" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('address_1') }}">
                        @error('address_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="vehicle_type">Vehicle<i class="text-danger">*</i></label>
                        <select name="vehicle_type" class="form-control inp select2">
                            <option value="">Select Vehicle</option>
                            @foreach($Vehicle_data as $Vehicle)
                                <option {{ old('vehicle_type') == $Vehicle->id ? 'selected' : '' }}
                                    value="{{ $Vehicle->id }}">
                                    {{ $Vehicle->vehicle_type }}
                                    (
                                    {{ $Vehicle->vehicle_type == '1' ? $Vehicle->container_no_1 : $Vehicle->vehicle_number }}
                                    )
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- license Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_number">License Number<i class="text-danger">*</i></label>
                        <input type="text" name="license_number" class="form-control inp" placeholder="Enter License"
                            value="{{ old('license_number') }}">
                        @error('license_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_expiry_date">License Expiry Date<i
                                class="text-danger">*</i></label>
                        <input type="text" name="license_expiry_date" class="form-control inp"
                            placeholder="Select Expiry Date" value="{{ old('license_expiry_date') }}">
                        @error('license_expiry_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_document">License Document<i
                                class="text-danger">*</i></label>
                        <input type="file" name="license_document" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('license_document') }}">
                        @error('license_document')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="status">Status <i class="text-danger">*</i></label>
                        <div class="status-toggle">
                            <span>Active</span>
                            <input id="rating_1" name="status" class="check" type="checkbox" value="Active">
                            <label for="rating_1" class="checktoggle checkbox-bg"></label>
                            <span class="inactive">Inactive</span>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="latitude" value="{{ old('latitude') }}"
                    class="form-control inp inputbackground" placeholder="0" readonly style="background: #ececec;">
                <input type="hidden" name="longitude" value="{{ old('longitude') }}"
                    class="form-control inp inputbackground" placeholder="0" readonly style="background: #ececec;">


                <input type="hidden" name="country" value="{{ old('country') }}" class="form-control inp" readonly
                    style="background: #ececec;">
            </div>
        </div>

        <div class="add-customer-btns text-end">

            <button type="button" onclick="redirectTo('{{ route('admin.drivers.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>

            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>
    </form>

    {{-- <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">

                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="warehouse_name">Warehouse Name <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                            <option {{ old('warehouse_name')==$warehouse->id ? 'selected' : '' }} value="{{
                                $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Driver Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="driver_name">Driver Name<i class="text-danger">*</i></label>
                        <input type="text" name="driver_name" class="form-control inp" placeholder="Enter Full Name"
                            value="{{ old('driver_name') }}">
                        @error('driver_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="email">E-mail <i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Contact Number"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

                <!-- Contact Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="phone">Contact Number <i class="text-danger">*</i></label>
                        <input type="tel" id="mobile_code" name="mobile_code" class="form-control inp"
                            placeholder="Enter Contact Number" value="{{ old('mobile_code') }}" maxlength="10"
                            pattern="[0-9]{10}" title="Please enter a valid 10-digit number">
                        @error('mobile_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="hidden" id="country_code" name="country_code">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="email" class="foncolor">Email ID<i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control inp" placeholder="Enter Email Id"
                            value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="address">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('address') }}">
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="vehicle_type">Vehicle<i class="text-danger">*</i></label>
                        <select name="vehicle_type" class="form-control inp select2">
                            <option value="">Select Vehicle</option>
                            @foreach($Vehicle_data as $Vehicle)
                            <option {{ old('vehicle_type')==$Vehicle->id ? 'selected' : '' }} value="{{ $Vehicle->id
                                }}">
                                {{ $Vehicle->vehicle_type }}
                                (
                                {{ $Vehicle->vehicle_type == '1' ? $Vehicle->container_no_1 : $Vehicle->vehicle_number
                                }}
                                )
                            </option>
                            @endforeach
                        </select>
                        @error('vehicle_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- license Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_number">License Number<i class="text-danger">*</i></label>
                        <input type="text" name="license_number" class="form-control inp" placeholder="Enter License"
                            value="{{ old('license_number') }}">
                        @error('license_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- License Expiry Date -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_expiry_date">License Expiry Date<i
                                class="text-danger">*</i></label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" name="license_expiry_date" class="btn-filters  form-cs inp "
                                style="cursor: pointer;" placeholder="Select Expiry Date"
                                value="{{ old('license_expiry_date') }}">
                        </div>
                        @error('license_expiry_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- License Documen -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_document">License Document<i
                                class="text-danger">*</i></label>
                        <input type="file" name="license_document" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('license_document') }}">
                        @error('license_document')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- User Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="driverUsername">User Name<i class="text-danger">*</i></label>
                        <input type="text" name="driverUsername" class="form-control inp" placeholder="Enter User Name"
                            value="{{ old('driverUsername') }}">
                        @error('driverUsername')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <h3 class="head">Configurations</h3>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-1">
                        <label class="foncolor" for="driverFor">Pickup Delivery<i class="text-danger">*</i></label>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="driverFor">P (Pickup)</label>
                                    <input class="form-check-input mt-0" checked type="radio" value="pickup"
                                        name="driverFor">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="driverFor">D (Delivery)</label>
                                    <input class="form-check-input mt-0" type="radio" value="Delivery" name="driverFor">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-1">
                        <label class="foncolor" for="customerpickup">Customer Pickup Only (Mobile)<i
                                class="text-danger">*</i></label>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="customerpickup">Yes</label> <input
                                        class="form-check-input mt-0" type="radio" value="Yes" name="customerpickup">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="customerpickup">No</label> <input
                                        class="form-check-input mt-0" checked type="radio" value="No"
                                        name="customerpickup">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="customerpickup">All</label> <input
                                        class="form-check-input mt-0" type="radio" value="All" name="customerpickup">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-1">
                        <label class="foncolor" for="customerdelivery">Customer Delivery Only (Mobile)<i
                                class="text-danger">*</i></label>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="customerdelivery">Yes</label>
                                    <input class="form-check-input mt-0" type="radio" value="Yes"
                                        name="customerdelivery">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="customerdelivery">No</label>
                                    <input class="form-check-input mt-0" checked type="radio" value="No"
                                        name="customerdelivery">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="customerdelivery">All</label>
                                    <input class="form-check-input mt-0" type="radio" value="All"
                                        name="customerdelivery">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-1">
                        <label class="foncolor" for="addPickupsMobile">Add Pickups Mobile<i
                                class="text-danger">*</i></label>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="addPickupsMobile">Yes</label>
                                    <input class="form-check-input mt-0" type="radio" value="Yes"
                                        name="addPickupsMobile">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="addPickupsMobile">No</label>
                                    <input class="form-check-input mt-0" checked type="radio" value="No"
                                        name="addPickupsMobile">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-1">
                        <label class="foncolor" for="ChangePickupDate">Change Pickup Date (Mobile)</label>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="ChangePickupDate">Yes</label>
                                    <input class="form-check-input mt-0" type="radio" value="Yes"
                                        name="ChangePickupDate">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A" for="ChangePickupDate">No</label>
                                    <input class="form-check-input mt-0" checked type="radio" value="No"
                                        name="ChangePickupDate">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="status">Status <i class="text-danger">*</i></label>
                        <div class="status-toggle">
                            <span>Active</span>
                            <input id="rating_1" name="status" class="check" type="checkbox" value="Active">
                            <label for="rating_1" class="checktoggle checkbox-bg"></label>
                            <span class="inactive">Inactive</span>
                        </div>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="add-customer-btns text-end">

            <button type="button" onclick="redirectTo('{{ route('admin.drivers.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>

            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>
    </form> --}}

    @section('script')
        <script>
            $('#country_code').val($('.iti').find('.iti__selected-dial-code').text());
            $('.col-sm-12').on('click', () => {
                $('#country_code').val($('.iti').find('.iti__selected-dial-code').text());
            })

        </script>
    @endsection

</x-app-layout>