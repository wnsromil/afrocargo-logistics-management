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
                                        <div class="text-center">
                                            <button type="button" class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button type="button" class="btn btn-primary iconBtn addBtn"><i class="ti ti-plus"></i></button>
                                            <button type="button" class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button>
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

        {{-- <form action="{{ route('admin.OrderShipment.store') }}" id="supplies" class="hidden" method="POST" enctype="multipart/form-data">
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
                        <table class="table table-bordered" id="dynamicTable">
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
                                            <option selected="selected" class="form-cs"></option>
                                            <option>Item 1</option>
                                            <option>Item 2</option>
                                            <option>Item 3</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-sm btn-secondary qty-minus">-</button>
                                            <input type="text" class="form-control tdbor inputcolor qty-input" value="1">
                                            <button class="btn btn-sm btn-secondary qty-plus">+</button>
                                        </div>
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor label-qty" placeholder="0"></td>
                                    <td>
                                        <div class="d-flex align-items-center priceInput">
                                            <input type="text" class="form-control inputcolor price-input" placeholder="0.00">
                                            <button class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor value-input" placeholder="0.00" readonly>
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor ins-input" placeholder="0"></td>
                                    <td><input type="text" class="form-control tdbor inputcolor discount-input" placeholder="0.00"></td>
                                    <td><input type="text" class="form-control tdbor inputcolor tax-input" placeholder="0.00"></td>
                                    <td><input type="text" class="form-control tdbor inputcolor total-input" placeholder="0.00" readonly></td>
                                    <td>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                                            <button type="button" class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button>
                                            <button type="button" class="btn btn-primary iconBtn addBtn"><i class="ti ti-plus"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                
                
                <style>
                .qty-minus, .qty-plus {
                    width: 30px;
                    padding: 0;
                }
                .qty-input {
                    width: 50px;
                    text-align: center;
                    margin: 0 5px;
                }
                .editBtn.btn-success {
                    background-color: #28a745;
                    border-color: #28a745;
                }
                </style>
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
        </form> --}}
    </div>
    @section('script')
        <script src="{{asset('js/invoice.js')}}"></script>
    @endsection
</x-app-layout>
