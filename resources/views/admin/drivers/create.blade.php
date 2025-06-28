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
                        <select name="warehouse_name" id="warehouseSelect" class="form-control inp select2">
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
                        <div class="flaginputwrap">
                            <div class="customflagselect">
                                <select class="flag-select" name="mobile_number_code_id">
                                    @foreach ($coutry as $key => $item)
                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                            data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                            {{ $item->name }} +{{ $item->phonecode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control flagInput inp" placeholder="Enter Contact Number"
                                name="mobile_number" value="{{ old('mobile_number') }}"
                                oninput="this.value = this.value.slice(0, 10)">
                        </div>
                        @error('mobile_number')
                            <small class="text-danger">The Contact Number field is required.</small>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="phone">Office Contact Number <i class="text-danger">*</i></label>
                        <div class="flaginputwrap">
                            <div class="customflagselect">
                                <select class="flag-select" name="alternative_mobile_number_code_id">
                                    @foreach ($coutry as $key => $item)
                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                            data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                            {{ $item->name }} +{{ $item->phonecode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control flagInput inp"
                                placeholder="Enter Office Contact Number" name="alternative_mobile_number"
                                value="{{ old('alternative_mobile_number') }}"
                                oninput="this.value = this.value.slice(0, 10)">
                        </div>
                        @error('alternative_mobile_number')
                            <small class="text-danger">The Office Contact Number field is required.</small>
                        @enderror
                    </div>
                </div>

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

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="address_1">Address <i class="text-danger">*</i></label>
                        <input type="text" name="address_1" class="form-control inp" placeholder="Enter Address"
                            value="{{ old('address_1') }}">
                        @error('address_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="vehicle_type">Vehicle</label>
                        <select name="vehicle_type" id="vehicleSelect" class="form-control inp select2">
                            <option value="">Select Vehicle</option>
                        </select>
                        @error('vehicle_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- license Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_number">License Number<i class="text-danger">*</i></label>
                        <input type="text" name="license_number" class="form-control inp" placeholder="Enter License"
                            value="{{ old('license_number') }}">
                        @error('license_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_expiry_date">License Expiry Date<i
                                class="text-danger">*</i></label>
                        <input type="text" name="license_expiry_date" class="form-control inp"
                            placeholder="Select Expiry Date" value="{{ old('license_expiry_date') }}">
                        @error('license_expiry_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="license_document">License Document<i
                                class="text-danger">*</i></label>
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
                            <span>Active</span>
                            <input id="rating_1" name="status" class="check" type="checkbox" value="Active">
                            <label for="rating_1" class="checktoggle checkbox-bg"></label>
                            <span class="inactive">Inactive</span>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="latitude" value="{{ old('latitude') }}"
                    class="form-control inp inputbackground" placeholder="0" readonly style="background: #ececec;">
                <input type="hidden" name="longitude" value="{{ old('longitude') }}"
                    class="form-control inp inputbackground" placeholder="0" readonly style="background: #ececec;">


                <input type="hidden" name="country" value="{{ old('country') }}" class="form-control inp" readonly
                    style="background: #ececec;">
            </div>
        </div>

        <div class="add-customer-btns text-end">

            <button type="button" onclick="redirectTo('{{ route('admin.drivers.index') }}')"
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
        <script>
            $(document).ready(function () {
                $('#warehouseSelect').on('change', function () {
                    var warehouseId = $(this).val();

                    if (warehouseId) {
                        $.ajax({
                            url: '/api/warehouse-vehicles/' + warehouseId,
                            type: 'GET',
                            success: function (response) {
                                let vehicles = response.data;
                                $('#vehicleSelect').empty().append('<option value="">Select Vehicle</option>');

                                $.each(vehicles, function (key, vehicle) {
                                    let vehicleLabel = vehicle.vehicle_type.id == 1
                                        ? vehicle.container_no_1
                                        : vehicle.vehicle_number ?? 'N/A';

                                    let vehicleTypeText = vehicle.vehicle_type.id == 1 ? 'Container' : vehicle.vehicle_type.name;

                                    let option = '<option value="' + vehicle.id + '">' +
                                        vehicleTypeText + ' (' + vehicleLabel + ')' +
                                        '</option>';

                                    $('#vehicleSelect').append(option);
                                });

                                // Refresh select2
                                $('#vehicleSelect').trigger('change.select2');
                            },
                            error: function () {
                                $('#vehicleSelect').empty().append('<option value="">No Vehicle Found</option>');
                            }
                        });
                    } else {
                        $('#vehicleSelect').empty().append('<option value="">Select Vehicle</option>');
                    }
                });
            });
        </script>

    @endsection

</x-app-layout>