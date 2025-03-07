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
                        <!-- <select name="inventory_name" class="form-control select2Tags">
                            <option value="">Select Warehouse Name</option>
                            @foreach($categories as $category)
                                <option {{ old('inventory_name') == $category->name ? 'selected' :'' }} value="{{ $category->name }}">{{ ucfirst($category->name) }}</option>
                            @endforeach
                        </select> -->
                        <select class="form-select fw-normal profileUpdateFont opacity-75 p-2" name="inventory_name"
                            aria-label="Default select example">
                            <option>Select / Add Inventory</option>
                            @foreach($categories as $category)
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
                        <!-- <select name="warehouse_id" class="form-control select2">
                            <option select value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                                <option {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select> -->
                        <select class="form-select fw-normal profileUpdateFont opacity-75 p-2" name="warehouse_id"
                            aria-label="Default select example">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
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
                        <label for="in_stock_quantity" class="opacity-50">Weight (kg)<i
                                class="text-danger">*</i></label>
                        <input class="form-control input-padding" type="number" name="in_stock_quantity"
                            value="{{ old('in_stock_quantity') }}" placeholder="Enter Weight"
                            aria-label="default input example" required>

                        @error('in_stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_width" class="opacity-50">Width (cm)</label>
                        <input class="form-control input-padding" type="number" value="" placeholder="Enter Width"
                            aria-label="default input example">

                        @error('in_stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_height" class="opacity-50">Height (cm)</label>
                        <input class="form-control input-padding" type="number" value="" placeholder="Enter Height"
                            aria-label="default input example">

                        @error('in_stock_quantity')
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
                            <input class="no-border" type="number" name="in_stock_price"
                                value="{{ old('in_stock_price') }}" placeholder="Enter price" required>
                            <h6><i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i></h6>
                        </div>

                        @error('in_stock_price')
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
                                        <input id="rating_6" class="check" type="checkbox">
                                        <label for="rating_6" class="checktoggle log checkbox-bg">checkbox</label>
                                    </div>
                            <p class="profileUpdateFont faded" id="inactiveText">Inactive</p>
                        </div>
                    </div>
                </div>


                <div class="add-customer-btns text-end">
                    <a href="{{ route('admin.inventories.index') }}" class="btn customer-btn-cancel px-3 py-2">Cancel</a>
                    <button type="submit" class="btn customer btn-save px-3 py-2">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <!-- ------------------------------------------------------------------------------------------------------------- -->


    <!-- <form action="{{ route('admin.inventories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="inventory_name">Inventory Name <i class="text-danger">*</i></label>
                        <select name="inventory_name" class="form-control select2Tags">
                            <option value="">Select Warehouse Name</option>
                            @foreach($categories as $category)
                                <option {{ old('inventory_name') == $category->name ? 'selected' :'' }} value="{{ $category->name }}">{{ ucfirst($category->name) }}</option>
                            @endforeach
                        </select>

                        @error('inventory_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->

    <!-- Warehouse Name -->
    <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id">Warehouse Name <i class="text-danger">*</i></label>
                        <select name="warehouse_id" class="form-control select2">
                            <option value="">Select Warehouse</option>
                            @foreach ($warehouses as $warehouse)
                                <option {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>

                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> -->


                <!-- weight -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="weight">Weight(kg) <i class="text-danger">*</i></label>
                        <input type="number" name="weight" class="form-control" placeholder="Enter weight"
                            value="{{ old('weight') }}">
                        @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- width -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="width">Width(cm) </label>
                        <input type="number" name="width" class="form-control" placeholder="Enter width"
                            value="{{ old('width') }}">
                        @error('width')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                  <!-- height -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="height">Height(cm) </label>
                        <input type="number" name="height" class="form-control" placeholder="Enter height"
                            value="{{ old('height') }}">
                        @error('height')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                 <!-- quantity -->
                 <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_stock_quantity">Quantity <i class="text-danger">*</i></label>
                        <input type="number" name="in_stock_quantity" class="form-control" placeholder="Enter quantity"
                            value="{{ old('in_stock_quantity') }}">
                        @error('in_stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Low Stock Warning -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="low_stock_warning">Low Stock Warning <i class="text-danger">*</i></label>
                        <input type="number" name="low_stock_warning" class="form-control"
                            placeholder="Enter Low Stock Warning" value="{{ old('low_stock_warning') }}">
                        @error('low_stock_warning')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>  

                <!-- price -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="price">Price <i class="text-danger">*</i></label>
                        <input type="number" name="price" class="form-control" placeholder="Enter price"
                            value="{{ old('price') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status">Status</label>
                        <div class="toggle-switch">
                            <label for="cb-switch">
                                <input type="checkbox" id="cb-switch" name="status" value="Active">
                                <span>
                                    <small></small>
                                </span>
                            </label>
                        </div>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="add-customer-btns text-end">
            <a href="{{ route('admin.inventories.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save">Submit</button>
        </div>

    </form>
</x-app-layout>
