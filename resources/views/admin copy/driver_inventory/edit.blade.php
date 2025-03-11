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
                        <label for="inventory_name">Inventory Name <i class="text-danger">*</i></label>
                        <select name="inventory_name" class="form-control select2Tags">
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
                        <select name="warehouse_id" class="form-control select2" >
                            <option selected value="{{ $inventory->warehouse->id }}">{{ $inventory->warehouse->warehouse_name }}</option>
                        </select>

                        @error('warehouse_id')
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

                <!-- Status -->
                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status">Status <i class="text-danger">*</i></label>
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
                </div> --}}
            </div>
        </div>

        <div class="add-customer-btns text-end">
            <a href="{{ route('admin.warehouses.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save">Submit</button>
        </div>
    </form>
</x-app-layout>