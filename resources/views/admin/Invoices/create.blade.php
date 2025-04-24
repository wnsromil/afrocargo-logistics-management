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
                            <button id="servicesBtn" type="button" class="btnBorder th-font col737 bg-light me-3 activity-feed" onclick="toggleLoginForm('services')">Services</button>
                            <button id="suppliesBtn" type="button" class="btnBorder th-font col737 bg-light" onclick="toggleLoginForm('supplies')">Supplies</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>

    <div class="invoiceForm">
        <!-- ------------------------------- Services form ------------------------------------- -->

        <form action="{{ route('admin.OrderShipment.store') }}" id="services" method="POST" enctype="multipart/form-data">
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
                                    <option {{ old('customer_id') == $customer->id ? 'selected' : '' }} value="{{ $customer->id }}">{{ $customer->name }}</option>
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

                    <div class="col-md-6">
                        <div class="d-sm-flex align-items-center">
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
                                <a id="addShiptoAddress" class="btn btn-primary buttons">
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
                                    <label class="foncolor" for="warehouse_name">First Name <i class="text-danger">*</i></label>
                                    <input type="text" name="first_name" class="form-control inp" placeholder="Enter First Name">

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="last_name">Last Name <i class="text-danger">*</i></label>
                                    <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control flagInput inp" placeholder="Enter Contact No. 1" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.2 </label>
                                    <input type="text" class="form-control flagInput inp" placeholder="Enter Contact No. 2" name="name">
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
                                    <label class="foncolor" for="Address.1">Address 1 <i class="text-danger">*</i></label>
                                    <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.2">Address 2 </label>
                                    <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="borderset position-relative newShipmentAddress disablesectionnew">
                            <div class="row gx-3 gy-2">
                                <div class="col-md-6">
                                    <label class="foncolor" for="warehouse_name">Reciever First Name <i class="text-danger">*</i></label>
                                    <input type="text" name="first_name" class="form-control inp" placeholder="Enter First Name">

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="last_name">Reciever Last Name <i class="text-danger">*</i></label>
                                    <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control inp flagInput" placeholder="Enter Contact No. 1" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.2 </label>
                                    <input type="text" class="form-control inp flagInput" placeholder="Enter Contact No. 2" name="name">
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
                                <input type="text" class="btn-filters datetimepicker form-control form-cs inp " name="invoice date" placeholder="mm-dd-yyyy" />
                                <input type="text" class="form-control inp inputs text-center timeOnlyInput smallinput" readonly value="08:30 AM" name="currentTIme">
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
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00" style="padding-left: 35px; padding-top: 8px !important;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Due Date <i class="text-danger">*</i></label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text" class="btn-filters daterangeInput form-cs inp readonly" readonly name="duedaterange" placeholder="From Date - To Date" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Payment</label>
                            <div class="input-container" style="position: relative;">
                                <span class="dollarSign">$</span>
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00" style="padding-left: 35px; padding-top: 8px !important;">
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
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00" style="padding-left: 35px; padding-top: 8px !important;">
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
                                        <div class="d-flex align-items-center priceInput"><input type="text" class="form-control inputcolor" placeholder=""><button class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button></div>
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
                                            <button class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button>
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
                                        <div class="d-flex align-items-center priceInput"><input type="text" class="form-control inputcolor" placeholder=""><button class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button></div>
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
                                            <button class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button>


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
                                        <div class="d-flex align-items-center priceInput"><input type="text" class="form-control inputcolor" placeholder=""><button class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button></div>
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
                                            <button class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button>
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
                                        <div class="d-flex align-items-center priceInput"><input type="text" class="form-control inputcolor" placeholder=""><button class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder="">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor " placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>
                                        <div class="text-center"><button class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button class="btn btn-primary iconBtn addBtn"><i class="ti ti-plus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button></div>
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
                        <input type="text" class="form-control smInput" placeholder="0"></div>
                    <div><label>Tax</label>
                        <input type="text" class="form-control smInput" placeholder="0"></div>
                    <div><label>Discount</label>
                        <input type="text" class="form-control smInput" placeholder="0"></div>
                    <div><label>Ins</label>
                        <input type="text" class="form-control smInput" placeholder="0"></div>
                    <div><label>Payment</label>
                        <input type="text" class="form-control" placeholder="0"></div>
                    <div><label>Service Fee</label>
                        <input type="text" class="form-control" placeholder="0"></div>
                    <div><label>Balance</label>
                        <input type="text" class="form-control" placeholder="0"></div>
                    <div> <button type="submit" class="btn btn-success invocebuttoncolor ">Submit</button></div>
                </div>
            </div>
        </form>


        <!-- ---------------------------- Supplies form ------------------------- -->

        <form action="{{ route('admin.OrderShipment.store') }}" id="supplies" class="hidden" method="POST" enctype="multipart/form-data">
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
                                    <option {{ old('customer_id') == $customer->id ? 'selected' : '' }} value="{{ $customer->id }}">{{ $customer->name }}</option>
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
                                    <label class="foncolor" for="warehouse_name">First Name <i class="text-danger">*</i></label>
                                    <input type="text" name="first_name" class="form-control inp" placeholder="Enter First Name">

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="last_name">Last Name <i class="text-danger">*</i></label>
                                    <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                                    <input type="text" id="mobile_code" class="form-control inp" placeholder="Enter Contact No. 1" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.2 </label>
                                    <input type="text" id="mobile" class="form-control inp" placeholder="Enter Contact No. 2" name="name">
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
                                    <label class="foncolor" for="Address.1">Address 1 <i class="text-danger">*</i></label>
                                    <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="Address.2">Address 2 </label>
                                    <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="borderset position-relative disablesectionnew">
                            <div class="row gx-3 gy-2">
                                <div class="col-md-6">
                                    <label class="foncolor" for="warehouse_name">Reciever First Name <i class="text-danger">*</i></label>
                                    <input type="text" name="first_name" class="form-control inp" placeholder="Enter First Name">

                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="last_name">Reciever Last Name <i class="text-danger">*</i></label>
                                    <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control inp flagInput" placeholder="Enter Contact No. 1" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="foncolor" for="contact_no1">Contact No.2 </label>
                                    <input type="text" class="form-control inp flagInput" placeholder="Enter Contact No. 2" name="name">
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
                                <input type="text" class="btn-filters datetimepicker form-control form-cs inp " name="invoice date" placeholder="mm-dd-yyyy" />
                                <input type="text" class="form-control inp inputs text-center timeOnlyInput smallinput" readonly value="08:30 AM" name="currentTIme">
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
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00" style="padding-left: 35px; padding-top: 8px !important;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Due Date <i class="text-danger">*</i></label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text" class="btn-filters daterangeInput form-cs inp readonly" readonly name="duedaterange" placeholder="From Date - To Date" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Payment</label>
                            <div class="input-container" style="position: relative;">
                                <span class="dollarSign">$</span>
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00" style="padding-left: 35px; padding-top: 8px !important;">
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <label>User</label>
                            <input type="text" class="form-control inp readonly" readonly placeholder="John Duo">
                        </div>
                        <div class="col-md-3 readonly">
                            <label>Container<i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2" readonly >
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
                                <input type="text" class="form-control form-cs inp readonly" readonly placeholder="0.00" style="padding-left: 35px; padding-top: 8px !important;">
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
                                        <div class="d-flex align-items-center priceInput"><input type="text" class="form-control inputcolor" placeholder=""><button class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button></div>
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
                                            <button class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button>
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
                                        <div class="d-flex align-items-center priceInput"><input type="text" class="form-control inputcolor" placeholder=""><button class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button></div>
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
                                            <button class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button>


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
                                        <div class="d-flex align-items-center priceInput"><input type="text" class="form-control inputcolor" placeholder=""><button class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button></div>
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
                                            <button class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button>
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
                                        <div class="d-flex align-items-center priceInput"><input type="text" class="form-control inputcolor" placeholder=""><button class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder="">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor " placeholder=""></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                    <td>
                                        <div class="text-center"><button class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button class="btn btn-primary iconBtn addBtn"><i class="ti ti-plus"></i></button>
                                            <button class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button></div>
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
                        <input type="text" class="form-control smInput" placeholder="0"></div>
                    <div><label>Tax</label>
                        <input type="text" class="form-control smInput" placeholder="0"></div>
                    <div><label>Discount</label>
                        <input type="text" class="form-control smInput" placeholder="0"></div>
                    <div><label>Ins</label>
                        <input type="text" class="form-control smInput" placeholder="0"></div>
                    <div><label>Payment</label>
                        <input type="text" class="form-control" placeholder="0"></div>
                    <div><label>Service Fee</label>
                        <input type="text" class="form-control" placeholder="0"></div>
                    <div><label>Balance</label>
                        <input type="text" class="form-control" placeholder="0"></div>
                    <div> <button type="submit" class="btn btn-success invocebuttoncolor ">Submit</button></div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function toggleLoginForm(type) {
            if (type === 'services') {
                document.getElementById('services').style.display = 'block';
                document.getElementById('supplies').style.display = 'none';
                document.getElementById('servicesBtn').classList.add('active3');
                document.getElementById('suppliesBtn').classList.remove('active3');

            } else if (type === 'supplies') {
                document.getElementById('services').style.display = 'none';
                document.getElementById('supplies').style.display = 'block';
                document.getElementById('servicesBtn').classList.remove('active3');
                document.getElementById('suppliesBtn').classList.add('active3');

            }
        }

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const formType = urlParams.get('id') || 'services';
            toggleLoginForm(formType);
        };

    </script>
    <script>
        document.getElementById('addCustomer').onclick = () => document.querySelector('.newCustomerAdd').classList.toggle('none');

        document.getElementById('addShiptoAddress').onclick = () => document.querySelector('.newShipmentAddress').classList.toggle('none');

    </script>
</x-app-layout>
