<x-app-layout>
    @section('script')
        <link rel='stylesheet' href='./css/admin/select2.css' />
    @endsection
    <x-slot name="header">
        {{ __('Customer List') }}
    </x-slot>



    <x-slot name="cardTitle">


        <div class="d-flex align-items-end justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{ route('admin.customer.create') }}" class="btn btn-primary buttons">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Customer
                    </a>
                </div>
            </div>
        </div>





         <!-- <x-slot name="cardTitle">
          <div class= d-flex style="border-bottom:1px dashed #DFDFDF; width:100%">
            <p class="head">All Customers</p>
            <div class="usersearch d-flex usersserach">

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
    </div>
        </x-slot> -->
    

        <x-slot name="cardTitle">
            <div class="d-flex topnavs" >
                <p class="head">All Customers</p>
                <div class="usersearch d-flex usersserach">
                <div class="top-nav-search">
                    <form>
                    <input type="text" id="searchInput" class="form-control forms" placeholder="Search ">
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
            </div>
        </x-slot>

        
        <div id='ajexTable'>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive mt-3">

                        <table class="table tables table-stripped table-hover datatable ">
                            <thead class="thead-light">

                                <tr>
                                    <th>S. No.</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Warehouse</th>
                                    <th>Container No.</th>
                                    <th>License ID</th>
                                    <th>Phone</th>
                                    <th>Phone 2</th>
                                    <th>Address</th>
                                    <th>Address 2</th>
                                    <th style="text-align: center;">Status</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $index => $customer)
                                    <tr>
                                        <td> {{ $serialStart + $index + 1 }}</td>
                                        <td>
                                            <h2 {{-- class="table-avatar" --}}>
                                                <a href="{{ route('admin.customer.show', $customer->id) }}"
                                                    class="avatar avatar-sm me-2">
                                                    @if ($customer->profile_pic)
                                                        <img class="avatar-img rounded-circle"
                                                            src="{{ asset($customer->profile_pic) }}" alt="license">
                                                    @else
                                                        <p>No Image</p>
                                                    @endif
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ ucfirst($customer->name ?? '') }}</td>
                                        <td>{{ $customer->username ?? '' }}</td>
                                        <td>{{ $customer->email ?? '-' }}</td>
                                        <td>{{ $customer->warehouse->warehouse_name ?? '-' }}</td>
                                        <td>-</td>
                                        <td>{{ $customer->license_number ?? '-' }}</td>
                                        <td>{{ $customer->country_code ?? '' }} {{ $customer->phone ?? '-' }}</td>
                                        <td>{{ $customer->country_code_2 ?? '' }} {{ $customer->phone_2 ?? '-' }}</td>
                                        <td>{{ $customer->address ?? '-' }}</td>
                                        <td>{{ $customer->address_2 ?? '-' }}</td>
                                        <td>
                                            @if ($customer->status == 'Active')
                                                <div class="container">
                                                    <img src="{{ asset('assets/img/checkbox.png')}}" alt="Image" />
                                                    <p>Active</p>
                                                </div>
                                            @else
                                                <div class="container">
                                                    <img src="{{ asset('assets/img/inactive.png')}}" alt="Image" />
                                                    <p>Inactive</p>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.customer.edit', $customer->id) . '?page=' . request()->page ?? 1 }}"><i
                                                                    class="far fa-edit me-2"></i>Update</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.customer.show', $customer->id) }}"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">No users found.
                                        </td>
                                    </tr>
                                @endforelse
                                {{-- <tr>
                                    <td>1</td>
                                    <td><img src="../assets/img/Image (1).png" alt="userimage"></td>
                                    <td>Jelene Largan</td>
                                    <td>Jelenelargan</td>
                                    <td>jeleneLargan@gmail.com</td>
                                    <td>Cargo NYC</td>
                                    <td>001-0825</td>
                                    <td>C9876543</td>
                                    <td>
                                        <p>228-134-8273 </p>
                                        <p>148-434-8773</p>
                                    </td>
                                    <td>
                                        <p>8 Service JunctionL...</p>
                                        <p>8 Service JunctionL..</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td><img src="../assets/img/Image (2).png" alt="userimage"></td>
                                    <td>Alysig Tremblett</td>
                                    <td>TremblettAlysig</td>
                                    <td>alysing@@gmail.com</td>
                                    <td>Shipper LA</td>
                                    <td>001-0725</td>
                                    <td>F1254514</td>
                                    <td>
                                        <p>854-187-6524</p>
                                        <p>845-226-4714</p>
                                    </td>
                                    <td>
                                        <p>575 Hanson PlaeL...</p>
                                        <p>21 westside NYC 12...</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas " data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td><img src="../assets/img/Image (3).png" alt="userimage"></td>
                                    <td>Norma McLarens</td>
                                    <td>McLarensNor</td>
                                    <td>normaMcla@gmail.com</td>
                                    <td>Packers AR</td>
                                    <td>001-0625</td>
                                    <td>ZS4582146</td>
                                    <td>
                                        <p>555-969-8745</p>
                                        <p>652-414-7454</p>
                                    </td>
                                    <td>
                                        <p>2A st.clock johnson</p>
                                        <p>331, Luxe arena LA ari..</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td><img src="../assets/img/Image (4).png" alt="userimage"></td>
                                    <td>Berting Dominico</td>
                                    <td>BertingDom</td>
                                    <td>bertingDomin@gmail.com</td>
                                    <td>Movers & SA</td>
                                    <td>001-0725</td>
                                    <td>D1234567</td>
                                    <td>
                                        <p>124-187-6524</p>
                                        <p>145-226-4714</p>
                                    </td>
                                    <td>
                                        <p>175 Hanson Placel..</p>
                                        <p>231 westside NYC 12..</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td><img src="../assets/img/Image (5).png" alt="userimage"></td>
                                    <td>Amalie McLachlan</td>
                                    <td>McLachlanAmalie</td>
                                    <td>amaileMc@gmail.com</td>
                                    <td>NYC Kargo</td>
                                    <td>001-0625</td>
                                    <td>X3698542</td>
                                    <td>
                                        <p>566-134-8271</p>
                                        <p>125-434-7854</p>
                                    </td>
                                    <td>
                                        <p>88 xmas JunctionL...</p>
                                        <p>12 Service Nueway...</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td><img src="../assets/img/Image (1).png" alt="userimage"></td>
                                    <td>Peterus Simondson</td>
                                    <td>PetSimondson</td>
                                    <td>peterusSimondson@gmail.com</td>
                                    <td>Mahim Ships</td>
                                    <td>001-0725</td>
                                    <td>Y41586524</td>
                                    <td>
                                        <p>665-187-6525</p>
                                        <p>255-226-4762</p>
                                    </td>
                                    <td>
                                        <p>10B luke green Arizo...</p>
                                        <p>21 westside NYC 12...</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>7</td>
                                    <td><img src="../assets/img/Image (2).png" alt="userimage"></td>
                                    <td>Gar Delagnes</td>
                                    <td>DelagneGar </td>
                                    <td>garDelanes@gmail.com</td>
                                    <td>Port LA </td>
                                    <td>001-0825</td>
                                    <td>G5214585</td>
                                    <td>
                                        <p>115-969-8525</p>
                                        <p>312-414-7312</p>
                                    </td>
                                    <td>
                                        <p>223 Dgrwin wolf Street..</p>
                                        <p>211,Luxe arena LA ari...</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>8</td>
                                    <td><img src="../assets/img/Image (3).png" alt="userimage"></td>
                                    <td>Bartlet Rayworth</td>
                                    <td>RayworthBartlet</td>
                                    <td>bartletRay@gmail.com</td>
                                    <td>Stocks Vice</td>
                                    <td>001-0825</td>
                                    <td>Q1452846</td>
                                    <td>
                                        <p>724-187-6520</p>
                                        <p>945-226-4710</p>
                                    </td>
                                    <td>
                                        <p>81971 Cambeidge Cro...</p>
                                        <p>965 westside NYC 12...</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>9</td>
                                    <td><img src="../assets/img/Image (4).png" alt="userimage"></td>
                                    <td>Sathe Fegres</td>
                                    <td>FegSareth</td>
                                    <td>satheFegres@gmail.com</td>
                                    <td>Omni Arixo</td>
                                    <td>001-0525</td>
                                    <td>E1522224</td>
                                    <td>
                                        <p>115-969-8525</p>
                                        <p>312-414-7312</p>
                                    </td>
                                    <td>
                                        <p>20 st.clock johnson...</p>
                                        <p>684 Lillign Street jx...</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>10</td>
                                    <td><img src="../assets/img/Image (5).png" alt="userimage"></td>
                                    <td>Lock Gillbanks</td>
                                    <td>GillbanksLock</td>
                                    <td>lockgillbank@gmail.com</td>
                                    <td>NYC Kargo</td>
                                    <td>001-0625</td>
                                    <td>K6665884</td>
                                    <td>
                                        <p>724-187-6520</p>
                                        <p>945-226-4710</p>
                                    </td>
                                    <td>
                                        <p>64302 Artisan Way LA...</p>
                                        <p>1839 Rieder Circle NYC..</p>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <img src="../assets/img/checkbox.png" alt="Image" />
                                            <p>Active</p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="edit-customer.html"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="customer-details.html"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
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
                    <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example" id="pageSizeSelect">
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
                            {!! $customers->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Items Modal -->
        <div class="modal custom-modal fade" id="delete_modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body confirmationpopup">
                        <div class="form-header">
                            <p class="popupc">Do you want to delete this customer?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" data-bs-dismiss="modal"
                                        class="w-100 btn btn-outline-primary custom-btn">Cancel</button>
                                </div>
                                <div class="col-6">
                                    <!-- 🛑 Delete Button - API Call Karega -->
                                    <button type="button" class="w-100 btn btn-primary paid-continue-btn customerpopup"
                                        id="confirmDelete">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Items Modal -->
        @section('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let deleteId = null;
        
                // 🔹 Delete button click par modal open hone se pehle ID store kare
                document.querySelectorAll('[data-bs-target="#delete_modal"]').forEach(button => {
                    button.addEventListener('click', function() {
                        deleteId = this.getAttribute('data-id'); // User ID ko store kare
                        console.log("Selected ID:", deleteId); // Debug ke liye
                    });
                });
        
                // 🔹 Delete Confirm Button par API call kare
                document.getElementById('confirmDelete').addEventListener('click', function() {
                    if (deleteId) {
                        fetch(`/delete-customers/${deleteId}`, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: "Good job!",
                                        text: "Customer deleted successfully",
                                        icon: "success"
                                    });
        
                                    setTimeout(function() {
                                        location.reload(); // 2 second ke baad page refresh karega
                                    }, 2000);
        
                                } else {
                                    alert('Error: ' + data.message);
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        </script>
        @endsection
</x-app-layout>

