<x-app-layout>
    <x-slot name="header">
        Vehicle Inspection Details
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head mtop-20">Vehicle Inspection Details</p>
        <div class="d-flex align-items-center justify-content-end mb-1 ">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a data-bs-toggle="modal" data-bs-target="#InspectingScheduel" class="btn btn-primary me-2">Update
                        Scheduled</a>
                    <a href="#" class="btn btn-primary">Upade</a>
                </div>
            </div>
        </div>
    </x-slot>
    @section('style')
        <style>
            .page-header {
                position: sticky;
                top: 65px;
                z-index: 99;
                background: white;
            }
        </style>
    @endsection


    <div class="card p-0">
        <div class="card-body p-0">
            <div class="row gx-3">
                {{-- Shipper Information --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Shipper Information</h6>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="input-block">
                        <label>inspection ID</label>
                        <p>INS-2025-001</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="input-block">
                        <label>Customer Name</label>
                        <p>Brian Bordina</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="input-block">
                        <label>Contact Details</label>
                        <p><i class="fe fe-phone fs_15 me-1 nbottom1"></i> +1 212323221</p>
                        <p><i class="fe fe-mail fs_15 me-1 nbottom1"></i> brianbordina@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                     <div class="input-block">
                        <label>Address</label>
                        <p>florida campa, near Augiston church Tulsa, OK</p>
                    </div>
                </div>

                {{-- ehicle Details --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Vehicle Details</h6>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Vehicle Info</label>
                        <p>2015 Toyota Camry</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>VIN Number</label>
                        <p>2015FR445G345452</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Vehicle Color</label>
                        <p>Matt Black</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Odometer Reading</label>
                        <p>55554</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Fuel Level</label>
                        <p>1/4 Tank</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Vehicle Value</label>
                        <p>$45000</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Vehicle Insurance</label>
                        <p>$12000</p>
                    </div>
                </div>

                {{-- Pickup Location --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Pickup Location</h6>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Company Name</label>
                        <p>Jaffery FX</p>
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
                        <label>Contact Details</label>
                        <p><i class="fe fe-phone fs_15 me-1 nbottom1"></i> +1 212323221</p>
                        <p><i class="fe fe-mail fs_15 me-1 nbottom1"></i> brianbordina@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Address</label>
                        <p>florida campa, near Augiston church Tulsa, OK</p>
                    </div>
                </div>

                {{-- Consignee details --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Consignee details</h6>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Company Name</label>
                        <p>Liberty Limes</p>
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
                        <label>Contact Details</label>
                        <p><i class="fe fe-phone fs_15 me-1 nbottom1"></i> +1 212323221</p>
                        <p><i class="fe fe-mail fs_15 me-1 nbottom1"></i> brianbordina@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Address</label>
                        <p>florida campa, near Augiston church Tulsa, OK</p>
                    </div>
                </div>

                {{-- Paperwork & Key Information --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Paperwork & Key Information</h6>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Keys Provided?</label>
                        <p>Yes</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Title Document Provided?</label>
                        <p>Yes</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Vehicle Starts?</label>
                        <p>Yes (Mandatory)</p>
                    </div>
                </div>

                {{-- Exterior Condition Checklist --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Exterior Condition Checklist</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Front Bumper</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div clas mt-3 mb-1s="col-md-12">
                                <label class="fs_16">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Rear Bumper</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div clas mt-3 mb-1s="col-md-12">
                                <label class="fs_16">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Hood</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Roof</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Left Fender</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Right Fender</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Left Front Door</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Left Rear Door</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Right Front Door</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Right Rear Door</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Trunk / Hatch</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Front Windshield</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Rear Windshield</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Mirrors (Left/Right)</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Headlights</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">License Plates</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Wheels (4 Total)</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs_16">Tires</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs_16">Condition</label>
                                <p>Scratched, Dented, Dusted</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="fs_16">Leaking Fluids Check</label>
                            </div>
                            <div class="col-md-6">
                                <p>Engine Oil, Brake Fluid, Coolant (Radiator), Transmission
                                    Fluid</p>
                            </div>
                            <div class="col-md-12">
                                <label class="fs_16 mt-3 mb-1">Note</label>
                                <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac
                                    tortor.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mechanical Check --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Mechanical Check</h6>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="fs_16 foncolor">Engine Condition</label>
                                <div class="div"></div>
                            </div>
                            <div class="col-md-12">
                                <p>Starts, Leak</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="fs_16 foncolor">Transmission Condition</label>
                                <div class="div"></div>
                            </div>
                            <div class="col-md-12">
                                <p>Smooth, Slipping</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="fs_16 foncolor">Battery Condition</label>
                                <div class="div"></div>
                            </div>
                            <div class="col-md-12">
                                <p>Dead</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="fs_16 foncolor">Brake Condition</label>
                                <div class="div"></div>
                            </div>
                            <div class="col-md-12">
                                <p>Good</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Additional Notes & Uploads --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Additional Notes & Uploads</h6>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="fs_16">Additional Observations</label>
                                <div class="div"></div>
                            </div>
                            <div class="col-md-12">
                                <p>Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría
                                    sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras
                                    aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem
                                    Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio
                                    del texto.</p>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-8">
                                <label class="fs_16">Extra Image Upload (Scratch, rust, etc.)</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                    <img class="uploadedimg"
                                        src="{{ asset('assets/images/inception_placeholder.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="fs_16">Signature</label>
                                <div class="div">
                                    <img class="uploadedimg signature"
                                        src="{{ asset('assets/images/signature_img.jpg') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Inspection Officer Info --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Inspection Officer Info</h6>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card rounded-3 border-primary mb-0">
                        <div class="row">
                            <div class="mb-3 mb-sm-0 col-lg-3 col-md-6 col-sm-12">
                                <label class="fs_16">Inspection Done By</label>
                                <p>Michel Bay</p>
                            </div>
                            <div class="mb-3 mb-sm-0 col-lg-3 col-md-6 col-sm-12">
                                <label class="fs_16">Date & Time</label>
                                <p>09/25-2025 10:40 AM</p>
                            </div>
                            <div class="mb-3 mb-sm-0 col-lg-3 col-md-6 col-sm-12">
                                <div>
                                    <label class="fs_16">Inspection Status</label><br>
                                    <span class="badge fw-medium bg-success-light fs_13 py-2">Inspection Completed
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3 mb-sm-0 col-lg-3 col-md-6 col-sm-12">
                                <div>
                                    <label class="fs_16">Status</label><br>
                                    <span class="badge fw-medium bg-success-light fs_13 py-2">
                                        In Progress
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            {{-- <div class="text-end">

            </div> --}}
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
