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
        <button type="button" class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
          <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
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
                                <th>Status</th>
                            </tr>
                        </thead>
<tbody>
<tr>
<td class="tabletext"><input type="checkbox"></td>
   <td class="tabletext">1</td>
   <td>WE97078893</td>
   <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Lokesh B S</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145995</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location"><label class="ellipseText">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block</label></div></div>
                                    </div>
                                </div></td>
   <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Markham</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145991</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block....</div></div>
                                    </div>
                                </div></td>
   <td><div>12-12-24</div></td>
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
   <td><label class="labelstatusc"for="transfer_status">Ready to Transfer</label></td>
</tr>

<tr>
<td class="tabletext"><input type="checkbox"></td>
  <td class="tabletext">2</td>
  <td>WE97078891</td>
   <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Lokesh B S</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145995</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location"><label class="ellipseText">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block</label></div></div>
                                    </div>
                                </div></td>
   <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Markham</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145991</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block....</div></div>
                                    </div>
                                </div></td>
   <td>12-12-24</td>
   <td><div class="row">
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
                                </div></td>
   <td>Online/Card</td>
   <td><label class="labelstatusc"for="transfer_status">Ready to Transfer</label></td>
</tr>

<tr>
<td class="tabletext"><input type="checkbox"></td>
  <td class="tabletext">3</td>
  <td>WE97078895</td>
  <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Lokesh B S</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145995</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location"><label class="ellipseText">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block</label></div></div>
                                    </div>
                                </div></td>
  <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Markham</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145991</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block....</div></div>
                                    </div>
                                </div></td>
  <td>12-12-24</td>
  <td><div class="row">
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
                                </div></td>
  <td>Cheque</td>
  <td><label class="labelstatusc"for="transfer_status">Ready to Transfer</label></td>
</tr>

<tr>
<td class="tabletext"><input type="checkbox"></td>
<td class="tabletext">4</td>
<td>WE97078896</td>
<td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Lokesh B S</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145995</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location"><label class="ellipseText">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block</label></div></div>
                                    </div>
                                </div></td>
    <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Markham</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145991</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block....</div></div>
                                    </div>
                                </div></td>
    <td>12-12-24</td>
    <td><div class="row">
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
                                </div></td>
    <td>Online/Card</td>
    <td><label class="labelstatusc"for="transfer_status">Ready to Transfer</label></td>
</tr>

<tr>
<td class="tabletext"><input type="checkbox"></td>
<td class="tabletext">5</td>
  <td>WE97078897</td>
  <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Lokesh B S</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145995</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location"><label class="ellipseText">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block</label></div></div>
                                    </div>
                                </div></td>
  <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Markham</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145991</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block....</div></div>
                                    </div>
                                </div></td>
  <td>12-12-24</td>
  <td><div class="row">
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
                                </div></td>
  <td>Cash</td>
  <td><label class="labelstatusc"for="transfer_status">Ready to Transfer</label></td>
</tr>

<tr>
<td class="tabletext"><input type="checkbox"></td>
<td class="tabletext">6</td>
<td>WE97078898</td>
<td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Lokesh B S</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145995</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location"><label class="ellipseText">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block</label></div></div>
                                    </div>
                                </div></td>
   <td><div>
                                    <div class="col">
                                     <div class="row"><div ><img src="{{asset('assets/img/User.png')}}" alt="user">Markham</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/phone.png')}}" alt="phone">09513145991</div></div>
                                     <div class="row"><div ><img src="{{asset('assets/img/Vector.png')}}" alt="location">No 295 opp.shalini ground,10th main,39th C Cross Road,5th Block....</div></div>
                                    </div>
                                </div></td>
   <td>12-12-24</td>
   <td><div class="row">
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
                                </div></td>
   <td>Online/Card</td>
   <td><label class="labelstatusc"for="transfer_status">Ready to Transfer</label></td>
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
