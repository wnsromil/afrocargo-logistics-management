<x-app-layout>
    <x-slot name="header">
        Parcel Management
    </x-slot>

    <x-slot name="cardTitle">
        <p>Send Notification</p>
       
    </x-slot>
    <p>Notification For</p>




    <div class="tabs">
  <!-- Radio buttons for tab control -->
  <input type="radio" id="tab1" name="tab" checked>
  <input type="radio" id="tab2" name="tab">
  <input type="radio" id="tab3" name="tab">
  <input type="radio" id="tab4" name="tab">

  <!-- Tab titles (labels) -->
  <!-- <div class="tab-titles">
    <label for="tab1" class="tab-title">All</label>
    <label for="tab2" class="tab-title">Warehouses</label>
    <label for="tab3" class="tab-title">Users</label>
    <label for="tab4" class="tab-title">Driver</label>
  </div> -->

  <div class="tab-titles">
  <label for="tab1" class="tab-title">All</label>
  <label for="tab2" class="tab-title">Warehouses</label>
  <label for="tab3" class="tab-title">Users</label>
  <label for="tab4" class="tab-title">Driver</label>
</div>


  <!-- Tab content sections -->
  <div class="tab-content" id="content1">
    <!-- <h2>Content for Tab 1</h2>
    <p>This is the content of the first tab.</p> -->
    <div class="col-lg-7 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor"> Notification Title<i class="text-danger">*</i></label>
                        <input type="text" name="notification_title" class="form-control inp" placeholder="Enter Notification Title">
                    </div>
                    </div>
                    <div class="col-lg-11 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor"> Notification Message<i class="text-danger">*</i></label>
                        <input type="text" name="notification_message" class="form-control inp" style="height: 98px !important;width: 677px;"placeholder="Enter Your Notification Message">
                    </div>
                    </div>
 
                    <div class="ptop d-flex">
                <div>
                    <div class="input-block mb-3">
                        <label class="foncolor" for="status">Status</label>

                        <div class="status-toggle">
                            <span>Active</span>
                            <input id="status" class="check" type="checkbox" name="status" checked>
                            <label for="status" class="checktoggle checkbox-bg togc"></label>
                            <span class="">Inactive</span>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                <div style="margin-top:22px;">
                    <div class="add-customer-btns ">

                        <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>

                        <button type="submit" class="btn btn-primary ">Submit</button>

                    </div>
                </div>




            </div>
              

  </div>

  <div class="tab-content" id="content2" style="padding:0">
  <div class="col-lg-7 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name" class="foncolor">Warehouse  <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse </option>
                               <option></option>
                               <option></option>
                        </select>
                    </div>
                </div>
  </div>

  <div class="tab-content" id="content3">
    <h2>Content for Tab 3</h2>
    <p>This is the content of the third tab.</p>
  </div>
  <div class="tab-content" id="content4">
    <h2>Content for Tab 4</h2>
    <p>This is the content of the four tab.</p>
  </div>
</div>

<!-- 
    <form action="{{ route('admin.OrderShipment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row"> -->

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
        </div>
    </form> -->
</x-app-layout>
