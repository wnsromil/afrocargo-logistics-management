<x-app-layout>
    <x-slot name="header">
        {{ __('Warehouse') }}
    </x-slot>

    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.warehouses.create') }}" class="btn btn-primary buttons">
                    <img class="imgs" src="assets/images/Vector.png">
                    Add Warehouse
                </a>
            </div>
        </div>
    </div>
    </div>





    <x-slot name="cardTitle">
        <p class="head">All Warehouses</p>

        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control forms" placeholder="Search ">

                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters"
                        href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a></button>
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
                                <th>S. No.</th>
                                <th>Warehouse Name</th>
                                <th>Warehouse Code</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip Code</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($warehouses as $index => $warehouse)
                                <tr>
                                    <td>
                                        {{ ++$index }}
                                    </td>

                                    <td>{{ ucfirst($warehouse->warehouse_name ?? '') }}</td>
                                    <td><span>{{ $warehouse->warehouse_code ?? '-' }}</span></td>
                                    <td>{{ $warehouse->address ?? '-' }}</td>
                                    <td>{{ $warehouse->city->name ?? '-' }}</td>
                                    <td>{{ $warehouse->state->name ?? '-' }}</td>
                                    <td>{{ $warehouse->country->name ?? '-' }}</td>
                                    <td>{{ $warehouse->zip_code ?? '-' }}</td>
                                    <td>{{ $warehouse->phone ?? '-' }}</td>
                                    <td>
                                        @if ($warehouse->status == 'Active')
                                            <div class="container">
                                                <img src="../assets/img/checkbox.png" alt="Image" />
                                                <p>Active</p>
                                            </div>
                                        @else
                                            <div class="container">
                                                <img src="../assets/img/inactive.png" alt="Image" />
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
                                                            href="{{ route('admin.warehouses.edit', $warehouse->id) . '?page=' . request()->page ?? 1 }}"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.warehouses.show', $warehouse->id) }}"><i
                                                                class="far fa-eye me-2"></i>View</a>
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
                        {{-- <tr>
                            <td>1</td>
                            <td>Location ABC</td>
                            <td>W_ABC</td>
                            <td>8 Service JunctionL</td>
                            <td>Houston</td>
                            <td>Alaska</td>
                            <td>284</td>
                            <td>United States</td>
                            <td>228-134-8273</td>
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
                            <td>Location CSA</td>
                            <td>W_CSA</td>
                            <td>575 Hanson PlaceL</td>
                            <td>Los Angeles</td>
                            <td>Nevada</td>
                            <td>1090</td>
                            <td>United States</td>
                            <td>754-622-7485</td>
                            <td>
                                <div class="container">
                                    <img src="../assets/img/inactive.png" alt="Image" />
                                    <p>Inactive</p>
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
                            <td>3</td>
                            <td>Location QWQ</td>
                            <td>W_QWQ</td>
                            <td>3225 Parkside CircleL</td>
                            <td>San Diego</td>
                            <td>New York</td>
                            <td>212</td>
                            <td>United States</td>
                            <td>993-320-1732</td>
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
                            <td>Location TTT</td>
                            <td>W_TTT</td>
                            <td>5 Drewry AlleyL</td>
                            <td>St. Augustine</td>
                            <td>Nevada</td>
                            <td>555</td>
                            <td>United States</td>
                            <td>492-335-8599</td>
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
                            <td>Location GGG</td>
                            <td>W_GGG</td>
                            <td>223 Dgrwin StreetL</td>
                            <td>Houston</td>
                            <td>Alaska</td>
                            <td>666</td>
                            <td>United States</td>
                            <td>827-579-8393</td>
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
                            <td>Location DDD </td>
                            <td>W_DDD </td>
                            <td>64302 Artisan WayL</td>
                            <td>Los Angeles</td>
                            <td>Nevada</td>
                            <td>6565</td>
                            <td>United States</td>
                            <td>141-949-2749</td>
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
                            <td>Location SSSS</td>
                            <td>W_SSS</td>
                            <td>70 Amoth PlaceL</td>
                            <td>San Diego</td>
                            <td>New York</td>
                            <td>989</td>
                            <td>United States</td>
                            <td>155-818-2452</td>
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
                            <td>Location FDFDF</td>
                            <td>W_FDF</td>
                            <td>81971 Cambridge...</td>
                            <td>St. Augustine</td>
                            <td>Ohio</td>
                            <td>88</td>
                            <td>United States</td>
                            <td>957-506-4947</td>
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
                            <td>Location DBGD</td>
                            <td>W_DBG</td>
                            <td>684 Lillign StreetL</td>
                            <td>Houston</td>
                            <td>Washington</td>
                            <td>67</td>
                            <td>United States</td>
                            <td>953-181-0473</td>
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
                            <td>Location WWW</td>
                            <td>W_FRE</td>
                            <td>1839 Rieder CircleL</td>
                            <td>Los Angeles</td>
                            <td>Nevada</td>
                            <td>56</td>
                            <td>United States</td>
                            <td>584-963-2410</td>
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

                    </table>

                    <div class="bottom-user-page mt-3">
                        {!! $warehouses->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>