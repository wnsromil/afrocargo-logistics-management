<x-app-layout>
    <x-slot name="header">
        {{ __('Custom Invoice Report') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head fw-semibold fs-4">Custom Invoice Report Details</p>
        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control forms" placeholder="Search" id="searchInput"
                            name="search" value="">

                    </div>
                </form>
            </div>
            <div class="mt-2">
                <button type="button"
                    class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                    <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                        <span><i class="fe fe-refresh-ccw"></i></span>
                    </a>
                </button>
            </div>
        </div>
    </x-slot>


    <div class="container-fluid">
        <div class="rounded-2 p-2 mt-2">
            <div class="row rounded-2 bg-custom">
                <div class="col-md-3 col-sm-6 col-lg-3 d-flex justify-content-between align-items-center">
                    <label for="search_id" class="col-form-label me-2">Search</label>
                    <input type="text" id="search_id" class="form-control rounded-1 form-control-lg"
                        placeholder="Search">
                </div>
            </div>

            <div class="row">
                <div class="d-flex align-items-center justify-content-end mt-2">
                    <div class="d-grid gap-2 d-md-block justify-content-end">
                        <button class="btn btn-primary btn-sm" type="button">Search</button>
                        <button class="btn btn-outline-danger btn-sm ms-2" type="button">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-2">
            <button class="btn btn-primary btn-sm mt-2" type="button" data-bs-toggle="modal"
                data-bs-target="#trackingReportModal">Item Report</button>
            <button class="btn btn-primary btn-sm mt-2" type="button">Container Status Report</button>
            <button class="btn btn-primary btn-sm mt-2" type="button">Container Status Print</button>
            <button class="btn btn-primary btn-sm mt-2" type="button">Print Invoice Report</button>
        </div>

        <div class="row">
            <div id='ajexTable'>
                <div class="card-table">
                  <div class="card-body">
                        <div class="table-responsive table-height mt-3">
                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light text-start px-3">
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice No</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Customer Lic</th>
                                        <th>Shipto Lic</th>
                                        <th>Items</th>
                                        <th class=" bg-transparent table-last-column">
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="px-3">
                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001319</td>
                                        <td>Layee Kromah</td>
                                        <td>4 Upland Gardens Dr</td>
                                        <td>null</td>
                                        <td>-</td>
                                        <td class="trunk-width text-truncate">Brown Box 8 With...</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001299</td>
                                        <td>Ahoua Kante</td>
                                        <td class=" trunk-width text-truncate">796 East 163rd Street
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class=" trunk-width text-truncate">Afro International...</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001308</td>
                                        <td>Irene G Bagnan</td>
                                        <td>220 Mt Nernon PI</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class=" trunk-width text-truncate">Barrel Large, Home...</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001321</td>
                                        <td>Seydou Saumahoro</td>
                                        <td>3 Wells Park Dr</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class=" trunk-width text-truncate">Invoirien Cargo Car...</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001309</td>
                                        <td>Ali Fofana</td>
                                        <td>1642 Park Ave</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class=" trunk-width text-truncate">New Computer in B...</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001316</td>
                                        <td>Julien Kouame</td>
                                        <td>6 Deerfield Rd</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class=" trunk-width text-truncate">Barrel Medium</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001298</td>
                                        <td>Antou Diakite</td>
                                        <td>200 W 148th St...</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class=" trunk-width text-truncate">Barrel large 3 doll...</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001296</td>
                                        <td>Fanta Fane</td>
                                        <td class=" trunk-width text-truncate">200 Bradhurst Ave</td>
                                        <td>null</td>
                                        <td>-</td>
                                        <td class=" trunk-width text-truncate">Peanut Butter Case...</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001297</td>
                                        <td>Mansse Balogun</td>
                                        <td>171-14 103rd Rd</td>
                                        <td>null</td>
                                        <td>-</td>
                                        <td class=" trunk-width text-truncate">Barrel Large</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>05/12/2025</td>
                                        <td>TIV-001295</td>
                                        <td>Khader Gbane</td>
                                        <td>63 Wyckoff Aver</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class=" trunk-width text-truncate">Suitecase(valise)...</td>
                                        <td>
                                            <i class="far fa-edit mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceReportModal"></i>
                                            <i class="far fa-trash-alt mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteInvoiceReportModal"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Invoice Report Modal -->
    <div class="modal fade" id="deleteInvoiceReportModal" tabindex="-1" aria-labelledby="deleteConfirmLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
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

    <!-- Custom Tracking Item Report Pdf Modal -->
    <div class="modal fade" id="trackingReportModal" tabindex="-1" aria-labelledby="trackingReportModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content tracking-modal-width">
                <div class="modal-header justify-content-between">
                    <h1 class="modal-title fs_18" id="trackingReportModalLabel">Send Custom Tracking Item Report Pdf
                    </h1>
                    <button type="button" class="btn btn-primary btn-sm py-0 ms-2">Print Report</button>
                    <button type="button" class="btn-close ms-0 fs_18" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="lading_bill" class="form-label mb-0">Email Id<i class="text-danger">*</i>:</label>
                        <input type="email" id="lading_bill" class="form-control" value=""
                            placeholder="Enter Emaill Id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm ms-2"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm ms-2">Send</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Invoice Report Modal -->
    <div class="modal fade" id="editInvoiceReportModal" tabindex="-1" aria-labelledby="deleteConfirmLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="expensePopupModalLabel">Edit Custom Report</h1>
                    <button type="button" class="btn-close fs_18" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="ng-untouched ng-invalid ng-dirty">
                        <div class="row px-2">
                            <div class="col-md-12">
                                <div class="mt-11">
                                    <div class="form-group">
                                        <label for="IdInput" class="form-label pt-2 mb-0">ID#<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="IdInput" value="TCP-000475"
                                            class="form-control ng-untouched ng-pristine" readonly>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="form-group">
                                        <label for="batchPackageDate" class="form-label pt-3 mb-0"> Date<span
                                                class="text-danger">*</span>:
                                        </label>
                                        <div class="input-group mb-0">
                                            <input type="date" id="batchPackageDate" name="date" placement="bottom"
                                                class="form-control " placeholder="MM-DD-YYYY" value="04-29-2024">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="form-group">
                                        <label for="customerName" class="form-label pt-3 mb-0">Customer
                                            Name<span class="text-danger">*</span></label>
                                        <input type="text" id="customerName" formcontrolname="customerName"
                                            placeholder="Enter Customer Name" class="form-control ">
                                        <div class="invalid-feedback mt-0">

                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="form-group">
                                        <label for="invoiceNumber" class="form-label pt-3 mb-0">Invoice
                                            Number<span class="text-danger">*</span></label>
                                        <input type="text" id="invoiceNumber" formcontrolname="invoiceNumber"
                                            placeholder="Enter Invoice Number" class="form-control ">

                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="form-group">
                                        <label for="customerAddress" class="form-label pt-3 mb-0">Customer Address<span
                                                class="text-danger">*</span></label>
                                        <input id="addressInput" formcontrolname="customerAddress"
                                            placeholder="Select Customer Address" maxlength="250"
                                            class="form-control  pac-target-input">
                                        <div></div>
                                    </div>
                                </div>

                                <!-- ---------------------------------- -->
                                <div class="mt-1">
                                    <div class="form-group">
                                        <div class="input-block">
                                            <label class="fw-normal pt-3 mb-0" for="phone">Customer Telephone
                                                <i class="text-danger">*</i></label>
                                            <div class="flaginputwrap">
                                                <div class="customflagselect">
                                                    <select class="flag-select" name="mobile_number_code_id">
                                                        @foreach ($coutry as $key => $item)
                                                            <option value="{{ $item->id }}"
                                                                data-image="{{ $item->flag_url }}"
                                                                data-name="{{ $item->name }}"
                                                                data-code="{{ $item->phonecode }}">
                                                                {{ $item->name }} +{{ $item->phonecode }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="number" class="form-control flagInput inp"
                                                    placeholder="Enter Mobile No" name="mobile_number"
                                                    value="{{ old('mobile_number') }}"
                                                    oninput="this.value = this.value.slice(0, 10)">
                                            </div>
                                            @error('mobile_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-1">
                                    <div class="form-group">
                                        <label for="receiverName" class="form-label pt-3 mb-0">Receiver
                                            Name<span class="text-danger">*</span></label>
                                        <input type="text" id="receiverName" formcontrolname="receiverName"
                                            placeholder="Enter Receiver Name" value="Chekou Traore"
                                            class="form-control">

                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="form-group">
                                        <label for="cedula" class="form-label pt-3 mb-0">Cedula<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="cedula" formcontrolname="cedula"
                                            placeholder="Enter Cedula"
                                            class="form-control ng-untouched ng-pristine ng-invalid">
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="form-group">
                                        <label for="receiverAddress" class="form-label pt-3 mb-0">Receiver Address<span
                                                class="text-danger">*</span></label>
                                        <input id="addressInput" formcontrolname="receiverAddress"
                                            placeholder="Select Receiver Address" value="Abidjan" class="form-control">

                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="form-group">
                                        <label for="province" class="form-label pt-3 mb-0">Province<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="province" formcontrolname="province"
                                            placeholder="Enter Province" value="AbidjaM" class="form-control ">
                                    </div>
                                </div>

                                <div class="mt-1">
                                    <div class="form-group">
                                        <div class="input-block">
                                            <label class="fw-normal pt-3 mb-0" for="phone">Receiver Telephone
                                                <i class="text-danger">*</i></label>
                                            <div class="flaginputwrap">
                                                <div class="customflagselect">
                                                    <select class="flag-select" name="mobile_number_code_id">
                                                        @foreach ($coutry as $key => $item)
                                                            <option value="{{ $item->id }}"
                                                                data-image="{{ $item->flag_url }}"
                                                                data-name="{{ $item->name }}"
                                                                data-code="{{ $item->phonecode }}">
                                                                {{ $item->name }} +{{ $item->phonecode }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="number" class="form-control flagInput inp"
                                                    placeholder="Enter Mobile No" name="mobile_number"
                                                    value="{{ old('mobile_number') }}"
                                                    oninput="this.value = this.value.slice(0, 10)">
                                            </div>
                                            @error('mobile_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-1">
                                    <div class="form-group">
                                        <label for="invoiceDetail" class="form-label pt-3 mb-0">Invoice
                                            Details<span class="text-danger">*</span></label>
                                        <input type="text" id="invoiceDetail" formcontrolname="invoiceDetail"
                                            placeholder="Enter Invoice Details"
                                            class="form-control ng-untouched ng-pristine ng-invalid">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer p-0 pt-3">
                                <button type="button" class="btn btn-primary btn-sm change-color">Save changes</button>
                                <button type="button" class="btn btn-secondary btn-sm ms-2"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>