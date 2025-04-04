<x-app-layout>
    <x-slot name="header">
        Container Details
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Container Details</p>

        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control forms" placeholder="Search ">

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


    <div class="card-table">
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-stripped table-hover datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="tabletext"><input type="checkbox"></th>
                            <th>S. No.</th>
                            <th>Tracking ID</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Pickup Date</th>
                            <th>Amount</th>
                            <th>Payment Mode</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ------------------- 1st ---------------------- -->
                        <tr>
                            <td class="tabletext"><input type="checkbox" checked></td>
                            <td class="text-center">1</td>
                            <td>WE97078893</td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Lokesh B S</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145995</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p class="ellipseText">No 295 opp.Xavier Church ground,10th main,39th C
                                                    Cross Road,5th Block California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Markham</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145991</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                                    California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>12-12-24</div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Parcial:<span class="opacity-75 fw-normal ps-1">$350</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Due:<span class="opacity-75 fw-normal ps-1">$100</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Total:<span class="opacity-75 fw-normal ps-1">$450</span></div>
                            </td>
                            <td class="fw-semibold">Cash</td>
                            <td class="text-center">
                                <label class="labelstatusc fw-medium px-2" for="transfer_status">
                                    Ready to Transfer
                                </label>
                            </td>
                            <!-- <td><label class="labelstatusc" for="transfer_status">Ready to Transfer</label></td> -->
                        </tr>
                        <!-- ------------------- 2nd ---------------------- -->
                        <tr>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="text-center">2</td>
                            <td>WE97078891</td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Lokesh B S</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145995</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p class="ellipseText">No 295 opp.Xavier Church ground,10th main,39th C
                                                    Cross Road,5th Block California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Markham</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145991</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                                    California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>12-12-24</div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Parcial:<span class="opacity-75 fw-normal ps-1">$200</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Due:<span class="opacity-75 fw-normal ps-1">$50</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Total:<span class="opacity-75 fw-normal ps-1">$250</span></div>
                            </td>
                            <td class="fw-semibold">Online/Card</td>
                            <td class="text-center">
                                <label class="labelstatusc fw-medium px-2" for="transfer_status">
                                    Ready to Transfer
                                </label>
                            </td>
                            <!-- <td><label class="labelstatusc" for="transfer_status">Ready to Transfer</label></td> -->
                        </tr>
                        <!-- ------------------- 3rd ---------------------- -->
                        <tr>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="text-center">3</td>
                            <td>WE97078895</td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Lokesh B S</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145995</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p class="ellipseText">No 295 opp.Xavier Church ground,10th main,39th C
                                                    Cross Road,5th Block California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Markham</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145991</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                                    California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>12-12-24</div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Parcial:<span class="opacity-75 fw-normal ps-1">$350</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Due:<span class="opacity-75 fw-normal ps-1">$100</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Total:<span class="opacity-75 fw-normal ps-1">$450</span></div>
                            </td>
                            <td class="fw-semibold">Cheque</td>
                            <td class="text-center">
                                <label class="labelstatusc fw-medium px-2" for="transfer_status">
                                    Ready to Transfer
                                </label>
                            </td>
                            <!-- <td><label class="labelstatusc" for="transfer_status">Ready to Transfer</label></td> -->
                        </tr>

                        <!-- ------------------- 4th ---------------------- -->

                        <tr>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="text-center">4</td>
                            <td>WE97078896</td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Lokesh B S</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145995</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p class="ellipseText">No 295 opp.Xavier Church ground,10th main,39th C
                                                    Cross Road,5th Block California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Markham</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145991</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                                    California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>12-12-24</div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Parcial:<span class="opacity-75 fw-normal ps-1">$200</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Due:<span class="opacity-75  fw-normal ps-1">$50</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Total:<span class="opacity-75 fw-normal ps-1">$250</span></div>
                            </td>
                            <td class="fw-semibold">Online/Card</td>
                            <td class="text-center">
                                <label class="labelstatusc fw-medium px-2" for="transfer_status">
                                    Ready to Transfer
                                </label>
                            </td>
                            <!-- <td><label class="labelstatusc" for="transfer_status">Ready to Transfer</label></td> -->
                        </tr>
                        <!-- ------------------- 5th ---------------------- -->

                        <tr>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="text-center">5</td>
                            <td>WE97078897</td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Lokesh B S</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145995</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p class="ellipseText">No 295 opp.Xavier Church ground,10th main,39th C
                                                    Cross Road,5th Block California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Markham</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145991</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                                    California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>12-12-24</div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Parcial:<span class="opacity-75 fw-normal ps-1">$350</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Due:<span class="opacity-75 fw-normal ps-1">$100</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Total:<span class="opacity-75 fw-normal ps-1">$450</span></div>
                            </td>
                            <td class="fw-semibold">Cash</td>
                            <td class="text-center">
                                <label class="labelstatusc fw-medium px-2" for="transfer_status">
                                    Ready to Transfer
                                </label>
                            </td>
                            <!-- <td><label class="labelstatusc" for="transfer_status">Ready to Transfer</label></td> -->
                        </tr>
                        <!-- ------------------- 6th ---------------------- -->

                        <tr>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="text-center">6</td>
                            <td>WE97078898</td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Lokesh B S</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145995</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p class="ellipseText">No 295 opp.Xavier Church ground,10th main,39th C
                                                    Cross Road,5th Block California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-user"></i>Markham</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-phone"></i>09513145991</div>
                                        </div>
                                        <div class="row">
                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                                    California</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>12-12-24</div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Parcial:<span class="opacity-75 fw-normal ps-1">$200</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Due:<span class="opacity-75 fw-normal ps-1">$50</span></div>
                                <div class="d-flex justify-content-between text-dark fw-semibold td-color">
                                    Total:<span class="opacity-75 fw-normal ps-1">$250</span></div>
                            </td>
                            <td class="fw-semibold">Online/Card</td>
                            <td class="text-center">
                                <label class="labelstatusc fw-medium px-2" for="transfer_status">
                                    Ready to Transfer
                                </label>
                            </td>
                            <!-- <td><label class="labelstatusc" for="transfer_status">Ready to Transfer</label></td> -->
                        </tr>

                    </tbody>
                </table>


                <script>
                    function deleteData(self, msg) {
                        Swal.fire({
                            title: msg,
                            showCancelButton: true,
                            confirmButtonText: "Delete",
                            cancelButtonText: "Cancel"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(self).closest('form').submit();
                            }
                        });
                    }
                </script>
</x-app-layout>