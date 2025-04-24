<x-app-layout>
    <x-slot name="header">
        Parcel Management
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Order details</p>
    </x-slot>
    <div class="card-table">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="thead-light">
                        <tr>
                            <th>S.No.</th>
                            <th>Tracking ID</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Transfer Date</th>
                            <th>Capture Image</th>
                            <th>Amount</th>
                            <th>Vehicle Number</th>
                            <th>No.of Orders</th>
                            <th>Driver Name</th>
                            <th>Estimate Cost</th>
                            <th>Payment Status</th>
                            <th>Payment Mode</th>
                            <th>Item List</th>
                            <th>Identity Image</th>
                            <th>Signature</th>
                            <th>Status</th>
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
                                                <p>No 295 opp.Xavier Church ground,10th main,39th C Cross Road,5th Block California</p>
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
                                <div>2E 5777</div>
                            </td>
                            <td>
                                <div>55</div>
                            </td>
                            <td>
                                <div>Jelene Largan</div>
                            </td>
                            <td>
                                <div>$25</div>
                            </td>
                            <td><label class="labelstatus" for="status">Paid</label></td>
                            <td>Cash</td>
                            <td>Books,Electronics..</td>
                            <td>
                                <div><img src="{{asset('assets/img/Rectangle 25.png')}}" alt="image"></div>
                            </td>
                            <td><img src="{{asset('assets/img/user-signature copy.png')}}"></td>
                            <td><label class="labelstatus" for="status">Self Pickup</label></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
            
                <p class="heading mt-4">Order History</p>
                <!-- Timeline -->
                <div class="col-md-12">
                    <div class="timeline-card px-3">
                        <div class="card-body">
                            <div class="cd-horizontal-timeline mannuallyCSS mt-0">
                                <div class="timeline w-100">
                                    <div class="events-wrapper">
                                        <div class="events">
                                            <ol>
                                                <li>
                                                    <a href="#0" data-date="16/01/2014">
                                                        <p class="bigfont">Pending</p>
                                                        <p class="smfont">12-12-2024</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#0" data-date="28/02/2014">
                                                        <p class="bigfont">Schedule Pickup</p>
                                                        <p class="smfont">12-12-2024</p>
                                                        <div class="bottom">
                                                            <p class="bigfont">Assign Driver</p>
                                                            <p class="smfont">Alex Jim</p>
                                                            <p class="smfont">12-12-2024</p>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#0" data-date="20/04/2014">
                                                        <p class="bigfont">Transfer to Hub</p>
                                                        <p class="smfont">13-12-2024</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#0" data-date="28/02/2014" >
                                                        <p class="bigfont">Schedule Pickup</p>
                                                        <p class="smfont">12-12-2024</p>
                                                        <div class="bottom">
                                                            <p class="bigfont">Assign Driver</p>
                                                            <p class="smfont">Alex Jim</p>
                                                            <p class="smfont">12-12-2024</p>
                                                        </div>
                                                    </a>
                                                </li>
                                                 <li>
                                                    <a href="#0" data-date="16/01/2014" class="selected">
                                                        <p class="bigfont">Self Pickup</p>
                                                        <p class="smfont">12-12-2024</p>
                                                    </a>
                                                </li>
                                            </ol>
                                            <span class="filling-line" aria-hidden="true"></span>
                                        </div>
                                        <!-- events -->
                                    </div>
                                    <ul class="cd-timeline-navigation">
                                        <li><a href="#0" class="prev inactive">Prev</a></li>
                                        <li><a href="#0" class="next">Next</a></li>
                                    </ul>
                                    <!-- cd-timeline-navigation -->
                                </div>
                                <!-- timeline -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Timeline -->
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>




</x-app-layout>
