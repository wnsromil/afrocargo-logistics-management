<x-app-layout>
    <x-slot name="header">
        Add Role
    </x-slot>

    <x-slot name="cardTitle">
        Add Role
    </x-slot>

    <form enctype="multipart/form-data">
        @csrf

        <div class="form-group-customer customer-additional-form text-dark">
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
                    <h6 class="head mt-3 text-dark fw-semibold">Permissions</h6>

                    <div class="col-md-12 ms-2">
                        <label class="custom_check primary col3a fw_500 mb-1 cardFontSize">
                            <input type="checkbox" class="d_none" name="accountingRport">
                            <span class="checkmark check-color check-size"></span>
                            Pages
                        </label>
                    </div>
                    <div class="col-md-12 ms-4">
                        <label class="custom_check primary col3a fw_500 mb-1 cardFontSize">
                            <input type="checkbox" class="d_none" name="accountingRport">
                            <span class="checkmark check-color check-size"></span>
                            [Callque]
                        </label>
                    </div>
                    <div class="col-md-12 ms-4">
                        <label class="custom_check primary col3a fw_500 mb-1 cardFontSize">
                            <input type="checkbox" class="d_none" name="accountingRport">
                            <span class="checkmark check-color check-size"></span>
                            My Account
                        </label>
                    </div>
                    <div class="col-md-12 ms-4">
                        <label class="custom_check primary col3a fw_500 mb-1 cardFontSize">
                            <input type="checkbox" class="d_none" name="accountingRport">
                            <span class="checkmark check-color check-size"></span>
                            [Deposit]
                        </label>
                    </div>
                    <div class="col-md-12 ms-4">
                        <label class="custom_check primary col3a fw_500 mb-1 cardFontSize">
                            <input type="checkbox" class="d_none" name="accountingRport">
                            <span class="checkmark check-color check-size"></span>
                            Configuration
                        </label>
                    </div>
                    <div class="col-md-12 ms-4">
                        <label class="custom_check primary col3a fw_500 mb-1 cardFontSize">
                            <input type="checkbox" class="d_none" name="accountingRport">
                            <span class="checkmark check-color check-size"></span>
                            [Voice guid entities]
                        </label>
                        <div class="d-flex mt-1">
                            <div class="checkboxlable bg-color  ms-1">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="invoice">
                                    <span class="checkmark check-size"></span>
                                    Create new voice guide entity
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="payment">
                                    <span class="checkmark check-size"></span>
                                    Delete voice guide entity
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="expenses">
                                    <span class="checkmark check-size"></span>
                                    Edit voice guide entity
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 mt-2 ps-3">
                    <label class="custom_check primary col3a fs_12-25 fw_500 mb-1">
                        <input type="checkbox" class="d_none" name="accountingRport">
                        <span class="checkmark check-color check-size"></span>
                        Accounting Report
                    </label>

                    <div class="col-md-12 p-32">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="newEndofdayReport">
                                    <span class="checkmark check-size"></span>
                                    New End Of The Day Reports
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="invoice">
                                        <span class="checkmark check-size"></span>
                                        Invoice
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="payment">
                                        <span class="checkmark check-size"></span>
                                        Payment
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="invoice">
                                        <span class="checkmark check-size"></span>
                                        Supply Invoice
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="expenses">
                                        <span class="checkmark check-size"></span>
                                        Expenses
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="invoice">
                                        <span class="checkmark check-size"></span>
                                        Void Payments
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="PrintReport">
                                        <span class="checkmark check-size"></span>
                                        Print Report
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 p-32">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="InvoiceReport">
                                    <span class="checkmark check-size"></span>
                                    Invoice Report
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="printinvoiceReport">
                                        <span class="checkmark check-size"></span>
                                        Print Invoice Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="PrintInvoice">
                                        <span class="checkmark check-size"></span>
                                        Print Invoice
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-4">
                                    <!-- <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="expenses">
                                        <span class="checkmark check-size"></span>
                                        Expenses
                                    </label> -->
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="print_description">
                                        <span class="checkmark check-size"></span>
                                        Print Description
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="PrintReport">
                                        <span class="checkmark check-size"></span>
                                        Print Invoice-B PDF
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 p-32">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="InvoiceReport">
                                    <span class="checkmark check-size"></span>
                                    Container Cash Report
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="printinvoiceReport">
                                        <span class="checkmark check-size"></span>
                                        Print Invoice Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="PrintInvoice">
                                        <span class="checkmark check-size"></span>
                                        Print Invoice
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="PrintReport">
                                        <span class="checkmark check-size"></span>
                                        Print Invoice-B PDF
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 p-32">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="InvoiceReport">
                                    <span class="checkmark check-size"></span>
                                    Cash Received Report
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="printinvoiceReport">
                                        <span class="checkmark check-size"></span>
                                        Print Cash Received Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="PrintInvoice">
                                        <span class="checkmark check-size"></span>
                                        Print Cash Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="PrintReport">
                                        <span class="checkmark check-size"></span>
                                        Print Invoice-B PDF
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4 ps-3">
                    <label class="custom_check primary col3a mb-2 fs_12-25 fw_500">
                        <input type="checkbox" class="d_none" name="Administration">
                        <span class="checkmark check-color check-size"></span>
                        Administration
                    </label>

                    <div class="col-md-12 p-32 marginTopBottom mt-0">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="audit_logs">
                                    <span class="checkmark check-size"></span>
                                    Audit Logs
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 p-32">
                        <div class="twoRowsSec w-max-content mt-3 p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="languages">
                                    <span class="checkmark check-size"></span>
                                    Languages
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="changingText">
                                        <span class="checkmark check-size"></span>
                                        Changing Text
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="newLang">
                                        <span class="checkmark check-size"></span>
                                        Creating New Language
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="deleteLang">
                                        <span class="checkmark check-size"></span>
                                        Deleting Language
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="editLang">
                                        <span class="checkmark check-size"></span>
                                        Editing Language
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 p-32">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="organizationUnits">
                                    <span class="checkmark check-size"></span>
                                    Organization Units
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="managing_manager">
                                        <span class="checkmark check-size"></span>
                                        Managing Manager
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="managingTree">
                                        <span class="checkmark check-size"></span>
                                        Managing Organization Tree
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="managing_roles">
                                        <span class="checkmark check-size"></span>
                                        Managing Roles
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 p-32">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="roles">
                                    <span class="checkmark check-size"></span>
                                    Roles
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="Creatingnewrole">
                                        <span class="checkmark check-size"></span>
                                        Creating new role
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="Deletingrole">
                                        <span class="checkmark check-size"></span>
                                        Deleting role
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="Editingrole">
                                        <span class="checkmark check-size"></span>
                                        Editing role
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="settings">
                                    <span class="checkmark check-size"></span>
                                    Settings
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="subscription">
                                    <span class="checkmark check-size"></span>
                                    Subscription
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 p-32">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="Users">
                                    <span class="checkmark check-size"></span>
                                    Users
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color ms-3">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="Changingpermissions">
                                        <span class="checkmark check-size"></span>
                                        Changing permissions
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-3">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="Creatingnewuser">
                                        <span class="checkmark check-size"></span>
                                        Creating new user
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-3">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="Deletinguser">
                                        <span class="checkmark check-size"></span>
                                        Deleting user
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-3">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="Editinguser">
                                        <span class="checkmark check-size"></span>
                                        Editing user
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-3">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="login_users">
                                        <span class="checkmark check-size"></span>
                                        Login For Users
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color ms-3">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="blank_grid">
                                        <span class="checkmark check-size"></span>
                                        Set Blank Grid
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="visual_settings">
                                    <span class="checkmark check-size"></span>
                                    Visual Settings
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 ms-4 mt-4 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="agent">
                        <span class="checkmark check-color check-size"></span>
                        Agents
                    </label>
                    <div class="d-flex mt-1">
                        <div class="checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_agent">
                                <span class="checkmark check-size"></span>
                                Add New Agent
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_agent">
                                <span class="checkmark check-size"></span>
                                Delete Agent
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_agent">
                                <span class="checkmark check-size"></span>
                                Edit Agent
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="autocalls">
                        <span class="checkmark check-color check-size"></span>
                        Autocalls
                    </label>
                    <div class="d-flex mt-1">
                        <div class="checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_autocall">
                                <span class="checkmark check-size"></span>
                                Create New Autocall
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_autocall">
                                <span class="checkmark check-size"></span>
                                Delete Autocall
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_autocall">
                                <span class="checkmark check-size"></span>
                                Edit Autocall
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="landing_detail">
                        <span class="checkmark check-color check-size"></span>
                        Bill Of Landing Details
                    </label>
                    <div class="d-flex mt-1">
                        <div class="checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_landing_detail">
                                <span class="checkmark check-size"></span>
                                Create New Bill Of Landing Detail
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_landing_detail">
                                <span class="checkmark check-size"></span>
                                Delete Bill Of Landing Detail
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_landing_detail">
                                <span class="checkmark check-size"></span>
                                Edit Bill Of Landing Detail
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="landing_entities">
                        <span class="checkmark check-color check-size"></span>
                        Bill Of Landing Entities
                    </label>
                    <div class="d-flex mt-1">
                        <div class="checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_landing_entity">
                                <span class="checkmark check-size"></span>
                                Create New Bill Of Landing Entity
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_landing_entity">
                                <span class="checkmark check-size"></span>
                                Delete Bill Of Landing Entity
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_landing_entity">
                                <span class="checkmark check-size"></span>
                                Edit Bill Of Landing Entity
                            </label>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="branches">
                        <span class="checkmark check-color check-size"></span>
                        Branches
                    </label>
                    <div class="d-flex mt-1">
                        <div class="checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_branch">
                                <span class="checkmark check-size"></span>
                                Create New Branch
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_branch">
                                <span class="checkmark check-size"></span>
                                Delete Branch
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_branch">
                                <span class="checkmark check-size"></span>
                                Edit Branch
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="Claims">
                        <span class="checkmark check-color check-size"></span>
                        Claims
                    </label>
                    <div class="d-flex mt-1">
                        <div class="col-auto checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="AddnewClaim">
                                <span class="checkmark check-size"></span>
                                Add New Claim
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="DeleteClaim">
                                <span class="checkmark check-size"></span>
                                Delete Claim
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="EditClaim">
                                <span class="checkmark check-size"></span>
                                Edit Claim
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="commission">
                        <span class="checkmark check-color check-size"></span>
                        Commission Batch Transaction
                    </label>
                </div>


                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="container">
                        <span class="checkmark check-color check-size"></span>
                        Container
                    </label>
                    <div class="d-flex mt-1">
                        <div class="col-auto checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_container">
                                <span class="checkmark check-size"></span>
                                Add New Container
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_container">
                                <span class="checkmark check-size"></span>
                                Delete Container
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="total_container">
                                <span class="checkmark check-size"></span>
                                Display Total For Container
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_container">
                                <span class="checkmark check-size"></span>
                                Edit Container
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="blank_grid_2">
                                <span class="checkmark check-size"></span>
                                Set Blank Grid
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="container_expenses">
                        <span class="checkmark check-color check-size"></span>
                        Container_Expenses
                    </label>
                    <div class="d-flex mt-1">
                        <div class="col-auto checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_container_expense">
                                <span class="checkmark check-size"></span>
                                Create New Container_Expense
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_container_expense">
                                <span class="checkmark check-size"></span>
                                Delete Claim
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_container_expense">
                                <span class="checkmark check-size"></span>
                                Edit Container_Expense
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="tracking_reports">
                        <span class="checkmark check-color check-size"></span>
                        Container Tracking Reports
                    </label>
                    <div class="d-flex mt-1">
                        <div class="col-auto checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_tracking_report">
                                <span class="checkmark check-size"></span>
                                Create New Container Tracking Report
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_tracking_report">
                                <span class="checkmark check-size"></span>
                                Delete Container Tracking Report
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_tracking_report">
                                <span class="checkmark check-size"></span>
                                Edit Container Tracking Report
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="customer">
                        <span class="checkmark check-color check-size"></span>
                        Customer
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_customer">
                                <span class="checkmark check-size"></span>
                                Add Customer
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="customer_toLicense">
                                <span class="checkmark check-size"></span>
                                Can Delete Customer ToLicense
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_customer">
                                <span class="checkmark check-size"></span>
                                Delete Customer
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="duplicate_customer">
                                <span class="checkmark check-size"></span>
                                Duplicate Customer
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_tracking_report">
                                <span class="checkmark check-size"></span>
                                Edit Customer
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="license_active">
                                <span class="checkmark check-size"></span>
                                License Active
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="license_pic">
                                <span class="checkmark check-size"></span>
                                Upload License Pic
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="customer_pickup">
                        <span class="checkmark check-color check-size"></span>
                        Customer Pickup
                    </label>
                    <div class="d-flex mt-1">
                        <div class="checkboxlable bg-color  ms-1">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_customer_pickup">
                                <span class="checkmark check-size"></span>
                                Create New Customer Pickup
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_customer_pickup">
                                <span class="checkmark check-size"></span>
                                Delete Customer Pickup
                            </label>
                        </div>
                        <div class="checkboxlable bg-color  ms-4">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_customer_pickup">
                                <span class="checkmark check-size"></span>
                                Edit Customer Pickup
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="relationship_manager">
                        <span class="checkmark check-color check-size"></span>
                        Customer Relationship Manager
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_relationship_manager">
                                <span class="checkmark check-size"></span>
                                Create New Customer Relationship Manager
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_relationship_manager">
                                <span class="checkmark check-size"></span>
                                Delete Customer Relationship Manager
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_relationship_manager">
                                <span class="checkmark check-size"></span>
                                Edit Customer Relationship Manager
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="relationship_manager_transaction">
                        <span class="checkmark check-color check-size"></span>
                        Customer Relationship Manager Transaction
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_relationship_manager_transaction">
                                <span class="checkmark check-size"></span>
                                Create New Customer Relationship Manager Transaction
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_relationship_manager_transaction">
                                <span class="checkmark check-size"></span>
                                Delete Customer Relationship Manager Transaction
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_relationship_manager_transaction">
                                <span class="checkmark check-size"></span>
                                Edit Customer Relationship Manager Transaction
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-0 font13">
                        <input type="checkbox" class="d_none" name="dashboard">
                        <span class="checkmark check-color check-size"></span>
                        Dashboard
                    </label>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="deliveries">
                        <span class="checkmark check-color check-size"></span>
                        Deliveries
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_delivery">
                                <span class="checkmark check-size"></span>
                                Create New Delivery
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_delivery">
                                <span class="checkmark check-size"></span>
                                Delete Delivery
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_delivery">
                                <span class="checkmark check-size"></span>
                                Edit Delivery
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delivery_report">
                                <span class="checkmark check-size"></span>
                                Delivery Report
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delivery_report_print">
                                <span class="checkmark check-size"></span>
                                Delivery Report Print
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="is_payment">
                                <span class="checkmark check-size"></span>
                                Is Payment?
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="ios_modiules">
                        <span class="checkmark check-color check-size"></span>
                        Delivery ios Modules
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_ios_modiules">
                                <span class="checkmark check-size"></span>
                                Create New Delivery ios Modules
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_ios_modiules">
                                <span class="checkmark check-size"></span>
                                Delete Delivery ios Modules
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_ios_modiules">
                                <span class="checkmark check-size"></span>
                                Edit Delivery ios Modules
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-0 fs_12-25">
                        <input type="checkbox" class="d_none" name="ui_components">
                        <span class="checkmark check-color check-size"></span>
                        Demo UI Components
                    </label>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="destriute_companies">
                        <span class="checkmark check-color check-size"></span>
                        Destribute Companies
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_destriute_company">
                                <span class="checkmark check-size"></span>
                                Create New Destribute Company
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_destriute_company">
                                <span class="checkmark check-size"></span>
                                Delete Destribute Company
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_destriute_company">
                                <span class="checkmark check-size"></span>
                                Edit Destribute Company
                            </label>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="drivers">
                        <span class="checkmark check-color check-size"></span>
                        Drivers
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_driver">
                                <span class="checkmark check-size"></span>
                                Create New Driver
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_driver">
                                <span class="checkmark check-size"></span>
                                Delete Driver
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_driver">
                                <span class="checkmark check-size"></span>
                                Edit Driver
                            </label>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="estimate">
                        <span class="checkmark check-color check-size"></span>
                        Estimate
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_estimate">
                                <span class="checkmark check-size"></span>
                                Create New Estimate
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_estimate">
                                <span class="checkmark check-size"></span>
                                Delete Estimate
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_estimate">
                                <span class="checkmark check-size"></span>
                                Edit Estimate
                            </label>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="expense">
                        <span class="checkmark check-color check-size"></span>
                        Expense
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_expense">
                                <span class="checkmark check-size"></span>
                                Create New Expense
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_expense">
                                <span class="checkmark check-size"></span>
                                Delete Expense
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_expense">
                                <span class="checkmark check-size"></span>
                                Edit Expense
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="expense_category">
                        <span class="checkmark check-color check-size"></span>
                        Expense Category
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_expense_category">
                                <span class="checkmark check-size"></span>
                                Create New Expense Category
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_expense_category">
                                <span class="checkmark check-size"></span>
                                Delete Expense Category
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_expense_category">
                                <span class="checkmark check-size"></span>
                                Edit Expense Category
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-0 fs_12-25">
                        <input type="checkbox" class="d_none" name="import_export">
                        <span class="checkmark check-color check-size"></span>
                        Import Export
                    </label>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="Inventory">
                        <span class="checkmark check-color check-size"></span>
                        Inventory
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_Inventory">
                                <span class="checkmark check-size"></span>
                                Create New Inventory
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_Inventory">
                                <span class="checkmark check-size"></span>
                                Delete Inventory
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_Inventory">
                                <span class="checkmark check-size"></span>
                                Edit Inventory
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="Invoice">
                        <span class="checkmark check-color check-size"></span>
                        Invoice
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_shipto_address">
                                <span class="checkmark check-size"></span>
                                Can Edit Shipto Address Only
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="multiple_payments">
                                <span class="checkmark check-size"></span>
                                Can Make Multiple Payments
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="make_payment">
                                <span class="checkmark check-size"></span>
                                Can Make Payment
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="print_custom_report">
                                <span class="checkmark check-size"></span>
                                Can Print Custom Report
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="print_invoice">
                                <span class="checkmark check-size"></span>
                                Can Print Invoice
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_invoice">
                                <span class="checkmark check-size"></span>
                                Create New Invoice
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_invoice">
                                <span class="checkmark check-size"></span>
                                Delete Invoice
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_invoice">
                                <span class="checkmark check-size"></span>
                                Edit Invoice
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_invoice_container">
                                <span class="checkmark check-size"></span>
                                Edit Invoice Container
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_invoice_date">
                                <span class="checkmark check-size"></span>
                                Edit Invoice Date
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="activate_buttons">
                                <span class="checkmark check-size"></span>
                                Just Activate Buttons Only
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="ios_settings">
                        <span class="checkmark check-color check-size"></span>
                        Ios Settings
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_ios_settings">
                                <span class="checkmark check-size"></span>
                                Create New Ios Settings
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_ios_settings">
                                <span class="checkmark check-size"></span>
                                Delete Ios Settings
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_ios_settings">
                                <span class="checkmark check-size"></span>
                                Edit Ios Settings
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-2 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-0 fs_12-25">
                        <input type="checkbox" class="d_none" name="unlock_lock_invoioces">
                        <span class="checkmark check-color check-size"></span>
                        IsUnlock Locked Invoices
                    </label>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="manual_distribution">
                        <span class="checkmark check-color check-size"></span>
                        Manual Distribution
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_manual_distribution">
                                <span class="checkmark check-size"></span>
                                Create New Manual Distribution
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_manual_distribution">
                                <span class="checkmark check-size"></span>
                                Delete Manual Distribution
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_manual_distribution">
                                <span class="checkmark check-size"></span>
                                Edit Manual Distribution
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="misc_packages">
                        <span class="checkmark check-color check-size"></span>
                        Misc Packages
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_misc_packages">
                                <span class="checkmark check-size"></span>
                                Create New Misc Packages
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_misc_packages">
                                <span class="checkmark check-size"></span>
                                Delete Misc Packages
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_misc_packages">
                                <span class="checkmark check-size"></span>
                                Edit Misc Packages
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="pd_ioses">
                        <span class="checkmark check-color check-size"></span>
                        Package Distribution Ioses
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_pd_ios">
                                <span class="checkmark check-size"></span>
                                Create New Package Distribution Ios
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_pd_ios">
                                <span class="checkmark check-size"></span>
                                Delete Package Distribution Ios
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_pd_ios">
                                <span class="checkmark check-size"></span>
                                Edit Package Distribution Ios
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="status">
                        <span class="checkmark check-color check-size"></span>
                        Package Status
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_status">
                                <span class="checkmark check-size"></span>
                                Create New Package Status
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_status">
                                <span class="checkmark check-size"></span>
                                Delete Package Status
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_status">
                                <span class="checkmark check-size"></span>
                                Edit Package Status
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="package_type">
                        <span class="checkmark check-color check-size"></span>
                        Package Type
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_package_type">
                                <span class="checkmark check-size"></span>
                                Create New Package Type
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_package_type">
                                <span class="checkmark check-size"></span>
                                Delete Package Type
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_package_type">
                                <span class="checkmark check-size"></span>
                                Edit Package Type
                            </label>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="Inventory">
                        <span class="checkmark check-color check-size"></span>
                        Pay Commission
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_pay_commission">
                                <span class="checkmark check-size"></span>
                                Delete Pay Commission Header
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_pay_commission">
                                <span class="checkmark check-size"></span>
                                Edit Pay Commission Header
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="pay_commission">
                                <span class="checkmark check-size"></span>
                                Pay Commission
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="pay_commission_batch">
                                <span class="checkmark check-size"></span>
                                Pay Commission Batch
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="invooice_in_batch">
                                <span class="checkmark check-size"></span>
                                Add Invoice In Batch
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="manual_invoice_batch">
                                <span class="checkmark check-size"></span>
                                Add Manual Invoice Batch
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="commission_report">
                                <span class="checkmark check-size"></span>
                                Print Commission report
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="verify_batch_paskages">
                                <span class="checkmark check-size"></span>
                                Verify Commission Batch Packages
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_batch_packages">
                                <span class="checkmark check-size"></span>
                                Delete Commission Batch Packages
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="verify_status_list">
                                <span class="checkmark check-size"></span>
                                Verify Status List
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="payment_types">
                        <span class="checkmark check-color check-size"></span>
                        Pament Types
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_payment_types">
                                <span class="checkmark check-size"></span>
                                Create New Pament Type
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_payment_types">
                                <span class="checkmark check-size"></span>
                                Delete Pament Type
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_payment_types">
                                <span class="checkmark check-size"></span>
                                Edit Pament Type
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="petty-cash">
                        <span class="checkmark check-color check-size"></span>
                        Petty Cash
                    </label>
                    <div class="row mt-1">

                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_petty-cash">
                                <span class="checkmark check-size"></span>
                                Delete Petty Cash
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_petty_transaction">
                                <span class="checkmark check-size"></span>
                                Delete Petty Cash transaction
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_petty-cash">
                                <span class="checkmark check-size"></span>
                                Edit Petty Cash
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="is_petty-cash">
                                <span class="checkmark check-size"></span>
                                Is Petty Cash
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="petty-cash-2">
                                <span class="checkmark check-size"></span>
                                Petty Cash
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="pickup">
                        <span class="checkmark check-color check-size"></span>
                        Pickup
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_pickup">
                                <span class="checkmark check-size"></span>
                                Create New Pickup
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_pickup">
                                <span class="checkmark check-size"></span>
                                Delete Pickup
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_pickup">
                                <span class="checkmark check-size"></span>
                                Edit Pickup
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="hide_verify">
                                <span class="checkmark check-size"></span>
                                Hide Verify Button
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="hide_shipto">
                                <span class="checkmark check-size"></span>
                                Pickup Hide Shipto Button
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="pickup_management">
                                <span class="checkmark check-size"></span>
                                Pickup Management
                            </label>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="receipt">
                        <span class="checkmark check-color check-size"></span>
                        Receipt
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_today_receipt">
                                <span class="checkmark check-size"></span>
                                Delete Todays Receipt Only
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_deposit">
                                <span class="checkmark check-size"></span>
                                Create New Deposit
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_deposit">
                                <span class="checkmark check-size"></span>
                                Delete Deposit
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_deposit">
                                <span class="checkmark check-size"></span>
                                Edit Deposit
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="payment_auth">
                                <span class="checkmark check-size"></span>
                                Check Payment Authorization
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_receipt">
                                <span class="checkmark check-size"></span>
                                Create New Receipt
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_receipt">
                                <span class="checkmark check-size"></span>
                                Delete Receipt
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_payment_date">
                                <span class="checkmark check-size"></span>
                                Edit Payment date
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_receipt">
                                <span class="checkmark check-size"></span>
                                Edit Receipt
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="report">
                        <span class="checkmark check-color check-size"></span>
                        Report
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_report">
                                <span class="checkmark check-size"></span>
                                Create New Report
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_report">
                                <span class="checkmark check-size"></span>
                                Delete Report
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_report">
                                <span class="checkmark check-size"></span>
                                Edit Report
                            </label>
                        </div>

                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="eod_report">
                                <span class="checkmark check-size"></span>
                                End Of The Day Report
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="isbranch">
                                <span class="checkmark check-size"></span>
                                Is Branch only
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="custom_invoice_total">
                                <span class="checkmark check-size"></span>
                                Is Custom Invoice Total
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="custom_tracking_total">
                                <span class="checkmark check-size"></span>
                                Is Custom Tracking Total
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="eod_report_2">
                                <span class="checkmark check-size"></span>
                                New End Of The Day Report
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="no_totals">
                                <span class="checkmark check-size"></span>
                                No Totals
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="invoice_note">
                                <span class="checkmark check-size"></span>
                                Print Invoice Note
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="update_exrate">
                                <span class="checkmark check-size"></span>
                                Update ExRate
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="shipto">
                        <span class="checkmark check-color check-size"></span>
                        ShipTo
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_shipto_license">
                                <span class="checkmark check-size"></span>
                                Can Delete ShipTo License
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_shipto">
                                <span class="checkmark check-size"></span>
                                Create New ShipTo
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_shipto">
                                <span class="checkmark check-size"></span>
                                Delete ShipTo
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_shipto">
                                <span class="checkmark check-size"></span>
                                Edit ShipTo
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="license_pic">
                                <span class="checkmark check-size"></span>
                                Upload License Pic
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="supports">
                        <span class="checkmark check-color check-size"></span>
                        Supports
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_support">
                                <span class="checkmark check-size"></span>
                                Create New Support
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_support">
                                <span class="checkmark check-size"></span>
                                Delete Support
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_support">
                                <span class="checkmark check-size"></span>
                                Edit Support
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="template">
                        <span class="checkmark check-color check-size"></span>
                        Template
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_template">
                                <span class="checkmark check-size"></span>
                                Create New Template
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_template">
                                <span class="checkmark check-size"></span>
                                Delete Template
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_template">
                                <span class="checkmark check-size"></span>
                                Edit Template
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="template_category">
                        <span class="checkmark check-color check-size"></span>
                        Template Category
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_template_category">
                                <span class="checkmark check-size"></span>
                                Create New Template Category
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_template_category">
                                <span class="checkmark check-size"></span>
                                Delete Template Category
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_template_category">
                                <span class="checkmark check-size"></span>
                                Edit Template Category
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="time_clocks">
                        <span class="checkmark check-color check-size"></span>
                        TimeClocks
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_time_clock">
                                <span class="checkmark check-size"></span>
                                Create New Time Clock
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_time_clock">
                                <span class="checkmark check-size"></span>
                                Delete Time Clock
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_time_clock">
                                <span class="checkmark check-size"></span>
                                Edit Time Clock
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="template_category">
                        <span class="checkmark check-color check-size"></span>
                        Truck Maintenance
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_truck_maintenance">
                                <span class="checkmark check-size"></span>
                                Create New Truck Maintenance Entity
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_truck_maintenance">
                                <span class="checkmark check-size"></span>
                                Delete Truck Maintenance Entity
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_truck_maintenance">
                                <span class="checkmark check-size"></span>
                                Edit Truck Maintenance Entity
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="truck_module">
                        <span class="checkmark check-color check-size"></span>
                        Truck Module
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_truck_module">
                                <span class="checkmark check-size"></span>
                                Create New Truck
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_truck_module">
                                <span class="checkmark check-size"></span>
                                Delete Truck Entity
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_truck_module">
                                <span class="checkmark check-size"></span>
                                Edit Truck Module
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="truck_module_transac">
                        <span class="checkmark check-color check-size"></span>
                        Truck Module Ios Transactions
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_truck_module_transac">
                                <span class="checkmark check-size"></span>
                                Add New Truck Module _Ios Transaction
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_truck_module_transac">
                                <span class="checkmark check-size"></span>
                                Delete Truck Module _Ios Transaction
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_truck_module_transac">
                                <span class="checkmark check-size"></span>
                                Edit Truck Module _Ios Transaction
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="vendor_entities">
                        <span class="checkmark check-color check-size"></span>
                        Vendor Entities
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_vendor_entity">
                                <span class="checkmark check-size"></span>
                                Create New Vendor Entity
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_vendor_entity">
                                <span class="checkmark check-size"></span>
                                Delete Vendor Entity
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_vendor_entity">
                                <span class="checkmark check-size"></span>
                                Edit Vendor Entity
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="vendor_invoice">
                        <span class="checkmark check-color check-size"></span>
                        Vendor invoice Entities
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_vendor_invoice">
                                <span class="checkmark check-size"></span>
                                Create New Vendor invoice Entity
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_vendor_invoice">
                                <span class="checkmark check-size"></span>
                                Delete Vendor invoice Entity
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_vendor_invoice">
                                <span class="checkmark check-size"></span>
                                Edit Vendor invoice Entity
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="vendor_payment">
                        <span class="checkmark check-color check-size"></span>
                        Vendor Payments
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_vendor_payment">
                                <span class="checkmark check-size"></span>
                                Create New Vendor Payment
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_vendor_payment">
                                <span class="checkmark check-size"></span>
                                Delete Vendor Payment
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_vendor_payment">
                                <span class="checkmark check-size"></span>
                                Edit Vendor Payment
                            </label>
                        </div>
                    </div>
                </div>

                 <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="vendor_payment">
                        <span class="checkmark check-color check-size"></span>
                        Vendor Warehouse
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_warehouse">
                                <span class="checkmark check-size"></span>
                                Create New Warehouse
                            </label>
                        </div>
                          <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_bulk_delivery">
                                <span class="checkmark check-size"></span>
                                Delete Bulk Delivery Records
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_warehouse">
                                <span class="checkmark check-size"></span>
                                Delete Warehouse
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_warehouse">
                                <span class="checkmark check-size"></span>
                                Edit Warehouse
                            </label>
                        </div>
                          <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="update_warehouse_container">
                                <span class="checkmark check-size"></span>
                                Update Container From Warehouse
                            </label>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="zone">
                        <span class="checkmark check-color check-size"></span>
                        Zone
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_zone">
                                <span class="checkmark check-size"></span>
                                Create New Zone
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_zone">
                                <span class="checkmark check-size"></span>
                                Delete Zone
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_zone">
                                <span class="checkmark check-size"></span>
                                Edit Zone
                            </label>
                        </div>
                    </div>
                </div>

                  <div class="col-md-12 ms-4 mt-1 ps-0">
                    <label class="custom_check primary col3a fw_500 mb-1 font13">
                        <input type="checkbox" class="d_none" name="zone_definition">
                        <span class="checkmark check-color check-size"></span>
                        Zone Definition
                    </label>
                    <div class="row mt-1">
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="add_zone_definition">
                                <span class="checkmark check-size"></span>
                                Create New Zone Definition
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="delete_zone_definition">
                                <span class="checkmark check-size"></span>
                                Delete Zone Definition
                            </label>
                        </div>
                        <div class="col-auto checkboxlable bg-color ms-3">
                            <label class="custom_check primary cardFontSize fw_500">
                                <input type="checkbox" class="d_none" name="edit_zone_definition">
                                <span class="checkmark check-size"></span>
                                Edit Zone Definition
                            </label>
                        </div>
                    </div>
                </div>



                <!-- ------------&&&&&----------------------------------------------------------------------------------- -->

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fs_12-25 fw_500">
                        <input type="checkbox" class="d_none" name="Warehouse">
                        <span class="checkmark check-size"></span>
                        Warehouse
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="CreatenewWarehouse">
                                    <span class="checkmark check-size"></span>
                                    Create new Warehouse
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteWarehouse">
                                    <span class="checkmark check-size"></span>
                                    Delete Warehouse
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditWarehouse">
                                    <span class="checkmark check-size"></span>
                                    Edit Warehouse
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Claims">
                        <span class="checkmark check-size"></span>
                        Claims
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewClaim">
                                    <span class="checkmark check-size"></span>
                                    Add new Claim
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteClaim">
                                    <span class="checkmark check-size"></span>
                                    Delete Claim
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditClaim">
                                    <span class="checkmark check-size"></span>
                                    Edit Claim
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Vehicle">
                        <span class="checkmark check-size"></span>
                        Vehicle
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewVehicle">
                                    <span class="checkmark check-size"></span>
                                    Add new Vehicle
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="Delete Vehicle">
                                    <span class="checkmark check-size"></span>
                                    Delete Vehicle
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditVehicle">
                                    <span class="checkmark check-size"></span>
                                    Edit Vehicle
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="CustomerPickup">
                        <span class="checkmark check-size"></span>
                        Customer Pickup
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewCustomerPickup">
                                    <span class="checkmark check-size"></span>
                                    Create new Customer Pickup
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteCustomerPickup">
                                    <span class="checkmark check-size"></span>
                                    Delete Customer Pickup
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditCustomerPickup">
                                    <span class="checkmark check-size"></span>
                                    Edit Customer Pickup
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Deliveries">
                        <span class="checkmark check-size"></span>
                        Deliveries
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewDelivery">
                                    <span class="checkmark check-size"></span>
                                    Create new Delivery
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteDelivery">
                                    <span class="checkmark check-size"></span>
                                    Delete Delivery
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditDelivery">
                                    <span class="checkmark check-size"></span>
                                    Edit Delivery
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="deliveryReport">
                                    <span class="checkmark check-size"></span>
                                    Delivery Report
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="ispayment">
                                    <span class="checkmark check-size"></span>
                                    Is Payment?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Drivers">
                        <span class="checkmark check-size"></span>
                        Drivers
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewDrivers">
                                    <span class="checkmark check-size"></span>
                                    Create new Drivers
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteDrivers">
                                    <span class="checkmark check-size"></span>
                                    Delete Drivers
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditDrivers">
                                    <span class="checkmark check-size"></span>
                                    Edit Drivers
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Expense">
                        <span class="checkmark check-size"></span>
                        Expense
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewExpense">
                                    <span class="checkmark check-size"></span>
                                    Create new Expense
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteExpense">
                                    <span class="checkmark check-size"></span>
                                    Delete Expense
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
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
                        <span class="checkmark check-size"></span>
                        Inventory
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewInventory">
                                    <span class="checkmark check-size"></span>
                                    Create new Inventory
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteInventory">
                                    <span class="checkmark check-size"></span>
                                    Delete Inventory
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditInventory">
                                    <span class="checkmark check-size"></span>
                                    Edit Inventory
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Invoice">
                        <span class="checkmark check-size"></span>
                        Invoice
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewInvoice">
                                    <span class="checkmark check-size"></span>
                                    Create new Invoice
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteInvoice">
                                    <span class="checkmark check-size"></span>
                                    Delete Invoice
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditInvoice">
                                    <span class="checkmark check-size"></span>
                                    Edit Invoice
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="PaymentTypes">
                        <span class="checkmark check-size"></span>
                        Payment Types
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewPaymentTypes">
                                    <span class="checkmark check-size"></span>
                                    Create new Payment Types
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeletePaymentTypes">
                                    <span class="checkmark check-size"></span>
                                    Delete Payment Types
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditPaymentTypes">
                                    <span class="checkmark check-size"></span>
                                    Edit Payment Types
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="Pickup">
                        <span class="checkmark check-size"></span>
                        Pickup
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewPickup">
                                    <span class="checkmark check-size"></span>
                                    Create new Pickup
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeletePickup">
                                    <span class="checkmark check-size"></span>
                                    Delete Pickup
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditPickup">
                                    <span class="checkmark check-size"></span>
                                    Edit Pickup
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="PickupAddress">
                        <span class="checkmark check-size"></span>
                        Pickup Address
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewPickupAddress">
                                    <span class="checkmark check-size"></span>
                                    Create new Pickup Address
                                </label>
                            </div>
                            <div class="checkboxlable bg-color ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeletePickupAddress">
                                    <span class="checkmark check-size"></span>
                                    Delete Pickup Address
                                </label>
                            </div>
                            <div class="checkboxlable bg-color ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditPickupAddress">
                                    <span class="checkmark check-size"></span>
                                    Edit Pickup Address
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="RolesnPermissions">
                        <span class="checkmark check-size"></span>
                        Roles & Permissions
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="CreateRole">
                                    <span class="checkmark check-size"></span>
                                    Create Role
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteRole">
                                    <span class="checkmark check-size"></span>
                                    Delete Role
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditRole">
                                    <span class="checkmark check-size"></span>
                                    Edit Role
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <label class="custom_check primary col3a fw_500">
                        <input type="checkbox" class="d_none" name="DriverInventory">
                        <span class="checkmark check-size"></span>
                        Driver Inventory
                    </label>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="twoRowsSec w-max-content">
                        <div class="d-flex">
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="AddnewDriverInventory">
                                    <span class="checkmark check-size"></span>
                                    Create new Driver Inventory
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="DeleteDriverInventory">
                                    <span class="checkmark check-size"></span>
                                    Delete Driver Inventory
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary fw_500">
                                    <input type="checkbox" class="d_none" name="EditDriverInventory">
                                    <span class="checkmark check-size"></span>
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
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.checkboxlable bg-color  input[type="checkbox"]');

            checkboxes.forEach(function (checkbox) {
                const parent = checkbox.closest('.checkboxlable bg-color ');

                if (checkbox.checked) {
                    parent.classList.add('active');
                }

                checkbox.addEventListener('change', function () {
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


<!-- ----------------------------------------------------------------------------------- -->

<!-- <div class="border-bottom"></div>

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

    <div class="parentDiv my-3 px-2 py-1">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck1">
                <label class="form-check-label fw-medium mb-0" for="exampleCheck1">Accounting
                    Report</label>
            </div>
        </div>
 
        <div class="form-checkbox border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck2">
            <label class="form-check-label  cardFontSize fw-regular mb-0" for="exampleCheck2">New
                End Of The Day Reports</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck3">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck3">Invoice</label>
                </div>
            </div>

            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck4">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck4">Payment</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck5">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck5">Excpenses</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck6">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck6">Print Report</label>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="parentDiv mt-3 mb-2 px-2 py-1">
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck7">
            <label class="form-check-label cardFontSize fw-regular mb-0"
                for="exampleCheck7">Invoice Reports</label>
        </div>
      
        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck8">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck8">Print Invoice
                        Report</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded ps-3 pe-2 py-1">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 bg-checkbox"
                        id="exampleCheck9">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck9">Print Invoice</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck10">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck10">Excpenses</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck11">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck11">Print Report</label>
                </div>
            </div>
        </div>
    </div>
<br>

 
    <div class="parentDiv mt-3 mb-2 px-2 py-1 widthCheckbox">
        <div class="input-group">
            <div class="form-check text-checkbox">
                <input type="checkbox" class="form-check-input border-dark opacity-75" id="exampleCheck12">
                <label class="form-check-label fw-medium mb-0"
                    for="exampleCheck12">Administration</label>
            </div>
        </div>

       
        <div class="border border-dark opacity-75 bg-checkbox rounded px-3 py-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck13">
            <label class="form-check-label cardFontSize fw-regular mb-0"
                for="exampleCheck13">Roles</label>
        </div>

        <div class="d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck14">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck14">Creating New
                        Roles</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck15">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck15">Deleting role</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck16">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck16">Editing role</label>
                </div>
            </div>
        </div>
    </div>

    <br>
 
    <div class="parentDiv mt-3 mb-2 px-2 py-1">
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck17">
            <label class="form-check-label cardFontSize fw-regular mb-0"
                for="exampleCheck17">Users</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck18">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck18">Changing
                        Permissions</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded ps-3 pe-2 py-1">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck19">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck19">Creating New User</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck20">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck20">Deleting User</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck21">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck21">Editing User</label>
                </div>
            </div>
        </div>
 
    </div>
<br>
   
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck23">Create New
                        Warehouse</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck24">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck24">Delete Warehouse</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck25">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck25">Edit Warehouse</label>
                </div>
            </div>
        </div>
    </div>

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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck27">Add New Claim</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck28">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck28">Delete Claim</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck29">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck29">Edit Claim</label>
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck31">Create New
                        Vehicle</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck32">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck32">Delete Vehicle</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck33">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck33">Edit Vehicle</label>
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck35">Create New Customer
                        Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck36">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck36">Delete Customer
                        Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck37">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck37">Edit Customer
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck39">Create New
                        Delivery</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck40">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck40">Delete Delivery</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck41">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck41">Edit Delivery</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck42">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck42">Delivery Report</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck43">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck43">Is Payment?</label>
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck45">Create New Driver</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck46">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck46">Delete Driver</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck47">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck47">Edit Driver</label>
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck49">Create New
                        Expense</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck50">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck50">Delete Expense</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck51">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck51">Edit Expense</label>
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck53">Create New
                        Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck54">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck54">Delete Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck55">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck55">Edit Inventory</label>
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck57">Create New
                        Invoice</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck58">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck58">Delete Invoice</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck59">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck59">Edit Invoice</label>
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck61">Create New Payment
                        Type</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck62">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck62">Delete Payment
                        Type</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck63">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck63">Edit Payment Type</label>
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
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck65">Create New Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck66">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck66">Delete Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck67">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck67">Edit Pickup</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck68">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck68">Pickup Management</label>
                </div>
            </div>
        </div>
    </div>

    <div class="parentDiv mt-3 mb-2 px-2 py-1">
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck69">
            <label class="form-check-label cardFontSize fw-regular mb-0"
                for="exampleCheck69">Pickup Address</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck70">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck70">Create New Pickup
                        Address</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck71">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck71">Delete Pickup
                        Address</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck72">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck72">Edit Pickup
                        Address</label>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="parentDiv mt-3 mb-2 px-2 py-1">
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck73">
            <label class="form-check-label cardFontSize fw-regular mb-0"
                for="exampleCheck73">Roles & Permission</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck74">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck74">Create Role</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck75">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck75">Delete Role</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck76">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck76">Edit Role</label>
                </div>
            </div>
        </div>
    </div>

<br>
    <div class="parentDiv mt-3 mb-2 px-2 py-1">
        <div class="border border-dark opacity-75 bg-checkbox rounded p-1 my-2">
            <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck77">
            <label class="form-check-label cardFontSize fw-regular mb-0"
                for="exampleCheck77">Driver Inventory</label>
        </div>

        <div class="col-md-12 d-flex my-3 ms-4">
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck78">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck78">Create Driver
                        Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck79">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck79">Delete Driver
                        Inventory</label>
                </div>
            </div>
            <div class="px-1">
                <div class="border border-dark opacity-75 bg-checkbox rounded p-1 pe-2">
                    <input type="checkbox" class="form-check-input border-dark opacity-75 mx-2" id="exampleCheck80">
                    <label class="form-check-label cardFontSize fw-regular mb-0" for="exampleCheck80">Edit Driver
                        Inventory</label>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.form-check-input').forEach(input =>{
            input.addEventListener("change", function(){
                const parentDiv = this.closest(".border");
                if(this.checked){
                    parentDiv.classList.add('selected');
                }else{
                    parentDiv.classList.remove('selected');
                }
            })
        })
    </script>