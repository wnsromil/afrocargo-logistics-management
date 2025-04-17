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
                    <button id="availabilitybtn" type="button" class="btnBorder th-font fw-semiBold ms-0 me-3 p-1 activity-feed active3" onclick="driverscheduleform('availability')">Availability</button>
                    <button id="weeklybtn" type="button" class="btnBorder th-font fw-semiBold p-1 faded" onclick="driverscheduleform('weekly')">Weekly Schedule</button>
                </div>
            </div>
        </div>
    </x-slot>
    <!-- ------------------------------------------------------------------------------ -->

    <form method="POST" id="availability">
        <div class="d-flex flex-wrap">
            <div class="col-md-12">
                <div class="d-flex gap-3">
                    <div class="col-md-4">

                        <div id="calendar-container">
                            <div class="calendar-header">
                                <button id="prev-month">&lt;</button>
                                <span id="month-year" class="calender"></span>
                                <button id="next-month">&gt;</button>
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

                    </div>
                    <div class="col-md-8">
                        <div class="col-md-6">
                            <label for="LacationInput1" class="form-label">Select Location</label>
                            <input type="text" class="form-control" id="LacationInput1" placeholder="Location">
                        </div>
                        <div class="input-group marginTopBottom">
                            <div class="form-check text-checkbox">
                                <input type="checkbox" class="form-check-input border-dark opacity-75" id="Check1">
                                <label class="form-check-label fw-medium mb-0" for="Check1">Is Available for this
                                    Location</label>
                            </div>
                        </div>

                        <div class="my-3">
                            <div class="status-toggle togglewrapper">
                                <div class="status-toggle px-2 ps-0">
                                    <input id="rating_21" class="check" type="checkbox" value="Inactive">
                                    <label for="rating_21" class="checktoggle log checkbox-bg ms-0">checkbox</label>
                                </div>
                                <p class="profileUpdateFont text-dark">Full Unavailable</p>
                            </div>
                        </div>

                        <div class="col-md-12 marginTopBottom">
                            <div class="d-flex">
                                <div class="col-md-4">
                                    <button type="button" class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3 pointernone">Morning</button>
                                    <div class="my-3">
                                        <div class="status-toggle togglewrapper">
                                            <div class="status-toggle px-2 ps-0">
                                                <input id="rating_24" class="check" type="checkbox" value="Inactive">
                                                <label for="rating_24" class="checktoggle log checkbox-bg ms-0">checkbox</label>
                                            </div>
                                            <p class="profileUpdateFont text-dark">Unavailable</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button type="button" class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3 pointernone">Afternoon</button>
                                    <div class="my-3">
                                        <div class="status-toggle togglewrapper">
                                            <div class="status-toggle px-2">
                                                <input id="rating_22" class="check" type="checkbox" value="Inactive">
                                                <label for="rating_22" class="checktoggle log checkbox-bg">checkbox</label>
                                            </div>
                                            <p class="profileUpdateFont text-dark">Unavailable</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button type="button" class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3 pointernone">Evening</button>
                                    <div class="my-3">
                                        <div class="status-toggle togglewrapper">
                                            <div class="status-toggle px-2">
                                                <input id="rating_23" class="check" type="checkbox" value="Inactive">
                                                <label for="rating_23" class="checktoggle log checkbox-bg">checkbox</label>
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
        </div>

        <div class="text-end mt-2">
            <button type="button" class="btn profileUpdateFont me-2 btn-outline-dark align-items-center fw-medium px-4">Cancel</button>
            <button type="button" class="btn btn-primary text-light fw-medium px-4">Submit</button>
        </div>
    </form>

    <div id="weekly" style="display:none;">

        <div class="col-md-12 mb-5">
            <div class="d-flex flex-wrap">
                <!-- <div class="col-md-2"></div> -->
                <div class="col-md-9 offset-md-3 d-flex flex-wrap">
                    <div class="col-md-4">
                        <button type="button" class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Morning</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Afternoon</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn profileUpdateFont btn-size pointernone align-items-center fw-medium p-1 px-3">Evening</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="timePickersSLots">
            <div class="col-md-12 d-flex flax-wrap">
                <div class="col-md-3 text-dark d-flex align-items-center"><span class="day pointernone">Monday</span>
                    <div class="me-3">
                        <div class="status-toggle togglewrapper">
                            <input id="monday" name="monday" class="check dayToggle" type="checkbox" value="Inactive">
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
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark d-flex align-items-center"><span class="day pointernone">Tuesday</span>
                    <div class="me-3">
                        <div class="status-toggle togglewrapper">
                            <input id="tuesday" name="tuesday" class="check dayToggle" type="checkbox" value="Inactive">
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
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark d-flex align-items-center"><span class="day pointernone">Wednesday</span>
                    <div class="me-3">
                        <div class="status-toggle togglewrapper">
                            <input id="wednesday" name="wednesday" class="check dayToggle" type="checkbox" value="Inactive">
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
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark d-flex align-items-center"><span class="day pointernone">Thursday</span>
                    <div class="me-3">
                        <div class="status-toggle togglewrapper">
                            <input id="thursday" name="thursday" class="check dayToggle" type="checkbox" value="Inactive">
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
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark d-flex align-items-center"><span class="day pointernone">Friday</span>
                    <div class="me-3">
                        <div class="status-toggle togglewrapper">
                            <input id="friday" name="friday" class="check dayToggle" type="checkbox" value="Inactive">
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
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark d-flex align-items-center"><span class="day pointernone">Saturday</span>
                    <div class="me-3">
                        <div class="status-toggle togglewrapper">
                            <input id="saturday" name="saturday" class="check dayToggle" type="checkbox" value="Inactive">
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
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark d-flex align-items-center"><span class="day pointernone">Sunday</span>
                    <div class="me-3">
                        <div class="status-toggle togglewrapper">
                            <input id="sunday" name="sunday" class="check dayToggle" type="checkbox" value="Inactive">
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
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Opening Time">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control inp inputs text-center onlyTimePicker" placeholder="Closing Time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 mt-5">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <p class="subhead login-logo-font fw-semibold me-sm-5">Schedule Availability</p>
                </div>
                <div class="col-md-6">
                    <div class="usersearch d-flex justify-content-end">
                        <div class="top-nav-search">
                            <form>
                                <input type="text" id="searchInput" class="form-control forms me-2" placeholder="Search ">
                            </form>
                        </div>

                        <div class="">
                            <button type="button" class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                                <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
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
                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>S. No.</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Availability</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-start">1</td>
                                        <td>04-12-2025</td>
                                        <td>Caliefornia, USA</td>
                                        <td>Full Unavailable</td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item"><i class="far fa-edit me-2"></i>Update</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="" ><i class="far fa-eye me-2"></i>View</a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">2</td>
                                        <td>04-18-2025</td>
                                        <td>San Andreas, USA</td>
                                        <td>Morning</td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item"><i class="far fa-edit me-2"></i>Update</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>




    <!-- -------------------------------------------------------------------------- -->

    <script>
        function driverscheduleform(type) {
            if (type === 'availability') {
                document.getElementById('availability').style.display = 'block';
                document.getElementById('weekly').style.display = 'none';
                document.getElementById('availabilitybtn').classList.add('active3');
                document.getElementById('weeklybtn').classList.remove('active3');
            } else if (type === 'weekly') {
                document.getElementById('availability').style.display = 'none';
                document.getElementById('weekly').style.display = 'block';
                document.getElementById('availabilitybtn').classList.remove('active3');
                document.getElementById('weeklybtn').classList.add('active3');
            }
        }

        window.onload = function() {
            driverscheduleform('availability');
        };

    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.toggle-switch').forEach(switchBtn => {

                switchBtn.addEventListener("change", function() {
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
        window.onload = function() {
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
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.dayToggle').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
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



</x-app-layout>
