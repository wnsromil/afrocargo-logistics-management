<x-app-layout>
    <x-slot name="header">
        Add Inventory
    </x-slot>

    <x-slot name="cardTitle">
        <p class="fw-semibold fs-5 text-dark">Add Inventory</p>
    </x-slot>

    <form action="{{ route('admin.inventories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="inventory_name" class="opacity-50">Inventory Type<i
                                class="text-danger">*</i></label>
                        <select class="form-select fw-normal profileUpdateFont opacity-75 p-2" name="inventory_name"
                            aria-label="Default select example">
                            <option>Select / Add Inventory</option>
                            @foreach ($categories as $category)
                                <option {{ old('inventory_name') == $category->name ? 'selected' : '' }}
                                    value="{{ $category->name }}">{{ ucfirst($category->name) }}</option>
                            @endforeach
                        </select>

                        @error('inventory_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id" class="opacity-50">Warehouse Name <i class="text-danger">*</i></label>

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
                        <label for="weight" class="opacity-50">Weight (kg)<i class="text-danger">*</i></label>
                        <input class="form-control input-padding" type="number" name="weight"
                            value="{{ old('weight') }}" placeholder="Enter Weight" aria-label="default input example"
                            required>

                        @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="width" class="opacity-50">Width (cm)</label>
                        <input class="form-control input-padding" name="width" type="number" value=""
                            placeholder="Enter Width" aria-label="default input example">

                        @error('width')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="height" class="opacity-50">Height (cm)</label>
                        <input class="form-control input-padding" name="height" type="number" value=""
                            placeholder="Enter Height" aria-label="default input example">

                        @error('height')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_stock_quantity" class="opacity-50">Quantity (kg)<i
                                class="text-danger">*</i></label>
                        <input class="form-control input-padding" type="number" name="in_stock_quantity"
                            value="{{ old('in_stock_quantity') }}" placeholder="Enter quantity"
                            aria-label="default input example" required>
                        @error('in_stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="low_stock_warning" class="opacity-50">Low Stock Warning <i
                                class="text-danger">*</i></label>
                        <input class="form-control" type="number" name="low_stock_warning"
                            value="{{ old('low_stock_warning') }}" placeholder="Enter Low Stock Warning"
                            aria-label="default input example" required>
                        @error('low_stock_warning')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="in_price">Price<i class="text-danger">*</i></label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="price" value="{{ old('price') }}"
                                placeholder="Enter price" required>
                            <h6><i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i></h6>
                        </div>

                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="in_status">Status</label>
                        <div class="d-flex">
                            <p class="profileUpdateFont" id="activeText">Active</p>
                            <div class="status-toggle px-2">
                                <input id="rating_6" class="check" type="checkbox" value="Inactive">
                                <label for="rating_6" class="checktoggle log checkbox-bg">checkbox</label>
                            </div>
                            <p class="profileUpdateFont faded" id="inactiveText">Inactive</p>
                        </div>
                    </div>
                </div>

                {{-- change status --}}
                <input id="status" class="check" name="status" type="hidden" value="Active">

            </div>
        </div>

        <div class="add-customer-btns text-end">
            <a href="{{ route('admin.inventories.index') }}" class="btn customer-btn-cancel px-3 py-2">Cancel</a>
            <button type="submit" class="btn customer btn-save px-3 py-2">Submit</button>
        </div>
        </div>
        </div>
    </form>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#rating_6').on('click', function() {
                if ($(this).is(':checked')) {
                    $('#status').val('Inactive');
                } else {
                    $('#status').val('Active');
                }
            });
        });
    </script>
</x-app-layout>
