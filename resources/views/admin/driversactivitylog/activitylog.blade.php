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
							<div class="card">
								<div class="card-body">
									<div class="cd-horizontal-timeline">
                                    <div class="timeline">
                                        <div class="events-wrapper">
                                            <div class="events">
                                                <ol>
                                                    <li><a href="#0" data-date="16/01/2014" class="selected">16 Jan</a></li>
                                                    <li><a href="#0" data-date="28/02/2014">28 Feb</a></li>
                                                    <li><a href="#0" data-date="20/04/2014">20 Mar</a></li>
                                                    <li><a href="#0" data-date="20/05/2014">20 May</a></li>
                                                    <li><a href="#0" data-date="09/07/2014">09 Jul</a></li>
                                                    <li><a href="#0" data-date="30/08/2014">30 Aug</a></li>
                                                    <li><a href="#0" data-date="15/09/2014">15 Sep</a></li>
                                                    <li><a href="#0" data-date="01/11/2014">01 Nov</a></li>
                                                    <li><a href="#0" data-date="10/12/2014">10 Dec</a></li>
                                                    <li><a href="#0" data-date="19/01/2015">29 Jan</a></li>
                                                    <li><a href="#0" data-date="03/03/2015">3 Mar</a></li>
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
                                                <h3><small>Title 01</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="28/02/2014">
                                                <h3> <small>Title 02</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="20/04/2014">
                                                <h3><small>Title 03</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="20/05/2014">
                                                <h3><small>Title 04</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="09/07/2014">
                                                <h3><small>Title 05</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="30/08/2014">
                                                <h3> <small>Title 06</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="15/09/2014">
                                                <h3><small>Title 07</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="01/11/2014">
                                                <h3> <small>Event List</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="10/12/2014">
                                                <h3><small>Event Item</small></h3>
                                                <p class="m-t-40">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="19/01/2015">
                                                <h3><small>Event title</small></h3>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                            <li data-date="03/03/2015">
                                                <h3><small>Event title</small></h3>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                </p>
                                            </li>
                                        </ol>
                                    </div>
                                    <!-- .events-content -->
                                </div>
								</div>
							</div>
						</div>
</x-app-layout>