<x-app-layout>
    <x-slot name="header">
        {{ __('Warehouse Management') }}
    </x-slot>

        <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{route('admin.warehouses.create')}}" class="btn btn-primary buttons">
                    <img class="imgs" src="assets/images/Vector.png">  
                    Add Warehouse
                    </a>
                </div>
            </div>
        </div>
    </div>
    
  
    
   
  
    <x-slot name="cardTitle" >
       <p class="head">All Warehouse</p>

       <div class="usersearch d-flex">
                <div class="top-nav-search">
                    <form >
                        <input type="text" class="form-control forms" placeholder="Search ">

                    </form>
                </div>
                <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
											data-bs-placement="bottom" title="Refresh"><span><i
													class="fe fe-refresh-ccw"></i></span></a></button>
                </div>
            </div>
    </x-slot>

    <div>

        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th >Sn no.</th>
                                <th >Warehouse Name</th>
                                <th >Warehouse Code</th>
                                <th >Address</th>
                                <th >City</th>
                                <th >State</th>
                                <th >Country</th>
                                <th >Zip Code</th>
                                <th >Phone</th>
                                <th >Status</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($warehouses as $index => $warehouse)
                            <tr>
                                <td>
                                    {{ ++$index }}
                                </td>
    
                                <td>{{ ucfirst($warehouse->warehouse_name ?? '')}}</td>
                                <td><span>{{$warehouse->warehouse_code ?? '-'}}</span></td>
                                <td>{{$warehouse->address ?? '-'}}</td>
                                <td>{{$warehouse->city->name ?? '-'}}</td>
                                <td>{{$warehouse->state->name ?? '-'}}</td>
                                <td>{{$warehouse->country->name ?? '-'}}</td>
                                <td>{{$warehouse->zip_code ?? '-'}}</td>
                                <td>{{$warehouse->phone ?? '-'}}</td>
                                <td><span class="badge {{$warehouse->status=='Active' ? 'bg-success-light':'bg-danger-light'}}">{{$warehouse->status ?? '-'}}</span>
                                </td>
                                <td class="d-flex align-items-center">
                                    {{-- <a href="add-invoice.html" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> Invoice</a>  
                                    <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                            class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('admin.warehouses.edit',$warehouse->id)}}"><i class="far fa-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <!-- Delete form -->
                                                    <form action="{{ route('admin.warehouses.destroy', $warehouse->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item" onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this warehouse? This action can’t be undone! 🚀')"><i class="far fa-trash-alt me-2"></i>Delete</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="active-customers.html"><i class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="deactive-customers.html"><i class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                            </tr>
                            @endforelse

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
