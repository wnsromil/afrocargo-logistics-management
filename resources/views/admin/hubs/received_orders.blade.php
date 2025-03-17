<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Received Orders</p>
        <div class="usersearch d-flex">
            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control forms" placeholder="Search ">

                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters"
                        href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a></button>
            </div>
        </div>
    </x-slot>


    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive table-body">
                    <table class="table table-stripped table-hover datatable table-body">
                        <thead class="thead-light">
                            <tr class="no-border">
                                <th>Sn no.</th>
                                <th>Tracking ID</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Transfer Date</th>
                                <th>Capture Image</th>
                                <th>Amount</th>
                                <th>Vehicle Number</th>
                                <th>No. of orders</th>
                                <th>Driver Name</th>
                                <th>Estimate Cost</th>
                                <th>Payment Status</th>
                                <th>Payment Mode</th>
                                <th>Item List</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-body">
                            <tr>
                                <td class="text-center">1</td>
                                <td>WE97078890</td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25.png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$350</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$100</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$450</span></div>
                                </td>
                                <td class="opacity-75">2E 5777</td>
                                <td class="opacity-75">55</td>
                                <td class="opacity-75">Jelene Largan</td>
                                <td class="text-center opacity-75">$25</td>
                                <td class="text-center"><span
                                        class="bg-danger-subtle text-danger px-2 py-1 rounded fw-medium">Unpaid</span>
                                </td>


                                <td class="fw-semibold opacity-50">Cash</td>
                                <td class="opacity-75">Books, Electronics...</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>

    <!-- ---------------------------- 2 --------------------------------------- -->

                            <tr>
                                <td class="text-center">2</td>
                                <td>WE97078891</td>
                                <td>
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td>
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td>12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25 (1).png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$200</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$50</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$250</span></div>
                                </td>
                                <td>5T 789</td>
                                <td>5T 789</td>
                                <td>Alysig Tremblett</td>
                                <td class="text-center">$22</td>
                                <td class="text-center"><span
                                        class="bg-warning-subtle text-warning px-3 px-2 py-1 rounded fw-medium">Partialy
                                        Paid</span>
                                </td>


                                <td class="fw-medium">Online/Card</td>
                                <td>Houshold set, Card...</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            <!-- -------------------------------- 3 -------------------------------------------------- -->

                            <tr>
                                <td class="text-center">3</td>
                                <td>WE97078895</td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25 (2).png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$350</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$100</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$450</span></div>
                                </td>
                                <td class="opacity-75">2E 5777</td>
                                <td class="opacity-75">55</td>
                                <td class="opacity-75">Norma McLarens</td>
                                <td class="text-center opacity-75">$12</td>
                                <td class="text-center"><span
                                        class="bg-success-subtle text-success px-3 px-2 py-1 rounded fw-medium">Paid</span>
                                </td>


                                <td class="fw-semibold opacity-50">Cheque</td>
                                <td class="opacity-75">Books</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            <!-- ------------------------------ 4 --------------------------------------------------- -->

                            <tr>
                                <td class="text-center">4</td>
                                <td>WE97078896</td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25.png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$200</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$50</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$250</span></div>
                                </td>
                                <td class="opacity-75">5T 789</td>
                                <td class="opacity-75">5T 789</td>
                                <td class="opacity-75">Berting Dominico</td>
                                <td class="text-center opacity-75">$35</td>
                                <td class="text-center"><span
                                        class="bg-warning-subtle text-warning px-3 px-2 py-1 rounded fw-medium">Partialy
                                        Paid</span>
                                </td>


                                <td class="fw-medium">Online/Card</td>
                                <td class="opacity-75">Houshold set, Card...</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            <!-- ------------------------- 5 ------------------------------------------ -->

                            <tr>
                                <td class="text-center">5</td>
                                <td>WE97078897</td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25 (1).png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$350</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$100</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$450</span></div>
                                </td>
                                <td class="opacity-75">2E 5777</td>
                                <td class="opacity-75">55</td>
                                <td class="opacity-75">Amalie Mclachian</td>
                                <td class="text-center opacity-75">$55</td>
                                <td class="text-center"><span
                                        class="bg-danger-subtle text-danger px-2 py-1 rounded fw-medium">Unpaid</span>
                                </td>


                                <td class="fw-semibold opacity-50">Cash</td>
                                <td class="opacity-75">Books</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            <!-- ---------------------- 6 ---------------------------------------------- -->

                            <tr>
                                <td class="text-center">6</td>
                                <td>WE97078898</td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25 (2).png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$200</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$50</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$250</span></div>
                                </td>
                                <td class="opacity-75">5T 789</td>
                                <td class="opacity-75">5T 789</td>
                                <td class="opacity-75">Peterus Simondson</td>
                                <td class="text-center opacity-75">$12</td>
                                <td class="text-center"><span
                                        class="bg-warning-subtle text-warning px-3 px-2 py-1 rounded fw-medium">Partialy
                                        Paid</span>
                                </td>


                                <td class="fw-medium">Online/Card</td>
                                <td class="opacity-75">Cards</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            <!-- ----------------------------- 7 ------------------------------------ -->

                            <tr>
                                <td class="text-center">7</td>
                                <td>WE97078899</td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25.png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$350</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$100</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$450</span></div>
                                </td>
                                <td class="opacity-75">2E 5777</td>
                                <td class="opacity-75">55</td>
                                <td class="opacity-75">Gar Delagnes</td>
                                <td class="text-center opacity-75">$8</td>
                                <td class="text-center"><span
                                        class="bg-success-subtle text-success px-3 px-2 py-1 rounded fw-medium">Paid</span>
                                </td>


                                <td class="fw-semibold opacity-50">Cheque</td>
                                <td class="opacity-75">Books</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            <!-- ------------------------------ 8 --------------------------------- -->

                            <tr>
                                <td class="text-center">8</td>
                                <td>WE97078900</td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25 (1).png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$200</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$50</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$250</span></div>
                                </td>
                                <td class="opacity-75">5T 789</td>
                                <td class="opacity-75">5T 789</td>
                                <td class="opacity-75">Bartlet Rayworth</td>
                                <td class="text-center opacity-75">$34</td>
                                <td class="text-center"><span
                                        class="bg-warning-subtle text-warning px-3 px-2 py-1 rounded fw-medium">Partialy
                                        Paid</span>
                                </td>


                                <td class="fw-medium">Cheque</td>
                                <td class="opacity-75">Houshold set, Card...</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            <!-- ------------------------------- 9 ------------------------------------- -->

                            <tr>
                                <td class="text-center">9</td>
                                <td>WE97078901</td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25 (2).png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$350</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$100</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$450</span></div>
                                </td>
                                <td class="opacity-75">2E 5777</td>
                                <td class="opacity-75">55</td>
                                <td class="opacity-75">Saxe Fegres</td>
                                <td class="text-center opacity-75">$21</td>
                                <td class="text-center"><span
                                        class="bg-danger-subtle text-danger px-2 py-1 rounded fw-medium">Unpaid</span>
                                </td>


                                <td class="fw-semibold opacity-50">Cash</td>
                                <td class="opacity-75">Electronics</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            <!-- ------------------------------------- 10 ---------------------------------------- -->
                            <tr>
                                <td class="text-center">10</td>
                                <td>WE97078904</td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Lokesh B S</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145995</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">
                                    <p><i class="fe fe-user pe-2"></i>Markham</p>
                                    <p><i class="fe fe-phone pe-2" data-bs-toggle="tooltip"
                                            title="fe fe-phone"></i>09513145991</p>
                                    <p><i class="fe fe-map-pin pe-2" data-bs-toggle="tooltip" title="fe fe-map-pin"></i>
                                        No 295, opp.shalini ground ,10th main, 39th C Cross Road, 5th Block...</p>
                                </td>
                                <td class="opacity-75">12-12-2024</td>
                                <td class="img-size">
                                    <img src="../assets/images/Rectangle 25.png" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$200</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$50</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$250</span></div>
                                </td>
                                <td class="opacity-75">5T 789</td>
                                <td class="opacity-75">5T 789</td>
                                <td class="opacity-75">Lock Gilbanks</td>
                                <td class="text-center opacity-75">$25</td>
                                <td class="text-center"><span
                                        class="bg-warning-subtle text-warning px-3 px-2 py-1 rounded fw-medium">Partialy
                                        Paid</span>
                                </td>


                                <td class="fw-medium">Online/Card</td>
                                <td class="opacity-75">Household</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><button type="button" class="btn btn-primary">
                                                <i class="fa fa-angle-down tooltipped fs-4" data-position="top"
                                                    data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>


                        <!-- ------------------------------------------------------------------------------- -->
                        <!-- <tbody>
                            @forelse ($parcels as $index => $parcel)
                            <tr>
                                <td><input type="checkbox" class="form-check-input selectCheckbox" value="{{ $parcel->id }}"></td>
                                <td>{{ ++$index }}</td>
                                <td>{{ ucfirst($parcel->tracking_id ?? '-') }}</td>
                                <td>{{ ucfirst($parcel->driver->name ?? '-') }}</td>
                                <td>{{ ucfirst($parcel->Vehicle->vehicle_type ?? '-') }} {{ $parcel->Vehicle->vehicle_number ?? '-' }}</td>
                                <td>{{ ucfirst($parcel->toWarehouse->warehouse_name ?? '-') }}</td>
                                <td>{{ ucfirst($parcel->fromWarehouse->warehouse_name ?? '-') }}</td>
                                <td><span>{{ $parcel->parcels_count ?? '-' }}</span></td>
                                <td><span class="badge-{{ activeStatusKey($parcel->status) }}">{{ $parcel->status ?? '-' }}</span></td>
                                <td><span>{{ \Carbon\Carbon::parse($parcel->tracking_start_at)->format('d/m/y') ?? '-' }}</span></td>
                                <td class="d-flex align-items-center">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.hubs.show', $parcel->id) }}"><i class="far fa-eye me-2"></i>View Parcels</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No data found.</td>
                            </tr>
                            @endforelse
                        </tbody> -->

                        <!-- ------------------------------------------------------------------------------- -->

                    </table>
                </div>

                <div class="bottom-user-page mt-3">
                    {!! $parcels->links('pagination::bootstrap-5') !!}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>