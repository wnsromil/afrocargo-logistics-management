<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        <div class="fw-medium cardAnalyticsSize col737">Inventory History</div>
    </x-slot>

    <div>

        <div class="card-table mt-3">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
                                <th>Inventory Type</th>
                                <th>Supply Image</th>
                                <th>Inventory Name</th>
                                <th>Warehouse Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Low Stock Warning</th>
                                <th>Date</th>
                                <th>Status</th>

                                <!-- <th>S. No.</th>
                                <th>Created By User</th>
                                <th>Inventory Name</th>
                                <th>Warehouse Name</th>
                                <th>Low stock Warning</th>
                                <th>In Stock Quantity</th>
                                <th>Status</th> -->
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @forelse ($inventories as $index => $inventory)
                                <tr style="
                                @if ($inventory->status == 'Created') background-color: #B6FFD3;
                                @elseif($inventory->status == 'Updated') background-color: #FFB5AA;
                                @else background-color: #FFD6A5;
                                @endif
                                ">
                                    <td>
                                        {{ ++$index }}
                                    </td>
                                    <td class="text-dark">{{ ucfirst($inventory->inventory_type ?? '') }} Supply</td>
                                    <td>
                                        @if (!empty($inventory->img))
                                            <img src="{{ asset($inventory->img) }}" alt="Inventory Image" width="50"
                                                height="50">
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($inventory->category->name ?? '')}}</td>

                                    <td>{{ ucfirst($inventory->warehouse->warehouse_name ?? '')}}</td>
                                    
                                    <td><span>{{$inventory->in_stock_quantity ?? '-'}}</span></td>

                                    <td class="text-dark"><span>
                                            @if (!empty($inventory->price))
                                                $
                                            @endif{{ $inventory->price ?? '-' }}
                                        </span>
                                    </td>
                                    <td><span>{{$inventory->low_stock_warning ?? '-'}}</span></td>

                                    <td>12/12/2025</td>

                                    <td><span
                                            class="badge {{$inventory->status != 'Updated' ? 'bg-success-light' : 'bg-danger-light'}} px-2 py-1 stock-font fw-medium">{{$inventory->status ?? '-'}}</span>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                                </tr>
                            @endforelse

                        </tbody>


                        <!-- ------------------------------------------------------------------------------------------- -->
                        <!-- <tbody>
                            @forelse ($inventories as $index => $inventory)
                            <tr>
                                <td>
                                    {{ ++$index }}
                                </td>
                                <td>{{ ucfirst($inventory->user->name ?? '') .' / ('. ucfirst($inventory->user->role.')' ?? '')}}</td>
                                <td>{{ ucfirst($inventory->category->name ?? '')}}</td>
                                <td>{{ ucfirst($inventory->warehouse->warehouse_name ?? '')}}</td>
                                <td><span>{{$inventory->low_stock_warning ?? '-'}}</span></td>
                                <td><span>{{$inventory->in_stock_quantity ?? '-'}}</span></td>
                                <td><span class="badge {{$inventory->status!='Updated' ? 'bg-success-light':'bg-danger-light'}}">{{$inventory->status ?? '-'}}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                            </tr>
                            @endforelse

                        </tbody> -->

                    </table>

                    <div class="bottom-user-page mt-3">
                        {!! $inventories->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>