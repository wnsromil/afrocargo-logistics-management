<x-app-layout>
    @section('style')
    <style>

    </style>

    @endsection
    <x-slot name="header">
        Warehouse
    </x-slot>

    <x-slot name="cardTitle">
        Edit Warehouse
    </x-slot>

    <form action="{{ route('admin.warehouse_manager.update',$manager_data->id) }}" method="POST" enctype="multipart/form-data">
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
                        <label for="manager_name">Warehouse Manage Name<i class="text-danger">*</i></label>
                        <input type="text" name="manager_name" class="form-control" placeholder="Enter Warehouse Code"  value="{{$manager_data->name ?? old('manager_name') }}">
                        @error('manager_name')
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


                <!-- Status -->

                <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                    <div class="mb-3 float-end">
                        <label for="in_status">Status</label>
                        <div class="d-flex align-items-center text-dark">
                            <p class="profileUpdateFont" id="activeText">Active</p>
                            <div class="status-toggle px-2">
                                <input id="rating_6" class="check" type="checkbox" name="status" 
                                    value="Active" @checked($manager_data->status === 'Inactive') 
                                    onchange="updateStatusValue()">
                                <label for="rating_6" class="checktoggle log checkbox-bg">checkbox</label>
                            </div>
                            <p class="profileUpdateFont faded" id="inactiveText">Inactive</p>
                        </div>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="add-customer-btns text-end">

            <button type="button" onclick="redirectTo('{{route('admin.warehouse_manager.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>

            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>
    </form>
</x-app-layout>