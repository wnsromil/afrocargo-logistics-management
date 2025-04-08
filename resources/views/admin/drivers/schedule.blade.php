<x-app-layout>
    <x-slot name="header">
        Drivers Management
    </x-slot>
<style>
    .text-checkbox{
        color:black;
    }
    .btn-size {
    width:auto;
    height: 26px;
    }
    .input.form-control.inp::placeholder {
font-size:8px !important;
font-weight :400;
}
.content-page-header {
    margin-top: -5px;
    justify-content: normal;
}
</style>
    <x-slot name="cardTitle">
        <p class="subhead login-logo-font fw-semibold">Add Schedule</p>

        <div class="row mt-3 mb-2">
            <div class="col-md-12 d-flex text-center">
                <button id="availabilitybtn" type="button" class="btnBorder th-font fw-semiBold p-1 activity-feed mx-4"
                    onclick="driverscheduleform('availability')">Availability</button>
                <button id="weeklybtn" type="button" class="btnBorder th-font fw-semiBold p-1 faded"
                    onclick="driverscheduleform('weekly')">Weekly Schedule</button>
            </div>
</div>
    </x-slot>
    <div class="border border-1 mb-5"></div>
    <!-- ------------------------------------------------------------------------------ -->

    <form method="POST" id="availability" style="display:none;">
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
                            <div class="status-toggle">
                                <!-- <input id="rating_21" class="check" type="checkbox">
                                <label for="rating_21" class="checktoggle gle checkbox-bg">checkbox</label> -->
                                <div class="status-toggle px-2">
                                <input id="rating_21" class="check" type="checkbox" value="Inactive">
                                <label for="rating_21" class="checktoggle log checkbox-bg">checkbox</label>
                            </div>
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
                                            <!-- <input id="rating_24" class="check" type="checkbox">
                                            <label for="rating_24" class="checktoggle gle checkbox-bg">checkbox</label> -->
                                            <div class="status-toggle px-2">
                                <input id="rating_24" class="check" type="checkbox" value="Inactive">
                                <label for="rating_24" class="checktoggle log checkbox-bg">checkbox</label>
                            </div>
                                            <p class="profileUpdateFont text-dark">Unavailable</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button type="button"
                                        class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3">Afternoon</button>
                                    <div class="my-3">
                                        <div class="status-toggle">
                                            <!-- <input id="rating_22" class="check" type="checkbox">
                                            <label for="rating_22" class="checktoggle gle checkbox-bg">checkbox</label> -->
                                            <div class="status-toggle px-2">
                                <input id="rating_22" class="check" type="checkbox" value="Inactive">
                                <label for="rating_22" class="checktoggle log checkbox-bg">checkbox</label>
                            </div>
                                            <p class="profileUpdateFont text-dark">Unavailable</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button type="button"
                                        class="btn profileUpdateFont btn-size align-items-center fw-medium p-1 px-3">Evening</button>
                                    <div class="my-3">
                                        <div class="status-toggle">
                                            <!-- <input id="rating_23" class="check" type="checkbox">
                                            <label for="rating_23" class="checktoggle gle checkbox-bg">checkbox</label> -->
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

        <div class="float-end mt-2">
            <button type="button"
                class="btn profileUpdateFont btn-outline-dark align-items-center fw-medium px-4">Cancel</button>
            <button type="button" class="btn profileUpdateFont btnColor1 text-light fw-medium px-4 mx-2">Submit</button>
        </div>
    </form>

    <div id="weekly" style="display:none;">

        <div class="col-md-12 mb-5">
            <div class="d-flex flex-wrap">
                <!-- <div class="col-md-2"></div> -->
                <div class="col-md-9 offset-md-3 d-flex flex-wrap">
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
                <div class="col-md-3 text-dark d-flex align-items-center"><span class="day">Monday</span>
                    <div class="me-3">
                            <div class="status-toggle">
                                <input id="monday" class="check" type="checkbox" value="Inactive">
                                <label for="monday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-9 ps-sm-0" id="selected-schedule">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin" id="selected-schedule">
                <div class="col-md-3 text-dark d-flex align-items-center"><span class="day">Tuesday</span>
                    <div class="me-3">
                        <!-- <div class="status-toggle">
                            <input id="tuesday" class="check" type="checkbox" value="Inactive">
                            <label for="tuesday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div> -->
                            <div class="status-toggle">
                                <input id="tuesday" class="check" type="checkbox" value="Inactive">
                                <label for="tuesday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-9 ps-sm-0" id="selected-schedule">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin align-items-center">
                <div class="col-md-3 text-dark d-flex"><span class="day">Wednesday</span>
                    <div class="me-3">
                        <!-- <div class="status-toggle">
                            <input id="wednesday" class="check" type="checkbox" value="Inactive">
                            <label for="wednesday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div> -->
                            <div class="status-toggle ">
                                <input id="wednesday" class="check" type="checkbox" value="Inactive">
                                <label for="wednesday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-9 ps-sm-0" id="selected-schedule">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark d-flex"><span class="day">Thursday</span>
                    <div class="me-3">
                        <!-- <div class="status-toggle">
                            <input id="thursday" class="check" type="checkbox" value="Inactive">
                            <label for="thursday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div> -->
                            <div class="status-toggle">
                                <input id="thursday" class="check" type="checkbox" value="Inactive">
                                <label for="thursday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-9 ps-sm-0" id="selected-schedule">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark d-flex"><span class="day">Friday</span>
                    <div class="me-3">
                        <!-- <div class="status-toggle">
                            <input id="friday" class="check" type="checkbox" value="Inactive">
                            <label for="friday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div> -->
                        <div class="status-toggle ">
                                <input id="friday" class="check" type="checkbox" value="Inactive">
                                <label for="friday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-9 ps-sm-0" id="selected-schedule">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex flax-wrap margin-margin">
                <div class="col-md-3 text-dark d-flex"><span class="day">Saturday</span>
                    <div class="me-3">
                        <!-- <div class="status-toggle">
                            <input id="saturday" class="check" type="checkbox" value="Inactive">
                            <label for="saturday" class="checktoggle gle checkbox-bg">checkbox</label>
                            <p class="profileUpdateFont text-dark">On</p>
                        </div> -->
                        <div class="status-toggle ">
                                <input id="saturday" class="check" type="checkbox" value="Inactive">
                                <label for="saturday" class="checktoggle log checkbox-bg">checkbox</label>
                                <p class="profileUpdateFont text-dark">On</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-9 ps-sm-0" id="selected-schedule">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row gx-2">
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Opening Time">
                              </div>
                               <div class="col-md-6">
                               <input type="text" class="form-control inp" placeholder="Closing Time">
                             </div>
                            </div>
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
                document.getElementById('availabilitybtn').classList.add('active');
                document.getElementById('weeklybtn').classList.remove('active');
            } else if (type === 'weekly') {
                document.getElementById('availability').style.display = 'none';
                document.getElementById('weekly').style.display = 'block';
                document.getElementById('availabilitybtn').classList.remove('active');
                document.getElementById('weeklybtn').classList.add('active');
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


    </script>


    <script>
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
</x-app-layout>