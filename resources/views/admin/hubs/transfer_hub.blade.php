<x-app-layout>
    <x-slot name="header">
        {{ __('Transfer to Warehouse') }}
    </x-slot>

    <x-slot name="cardTitle" >
     <p class="head">Transfer to Warehouse</p>  

     <div class="usersearch d-flex usersserach">
        
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
                                <th>S. No.</th>
                                <th>Tracking ID</th>
                                <th>Transfer date</th>
                                <th>Vehicle Type</th>
                                <th>Seal Number</th>
                                <th>Open Date</th>
                                <th>Close Date</th>
                                <th>No. of orders</th>
                                <th>Driver Name</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Status</th>
                                <th>Status Update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @forelse ($parcels as $index => $parcel)
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
                            @endforelse -->
                            <tr >
                        <td>1</td>
                        <td>-</td>
                        <td><div>02-21-24</div></td>
                        <td><div>Container</div></td>
                              <td><div>2E 5777</div></td>
                              <td><div>5-12-24</div></td>
                              <td><div>6-12-24</div></td> 
                              <td><div>55</div></td>
                              <td><div>-</div></td>
                              <td><label  class="labelstatus"for="unpaid_status">unpaid</label></td>
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
                              <td><div>Cash</div></td>
                              <td><label class="labelstatus"for="status">Pending</label></td>
                              <td>
                              <li class="nav-item dropdown">
                        <a class="amargin"href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">
                            
                            <span class="user-content" style="background-color:#203A5F;border-radius:5px;width: 30px;
    height: 26px;align-content: center;">
                                <div ><img src="../assets/img/downarrow.png"></div>
                            </span>
                        </a>
                        <div class="dropdown-menu menu-drop-user">
                            <div class="profilemenu">
                                <div class="subscription-menu">
                                    <ul>
                                        
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);"data-bs-toggle="modal" data-bs-target="#recieved_modal">Schedule Pickup</a>
                                        </li>
                                    </ul>
                                </div>
                               
                            </div>
                        </div>
                    </li>
			</div>
                            </td>
                               <td class="btntext">
                             <button onClick= "redirectTo('{{route('admin.orderdetails')}}')" class=orderbutton><img src="../assets/img/ordereye.png"></button>
                              </td>
                             </tr>
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
