<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Warehouse Details') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <h6 class=subhead>Warehouse Details</h6>
    </x-slot>
    <section class="mt-4">
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Warehouse Name</h6>
                    <p>{{$warehouse->warehouse_name ?? '-'}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Warehouse Code</h6>
                    <p>{{$warehouse->warehouse_code ?? '-'}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Contact No.</h6>
                    <p>+{{ $warehouse->phone_code->phonecode ?? '' }} {{ $warehouse->phone ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Address</h6>
                    <p>{{ $warehouse->address ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Status</h6>
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
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Created At </h6>
                    <p>{{ $warehouse->created_at ? $warehouse->created_at->format('m/d/Y') : "-"}}</p>
                </div>
            </div>
    </section>
</x-app-layout>