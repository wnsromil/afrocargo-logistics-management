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

    <div class="container-fluid text-dark responsiveness">
        <div class="rounded-2 p-2 mt-4">
            <div class="row rounded-2 bg-custom">
                <div class="col-md-3 col-sm-6 col-lg-3 align-items-center mt-1">

                    <label for="search_id" class="col-form-label">Search</label>

                    <input type="text" id="search_id" class="form-control rounded-1 form-control-lg"
                        placeholder="Search">

                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 align-items-center mt-1">
                    <div class="col-md-12 col-sm-6 col-lg-12">
                        <label for="report_id" class="col-form-label">Report Type</label>
                    </div>
                    <div class="col-md-12 col-sm-6 col-lg-12 noBorder">
                        <select class="form-select select2 select-tag-width text-truncate text-dark">
                            <option selected>Report Type</option>
                            <option value="1">Invoice</option>
                            <option value="2">Tracking</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 align-items-center mt-1">
                    <div class="col-md-12 col-sm-6 col-lg-12">
                        <label for="branch_id" class="col-form-label">Branch</label>
                    </div>
                    <div class="col-md-12 col-sm-6 col-lg-12 noBorder">
                        <select class="form-select select2">
                            <option selected>Select Branch</option>
                            <option value="1">Afro Cargo OH USA</option>
                            <option value="2">Afro Cargo GA USA</option>
                            <option value="3">Afro Cargo Abidjan</option>
                            <option value="4">Afro Cargo Bamako</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 align-items-center mt-1">
                    <div class="col-md-12 col-sm-6 col-lg-12">
                        <label for="user_id" class="col-form-label">User</label>
                    </div>
                    <div class="col-md-12 col-sm-6 col-lg-12 noBorder">
                        <select class="form-select select2 text-dark">
                            <option value="1" selected>Abijan Cargo</option>
                            <option value="2">Bakary Siby</option>
                            <option value="3">Fode Sacko</option>
                            <option value="4">Taher Samssa</option>
                            <option value="5">Abdou Sacko</option>
                            <option value="6">Amara Wague</option>
                            <option value="7">Abou Sacko</option>
                            <option value="8">Harouna Diabira</option>
                            <option value="9">Dra Sacko</option>
                            <option value="10">Bouba Fofana</option>
                            <option value="11">Ouamr Marega</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row rounded-2 bg-custom">
                <div class="col-md-3 col-sm-6 col-lg-3 align-items-center mt-2">
                    <div class="col-md-12 col-sm-6 col-lg-12">
                        <label for="container_id" class="col-form-label">Container</label>
                    </div>
                    <div class="col-md-12 col-sm-6 col-lg-12 noBorder">
                        <select class="form-select select2 text-dark">
                            <option value="17" selected>001-02325</option>
                            <option value="1">001-02225</option>
                            <option value="2">001-SUDU8880982</option>
                            <option value="3">001-01425</option>
                            <option value="4">001-GCNU488437</option>
                            <option value="5">001-1225GCNU4784</option>
                            <option value="6">001-01125Abj</option>
                            <option value="7">001-01025Abj</option>
                            <option value="8">001-0925Abj</option>
                            <option value="9">001-0825Abj</option>
                            <option value="10">001-0725Abj</option>
                            <option value="11">001-FFAU5415337</option>
                            <option value="12">001-0525Abj</option>
                            <option value="13">001-0425Abj</option>
                            <option value="14">001-0325Abj</option>
                            <option value="15">001-0225Abj</option>
                            <option value="16">001-0125</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 align-items-center mt-2">
                    <label for="date_id" class="col-form-label">Date</label>
                    <input type="date" id="date_id" class="form-control rounded-1 form-control-lg">
                </div>
            </div>

            <div class="row">
                <div class="d-flex align-items-center justify-content-end mt-2">
                    <button class="btn btn-primary" type="button">Search</button>
                    <button class="btn btn-outline-danger ms-1" type="button">Reset</button>

                </div>
            </div>
        </div>
        <div class="row">
            <div id='ajexTable'>
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive table-height mt-3">
                            <table class="table table-hover datatable">
                                <thead class="thead-light text-start">
                                    <tr>
                                        <th class="p-2">Invoice Date</th>
                                        <th class="p-2">Invoice</th>
                                        <th class="p-2">Container</th>
                                        <th class="p-2">Driver</th>
                                        <th class="p-2">Customer</th>
                                        <th class="p-2">CustLIcId</th>
                                        <th class="p-2">CustLicPic</th>
                                        <th class="p-2">ShipTo</th>
                                        <th class="p-2">ShipToLicId</th>
                                        <th class="p-2">ShipToLicPic</th>
                                        <th class="p-2 bg-transparent table-last-column">
                                            Amount
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td colspan="11" class="text-center">No Rows To Show</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>