<x-app-layout>
    <x-slot name="header">
        {{ __('Warehouse Managers') }}
    </x-slot>


        

        
  
  
  
  
    <x-slot name="cardTitle" >
        
    
       <p class="head">All Warehouse Manager</p>

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
    
    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{route('admin.warehouse_manager.create')}}" class="btn btn-primary buttons"style="background:#203A5F">
                <img src="assets/images/Vector.png">  
                Add Manager
                </a>
            </div>
        </div>
    </div>

    <div>

        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th >S. No.</th>
                                <th >Manager Name</th>
                                <th >Warehouse Name</th>
                                <th >Email</th>
                                <th >Address</th>
                                <th >Phone</th>
                                <th >Status</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @forelse ($warehouses as $index => $warehouse)
                                <tr>
                                    <td>
                                        {{ ++$index }}
                                    </td>

                                    <td>{{ ucfirst($warehouse->warehouse->warehouse_name ?? '')}}</td>
                                    <td><span>{{$warehouse->name ?? '-'}}</span></td>
                                    <td>{{$warehouse->email ?? '-'}}</td>
                                    <td>{{$warehouse->phone ?? '-'}}</td>
                                    <td>{{$warehouse->address ?? '-'}}</td>
                                    <td><span
                                            class="badge {{$warehouse->status == 'Active' ? 'bg-success-light' : 'bg-danger-light'}}">{{$warehouse->status ?? '-'}}</span>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        {{-- <a href="add-invoice.html" class="btn btn-greys me-2"><i
                                                class="fa fa-plus-circle me-1"></i> Invoice</a>
                                        <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                                class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('admin.warehouse_manager.edit', $warehouse->id)}}"><i
                                                                class="far fa-edit me-2"></i>Edit</a>
                                                    </li>
                                                    <li> -->
                                                        <!-- Delete form -->
                                                        <!-- <form
                                                            action="{{ route('admin.warehouse_manager.destroy', $warehouse->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item" onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this manager? This action can’t be undone! 🚀')"><i class="far fa-trash-alt me-2"></i>Delete</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="active-customers.html"><i
                                                                class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="deactive-customers.html"><i
                                                                class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-4 text-center text-gray-500">No manager found.</td>
                                </tr>
                            @endforelse -->
                         <tr>
                            <td>1</td>
                            <td>Jelene Largan</td>
                            <td>Location ABC</td>
                            <td>jeleneLargan@gmail.com</td>
                            <td>8 Service JunctionL</td>
                            <td>228-134-8273</td>
                            <td><div class="container">
        <img src="../assets/img/checkbox.png" alt="Image" />
        <p>Active</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                         <tr>
                            <td>2</td>
                            <td>Alysig Tremblett</td>
                            <td>Location CSA</td>
                            <td>alysing@@gmail.com</td>
                            <td>575 Hanson PlaceL</td>
                            <td>754-622-7485</td>
                            <td><div class="container">
        <img src="../assets/img/inactive.png" alt="Image" />
        <p>Inactive</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                         <tr>
                            <td>3</td>
                            <td>Norma McLarens</td>
                            <td>Location QWQ</td>
                            <td>normaMcla@gmail.com</td>
                            <td>3225 Parkside CircleL</td>
                            <td>993-320-1732</td>
                            <td><div class="container">
        <img src="../assets/img/checkbox.png" alt="Image" />
        <p>Active</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                         <tr>
                            <td>4</td>
                            <td>Berting Dominico</td>
                            <td>Location TTT</td>
                            <td>bertingDomin@gmail.com</td>
                            <td>5 Drewry AlleyL</td>
                            <td>492-335-8599</td>
                            <td><div class="container">
        <img src="../assets/img/checkbox.png" alt="Image" />
        <p>Active</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                         <tr>
                            <td>5</td>
                            <td>Amalie McLachlan</td>
                            <td>Location GGG</td>
                            <td>amaileMc@gmail.com</td>
                            <td>223 Dgrwin StreetL</td>
                            <td>827-579-8393</td>
                            <td><div class="container">
        <img src="../assets/img/checkbox.png" alt="Image" />
        <p>Active</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                         <tr>
                            <td>6</td>
                            <td>Peterus Simondson</td>
                            <td>Location DDD </td>
                            <td>peterusSimondson@gmail.com</td>
                            <td>64302 Artisan WayL</td>
                            <td>141-949-2749</td>
                            <td><div class="container">
        <img src="../assets/img/checkbox.png" alt="Image" />
        <p>Active</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                         <tr>
                            <td>7</td>
                            <td>Gar Delagnes</td>
                            <td>Location  SSSS</td>
                            <td>garDelanes@gmail.com</td>
                            <td>70 Amoth PlaceL</td>
                            <td>155-818-2452</td>
                            <td><div class="container">
        <img src="../assets/img/checkbox.png" alt="Image" />
        <p>Active</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                         <tr>
                            <td>8</td>
                            <td>Bartlet Rayworth</td>
                            <td>Location  FDFDF</td>
                            <td>bartletRay@gmail.com</td>
                            <td>81971 Cambridge...</td>
                            <td>957-506-4947</td>
                            <td><div class="container">
        <img src="../assets/img/checkbox.png" alt="Image" />
        <p>Active</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                         <tr>
                            <td>9</td>
                            <td>Saxe Fegres</td>
                            <td>Location  DBGD</td>
                            <td>saxeFegres@gmail.com</td>
                            <td>684 Lillign StreetL</td>
                            <td>953-181-0473</td>
                            <td><div class="container">
        <img src="../assets/img/checkbox.png" alt="Image" />
        <p>Active</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                         <tr>
                            <td>10</td>
                            <td>Lock Gillbanks</td>
                            <td>Location WWW</td>
                            <td>lockgillbank@gmail.com</td>
                            <td>1839 Rieder CircleL</td>
                            <td>584-963-2410</td>
                            <td><div class="container">
        <img src="../assets/img/checkbox.png" alt="Image" />
        <p>Active</p></div></td>
                            <td>
                            <div class="dropdown dropdown-action">
															<a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-end">
																<ul>
																	<li>
																		<a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Update</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
																	</li>
																	<li>
																		<a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
																	</li>
																	
																</ul>
															</div>
														</div>
                            </td>
                         </tr>
                        </tbody>

                    </table>

                    <div class="bottom-user-page mt-3">
                        {!! $warehouses->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>