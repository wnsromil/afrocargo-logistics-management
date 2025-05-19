<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Received Orders</p>
        <div class="usersearch d-flex usersserach">
            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control forms" placeholder="Search ">
                </form>
            </div>

            <div class="mt-2">
                <button type="button"
                    class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                    <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                        <span><i class="fe fe-refresh-ccw"></i></span>
                    </a>
                </button>
            </div>
        </div>

    </x-slot>


    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive table-body">
                    <table class="table table-stripped table-hover datatable table-body">
                        <thead class="thead-light">
                            <tr class="no-border">
                                <th>S. No.</th>
                                <th>Tracking ID</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Transfer Date</th>
                                <th>Capture Image</th>
                                <th>Amount</th>
                                <th>Vehicle Number</th>
                                <th>No. of orders</th>
                                <th>Driver Name</th>
                                <th>Estimate Cost</th>
                                <th>Payment Status</th>
                                <th>Payment Mode</th>
                                <th>Item List</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-body">
                            <tr>
                                <td class="text-center">1</td>
                                <td>WE97078890</td>
                                <td>
                                    <div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="td"><i class="me-2 ti ti-user"></i>Lokesh B S</div>
                                            </div>
                                            <div class="row">
                                                <div class="td"><i class="me-2 ti ti-phone"></i>09513145995</div>
                                            </div>
                                            <div class="row">
                                                <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                <p class="ellipseText">No 295, opp.shalini ground,10th main, 39th C Cross Road, 5th Block..</p></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="td"><i class="me-2 ti ti-user"></i>Markham</div>
                                            </div>
                                            <div class="row">
                                                <div class="td"><i class="me-2 ti ti-phone"></i>09513145991</div>
                                            </div>
                                            <div class="row">
                                                <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                    <p>No 295, opp.shalini ground,10th main, 39th C Cross Road, 5th Block...</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>12-12-2024</td>
                                <td class="img-size">
                                    <img src="{{asset('assets/img/Rectangle 25.png')}}" alt="Picture.png">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Parcial:<span class="opacity-75 ps-1">$350</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Due:<span class="opacity-75 ps-1">$100</span></div>
                                    <div class="d-flex justify-content-between fw-medium td-color">
                                        Total:<span class="opacity-75 ps-1">$450</span></div>
                                </td>
                                <td>2E 5777</td>
                                <td>55</td>
                                <td>Jelene Largan</td>
                                <td class="text-center">$25</td>
                                <td class="text-center"><span
                                        class="bg-danger-subtle text-danger px-2 py-1 rounded fw-medium">Unpaid</span>
                                </td>


                                <td class="fw-semibold">Cash</td>
                                <td>Books, Electronics...</td>
                                <td>
                                    <span class="bg-set px-3 px-2 py-1 fw-medium rounded">
                                        Received By Warehouse
                                    </span>
                                </td>

                                <td class="btntext">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <button type="button" class="btn btn-primary align-center orderbutton new    rounded-1"
                                                style="height:26px; width:36px;">
                                                <i class="fa fa-angle-down tooltipped fs-6 fw-1"
                                                    data-position="top" data-tooltip="fa fa-angle-down"></i>
                                            </button></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Delivery Man Assign</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#">Self Pickup</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        </tbody>


                        <!-- ------------------------------------------------------------------------------- -->
                        <!-- <tbody>
                            @forelse ($parcels as $index => $parcel)
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
                            @endforelse
                        </tbody> -->

                        <!-- ------------------------------------------------------------------------------- -->

                    </table>
                </div>

                <div class="bottom-user-page mt-3">
                    {!! $parcels->links('pagination::bootstrap-5') !!}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>