<x-app-layout>
    <x-slot name="header">
        {{ __('Transfer to Warehouse') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Transfer to Warehouse</p>

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
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Container ID</th>
                                <th>Transfer date</th>
                                <th>Vehicle Type</th>
                                <th>Seal Number</th>
                                <th>Open Date</th>
                                <th>Close Date</th>
                                <th>No. of orders</th>
                                <th>Driver Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Status Update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicles as $index => $vehicle)
                                                        <tr>
                                                            <td>{{ $vehicle->unique_id ?? "-" }}</td>
                                                            <td>---</td>
                                                            <td>{{ $vehicle->vehicle_type ?? "-" }}</td>
                                                            <td>{{ $vehicle->seal_no ?? "-" }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($vehicle->open_date)->format('m-d-Y') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($vehicle->close_date)->format('m-d-Y') }}</td>
                                                            <td>{{$vehicle->parcelsCount->first()->count ?? 0}}</td>
                                                            <td>{{ $vehicle->driver->name ?? "-" }}</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="row fw-medium">Partial: </div>
                                                                        <div class="row">Due: </div>
                                                                        <div class="row">Total: </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="row"> ${{ $vehicle->partial_payment_sum ?? '0' }}</div>
                                                                        <div class="row"> ${{ $vehicle->remaining_payment_sum ?? '0' }}</div>
                                                                        <div class="row"> ${{ $vehicle->total_amount_sum ?? '0' }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @php
                                                                $status = $vehicle->containerStatus->status ?? null;

                                                                $classValue = match ($status) {
                                                                    'Ready to transfer' => 'badge-ready_to_transfer',
                                                                    'Transfer to Hub' => 'badge-transfer_to_hub',
                                                                    'In transit' => 'badge-in-transit',
                                                                    default => 'badge-pending',
                                                                };
                                                            @endphp

                                                            <td>
                                                                <label class="{{ $classValue }}" for="status">
                                                                    {{ $status ?? '-' }}
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <li class="nav-item dropdown">
                                                                    <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                                                        data-bs-toggle="dropdown">

                                                                        <span class="user-content"
                                                                            style="background-color:#203A5F;border-radius:5px;width: 30px;
                                                                                                               height: 26px;align-content: center;">
                                                                            <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                                                                        </span>
                                                                    </a>
                                                                    <div class="dropdown-menu menu-drop-user">
                                                                        <div class="profilemenu">
                                                                            <div class="subscription-menu">
                                                                                <ul>

                                                                                    <li>
                                                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#deliveryman_modal">Transfer to Hub</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </td>
                                                            <td class="d-flex align-items-center">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul>
                                                                            <li>
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('admin.hubs.show', $vehicle->id) }}"><i
                                                                                        class="far fa-eye me-2"></i>View Parcels</a>
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
                    {!! $vehicles->links('pagination::bootstrap-5') !!}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>