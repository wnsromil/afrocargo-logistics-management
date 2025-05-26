<x-app-layout>
    @section('style')
        <style>
            .card.mainCardGlobal:before {
                display: none;
            }

            .card.mainCardGlobal>.card-body>.page-header {
                margin-bottom: -10px !important;
            }
        </style>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Driver Details') }}
        </h2>
    </x-slot>
    @section('content')
        <div class="content-page-header mb-4">
            <h5 class="setting-menu">Driver Details</h5>
        </div>
    @endsection

    <div class="text-end mt-n4">
        <a class="btn update btn-primary me-2" href="{{ route('admin.drivers.edit', $user->id) }}"><i
                class="ti ti-edit"></i> Update
            Driver</a>
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
                                        @if ($user->profile_pic)
                                            <img id="blah" class="avatar" src="{{ ($user->profile_pic) }}" alt="license">
                                        @else
                                            <p> - No Image</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-1">{{$user->name ?? "--"}}</h6>
                            <p class="col3A fw_500">Driver</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-4">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-img d-inline-flex">
                            <div class="iconwrapper me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                    <path d="M3 7l9 6l9 -6" />
                                </svg>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-1">Email Address</h6>
                            <p class="col3A fw_500">{{ $user->email ?? '--'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-4">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-img d-inline-flex">
                            <div class="iconwrapper me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                </svg>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-1">Phone Number</h6>
                            <p class="col3A fw_500">{{ $user->country_code ?? '' }} {{ $user->phone ?? '--' }}</p>
                            {{-- <p class="col3A fw_500">{{ $user->country_code_2 ?? '' }} {{ $user->phone_2 ?? '--'}}</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-4">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-img d-inline-flex">
                            <div class="iconwrapper me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-map-pins">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10.828 9.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" />
                                    <path d="M8 7l0 .01" />
                                    <path d="M18.828 17.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" />
                                    <path d="M16 15l0 .01" />
                                </svg>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-1">Address</h6>
                            <p class="col3A fw_500">{{ $user->address ?? '--' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-4">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-img d-inline-flex">
                            <div class="profile-picture text-center mb-0">
                                <div class="upload-profile me-2">
                                    <div class="profile-img">
                                        @if ($user->license_document)
                                            <img id="blah" style="max-width: 150px;"
                                                src="{{ asset('' . $user->license_document) }}" alt="license">
                                        @else
                                            <p> - No Image</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-1">License image</h6>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12 my-4">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-img d-inline-flex">
                            <div class="iconwrapper me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-id">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                    <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M15 8l2 0" />
                                    <path d="M15 12l2 0" />
                                    <path d="M7 16l10 0" />
                                </svg>
                            </div>
                        </span>
                        <div class="customer-details-cont">
                            <h6 class="fs_20 fw_600 col00 mb-1">License No.</h6>
                            <p class="col3A fw_500">{{ $user->license_number ?? '--'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @section('bottomContent')
        <div class="card mainCardGlobal my-4">
            <div class="card-body">
                <h5 class="textSize col3a mb-4">Activity Logs</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label>By Date</label>
                            <div class="daterangepicker-wrap mannual cal-icon cal-icon-info">
                                <input type="text" class="btn-filters form-control form-cs info" name="datetimes"
                                    placeholder="From Date - To Date" />
                            </div>
                        </div>

                        <div class="col-md-4">

                            <label>Activity Type</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected " class="form-cs">Select Category</option>
                                <option>Category 1</option>
                                <option>Category 2</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary padd me-3">Filter</button>
                                <button class="btn btn-outline-danger padd">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        {{-- <div class="cd-horizontal-timeline mannuallyCSS type2">
                            <div class="timeline w-100">
                                <div class="events-wrapper">
                                    <div class="events">
                                        <ol>
                                            <li>
                                                <a href="#0" data-date="16/01/2014" class="selected">
                                                    <p class="smfont">12-12-2024</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#0" data-date="17/01/2014">
                                                    <p class="smfont">12-13-2024</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#0" data-date="18/01/2014">
                                                    <p class="smfont">12-15-2024</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#0" data-date="19/01/2014">
                                                    <p class="smfont">12-16-2024</p>
                                                </a>
                                            </li>
                                        </ol>
                                        <span class="filling-line" aria-hidden="true"></span>
                                    </div>
                                    <!-- events -->
                                </div>
                                <ul class="cd-timeline-navigation">
                                    <li><a href="#0" class="prev inactive">Prev</a></li>
                                    <li><a href="#0" class="next">Next</a></li>
                                </ul>
                                <!-- cd-timeline-navigation -->
                            </div>
                            <!-- timeline -->
                            <div class="events-content">
                                <ol>
                                    <li class="selected" data-date="16/01/2014">
                                        1 sss
                                    </li>
                                    <li class="selected" data-date="17/01/2014">
                                        2sss
                                    </li>
                                    <li class="selected" data-date="18/01/2014">
                                        3 sss
                                    </li>
                                    <li class="selected" data-date="19/01/2014">
                                        4sss
                                    </li>
                                </ol>
                            </div>
                            <!-- timeline -->
                        </div> --}}

                        <div class="cd-horizontal-timeline two mannuallyCSS type2">
                            <div class="timeline w-100">
                                <div class="events-wrapper">
                                    <div class="events">
                                        <ol>
                                            <li><a href="#0" data-date="16/01/2014" class="selected">16 Jan</a>
                                            </li>
                                            <li><a href="#0" data-date="28/02/2014">28 Feb</a></li>
                                            <li><a href="#0" data-date="20/04/2014">20 Mar</a></li>
                                            <li><a href="#0" data-date="20/05/2014">20 May</a></li>
                                        </ol>
                                        <span class="filling-line" aria-hidden="true"></span>
                                    </div>
                                    <!-- events -->
                                </div>
                                <ul class="cd-timeline-navigation">
                                    <li><a href="#0" class="prev inactive">Prev</a></li>
                                    <li><a href="#0" class="next">Next</a></li>
                                </ul>
                                <!-- cd-timeline-navigation -->
                            </div>
                            <!-- timeline -->
                            <div class="events-content mt-0 py-3">
                                <ol>
                                    <li class="selected" data-date="16/01/2014">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">08:45 AM — <label
                                                                        class="col00 mb-0">Login</label></p>
                                                                <p class="col737 fs_18 fw_500">Status — <label
                                                                        class="col00 mb-0">Successful</label></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">10:15 AM — <label
                                                                        class="col00 mb-0">Customer Added</label></p>
                                                                <p class="col737 fs_18 fw_500">Customer Name: — <label
                                                                        class="col00 mb-0">Acme Corp</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-primary smbtn me-2">View</button>
                                                            <button class="btn btn-danger smbtn">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">10:15 AM — <label
                                                                        class="col00 mb-0">Order Pickup Scheduled</label>
                                                                </p>
                                                                <p class="col737 fs_18 fw_500">Tracking ID: — <label
                                                                        class="col00 mb-0">WE97078893</label></p>
                                                                <p class="col737 fs_18 fw_500">Pickup Date: — <label
                                                                        class="col00 mb-0">02-15-2025</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-primary smbtn me-2">View</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li data-date="28/02/2014">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">02:00 PM — <label
                                                                        class="col00 mb-0">Payment Collected</label></p>
                                                                <p class="col737 fs_18 fw_500">Amount — <label
                                                                        class="col00 mb-0">$500</label></p>
                                                                <p class="col737 fs_18 fw_500">Mode — <label
                                                                        class="col00 mb-0">Cash</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-primary smbtn me-2">View</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">03:45 PM — <label
                                                                        class="col00 mb-0">Customer Deleted</label></p>
                                                                <p class="col737 fs_18 fw_500">Customer Name: — <label
                                                                        class="col00 mb-0">Acme Corp</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-danger smbtn me-2">Delete</button>
                                                            <button class="btn btn-success smbtn">Restore</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">04:30 PM — <label
                                                                        class="col00 mb-0">Invoice Deleted</label></p>
                                                                <p class="col737 fs_18 fw_500">Invoice ID: — <label
                                                                        class="col00 mb-0"> INV-12345</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-primary smbtn me-2">View</button>
                                                            <button class="btn btn-success smbtn">Restore</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li data-date="20/04/2014">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">02:00 PM — <label
                                                                        class="col00 mb-0">Payment Collected</label></p>
                                                                <p class="col737 fs_18 fw_500">Amount — <label
                                                                        class="col00 mb-0">$500</label></p>
                                                                <p class="col737 fs_18 fw_500">Mode — <label
                                                                        class="col00 mb-0">Cash</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-primary smbtn me-2">View</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">03:45 PM — <label
                                                                        class="col00 mb-0">Customer Deleted</label></p>
                                                                <p class="col737 fs_18 fw_500">Customer Name: — <label
                                                                        class="col00 mb-0">Acme Corp</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-danger smbtn me-2">Delete</button>
                                                            <button class="btn btn-success smbtn">Restore</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">04:30 PM — <label
                                                                        class="col00 mb-0">Invoice Deleted</label></p>
                                                                <p class="col737 fs_18 fw_500">Invoice ID: — <label
                                                                        class="col00 mb-0"> INV-12345</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-primary smbtn me-2">View</button>
                                                            <button class="btn btn-success smbtn">Restore</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li data-date="20/05/2014">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">08:45 AM — <label
                                                                        class="col00 mb-0">Login</label></p>
                                                                <p class="col737 fs_18 fw_500">Status — <label
                                                                        class="col00 mb-0">Successful</label></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">10:15 AM — <label
                                                                        class="col00 mb-0">Customer Added</label></p>
                                                                <p class="col737 fs_18 fw_500">Customer Name: — <label
                                                                        class="col00 mb-0">Acme Corp</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-primary smbtn me-2">View</button>
                                                            <button class="btn btn-danger smbtn">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card activityCard">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <i class="ti ti-clock-filled"></i>
                                                            <div>
                                                                <p class="col737 fs_18 fw_500">10:15 AM — <label
                                                                        class="col00 mb-0">Order Pickup Scheduled</label>
                                                                </p>
                                                                <p class="col737 fs_18 fw_500">Tracking ID: — <label
                                                                        class="col00 mb-0">WE97078893</label></p>
                                                                <p class="col737 fs_18 fw_500">Pickup Date: — <label
                                                                        class="col00 mb-0">02-15-2025</label></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <button class="btn btn-primary smbtn me-2">View</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                            <!-- .events-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>