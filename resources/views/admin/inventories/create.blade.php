<x-app-layout>
    <x-slot name="header">
        Add Inventory
    </x-slot>

    <x-slot name="cardTitle">
        <div class="innertopnav">
            <p class="fw-semibold fs-5 text-dark pheads">Add Inventory</p>
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

    <form action="{{ route('admin.inventories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="price" id="">
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="input-block">
                                <label class="foncolor m-0 p-0">Type <i class="text-danger">*</i></label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Ocean cargo</label>
                                <input class="form-check-input mt-0" type="radio" value="Ocean Cargo"
                                    name="inventary_sub_type" {{ old('inventary_sub_type', 'Ocean Cargo') === 'Ocean Cargo' ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Air cargo</label>
                                <input class="form-check-input mt-0" type="radio" value="Air Cargo"
                                    name="inventary_sub_type" {{ old('inventary_sub_type') === 'Air Cargo' ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-3 d-none">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Supply</label>
                                <input class="form-check-input mt-0" type="radio" value="Supply"
                                    name="inventary_sub_type" {{ old('inventary_sub_type') === 'Supply' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block border-0 mb-3">
                        <label for="warehouse_id" class="table-content col737 fw-medium">Warehouse Name <i
                                class="text-danger">*</i></label>

                        <select class="form-control select2" name="warehouse_id">
                            <option disabled hidden selected value="">Select Warehouse Name</option>
                            @foreach ($warehouses as $warehouse)
                                <option {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>

                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="costprice" class="table-content col737 fw-medium">Cost Price <i
                                class="text-danger">*</i></label>
                        <input class="form-control input-padding" name="costprice" type="text"
                            value="{{ old('costprice') }}" placeholder="Enter Cost Price" readonly value="0"
                            aria-label="default input example" style="background: #ececec;">

                        @error('costprice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="name" class="table-content col737 fw-medium">Item Name <i
                                class="text-danger">*</i></label>
                        <input class="form-control input-padding" name="name" type="text" value="{{ old('name') }}"
                            placeholder="Enter Item Name" aria-label="default input example">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_stock_quantity" class="table-content col737 fw-medium">Quantity<i
                                class="text-danger">*</i></label>
                        <input class="form-control input-padding" type="number" name="in_stock_quantity"
                            value="{{ old('in_stock_quantity') }}" placeholder="Enter quantity"
                            aria-label="default input example">
                        @error('in_stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" id="low_stock_warning" style="display: none;">
                    <div class="input-block mb-3">
                        <label for="low_stock_warning" class="table-content col737 fw-medium">Low Stock
                            Warning <i class="text-danger">*</i></label>
                        <input class="form-control text-dark" type="number" name="low_stock_warning"
                            value="{{ old('low_stock_warning') }}" placeholder="Enter Low Stock Warning"
                            aria-label="default input example">
                        @error('low_stock_warning')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12" id="minimum_order_limit" style="display: none;">
                    <div class="input-block mb-3">
                        <label for="minimum_order_limit" class="table-content col737 fw-medium">Minimum Order Limit
                            <i class="text-danger">*</i></label>
                        <input class="form-control text-dark" type="number" name="minimum_order_limit"
                            value="{{ old('minimum_order_limit') }}" placeholder="Enter Minimum Order Limit"
                            aria-label="default input example">
                        @error('minimum_order_limit')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="package_type" class="table-content col737 fw-medium">Package Type<i
                                class="text-danger">*</i></label>
                        <select class="form-select fw-normal profileUpdateFont select2" name="package_type"
                            aria-label="Default select example" value="{{ old('package_type') }}">
                            <option value="">Select Package Type</option>
                            <option value="Imported">Imported</option>
                        </select>

                        @error('package_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12" id="retail_shipping_price">
                    <div class="input-block mb-3">
                        <label for="retail_shipping_price"
                            class="table-content col737 fw-medium required text-dark">Shipping
                            Price </label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="retail_shipping_price"
                                value="{{ old('retail_shipping_price') }}" placeholder="Enter Shipping Price">
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
                                value="{{ old('retail_vaule_price') }}" placeholder="Enter retail price">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>
                        @error('retail_vaule_price')
                            <span class="text-danger">The retail price field is required.</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="description"
                            class="table-content col737 fw-medium required text-dark">Description</label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="text" name="description" value="{{ old('description') }}"
                                placeholder="Enter description">
                        </div>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block">
                        <label class="table-content col737 fw-medium">Inventory Image </label>
                        <div class="input-block mb-3 service-upload img-size2 mb-0">
                            <span id="upload_inventory_image">
                                <svg width="65" height="37" viewBox="0 0 65 37" fill="none" style="color:black;"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="65" height="37" fill="url(#pattern0_2250_39084)"
                                        style="mix-blend-mode:luminosity" />
                                    <defs>
                                        <pattern id="pattern0_2250_39084" patternContentUnits="objectBoundingBox"
                                            width="1" height="1">
                                            <use xlink:href="#image0_2250_39084"
                                                transform="matrix(0.00877193 0 0 0.0154101 0 -0.000829777)" />
                                        </pattern>
                                        <image id="image0_2250_39084" width="114" height="65" preserveAspectRatio="none"
                                            xlink:href="data:image/png;base64,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" />
                                    </defs>
                                </svg>
                                <h6 class="drop-browse align-center">Upload Image</h6>
                            </span>

                            <input type="file" id="inventory_image" name="img" class="form-control" accept="image/*">
                            <div id="preview" class="mt-2">
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>

            <div class="col-12 pt-3 mt-3 border-top">
                <div class="row">
                    <div class="col-12" id="CargoTagDiv">
                        <p class="heading mb-3">Ocean Cargo/Air Cargo</p>
                    </div>

                    <div class="col-12" style="display: none;" id="SupplyTagDiv">
                        <p class="heading mb-3">Supply</p>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block border-0 mb-3">
                            <label for="country" class="table-content col737 fw-medium">Country<i
                                    class="text-danger">*</i></label>
                          <select class="form-control" id="country_inventory" name="country">
                                <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select Country</option>

                                @foreach(setting()->warehouseContries() as $country)
                                    <option 
                                        value="{{ $country->name }}" 
                                        data-id="{{ $country->id }}" 
                                        {{ old('country') == $country->name ? 'selected' : '' }}>
                                        {{ $country->name }}
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
                                value="{{ old('weight') }}" placeholder="Enter Weight" step="any"
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
                                step="any" value="{{ old('item_length_inch') }}" placeholder="Enter Item Length"
                                aria-label="default input example">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="width" class="table-content col737 fw-medium">Item Width </label>
                            <input class="form-control input-padding" name="width" id="width" type="number" step="any"
                                value="{{ old('width') }}" placeholder="Enter Item Width"
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
                                value="{{ old('height') }}" placeholder="Enter Item Height"
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
                                type="number" step="any" value="{{ old('volume_total') }}" placeholder="value"
                                aria-label="default input example">

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
                                    value="{{ old('weight_price') }}" placeholder="Enter Weight Price">
                                <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                            </div>

                            @error('weight_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12" id="capacityDiv" style="display:none;">
                        <div class="input-block mb-3">
                            <label for="capacity" class="table-content col737 fw-medium">Capacity<i
                                    class="text-danger">*</i></label>
                            <input class="form-control input-padding" name="capacity" id="capacity_supply" type="text"
                                step="any" value="{{ old('capacity') }}" placeholder="Enter Item Capacity"
                                aria-label="default input example">
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
                                    type="number" step="any" value="{{ old('volume_price') }}"
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
                        <div class="col-md-4 col-sm-12 align-content-center">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-block">
                                        <label class="foncolor fw_500 m-0 p-0">Insurance</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-block mb-3 d-flex align-items-center">
                                        <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label> <input
                                            class="form-check-input mt-0" {{ old('insurance_have') === 'Yes' ? 'checked' : '' }} type="radio" value="Yes" name="insurance_have">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-block mb-3 d-flex align-items-center">
                                        <label class="foncolor mb-0 pt-0 me-2 col3A">No</label> <input
                                            class="form-check-input mt-0" {{ old('insurance_have', 'No') === 'No' ? 'checked' : '' }} type="radio" value="No" name="insurance_have">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="height" class="table-content col737 fw-medium">Insurance</label>
                                <input class="form-control input-padding" readonly name="insurance" id="insurance"
                                    type="text" placeholder="Enter Insurance" value="{{ old('insurance') }}"
                                    aria-label="default input example" style="background: #ececec;">
                                @error('insurance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                    <option value="" disabled {{ old('color') ? '' : 'selected' }}>Select Color</option>
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
                                    @endphp

                                    @foreach ($colors as $color)
                                        <option value="{{ $color }}" {{ old('color') == $color ? 'selected' : '' }}>
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
                                    type="text" step="any" value="{{ old('un_rating') }}"
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
                                    id="model_number_supply" step="any" value="{{ old('model_number') }}"
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
                                <select class="js-example-basic-single select2" id="open_supply" name="open">
                                    <option value="" disabled {{ old('open') ? '' : 'selected' }}>Select Open</option>
                                    <option value="Top" {{ old('open') == 'Top' ? 'selected' : '' }}>Top</option>
                                    <option value="Bottom" {{ old('open') == 'Bottom' ? 'selected' : '' }}>Bottom</option>
                                    <option value="Left" {{ old('open') == 'Left' ? 'selected' : '' }}>Left</option>
                                    <option value="Right" {{ old('open') == 'Right' ? 'selected' : '' }}>Right</option>
                                    <option value="Front" {{ old('open') == 'Front' ? 'selected' : '' }}>Front</option>
                                    <option value="Back" {{ old('open') == 'Back' ? 'selected' : '' }}>Back</option>
                                    <option value="Top & Bottom" {{ old('open') == 'Top & Bottom' ? 'selected' : '' }}>Top
                                        & Bottom</option>
                                    <option value="Left & Right" {{ old('open') == 'Left & Right' ? 'selected' : '' }}>
                                        Left & Right</option>
                                    <option value="All Sides" {{ old('open') == 'All Sides' ? 'selected' : '' }}>All Sides
                                    </option>
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
                                    value="{{ old('re_order_point') }}" placeholder="Enter Re-order Point"
                                    aria-label="default input example">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="re_order_quantity" class="table-content col737 fw-medium">Re-order
                                    Quantity</label>
                                <input class="form-control input-padding" type="number" name="re_order_quantity"
                                    value="{{ old('re_order_quantity') }}" placeholder="Enter Re-order Quantity"
                                    aria-label="default input example">
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
                                <input class="form-control input-padding" value="{{ old('tax_percentage') }}"
                                    type="number" name="tax_percentage" placeholder="Enter Tax"
                                    aria-label="default input example">
                                @error('tax_percentage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <input id="status" class="check" name="status" type="hidden" value="Active">
        </div>

        <div class="add-customer-btns d-flex" style="justify-self: right">
            <div class="btnWrapper">
                <button type="button" onclick="redirectTo('{{ route('admin.inventories.index') }}')"
                    class="btn btn-outline-primary custom-btn">Cancel</button>
                @can('has-dynamic-permission', 'service_inventory_list.create')    
                <button type="submit" class="btn btn-primary ">Submit</button>
                @endcan
            </div>
        </div>

        @error('status')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        </div>

    </form>

    @section('script')
        <script src="{{asset('js/inventory.js')}}"></script>
        <script>
            var countryOptionsData = @json(setting()->warehouseContries());
        </script>
    @endsection
</x-app-layout>