<x-app-layout>
    <x-slot name="header">
        Schedule RORO shipment
    </x-slot>
    @section('style')
        <style>
            .page-header,
            .content-page-header {
                margin-bottom: 0px !important;
            }

            .custom-uploader {
                border: 2px dashed #dadada;
                border-radius: 8px;
                padding: 15px;
                text-align: center;
                cursor: pointer;
                position: relative;
                transition: border-color 0.2s ease;
                height: 100px;
                align-content: center;
            }

            .custom-uploader:hover {
                border-color: #203f5f;
            }

            .custom-uploader input[type="file"] {
                position: absolute;
                width: 100%;
                height: 100%;
                opacity: 0;
                cursor: pointer;
                top: 0;
                left: 0;
            }

            .preview-image {
                max-height: 60px;
                object-fit: cover;
                border-radius: 6px;
            }
        </style>
    @endsection

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Schedule RORO shipment</p>
        </div>
    </x-slot>


    <form>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="foncolor">Customer Name</label>
                <input type="text" class="form-control form-cs inp ps-3" name="customerName"
                    placeholder="Enter Customer Name" readonly value="Charls Xavier" />
            </div>

            <div id="vehicleDocumentWrapper" class="col-sm-12">
                <div class="row vehicleRow">
                    <!-- Vehicle List -->
                    <div class="col-lg-3 col-md-3 col-sm-12 pe-2">
                        <div class="mb-2">
                            <label class="foncolor">Vehicle List <i class="text-danger">*</i></label>
                            <select name="vehicle_list[]" class="form-control select2Tags">
                                <option hidden disabled selected value="">Select Vehicle</option>
                                <option value="1">Vehicle A</option>
                                <option value="2">Vehicle B</option>
                                <option value="3">Vehicle C</option>
                            </select>
                        </div>
                    </div>

                    <!-- Vehicle Title -->
                    <div class="col-lg-3 col-md-3 col-sm-12 ps-2 pe-2">
                        <div class="mb-2">
                            <label class="foncolor">Vehicle Title <i class="text-danger">*</i></label>
                            <input type="file" name="vehicle_title[]" class="form-control form-cs inp typeFile">
                        </div>
                    </div>

                    <!-- Bill of Lading -->
                    <div class="col-lg-3 col-md-3 col-sm-12 ps-2 pe-2">
                        <div class="mb-2">
                            <label class="foncolor">Bill of Lading <i class="text-danger">*</i></label>
                            <input type="file" name="bill_of_lading[]" class="form-control form-cs inp typeFile">
                        </div>
                    </div>

                    <!-- Additional Documents -->
                    <div class="col-lg-3 col-md-3 col-sm-12 ps-2">
                        <div class="mb-2">
                            <label class="foncolor">Additional Documents <i class="text-danger">*</i></label>
                            <input type="file" name="AdditionalDocuments[]" class="form-control form-cs inp typeFile">
                        </div>
                    </div>

                    <!-- Add/Delete Buttons -->
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-danger iconBtn deletebutton"><i
                                class="ti ti-minus"></i></button>
                        <button type="button" class="btn btn-primary iconBtn addbutton"><i
                                class="ti ti-plus"></i></button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label class="foncolor">Vessel Name <i class="text-danger">*</i></label>
                <input type="text" class="form-control form-cs inp ps-3" name="vesselName"
                    placeholder="Enter Vessel Name" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Shipping Line / Company <i class="text-danger">*</i></label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Shipping Line / Company</option>
                    <option value="MSC">MSC</option>
                    <option value="ISC">ISC</option>
                    <option value="SuperSonic">SuperSonic</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Departure Port <i class="text-danger">*</i></label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Port</option>
                    <option value="Tulsa">Tulsa</option>
                    <option value="Arizona">Arizona</option>
                    <option value="NYC">NYC</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Arrival Port <i class="text-danger">*</i></label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Port</option>
                    <option value="Cocchin">Cocchin</option>
                    <option value="Port Blare">Port Blare</option>
                    <option value="Vizag">Vizag</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Departure Date & Time <i class="text-danger">*</i></label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info d-flex flex-wrap dateTime">
                    <input type="text" class="btn-filters datetimepicker form-control form-cs inp text-lowercase"
                        name="InspectionDateTime" placeholder="mm-dd-yyyy" />
                    <input type="text"
                        class="form-control inp inputs text-center onlyTimePicker smallinput flatpickr-input d-inline"
                        value="08:30 AM" name="currentTime">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Arrival Date & Time <i class="text-danger">*</i></label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info d-flex flex-wrap dateTime">
                    <input type="text" class="btn-filters datetimepicker form-control form-cs inp text-lowercase"
                        name="InspectionDateTime" placeholder="mm-dd-yyyy" />
                    <input type="text"
                        class="form-control inp inputs text-center onlyTimePicker smallinput flatpickr-input d-inline"
                        value="08:30 AM" name="currentTime">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Assign Container <i class="text-danger">*</i></label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Container</option>
                    <option value="CNUS-000008-25">CNUS-000008-25</option>
                    <option value="CNUS-000008-23">CNUS-000008-23</option>
                    <option value="CNUS-000008-22">CNUS-000008-22</option>
                    <option value="CNUS-000008-21">CNUS-000008-21</option>
                    <option value="CNUS-000008-20">CNUS-000008-20</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Change Status <i class="text-danger">*</i></label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Status</option>
                    <option value="Upcoming">Upcoming</option>
                    <option value="In Transit">In Transit</option>
                    <option value="On Loading">On Loading</option>
                    <option value="Unloading">Unloading</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label class="foncolor">Add Notes</label>
                <textarea class="form-control" id="frontNotes" name="containerNotes" placeholder="Add Notes" rows="3"></textarea>
            </div>


            <div class="col-12 mt-4">
                <div class="add-customer-btns text-end">
                    <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="button" class="btn btn-primary" id="kt_sweetalert_demo_4">Submit</button>
                </div>
            </div>

        </div>
    </form>

    @section('script')
        <script>
            $(document).ready(function() {
                $("#kt_sweetalert_demo_4").click(function(e) {
                    Swal.fire({
                        title: false,
                        text: "Are you sure you want to change scheduel status  as 'On Loading'?",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Confirm",
                        showCancelButton: true,
                        cancelButtonText: "No",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-outline-primary",
                            popup: 'imgMargin'
                        }
                    });
                });
            });
        </script>
    @endsection

</x-app-layout>
