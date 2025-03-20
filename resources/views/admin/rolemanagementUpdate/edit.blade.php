<x-app-layout>
    <x-slot name="header">
        Update Role
    </x-slot>

    <x-slot name="cardTitle">
        Update Role
    </x-slot>

    <div class="border-bottom"></div>

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
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck1">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck1">Accounting
                    Report</label>
            </div>
        </div>
        <!-- <div class="form-check border rounded ms-2 px-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    New End Of The Day Reports
                </label>
            </div> -->
        <div class="parentDiv">
            <div class="form-checkbox border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
                <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
                <label class="form-check-label  font13 fw-regular mb-0" for="exampleCheck2">New
                    End Of The Day Reports</label>
            </div>

            <div class="col-md-12 d-flex my-3 ms-4">
                <div class="px-1">
                    <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                        <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                        <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck3">Invoice</label>
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
                        <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck4">
                        <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck4">Payment</label>
                    </div>
                </div>
                <div class="px-1">
                    <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                        <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck5">
                        <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck5">Excpenses</label>
                    </div>
                </div>
                <div class="px-1">
                    <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                        <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck6">
                        <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck6">Print Report</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ----------------------------------------------------------------------------------------------------------------- -->
    <div class="parentDiv col-md-8 mt-3 mb-2 px-2 py-1">
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck7">
            <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck7">Invoice Reports</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck8">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck8">Print Invoice
                        Report</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded ps-3 pe-2 py-1">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 bg-checkbox"
                        id="exampleCheck9">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck9">Print Invoice</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck10">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck10">Excpenses</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck11">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck11">Print Report</label>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- ------------------------------------------------------------------------------------------------------------------ -->

    <div class="parentDiv mt-3 mb-2 px-2 py-1 widthCheckbox">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck12">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck12">Administration</label>
            </div>
        </div>
        <!-- <div class="form-check border rounded ms-2 px-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    New End Of The Day Reports
                </label>
            </div> -->
        <div>
            <div class="border border-dark opacity-75 bg-checkbox rounded px-3 py-1 my-2">
                <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck13">
                <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck13">Roles</label>
            </div>
        </div>

        <div class="d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck14">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck14">Creating New
                        Roles</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck15">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck15">Deleting role</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck16">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck16">Editing role</label>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- -------------------------------------------------------------------------------------- -->

    <div class="parentDiv mt-3 mb-2 px-2 py-1">
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck17">
            <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck17">Users</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck18">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck18">Changing
                        Permissions</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded ps-3 pe-2 py-1">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck19">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck19">Creating New
                        User</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck20">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck20">Deleting User</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck21">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck21">Editing User</label>
                </div>
            </div>
        </div>

    </div>

    <!-- --------------------------------------------------------------------------------------- -->

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck22">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck22">Warehouse</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck23">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck23">Create New
                        Warehouse</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck24">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck24">Delete Warehouse</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck25">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck25">Edit Warehouse</label>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------------------------------------------------------- -->
    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck26">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck26">Claims</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck27">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck27">Add New Claim</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck28">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck28">Delete Claim</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck29">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck29">Edit Claim</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck30">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck30">Vehicle</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck31">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck31">Create New
                        Vehicle</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck32">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck32">Delete Vehicle</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck33">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck33">Edit Vehicle</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck34">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck34">Customer
                    Pickup</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck35">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck35">Create New Customer
                        Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck36">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck36">Delete Customer
                        Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck37">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck37">Edit Customer
                        Pickup</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck38">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck38">Deliveries</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck39">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck39">Create New
                        Delivery</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck40">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck40">Delete Delivery</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck41">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck41">Edit Delivery</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck42">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck42">Delivery Report</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck43">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck43">Is Payment?</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck44">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck44">Drivers</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck45">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck45">Create New
                        Driver</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck46">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck46">Delete Driver</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck47">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck47">Edit Driver</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck48">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck48">Expenses</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck49">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck49">Create New
                        Expense</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck50">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck50">Delete Expense</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck51">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck51">Edit Expense</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck52">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck52">Inventory</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck53">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck53">Create New
                        Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck54">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck54">Delete Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck55">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck55">Edit Inventory</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck56">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck56">Invoice</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck57">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck57">Create New
                        Invoice</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck58">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck58">Delete Invoice</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck59">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck59">Edit Invoice</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck60">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck60">Payment Types</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck61">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck61">Create New Payment
                        Type</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck62">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck62">Delete Payment
                        Type</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck63">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck63">Edit Payment
                        Type</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-2 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck64">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck64">Pickup</label>
            </div>
        </div>

        <div class="col-md-12 d-flex my-2 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck65">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck65">Create New
                        Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck66">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck66">Delete Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck67">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck67">Edit Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck68">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck68">Pickup
                        Management</label>
                </div>
            </div>
        </div>
    </div>

    <div class="parentDiv mt-3 mb-2 px-2 py-1">
        <!-- <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75 bg-checkbox" id="exampleCheck5">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck5">Pickup Address</label>
            </div>
        </div> -->
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck69">
            <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck69">Pickup Address</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck70">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck70">Create New Pickup
                        Address</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck71">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck71">Delete Pickup
                        Address</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck72">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck72">Edit Pickup
                        Address</label>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="parentDiv mt-3 mb-2 px-2 py-1">
        <!-- <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75 bg-checkbox" id="exampleCheck5">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck5">Roles & Permission</label>
            </div>
        </div> -->
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck73">
            <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck73">Roles & Permission</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck74">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck74">Create Role</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck75">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck75">Delete Role</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck76">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck76">Edit Role</label>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="parentDiv mt-3 mb-2 px-2 py-1">
        <!-- <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75 bg-checkbox" id="exampleCheck5">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck5">Driver Inventory</label>
            </div>
        </div> -->
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck77">
            <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck77">Driver Inventory</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck78">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck78">Create Driver
                        Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck79">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck79">Delete Driver
                        Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck80">
                    <label class="form-check-label font13 fw-regular mb-0" for="exampleCheck80">Edit Driver
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

    <script>
        document.querySelectorAll('.form-check-input').forEach(input => {
            input.addEventListener("change", function () {
                const parentDiv = this.closest(".border");
                if (this.checked) {
                    parentDiv.classList.add('selected2');
                } else {
                    parentDiv.classList.remove('selected2');
                }
            })
        })
    </script>

</x-app-layout>
<!-- --------------------------------------------------------------------------- -->