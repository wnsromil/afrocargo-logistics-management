<x-app-layout>

    <x-slot name="header">
        Container Management
    </x-slot>


    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Edit Container</p>
        </div>
    </x-slot>

    <form action="{{ route('admin.container.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
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

                <!-- Container Size -->
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-size-field">
                    <div class="input-block mb-3">
                        <label for="container_size" class="foncolor">Size</label>
                        <select name="container_size" id="container_size" class="js-example-basic-single select2">
                            <option value="">Select Size</option>
                            <option {{ old('container_size', $vehicle->container_size) == '40 feet' ? 'selected' : '' }} value="40 feet">40 feet</option>
                            <option {{ old('container_size',$vehicle->container_size) == '20 feet' ? 'selected' : '' }} value="20 feet">20 feet</option>
                        </select>
                        @error('container_size')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                @php
                    $role_id = Auth::user()->role_id;
                @endphp
                @if($role_id == 1)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="company_for_container" class="foncolor">Company For Container <i
                                    class="text-danger">*</i></label>
                            <select id="company_for_container" name="company_for_container" class="profileUpdateFont">
                                <option value="">Select Company For Container</option>
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



                {{-- Seal Number --}}
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

                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <label class="foncolor" for="ship_to_country">Ship To Country <i class="text-danger">*</i></label>
                    <div class="widthmannual">
                         <select id="country" name="country" class="js-example-basic-single select2">
                                <option value="" disabled hidden {{ old('country', $vehicle->ship_to_country) ? '' : 'selected' }}>Select Country</option>
                                <option value="Bangladesh" {{ old('country', $vehicle->ship_to_country) == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                <option value="Belgium" {{ old('country', $vehicle->ship_to_country) == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                <option value="Kuwait" {{ old('country', $vehicle->ship_to_country) == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                <option value="Dominica" {{ old('country', $vehicle->ship_to_country) == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                                <option value="India" {{ old('country', $vehicle->ship_to_country) == 'India' ? 'selected' : '' }}>India</option>
                                <option value="Dominican Republic" {{ old('country', $vehicle->ship_to_country) == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                <option value="Andorra" {{ old('country', $vehicle->ship_to_country) == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                <option value="Chile" {{ old('country', $vehicle->ship_to_country) == 'Chile' ? 'selected' : '' }}>Chile</option>
                                <option value="United States" {{ old('country', $vehicle->ship_to_country) == 'United States' ? 'selected' : '' }}>United States</option>
                                <option value="Greenland" {{ old('country', $vehicle->ship_to_country) == 'Greenland' ? 'selected' : '' }}>Greenland</option>
                                <option value="Cabo Verde" {{ old('country', $vehicle->ship_to_country) == 'Cabo Verde' ? 'selected' : '' }}>Cabo Verde</option>
                                <option value="Côte d'Ivoire" {{ old('country', $vehicle->ship_to_country) == "Côte d'Ivoire" ? 'selected' : '' }}>Côte d'Ivoire</option>
                                <option value="Mali" {{ old('country', $vehicle->ship_to_country) == 'Mali' ? 'selected' : '' }}>Mali</option>
                                <option value="European Union" {{ old('country', $vehicle->ship_to_country) == 'European Union' ? 'selected' : '' }}>European Union</option>
                            </select>
                    </div>
                    @error('ship_to_country')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

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
                            value="{{ old('volume', $vehicle->volume) }}" readonly style="background-color: #e9ecef;">
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
                    placeholder: 'Select Or Type Company For Container',
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
    @endsection

</x-app-layout>