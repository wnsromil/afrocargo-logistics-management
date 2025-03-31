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

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="inventory_type" class="table-content profileUpdateFont fw-medium">Inventory Type<i
                                class="text-danger">*</i></label>
                        <select class="form-select fw-normal profileUpdateFont opacity-75 p-2" name="inventory_type"
                            aria-label="Default select example">
                            <option value="">Select / Add Inventory</option>
                            @foreach ($categories as $category)
                                <option {{ old('inventory_type') == $category->name ? 'selected' : '' }}
                                    value="{{ $category->name }}">{{ ucfirst($category->name) }}</option>
                            @endforeach
                        </select>

                        @error('inventory_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="inventory_name" class="table-content profileUpdateFont fw-medium">Item Name<i
                                class="text-danger">*</i></label>
                        <input class="form-control input-padding" name="inventory_name" type="text" value=""
                            placeholder="Enter Item Name" aria-label="default input example" >

                        @error('inventory_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id" class="table-content profileUpdateFont fw-medium">Warehouse Name <i
                                class="text-danger">*</i></label>

                        <select class="form-select fw-normal profileUpdateFont opacity-75 p-2" name="warehouse_id"
                            aria-label="Default select example">
                            <option value="">Select Warehouse Name</option>
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
                        <label for="weight" class="table-content profileUpdateFont fw-medium">Weight (kg)</label>
                        <input class="form-control input-padding" type="number" name="weight"
                            value="{{ old('weight') }}" placeholder="Enter Weight" aria-label="default input example">

                        @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="width" class="table-content profileUpdateFont fw-medium">Width (cm)</label>
                        <input class="form-control input-padding" name="width" type="number" value=""
                            placeholder="Enter Width" aria-label="default input example">

                        @error('width')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="height" class="table-content profileUpdateFont fw-medium">Height (cm)</label>
                        <input class="form-control input-padding" name="height" type="number" value=""
                            placeholder="Enter Height" aria-label="default input example">

                        @error('height')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_stock_quantity" class="table-content profileUpdateFont fw-medium">Quantity (kg)<i
                                class="text-danger">*</i></label>
                        <input class="form-control input-padding" type="number" name="in_stock_quantity"
                            value="{{ old('in_stock_quantity') }}" placeholder="Enter quantity"
                            aria-label="default input example">
                        @error('in_stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="low_stock_warning" class="table-content profileUpdateFont fw-medium">Low Stock
                            Warning <i class="text-danger">*</i></label>
                        <input class="form-control text-dark" type="number" name="low_stock_warning"
                            value="{{ old('low_stock_warning') }}" placeholder="Enter Low Stock Warning"
                            aria-label="default input example">
                        @error('low_stock_warning')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="in_price"
                            class="table-content profileUpdateFont fw-medium required text-dark">Price</label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="price" value="{{ old('price') }}"
                                placeholder="Enter price" >
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>

                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block">
                        <label class="table-content profileUpdateFont fw-medium required">Inventory Image</label>
                        <div class="input-block mb-3 service-upload img-size2 mb-0">
                            <span>
                                <svg width="65" height="37" viewBox="0 0 65 37" fill="none" style="color:black;" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="65" height="37" fill="#ddd" />
                                </svg>
                            </span>
                            <h6 class="drop-browse align-center">Upload Image</h6>
                            <input type="file" id="inventory_image" class="form-control" accept="image/*">
                            <div id="preview" class="mt-2">
                                <!-- Image preview will be shown here -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                    <div class="mb-3 float-end">
                        <label for="in_status">Status</label>
                        <div class="d-flex align-items-center text-dark">
                            <p class="profileUpdateFont" id="activeText">Active</p>
                            <div class="status-toggle px-2">
                                <input id="rating_16" class="check" type="checkbox" value="Inactive">
                                <label for="rating_16" class="checktoggle tog-circle checkbox-bg">checkbox</label>
                            </div>
                            <p class="profileUpdateFont faded" id="inactiveText">Inactive</p>
                        </div>

                    </div>
                </div>


                <div class="add-customer-btns text-end">
                    <button type="button" onclick="redirectTo('{{ route('admin.inventories.index') }}')"
                        class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>
                
                {{-- change status --}}
                <input id="status" class="check" name="status" type="hidden" value="Active">

            </div>


            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        </div>

    </form>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#rating_6').change(function () {
                if ($(this).is(':checked')) {
                    $('#inactiveText').removeClass('faded');
                    $('#activeText').addClass('faded');
                } else {
                    $('#activeText').removeClass('faded');
                    $('#inactiveText').addClass('faded');
                }
            });
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
            }
        });
        
    </script>
</x-app-layout>