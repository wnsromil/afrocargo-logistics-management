<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <!-- <x-slot name="cardTitle">
        All Parcels
        
        {{-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <p style="text-align: center;">
                        <span class="isSelected d-none">     
                            <button class="btn btn-primary" onclick="handlePickupAssign('selectArr', {{ json_encode($drivers) }},'{{ activeStatusKey('Pickup Assign')}}')">
                                <i class="fas fa-truck me-2"></i>Pickup Assign
                            </button>
                            <button class="btn btn-danger" onclick="handlePickupCancel([],,{{ activeStatusKey('Pickup Cancel') }})">
                                <i class="fas fa-times-circle me-2"></i>Pickup Cancel
                            </button>
                            
                            <button class="btn btn-warning" onclick="handlePickupReschedule([], {{ json_encode($drivers) }},{{ activeStatusKey('Pickup Cancel') }})">
                                <i class="fas fa-calendar-alt me-2"></i>Pickup Re-Schedule
                            </button>
                            <button class="btn btn-info" onclick="handleReceivedWarehouse([], {{json_encode($warehouses)}},{{ activeStatusKey('Pickup Cancel') }})">
                                <i class="fas fa-warehouse me-2"></i>Received Warehouse
                            </button>
                        </span>
                        <a href="{{route('admin.OrderShipment.create')}}" class="btn btn-primary">
                            Add Parcel
                        </a>
                    </p>
                </div>
            </div>

        </div> --}}

    </x-slot> -->

    <x-slot name="cardTitle">
        <p class="head">Supply Order Management</p>

        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control forms" placeholder="Search">

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
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable datatable">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                <th>Sn no.</th>
                                <th>Tracking ID</th>
                                <th>From</th>
                                <th>Warehouse Name</th>
                                <th>Order Date</th>
                                <th>Supply Image</th>
                                <th>Supply Details</th>
                                <th>Quantity</th>
                                <th>Estimate cost</th>
                                <th>Driver Name</th>
                                <th>Vehicle Type</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Status</th>
                                <th>Status update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block California</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                </td>
                                <td>Location ABC</td>
                                <td>12-12-24</td>
                                <td>
                                    <div><img src="{{asset('assets/img/img1.png')}}" alt="image"></div>
                                </td>
                                </td>
                                <td>Boxes</td>
                                <td>4</td>
                                <td>$40</td>
                                <td>-</td>
                                <td>-</td>
                                <td><label class="labelstatus" for="unpaid_status">unpaid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row amountfont">Partial:</div>
                                            <div class="row amountfont">Due:</div>
                                            <div class="row amountfont">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$350</div>
                                            <div class="row">$100</div>
                                            <div class="row">$450</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Cash</td>
                                <td><label class="labelstatus" for="status">Pending</label></td>
                                <td>
                                    <li class="nav-item dropdown">
                                        <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                            data-bs-toggle="dropdown">

                                            <span class="user-content" style="background-color:#203A5F;border-radius:5px;width: 30px;
                                               height: 26px;align-content: center;">
                                                <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                                            </span>
                                        </a>
                                        <div class="dropdown-menu menu-drop-user">
                                            <div class="profilemenu">
                                                <div class="subscription-menu">
                                                    <ul>

                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deliveryman_modal">Assign delivery
                                                                Boy</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                </div>
                </td>
                <td class="btntext">
                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                            src="{{asset('assets/img/ordereye.png')}}"></button>
                </td>
                </tr>

                <!-- second line started -->
                <tr>
                    <td>2</td>
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
                                        <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                            California</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>Location CSA</td>
                    <td>12-12-24</td>
                    <td>
                        <div><img src="{{asset('assets/img/img2.png')}}" alt="image"></div>
                    </td>
                    </td>
                    <td>Barrels</td>
                    <td>3</td>
                    <td>$150</td>
                    <td>Alysig Tremblett</td>
                    <td>Van</td>
                    <td><label class="labelstatusy" for="partial_status">Partialy Paid</label></td>
                    <td>
                        <div class="row">
                            <div class="col-6">
                                <div class="row amountfont">Partial:</div>
                                <div class="row amountfont">Due:</div>
                                <div class="row amountfont">Total:</div>
                            </div>
                            <div class="col-6">
                                <div class="row">$200</div>
                                <div class="row">$50</div>
                                <div class="row">$250</div>
                            </div>
                        </div>
                    </td>
                    <td>Online/Card</td>
                    <td><label class="labelstatuspi" for="status">Assign Delivery Boy</label></td>
                    <td>

                    </td>
                    <td class="btntext">
                        <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                                src="{{asset('assets/img/ordereye.png')}}"></button>
                    </td>
                </tr>

                <!-- third line started -->

                <tr>
                    <td>3</td>
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
                                        <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                            California</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>Location QWQ</td>
                    <td>12-12-24</td>
                    <td>
                        <div><img src="{{asset('assets/img/img3.png')}}" alt="image"></div>
                    </td>
                    </td>
                    <td>Brown tap</td>
                    <td>2</td>
                    <td>$40</td>
                    <td>Amalie McLachlan</td>
                    <td>Two Wheeler</td>
                    <td><label class="labelstatusw" for="partial_status"> Paid</label></td>
                    <td>
                        <div class="row">
                            <div class="col-6">
                                <div class="row amountfont">Partial:</div>
                                <div class="row amountfont">Due:</div>
                                <div class="row amountfont">Total:</div>
                            </div>
                            <div class="col-6">
                                <div class="row ">$350</div>
                                <div class="row ">$100</div>
                                <div class="row ">$450</div>
                            </div>
                        </div>
                    </td>
                    <td>Cheque</td>
                    <td><label class="labelstatuspi" for="status">Assign Delivery Boy</label></td>
                    <td>

                    </td>
                    <td class="btntext">
                        <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                                src="{{asset('assets/img/ordereye.png')}}"></button>
                    </td>
                </tr>


                <!-- fourth line started -->
                <tr>
                    <td>4</td>
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
                                        <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                            California</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>Location TTT</td>
                    <td>12-12-24</td>
                    <td>
                        <div><img src="{{asset('assets/img/img4.png')}}" alt="image"></div>
                    </td>
                    </td>
                    <td>Clear Tap</td>
                    <td>5</td>
                    <td>$125</td>
                    <td>Berting Dominico</td>
                    <td>Two Wheeler</td>
                    <td><label class="labelstatusy" for="partial_status">Partialy Paid</label></td>
                    <td>
                        <div class="row">
                            <div class="col-6">
                                <div class="row amountfont">Partial:</div>
                                <div class="row amountfont">Due:</div>
                                <div class="row amountfont">Total:</div>
                            </div>
                            <div class="col-6">
                                <div class="row ">$200</div>
                                <div class="row ">$50</div>
                                <div class="row ">$250</div>
                            </div>
                        </div>
                    </td>
                    <td>Online/Card</td>
                    <td><label class="labelstatuspi" for="status">Assign Delivery Boy</label></td>
                    <td>

                    </td>
                    <td class="btntext">
                        <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                                src="{{asset('assets/img/ordereye.png')}}"></button>
                    </td>
                </tr>

                <!-- fifth line started -->


                <tr>
                    <td>5</td>
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
                                        <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block
                                            California</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>Location GGG </td>
                    <td>12-12-24</td>
                    <td>
                        <div><img src="{{asset('assets/img/img5.png')}}" alt="image"></div>
                    </td>
                    </td>
                    <td>Shrink Wrap</td>
                    <td>20</td>
                    <td>$600</td>
                    <td>-</td>
                    <td>-</td>
                    <td><label class="labelstatus" for="unpaid_status">unpaid</label></td>
                    <td>
                        <div class="row">
                            <div class="col-6">
                                <div class="row amountfont">Partial:</div>
                                <div class="row amountfont">Due:</div>
                                <div class="row amountfont">Total:</div>
                            </div>
                            <div class="col-6">
                                <div class="row ">$350</div>
                                <div class="row">$100</div>
                                <div class="row">$450</div>
                            </div>
                        </div>
                    </td>
                    <td>Cash</td>
                    <td><label class="labelstatus" for="status">Pending</label></td>
                    <td>
                        <li class="nav-item dropdown">
                            <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                data-bs-toggle="dropdown">

                                <span class="user-content" style="background-color:#203A5F;border-radius:5px;width: 30px;
    height: 26px;align-content: center;">
                                    <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                                </span>
                            </a>
                            <div class="dropdown-menu menu-drop-user">
                                <div class="profilemenu">
                                    <div class="subscription-menu">
                                        <ul>

                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#deliveryman_modal">Assign
                                                    delivery Boy</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </li>
            </div>
            </td>
            <td class="btntext">
                <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                        src="{{asset('assets/img/ordereye.png')}}"></button>
            </td>
            </tr>


            <!-- sixth line -->



            <tr>
                <td>6</td>
                <td>WE97078899</td>
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
                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block California
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>Location DDD</td>
                <td>12-12-24</td>
                <td>
                    <div><img src="{{('assets/img/img1.png')}}" alt="image"></div>
                </td>
                </td>
                <td>Boxes</td>
                <td>2</td>
                <td>$40</td>
                <td>-</td>
                <td>-</td>
                <td><label class="labelstatusy" for="partial_status">Partialy Paid</label></td>
                <td>
                    <div class="row">
                        <div class="col-6">
                            <div class="row amountfont">Partial:</div>
                            <div class="row amountfont">Due:</div>
                            <div class="row amountfont">Total:</div>
                        </div>
                        <div class="col-6">
                            <div class="row">$200</div>
                            <div class="row">$50</div>
                            <div class="row">$250</div>
                        </div>
                    </div>
                </td>
                <td>Online/Card</td>
                <td><label class="labelstatus" for="status">Pending</label></td>
                <td>
                    <li class="nav-item dropdown">
                        <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                            data-bs-toggle="dropdown">

                            <span class="user-content" style="background-color:#203A5F;border-radius:5px;width: 30px;
    height: 26px;align-content: center;">
                                <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                            </span>
                        </a>
                        <div class="dropdown-menu menu-drop-user">
                            <div class="profilemenu">
                                <div class="subscription-menu">
                                    <ul>

                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#deliveryman_modal">Assign delivery Boy</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </li>
        </div>
        </td>
        <td class="btntext">
            <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                    src="{{asset('assets/img/ordereye.png')}}"></button>
        </td>
        </tr>



        <!-- seven line  -->


        <tr>
            <td>7</td>
            <td>WE97078900</td>
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
                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block California</p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>Location SSSS</td>
            <td>12-12-24</td>
            <td>
                <div><img src="{{asset('assets/img/img2.png')}}" alt="image"></div>
            </td>
            </td>
            <td>Barrels</td>
            <td>1</td>
            <td>$50</td>
            <td>Gar Delagnes</td>
            <td>Van</td>
            <td><label class="labelstatusw" for="partial_status"> Paid</label></td>
            <td>
                <div class="row">
                    <div class="col-6">
                        <div class="row amountfont">Partial:</div>
                        <div class="row amountfont">Due:</div>
                        <div class="row amountfont">Total:</div>
                    </div>
                    <div class="col-6">
                        <div class="row">$350</div>
                        <div class="row">$100</div>
                        <div class="row">$450</div>
                    </div>
                </div>
            </td>
            <td>Cheque</td>
            <td><label class="labelstatuspi" for="status">Assign Delivery Boy</label></td>
            <td>

            </td>
            <td class="btntext">
                <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                        src="{{asset('assets/img/ordereye.png')}}"></button>
            </td>
        </tr>

        <!-- eight line started -->



        <tr>
            <td>8</td>
            <td>WE97078901</td>
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
                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block California</p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>Location FDFDF</td>
            <td>12-12-24</td>
            <td>
                <div><img src="{{asset('assets/img/img3.png')}}" alt="image"></div>
            </td>
            </td>
            <td>Brown tap</td>
            <td>5</td>
            <td>$100</td>
            <td>-</td>
            <td>-</td>
            <td><label class="labelstatusy" for="partial_status">Partialy Paid</label></td>
            <td>
                <div class="row">
                    <div class="col-6">
                        <div class="row amountfont">Partial:</div>
                        <div class="row amountfont">Due:</div>
                        <div class="row amountfont">Total:</div>
                    </div>
                    <div class="col-6">
                        <div class="row">$200</div>
                        <div class="row">$50</div>
                        <div class="row">$250</div>
                    </div>
                </div>
            </td>
            <td>Cheque</td>
            <td><label class="labelstatus" for="status">Pending</label></td>
            <td>
                <li class="nav-item dropdown">
                    <a class="amargin" href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">

                        <span class="user-content" style="background-color:#203A5F;border-radius:5px;width: 30px;
    height: 26px;align-content: center;">
                            <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                        </span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilemenu">
                            <div class="subscription-menu">
                                <ul>

                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#deliveryman_modal">Assign delivery Boy</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </li>
    </div>
    </td>
    <td class="btntext">
        <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                src="{{asset('assets/img/ordereye.png')}}"></button>
    </td>
    </tr>
    <!-- nine line started -->


    <tr>
        <td>9</td>
        <td>WE97078894</td>
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
                            <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block California</p>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td>Location DBGD</td>
        <td>12-12-24</td>
        <td>
            <div><img src="{{asset('assets/img/img4.png')}}" alt="image"></div>
        </td>
        </td>
        <td>Clear Tap</td>
        <td>10</td>
        <td>$250</td>
        <td>-</td>
        <td>-</td>
        <td><label class="labelstatus" for="unpaid_status">unpaid</label></td>
        <td>
            <div class="row">
                <div class="col-6">
                    <div class="row amountfont">Partial:</div>
                    <div class="row amountfont">Due:</div>
                    <div class="row amountfont">Total:</div>
                </div>
                <div class="col-6">
                    <div class="row">$350</div>
                    <div class="row">$100</div>
                    <div class="row">$450</div>
                </div>
            </div>
        </td>
        <td>Cash</td>
        <td><label class="labelstatus" for="status">Pending</label></td>
        <td>
            <li class="nav-item dropdown">
                <a class="amargin" href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">

                    <span class="user-content" style="background-color:#203A5F;border-radius:5px;width: 30px;
    height: 26px;align-content: center;">
                        <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilemenu">
                        <div class="subscription-menu">
                            <ul>

                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#deliveryman_modal">Assign delivery Boy</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </li>
            </div>
        </td>
        <td class="btntext">
            <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                    src="{{asset('assets/img/ordereye.png')}}"></button>
        </td>
    </tr>

    <!-- ten line started -->


    <tr>
        <td>10</td>
        <td>WE97078901</td>
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
                            <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block California</p>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td>Location WWW</td>
        <td>12-12-24</td>
        <td>
            <div><img src="{{asset('assets/img/img5.png')}}" alt="image"></div>
        </td>
        </td>
        <td>Shrink Wrap</td>
        <td>10</td>
        <td>$300</td>
        <td>-</td>
        <td>-</td>
        <td><label class="labelstatusy" for="partial_status">Partialy Paid</label></td>
        <td>
            <div class="row">
                <div class="col-6">
                    <div class="row amountfont">Partial:</div>
                    <div class="row amountfont">Due:</div>
                    <div class="row amountfont">Total:</div>
                </div>
                <div class="col-6">
                    <div class="row">$200</div>
                    <div class="row">$50</div>
                    <div class="row">$250</div>
                </div>
            </div>
        </td>
        <td>Online/Card</td>
        <td><label class="labelstatus" for="status">Pending</label></td>
        <td>
            <li class="nav-item dropdown">
                <a class="amargin" href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">

                    <span class="user-content" style="background-color:#203A5F;border-radius:5px;width: 30px;
    height: 26px;align-content: center;">
                        <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilemenu">
                        <div class="subscription-menu">
                            <ul>

                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#deliveryman_modal">Assign delivery Boy</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </li>
            </div>
        </td>
        <td class="btntext">
            <button onClick="redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img
                    src="{{asset('assets/img/ordereye.png')}}"></button>
        </td>
    </tr>
    <!-- @forelse ($parcels as $index => $parcel)
                                <tr>
                                    {{-- <td><input type="checkbox" class="form-check-input selectCheckbox checkbox-{{ activeStatusKey($parcel->status) }}" value="{{ $parcel->id }}"></td> --}}
                                    <td>{{ ++$index }}</td>
                                    <td>
                                        {{ ucfirst($parcel->tracking_number ?? '-') }}
                                    </td>
                                    <td>
                                        <div>
                                            <p>
                                                <i class="fe fe-user"></i>{{ ucfirst($parcel->customer->name ?? '-') }}
                                            </p>
                                            <p>
                                                <i class="fe fe-phone"></i>{{ $parcel->customer->phone ?? '-' }}
                                            </p>
                                            <p>
                                                <i class="fe fe-map-pin"></i>{{ $parcel->customer->address ?? '-' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p>
                                                <i class="fe fe-user"></i>{{ ucfirst($parcel->destination_user_name ?? '-') }}
                                            </p>
                                            <p>
                                                <i class="fe fe-phone"></i>{{ $parcel->destination_user_phone ?? '-' }}
                                            </p>
                                            <p>
                                                <i class="fe fe-map-pin"></i>{{ $parcel->destination_address ?? '-' }}
                                            </p>
                                        </div>
                                    </td>
                                    {{-- <td>{{ ucfirst($parcel->warehouse->warehouse_name ?? '-') }}</td> --}}
                                    {{-- <td><span>{{ $parcel->weight ?? '-' }}</span></td> --}}
                                    <td>
                                        <div>
                                            <p>
                                                <span class="fw-bold">Partial:</span>
                                                <span>${{ $parcel->partial_payment ?? '-' }}</span>
                                            </p>
                                            <p>
                                                <span class="fw-bold">Due:</span>
                                                <span>${{ $parcel->remaining_payment ?? '-' }}</span>
                                            </p>
                                            <p>
                                                <span class="fw-bold">Total:</span>
                                                <span>${{ $parcel->total_amount ?? '-' }}</span>
                                            </p>
                                        </div>
                                        
                                    </td>
                                    <td><span>{{ ucfirst($parcel->payment_type ?? '-') }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $parcel->pickup_date ? \Carbon\Carbon::parse($parcel->pickup_date)->format('d/m/Y') : '-' }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $parcel->delivery_date ? \Carbon\Carbon::parse($parcel->delivery_date)->format('d/m/Y') : '-' }}</span>
                                    </td>
                                    <td><span
                                            class="badge-{{ activeStatusKey($parcel->status) }}">{{ $parcel->status ?? '-' }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="dropdown">
                                            <span class="dropdown-icon-status" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fas fa-chevron-down"></i>
                                            </span>
                                            <ul class="dropdown-menu">
                                                @if($parcel->status == 'Pending')
                                                    <li>
                                                        <span class="dropdown-item"
                                                            onclick="handlePickupAssign({{ $parcel->id }}, {{ json_encode($drivers) }})">
                                                            <i class="fas fa-truck me-2"></i>Pickup Assign
                                                        </span>
                                                    </li>
                                                @elseif($parcel->status == 'Pickup Assign')
                                                    <li>
                                                        <span class="dropdown-item" onclick="handlePickupCancel({{ $parcel->id }})">
                                                            <i class="fas fa-times-circle me-2"></i>Pickup Cancel
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="dropdown-item" onclick="handlePickupReschedule({{ $parcel->id }}, {{ json_encode($drivers) }})">
                                                            <i class="fas fa-calendar-alt me-2"></i>Pickup Re-Schedule
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="dropdown-item" onclick="handleReceivedByPickupMan({{ $parcel->id }})">
                                                            <i class="fas fa-box-open me-2"></i>Received By Pickup Man
                                                        </span>
                                                    </li>
                                                @elseif($parcel->status == 'Pickup Re-Schedule')
                                                    <li>
                                                        <span class="dropdown-item" onclick="handlePickupReschedule({{ $parcel->id }}, {{ json_encode($drivers) }})">
                                                            <i class="fas fa-calendar-alt me-2"></i>Pickup Re-Schedule
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="dropdown-item" onclick="handleReceivedWarehouse({{ $parcel->id }}, {{json_encode($warehouses)}})">
                                                            <i class="fas fa-warehouse me-2"></i>Received Warehouse
                                                        </span>
                                                    </li>
                                                @elseif($parcel->status == 'Received Warehouse')
                                                    <li>
                                                        <span class="dropdown-item" onclick="handleTransferToHub({{ $parcel->id }}, {{ json_encode($drivers) }})">
                                                            <i class="fas fa-calendar-alt me-2"></i>Transfer To Hub
                                                        </span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>

                                    <td class="align-items-center">
                                        <span class="dropdown-icon-status">
                                            <a href="{{ route('admin.OrderShipment.show', $parcel->id) }}">
                                                <i class="far fa-eye my-1 text-white"></i>
                                                
                                            </a>
                                        </span>
                                        {{-- <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.OrderShipment.edit', $parcel->id) }}"><i
                                                                class="far fa-edit me-2"></i>Edit</a>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('admin.OrderShipment.destroy', $parcel->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item"
                                                                onclick="deleteData(this, 'Are you sure you want to remove this parcel? This action can’t be undone!')"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.OrderShipment.show', $parcel->id) }}"><i
                                                                class="far fa-eye me-2"></i>View History</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-4 text-center text-gray-500">No parcels found.</td>
                                </tr>
                            @endforelse -->
    </tbody>
    </table>
    </div>
    <div class="bottom-user-page mt-3">
        {!! $parcels->links('pagination::bootstrap-5') !!}
    </div>
    </div>
    </div>
    </div>
</x-app-layout>
<script>
    function handlePickupAssign(ParcelId, drivers) {
        let options = `<option value="">Select Pickup Man</option>`;
        drivers.forEach(driver => {
            options += `<option value="${driver.id}">${driver.name}</option>`;
        });

        const Input_Fields = [
            {
                id: "pickup-man",
                label: "Pickup Man",
                type: "select",
                options: options,
                required: true
            },
            {
                id: "note",
                label: "Note",
                type: "textarea",
                required: false
            }
        ];

        let selectedUsers = [];
        $(".selectCheckbox:checked").each(function () {
            selectedUsers.push($(this).val());
        });

        if (ParcelId == "selectArr") {
            ParcelId = selectedUsers;
        }

        const status = "Pickup Assign";
        DynmicModel(ParcelId, status, Input_Fields);
    }

    function handlePickupReschedule(ParcelId, drivers) {
        let options = `<option value="">Select Pickup Man</option>`;
        drivers.forEach(driver => {
            options += `<option value="${driver.id}">${driver.name}</option>`;
        });

        const Input_Fields = [
            {
                id: "pickup-man",
                label: "Pickup Man",
                type: "select",
                options: options,
                required: true
            },
            {
                id: "pickup_date",
                label: "Pickup Date",
                type: "date",
                required: true
            },
            {
                id: "note",
                label: "Note",
                type: "textarea",
                required: false
            }

        ];

        const status = "Pickup Re-Schedule";
        DynmicModel(ParcelId, status, Input_Fields);
    }

    function handlePickupCancel(ParcelId) {
        const status = "Cancelled";
        DynmicModel(ParcelId, status, []);
        console.log("❌ Pickup Cancel Clicked");
    }

    function handleReceivedByPickupMan(ParcelId = false) {
        const status = "Received By Pickup Man";
        DynmicModel(ParcelId, status, []);
    }

    function handleReceivedWarehouse(ParcelId, warehouses) {
        let options = `<option value="">Select Warehouse</option>`;
        warehouses.forEach(warehouse => {
            options += `<option value="${warehouse.id}">${warehouse.warehouse_name}</option>`;
        });

        const Input_Fields = [
            {
                id: "warehouse_id",
                label: "Warehouse",
                type: "select",
                options: options,
                required: true
            },
            {
                id: "note",
                label: "Note",
                type: "textarea",
                required: false
            }
        ];

        const status = "Received Warehouse";
        DynmicModel(ParcelId, status, Input_Fields);
        console.log("🏢 Received Warehouse Clicked");
    }

    async function DynmicModel(ParcelId, status, Input_Fields) {
        var _token = '{{ csrf_token() }}';

        // Generate Dynamic HTML Inputs
        let formHtml = "";
        Input_Fields.forEach(field => {
            if (field.type === "select") {
                formHtml += `
                <label for="${field.id}" style="display:block; text-align:left; font-weight:bold; margin-top: 10px;">${field.label}</label>
                <select id="${field.id}" class="swal2-input">${field.options}</select>`;
            } else if (field.type === "textarea") {
                formHtml += `
                <label for="${field.id}" style="display:block; text-align:left; font-weight:bold; margin-top: 10px;">${field.label}</label>
                <textarea id="${field.id}" class="swal2-input textarea-swal2-input" rows="4" cols="50"></textarea>`;
            } else if (field.type === "date") {
                formHtml += `
                <label for="${field.id}" style="display:block; text-align:left; font-weight:bold; margin-top: 10px;">${field.label}</label>
                <input type="date" id="${field.id}" class="swal2-input">`;
            }
        });

        // Show SweetAlert
        const { value: formValues } = await Swal.fire({
            title: "Update Status",
            html: formHtml,
            showCancelButton: true,
            confirmButtonText: "Change",
            showCloseButton: true,
            preConfirm: () => {
                let formData = { ParcelId: ParcelId, status: status, _token: _token };
                let isValid = true;

                // Validate and collect data
                Input_Fields.forEach(field => {
                    let inputValue = document.getElementById(field.id)?.value.trim() || "";
                    if (field.required && !inputValue) {
                        Swal.showValidationMessage(`Please fill ${field.label}!`);
                        isValid = false;
                    }
                    formData[field.id] = inputValue; // Add to data object
                });

                return isValid ? formData : false;
            }
        });

        if (formValues) {
            // Send AJAX Request
            $.ajax({
                url: "{{ route('parcel.status_update') }}",
                type: "POST",
                data: formValues, // Dynamic data object
                success: function (response) {
                    if (response.status === true) {
                        Swal.fire({
                            title: "Good job!",
                            text: "Status change successfully!",
                            icon: "success"
                        }).then(() => {
                            location.reload(); // Page reload after OK click
                        });
                    } else {
                        Swal.fire({
                            title: "Oops...",
                            text: "Something went to wrong!",
                            icon: "error"
                        });
                    }
                },
                error: function (xhr) {
                    Swal.fire('Error!', 'An error occurred while processing your request.', 'error');
                    console.log(xhr.responseJSON);
                }
            });
        }
    }

</script>
<!-- deliveryman_modal -->
<div class="modal custom-modal signature-add-modal fade" id="deliveryman_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <div class="form-header  text-start mb-0">
                    <div class="popuph">
                        <h4>Delivery Man Assign</h4>
                    </div>
                </div>

                <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    src="{{asset('assets/img/cross.png')}}">

            </div>
            <form action="#">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <div class="col-12">
                                    <label class="foncolor">From Warehouse<i class="text-danger">*</i></label>
                                </div>
                                <div class="col-12">
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">Select Warehouse</option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>

                            </div>

                            <div class="input-block mb-3">
                                <div class="col-12">
                                    <label class="foncolor">To Warehouse<i class="text-danger">*</i></label>
                                </div>
                                <div class="col-12">
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">Select Warehouse</option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>

                            </div>

                            <div class="input-block mb-3">
                                <div class="col-12">
                                    <label class="foncolor">Delivery Man<i class="text-danger">*</i></label>
                                </div>
                                <div class="col-12">
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">Select Delivery Man</option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block ">
                                <label class="foncolor">Note</label>
                                <div class="input-block service-upload service-upload-info mb-0">
                                    <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>