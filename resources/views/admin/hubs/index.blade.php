<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <x-slot name="cardTitle">
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
    </x-slot>

    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Sn no.</th>
                                <th>Tracking Number</th>
                                <th>Driver Name</th>
                                <th>Vehicle</th>
                                <th>From Warehouse</th>
                                <th>To Warehouse</th>
                                <th>Total Quantity</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($parcels as $index => $parcel)
                            <tr>
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
                                                {{-- <li>
                                                    <a class="dropdown-item" href="{{ route('admin.hubs.edit', $parcel->id) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                </li> --}}
                                                {{-- <li>
                                                    <form action="{{ route('admin.OrderShipment.destroy', $parcel->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item" onclick="deleteData(this, 'Are you sure you want to remove this parcel? This action can’t be undone!')"><i class="far fa-trash-alt me-2"></i>Delete</button>
                                                    </form>
                                                </li> --}}
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
                                <td colspan="9" class="px-4 py-4 text-center text-gray-500">No data found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="bottom-user-page mt-3">
                        {!! $parcels->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
