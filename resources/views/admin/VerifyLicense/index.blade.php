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
        <div class="thead-light rounded-2 p-2 mt-4">
            <div class="row rounded-2 bg-custom">
                <div class="col-md-3 col-sm-6 col-lg-3 d-flex justify-content-between align-items-center mt-1">
                    <div class="col-md-3 col-sm-6 col-lg-3">
                        <label for="search_id" class="col-form-label">Search</label>
                    </div>
                    <div class="col-md-8 col-sm-6 col-lg-8">
                        <input type="text" id="search_id" class="form-control rounded-1 form-control-lg"
                            placeholder="Search">
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 d-flex justify-content-between align-items-center mt-1">
                    <div class="col-md-3 col-sm-6 col-lg-3">
                        <label for="report_id" class="col-form-label">Report Type</label>
                    </div>
                    <div class="col-md-8 col-sm-6 col-lg-8">
                        <select class="form-select select2 select-tag-width text-truncate text-dark">
                            <option selected>Report Type</option>
                            <option value="1">Invoice</option>
                            <option value="2">Tracking</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 d-flex justify-content-between align-items-center mt-1">
                    <div class="col-md-3 col-sm-6 col-lg-3">
                        <label for="branch_id" class="col-form-label">Branch</label>
                    </div>
                    <div class="col-md-8 col-sm-6 col-lg-8">
                        <select class="form-select select2">
                            <option selected>Select Branch</option>
                            <option value="1">Afro Cargo OH USA</option>
                            <option value="2">Afro Cargo GA USA</option>
                            <option value="3">Afro Cargo Abidjan</option>
                            <option value="4">Afro Cargo Bamako</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3 d-flex justify-content-between align-items-center mt-1">
                    <div class="col-md-3 col-sm-6 col-lg-3">
                        <label for="user_id" class="col-form-label">User</label>
                    </div>
                    <div class="col-md-9 col-sm-6 col-lg-9">
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

                <div class="col-md-3 col-sm-6 col-lg-3 d-flex justify-content-between align-items-center mt-2">
                    <div class="col-md-3 col-sm-6 col-lg-3">
                        <label for="container_id" class="col-form-label">Container</label>
                    </div>
                    <div class="col-md-8 col-sm-6 col-lg-8">
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

                <div class="col-md-3 col-sm-6 col-lg-3 d-flex justify-content-between align-items-center mt-2">
                    <div class="col-md-3 col-sm-6 col-lg-3">
                        <label for="date_id" class="col-form-label">Date</label>
                    </div>
                    <div class="col-md-8 col-sm-6 col-lg-8">
                        <input type="date" id="date_id" class="form-control rounded-1 form-control-lg">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-flex align-items-center justify-content-end mb-1">
                    <div class="d-grid gap-2 d-md-block justify-content-end">
                        <button class="btn btn-danger" type="button">Search</button>
                        <button class="btn btn-tomato ms-12" type="button">Clear</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id='ajexTable'>
                <div class="card-table">
                    <div class="">
                        <div class="table-responsive table-height border border-dark mt-3">

                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light border-bottom border-dark text-start">
                                    <tr>
                                        <th class="fs_14 fw-semibold ">Invoice Date</th>
                                        <th class="fs_14 fw-semibold ">Invoice</th>
                                        <th class="fs_14 fw-semibold ">Container</th>
                                        <th class="fs_14 fw-semibold ">Driver</th>
                                        <th class="fs_14 fw-semibold ">Customer</th>
                                        <th class="fs_14 fw-semibold ">CustLIcId</th>
                                        <th class="fs_14 fw-semibold ">CustLicPic</th>
                                        <th class="fs_14 fw-semibold ">ShipTo</th>
                                        <th class="fs_14 fw-semibold ">ShipToLicId</th>
                                        <th class="fs_14 fw-semibold ">ShipToLicPic</th>
                                        <th class="fs_14 fw-semibold bg-transparent table-last-column">
                                            Amount
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <!-- <tr class="font12 border-bottom border-dark">
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                        <td class="text-dark"></td>
                                    </tr> -->


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