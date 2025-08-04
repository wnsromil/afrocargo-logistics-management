<x-app-layout>

    <x-slot name="header">
        Add Bill of Lading
    </x-slot>


    <x-slot name="cardTitle">
        <div class="innertopnav">
            <div class="subhead">Add Bill of Lading</div>
        </div>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('admin.bill_of_lading.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer addTemplateForm mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="input-block mb-3">
                        <p for="templateTitle" class="form-label text-dark">Type<i class="text-danger">*</i></p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Shipper" name="type" id="radio1" {{ old('type', 'Shipper') == 'Shipper' ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="inlineRadio1">Shipper</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Consignee" name="type" id="radio2" {{ old('type') == 'Consignee' ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="inlineRadio2">Consignee</label>
                        </div>
                        @error('type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="company" class="form-label text-dark">Company</label>
                        <input type="text" class="form-control inp" id="company" name="company" placeholder="Enter Company Name" value="{{ old('company') }}">
                        @error('company')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="name" class="form-label text-dark">Name<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="name" name="name" placeholder="Enter Name" required value="{{ old('name') }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="address" class="form-label text-dark">Address<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="address" name="address" placeholder="Enter Address" required value="{{ old('address') }}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="address2" class="form-label text-dark">Address 2</label>
                        <input type="text" class="form-control inp" id="address2" name="address2" placeholder="Enter Address 2" value="{{ old('address2') }}">
                        @error('address2')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="city" class="form-label text-dark">City<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="city" name="city" placeholder="Enter City" required value="{{ old('city') }}">
                        @error('city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="state" class="form-label text-dark">State<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="state" name="state" placeholder="Enter State" required value="{{ old('state') }}">
                        @error('state')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="zip" class="form-label text-dark">Zipcode<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="zip" name="zip" placeholder="Enter Zipcode" required value="{{ old('zip') }}">
                        @error('zip')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor pt-0" for="phone">Telephone <i class="text-danger">*</i></label>
                        <div class="flaginputwrap">
                            <div class="customflagselect">
                                <select class="flag-select" name="phone_code">
                                    @foreach ($coutry as $key => $item)
                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                        {{ old('phone_code') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} +{{ $item->phonecode }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control form-select-sm py-0 flagInput inp" placeholder="Enter Mobile No" name="phone" value="{{ old('phone', '201-555-0123') }}" oninput="this.value = this.value.slice(0, 10)">
                        </div>
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @error('telephone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor pt-0" for="cellphone">Cellphone</label>
                        <div class="flaginputwrap">
                            <div class="customflagselect">
                                <select class="flag-select" name="cellphone_code">
                                    @foreach ($coutry as $key => $item)
                                    <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}" data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}"
                                        {{ old('cellphone_code') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} +{{ $item->phonecode }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control form-select-sm py-0 flagInput inp" placeholder="Enter Cellphone No" name="cellphone" value="{{ old('cellphone', '201-555-0123') }}" oninput="this.value = this.value.slice(0, 10)">
                        </div>
                        @error('cellphone_code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @error('cellphone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="add-customer-btns text-end mt-4">
                        <button type="button" onclick="redirectTo('{{ route('admin.bill_of_lading.index') }}')" class="btn btn-outline-primary custom-btn">Cancel</button>
                        @can('has-dynamic-permission', 'bill_of_landing_list.create')
                        <button type="submit" class="btn btn-primary">Save</button>
                        @endcan
                    </div>
                </div>

            </div>
        </div>
    </form>

</x-app-layout>
