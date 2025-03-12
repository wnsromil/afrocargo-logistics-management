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
            height: 2rem;
            border-radius: 1.875rem;
            background: #fff;
            transition: left .25s;
        }

        .btn-toggle.active {
            background-color: #ff8800;
        }

        .btn-toggle.btn-lg.active>.switch {
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
        Warehouse
    </x-slot>

    <x-slot name="cardTitle">
        Edit Warehouse
    </x-slot>

    <form action="{{ route('admin.warehouses.update',$warehouse->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name">Warehouse Name <i class="text-danger">*</i></label>
                        <input type="text" name="warehouse_name" class="form-control" placeholder="Enter Warehouse Name"
                            value="{{$warehouse->warehouse_name ?? old('warehouse_name') }}">
                        @error('warehouse_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Warehouse Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_code">Warehouse Code <i class="text-danger">*</i></label>
                        <input type="text" name="warehouse_code" class="form-control" placeholder="Enter Warehouse Code"
                            value="{{ $warehouse->warehouse_code ?? old('warehouse_code') }}">
                        @error('warehouse_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="address">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address"
                            value="{{ $warehouse->address ?? old('address') }}">
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Country -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="country_id">Country <i class="text-danger">*</i></label>

                        <select name="country_id" id="country" class="form-control select2">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                            <option {{$warehouse->country_id == $country->id ? 'selected':''}} value="{{ $country->id }}">{{ $country->name }}</option>
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
                        <label for="state_id">State <i class="text-danger">*</i></label>
                        <select name="state_id" id="state" class="form-control select2">
                            <option value="">Select State</option>
                        </select>
                        @error('state_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- City -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="city_id">City <i class="text-danger">*</i></label>
                        <select name="city_id" id="city" class="form-control select2">
                            <option value="">Select City</option>
                        </select>
                        @error('city_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Zip Code -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="zip_code">Zip Code <i class="text-danger">*</i></label>
                        <input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code"
                        value="{{ $warehouse->zip_code ?? old('zip_code') }}">
                        @error('zip_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Contact Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="phone">Contact Number <i class="text-danger">*</i></label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Contact Number"
                        value="{{ $warehouse->phone ?? old('phone') }}">
                        @error('phone')
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
                                <input type="checkbox" id="cb-switch" name="status" {{ $warehouse->status =='Active' ? 'checked':'' }} value="Active">
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
            <a href="{{ route('admin.warehouses.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save">Submit</button>
        </div>
    </form>

      {{-- jqury cdn --}}
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
             var selectedCountry = "{{ $warehouse->country_id }}"; 
             var selectedState = "{{ $warehouse->state_id }}"; 
             var selectedCity = "{{ $warehouse->city_id }}";
 
 
             // Load States Automatically
             if (selectedCountry) {
                 $.ajax({
                     url: "{{ url('api/get-states') }}/" + selectedCountry,
                     method: "GET",
                     success: function(response) {
                        //  $('#state').append('<option value="">Select State</option>');
                         $.each(response, function(key, value) {
                             let selected = (value.id == selectedState) ? 'selected' : '';
                             $('#state').append(
                                 `<option value="${value.id}" ${selected}>${value.name}</option>`
                                 );
                         });
 
                         // 🔥 Automatically Load Cities When State is Selected
                         if (selectedState) {
                             loadCities(selectedState);
                         }
                     }
                 });
             }
 
             //  On State Change Load Cities
             $('#state').on('change', function() {
                 var stateId = $(this).val();
                 loadCities(stateId);
             });
 
             function loadCities(stateId) {
                 $.ajax({
                     url: "{{ url('api/get-cities') }}/" + stateId,
                     method: "GET",
                     success: function(response) {
                         $('#city').html('<option value="">Select City</option>');
                         $.each(response, function(key, value) {
                             let selected = (value.id == selectedCity) ? 'selected' : '';
                             $('#city').append(
                                 `<option value="${value.id}" ${selected}>${value.name}</option>`
                                 );
                         });
                     }
                 });
             }
         });
     </script>
</x-app-layout>