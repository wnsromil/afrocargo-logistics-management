<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

   
    <x-slot name="cardTitle" >
       <p class="head">Supply Order Management</p>

       <div class="usersearch d-flex">
                <div class="top-nav-search">
                    <form>
                        <input type="text" class="form-control forms" placeholder="Search ">

                    </form>
                </div>
                <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser " ><a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
											data-bs-placement="bottom" title="Refresh"><span><i
													class="fe fe-refresh-ccw"></i></span></a></button>
                </div>
            </div>
    </x-slot>

    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable">
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
                             
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <td>2</td>
                        <td>WE97078891</td>
                        <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="../assets/img/User.png" alt="user">Lokesh B S</div></div>
                                     <div class="row"><div ><img src="../assets/img/phone.png" alt="phone">09513145995</div></div>
                                     <div class="row"><div ><img src="../assets/img/Vector.png" alt="location">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block....</div></div>
                                    </div>
                                </div>
                            </td>
                            <td>Location CSA</td>
                            <td>12-12-24</td>
                            <td><div><img src="../assets/img/img2.png" alt="image"></div></td></td>
                            <td>Barrels</td>
                            <td>3</td>
                            <td>$150</td>
                            <td>Alysig Tremblett</td>
                            <td>Van</td>
                            <td><label  class="labelstatusy"for="partial_status">Partialy Paid</label></td>
                            <td><div class="row">
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
                                </div></td>
                                <td>Online/Card</td>
                              
                               <td><label class="labelstatuspi"for="status">Assign Delivery Boy</label></td>
                               </tr>
                            
</tbody>
</table>
</div>

<p class="orderhistory">Order History</p>  
</x-app-layout>

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
							
								<img  class="btn-close" data-bs-dismiss="modal" aria-label="Close"src="../assets/img/cross.png">
							
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
	                                        <label  class="foncolor">Note</label>
	                                        <div class="input-block service-upload service-upload-info mb-0">
	                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">    
	                                    
                                        </div>
	                                        
	                                    </div>
									</div>
									
								</div>
							</div>
							<div class="modal-footer">
                            
								<button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary custom-btn">Cancel</button>
								<button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>