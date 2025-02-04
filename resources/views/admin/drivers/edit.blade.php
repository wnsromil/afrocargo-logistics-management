<x-app-layout>
    <x-slot name="header">
        Drivers Management
    </x-slot>

    <x-slot name="cardTitle">
        Edit Driver
    </x-slot>

    <form action="{{ route('admin.drivers.update',$manager_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name">Warehouse Name <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                                <option {{ $manager_data->warehouse_id ?? old('warehouse_name')  == $warehouse->id ? 'selected' :'' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
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
                        <label for="driver_name">Driver Name<i class="text-danger">*</i></label>
                        <input type="text" name="driver_name" class="form-control" placeholder="Enter Warehouse Code"  value="{{$manager_data->name ?? old('driver_name') }}">
                        @error('driver_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="email">E-mail <i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Contact Number"
                            value="{{$manager_data->email ?? old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Contact Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone">Contact Number <i class="text-danger">*</i></label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Contact Number"
                        value="{{$manager_data->phone ?? old('phone') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="address">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address"
                        value="{{$manager_data->address ?? old('address') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone">Password <i class="text-danger">*</i></label>
                        <input type="text" name="password" class="form-control" placeholder="Enter Contact Number"
                            value="{{ old('password') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone">Confirm Password <i class="text-danger">*</i></label>
                        <input type="text" name="confirm-password" class="form-control" placeholder="Enter Contact Number"
                            value="{{ old('confirm-password') }}">
                        @error('confirm-password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Vehicle<i class="text-danger">*</i></label>
                        <select name="vehicle_type" class="form-control">
                            <option value="">Select Vehicle</option>
                            @foreach($Vehicle_data as $Vehicle)
                                <option {{ $manager_data->vehicle_type == $Vehicle->id ? 'selected' : '' }}
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
                        <label for="license_number">License Number<i class="text-danger">*</i></label>
                        <input type="text" name="license_number" class="form-control" placeholder="Enter Address"
                            value="{{ $manager_data->license_number }}">
                        @error('license_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="license_expiry_date">License Expiry Date<i class="text-danger">*</i></label>
                        <input type="date" name="license_expiry_date" class="form-control" placeholder="Enter Address"
                            value="{{ $manager_data->license_expiry_date  }}">
                        @error('license_expiry_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="license_document">License Document<i class="text-danger">*</i></label>
                        <input type="file" name="license_document" class="form-control" placeholder="Enter Address"
                            value="{{ old('license_document') }}">
                        @error('license_document')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status">Status <i class="text-danger">*</i></label>
                        <div class="toggle-switch">
                            <label for="cb-switch">
                                <input type="checkbox" id="cb-switch" name="status" value="Active" @checked($manager_data->status === 'Active')>
                                <span>
                                    <small></small>
                                </span>
                            </label>
                        </div>


                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="add-customer-btns text-end">
            <a href="{{ route('admin.warehouse_manager.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save">Submit</button>
        </div>
    </form>
</x-app-layout>