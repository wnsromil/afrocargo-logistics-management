<x-app-layout>
    <x-slot name="header">
        {{ __('Vehicle Loading / Unloading Tracker') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">Vehicle Loading / Unloading Tracker</p>
        <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    {{-- <a data-bs-toggle="modal" data-bs-target="#AddRequestForm" class="btn btn-primary buttons"
                        style="background:#203A5F">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Request
                    </a> --}}
                </div>
            </div>
        </div>
    </x-slot>

    <form id="expenseFilterForm">
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search">
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>Status</label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Status</option>
                    <option value="Self Pickup">Self Pickup</option>
                    <option value="Pickup by Driver">Pickup by Driver</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Date Range</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info height40">
                    <input type="text" class="btn-filters daterangeInput form-control form-cs height40"
                        name="orderDate" placeholder="From Date - To Date" />
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>Vessel</label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Vessel</option>
                    <option value="vessel 1">vessel 1</option>
                    <option value="vessel 2">vessel 2</option>
                    <option value="vessel 3">vessel 3</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>port</label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select port</option>
                    <option value="Tulsa">Tulsa</option>
                    <option value="Cocchin">Cocchin</option>
                    <option value="Arizona">Arizona</option>
                </select>
            </div>
            <div class="col mb-3 d-flex justify-content-end align-items-end">
                <a href="{{ route('admin.advance_reports.index') }}"
                    class="btn btn-outline-danger btnr me-sm-2">Reset</a>
                <button type="submit" class="btn btn-primary btnf">Filter</button>
            </div>
        </div>
    </form>




    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable pxless">
                        <thead class="thead-light">
                            <tr>
                                <th>RoRo ID</th>
                                <th>Vehicle</th>
                                <th>Loading By</th>
                                <th>Loading Status</th>
                                <th>Loading Time (In/Out)</th>
                                <th>Unloading Status</th>
                                <th>Unloading Time</th>
                                <th>Unloading By</th>
                                <th>Images</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>RORO-2025-001</td>
                                <td>2015 Toyota Camry<br>
                                    DSA222333323
                                </td>
                                <td>Brian Bordina</td>
                                <td><span class="badge badge-soft-warning fw_mid fs_13 py-2">Pending</span></td>
                                <td>06-29-2025 10:00 PM</td>
                                <td><span class="badge badge-soft-warning fw_mid fs_13 py-2">Pending</span></td>
                                <td>07-03-2025 10:00 PM</td>
                                <td>Clark Markham</td>
                                <td><a data-bs-toggle="modal" data-bs-target="#documentShows" class="imgover"><i
                                            class="ti ti-photo fs_24"></i></a></td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('admin.vehicle-load-unload.load_unload', 1) }}"
                                                        class="dropdown-item">
                                                        <i class="far fa-eye me-2"></i>
                                                        Show</a>
                                                </li>
                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#VehicleLoadingModal"
                                                        class="dropdown-item">
                                                        <i class="ti ti-s-turn-up me-2 fs_16"></i>
                                                        Track Loading</a>
                                                </li>
                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#VehicleUnLoadingModal"
                                                        class="dropdown-item">
                                                        <i class="ti ti-s-turn-down me-2 fs_16"></i>
                                                        Track Unloading</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>RORO-2025-002</td>
                                <td>2020 Mitsubisi Pajero<br>
                                    MT333222PJ111
                                </td>
                                <td>Gabrial Mageto</td>
                                <td><span class="badge bg-success-light fs_13 py-2">Completed</span></td>
                                <td>06-29-2025 10:00 PM</td>
                                <td><span class="badge badge-soft-warning fw_mid fs_13 py-2">Pending</span></td>
                                <td>07-03-2025 10:00 PM</td>
                                <td>Robert Pattison</td>
                                <td><a data-bs-toggle="modal" data-bs-target="#documentShows" class="imgover"><i
                                            class="ti ti-photo fs_24"></i></a></td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('admin.vehicle-load-unload.load_unload', 1) }}"
                                                        class="dropdown-item">
                                                        <i class="far fa-eye me-2"></i>
                                                        Show</a>
                                                </li>
                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#VehicleLoadingModal"
                                                        class="dropdown-item">
                                                        <i class="ti ti-s-turn-up me-2 fs_16"></i>
                                                        Track Loading</a>
                                                </li>
                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#VehicleUnLoadingModal"
                                                        class="dropdown-item">
                                                        <i class="ti ti-s-turn-down me-2 fs_16"></i>
                                                        Track Unloading</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>RORO-2025-003</td>
                                <td>2018 BMW X7<br>
                                    DSA65582456
                                </td>
                                <td>Alex Carnia</td>
                                <td><span class="badge bg-success-light fs_13 py-2">Completed</span></td>
                                <td>06-19-2025 10:00 PM</td>
                                <td><span class="badge bg-success-light fs_13 py-2">Completed</span></td>
                                <td>06-25-2025 10:00 PM</td>
                                <td>Liam Nelson</td>
                                <td><a data-bs-toggle="modal" data-bs-target="#documentShows" class="imgover"><i
                                            class="ti ti-photo fs_24"></i></a></td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('admin.vehicle-load-unload.load_unload', 1) }}"
                                                        class="dropdown-item">
                                                        <i class="far fa-eye me-2"></i>
                                                        Show</a>
                                                </li>
                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#VehicleLoadingModal"
                                                        class="dropdown-item">
                                                        <i class="ti ti-s-turn-up me-2 fs_16"></i>
                                                        Track Loading</a>
                                                </li>
                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#VehicleUnLoadingModal"
                                                        class="dropdown-item">
                                                        <i class="ti ti-s-turn-down me-2 fs_16"></i>
                                                        Track Unloading</a>
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


    <div class="modal fade" id="PickupArrangement" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Pickup Arrangement</h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Customer Name</label>
                            <input type="text" class="form-control form-cs inp ps-3" name="customerName"
                                placeholder="Enter Customer Name" readonly value="Charls Xavier" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Vehicle Details</label>
                            <input type="text" class="form-control form-cs inp ps-3" name="VehicleDetails"
                                placeholder="Enter Customer Name" readonly value="2015 Toyota Camry" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Vin Number</label>
                            <input type="text" class="form-control form-cs inp ps-3" name="VinNumber"
                                placeholder="Enter Customer Name" readonly value="2015FR445G345452" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-block mb-3 d-flex align-items-center">
                                        <label class="foncolor mb-0 pt-0 me-3">Self Pickup</label>
                                        <input class="form-check-input mt-0" type="radio" name="InOutType"
                                            value="In" checked>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-block mb-3 d-flex align-items-center">
                                        <label class="foncolor mb-0 pt-0 me-3">Pickup by Company</label>
                                        <input class="form-check-input mt-0" type="radio" name="InOutType"
                                            value="Out">
                                    </div>
                                </div>
                                <div id="toggleDiv" class="col-md-6" style="display: none;">
                                    <div class="mb-3">
                                        <label class="foncolor mt-0 pt-0">Assign Driver <i
                                                class="text-danger">*</i></label>
                                        <select name="AssignDriver" class="form-control select2 Tags">
                                            <option hidden disabled selected value="">Select Driver</option>
                                            <option value="1">Alex Carry</option>
                                            <option value="2">Brian O'Connor</option>
                                            <option value="3">Clare Minasa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Pickup Date Time</label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text"
                                    class="btn-filters datetimepicker form-control form-cs inp  text-lowercase"
                                    name="currentdate" placeholder="mm-dd-yyyy" />
                                <input type="text"
                                    class="form-control inp inputs text-center timeOnlyInput smallinput" readonly
                                    value="08:30 AM" name="currentTime">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Pickup Location</label>
                            <input type="text" class="form-control inp" name="PickupLocation"
                                placeholder="Enter Location" value="AFRO NYC Warehouse NYC" readonly />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Change Status <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2" name="main_type">
                                <option hidden selected disabled value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Picked Up">Picked Up</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="foncolor">Notes</label>
                            <textarea type="text" class="form-control" name="notes" placeholder="Enter Your Message"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="checkbox-inline">
                                <label class="checkbox d-flex align-items-center gap-1">
                                    <input type="checkbox" name="Checkboxes3">
                                    <span></span>Notify Customer</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary confirm-supply me-2"
                        data-bs-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="VehicleLoadingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Vehicle Loading Tracker</h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Loading Details</h6>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Change Status <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2" name="main_type">
                                <option hidden selected disabled value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Picked Up">Picked Up</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Loaded By (Staff Name) <i class="text-danger">*</i></label>
                            <select name="AssignDriver" class="js-example-basic-single select2">
                                <option hidden disabled selected value="">Select Driver</option>
                                <option value="1">Alex Carry</option>
                                <option value="2">Brian O'Connor</option>
                                <option value="3">Clare Minasa</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Loading Time</label>
                            <div
                                class="daterangepicker-wrap cal-icon cal-icon-info d-flex flex-wrap dateTime dateTime2">
                                <input type="text"
                                    class="btn-filters datetimepicker form-control form-cs inp text-lowercase"
                                    name="InspectionDateTime" placeholder="mm-dd-yyyy" />
                                <input type="text"
                                    class="form-control inp inputs text-center onlyTimePicker smallinput flatpickr-input d-inline"
                                    value="08:30 AM" name="currentTime">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="foncolor">Upload Loading Image</label>
                            <div class="form-group">
                                <div class="custom-uploader multiple">
                                    <p id="frontText">
                                        <i class="d-block fs_18 fa-solid fa-upload"></i>
                                        Drag or tap to upload image<br><small>Upload clear photo</small>
                                    </p>
                                    <input type="file" accept="image/*" capture="environment" id="frontImage"
                                        multiple
                                        onchange="previewMultipleUpload(event, 'frontPreviewContainer', 'frontText')" />
                                    <div id="frontPreviewContainer"
                                        class="d-flex justify-content-center flex-wrap mt-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="foncolor">Condition Notes</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" placeholder="Enter Your Notes" rows="4"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="foncolor">Damage Found?</label>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block mb-3 d-flex align-items-center">
                                                <label class="foncolor mb-0 pt-0 me-3">No</label>
                                                <input class="form-check-input mt-0" type="radio"
                                                    name="DamageFound" value="No" checked>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block mb-3 d-flex align-items-center">
                                                <label class="foncolor mb-0 pt-0 me-3">Yes</label>
                                                <input class="form-check-input mt-0" type="radio"
                                                    name="DamageFound" value="Yes">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="toggleDiv" class="col-md-8" style="display: none;">
                                    <label class="foncolor">Damage Images</label>
                                    <div class="form-group">
                                        <div class="custom-uploader multiple">
                                            <p id="frontText">
                                                <i class="d-block fs_18 fa-solid fa-upload"></i>
                                                Drag or tap to upload image<br><small>Upload clear photo</small>
                                            </p>
                                            <input type="file" accept="image/*" capture="environment"
                                                id="frontImage" multiple
                                                onchange="previewMultipleUpload(event, 'frontPreviewContainer', 'frontText')" />
                                            <div id="frontPreviewContainer"
                                                class="d-flex justify-content-center flex-wrap mt-2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="foncolor">Signature of loader</label>
                            <div class="form-group">
                                <div class="custom-uploader multiple">
                                    <p id="frontText">
                                        <i class="d-block fs_18 fa-solid fa-upload"></i>
                                        Drag or tap to upload image<br><small>Upload clear photo</small>
                                    </p>
                                    <input type="file" accept="image/*" capture="environment" id="frontImage"
                                        multiple
                                        onchange="previewMultipleUpload(event, 'frontPreviewContainer', 'frontText')" />
                                    <div id="frontPreviewContainer"
                                        class="d-flex justify-content-center flex-wrap mt-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="checkbox-inline">
                                <label class="checkbox d-flex align-items-center gap-1">
                                    <input type="checkbox" name="Checkboxes3">
                                    <span></span>Notify Customer</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary confirm-supply me-2"
                        data-bs-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="VehicleUnLoadingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Vehicle Unloading Tracker</h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Unloading Details</h6>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Change Status <i class="text-danger">*</i></label>
                            <select class="js-example-basic-single select2" name="main_type">
                                <option hidden selected disabled value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Picked Up">Picked Up</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Loaded By (Staff Name) <i class="text-danger">*</i></label>
                            <select name="AssignDriver" class="js-example-basic-single select2">
                                <option hidden disabled selected value="">Select Driver</option>
                                <option value="1">Alex Carry</option>
                                <option value="2">Brian O'Connor</option>
                                <option value="3">Clare Minasa</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Unloading Time</label>
                            <div
                                class="daterangepicker-wrap cal-icon cal-icon-info d-flex flex-wrap dateTime dateTime2">
                                <input type="text"
                                    class="btn-filters datetimepicker form-control form-cs inp text-lowercase"
                                    name="InspectionDateTime" placeholder="mm-dd-yyyy" />
                                <input type="text"
                                    class="form-control inp inputs text-center onlyTimePicker smallinput flatpickr-input d-inline"
                                    value="08:30 AM" name="currentTime">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="foncolor">Upload Unloading Image</label>
                            <div class="form-group">
                                <div class="custom-uploader multiple">
                                    <p id="frontText">
                                        <i class="d-block fs_18 fa-solid fa-upload"></i>
                                        Drag or tap to upload image<br><small>Upload clear photo</small>
                                    </p>
                                    <input type="file" accept="image/*" capture="environment" id="frontImage"
                                        multiple
                                        onchange="previewMultipleUpload(event, 'frontPreviewContainer', 'frontText')" />
                                    <div id="frontPreviewContainer"
                                        class="d-flex justify-content-center flex-wrap mt-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="foncolor">Condition Notes</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" placeholder="Enter Your Notes" rows="4"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="foncolor">Damage Found?</label>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block mb-3 d-flex align-items-center">
                                                <label class="foncolor mb-0 pt-0 me-3">No</label>
                                                <input class="form-check-input mt-0" type="radio"
                                                    name="DamageFound" value="No" checked>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block mb-3 d-flex align-items-center">
                                                <label class="foncolor mb-0 pt-0 me-3">Yes</label>
                                                <input class="form-check-input mt-0" type="radio"
                                                    name="DamageFound" value="Yes">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="toggleDiv" class="col-md-8" style="display: none;">
                                    <label class="foncolor">Damage Images</label>
                                    <div class="form-group">
                                        <div class="custom-uploader multiple">
                                            <p id="frontText">
                                                <i class="d-block fs_18 fa-solid fa-upload"></i>
                                                Drag or tap to upload image<br><small>Upload clear photo</small>
                                            </p>
                                            <input type="file" accept="image/*" capture="environment"
                                                id="frontImage" multiple
                                                onchange="previewMultipleUpload(event, 'frontPreviewContainer', 'frontText')" />
                                            <div id="frontPreviewContainer"
                                                class="d-flex justify-content-center flex-wrap mt-2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="foncolor">Signature of Unloader</label>
                            <div class="form-group">
                                <div class="custom-uploader multiple">
                                    <p id="frontText">
                                        <i class="d-block fs_18 fa-solid fa-upload"></i>
                                        Drag or tap to upload image<br><small>Upload clear photo</small>
                                    </p>
                                    <input type="file" accept="image/*" capture="environment" id="frontImage"
                                        multiple
                                        onchange="previewMultipleUpload(event, 'frontPreviewContainer', 'frontText')" />
                                    <div id="frontPreviewContainer"
                                        class="d-flex justify-content-center flex-wrap mt-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="checkbox-inline">
                                <label class="checkbox d-flex align-items-center gap-1">
                                    <input type="checkbox" name="Checkboxes3">
                                    <span></span>Notify Customer</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary confirm-supply me-2"
                        data-bs-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.activate, .deactivate').on('click', function() {
            let id = $(this).data('id');
            let status = $(this).data('status');

            $.ajax({
                url: "{{ route('admin.vehicle.status', '') }}/" + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Status Updated',
                            text: response.success
                        });

                        location.reload();
                    }
                }
            });
        });
    </script>

    @section('script')
        <script>
            // 🖼 Image Preview Function
            function previewImage(input, imageType) {
                if (input.files && input.files[0]) {
                    let file = input.files[0];

                    // Only PNG or JPG Allowed
                    if (file.type === "image/png" || file.type === "image/jpeg") {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('preview_' + imageType).src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert("Only PNG & JPG images are allowed!");
                        input.value = ""; // remove Invalid file
                    }
                }
            }

            //  Remove Image Function
            function removeImage(imageType) {
                document.getElementById('preview_' + imageType).src = "{{ asset('../assets/img.png') }}";
                document.getElementById('file_' + imageType).value = "";
            }
            $('#country_code').val($('.mobile_code').find('.iti__selected-dial-code').text());
            $('.col-md-12').on('click', () => {
                $('#country_code').val($('.mobile_code').find('.iti__selected-dial-code').text());
            })

            $('#country_code_2').val($('.alternate_mobile_no').find('.iti__selected-dial-code').text());
            $('.col-md-12').on('click', () => {
                $('#country_code_2').val($('.alternate_mobile_no').find('.iti__selected-dial-code').text());
            })
        </script>
        <script>
            $(document).ready(function() {
                var oldState = "{{ old('state') }}"; // Laravel old value
                var oldCity = "{{ old('city') }}";

                // ✅ Agar old state available hai toh state ke cities load kare
                if (oldState) {
                    $('#state').html('<option selected="selected">Loading...</option>');
                    $.ajax({
                        url: '/api/get-states/' + $('#country').val(),
                        type: 'GET',
                        success: function(states) {
                            $('#state').html('<option selected="selected">Select State</option>');
                            $.each(states, function(key, state) {
                                var selected = (state.id == oldState) ? 'selected' :
                                    ''; // ✅ Old value match kare
                                $('#state').append('<option value="' + state.id + '" ' + selected +
                                    '>' + state.name + '</option>');
                            });

                            // ✅ Agar old city available hai, toh cities load kare
                            if (oldCity) {
                                $('#city').html('<option selected="selected">Loading...</option>');
                                $.ajax({
                                    url: '/api/get-cities/' + oldState,
                                    type: 'GET',
                                    success: function(cities) {
                                        $('#city').html(
                                            '<option selected="selected">Select City</option>'
                                        );
                                        $.each(cities, function(key, city) {
                                            var selected = (city.id == oldCity) ?
                                                'selected' :
                                                ''; // ✅ Old value match kare
                                            $('#city').append('<option value="' + city
                                                .id + '" ' + selected + '>' + city
                                                .name + '</option>');
                                        });
                                    }
                                });
                            }
                        }
                    });
                }
                // Country Change Event
                $('#country').change(function() {
                    var country_id = $(this).val();
                    $('#state').html('<option selected="selected">Loading...</option>');
                    $('#city').html('<option selected="selected">Select City</option>');

                    $.ajax({
                        url: '/api/get-states/' + country_id,
                        type: 'GET',
                        success: function(states) {
                            $('#state').html(
                                '<option selected="selected" value="">Select State</option>');
                            $.each(states, function(key, state) {
                                $('#state').append('<option value="' + state.id + '">' +
                                    state.name + '</option>');
                            });
                        }
                    });
                });

                // State Change Event
                $('#state').change(function() {
                    var state_id = $(this).val();
                    $('#city').html('<option selected="selected">Loading...</option>');

                    $.ajax({
                        url: '/api/get-cities/' + state_id,
                        type: 'GET',
                        success: function(cities) {
                            $('#city').html(
                                '<option selected="selected" value="">Select City</option>');
                            $.each(cities, function(key, city) {
                                $('#city').append('<option value="' + city.id + '">' + city
                                    .name + '</option>');
                            });
                        }
                    });
                });
            });
        </script>
        <script>
            $(function() {
                $('input[name="InOutType"]').on('change', function() {
                    $('#toggleDiv').toggle($(this).val() === 'Out');
                });
            });
        </script>

        <script>
            $(function() {
                $('input[name="DamageFound"]').on('change', function() {
                    $('#toggleDiv').toggle($(this).val() === 'Yes');
                });
            });
        </script>
        <script>
            function previewMultipleUpload(event, containerId, textId) {
                const files = event.target.files;
                const container = document.getElementById(containerId);
                const placeholder = document.getElementById(textId);

                container.innerHTML = ''; // Clear previous previews
                placeholder.style.display = 'none';

                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function() {
                        const img = document.createElement('img');
                        img.src = reader.result;
                        img.className = 'preview-image m-1';
                        img.style.maxWidth = '100px';
                        img.style.borderRadius = '6px';
                        container.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        </script>
    @endsection
</x-app-layout>
