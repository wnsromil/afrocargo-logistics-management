<x-app-layout>

    <x-slot name="header">
        Edit Bill of Lading
    </x-slot>

    <x-slot name="cardTitle">
        <div class="innertopnav">
            <div class="subhead">Edit Bill of Lading</div>
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

    <form action="{{ route('admin.bill_of_lading.update', $billOfLading->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer addTemplateForm mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="input-block mb-3">
                        <p for="templateTitle" class="form-label text-dark">Type<i class="text-danger">*</i></p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Shipper" name="type" id="radio1" {{ old('type', $billOfLading->type) == 'Shipper' ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="inlineRadio1">Shipper</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Consignee" name="type" id="radio2" {{ old('type', $billOfLading->type) == 'Consignee' ? 'checked' : '' }}>
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
                        <input type="text" class="form-control inp" id="company" name="company" placeholder="Enter Company Name" value="{{ old('company', $billOfLading->company) }}">
                        @error('company')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="name" class="form-label text-dark">Name<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="name" name="name" placeholder="Enter Name" required value="{{ old('name', $billOfLading->name) }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="address" class="form-label text-dark">Address<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="address" name="address" placeholder="Enter Address" required value="{{ old('address', $billOfLading->address) }}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="address2" class="form-label text-dark">Address 2</label>
                        <input type="text" class="form-control inp" id="address2" name="address2" placeholder="Enter Address 2" value="{{ old('address2', $billOfLading->address2) }}">
                        @error('address2')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="city" class="form-label text-dark">City<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="city" name="city" placeholder="Enter City" required value="{{ old('city', $billOfLading->city) }}">
                        @error('city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="state" class="form-label text-dark">State<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="state" name="state" placeholder="Enter State" required value="{{ old('state', $billOfLading->state) }}">
                        @error('state')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4">
                    <div class="input-block mb-3">
                        <label for="zip" class="form-label text-dark">Zipcode<i class="text-danger">*</i></label>
                        <input type="text" class="form-control inp" id="zip" name="zip" placeholder="Enter Zipcode" required value="{{ old('zip', $billOfLading->zip) }}">
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
                                        {{ old('phone_code', $billOfLading->phone_code) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} +{{ $item->phonecode }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control form-select-sm py-0 flagInput inp" placeholder="Enter Mobile No" name="phone" value="{{ old('phone', $billOfLading->phone) }}" oninput="this.value = this.value.slice(0, 10)">
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
                                        {{ old('cellphone_code', $billOfLading->cellphone_code) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} +{{ $item->phonecode }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control form-select-sm py-0 flagInput inp" placeholder="Enter Cellphone No" name="cellphone" value="{{ old('cellphone', $billOfLading->cellphone) }}" oninput="this.value = this.value.slice(0, 10)">
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>

            </div>
        </div>
    </form>

</x-app-layout>
