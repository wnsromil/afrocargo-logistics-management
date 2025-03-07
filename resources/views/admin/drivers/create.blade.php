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
                        <input type="text" name="phone" class="form-control inp" placeholder="Enter Contact Number"
                            value="{{ old('phone') }}">
                        @error('phone')
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

                <!-- Password -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="phone">Password <i class="text-danger">*</i></label>
                        <input type="text" name="password" class="form-control inp" placeholder="Enter Password"
                            value="{{ old('password') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label  class="foncolor" for="phone">Confirm Password <i class="text-danger">*</i></label>
                        <input type="text" name="confirm-password" class="form-control inp"
                            placeholder="Confirm Passowrd" value="{{ old('confirm-password') }}">
                        @error('confirm-password')
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
                                    value="{{ $Vehicle->id }}">{{ $Vehicle->vehicle_type }}</option>
                            @endforeach
                        </select>
                        @error('vehicle_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_number">License Number<i class="text-danger">*</i></label>
                        <input type="text" name="license_number" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('license_number') }}">
                        @error('license_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label  class="foncolor" for="license_expiry_date">License Expiry Date<i class="text-danger">*</i></label>
                        <input type="date" name="license_expiry_date" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('license_expiry_date') }}">
                        @error('license_expiry_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_document">License Document<i class="text-danger">*</i></label>
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
    <span >Active</span>
    <input id="rating_1" class="check" type="checkbox" checked>
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
           
           <button type="button" onclick="{{ route('admin.warehouses.index') }}" class="btn btn-outline-primary custom-btn">Cancel</button> 
               
                <button type="submit" class="btn btn-primary ">Submit</button>
                
           </div>
    </form>
</x-app-layout>