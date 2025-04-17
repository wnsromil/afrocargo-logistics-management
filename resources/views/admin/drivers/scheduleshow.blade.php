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

    <div class="d-flex justify-content-between w-100 mt-n4">
        <p class="subhead login-logo-font fw-semibold">Weekly Schedule</p>
        <a class="btn update btn-primary" href="{{ route('admin.drivers.schedule', $user->id) }}"><i class="ti ti-edit"></i> Update
            Schedule</a>
    </div>
    <section>
        <div class="row align-items-center">
            <div class="timePickersSLots">
                <div class="col-md-12 mt-4">
                    <div class="d-flex flex-wrap">
                        <div class="col-md-2">
                            <button type="button" class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Days</button>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button" class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Morning</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Afternoon</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Evening</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap mt-3">
                    <div class="col-md-2 text-dark">
                        <span class="day pointernone">Monday</span>
                    </div>
                    <div class="col-md-10 ps-sm-0 monday">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">01:00 PM - 04:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">06:00 PM - 09:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap mt-2">
                    <div class="col-md-2 text-dark">
                        <span class="day pointernone">Tuesday</span>
                    </div>
                    <div class="col-md-10 ps-sm-0 tuesday">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap mt-2">
                    <div class="col-md-2 text-dark">
                        <span class="day pointernone">Wednesday</span>
                    </div>
                    <div class="col-md-10 ps-sm-0 wednesday">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap mt-2">
                    <div class="col-md-2 text-dark">
                        <span class="day pointernone">Thursday</span>
                    </div>
                    <div class="col-md-10 ps-sm-0 thursday">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap mt-2">
                    <div class="col-md-2 text-dark">
                        <span class="day pointernone">Friday</span>
                    </div>
                    <div class="col-md-10 ps-sm-0 friday">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap mt-2">
                    <div class="col-md-2 text-dark">
                        <span class="day pointernone">Saturday</span>
                    </div>
                    <div class="col-md-10 ps-sm-0 saturday">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap mt-2">
                    <div class="col-md-2 text-dark">
                        <span class="day pointernone">Sunday</span>
                    </div>
                    <div class="col-md-10 ps-sm-0 sunday">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                            <div class="col-md-3">
                                <p class="timedata">09:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4 pt-2 border-top">
                <p class="subhead login-logo-font fw-semibold">Availability</p>
            </div>
            <div class="col-md-12 mt-4">
                <div class="row row-cols-1 row-cols-md-5 justify-content-between">
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Date</p>
                        <p class="col3A">04-12-2025</p>
                    </div>
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Location</p>
                        <p class="col3A">San Andreas</p>
                    </div>
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Morning Availability</p>
                        <p class="text-success text-center"><i class="fs_24 ti ti-square-rounded-check"></i></p>
                    </div>
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Afternoon Availability</p>
                        <p class="text-success text-center"><i class="fs_24 ti ti-square-rounded-check"></i></p>
                    </div>
                    <div class="col">
                        <p class="fw_600 col3A mb-2">Evening Availability</p>
                        <p class="text-danger text-center"><i class="fs_24 ti ti-square-rounded-x"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
