<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('My Profile') }}
        </h2>
        @section('style')
        <style>
            .card.mainCardGlobal:before {
                display: none;
            }
        </style>
    @endsection
    </x-slot>
    @section('content')
    <div class="content-page-header mb-4">
        <h5 class="setting-menu">My Profile</h5>
    </div>
    @endsection
    <div class="text-end mt-n4">
        <a class="btn update btn-primary me-2" href="{{ route('profile.edit') }}"><i class="ti ti-edit"></i> Update Profile</a>
        <a href="{{ route('profile.password') }}" class="btn update btn-primary"><i class="ti ti-lock-square-rounded"></i> Change Password</a>
    </div>
    <section>
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12 my-4">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-img d-inline-flex">
                            <div class="profile-picture text-center mb-0">
                                <div class="upload-profile me-2">
                                    <div class="profile-img">
                                        @if (!empty($user->profile_pic) && is_string($user->profile_pic))
                                        <img id="blah" class="avatar" src="{{ !empty(@$user->profile_pic) ? asset(@$user->profile_pic) : asset('assets/img/profiles/avatar-10.jpg') }}" alt="profile-img">
                                        @else
                                        <img id="blah" class="avatar" src="{{  asset('assets/img/profiles/avatar-14.jpg') }}" alt="profile-img">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-3">
                                {{ @$user->name ?? '--'}} {{ @$user->last_name ?? ''}}</h6>
                                <p class="fs_14 fw_400 col00 mb-0"> {{ ucfirst(auth()->user()->role ?? '') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-4">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-img d-inline-flex">
                            <div class="iconwrapper me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                    <path d="M3 7l9 6l9 -6" /></svg>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-3">Email Address</h6>
                            <p class="col3A fw_mid">{{ $user->email ?? '--'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-4">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-img d-inline-flex">
                            <div class="iconwrapper me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-3">Phone Number</h6>
                            <p class="col3A fw_mid">{{ $user->country_code ?? '' }} {{ $user->phone ?? '--' }}</p>
                            <p class="col3A fw_mid">{{ $user->country_code_2 ?? '' }} {{ $user->phone_2 ?? '--'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-4">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-img d-inline-flex">
                            <div class="iconwrapper me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pins">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10.828 9.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" />
                                    <path d="M8 7l0 .01" />
                                    <path d="M18.828 17.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" />
                                    <path d="M16 15l0 .01" /></svg>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-3">Address</h6>
                            <p class="col3A fw_mid">{{ $user->address ?? '--' }}</p>
                            <br>
                            <p class="col3A fw_mid">{{ $user->address_2 ?? '--'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
