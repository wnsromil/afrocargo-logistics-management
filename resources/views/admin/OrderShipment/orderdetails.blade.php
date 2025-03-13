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
            <th>S.No</th>
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
            <div class="row"><div class="d-flex"><img src="../assets/img/User.png" alt="user">Lokesh B S</div></div>
            <div class="row"><div class="d-flex"><img src="../assets/img/phone.png" alt="phone">09513145995</div></div>
            <div class="row"><div class="d-flex"><img src="../assets/img/Vector.png" alt="location">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block....</div></div>
            </div>
            </div>
          </td>
          <td>
          <div>
            <div class="col">
            <div class="row"><div class="d-flex"><img src="../assets/img/User.png" alt="user">Markham</div></div>
            <div class="row"><div class="d-flex"><img src="../assets/img/phone.png" alt="phone">09513145991</div></div>
            <div class="row"><div class="d-flex"><img src="../assets/img/Vector.png" alt="location">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block....</div></div>
            </div>
            </div>
          </td>
          <td><div>12-12-24</div></td>
          <td><div><img src="../assets/img/Rectangle 25.png" alt="image"></div></td>
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
          <td><div>2E 5777</div></td>
          <td><div>55</div></td>
          <td><div>Jelene Largan</div></td>
          <td><div>$25</div></td>
          <td><label class="labelstatus"for="status">Paid</label></td>
          <td>Cash</td>
          <td>Books,Electronics..</td>
          <td><div><img src="../assets/img/Rectangle 25.png" alt="image"></div></td>
          <td></td>
          <td><label class="labelstatus"for="status">Self Pickup</label></td>
        </tr>
       </tbody>
</table>
         </div>
         <div>
         <p style="font-size:20px;font-weight:600px;color:#3A3A3A;padding-top:20px">Order History</p>
         <div class="col-md-12">	
							<div class="card">
								<div class="card-body">
									<div class="cd-horizontal-timeline">
                                    <div class="timeline">
                                        <div class="events-wrapper">
                                            <div class="events">
                                                <ol>
                                                    <li><a href="#0" data-date="16/01/2014" class="selected"><div><div><div>Pending</div>12-12-24</div></div></a></li>
                                                    <li><a href="#0" data-date="28/02/2014">28 Feb</a></li>
                                                    <li><a href="#0" data-date="20/04/2014">20 Mar</a></li>
                                                    <li><a href="#0" data-date="20/05/2014">20 May</a></li>
                                                    <li><a href="#0" data-date="09/07/2014">09 Jul</a></li>
                                                    
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
                                    <!-- <div class="events-content">
                                        <ol>
                                            <li class="selected" data-date="16/01/2014">
                                                <h3><small>Title 01</small></h3>
                                                <p class="">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="28/02/2014">
                                                <h3> <small>Title 02</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="20/04/2014">
                                                <h3><small>Title 03</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="20/05/2014">
                                                <h3><small>Title 04</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="09/07/2014">
                                                <h3><small>Title 05</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="30/08/2014">
                                                <h3> <small>Title 06</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="15/09/2014">
                                                <h3><small>Title 07</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="01/11/2014">
                                                <h3> <small>Event List</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="10/12/2014">
                                                <h3><small>Event Item</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="19/01/2015">
                                                <h3><small>Event title</small></h3>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="03/03/2015">
                                                <h3><small>Event title</small></h3>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                        </ol>
                                    </div> -->
                                    <!-- .events-content -->
                                </div>
								</div>
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
