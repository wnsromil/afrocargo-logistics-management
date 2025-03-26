<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>


    <!-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="#" class="btn btn-primary buttons">
                    <i class="ti ti-circle-plus me-2 text-white"></i>
                    Add Inventory
                    </a>
                </div>
            </div>
        </div>
     -->
    <x-slot name="cardTitle">
        <p class="head">All Inventory</p>

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
    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.inventories.create') }}" class="btn btn-primary buttons"
                    style="background:#203A5F">
                    <img src="assets/images/Vector.png" class="pe-3">
                    Add Inventory
                </a>
            </div>
        </div>
    </div>

    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable" id="setBackground">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
                                <th>Inventory Type</th>
                                <th>Supply Image</th>
                                <th>Inventory Name</th>
                                <th>Warehouse Name</th>
                                <th>Weight (kg)</th>
                                <th>Width (m)</th>
                                <th>Height (m)</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Low Stock Warning</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- ------------------------- 1 ---------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    1
                                </td>
                                <td class="text-dark">Supply</td>
                                <!-- <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> -->
                                <td><img src="../assets/img/img2.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Barrel</td>
                                <td class="text-dark">Location ABC</td>
                                <td class="text-dark">15</td>
                                <td class="text-dark">5</td>
                                <td class="text-dark">10</td>
                                <td class="text-dark text-start">1200</td>
                                <td class="text-dark text-start">$25</td>
                                <td class="text-dark">20</td>
                                <td class="text-dark">12/5/2025</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">In
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- ---------------------- 2 ---------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    2
                                </td>
                                <td class="text-dark">Services</td>
                                <!-- <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> -->
                                <td><img src="../assets/img/img1.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Box</td>
                                <td class="text-dark">Location CSA</td>
                                <td class="text-dark">20</td>
                                <td class="text-dark">8</td>
                                <td class="text-dark">15</td>
                                <td class="text-dark text-start">500</td>
                                <td class="text-dark text-start">$500</td>
                                <td class="text-dark">45</td>
                                <td class="text-dark">12/12/2024</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">Out of
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- ----------------------- 3 --------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    3
                                </td>
                                <td class="text-dark">Supply</td>
                                <!-- <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> -->
                                <td><img src="../assets/img/img3.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Brown Tap</td>
                                <td class="text-dark">Location QWQ</td>
                                <td class="text-dark">5</td>
                                <td class="text-dark">2</td>
                                <td class="text-dark">5</td>
                                <td class="text-dark text-start">78555</td>
                                <td class="text-dark text-start">$120</td>
                                <td class="text-dark">85</td>
                                <td class="text-dark">12/5/2025</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">Low
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- ------------------------ 4 -------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    4
                                </td>
                                <td class="text-dark">Supply</td>
                                <!-- <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> -->
                                <td><img src="../assets/img/img4.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Clear Tap</td>
                                <td class="text-dark">Location TTT</td>
                                <td class="text-dark">0.5</td>
                                <td class="text-dark">0.2</td>
                                <td class="text-dark">1</td>
                                <td class="text-dark text-start">9855</td>
                                <td class="text-dark text-start">$75</td>
                                <td class="text-dark">55</td>
                                <td class="text-dark">12/12/2024</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">In
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- ------------------------ 5 --------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    5
                                </td>
                                <td class="text-dark">Supply</td>
                                <!-- <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> -->
                                <td><img src="../assets/img/img5.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Shrink Wrap</td>
                                <td class="text-dark">Location GGG</td>
                                <td class="text-dark">14</td>
                                <td class="text-dark">6</td>
                                <td class="text-dark">4</td>
                                <td class="text-dark text-start">755</td>
                                <td class="text-dark text-start">$16</td>
                                <td class="text-dark">12</td>
                                <td class="text-dark">12/5/2025</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">Out of
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- ----------------------- 6 --------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    6
                                </td>
                                <td class="text-dark">Supply</td>
                                <!-- <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> -->
                                <td><img src="../assets/img/img2.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Barrel</td>
                                <td class="text-dark">Location DDD</td>
                                <td class="text-dark">45</td>
                                <td class="text-dark">25</td>
                                <td class="text-dark">10</td>
                                <td class="text-dark text-start">2223</td>
                                <td class="text-dark text-start">$25</td>
                                <td class="text-dark">1</td>
                                <td class="text-dark">12/12/2024</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">Low
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>

                                        </ul>
                                    </div>


                                </td>
                            </tr>

                            <!-- ----------------------- 7 --------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    7
                                </td>
                                <td class="text-dark">Supply</td>
                                <!-- <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> -->
                                <td><img src="../assets/img/img1.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Box</td>
                                <td class="text-dark">Location SSSS</td>
                                <td class="text-dark">1</td>
                                <td class="text-dark">1</td>
                                <td class="text-dark">.5</td>
                                <td class="text-dark text-start">777</td>
                                <td class="text-dark text-start">$100</td>
                                <td class="text-dark">22</td>
                                <td class="text-dark">12/5/2025</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">In
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- ----------------------- 8 --------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    8
                                </td>
                                <td class="text-dark">Supply</td>
                                <!-- <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> -->
                                <td><img src="../assets/img/img3.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Brown Tap</td>
                                <td class="text-dark">Location FDFDF</td>
                                <td class="text-dark">0.2</td>
                                <td class="text-dark">0.5</td>
                                <td class="text-dark">2.5</td>
                                <td class="text-dark text-start">1000</td>
                                <td class="text-dark text-start">$65</td>
                                <td class="text-dark">22</td>
                                <td class="text-dark">12/12/2024</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">Out of
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- ----------------------- 9 --------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    9
                                </td>
                                <td class="text-dark">Services</td>
                                <!-- <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> -->
                                <td><img src="../assets/img/img4.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Clear Tap</td>
                                <td class="text-dark">Location DBGD</td>
                                <td class="text-dark">5</td>
                                <td class="text-dark">2</td>
                                <td class="text-dark">4</td>
                                <td class="text-dark text-start">5444</td>
                                <td class="text-dark text-start">$22</td>
                                <td class="text-dark">55</td>
                                <td class="text-dark">12/5/2025</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">Low
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- ----------------------- 10 --------------------------- -->
                            <tr class="text-center">
                                <td class="text-dark">
                                    10
                                </td>
                                <td class="text-dark">Supply</td>
                                <td><img src="../assets/img/img5.png" alt="Inventory Image" width="50" height="50">
                                </td>
                                <td class="text-dark">Shrink Wrap</td>
                                <td class="text-dark">Location WWW</td>
                                <td class="text-dark">8</td>
                                <td class="text-dark">7</td>
                                <td class="text-dark">7</td>
                                <td class="text-dark text-start">9988</td>
                                <td class="text-dark text-start">$44</td>
                                <td class="text-dark">10</td>
                                <td class="text-dark">12/12/2024</td>
                                <td class="text-center"><span class="font-10 px-3 px-2 py-1 rounded-1 fw-medium">Out of
                                        Stock</span>
                                </td>
                                <td>
                                    <a href="#" class=" btn-action-icon bg-transparent" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                            data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.edit'>
                                                    <i class="far fa-edit me-2"></i>Update</a>
                                            </li>
                                            <li>
                                                <form action="admin.inventories.destroy" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href='admin.inventories.show'><i
                                                        class="far fa-eye me-2"></i>View History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>


                        <!-- ------------------------------------------------------------------------------------------- -->
                        <!-- <tbody>
                        @forelse ($inventories as $inventory)
                        <tr style="
                            @if ($inventory->stock_status == 'In Stock') background-color: #B6FFD3;
                            @elseif($inventory->stock_status == 'Out of Stock') background-color: #FFB5AA;
                            @else background-color: #FFD6A5;
                            @endif
                          ">
                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>{{ ucfirst($inventory->category->name ?? '') }}</td>
                                <td>
                                    @if (!empty($inventory->img))
                                        <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                            height="50">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>{{ ucfirst($inventory->warehouse->warehouse_name ?? '') }}</td>
                                <td><span>{{ $inventory->weight ?? '-' }}</span></td>
                                <td><span>{{ $inventory->width ?? '-' }}</span></td>
                                <td><span>{{ $inventory->height ?? '-' }}</span></td>
                                <td><span>{{ $inventory->in_stock_quantity ?? '-' }}</span></td>
                                <td><span>
                                        @if (!empty($inventory->price))
                                            $
                                        @endif{{ $inventory->price ?? '-' }}
                                    </span></td>

                                <td><span>{{ $inventory->low_stock_warning ?? '-' }}</span></td>
                                <td><span>{{ $inventory->formatted_created_at ?? '-' }}</span></td>
                                <td><span
                                        class=" @if ($inventory->stock_status == 'In Stock') bg-light text-success @elseif($inventory->stock_status == 'Out Of Stock')
                                    bg-light text-danger
                                    @else
                                    bg-light text-warning @endif  px-2 py-1 stock-font fw-medium">{{ $inventory->stock_status ?? '-' }}</span>
                                </td>
                                {{-- <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                        title="fe fe-more-vertical"></i></td> --}}
                                <td class="d-flex align-items-center">
                                    {{-- <a href="add-invoice.html" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> Invoice</a>  
                                        <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                                class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fe fe-more-vertical fs-4"
                                                data-bs-toggle="tooltip" title="fe fe-more-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.inventories.edit', $inventory->id) }}"><i
                                                            class="far fa-edit me-2"></i>Edit</a>
                                                </li>
                                                {{-- <li>

                                                    <form
                                                        action="{{ route('admin.inventories.destroy', $inventory->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item"
                                                            onclick="deleteData(this,'Wait! 🤔 Are you sure you want to remove this inventory? This action can’t be undone! 🚀')"><i
                                                                class="far fa-trash-alt me-2"></i>Delete</button>
                                                    </form>
                                                </li> --}}
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.inventories.show', $inventory->id) }}"><i
                                                            class="far fa-eye me-2"></i>View History</a>
                                                </li>
                                                {{-- <li>
                                                        <a class="dropdown-item" href="active-customers.html"><i class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="deactive-customers.html"><i class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                    </li> --}}
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No inventories found.
                                </td>
                            </tr>
                        @endforelse

                        </tbody> -->
                    </table>
                </div>
            </div>
        </div>


        <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">

            <div class="col-md-6 d-flex p-2 align-items-center">
                <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
                <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example">
                    <option selected>10</option>
                    <option value="1">5</option>
                    <option value="2">10</option>
                    <option value="3">15</option>
                </select>
                <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
            </div>

            <div class="col-md-6">
                <div class="float-end">
                    <button class="btn button-border">
                        <i class="fa fa-angle-left tooltipped" data-position="top" data-tooltip="fa fa-angle-left"></i>
                    </button>
                    <button class="btn paginate_button page-item button-border active" type="button"
                        data-bs-toggle="button">1</button>
                    <button class="btn button-border">2</button>
                    <button class="btn button-border" type="button">3</button>
                    <button class="btn button-border" type="button">4</button>
                    <button class="btn button-border" type="button">5</button>


                    <button class="btn button-border">
                        <i class="fa fa-angle-right tooltipped" data-position="top"
                            data-tooltip="fa fa-angle-right"></i>
                    </button>
                    <!--   <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a></li> -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("#setBackground tbody tr").forEach(row => {
                // Get the text content of the <span> element inside the 13th <td> (index 12)
                let back = row.cells[12].querySelector('span').innerText.trim();

                // Apply background color to the <tr> based on stock status
                if (back === 'Low Stock' || back === 'low stock') {
                    row.classList.add('bg-warning-bg');
                    row.cells[12].querySelector('span').classList.add('bg-set4');  // Apply bg-set4 to the <span> as well
                } else if (back === 'Out of Stock' || back === 'out of stock') {
                    row.classList.add('bg-danger-bg');
                    row.cells[12].querySelector('span').classList.add('bg-set3');  // Apply bg-set3 to the <span> as well
                } else if (back === 'In Stock' || back === 'in stock') {
                    row.classList.add('bg-success-bg');
                    row.cells[12].querySelector('span').classList.add('bg-set2');  // Apply bg-set2 to the <span> as well
                }
            });
        });
    </script>
</x-app-layout>