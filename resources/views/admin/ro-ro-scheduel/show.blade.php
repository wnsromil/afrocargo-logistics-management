<x-app-layout>
    <x-slot name="header">
        ro-ro-scheduel Details
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head mtop-20">ro-ro-scheduel Details</p>
        <div class="d-flex align-items-center justify-content-end mb-1 ">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a data-bs-toggle="modal" data-bs-target="#InspectingScheduel" class="btn btn-primary me-2">Update
                        Status</a>
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
            <div id='ajexTable'>
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive notMinheight mt-3">
                            <table class="table table-stripped table-hover datatable pxless notposition">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Vehicle Info</th>
                                        <th>Docs</th>
                                        <th>Vessel</th>
                                        <th>Loading Status</th>
                                        <th>Loading Time (In/Out)</th>
                                        <th>Loading By</th>
                                        <th>Unloading Status</th>
                                        <th>Unloading Time</th>
                                        <th>Unloading By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="td fs_14 pb-0"><i class="me-2 ti ti-car"></i> BMW X5 (VIN:
                                                2JF567155545441)
                                            </div>
                                            <div class="td fs_14"><i class="me-2 ti ti-user"></i> Aliyu Bello
                                            </div>
                                        </td>
                                        <td><a data-bs-toggle="modal" data-bs-target="#documentShows" class="imgover"><i
                                                    class="ti ti-photo fs_24"></i></a></td>
                                        <td>MV Liberty</td>
                                        <td><span class="badge badge-soft-warning fw_mid fs_13 py-2">Pending</span></td>
                                        <td>06-29-2025 10:00 PM</td>
                                        <td>Brian Bordina</td>
                                        <td><span class="badge badge-soft-warning fw_mid fs_13 py-2">Pending</span></td>
                                        <td>07-03-2025 10:00 PM</td>
                                        <td>Clark Markham</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="td fs_14 pb-0"><i class="me-2 ti ti-car"></i> Toyota Corolla
                                                (VIN:
                                                4DXE44GYT653)
                                            </div>
                                            <div class="td fs_14"><i class="me-2 ti ti-user"></i> Aliyu Bello
                                            </div>
                                        </td>
                                        <td><a data-bs-toggle="modal" data-bs-target="#documentShows" class="imgover"><i
                                                    class="ti ti-photo fs_24"></i></a></td>
                                        <td>MV Liberty</td>
                                        <td><span class="badge badge-soft-warning fw_mid fs_13 py-2">Pending</span></td>
                                        <td>06-29-2025 10:00 PM</td>
                                        <td>Brian Bordina</td>
                                        <td><span class="badge badge-soft-warning fw_mid fs_13 py-2">Pending</span></td>
                                        <td>07-03-2025 10:00 PM</td>
                                        <td>Clark Markham</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Schedule RORO shipment --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Schedule RORO shipment</h6>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>RoRo ID</label>
                        <p>RORO-2025-001</p>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Assigned Container</label>
                        <p>CNUS-000008-20</p>
                    </div>
                </div> --}}
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Shipping Line / Company</label>
                        <p>MSE</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Ports</label>
                        <p>Houston → Lagos</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Departure Date & Time</label>
                        <p>06-25-2025 12:40 AM</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Arrival Date & Time</label>
                        <p>07-05-2025 12:40 AM</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Inspection Status</label>
                        <p><span class="badge bg-success-light fw_mid fs_13 py-2">Inspection Completed </span></p>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="input-block mb-3">
                        <label>Notes</label>
                        <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed, mattis ac tortor.
                            pharetra urna Etiam ex odio, rhoncus</p>
                    </div>
                </div>


                {{-- Pickup Arrangement --}}
                <div class="col-12">
                    <h6 class="bl-3 py-1 ps-3 my-3 fs_18">Pickup Arrangement Details</h6>
                </div>
                <div class="col-12 mb-3">
                    <div class="card rounded-3 border-primary mb-0 secondway">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Vehicle Details</label>
                                    <p>2015 Toyota Camry</p>
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
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Pickup by</label>
                                    <p>Pickup by Company</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Assign Driver</label>
                                    <p>Amber Heard</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Pickup Date Time</label>
                                    <p>06-21-2025 12:00 AM</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Pickup Location</label>
                                    <p>AFRO NYC Warehouse NYC</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Pickup Status</label>
                                    <p><span class="badge badge-soft-success fw_mid fs_13 py-2">Picked Up</span></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Notes</label>
                                    <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed,
                                        mattis actortor. condimentum nulla ac, pharetra urna. Etiam ex odio.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card rounded-3 border-primary mb-0 secondway">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Vehicle Details</label>
                                    <p>2018 BMW X5</p>
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
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Pickup by</label>
                                    <p>Self Pickup</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">

                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Pickup Date Time</label>
                                    <p>06-21-2025 12:00 AM</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Pickup Location</label>
                                    <p>AFRO NYC Warehouse NYC</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Pickup Status</label>
                                    <p><span class="badge badge-soft-danger fw_mid fs_13 py-2">Awaiting Drop</span></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-block mb-3">
                                    <label>Notes</label>
                                    <p>condimentum nulla ac, pharetra urna. Etiam ex odio, rhoncus ut commodo sed,
                                        mattis actortor. condimentum nulla ac, pharetra urna. Etiam ex odio.</p>
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
    <div class="modal fade" id="documentShows" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Uploaded Documents</h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="foncolor d-block mb-2">Vehicle Title</label>
                            <label class="imgHoverLabel mb-0">
                                <img class="mx-width" src="{{ asset('assets/img/placeholderImgss.png') }}">
                                <img class="hoverTooltip" src="{{ asset('assets/img/placeholderImgss.png') }}"></label>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor d-block mb-2">Bill of Lading</label>
                            <label class="imgHoverLabel mb-0">
                                <img class="mx-width" src="{{ asset('assets/img/placeholderImgss.png') }}">
                                <img class="hoverTooltip" src="{{ asset('assets/img/placeholderImgss.png') }}"></label>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="foncolor d-block mb-2">Additional Documents</label>
                            <label class="imgHoverLabel mb-0">
                                <img class="mx-width" src="{{ asset('assets/img/placeholderImgss.png') }}">
                                <img class="hoverTooltip" src="{{ asset('assets/img/placeholderImgss.png') }}"></label>
                            <label class="imgHoverLabel mb-0">
                                <img class="mx-width" src="{{ asset('assets/img/placeholderImgss.png') }}">
                                <img class="hoverTooltip" src="{{ asset('assets/img/placeholderImgss.png') }}"></label>
                        </div>
                    </div>
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
