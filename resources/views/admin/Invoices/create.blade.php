<x-app-layout>

    <x-slot name="header">
        Add Invoice
    </x-slot>

    <x-slot name="cardTitle">
        <p class="subhead me-sm-4">Add Invoice</p>
        <div class="card invoices-tabs-card mb-0 pt-0">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="d-block">
                        <div class="authTabDiv">
                            <div id="click"></div>
                            <button id="servicesBtn" type="button"
                                class="btnBorder th-font col737 bg-light me-3 activity-feed"
                                onclick="toggleLoginForm('services')">Services</button>
                            <button id="suppliesBtn" type="button" class="btnBorder th-font col737 bg-light"
                                onclick="toggleLoginForm('supplies')">Supplies</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="invoiceForm">
        <!-- ------------------------------- Services form ------------------------------------- -->
        <div class="form-group-customer customer-additional-form">
            <div class="row mb-4 g-3">
                <div class="col-md-6">
                    <div class="d-sm-flex align-items-center">
                        <div class="first">
                            <label for="customer_id">Country<i class="text-danger">*</i></label>
                        </div>
                        <div class="middleDiv">
                            <select class="form-control select2" name="sip_country" id="sip_country">
                                <option value="">Select Country</option>
                                    @foreach (setting()->warehouseContries() as $key => $item)
                                    <option value="{{ $item->iso2 ?? 'AF' }}">
                                        {{ $item->name ?? '' }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-sm-flex align-items-center">
                        <div class="first">
                            <label for="customer_id">Country<i class="text-danger">*</i></label>
                        </div>
                        <div class="middleDiv">
                            <select class="form-control select2" >
                                    @foreach (setting()->warehouseContries() as $key => $item)
                                    <option value="{{ $item->iso2 ?? 'AF' }}">
                                        {{ $item->name ?? '' }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="d-sm-flex align-items-center">
                        <div class="first">
                            <label for="customer_id">Customer <i class="text-danger">*</i></label>
                        </div>
                        <div class="middleDiv">
                            <input type="hidden" name="type" value="pickup">
                            <select name="customer_id" class="form-control delevery_customer select2"
                                id="delevery_customer_id">
                                <option value="">Search Customer</option>
                                {{-- @foreach($customers as $customer)
                                                            <option {{ old('customer_id') == $customer->id ? 'selected' : '' }} value="{{
                                    $customer->id }}">{{ $customer->name }}</option>
                                @endforeach --}}
                            </select>
                            @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="last">
                            <a id="addCustomer" class="btn btn-primary buttons">
                                Add New Customer
                            </a>
                            <div id="add_delevery_save_body" class="d-none">
                                <button type="button" class="btn btn-primary buttons" id="add_delevery_save">
                                    Save
                                </button>
                                <button type="button" class="btn btn-outline-secondary" id="add_delevery_cancel">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-sm-flex align-items-center">
                        <div class="first">
                            <label for="customer_id">Ship To <i class="text-danger">*</i></label>
                        </div>
                        <div class="middleDiv">
                            <input type="hidden" value="delivery">
                            <select name="customer_id" class="form-control delevery_customer select2"
                                id="ship_customer">
                                <option value="">Search Customer</option>
                                {{-- @foreach($customers as $customer)
                                                            <option {{ old('customer_id') == $customer->id ? 'selected' : '' }} value="{{
                                    $customer->id }}">{{ $customer->name }}</option>
                                @endforeach --}}
                            </select>
                            @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="last">

                            <a id="addShiptoAddress" class="btn btn-primary buttons">
                                Add Ship to Address
                            </a>

                            <div id="add_ship_save_body" class="d-none">
                                <button type="button" class="btn btn-primary buttons" id="add_ship_save">
                                    Save
                                </button>
                                <button type="button" class="btn btn-outline-secondary" id="add_ship_cancel">
                                    Cancel
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- country wis address search -->
            <div class="row mt-5 g-3 d-none" id="add_location">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="d-sm-flex align-items-center">
                        <div class="first">
                            <label for="customer_id">Country<i class="text-danger">*</i></label>
                        </div>
                        <div class="middleDiv">
                            <select class="form-control select2" id="countryForLocation">
                                    @foreach (setting()->warehouseContries() as $key => $item)
                                    <option value="{{ $item->iso2 ?? 'AF' }}">
                                        {{ $item->name ?? '' }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="last">
                            <div>
                                <button type="button" class="btn btn-primary buttons" data-bs-toggle="modal" data-bs-target="#locationModal" id="locationModalShow">
                                    location
                                </button>
                            </div>
                            <div class="modal fade" id="locationModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Select Location</h5>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" class="form-control" id="locationSearchBox" placeholder="Enter location..." />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary confirm-supply"
                                                data-bs-dismiss="modal" aria-label="Close">Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- first row end pick up  -->
            <div class="row mt-5 g-3">

                <div class="col-md-6">
                    <form action="{{route('admin.saveInvoceCustomer')}}" method="post" id="delivery_customer_inf_form">
                        <div class="borderset position-relative newCustomerAdd {{--disablesectionnew--}}" id="delivery_to_address">
                            <div class="row gx-3 gy-2">

                                @csrf
                                <input type="hidden" name="address_type" value="delivery">

                                <input type="hidden" name="address_id">

                                <div class="col-md-6">
                                    <label class="foncolor" for="first_name">First Name <i
                                            class="text-danger">*</i></label>
                                    <input type="text" name="first_name" class="form-control inp"
                                        placeholder="Enter First Name">

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="last_name">Last Name <i
                                            class="text-danger">*</i></label>
                                    <input type="text" name="last_name" class="form-control inp"
                                        placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.1 <i
                                            class="text-danger">*</i></label>
                                    <!-- Contact No. 1 -->
                                    <div class="flaginputwrap">
                                        <div class="customflagselect">
                                            <select class="flag-select" name="mobile_number_code_id">
                                                @foreach ($coutry as $key => $item)
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                        data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                        {{ $item->name }} +{{ $item->phonecode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" class="form-control flagInput inp"
                                            placeholder="Enter Contact No. 2" name="mobile_number">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.2 </label>
                                    <!-- Contact No. 2 -->
                                    <div class="flaginputwrap">
                                        <div class="customflagselect">
                                            <select class="flag-select" name="alternative_mobile_number_code_id">
                                                @foreach ($coutry as $key => $item)
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                        data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                        {{ $item->name }} +{{ $item->phonecode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" class="form-control flagInput inp"
                                            placeholder="Enter Contact No. 2" name="alternative_mobile_number">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.1">Address 1 <i
                                            class="text-danger">*</i></label>
                                    <!-- Address 1 -->
                                    <input type="text" name="address" class="form-control inp address"
                                        placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.2">Address 2 </label>
                                    <!-- Address 2 — optional, you may remove or merge -->
                                    <input type="text" name="address_2" class="form-control inp"
                                        placeholder="Enter Address 2">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                                    <input type="text" name="country" id="country"class="form-control inp address" placeholder="Country">
                                    {{-- <select name="country_id" id="country"
                                        class="form-control  form-cs js-example-basic-single select2 ">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ?
                                            'selected' : '' }}>
                                                                                {{ $country->name }}
                                                                            </option>
                                        @endforeach
                                    </select> --}}

                                    @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="State">State <i class="text-danger">*</i></label>
                                    <input type="text" name="state" id="state"class="form-control inp address" placeholder="state">
                                    {{-- <select name="state_id" id="state" class="form-control inp select2">
                                        <option value="">Select State</option>
                                        @if (old('state_id'))
                                            <option value="{{ old('state_id') }}" selected>{{ old('state_id') }}</option>
                                        @endif
                                    </select> --}}
                                    @error('state_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                                    <input type="text" name="city" id="city" class="form-control inp address" placeholder="city">
                                    {{-- <select name="city_id" id="city" class="form-control inp select2">
                                        <option value="">Select City</option>
                                        @if (old('city_id'))
                                            <option value="{{ old('city_id') }}" selected>{{ old('city_id') }}</option>
                                        @endif
                                    </select> --}}
                                    @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                                    <!-- Zip Code -->
                                    <input type="text" name="zip_code" class="form-control inp" placeholder="Enter Zip">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <form action="{{route('admin.saveInvoceCustomer')}}" method="post" id="pick_up_customer_inf_form">
                        <div class="borderset position-relative newShipmentAddress {{--disablesectionnew--}}"
                            id="ship_to_address">
                            <div class="row gx-3 gy-2">

                                @csrf
                                <input type="hidden" name="address_type" value="pickup">
                                <input type="hidden" name="address_id">
                                <input type="hidden" name="invoice_custmore_type" value="ship_to">
                                <input type="hidden" name="invoice_custmore_id" id="invoice_custmore_id">

                                <div class="col-md-6">
                                    <label class="foncolor" for="first_name">First Name <i
                                            class="text-danger">*</i></label>
                                    <input type="text" name="first_name" class="form-control inp"
                                        placeholder="Enter First Name">

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="last_name">Last Name <i
                                            class="text-danger">*</i></label>
                                    <input type="text" name="last_name" class="form-control inp"
                                        placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.1 <i
                                            class="text-danger">*</i></label>
                                    <!-- Contact No. 1 -->
                                    <div class="flaginputwrap">
                                        <div class="customflagselect">
                                            <select class="flag-select" name="mobile_number_code_id">
                                                @foreach ($coutry as $key => $item)
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                        data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                        {{ $item->name }} +{{ $item->phonecode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" class="form-control flagInput inp"
                                            placeholder="Enter Contact No. 2" name="mobile_number">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.2 </label>
                                    <!-- Contact No. 2 -->
                                    <div class="flaginputwrap">
                                        <div class="customflagselect">
                                            <select class="flag-select" name="alternative_mobile_number_code_id">
                                                @foreach ($coutry as $key => $item)
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                        data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                                        {{ $item->name }} +{{ $item->phonecode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" class="form-control flagInput inp"
                                            placeholder="Enter Contact No. 2" name="alternative_mobile_number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.1">Address 1 <i
                                            class="text-danger">*</i></label>
                                    <!-- Address 1 -->
                                    <input type="text" name="address" class="form-control inp address"
                                        placeholder="Enter Address 1" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.2 address">Address 2 </label>
                                    <!-- Address 2 — optional, you may remove or merge -->
                                    <input type="text" name="address_2" class="form-control inp"
                                        placeholder="Enter Address 2">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                                    <input type="text" name="country" id="country"class="form-control inp address" placeholder="Country" readonly>
                                    {{-- <select name="country_id" id="country"
                                        class="form-control  form-cs js-example-basic-single select2 ">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ?
                                            'selected' : '' }}>
                                                                                {{ $country->name }}
                                                                            </option>
                                        @endforeach
                                    </select> --}}

                                    @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="State">State <i class="text-danger">*</i></label>
                                    <input type="text" name="state" id="state"class="form-control inp address" placeholder="state" readonly>
                                    {{-- <select name="state_id" id="state" class="form-control inp select2">
                                        <option value="">Select State</option>
                                        @if (old('state_id'))
                                        <option value="{{ old('state_id') }}" selected>{{ old('state_id') }}</option>
                                        @endif
                                    </select> --}}
                                    @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                                    <input type="text" name="city" id="city" class="form-control inp address" placeholder="city" readonly>
                                    {{-- <select name="city_id" id="city" class="form-control inp select2">
                                        <option value="">Select City</option>
                                        @if (old('city_id'))
                                            <option value="{{ old('city_id') }}" selected>{{ old('city_id') }}</option>
                                        @endif
                                    </select> --}}
                                    @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                                    <!-- Zip Code -->
                                    <input type="text" name="zip_code" class="form-control inp" placeholder="Enter Zip" readonly>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.invoices.store') }}" id="services" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group-customer customer-additional-form">
                <!-- both form ended Ship to Address -->
                <!-- inventory suplay and service add start -->
                <div>
                    <div class="row mt-4 pt-3 g-3" id="ship_to_address">
                        <div class="col-md-12 d-none" id="service_type">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="input-block">
                                        <label class="foncolor m-0 p-0">Type <i class="text-danger">*</i></label>
                                    </div>
                                    <div class="d-fex justify-content-between flex-wrap row mt-2">
                                        <div class="input-block mb-3 col-lg-2 col-md-2">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A">Ocean Cargo</label>
                                            <input class="form-check-input mt-0" type="radio" value="Ocean Cargo" name="transport_type">
                                        </div>
                                        <div class="input-block mb-3 col-lg-2 col-md-2">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A">Air Cargo</label>
                                            <input class="form-check-input mt-0" type="radio" value="Air Cargo" name="transport_type">
                                        </div>
                                        <div class="col-8"></div>
                                    </div>
                                    @error('transport_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label> Date <i class="text-danger">*</i></label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text" class="btn-filters datetimepickerDefault form-control form-cs inp "
                                    name="currentdate" placeholder="mm-dd-yyyy" value="{{ carbon()->now()->addDays(15)->format('Y/m/d') }}" />
                                <input type="text" class="form-control inp inputs text-center timeOnlyInput smallinput"
                                    readonly value="08:30 AM" name="currentTime">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Invoice# <i class="text-danger">*</i></label>
                            <div class="input-container invoiceNoInput position-relative">
                                <input type="text" name="nextInvoiceNo" value="{{$nextInvoiceNo}}"
                                    style="display: none">
                                <button type="button" id="auto_invoice_gen" class="btn-primary square sm">Auto</button>
                                <input type="text" name="invoice_no" class="form-control form-cs inp"
                                    placeholder="INV 00021">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Driver<i class="text-danger">*</i></label>
                            <select name="driver_id" class="form-control select2">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option {{ old('driver_id') == $driver->id ? 'selected' : '' }} value="{{ $driver->id
                                        }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            @error('driver_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label>Total</label>
                            <div class="input-container" style="position: relative;">
                                <span class="dollarSign">$</span>
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00"
                                    style="padding-left: 35px; padding-top: 8px !important;" id="grand_total"
                                    name="grand_total">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Due Date <i class="text-danger">*</i></label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text" class="btn-filters daterangeInput form-cs inp readonly" readonly
                                    name="duedaterange" placeholder="From Date - To Date" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Payment</label>
                            <div class="input-container" style="position: relative;">
                                <span class="dollarSign">$</span>
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00"
                                    style="padding-left: 35px; padding-top: 8px !important;">
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <label>User</label>
                            <input type="text" class="form-control inp readonly" readonly placeholder="John Duo"
                                value="{{auth()->user()->name ?? ''}} {{auth()->user()->last_name ?? ''}}">
                        </div>

                        <div class="col-md-3">
                            <label>Container</label>
                            <select name="container_id" class="form-control select2">
                                <option value="">Select Container</option>
                                @foreach($containers as $container)
                                                            <option {{ old('container_id') == $container->id ? 'selected' : '' }} value="{{
                                    $container->id }}">{{ $container->unique_id }}{{ $container->ship_to_country ?  ', '.$container->ship_to_country:''}}</option>
                                @endforeach
                            </select>
                            @error('container_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 ">
                            <label>Status<i class="text-danger">*</i></label>
                            <input type="text" class="form-control inp readonly" readonly placeholder="Pending"
                                name="status" value="pending">
                        </div>

                        <div class="col-md-3">
                            <label>Balance</label>
                            <div class="input-container" style="position: relative;">
                                <span class="dollarSign">$</span>
                                <input type="text" name="balance" class="form-control form-cs inp readonly" readonly
                                    placeholder="0.00" style="padding-left: 35px; padding-top: 8px !important;">
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <label>Total Items</label>
                            <input type="text" class="form-control inp readonly" readonly placeholder="0">
                        </div>

                        <div class="col-md-3 ">

                            <label> Warehouse</label>
                            <select name="warehouse_id" class="js-example-basic-single select2"
                                style="font-weight:400px !important">
                                <option value="">Select Warehouse </option>
                                @foreach($warehouses as $warehouse)
                                                            <option {{ old('warehouse_id',auth()->user()->role_id !=1 ? auth()->user()->warehouse_id :'' ) == $warehouse->id ? 'selected' : '' }} value="{{
                                    $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>

                            @error('warehouse_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="col-md-6 d-none" id="description_services_items">
                            <label>description<i class="text-danger">*</i></label>
                            <textarea name="descrition" class="form-control form-cs inp"></textarea>
                        </div>
                        <div class="col-md-6 d-none" id="weight_services_items">
                            <label>weight<i class="text-danger">*</i></label>
                            <input type="text" name="weight" class="form-control form-cs inp" value="">
                        </div> --}}
                    </div>
                </div>

                <!-- total  -->
                <div class="card-body curve_tabel p-0 mt-5">
                    <div class="table-responsive p-1 " id="supplies_items">
                        <table class="table table-bordered " id="dynamicTable">
                            <thead>
                                <tr>
                                    <th style="width:57px;">Item</th>
                                    <th class="thwidth">Qty</th>
                                    <th class="thwidth">Description</th>
                                    <th class="thwidth">Volume</th>
                                    <th class="thwidth">Price</th>
                                    <th class="thwidth">Value</th>
                                    <th class="thwidth">Ins</th>
                                    <th class="thwidth">Discount</th>
                                    <th class="thwidth">Tax%</th>
                                    <th class="thwidth">Total</th>
                                    <th style="width:100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="mwidth open-supply-modal">
                                        <div class="d-flex align-items-center">
                                            <input type="text" name="supply_name"
                                                class="selected-supply-name form-control tdbor inputcolor">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#supplyModal"
                                                class="btn iconbtn p-0">
                                                <i class="ti ti-chevron-down"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="supply_id">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="qty"></td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="label_qty">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="volume" value="{{ $item['volume'] ?? '0' }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center priceInput"><input type="text"
                                                class="form-control inputcolor" placeholder="" name="price"><button
                                                type="button" class="btn btn-secondary p-0 flat-btn"><i
                                                    class="ti ti-circle-plus col737"></i></button></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="value">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="ins"></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="discount"></td>
                                    <td><input type="text" class="form-control tdbor inputcolor " placeholder=""
                                            name="tax"></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="total"></td>
                                    <td>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-danger iconBtn dltBtn"><i
                                                    class="ti ti-minus"></i></button>
                                            <button type="button" class="btn btn-primary iconBtn addBtn"><i
                                                    class="ti ti-plus"></i></button>
                                            <button type="button" class="btn btn-secondary iconBtn editBtn"><i
                                                    class="ti ti-edit"></i></button>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="blueRibbon">
                <div class="d-sm-flex align-items-end belowflex">
                    <div><label>Subtotal</label>
                        <input type="text" class="form-control bigInput" placeholder="0" name="total_amount">
                    </div>
                    <div><label>Value</label>
                        <input type="text" class="form-control smInput" placeholder="0" name="total_price">
                    </div>
                    <div><label>Tax</label>
                        <input type="text" class="form-control smInput" placeholder="0" name="tax">
                    </div>
                    <div><label>Discount</label>
                        <input type="text" class="form-control smInput" placeholder="0" name="discount">
                    </div>
                    <div><label>Ins</label>
                        <input type="text" class="form-control smInput" placeholder="0" name="ins"
                            value="{{$invoice->ins ?? 0}}">
                    </div>
                    <div><label>Payment</label>
                        <input type="text" class="form-control" placeholder="0" name="payment"
                            value="{{$invoice->payment ?? 0}}">
                    </div>
                    <div><label>Service Fee</label>
                        <input type="text" class="form-control" placeholder="0" name="service_fee">
                    </div>
                    <div><label>Balance</label>
                        <input type="text" class="form-control" placeholder="0" name="balance">
                    </div>
                    <div> <button type="submit" class="btn btn-success invocebuttoncolor ">Submit</button></div>
                </div>
            </div>

            <input type="hidden" name="invoce_item">
            <input type="hidden" name="invoce_type" value="services">
            <input type="hidden" name="total_qty">
            <input type="hidden" name="total_amount">
            <input type="hidden" name="pickup_address_id">
            <input type="hidden" name="delivery_address_id">
            <input type="hidden" name="parcel_id">

            <div class="modal custom-modal fade" id="supplyModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Select Supply</h5>
                        </div>
                        <div class="modal-body">
                            <select class="form-control select2" id="supplySelector">
                                @if($inventories && $inventories->get('Supply'))
                                    @foreach ($inventories->get('Supply') as $supply)
                                        <option value="{{ $supply->id }}" data-selected='{{ $supply->name }}' data-supply='@json($supply)'>{{ $supply->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label>Volume Total</label>
                                    <div id="volume_total_display" class="form-control-plaintext"></div>
                                </div>
                                <div class="col-md-4">
                                    <label>Price</label>
                                    <div id="price_display" class="form-control-plaintext"></div>
                                </div>
                                <div class="col-md-4 d-none">
                                    <label>Volume Price</label>
                                    <div id="volume_price_display" class="form-control-plaintext"></div>
                                </div>
                                <div class="col-md-4">
                                    <label>Height</label>
                                    <div id="height_display" class="form-control-plaintext"></div>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label>Width</label>
                                    <div id="width_display" class="form-control-plaintext"></div>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label>Weight</label>
                                    <div id="weight_display" class="form-control-plaintext"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary confirm-supply"
                                data-bs-dismiss="modal">Confirm</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <!-- ---------------------------- Supplies form ------------------------- -->
    </div>
    @section('script')
        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script src="{{asset('js/invoice.js')}}"></script>
        <script>
            var supplyItems = @json($inventories->get('Supply'));
            var currentRow = null;

            window.onload = function () {
                // const urlParams = new URLSearchParams(window.location.search);
                // const formType = urlParams.get('id') || 'services';
                // toggleLoginForm(formType);
                setTimeout(() => {
                    console.log("invoce_typ", invoce_type);
                    toggleLoginForm(invoce_type);
                    if ($('input[name="transport_type"]').val() != "Air Cargo") {
                        $('select[name="container_id"]')
                            .prop("disabled", true) // this is essential
                            .css("pointer-events", "auto") // optional: restores interaction if previously styled with pointer-events
                            .css("opacity", "1"); // optional: restores visual state
                    } else {
                        $('select[name="container_id"]').prop("disabled", false);
                    }
                }, 600);
            };

            document.getElementById("addCustomer").onclick = () => {
                // it's deliver address code
                document.querySelector(".newCustomerAdd").classList.toggle("none");
            };
        </script>
    @endsection

</x-app-layout>