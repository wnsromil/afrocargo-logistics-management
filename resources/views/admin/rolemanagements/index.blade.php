<x-app-layout>
    <x-slot name="header">
        Role Management
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex justify-content-between col-md-12">
            <!-- <div class="th-font fw-medium">All Role</div> -->
            <p class="head">All Role</p>
            <div class="mt-2">
                <a href="{{ route('admin.inventories.create') }}" class="btn btn-primary buttons"
                    style="background:#203A5F">
                    <i class="ti ti-circle-plus me-2 text-white"></i>
                    Add Role
                </a>
            </div>
        </div>

    </x-slot>

    <!-- <div class="row d-flex">
        <div class="col">Search By Permission</div>
        <div class="col-md-6">
        <select class="form-select" aria-label="Default select example">
            <option selected>Search Permission</option>
            <option value="1">Select Option</option>
        </select>
        </div>
    </div> -->
    <div class="col-md-6 d-flex">
        <div class="col-auto">
            <label class="col-form-label profileUpdateFont text-dark fw-medium pe-2">Search By Permission</label>
        </div>
        <select class="form-select" aria-label="Default select example">
            <option selected>Search Permission</option>
            <option value="1">Select Option</option>
        </select>
    </div>

    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
                                <th>Role Name</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="opacity-50">1</span></td>
                                <td><span class="opacity-50">Driver</span></td>
                                <td><span class="opacity-50">02-15-2025</span></td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                                data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item"><i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="permission-font">2</span></td>
                                <td><span class="permission-font">Wareouse Manager</span></td>
                                <td><span class="permission-font">02-15-2025</span></td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                                data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item"><i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
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


    <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">

        <div class="col-md-6 d-flex p-2 align-items-center">
            <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
            <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example">
                <option selected>10</option>
                <option value="1">5</option>
                <option value="2">10</option>
                <option value="3">15</option>
            </select>
            <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
        </div>

        <!-- <div class="dataTables_length" id="DataTables_Table_0_length">
    <label>
        <select name="DataTables_Table_0_length input-box" aria-controls="DataTables_Table_0"
            class="custom-select custom-select-sm form-control-sm">
            <option value="5">10</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
        </select>
    </label>
</div> -->

        <div class="col-md-6">
            <div class="float-end">
                <button class="btn button-border">
                    <i class="fa fa-angle-left tooltipped" data-position="top" data-tooltip="fa fa-angle-left"></i>
                </button>
                <button class="btn paginate_button page-item button-border active" type="button"
                    data-bs-toggle="button">1</button>
                <button class="btn button-border">2</button>
                <button class="btn button-border" type="button">3</button>
                <button class="btn button-border" type="button">4</button>
                <button class="btn button-border" type="button">5</button>


                <button class="btn button-border">
                    <i class="fa fa-angle-right tooltipped" data-position="top" data-tooltip="fa fa-angle-right"></i>
                </button>
            </div>
        </div>
    </div>


</x-app-layout>