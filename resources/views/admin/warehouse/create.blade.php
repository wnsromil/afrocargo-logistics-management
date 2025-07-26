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

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

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
                        <input type="text" name="address_1" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('address_1') }}">
                        @error('address_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
                        <input type="text" name="country" value="{{ old('country') }}" class="form-control inp" readonly
                            style="background: #ececec;">
                        @error('country')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                </div>

                <!-- State -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="state">State <i class="text-danger">*</i></label>
                        <input type="text" name="state" value="{{ old('state') }}" class="form-control inp"
                            placeholder="" readonly style="background: #ececec;">
                        @error('state')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- City -->
                <div class="col-lg-4 col-md-6 col-sm-12 hidden_City">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
                        <input type="text" name="city" value="{{ old('city') }}" class="form-control inp" placeholder=""
                            readonly style="background: #ececec;">
                        @error('city')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Zip Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="Zip_code">Zipcode</label>
                        <input type="text" name="Zip_code" value="{{ old('Zip_code') }}" class="form-control inp"
                            placeholder="Enter Zip">
                        @error('Zip_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>



                <div class="col-lg-4 col-md-6 col-sm-12 custom-zindex">
                    <label class="foncolor" for="mobile_code">Contact Number<span class="text-danger">*</span></label>
                    <div class="flaginputwrap">
                        <div class="customflagselect">
                            <select class="flag-select" name="mobile_number_code_id">
                                @foreach ($coutry as $key => $item)
                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                        data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                        data-length="{{ $item->phone_length ?? 10 }}"
                                        {{ old('mobile_number_code_id') == $item->id ? 'selected' : '' }}
                                        >
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
        <input type="hidden" name="latitude" value="{{ old('latitude') }}" class="form-control inp inputbackground"
            placeholder="0" readonly style="background: #ececec;">
        <input type="hidden" name="longitude" value="{{ old('longitude') }}" class="form-control inp inputbackground"
            placeholder="0" readonly style="background: #ececec;">


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
            $(document).ready(function () {
                var oldState = "{{ old('state_id') }}"; // Laravel old value
                var oldCity = "{{ old('city_id') }}";

                // ✅ Agar old state available hai toh state ke cities load kare
                if (oldState) {
                    $('#state').html('<option selected="selected">Loading...</option>');
                    $.ajax({
                        url: '/api/get-states/' + $('#country').val(),
                        type: 'GET',
                        success: function (states) {
                            $('#state').html('<option selected="selected">Select State</option>');
                            $.each(states, function (key, state) {
                                var selected = (state.id == oldState) ? 'selected' : ''; // ✅ Old value match kare
                                $('#state').append('<option value="' + state.id + '" ' + selected + '>' + state.name + '</option>');
                            });

                            // ✅ Agar old city available hai, toh cities load kare
                            // if (oldCity) {
                            $('#city').html('<option selected="selected">Loading...</option>');
                            $.ajax({
                                url: '/api/get-cities/' + oldState,
                                type: 'GET',
                                success: function (cities) {
                                    if (cities.length === 0) {
                                        console.log("if");
                                        $('.hidden_City').addClass('d-none'); // Bootstrap hidden class
                                        $('#city').html('<option value="">No cities available</option>');
                                    } else {
                                        console.log("else");
                                        $('.hidden_City').removeClass('d-none');
                                        $('#city').html('<option value="">Select City</option>');
                                        $.each(cities, function (index, city) {
                                            $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                                        });
                                    }
                                }
                            });
                            //  }
                        }
                    });
                }
            });
        </script>
    @endsection
</x-app-layout>