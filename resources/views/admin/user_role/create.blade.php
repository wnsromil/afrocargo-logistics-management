<x-app-layout>
    <x-slot name="header">
        Add Role
    </x-slot>

    <x-slot name="cardTitle">
        Add Role
    </x-slot>

    <form action="{{ route('admin.user_role.index') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="role_name">Role Name <i class="text-danger">*</i></label>
                        <select name="role_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Role </option>
                            <option value="Driver">Driver</option>
                            <option value="Warehouse Manager">Warehouse Manager</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3 class="head mt-3">Permissions</h3>
                </div>
                <div class="col-md-12 mt-3">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="accountingRport">
                        <span class="checkmark"></span>
                        Accounting Report
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="checkboxlable">
                            <label class="custom_check primary fw_500">
                                <input type="checkbox" class="d_none" name="newEndofdayReport">
                                <span class="checkmark"></span>
                                New End Of The Day Reports
                            </label>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="invoice">
                                    <span class="checkmark"></span>
                                    Invoice
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="payment">
                                    <span class="checkmark"></span>
                                    Payment
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="expenses">
                                    <span class="checkmark"></span>
                                    Expenses
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="PrintReport">
                                    <span class="checkmark"></span>
                                    Print Report
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="twoRowsSec w-max-content">
                        <div class="checkboxlable">
                            <label class="custom_check primary fw_500">
                                <input type="checkbox" class="d_none" name="InvoiceReport">
                                <span class="checkmark"></span>
                                Invoice Report
                            </label>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="printinvoiceReport">
                                    <span class="checkmark"></span>
                                    Print Invoice Report
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="PrintInvoice">
                                    <span class="checkmark"></span>
                                    Print Invoice
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="expenses">
                                    <span class="checkmark"></span>
                                    Expenses
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="PrintReport">
                                    <span class="checkmark"></span>
                                    Print Report
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Administration">
                        <span class="checkmark"></span>
                        Administration
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="checkboxlable">
                            <label class="custom_check primary fw_500">
                                <input type="checkbox" class="d_none" name="roles">
                                <span class="checkmark"></span>
                                Roles
                            </label>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Creatingnewrole">
                                    <span class="checkmark"></span>
                                    Creating new role
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Deletingrole">
                                    <span class="checkmark"></span>
                                    Deleting role
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Editingrole">
                                    <span class="checkmark"></span>
                                    Editing role
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="twoRowsSec w-max-content">
                        <div class="checkboxlable">
                            <label class="custom_check primary fw_500">
                                <input type="checkbox" class="d_none" name="Users">
                                <span class="checkmark"></span>
                                Users
                            </label>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Changingpermissions">
                                    <span class="checkmark"></span>
                                    Changing permissions
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Creatingnewuser">
                                    <span class="checkmark"></span>
                                    Creating new user
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Deletinguser">
                                    <span class="checkmark"></span>
                                    Deleting user
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Editinguser">
                                    <span class="checkmark"></span>
                                    Editing user
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Warehouse">
                        <span class="checkmark"></span>
                        Warehouse
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="CreatenewWarehouse">
                                    <span class="checkmark"></span>
                                    Create new Warehouse
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteWarehouse">
                                    <span class="checkmark"></span>
                                    Delete Warehouse
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditWarehouse">
                                    <span class="checkmark"></span>
                                    Edit Warehouse
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Claims">
                        <span class="checkmark"></span>
                        Claims
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewClaim">
                                    <span class="checkmark"></span>
                                    Add new Claim
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Delete Claim">
                                    <span class="checkmark"></span>
                                    Delete Claim
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditClaim">
                                    <span class="checkmark"></span>
                                    Edit Claim
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Vehicle">
                        <span class="checkmark"></span>
                        Vehicle
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewVehicle">
                                    <span class="checkmark"></span>
                                    Add new Vehicle
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Delete Vehicle">
                                    <span class="checkmark"></span>
                                    Delete Vehicle
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditVehicle">
                                    <span class="checkmark"></span>
                                    Edit Vehicle
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="CustomerPickup">
                        <span class="checkmark"></span>
                        Customer Pickup
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewCustomerPickup">
                                    <span class="checkmark"></span>
                                    Create new Customer Pickup
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteCustomerPickup">
                                    <span class="checkmark"></span>
                                    Delete Customer Pickup
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditCustomerPickup">
                                    <span class="checkmark"></span>
                                    Edit Customer Pickup
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Deliveries">
                        <span class="checkmark"></span>
                        Deliveries
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewDelivery">
                                    <span class="checkmark"></span>
                                    Create new Delivery
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteDelivery">
                                    <span class="checkmark"></span>
                                    Delete Delivery
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditDelivery">
                                    <span class="checkmark"></span>
                                    Edit Delivery
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="deliveryReport">
                                    <span class="checkmark"></span>
                                    Delivery Report
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="ispayment">
                                    <span class="checkmark"></span>
                                    Is Payment?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Drivers">
                        <span class="checkmark"></span>
                        Drivers
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewDrivers">
                                    <span class="checkmark"></span>
                                    Create new Drivers
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteDrivers">
                                    <span class="checkmark"></span>
                                    Delete Drivers
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditDrivers">
                                    <span class="checkmark"></span>
                                    Edit Drivers
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Expense">
                        <span class="checkmark"></span>
                        Expense
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewExpense">
                                    <span class="checkmark"></span>
                                    Create new Expense
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteExpense">
                                    <span class="checkmark"></span>
                                    Delete Expense
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditExpense">
                                    <span class="checkmark"></span>
                                    Edit Expense
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Inventory">
                        <span class="checkmark"></span>
                        Inventory
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewInventory">
                                    <span class="checkmark"></span>
                                    Create new Inventory
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteInventory">
                                    <span class="checkmark"></span>
                                    Delete Inventory
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditInventory">
                                    <span class="checkmark"></span>
                                    Edit Inventory
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Invoice">
                        <span class="checkmark"></span>
                        Invoice
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewInvoice">
                                    <span class="checkmark"></span>
                                    Create new Invoice
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteInvoice">
                                    <span class="checkmark"></span>
                                    Delete Invoice
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditInvoice">
                                    <span class="checkmark"></span>
                                    Edit Invoice
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="PaymentTypes">
                        <span class="checkmark"></span>
                        Payment Types
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewPaymentTypes">
                                    <span class="checkmark"></span>
                                    Create new Payment Types
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeletePaymentTypes">
                                    <span class="checkmark"></span>
                                    Delete Payment Types
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditPaymentTypes">
                                    <span class="checkmark"></span>
                                    Edit Payment Types
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Pickup">
                        <span class="checkmark"></span>
                        Pickup
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewPickup">
                                    <span class="checkmark"></span>
                                    Create new Pickup
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeletePickup">
                                    <span class="checkmark"></span>
                                    Delete Pickup
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditPickup">
                                    <span class="checkmark"></span>
                                    Edit Pickup
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="PickupAddress">
                        <span class="checkmark"></span>
                        Pickup Address
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewPickupAddress">
                                    <span class="checkmark"></span>
                                    Create new Pickup Address
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeletePickupAddress">
                                    <span class="checkmark"></span>
                                    Delete Pickup Address
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditPickupAddress">
                                    <span class="checkmark"></span>
                                    Edit Pickup Address
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="RolesnPermissions">
                        <span class="checkmark"></span>
                        Roles & Permissions
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="CreateRole">
                                    <span class="checkmark"></span>
                                    Create Role
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteRole">
                                    <span class="checkmark"></span>
                                    Delete Role
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditRole">
                                    <span class="checkmark"></span>
                                    Edit Role
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="DriverInventory">
                        <span class="checkmark"></span>
                        Driver Inventory
                    </label>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewDriverInventory">
                                    <span class="checkmark"></span>
                                    Create new Driver Inventory
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteDriverInventory">
                                    <span class="checkmark"></span>
                                    Delete Driver Inventory
                                </label>
                            </div>
                            <div class="checkboxlable ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditDriverInventory">
                                    <span class="checkmark"></span>
                                    Edit Driver Inventory
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="add-customer-btns text-end">
            <a href="{{ route('admin.user_role.index') }}" class="btn btn-outline-primary custom-btn">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.checkboxlable input[type="checkbox"]');

            checkboxes.forEach(function(checkbox) {
                const parent = checkbox.closest('.checkboxlable');

                if (checkbox.checked) {
                    parent.classList.add('active');
                }

                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        parent.classList.add('active');
                    } else {
                        parent.classList.remove('active');
                    }
                });
            });
        });

    </script>
</x-app-layout>
