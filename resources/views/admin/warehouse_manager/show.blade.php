<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Warehouse Manager Details') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <h6 class=subhead>Warehouse Manager Details</h6>
    </x-slot>
    <section class="mt-4">
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Warehouse Manager Name</h6>
                    <p>{{$user->name ?? '-'}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Warehouse Name</h6>
                    <p>{{$user->warehouse->warehouse_name ?? '-'}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Email Address</h6>
                    <p>{{$user->email ?? '-'}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Contact No.</h6>
                    <p>{{ $user->country_code ?? '' }} {{$user->phone ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Address</h6>
                    <p>{{$user->address ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Status</h6>
                    @if ($user->status == 'Active')
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
        </div>
    </section>
</x-app-layout>