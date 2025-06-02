<x-app-layout>

    <x-slot name="header">
        Add Bill of Lading
    </x-slot>


    <x-slot name="cardTitle">
        <div class="innertopnav">
            <div class="subhead h5Size fw-semibold p-0">Add Bill of Lading</div>
            <nav aria-label="breadcrumb" class="mb-lg-0 mb-16">

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Bill of Lading</a></li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <a href="#" class="text-secondary"> Add Bill
                            of Lading </a>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer addTemplateForm mb-3">
            <div class="row mx-3">
                <div class="col-md-4 col-sm-12 col-lg-4 mb-3">
                    <label for="company_name" class="form-label text-dark">Company</label>
                    <input type="text" class="form-control" id="company_name" placeholder="Enter Company Name">
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4 mb-3 px-4">
                    <p for="templateTitle" class="form-label text-dark">Type<i class="text-danger">*</i></p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Shipper" name="ladingtype" id="radio1" checked>
                        <label class="form-check-label text-dark" for="inlineRadio1">Shipper</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Consignee" name="ladingtype" id="radio2">
                        <label class="form-check-label text-dark" for="inlineRadio2">Consignee</label>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-4 mb-3">
                    <label for="name" class="form-label text-dark">Name<i class="text-danger">*</i></label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" required>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4 mb-3">
                    <label for="address1" class="form-label text-dark">Address<i class="text-danger">*</i></label>
                    <input type="text" class="form-control" id="address1" placeholder="Enter Address" required>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-4 mb-3">
                    <label for="address2" class="form-label text-dark">Address 2</label>
                    <input type="text" class="form-control" id="address2" placeholder="Enter Address 2">
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4 mb-3">
                    <label for="city" class="form-label text-dark">City<i class="text-danger">*</i></label>
                    <input type="text" class="form-control" id="city" placeholder="Enter City" required>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-4">
                    <label for="state" class="form-label text-dark">State<i class="text-danger">*</i></label>
                    <input type="text" class="form-control" id="state" placeholder="Enter State" required>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-4">
                    <label for="zipcode" class="form-label text-dark">Zipcode<i class="text-danger">*</i></label>
                    <input type="text" class="form-control" id="zipcode" placeholder="Enter Zipcode" required>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor pt-0" for="telephone">Telephone <i class="text-danger">*</i></label>
                        <div class="flaginputwrap">
                            <div class="customflagselect">
                                <select class="flag-select" name="mobile_number_code_id">
                                    @foreach ($coutry as $key => $item)
                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                            data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                            {{ $item->name }} +{{ $item->phonecode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control form-select-sm py-0 flagInput inp"
                                placeholder="Enter Mobile No" name="telephone" value="201-555-0123"
                                oninput="this.value = this.value.slice(0, 10)">
                        </div>
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
                                <select class="flag-select" name="mobile_number_code_id">
                                    @foreach ($coutry as $key => $item)
                                        <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                            data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                            {{ $item->name }} +{{ $item->phonecode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="form-control form-select-sm py-0 flagInput inp"
                                placeholder="Enter Cellphone No" name="cellphone" value="201-555-0123"
                                oninput="this.value = this.value.slice(0, 10)">
                        </div>
                        @error('cellphone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12"></div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="add-customer-btns text-end mt-4">
                        <button type="button" onclick="redirectTo('{{ route('admin.drivers.index') }}')"
                            class="btn btn-outline-primary custom-btn">Cancel</button>

                        <button type="submit" class="btn btn-primary">Save</button>

                    </div>
                </div>



                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templateTitle">Template Title<i class="text-danger">*</i></label>
                        <input type="text" name="templateTitle" class="form-control inp"
                            placeholder="Enter Template Title">
                    </div>
                    </div> -->
                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templateTitle">Template Category<i
                                class="text-danger">*</i></label>
                        <select name="TemplateCategory" class="form-control inp select2">
                            <option disabled hidden selected value="">Select Template Category</option>
                            <option value="Category 1">Category 1</option>
                            <option value="Category 2">Category 2</option>
                            <option value="Category 3">Category 3</option>
                            <option value="Category 4">Category 4</option>
                            <option value="Category 5">Category 5</option>
                        </select>
                    </div>
                </div> -->

            </div>
        </div>
        <!-- <div class="row align-items-end">
            <div class="col-md-6">
                <div class="input-block mb-0">
                    <label class="foncolor" for="status">Status <i class="text-danger">*</i></label>
                    <div class="status-toggle">
                        <span>Active</span>
                        <input id="rating_1" class="check" type="checkbox" value="Active">
                        <label for="rating_1" class="checktoggle checkbox-bg"></label>
                        <span class="inactive">Inactive</span>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="col-md-6">
                <div class="add-customer-btns text-end">
                    <button type="button" onclick="redirectTo('{{route('admin.template_category.index') }}')"
                        class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary"
                        onclick="redirectTo('{{route('admin.template_category.index') }}')">Submit</button>

                </div>
            </div>
        </div> -->
    </form>

</x-app-layout>