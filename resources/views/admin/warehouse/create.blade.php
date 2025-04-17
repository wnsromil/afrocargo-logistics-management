<x-app-layout>
    @section('style')
        <style>
            /*----------- BUTTON ----------*/
            .btn-holder {
                width: 400px;
                height: 300px;
                margin: 50px auto 0;
            }

            .btn-lg.btn-toggle {
                padding: 0;
                margin: 0 5rem;
                position: relative;
                height: 2.5rem;
                width: 6rem;
                border-radius: 3rem;
                color: #6b7381;
                background: #bdc1c8;
                margin-bottom: 30px;
            }

            .btn-toggle.btn-lg>.switch {
                position: absolute;
                top: 0.2rem;
                left: 0.1rem;
                width: 2rem;
                color: #6b7381;
                background: #bdc1c8;
                margin-bottom: 30px;
                height: 2rem;
                border-radius: 1.875rem;
                background: #fff;
                transition: left .25s;
            }

            .btn-toggle.active {
                background-color: #ff8800;
            }

            .btn-toggle.btn-lg.active>.switch {
                color: #6b7381;
                background: #bdc1c8;
                margin-bottom: 30px;
                left: 3.75rem;
                transition: left .25s;
            }

            .btn-lg.btn-toggle::before {
                content: "Inactive";
                right: -5rem;
                opacity: 0.5;
                line-height: 2.5rem;
                width: 5rem;
                text-align: center;
                color: #6b7381;
                background: #bdc1c8;
                margin-bottom: 30px;
                font-weight: 600;
                font-size: 1rem;
                letter-spacing: 2px;
                position: absolute;
                bottom: 0;
                transition: opacity .25s;
            }

            .btn-lg.btn-toggle:after {
                content: "Active";
                right: -5rem;
                color: #6b7381;
                background: #bdc1c8;
                margin-bottom: 30px;
                opacity: 0.5;
                line-height: 2.5rem;
                width: 5rem;
                text-align: center;
                font-weight: 600;
                font-size: 1rem;
                letter-spacing: 2px;
                position: absolute;
                bottom: 0;
                transition: opacity .25s;
            }

            .btn-lg.btn-toggle.active:after {
                opacity: 1;
            }

            /*------------ CHECKBOX -------------*/
            .toggle-switch {
                margin: 0 auto;
                width: 241px;
                margin-top: 20px;
                position: relative;
            }

            .toggle-switch label {
                padding: 0;
            }

            input#cb-switch {
                display: none;
            }

            .toggle-switch label input+span {
                position: relative;
                display: inline-block;
                margin-right: 10px;
                width: 6rem;
                height: 2.5rem;
                background: #bdc1c8;
                border: 1px solid #eee;
                border-radius: 50px;
                transition: all 0.3s ease-in-out;
                box-shadow: inset 0 0 5px #828282;
            }

            .toggle-switch label input+span small {
                position: absolute;
                display: block;
                width: 2rem;
                height: 2rem;
                border-radius: 1.875rem;
                background: #fff;
                transition: all 0.3s ease-in-out;
                top: 0.2rem;
                left: 0.2rem;
            }

            .toggle-switch label input:checked+span {
                background-color: #ff8800;
            }

            .toggle-switch label input:checked+span small {
                left: 3.7rem;
                transition: left .25s;
            }

            .toggle-switch span:after {
                content: "Active";
                line-height: 2.5rem;
                width: 5rem;
                text-align: center;
                font-weight: 600;
                font-size: 1rem;
                letter-spacing: 2px;
                position: absolute;
                bottom: 0;
                transition: opacity .25s;
                left: 6rem;
                opacity: 0.5;
                color: #6b7381;
            }

            .toggle-switch label input:checked+span:after {
                opacity: 1;
            }
        </style>
    @endsection
    <x-slot name="header">
        Add Warehouse
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Warehouse</p>
        </div>
    </x-slot>

    <form action="{{ route('admin.warehouses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3 ">
                        <label class="foncolor divform" for="warehouse_name">Warehouse Name <i
                                class="text-danger">*</i></label>
                        <input type="text" name="warehouse_name" class="form-control inp"
                            placeholder="Enter Warehouse Name" value="{{ old('warehouse_name') }}">
                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Warehouse Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor divform" for="warehouse_code">Warehouse Code <i
                                class="text-danger">*</i></label>
                        <input type="text" name="warehouse_code" class="form-control inp"
                            placeholder="Enter Warehouse Code" value="{{ old('warehouse_code') }}">
                        @error('warehouse_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor divform" for="address">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('address') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor divform" for="country_id">Country <i class="text-danger">*</i></label>
                        <select name="country_id" id="country"
                            class="form-control  form-cs js-example-basic-single select2 ">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                <!-- State -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor divform" for="state_id">State <i class="text-danger">*</i></label>
                        <select name="state_id" id="state" class="form-control inp select2">
                            <option value="">Select State</option>
                            @if (old('state_id'))
                                <option value="{{ old('state_id') }}" selected>{{ old('state_id') }}</option>
                            @endif
                        </select>
                        @error('state_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- City -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor divform" for="city_id">City <i class="text-danger">*</i></label>
                        <select name="city_id" id="city" class="form-control inp select2">
                            <option value="">Select City</option>
                            @if (old('city_id'))
                                <option value="{{ old('city_id') }}" selected>{{ old('city_id') }}</option>
                            @endif
                        </select>
                        @error('city_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Zip Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor divform" for="zip_code">Zip Code <i class="text-danger">*</i></label>
                        <input type="text" name="zip_code" class="form-control inp" placeholder="Enter Zip Code"
                            value="{{ old('zip_code') }}">
                        @error('zip_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                    <div class="col-lg-4 col-md-6 col-sm-12 custom-zindex">
    <label class="foncolor" for="mobile_code">Contact Number<span class="text-danger">*</span></label> 
    <input type="tel" id="alternate_mobile_no" name="mobile_code" class="form-control inp" placeholder="Enter Contact No."> 
    @error('mobile_code') 
        <span class="text-danger">{{ $message }}</span> 
    @enderror 
    <input type="hidden" id="country_code" name="country_code">
</div>

                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor divform" for="in_status">Status</label>
                        <div class="d-flex align-items-center text-dark">
                            <p class="profileUpdateFont" id="activeText">Active</p>
                            <div class="status-toggle px-2">
                                <input id="rating_6" class="check" type="checkbox" value="Inactive">
                                <label for="rating_6" class="checktoggle log checkbox-bg">checkbox</label>
                            </div>
                            <p class="profileUpdateFont faded" id="inactiveText">Inactive</p>
                        </div>

                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
            </div>
        </div>

        <div class="add-customer-btns text-end">

            <button type="button" onclick="redirectTo('{{ route('admin.warehouses.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>

            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>
    </form>

    @section('script')
        <script>
            $('#country_code').val($('.iti').find('.iti__selected-dial-code').text());
            $('.col-sm-12').on('click', () => {
                $('#country_code').val($('.iti').find('.iti__selected-dial-code').text());
            })
        </script>
    @endsection

</x-app-layout>