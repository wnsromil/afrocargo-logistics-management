<x-app-layout>
    @section('style')
    <style>
        .form-group-customer.customer-additional-form {
            border: 0;
            margin: 0;
        }
    </style>
    @endsection
    <x-slot name="header">
        Add New Expenses
    </x-slot>

    <x-slot name="cardTitle">
        <p class="subhead me-sm-4">Add New Expenses </p>
    </x-slot>

    <div class="">

        <form id="expenses" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group-customer customer-additional-form">
                <!-- first row end  -->
                <div class="row mt-0 g-3 align-items-stretch">
                    <div class="col-md-6">
                        <div class="borderset">
                            <div class="row gx-3 gy-2">

                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="country">Warehouse <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">Select Warehouse</option>
                                        <option>white</option>
                                        <option>purple</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label> Due Date <i class="text-danger">*</i></label>
                                    <div class="cal-icon onlyDatetime little cal-icon-info">
                                        <input type="text" class="btn-filters datetimepicker form-control form-cs inp " name="dateTime" placeholder="MM/DD/YYYY" />
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label> Description <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control inp" name="description" placeholder="Enter Description" />
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="User">User <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2">
                                        <option hidden disabled selected="selected">Select User</option>
                                        <option>Peter Park</option>
                                        <option>Liam Nelson</option>
                                        <option>Mac Warth</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="Container">Container <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2">
                                        <option hidden disabled selected="selected">Select Container</option>
                                        <option>Container 1</option>
                                        <option>Container 2</option>
                                        <option>Container 3</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label> Amount <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control inp" name="Amount" placeholder="Enter Amount" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="borderset">
                            <div class="row gx-3 gy-2">
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="Category">Expense Category <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2">
                                        <option hidden disabled selected="selected">Select Category</option>
                                        <option>Category 1</option>
                                        <option>Category 2</option>
                                        <option>Category 3</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <div class="d-flex align-items-center justify-content-center pt-4">
                                        <label class="foncolor set me-3" for="img">Image</label>
                                        <div class="avtarset oneonly" style="position: relative;">
                                            <!-- Image Preview -->
                                            <img id="preview_image" class="avtars" src="{{ asset('assets/img.png') }}" alt="avatar">

                                            <!-- File Input (Hidden by Default) -->
                                            <input type="file" id="file_image" name="image" accept="image/png, image/jpeg" style="display: none;" onchange="previewImage(this, 'image')">

                                            <div class="divedit">
                                                <!-- Edit Button -->
                                                <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}" alt="edit" style="cursor: pointer;">

                                                <!-- Delete Button -->
                                                <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}" alt="delete" style="cursor: pointer;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="warehouse_name">Creator User Name <i class="text-danger">*</i></label>
                                    <input type="text" name="first_name" readonly class="form-control inp" placeholder="Enter First Name" value="Mark Henry">

                                </div>
                                <div class="col-md-12 mb-1">
                                    <div class="ptop d-flex align-items-end">
                                        <div>
                                            <div class="input-block">
                                                <label class="foncolor" for="status">Status</label>

                                                <div class="status-toggle">
                                                    <span>Active</span>
                                                    <input id="status" class="check" type="checkbox" name="status">
                                                    <label for="status" class="checktoggle checkbox-bg togc"></label>
                                                    <span class="">Inactive</span>
                                                </div>

                                            </div>
                                        </div>

                                        <div>
                                            <div class="add-customer-btns ">

                                                <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>

                                                <button type="submit" class="btn btn-primary ">Submit</button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>


</x-app-layout>
