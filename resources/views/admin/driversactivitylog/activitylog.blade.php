<x-app-layout>
    <x-slot name="header">
        {{ __('Driver Details') }}
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2 textSize fw-semibold">
                    Activity Logs
                </div>
            </div>
        </div>
    </x-slot>

    <div class="col-md-12">
        <div class="d-flex flex-wrap justify-content-between">

            <div class="col-md-4 mx-2">
                <label class="text-dark">By Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                    <input type="text" class="btn-filters form-control form-cs info" name="datetimes"
                        placeholder="2/12/2025 - 2/14/2025" style="border:none" />
                </div>
            </div>
            <div class="col-md-4 mx-2">
                <label class="text-dark">Activity Type</label>

                <select class="form-select" aria-label="Default select example">
                    <option selected>Select Category</option>
                    <option value="1">Category 1</option>
                </select>
            </div>
            <div class="col-md-3 twobutton mt-4">
                <button class="btn btn-primary btnf rounded-2">Filter</button>
                <button class="btn btn-outline-danger btnr">Reset</button>
            </div>
        </div>
    </div>


    <!-- --------------------------------------------------------------------- -->

    <div class="col-md-12">

        <div class="cd-horizontal-timeline">
            <div class="timeline tl1">
                <div class="events-wrapper">
                    <div class="events">
                        <ol class="text-dark">
                            <li><a href="#0" data-date="16/01/2014" class="selected">02-15-2025</a></li>
                            <li><a href="#0" data-date="28/02/2014">02-16-2025</a></li>
                            <li><a href="#0" data-date="20/04/2014">02-17-2025</a></li>
                            <li><a href="#0" data-date="20/05/2014">02-18-2025</a></li>
                            <li><a href="#0" data-date="09/07/2014">03-19-2025</a></li>
                            <li><a href="#0" data-date="30/08/2014">05-19-2025</a></li>
                            <li><a href="#0" data-date="15/09/2014">06-19-2025</a></li>
                            <li><a href="#0" data-date="01/11/2014">07-19-2025</a></li>
                            <li><a href="#0" data-date="10/12/2014">10-11-2025</a></li>
                            <li><a href="#0" data-date="19/01/2015">02-19-2025</a></li>
                            <li><a href="#0" data-date="03/03/2015">02-19-2025</a></li>
                        </ol>
                        <span class="filling-line" aria-hidden="true"></span>
                    </div>
                    <!-- events -->
                </div>
                <ul class="cd-timeline-navigation setColor">
                    <li><a href="#0" class="prev setColor">Prev</a></li>
                    <li><a href="#0" class="next setColor">Next</a></li>
                </ul>
                <!-- cd-timeline-navigation -->
            </div>


            
            <!-- timeline -->
            <div class="events-content">
                <ol>
                    <li class="selected dispaly-content" data-date="16/01/2014">
                        <div>
                            <div class="d-display">
                                <div class="card widthautoset border border-2 mb-3">
                                    <div class="card-body d-flex">
                                        <i class="fa-solid fa-clock icon-size-22" style="color: #FFD43B;"></i>
                                        <div class="cardh5Size fw-medium">
                                            <span class="opacity-50">08:45 AM —</span> Login
                                            <br>
                                            <span class="opacity-50">Amount :</span> $500

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="d-display">
                                <div class="card widthautoset border border-2 mb-3">
                                    <div class="card-body d-flex">
                                        <i class="fa-solid fa-clock icon-size-22" style="color: #FFD43B;"></i>
                                        <div class="cardh5Size fw-medium">
                                            <span class="opacity-50">10:15 AM —</span> Customer Added
                                            <br>
                                            <span class="opacity-50">Customer Name:</span> Acme Corp
                                            <br>
                                            <button type="button"
                                                class="btn btn-outline-dark mt-3 bg-secondary-subtle">View</button>

                                            <button type="button"
                                                class="btn btn-outline-danger mt-3 bg-danger-subtle">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-display">
                                <div class="card widthautoset border border-2 mb-3">
                                    <div class="card-body d-flex">
                                        <i class="fa-solid fa-clock icon-size-22" style="color: #FFD43B;"></i>
                                        <div class="cardh5Size fw-medium">
                                            <span class="opacity-50">12:30 PM —</span> Order Pickup Scheduled
                                            <br>
                                            <span class="opacity-50">Tracking ID:</span> WE97078893
                                            <br>
                                            <span class="opacity-50">Pickup Date:</span> 02-15-2025
                                            <br>
                                            <button type="button"
                                                class="btn btn-outline-dark mt-3 bg-secondary-subtle">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dispaly-content" data-date="28/02/2014">
                        <div>
                            <div class="d-display">
                                <div class="card widthautoset border border-2 mb-3">
                                    <div class="card-body d-flex">
                                        <i class="fa-solid fa-clock icon-size-22" style="color: #FFD43B;"></i>
                                        <div class="cardh5Size fw-medium">
                                            <span class="opacity-50">02:00 PM —</span> Payment Collected
                                            <br>
                                            <span class="opacity-50">Amount :</span> $500
                                            <br>
                                            <span class="opacity-50">Mode :</span> Cash
                                            <br>
                                            <button type="button"
                                                class="btn btn-outline-dark mt-3 bg-secondary-subtle">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-display">
                                <div class="card widthautoset border border-2 mb-3">
                                    <div class="card-body d-flex">
                                        <i class="fa-solid fa-clock icon-size-22" style="color: #FFD43B;"></i>
                                        <div class="cardh5Size fw-medium">
                                            <span class="opacity-50">03:45 PM —</span> Customer Deleted
                                            <br>
                                            <span class="opacity-50">Customer Name :</span> Acme Corp
                                            <br>
                                            <button type="button"
                                                class="btn btn-outline-danger mt-3 bg-danger-subtle">Delete</button>
                                            <button type="button"
                                                class="btn btn-outline-success mt-3 bg-success-subtle">Restore</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-display">
                                <div class="card widthautoset border border-2 mb-3">
                                    <div class="card-body d-flex">
                                        <i class="fa-solid fa-clock icon-size-22" style="color: #FFD43B;"></i>
                                        <div class="cardh5Size fw-medium">
                                            <span class="opacity-50">04:30 PM —</span>0 Invoice Deleted
                                            <br>
                                            <span class="opacity-50">Invoice ID:</span> INV-12345
                                            <br>
                                            <button type="button"
                                                class="btn btn-outline-dark mt-3 bg-secondary-subtle">View</button>
                                            <button type="button"
                                                class="btn btn-outline-success mt-3 bg-success-subtle">Restore</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</x-app-layout>