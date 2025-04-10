<x-app-layout>
    <x-slot name="header">
        {{ __('All Expenses') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">All Expenses</p>

        <div class="d-flex align-items-center justify-content-end mb-0">
            <div class="usersearch d-flex">
                <div class="">
                    <a href="{{ route('admin.expenses.create') }}" class="btn btn-primary buttons" style="background:#203A5F">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Expense
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <form>
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInput" class="form-control height40 form-cs" placeholder="Search">
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>By Warehouse</label>
                <select class="js-example-basic-single select2">
                    <option selected="selected" style="color:#737B8B">Select Warehouse</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info bordered">
                    <input type="text" name="daterangeOnly" class="btn-filters form-cs inp dateInput" placeholder="02-21-2024 - 02-21-2024" />
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>By Category</label>
                <select class="js-example-basic-single select2">
                    <option selected="selected" style="color:#737B8B">Select Category</option>
                </select>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary btnf me-2">Search</button>
                    <button class="btn btn-outline-danger btnr">Reset</button>
                </div>
            </div>
        </div>

        <div>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive smpadding mt-5">
                        <table class="table table-stripped table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>S. No.</th>
                                    <th>User</th>
                                    <th>Warehouse Name</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Peter Denk</td>
                                    <td>Star GST</td>
                                    <td>02-12-2024</td>
                                    <td>Category 1</td>
                                    <td>$ 100</td>
                                    <td><img src="../assets/images/userPlaceholderImg.png" alt="Image" /></td>
                                    <td>
                                        <div class="statusFor active">
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Max Cunnig</td>
                                    <td>Star GST</td>
                                    <td>03-12-2024</td>
                                    <td>Category 2</td>
                                    <td>$ 105</td>
                                    <td><img src="../assets/images/userPlaceholderImg.png" alt="Image" /></td>
                                    <td>
                                        <div class="statusFor inactive">
                                            <p>Inactive</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i class="far fa-eye me-2"></i>View</a>
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

</x-app-layout>
