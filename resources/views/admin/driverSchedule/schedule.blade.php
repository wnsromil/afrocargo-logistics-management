<x-app-layout>
    <x-slot name="header">
        Drivers Management
    </x-slot>

    <x-slot name="cardTitle">
        <p class="subhead login-logo-font fw-semibold">Add Schedule</p>

        <div class="row mt-3 mb-2">
            <div class="d-block">
                <div class="col-md-12 d-flex text-center">
                    <button id="availabilitybtn" type="button"
                        class="btnBorder p-1 pe-2  th-font fw-semiBold p-1 mx-4 bg-light faded"
                        onclick="driverscheduleform('availability')">Availability</button>
                    <button id="weeklybtn" type="button" class="btnBorder th-font fw-semiBold p-1 bg-light faded"
                        onclick="driverscheduleform('weekly')">Weekly Schedule</button>
                </div>
                <div class="border-bottom border-dark border-opacity-50 mb-4 ms-3 w-100"></div>

            </div>
    </x-slot>
    <div class="border border-1 mb-5"></div>
    <!-- ------------------------------------------------------------------------------ -->

    <form method="POST" id="availability" style="display:none;">
        <div class="d-flex flex-wrap">
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="col-md-4">
                        <!-- ------------------------------------------------------------------- -->

                        <div id="calendar-container">
                            <div id="calendar"></div>

             
                        </div>
                        <!-- ------------------------------------------------------------------- -->

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
                            <div class="status-toggle">
                                <input id="rating_21" class="check" type="checkbox">
                                <label for="rating_21" class="checktoggle gle checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">Full Unavailable</p>
                            </div>
                        </div>

                        <div class="col-md-12 marginTopBottom">
                            <div class="d-flex">
                                <div class="col-md-4">
                                    <button type="button"
                                        class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3">Morning</button>
                                    <div class="my-3">
                                        <div class="status-toggle">
                                            <input id="rating_24" class="check" type="checkbox">
                                            <label for="rating_24" class="checktoggle gle checkbox-bg">checkbox</label>
                                            <p class="profileUpdateFont text-dark">Unavailable</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button type="button"
                                        class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3">Afternoon</button>
                                    <div class="my-3">
                                        <div class="status-toggle">
                                            <input id="rating_22" class="check" type="checkbox">
                                            <label for="rating_22" class="checktoggle gle checkbox-bg">checkbox</label>
                                            <p class="profileUpdateFont text-dark">Unavailable</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button type="button"
                                        class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3">Evening</button>
                                    <div class="my-3">
                                        <div class="status-toggle">
                                            <input id="rating_23" class="check" type="checkbox">
                                            <label for="rating_23" class="checktoggle gle checkbox-bg">checkbox</label>
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

        <div class="float-end mt-2">
            <button type="button"
                class="btn profileUpdateFont btn-outline-dark align-items-center fw-medium px-4">Cancel</button>
            <button type="button" class="btn profileUpdateFont btnColor1 text-light fw-medium px-4 mx-2">Submit</button>
        </div>
    </form>

    <div id="weekly" style="display:none;">

        <div class="col-md-12 mb-5">
            <div class="d-flex flex-wrap">
                <div class="col-md-2"></div>
                <div class="col-md-10 d-flex flex-wrap">
                    <div class="col-md-4">
                        <button type="button"
                            class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3">Morning</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button"
                            class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3">Afternoon</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button"
                            class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3">Evening</button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="col-md-12 d-flex flax-wrap">
                <div class="col-md-3 text-dark"><span class="align-items-center profileUpdateFont">Monday</span>
                    <div class="float-end me-3">
                        <div class="status-toggle">
                            <input id="monday" class="check" type="checkbox" value="Inactive">
                            <label for="monday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 opacity-25" id="selected-schedule">
                    <div class="d-flex">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin" id="selected-schedule">
                <div class="col-md-3 text-dark"><span class="align-items-center profileUpdateFont">Tuesday</span>
                    <div class="float-end me-3">
                        <div class="status-toggle">
                            <input id="tuesday" class="check" type="checkbox" value="Inactive">
                            <label for="tuesday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 opacity-25" id="selected-schedule">
                    <div class="d-flex">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark"><span class="align-items-center profileUpdateFont">Wednesday</span>
                    <div class="float-end me-3">
                        <div class="status-toggle">
                            <input id="wednesday" class="check" type="checkbox" value="Inactive">
                            <label for="wednesday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 opacity-25" id="selected-schedule">
                    <div class="d-flex">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark"><span class="align-items-center profileUpdateFont">Thursday</span>
                    <div class="float-end me-3">
                        <div class="status-toggle">
                            <input id="thursday" class="check" type="checkbox" value="Inactive">
                            <label for="thursday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 opacity-25" id="selected-schedule">
                    <div class="d-flex">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark"><span class="align-items-center profileUpdateFont">Friday</span>
                    <div class="float-end me-3">
                        <div class="status-toggle">
                            <input id="friday" class="check" type="checkbox" value="Inactive">
                            <label for="friday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 opacity-25" id="selected-schedule">
                    <div class="d-flex">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark"><span class="align-items-center profileUpdateFont">Saturday</span>
                    <div class="float-end me-3">
                        <div class="status-toggle">
                            <input id="saturday" class="check" type="checkbox" value="Inactive">
                            <label for="saturday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 opacity-25" id="selected-schedule">
                    <div class="d-flex">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark"><span class="align-items-center profileUpdateFont">Sunday</span>
                    <div class="float-end me-3">
                        <div class="status-toggle">
                            <input id="sunday" class="check" type="checkbox" value="Inactive">
                            <label for="sunday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 opacity-25" id="selected-schedule">
                    <div class="d-flex">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-dark rounded-1">Opening Time</button>
                            <button type="button" class="btn btn-outline-dark rounded-1">Closing Time</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- -------------------------------------------------------------------------- -->

    <script>

        function driverscheduleform(type) {
            if (type === 'availability') {
                document.getElementById('availability').style.display = 'block';
                document.getElementById('weekly').style.display = 'none';
                document.getElementById('availabilitybtn').classList.add('active2');
                document.getElementById('weeklybtn').classList.remove('active2');
            } else if (type === 'weekly') {
                document.getElementById('availability').style.display = 'none';
                document.getElementById('weekly').style.display = 'block';
                document.getElementById('availabilitybtn').classList.remove('active2');
                document.getElementById('weeklybtn').classList.add('active2');
            }
        }

        window.onload = function () {
            driverscheduleform('availability');
        };
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

        // ------------------------------------------------------

        // document.querySelectorAll('.selected-schedule').forEach(input =>{
        //     input.addEventListener('change', function () {
        //             if (toggle.checked) {
        //                 schedule.classList.remove('opacity-25');
        //                 schedule.classList.add('opacity-100');
        //             } else {
        //                 schedule.classList.remove('opacity-100');
        //                 schedule.classList.add('opacity-25');
        //             }
        //         });
        // })
    </script>
        

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            var calendarEI = document.getElementById("calendar");
            var calendar = new FullCalendar.Calendar(calendarEI, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap',
                selectable: true,
                editable: false,
                height: 300,
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                }
            });
            calendar.render();
        });
    </script>


    <!-- <script>
        function generateCalender(year, month) {
            const daysContainer = document.getElementById('calendar-body');
            const header = document.getElementById("calendar-header");
            daysContainer.innerHTML = "";
            const monthName = ['January', 'Feburary', 'March', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            header.innerText = ${ monthName[month] } ${ year };

            const totalDays = new Date(year, month + 1, 0).getDate();
            for (leti = 0; i < firstDay; i++) {
                daysContainer.innerHTML += <div class="day"></div>
            }

            for (let days = 1; day <= tatlDays; day++) {
                daysContainer.innerHTML +=
                    <div class="day" onClick="selectDate(this)">${day}</div>;
            }
        }

        function selectDate(element)
    </script> -->


</x-app-layout>