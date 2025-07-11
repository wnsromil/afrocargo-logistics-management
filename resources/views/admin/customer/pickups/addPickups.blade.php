<x-app-layout>
    <style>
        /* Adjust z-index for stacking */
        #locationModal {
            z-index: 1060;
        }

        .modal-backdrop {
            z-index: 1050;
        }
    </style>
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

    <div class="container p-0">
        <div class="row">
            <div class="col-md-auto pickup-font-1 text-dark-shade">Add Pickups</div>
            <div class="col-md-auto pickup-font-2 text-dark-shade mx-4">Customer Balance: <span
                    class="danger-shade pickup-font-1">
                    $
                    250</span>
            </div>
            <div class="col-md-auto font-size2 fw-normal danger-shade animation-link">Editing Main Customer Account
            </div>

            <!-- <div class="col">col</div> -->
        </div>
        <div class="d-flex">
            <a href="" class="text-dark px-1 pl-0">Pickup List</a> / <a href="" class="text-link px-1"> Add
                Pickups</a>
        </div>
        <div class="d-flex justify-content-end pickup-margin">
            <a href="{{ url()->previous() }}" class="btn btn-color fw-medium">Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.customer.Pickupstore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row border rounded-top px-1 py-1">
            <div class="row px-3 py-2">

                <div class="col float-start text-dark py-1 px-1">Pickup Address Details</div>

                <div class="col-md-auto p-0 mx-1">
                    <select class="form-select form-select-sm select-size-2" aria-label="Small select example"
                        name="pickup_type" id="pickup_type_select">
                        <option selected value="Pickup">Pickup</option>
                        <option value="No Shipto">No Shipto</option>
                    </select>
                </div>
                <div class="col-md-auto p-0 mx-1">
                    <!-- <button type="button" class="btn btn-primary pickup-button-size"> -->
                    <button type="button" class="btn btn-primary pickup-button-size" data-bs-toggle="modal"
                        data-bs-target="#pickupModal">
                        Add Pickup Address
                    </button>
                </div>
                <div class="col-md-auto p-0 mx-1">
                    <select id="pickupUserSelect" class="form-select form-select-sm text-truncate select-size-1"
                        aria-label="Small select example" name="pickup_address_id">
                        <option disabled>-- Select Pickup User --</option>
                    </select>
                </div>
            </div>
            <hr class="my-1">
            <div class="row px-3">
                <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                    <div class="row align-items-center">
                        <div class="col-4 px-0 text-end">
                            <label for="masterPickUpAddressId"
                                class="col-form-label font-size-label text-dark">ID</label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="unique_id" name="unique_id" class="form-control form-control-sm"
                                placeholder="ID" value="" readonly style="background-color: #d3d3d3;">
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 px-0 text-end">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">First
                                Name
                                <i class="text-danger">*</i>
                            </label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="pickup_name" name="pickup_name" class="form-control form-control-sm"
                                placeholder="Enter First Name" value="">
                            @error('pickup_name')
                                <small class="text-danger">First name is required.</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 px-0 text-end">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">Last
                                Name
                                <i class="text-danger">*</i>
                            </label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="pickup_last_name" name="pickup_last_name"
                                class="form-control form-control-sm" placeholder="Enter Last Name" value="">
                            @error('pickup_last_name')
                                <small class="text-danger">Last name is required.</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="address2" class="col-form-label font-size-label text-dark">Longitude<i
                                    class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="Pickup_longitude" id="longitude"
                                class="form-control form-control-sm text-truncate" placeholder="Longitude" value="0"
                                readonly style="background-color: #f8f9fa;">
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                    <div class="row align-items-center">
                        <div class="col-4 text-end px-0">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">Address
                                1<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="address" class="form-control form-control-sm text-truncate" value=""
                                name="address_1" placeholder="Enter Address 1" value="">
                            @error('address_1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">Address
                                2</label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="pickup_address_2" id="address_2"
                                class="form-control form-control-sm text-truncate" placeholder="Enter Address 2">
                        </div>
                    </div> --}}
                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="masterPickUpAddressId"
                                class="col-form-label font-size-label text-dark">Apartment</label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="pickup_apartment" id="apartment"
                                class="form-control form-control-sm text-truncate" value=""
                                placeholder="Enter Apartment">
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                    <div class="row align-items-center">
                        <div class="col-4 text-end px-0">
                            <label for="address2" class="col-form-label font-size-label text-dark">City<i
                                    class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="city" id="city" class="form-control form-control-sm text-truncate"
                                placeholder="Enter City" value="{{old('city')}}">
                            @error('city')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="address2" class="col-form-label font-size-label text-dark">State<i
                                    class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="state" id="state"
                                class="form-control form-control-sm text-truncate" value="{{old('state')}}"
                                placeholder="Enter State">
                            @error('state')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="address2" class="col-form-label font-size-label text-dark">Zipcode<i
                                    class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="zipcode" id="zipcode"
                                class="form-control form-control-sm text-truncate" value="10039" placeholder="Enter ID">
                            @error('zipcode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                    <div class="row align-items-center my-4">
                        <div class="col-4 px-0 text-end">
                            <label for="address2" class="col-form-label font-size-label text-dark">Cell Phone<i
                                    class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <div class="flaginputwrap">
                                <div class="customflagselect">
                                    <select class="flag-select" name="phone_code_id" id="Pickup_cell_phone_id">
                                        @foreach ($coutry as $key => $item)
                                            <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                {{ $item->name }} +{{ $item->phonecode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="number" class="form-control form-control-sm flagInput inp"
                                    placeholder="Enter Cell Phone" id="Pickup_cell_phone" name="Pickup_cell_phone"
                                    value="{{ old('Pickup_cell_phone') }}"
                                    oninput="this.value = this.value.slice(0, 10)">
                            </div>
                            @error('Pickup_cell_phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 px-0 text-end">
                            <label for="address2" class="col-form-label font-size-label text-dark">TelePhone</label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <div class="flaginputwrap">
                                <div class="customflagselect">
                                    <select class="flag-select" name="phone_2_code_id_id" id="Pickup_telePhone_id">
                                        @foreach ($coutry as $key => $item)
                                            <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                {{ $item->name }} +{{ $item->phonecode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="number" class="form-control form-control-sm flagInput inp"
                                    placeholder="Enter TelePhone" id="Pickup_telePhone" name="Pickup_telePhone"
                                    value="{{ old('mobile_number') }}" oninput="this.value = this.value.slice(0, 10)">
                            </div>
                            @error('alternate_mobile_no')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 px-0 text-end">
                            <label for="address2" class="col-form-label font-size-label text-dark">Latitude<i
                                    class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="Pickup_latitude" id="latitude"
                                class="form-control form-control-sm text-truncate" placeholder="Enter ID" value="0"
                                readonly style="background-color: #f8f9fa;">
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-1">
            <!-- ---------------------------------------------------------- -->
            <div class="row">
                <p class="py-1 font-color-pickup px-2 text-dark-shade">Pickup Details</p>
                <hr class="my-1">

                <div class="row px-3 py-1">
                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Item1<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm"
                                    placeholder="Enter Item 1" value="{{old('item1')}}" name="item1">
                                @error('item1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-4">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label float-left float-end text-dark-shade">Item2</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm"
                                    placeholder="Enter Item 2" value="{{old('item2')}}" name="item2">
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Pickup Delivery</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" checked
                                        id="inlineRadio1" value="P">
                                    <label class="form-check-label" for="inlineRadio1">P</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio2" value="D">
                                    <label class="form-check-label" for="inlineRadio2">D</label>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="status" class="col-form-labelfont-size-label text-dark-shade">Status<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-8">
                                <select id="status" name="pickup_status_type"
                                    class="form-select select2 form-select-sm">
                                    <option value="not_done" {{ old('pickup_status_type') == 'not_done' ? 'selected' : '' }}>Not Done</option>
                                    <option value="done" {{ old('pickup_status_type') == 'done' ? 'selected' : '' }}>Done
                                    </option>
                                    <option value="cancel" {{ old('pickup_status_type') == 'cancel' ? 'selected' : '' }}>
                                        Cancel</option>
                                    <option value="reschedule" {{ old('pickup_status_type') == 'reschedule' ? 'selected' : '' }}>Reschedule</option>
                                </select>
                                @error('pickup_status_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Date<i
                                        class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm"
                                    value="" name="pickup_date" readonly style="background: white;">
                                @error('pickup_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Time</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="time" id="masterPickUpAddressId" class="form-control form-control-sm"
                                    value="" placeholder="Enter Date" name="pickup_time">
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Done
                                    Date</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm"
                                    value="" placeholder="Enter Date" name="done_date" readonly
                                    style="background: white;">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center">
                            <div class="col-4 px-0 text-end">
                                <label for="address2" class="col-form-label font-size-label text-dark-shade">Zone<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <select name="zone" class="form-select form-select-sm" required
                                    aria-label="Small select example">
                                    <option selected value="100">100</option>
                                </select>
                                @error('zone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="driver"
                                    class="col-form-label font-size-label text-dark-shade">Driver</label>
                            </div>
                            <div class="col-8">
                                <select name="Driver_id" class="js-example-basic-single select2"
                                    style="font-weight:400px !important">
                                    <option value="">Select Driver </option>
                                    @foreach($drivers as $driver)
                                                                    <option {{ old('Driver_id') == $driver->id ? 'selected' : '' }} value="{{
                                        $driver->id }}">{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Note</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input name="note" type="text" id="masterPickUpAddressId"
                                    class="form-control form-control-sm" value="" placeholder="Enter Notes">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center">
                            <div class="col-4 px-0 text-end">
                                <label for="address2" class="col-form-label font-size-label text-dark-shade">Box</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="number" name="Box_quantity" id="Box_quantity"
                                    class="form-control form-control-sm text-truncate" placeholder="Enter Box"
                                    value="{{old('Box_quantity')}}">
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Barrel</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="number" id="Barrel_quantity" name="Barrel_quantity"
                                    class="form-control form-control-sm" value="{{old('Barrel_quantity')}}"
                                    placeholder="Enter Barrel">
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Tapes</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="number" id="Tapes_quantity" name="Tapes_quantity"
                                    class="form-control form-control-sm" value="{{old('Tapes_quantity')}}"
                                    placeholder="Enter Tapes">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-1">
            <!-- ------------------------------------------------------------------ -->
            <div class="row" id="Shipto_address_details">
                <div class="row px-3 py-2">

                    <div class="col float-start text-dark py-1 px-1">Shipto Address Details</div>

                    <div class="col-md-auto p-0 mx-1">
                        <button type="button" class="btn btn-primary pickup-button-size" data-bs-toggle="modal"
                            data-bs-target="#shiptoAddressModal">
                            Add Shipto Address
                        </button>
                    </div>
                    <div class="col-md-auto p-0 mx-1">
                        <select id="shiptoUserSelect" name="shipto_address_id"
                            class="form-select form-select-sm text-truncate select-size-1"
                            aria-label="Small select example">
                            <option disabled>-- Select Ship To User --</option>
                        </select>
                    </div>
                </div>
                <hr class="my-1">
                <div class="row px-3 py-1">
                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <!-- Country Dropdown -->
                        <div class="row align-items-center">
                            <div class="col-4 px-0 text-end">
                                <label for="country" class="col-form-label font-size-label text-dark-shade">Country<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-8">
                                <select id="shipto_country" name="shipto_country"
                                    class="js-example-basic-single select2">
                                    <option value="" disabled hidden {{ old('shipto_country') ? '' : 'selected' }}>
                                        Select
                                        Country</option>
                                    @foreach (setting()->warehouseContries() as $country)
                                        <option value="{{ $country['name'] }}" {{ old('shipto_country') == $country['name'] ? 'selected' : '' }}>
                                            {{ $country['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('shipto_country')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">First Name
                                    <i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" name="shipto_name" id="shipto_name"
                                    class="form-control form-control-sm" placeholder="Enter First Name">
                                @error('shipto_name')
                                    <small class="text-danger">First name is required.</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Last
                                    Name<i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" name="shipto_last_name" id="shipto_last_name"
                                    class="form-control form-control-sm" placeholder="Enter Last Name">
                                @error('shipto_last_name')
                                    <small class="text-danger">Last name is required.</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Address 1<i
                                        class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="shipto_address" name="shipto_address_1"
                                    class="form-control form-control-sm" placeholder="Enter Address 1">
                                @error('shipto_address_1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark-shade">Address 2
                                </label>
                            </div>
                            <div class="col-8 justify-content-end my-3">
                                <input type="text" id="shipto_address_2" name="shipto_address_2"
                                    class="form-control form-control-sm" placeholder="Enter Address 2">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="address2" class="col-form-label font-size-label text-dark">Cell Phone<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <div class="flaginputwrap">
                                    <div class="customflagselect">
                                        <select class="flag-select" name="shipto_phone_code_id"
                                            id="shipto_cellphone_id">
                                            @foreach ($coutry as $key => $item)
                                                <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                    data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                    {{ $item->name }} +{{ $item->phonecode }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="number" class="form-control form-control-sm flagInput inp"
                                        placeholder="Enter Cell Phone" name="shipto_cell_phone" id="shipto_cell_phone"
                                        value="{{ old('shipto_cell_phone') }}"
                                        oninput="this.value = this.value.slice(0, 10)">
                                </div>
                                @error('shipto_cell_phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="address2" class="col-form-label font-size-label text-dark">Telephone<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <div class="flaginputwrap">
                                    <div class="customflagselect">
                                        <select class="flag-select" name="shipto_phone_2_code_id_id"
                                            id="shipto_telePhone_id">
                                            @foreach ($coutry as $key => $item)
                                                <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                    data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                    {{ $item->name }} +{{ $item->phonecode }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="number" class="form-control form-control-sm flagInput inp"
                                        placeholder="Enter TelePhone" name="shipto_telePhone" id="shipto_telePhone"
                                        value="{{ old('shipto_telePhone') }}"
                                        oninput="this.value = this.value.slice(0, 10)">
                                </div>
                                @error('shipto_telePhone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        {{-- <div id="location-block" class="row align-items-center my-2" style="display: none;">
                            <div class="col-4 px-0 text-end">
                                <label for="location" class="col-form-label font-size-label text-dark-shade">Location<i
                                        class="text-danger">*</i></label>
                            </div>
                            <div class="col-8">
                                <select id="location" class="form-select form-select-sm">
                                    <option value="1">Select Location </option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark">Latitude</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" class="form-control form-control-sm" name="Shipto_latitude"
                                    placeholder="Enter Latitude" id="shipto_latitude" readonly
                                    style="background-color: #f8f9fa;">
                            </div>
                        </div>

                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId"
                                    class="col-form-label font-size-label text-dark">Longitude</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" class="form-control form-control-sm" name="Shipto_longitude"
                                    placeholder="Enter Longitude" id="shipto_longitude" value="" readonly
                                    style="background-color: #f8f9fa;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="parent_customer_id" class="form-control inp" placeholder="Enter License ID"
            value="{{ $id }}">
        <div class="float-end mt-3">
            <button type="button" onclick="redirectTo('{{route('admin.customer.index') }}')"
                class="btn btn-outline-dark">Cancel</button>
            <button type="submit" class="btn btn-dark">Save</button>
        </div>
    </form>



    <!-- ================================================================ -->

    <div class="modal custom-modal fade" id="pickupModal" aria-labelledby="pickupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-size">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-shade " id="pickupModalLabel">Add Pickup Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="modelpickupForm" method="POST">
                        <div class="row px-3">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Company
                                        </label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" name="company_name"
                                            class="form-control form-control-sm" placeholder="Enter Company Name"
                                            value="">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label class="col-form-label text-dark" for="country">First
                                            Name<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="" name="full_name" class="form-control form-control-sm"
                                            placeholder="Enter First Name" value="">

                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label class="col-form-label text-dark" for="country">Last
                                            Name<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="" name="last_name" class="form-control form-control-sm"
                                            placeholder="Enter Last Name" value="">

                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="mobile_code_2" class="col-form-label text-dark">
                                            Cell Phone<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <div class="flaginputwrap">
                                            <div class="customflagselect">
                                                <select id="mobile_code_2" class="flag-select"
                                                    name="mobile_number_code_id">
                                                    @foreach ($coutry as $key => $item)
                                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                            data-name="{{ $item->name }}"
                                                            data-code="{{ $item->phonecode }}">
                                                            {{ $item->name }} +{{ $item->phonecode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control form-control-sm flagInput inp"
                                                placeholder="Enter Cell Phone" name="mobile_number"
                                                value="{{ old('mobile_number') }}"
                                                oninput="this.value = this.value.slice(0, 10)">
                                        </div>
                                        @error('mobile_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="alternate_mobile_no_2"
                                            class="col-form-label text-dark">TelePhone</label>
                                    </div>
                                    <div class="col-9">
                                        <div class="flaginputwrap">
                                            <div class="customflagselect">
                                                <select class="flag-select" id="alternate_mobile_no_2"
                                                    name="alternative_mobile_number_code_id">
                                                    @foreach ($coutry as $key => $item)
                                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                            data-name="{{ $item->name }}"
                                                            data-code="{{ $item->phonecode }}">
                                                            {{ $item->name }} +{{ $item->phonecode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control form-control-sm flagInput inp"
                                                placeholder="Enter TelePhone" name="alternate_mobile_no"
                                                value="{{ old('alternate_mobile_no') }}"
                                                oninput="this.value = this.value.slice(0, 10)">
                                        </div>
                                        @error('alternate_mobile_no')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Address 1<i
                                                class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="" class="form-control form-control-sm text-truncate"
                                            name="Model_Pickup_address_1" placeholder="Enter Address 1" value="">
                                    </div>
                                </div>
                                {{-- <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Address
                                            2</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId"
                                            class="form-control form-control-sm text-truncate" name="address_2"
                                            placeholder="Enter Address 2">
                                    </div>
                                </div> --}}
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId"
                                            class="col-form-label text-dark">Apartment</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId"
                                            class="form-control form-control-sm text-truncate" value="" name="apartment"
                                            placeholder="Enter Apartment">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 my-3">
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="address2" class="col-form-label text-dark">Latitude<i
                                                class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="latitude" id="latitude"
                                            class="form-control form-control-sm text-truncate" placeholder="" value=""
                                            readonly style="background: #ececec;">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="address2" class="col-form-label text-dark">Longitude<i
                                                class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="longitude" id="longitude"
                                            class="form-control form-control-sm text-truncate" placeholder="" readonly
                                            style="background: #ececec;">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="country_name" class="col-form-label text-dark">Country<i
                                                class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="country" value="{{ old('country') }}"
                                            class="form-control inp" readonly style="background: #ececec;">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="city_name" class="col-form-label text-dark">City<i
                                                class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="city" value="{{ old('city') }}"
                                            class="form-control inp" placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="country_name" class="col-form-label text-dark">State<i
                                                class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="state" value="{{ old('state') }}"
                                            class="form-control inp" placeholder="Enter State">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="country_name" class="col-form-label text-dark">ZipCode</label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="Zip_code" value="{{ old('Zip_code') }}"
                                            class="form-control inp" placeholder="Enter State">
                                    </div>
                                </div>
                                <input type="hidden" name="parent_customer_id" class="form-control inp"
                                    placeholder="Enter License ID" value="{{ $id }}">
                            </div>
                            <div class="text-end mt-3">
                                <button type="button"
                                    onclick="redirectTo('{{ route('admin.customer.viewPickups', $id) }}')"
                                    class="btn btn-outline-dark btn-sm">Cancel</button>
                                <button type="submit" id="modelsubmitBtn" class="btn btn-dark btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ------------------- 2nd modal ---------------------------- -->

    <div class="modal custom-modal fade" id="shiptoAddressModal" aria-labelledby="shiptoAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-size modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-shade" id="shiptoAddressModalLabel">Add ShipTo Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form enctype="multipart/form-data" id="model_shipto_Form" method="POST">

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
                                                <option value="{{ $country['name'] }}" {{ old('country') == $country['name'] ? 'selected' : '' }}>
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
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Company<i
                                                class="text-danger">*</i>
                                        </label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" name="company_name" class="form-control inp"
                                            placeholder="Enter Company Name" value="{{ old('company_name') }}">
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
                                                placeholder="Enter TelePhone" name="alternative_mobile_number"
                                                value="{{ old('alternative_mobile_number') }}"
                                                oninput="this.value = this.value.slice(0, 10)">
                                        </div>
                                        @error('alternate_mobile_no')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Address 1<i
                                                class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" name="Model_ShipTo_address_1"
                                            value="{{ old('Model_ShipTo_address_1') }}" class="form-control inp"
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
                                            class="form-control inp" placeholder="Enter Address 2">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="" class="col-form-label text-dark">Apartment</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" name="apartment" value="{{ old('apartment') }}"
                                            class="form-control inp" placeholder="Enter Apartment">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-6">

                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Latitude<i
                                                class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" name="ship_to_latitude" value="{{ old('ship_to_latitude') }}"
                                            class="form-control inp inputbackground" placeholder="" readonly
                                            style="background: #ececec;">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId"
                                            class="col-form-label text-dark">Longitude</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" name="ship_to_longitude"
                                            value="{{ old('ship_to_longitude') }}"
                                            class="form-control inp inputbackground" placeholder="" readonly
                                            style="background: #ececec;">
                                    </div>
                                </div>

                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label for="language"
                                            class="col-form-label font-size-label text-dark-shade">Language</label>
                                    </div>
                                    <div class="col-9">
                                        <select id="language" name="language" class="js-example-basic-single select2">
                                            <option value="English" {{ old('language') == 'English' ? 'selected' : '' }}>
                                                English
                                            </option>
                                            <option value="French" {{ old('language') == 'French' ? 'selected' : '' }}>
                                                French</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Email Id<i
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
                                    placeholder="Enter License ID" value="{{ $id }}">
                            </div>
                            <!-- #region -->
                            <div class="text-end mt-3">
                                <button type="button"
                                    onclick="redirectTo('{{ route('admin.customer.viewPickups', $id) }}')"
                                    class="btn btn-outline-dark btn-sm">Cancel</button>
                                <button type="submit" id="model_ship_submit_Btn"
                                    class="btn btn-dark btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- --------------------   3rd Modal   ------------------------ -->

    <div class="modal custom-modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-dark-shade" id="locationModalLabel">Location</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="form-select select2" aria-label="Default select example">
                        <option selected>Select Location</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-color" data-bs-dismiss="modal">Continue</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    @section('script')

        <script>
            $(document).ready(function () {
                $("#customBackWarning").on("click", function () {
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
                            ,
                        }
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
        <script>
            $(document).ready(function () {
                $('#country').select2();

                $('#country').on('change', function () {
                    const value = $(this).val();
                    if (value !== '') {
                        $('#location-block').css('display', 'flex');
                    } else {
                        $('#location-block').css('display', 'none');
                    }
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const openLocationModalBtn = document.getElementById('openLocationModal');
                const locationModalEl = document.getElementById('locationModal');

                const locationModal = new bootstrap.Modal(locationModalEl, {
                    backdrop: false, // Prevent closing the first modal
                    keyboard: false
                });

                openLocationModalBtn.addEventListener('click', function () {
                    locationModal.show();
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                const url = window.location.href;
                const id = url.substring(url.lastIndexOf('/') + 1);

                // Ye variable baahar declare karo taaki change event me use ho sake
                let pickupUsers = [];

                $.ajax({
                    url: '/api/pickup-users/' + id,
                    type: 'GET',
                    success: function (response) {
                        if (response.status && Array.isArray(response.data) && response.data.length > 0) {
                            pickupUsers = response.data; // store data globally

                            $('#pickupUserSelect').empty().append('<option disabled>-- Select Pickup User --</option>');

                            response.data.forEach(function (user, index) {
                                $('#pickupUserSelect').append(
                                    `<option value="${user.id}" ${index === 0 ? 'selected' : ''}>${user.name} ${user.last_name}</option>`
                                );
                            });

                            // Initial fill for first user
                            fillPickupUserDetails(response.data[0]);

                            // Change event
                            $('#pickupUserSelect').on('change', function () {
                                const selectedId = $(this).val();
                                const selectedUser = pickupUsers.find(user => user.id == selectedId);
                                if (selectedUser) {
                                    fillPickupUserDetails(selectedUser);
                                }
                            });

                        } else {
                            $('#pickupUserSelect').append('<option disabled>No active pickup users found</option>');
                        }
                    },
                    error: function (xhr) {
                        console.error("Error fetching users:", xhr);
                    }
                });

                // Function to update form fields
                function fillPickupUserDetails(user) {
                    document.getElementById('unique_id').value = user.unique_id || '';
                    document.getElementById('pickup_name').value = user.name || '';
                    document.getElementById('pickup_last_name').value = user.last_name || '';
                    document.getElementById('latitude').value = user.lat || '';
                    document.getElementById('longitude').value = user.long || '';
                    document.getElementById('address').value = user.address || '';
                    // document.getElementById('address_2').value = user.address_2 || '';
                    document.getElementById('apartment').value = user.apartment || '';
                    document.getElementById('state').value = user.state_id || '';
                    document.getElementById('city').value = user.city_id || '';
                    document.getElementById('zipcode').value = user.pincode || '';
                    document.getElementById('Pickup_cell_phone').value = user.mobile_number || '';
                    document.getElementById('Pickup_telePhone').value = user.alternative_mobile_number || '';

                    $('#Pickup_cell_phone_id').val(user.mobile_number_code_id || '').trigger('change');
                    $('#Pickup_telePhone_id').val(user.alternative_mobile_number_code_id || '').trigger('change');
                }


            });

            $(document).ready(function () {
                const url = window.location.href;
                const id = url.substring(url.lastIndexOf('/') + 1);

                // Ye variable baahar declare karo taaki change event me use ho sake
                let pickupUsers = [];

                $.ajax({
                    url: '/api/ship-to-users/' + id,
                    type: 'GET',
                    success: function (response) {
                        if (response.status && Array.isArray(response.data) && response.data.length > 0) {
                            pickupUsers = response.data; // store data globally

                            $('#shiptoUserSelect').empty().append('<option disabled>-- Select Pickup User --</option>');

                            response.data.forEach(function (user, index) {
                                $('#shiptoUserSelect').append(
                                    `<option value="${user.id}" ${index === 0 ? 'selected' : ''}>${user.name}</option>`
                                );
                            });

                            // Initial fill for first user
                            fillShipToUserDetails(response.data[0]);

                            // Change event
                            $('#shiptoUserSelect').on('change', function () {
                                const selectedId = $(this).val();
                                const selectedUser = pickupUsers.find(user => user.id == selectedId);
                                if (selectedUser) {
                                    fillShipToUserDetails(selectedUser);
                                }
                            });

                        } else {
                            $('#shiptoUserSelect').append('<option disabled>No active pickup users found</option>');
                        }
                    },
                    error: function (xhr) {
                        console.error("Error fetching users:", xhr);
                    }
                });

                function fillShipToUserDetails(user) {
                    // document.getElementById('shipto_country').value = user.country_id || '';
                    document.getElementById('shipto_name').value = user.name || '';
                    document.getElementById('shipto_last_name').value = user.last_name || '';
                    document.getElementById('shipto_latitude').value = user.latitude || '';
                    document.getElementById('shipto_longitude').value = user.longitude || '';
                    document.getElementById('shipto_address').value = user.address || '';
                    document.getElementById('shipto_address_2').value = user.address_2 || '';
                    document.getElementById('shipto_cell_phone').value = user.phone || '';
                    document.getElementById('shipto_telePhone').value = user.phone_2 || '';

                    $('#shipto_country').val(user.country_id || '').trigger('change');
                    $('#shipto_cellphone_id').val(user.phone_code_id || '').trigger('change');
                    $('#shipto_telePhone_id').val(user.phone_2_code_id_id || '').trigger('change');
                }

            });
        </script>
        <script>
            $(document).ready(function () {
                $('#modelpickupForm').on('submit', function (e) {
                    e.preventDefault();

                    let formData = new FormData(this);
                    let $submitBtn = $('#modelsubmitBtn');
                    $submitBtn.prop('disabled', true).text('Submitting...');

                    // Purane error messages hatao
                    $('.text-danger').remove();

                    $.ajax({
                        url: "/api/pickup-address", // 🔁 Laravel API route
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            $submitBtn.prop('disabled', false).text('Submit');
                            // ✅ Modal band karo (Bootstrap example)
                            $('#pickupModal').modal('hide');

                            // ✅ Form reset karo
                            // $('#pickupForm')[0].reset();

                            window.location.reload();
                        },
                        error: function (xhr) {
                            $submitBtn.prop('disabled', false).text('Submit');

                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;

                                // Har error ke liye proper input ke paas show karo
                                $.each(errors, function (field, messages) {
                                    let input = $('[name="' + field + '"]');

                                    if (input.length) {
                                        let errorMessage = '<small class="text-danger">' + messages[0] + '</small>';

                                        // Form layout ke hisab se inject karo
                                        let parentCol = input.closest('.col-9');
                                        if (parentCol.length) {
                                            parentCol.append(errorMessage);
                                        } else {
                                            input.after(errorMessage);
                                        }
                                    }
                                });
                            } else {
                                alert('Something went wrong. Please try again.');
                            }
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#model_shipto_Form').on('submit', function (e) {
                    e.preventDefault();

                    let formData = new FormData(this);
                    let $submitBtn = $('#model_ship_submit_Btn');
                    $submitBtn.prop('disabled', true).text('Submitting...');

                    // Purane error messages hatao
                    $('.text-danger').remove();

                    $.ajax({
                        url: "/api/shipto-address", // 🔁 Laravel API route
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            $submitBtn.prop('disabled', false).text('Submit');
                            // ✅ Modal band karo (Bootstrap example)
                            $('#shiptoAddressModal').modal('hide');

                            // ✅ Form reset karo
                            // $('#pickupForm')[0].reset();

                            window.location.reload();
                        },
                        error: function (xhr) {
                            $submitBtn.prop('disabled', false).text('Submit');

                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;

                                // Har error ke liye proper input ke paas show karo
                                $.each(errors, function (field, messages) {
                                    let input = $('[name="' + field + '"]');

                                    if (input.length) {
                                        // Create error message HTML
                                        let errorMessage = '<small class="text-danger">' + messages[0] + '</small>';

                                        // Insert error message
                                        let parentCol = input.closest('.col-9');
                                        if (parentCol.length) {
                                            parentCol.append(errorMessage);
                                        } else {
                                            input.after(errorMessage);
                                        }

                                        // Now add asterisk (*) next to the label
                                        let label = $('label[for="' + input.attr('id') + '"]');
                                        if (label.length && label.find('i.text-danger').length === 0) {
                                            label.append(' <i class="text-danger">*</i>');
                                        }
                                    }
                                });

                            } else {
                                alert('Something went wrong. Please try again.');
                            }
                        }
                    });
                });
            });
        </script>
        <script>
            document.getElementById('pickup_type_select').addEventListener('change', function () {
                const selectedValue = this.value;
                const shiptoDiv = document.getElementById('Shipto_address_details');

                if (selectedValue === 'No Shipto') {
                    shiptoDiv.style.display = 'none';
                } else {
                    shiptoDiv.style.display = 'block';
                }
            });

            // Initial check on page load (optional)
            window.addEventListener('DOMContentLoaded', function () {
                document.getElementById('pickup_type_select').dispatchEvent(new Event('change'));
            });
        </script>
    @endsection

</x-app-layout>