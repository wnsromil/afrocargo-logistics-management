<x-app-layout>
    @section('style')
        <style>
            .card.mainCardGlobal:before {
                display: none;
            }

            .card.mainCardGlobal>.card-body>.page-header {
                margin-bottom: -10px !important;
            }

            .card.mainCardGlobal.mb-0 .page-header .content-page-header {
                display: none;
            }
        </style>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Schedule Availability') }}
        </h2>
    </x-slot>
    @section('content')
        <div class="content-page-header mb-4">
            <h5 class="setting-menu">Schedule Availability</h5>
        </div>
    @endsection

    {{-- <div class="d-flex justify-content-between w-100 mt-n4">
        <p class="subhead login-logo-font fw-semibold">Weekly Schedule</p>
        <a class="btn update btn-primary" href="{{ route(
    'admin.drivers.schedule',
    $availabilities[0]->user_id
) }}"><i class="ti ti-edit"></i> Update
            Schedule</a>
    </div> --}}
    <section>
        <div class="row align-items-center">
            <div class="timePickersSLots">
                <div class="col-md-12 mt-4">
                    <div class="d-flex flex-wrap">
                        <div class="col-md-2">
                            <button type="button"
                                class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Days</button>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button"
                                        class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Morning</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button"
                                        class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Afternoon</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button"
                                        class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Evening</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    $scheduleByDay = collect($weeklyschedule)->keyBy('day');
                @endphp

                @foreach($weekdays as $day)
                                    @php
                                        $schedule = $scheduleByDay->get(strtolower($day));
                                    @endphp
                                    <div class="col-md-12 d-flex flax-wrap mt-3">
                                        <div class="col-md-2 text-dark">
                                            <span class="day pointernone">{{ $day }}</span>
                                        </div>
                                        <div class="col-md-10 ps-sm-0">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p class="timedata">
                                                        {{ $schedule && $schedule->morning_start ? \Carbon\Carbon::createFromFormat('H:i:s', $schedule->morning_start)->format('h:i A') : 'NA' }}
                                                        -
                                                        {{ $schedule && $schedule->morning_end ? \Carbon\Carbon::createFromFormat('H:i:s', $schedule->morning_end)->format('h:i A') : 'NA' }}
                                                    </p>
                                                </div>

                                                <div class="col-md-3">
                                                    <p class="timedata">
                                                        {{ $schedule && $schedule->afternoon_start ? \Carbon\Carbon::createFromFormat('H:i:s', $schedule->afternoon_start)->format('h:i A') : 'NA' }}
                                                        -
                                                        {{ $schedule && $schedule->afternoon_end ? \Carbon\Carbon::createFromFormat('H:i:s', $schedule->afternoon_end)->format('h:i A') : 'NA' }}
                                                    </p>
                                                </div>

                                                <div class="col-md-3">
                                                    <p class="timedata">
                                                        {{ $schedule && $schedule->evening_start ? \Carbon\Carbon::createFromFormat('H:i:s', $schedule->evening_start)->format('h:i A') : 'NA' }}
                                                        -
                                                        {{ $schedule && $schedule->evening_end ? \Carbon\Carbon::createFromFormat('H:i:s', $schedule->evening_end)->format('h:i A') : 'NA' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                @endforeach


                @if($weeklyschedule->isEmpty())
                    <p class="mt-3">No weekly schedule available.</p>
                @endif

            </div>
            <div class="col-md-12 mt-4 pt-2 border-top">
                <p class="subhead login-logo-font fw-semibold">Availability</p>
            </div>
            <div class="col-md-12 mt-4">
                <div class="row row-cols-1 row-cols-md-5 justify-content-between">
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Date</p>
                        <p class="col3A">{{ \Carbon\Carbon::parse($availabilitie->date)->format('d-m-Y') ?? '--' }}</p>
                    </div>
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Location</p>
                        <p class="col3A">{{ $availabilitie->locationName->address ?? 'For All' }}</p>
                    </div>
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Morning Availability</p>
                        @if($availabilitie->morning == 1)
                            <p class="text-success text-center"><i class="fs_24 ti ti-square-rounded-check"></i></p>
                        @else
                            <p class="text-danger text-center"><i class="fs_24 ti ti-square-rounded-x"></i></p>
                        @endif
                    </div>
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Afternoon Availability</p>
                        @if($availabilitie->afternoon == 1)
                            <p class="text-success text-center"><i class="fs_24 ti ti-square-rounded-check"></i></p>
                        @else
                            <p class="text-danger text-center"><i class="fs_24 ti ti-square-rounded-x"></i></p>
                        @endif
                    </div>
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Evening Availability</p>
                        @if($availabilitie->evening == 1)
                            <p class="text-success text-center"><i class="fs_24 ti ti-square-rounded-check"></i></p>
                        @else
                            <p class="text-danger text-center"><i class="fs_24 ti ti-square-rounded-x"></i></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>