<x-app-layout>
    <x-slot name="header">
        Add Inventory
    </x-slot>

    <x-slot name="cardTitle">
        <div class="innertopnav">
            <p class="fw-semibold fs-5 text-dark pheads">Add Inventory</p>
        </div>
    </x-slot>

    <form action="{{ route('admin.inventories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-2 col-md-3">
                            <div class="input-block">
                                <label class="foncolor m-0 p-0">Type<i class="text-danger">*</i></label>
                            </div>
                        </div>          
                        <div class="col-lg-2 col-md-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-2 col3A">Supply</label>
                                <input class="form-check-input mt-0" type="radio" value="Supply" name="inventoryType" checked>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="inventory_name" class="table-content col737 fw-medium">Item Name <i class="text-danger">*</i></label>
                        <input class="form-control input-padding" name="inventory_name" type="text" value="" placeholder="Enter Item Name" aria-label="default input example">

                        @error('inventory_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block border-0 mb-3">
                        <label for="warehouse_id" class="table-content col737 fw-medium">Warehouse Name <i class="text-danger">*</i></label>

                        <select class="form-control select2" name="warehouse_id">
                            <option disabled hidden selected value="">Select Warehouse Name</option>
                            @foreach ($warehouses as $warehouse)
                            <option {{ old('warehouse_id')==$warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>

                        @error('warehouse_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_stock_quantity" class="table-content col737 fw-medium">Quantity<i class="text-danger">*</i></label>
                        <input class="form-control input-padding" type="number" name="in_stock_quantity" value="{{ old('in_stock_quantity') }}" placeholder="Enter quantity" aria-label="default input example">
                        @error('in_stock_quantity')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="low_stock_warning" class="table-content col737 fw-medium">Low Stock
                            Warning <i class="text-danger">*</i></label>
                        <input class="form-control text-dark" type="number" name="low_stock_warning" value="{{ old('low_stock_warning') }}" placeholder="Enter Low Stock Warning" aria-label="default input example">
                        @error('low_stock_warning')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_price" class="table-content col737 fw-medium required text-dark">Price </label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="price" value="{{ old('price') }}" placeholder="Enter price">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>

                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block">
                        <label class="table-content col737 fw-medium">Inventory Image </label>
                        <div class="input-block mb-3 service-upload img-size2 mb-0">
                            <span id="upload_inventory_image">
                                <svg width="65" height="37" viewBox="0 0 65 37" fill="none" style="color:black;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="65" height="37" fill="url(#pattern0_2250_39084)" style="mix-blend-mode:luminosity" />
                                    <defs>
                                        <pattern id="pattern0_2250_39084" patternContentUnits="objectBoundingBox" width="1" height="1">
                                            <use xlink:href="#image0_2250_39084" transform="matrix(0.00877193 0 0 0.0154101 0 -0.000829777)" />
                                        </pattern>
                                        <image id="image0_2250_39084" width="114" height="65" preserveAspectRatio="none" xlink:href="data:image/png;base64,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" />
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
                <div class="col-lg-4 col-md-6 col-sm-12 align-center mt-n6">
                    <div class="mb-3 float-end">
                        <label for="in_status" class="foncolor fw_500" >Status</label>
                        <div class="status-toggle d-flex align-items-center">
                            <span id="inactiveText" class="bold">Active</span>
                            <input id="status" class="check" type="checkbox" name="status">
                            <label for="status" class="checktoggle checkbox-bg togc"></label>
                            <span id="activeText">Inactive</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 pt-3 mt-3 border-top">
                <div id="cargoDiv">
                    <div class="row">
                        <div class="col-12">
                            <p class="heading mb-3">Ocean Cargo/Air Cargo</p>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block border-0 mb-3">
                                <label for="warehouse_id" class="table-content col737 fw-medium">Country <i class="text-danger">*</i></label>

                                <select class="form-control select2" name="warehouse_id">
                                    <option disabled hidden selected value="">Select Country</option>
                                    <option value="USA">USA</option>
                                    <option value="USA">South Africa</option>
                                </select>

                                @error('warehouse_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="weight" class="table-content col737 fw-medium">Weight (kg)</label>
                                <input class="form-control input-padding" type="number" name="weight" value="{{ old('weight') }}" placeholder="Enter Weight" step="any" aria-label="default input example">

                                @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="width" class="table-content col737 fw-medium">Item Length(inch) </label>
                                <input class="form-control input-padding" name="length" type="number" step="any" value="" placeholder="Enter Item Length" aria-label="default input example">

                                @error('width')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="width" class="table-content col737 fw-medium">Width </label>
                                <input class="form-control input-padding" name="width" type="number" step="any" value="" placeholder="Enter Width" aria-label="default input example">

                                @error('width')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="height" class="table-content col737 fw-medium">Height</label>
                                <input class="form-control input-padding" name="height" type="number" step="any" value="" placeholder="Enter Height" aria-label="default input example">

                                @error('height')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label for="height" class="table-content col737 fw-medium">Volume(l*b*h)</label>
                                <input class="form-control input-padding" readonly name="volume" type="number" step="any" value="" placeholder="value" aria-label="default input example">

                                @error('height')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div id="airDiv" style="display:none;">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="emailId">Air<i class="text-danger">*</i></label>
                        <input type="text" name="emailId" class="form-control inp" placeholder="Enter Email ID">
                    </div>
                </div>

                <div id="supplyDiv" style="display:none;">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="alternate_mobile_no">Supply</label>
                        <input type="tel" id="alternate_mobile_no" name="alternate_mobile_no" class="form-control inp" placeholder="Enter Alternate Mobile No.">
                    </div>
                </div>
            </div>


            <div class="add-customer-btns text-end">
                <button type="button" onclick="redirectTo('{{ route('admin.inventories.index') }}')" class="btn btn-outline-primary custom-btn">Cancel</button>
                <button type="submit" class="btn btn-primary ">Submit</button>
            </div>

            <input id="status" class="check" name="status" type="hidden" value="Active">
        </div>
        @error('status')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        </div>

    </form>


    @section('script')
    <script>
        document.querySelectorAll('input[name="inventoryType"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('cargoDiv').style.display = this.value === 'Ocean Cargo' ? 'block' : 'none';
                document.getElementById('airDiv').style.display = this.value === 'Air Cargo' ? 'block' : 'none';
                document.getElementById('supplyDiv').style.display = this.value === 'Supply' ? 'block' : 'none';
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
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

        document.getElementById('inventory_image').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = ''; // Clear previous previews
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    img.style.height = 'auto';
                    img.classList.add('mt-2', 'img-thumbnail');
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
                $('#upload_inventory_image').hide();
            }
        });

    </script>
    @endsection

</x-app-layout>
