<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Management') }}
    </x-slot>

    <x-slot name="cardTitle">
        All Inventory History

        {{-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{route('admin.inventories.create')}}" class="btn btn-primary">
                        Add Inventory
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
                                <th>S. No.</th>
                                <th>Created By User</th>
                                <th>Inventory Name</th>
                                <th>Warehouse Name</th>
                                <th>Low stock Warning</th>
                                <th>In Stock Quantity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
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

                        </tbody>

                    </table>
                    
                    <div class="bottom-user-page mt-3">
                        {!! $inventories->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
