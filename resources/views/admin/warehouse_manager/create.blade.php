<x-app-layout>

    <x-slot name="header">
        Add Warehouse Manager
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Warehouse Manager</p>
        </div>
    </x-slot>
    <form action="{{ route('admin.warehouse_manager.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name" class="foncolor">Warehouse Name <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="js-example-basic-single select2">
                            <option value="">Select Warehouse </option>
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

                <!-- Warehouse Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="manager_name" class="foncolor">Warehouse Manager Name<i
                                class="text-danger">*</i></label>
                        <input type="text" name="manager_name" class="form-control inp" placeholder="Enter Full Name"
                            value="{{ old('manager_name') }}">
                        @error('manager_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="address" class="foncolor">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address_1" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('address_1') }}">
                        @error('address_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Email -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="email" class="foncolor">Email ID<i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control inp" placeholder="Enter Email Id"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Contact Number -->
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone" class="foncolor">Contact Number <i class="text-danger">*</i></label>
                        <input type="text" name="phone" class="form-control inp" placeholder="Enter Contact No."
                            value="{{ old('phone') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

                <div class="col-lg-4 col-md-6 col-sm-12 mobile_code">
                    <label class="foncolor" for="mobile_code">Mobile No.<span class="text-danger">*</span></label>
                    <div class="flaginputwrap">
                        <div class="customflagselect">
                            <select class="flag-select" name="mobile_number_code_id">
                                @foreach ($coutry as $key => $item)
                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                        data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                        data-length="{{ $item->phone_length ?? 10 }}"
                                        {{ $item->id == old('mobile_number_code_id') ? 'selected' : '' }}>
                                        {{ $item->name }} +{{ $item->phonecode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No"
                            name="mobile_number" value="{{ old('mobile_number') }}"
                            >
                    </div>
                    @error('mobile_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                    <div class="mb-3 float-end">
                        <label for="in_status">Status</label>
                        <div class="d-flex align-items-center text-dark">
                            <p class="profileUpdateFont" id="activeText">Active</p>
                            <div class="status-toggle px-2">
                                <input id="rating_16" class="check" type="checkbox" value="Inactive">
                                <label for="rating_16" class="checktoggle tog-circle checkbox-bg">checkbox</label>
                            </div>
                            <p class="profileUpdateFont faded" id="inactiveText">Inactive</p>
                        </div>

                    </div>
                    {{-- change status --}}
                    <input id="status" class="check" name="status" type="hidden" value="Active">
                </div>
            </div>
        </div>
        <input type="hidden" name="country" value="{{ old('country') }}" class="form-control inp" readonly
            style="background: #ececec;">

        <div class="add-customer-btns text-end">

            <button type="button" onclick="redirectTo('{{route('admin.warehouse_manager.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>

            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>
    </form>
    @section('script')
        <script>
            $('#country_code').val($('.mobile_code').find('.iti__selected-dial-code').text());
            $('.col-md-12').on('click', () => {
                $('#country_code').val($('.mobile_code').find('.iti__selected-dial-code').text());
            })
        </script>
    @endsection
</x-app-layout>