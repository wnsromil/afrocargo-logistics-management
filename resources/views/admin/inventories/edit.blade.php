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

    <form action="{{ route('admin.inventories.update', $editData->id ?? '') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="price" id="">
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Inventory Type Selection -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="input-block">
                                <label class="foncolor m-0 p-0">Type <i class="text-danger">*</i></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Ocean Cargo</label>
                                <input class="form-check-input mt-0" type="radio" value="Ocean Cargo"
                                    name="inventary_sub_type" {{ old('inventary_sub_type', $editData->inventary_sub_type ?? '') === 'Ocean Cargo' ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Air cargo</label>
                                <input class="form-check-input mt-0" type="radio" value="Air Cargo"
                                    name="inventary_sub_type" {{ old('inventary_sub_type', $editData->inventary_sub_type ?? '') === 'Air Cargo' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Barcode Selection -->
                {{-- <div class="col-md-5 col-sm-12">
                    <div class="row justify-content-end">
                        <div class="col-md-3">
                            <div class="input-block">
                                <label class="foncolor m-0 p-0">Barcode<i class="text-danger">*</i></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                                <input class="form-check-input mt-0" type="radio" value="Yes" name="barcode" {{
                                    old('barcode', $editData->barcode_have ?? '') === 'Yes' ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                                <input class="form-check-input mt-0" type="radio" value="No" name="barcode" {{
                                    old('barcode', $editData->barcode_have ?? '') === 'No' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block border-0 mb-3">
                        <label for="warehouse_id" class="table-content col737 fw-medium">Warehouse Name <i
                                class="text-danger">*</i></label>
                        <select class="form-control select2" name="warehouse_id">
                            <option disabled hidden value="">Select Warehouse Name</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $editData->warehouse_id ?? '') == $warehouse->id ? 'selected' : '' }}>
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
                        <label for="costprice" class="table-content col737 fw-medium">Cost Price <i
                                class="text-danger">*</i></label>
                        <input class="form-control input-padding" name="costprice" min="0.1" type="text" value="0"
                            readonly style="background: #ececec;">
                        @error('costprice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Item Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="name" class="table-content col737 fw-medium">Item Name <i
                                class="text-danger">*</i></label>
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
                        <label for="in_stock_quantity" class="table-content col737 fw-medium">Quantity<i
                                class="text-danger">*</i></label>
                        <input class="form-control input-padding" type="number" name="in_stock_quantity"
                            value="{{ old('in_stock_quantity', $editData->in_stock_quantity ?? '') }}"
                            placeholder="Enter quantity">
                        @error('in_stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Package Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="package_type" class="table-content col737 fw-medium">Package Type<i
                                class="text-danger">*</i></label>
                        <select class="form-select fw-normal profileUpdateFont select2" name="package_type">
                            <option value="">Select Package Type</option>
                            <option value="Imported" {{ old('package_type', $editData->package_type ?? '') == 'Imported' ? 'selected' : '' }}>
                                Imported
                            </option>
                        </select>
                        @error('package_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Retail/Shipping Price -->
                <div class="col-lg-4 col-md-6 col-sm-12" id="retail_shipping_price">
                    <div class="input-block mb-3">
                        <label for="retail_shipping_price"
                            class="table-content col737 fw-medium required text-dark">Shipping Price </label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="retail_shipping_price"
                                value="{{ old('retail_shipping_price', $editData->retail_shipping_price ?? '') }}"
                                placeholder="Enter Shipping Price">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>
                        @error('retail_shipping_price')
                            <span class="text-danger">The shipping price field is required.</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12" id="retail_vaule_price" style="display: none;">
                    <div class="input-block mb-3">
                        <label for="retail_vaule_price" class="table-content col737 fw-medium required text-dark">Retail
                            Price</label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="retail_vaule_price"
                                value="{{ old('retail_vaule_price', $editData->retail_vaule_price) }}"
                                placeholder="Enter retail price">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>
                        @error('retail_vaule_price')
                            <span class="text-danger">The retail price field is required.</span>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="description"
                            class="table-content col737 fw-medium required text-dark">Description</label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="text" name="description"
                                value="{{ old('description', $editData->description ?? '') }}"
                                placeholder="Enter description">
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
                            <img id="inventory_img_preview" src="{{ !empty($editData->img) ? $editData->img : '' }}"
                                alt="Inventory Image"
                                class="img-thumbnail mb-2 {{ empty($editData->img) ? 'd-none' : '' }}"
                                style="max-width: 150px; height: auto;">

                            <!-- Hidden File Input -->
                            <input type="file" name="img" id="inventory_image" class="d-none">

                            <!-- Action Icons -->
                            <div>
                                <img src="{{ asset('assets/img/edit (1).png') }}" alt="Edit" style="cursor: pointer;"
                                    onclick="openImagePicker()">
                                <img src="{{ asset('assets/img/dlt (1).png') }}" alt="Delete" style="cursor: pointer;"
                                    onclick="removeImage()">
                            </div>

                            <!-- Delete Flag -->
                            <input type="hidden" name="delete_img" id="delete_img" value="0">
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-4 col-sm-12">
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
                                    class="form-check-input mt-0" type="radio" value="Yes" name="driver_app_access" {{
                                    old('driver_app_access', $editData->driver_app_access ?? '') === 'Yes' ? 'checked' :
                                '' }}>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">No</label> <input
                                    class="form-check-input mt-0" {{ old('driver_app_access',
                                    $editData->driver_app_access ?? '') === 'No' ? 'checked' : '' }}
                                type="radio" value="No" name="driver_app_access">
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Ocean Cargo/Air Cargo Section -->
            <div class="col-12 pt-3 mt-3 border-top">
                <div class="row">
                    <div class="col-12" id="CargoTagDiv">
                        <p class="heading mb-3">Ocean Cargo/Air Cargo</p>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block border-0 mb-3">
                            <label for="country" class="table-content col737 fw-medium">Country<i
                                    class="text-danger">*</i></label>
                            <select class="form-control " id="country_inventory" name="country">
                                <option value="" disabled selected>Select Country</option>
                                <option value="" {{ old('country', $editData->name ?? '') == '' ? 'selected' : '' }}>
                                    Select Country</option>
                                @foreach (setting()->warehouseContries() as $country)
                                    <option data-id="{{ $country['id'] }}" value="{{ $country['name'] }}" {{ $editData->country == $country['name'] ? 'selected' : '' }}>
                                        {{ $country['name'] }}
                                    </option>
                                @endforeach
                            </select>

                            @error('country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block border-0 mb-3">
                            <label for="state" class="table-content col737 fw-medium">State</label>
                            <select class="form-control select2" name="state" id="state_inventory">
                                <option value="" disabled selected>Select State</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block border-0 mb-3">
                            <label for="city" class="table-content col737 fw-medium">City</label>
                            <select class="form-control select2" name="city" id="city_inventory">
                                <option value="" disabled selected>Select City</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="weight" class="table-content col737 fw-medium">Weight (kg)</label>
                            <input class="form-control input-padding" type="number" name="weight"
                                value="{{ old('weight', $editData->weight) }}" placeholder="Enter Weight" step="any"
                                aria-label="default input example">

                            @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="item_length_inch" class="table-content col737 fw-medium">Item Length(inch)
                            </label>
                            <input class="form-control input-padding" name="item_length_inch" id="length" type="number"
                                step="any" value="{{ old('item_length_inch', $editData->item_length_inch) }}"
                                placeholder="Enter Item Length" aria-label="default input example">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="width" class="table-content col737 fw-medium">Item Width </label>
                            <input class="form-control input-padding" name="width" id="width" type="number" step="any"
                                value="{{ old('width', $editData->width) }}" placeholder="Enter Item Width"
                                aria-label="default input example">

                            @error('width')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="height" class="table-content col737 fw-medium">Item Height</label>
                            <input class="form-control input-padding" name="height" id="height" type="number" step="any"
                                value="{{ old('height', $editData->height) }}" placeholder="Enter Item Height"
                                aria-label="default input example">

                            @error('height')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="volume_total" class="table-content col737 fw-medium">Volume(L*W*H)</label>
                            <input class="form-control input-padding" readonly name="volume_total" id="volume"
                                type="number" step="any" value="{{ old('volume_total', $editData->volume_total) }}"
                                placeholder="value" aria-label="default input example">

                            @error('volume_total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12" id="weightPriceDiv">
                        <div class="input-block mb-3">
                            <label for="in_price" class="table-content col737 fw-medium text-dark">Weight
                                Price</label>
                            <div class="d-flex align-items-center justify-content-between form-control">
                                <input class="no-border" type="number" name="weight_price"
                                    value="{{ old('weight_price', $editData->weight_price) }}"
                                    placeholder="Enter Weight Price">
                                <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                            </div>

                            @error('weight_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="height" class="table-content col737 fw-medium">Volume Price(1*1*1)</label>
                            <input class="form-control input-padding" name="volume_price" id="volume_price"
                                type="number" step="any" value="{{ old('volume_price', $editData->volume_price) }}"
                                placeholder="Enter Volume Price" aria-label="default input example">

                            @error('volume_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="height" class="table-content col737 fw-medium">Factor</label>
                            <input class="form-control input-padding" name="factor" type="number"
                                value="{{ old('factor', 5000) }}" placeholder="Factor"
                                aria-label="default input example">
                        </div>
                    </div>

                    @php
                        $insuranceValue = old('insurance_have', $editData->insurance_have ?? 'No');
                    @endphp

                    <div class="col-md-4 col-sm-12 align-content-center">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-block">
                                    <label class="foncolor fw_500 m-0 p-0">Insurance</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                                    <input class="form-check-input mt-0" type="radio" name="insurance_have" value="Yes"
                                        {{ $insuranceValue == 'Yes' ? 'checked' : '' }}>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="input-block mb-3 d-flex align-items-center">
                                    <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                                    <input class="form-check-input mt-0" type="radio" name="insurance_have" value="No"
                                        {{ $insuranceValue == 'No' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="height" class="table-content col737 fw-medium">Insurance</label>
                            <input class="form-control input-padding" readonly name="insurance" id="insurance"
                                type="text" placeholder="Enter Insurance"
                                value="{{ old('insurance', $editData->insurance) }}" aria-label="default input example"
                                style="background: #ececec;">
                            @error('insurance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12" id="capacityDiv" style="display:none;">
                        <div class="input-block mb-3">
                            <label for="capacity" class="table-content col737 fw-medium">Capacity<i
                                    class="text-danger">*</i></label>
                            <input class="form-control input-padding" name="capacity" id="capacity_supply" type="text"
                                step="any" value="{{ old('capacity', $editData->capacity) }}"
                                placeholder="Enter Item Capacity" aria-label="default input example">
                            @error('capacity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="cargoDiv" style="display:none;">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="height" class="table-content col737 fw-medium">Volume Price(1*1*1)</label>
                                <input class="form-control input-padding" name="volume_price" id="volume_price"
                                    type="number" step="any" value="{{ old('volume_price', $editData->volume_price) }}"
                                    placeholder="Enter Volume Price" aria-label="default input example">

                                @error('volume_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="height" class="table-content col737 fw-medium">Factor</label>
                                <input class="form-control input-padding" name="factor" type="number"
                                    value="{{ old('factor', 5000) }}" placeholder="Factor"
                                    aria-label="default input example">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="supplyDiv" style="display:none;">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block border-0 mb-3">
                                <label for="color" class="table-content col737 fw-medium">Color<i
                                        class="text-danger">*</i></label>
                                <select class="js-example-basic-single select2" id="color" name="color">
                                    <option value="" disabled {{ old('color', $editData->color ?? '') ? '' : 'selected' }}>Select Color</option>

                                    @php
                                        $colors = [
                                            "Amber",
                                            "Aqua",
                                            "Beige",
                                            "Black",
                                            "Blue",
                                            "Bronze",
                                            "Brown",
                                            "Burgundy",
                                            "Charcoal",
                                            "Cherry",
                                            "Cyan",
                                            "Dark Blue",
                                            "Dark Green",
                                            "Dark Grey",
                                            "Emerald",
                                            "Fuchsia",
                                            "Gold",
                                            "Gray",
                                            "Green",
                                            "Hot Pink",
                                            "Indigo",
                                            "Ivory",
                                            "Lavender",
                                            "Lemon",
                                            "Light Blue",
                                            "Light Brown",
                                            "Light Green",
                                            "Light Grey",
                                            "Lime",
                                            "Magenta",
                                            "Maroon",
                                            "Mauve",
                                            "Mint",
                                            "Mustard",
                                            "Navy",
                                            "Olive",
                                            "Orange",
                                            "Peach",
                                            "Pink",
                                            "Plum",
                                            "Purple",
                                            "Red",
                                            "Rose",
                                            "Ruby",
                                            "Rust",
                                            "Salmon",
                                            "Sand",
                                            "Silver",
                                            "Sky Blue",
                                            "Slate Grey",
                                            "Tan",
                                            "Teal",
                                            "Turquoise",
                                            "Violet",
                                            "White",
                                            "Wine",
                                            "Yellow"
                                        ];

                                        $selectedColor = old('color', $editData->color ?? '');
                                    @endphp

                                    @foreach ($colors as $color)
                                        <option value="{{ $color }}" {{ $selectedColor == $color ? 'selected' : '' }}>
                                            {{ $color }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="un_rating" class="table-content col737 fw-medium">Un Rating<i
                                        class="text-danger">*</i></label>
                                <input class="form-control input-padding" name="un_rating" id="un_rating_supply"
                                    type="text" step="any" value="{{ old('un_rating', $editData->un_rating) }}"
                                    placeholder="Enter Item Un Rating" aria-label="default input example">
                                @error('un_rating')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="model_number" class="table-content col737 fw-medium">Model Number<i
                                        class="text-danger">*</i></label>
                                <input type="text" class="form-control input-padding" name="model_number"
                                    id="model_number_supply" step="any"
                                    value="{{ old('model_number', $editData->model_number) }}"
                                    placeholder="Enter Item Model Number" aria-label="default input example">
                                @error('model_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block border-0 mb-3">
                                <label for="open" class="table-content col737 fw-medium">Open <i
                                        class="text-danger">*</i></label>
                                @php
                                    $selectedOpen = old('open', $editData->open ?? '');
                                @endphp
                                <select class="js-example-basic-single select2" id="open_supply" name="open">
                                    <option value="" disabled {{ $selectedOpen ? '' : 'selected' }}>Select Open</option>
                                    <option value="Top" {{ $selectedOpen == 'Top' ? 'selected' : '' }}>Top</option>
                                    <option value="Bottom" {{ $selectedOpen == 'Bottom' ? 'selected' : '' }}>Bottom
                                    </option>
                                    <option value="Left" {{ $selectedOpen == 'Left' ? 'selected' : '' }}>Left</option>
                                    <option value="Right" {{ $selectedOpen == 'Right' ? 'selected' : '' }}>Right</option>
                                    <option value="Front" {{ $selectedOpen == 'Front' ? 'selected' : '' }}>Front</option>
                                    <option value="Back" {{ $selectedOpen == 'Back' ? 'selected' : '' }}>Back</option>
                                    <option value="Top & Bottom" {{ $selectedOpen == 'Top & Bottom' ? 'selected' : '' }}>
                                        Top & Bottom</option>
                                    <option value="Left & Right" {{ $selectedOpen == 'Left & Right' ? 'selected' : '' }}>
                                        Left & Right</option>
                                    <option value="All Sides" {{ $selectedOpen == 'All Sides' ? 'selected' : '' }}>All
                                        Sides</option>
                                </select>
                                @error('open')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="qty_on_hand" class="table-content col737 fw-medium">Qty on hand</label>
                                <input class="form-control input-padding" readonly type="number" name="qty_on_hand"
                                    value="{{ old('qty_on_hand', 0) }}" placeholder="Qty on hand" step="any"
                                    aria-label="default input example" style="background: #ececec;">
                                @error('qty_on_hand')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="value_price" class="table-content col737 fw-medium">Value Price</label>
                                <input class="form-control input-padding" readonly type="number" name="value_price"
                                    value="{{ old('value_price', default: 0) }}" placeholder="Value Price" step="any"
                                    aria-label="default input example" style="background: #ececec;">
                                @error('value_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="last_cost_received" class="table-content col737 fw-medium">Last Cost
                                    Received</label>
                                <input class="form-control input-padding" type="number" name="last_cost_received"
                                    placeholder="Enter Last Cost Received" readonly style="background: #ececec;"
                                    value="{{ old('last_cost_received', 0) }}" aria-label="default input example">
                                @error('last_cost_received')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="re_order_point" class="table-content col737 fw-medium">Re-order
                                    Point</label>
                                <input class="form-control input-padding" type="number" name="re_order_point"
                                    value="{{ old('re_order_point', $editData->re_order_point) }}"
                                    placeholder="Enter Re-order Point" aria-label="default input example">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="re_order_quantity" class="table-content col737 fw-medium">Re-order
                                    Quantity</label>
                                <input class="form-control input-padding" type="number" name="re_order_quantity"
                                    value="{{ old('re_order_quantity', $editData->re_order_quantity) }}"
                                    placeholder="Enter Re-order Quantity" aria-label="default input example">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="weight" class="table-content col737 fw-medium">Last Date Received</label>
                                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                    <input type="text" name="last_date_received" readonly
                                        value="{{ old('last_date_received') }}"
                                        class="btn-filters  form-cs inp  inputbackground" placeholder="MM-DD-YYYY"
                                        style="background: #ececec;" />
                                    @error('last_date_received')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="weight" class="table-content col737 fw-medium">Tax(%)</label>
                                <input class="form-control input-padding"
                                    value="{{ old('tax_percentage', $editData->tax_percentage) }}" type="number"
                                    name="tax_percentage" placeholder="Enter Tax" aria-label="default input example">
                                @error('tax_percentage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <input class="no-border" type="hidden" name="country_hidden"
                    value="{{ old('country_hidden', $editData->country) }}">
                <input class="no-border" type="hidden" name="state_hidden"
                    value="{{ old('state_hidden', $editData->state) }}">
                <input class="no-border" type="hidden" name="city_hidden"
                    value="{{ old('city_hidden', $editData->city) }}">

            </div>
            <!-- Status and Buttons -->
            <div class="add-customer-btns d-flex" style="justify-self: right">
                <div class="btnWrapper">
                    <button type="button" onclick="redirectTo('{{ route('admin.inventories.index') }}')"
                        class="btn btn-outline-primary custom-btn">Cancel</button>
                    @can('has-dynamic-permission', 'service_inventory_list.edit')
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    @endcan
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
            const originalCountryOptions = $('#country_inventory option').clone();
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

        <script>
            $(document).ready(function () {
                const countrySelectors = ['#country_inventory'];
                const stateSelectors = ['#state_inventory'];
                const citySelectors = ['#city_inventory'];

                const hiddenCountry = $('input[name="country_hidden"]').val();
                const hiddenState = $('input[name="state_hidden"]').val();
                const hiddenCity = $('input[name="city_hidden"]').val();

                // Load states based on country data-id
                function loadStates(countryId, stateSelector, selectedState = '') {
                    $(stateSelector).html('<option selected>Loading...</option>');
                    $.get('/api/get-states/' + countryId, function (states) {
                        let stateOptions = '<option value="">Select State</option>';
                        $.each(states, function (i, state) {
                            const selected = state.name === selectedState ? 'selected' : '';
                            stateOptions += `<option value="${state.name}" data-id="${state.id}" ${selected}>${state.name}</option>`;
                        });
                        $(stateSelector).html(stateOptions);

                        // Load cities if selectedState is passed
                        if (selectedState) {
                            const selectedOption = $(stateSelector).find('option:selected');
                            const stateId = selectedOption.data('id');
                            const citySelector = getCitySelector(stateSelector);
                            loadCities(stateId, citySelector, hiddenCity);
                        }
                    });
                }

                // Load cities based on state data-id
                function loadCities(stateId, citySelector, selectedCity = '') {
                    $(citySelector).html('<option selected>Loading...</option>');
                    $.get('/api/get-cities/' + stateId, function (cities) {
                        let cityOptions = '<option value="">Select City</option>';
                        $.each(cities, function (i, city) {
                            const selected = city.name === selectedCity ? 'selected' : '';
                            cityOptions += `<option value="${city.name}" data-id="${city.id}" ${selected}>${city.name}</option>`;
                        });
                        $(citySelector).html(cityOptions);
                    });
                }

                // Identify which city selector to use based on state selector
                function getCitySelector(stateSelector) {
                    return stateSelector.includes('_supply') ? '' : '#city_inventory';
                }

                // Handle country change
                $('#country_inventory').change(function () {
                    const selectedOption = $(this).find('option:selected');
                    const countryId = selectedOption.data('id');
                    const stateSelector = $(this).attr('id') === 'country' ? '#state_inventory' : '';
                    const citySelector = getCitySelector(stateSelector);

                    // Reset state & city
                    $(stateSelector).html('<option selected>Loading...</option>');
                    $(citySelector).html('<option value="">Select City</option>');

                    loadStates(countryId, stateSelector);
                });

                // Handle state change
                $('#state_inventory').change(function () {
                    const selectedOption = $(this).find('option:selected');
                    const stateId = selectedOption.data('id');
                    const citySelector = getCitySelector($(this).attr('id'));
                    loadCities(stateId, citySelector);
                });

                // Page load: auto select by hidden values
                countrySelectors.forEach(selector => {
                    const countryOption = $(`${selector} option[value="${hiddenCountry}"]`);
                    if (countryOption.length) {
                        countryOption.prop('selected', true);
                        const stateSelector = selector.includes('_supply') ? '' : '#state_inventory';
                        const countryId = countryOption.data('id');
                        loadStates(countryId, stateSelector, hiddenState);
                    }
                });
            });
        </script>
    @endsection

</x-app-layout>