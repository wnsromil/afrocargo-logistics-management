<x-app-layout>

    <x-slot name="header">
        Warehouse Manager
    </x-slot>

    <x-slot name="cardTitle">
       <p class="subhead">Add Warehouse Manager</p> 
    </x-slot>

    <form action="{{ route('admin.warehouse_manager.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name" class="foncolor">Warehouse Name <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                                <option {{ old('warehouse_name') == $warehouse->id ? 'selected' :'' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>

                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Warehouse Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="manager_name" class="foncolor">Warehouse Manage Name<i class="text-danger">*</i></label>
                        <input type="text" name="manager_name" class="form-control inp" placeholder="Enter Full Name" value="{{ old('manager_name') }}">
                        @error('manager_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="email" class="foncolor">E-mail <i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control inp" placeholder="Enter Contact Number"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Contact Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone" class="foncolor">Contact Number <i class="text-danger">*</i></label>
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
                        <label for="address"class="foncolor">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('address') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone" class="foncolor">Password <i class="text-danger">*</i></label>
                        <input type="text" name="password" class="form-control inp" placeholder="Enter Password"
                            value="{{ old('password') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone" class="foncolor">Confirm Password <i class="text-danger">*</i></label>
                        <input type="text" name="confirm-password" class="form-control inp" placeholder="Confirm Passowrd"
                            value="{{ old('confirm-password') }}">
                        @error('confirm-password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status" class="foncolor">Status <i class="text-danger">*</i></label>
                        <!-- <div class="toggle-switch">
                            <label for="cb-switch">
                                <input type="checkbox" id="cb-switch" name="status" value="Active">
                                <span>
                                    <small></small>
                                </span>
                            </label>
                        </div> -->


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
           
           <button type="button" onclick="redirectTo('{{route('admin.warehouses.index') }}')" class="btn btn-outline-primary custom-btn">Cancel</button> 
          
                <button type="submit" class="btn btn-primary ">Submit</button>
                
           </div>
    </form>
</x-app-layout>