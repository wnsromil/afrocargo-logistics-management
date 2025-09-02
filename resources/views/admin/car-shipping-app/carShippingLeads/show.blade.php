<x-app-layout>
    <x-slot name="header">
        Shipping Leads Details
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Shipping Leads Details</p>
    </x-slot>

    <div class="card p-0">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Lead ID</label>
                        <p>REQ-00001</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Customer Name</label>
                        <p>Brian Bordina</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Company Name</label>
                        <p>Star Light Enterprise</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Contact Details</label>
                        <p><i class="fe fe-phone fs_15 me-1 ibottom1"></i> +1 212323221</p>
                        <p><i class="fe fe-mail fs_15 me-1 ibottom1"></i> brianbordina@gmail.com</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Preferred Ship By</label>
                        <p>Ocean</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Vehicle Info</label>
                        <p>2015 Toyota Camry</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Vehicle Value</label>
                        <p>$30000</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Vehicle Insurance</label>
                        <p>$1500</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Pickup Location</label>
                        <p>florida campa, near Augiston church Tulsa, OK</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Date Requested</label>
                        <p>06-22-2025</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Assigned To</label>
                        <p>Lauren Pitbull</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Scheduled Date Time</label>
                        <p>06-08-2025, 05:30PM</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="d-block">Inspection Status</label>
                        <span class="badge bg-success-light fs_13 fw_500 py-2">
                            Scheduled
                        </span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="d-block">Status</label>
                        <span class="badge badge-soft-warning fs_13 fw_500 py-2">
                            In Progress
                        </span>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a data-bs-toggle="modal" data-bs-target="#InspectingScheduel" class="btn btn-primary me-2">Update
                    Scheduled</a>
            </div>
        </div>
    </div>



    <div class="modal fade" id="InspectingScheduel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inspection Scheduling</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Inspection Assigned To</label>
                            <select class="js-example-basic-single select2" name="main_type">
                                <option hidden selected disabled value="">Select Staff</option>
                                <option value="Alex Serpent">Alex Serpent</option>
                                <option value="Lauren Pitbull">Lauren Pitbull</option>
                                <option value="Christofer Durreno">Christofer Durreno</option>
                                <option value="Vernonica vemola">Vernonica vemola</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Scheduled Date Time</label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text"
                                    class="btn-filters datetimepicker form-control form-cs inp  text-lowercase"
                                    name="currentdate" placeholder="mm-dd-yyyy" />
                                <input type="text"
                                    class="form-control inp inputs text-center timeOnlyInput smallinput" readonly
                                    value="08:30 AM" name="currentTime">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor">Inspection Location</label>
                            <input type="text" class="form-control form-cs inp" name="InspectionLocation"
                                placeholder="Enter Location" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="foncolor">Notes</label>
                            <textarea type="text" class="form-control" name="notes" placeholder="Enter Your Message"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="checkbox-inline">
                                <label class="checkbox d-flex align-items-center gap-1">
                                    <input type="checkbox" name="Checkboxes3">
                                    <span></span>Notify Customer</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary confirm-supply me-2"
                        data-bs-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteData(self, msg) {
            Swal.fire({
                title: msg,
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(self).closest('form').submit();
                }
            });
        }
    </script>
</x-app-layout>
