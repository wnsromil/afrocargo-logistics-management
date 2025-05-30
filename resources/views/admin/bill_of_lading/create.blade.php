<x-app-layout>

    <x-slot name="header">
        Add Bill of Lading
    </x-slot>


    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Bill of Lading</p>
        </div>
    </x-slot>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer addTemplateForm mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor" for="templateTitle">Type<i class="text-danger">*</i></label>
                            </div>
                        </div>
                        <div class="me-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Shipper</label> <input class="form-check-input mt-0" type="radio" value="Shipper" name="ladingtype">
                            </div>
                        </div>
                        <div class="me-3">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Consignee</label> <input class="form-check-input mt-0" type="radio" value="Consignee" name="ladingtype">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templateTitle">Template Title<i class="text-danger">*</i></label>
                        <input type="text" name="templateTitle" class="form-control inp" placeholder="Enter Template Title">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templateTitle">Template Category<i class="text-danger">*</i></label>
                        <select name="TemplateCategory" class="form-control inp select2">
                            <option disabled hidden selected value="">Select Template Category</option>
                            <option value="Category 1">Category 1</option>
                            <option value="Category 2">Category 2</option>
                            <option value="Category 3">Category 3</option>
                            <option value="Category 4">Category 4</option>
                            <option value="Category 5">Category 5</option>
                        </select>
                    </div>
                </div>

            </div>

        </div>
        <div class="row align-items-end">
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
                    <button type="button" onclick="redirectTo('{{route('admin.template_category.index') }}')" class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary" onclick="redirectTo('{{route('admin.template_category.index') }}')">Submit</button>

                </div>
            </div>
        </div>
    </form>

</x-app-layout>
