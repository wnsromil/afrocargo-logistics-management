<x-app-layout>
    <x-slot name="header">
        Edit Inventory
    </x-slot>

    <x-slot name="cardTitle">
        <div class="innertopnav">
            <p class="fw-semibold fs-5 text-dark pheads">Edit Inventory</p>
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

    <form action="{{ route('admin.inventories.update', $editData->id ?? '') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Inventory Type Selection -->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-2 col-md-3">
                            <div class="input-block">
                                <label class="foncolor m-0 p-0">Type <i class="text-danger">*</i></label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Cargo</label>
                                <input class="form-check-input mt-0" type="radio" value="Ocean Cargo" name="inventary_sub_type"
                                    {{ old('inventary_sub_type', $editData->inventary_sub_type ?? '') === 'Ocean Cargo' ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Air</label>
                                <input class="form-check-input mt-0" type="radio" value="Air Cargo" name="inventary_sub_type"
                                    {{ old('inventary_sub_type', $editData->inventary_sub_type ?? '') === 'Air Cargo' ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Supply</label>
                                <input class="form-check-input mt-0" type="radio" value="Supply" name="inventary_sub_type"
                                    {{ old('inventary_sub_type', $editData->inventary_sub_type ?? '') === 'Supply' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Barcode Selection -->
                <div class="col-md-6 col-sm-12">
                    <div class="row justify-content-end">
                        <div class="col-md-3">
                            <div class="input-block">
                                <label class="foncolor m-0 p-0">Barcode<i class="text-danger">*</i></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                                <input class="form-check-input mt-0" type="radio" value="Yes" name="barcode"
                                    {{ old('barcode', $editData->barcode_have ?? '') === 'Yes' ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                                <input class="form-check-input mt-0" type="radio" value="No" name="barcode"
                                    {{ old('barcode', $editData->barcode_have ?? '') === 'No' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block border-0 mb-3">
                        <label for="warehouse_id" class="table-content col737 fw-medium">Warehouse Name <i class="text-danger">*</i></label>
                        <select class="form-control select2" name="warehouse_id">
                            <option disabled hidden value="">Select Warehouse Name</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}"
                                    {{ old('warehouse_id', $editData->warehouse_id ?? '') == $warehouse->id ? 'selected' : '' }}>
                                    {{ $warehouse->warehouse_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Cost Price -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="costprice" class="table-content col737 fw-medium">Cost Price <i class="text-danger">*</i></label>
                        <input class="form-control input-padding" name="costprice" type="text"
                            value="{{ old('costprice', $editData->price ?? '') }}" readonly style="background: #ececec;">
                        @error('costprice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Item Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="name" class="table-content col737 fw-medium">Item Name <i class="text-danger">*</i></label>
                        <input class="form-control input-padding" name="name" type="text"
                            value="{{ old('name', $editData->name ?? '') }}" placeholder="Enter Item Name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Quantity -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_stock_quantity" class="table-content col737 fw-medium">Quantity<i class="text-danger">*</i></label>
                        <input class="form-control input-padding" type="number" name="in_stock_quantity"
                            value="{{ old('in_stock_quantity', $editData->in_stock_quantity ?? '') }}" placeholder="Enter quantity">
                        @error('in_stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Low Stock Warning -->
                <div class="col-lg-4 col-md-6 col-sm-12" id="low_stock_warning">
                    <div class="input-block mb-3">
                        <label for="low_stock_warning" class="table-content col737 fw-medium">Low Stock Warning <i class="text-danger">*</i></label>
                        <input class="form-control text-dark" type="number" name="low_stock_warning"
                            value="{{ old('low_stock_warning', $editData->low_stock_warning ?? '') }}" placeholder="Enter Low Stock Warning">
                        @error('low_stock_warning')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Package Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="package_type" class="table-content col737 fw-medium">Package Type<i class="text-danger">*</i></label>
                        <select class="form-select fw-normal profileUpdateFont select2" name="package_type">
                            <option value="">Select Package Type</option>
                            <option value="Imported"
                                {{ old('package_type', $editData->package_type ?? '') == 'Imported' ? 'selected' : '' }}>
                                Imported
                            </option>
                        </select>
                        @error('package_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Retail/Shipping Price -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="retail_shipping_price" class="table-content col737 fw-medium required text-dark">Retail/Shipping Price </label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="retail_shipping_price"
                                value="{{ old('retail_shipping_price', $editData->retail_shipping_price ?? '') }}"
                                placeholder="Enter Retail/Shipping price">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>
                        @error('retail_shipping_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Description -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="description" class="table-content col737 fw-medium required text-dark">Description</label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="text" name="description"
                                value="{{ old('description', $editData->description ?? '') }}"
                                placeholder="Enter description">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Inventory Image -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="input-block">
                    <label>Inventory Image</label>
                        <div class="input-block mb-3 service-upload img-size2 mb-0">
                    <!-- Preview Image -->
                    <img id="inventory_img_preview"
                        src="{{ !empty($editData->img) ? $editData->img : '' }}"
                        alt="Inventory Image"
                        class="img-thumbnail mb-2 {{ empty($editData->img) ? 'd-none' : '' }}"
                        style="max-width: 150px; height: auto;">

                    <!-- Hidden File Input -->
                    <input type="file" name="img" id="inventory_image" class="d-none">

                    <!-- Action Icons -->
                    <div>
                        <img src="{{ asset('assets/img/edit (1).png') }}" alt="Edit" style="cursor: pointer;" onclick="openImagePicker()">
                        <img src="{{ asset('assets/img/dlt (1).png') }}" alt="Delete" style="cursor: pointer;" onclick="removeImage()">
                    </div>

                    <!-- Delete Flag -->
                    <input type="hidden" name="delete_img" id="delete_img" value="0">
                      </div>
                </div>
                </div>
                
                 <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-block">
                                <label class="foncolor fw_500 m-0 p-0">Default Driver App <i
                                        class="text-danger">*</i></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label> <input
                                    class="form-check-input mt-0" type="radio" value="Yes" name="driver_app_access"
                                    {{ old('driver_app_access', $editData->driver_app_access ?? '') === 'Yes' ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">No</label> <input
                                    class="form-check-input mt-0" {{ old('driver_app_access', $editData->driver_app_access ?? '') === 'No' ? 'checked' : '' }}
                                     type="radio" value="No" name="driver_app_access">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ocean Cargo/Air Cargo Section -->
            <div class="col-12 pt-3 mt-3 border-top">
                <div id="cargoDiv" style="display:none;">
                    <div class="row">
                        <div class="col-12">
                            <p class="heading mb-3">Ocean Cargo/Air Cargo</p>
                        </div>
                        <!-- Country -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block border-0 mb-3">
                                <label for="country" class="table-content col737 fw-medium">Country</label>
                                <select id="country" name="country" class="js-example-basic-single select2">
                                    <option value="" disabled hidden>Select Country</option>
                                    @php
                                        $countries = [
                                            'Bangladesh', 'Belgium', 'Kuwait', 'Dominica', 'India',
                                            'Dominican Republic', 'Andorra', 'Chile', 'United States',
                                            'Greenland', 'Cabo Verde', "Côte d'Ivoire", 'Mali', 'European Union'
                                        ];
                                    @endphp
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" {{ old('country', $editData->country ?? '') == $country ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                                @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- State/Zone -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block border-0 mb-3">
                                <label for="state_zone" class="table-content col737 fw-medium">State/Zone</label>
                                <select class="form-control select2" name="state_zone">
                                    <option disabled hidden value="">Select State/Zone</option>
                                    <option value="100" {{ old('state_zone', $editData->state_zone ?? '') == '100' ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                        </div>
                        <!-- Weight -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="weight" class="table-content col737 fw-medium">Weight (kg)</label>
                                <input 
                                    type="number" 
                                    name="weight" 
                                    class="form-control input-padding" 
                                    id="weight"
                                    value="{{ old('weight', $editData->weight ?? '') }}" 
                                    placeholder="Weight (kg)"
                                >
                            </div>
                        </div>
                        <!-- Length -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="item_length_inch" class="table-content col737 fw-medium">Item Length (inch)</label>
                                <input 
                                    type="number" 
                                    name="item_length_inch" 
                                    class="form-control input-padding" 
                                    id="item_length_inch"
                                    value="{{ old('item_length_inch', $editData->item_length_inch ?? '') }}" 
                                    placeholder="Item Length (inch)"
                                >
                            </div>
                        </div>
                        <!-- Width -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="width" class="table-content col737 fw-medium">Item Width</label>
                                <input 
                                    type="number" 
                                    name="width" 
                                    class="form-control input-padding" 
                                    id="width"
                                    value="{{ old('width', $editData->width ?? '') }}" 
                                    placeholder="Item Width"
                                >
                            </div>
                        </div>
                        <!-- Height -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="height" class="table-content col737 fw-medium">Item Height</label>
                                <input 
                                    type="number" 
                                    name="height" 
                                    class="form-control input-padding" 
                                    id="height"
                                    value="{{ old('height', $editData->height ?? '') }}" 
                                    placeholder="Item Height"
                                >
                            </div>
                        </div>
                        <!-- Volume Total -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="volume_total" class="table-content col737 fw-medium">Volume(l*b*h)</label>
                                <input 
                                    type="number" 
                                    name="volume_total" 
                                    class="form-control input-padding" 
                                    id="volume_total"
                                    value="{{ old('volume_total', $editData->volume_total ?? '') }}" 
                                    placeholder="Volume(l*b*h)"
                                    readonly
                                >
                            </div>
                        </div>
                        <!-- Volume Price -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="volume_price" class="table-content col737 fw-medium">Volume Price (1*1*1)</label>
                                <input 
                                    type="number" 
                                    name="volume_price" 
                                    class="form-control input-padding" 
                                    id="volume_price"
                                    value="{{ old('volume_price', $editData->volume_price ?? '') }}" 
                                    placeholder="Volume Price (1*1*1)"
                                >
                            </div>
                        </div>
                        <!-- Factor -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="factor" class="table-content col737 fw-medium">Factor</label>
                                <input 
                                    type="number" 
                                    name="factor" 
                                    class="form-control input-padding" 
                                    id="factor"
                                    value="{{ old('factor', $editData->factor ?? 5000) }}" 
                                    placeholder="Factor"
                                type="number"
                                >
                            </div>
                        </div>
                        <!-- Insurance Yes/No -->
                        <div class="col-md-4 col-sm-12 align-content-center">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="foncolor fw_500 m-0 p-0">Insurance</label>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-block mb-3 d-flex align-items-center">
                                        <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                                        <input class="form-check-input mt-0" type="radio" name="insurance_have" value="Yes"
                                            {{ old('insurance_have', $editData->insurance_have ?? 'No') === 'Yes' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-block mb-3 d-flex align-items-center">
                                        <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                                        <input class="form-check-input mt-0" type="radio" name="insurance_have" value="No"
                                            {{ old('insurance_have', $editData->insurance_have ?? 'No') === 'No' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="insurance" class="table-content col737 fw-medium">Insurance</label>
                                <input 
                                    type="text" 
                                    name="insurance" 
                                    id="insurance"
                                    class="form-control input-padding"
                                    value="{{ old('insurance', $editData->insurance ?? '') }}"
                                    readonly
                                    style="background: #ececec;"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Supply Section -->
                <div id="supplyDiv" style="display:none;">
                    <div class="row">
                        <div class="col-12">
                            <p class="heading mb-3">Supply</p>
                        </div>
                        <!-- Qty on hand -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="qty_on_hand" class="table-content col737 fw-medium">Qty on hand<i class="text-danger">*</i></label>
                                <input class="form-control input-padding" readonly type="number" name="qty_on_hand"
                                    value="{{ old('qty_on_hand', 0) }}" placeholder="Qty on hand" step="any" aria-label="default input example">
                                @error('qty_on_hand')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Retail Value Price -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="weight" class="table-content col737 fw-medium">Retail Value Price<i class="text-danger">*</i></label>
                                <input class="form-control input-padding" readonly type="number" name="retail_vaule_price"
                                    value="{{ old('retail_vaule_price', 0) }}" placeholder="Retail Value Price" step="any" aria-label="default input example">
                                @error('retail_vaule_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Value Price -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="value_price" class="table-content col737 fw-medium">Value Price<i class="text-danger">*</i></label>
                                <input class="form-control input-padding" readonly type="number" name="value_price"
                                    value="{{ old('value_price', default: 0) }}" placeholder="Value Price" step="any" aria-label="default input example">
                                @error('value_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Last Cost Received -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="last_cost_received" class="table-content col737 fw-medium">Last Cost Received<i class="text-danger">*</i></label>
                                <input class="form-control input-padding" type="number" name="last_cost_received"
                                    placeholder="Enter Last Cost Received" readonly value="{{ old('last_cost_received', 0) }}"
                                    aria-label="default input example">
                                @error('last_cost_received')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Re-order Point -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="re_order_point" class="table-content col737 fw-medium">Re-order Point</label>
                                <input class="form-control input-padding" type="number" name="re_order_point"
                                    value="{{ old('re_order_point', $editData->re_order_point ?? '') }}" placeholder="Enter Re-order Point" aria-label="default input example">
                            </div>
                        </div>
                        <!-- Re-order Quantity -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="re_order_quantity" class="table-content col737 fw-medium">Re-order Quantity</label>
                                <input class="form-control input-padding" type="number" name="re_order_quantity"
                                    value="{{ old('re_order_quantity', $editData->re_order_quantity ?? '') }}" placeholder="Enter Re-order Quantity" aria-label="default input example">
                            </div>
                        </div>
                        <!-- Last Date Received -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="weight" class="table-content col737 fw-medium">Last Date Received<i class="text-danger">*</i></label>
                                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                    <input type="text" name="last_date_received" readonly
                                        value="{{ old('last_date_received') }}"
                                        class="btn-filters form-cs inp inputbackground" placeholder="MM-DD-YYYY" />
                                    @error('last_date_received')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Tax Percentage -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="weight" class="table-content col737 fw-medium">Tax(%)<i class="text-danger">*</i></label>
                                <input class="form-control input-padding" value="{{ old('tax_percentage', $editData->tax_percentage ?? '') }}" type="number" name="tax_percentage"
                                    placeholder="Enter Tax" aria-label="default input example">
                                @error('tax_percentage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Status and Buttons -->
            <div class="add-customer-btns d-flex" style="justify-self: right">
                {{-- <div class="col-md-6 col-sm-12 align-content-center justify-content-start">
                    <div class="d-flex">
                        <label for="in_status" class="foncolor fw_500 p-0 me-3">Status</label>
                        <div class="status-toggle d-flex align-items-center">
                            <input id="status" class="check" type="checkbox" name="status" value="Active" {{ old('status', $editData->status ?? '') === 'Active' ? 'checked' : '' }}>
                            <input id="status" class="check" type="checkbox" name="status">
                            <label for="status" class="checktoggle checkbox-bg togc"></label>
                            <span id="activeText">Inactive</span>
                        </div>
                    </div>
                </div> --}}
                <div class="btnWrapper">
                    <button type="button" onclick="redirectTo('{{ route('admin.inventories.index') }}')" class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>
            </div>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </form>

    @section('script')
        <script>
            const insuranceRadios = document.querySelectorAll('input[name="insurance_have"]');
            const insuranceInput = document.getElementById('insurance');

            insuranceRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.value.toLowerCase() === 'yes') {
                        insuranceInput.removeAttribute('readonly');
                        insuranceInput.removeAttribute('style');
                    } else {
                        insuranceInput.setAttribute('readonly', true);
                        insuranceInput.value = '';
                        insuranceInput.style.backgroundColor = '#ececec';
                    }
                });
            });
        </script>
        <script>
            const lengthInput = document.getElementById("length");
            const widthInput = document.getElementById("width");
            const heightInput = document.getElementById("height");
            const volumeInput = document.getElementById("volume");

            function calculateVolume() {
                const length = parseFloat(lengthInput.value) || 0;
                const width = parseFloat(widthInput.value) || 0;
                const height = parseFloat(heightInput.value) || 0;
                const volume = length * width * height;
                volumeInput.value = volume;
            }

            lengthInput.addEventListener("input", calculateVolume);
            widthInput.addEventListener("input", calculateVolume);
            heightInput.addEventListener("input", calculateVolume);
        </script>
        <script>
            function updateInventoryDivs(selectedValue) {
                if (selectedValue === 'Ocean Cargo' || selectedValue === 'Air Cargo') {
                    document.getElementById('cargoDiv').style.display = 'block';
                     document.getElementById('low_stock_warning').style.display = 'none';
                } else {
                    document.getElementById('cargoDiv').style.display = 'none';
                    document.getElementById('low_stock_warning').style.display = 'block';
                }
                document.getElementById('supplyDiv').style.display = selectedValue === 'Supply' ? 'block' : 'none';
            }

            document.querySelectorAll('input[name="inventary_sub_type"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    updateInventoryDivs(this.value);
                });
            });

            window.addEventListener('DOMContentLoaded', function () {
                const checkedRadio = document.querySelector('input[name="inventary_sub_type"]:checked');
                if (checkedRadio) {
                    updateInventoryDivs(checkedRadio.value);
                }
            });

            document.addEventListener("DOMContentLoaded", function () {
                let statusToggle = document.getElementById("status");
                let activeText = document.getElementById("activeText");
                let inactiveText = document.getElementById("inactiveText");
                function updateTextColor() {
                    if (statusToggle.checked) {
                        activeText.classList.add("bold");
                        inactiveText.classList.remove("bold");
                    } else {
                        activeText.classList.remove("bold");
                        inactiveText.classList.add("bold");
                    }
                }
                updateTextColor();
                statusToggle.addEventListener("change", updateTextColor);
            });

            const inventoryImageInput = document.getElementById('inventory_image');
            const preview = document.getElementById('preview');
            const uploadedImg = document.querySelector('#upload_inventory_image img');

            inventoryImageInput.addEventListener('change', function (event) {
                // Remove the existing database image if present
                if (uploadedImg) {
                    uploadedImg.remove();
                }
                preview.innerHTML = '';
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%';
                        img.style.height = 'auto';
                        img.classList.add('mt-2', 'img-thumbnail');
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
        <script>
        function openImagePicker() {
            document.getElementById('inventory_image').click();
        }

        document.getElementById('inventory_image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('inventory_img_preview');
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                preview.style.display = 'inline-block';
                preview.style.maxWidth = '150px';
                preview.style.height = 'auto';
            };
            reader.readAsDataURL(file);

            // Reset delete flag
            document.getElementById('delete_img').value = '0';
         });

        function removeImage() {
            const preview = document.getElementById('inventory_img_preview');
            const fileInput = document.getElementById('inventory_image');
            const deleteInput = document.getElementById('delete_img');

            preview.src = '';
            preview.classList.add('d-none');
            fileInput.value = '';
            deleteInput.value = '1';
          }
        </script>
    @endsection

</x-app-layout>