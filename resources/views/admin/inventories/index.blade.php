<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>


    <!-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="#" class="btn btn-primary buttons">
                    <img class="imgs" src="assets/images/Vector.png">  
                    Add Inventory
                    </a>
                </div>
            </div>
        </div>
     -->




    <x-slot name="cardTitle">
        <p class="head">All Inventory</p>

        <div class="usersearch d-flex">
            <div class="top-nav-search top-search">
                <form>
                    <input type="text" class="form-control forms-input" placeholder="Search ">
                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser">
                    <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Refresh"><span><i
                                class="fe fe-refresh-ccw"></i></span></a></button>
            </div>
        </div>

    </x-slot>
    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{route('admin.inventories.create')}}" class="btn btn-primary buttons"
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

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Sn no.</th>
                                <th>Inventory Name</th>
                                <th>Warehouse Name</th>
                                <th>Weight (kg)</th>
                                <th>Width(m)</th>
                                <th>height(m)</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Low Stock Warning</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                        <tr class="bg-success-bg">
                            <td>1</td>
                            <td>Barrel</td>
                            <td>Location ABC</td>
                            <td>15</td>
                            <td>5</td>
                            <td>10</td>
                            <td>1200</td>
                            <td>$25</td>
                            <td>20</td>
                            <td>12/5/2025</td>
                            <td><span class="bg-light text-success px-2 py-1 stock-font fw-medium">In Stock</span></td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>
                        </tr>

                        <tr class="bg-danger-bg">
                            <td>2</td>
                            <td>Bag</td>
                            <td>Location CSA</td>
                            <td>20</td>
                            <td>8</td>
                            <td>15</td>
                            <td>500</td>
                            <td>$500</td>
                            <td>45</td>
                            <td>12/12/2025</td>
                            <td><span class="bg-light text-danger px-2 py-1 stock-font fw-medium">Out Of Stock</span>
                            </td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>
                        </tr>

                        <tr class="bg-warning-bg">
                            <td>3</td>
                            <td>Bottel</td>
                            <td>Location QWQ</td>
                            <td>5</td>
                            <td>2</td>
                            <td>5</td>
                            <td>78555</td>
                            <td>$120</td>
                            <td>85</td>
                            <td>12/5/2025</td>
                            <td><span class="bg-light text-warning px-2 py-1 stock-font fw-medium">Low Stock</span></td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>

                        </tr>
                        <tr class="bg-success-bg">
                            <td>4</td>
                            <td>Cartel</td>
                            <td>Location TTT</td>
                            <td>0.5</td>
                            <td>0.2</td>
                            <td>1</td>
                            <td>9855</td>
                            <td>$75</td>
                            <td>55</td>
                            <td>12/12/2024</td>
                            <td><span class="bg-light text-success px-2 py-1 stock-font fw-medium">In Stock</span></td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>
                        </tr>

                        <tr class="bg-danger-bg">
                            <td>5</td>
                            <td>Barrel</td>
                            <td>Location GGG</td>
                            <td>14</td>
                            <td>6</td>
                            <td>4</td>
                            <td>755</td>
                            <td>$16</td>
                            <td>12</td>
                            <td>12/5/2025</td>
                            <td><span class="bg-light text-danger px-2 py-1 stock-font fw-medium">Out Of Stock</span>
                            </td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>
                        </tr>

                        <tr class="bg-warning-bg">
                            <td>6</td>
                            <td>Bag</td>
                            <td>Location DDD</td>
                            <td>45</td>
                            <td>25</td>
                            <td>10</td>
                            <td>2223</td>
                            <td>$25</td>
                            <td>1</td>
                            <td>12/12/2024</td>
                            <td><span class="bg-light text-warning px-2 py-1 stock-font fw-medium">Low Stock</span></td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>
                        </tr>

                        <tr class="bg-success-bg">
                            <td>7</td>
                            <td>Barrel</td>
                            <td>Location SSSS</td>
                            <td>1</td>
                            <td>1</td>
                            <td>.5</td>
                            <td>777</td>
                            <td>$100</td>
                            <td>22</td>
                            <td>12/5/2025</td>
                            <td><span class="bg-light text-success px-2 py-1 stock-font fw-medium">In Stock</span></td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>
                        </tr>

                        <tr class="bg-danger-bg">
                            <td>8</td>
                            <td>Cartel</td>
                            <td>Location FDFDF</td>
                            <td>0.2</td>
                            <td>0.5</td>
                            <td>2.5</td>
                            <td>1000</td>
                            <td>$65</td>
                            <td>22</td>
                            <td>12/12/2024</td>
                            <td><span class="bg-light text-danger px-2 py-1 stock-font fw-medium">Out Of Stock</span>
                            </td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>
                        </tr>

                        <tr class="bg-warning-bg">
                            <td>9</td>
                            <td>Bottel</td>
                            <td>Location DBGD</td>
                            <td>5</td>
                            <td>2</td>
                            <td>4</td>
                            <td>5444</td>
                            <td>$22</td>
                            <td>55</td>
                            <td>12/5/2025</td>
                            <td><span class="bg-light text-warning px-2 py-1 stock-font fw-medium">Low Stock</span></td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>
                        </tr>

                        <tr class="bg-danger-bg">
                            <td>10</td>
                            <td>Barrel</td>
                            <td>Location WWW</td>
                            <td>8</td>
                            <td>7</td>
                            <td>7</td>
                            <td>988</td>
                            <td>$44</td>
                            <td>10</td>
                            <td>12/12/2024</td>
                            <td><span class="bg-light text-danger px-2 py-1 stock-font fw-medium">Out Of Stock</span>
                            </td>
                            <td><i class="fe fe-more-vertical fs-4" data-bs-toggle="tooltip"
                                    title="fe fe-more-vertical"></i></td>
                        </tr>
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


  
    </x-app-layout>