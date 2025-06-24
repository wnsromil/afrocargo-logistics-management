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
        <p class="head">Order/Shipment Management</p>

        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form>
                    <input type="text" id="searchInput" class="form-control forms" placeholder="Search ">

                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters"
                        href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a></button>
            </div>
        </div>
    </x-slot>
    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                <th>S.No</th>
                                <th>Tracking ID</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Pickup Date</th>
                                <th>Capture Image</th>
                                <th>Item List</th>
                                <th>Estimate cost</th>
                                <th>Driver Name</th>
                                <th>Vehicle Type</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                {{-- <th>Warehouse</th> --}}
                                <th>Status</th>
                                <th>Status update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($parcels as $index => $parcel)
                                                        <tr>
                                                            <td> {{ $serialStart + $index + 1 }}</td>
                                                            <td>{{ $parcel->tracking_number ?? "-"}}</td>
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
                                                                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                                                    Block
                                                                                    California</p>
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
                                                                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                                                    Block
                                                                                    California</p>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>{{ $parcel->pickup_date ? $parcel->pickup_date->format('m-d-Y') : '-' }}</div>
                                                            </td>
                                                            <td>
                                                                <div><img src="{{asset('assets/img/Rectangle 25.png')}}" alt="image"></div>
                                                            </td>
                                                            <td>
                                                                <div>Household Set,Card..</div>
                                                            </td>
                                                            <td>
                                                                <div>${{ $parcel->estimate_cost ?? "0"}}</div>
                                                            </td>
                                                            <td>
                                                                <div>{{ $parcel->driver->name ?? "-"}}</div>
                                                            </td>
                                                            <td>
                                                                <div>{{ $parcel->driver_vehicle->vehicle_type ?? "-"}}</div>
                                                            </td>
                                                            @php
                                                                $forValue = match ($parcel->payment_status) {
                                                                    'Unpaid' => 'unpaid_status',
                                                                    'Paid' => 'status',
                                                                    'Completed' => 'partial_status',
                                                                };
                                                            @endphp


                                                            <td>
                                                                <label class="labelstatusy" for="{{ $forValue }}">
                                                                    {{ $parcel->payment_status ?? '-' }}
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="row">Partial:</div>
                                                                        <div class="row">Due:</div>
                                                                        <div class="row">Total:</div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="row">${{ $parcel->partial_payment ?? "0"}}</div>
                                                                        <div class="row">${{ $parcel->remaining_payment ?? "0"}}</div>
                                                                        <div class="row">${{ $parcel->total_amount ?? "0"}}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @php
                                                            $classValue = match ($parcel->status) {
                                                                'Pickup Assign' => 'labelstatusp',
                                                                'Pending' => 'labelstatusp',
                                                                'Pickup Re-Schedule' => 'labelstatuspi',
                                                                default => 'labelstatusp',
                                                            };
                                                        @endphp
                                                            <td>
                                                                <div> {{ $parcel->payment_type === 'COD' ? 'Cash' : ($parcel->payment_type ?? '-') }}</div>
                                                            </td>
                                                            <td>
                                                                <label class="{{ $classValue }}" for="status">
                                                                    {{ $parcel->status ?? '-' }}
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <li class="nav-item dropdown">
                                                                    <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                                                        data-bs-toggle="dropdown">

                                                                        <span class="user-content droparrow droparrow">
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
                                                                                            data-bs-target="#cancel_modal">Schedule
                                                                                            Pickup Cancel</a>


                                                                                    </li>
                                                                                    <li>
                                                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#reschedule_modal"> Pickup
                                                                                            Re-schedule</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#recieved_modal">Recieved by
                                                                                            Pickup Man</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </td>
                                                            <td class="btntext">
                                                                <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                                                    class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                                            </td>
                                                        </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-center text-gray-500">No order found.
                                    </td>
                                </tr>
                            @endforelse

                            {{-- <tr style="border:none">
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
                                                    <p class="ellipseText">No 295 opp.Xavier Church ground,10th
                                                        main,39th C Cross Road,5th Block California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block California</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>12-12-24</div>
                                </td>
                                <td>
                                    <div><img src="{{asset('assets/img/Rectangle 25.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Books,Electronics..</div>
                                </td>
                                <td>
                                    <div>$25</div>
                                </td>
                                <td>
                                    <div>Jelene Largan</div>
                                </td>
                                <td>
                                    <div>Two Wheeler</div>
                                </td>
                                <td><label class="labelstatus" for="unpaid_status">unpaid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$350</div>
                                            <div class="row">$100</div>
                                            <div class="row">$450</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Cash</div>
                                </td>
                                <td><label class="labelstatus" for="status">Pending</label></td>
                                <td>
                                    <li class="nav-item dropdown">
                                        <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                            data-bs-toggle="dropdown">

                                            <span class="user-content droparrow">
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
                                                                data-bs-target="#recieved_modal">Schedule Pickup</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>
                            <!-- second line -->
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
                                                        California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
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
                                    <div><img src="{{asset('assets/img/Rectangle 25.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Household Set,Card..</div>
                                </td>
                                <td>
                                    <div>$22</div>
                                </td>
                                <td>
                                    <div>Alysig Tremblett</div>
                                </td>
                                <td>
                                    <div>Van</div>
                                </td>
                                <td><label class="labelstatusy" for="partial_status">Partialy Paid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$200</div>
                                            <div class="row">$50</div>
                                            <div class="row">$250</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Online/Card</div>
                                </td>
                                <td><label class="labelstatusy" for="status">Schedule Pickup</label></td>
                                <td>
                                    <li class="nav-item dropdown">
                                        <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                            data-bs-toggle="dropdown">

                                            <span class="user-content droparrow droparrow">
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
                                                                data-bs-target="#cancel_modal">Schedule
                                                                Pickup Cancel</a>


                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reschedule_modal"> Pickup
                                                                Re-schedule</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#recieved_modal">Recieved by
                                                                Pickup Man</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <!-- third line -->
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
                                                        California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
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
                                    <div><img src="{{asset('assets/img/Rectangle 3.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Books</div>
                                </td>
                                <td>
                                    <div>$12</div>
                                </td>
                                <td>
                                    <div>Norma McLarens</div>
                                </td>
                                <td>
                                    <div>Two Wheeler</div>
                                </td>
                                <td><label class="labelstatusw" for="partial_status">Paid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$350</div>
                                            <div class="row">$100</div>
                                            <div class="row">$450</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Cheque</div>
                                </td>
                                <td><label class="labelstatusp" for="status">Pickup Re-Schedule</label></td>
                                <td>
                                    <li class="nav-item dropdown">
                                        <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                            data-bs-toggle="dropdown">

                                            <span class="user-content droparrow droparrow">
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
                                                                data-bs-target="#reschedule_modal"> Pickup
                                                                Re-schedule</a>

                                                        </li>

                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#receivedwarehouse_modal">Recieved
                                                                Warehouse</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <!-- fourth line -->
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
                                                        California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
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
                                    <div><img src="{{asset('assets/img/Rectangle 25.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Household Set,card..</div>
                                </td>
                                <td>
                                    <div>$35</div>
                                </td>
                                <td>
                                    <div>Berting Dominico</div>
                                </td>
                                <td>
                                    <div>Van</div>
                                </td>
                                <td><label class="labelstatusy" for="partial_status"> Partial Paid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$200</div>
                                            <div class="row">$50</div>
                                            <div class="row">$250</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Online/Card</div>
                                </td>
                                <td><label class="labelstatuspi" for="status">Received By Pickup Man</label></td>
                                <td></td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <!-- fifth line  -->
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
                                                        California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
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
                                    <div><img src="{{asset('assets/img/Rectangle 2.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Books</div>
                                </td>
                                <td>
                                    <div>$55</div>
                                </td>
                                <td>
                                    <div>Amalie McLachlan</div>
                                </td>
                                <td>
                                    <div>Container</div>
                                </td>
                                <td><label class="labelstatus" for="partial_status"> Unpaid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$200</div>
                                            <div class="row">$50</div>
                                            <div class="row">$250</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Cash</div>
                                </td>
                                <td><label class="labelstatusp" for="status">Pickup Re-Schedule</label></td>
                                <td>
                                    <li class="nav-item dropdown">
                                        <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                            data-bs-toggle="dropdown">

                                            <span class="user-content droparrow droparrow">
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
                                                                data-bs-target="#reschedule_modal"> Pickup
                                                                Re-schedule</a>

                                                        </li>

                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#receivedwarehouse_modal">Recieved
                                                                Warehouse</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <!-- sixth line  -->
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
                                                        California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
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
                                    <div><img src="{{asset('assets/img/Rectangle 3.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Cards</div>
                                </td>
                                <td>
                                    <div>$12</div>
                                </td>
                                <td>
                                    <div>Peterus Simondson</div>
                                </td>
                                <td>
                                    <div>Container</div>
                                </td>
                                <td><label class="labelstatusy" for="partial_status"> Partialy paid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$200</div>
                                            <div class="row">$50</div>
                                            <div class="row">$250</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Online/Card</div>
                                </td>
                                <td><label class="labelstatuspi" for="status">Received By Pickup Man</label></td>
                                <td>

                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>
                            <!-- seven line -->
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
                                                        California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
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
                                    <div><img src="{{asset('assets/img/Rectangle 25.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Books</div>
                                </td>
                                <td>
                                    <div>$8</div>
                                </td>
                                <td>
                                    <div>Gar Delagnes</div>
                                </td>
                                <td>
                                    <div>Two Wheeler</div>
                                </td>
                                <td><label class="labelstatusw" for="partial_status"> paid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$350</div>
                                            <div class="row">$100</div>
                                            <div class="row">$450</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Cheque</div>
                                </td>
                                <td><label class="labelstatusy" for="status">Schedule Pickup</label></td>
                                <td>
                                    <li class="nav-item dropdown">
                                        <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                            data-bs-toggle="dropdown">

                                            <span class="user-content droparrow droparrow">
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
                                                                data-bs-target="#cancelcontainer_modal">Delivery Man
                                                                Assign
                                                                Cancel</a>


                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reschedule_modal"> Delivery
                                                                Re-schedule</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#returncourier_modal">Return
                                                                to Courier</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deliveredcourier_modal">Delivered</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </li>

                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <!-- eight line -->
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
                                                        California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
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
                                    <div><img src="{{asset('assets/img/Rectangle 25.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Household set,card..</div>
                                </td>
                                <td>
                                    <div>$34</div>
                                </td>
                                <td>
                                    <div>Bartlet Rayworth</div>
                                </td>
                                <td>
                                    <div>Van</div>
                                </td>
                                <td><label class="labelstatusy" for="partial_status"> Partial paid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$200</div>
                                            <div class="row">$50</div>
                                            <div class="row">$250</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Cheque</div>
                                </td>
                                <td><label class="labelstatuspi" for="status">Recieved by PickupMan</label></td>
                                <td>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>
                            <!-- nine line -->
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
                                                        California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
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
                                    <div><img src="{{asset('assets/img/Rectangle 3.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Electronics</div>
                                </td>
                                <td>
                                    <div>$21</div>
                                </td>
                                <td>
                                    <div>Saxe Fegres</div>
                                </td>
                                <td>
                                    <div>Van</div>
                                </td>
                                <td><label class="labelstatus" for="partial_status"> Unpaid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$350</div>
                                            <div class="row">$100</div>
                                            <div class="row">$450</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Cash</div>
                                </td>
                                <td><label class="labelstatus" for="status">Pending</label></td>
                                <td>
                                    <li class="nav-item dropdown">
                                        <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                            data-bs-toggle="dropdown">

                                            <span class="user-content droparrow droparrow">
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
                                                                data-bs-target="#recieved_modal">Schedule
                                                                Pickup</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </li>

                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr>

                            <!-- ten line -->
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
                                                        California</p>
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
                                                    <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th
                                                        Block
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
                                    <div><img src="{{asset('assets/img/Rectangle 25.png')}}" alt="image"></div>
                                </td>
                                <td>
                                    <div>Household</div>
                                </td>
                                <td>
                                    <div>$25</div>
                                </td>
                                <td>
                                    <div>Lock Gillbanks</div>
                                </td>
                                <td>
                                    <div>Container</div>
                                </td>
                                <td><label class="labelstatusy" for="partial_status"> Partially paid</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">Partial:</div>
                                            <div class="row">Due:</div>
                                            <div class="row">Total:</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">$200</div>
                                            <div class="row">$50</div>
                                            <div class="row">$250</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Online/Card</div>
                                </td>
                                <td><label class="labelstatusy" for="status">Schedule Pickup</label></td>
                                <td>
                                    <li class="nav-item dropdown">
                                        <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                            data-bs-toggle="dropdown">

                                            <span class="user-content droparrow droparrow">
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
                                                                data-bs-target="#cancelcontainer_modal">Delivery Man
                                                                Assign
                                                                Cancel</a>


                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reschedule_modal"> Delivery
                                                                Re-schedule</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#returncourier_modal">Return
                                                                to Courier</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item " href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deliveredcourier_modal">Delivered</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                </td>
                                <td class="btntext">
                                    <button onClick="redirectTo('{{route('admin.orderdetails')}}')"
                                        class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
            <div class="col-md-6 d-flex p-2 align-items-center">
                <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
                <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example"
                    id="pageSizeSelect">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
            </div>
            <div class="col-md-6">
                <div class="float-end">
                    <div class="bottom-user-page mt-3">
                        {!! $parcels->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- <script>
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

        if(ParcelId=="selectArr"){
            ParcelId =selectedUsers;
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

    function handleReceivedByPickupMan(ParcelId=false) {
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
        DynmicModel(ParcelId, status, Input_Fields );
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

</script> -->
<!-- cancel model -->
<div class="modal custom-modal signature-add-modal fade" id="cancel_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body confirmationpopup">
                <div class="form-header">

                    <p class="popupc">Do you want to cancel the Schedule Pickup?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">

                            <button type="submit" data-bs-dismiss="modal"
                                class=" w-100 btn btn-outline-primary custom-btn">No</button>
                        </div>
                        <div class="col-6">
                            <button data-bs-dismiss="modal"
                                class="w-100 btn btn-primary paid-continue-btn customerpopup"><a class="dropdown-item"
                                    href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#reason_modal">Yes</a>
                            </button>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>


<!-- recieved_modal -->
<div class="modal custom-modal signature-add-modal fade" id="recieved_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <div class="form-header  text-start mb-0">
                    <div class="popuph">
                        <h4>Pickup Man Assign</h4>
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
                                    <label class="foncolor">Pickup Man<i class="text-danger">*</i></label>
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
                                <div class="input-block mb-0">
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

<!-- re-schedule  pickup-->

<div class="modal custom-modal signature-add-modal fade" id="reschedule_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <div class="form-header  text-start mb-0">
                    <div class="popuph">
                        <h4>Pickup Re-Schedule</h4>
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
                                    <label class="foncolor">Pickup Man<i class="text-danger">*</i></label>
                                </div>
                                <div class="col-12">
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">Select Delivery Man</option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="colordate"> Date <i class="text-danger">*</i></label>
                                    <div class="daterangepicker-wrap cal-icon cal-icon-info popdate">
                                        <input type="text" class="btn-filters form-control form-cs inp "
                                            name="datetimes" placeholder="From Date - To Date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block ">
                                <label class="foncolor">Note</label>
                                <div class="input-block mb-0">
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


<!-- reasonofaction  -->

<div class="modal custom-modal signature-add-modal fade" id="reason_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <div class="form-header  text-start mb-0">
                    <div class="popuph">
                        <h4>Reason for Action</h4>
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
                                    <label class="foncolor">Select Reason<i class="text-danger">*</i></label>
                                </div>
                                <div class="col-12">
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">Select Reason</option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block ">
                                <label class="foncolor">Note</label>
                                <div class="input-block mb-0">
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


<!-- recieved warehouse -->
<div class="modal custom-modal signature-add-modal fade" id="receivedwarehouse_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <div class="form-header  text-start mb-0">
                    <div class="popuph">
                        <h4>Recieved Warehouse</h4>
                    </div>
                </div>
                <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    src="{{asset('assets/img/cross.png')}}">


                </button>
            </div>
            <form action="#">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <div class="col-12">
                                    <label class="foncolor">Warehouse Name<i class="text-danger">*</i></label>
                                </div>
                                <div class="col-12">
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">Select Warehouse</option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block ">
                                <label class="foncolor">Note</label>
                                <div class="input-block mb-0">
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



<!-- cancel container recieved -->

<div class="modal custom-modal signature-add-modal fade" id="cancelcontainer_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body confirmationpopup">
                <div class="form-header">

                    <p class="popupc">Do you want to cancel the Container Recieved by Hub?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">

                            <button type="submit" data-bs-dismiss="modal"
                                class=" w-100 btn btn-outline-primary custom-btn">No</button>
                        </div>
                        <div class="col-6">
                            <button data-bs-dismiss="modal"
                                class="w-100 btn btn-primary paid-continue-btn customerpopup"><a class="dropdown-items"
                                    href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#reason_modal">Yes</a>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- delivery reschedule -->
<div class="modal custom-modal signature-add-modal fade" id="reschedule_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <div class="form-header  text-start mb-0">
                    <div class="popuph">
                        <h4>Delivery Re-Schedule</h4>
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
                                    <label class="foncolor">Delivery Man<i class="text-danger">*</i></label>
                                </div>
                                <div class="col-12">
                                    <select class="js-example-basic-single select2">
                                        <option selected="selected">Select Delivery Man</option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="colordate"> Date <i class="text-danger">*</i></label>
                                    <div class="daterangepicker-wrap cal-icon cal-icon-info popdate">
                                        <input type="text" class="btn-filters form-control form-cs inp "
                                            name="datetimes" placeholder="From Date - To Date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block ">
                                <label class="foncolor">Note</label>
                                <div class="input-block mb-0">
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


<!-- return courier -->

<div class="modal custom-modal signature-add-modal fade" id="returncourier_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <div class="form-header  text-start mb-0">
                    <div class="popuph">
                        <h4>Return to Courier</h4>
                    </div>
                </div>
                <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    src="{{asset('assets/img/cross.png')}}">

            </div>
            <form action="#">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">

                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block ">
                                <label class="foncolor">Note</label>
                                <div class="input-block mb-0">
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



<!-- delivered courier -->
<div class="modal custom-modal signature-add-modal fade" id="deliveredcourier_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <div class="form-header  text-start mb-0">
                    <div class="popuph">
                        <h4>Delivered</h4>
                    </div>
                </div>
                <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    src="{{asset('assets/img/cross.png')}}">

            </div>
            <form action="#">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">

                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block ">
                                <label class="foncolor">Note</label>
                                <div class="input-block mb-0">
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