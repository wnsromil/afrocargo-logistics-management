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
                                onclick="toggleLoginForm('services')">Services</button>
                            <button id="suppliesBtn" type="button" class="btnBorder th-font col737 bg-light"
                                onclick="toggleLoginForm('supplies')">Supplies</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="invoiceForm">
                <!-- ------------------------------- Services form ------------------------------------- -->

                @csrf
                <input type="hidden" name="address_type" value="delivery">

                <input type="hidden" name="address_id">

                <div class="col-md-6">
                    <label class="foncolor" for="warehouse_name">First Name <i class="text-danger">*</i></label>
                    <input type="text" name="first_name" class="form-control inp" placeholder="Enter First Name">

                </div>
                <div class="col-md-6">
                    <label class="foncolor" for="last_name">Last Name <i class="text-danger">*</i></label>
                    <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name">
                </div>
                <div class="col-md-6">
                    <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                    <!-- Contact No. 1 -->
                    <div class="flaginputwrap">
                        <div class="customflagselect">
                            <select class="flag-select" name="mobile_number_code_id">
                                @foreach ($coutry as $key => $item)
                                <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                    data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"> {{ $item->name }}
                                    +{{ $item->phonecode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" class="form-control flagInput inp" placeholder="Enter Contact No. 2"
                            name="mobile_number">
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
                                    data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"> {{ $item->name }}
                                    +{{ $item->phonecode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" class="form-control flagInput inp" placeholder="Enter Contact No. 2"
                            name="alternative_mobile_number">
                    </div>
                </div>
                <div class="middleDiv">
                    <select name="customer_id" class="form-control select2">
                        <option value="">Search Customer</option>
                        @foreach($customers as $customer)
                        <option {{ old('customer_id')==$customer->id ? 'selected' : '' }} value="{{ $customer->id }}">{{
                            $customer->name }}</option>
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
                </div>
            </div>
        </div>

        </div>
        <div class="middleDiv">
            <select class="js-example-basic-single select2">
                <option selected="selected">Select</option>
                <option>white</option>
                <option>purple</option>
            </select>
        </div>
        <div class="last">
            <a id="addShiptoAddress" class="btn btn-primary buttons">
                Add Ship to Address
            </a>
        </div>
        </div>
        </div>

        @csrf
        <input type="hidden" name="address_type" value="pickup">
        <input type="hidden" name="address_id">

        <div class="col-md-6">
            <label class="foncolor" for="warehouse_name">First Name <i class="text-danger">*</i></label>
            <input type="text" name="first_name" class="form-control inp" placeholder="Enter First Name">

        </div>
        </div>
        </div>
        <div class="col-md-6">
            <div class="borderset position-relative newShipmentAddress disablesectionnew">
                <div class="row gx-3 gy-2">
                    <div class="col-md-6">
                        <label class="foncolor" for="warehouse_name">Reciever First Name <i
                                class="text-danger">*</i></label>
                        <input type="text" name="first_name" class="form-control inp" placeholder="Enter First Name">

                    </div>
                    <div class="col-md-6">
                        <label class="foncolor" for="last_name">Reciever Last Name <i class="text-danger">*</i></label>
                        <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name">
                    </div>
                    <div class="col-md-6">
                        <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp flagInput" placeholder="Enter Contact No. 1"
                            name="name">
                    </div>
                    <div class="col-md-6">
                        <label class="foncolor" for="contact_no1">Contact No.2 </label>
                        <input type="text" class="form-control inp flagInput" placeholder="Enter Contact No. 2"
                            name="name">
                    </div>
                    <div class="col-md-6">
                        <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                        <select class="js-example-basic-single select2">
                            <option selected="selected">orange</option>
                            <option>white</option>
                            <option>purple</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                        <select class="js-example-basic-single select2">
                            <option selected="selected">orange</option>
                            <option>white</option>
                            <option>purple</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="foncolor" for="Address.1">Address 1 <i class="text-danger">*</i></label>
                        <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 1">
                    </div>
                    <div class="col-md-6">
                        <label class="foncolor" for="Address.2">Address 2 </label>
                        <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 2">
                    </div>
                    <div class="col-md-6">
                        <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                        <input type="text" name="Zip_code" class="form-control inp" placeholder="Enter Zip">
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- both form ended -->
        <div>
            <div class="row mt-4 pt-3 g-3">
                <div class="col-md-3">
                    <label> Date <i class="text-danger">*</i></label>
                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                        <input type="text" class="btn-filters datetimepicker form-control form-cs inp "
                            name="invoice date" placeholder="mm-dd-yyyy" />
                        <input type="text" class="form-control inp inputs text-center timeOnlyInput smallinput" readonly
                            value="08:30 AM" name="currentTIme">
                    </div>
                </div>

                <div class="col-md-3">
                    <label>Invoice# <i class="text-danger">*</i></label>
                    <div class="input-container invoiceNoInput position-relative">
                        <button class="btn-primary square sm">Auto</button>
                        <input type="text" class="form-control form-cs inp" placeholder="INV 00021">
                    </div>
                </div>

                <div class="col-md-3">
                    <label>Driver<i class="text-danger">*</i></label>
                    <select class="js-example-basic-single select2 ">
                        <option selected="selected " class="form-cs inp">Alex James</option>
                        <option>white</option>
                        <option>purple</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Total</label>
                    <div class="input-container" style="position: relative;">
                        <span class="dollarSign">$</span>
                        <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00"
                            style="padding-left: 35px; padding-top: 8px !important;">
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
                    <input type="text" class="form-control inp readonly" readonly placeholder="John Duo">
                </div>
                <div class="col-md-3">
                    <label>Container<i class="text-danger">*</i></label>
                    <select class="js-example-basic-single select2 ">
                        <option selected="selected " class="form-cs">Select Container</option>
                        <option>white</option>
                        <option>purple</option>
                    </select>
                </div>
                <div class="col-md-3 ">
                    <label>Status<i class="text-danger">*</i></label>
                    <input type="text" class="form-control inp readonly" readonly placeholder="Pending">
                </div>
                <div class="col-md-3">
                    <label>Balance</label>
                    <div class="input-container" style="position: relative;">
                        <span class="dollarSign">$</span>
                        <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00"
                            style="padding-left: 35px; padding-top: 8px !important;">
                    </div>
                </div>

                <div class="col-md-3 ">
                    <label>Total Items</label>
                    <input type="text" class="form-control inp readonly" readonly placeholder="0">
                </div>
            </div>

            <label> Warehouse</label>
            <select class="js-example-basic-single select2 ">
                <option selected="selected " class="form-cs">Select Warehouse</option>
                <option>white</option>
                <option>purple</option>
            </select>
        </div>
        </div>


        <!-- Tracking Number -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="tracking_number">Tracking Number <i class="text-danger">*</i></label>
                            <input type="text" name="tracking_number" class="form-control" placeholder="Enter Tracking Number" value="{{ old('tracking_number') }}">
                            @error('tracking_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Customer -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="customer_id">Customer <i class="text-danger">*</i></label>
                            <select name="customer_id" class="form-control select2">
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option {{ old('customer_id') == $customer->id ? 'selected' : '' }} value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Driver -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="driver_id">Driver</label>
                            <select name="driver_id" class="form-control select2">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option {{ old('driver_id') == $driver->id ? 'selected' : '' }} value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            @error('driver_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Warehouse -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="warehouse_id">Warehouse<i class="text-danger">*</i></label>
                            <select name="warehouse_id" class="form-control select2">
                                <option value="">Select Warehouse</option>
                                @foreach($warehouses as $warehouse)
                                    <option {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>
                            @error('warehouse_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Weight -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="weight">Weight (kg) <i class="text-danger">*</i></label>
                            <input type="number" step="0.01" name="weight" class="form-control" placeholder="Enter weight" value="{{ old('weight') }}">
                            @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="parcel_car_ids">Parcel Types<i class="text-danger">*</i></label>
                            <select name="parcel_car_ids[]" class="form-control select2" multiple>
                                <option value="">Select Warehouse</option>
                                @foreach($parcelTpyes as $parcelTpye)
                                    <option value="{{ $parcelTpye->id }}" {{ in_array($parcelTpye->parcel_car_ids,old('parcel_car_ids',[])) ? 'selected' : '' }}>{{ $parcelTpye->name }}</option>
                                @endforeach
                            </select>
                            @error('parcel_car_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Payment Type -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="payment_type">Payment Type <i class="text-danger">*</i></label>
                            <select name="payment_type" class="form-control">
                                <option value="COD" {{ old('payment_type') == 'COD' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                                <option value="Online" {{ old('payment_type') == 'Online' ? 'selected' : '' }}>Online Payment</option>
                            </select>
                            @error('payment_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Total Amount -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="total_amount">Total Amount ($) <i class="text-danger">*</i></label>
                            <input type="number" step="0.01" name="total_amount" class="form-control" placeholder="Enter total amount" value="{{ old('total_amount') }}">
                            @error('total_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Partial Payment -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="partial_payment">Partial Payment ($)</label>
                            <input type="number" step="0.01" name="partial_payment" class="form-control" placeholder="Enter partial payment" value="{{ old('partial_payment') }}">
                            @error('partial_payment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Remaining Payment -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="remaining_payment">Remaining Payment ($)</label>
                            <input type="number" step="0.01" name="remaining_payment" class="form-control" placeholder="Enter remaining payment" value="{{ old('remaining_payment') }}">
                            @error('remaining_payment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Status -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="status">Status <i class="text-danger">*</i></label>
        
                            <select name="status" class="form-control">
                                @foreach($parcelStatuses as $status)
                                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }} >{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Source Address -->
        <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="source_address">Source Address<i class="text-danger">*</i></label>
                            <textarea name="source_address" class="form-control" placeholder="Enter Source Address">{{ old('source_address') }}</textarea>
                            @error('source_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

        <!-- Destination Address -->
        <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="destination_address">Destination Address<i class="text-danger">*</i></label>
                            <textarea name="destination_address" class="form-control" placeholder="Enter Destination Address">{{ old('destination_address') }}</textarea>
                            @error('destination_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->



        <!-- Description -->
        <!-- <div class="col-lg-12">
                        <div class="input-block mb-3">
                            <label for="descriptions">Description</label>
                            <textarea name="descriptions" class="form-control" rows="3" placeholder="Enter parcel details">{{ old('descriptions') }}</textarea>
                            @error('descriptions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div> -->

        <!-- <div class="add-customer-btns text-end">
                <a href="{{ route('admin.OrderShipment.index') }}" class="btn customer-btn-cancel">Cancel</a>
                <button type="submit" class="btn customer-btn-save">Submit</button>
            </div> -->
        </div>

        <div class="blueRibbon">
            <div class="d-sm-flex align-items-end belowflex">
                <div><label>Subtotal</label>
                    <input type="text" class="form-control bigInput" placeholder="0">
                </div>
            </div>
        </div>
        </form>


        <!-- ---------------------------- Supplies form ------------------------- -->

        <form action="{{ route('admin.OrderShipment.store') }}" id="supplies" class="hidden" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group-customer customer-additional-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-sm-flex align-items-center">
                            <div class="first">
                                <label for="customer_id">Customer <i class="text-danger">*</i></label>
                            </div>
                            <div class="middleDiv">
                                <select name="customer_id" class="form-control select2">
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
                                <a href="#" class="btn btn-primary buttons">
                                    Add New Customer
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-sm-flex align-items-center position-relative disablesectionnew">
                            <div class="first">
                                <label for="customer_id">Ship To <i class="text-danger">*</i></label>
                            </div>
                            <div class="middleDiv">
                                <select class="js-example-basic-single select2">
                                    <option selected="selected">Select</option>
                                    <option>white</option>
                                    <option>purple</option>
                                </select>
                            </div>
                            <div class="last">
                                <a href="#" class="btn btn-primary buttons">
                                    Add Ship to Address
                                </a>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- first row end  -->
                <div class="row mt-5 g-3">
                    <div class="col-md-6">
                        <div class="borderset position-relative newCustomerAdd disablesectionnew">
                            <div class="row gx-3 gy-2">
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
                                    <input type="text" id="mobile_code" class="form-control inp"
                                        placeholder="Enter Contact No. 1" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.2 </label>
                                    <input type="text" id="mobile" class="form-control inp"
                                        placeholder="Enter Contact No. 2" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">orange</option>
                                        <option>white</option>
                                        <option>purple</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="State">State <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">orange</option>
                                        <option>white</option>
                                        <option>purple</option>
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">orange</option>
                                        <option>white</option>
                                        <option>purple</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                                    <input type="text" name="Zip_code" class="form-control inp" placeholder="Enter Zip">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.1">Address 1 <i
                                            class="text-danger">*</i></label>
                                    <input type="text" name="Address.1" class="form-control inp"
                                        placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.2">Address 2 </label>
                                    <input type="text" name="Address.1" class="form-control inp"
                                        placeholder="Enter Address 2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="borderset position-relative disablesectionnew">
                            <div class="row gx-3 gy-2">
                                <div class="col-md-6">
                                    <label class="foncolor" for="warehouse_name">Reciever First Name <i
                                            class="text-danger">*</i></label>
                                    <input type="text" name="first_name" class="form-control inp"
                                        placeholder="Enter First Name">

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="last_name">Reciever Last Name <i
                                            class="text-danger">*</i></label>
                                    <input type="text" name="last_name" class="form-control inp"
                                        placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.1 <i
                                            class="text-danger">*</i></label>
                                    <input type="text" class="form-control inp flagInput"
                                        placeholder="Enter Contact No. 1" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.2 </label>
                                    <input type="text" class="form-control inp flagInput"
                                        placeholder="Enter Contact No. 2" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">orange</option>
                                        <option>white</option>
                                        <option>purple</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">orange</option>
                                        <option>white</option>
                                        <option>purple</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.1">Address 1 <i
                                            class="text-danger">*</i></label>
                                    <input type="text" name="Address.1" class="form-control inp"
                                        placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.2">Address 2 </label>
                                    <input type="text" name="Address.1" class="form-control inp"
                                        placeholder="Enter Address 2">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                                    <input type="text" name="Zip_code" class="form-control inp" placeholder="Enter Zip">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- both form ended -->
                <div>
                    <div class="row mt-4 pt-3 g-3">
                        <div class="col-md-3">
                            <label> Date <i class="text-danger">*</i></label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text" class="btn-filters datetimepicker form-control form-cs inp "
                                    name="invoice date" placeholder="mm-dd-yyyy" />
                                <input type="text" class="form-control inp inputs text-center timeOnlyInput smallinput"
                                    readonly value="08:30 AM" name="currentTIme">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Invoice# <i class="text-danger">*</i></label>
                            <div class="input-container invoiceNoInput position-relative">
                                <button class="btn-primary square sm">Auto</button>
                                <input type="text" class="form-control form-cs inp" placeholder="INV 00021">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Driver<i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected " class="form-cs inp">Alex James</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Total</label>
                            <div class="input-container" style="position: relative;">
                                <span class="dollarSign">$</span>
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00"
                                    style="padding-left: 35px; padding-top: 8px !important;">
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
                            <input type="text" class="form-control inp readonly" readonly placeholder="John Duo">
                        </div>
                        <div class="col-md-3 readonly">
                            <label>Container<i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2" readonly>
                                <option selected="selected " class="form-cs">Select Container</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-md-3 ">
                            <label>Status<i class="text-danger">*</i></label>
                            <input type="text" class="form-control inp readonly" readonly placeholder="Pending">
                        </div>
                        <div class="col-md-3">
                            <label>Balance</label>
                            <div class="input-container" style="position: relative;">
                                <span class="dollarSign">$</span>
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00"
                                    style="padding-left: 35px; padding-top: 8px !important;">
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <label>Total Items</label>
                            <input type="text" class="form-control inp readonly" readonly placeholder="0">
                        </div>
                        <div class="col-md-3 ">

                            <label> Warehouse</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected " class="form-cs">Select Warehouse</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body curve_tabel p-0 mt-5">
                    <div class="table-responsive p-1">
                        <table class="table table-bordered ">
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
                                <tr>
                                    <td class="mwidth">
                                        <select class="js-example-basic-single select2 inputcolor">
                                            <option selected="selected " class="form-cs"></option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>
                                        <div class="d-flex align-items-center priceInput"><input type="text"
                                                class="form-control inputcolor" placeholder=""><button
                                                class="btn btn-secondary p-0 flat-btn"><i
                                                    class="ti ti-circle-plus col737"></i></button></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder="">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>

                                        <div class="text-center">
                                            <button class="btn btn-danger iconBtn dltBtn"><i
                                                    class="ti ti-minus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i
                                                    class="ti ti-edit"></i></button>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                <tr>
                                    <td class="mwidth"><select class="js-example-basic-single select2 inputcolor">
                                            <option selected="selected " class="form-cs"></option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>
                                        <div class="d-flex align-items-center priceInput"><input type="text"
                                                class="form-control inputcolor" placeholder=""><button
                                                class="btn btn-secondary p-0 flat-btn"><i
                                                    class="ti ti-circle-plus col737"></i></button></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder="">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>

                                        <div class="text-center">
                                            <button class="btn btn-danger iconBtn dltBtn"><i
                                                    class="ti ti-minus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i
                                                    class="ti ti-edit"></i></button>


                                        </div>
                                    </td>

                                </tr>

                                <tr>
                                    <td class="mwidth"><select class="js-example-basic-single select2 inputcolor">
                                            <option selected="selected " class="form-cs"></option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>
                                        <div class="d-flex align-items-center priceInput"><input type="text"
                                                class="form-control inputcolor" placeholder=""><button
                                                class="btn btn-secondary p-0 flat-btn"><i
                                                    class="ti ti-circle-plus col737"></i></button></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder="">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>

                                        <div class="text-center">
                                            <button class="btn btn-danger iconBtn dltBtn"><i
                                                    class="ti ti-minus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i
                                                    class="ti ti-edit"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mwidth"><select class="js-example-basic-single select2">
                                            <option selected="selected " class="form-cs"></option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>
                                        <div class="d-flex align-items-center priceInput"><input type="text"
                                                class="form-control inputcolor" placeholder=""><button
                                                class="btn btn-secondary p-0 flat-btn"><i
                                                    class="ti ti-circle-plus col737"></i></button></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder="">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor " placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>
                                        <div class="text-center"><button class="btn btn-danger iconBtn dltBtn"><i
                                                    class="ti ti-minus"></i></button>
                                            <button class="btn btn-primary iconBtn addBtn"><i
                                                    class="ti ti-plus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i
                                                    class="ti ti-edit"></i></button>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Tracking Number -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="tracking_number">Tracking Number <i class="text-danger">*</i></label>
                            <input type="text" name="tracking_number" class="form-control" placeholder="Enter Tracking Number" value="{{ old('tracking_number') }}">
                            @error('tracking_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Customer -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="customer_id">Customer <i class="text-danger">*</i></label>
                            <select name="customer_id" class="form-control select2">
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option {{ old('customer_id') == $customer->id ? 'selected' : '' }} value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Driver -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="driver_id">Driver</label>
                            <select name="driver_id" class="form-control select2">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option {{ old('driver_id') == $driver->id ? 'selected' : '' }} value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            @error('driver_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Warehouse -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="warehouse_id">Warehouse<i class="text-danger">*</i></label>
                            <select name="warehouse_id" class="form-control select2">
                                <option value="">Select Warehouse</option>
                                @foreach($warehouses as $warehouse)
                                    <option {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>
                            @error('warehouse_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Weight -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="weight">Weight (kg) <i class="text-danger">*</i></label>
                            <input type="number" step="0.01" name="weight" class="form-control" placeholder="Enter weight" value="{{ old('weight') }}">
                            @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="parcel_car_ids">Parcel Types<i class="text-danger">*</i></label>
                            <select name="parcel_car_ids[]" class="form-control select2" multiple>
                                <option value="">Select Warehouse</option>
                                @foreach($parcelTpyes as $parcelTpye)
                                    <option value="{{ $parcelTpye->id }}" {{ in_array($parcelTpye->parcel_car_ids,old('parcel_car_ids',[])) ? 'selected' : '' }}>{{ $parcelTpye->name }}</option>
                                @endforeach
                            </select>
                            @error('parcel_car_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Payment Type -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="payment_type">Payment Type <i class="text-danger">*</i></label>
                            <select name="payment_type" class="form-control">
                                <option value="COD" {{ old('payment_type') == 'COD' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                                <option value="Online" {{ old('payment_type') == 'Online' ? 'selected' : '' }}>Online Payment</option>
                            </select>
                            @error('payment_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Total Amount -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="total_amount">Total Amount ($) <i class="text-danger">*</i></label>
                            <input type="number" step="0.01" name="total_amount" class="form-control" placeholder="Enter total amount" value="{{ old('total_amount') }}">
                            @error('total_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Partial Payment -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="partial_payment">Partial Payment ($)</label>
                            <input type="number" step="0.01" name="partial_payment" class="form-control" placeholder="Enter partial payment" value="{{ old('partial_payment') }}">
                            @error('partial_payment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Remaining Payment -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="remaining_payment">Remaining Payment ($)</label>
                            <input type="number" step="0.01" name="remaining_payment" class="form-control" placeholder="Enter remaining payment" value="{{ old('remaining_payment') }}">
                            @error('remaining_payment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Status -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="status">Status <i class="text-danger">*</i></label>
        
                            <select name="status" class="form-control">
                                @foreach($parcelStatuses as $status)
                                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }} >{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Source Address -->
                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="source_address">Source Address<i class="text-danger">*</i></label>
                            <textarea name="source_address" class="form-control" placeholder="Enter Source Address">{{ old('source_address') }}</textarea>
                            @error('source_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->

                <!-- Destination Address -->
                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="destination_address">Destination Address<i class="text-danger">*</i></label>
                            <textarea name="destination_address" class="form-control" placeholder="Enter Destination Address">{{ old('destination_address') }}</textarea>
                            @error('destination_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> -->



                <!-- Description -->
                <!-- <div class="col-lg-12">
                        <div class="input-block mb-3">
                            <label for="descriptions">Description</label>
                            <textarea name="descriptions" class="form-control" rows="3" placeholder="Enter parcel details">{{ old('descriptions') }}</textarea>
                            @error('descriptions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div> -->

                <!-- <div class="add-customer-btns text-end">
                <a href="{{ route('admin.OrderShipment.index') }}" class="btn customer-btn-cancel">Cancel</a>
                <button type="submit" class="btn customer-btn-save">Submit</button>
            </div> -->
            </div>

            <div class="blueRibbon">
                <div class="d-sm-flex align-items-end belowflex">
                    <div><label>Subtotal</label>
                        <input type="text" class="form-control bigInput" placeholder="0">
                    </div>
                    <div><label>Value</label>
                        <input type="text" class="form-control smInput" placeholder="0">
                    </div>
                    <div><label>Tax</label>
                        <input type="text" class="form-control smInput" placeholder="0">
                    </div>
                    <div><label>Discount</label>
                        <input type="text" class="form-control smInput" placeholder="0">
                    </div>
                    <div><label>Ins</label>
                        <input type="text" class="form-control smInput" placeholder="0">
                    </div>
                    <div><label>Payment</label>
                        <input type="text" class="form-control" placeholder="0">
                    </div>
                    <div><label>Service Fee</label>
                        <input type="text" class="form-control" placeholder="0">
                    </div>
                    <div><label>Balance</label>
                        <input type="text" class="form-control" placeholder="0">
                    </div>
                    <div> <button type="submit" class="btn btn-success invocebuttoncolor ">Submit</button></div>
                </div>
            </div>
        </form>
        </div>

        <!-- Invoice History Modal -->
        <div class="modal custom-modal invoiceSModel fade" id="invoiceHistory" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0 border-bottom py-3">
                        <div class="form-header modal-header-title text-start mb-0">
                            <h4 class="mb-0">Invoice History</h4>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body pt-3 pb-0">
                        <div class="row pb-2">
                            <div class="col-md-6 text-end">
                                <label class="col3A fw_500">User name: Abijan Cargo</label>
                            </div>
                            <div class="col-md-6">
                                <label class="col3A fw_500">Update Date: 02/28/2025, 17:36</label>
                            </div>
                        </div>
                        <div class="row border-top gx-sm-4 border-bottom py-3">
                            <div class="col-md-3">
                                <label class="col3A fw_500 mb-0">I/D: CUS-001014</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500 mb-0">Customer: Afro Cargo Express LLC Abidjan
                                    customer</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500 mb-0">Address: 366 Concord Ave</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500 mb-0">Ship To Name: Haouma Tambadou Papa Soumare</label>
                            </div>
                        </div>
                        <div class="row gx-sm-4 border-bottom py-2">
                            <div class="col-md-12 text-center">
                                <label class="col3A fs_20 mb-0">Invoice Details</label>
                            </div>
                        </div>
                        <div class="row gx-sm-4 border-bottom py-3">
                            <div class="col-md-3">
                                <label class="col3A fw_500">Date: 03-01-2025</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Invoice No: TIV-000529</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Driver: Fode Sacko</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Total: 450</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Due Date: 03-16-2025</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Address1: 366 Concord Ave</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Payments: 0</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">User: Abijan Cargo</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Container: FFAU5415337</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Status: Not Done</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Balance: 0</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col3A fw_500">Total Box: 1</label>
                            </div>
                        </div>
                        <div class="row gx-sm-4 py-3">
                            <div class="col-12">
                                <div class="table-responsive nopadding notMinheight nocolor">
                                    <table class="table datatable">
                                        <tbody>
                                            <tr>
                                                <td>Item</td>
                                                <td>Size</td>
                                                <td>Qty</td>
                                                <td>LabelQty</td>
                                                <td>Price</td>
                                                <td>Value</td>
                                                <td>Discount</td>
                                                <td>Ins</td>
                                                <td>Tax</td>
                                                <td>Total</td>
                                            </tr>
                                            <tr>
                                                <td>--</td>
                                                <td>xl</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>450</td>
                                                <td>650</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>450</td>
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
        </div>
        <!-- /Invoice History Modal -->

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
                                            <input type="text" name="driverInventoryDate"
                                                class="btn-filters  form-cs inp" placeholder="MM/DD/YYYY" />
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
                                        <input type="text" name="userName" class="form-control inp inputbackground"
                                            readonly value="Abigel Miyagi" />
                                    </div>
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
                                        <input type="text" name="userName" class="form-control inp inputbackground"
                                            readonly value="600.00" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-block flexblockInput mb-3">
                                        <label>Total Balance<i class="text-danger">*</i></label>
                                        <input type="text" name="userName" class="form-control inp inputbackground"
                                            readonly value="300.00" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-block flexblockInput mb-3">
                                        <label>Exchange Rate Balance<i class="text-danger">*</i></label>
                                        <input type="text" name="userName" class="form-control inp inputbackground"
                                            readonly placeholder="Exchange Rate Balance" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-block flexblockInput mb-3">
                                        <label>Applied Payments<i class="text-danger">*</i></label>
                                        <input type="text" name="userName" class="form-control inp inputbackground"
                                            readonly placeholder="Applied Payments" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-block flexblockInput mb-3">
                                        <label>Applied Payment Total In USD<i class="text-danger">*</i></label>
                                        <input type="text" name="userName" class="form-control inp inputbackground"
                                            readonly placeholder="Applied Payment Total In USD" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-block flexblockInput mb-3">
                                        <label>Current Balance<i class="text-danger">*</i></label>
                                        <input type="text" name="userName" class="form-control inp inputbackground"
                                            readonly placeholder="Current Balance" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-block flexblockInput mb-3">
                                        <label>Exchange Rate<i class="text-danger">*</i></label>
                                        <input type="text" name="userName" class="form-control inp inputbackground"
                                            readonly placeholder="Exchange Rate" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-block flexblockInput mb-3">
                                        <label>Current Balance After Ex.Rate<i class="text-danger">*</i></label>
                                        <input type="text" name="userName" class="form-control inp inputbackground"
                                            readonly placeholder="Current Balance After Ex.Rate" />
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
                                                            data-bs-placement="top" title="Abijan Cargo Sacko">Abijan
                                                            Cargo Sacko</p>
                                                    </td>
                                                    <td>Cash</td>
                                                    <td>04/28/2025, 03:21</td>
                                                    <td>200.00</td>
                                                    <td>-</td>
                                                    <td>USD</td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class=" btn-action-icon "
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
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
                                        <label class="foncolor mb-0 pt-0 me-3 col3A"
                                            for="templateTitle">Text/SMS</label> <input class="form-check-input mt-0"
                                            type="radio" value="textorsms" name="sentInvoicePdf">
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
                                            <label class="foncolor" for="alternate_mobile_no">Alternate Mobile
                                                No.</label>
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
                                        <textarea name="PaymentAmount" class="form-control inp"
                                            placeholder="Write Comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="custodis d-flex mt-0">
                                        @foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture']
                                        as $imageType)
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center justify-content-center  avtard">
                                                <label class="foncolor set me-sm-2">Image 1</label>
                                                <div class="avtarset" style="position: relative;">
                                                    <!-- Image Preview -->
                                                    <img id="preview_{{ $imageType }}" class="avtars avtarc"
                                                        src="{{ asset('assets/img.png') }}" alt="avatar">

                                                    <!-- File Input (Hidden by Default) -->
                                                    <input type="file" id="file_{{ $imageType }}"
                                                        name="{{ $imageType }}" accept="image/png, image/jpeg"
                                                        style="display: none;"
                                                        onchange="previewImage(this, '{{ $imageType }}')">

                                                    <div class="divedit">
                                                        <!-- Edit Button -->
                                                        <img class="editstyle"
                                                            src="{{ asset('assets/img/edit (1).png') }}" alt="edit"
                                                            style="cursor: pointer;"
                                                            onclick="document.getElementById('file_{{ $imageType }}').click();">

                                                        <!-- Delete Button -->
                                                        <img class="editstyle"
                                                            src="{{ asset('assets/img/dlt (1).png') }}" alt="delete"
                                                            style="cursor: pointer;"
                                                            onclick="removeImage('{{ $imageType }}')">
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
                            <h4 class="mb-0">Labels <a href="#" class="btn btn-primary ms-2">Print</a> </h4>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
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
                        <div class="modal-body pt-3 pb-2">
                            <form action="{{ route('admin.updateNote') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">

                                        @csrf
                                        <div class="input-block mb-3">
                                            <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                                            <textarea name="notes" class="form-control inp"
                                                placeholder="Write Comment"></textarea>
                                            <label class="col_000 fw-600 mb-0 mt-2">NOTE: [You can enter only 255
                                                charcters in
                                                the above field.]</label>
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
                                                        <td>{{$invoice->createdByUser->name ?? ''}}</td>
                                                        <td>{{$invoice->notes ?? ''}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="add-customer-btns text-end">
                                            <button type="button"
                                                class="btn btn-outline-primary custom-btn">Cancel</button>
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
            <!-- Flatpickr CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

            <!-- Flatpickr JS -->
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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