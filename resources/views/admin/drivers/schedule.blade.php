<x-app-layout>
    <x-slot name="header">
        Drivers Management
    </x-slot>
    <style>
        .text-checkbox {
            color: black;
        }

        .btn-size {
            width: auto;
            height: 26px;
        }

        .input.form-control.inp::placeholder {
            font-size: 8px !important;
            font-weight: 400;
        }

        .content-page-header {
            margin-top: -5px;
            justify-content: normal;
        }
    </style>
    <x-slot name="cardTitle">
        <p class="subhead login-logo-font fw-semibold me-sm-5">Add Schedule</p>

        <div class="row mt-0 mb-2">
            <div class="d-block">
                <div class="d-flex text-center authTabDiv">
                    <div id="click"></div>
                    <button id="locationbtn" type="button"
                        class="btnBorder th-font fw-semiBold ms-0 me-3 p-1 activity-feed"
                        onclick="driverscheduleform('location')">Location</button>

                    <button id="availabilitybtn" type="button"
                        class="btnBorder th-font fw-semiBold ms-0 me-3 p-1 activity-feed"
                        onclick="driverscheduleform('availability')">Availability</button>

                    <button id="weeklybtn" type="button" class="btnBorder th-font fw-semiBold p-1 activity-feed"
                        onclick="driverscheduleform('weekly')">Weekly Schedule</button>

                </div>
            </div>
        </div>
    </x-slot>
    <!-- ------------------------------------------------------------------------------ -->

    <form method="POST" action="{{ route('admin.schedule.locationstore') }}" enctype="multipart/form-data">
        @csrf
        <div id="location" style="display: none;">
            <div class="d-flex flex-wrap justify-content-end">
                <div class="col-md-12">
                    <div class="d-flex gap-3">

                        <div class="col-md-8">
                            <div class="col-md-6">
                                <label for="LacationInput1" class="form-label">Enter Location</label>
                                <input type="text" class="form-control address" id="LacationInput1"
                                    placeholder="Location" name="schedule_location"
                                    value="{{ old('schedule_location') ?? ($locationschedule->isNotEmpty() ? $locationschedule->first()->address : '') }}">
                                @error('schedule_location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{ $user->id ?? "" }}" class="form-control" name="user_id">
                <input type="hidden" name="latitude"
                    value="{{ old('latitude') ?? ($locationschedule->isNotEmpty() ? $locationschedule->first()->lat : '') }}"
                    class="form-control inp inputbackground">
                <input type="hidden" name="longitude"
                    value="{{ old('longitude') ?? ($locationschedule->isNotEmpty() ? $locationschedule->first()->lng : '') }}"
                    class="form-control inp inputbackground">
                <div class="text-end mt-2">
                    <a href="{{ route('admin.drivers.index', $user->id) }}">
                        <button type="button"
                            class="btn profileUpdateFont me-2 btn-outline-dark align-items-center fw-medium px-4">Cancel</button></a>
                    <button type="submit" class="btn btn-primary text-light fw-medium px-4">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.schedules.store') }}" enctype="multipart/form-data">
        @csrf
        <div id="availability" style="display:none;">
            <div class="d-flex flex-wrap justify-content-end">
                <div class="col-md-12">
                    <div class="d-flex gap-3">
                        <div class="col-md-4">
                            <input type="hidden" id="selected-date" name="date">
                            <div id="calendar-container">
                                <div class="calendar-header">
                                    <button type="button" id="prev-month">&lt;</button>
                                    <span id="month-year" class="calender"></span>
                                    <button type="button" id="next-month">&gt;</button>
                                </div>
                                <div class="calendar-grid">
                                    <div class="day-name">Su</div>
                                    <div class="day-name">Mo</div>
                                    <div class="day-name">Tu</div>
                                    <div class="day-name">We</div>
                                    <div class="day-name">Th</div>
                                    <div class="day-name">Fr</div>
                                    <div class="day-name">Sa</div>
                                    <!-- Dates will be injected here -->
                                </div>
                            </div>
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <label style="display: flex; align-items: center;"
                                class="profileUpdateFont text-dark d-none">
                                <input type="checkbox" name="is_for_all_location" style="margin-right: 10px;">
                                Is for all location
                            </label>
                            <div class="my-3">
                                <div class="status-toggle togglewrapper">
                                    <div class="status-toggle px-2 ps-0">
                                        <input id="rating_21" class="check" type="checkbox" name="full_unavailable"
                                            value="full_unavailable">
                                        <label for="rating_21" class="checktoggle log checkbox-bg ms-0">checkbox</label>
                                    </div>
                                    <p class="profileUpdateFont text-dark">Full Unavailable</p>
                                </div>
                            </div>

                            <div class="col-md-12 marginTopBottom">
                                <div class="d-flex">
                                    <div class="col-md-4">
                                        <button type="button"
                                            class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3 pointernone">Morning</button>
                                        <div class="my-3">
                                            <div class="status-toggle togglewrapper">
                                                <div class="status-toggle px-2 ps-0">
                                                    <input id="rating_24" class="check" name="morning" type="checkbox"
                                                        value="0">
                                                    <label for="rating_24"
                                                        class="checktoggle log checkbox-bg ms-0">checkbox</label>
                                                </div>
                                                <p class="profileUpdateFont text-dark">Unavailable</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="button"
                                            class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3 pointernone">Afternoon</button>
                                        <div class="my-3">
                                            <div class="status-toggle togglewrapper">
                                                <div class="status-toggle px-2">
                                                    <input id="rating_22" class="check" name="afternoon" type="checkbox"
                                                        value="0">
                                                    <label for="rating_22"
                                                        class="checktoggle log checkbox-bg">checkbox</label>
                                                </div>
                                                <p class="profileUpdateFont text-dark">Unavailable</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="button"
                                            class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3 pointernone">Evening</button>
                                        <div class="my-3">
                                            <div class="status-toggle togglewrapper">
                                                <div class="status-toggle px-2">
                                                    <input id="rating_23" class="check" name="evening" type="checkbox"
                                                        value="0">
                                                    <label for="rating_23"
                                                        class="checktoggle log checkbox-bg">checkbox</label>
                                                </div>
                                                <p class="profileUpdateFont text-dark">Unavailable</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{ $user->id ?? "" }}" class="form-control" name="user_id">
                <div class="text-end mt-2">
                    <a href="{{ route('admin.drivers.index', $user->id) }}">
                        <button type="button"
                            class="btn profileUpdateFont me-2 btn-outline-dark align-items-center fw-medium px-4">Cancel</button></a>
                    <button type="submit" class="btn btn-primary text-light fw-medium px-4">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.schedule.weeklyschedulestore') }}" enctype="multipart/form-data">
        @csrf
        <div id="weekly" style="display:none;">
            <div class="col-md-12 mb-5">
                <div class="d-flex flex-wrap">
                    <!-- <div class="col-md-2"></div> -->
                    <div class="col-md-9 offset-md-3">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button"
                                    class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Morning</button>
                            </div>
                            <div class="col-md-4">
                                <button type="button"
                                    class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Afternoon</button>
                            </div>
                            <div class="col-md-4">
                                <button type="button"
                                    class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Evening</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timePickersSLots">
                <div class="col-md-12 d-flex flax-wrap">
                    <div class="col-md-3 text-dark d-flex align-items-center"><span
                            class="day pointernone">Monday</span>
                        <div class="me-3">
                            <div class="status-toggle togglewrapper">
                                <input id="monday" name="monday" class="check dayToggle" type="checkbox" value="monday">
                                <label for="monday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 ps-sm-0 disablesection monday">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="monday_morning_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="monday_morning_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="monday_afternoon_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="monday_afternoon_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="monday_evening_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="monday_evening_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap margin-margin">
                    <div class="col-md-3 text-dark d-flex align-items-center"><span
                            class="day pointernone">Tuesday</span>
                        <div class="me-3">
                            <div class="status-toggle togglewrapper">
                                <input id="tuesday" name="tuesday" class="check dayToggle" type="checkbox"
                                    value="Inactive">
                                <label for="tuesday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 ps-sm-0 disablesection tuesday" id="selected-schedule">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="tuesday_morning_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="tuesday_morning_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="tuesday_afternoon_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="tuesday_afternoon_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="tuesday_evening_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="tuesday_evening_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap margin-margin">
                    <div class="col-md-3 text-dark d-flex align-items-center"><span
                            class="day pointernone">Wednesday</span>
                        <div class="me-3">
                            <div class="status-toggle togglewrapper">
                                <input id="wednesday" name="wednesday" class="check dayToggle" type="checkbox"
                                    value="Inactive">
                                <label for="wednesday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 ps-sm-0 disablesection wednesday" id="selected-schedule">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="wednesday_morning_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="wednesday_morning_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="wednesday_afternoon_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="wednesday_afternoon_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="wednesday_evening_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="wednesday_evening_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap margin-margin">
                    <div class="col-md-3 text-dark d-flex align-items-center"><span
                            class="day pointernone">Thursday</span>
                        <div class="me-3">
                            <div class="status-toggle togglewrapper">
                                <input id="thursday" name="thursday" class="check dayToggle" type="checkbox"
                                    value="Inactive">
                                <label for="thursday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 ps-sm-0 disablesection thursday" id="selected-schedule">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="thursday_morning_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="thursday_morning_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="thursday_afternoon_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="thursday_afternoon_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="thursday_evening_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="thursday_evening_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap margin-margin">
                    <div class="col-md-3 text-dark d-flex align-items-center"><span
                            class="day pointernone">Friday</span>
                        <div class="me-3">
                            <div class="status-toggle togglewrapper">
                                <input id="friday" name="friday" class="check dayToggle" type="checkbox"
                                    value="Inactive">
                                <label for="friday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 ps-sm-0 disablesection friday" id="selected-schedule">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="friday_morning_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="friday_morning_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="friday_afternoon_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="friday_afternoon_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="friday_evening_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="friday_evening_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap margin-margin">
                    <div class="col-md-3 text-dark d-flex align-items-center"><span
                            class="day pointernone">Saturday</span>
                        <div class="me-3">
                            <div class="status-toggle togglewrapper">
                                <input id="saturday" name="saturday" class="check dayToggle" type="checkbox"
                                    value="Inactive">
                                <label for="saturday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 ps-sm-0 disablesection saturday" id="selected-schedule">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="saturday_morning_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="saturday_morning_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="saturday_afternoon_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="saturday_afternoon_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="saturday_evening_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="saturday_evening_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex flax-wrap margin-margin">
                    <div class="col-md-3 text-dark d-flex align-items-center"><span
                            class="day pointernone">Sunday</span>
                        <div class="me-3">
                            <div class="status-toggle togglewrapper">
                                <input id="sunday" name="sunday" class="check dayToggle" type="checkbox"
                                    value="Inactive">
                                <label for="sunday" class="checktoggle log checkbox-bg"> </label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 ps-sm-0 disablesection sunday" id="selected-schedule">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="sunday_morning_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="sunday_morning_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="sunday_afternoon_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="sunday_afternoon_end">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row gx-2">
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Opening Time" name="sunday_evening_start">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control inp inputs text-center onlyTimePickerSchedule"
                                            placeholder="Closing Time" name="sunday_evening_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="{{ $user->id ?? "" }}" class="form-control" name="user_id">
            <div class="text-end mt-4">
                <a href="{{ route('admin.drivers.index', $user->id) }}">
                    <button type="button"
                        class="btn profileUpdateFont me-2 btn-outline-dark align-items-center fw-medium px-4">Cancel</button></a>
                <button type="submit" class="btn btn-primary text-light fw-medium px-4">Submit</button>
            </div>
        </div>
    </form>

    <div class="col-md-12 mt-5">

        <div class="row">
            <div class="col-md-6">
                <p class="subhead login-logo-font fw-semibold me-sm-5 availability">Schedule Availability</p>
                <p class="subhead login-logo-font fw-semibold me-sm-5 location">Locations</p>
            </div>
            <div class="col-md-6">
                <div class="usersearch d-flex justify-content-end">
                    <div class="top-nav-search">
                        {{-- <form>
                            <input type="text" id="searchInput" class="form-control forms me-2" placeholder="Search ">
                        </form> --}}
                    </div>

                    <div class="">
                        <button type="button"
                            class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                            <a class="btn-filters d-flex justify-content-center align-items-center"
                                href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Refresh">
                                <span><i class="fe fe-refresh-ccw"></i></span>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive DriverInventoryTable mt-3">
                        <table class="table table-stripped table-hover location">
                            <thead class="thead-light">
                                <tr>
                                    <th>S. No.</th>
                                    <th>Location</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($locationschedule as $key => $item)
                                    <tr>
                                        <td class="text-start">{{$key + 1}}</td>
                                        <td>{{$item->address ?? ''}}</td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <form method="POST"
                                                                action="{{ route('admin.schedule.locationstore') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" value="{{ $item->id ?? "" }}"
                                                                    class="form-control" name="id">
                                                                <input type="hidden" value="{{ $user->id ?? "" }}"
                                                                    class="form-control" name="user_id">
                                                                <input type="hidden" value="delete" class="form-control"
                                                                    name="type">
                                                                <button class="dropdown-item" type="submit">
                                                                    <i class="fa fa-trash me-2"></i>Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>

                        <table class="table table-stripped table-hover availability">
                            <thead class="thead-light">
                                <tr>
                                    <th>S. No.</th>
                                    <th>Date</th>
                                    {{-- <th>Location</th> --}}
                                    <th>Availability</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($availabilities as $index => $availabilitie)
                                    @php
                                        $slots = [];
                                        if (isset($availabilitie->morning) && $availabilitie->morning == 1)
                                            $slots[] = 'Morning';
                                        if (isset($availabilitie->afternoon) && $availabilitie->afternoon == 1)
                                            $slots[] = 'Afternoon';
                                        if (isset($availabilitie->evening) && $availabilitie->evening == 1)
                                            $slots[] = 'Evening';

                                        $isFullyAvailable = count($slots) === 3;
                                    @endphp

                                    @if ($isFullyAvailable)
                                        @continue
                                    @endif

                                    <tr>
                                        <td class="text-start">{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($availabilitie->date)->format('m-d-Y') ?? '--' }}</td>
                                        {{-- <td>{{ $availabilitie->locationName->address ?? 'For All' }}</td> --}}
                                        <td>
                                            @if (count($slots) === 0)
                                                Full Unavailable
                                            @else
                                                {{ implode(', ', $slots) }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <!-- <li>
                                                                <a class="dropdown-item" href="{{ route('admin.drivers.scheduleshow', $availabilitie->id) }}">
                                                                    <i class="far fa-eye me-2"></i>View
                                                                </a>
                                                            </li> -->
                                                        <!-- <li>
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="event.preventDefault(); showEditSchedule(
                                                                        '{{ $availabilitie->id }}', 
                                                                        '{{ \Carbon\Carbon::parse($availabilitie->date)->format('m-d-Y') }}', 
                                                                        '{{ $availabilitie->morning }}', 
                                                                        '{{ $availabilitie->afternoon }}', 
                                                                        '{{ $availabilitie->evening }}'
                                                                    );">
                                                                    <i class="far fa-edit me-2"></i>Update
                                                                </a>
                                                            </li> -->
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.drivers.schedule.delete', $availabilitie->id) }}">
                                                                <i class="fa fa-trash me-2"></i>Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <!-- -------------------------------------------------------------------------- -->
    @section('script')
        <script>
            const scheduleData = @json($weeklyschedule);
            $(document).ready(function () {
                if (!scheduleData) {
                    console.log("---------------------");
                    return;
                }
                if (Array.isArray(scheduleData) && scheduleData.length > 0) {
                    scheduleData.forEach(function (entry) {
                        const day = entry.day.toLowerCase();

                        // Checkbox enable
                        $("#" + day).prop("checked", true);
                        $(`#${day}`).val("Inactive");
                        $("." + day).removeClass("disablesection");

                        // Set times if available
                        if (entry.morning_start) {
                            $(`input[name="${day}_morning_start"]`).val(
                                moment(entry.morning_start, "HH:mm:ss").format(
                                    "hh:mm A"
                                )
                            );
                        }
                        if (entry.morning_end) {
                            $(`input[name="${day}_morning_end"]`).val(
                                moment(entry.morning_end, "HH:mm:ss").format("hh:mm A")
                            );
                        }
                        if (entry.afternoon_start) {
                            $(`input[name="${day}_afternoon_start"]`).val(
                                moment(entry.afternoon_start, "HH:mm:ss").format(
                                    "hh:mm A"
                                )
                            );
                        }
                        if (entry.afternoon_end) {
                            $(`input[name="${day}_afternoon_end"]`).val(
                                moment(entry.afternoon_end, "HH:mm:ss").format(
                                    "hh:mm A"
                                )
                            );
                        }
                        if (entry.evening_start) {
                            $(`input[name="${day}_evening_start"]`).val(
                                moment(entry.evening_start, "HH:mm:ss").format(
                                    "hh:mm A"
                                )
                            );
                        }
                        if (entry.evening_end) {
                            $(`input[name="${day}_evening_end"]`).val(
                                moment(entry.evening_end, "HH:mm:ss").format("hh:mm A")
                            );
                        }
                    });
                }

                // Checkbox change event to handle checked and unchecked actions
                $("input[type='checkbox']").on("change", function () {
                    const day = $(this).attr("id");

                    if (!$(this).prop("checked")) {
                        // If unchecked, clear all fields and disable them
                        $(`input[name="${day}_morning_start"]`)
                            .val("")
                            .prop("disabled", true);
                        $(`input[name="${day}_morning_end"]`)
                            .val("")
                            .prop("disabled", true);
                        $(`input[name="${day}_afternoon_start"]`)
                            .val("")
                            .prop("disabled", true);
                        $(`input[name="${day}_afternoon_end"]`)
                            .val("")
                            .prop("disabled", true);
                        $(`input[name="${day}_evening_start"]`)
                            .val("")
                            .prop("disabled", true);
                        $(`input[name="${day}_evening_end"]`)
                            .val("")
                            .prop("disabled", true);

                        // Disable day section and reset its value
                        $("." + day).addClass("disablesection");
                        $(`input[name="${day}_morning_start"]`).prop("readonly", true);
                        $(`input[name="${day}_morning_end"]`).prop("readonly", true);
                        $(`input[name="${day}_afternoon_start"]`).prop(
                            "readonly",
                            true
                        );
                        $(`input[name="${day}_afternoon_end"]`).prop("readonly", true);
                        $(`input[name="${day}_evening_start"]`).prop("readonly", true);
                        $(`input[name="${day}_evening_end"]`).prop("readonly", true);

                        // Clear the value for day as well
                        $(`#${day}`).val("");
                    } else {
                        // If checked, enable the day section and fields
                        $("." + day).removeClass("disablesection");
                        $(`input[name="${day}_morning_start"]`)
                            .prop("disabled", false)
                            .prop("readonly", false);
                        $(`input[name="${day}_morning_end"]`)
                            .prop("disabled", false)
                            .prop("readonly", false);
                        $(`input[name="${day}_afternoon_start"]`)
                            .prop("disabled", false)
                            .prop("readonly", false);
                        $(`input[name="${day}_afternoon_end"]`)
                            .prop("disabled", false)
                            .prop("readonly", false);
                        $(`input[name="${day}_evening_start"]`)
                            .prop("disabled", false)
                            .prop("readonly", false);
                        $(`input[name="${day}_evening_end"]`)
                            .prop("disabled", false)
                            .prop("readonly", false);
                    }
                });

                // Agar koi data nahi hai to default form hi dikhega (blank), jaisa abhi dikh raha hai
            });

        </script>

        <script>
            function driverscheduleform(type) {
                // Hide all sections
                document.getElementById('availability').style.display = 'none';
                document.getElementById('location').style.display = 'none';
                document.getElementById('weekly').style.display = 'none';

                // Remove active3 class from all buttons
                document.getElementById('availabilitybtn').classList.remove('active3');
                document.getElementById('locationbtn').classList.remove('active3');
                document.getElementById('weeklybtn').classList.remove('active3');

                // Show selected section & activate corresponding button
                if (type === 'availability') {
                    $('.availability').show();
                    $('.location').hide();
                    document.getElementById('availability').style.display = 'block';
                    document.getElementById('availabilitybtn').classList.add('active3');
                } else if (type === 'location') {
                    $('.availability').hide();
                    $('.location').show();
                    document.getElementById('location').style.display = 'block';
                    document.getElementById('locationbtn').classList.add('active3');
                } else if (type === 'weekly') {
                    $('.availability').hide();
                    $('.location').hide();
                    document.getElementById('weekly').style.display = 'block';
                    document.getElementById('weeklybtn').classList.add('active3');
                }

                // Update the URL with the selected tab
                const url = new URL(window.location);
                url.searchParams.set('tab', type); // Set the tab parameter in the URL
                window.history.pushState({}, '', url); // Update the URL without reloading the page
            }

            // Show correct tab based on URL query on page load
            document.addEventListener("DOMContentLoaded", function () {
                const urlParams = new URLSearchParams(window.location.search);
                const activeTab = urlParams.get('tab') || 'availability'; // Default 'availability' tab
                driverscheduleform(activeTab);
            });


        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                document.querySelectorAll('.toggle-switch').forEach(switchBtn => {

                    switchBtn.addEventListener("change", function () {
                        let buttonsContainer = this.closest('.form-check').querySelector('.schedule-buttons');
                        let buttons = buttonsContainer.querySelectorAll('button');
                        buttons.forEach(button => {
                            button.classList.toggle('.text-dark', this.checked);
                        })
                    })
                })

            });

        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const fullUnavailable = document.querySelector('input[name="full_unavailable"]');
                const timeCheckboxes = [
                    document.querySelector('input[name="morning"]'),
                    document.querySelector('input[name="afternoon"]'),
                    document.querySelector('input[name="evening"]')
                ];

                // When "Full Unavailable" is toggled
                fullUnavailable.addEventListener("change", function () {
                    timeCheckboxes.forEach(checkbox => {
                        checkbox.checked = fullUnavailable.checked;
                        updateCheckboxValue(checkbox);
                    });
                });

                // When any of the Morning/Afternoon/Evening is changed
                timeCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener("change", function () {
                        if (!checkbox.checked) {
                            fullUnavailable.checked = false;
                        } else {
                            // Check if all time checkboxes are ON, then set Full Unavailable ON
                            const allChecked = timeCheckboxes.every(cb => cb.checked);
                            fullUnavailable.checked = allChecked;
                        }
                        updateCheckboxValue(checkbox);
                    });
                });

                // Function to update checkbox value (Active/Inactive)
                function updateCheckboxValue(checkbox) {
                    if (checkbox.checked) {
                        checkbox.value = 'Inactive';  // Active if checked
                    } else {
                        checkbox.value = '';  // Inactive if unchecked
                    }
                }

                // Initialize checkbox values based on current state
                timeCheckboxes.forEach(checkbox => updateCheckboxValue(checkbox));
            });

        </script>

        <script>
            function generateCalendar(year, month) {
                const daysContainer = document.getElementById('calendar-body');
                const header = document.getElementById("calendar-header");

                daysContainer.innerHTML = "";

                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June'
                    , 'July', 'August', 'September', 'October', 'November', 'December'
                ];

                header.innerText = `${monthNames[month]} ${year}`;

                const firstDay = new Date(year, month, 1).getDay(); // 0 = Sunday, 1 = Monday, ...
                const totalDays = new Date(year, month + 1, 0).getDate();

                // Blank days for alignment
                for (let i = 0; i < firstDay; i++) {
                    daysContainer.innerHTML += `<div class="day empty"></div>`;
                }

                // Fill actual days
                for (let day = 1; day <= totalDays; day++) {
                    daysContainer.innerHTML += `<div class="day" onclick="selectDate(this)">${day}</div>`;
                }
            }

            function selectDate(element) {
                // You can add any logic here, for now we'll just highlight the selected day
                const previouslySelected = document.querySelector('.day.selected');
                if (previouslySelected) {
                    previouslySelected.classList.remove('selected');
                }
                element.classList.add('selected');
            }

            // Optional: generate current month on load
            window.onload = function () {
                const today = new Date();
                generateCalendar(today.getFullYear(), today.getMonth());
            };

        </script>

        <script>
            const calendarGrid = document.querySelector('.calendar-grid');
            const monthYear = document.getElementById('month-year');
            let currentDate = new Date();

            function renderCalendar(date) {
                const year = date.getFullYear();
                const month = date.getMonth();
                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                monthYear.textContent = `${date.toLocaleString('default', { month: 'long' })} ${year}`;

                // Clear previous dates
                calendarGrid.querySelectorAll('.date').forEach(e => e.remove());

                // Add blank days for starting offset
                for (let i = 0; i < firstDay; i++) {
                    const blank = document.createElement('div');
                    calendarGrid.appendChild(blank);
                }

                // Add actual days
                for (let i = 1; i <= daysInMonth; i++) {
                    const day = document.createElement('div');
                    day.className = 'date';
                    day.textContent = i;

                    day.addEventListener('click', () => {
                        document.querySelectorAll('.date').forEach(d => d.classList.remove('selected'));
                        day.classList.add('selected');

                        // Format selected date as YYYY-MM-DD
                        const selectedDay = i.toString().padStart(2, '0');
                        const selectedMonth = (month + 1).toString().padStart(2, '0');
                        const formattedDate = `${year}-${selectedMonth}-${selectedDay}`;

                        // Store in hidden input
                        const input = document.getElementById('selected-date');
                        if (input) {
                            input.value = formattedDate;
                        }

                        // Optional: Console log
                        console.log("Selected date:", formattedDate);
                    });

                    // Highlight today's date
                    if (
                        i === new Date().getDate() &&
                        month === new Date().getMonth() &&
                        year === new Date().getFullYear()
                    ) {
                        day.classList.add('selected');
                    }

                    calendarGrid.appendChild(day);
                }
            }


            document.getElementById('prev-month').onclick = () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar(currentDate);
            };

            document.getElementById('next-month').onclick = () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar(currentDate);
            };

            renderCalendar(currentDate);

        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll('.dayToggle').forEach(function (checkbox) {
                    checkbox.addEventListener('change', function () {
                        const day = this.name;
                        const targetDiv = document.querySelector('.disablesection.' + day);
                        if (this.checked) {
                            targetDiv.classList.add('notvisible');
                        } else {
                            targetDiv.classList.remove('notvisible');
                        }
                    });
                });
            });

        </script>

        <script>
            const updateScheduleRoute = "{{ route('admin.schedules.update', ['schedule' => '__ID__']) }}";

            async function showEditSchedule(id, date, morning, afternoon, evening) {
                // Format date to MM-DD-YYYY
                const formattedDate = new Date(date).toLocaleDateString('en-US');

                const { value: formValues } = await Swal.fire({
                    title: `Edit Schedule For This ${formattedDate}`,
                    html: `
                    <form id="scheduleForm" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="${id}">
                        <input type="hidden" name="date" value="${date}">

                        <div class="status-toggle togglewrapper px-2 ps-0">
                            <input id="rating_35" class="check" type="checkbox" name="full_unavailable">
                            <label for="rating_35" class="checktoggle log checkbox-bg ms-0">checkbox</label>
                            <p class="profileUpdateFont text-dark">Full Unavailable</p>
                        </div>

                        <div class="status-toggle togglewrapper px-2 ps-0 mt-3" style="display: flow; text-align: -webkit-left;">
                            <button type="button" class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3 pointernone">Morning</button>
                            <div class="my-2" style="display: flex;">
                                <input id="rating_30" class="check" name="morning" type="checkbox">
                                <label for="rating_30" class="checktoggle log checkbox-bg ms-0">checkbox</label>
                                <p class="profileUpdateFont text-dark">Unavailable</p>
                            </div>
                        </div>

                        <div class="status-toggle togglewrapper px-2 ps-0 mt-3" style="display: flow; text-align: -webkit-left;">
                            <button type="button" class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3 pointernone">Afternoon</button>
                            <div class="my-2" style="display: flex;">
                                <input id="rating_31" class="check" name="afternoon" type="checkbox">
                                <label for="rating_31" class="checktoggle log checkbox-bg ms-0">checkbox</label>
                                <p class="profileUpdateFont text-dark">Unavailable</p>
                            </div>
                        </div>

                        <div class="status-toggle togglewrapper px-2 ps-0 mt-3" style="display: flow; text-align: -webkit-left;">
                            <button type="button" class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3 pointernone">Evening</button>
                            <div class="my-2" style="display: flex;">
                                <input id="rating_32" class="check" name="evening" type="checkbox">
                                <label for="rating_32" class="checktoggle log checkbox-bg ms-0">checkbox</label>
                                <p class="profileUpdateFont text-dark">Unavailable</p>
                            </div>
                        </div>
                    </form>
                `,
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    didOpen: () => {
                        const form = Swal.getPopup().querySelector('#scheduleForm');
                        form.action = updateScheduleRoute.replace('__ID__', id); // Laravel route

                        const fullUnavailable = form.querySelector('input[name="full_unavailable"]');
                        const morningCb = form.querySelector('input[name="morning"]');
                        const afternoonCb = form.querySelector('input[name="afternoon"]');
                        const eveningCb = form.querySelector('input[name="evening"]');

                        if (morning == 0) morningCb.checked = true;
                        if (afternoon == 0) afternoonCb.checked = true;
                        if (evening == 0) eveningCb.checked = true;

                        if (morning == 0 && afternoon == 0 && evening == 0) {
                            fullUnavailable.checked = true;
                        }

                        function updateCheckboxValue(checkbox) {
                            checkbox.value = checkbox.checked ? 0 : 1;
                        }

                        fullUnavailable.addEventListener("change", function () {
                            morningCb.checked = this.checked;
                            afternoonCb.checked = this.checked;
                            eveningCb.checked = this.checked;

                            updateCheckboxValue(morningCb);
                            updateCheckboxValue(afternoonCb);
                            updateCheckboxValue(eveningCb);
                        });

                        [morningCb, afternoonCb, eveningCb].forEach(cb => {
                            cb.addEventListener("change", function () {
                                updateCheckboxValue(cb);
                                fullUnavailable.checked = morningCb.checked && afternoonCb.checked && eveningCb.checked;
                            });
                            updateCheckboxValue(cb);
                        });
                    },
                    preConfirm: () => {
                        document.getElementById('scheduleForm').submit();
                    }
                });
            }
        </script>

    @endsection

</x-app-layout>