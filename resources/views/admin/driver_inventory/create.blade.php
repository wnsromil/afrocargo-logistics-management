<x-app-layout>
    <x-slot name="header">
        Add Driver Inventory
    </x-slot>

    <x-slot name="cardTitle">
        Add Driver Inventory
    </x-slot>

    <form action="{{ route('admin.inventories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Date -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Date</label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" name="driverInventoryDate" class="datetimepicker form-cs inp " placeholder="mm-dd-yy" />
                            <input type="text" class="form-control inp inputs text-center timeOnlyInput" readonly value="08:30 AM" name="currentTIme">
                        </div>
                    </div>
                </div>

                <!-- Warehouse Name -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id">Warehouse Name <i class="text-danger">*</i></label>
                        <select name="warehouse_id" class="form-control select2">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                            <option {{ old('warehouse_id') == $warehouse->id ? 'selected' :'' }} value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>

                        @error('warehouse_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="input-block mb-1">
                        <label for="InOutType">In Out<i class="text-danger">*</i></label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="InOutType">In</label> <input class="form-check-input mt-0" type="radio" value="In" name="InOutType">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="InOutType">Out</label> <input class="form-check-input mt-0" type="radio" value="Out" name="InOutType">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="inventory_name">Items <i class="text-danger">*</i></label>
                        <select name="inventory_name" class="form-control select2Tags">
                            <option value="">Select Items</option>
                            @foreach($categories as $category)
                            <option {{ old('inventory_name') == $category->name ? 'selected' :'' }} value="{{ $category->name }}">{{ ucfirst($category->name) }}</option>
                            @endforeach
                        </select>

                        @error('inventory_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- quantity -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_stock_quantity">Quantity <i class="text-danger">*</i></label>
                        <input type="number" name="in_stock_quantity" class="form-control" placeholder="Enter Quantity" value="{{ old('in_stock_quantity') }}">
                        @error('in_stock_quantity')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                <!-- Status -->
                {{-- <div class="col-lg-6 col-md-6 col-sm-12">
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
            <a href="{{ route('admin.inventories.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save btn-primary">Submit</button>
        </div>
    </form>
</x-app-layout>
