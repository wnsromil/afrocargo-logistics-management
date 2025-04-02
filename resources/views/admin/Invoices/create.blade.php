<x-app-layout>

    <x-slot name="header">
        Parcel Management
    </x-slot>

    <x-slot name="cardTitle">
        <style>
            .dshow {
                border: none !important !
            }

            .hidden {
                display: none;
            }
        </style>

        <div class="page-header">
            <div class="content-page-header tomain">
                @isset($cardTitle)
                    {{$cardTitle}} display:flex;
                    border:none !important;
                @endisset
            </div>
            @isset($cardHeader)
                {{$cardHeader}}
            @endisset
        </div>
        <p class="subhead">Add Invoice</p>
        <div class="card invoices-tabs-card">

            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- <div class="invoices-tabs">
                            <div class="d-flex text-center authTabDiv">
                                <ul>
                                    <li><a href="#" class="tab-link active3 cardAnalyticsSize fw-medium"
                                            data-tab="services">Service</a></li>
                                    <li><a href="#" class="tab-link cardAnalyticsSize fw-medium"
                                            data-tab="supplies">Supplies</a></li>
                                </ul>
                            </div>
                        </div> -->

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

    <!-- ------------------------------- Services form ------------------------------------- -->

    <form action="{{ route('admin.OrderShipment.store') }}" id="services" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="customer_id">Customer <i class="text-danger">*</i></label>
                        </div>
                        <div class="col-md-5">
                            <select name="customer_id" class="form-control select2">
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option {{ old('customer_id') == $customer->id ? 'selected' : '' }}
                                        value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary buttons">
                                Add New Customer
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="customer_id">Ship To <i class="text-danger">*</i></label>
                        </div>
                        <div class="col-md-5">
                            <select class="js-example-basic-single select2">
                                <option selected="selected">Select</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary buttons">
                                Add Ship to Address
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- first row end  -->
            <div class="row d-flex" style="justify-content: space-between;">
                <div class="col-6" style="padding-right: 20px;">
                    <div class="row borderset">
                        <div class="col-6">
                            <label class="foncolor" for="warehouse_name">First Name <i class="text-danger">*</i></label>
                            <input type="text" name="first_name" class="form-control inp"
                                placeholder="Enter First Name">

                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="last_name">Last Name <i class="text-danger">*</i></label>
                            <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                            <input type="text" id="mobile_code" class="form-control inp"
                                placeholder="Enter Contact Number 1" name="name">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="contact_no1">Contact No.2 <i class="text-danger">*</i></label>
                            <input type="text" id="mobile" class="form-control inp" placeholder="Enter Contact Number 2"
                                name="name">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2">
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="State">State <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2">
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>

                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2">
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                            <input type="text" name="Zip_code" class="form-control inp" placeholder="Enter Zip">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Address.1">Address 1 <i class="text-danger">*</i></label>
                            <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 1">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Address.2">Address 2 </label>
                            <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 2">
                        </div>
                    </div>
                </div>
                <div class="col-6" style="padding-left: 20px;">
                    <div class="row borderset">
                        <div class="col-6">
                            <label class="foncolor" for="warehouse_name">Reciever First Name <i
                                    class="text-danger">*</i></label>
                            <input type="text" name="first_name" class="form-control inp"
                                placeholder="Enter First Name">

                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="last_name">Reciever Last Name <i
                                    class="text-danger">*</i></label>
                            <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                            <input type="text" id="mobile_code" class="form-control inp"
                                placeholder="Enter Contact Number 1" name="name">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="contact_no1">Contact No.2 <i class="text-danger">*</i></label>
                            <input type="text" id="mobile" class="form-control inp" placeholder="Enter Contact Number 2"
                                name="name">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2">
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2">
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Address.1">Address 1 <i class="text-danger">*</i></label>
                            <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 1">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Address.2">Address 2 </label>
                            <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 2">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                            <input type="text" name="Zip_code" class="form-control inp" placeholder="Enter Zip">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="row bsdown">
                    <div class="col-md-3">
                        <label> Date <i class="text-danger">*</i></label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" class="btn-filters form-control form-cs inp " name="datetimes"
                                placeholder="From Date - To Date" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label>Invoice# <i class="text-danger">*</i></label>
                        <div class="input-container"
                            style="display:flex; position: relative;border: 1px solid #00000042;border-radius: 5px !important;">
                            <div
                                style="background: #203A5F; width: 30px; height: 30px; margin-right: 10px; border-radius: 5px; margin-left: 4px; margin-block: 4px; color: white; font-size: 8px; align-content: center; text-align: center;">
                                Auto</div>

                            <input type="text" class="form-control form-cs inp" placeholder="INV 00021"
                                style=" border:none !important">
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
                            <img src="../assets/img/invoices/$.png" alt="img"
                                style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 11px; height: 24px;">
                            <input type="text" class="form-control form-cs inp" placeholder="0.00"
                                style="padding-left: 30px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Due Date <i class="text-danger">*</i></label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" class="btn-filters  form-cs inp " name="datetimes"
                                placeholder="From Date - To Date" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label>Payment</label>
                        <div class="input-container" style="position: relative;">
                            <img src="../assets/img/invoices/$.png" alt="img"
                                style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 11px; height: 24px;">
                            <input type="text" class="form-control form-cs inp" placeholder="0.00"
                                style="padding-left: 30px;">
                        </div>
                    </div>

                    <div class="col-md-3 ">
                        <label>User</label>
                        <input type="text" class="form-control form-cs inp" placeholder="John Duo">
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
                        <input type="text" class="form-control form-cs inp" placeholder="Pending">
                    </div>
                    <div class="col-md-3">
                        <label>Balance</label>
                        <div class="input-container" style="position: relative;">
                            <img src="../assets/img/invoices/$.png" alt="img"
                                style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 11px; height: 24px;">
                            <input type="text" class="form-control form-cs inp" placeholder="0.00"
                                style="padding-left: 30px;">
                        </div>
                    </div>

                    <div class="col-md-3 ">
                        <label>Total Items</label>
                        <input type="text" class="form-control form-cs inp" placeholder="0">
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th style="width:57px;">Item</th>
                                <th class="thwidth">Value</th>
                                <th class="thwidth">Qty</th>
                                <th class="thwidth">Label Qty</th>
                                <th class="thwidth">Price</th>
                                <th class="thwidth">Discount</th>
                                <th class="thwidth">Ins</th>
                                <th class="thwidth">Tax%</th>
                                <th class="thwidth">Total</th>
                                <th style="width:100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="mwidth"><select class="js-example-basic-single select2 ">
                                        <option selected="selected " class="form-cs"></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>
                                    <div class="d-flex"><input type="text" class="form-control inputcolor"
                                            placeholder=""><img class="plusimg" src="../assets/img/Vector (8).png"
                                            alt="Icon"></div>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>

                                    <div class="image-container imgin">
                                        <img class="" src="../assets/img/dlt.png" alt="img">
                                        <img src="../assets/img/edit.png" alt="img">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                            <tr>
                                <td class="mwidth"><select class="js-example-basic-single select2 ">
                                        <option selected="selected " class="form-cs"></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>
                                    <div class="d-flex"><input type="text" class="form-control inputcolor"
                                            placeholder=""><img class="plusimg" src="../assets/img/Vector (8).png"
                                            alt="Icon"></div>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>

                                    <div class="image-container imgin">
                                        <img src="../assets/img/dlt.png" alt="img">
                                        <img src="../assets/img/edit.png" alt="img">
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td class="mwidth"><select class="js-example-basic-single select2 ">
                                        <option selected="selected " class="form-cs"></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>
                                    <div class="d-flex"><input type="text" class="form-control inputcolor"
                                            placeholder=""><img class="plusimg" src="../assets/img/Vector (8).png"
                                            alt="Icon"></div>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>

                                    <div class="image-container imgin">
                                        <img src="../assets/img/dlt.png" alt="img">
                                        <img src="../assets/img/edit.png" alt="img">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="mwidth"><select class="js-example-basic-single select2 ">
                                        <option selected="selected " class="form-cs"></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>
                                    <div class="d-flex"><input type="text" class="form-control inputcolor"
                                            placeholder=""><img class="plusimg" src="../assets/img/Vector (8).png"
                                            alt="Icon"></div>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor " placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td style="padding-left:0px !important">
                                    <div class="image-container imgin" style="margin-left:0px !important"><img
                                            src="../assets/img/dlt.png" alt="img"><img src="../assets/img/add.png"
                                            alt="img"><img src="../assets/img/edit.png" alt="img"></div>
                                </td>

                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex" style="background-color:#203A5F;height:105px;margin-top:20px">
                        <div><label>Subtotal</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Value</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Tax</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Discount</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Ins</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Payment</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Service Fee</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Balance</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div> <button type="submit" class="btn btn-primary invocebuttoncolor ">Submit</button></div>
                    </div>


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
    </form>


    <!-- ---------------------------- Supplies form ------------------------- -->

    <form action="{{ route('admin.OrderShipment.store') }}" id="supplies" class="hidden" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="customer_id">Customer<i class="text-danger">*</i></label>
                        </div>
                        <div class="col-md-5">
                            <select name="customer_id" class="form-control select2">
                                <option value="">Search Customer</option>
                                @foreach($customers as $customer)
                                    <option {{ old('customer_id') == $customer->id ? 'selected' : '' }}
                                        value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary buttons">
                                Add New Customer
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="customer_id">Ship To <i class="text-danger">*</i></label>
                        </div>
                        <div class="col-md-5">
                            <select class="js-example-basic-single select2">
                                <option selected="selected">Select</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary buttons">
                                Add Ship to Address
                            </a>
                        </div>
                    </div>
                </div>

            </div>


            <!-- first row end  -->
            <div class="row d-flex" style="justify-content: space-between;">
                <div class="col-6" style="padding-right: 20px;">
                    <div class="row borderset">
                        <div class="col-6">
                            <label class="foncolor" for="warehouse_name">First Name <i class="text-danger">*</i></label>
                            <input type="text" name="first_name" class="form-control inp"
                                placeholder="Enter First Name">

                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="last_name">Last Name <i class="text-danger">*</i></label>
                            <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                            <input type="text" id="mobile_code" class="form-control inp"
                                placeholder="Enter Contact Number 1" name="name">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="contact_no1">Contact No.2 <i class="text-danger">*</i></label>
                            <input type="text" id="mobile" class="form-control inp" placeholder="Enter Contact Number 2"
                                name="name">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2">
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="State">State <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2">
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>

                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2">
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                            <input type="text" name="Zip_code" class="form-control inp" placeholder="Enter Zip">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Address.1">Address 1 <i class="text-danger">*</i></label>
                            <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 1">
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Address.2">Address 2 </label>
                            <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 2">
                        </div>
                    </div>
                </div>
                <div class="col-6" style="padding-left: 20px;">
                    <div class="row borderset">
                        <div class="col-6">
                            <label class="foncolor" for="warehouse_name">Reciever First Name <i
                                    class="text-danger">*</i></label>
                            <input type="text" name="first_name" class="form-control inp"
                                placeholder="Enter First Name" disabled>

                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="last_name">Reciever Last Name <i
                                    class="text-danger">*</i></label>
                            <input type="text" name="last_name" class="form-control inp" placeholder="Enter Last Name" disabled>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="contact_no1">Contact No.1 <i class="text-danger">*</i></label>
                            <input type="text" id="mobile_code" class="form-control inp"
                                placeholder="Enter Contact Number 1" name="name" disabled>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="contact_no1">Contact No.2 <i class="text-danger">*</i></label>
                            <input type="text" id="mobile" class="form-control inp" placeholder="Enter Contact Number 2"
                                name="name" disabled>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2" disabled>
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2" disabled>
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Address.1">Address 1 <i class="text-danger">*</i></label>
                            <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 1" disabled>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Address.2">Address 2 </label>
                            <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 2" disabled>
                        </div>
                        <div class="col-6">
                            <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                            <input type="text" name="Zip_code" class="form-control inp" placeholder="Enter Zip" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <!-- both form ended
        -->
            <div>
                <div class="row bsdown">
                    <div class="col-md-3">
                        <label> Date <i class="text-danger">*</i></label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" class="btn-filters form-control form-cs inp " name="datetimes"
                                placeholder="From Date - To Date" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label>Invoice# <i class="text-danger">*</i></label>
                        <div class="input-container"
                            style="display:flex; position: relative;border: 1px solid #00000042;border-radius: 5px !important;">
                            <div style="background: #203A5F;
    width: 30px;
    height: 30px;
    margin-right: 10px;
    border-radius: 5px;
    margin-left: 4px;
    margin-block: 4px;
    color: white;
    font-size: 8px;
    align-content: center;
    text-align: center;">Auto</div>

                            <input type="text" class="form-control form-cs inp" placeholder="INV 00021"
                                style=" border:none !important">
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
                            <img src="../assets/img/invoices/$.png" alt="img"
                                style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 11px; height: 24px;">
                            <input type="text" class="form-control form-cs inp" placeholder="0.00"
                                style="padding-left: 30px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Due Date <i class="text-danger">*</i></label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" class="btn-filters  form-cs inp " name="datetimes"
                                placeholder="From Date - To Date" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label>Payment</label>
                        <div class="input-container" style="position: relative;">
                            <img src="../assets/img/invoices/$.png" alt="img"
                                style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 11px; height: 24px;">
                            <input type="text" class="form-control form-cs inp" placeholder="0.00"
                                style="padding-left: 30px;">
                        </div>
                    </div>

                    <div class="col-md-3 ">
                        <label>User</label>
                        <input type="text" class="form-control form-cs inp" placeholder="John Duo" disabled>
                    </div>
                    <div class="col-md-3">
                        <label>Container<i class="text-danger">*</i></label>
                        <select class="js-example-basic-single select2" disabled>
                            <option selected="selected " class="form-cs">Select Container</option>
                            <option>white</option>
                            <option>purple</option>
                        </select>
                    </div>
                    <div class="col-md-3 ">
                        <label>Status<i class="text-danger">*</i></label>
                        <input type="text" class="form-control form-cs inp" placeholder="Pending">
                    </div>
                    <div class="col-md-3">
                        <label>Balance</label>
                        <div class="input-container" style="position: relative;">
                            <img src="../assets/img/invoices/$.png" alt="img"
                                style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 11px; height: 24px;">
                            <input type="text" class="form-control form-cs inp" placeholder="0.00"
                                style="padding-left: 30px;">
                        </div>
                    </div>

                    <div class="col-md-3 ">
                        <label>Total Items</label>
                        <input type="text" class="form-control form-cs inp" placeholder="0">
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th style="width:57px;">Item</th>
                                <th class="thwidth">Value</th>
                                <th class="thwidth">Qty</th>
                                <th class="thwidth">Label Qty</th>
                                <th class="thwidth">Price</th>
                                <th class="thwidth">Discount</th>
                                <th class="thwidth">Ins</th>
                                <th class="thwidth">Tax%</th>
                                <th class="thwidth">Total</th>
                                <th style="width:100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="mwidth"><select class="js-example-basic-single select2 ">
                                        <option selected="selected " class="form-cs"></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>
                                    <div class="d-flex"><input type="text" class="form-control inputcolor"
                                            placeholder=""><img class="plusimg" src="../assets/img/Vector (8).png"
                                            alt="Icon"></div>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>

                                    <div class="image-container imgin">
                                        <img class="" src="../assets/img/dlt.png" alt="img">
                                        <img src="../assets/img/edit.png" alt="img">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                            <tr>
                                <td class="mwidth"><select class="js-example-basic-single select2 ">
                                        <option selected="selected " class="form-cs"></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>
                                    <div class="d-flex"><input type="text" class="form-control inputcolor"
                                            placeholder=""><img class="plusimg" src="../assets/img/Vector (8).png"
                                            alt="Icon"></div>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>

                                    <div class="image-container imgin">
                                        <img src="../assets/img/dlt.png" alt="img">
                                        <img src="../assets/img/edit.png" alt="img">
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td class="mwidth"><select class="js-example-basic-single select2 ">
                                        <option selected="selected " class="form-cs"></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>
                                    <div class="d-flex"><input type="text" class="form-control inputcolor"
                                            placeholder=""><img class="plusimg" src="../assets/img/Vector (8).png"
                                            alt="Icon"></div>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>

                                    <div class="image-container imgin">
                                        <img src="../assets/img/dlt.png" alt="img">
                                        <img src="../assets/img/edit.png" alt="img">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="mwidth"><select class="js-example-basic-single select2 ">
                                        <option selected="selected " class="form-cs"></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td>
                                    <div class="d-flex"><input type="text" class="form-control inputcolor"
                                            placeholder=""><img class="plusimg" src="../assets/img/Vector (8).png"
                                            alt="Icon"></div>
                                </td>
                                <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor " placeholder=""></td>
                                <td><input type="text" class="form-control tdbor inputcolor" placeholder=""></td>
                                <td style="padding-left:0px !important">
                                    <div class="image-container imgin" style="margin-left:0px !important"><img
                                            src="../assets/img/dlt.png" alt="img"><img src="../assets/img/add.png"
                                            alt="img"><img src="../assets/img/edit.png" alt="img"></div>
                                </td>

                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex" style="background-color:#203A5F;height:105px;margin-top:20px">
                        <div><label>Subtotal</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Value</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Tax</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Discount</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Ins</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Payment</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Service Fee</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div><label>Balance</label>
                            <input type="text" class="form-control form-cs" placeholder="0">
                        </div>
                        <div> <button type="submit" class="btn btn-primary invocebuttoncolor ">Submit</button></div>
                    </div>
                </div>
            </div>
    </form>

    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     const tabLinks = document.querySelectorAll(".tab-link");
        //     const servicesForm = document.getElementById("services-form");
        //     const suppliesForm = document.getElementById("supplies-form");

        //     tabLinks.forEach(link => {
        //         link.addEventListener("click", function (event) {
        //             event.preventDefault();

        //             tabLinks.forEach(tab => tab.classList.remove("active3"));
        //             this.classList.add("active3");

        //             if (this.dataset.tab === "services") {
        //                 servicesForm.classList.remove("hidden");
        //                 suppliesForm.classList.add("hidden");
        //             } else {
        //                 servicesForm.classList.add("hidden");
        //                 suppliesForm.classList.remove("hidden");
        //             }
        //         });
        //     });
        // });

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

        


        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            const formType = urlParams.get('id') || 'services';
            toggleLoginForm(formType);
        };
    </script>
</x-app-layout>