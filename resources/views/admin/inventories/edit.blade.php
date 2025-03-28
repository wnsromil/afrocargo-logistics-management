<x-app-layout>
    <x-slot name="header">
        Inventory Menagement
    </x-slot>

    <x-slot name="cardTitle">
        Edit New Inventory
    </x-slot>

    <form action="{{ route('admin.inventories.update',$inventory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="inventory_name">Inventory Type <i class="text-danger">*</i></label>
                        <select name="inventory_name" class="form-control select2Tags" >
                            <option selected value="{{ $inventory->category->name }}">{{ ucfirst($inventory->category->name) }}</option>
                        </select>

                        @error('inventory_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id">Warehouse Name <i class="text-danger">*</i></label>
                        <select name="warehouse_id" class="form-control select2"  >
                            <option selected value="{{ $inventory->warehouse->id }}">{{ $inventory->warehouse->warehouse_name }}</option>
                        </select>

                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                   <!-- weight -->
                   <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="weight">Weight(kg) <i class="text-danger">*</i></label>
                        <input type="number" name="weight" class="form-control" placeholder="Enter weight"
                            value="{{ $inventory->weight ?? '--'}}">
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
                            value="{{ $inventory->width ?? '--'}}">
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
                            value="{{ $inventory->height ?? '--'}}">
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
                            value="{{ $inventory->in_stock_quantity }}">
                        @error('in_stock_quantity')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Low Stock Warning -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="low_stock_warning">Low Stock Warning <i class="text-danger">*</i></label>
                        <input type="number" name="low_stock_warning" class="form-control" placeholder="Enter Low Stock Warning"
                            value="{{ $inventory->low_stock_warning }}">
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
                            value="{{ $inventory->price ?? '--'}}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Status -->

                <div class="col-lg-4 col-md-6 col-sm-12 align-center">
                    <div class="mb-3 float-end">
                        <label for="in_status">Status</label>
                        <div class="d-flex align-items-center text-dark">
                            <p class="profileUpdateFont" id="activeText">Active</p>
                            <div class="status-toggle px-2">
                                <input id="rating_6" class="check" type="checkbox" name="status" value="Active" @checked($inventory->status === 'Active')>
                                <label for="rating_6" class="checktoggle log checkbox-bg">checkbox</label>
                            </div>
                            <p class="profileUpdateFont faded" id="inactiveText">Inactive</p>
                        </div>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

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
</x-app-layout>