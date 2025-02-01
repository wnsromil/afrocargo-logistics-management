<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="row">
                            <!-- First Row (4 Columns) -->
                            <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                <div class="card dashbox inovices-card w-100">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <div class="dash-count">
                                                <div class="dash-title">Today’s Packages</div>
                                                <div class="dash-counts">
                                                    <p>254</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                <div class="card dashbox inovices-card w-100">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <div class="dash-count">
                                                <div class="dash-title">Total Packages</div>
                                                <div class="dash-counts">
                                                    <p>354</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                <div class="card dashbox inovices-card w-100">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <div class="dash-count">
                                                <div class="dash-title">Ready for Shipping</div>
                                                <div class="dash-counts">
                                                    <p>236</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                <div class="card dashbox inovices-card w-100">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <div class="dash-count">
                                                <div class="dash-title">In Transit</div>
                                                <div class="dash-counts">
                                                    <p>216</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <!-- Second Row (4 Columns) -->
                
                
                            <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                <div class="card dashbox inovices-card w-100">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <div class="dash-count">
                                                <div class="dash-title">Delivered</div>
                                                <div class="dash-counts">
                                                    <p>189</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                <div class="card dashbox inovices-card w-100">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <div class="dash-count">
                                                <div class="dash-title">Total Customers</div>
                                                <div class="dash-counts">
                                                    <p>12</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                <div class="card dashbox inovices-card w-100">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <div class="dash-count">
                                                <div class="dash-title">Total Orders</div>
                                                <div class="dash-counts">
                                                    <p>220</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                <div class="card dashbox inovices-card w-100">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <div class="dash-count">
                                                <div class="dash-title">New Orders</div>
                                                <div class="dash-counts">
                                                    <p>120</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="dash-title">
                                <h4 class="order-title">Latest Orders</h4>
                            </div>
                            <div class="card-table">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-stripped table-hover datatable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>
                                                        Order ID
                                                    </th>
                
                                                    <th>Date</th>
                                                    <th>Product</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                
                
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                
                                            </tbody>
                
                                        </table>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagi-dash">
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">1</a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">2</a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>

