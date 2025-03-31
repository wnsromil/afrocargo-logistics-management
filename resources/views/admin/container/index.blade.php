<x-app-layout>
    <x-slot name="header">
        {{ __('Container List') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">All Containers</p>

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

    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
                                <th>Vehicle Type</th>
                                <th>Warehouse Name</th>
                                <th>Seal No.</th>
                                <th>Container No. 1</th>
                                <th>Container  No. 2</th>
                                <th>Container Size</th>
                                <th>Open Date</th>
                                <th>Close Date</th>
                                <th>Close Invoice</th>
                                <th>Close Warehouse</th>
                                <th>Driver Name</th>
                                <th>Transfer Date</th>
                                <th>Total Orders</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Status Change</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @forelse ($vehicles as $index => $vehicle)
                                <tr>
                                    <td>
                                        {{ ++$index }}
                                    </td>

                                    <td><span>{{ $vehicle->vehicle_type ?? '-' }}</span></td>
                                    <td>{{ ucfirst($vehicle->warehouse->warehouse_name ?? '') }}</td>

                                    <td>{{ $vehicle->vehicle_number ?? '-' }}</td>
                                    <td>{{ $vehicle->container_no_1 ?? '-' }}</td>
                                    <td>{{ $vehicle->container_no_2 ?? '-' }}</td>
                                    <td>{{ $vehicle->vehicle_model ?? '-' }}</td>
                                    <td>{{ $vehicle->vehicle_year ?? '-' }}</td>
                                    <td>{{ $vehicle->vehicle_capacity ?? '-' }}</td>
                                    <td><span
                                            class="badge {{ $vehicle->status == 'Active' ? 'bg-success-light' : 'bg-danger-light' }}">{{ $vehicle->status ?? '-' }}</span>
                                    </td>
                                    <td class="d-flex align-items-center"> -->
                                        {{-- <a href="add-invoice.html" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> Invoice</a>  
                                    <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                            class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                        <!-- <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.vehicle.edit', $vehicle->id) }}"><i
                                                                class="far fa-edit me-2"></i>Edit</a>
                                                    </li>
                                                    <li> -->
                                                        <!-- Delete form -->
                                                        <!-- <form
                                                            action="{{ route('admin.vehicle.destroy', $vehicle->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item"
                                                                onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this manager? This action can’t be undone! 🚀')"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.vehicle.show', $vehicle->id) }}"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li> -->
                                                    {{-- <li>
                                                    <a class="dropdown-item" href="active-customers.html"><i class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="deactive-customers.html"><i class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                </li> --}}
                                                <!-- </ul>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-4 text-center text-gray-500">No data found.</td>
                                </tr>
                            @endforelse -->
                           <tr>
                            <td>1</td>
                            <td>Container</td>
                            <td>Location ABC</td>
                            <td>2E 5777</td>
                            <td>5855</td>
                            <td>887</td>
                            <td>40”</td>
                            <td>5-12-2024</td>
                            <td>6-12-2024</td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td>-</td>
                            <td>12-12-2024</td>
                            <td>120</td>
                            <td>
                                <p><label class="amountfont">Recieved:</label> $1500</p>
                                <p><label class="amountfont">Due:</label> $120</p>
                                <p><label class="amountfont">Total:</label> $2120</p>
                               
                            </td>
                            <td><label class="labelstatus"for="unpaid_status">Inactive</label></td>
                            <td>
                           
                            <div class="status-toggle toggles togglep">
                                <input id="rating_8" class="check" type="checkbox" value="Inactive">
                                <label for="rating_8" class="checktoggle log checkbox-bg" >checkbox</label>
                            </div>
                            
                        

                            </td>
                            <td class="btntext">
                             <button onClick= "redirectTo('{{route('admin.orderdetails')}}')"class=orderbutton><img src="{{ asset('assets/img/ordereye.png')}}"></button>
                              </td>
                          
                           </tr>

                           <tr>
                            <td>2</td>
                            <td>Container</td>
                            <td>Location CSA</td>
                            <td>5T 789</td>
                            <td>4555</td>
                            <td>474</td>
                            <td>20 feet</td>
                            <td>6-12-2024</td>
                            <td>7-12-2024</td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td>Don John</td>
                            <td>02-21-2024</td>
                            <td>555</td>
                            <td> <p><label class="amountfont">Recieved:</label> $5000</p>
                                <p><label class="amountfont">Due:</label> $555</p>
                                <p><label class="amountfont">Total:</label> $5555</p></td>
                            <td><label  class="labelstatusw"for="partial_status"> Active</label></td>
                            <td >
                            <div class="status-toggle toggles togglep">
                                <input id="rating_9" class="check" type="checkbox" value="Inactive">
                                <label for="rating_9" class="checktoggle log checkbox-bg" >checkbox</label>
                            </div>
                       
                            </td>
                            <td class="btntext">
                             <button onClick= "redirectTo('{{ route('admin.container.show', 1) }}')"class=orderbutton><img src="{{ asset('assets/img/ordereye.png')}}"></button>
                              </td> 
                           </tr>

                           <tr>
                            <td>3</td>
                            <td>Container</td>
                            <td>Location QWQ</td>
                            <td>2E 577</td>
                            <td>585</td>
                            <td>442</td>
                            <td>20 feet</td>
                            <td>5-12-2024</td>
                            <td>6-12-2024</td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td>-</td>
                            <td>06-16-2024</td>
                            <td>200</td>
                            <td><p><label class="amountfont">Recieved:</label> $900</p>
                                <p><label class="amountfont">Due:</label> $300</p>
                                <p><label class="amountfont">Total:</label> $1200</p></td>
                            <td><label class="labelstatus"for="unpaid_status">Inactive</label></td>
                            <td > <div class="status-toggle toggles togglep">
                                <input id="rating_1" class="check" type="checkbox" value="Inactive">
                                <label for="rating_1" class="checktoggle log checkbox-bg" >checkbox</label>
                            </div></td>
                            <td class="btntext">
                             <button onClick= "redirectTo('{{ route('admin.container.show', 1) }}')"class=orderbutton><img src="{{ asset('assets/img/ordereye.png')}}"></button>
                              </td> 
                           </tr>

                           <tr>
                            <td>4</td>
                            <td>Container</td>
                            <td>Location TTT</td>
                            <td>5T 739</td>
                            <td>658</td>
                            <td>2100</td>
                            <td>40”</td>
                            <td>5-12-2024</td>
                            <td>6-12-2024</td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td>-</td>
                            <td>06-16-2024</td>
                            <td>300</td>
                            <td><p><label class="amountfont">Recieved:</label> $100</p>
                                <p><label class="amountfont">Due:</label> $300</p>
                                <p><label class="amountfont">Total:</label> $1300</p></td>
                            <td><label class="labelstatus"for="unpaid_status">Inactive</label></td>
                            <td > <div class="status-toggle toggles togglep">
                                <input id="rating_2" class="check" type="checkbox" value="Inactive">
                                <label for="rating_2" class="checktoggle log checkbox-bg" >checkbox</label>
                            </div></td>
                            <td class="btntext">
                             <button onClick= "redirectTo('{{ route('admin.container.show', 1) }}')"class=orderbutton><img src="{{ asset('assets/img/ordereye.png')}}"></button>
                              </td> 
                           </tr>

                           <tr>
                            <td>5</td>
                            <td>Container</td>
                            <td>Location GGG</td>
                            <td>2E 5757</td>
                            <td>485</td>
                            <td>125</td>
                            <td>40”</td>
                            <td>5-12-2024</td>
                            <td>6-12-2024</td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td>Peter Duke</td>
                            <td>12-4-2024</td>
                            <td>450</td>
                            <td><p><label class="amountfont">Recieved:</label> $1500</p>
                                <p><label class="amountfont">Due:</label> $120</p>
                                <p><label class="amountfont">Total:</label> $2120</p></td>
                            <td><label class="labelstatus"for="unpaid_status">Inactive</label></td>
                            <td > <div class="status-toggle toggles togglep">
                                <input id="rating_3" class="check" type="checkbox" value="Inactive">
                                <label for="rating_3" class="checktoggle log checkbox-bg" >checkbox</label>
                            </div></td>
                            <td class="btntext">
                             <button onClick= "redirectTo('{{ route('admin.container.show', 1) }}')"class=orderbutton><img src="{{ asset('assets/img/ordereye.png')}}"></button>
                              </td> 
                           </tr>

                           <tr>
                            <td>6</td>
                            <td>Container</td>
                            <td>Location DDD </td>
                            <td>5T 7319</td>
                            <td>474</td>
                            <td>555</td>
                            <td>20 feet</td>
                            <td>12-4-2024</td>
                            <td>12-4-2024</td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td>-</td>
                            <td>12-4-2024</td>
                            <td>110</td>
                            <td><div class="row">
                                <div class="col-6">
                                    <div class="row amountfont">Received:</div>
                                    <div class="row amountfont">Due:</div>
                                    <div class="row amountfont">Total:</div>
                                </div>
                                <div class="col-6">
                                    <div class="row">$5000</div>
                                    <div class="row">$555</div>
                                    <div class="row">$5555</div>
                                </div>
                                </div></td>
                            <td><label class="labelstatus"for="unpaid_status">Inactive</label></td>
                            <td > <div class="status-toggle toggles togglep">
                                <input id="rating_4" class="check" type="checkbox" value="Inactive">
                                <label for="rating_4" class="checktoggle log checkbox-bg" >checkbox</label>
                            </div></td>
                            <td class="btntext">
                             <button onClick= "redirectTo('{{ route('admin.container.show', 1) }}')"class=orderbutton><img src="{{ asset('assets/img/ordereye.png')}}"></button>
                              </td> 
                           </tr>
                           
                           <tr>
                            <td>7</td>
                            <td>Container</td>
                            <td>Location  SSSS</td>
                            <td>2E 56777</td>
                            <td>658</td>
                            <td>450</td>
                            <td>20 feet</td>
                            <td>8-12-2024</td>
                            <td>9-12-2024</td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td class="tabletext"><input type="checkbox"></td>
                            <td>-</td>
                            <td>12-4-2024</td>
                            <td>554</td>
                            <td><div class="row">
                                <div class="col-6">
                                    <div class="row amountfont">Received:</div>
                                    <div class="row amountfont">Due:</div>
                                    <div class="row amountfont">Total:</div>
                                </div>
                                <div class="col-6">
                                    <div class="row">$900</div>
                                    <div class="row">$300</div>
                                    <div class="row">$1200</div>
                                </div>
                                </div></td>
                            <td><label class="labelstatus"for="unpaid_status">Inactive</label></td>
                            <td> <div class="status-toggle toggles togglep">
                                <input id="rating_5" class="check" type="checkbox" value="Inactive">
                                <label for="rating_5" class="checktoggle log checkbox-bg" >checkbox</label>
                            </div></td>
                            <td class="btntext">
                             <button onClick= "redirectTo('{{ route('admin.container.show', 1) }}')"class=orderbutton><img src="{{ asset('assets/img/ordereye.png')}}"></button>
                              </td> 
                           </tr>
                        </tbody>

                    </table>

                    <div class="bottom-user-page mt-3">
                        {!! $vehicles->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
