<x-app-layout>
    <x-slot name="header">
        Update Role
    </x-slot>

    <x-slot name="cardTitle">
        Update Role
    </x-slot>

    <div class="border-bottom"></div>

    <!-- <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="input-block mb-3">
            <label class="required">Role Name</label>
            <ul class="form-group-plus css-equal-heights">
                <li>
                    <select class="select">
                        <option>Select Role</option>
                        <option>Driver</option>
                        <option>Warehouse Manager</option>
                    </select>
                </li>
            </ul>
        </div>
    </div> -->
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label class="required">Role Name</label>
        <select class="form-select border-dark border-1 opacity-75 bg-checkbox" id="inputGroupSelect01">
            <option>Select Role</option>
            <option>Warehouse Manager</option>
            <option>Driver</option>
        </select>
    </div>

    <div class="cardTitle my-3">
        <p class="fw-semibold fs-5 text-dark">Permissions</p>
    </div>

    <div class="col-md-7 my-3 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Accounting
                    Report</label>
            </div>
        </div>
        <!-- <div class="form-check border rounded ms-2 px-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    New End Of The Day Reports
                </label>
            </div> -->
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck6">
            <label class="form-check-label permission-font font13 fw-regular mb-0 text-checkbox" for="exampleCheck6">New
                End Of The Day Reports</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Invoice</label>
                </div>
            </div>
            <!-- -------------------------------- -->
            <!-- <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck14">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck14">Invoice</label>
                </div>
            </div> -->

            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Payment</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Excpenses</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck4">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck4">Print Report</label>
                </div>
            </div>
        </div>
    </div>
    <!-- ----------------------------------------------------------------------------------------------------------------- -->
    <div class="col-md-8 my-4 px-2 py-1">
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck6">
            <label class="form-check-label permission-font font13 fw-regular mb-0 text-checkbox"
                for="exampleCheck6">Invoice Reports</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Print Invoice
                        Report</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded ps-3 pe-2 py-1">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 bg-checkbox"
                        id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Print Invoice</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Excpenses</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck4">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck4">Print Report</label>
                </div>
            </div>
        </div>
    </div>


    <!-- ------------------------------------------------------------------------------------------------------------------ -->

    <div class="col-md-7 my-4 px-2 py-1 widthCheckbox">
        <div class="input-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0"
                    for="exampleCheck5">Administration</label>
            </div>
        </div>
        <!-- <div class="form-check border rounded ms-2 px-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    New End Of The Day Reports
                </label>
            </div> -->
        <div class="border border-dark opacity-75 bg-checkbox rounded px-3 py-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck6">
            <label class="form-check-label permission-font font13 fw-regular mb-0 text-checkbox"
                for="exampleCheck6">Roles</label>
        </div>

        <div class="d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Creating New
                        Roles</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Deleting role</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Editing role</label>
                </div>
            </div>

        </div>
    </div>

    <!-- -------------------------------------------------------------------------------------- -->

    <div class="col-md-9 my-4 px-2 py-1">
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck6">
            <label class="form-check-label permission-font font13 fw-regular mb-0 text-checkbox"
                for="exampleCheck6">Users</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Changing
                        Permissions</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded ps-3 pe-2 py-1">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Creating New User</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Deleting User</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck4">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck4">Editing User</label>
                </div>
            </div>
        </div>
    </div>

    <!-- --------------------------------------------------------------------------------------- -->

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Warehouse</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New
                        Warehouse</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Warehouse</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Warehouse</label>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------------------------------------------------------- -->
    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Claims</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Add New Claim</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Claim</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Claim</label>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Vehicle</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New
                        Vehicle</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Vehicle</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Vehicle</label>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Customer
                    Pickup</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New Customer
                        Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Customer
                        Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Customer
                        Pickup</label>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Deliveries</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New
                        Delivery</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Delivery</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Delivery</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Delivery Report</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Is Payment?</label>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Drivers</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New Driver</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Driver</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Driver</label>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Expenses</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New
                        Expense</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Expense</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Expense</label>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Inventory</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New
                        Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Inventory</label>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Invoice</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New
                        Invoice</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Invoice</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Invoice</label>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Payment Types</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New Payment
                        Type</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Payment
                        Type</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Payment Type</label>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Pickup</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Pickup Management</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9 my-4 px-2 py-1">
        <!-- <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75 bg-checkbox" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Pickup Address</label>
            </div>
        </div> -->
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck6">
            <label class="form-check-label permission-font font13 fw-regular mb-0 text-checkbox"
                for="exampleCheck6">Pickup Address</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create New Pickup
                        Address</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Pickup
                        Address</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Pickup
                        Address</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 my-4 px-2 py-1">
        <!-- <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75 bg-checkbox" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Roles & Permission</label>
            </div>
        </div> -->
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75mx-2" id="exampleCheck6">
            <label class="form-check-label permission-font font13 fw-regular mb-0 text-checkbox"
                for="exampleCheck6">Roles & Permission</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create Role</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Role</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Role</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 my-4 px-2 py-1">
        <!-- <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75 bg-checkbox" id="exampleCheck5">
                <label class="form-check-label permission-font fw-medium mb-0" for="exampleCheck5">Driver Inventory</label>
            </div>
        </div> -->
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck6">
            <label class="form-check-label permission-font font13 fw-regular mb-0 text-checkbox"
                for="exampleCheck6">Driver Inventory</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck1">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck1">Create Driver
                        Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck2">Delete Driver
                        Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Edit Driver
                        Inventory</label>
                </div>
            </div>
        </div>
    </div>
<!-- 
    <script>
        const checkbox = document.querySelector('#exampleCheck14');

        const checkboxContainer = checkbox.closest('.border');

        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                checkboxContainer.style.backgroundColor = '#cce7ff';
            } else {
                checkboxContainer.style.backgroundColor = '';
            }
        });

    </script> -->

</x-app-layout>