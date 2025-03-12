<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <!-- <x-slot name="cardTitle">
        All Parcels

        <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{route('admin.OrderShipment.create')}}" class="btn btn-primary">
                        Add Parcel
                    </a>
                </div>
            </div>
        </div>
    </x-slot> -->
    <x-slot name="cardTitle" >
     <p class="head">Received by Warehouse</p> 
       <div class="usersearch d-flex">
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
                            <tr >
                                <th>Sn no.</th>
                                <th>Tracking Number</th>
                                <th>Transfer Date</th>
                                <th>Driver Name</th>
                                <th>Vehicle Type</th>
                                <th>Seal number</th>
                                <th>Number of orders</th>
                                <th>Open Date</th>
                                <th>Close Date</th>
                                <th>From Warehouse</th>
                                <th>To Warehouse</th>
                                <th>Total Quantity</th>
                                <th>Payment Status</th>
                                <th>Payment Mode</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Status Update</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
