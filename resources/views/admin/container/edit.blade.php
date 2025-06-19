<x-app-layout>

    <x-slot name="header">
        Container Management
    </x-slot>


    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Edit Container</p>
        </div>
    </x-slot>
    
{{-- 
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)sss
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  --}}

    <form action="{{ route('admin.container.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                  {{-- Container ID --}}
                 <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="company_name"> Container ID</label>
                        <input type="text" class="form-control inp" id="unique_id" name="unique_id" style="background: #ececec;" placeholder=""
                            value="{{ $vehicle->unique_id }}" readonly style="background: #ececec;">
                    </div>
                </div>
                
                {{-- Warehouse Name --}}
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block fwNormal mb-3">
                        <label for="warehouse_location" class="foncolor">Warehouse<i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="js-example-basic-single select2">
                            <option value="">Select Warehouse </option>
                            @foreach($warehouses as $warehouse)
                                                    <option {{ old('warehouse_name', $vehicle->warehouse_id) == $warehouse->id ? 'selected' : '' }} value="{{
                                $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                 {{-- Container Size --}}
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-size-field">
                    <div class="input-block mb-3">
                        <label for="container_size" class="foncolor">Size</label>
                        <select name="container_size" id="container_size" class="js-example-basic-single select2">
                        @foreach($containerSizes as $size)
                          <option value="{{ $size->id }}"
                            data-volume="{{ $size->volume }}"
                            {{ old('container_size', $vehicle->container_size) == $size->id ? 'selected' : '' }}>
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
                            placeholder="Enter Booking Number" value="{{ old('booking_number', $vehicle->booking_number) }}">
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
                            placeholder=" Enter Container No." value="{{ old('container_no_1', $vehicle->container_no_1) }}">
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
                            placeholder="Enter Seal Number" value="{{ old('seal_no', $vehicle->seal_no) }}">
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
                            placeholder="Enter Bill Of Lading" value="{{ old('bill_of_lading', $vehicle->bill_of_lading) }}">
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
                            <label for="company_for_container" class="foncolor">Shipping line <i
                                    class="text-danger">*</i></label>
                            <select id="company_for_container" name="company_for_container" class="profileUpdateFont">
                                <option value="">Select Shipping line</option>
                                @foreach($viewVContainercompanys as $viewVContainercompany)
                                    <option {{ old('company_for_container', $vehicle->containerCompany->name) == $viewVContainercompany->name ? 'selected' : '' }}
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
                                <option {{ old('company_for_container',$vehicle->containerCompany->name) == $viewVContainercompany->name ? 'selected' : '' }}
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
                @endif

                {{-- Broker --}}
                @if($role_id == 1)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="broker" class="foncolor">Broker<i class="text-danger">*</i></label>
                            <select id="broker" name="broker" class="profileUpdateFont">
                                <option value="">Select Broker</option>
                                @foreach($viewBrokers as $viewBroker)
                                    <option {{ old('broker', $vehicle->brokerData->name) == $viewBroker->name ? 'selected' : '' }}
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
                                    <option {{ old('broker', $vehicle->broker->name) == $viewBroker->name ? 'selected' : '' }}
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
                            placeholder="Enter trucking company" value="{{ old('trucking_company', $vehicle->trucking_company) }}">
                        @error('trucking_company')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- In Date & Time --}}
                 {{-- @php
                    $defaultDateTime = old('edit_container_date_time');
                    if (!$defaultDateTime && isset($vehicle->container_in_date, $vehicle->container_in_time)) {
                        $defaultDateTime = \Carbon\Carbon::parse($vehicle->container_in_date . ' ' . $vehicle->container_in_time)->format('m/d/Y h:i A');
                    }
                @endphp

                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <label class="foncolor mt-0 pt-0">In Date & Time</label>
                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                        <input type="text" name="edit_container_date_time" style="cursor: pointer; background: #ececec;"  readonly
                            class="btn-filters form-cs inp"
                            value="{{ $defaultDateTime }}"
                            placeholder="M/DD/YYYY hh:mm A" />
                    </div>
                </div> --}}

                {{-- Chassis Number --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="chassis_number" class="foncolor">Chassis Number<i class="text-danger">*</i></label>
                        <input type="text" name="chassis_number" id="chassis_number" class="form-control inp"
                            placeholder="Enter chassis number" value="{{ old('chassis_number', $vehicle->chassis_number) }}">
                        @error('chassis_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Vessel/Voyage --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="vessel_voyage" class="foncolor">Vessel/Voyage<i class="text-danger">*</i></label>
                        <input type="text" name="vessel_voyage" id="vessel_voyage" class="form-control inp"
                            placeholder="Enter vessel/voyage" value="{{ old('vessel_voyage',  $vehicle->vessel_voyage) }}">
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
                            placeholder="Enter TIR number" value="{{ old('tir_number',  $vehicle->tir_number) }}">
                        @error('tir_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Ship To Country --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <label class="foncolor" for="ship_to_country">Ship To Country <i class="text-danger">*</i></label>
                    <div class="widthmannual">
                         <select id="country" name="ship_to_country" class="js-example-basic-single select2">
                                <option value="" disabled hidden {{ old('ship_to_country', $vehicle->ship_to_country) ? '' : 'selected' }}>Select Country</option>
                                <option value="Bangladesh" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                <option value="Belgium" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                <option value="Kuwait" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                <option value="Dominica" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                                <option value="India" {{ old('ship_to_country', $vehicle->ship_to_country) == 'India' ? 'selected' : '' }}>India</option>
                                <option value="Dominican Republic" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                <option value="Andorra" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                <option value="Chile" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Chile' ? 'selected' : '' }}>Chile</option>
                                <option value="United States" {{ old('ship_to_country', $vehicle->ship_to_country) == 'United States' ? 'selected' : '' }}>United States</option>
                                <option value="Greenland" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Greenland' ? 'selected' : '' }}>Greenland</option>
                                <option value="Cabo Verde" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Cabo Verde' ? 'selected' : '' }}>Cabo Verde</option>
                                <option value="Côte d'Ivoire" {{ old('ship_to_country', $vehicle->ship_to_country) == "Côte d'Ivoire" ? 'selected' : '' }}>Côte d'Ivoire</option>
                                <option value="Mali" {{ old('ship_to_country', $vehicle->ship_to_country) == 'Mali' ? 'selected' : '' }}>Mali</option>
                                <option value="European Union" {{ old('ship_to_country', $vehicle->ship_to_country) == 'European Union' ? 'selected' : '' }}>European Union</option>
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
                            placeholder=" Enter Doc Id." value="{{ old('doc_id', $vehicle->doc_id) }}">
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
                            value="{{ old('volume', $vehicle->volume) }}" readonly style="background: #ececec;">
                        @error('volume')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
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
    @endsection

</x-app-layout>