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
                        <label for="warehouse_location" class="foncolor">Warehouse Location <i class="text-danger">*</i></label>
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

                <!-- Vehicle Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type" class="foncolor">Vehicle Type</label>
                        <input type="text" id="vehicle_type" name="vehicle_type" value="Container" readonly style="background-color: #e9ecef !important; color: #6c757d; cursor: not-allowed;" class="form-control profileUpdateFont">

                        @error('vehicle_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Vehicle Model -->

                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_model" class="foncolor">Vehicle Model <i class="text-danger">*</i></label>
                        <input type="text" name="vehicle_model" class="form-control inp"
                            placeholder="Enter Vehicle Model" value="{{ old('vehicle_model') }}">
                @error('vehicle_model')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                    </div> --}}


                    <!-- Vehicle Manufactured year -->

                    {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label for="vehicle_year" class="foncolor">Vehicle Manufactured year<i
                                                    class="text-danger">*</i></label>
                                            <input type="vehicle_year" name="vehicle_year" class="form-control inp"
                                                placeholder=" Enter Vehicle Manufactured year" value="{{ old('vehicle_year') }}">
                    @error('vehicle_year')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    </div> --}}

                    <!-- Container Size -->
                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-size-field">
                    <div class="input-block mb-3">
                        <label for="container_size" class="foncolor">Container Size</label>
                        <select name="container_size" id="container_size" class="js-example-basic-single select2">
                            <option value="">Select Container Size</option>
                            <option>40 feet</option>
                            <option>20 feet</option>
                        </select>
                    </div>
                </div>


                <!-- Container No.1 -->

                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-no-1-field">
                    <div class="input-block mb-3">
                        <label for="container_no_1" class="foncolor">Container No.1<i class="text-danger">*</i></label>
                        <input type="text" name="container_no_1" id="container_no_1" class="form-control inp" placeholder=" Enter Vehicle No." value="{{ old('container_no_1') }}">
                        @error('container_no_1')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Container No.2 -->

                <div class="col-lg-4 col-md-6 col-sm-12 container-inputs container-no-2-field">
                    <div class="input-block mb-3">
                        <label for="container_no_2" class="foncolor">Container No.2<i class="text-danger">*</i></label>
                        <input type="text" name="container_no_2" id="container_no_1" class="form-control inp" placeholder=" Enter Vehicle No." value="{{ old('container_no_2') }}">
                        @error('container_no_2')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Seal Number --}}
                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="seal_no" class="foncolor">Seal Number <i class="text-danger">*</i></label>
                        <input type="text" name="seal_no" id="seal_no" class="form-control inp" placeholder="Enter Seal Number" value="{{ old('seal_no') }}">
                        @error('seal_no')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 seal-no-field">
                    <div class="input-block mb-3">
                        <label for="bill_of_lading" class="foncolor">Bill Of Lading <i class="text-danger">*</i></label>
                        <input type="text" name="bill_of_lading" id="bill_of_lading" class="form-control inp" placeholder="Enter Bill Of Lading" value="{{ old('bill_of_lading') }}">
                        @error('bill_of_lading')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12 ps-5">
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
                </div>
            </div>
        </div>

        <div class="add-customer-btns text-end">
            <button type="button" onclick="redirectTo('{{route('admin.warehouses.index') }}')" class="btn btn-outline-primary custom-btn">Cancel</button>
            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>

    </form>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</x-app-layout>
