<x-app-layout>

    <x-slot name="header">
        Container Management
    </x-slot>


    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Container</p>
        </div>
    </x-slot>

    <form action="{{ route('admin.container.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block fwNormal mb-3">
                        <label for="warehouse_location" class="foncolor">Warehouse<i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="js-example-basic-single select2">
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

                <!-- Container Size -->
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-size-field">
                    <div class="input-block mb-3">
                        <label for="container_size" class="foncolor">Size</label>
                        <select name="container_size" id="container_size" class="js-example-basic-single select2">
                            <option value="">Select Size</option>
                            <option {{ old('container_size') == '40 feet' ? 'selected' : '' }} value="40 feet">40 feet
                            </option>
                            <option {{ old('container_size') == '20 feet' ? 'selected' : '' }} value="20 feet">20 feet
                            </option>
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



                {{-- Seal Number --}}
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

                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <label class="foncolor" for="ship_to_country">Ship To Country <i class="text-danger">*</i></label>
                    <div class="widthmannual">
                        <select id="ship_to_country" name="ship_to_country" class="js-example-basic-single select2">
                            <option value="" disabled hidden {{ old('ship_to_country') ? '' : 'selected' }}>Select
                                Country</option>
                            @foreach (setting()->warehouseContries() as $country)
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