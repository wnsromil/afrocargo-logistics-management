<x-app-layout>
    @section('style')
    <style>
        .content-page-header {
            margin-top: -20px;
            justify-content: flex-start !important;
        }

        .card.invoices-tabs-card.mb-0.pt-0 {
            width: auto;
        }
    </style>
    @endsection

    <x-slot name="header">
        Update Invoice
    </x-slot>

    <x-slot name="cardTitle">
        <p class="subhead me-sm-2">Update Invoice</p>
        <div class="card invoices-tabs-card mb-0 pt-0 me-sm-4">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="d-block">
                        <div class="authTabDiv">
                            <div id="click"></div>
                            <button id="servicesBtn" type="button"
                                class="btnBorder th-font col737 bg-light me-3 activity-feed"
                                @if ($invoice->invoce_type=='services') onclick="toggleLoginForm('services')" @endif>Services</button>
                            <button id="suppliesBtn" type="button" class="btnBorder th-font col737 bg-light"
                            @if ($invoice->invoce_type=='supplies') onclick="toggleLoginForm('supplies')"@endif>Supplies</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center tooltipSections">
            <a class="circleIconBtn" data-bs-placement="bottom" title="Invoice History" data-bs-toggle="modal" data-bs-target="#invoiceHistory"><i class="ti ti-history-toggle"></i></a>
            <a class="circleIconBtn" data-bs-placement="bottom" title="Individual Payment" data-bs-toggle="modal" data-bs-target="#individualPayment"><i class="ti ti-cash"></i></a>
            <a class="circleIconBtn" data-bs-placement="bottom" title="Send Invoice pdf" data-bs-toggle="modal" data-bs-target="#sendinvoicepdf"><i class="ti ti-mail"></i></a>
            <a class="circleIconBtn" data-bs-placement="bottom" title="Claim" data-bs-toggle="modal" data-bs-target="#addnewClaim"><i class="ti ti-report-money"></i></a>
            <a class="circleIconBtn" data-bs-placement="bottom" title="Print" href="{{route('admin.invoices.invoicesdownload',$invoice->id)}}" target="blank"><i class="ti ti-printer"></i></a>
            <a class="circleIconBtn" data-bs-placement="bottom" title="Labels" data-bs-toggle="modal" data-bs-target="#InvoiceLabel"><i class="ti ti-tag-starred"></i></a>
            <a class="circleIconBtn" data-bs-placement="bottom" title="Tracking" data-bs-toggle="modal" data-bs-target="#trackingDetails"><i class="ti ti-route"></i></a>
            <a class="circleIconBtn" data-bs-placement="bottom" title="Notes" data-bs-toggle="modal" data-bs-target="#addnewNote"><i class="ti ti-notebook"></i></a>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="d-sm-flex align-items-center">
                        <div class="first">
                            <label for="customer_id">Customer <i class="text-danger">*</i></label>
                        </div>
                        <div class="middleDiv">
                            <input type="hidden" name="type" value="delivery">
                            <select name="customer_id" class="form-control delevery_customer select2" id="delevery_customer_id">
                                <option value="">Search Customer</option>
                                @foreach($customers as $customer)
                                <option {{ old('customer_id')==$customer->id ? 'selected' : '' }} value="{{
                                    $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
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
                            @if ($invoice->invoce_type=='supplies')
                            <input type="hidden" value="delivery">
                            <select name="customer_id" class="form-control delevery_customer select2" id="ship_customer">
                                <option value="">Search Customer</option>
                                @foreach($customers as $customer)
                                <option {{ old('customer_id')==$customer->id ? 'selected' : '' }} value="{{
                                    $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @else
                            <select class="form-control select2">
                            </select>
                            @endif
                        </div>
                        <div class="last">

                            @if ($invoice->invoce_type=='supplies')
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
                            @else
                                <a class="btn btn-primary buttons">
                                    Add Ship to Address
                                </a>
                            @endif
                        </div>

                    </div>
                </div>

            </div>


            <!-- first row end pick up  -->
            <div class="row mt-5 g-3">

                <div class="col-md-6">
                    <form action="{{route('admin.saveInvoceCustomer')}}" method="post" id="pick_up_customer_inf_form">
                        <div class="borderset position-relative newCustomerAdd disablesectionnew" id="pick_up">
                            <div class="row gx-3 gy-2">

                                @csrf
                                <input type="hidden" name="address_type" value="delivery">

                                <div class="col-md-6">
                                    <label class="foncolor" for="warehouse_name">First Name <i
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
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"> {{ $item->name }} +{{ $item->phonecode }}</option>
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
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"> {{ $item->name }} +{{ $item->phonecode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" class="form-control flagInput inp"
                                            placeholder="Enter Contact No. 2" name="alternative_mobile_number">
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                                    <select name="country_id" id="country"
                                        class="form-control  form-cs js-example-basic-single select2 ">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id')==$country->id ?
                                            'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    
                                        
                                    @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="State">State <i class="text-danger">*</i></label>
                                    <select name="state_id" id="state" class="form-control inp select2">
                                        <option value="">Select State</option>
                                        @if (old('state_id'))
                                        <option value="{{ old('state_id') }}" selected>{{ old('state_id') }}</option>
                                        @endif
                                    </select>
                                    @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                                    <select name="city_id" id="city" class="form-control inp select2">
                                        <option value="">Select City</option>
                                        @if (old('city_id'))
                                        <option value="{{ old('city_id') }}" selected>{{ old('city_id') }}</option>
                                        @endif
                                    </select>
                                    @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                                    <!-- Zip Code -->
                                    <input type="text" name="zip_code" class="form-control inp" placeholder="Enter Zip">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.1">Address 1 <i
                                            class="text-danger">*</i></label>
                                    <!-- Address 1 -->
                                    <input type="text" name="address" class="form-control inp"
                                        placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.2">Address 2 </label>
                                    <!-- Address 2 — optional, you may remove or merge -->
                                    <input type="text" name="address_2" class="form-control inp"
                                        placeholder="Enter Address 2">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <form action="{{route('admin.saveInvoceCustomer')}}" method="post" id="pick_up_customer_inf_form">
                        <div class="borderset position-relative newShipmentAddress disablesectionnew"
                            id="ship_to_address">
                            <div class="row gx-3 gy-2">

                                @csrf
                                <input type="hidden" name="address_type" value="pickup">

                                <div class="col-md-6">
                                    <label class="foncolor" for="warehouse_name">First Name <i
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
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"> {{ $item->name }} +{{ $item->phonecode }}</option>
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
                                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"> {{ $item->name }} +{{ $item->phonecode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" class="form-control flagInput inp"
                                            placeholder="Enter Contact No. 2" name="alternative_mobile_number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="pickup_country">Country <i class="text-danger">*</i></label>
                                    <select name="country_id" id="pickup_country"
                                        class="form-control  form-cs js-example-basic-single select2 ">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id')==$country->id ?
                                            'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6">
                                    <label class="foncolor" for="State">State <i class="text-danger">*</i></label>
                                    <select name="state_id" id="state" class="form-control inp select2">
                                        <option value="">Select State</option>
                                        @if (old('state_id'))
                                        <option value="{{ old('state_id') }}" selected>{{ old('state_id') }}</option>
                                        @endif
                                    </select>
                                    @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div> --}}
                                <div class="col-md-6">
                                    <label class="foncolor" for="pickup_city">City <i class="text-danger">*</i></label>
                                    <select name="city_id" id="pickup_city" class="form-control inp select2">
                                        <option value="">Select City</option>
                                        @if (old('city_id'))
                                        <option value="{{ old('city_id') }}" selected>{{ old('city_id') }}</option>
                                        @endif
                                    </select>
                                    @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                                    <!-- Zip Code -->
                                    <input type="text" name="zip_code" class="form-control inp" placeholder="Enter Zip">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.1">Address 1 <i
                                            class="text-danger">*</i></label>
                                    <!-- Address 1 -->
                                    <input type="text" name="address" class="form-control inp"
                                        placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.2">Address 2 </label>
                                    <!-- Address 2 — optional, you may remove or merge -->
                                    <input type="text" name="address_2" class="form-control inp"
                                        placeholder="Enter Address 2">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.invoices.update',$invoice->id) }}" id="services" method="POST"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group-customer customer-additional-form">
                <!-- both form ended Ship to Address -->
                <!-- inventory suplay and service add start -->
                <div>
                    <div class="row mt-4 pt-3 g-3" id="ship_to_address">
                        <div class="col-md-3">
                            <label> Date <i class="text-danger">*</i></label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">

                                <input type="text" class="btn-filters datetimepicker form-control form-cs inp "
                                    name="currentdate" placeholder="mm-dd-yyyy"
                                    value="{{ Carbon\Carbon::parse($invoice->currentdate)->format('d-m-Y') ?? ''}}" />
                                <input type="text" class="form-control inp inputs text-center timeOnlyInput smallinput"
                                    readonly value="08:30 AM" name="currentTime"
                                    value="{{ $invoice->currentTime ?? ''}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Invoice# <i class="text-danger">*</i></label>
                            <div class="input-container invoiceNoInput position-relative">
                                <input type="text" name="nextInvoiceNo" value="{{$invoice->nextInvoiceNo ?? ''}}"
                                    style="display: none">
                                <button type="button" id="auto_invoice_gen" class="btn-primary square sm">Auto</button>
                                <input type="text" name="invoice_no" class="form-control form-cs inp"
                                    placeholder="INV 00021" value="{{$invoice->invoice_no ?? ''}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Driver<i class="text-danger">*</i></label>
                            <select name="driver_id" class="form-control select2">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                <option {{ old('driver_id',$invoice->driver_id)==$driver->id ? 'selected' : '' }}
                                    value="{{ $driver->id
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
                                    style="padding-left: 35px; padding-top: 8px !important;" id="grand_total" name="grand_total"
                                    value="{{$invoice->grand_total ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Due Date <i class="text-danger">*</i></label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text" class="btn-filters daterangeInput form-cs inp readonly" readonly
                                    name="duedaterange" placeholder="From Date - To Date"
                                    value="{{$invoice->duedaterange ?? ''}}" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Payment</label>
                            <div class="input-container" style="position: relative;">
                                <span class="dollarSign">$</span>
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00"
                                    style="padding-left: 35px; padding-top: 8px !important;" id="payment" value="{{$invoice->payment ?? ''}}">
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <label>User</label>
                            <input type="text" class="form-control inp readonly" readonly placeholder="John Duo"
                                value="{{auth()->user()->name ?? ''}} {{auth()->user()->last_name ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label>Container<i class="text-danger">*</i></label>
                            <select name="container_id" class="form-control select2">
                                <option value="">Select Container</option>
                                @foreach($containers as $container)
                                <option {{ old('container_id',$invoice->container_id)==$container->id ? 'selected' : '' }} value="{{
                                    $container->id }}">{{ $container->vehicle_number }}</option>
                                @endforeach
                            </select>
                            @error('container_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 ">
                            <label>Status<i class="text-danger">*</i></label>
                            <input type="text" class="form-control inp readonly" readonly placeholder="Pending" id="status" name="status" value="{{$invoice->status ?? 'pending'}}">
                        </div>
                        <div class="col-md-3">
                            <label>Balance</label>
                            <div class="input-container" style="position: relative;">
                                <span class="dollarSign">$</span>
                                <input type="text" id="balance" class="form-control form-cs inp readonly" readonly
                                    placeholder="0.00" style="padding-left: 35px; padding-top: 8px !important;" value="{{$invoice->balance ?? ''}}">
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <label>Total Items</label>
                            <input type="text" class="form-control inp readonly" readonly placeholder="0" id="total_qty" value="{{$invoice->total_qty ?? ''}}">
                        </div>
                        <div class="col-md-3 ">

                            <label> Warehouse</label>
                            <select name="warehouse_id" class="js-example-basic-single select2"
                                style="font-weight:400px !important">
                                <option value="">Select Warehouse </option>
                                @foreach($warehouses as $warehouse)
                                <option {{ old('warehouse_id',$invoice->warehouse_id)==$warehouse->id ? 'selected' : '' }} value="{{
                                    $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>

                            @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 @if ($invoice->invoce_type=='supplies') d-none @endif" id="description_services_items">
                            <label>description<i class="text-danger">*</i></label>
                            <textarea name="descrition" class="form-control form-cs inp">{{$invoice->descrition ?? ''}}</textarea>
                        </div>
                        <div class="col-md-6 @if ($invoice->invoce_type=='supplies') d-none @endif" id="weight_services_items">
                            <label>weight<i class="text-danger">*</i></label>
                            <input type="text" name="weight" class="form-control form-cs inp" value="{{$invoice->weight ?? ''}}">
                        </div>
                    </div>
                </div>

                <!-- total  -->
                <div class="card-body curve_tabel p-0 mt-5">
                    <div class="table-responsive p-1 @if ($invoice->invoce_type!='supplies') d-none @endif" id="supplies_items">
                        <table class="table table-bordered " id="dynamicTable">
                            <thead>
                                <tr>
                                    <th style="width:57px;">Item</th>
                                    <th class="thwidth">Qty</th>
                                    <th class="thwidth">Label Qty</th>
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
                                @forelse ($invoice->invoce_item as $invoce_item)

                                <tr>
                                    <td class="mwidth open-supply-modal">
                                        <div class="d-flex align-items-center">
                                            <input type="text" name="supply_name"
                                                class="selected-supply-name form-control tdbor inputcolor"
                                                value="{{$invoce_item['supply_name'] ?? ''}}">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#supplyModal"
                                                class="btn iconbtn p-0">
                                                <i class="ti ti-chevron-down"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="supply_id"
                                            value="{{$invoce_item['supply_id'] ?? ''}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="qty" value="{{$invoce_item['qty'] ?? 0}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="label_qty" value="{{$invoce_item['label_qty'] ?? 0}}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center priceInput"><input type="text"
                                                class="form-control inputcolor" placeholder="" name="price"
                                                value="{{$invoce_item['price'] ?? 0}}"><button type="button"
                                                class="btn btn-secondary p-0 flat-btn"><i
                                                    class="ti ti-circle-plus col737"></i></button></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="value" value="{{$invoce_item['value'] ?? 0}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="ins" value="{{$invoce_item['ins'] ?? 0}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="discount" value="{{$invoce_item['discount'] ?? 0}}">
                                        </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor " placeholder=""
                                            name="tax" value="{{$invoce_item['tax'] ?? 0}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="total" value="{{$invoce_item['total'] ?? 0}}">
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-danger iconBtn dltBtn"><i
                                                    class="ti ti-minus"></i></button>
                                            <button type="button" class="btn btn-primary iconBtn addBtn"
                                                style="display: none;"><i class="ti ti-plus"></i></button>
                                            <button type="button" class="btn btn-secondary iconBtn editBtn"><i
                                                    class="ti ti-edit"></i></button>
                                        </div>
                                    </td>

                                </tr>
                                @empty
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
                                            name="label_qty"></td>
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
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="blueRibbon">
                <div class="d-sm-flex align-items-end belowflex">
                    <div><label>Subtotal</label>
                        <input type="text" class="form-control bigInput" placeholder="0"
                            value="{{$invoice->total_amount ?? 0}}" name="total_amount">
                    </div>
                    <div><label>Value</label>
                        <input type="text" class="form-control smInput" placeholder="0" name="total_price"
                            value="{{$invoice->total_price ?? 0}}">
                    </div>
                    <div><label>Tax</label>
                        <input type="text" class="form-control smInput" placeholder="0" value="{{$invoice->tax ?? 0}}"
                            name="tax">
                    </div>
                    <div><label>Discount</label>
                        <input type="text" class="form-control smInput" placeholder="0"
                            value="{{$invoice->discount ?? 0}}" name="discount">
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
                        <input type="text" class="form-control" placeholder="0" value="{{$invoice->service_fee ?? 0}}"
                            name="service_fee">
                    </div>
                    <div><label>Balance</label>
                        <input type="text" class="form-control" placeholder="0" name="balance" value="{{$invoice->balance ?? 0}}">
                    </div>
                    <div> <button type="submit" class="btn btn-success invocebuttoncolor ">Submit</button></div>
                </div>
            </div>

            <input type="hidden" name="invoce_item" value="{{json_encode($invoice->invoce_item)}}">
            <input type="hidden" name="invoce_type" value="services" value="{{$invoice->invoce_type ?? 0}}">
            <input type="hidden" name="total_qty" value="{{$invoice->total_qty ?? 0}}">
            <input type="hidden" name="total_amount" value="{{$invoice->total_amount ?? 0}}">
            <input type="hidden" name="pickup_address_id" value="{{$invoice->pickup_address_id ?? null}}">
            <input type="hidden" name="delivery_address_id" value="{{$invoice->delivery_address_id ?? null}}">

            <div class="modal fade" id="supplyModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Select Supply</h5>
                        </div>
                        <div class="modal-body">
                            <select class="form-control select2" id="supplySelector">
                                @foreach ($inventories->get('Supply') as $supply)
                                <option value="{{ $supply->id }}">{{ $supply->name }}</option>
                                @endforeach
                            </select>
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

     <!-- Invoice History Modal -->
     <div class="modal custom-modal invoiceSModel fade" id="invoiceHistory" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0 border-bottom py-3">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Invoice History</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3 pb-0">
                    <div class="row pb-2">
                        <div class="col-md-6 text-end">
                            <label class="col3A fw_500">User name: {{ $invoiceHistory->createdByUser['name'] }} {{ $invoiceHistory->createdByUser['last_name'] }}</label>
                        </div>
                        <div class="col-md-6">
                            <label class="col3A fw_500">Update Date: {{ date('m/d/Y', strtotime($invoiceHistory['updated_at'])) }}, {{ date('H:i', strtotime($invoiceHistory['updated_at'])) }}</label>
                        </div>
                    </div>
                    @if(!empty($invoiceHistory->histry_info))
                    <div class="row border-top gx-sm-4 border-bottom py-3">
                        <div class="col-md-3">
                            <label class="col3A fw_500 mb-0">Invoice No: {{ $invoiceHistory->histry_info['invoice_no'] }}</label>
                        </div>
                        @if(!empty($invoiceHistory->histry_info['delivery_address']))
                        <div class="col-md-3">
                            <label class="col3A fw_500 mb-0">Customer: {{ $invoiceHistory->histry_info['delivery_address']['user']['name'] }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500 mb-0">Address: {{ $invoiceHistory->histry_info['delivery_address']['address'] }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500 mb-0">Ship To Name: {{ $invoiceHistory->histry_info['delivery_address']['full_name'] }}</label>
                        </div>
                        @endif
                    </div>
                    <div class="row gx-sm-4 border-bottom py-2">
                        <div class="col-md-12 text-center">
                            <label class="col3A fs_20 mb-0">Invoice Details</label>
                        </div>
                    </div>
                    <div class="row gx-sm-4 border-bottom py-3">
                        <div class="col-md-3">
                            <label class="col3A fw_500">Date: {{ date('m-d-Y', strtotime($invoiceHistory->histry_info['issue_date'])) }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Invoice No: {{ $invoiceHistory->histry_info['invoice_no'] }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Driver: {{ $invoiceHistory->histry_info['driver_id'] }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Total: {{ $invoiceHistory->histry_info['grand_total'] }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Due Date: {{ !empty($invoiceHistory->histry_info['duedaterange']) && count(explode(' - ', $invoiceHistory->histry_info['duedaterange'])) > 1 ?  date('m-d-Y', strtotime(explode(' - ', $invoiceHistory->histry_info['duedaterange'])[1])) :'-' }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Address1: {{ !empty($invoiceHistory->histry_info['pickup_address']) ? $invoiceHistory->histry_info['pickup_address']['address'] :'-' }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Payments: {{ $invoiceHistory->histry_info['payment'] }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">User: {{ $invoiceHistory->createdByUser['name'] }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Container: {{ $invoiceHistory->histry_info['container_id'] }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Status: {{ ucfirst(str_replace('_', ' ', $invoiceHistory->histry_info['status'])) }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Balance: {{ $invoiceHistory->histry_info['balance'] }}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col3A fw_500">Total Box: {{ $invoiceHistory->histry_info['total_qty'] }}</label>
                        </div>
                    </div>
                    @endif
                    <div class="row gx-sm-4 py-3">
                        <div class="col-12">
                            <div class="table-responsive nopadding notMinheight nocolor">
                                <table class="table datatable">
                                    <tbody>
                                        <tr>
                                            <td>Item</td>
                                            <td>Supply ID</td>
                                            <td>Qty</td>
                                            <td>LabelQty</td>
                                            <td>Price</td>
                                            <td>Value</td>
                                            <td>Ins</td>
                                            <td>Tax</td>
                                            <td>Total</td>
                                        </tr>
                                        @foreach ($invoiceHistory->histry_info['invoce_item'] as $item)
                                        <tr>
                                            <td>{{ $item['supply_name'] }}</td>
                                            <td>{{ $item['supply_id'] }}</td>
                                            <td>{{ $item['qty'] }}</td>
                                            <td>{{ $item['label_qty'] }}</td>
                                            <td>{{ $item['price'] }}</td>
                                            <td>{{ $item['value'] }}</td>
                                            <td>{{ $item['ins'] }}</td>
                                            <td>{{ $item['tax'] }}</td>
                                            <td>{{ $item['total'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Invoice History Modal -->

    <!-- Individual Payment Modal -->
    <div class="modal invoiceSModel fade" id="individualPayment" role="dialog">
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
                    <form action="{{ route('admin.saveIndividualPayment') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id ?? '' }}">
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                    
                        <div class="row pb-2">
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Date <i class="text-danger">*</i></label>
                                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                        <input type="date" name="payment_date" class="form-cs inp" required />
                                        <input type="text" name="currentTime" class="form-control inp inputs text-center timeOnlyInput inputbackground" readonly value="{{ now()->format('h:i A') }}">
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Personal</label>
                                    <input type="text" name="personal" class="form-control inp" placeholder="Enter name or description">
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>User</label>
                                    <input type="text" class="form-control inp inputbackground" readonly value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Currency <i class="text-danger">*</i></label>
                                    <select name="currency" class="select2 form-cs" required>
                                        <option value="">Select Currency</option>
                                        <option value="USD">United States - USD</option>
                                        <option value="DKK">Greenland - DKK</option>
                                        <option value="EUR">European Union - EUR</option>
                                    </select>
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Payment Type <i class="text-danger">*</i></label>
                                    <select name="payment_type" class="select2 form-cs" required>
                                        <option value="">Select Type</option>
                                        <option value="boxcredit">Box Credit</option>
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="CreditCard">Credit Card</option>
                                    </select>
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Payment Amount <i class="text-danger">*</i></label>
                                    <input type="text" name="payment_amount" class="form-control inp" required placeholder="Enter Payment Amount" />
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Reference</label>
                                    <input type="text" name="reference" class="form-control inp" placeholder="Enter Reference" />
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Comment</label>
                                    <textarea name="comment" class="form-control inp" placeholder="Enter Comment"></textarea>
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Invoice Amount</label>
                                    <input type="text" name="invoice_amount" class="form-control inp inputbackground" readonly value="{{ $invoice->total_amount ?? '' }}" />
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Total Balance</label>
                                    <input type="text" name="total_balance" class="form-control inp inputbackground" readonly value="{{ $invoice->balance ?? '' }}" />
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Exchange Rate Balance</label>
                                    <input type="text" name="exchange_rate_balance" class="form-control inp inputbackground" readonly />
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Applied Payments</label>
                                    <input type="text" name="applied_payments" class="form-control inp inputbackground" readonly />
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Applied Payment Total In USD</label>
                                    <input type="text" name="applied_total_usd" class="form-control inp inputbackground" readonly />
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Current Balance</label>
                                    <input type="text" name="current_balance" class="form-control inp inputbackground" readonly />
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Exchange Rate</label>
                                    <input type="text" name="exchange_rate" class="form-control inp inputbackground" readonly />
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="input-block flexblockInput mb-3">
                                    <label>Balance After Exchange Rate</label>
                                    <input type="text" name="balance_after_exchange_rate" class="form-control inp inputbackground" readonly />
                                </div>
                            </div>
                        </div>
                    
                        <div class="add-customer-btns text-end mt-4">
                            <button type="button" class="btn btn-outline-primary custom-btn" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                    <label class="foncolor" for="templateTitle">Send Invoice from<i class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Email</label> <input class="form-check-input mt-0" checked type="radio" value="email" name="sentInvoicePdf">
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Text/SMS</label> <input class="form-check-input mt-0" type="radio" value="textorsms" name="sentInvoicePdf">
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="emailDiv">
                                    <div class="input-block mb-3">
                                        <label class="foncolor" for="emailId">Email Id<i class="text-danger">*</i></label>
                                        <input type="text" name="emailId" class="form-control inp" placeholder="Enter Email ID">
                                    </div>
                                </div>

                                <div id="textorsmsDiv" style="display:none;">
                                    <div class="input-block mb-3">
                                        <label class="foncolor" for="alternate_mobile_no">Alternate Mobile No.</label>
                                        <input type="tel" id="alternate_mobile_no" name="alternate_mobile_no" class="form-control inp" placeholder="Enter Alternate Mobile No.">
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

    <!-- Claim Modal -->
    <div class="modal custom-modal invoiceSModel fade" id="addnewClaim" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0 border-bottom py-3">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Add New Claim</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body pt-3 pb-2">
                    <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-block mb-3">
                                    <textarea name="PaymentAmount" class="form-control inp" placeholder="Write Comment"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="custodis d-flex mt-0">
                                    @foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture'] as $imageType)
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center justify-content-center  avtard">
                                            <label class="foncolor set me-sm-2">Image 1</label>
                                            <div class="avtarset" style="position: relative;">
                                                <!-- Image Preview -->
                                                <img id="preview_{{ $imageType }}" class="avtars avtarc" src="{{ asset('assets/img.png') }}" alt="avatar">

                                                <!-- File Input (Hidden by Default) -->
                                                <input type="file" id="file_{{ $imageType }}" name="{{ $imageType }}" accept="image/png, image/jpeg" style="display: none;" onchange="previewImage(this, '{{ $imageType }}')">

                                                <div class="divedit">
                                                    <!-- Edit Button -->
                                                    <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}" alt="edit" style="cursor: pointer;" onclick="document.getElementById('file_{{ $imageType }}').click();">

                                                    <!-- Delete Button -->
                                                    <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}" alt="delete" style="cursor: pointer;" onclick="removeImage('{{ $imageType }}')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive lesspadding notMinheight border mt-3">
                                    <table class="table table-stripped table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Write Claim</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Fode Sacko</td>
                                                <td>Lorem Ipsum - 04/28/2025, 08:09 am </td>
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
    <!--/Claim Modal -->

    <!-- labels Modal -->
    <div class="modal custom-modal invoiceSModel fade" id="InvoiceLabel" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 border-bottom py-3">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Labels <a href="#" onclick="printLabel()" class="btn btn-primary ms-2">Print</a> </h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body px-0" id="label_print">
                    <body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; font-size: 12px; color: #000;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; max-width:460px; margin: 0 auto; background: #fff; border: 1px solid #ffffff;">
                            <tr>
                                <td>
                                    <table aria-describedby="table-description" style="width: 100%; table-layout: fixed;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="height: unset!important; vertical-align: top;">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <img style="max-width: 60px; margin-right: 5px;" src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                                                            </td>
                                                            <td style="height: unset!important; vertical-align: top;">
                                                                Afro Cargo Express Llc NY<br> 366 Concord Ave<br>
                                                                <!----> NY The Bronx
                                                                <br>
                                                                646-468-4135<br> 718-954-9093
                                                            </td>
                                                        </tr>
                                                    </table>

                                                <td style="height: unset!important; text-align: right;"> Afro Cargo Express Llc Abidjan<br> Avenue
                                                    21<br>
                                                    Rue 15 Treichville<br>
                                                    <!----> Abidjan Autonomous District Abidjan <br> 07 09 04
                                                    1250<br> 07 89 49 2486 </td>
                                            </tr>
                                            <tr>
                                                <td style="height: unset!important; height: 5px;"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="font-weight: bold; font-size: 30px; color: #000; text-align: center; height: unset;"> TIV-000982
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: unset!important; height: 5px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table aria-describedby="table-description" style="width: 100%; table-layout: fixed; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="height: unset!important; padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 14px;"> 04/11/2025</td>
                                                <td style="height: unset!important; padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 14px; text-align: right;"> Afro Cargo
                                                    Express Llc NY </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table aria-describedby="table-description" style="width: 100%; table-layout: fixed; border-bottom: 1px solid #000;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                            <tr>
                                                <td><b style="font-size: 13px;">Ship To:</b><br> Fatoumata <br> 1042 Oaks Dr<br>
                                                    <!----> Ohio Columbus 42228 <br></td>
                                                <td style="height: unset!important; text-align: right; font-size: 15px; font-weight: 700;"> Tracking Items: 2 </td>
                                            </tr>
                                            <tr>
                                                <td style="height: unset!important; height:0px;"></td>
                                            </tr>
                                            <tr></tr>
                                            <tr>
                                                <td> Zeinabou <br> Abidjan<br>
                                                    <!---->
                                                    <!---->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="height: 5px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="height: unset!important; text-align: left; font-weight: 500; font-size: 14px;"> Barrel large </td>
                                            </tr>
                                            <tr>
                                                <td style="height: unset!important; height:5px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table aria-describedby="table-description" style="width: 100%; border-radius: 4px; border-bottom: 1px solid #000000;">
                                        <thead>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="height: unset!important; text-align: center;"><img width="300px" alt="Logo" src="https://d9wi98su9qvhp.cloudfront.net/production/kroC02.png"><span style="display: block; padding-top: 5px; font-weight: bold; font-size: 16px; text-align: center;">
                                                        Abidjam
                                                    </span><span style="display: block; font-weight: bold; font-size: 16px; text-align: center;"> AbidjaM
                                                    </span></td>
                                            </tr>
                                            <tr>
                                                <td style="height: unset!important; height: 20px;"></td>
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

    <!-- Tracking Details Modal -->
    <div class="modal custom-modal invoiceSModel fade" id="trackingDetails" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0 border-bottom py-3">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Tracking Details</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body pt-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive onlyxpadding notMinheight border">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Barcode</th>
                                            <th>Date</th>
                                            <th>Package Type</th>
                                            <th>Img1</th>
                                            <th>Img2</th>
                                            <th>Package Status</th>
                                            <th>Warehouse</th>
                                            <th>Container</th>
                                            <th>User</th>
                                            <th>Driver</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>060000529I1001</td>
                                            <td>02/28/2025, 17:36</td>
                                            <td>Imported</td>
                                            <td>
                                                <img class="smImg" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<img style='max-width: 200px;' src='{{ asset('assets/img.png') }}'>" src="{{ asset('assets/img.png') }}">
                                            </td>
                                            <td>
                                                <img class="smImg" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<img style='max-width: 200px;' src='{{ asset('assets/img.png') }}'>" src="{{ asset('assets/img.png') }}">
                                            </td>
                                            <td>
                                                <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="Out For Delivery(it is for batch creation only.)"> Out For Delivery(it is for batch creation only.)</p>
                                            </td>
                                            <td>Afro Cargo Bronx NYC</td>
                                            <td>-</td>
                                            <td>Fode Sacko</td>
                                            <td>Fode Sacko</td>
                                        </tr>
                                        <tr>
                                            <td>060000529I1002</td>
                                            <td>03/18/2025, 11:36</td>
                                            <td>Imported</td>
                                            <td>
                                                <img class="smImg" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<img style='max-width: 200px;' src='{{ asset('assets/img.png') }}'>" src="{{ asset('assets/img.png') }}">

                                            </td>
                                            <td>
                                                <img class="smImg" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<img style='max-width: 200px;' src='{{ asset('assets/img.png') }}'>" src="{{ asset('assets/img.png') }}">
                                            </td>
                                            <td>
                                                <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="Out For Delivery(it is for batch creation only.)"> WH</p>
                                            </td>
                                            <td>Afro Cargo Bronx NYC</td>
                                            <td>-</td>
                                            <td>Fode Sacko</td>
                                            <td>Fode Sacko</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Tracking Details Modal -->

    <!-- Note Modal -->
    <div class="modal custom-modal invoiceSModel fade" id="addnewNote" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0 border-bottom py-3">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Add New Note</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body pt-3 pb-2">
                    <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-block mb-3">
                                    <textarea name="PaymentAmount" class="form-control inp" placeholder="Write Comment"></textarea>
                                    <label class="col_000 fw-600 mb-0 mt-2">NOTE: [You can enter only 255 charcters in the above field.]</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive lesspadding notMinheight border mt-2">
                                    <table class="table table-stripped table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Fode Sacko</td>
                                                <td>Lorem Ipsum - 04/28/2025, 08:09 am </td>
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
    <!--/Note Modal -->

    @section('script')
    

    <script src="https://rawgit.com/DoersGuild/jQuery.print/master/jQuery.print.js"></script>
    <script src="{{asset('js/invoice.js')}}"></script>
    <script>
        var supplyItems = @json($inventories->get('Supply'));
        var pickupAddress = @json($pickupAddress);
        var deliveryAddress = @json($deliveryAddress);
        var currentRow = null;
        var invoce_type ='{{$invoice->invoce_type}}';
    </script>
    @endsection
</x-app-layout>