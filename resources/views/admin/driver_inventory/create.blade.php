<x-app-layout>
    <x-slot name="header">
        Add Driver Inventory
    </x-slot>

    <x-slot name="cardTitle">
        Add Driver Inventory
    </x-slot>

    <form action="{{ route('admin.driver_inventory.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <!-- Date -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Date</label>
                        <div class="daterangepicker-wrap cal-icon cal-icon-info">
                            <input type="text" name="driverInventoryDate" class="btn-filters  form-cs inp  inputbackground"
                                   placeholder="MM/DD/YYYY" value="{{ old('driverInventoryDate') }}"  readonly style="cursor: pointer; background-color: #ffffff;" />
                            <input type="text" class="form-control inp inputs text-center timeOnlyInput" readonly 
                                   value="{{ old('currentTIme', $time) }}" name="currentTIme">
                            @error('driverInventoryDate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                @php
                    $role_id = Auth::user()->role_id;
                @endphp
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="driver_id">Driver<i class="text-danger">*</i></label>
                            <select name="driver_id" class="form-control select2">
                                <option value="">Select Driver</option>
                                @foreach($users as $user)
                                    <option {{ old('driver_id') == $user->id ? 'selected' : '' }}
                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('driver_id')
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
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="InOutType">In</label>
                                <input class="form-check-input mt-0" type="radio" value="In" name="InOutType" 
                                       {{ old('InOutType') == 'In' ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="InOutType">Out</label>
                                <input class="form-check-input mt-0" type="radio" value="Out" name="InOutType" 
                                       {{ old('InOutType') == 'Out' ? 'checked' : '' }}>
                            </div>
                        </div>
                        @error('InOutType')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>



                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="item_id">Items <i class="text-danger">*</i></label>
                        <select name="item_id" class="form-control select2Tags">
                            <option value="">Select Items</option>
                            @foreach($items as $item)
                                <option {{ old('item_id') == $item->id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                            @endforeach
                        </select>

                        @error('item_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- quantity -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="in_stock_quantity">Quantity <i class="text-danger">*</i></label>
                        <input type="number" name="in_stock_quantity" class="form-control" placeholder="Enter Quantity"
                            value="{{ old('in_stock_quantity') }}">
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