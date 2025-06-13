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

                <div class="col-md-12 mt-4 ps-3">
                    <label class="custom_check primary col3a mb-2 fs_12-25 fw_500">
                        <input type="checkbox" class="d_none" name="Administration">
                        <span class="checkmark check-color check-size"></span>
                        Misc
                    </label>

                    <div class="col-md-12 p-32 marginTopBottom mt-0">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="my_plans">
                                    <span class="checkmark check-size"></span>
                                    My Plans
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 p-32">
                        <div class="twoRowsSec w-max-content mt-3 p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="myAddOns">
                                    <span class="checkmark check-size"></span>
                                    My Add Ons
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="print_addon">
                                        <span class="checkmark check-size"></span>
                                        Print Addon
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="cancelAutoRenewal">
                                        <span class="checkmark check-size"></span>
                                        Cancel Auto Renewal
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 p-32">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="purchase_addons">
                                    <span class="checkmark check-size"></span>
                                    Purchase Add ons
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="pay_addon2">
                                        <span class="checkmark check-size"></span>
                                        Pay Addon
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 p-32">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="myCards">
                                    <span class="checkmark check-size"></span>
                                    My Cards
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="createCard">
                                        <span class="checkmark check-size"></span>
                                        Creat Card
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="editCard">
                                        <span class="checkmark check-size"></span>
                                        Edit Card
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="deleteCard">
                                        <span class="checkmark check-size"></span>
                                        Delet Card
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="stateMaster">
                                    <span class="checkmark check-size"></span>
                                    State Masters
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="add_state_tc">
                                        <span class="checkmark check-size"></span>
                                        Add State TC
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_state_tc">
                                        <span class="checkmark check-size"></span>
                                        Edit State TC
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="cityMaster">
                                    <span class="checkmark check-size"></span>
                                    City Masters
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="add_city_tc">
                                        <span class="checkmark check-size"></span>
                                        Add City TC
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_city_tc">
                                        <span class="checkmark check-size"></span>
                                        Edit City TC
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="shipTo_province_master">
                                    <span class="checkmark check-size"></span>
                                    Ship To Province Masters
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="add_province_tc">
                                        <span class="checkmark check-size"></span>
                                        Add Province TC
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_province_tc">
                                        <span class="checkmark check-size"></span>
                                        Edit Province TC
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="shipTo_municipal_master">
                                    <span class="checkmark check-size"></span>
                                    Ship To Municipal Masters
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="add_municipal_tc">
                                        <span class="checkmark check-size"></span>
                                        Add Municipal TC
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_municipal_tc">
                                        <span class="checkmark check-size"></span>
                                        Edit Municipal TC
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="shipTo_sector_master">
                                    <span class="checkmark check-size"></span>
                                    Ship To Sector Masters
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="add_sector_tc">
                                        <span class="checkmark check-size"></span>
                                        Add Sector TC
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_sector_tc">
                                        <span class="checkmark check-size"></span>
                                        Edit Sector TC
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="sales_report">
                                    <span class="checkmark check-size"></span>
                                    Sales Report
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="user_srepo">
                                        <span class="checkmark check-size"></span>
                                        User Sales Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="customer_srepo">
                                        <span class="checkmark check-size"></span>
                                        Customer Sales Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="shipTo_srepo">
                                        <span class="checkmark check-size"></span>
                                        Ship To Sales Report
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="package_master">
                                    <span class="checkmark check-size"></span>
                                    Package Master
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="create_package_master">
                                        <span class="checkmark check-size"></span>
                                        Create Package Master
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_package_master">
                                        <span class="checkmark check-size"></span>
                                        Edit Package Master
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_package_master">
                                        <span class="checkmark check-size"></span>
                                        Delete Package Master
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="warehouse_package_tracking">
                                    <span class="checkmark check-size"></span>
                                    Warehouse Package Tracking
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="update_container_pt">
                                        <span class="checkmark check-size"></span>
                                        Update Container Package Tracking
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_warehouse_pt">
                                        <span class="checkmark check-size"></span>
                                        Edit Package Tracking
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_warehouse_pt">
                                        <span class="checkmark check-size"></span>
                                        Delete Package Tracking
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="warehouse_package_error">
                                    <span class="checkmark check-size"></span>
                                    Warehouse Package Errors
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="clear_package_error">
                                        <span class="checkmark check-size"></span>
                                        Clear Package Error
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="wrh_pdist">
                                    <span class="checkmark check-size"></span>
                                    Warehouse Package Distribution
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="print_pdist">
                                        <span class="checkmark check-size"></span>
                                        Print Package Distribution
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="verify_pdist">
                                        <span class="checkmark check-size"></span>
                                        Verify Complete Package Distribution
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_pdist">
                                        <span class="checkmark check-size"></span>
                                        Edit Package Distribution
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_pdist">
                                        <span class="checkmark check-size"></span>
                                        Delete Package Distribution
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="wrh_verified">
                                    <span class="checkmark check-size"></span>
                                    Warhouse Package Verified
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="wrh_prepare_delivery">
                                    <span class="checkmark check-size"></span>
                                    Warehouse Prepare For Deliery
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_delivery2">
                                        <span class="checkmark check-size"></span>
                                        Edit Prepare For Delivery
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_delivery">
                                        <span class="checkmark check-size"></span>
                                        Delete Prepare For Delivery
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="missing_packs">
                                        <span class="checkmark check-size"></span>
                                        Get Missing packages
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="batch2">
                                        <span class="checkmark check-size"></span>
                                        Batch
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="addto_batch2">
                                        <span class="checkmark check-size"></span>
                                        Add To Batch
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="create_batch2">
                                        <span class="checkmark check-size"></span>
                                        Create Batch
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="visible_driver_batch">
                                        <span class="checkmark check-size"></span>
                                        Visible To Driver Batch
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_batch">
                                        <span class="checkmark check-size"></span>
                                        Edit Batch
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_batch">
                                        <span class="checkmark check-size"></span>
                                        Delete Batch
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="change_driver_batch">
                                        <span class="checkmark check-size"></span>
                                        Change Driver Batch
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_batch_packs">
                                        <span class="checkmark check-size"></span>
                                        Delete Batch Packages
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="print_report2">
                                        <span class="checkmark check-size"></span>
                                        Print Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="print_invoice">
                                        <span class="checkmark check-size"></span>
                                        Print Invoice
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="print_province">
                                        <span class="checkmark check-size"></span>
                                        Print Province
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="wrh_inventory">
                                    <span class="checkmark check-size"></span>
                                    Warehouse Inventory
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="create_batch3">
                                        <span class="checkmark check-size"></span>
                                        Create Batch
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="batch3">
                                        <span class="checkmark check-size"></span>
                                        Batch
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="batch_packs3">
                                        <span class="checkmark check-size"></span>
                                        Batch Packages
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="exchange_rate">
                                    <span class="checkmark check-size"></span>
                                    Exchange Rate
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="create_ex-rate">
                                        <span class="checkmark check-size"></span>
                                        Create Exchange Rate
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_ex-rate">
                                        <span class="checkmark check-size"></span>
                                        Edit Exchange Rate
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_ex-rate">
                                        <span class="checkmark check-size"></span>
                                        Delete Exchange Rate
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="wrh_location_master">
                                    <span class="checkmark check-size"></span>
                                    Warehouse Location Master
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="create_wrh_lm">
                                        <span class="checkmark check-size"></span>
                                        Create Warehouse Location Master
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_wrh_lm">
                                        <span class="checkmark check-size"></span>
                                        Edit Warehouse Location Master
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_wrh_lm">
                                        <span class="checkmark check-size"></span>
                                        Delete Warehouse Location Master
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="pickup_add">
                                    <span class="checkmark check-size"></span>
                                    PickUp Address
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="create_pickup_add">
                                        <span class="checkmark check-size"></span>
                                        Create PickUp Address
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_pickup_add">
                                        <span class="checkmark check-size"></span>
                                        Edit PickUp Address
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_pickup_add">
                                        <span class="checkmark check-size"></span>
                                        Delete PickUp Address
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="tenant_user">
                                    <span class="checkmark check-size"></span>
                                    Tenant Users
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="create_tenant_user">
                                        <span class="checkmark check-size"></span>
                                        Create Tenant Users
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_tenant_user">
                                        <span class="checkmark check-size"></span>
                                        Edit Tenant Users
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_tenant_user">
                                        <span class="checkmark check-size"></span>
                                        Delete Tenant Users
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="duplicate_user">
                                        <span class="checkmark check-size"></span>
                                        Duplicate Users Created
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="unlocked_user">
                                        <span class="checkmark check-size"></span>
                                        Lock Unlock User
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="user_login">
                                        <span class="checkmark check-size"></span>
                                        Login User
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="update_role">
                                        <span class="checkmark check-size"></span>
                                        Update Role Users
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="update_shift">
                                        <span class="checkmark check-size"></span>
                                        Update Timer Shift
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="company_settings">
                                    <span class="checkmark check-size"></span>
                                    Company Settings
                                </label>
                            </div>
                            <div class="checkboxlable bg-color  ms-4">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="edit_company_settings">
                                    <span class="checkmark check-size"></span>
                                    Edit Company Settings
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="inventory_item">
                                    <span class="checkmark check-size"></span>
                                    Inventory Purchase Item
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="create_inventory_item">
                                        <span class="checkmark check-size"></span>
                                        Create Inventory Purchase Item
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_inventory_item">
                                        <span class="checkmark check-size"></span>
                                        Delete Inventory Purchase Item
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="role&permission_2">
                                    <span class="checkmark check-size"></span>
                                    Roles & Permission
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="create_role_2">
                                        <span class="checkmark check-size"></span>
                                        Create Role
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_role_2">
                                        <span class="checkmark check-size"></span>
                                        Edit Role
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_role_2">
                                        <span class="checkmark check-size"></span>
                                        Delete Role
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="driver_inventory">
                                    <span class="checkmark check-size"></span>
                                    Driver Inventory
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="add_dri_invent">
                                        <span class="checkmark check-size"></span>
                                        Add Driver Inventory
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_dri_invent">
                                        <span class="checkmark check-size"></span>
                                        Delete Driver Inventory
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="send_pdf">
                                        <span class="checkmark check-size"></span>
                                        Send PDF Driver Inventory
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="cust_repo">
                                    <span class="checkmark check-size"></span>
                                    Custom Report
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="add_custRepo">
                                        <span class="checkmark check-size"></span>
                                        Add Custom Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_custRepo">
                                        <span class="checkmark check-size"></span>
                                        Edit Custom Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_custRepo_container">
                                        <span class="checkmark check-size"></span>
                                        Edit Custom Report Container
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_custRepo">
                                        <span class="checkmark check-size"></span>
                                        Delete Custom Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="custRepo_print">
                                        <span class="checkmark check-size"></span>
                                        Print Custom Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="exp_custRepo">
                                        <span class="checkmark check-size"></span>
                                        Expense Custom Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="add_exp_custRepo">
                                        <span class="checkmark check-size"></span>
                                        Add Expense Custom Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_exp_custRepo">
                                        <span class="checkmark check-size"></span>
                                        Edit Expense Custom Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_exp_custRepo">
                                        <span class="checkmark check-size"></span>
                                        Delete Expense Custom Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_cust_repo">
                                        <span class="checkmark check-size"></span>
                                        Edit Custom Report Package
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="delete_cust_repo">
                                        <span class="checkmark check-size"></span>
                                        Delete Custom Report Package
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="item_repo_print">
                                        <span class="checkmark check-size"></span>
                                        Print Item Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="status_report_print">
                                        <span class="checkmark check-size"></span>
                                        Print Container Status Report
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="verify_licen">
                                        <span class="checkmark check-size"></span>
                                        Verify License
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_custLicid_verify">
                                        <span class="checkmark check-size"></span>
                                        Edit CustLicId Verify License
                                    </label>
                                </div>
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="edit_shiptoLic_verify">
                                        <span class="checkmark check-size"></span>
                                        Edit ShipToLicId Verify License
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-32 mt-4">
                        <div class="twoRowsSec w-max-content p-32">
                            <div class="checkboxlable bg-color ">
                                <label class="custom_check primary cardFontSize fw_500">
                                    <input type="checkbox" class="d_none" name="container_comp_report">
                                    <span class="checkmark check-size"></span>
                                    Container Compare Report
                                </label>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="checkboxlable bg-color  ms-4">
                                    <label class="custom_check primary cardFontSize fw_500">
                                        <input type="checkbox" class="d_none" name="print_comp_report">
                                        <span class="checkmark check-size"></span>
                                        Print Container Compare Report
                                    </label>
                                </div>
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


    <!-- <script>
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

    </script> -->
</x-app-layout>


<!-- 
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
    </script> -->