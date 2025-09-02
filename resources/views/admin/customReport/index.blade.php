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

    <div class="container-fluid ">
        <div class="rounded-2 p-2 mt-3">
            <form action="{{route('admin.custom-reports.index')}}" method="get">
                <div class="row rounded-2 bg-custom text-dark">
                    <div class="col-md-3 col-sm-6 col-lg-3 align-items-center">
                        <label for="search_id" class="col-form-label">Search</label>
                        <input type="text" id="search_id" name="search" class="form-control rounded-1 form-control-lg"
                            placeholder="Search">
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 align-items-center noBorder">
                        <label for="branch_id" class="col-form-label">Branch</label>
                        <select class="form-select select2" name="warehouse_id" id="branch_id">
                            <option selected value="">Select Branch</option>
                            @foreach ($warehouses as $warehouse)
                            <option {{request()->get('warehouse_id') && request()->get('warehouse_id') == $warehouse->id
                                ? 'selected':'' }} value="{{$warehouse->id ?? ''}}">{{$warehouse->warehouse_name ?? ''}}
                                {{$warehouse->warehouse_code ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 col-sm-6 col-lg-3 align-items-center">
                        <label for="date_id" class="col-form-label">Date</label>
                        <input type="date" id="date_id" class="form-control rounded-1 form-control-lg"
                            name="report_date" value="{{request()->get('report_date') ?? ''}}"
                            placeholder="Enter Date">
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
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-trash me-2"></i>Delete</a>
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
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-trash me-2"></i>Delete</a>
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
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-trash me-2"></i>Delete</a>
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
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-trash me-2"></i>Delete</a>
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
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-trash me-2"></i>Delete</a>
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
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-trash me-2"></i>Delete</a>
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
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCustomReportModal"><i class="ti ti-trash me-2"></i>Delete</a>
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

                <div class="row">
                    <div class="d-flex align-items-center justify-content-end mt-2">
                        <button class="btn btn-primary" type="submit">Search</button>
                        <button class="btn btn-outline-danger ms-2"
                            onclick="redirectTo('{{route('admin.custom-reports.index')}}')" type="button">Reset</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

        <div class="row mt-2 text-dark">
            <div class="col-auto">
                <div><strong>Total I-Amount:</strong>
                    ${{$totalAmount ?? 0}}</div>
            </div> |
            <div class="col-auto">
                <div><strong>Total Expense:</strong>
                    ${{$totalInvoiced ?? 0}}</div>
            </div> |
            <div class="col-auto">
                <div><strong>Total Income:</strong>
                    ${{$totalExpense ?? 0}}</div>
            </div>
        </div>
    </div>

        <div class="row">
            <div id='ajexTable'>
                <div class="card-table">
                    <div class="table-body">
                        <div class="table-responsive table-height mt-3">
                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light text-start">
                                    <tr>
                                        <th>Date</th>
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
                                    @forelse ($customReports as $customReport)
                                    <tr>
                                        <td>{{$customReport->report_date->format('m/d/Y') ?? ''}}</td>
                                        <td>{{$customReport->warehouse->warehouse_name ?? ''}},
                                            {{$customReport->warehouse->warehouse_code ?? ''}}</td>
                                        <td><a data-bs-toggle="modal"
                                                data-bs-target="#editContainerModal{{$customReport->id}}">{{$customReport->container->unique_id
                                                ?? ''}}</a></td>
                                        <td>{{$customReport->report_type ?? ''}}</td>
                                        <td>{{$customReport->container->doc_id ?? ''}}</td>
                                        <td>{{$customReport->invoiced ?? 0 }}</td>
                                        <td class="text-danger">{{$customReport->expense ?? ''}}</td>

                                        <td class="text-success">{{ sum($customReport->expense ?? 0,
                                            $customReport->invoiced ?? 0) }}
                                        </td>
                                        <td>
                                            <i class="fa-regular fa-envelope me-1" data-bs-toggle="modal"
                                                data-bs-target="#trackingReportModal"></i>
                                            <i class="far fa-edit mx-1"
                                                onclick="redirectTo('{{route('admin.custom-reports.show',$customReport->id)}}')"></i>
                                            <i class="far fa-trash-alt mx-1"
                                                onclick="deleteRaw('{{route('admin.custom-reports.destroy',$customReport->id)}}')"></i>
                                            <button type="button" class="btn bg-transparent fw-semibold p-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#expensePopupModal">Expense</button>
                                        </td>


                                        <!-- Edit Container -->
                                        <div class="modal custom-modal fade"
                                            id="editContainerModal{{$customReport->id}}" tabindex="-1"
                                            aria-labelledby="editContainerModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editContainerModalLabel">Edit
                                                            Container</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body noBorder">
                                                        <form
                                                            action="{{route('admin.custom-reports.updateCustomReportContainer')}}"
                                                            method="post">
                                                            @csrf
                                                            <div class="mt-3">
                                                                <label for="exampleFormControlInput1"
                                                                    class="form-label mb-0">Branch<i
                                                                        class="text-danger">*</i>:</label>
                                                                <select class="form-select select2"
                                                                    aria-label="Default select example"
                                                                    name="warehouse_id" disabled>
                                                                    <option selected>Search Branch</option>
                                                                    @foreach ($warehouses as $warehouse)
                                                                    <option {{$customReport->warehouse_id ==
                                                                        $warehouse->id ? 'selected' :'' }}
                                                                        value="{{$warehouse->id ??
                                                                        ''}}">{{$warehouse->warehouse_name ?? ''}},
                                                                        {{$warehouse->warehouse_code ?? ''}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mt-3">
                                                                <label for="exampleFormControlInput1"
                                                                    class="form-label mb-0">Container<i
                                                                        class="text-danger">*</i>:</label>
                                                                <select class="form-select select2"
                                                                    aria-label="Default select example" disabled>
                                                                    @foreach ($containers as $item)
                                                                    <option {{$customReport->container_id == $item->id ?
                                                                        'selected' :'' }}
                                                                        value="{{$item->id}}">{{$item->unique_id}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" name="container_id"
                                                                    value="{{$customReport->container_id}}">
                                                            </div>

                                                            <div class="mt-3">
                                                                <label for="doc_id" class="form-label mb-0">Doc Id<i
                                                                        class="text-danger">*</i>:</label>
                                                                <input type="text" id="doc_id" name="doc_id"
                                                                    class="form-control"
                                                                    value="{{$customReport->container->doc_id ?? '' }}">
                                                            </div>

                                                            <div class="mt-3">
                                                                <label for="lading_bill" class="form-label mb-0">Bill Of
                                                                    Lading<i class="text-danger">*</i>:</label>
                                                                <input type="text" id="lading_bill"
                                                                    name="bill_of_lading" class="form-control"
                                                                    value="{{$customReport->container->bill_of_lading ?? 0 }}">
                                                            </div>

                                                            <div class="modal-footer p-0 pt-3 mt-3">
                                                                <button type="submit"
                                                                    class="btn btn-primary change-color">Save
                                                                    changes</button>
                                                                <button type="button" class="btn btn-secondary ms-2"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No custom reports found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
                    <div class="col-md-6 d-flex p-2 align-items-center">
                        <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
                        <select class="form-select input-width form-select-sm opacity-50"
                            aria-label="Small select example" id="pageSizeSelect">
                            <option value="10" {{ request('per_page', 10)==10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page')==20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page')==100 ? 'selected' : '' }}>100</option>
                        </select>
                        <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="float-end">
                            <div class="bottom-user-page mt-3">
                                {!! $customReports->appends(['per_page' =>
                                request('per_page')])->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>







    <!--  New Report Modal -->
    <div class="modal custom-modal fade" id="newReportModal" tabindex="-1" aria-labelledby="newReportModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newReportModalLabel">Add New Custom Report</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body noBorder">
                    <form action="{{ route('admin.custom-reports.store') }}" method="POST" id="addCustomReportForm">
                        @csrf
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Date<i
                                    class="text-danger">*</i>:</label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="report_date" value="{{date('m-d-Y')}}"
                                    placeholder="Enter Date" required>
                                <span class="input-group-text" id="basic-addon2" readonly>08 : 26 <button type="button"
                                        class="btn btn-default text-center p-1 btn-secondary ms-2" disabled>AM</button>
                                </span>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Report Type<i
                                    class="text-danger">*</i>:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="report_type" id="inlineRadio1"
                                        value="Invoice" checked>
                                    <label class="form-check-label" for="inlineRadio1">Invoice</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="report_type" id="inlineRadio2"
                                        value="Tracking">
                                    <label class="form-check-label" for="inlineRadio2">Tracking</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Branch<i
                                    class="text-danger">*</i>:</label>
                            <select class="form-select select2" aria-label="Default select example" name="warehouse_id"
                                id="addReportBranch">
                                <option selected>Search Branch</option>
                                @foreach ($warehouses as $warehouse)
                                <option value="{{$warehouse->id ?? ''}}">{{$warehouse->warehouse_name ?? ''}}
                                    {{$warehouse->warehouse_code ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Container<i
                                    class="text-danger">*</i>:</label>
                            <select class="form-select select2" aria-label="Default select example" name="container_id"
                                id="addReportcontainer">
                                <option value="">Search Container</option>
                                {{-- @foreach ($containers as $item)
                                <option value="{{$item->id}}">{{$item->unique_id}}</option>
                                @endforeach --}}
                            </select>
                        </div>

                        <div class="modal-footer p-0 pt-3">
                            <button type="submit" class="btn btn-primary change-color">Save changes</button>
                            <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Custom Tracking Report Pdf Modal -->
    <div class="modal custom-modal fade" id="trackingReportModal" tabindex="-1"
        aria-labelledby="trackingReportModalLabel" aria-hidden="true">
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
    <div class="modal custom-modal fade" id="deleteCustomReportModal" tabindex="-1" aria-labelledby="deleteConfirmLabel"
        aria-hidden="true">
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
    <div class="modal custom-modal fade" id="expensePopupModal" tabindex="-1" aria-labelledby="expensePopupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-size">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="expensePopupModalLabel">Edit Expense</h1>
                    <button type="button" class="btn-close fs_18" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="d-flex align-items-center justify-content-end">
                        <div class="usersearch d-flex">
                            <button class="btn btn-primary buttons px-2" data-bs-toggle="modal" data-bs-target="#addExpensesModal">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle-plus me-1 text-white"></i>
                                New Report
                            </div>
                        </button>
                        </div>
                    </div>

                    <div id='ajexTable'>
                        <div class="card-table">
                            <div class="card-body"></div>
                            <div class="table-responsive table-height mt-3">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light ">
                                        <tr>
                                            <th class="text-truncate text-start">Expense ID
                                            </th>
                                            <th class="text-truncate text-start">Date
                                            </th>
                                            <th class="text-truncate text-start">Category
                                            </th>
                                            <th class="text-truncate text-start">Note
                                            </th>
                                            <th class="text-truncate text-start">Amount
                                            </th>
                                            <th class="text-truncate text-center bg-transparent table-last-column">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>TEX-000001</td>
                                            <td>06-18-2025</td>
                                            <td>Category 1</td>
                                            <td>Dummy Content</td>
                                            <td>2800</td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>TEX-000002</td>
                                            <td>06-18-2025</td>
                                            <td>Category 2</td>
                                            <td>Dummy Content 3</td>
                                            <td>2100</td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>TEX-000003</td>
                                            <td>06-11-2025</td>
                                            <td>Category 3</td>
                                            <td>Dummy Content 3</td>
                                            <td>2100</td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>TEX-000004</td>
                                            <td>06-05-2025</td>
                                            <td>Category 4</td>
                                            <td>Dummy Content 4</td>
                                            <td>4800</td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Update</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a>
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
        </div>
    </div>


    <!--  Add Expense Modal -->
    <div class="modal custom-modal fade" id="addExpensesModal" tabindex="-1" aria-labelledby="addExpensesModalLabel"
        aria-hidden="true">
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

    @section('script')
    <script>
        $(document).ready(function() {
           $("#addReportBranch").on("change", function () {
                var warehouse_id = $(this).val();
                console.log('warehouse_id',warehouse_id);
                if (warehouse_id) {
                    getContainersByWarehouse(warehouse_id, '#addReportcontainer');
                }
            });
        });

        function getContainersByWarehouse(warehouseId,pushToSelect = false) {
            if (!warehouseId || !pushToSelect) {
                console.error("Warehouse ID or pushToSelect is not provided.");
                return;
            }
            $.ajax({
                url: "{{ route('getContainersByWarehouse') }}",
                type: "POST",
                data: {
                    warehouse_id: warehouseId
                },
                success: function(response) {
                    var containerSelect = $(pushToSelect);
                    containerSelect.empty();
                    containerSelect.append('<option value="">Search Container</option>');
                    $.each(response.containers, function(index, container) {
                        containerSelect.append('<option value="' + container.id + '">' + container.unique_id + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching containers:", error);
                }
            });
        }
    </script>
    @endsection

</x-app-layout>
