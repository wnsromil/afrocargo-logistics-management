<x-app-layout>
    <x-slot name="header">
        Inventory Management
    </x-slot>

    <x-slot name="cardTitle">
        <div class="innertopnav">
            <p class="fw-semibold fs-5 text-dark pheads">Update Inventory</p>
        </div>
    </x-slot>

    <form action="{{ route('admin.inventories.update', $inventory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="inventory_type" class="table-content col737 fw-medium">Inventory Type<i
                                class="text-danger"> *</i></label>
                        <select class="form-select fw-normal opacity-75 p-2" name="inventory_type"
                            aria-label="Default select example">
                            <option value="">Select / Add Inventory</option>
                            @foreach ($categories as $category)
                                <option {{ old('inventory_type') == $category->name || $inventory->inventory_type == $category->name ? 'selected' : '' }}
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
                        <label for="inventory_name" class="table-content col737 fw-medium">Item Name<i
                                class="text-danger"> *</i></label>
                        <input class="form-control input-padding" name="inventory_name" type="text"
                            value="{{ $inventory->name ?? '' }}" placeholder="Enter Item Name"
                            aria-label="default input example">

                        @error('inventory_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id" class="table-content col737 fw-medium">Warehouse Name <i
                                class="text-danger"> *</i></label>

                        <select class="form-select fw-normal opacity-75 p-2" name="warehouse_id"
                            aria-label="Default select example">
                            <option value="">Select Warehouse Name</option>
                            @foreach ($warehouses as $warehouse)
                                <option {{ $inventory->warehouse_id == $warehouse->id ? 'selected' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>

                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- weight -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="weight" class="col737">Weight(kg)</label>
                        <input type="number" name="weight" class="form-control" placeholder="Enter weight"
                            value="{{ $inventory->weight ?? ''}}">
                        @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- width -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="width" class="col737">Width(cm) </label>
                        <input type="number" name="width" class="form-control" placeholder="Enter width"
                            value="{{ $inventory->width ?? ''}}">
                        @error('width')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- height -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="height" class="col737">Height(cm) </label>
                        <input type="number" name="height" class="form-control" placeholder="Enter height"
                            value="{{ $inventory->height ?? ''}}">
                        @error('height')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- quantity -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_stock_quantity" class="col737">Quantity <i class="text-danger">*</i></label>
                        <input type="number" name="in_stock_quantity" class="form-control" placeholder="Enter quantity"
                            value="{{ $inventory->in_stock_quantity }}">
                        @error('in_stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Low Stock Warning -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="low_stock_warning" class="col737">Low Stock Warning <i
                                class="text-danger">*</i></label>
                        <input type="number" name="low_stock_warning" class="form-control"
                            placeholder="Enter Low Stock Warning" value="{{ $inventory->low_stock_warning }}">
                        @error('low_stock_warning')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- price -->

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="in_price" class="table-content profileUpdateFont fw-medium col737">Price 
                            <i class="text-danger">*</i></label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="price" value="{{ $inventory->price ?? ''}}"
                                placeholder="Enter price">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block">
                        <label class="table-content fw-medium col737 required">Inventory Image</label>
                        <div class="input-block mb-3 service-upload img-size2 mb-0">
                            <span id="upload_inventory_image">
                                <img src="{{asset('assets/img/Rectangle 27.png')}}" class="border-0" alt="inventory">
                            </span>

                            <input type="file" id="inventory_image" name="img" class="form-control" accept="image/*">
                            <div id="preview" class="mt-2">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                </div>

                <!-- Status -->

                <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                    <div class="mb-3 float-end">
                        <label for="in_status">Status</label>
                        <div class="status-toggle d-flex align-items-center">
                            <span id="inactiveText" class="bold">Active</span>
                            <input id="status" class="check" type="checkbox" name="status">
                            <label for="status" class="checktoggle checkbox-bg togc"></label>
                            <!-- <input id="status" class="check d-none" type="checkbox" name="status" checked>
                            <label for="status" class="checktoggle checkbox-bg togc mx-2"></label> -->
                            <span id="activeText">Inactive</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="add-customer-btns text-end">
            <button type="button" onclick="redirectTo('{{ route('admin.inventories.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>
            <button type="submit" class="btn btn-primary ">Submit</button>
        </div>

    </form>

    @section('script')
        <script>
            document.getElementById('inventory_image').addEventListener('change', function (event) {
                const preview = document.getElementById('preview');
                preview.innerHTML = ''; // Clear previous previews
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
                    $('#upload_inventory_image').hide();
                }
            });

        </script>

        <script>
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
        </script>
    @endsection
</x-app-layout>