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
    @php
        $expiry = checkExpiryStatus($user->license_expiry_date, 'license_expiry_date');
    @endphp

    <section>
        <div class="row align-items-center">
            @if ($expiry && isset($expiry['message']))
                <div class="mt-2 alert alert-danger alert-dismissible fade show {{ $expiry['bg_class'] ?? '' }} {{ $expiry['text_class'] ?? '' }}"
                    role="alert">
                    {{ $expiry['message'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                                            <img id="blah" class="avatar" src="{{ asset('assets/img.png') }}" alt="license">
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
                            <h6 class="fs_20 fw_600 col00 mb-1">Contact Number</h6>
                            <p class="col3A fw_500">+{{ $user->phone_code->phonecode ?? '' }} {{ $user->phone ?? '-' }}
                            </p>
                            {{-- <p class="col3A fw_500">{{ $user->country_code_2 ?? '' }} {{ $user->phone_2 ?? '--'}}
                            </p> --}}
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
                            <h6 class="fs_20 fw_600 col00 mb-1">Office Contact Number</h6>
                            <p class="col3A fw_500">+{{ $user->phone_2_code->phonecode ?? '' }}
                                {{ $user->phone_2 ?? '-' }}
                            </p>
                            {{-- <p class="col3A fw_500">{{ $user->country_code_2 ?? '' }} {{ $user->phone_2 ?? '--'}}
                            </p> --}}
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
                            <h6 class="fs_20 fw_600 col00 mb-1">License Expiry Date</h6>
                            <p class="col3A fw_500">
                                @if ($user->license_expiry_date)
                                    {{ \Carbon\Carbon::parse($user->license_expiry_date)->format('m/d/Y') }}
                                @else
                                    --
                                @endif
                            </p>
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
                            <h6 class="fs_20 fw_600 col00 mb-1">Created At</h6>
                            <p class="col3A fw_500">
                            <p>{{ $user->created_at ? $user->created_at->format('m/d/Y') : "-"}}</p>
                            </p>
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
                                <input type="text" name="logs_datetimes" placeholder="Select Date Range"
                                    value="{{ request('logs_datetimes') }}" class="btn-filters form-control form-cs info"
                                    readonly style="background-color:white;cursor:pointer;" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Activity Type</label>
                            <select id="activityType" class="js-example-basic-single select2">
                                <option selected="selected " value="" class="form-cs">Select Category</option>
                                @foreach($types as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex justify-content-end">
                                <button type="button" id="filterButton" class="btn btn-primary padd me-3">Filter</button>
                                <button type="button" class="btn btn-outline-danger padd" id="resetButton">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-0 py-3">
                            <ol>
                                <li class="selected">
                                    <div class="row">
                                        <div id="driver-log-container"></div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            $('#resetButton').on('click', function () {
                location.reload(); // This will refresh the entire page
            });

            $(document).ready(function () {
                function fetchDriverLogs(userId, fromDate = null, toDate = null, type = null) {
                    $.ajax({
                        url: '/api/driver-logs',
                        method: 'POST',
                        data: {
                            user_id: userId,
                            from_date: fromDate,
                            to_date: toDate,
                            type: type,
                        },
                        success: function (response) {
                            $('#driver-log-container').empty();

                            if (response.status && response.data.length > 0) {
                                response.data.forEach(log => {
                                    if (log.metadata) {
                                        const metadata = JSON.parse(log.metadata);
                                        $('#driver-log-container').append(metadata.html);
                                    }
                                });
                            } else {
                                $('#driver-log-container').html('<p class="col3A fw_500 mb-4">No logs found.</p>');
                            }
                        },
                        error: function (xhr) {
                            $('#driver-log-container').html('<p class="col3A fw_500 mb-4">Error loading logs.</p>');
                            console.error('API Error:', xhr.responseText);
                        }
                    });
                }

                // Extract clean user ID from URL (without query params)
                const url = new URL(window.location.href);
                const pathnameParts = url.pathname.split('/');
                const userId = pathnameParts[pathnameParts.length - 1];

                // Initial load
                fetchDriverLogs(userId);

                // On Filter Button Click
                $('#filterButton').on('click', function () {
                    const dateRange = $('input[name="logs_datetimes"]').val();
                    const type = $('#activityType').val();

                    let fromDate = null;
                    let toDate = null;

                    if (dateRange && dateRange.includes(' - ')) {
                        const parts = dateRange.split(' - ');
                        fromDate = parts[0];
                        toDate = parts[1];
                    }

                    fetchDriverLogs(userId, fromDate, toDate, type);
                });
            });

        </script>

    @endsection
</x-app-layout>