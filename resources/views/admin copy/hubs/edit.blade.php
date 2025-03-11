<x-app-layout>
    <x-slot name="header">
        Edit Parcel
    </x-slot>

    <x-slot name="cardTitle">
        Update Parcel Information
    </x-slot>

    <form action="{{ route('admin.OrderShipment.update', $parcel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="tracking_number">Tracking Number <i class="text-danger">*</i></label>
                        <input type="text" name="tracking_number" class="form-control" value="{{ old('tracking_number', $parcel->tracking_number) }}">
                        @error('tracking_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="customer_id">Customer <i class="text-danger">*</i></label>
                        <select name="customer_id" class="form-control select2">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id', $parcel->customer_id) == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Driver -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="driver_id">Driver</label>
                        <select name="driver_id" class="form-control select2">
                            <option value="">Select Driver</option>
                            @foreach($drivers as $driver)
                                <option {{ old('driver_id', $parcel->driver_id) == $driver->id ? 'selected' : '' }} value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                        @error('driver_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id">Warehouse<i class="text-danger">*</i></label>
                        <select name="warehouse_id" class="form-control select2">
                            <option value="">Select Warehouse</option>
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $parcel->warehouse_id) == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="weight">Weight <i class="text-danger">*</i></label>
                        <input type="text" name="weight" class="form-control" value="{{ old('weight', $parcel->weight) }}">
                        @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="parcel_car_ids">Parcel Types<i class="text-danger">*</i></label>
                        <select name="parcel_car_ids[]" class="form-control select2" multiple>
                            <option value="">Select Warehouse</option>
                            @foreach($parcelTpyes as $parcelTpye)
                                <option value="{{ $parcelTpye->id }}" {{ in_array($parcelTpye->id,old('parcel_car_ids', $parcel->parcel_car_ids ?? [])) ? 'selected' : '' }}>{{ $parcelTpye->name }}</option>
                            @endforeach
                        </select>
                        @error('parcel_car_ids')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                 <!-- Payment Type -->
                 <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="payment_type">Payment Type <i class="text-danger">*</i></label>
                        <select name="payment_type" class="form-control">
                            <option value="COD" {{ old('payment_type') == 'COD' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                            <option value="Online" {{ old('payment_type') == 'Online' ? 'selected' : '' }}>Online Payment</option>
                        </select>
                        @error('payment_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="total_amount">Total Amount ($) <i class="text-danger">*</i></label>
                        <input type="number" step="0.01" name="total_amount" class="form-control" placeholder="Enter total amount" value="{{ old('total_amount', $parcel->total_amount) }}">
                        @error('total_amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Partial Payment -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="partial_payment">Partial Payment ($)</label>
                        <input type="number" step="0.01" name="partial_payment" class="form-control" placeholder="Enter partial payment" value="{{ old('partial_payment', $parcel->partial_payment) }}">
                        @error('partial_payment')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Remaining Payment -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="remaining_payment">Remaining Payment ($)</label>
                        <input type="number" step="0.01" name="remaining_payment" class="form-control" placeholder="Enter remaining payment" value="{{ old('remaining_payment', $parcel->remaining_payment) }}">
                        @error('remaining_payment')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="status">Status <i class="text-danger">*</i></label>
                        <select name="status" class="form-control">
                            @foreach($parcelStatuses as $status)
                                <option value="{{ $status }}" {{ old('status', $parcel->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="input-block mb-3">
                        <label for="source_address">Source Address <i class="text-danger">*</i></label>
                        <textarea name="source_address" class="form-control">{{ old('source_address', $parcel->source_address) }}</textarea>
                        @error('source_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="input-block mb-3">
                        <label for="destination_address">Destination Address <i class="text-danger">*</i></label>
                        <textarea name="destination_address" class="form-control">{{ old('destination_address', $parcel->destination_address) }}</textarea>
                        @error('destination_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Description -->
                <div class="col-lg-12">
                    <div class="input-block mb-3">
                        <label for="descriptions">Description</label>
                        <textarea name="descriptions" class="form-control" rows="3" placeholder="Enter parcel details">{{ old('descriptions', $parcel->descriptions) }}</textarea>
                        @error('descriptions')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="add-customer-btns text-end">
            <a href="{{ route('admin.OrderShipment.index') }}" class="btn customer-btn-cancel">Cancel</a>
            <button type="submit" class="btn customer-btn-save">Update</button>
        </div>
    </form>
</x-app-layout>
