<x-app-layout>
    <x-slot name="header">
        {{ __('Custom Reports') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head fw-semibold fs-4">Custom Reports</p>
        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control forms" placeholder="Search" id="searchInput" name="search" value="">

                    </div>
                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                    <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                        <span><i class="fe fe-refresh-ccw"></i></span>
                    </a>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <button class="btn btn-primary buttons" data-bs-toggle="modal" data-bs-target="#newReportModal">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        New Report
                    </div>
                </button>
            </div>
        </div>
    </div>

    <div class="row rounded-2 bg-custom text-dark">
        <div class="col-md-3 col-sm-6 col-lg-3 align-items-center">
            <label for="search_id" class="col-form-label">Search</label>
            <input type="text" id="search_id" class="form-control rounded-1 form-control-lg" placeholder="Search">
        </div>

        <div class="col-md-3 col-sm-6 col-lg-3 align-items-center noBorder">
            <label for="branch_id" class="col-form-label">Branch</label>
            <select class="form-select select2">
                <option selected>Select Branch</option>
                <option value="1">Afro Cargo OH USA</option>
                <option value="2">Afro Cargo GA USA</option>
                <option value="3">Afro Cargo Abidjan</option>
                <option value="4">Afro Cargo Bamako</option>
            </select>
        </div>

        <div class="col-md-3 col-sm-6 col-lg-3 align-items-center">
            <label for="date_id" class="col-form-label">Date</label>
            <input type="date" id="date_id" class="form-control rounded-1 form-control-lg">
        </div>

        <div class="col-md-3 col-sm-6 col-lg-3 align-items-center noBorder">
            <label for="report_id" class="col-form-label">Report Type</label>
            <select class="form-select select2">
                <option selected>Select Report Type</option>
                <option value="1">Invoice</option>
                <option value="2">Tracking</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="d-flex align-items-center justify-content-end mt-2">
            <button class="btn btn-primary" type="button">Search</button>
            <button class="btn btn-outline-danger ms-2" type="button">Reset</button>

        </div>
    </div>

    <div class="row mt-2 text-dark">
        <div class="col-auto">
            <div><strong>Total I-Amount:</strong>
                $176,504.00</div>
        </div> |
        <div class="col-auto">
            <div><strong>Total Expense:</strong>
                $0</div>
        </div> |
        <div class="col-auto">
            <div><strong>Total Income:</strong>
                $176,504.00</div>
        </div>
    </div>

    <div class="row">
        <div id='ajexTable'>
            <div class="card-table">
                <div class="table-body">
                    <div class="table-responsive mt-3">
                        <table class="table tables table-stripped table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="no-sort">Date</th>
                                    <th>Branch</th>
                                    <th>Container</th>
                                    <th>Report Type</th>
                                    <th>Doc Id</th>
                                    <th>Invoice</th>
                                    <th>Expense</th>
                                    <th>Exp</th>
                                    <th class="bg-transparent table-last-column">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>05/26/2025</td>
                                    <td>Afro Cargo N...</td>
                                    <td><a data-bs-toggle="modal" data-bs-target="#editContainerModal">Sudu8880982</a></td>
                                    <td>Invoice</td>
                                    <td>Billaly3Cars</td>
                                    <td>6000</td>
                                    <td class="text-danger">0</td>

                                    <td class="text-success">6000
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a data-bs-toggle="modal" data-bs-target="#trackingReportModal" class="dropdown-item"><i class="ti ti-mail me-2"></i></i>Send Pdf</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-edit me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expensePopupModal"><i class="ti ti-devices-dollar
                                                         me-2"></i>Expense</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>04/29/2024</td>
                                    <td>Afro Cargo N...</td>
                                    <td><a data-bs-toggle="modal" data-bs-target="#editContainerModal">01425</a>
                                    </td>
                                    <td>Invoice</td>
                                    <td>1</td>
                                    <td>7502.5</td>
                                    <td class="text-danger">0</td>
                                    <td class="text-success">750
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a data-bs-toggle="modal" data-bs-target="#trackingReportModal" class="dropdown-item"><i class="ti ti-mail me-2"></i></i>Send Pdf</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-edit me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expensePopupModal"><i class="ti ti-devices-dollar
                                                         me-2"></i>Expense</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>04/04/2025</td>
                                    <td>Afro Cargo N...</td>
                                    <td><a data-bs-toggle="modal" data-bs-target="#editContainerModal">01045abj</a>
                                    </td>
                                    <td>Invoice</td>
                                    <td>ACLUp787255</td>
                                    <td>39408.5</td>
                                    <td class="text-danger">0</td>

                                    <td class="text-success">394
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a data-bs-toggle="modal" data-bs-target="#trackingReportModal" class="dropdown-item"><i class="ti ti-mail me-2"></i></i>Send Pdf</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-edit me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expensePopupModal"><i class="ti ti-devices-dollar
                                                         me-2"></i>Expense</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>04/05/2025</td>
                                    <td>Afro Cargo N...</td>
                                    <td><a data-bs-toggle="modal" data-bs-target="#editContainerModal">Fafau5415337</a></td>
                                    <td>Invoice</td>
                                    <td>Fafau5415337</td>
                                    <td>40811</td>
                                    <td class="text-danger">0</td>

                                    <td class="text-success">750
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a data-bs-toggle="modal" data-bs-target="#trackingReportModal" class="dropdown-item"><i class="ti ti-mail me-2"></i></i>Send Pdf</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-edit me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expensePopupModal"><i class="ti ti-devices-dollar
                                                         me-2"></i>Expense</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>04/16/2025</td>
                                    <td>Afro Cargo N...</td>
                                    <td><a data-bs-toggle="modal" data-bs-target="#editContainerModal">01125abj</a>
                                    </td>
                                    <td>Invoice</td>
                                    <td>Gcnu73886</td>
                                    <td>44133</td>
                                    <td class="text-danger">0</td>

                                    <td class="text-success">441
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a data-bs-toggle="modal" data-bs-target="#trackingReportModal" class="dropdown-item"><i class="ti ti-mail me-2"></i></i>Send Pdf</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-edit me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expensePopupModal"><i class="ti ti-devices-dollar
                                                         me-2"></i>Expense</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>04/29/2025</td>
                                    <td>Afro Cargo N...</td>
                                    <td><a data-bs-toggle="modal" data-bs-target="#editContainerModal">1225gcnu7853</a></td>
                                    <td>Invoice</td>
                                    <td>SEALUL5073</td>
                                    <td>38649</td>
                                    <td class="text-danger">0</td>

                                    <td class="text-success">386
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a data-bs-toggle="modal" data-bs-target="#trackingReportModal" class="dropdown-item"><i class="ti ti-mail me-2"></i></i>Send Pdf</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-edit me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expensePopupModal"><i class="ti ti-devices-dollar
                                                         me-2"></i>Expense</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>05/26/2025</td>
                                    <td>Afro Cargo N...</td>
                                    <td><a data-bs-toggle="modal" data-bs-target="#editContainerModal">Sudu8880982</a></td>
                                    <td>Invoice</td>
                                    <td>Billaly3Cars</td>
                                    <td>6000</td>
                                    <td class="text-danger">0</td>

                                    <td class="text-success">600
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a data-bs-toggle="modal" data-bs-target="#trackingReportModal" class="dropdown-item"><i class="ti ti-mail me-2"></i></i>Send Pdf</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-edit me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expensePopupModal"><i class="ti ti-devices-dollar
                                                         me-2"></i>Expense</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Edit Container -->
    <div class="modal fade" id="editContainerModal" tabindex="-1" aria-labelledby="editContainerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editContainerModalLabel">Edit Container</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body noBorder">

                    <div class="mt-3">
                        <label for="exampleFormControlInput1" class="form-label mb-0">Branch<i class="text-danger">*</i>:</label>
                        <select class="form-select select2" aria-label="Default select example" disabled>
                            <option selected>Search Branch</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="exampleFormControlInput1" class="form-label mb-0">Container<i class="text-danger">*</i>:</label>
                        <select class="form-select select2" aria-label="Default select example" disabled>
                            <option value="">Container</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="doc_id" class="form-label mb-0">Doc Id<i class="text-danger">*</i>:</label>
                        <input type="text" id="doc_id" class="form-control" value="1">
                    </div>

                    <div class="mt-3">
                        <label for="lading_bill" class="form-label mb-0">Bill Of Lading<i class="text-danger">*</i>:</label>
                        <input type="text" id="lading_bill" class="form-control" value="1">
                    </div>

                    <div class="modal-footer p-0 pt-3 mt-3">
                        <button type="button" class="btn btn-primary change-color">Save changes</button>
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  New Report Modal -->
    <div class="modal fade" id="newReportModal" tabindex="-1" aria-labelledby="newReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newReportModalLabel">Add New Custom Report</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body noBorder">

                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Date<i class="text-danger">*</i>:</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" value="06-02-2025" placeholder="Enter Date" required>
                            <span class="input-group-text" id="basic-addon2" readonly>08 : 26 <button type="button" class="btn btn-default text-center p-1 btn-secondary ms-2" disabled>AM</button>
                            </span>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Report Type<i class="text-danger">*</i>:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                                <label class="form-check-label" for="inlineRadio1">Invoice</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">Tracking</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Branch<i class="text-danger">*</i>:</label>
                        <select class="form-select select2" aria-label="Default select example">
                            <option selected>Search Branch</option>
                            <option value="1">Afro Cargo Bamako</option>
                            <option value="2">Afro Cargo Abidjan</option>
                            <option value="3">Afro Cargo FL USA</option>
                            <option value="4">Afro Cargo GA USA</option>
                            <option value="5">Afro Cargo OH USA</option>
                            <option value="6">Afro Cargo NYC USA</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Container<i class="text-danger">*</i>:</label>
                        <select class="form-select select2" aria-label="Default select example" disabled>
                            <option value="">Search Container</option>
                        </select>
                    </div>

                    <div class="modal-footer p-0 pt-3">
                        <button type="button" class="btn btn-primary change-color">Save changes</button>
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Custom Tracking Report Pdf Modal -->
    <div class="modal fade" id="trackingReportModal" tabindex="-1" aria-labelledby="trackingReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h1 class="modal-title fs_18" id="trackingReportModalLabel">Send Custom Tracking Report Pdf</h1>
                    <button type="button" class="btn btn-primary btn-sm py-0 ms-2">Print Report</button>
                    <button type="button" class="btn-close ms-0 fs_18" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="mb-2">
                        <label for="lading_bill" class="form-label">Email Id<i class="text-danger">*</i>:</label>
                        <input type="email" id="lading_bill" class="form-control" value="" placeholder="Enter Emaill Id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm ms-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm ms-2">Send</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteCustomReportModal" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <!-- <div class="mb-3">
                            <i class="bi bi-exclamation-circle" style="font-size: 48px; color: orange;"></i>
                        </div> -->
                    <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                        <div class="swal2-icon-content">!</div>
                    </div>
                    <h4 class="fw-bold mb-2">Are you sure?</h4>
                    <p class="mb-4 fs_18">You won't be able to revert this!</p>
                    <button type="button" class="btn btn-danger me-2 rounded-1">Yes, delete it!</button>
                    <button type="button" class="btn btn-secondary rounded-1" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Expense Popup Modal -->
    <div class="modal fade" id="expensePopupModal" tabindex="-1" aria-labelledby="expensePopupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-size">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="expensePopupModalLabel">Edit Expense</h1>
                    <button type="button" class="btn-close fs_18" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="d-flex align-items-center justify-content-end mb-1 mt-3">
                        <div class="usersearch d-flex">
                            <div class="mt-2">
                                <button class="btn btn-primary buttons px-2" data-bs-toggle="modal" data-bs-target="#addExpensesModal">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle-plus me-1 text-white"></i>
                                        New Report
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id='ajexTable'>
                        <div class="card-table">
                            <div class="card-body"></div>
                            <div class="table-responsive table-height mt-3">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light ">
                                        <tr>
                                            <th class="text-truncate text-start">Date
                                            </th>
                                            <th class="text-truncate text-start">Category
                                            </th>
                                            <th class="text-truncate text-start">Note
                                            </th>
                                            <th class="text-truncate text-start">Amount
                                            </th>
                                            <th class="text-truncate text-start bg-transparent table-last-column">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="text-center">No Rows to Show</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  Add Expense Modal -->
    <div class="modal fade" id="addExpensesModal" tabindex="-1" aria-labelledby="addExpensesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addExpensesModalLabel">Add Expense</h1>
                    <button type="button" class="btn-close fs_18" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <div class="mb-2">
                        <label for="selectCategory" class="form-label">Expense Category<i class="text-danger">*</i>:</label>
                        <select class="form-select select2 border-top-0" aria-label="Default select example">
                            <option selected>Search Expense Category</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="amountInput" class="form-label">Amount<i class="text-danger">*</i>:</label>
                        <input class="form-control" id="amountInput" type="text" placeholder="Enter Amount" aria-label="default input example">

                    </div>
                    <div class="mb-2">
                        <label for="noteInput" class="form-label">Note:</label>
                        <input class="form-control" id="noteInput" type="text" placeholder="Enter Note" aria-label="default input example">
                    </div>

                    <div class="modal-footer p-0 pt-3">
                        <button type="button" class="btn btn-primary change-color">Save changes</button>
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
