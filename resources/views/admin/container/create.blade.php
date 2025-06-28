<x-app-layout>

    <x-slot name="header">
        Container Management
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Container</p>
        </div>
    </x-slot>

   {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)sss
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}

    <form action="{{ route('admin.container.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block fwNormal mb-3">
                        <label for="warehouse_location" class="foncolor">Warehouse<i class="text-danger">*</i></label>
                        <select name="warehouse_name" id="warehouseSelect" class="js-example-basic-single select2">
                            <option value="">Select Warehouse </option>
                            @foreach($warehouses as $warehouse)
                            <option {{ old('warehouse_name') == $warehouse->id ? 'selected' : '' }} value="{{
                                $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Container Size -->
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-size-field">
                    <div class="input-block mb-3">
                        <label for="container_size" class="foncolor">Size</label>
                        <select name="container_size" id="container_size" class="js-example-basic-single select2">
                            <option value="">Select Size</option>
                            @foreach($containerSizes as $size)
                                <option value="{{ $size->id }}"
                                        data-volume="{{ $size->volume }}"
                                      {{ old('container_size') == $size->container_name ? 'selected' : '' }}>
                                    {{ $size->container_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('container_size')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Booking Number --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="seal_no" class="foncolor">Booking Number <i class="text-danger">*</i></label>
                        <input type="text" name="booking_number" id="booking_number" class="form-control inp"
                            placeholder="Enter Booking Number" value="{{ old('booking_number') }}">
                        @error('booking_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Container No -->
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-no-1-field">
                    <div class="input-block mb-3">
                        <label for="container_no_1" class="foncolor">Container No<i class="text-danger">*</i></label>
                        <input type="text" name="container_no_1" id="container_no_1" class="form-control inp"
                            placeholder=" Enter Container No." value="{{ old('container_no_1') }}">
                        @error('container_no_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Seal Number --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="seal_no" class="foncolor">Seal Number <i class="text-danger">*</i></label>
                        <input type="text" name="seal_no" id="seal_no" class="form-control inp"
                            placeholder="Enter Seal Number" value="{{ old('seal_no') }}">
                        @error('seal_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Bill Of Lading --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="bill_of_lading" class="foncolor">Bill Of Lading <i class="text-danger">*</i></label>
                        <input type="text" name="bill_of_lading" id="bill_of_lading" class="form-control inp"
                            placeholder="Enter Bill Of Lading" value="{{ old('bill_of_lading') }}">
                        @error('bill_of_lading')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Shipping line --}}
                @php
                    $role_id = Auth::user()->role_id;
                @endphp
                @if($role_id == 1)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="company_for_container" class="foncolor">Shipping line<i
                                    class="text-danger">*</i></label>
                            <select id="company_for_container" name="company_for_container" class="profileUpdateFont">
                                <option value="">Select Shipping line</option>
                                @foreach($viewVContainercompanys as $viewVContainercompany)
                                    <option {{ old('company_for_container') == $viewVContainercompany->name ? 'selected' : '' }}
                                        value="{{ $viewVContainercompany->name }}">
                                        {{ $viewVContainercompany->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_for_container')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @else
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="company_for_container" class="foncolor">Company For Container <i
                                    class="text-danger">*</i></label>
                            <select name="company_for_container"
                                class="js-example-basic-single select2 form-control profileUpdateFont">
                                <option value="">Select Company For Container</option>
                                @foreach($viewVContainercompanys as $viewVContainercompany)
                                    <option {{ old('company_for_container') == $viewVContainercompany->name ? 'selected' : '' }}
                                        value="{{ $viewVContainercompany->name }}">
                                        {{ $viewVContainercompany->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                {{-- Broker --}}
                @if($role_id == 1)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="broker" class="foncolor">Broker<i class="text-danger">*</i></label>
                            <select id="broker" name="broker" class="profileUpdateFont">
                                <option value="">Select Broker</option>
                                @foreach($viewBrokers as $viewBroker)
                                    <option {{ old('broker') == $viewBroker->name ? 'selected' : '' }}
                                        value="{{ $viewBroker->name }}">
                                        {{ $viewBroker->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('broker')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @else
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="broker" class="foncolor">Broker<i class="text-danger">*</i></label>
                            <select name="broker" class="profileUpdateFont">
                                <option value="">Select Broker</option>
                                @foreach($viewBrokers as $viewBroker)
                                    <option {{ old('broker') == $viewBroker->name ? 'selected' : '' }}
                                        value="{{ $viewBroker->name }}">
                                        {{ $viewBroker->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('broker')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                {{-- Trucking company --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="trucking_company" class="foncolor">Trucking Company<i
                                class="text-danger">*</i></label>
                        <input type="text" name="trucking_company" id="trucking_company" class="form-control inp"
                            placeholder="Enter trucking company" value="{{ old('trucking_company') }}">
                        @error('trucking_company')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- In Date & Time --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block fwNormal mb-3">
                        <label for="container_date_time" class="foncolor">In Date & Time</label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" name="container_date_time" style="cursor: pointer;"
                                class="btn-filters  form-cs inp" value="{{ old('container_date_time') }}"
                                placeholder="M/DD/YYYY hh:mm A" readonly style="background: #ececec;" />
                        </div>
                    </div>
                </div>

                <!-- Gate In Driver -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block fwNormal mb-3">
                        <label for="gate_in_driver_id" class="foncolor">Gate In Driver</label>
                      <select name="gate_in_driver_id" id="gateInDriver" class="js-example-basic-single select2">
                            <option value="">Select Driver </option>
                        </select>
                        @error('gate_in_driver_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Gate Out Driver -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block fwNormal mb-3">
                        <label for="gate_out_driver_id" class="foncolor">Gate Out Driver</label>
                      <select name="gate_out_driver_id" id="gateOutDriver" class="js-example-basic-single select2">
                            <option value="">Select Driver </option>
                    </select>
                        @error('gate_out_driver_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Port Of Loading --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="port_of_loading" class="foncolor">Port Of Loading<i
                                class="text-danger">*</i></label>
                        <input type="text" name="port_of_loading" id="port_of_loading" class="form-control inp"
                            placeholder="Enter port of loading" value="{{ old('port_of_loading') }}">
                        @error('port_of_loading')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Port Of Discharge --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="port_of_discharge" class="foncolor">Port Of Discharge<i
                                class="text-danger">*</i></label>
                        <input type="text" name="port_of_discharge" id="port_of_discharge" class="form-control inp"
                            placeholder="Enter port of discharge" value="{{ old('port_of_discharge') }}">
                        @error('port_of_discharge')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Celliling Date --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="celliling_date" class="foncolor">Celliling Date<i class="text-danger">*</i></label>
                        <input type="text" name="celliling_date" readonly style="cursor: pointer;"
                            class="form-control inp" value="{{ old('celliling_date') }}" placeholder="M/DD/YYYY" />
                        @error('celliling_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- ETA Date --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="eta_date" class="foncolor">ETA Date<i class="text-danger">*</i></label>
                        <input type="text" name="eta_date" readonly style="cursor: pointer;" class="form-control inp"
                            value="{{ old('eta_date') }}" placeholder="M/DD/YYYY" />
                        @error('eta_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Transit --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="transit_country" class="foncolor">Transit<i class="text-danger">*</i></label>
                        <input type="text" name="transit_country" id="transit_country" class="form-control inp"
                            placeholder="Enter transit" value="{{ old('transit_country') }}">
                        @error('transit_country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Chassis Number --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="chassis_number" class="foncolor">Chassis Number<i class="text-danger">*</i></label>
                        <input type="text" name="chassis_number" id="chassis_number" class="form-control inp"
                            placeholder="Enter chassis number" value="{{ old('chassis_number') }}">
                        @error('chassis_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Vessel/Voyage --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="vessel_voyage" class="foncolor">Vessel/Voyage</label>
                        <input type="text" name="vessel_voyage" id="vessel_voyage" class="form-control inp"
                            placeholder="Enter vessel/voyage" value="{{ old('vessel_voyage') }}">
                        @error('vessel_voyage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- TIR Number --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="tir_number" class="foncolor">TIR Number</label>
                        <input type="text" name="tir_number" id="tir_number" class="form-control inp"
                            placeholder="Enter TIR number" value="{{ old('tir_number') }}">
                        @error('tir_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Ship To Country -->
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <label class="foncolor" for="ship_to_country">Ship To Country <i class="text-danger">*</i></label>
                    <div class="widthmannual">
                    <select id="ship_to_country" name="ship_to_country" class="js-example-basic-single select2">
                       <option selected="selected" value="">Select Ship To Country</option>
                        @foreach (setting()->warehouseContries() as $country )
                        <option value="{{ $country['name'] }}" {{ old('ship_to_country') == $country['name'] ? 'selected' : '' }}>
                            {{ $country['name'] }}
                        </option>
                        @endforeach
                    </select>
                    </div>
                    @error('ship_to_country')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Doc Id -->
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-no-1-field">
                    <div class="input-block mb-3">
                        <label for="doc_id" class="foncolor">Doc Id<i class="text-danger">*</i></label>
                        <input type="text" name="doc_id" id="doc_id" class="form-control inp"
                            placeholder=" Enter Doc Id." value="{{ old('doc_id') }}">
                        @error('doc_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- volume -->
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-no-1-field">
                    <div class="input-block mb-3">
                        <label for="volume" class="foncolor">Volume<i class="text-danger">*</i></label>
                        <input type="text" name="volume" id="volume" class="form-control inp"
                            value="{{ old('volume') }}" readonly style="background-color: #e9ecef;">
                        @error('volume')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Status -->
                {{-- <div class="col-lg-4 col-md-6 col-sm-12 ps-5">
                    <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                        <div class="mb-3 float-end">
                            <label for="in_status">Status</label>
                            <div class="status-toggle d-flex align-items-center">
                                <span id="inactiveText" class="bold">Active</span>
                                <input id="status" class="check" type="checkbox" name="status">
                                <label for="status" class="checktoggle checkbox-bg togc"></label>
                                <span id="activeText">Inactive</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="add-customer-btns text-end">
            <button type="button" onclick="redirectTo('{{route('admin.warehouses.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>
            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>

    </form>

    {{-- jqury cdn --}}
    @section('script')
        <script>
            $(document).ready(function () {
                $('#company_for_container').select2({
                    tags: true,
                    placeholder: 'Select Or Type Shipping line',
                    allowClear: true
                });
            });
            $(document).ready(function () {
                $('#broker').select2({
                    tags: true,
                    placeholder: 'Select Or Type Broker',
                    allowClear: true
                });
            });
        </script>
        <script>
            $(document).ready(function () {
            $('#container_size').on('change', function () {
                const selectedOption = $(this).find('option:selected');
                const volume = selectedOption.data('volume');
                console.log('Selected volume:', volume);
                $('#volume').val(volume || '');
            });

            // Page load pe bhi value set karne ke liye:
            const selectedOption = $('#container_size').find('option:selected');
            const volume = selectedOption.data('volume');
            if (volume) {
                $('#volume').val(volume);
            }
        });

        </script>
        <script>
    $(document).ready(function () {
        $('#warehouseSelect').on('change', function () {
            var warehouseId = $(this).val();

            if (warehouseId) {
                $.ajax({
                    url: '/api/warehouse-drivers/' + warehouseId,
                    type: 'GET',
                    success: function (data) {
                        // Clear existing options
                        $('#gateInDriver').empty().append('<option value="">Select Driver</option>');
                        $('#gateOutDriver').empty().append('<option value="">Select Driver</option>');

                        // Add new driver options
                          $.each(data.data, function (key, driver) {
                            var option = '<option value="' + driver.id + '">' + driver.name + '</option>';
                            $('#gateInDriver').append(option);
                            $('#gateOutDriver').append(option);
                           });

                              // Refresh Select2 if needed
                            $('#gateInDriver').trigger('change.select2');
                            $('#gateOutDriver').trigger('change.select2');
                    }
                });
            } else {
                // Reset if no warehouse selected
                $('#gateInDriver').empty().append('<option value="">Select Driver</option>');
                $('#gateOutDriver').empty().append('<option value="">Select Driver</option>');
            }
        });
    });
</script>


    @endsection

</x-app-layout>