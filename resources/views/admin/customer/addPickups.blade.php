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
            <div class="col-md-auto pickup-font-2 text-dark-shade mx-4">Customer Balance: <span class="danger-shade pickup-font-1">
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
            <button type="button" class="btn btn-color fw-medium">Back</button>
        </div>
    </div>

    <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row border rounded-top px-1 py-1">
            <div class="row px-3 py-2">

                <div class="col float-start text-dark py-1 px-1">Pickup Address Details</div>

                <div class="col-md-auto p-0 mx-1">
                    <select class="form-select form-select-sm select-size-2" aria-label="Small select example">
                        <option selected value="1">Pickup</option>
                        <option value="2">No Shipto</option>
                    </select>
                </div>
                <div class="col-md-auto p-0 mx-1">
                    <!-- <button type="button" class="btn btn-primary pickup-button-size"> -->
                    <button type="button" class="btn btn-primary pickup-button-size" data-bs-toggle="modal" data-bs-target="#pickupModal">
                        Add Pickup Address
                    </button>
                </div>
                <div class="col-md-auto p-0 mx-1">
                    <select class="form-select form-select-sm text-truncate select-size-1" aria-label="Small select example">
                        <option selected value="1">Mahamed Bakayoko - 200 W 146th St...
                        </option>
                    </select>
                </div>
            </div>
            <hr class="my-1">
            <div class="row px-3">
                <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                    <div class="row align-items-center">
                        <div class="col-4 px-0 text-end">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">ID</label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter ID" value="PUA-001854">
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 px-0 text-end">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">First
                                Name<i class="text-danger">*</i>
                            </label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter ID" value="Mahamed" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 px-0 text-end">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">Last
                                Name<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Last Name" value="Bakayoko" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="address2" class="col-form-label font-size-label text-dark">Longitude<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" value="0" placeholder="Enter ID" value="0" required readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                    <div class="row align-items-center">
                        <div class="col-4 text-end px-0">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label danger-shade">Address1<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm text-truncate border-danger-shade" value="200 W 146th St" placeholder="Enter Address 1" value="200 W 146th St" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">Address2</label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm text-truncate" placeholder="Enter Address 2">
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">Apartment</label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm text-truncate" value="" placeholder="Enter Apartment">
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                    <div class="row align-items-center">
                        <div class="col-4 text-end px-0">
                            <label for="address2" class="col-form-label font-size-label text-dark">City<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" value="New York" placeholder="Enter ID" value="200 W 146th St" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="address2" class="col-form-label font-size-label text-dark">State<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" value="NY" placeholder="Enter State" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="address2" class="col-form-label font-size-label text-dark">Zipcode<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" value="10039" placeholder="Enter ID" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                    <div class="row align-items-center">
                        <div class="col-4 text-end px-0">
                            <label for="alternate_mobile_no" class="col-form-label font-size-label text-dark">Cell
                                Phone<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <div class="flaginputwrap">
                                <div class="customflagselect">
                                    <select class="flag-select" name="mobile_number_code_id">
                                        @foreach ($coutry as $key => $item)
                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                            {{ $item->name }} +{{ $item->phonecode }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No" name="mobile_number" value="{{ old('mobile_number') }}" oninput="this.value = this.value.slice(0, 10)">
                            </div>
                            @error('alternate_mobile_no')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row align-items-center my-4">
                        <div class="col-4 text-end px-0">
                            <label for="mobile_code" class="col-form-label font-size-label text-dark">TelePhone</label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <div class="flaginputwrap">
                                <div class="customflagselect">
                                    <select class="flag-select" name="alternative_mobile_number_code_id">
                                        @foreach ($coutry as $key => $item)
                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                            {{ $item->name }} +{{ $item->phonecode }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No. 2" name="alternative_mobile_number" value="{{ old('alternative_mobile_number') }}" oninput="this.value = this.value.slice(0, 10)">
                            </div>
                            @error('alternate_mobile_no')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row align-items-center my-4">
                        <div class="col-4 px-0 text-end">
                            <label for="address2" class="col-form-label font-size-label text-dark">Latitude<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-8 justify-content-end">
                            <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" placeholder="Enter ID" value="0" required readonly>
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
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Item1<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Item 1" value="" required>
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-4">
                                <label for="masterPickUpAddressId" class="col-form-label float-left float-end text-dark-shade">Item2</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Item 2" value="">
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Pickup Delivery</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" checked id="inlineRadio1" value="option_P">
                                    <label class="form-check-label" for="inlineRadio1">P</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option_D">
                                    <label class="form-check-label" for="inlineRadio2">D</label>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="status" class="col-form-labelfont-size-label text-dark-shade">Status<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-8">
                                <select id="status" class="form-select select2 form-select-sm" required>
                                    <option value="">Not Done</option>
                                    <option value="done">Done</option>
                                    <option value="cancel">Cancel</option>
                                    <option value="reschedule">Reschedule</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Date<i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="date" id="masterPickUpAddressId" class="form-control form-control-sm" value="" placeholder="Enter Date" required>
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Time</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="time" id="masterPickUpAddressId" class="form-control form-control-sm" value="" placeholder="Enter Date">
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Done
                                    Date</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="date" id="masterPickUpAddressId" class="form-control form-control-sm" value="" placeholder="Enter Date">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center">
                            <div class="col-4 px-0 text-end">
                                <label for="address2" class="col-form-label font-size-label text-dark-shade">Zone<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <!-- <input type="text" name="cityName" id="address2"
                                class="form-control form-control-sm text-truncate" value="10039"
                                placeholder="Enter ID" required> -->
                                <select class="form-select form-select-sm" required aria-label="Small select example">
                                    <option selected value="100">100</option>
                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="driver" class="col-form-label font-size-label text-dark-shade">Driver</label>
                            </div>
                            <div class="col-8">
                                <select id="driver" class="form-select select2 form-select-sm">
                                    <option value="">Select Driver</option>
                                    <option value="us">US</option>
                                    <option value="india">India</option>
                                    <option value="france">France</option>
                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Note</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" value="" placeholder="Enter Notes">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center">
                            <div class="col-4 px-0 text-end">
                                <label for="address2" class="col-form-label font-size-label text-dark-shade">Box</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" placeholder="Enter Box" value="">
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Barrel</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" value="" placeholder="Enter Barrel">
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Tapes</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" value="" placeholder="Enter Tapes">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-1">
            <!-- ------------------------------------------------------------------ -->
            <div class="row">
                <div class="row px-3 py-2">

                    <div class="col float-start text-dark py-1 px-1">Shipto Address Details</div>

                    <div class="col-md-auto p-0 mx-1">
                        <button type="button" class="btn btn-primary pickup-button-size" data-bs-toggle="modal" data-bs-target="#shiptoAddressModal">
                            Add Shipto Address
                        </button>
                    </div>
                    <div class="col-md-auto p-0 mx-1">
                        <select class="form-select form-select-sm text-truncate select-size-1" aria-label="Small select example">
                            <option selected value="1">Aly Dramane - Abidjan
                            </option>
                        </select>
                    </div>
                </div>
                <hr class="my-1">
                <div class="row px-3 py-1">
                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <!-- Country Dropdown -->
                        <div class="row align-items-center">
                            <div class="col-4 px-0 text-end">
                                <label for="country" class="col-form-label font-size-label text-dark-shade">Country<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-8">
                                <select id="country" name="country" class="form-select select2 form-select-sm" required>
                                    <option value="" selected>Select Country</option>
                                    <option value="us">US</option>
                                    <option value="india">India</option>
                                    <option value="france">France</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">First
                                    Name<i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter First Name" value="Aly" required>
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Last
                                    Name<i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Last Name" value="Dramane" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Address1<i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Last Name" value="Abidjan" required>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark-shade">Address2
                                </label>
                            </div>
                            <div class="col-8 justify-content-end my-3">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Address 2" value="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="address2" class="col-form-label font-size-label text-dark">Cell Phone<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <div class="flaginputwrap">
                                    <div class="customflagselect">
                                        <select class="flag-select" name="alternate_mobile_no">
                                            @foreach ($coutry as $key => $item)
                                            <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                {{ $item->name }} +{{ $item->phonecode }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="number" class="form-control form-control-sm flagInput inp" placeholder="Enter Mobile No" name="mobile_number" value="{{ old('mobile_number') }}" oninput="this.value = this.value.slice(0, 10)">
                                </div>
                                @error('alternate_mobile_no')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row align-items-center my-2">
                            <div class="col-4 px-0 text-end">
                                <label for="address2" class="col-form-label font-size-label text-dark">Telephone<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <div class="flaginputwrap">
                                    <div class="customflagselect">
                                        <select class="flag-select" name="alternate_mobile_no">
                                            @foreach ($coutry as $key => $item)
                                            <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                {{ $item->name }} +{{ $item->phonecode }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="number" class="form-control form-control-sm flagInput inp" placeholder="Enter Mobile No" name="mobile_number" value="{{ old('mobile_number') }}" oninput="this.value = this.value.slice(0, 10)">
                                </div>
                                @error('alternate_mobile_no')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 my-3">
                        <div id="location-block" class="row align-items-center my-2" style="display: none;">
                            <div class="col-4 px-0 text-end">
                                <label for="location" class="col-form-label font-size-label text-dark-shade">Location<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-8">
                                <select id="location" class="form-select form-select-sm" required>
                                    <option value="1">Select Location </option>

                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">Latitude</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Latitude" value="">
                            </div>
                        </div>

                        <div class="row align-items-center my-3">
                            <div class="col-4 px-0 text-end">
                                <label for="masterPickUpAddressId" class="col-form-label font-size-label text-dark">Longitude</label>
                            </div>
                            <div class="col-8 justify-content-end">
                                <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Longitude" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="float-end mt-3">
        <button type="button" onclick="redirectTo('{{route('admin.customer.index') }}')" class="btn btn-outline-dark">Cancel</button>
        <button type="submit" class="btn btn-dark">Save</button>
    </div>
    <!-- ================================================================ -->

    <!-- <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
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
    </form> -->

    <div class="modal fade" id="pickupModal" aria-labelledby="pickupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-size">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-shade " id="pickupModalLabel">Add Pickup Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form enctype="multipart/form-data">

                        <div class="row px-3">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-auto px-0 text-end">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Customer
                                            Pickup ID<i class="text-danger">*</i>
                                        </label>
                                    </div>
                                    <div class="col justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter ID" value="PUA-002241" required readonly>
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Company
                                        </label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Company Name" value="">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">First
                                            Name<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Last Name" value="Djeneba" required>
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Last
                                            Name<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Last Name" value="Stephane" required>
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="mobile_code_2" class="col-form-label text-dark">TelePhone</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <div class="flaginputwrap">
                                            <div class="customflagselect">
                                                <select id="mobile_code_2" class="flag-select" name="mobile_code_2">
                                                    @foreach ($coutry as $key => $item)
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                        {{ $item->name }} +{{ $item->phonecode }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control form-control-sm flagInput inp" placeholder="Enter Telephone Number" name="mobile_number" value="{{ old('mobile_number') }}" oninput="this.value = this.value.slice(0, 10)">
                                        </div>
                                        @error('alternate_mobile_no')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="alternate_mobile_no_2" class="col-form-label text-dark">Cell
                                            Phone<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9">
                                        <div class="flaginputwrap">
                                            <div class="customflagselect">
                                                <select class="flag-select" id="alternate_mobile_no_2" name="alternate_mobile_no_2">
                                                    @foreach ($coutry as $key => $item)
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                        {{ $item->name }} +{{ $item->phonecode }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control form-control-sm flagInput inp" placeholder="201-747-3177" name="mobile_number" value="{{ old('mobile_number') }}" oninput="this.value = this.value.slice(0, 10)">
                                        </div>
                                        @error('alternate_mobile_no')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Address1<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm text-truncate" value="200 W 146th St" placeholder="Enter Address 1" value="200 W 146th St" required>
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Address2</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm text-truncate" placeholder="Enter Address 2">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Apartment</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm text-truncate" value="" placeholder="Enter Apartment">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-6 my-3">

                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="address2" class="col-form-label text-dark">Latitude<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" value="0" placeholder="Enter latitude" value="0" required readonly>
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="address2" class="col-form-label text-dark">Longitude<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" value="0" placeholder="Enter longitude" value="0" required readonly>
                                    </div>
                                </div>

                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="country_name" class="col-form-label text-dark">Country<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="country_name" id="address2" class="form-control form-control-sm text-truncate" value="" placeholder="Enter Country" value="0" required>
                                    </div>
                                </div>

                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="city_name" class="col-form-label text-dark">City<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="country_name" id="address2" class="form-control form-control-sm text-truncate" value="" placeholder="Enter City" value="0" required>
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="country_name" class="col-form-label text-dark">State<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="state_name" id="address2" class="form-control form-control-sm text-truncate" value="" placeholder="Enter State" value="0" required>
                                    </div>
                                </div>

                                <div class="row align-items-center margin-top-top">
                                    <div class="col-4 text-end px-0">
                                        <label for="country_name" class="col-form-label text-dark">Zipcode<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-8 justify-content-end">
                                        <input type="text" name="zipcode" id="address2" class="form-control form-control-sm text-truncate" value="" placeholder="Enter ZipCode" value="0" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                    <div class="float-end mt-3">
                        <button type="button" onclick="redirectTo('{{route('admin.customer.index') }}')" class="btn btn-outline-dark btn-sm">Cancel</button>
                        <button type="submit" class="btn btn-dark btn-sm">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- ------------------- 2nd modal ---------------------------- -->

    <div class="modal fade" id="shiptoAddressModal" aria-labelledby="shiptoAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-size modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-shade" id="shiptoAddressModalLabel">Add ShipTo Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form enctype="multipart/form-data">

                        <div class="row px-3">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="row align-items-center margin-top-top">
                                    <div class="col-3 px-0 text-end">
                                        <label for="country_2" class="col-form-label text-dark-shade">Country</label>
                                    </div>
                                    <div class="col pe-0">
                                        <select id="country_2" name="country_2" class="form-select select2 form-select-sm">
                                            <option value="">Select Country</option>
                                            <option value="Cote_d'lvoire">Cote d'lvoire</option>
                                            <option value="spain" selected>Spain</option>
                                            <option value="india">India</option>
                                            <option value="kuwait">Kuwait</option>
                                        </select>
                                    </div>
                                    <div class="col-2 px-0" id="location_button" style="display: none;">
                                        <button class="btn btn-dark btn-sm" id="openLocationModal">Location</button>

                                    </div>
                                </div>

                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Company
                                        </label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Company Name" value="">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">First
                                            Name<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Last Name" value="Djeneba" required>
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Last
                                            Name<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm" placeholder="Enter Last Name" value="Stephane" required>
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
                                                <select class="flag-select" id="alternate_mobile_no" name="alternate_mobile_no">
                                                    @foreach ($coutry as $key => $item)
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                        {{ $item->name }} +{{ $item->phonecode }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control form-control-sm flagInput inp" placeholder="201-747-3177" name="mobile_number" value="{{ old('mobile_number') }}" oninput="this.value = this.value.slice(0, 10)">
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
                                                <select id="mobile_code" class="flag-select" name="mobile_code">
                                                    @foreach ($coutry as $key => $item)
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                        {{ $item->name }} +{{ $item->phonecode }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" class="form-control form-control-sm flagInput inp" placeholder="Enter Telephone Number" name="mobile_number" value="{{ old('mobile_number') }}" oninput="this.value = this.value.slice(0, 10)">
                                        </div>
                                        @error('alternate_mobile_no')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Address<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm text-truncate" value="" placeholder="Enter Address 1" value="200 W 146th St" required>
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Address2</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm text-truncate" placeholder="Enter Address 2">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="masterPickUpAddressId" class="col-form-label text-dark">Apartment</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" id="masterPickUpAddressId" class="form-control form-control-sm text-truncate" value="" placeholder="Enter Apartment">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-6">

                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="address2" class="col-form-label text-dark">Latitude</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" value="0" placeholder="Enter latitude" value="0">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="address2" class="col-form-label text-dark">Longitude</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" name="cityName" id="address2" class="form-control form-control-sm text-truncate" value="0" placeholder="Enter longitude" value="0">
                                    </div>
                                </div>

                                <div class="row align-items-center margin-top-top">
                                    <div class="col px-0 text-end">
                                        <label for="language" class="col-form-label font-size-label text-dark-shade">Language</label>
                                    </div>
                                    <div class="col-9">
                                        <select id="language" name="language" class="form-select select2 form-select-sm">
                                            <option value="" selected>Select Language</option>
                                            <option value="spain">Spain-Castilian</option>
                                            <option value="india">India-English</option>
                                            <option value="kuwait">Kuwait-Arabic</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="email" class="col-form-label text-dark">Email Id</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" name="email" id="email" class="form-control form-control-sm text-truncate" value="" placeholder="Enter Email Id" value="0">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="License_Id" class="col-form-label text-dark">License Id</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <input type="text" name="License_Id" id="License_Id" class="form-control form-control-sm text-truncate" value="" placeholder="Enter License Id" value="0">
                                    </div>
                                </div>
                                <div class="row align-items-center margin-top-top">
                                    <div class="col text-end px-0">
                                        <label for="License_Id" class="col-form-label text-dark">License Picture</label>
                                    </div>
                                    <div class="col-9 justify-content-end">
                                        <img src="\assets\img\receipt-logo.svg" href="" class="license-size-fix" />
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                    <div class="float-end mt-3">
                        <button type="button" onclick="redirectTo('{{route('admin.customer.index') }}')" class="btn btn-outline-dark btn-sm">Cancel</button>
                        <button type="submit" class="btn btn-dark btn-sm">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- --------------------   3rd Modal   ------------------------ -->

    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
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
<script>
    $(document).ready(function() {
        $('#country').select2();

        $('#country').on('change', function() {
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
    const countrySelect = document.getElementById('country_2');
    const locationButton = document.getElementById('location_button');

    function toggleButtonVisibility() {
        if (countrySelect.value) {
            locationButton.style.display = 'block';
        } else {
            locationButton.style.display = 'none';
        }
    }

    // Initial check in case the form is pre-filled
    toggleButtonVisibility();

    // Event listener
    countrySelect.addEventListener('change', toggleButtonVisibility);

</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const openLocationModalBtn = document.getElementById('openLocationModal');
        const locationModalEl = document.getElementById('locationModal');

        const locationModal = new bootstrap.Modal(locationModalEl, {
            backdrop: false, // Prevent closing the first modal
            keyboard: false
        });

        openLocationModalBtn.addEventListener('click', function() {
            locationModal.show();
        });
    });

</script>
