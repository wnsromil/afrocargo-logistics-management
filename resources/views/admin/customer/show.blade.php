<x-app-layout>
    @section('style')
    <style>
        .card.mainCardGlobal:before {
            display: none;
        }

    </style>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Detail') }}
        </h2>
    </x-slot>
    @section('content')
    <div class="content-page-header mb-4">
        <h5 class="setting-menu">User Detail</h5>
    </div>
    @endsection
    <div class="customerhead">
        <div class="d-flex align-items-center position-relative">
            <div>

                @if ($user->profile_pic)
                <img class="profileImg" src="{{ ($user->profile_pic) }}" alt="license">

                @else
                <p> - No Image</p>
                @endif
            </div>
            <div class="ms-4">
                <div>
                    <p style="font-size=22px;font-weight:600px;color:#000000">{{ $user->name }}</p>
                    <p style="font-size=14px;font-weight:500px; color:#3A3A3A">{{ $user->last_name }}</p>
                    <p style="font-size=14px;font-weight:500px; color:#3A3A3A">{{ $user->email }}</p>
                </div>
            </div>
            <div style="margin-left:auto">
                <a href="{{ route('admin.customer.edit', $user->id) }}" class="btn btn-primary buttons">
                    <img class="imgs" src="{{ asset('assets/img/Vector (9).png')}}">
                    Update Customer
                </a>
            </div>
        </div>
    </div>





    <div class="row customerbody">
        <div class="col-4 customerr">
            <p class="phead">Phone Numbers</p>
            <p class="pdata">{{ $user->country_code ?? '' }} {{ $user->phone ?? '-' }}</p>
            <p class="pdata">{{ $user->country_code_2 ?? '' }} {{ $user->phone_2 ?? '-' }}</p>
        </div>
        <div class="col-4 customerr">
            <p class="phead">Address</p>
            <p class="pdata">{{ $user->address ?? '-' }}</p>
            <p class="pdata">{{ $user->address_2 ?? '-' }}</p>
        </div>
        <div class="col-4 customerr">
            <p class="phead">Latitude & Longitude</p>
            <p class="pdata">{{ $user->latitude ?? '-' }}, {{ $user->longitude ?? '-' }}</p>
        </div>
    </div>



    <div class="row">
        <div class="col-4 customerr">
            <p class="phead">Warehouse</p>
            <p class="pdata">{{ $user->warehouse->warehouse_name ?? '-' }}</p>
        </div>
        <div class="col-4 customerr">
            <p class="phead">Group Container</p>
            <p class="pdata">{{ $user->vehicle->container_no_1 ?? '-' }}</p>
        </div>
        <div class="col-4 customerr">
            <p class="phead">Company Name</p>
            <p class="pdata">{{ $user->company_name ?? '-' }}.</p>
        </div>
    </div>


    <div class="row">
        <div class="col-4 customerr">
            <p class="phead">Website</p>
            <p class="pdata">{{ $user->website_url ?? '-' }}</p>
        </div>
        <div class="col-4 customerr">
            <p class="phead">Signature Date</p>
            <p class="pdata">
                {{ $user->signature_date ? \Carbon\Carbon::parse($user->signature_date)->format('d-m-Y') : '-' }}
            </p>
        </div>
        <div class="col-4 customerr">
            <p class="phead">year to Date</p>
            <p class="pdata">{{ $user->year_to_date ?? '-' }}</p>
        </div>
    </div>


    <div class="row">
        <div class="col-4 customerr">
            <p class="phead">License ID</p>
            <p>{{ $user->license_number ?? '-' }}</p>
        </div>
        <div class="col-4 customerr">
            <p class="phead">Lic Expired Date</p>
            <p class="pdata">
                {{ $user->license_expiry_date ? \Carbon\Carbon::parse($user->license_expiry_date)->format('d-m-Y') : '-' }}
            </p>
        </div>
        <div class="col-4 customerr">
            <p class="phead">Language</p>
            <p class="pdata">{{ $user->language ?? '-' }}</p>
        </div>
    </div>


    <div class="row">
        <div class="col-6 customerr">
            <p class="phead">Write Comment</p>
            <p class="pdata">{{ $user->write_comment ?? '-' }}
            </p>
        </div>
        <div class="col-6 customerr">
            <p class="phead">Read Comment</p>
            <p class="pdata">{{ $user->read_comment ?? '-' }}
            </p>
        </div>
    </div>


    <div class="row">


        <div class="col-4">
            <div class="d-flex align-items-center">
                <p class="phead" style="margin-bottom: 0;">Signature </p>
                @if ($user->signature_img)
                <img src="{{ asset('storage/' . $user->signature_img) }}" alt="license" style="margin-left: 15px; max-width: 150px;">
                @else
                <p> - No Image</p>
                @endif

            </div>
        </div>

        <div class="col-4">
            <div class="d-flex align-items-center">
                <p class="phead" style="margin-bottom: 0;">Contract Signature </p>
                @if ($user->signature_img)
                <img src="{{ asset('storage/' . $user->contract_signature_img) }}" alt="license" style="margin-left: 15px; max-width: 150px;">
                @else
                <p> - No Image</p>
                @endif
            </div>
        </div>


        <div class="col-4">
            <div class="d-flex align-items-center">
                <p class="phead" style="margin-bottom: 0;">Licence Picture </p>
                @if ($user->license_document)
                <img src="{{ asset('storage/' . $user->license_document) }}" alt="license" style="margin-left: 15px; max-width: 150px;">
                @else
                <p> - No Image</p>
                @endif
            </div>
        </div>



    </div>





</x-app-layout>
