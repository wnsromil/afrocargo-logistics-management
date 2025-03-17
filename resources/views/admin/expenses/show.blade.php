<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        All Parcel History

        {{-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{route('admin.inventories.create')}}" class="btn btn-primary">
                        Add Parcel
                    </a>
                </div>
            </div>
        </div> --}}
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
                                <th>Created By</th>
                                <th>Parcel Name</th>
                                <th>Warehouse Name</th>
                                <th>Customer</th>
                                <th>Weight (kg)</th>
                                <th>Total Amount ($)</th>
                                <th>Payment Type</th>
                                <th>Parcel Status</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ParcelHistories as $index => $ParcelHistory)
                            <tr>
                                <td>
                                    {{ ++$index }}
                                </td>
                                <td><span>{{$ParcelHistory->description->tracking_number ?? '-'}}</span></td>
                                <td>{{ ucfirst($ParcelHistory->CreatedByUser->name ?? '') .' / ('. ucfirst($ParcelHistory->CreatedByUser->role ?? '').')'}}</td>
                                <td>{{ $parcelTpyes->whereIn('id',$ParcelHistory->description->parcel_car_ids)->pluck('name')->implode(', ')}}</td>
                                <td>{{ ucfirst($ParcelHistory->warehouse->warehouse_name ?? '')}}</td>
                                <td>{{ ucfirst($ParcelHistory->customer->name ?? '') .' / ('. ucfirst($ParcelHistory->customer->role ?? '').')'}}</td>
                                <td><span>{{$ParcelHistory->description->weight ?? '-'}}</span></td>
                                <td><span>{{$ParcelHistory->description->total_amount ?? '-'}}</span></td>
                                <td><span>{{$ParcelHistory->description->payment_type ?? '-'}}</span></td>
                                <td><span class="badge-{{ activeStatusKey($ParcelHistory->parcel_status) }}">{{ $ParcelHistory->parcel_status ?? '-' }}</span></td>
                                <td><span class="badge-{{ activeStatusKey($ParcelHistory->status) }}">{{ $ParcelHistory->status ?? '-' }}</span></td>
                            <td><span>{{ $ParcelHistory->created_at->format('d/m/y') ?? '-' }}</span></td>
                                

                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No data found.</td>
                            </tr>
                            @endforelse

                        </tbody>

                    </table>
                    
                    <div class="bottom-user-page mt-3">
                        {!! $ParcelHistories->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
