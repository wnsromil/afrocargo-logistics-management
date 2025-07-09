<x-app-layout>
    <x-slot name="header">
        Vehicle Inspection
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
            <p class="subhead pheads">Add Vehicle Inspection</p>
        </div>
    </x-slot>


    <form>
        <div class="row">
            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22">Vehicle Details</h6>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Year</label>
                <input type="number" class="form-control form-cs inp ps-3" name="vehicleCreatedYear"
                    placeholder="Enter Year" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Vehicle Make</label>
                <input type="text" class="form-control form-cs inp ps-3" name="vehicleMake"
                    placeholder="Enter Vehicle Make" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Vehicle Model</label>
                <input type="text" class="form-control form-cs inp ps-3" name="vehicleModel"
                    placeholder="Enter Vehicle Model" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">VIN Number</label>
                <input type="text" class="form-control form-cs inp ps-3" name="VINnumber"
                    placeholder="Enter VIN Number" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Vehicle Value</label>
                <input type="text" class="form-control form-cs inp ps-3" name="vehicleValue"
                    placeholder="Enter Vehicle Value" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Vehicle Color</label>
                <input type="text" class="form-control form-cs inp ps-3" name="vehicleColor"
                    placeholder="Enter Vehicle Color" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Odometer Reading</label>
                <input type="text" class="form-control form-cs inp ps-3" name="OdometerReading"
                    placeholder="Enter Odometer Reading" />
            </div>

            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22">Shipper Information</h6>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Full Name</label>
                <input type="text" class="form-control form-cs inp ps-3" name="fullName"
                    placeholder="Enter Full Name" value="Alex Carrey" readonly />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Company Name</label>
                <input type="text" class="form-control form-cs inp ps-3" name="CompanyName"
                    placeholder="Enter Company Name" value="Neo Auto Mobiles" readonly />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Email ID</label>
                <input type="email" class="form-control form-cs inp ps-3" name="emailID" placeholder="Enter Email ID"
                    value="alex1@gmail.com" readonly />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor" for="alternate_mobile_no">Mobile No.</label>
                <div class="flaginputwrap newCustom">
                    <div class="customflagselect disabled">
                        <select class="flag-select" disabled readonly name="mobile_number_code_id">
                            @foreach ($coutry as $key => $item)
                                <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                    data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                    {{ $item->name }} +{{ $item->phonecode }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No"
                        name="mobile_number" value="2159658452" readonly oninput="this.value = this.value.slice(0, 10)">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Address1</label>
                <input type="text" class="form-control form-cs inp ps-3" name="Address1" placeholder="Enter Address1"
                    value="NYC NY USA" readonly />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Address2(optional)</label>
                <input type="text" class="form-control form-cs inp ps-3" name="Address2"
                    placeholder="Enter Address2" value="Tulsa Airport Tulsa OK USA" readonly />
            </div>

            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22">Pickup Location</h6>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Company Name</label>
                <input type="text" class="form-control form-cs inp ps-3" name="PickupCompanyName"
                    placeholder="Enter Company Name" value="" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Full Name</label>
                <input type="text" class="form-control form-cs inp ps-3" name="PickupfullName"
                    placeholder="Enter Full Name" value="" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Email ID</label>
                <input type="email" class="form-control form-cs inp ps-3" name="PickupemailID"
                    placeholder="Enter Email ID" value="" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor" for="alternate_mobile_no">Mobile No.</label>
                <div class="flaginputwrap newCustom">
                    <div class="customflagselect">
                        <select class="flag-select" name="mobile_number_code_id">
                            @foreach ($coutry as $key => $item)
                                <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                    data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                    {{ $item->name }} +{{ $item->phonecode }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No"
                        name="Pickupmobile_number" value="2159658452" oninput="this.value = this.value.slice(0, 10)">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Address1</label>
                <input type="text" class="form-control form-cs inp ps-3" name="PickupAddress1"
                    placeholder="Enter Address1" value="" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Address2(optional)</label>
                <input type="text" class="form-control form-cs inp ps-3" name="PickupAddress2"
                    placeholder="Enter Address2" value="" />
            </div>

            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22">Consignee details</h6>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Company Name</label>
                <input type="text" class="form-control form-cs inp ps-3" name="ConsigneeCompanyName"
                    placeholder="Enter Company Name" value="" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Full Name</label>
                <input type="text" class="form-control form-cs inp ps-3" name="ConsigneefullName"
                    placeholder="Enter Full Name" value="" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Email ID</label>
                <input type="email" class="form-control form-cs inp ps-3" name="ConsigneeemailID"
                    placeholder="Enter Email ID" value="" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor" for="alternate_mobile_no">Mobile No.</label>
                <div class="flaginputwrap newCustom">
                    <div class="customflagselect">
                        <select class="flag-select" name="Consigneemobile_number_code_id">
                            @foreach ($coutry as $key => $item)
                                <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                    data-name="{{ $item->name }}" data-code="{{ $item->phonecode }}">
                                    {{ $item->name }} +{{ $item->phonecode }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="number" class="form-control flagInput inp" placeholder="Enter Mobile No"
                        name="Consigneemobile_number" value="2159658452"
                        oninput="this.value = this.value.slice(0, 10)">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Address1</label>
                <input type="text" class="form-control form-cs inp ps-3" name="ConsigneeAddress1"
                    placeholder="Enter Address1" value="" />
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Address2(optional)</label>
                <input type="text" class="form-control form-cs inp ps-3" name="ConsigneeAddress2"
                    placeholder="Enter Address2" value="" />
            </div>

            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22">Paperwork & Key Information</h6>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Keys Provided?</label>
                <div class="d-flex">
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                        <input class="form-check-input mt-0" type="radio" value="Yes" name="KeysProvided">
                    </div>
                    <div class="input-block d-flex align-items-center">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                        <input class="form-check-input mt-0" type="radio" value="No" name="KeysProvided">
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Title Document Provided?</label>
                <div class="d-flex">
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                        <input class="form-check-input mt-0" type="radio" value="Yes"
                            name="TitleDocumentProvided">
                    </div>
                    <div class="input-block d-flex align-items-center">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                        <input class="form-check-input mt-0" type="radio" value="No"
                            name="TitleDocumentProvided">
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Vehicle Starts?</label>
                <div class="d-flex">
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                        <input class="form-check-input mt-0" type="radio" value="Yes" name="VehicleStarts">
                    </div>
                    <div class="input-block d-flex align-items-center">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                        <input class="form-check-input mt-0" type="radio" value="No" name="VehicleStarts">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22">Exterior Condition Checklist</h6>
            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Front Bumper</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Rear Bumper</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Hood</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Roof</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Left Fender</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Right Fender</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Left Front Door</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Left Rear Door</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Right Front Door</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Right Rear Door</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Trunk / Hatch</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Front Windshield</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Rear Windshield</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Mirrors (Left/Right)</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Headlights</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Taillights</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">License Plates</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Wheels (4 Total)</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Tires</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Worn</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Flat</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22">Interior Condition Checklist</h6>
            </div>

            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Dashboard</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Seats (Front/Rear)</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Floor Mats / Carpets</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Center Console</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-2 mb-sm-0">Steering Wheel</h5>

                    <div class="centerBetween">
                        <div class="form-group">
                            <label>Condition:</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontGood"
                                    name="front_condition[]" value="Good">
                                <label class="form-check-label mt_2" for="frontGood">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontScratched"
                                    name="front_condition[]" value="Scratched">
                                <label class="form-check-label mt_2" for="frontScratched">Scratched</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontDented"
                                    name="front_condition[]" value="Dented">
                                <label class="form-check-label mt_2" for="frontDented">Dented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontRusted"
                                    name="front_condition[]" value="Rusted">
                                <label class="form-check-label mt_2" for="frontRusted">Rusted</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="frontMissing"
                                    name="front_condition[]" value="Missing">
                                <label class="form-check-label mt_2" for="frontMissing">Missing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-uploader" onclick="document.getElementById('frontImage').click();">
                                <p id="frontText">

                                    <i class="d-block fs_18 fa-solid fa-upload"></i> Drag or tap to
                                    upload
                                    image<br><small>Upload clear
                                        photo</small>
                                </p>
                                <input type="file" accept="image/*" capture="environment" id="frontImage"
                                    onchange="previewUpload(event, 'frontPreview', 'frontText')" />
                                <img id="frontPreview" class="preview-image d-none" />
                            </div>
                        </div>
                        <div class="form-group maxw_200">
                            <label for="frontNotes">Notes (optional):</label>
                            <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-3">AC / Heater</h5>
                    <div class="d-flex">
                        <div class="input-block d-flex align-items-center me-3">
                            <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                            <input class="form-check-input mt-0" type="radio" value="Yes"
                                name="VehicleStarts">
                        </div>
                        <div class="input-block d-flex align-items-center">
                            <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                            <input class="form-check-input mt-0" type="radio" value="No"
                                name="VehicleStarts">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 rounded-3 setCard mb-3">
                    <h5 class="card-title fs_18 mb-3">Stereo System</h5>
                    <div class="d-flex">
                        <div class="input-block d-flex align-items-center me-3">
                            <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                            <input class="form-check-input mt-0" type="radio" value="Yes"
                                name="VehicleStarts">
                        </div>
                        <div class="input-block d-flex align-items-center">
                            <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                            <input class="form-check-input mt-0" type="radio" value="No"
                                name="VehicleStarts">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22">Mechanical Check</h6>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Engine Condition</label>
                <div class="d-flex">
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Starts</label>
                        <input class="form-check-input mt-0" type="radio" value="Starts"
                            name="EngineCondition">
                    </div>
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Leaks</label>
                        <input class="form-check-input mt-0" type="radio" value="Leaks"
                            name="EngineCondition">
                    </div>
                    <div class="input-block d-flex align-items-center">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">No Start</label>
                        <input class="form-check-input mt-0" type="radio" value="No Start"
                            name="EngineCondition">
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Transmission Condition</label>
                <div class="d-flex">
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Smooth</label>
                        <input class="form-check-input mt-0" type="radio" value="Smooth"
                            name="TransmissionCondition">
                    </div>
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Slipping</label>
                        <input class="form-check-input mt-0" type="radio" value="Slipping"
                            name="TransmissionCondition">
                    </div>
                    <div class="input-block d-flex align-items-center">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">N/A</label>
                        <input class="form-check-input mt-0" type="radio" value="N/A"
                            name="TransmissionCondition">
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Battery Condition</label>
                <div class="d-flex">
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Good</label>
                        <input class="form-check-input mt-0" type="radio" value="Good"
                            name="BatteryCondition">
                    </div>
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Weak</label>
                        <input class="form-check-input mt-0" type="radio" value="Weak"
                            name="BatteryCondition">
                    </div>
                    <div class="input-block d-flex align-items-center">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Dead</label>
                        <input class="form-check-input mt-0" type="radio" value="Dead"
                            name="BatteryCondition">
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="foncolor">Brake Functionality</label>
                <div class="d-flex">
                    <div class="input-block d-flex align-items-center me-3">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">Yes</label>
                        <input class="form-check-input mt-0" type="radio" value="Yes"
                            name="BrakeFunctionality">
                    </div>
                    <div class="input-block d-flex align-items-center">
                        <label class="foncolor mb-0 pt-0 me-2 col3A">No</label>
                        <input class="form-check-input mt-0" type="radio" value="No"
                            name="BrakeFunctionality">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22">Additional Notes & Uploads</h6>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="frontNotes">Additional Observations</label>
                    <textarea class="form-control" id="frontNotes" name="front_notes" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <h5 class="card-title fs_16 mb-3">Extra Image Upload (Scratch, rust, etc.)</h5>
                <div class="form-group">
                    <div class="custom-uploader multiple">
                        <p id="frontText">
                            <i class="d-block fs_18 fa-solid fa-upload"></i>
                            Drag or tap to upload image<br><small>Upload clear photo</small>
                        </p>
                        <input type="file" accept="image/*" capture="environment" id="frontImage" multiple
                            onchange="previewMultipleUpload(event, 'frontPreviewContainer', 'frontText')" />
                        <div id="frontPreviewContainer" class="d-flex justify-content-center flex-wrap mt-2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <h5 class="card-title fs_16 mb-3">Signature</h5>
                <div class="form-group">
                    <div class="custom-uploader multiple">
                        <p id="frontText">
                            <i class="d-block fs_18 fa-solid fa-upload"></i>
                            Drag or tap to upload image
                        </p>
                        <input type="file" accept="image/*" capture="environment" id="frontImage"
                            onchange="previewMultipleUpload(event, 'frontPreviewContainer', 'frontText')" />
                        <div id="frontPreviewContainer" class="d-flex justify-content-center flex-wrap mt-2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h6 class="bl-3 py-1 ps-3 my-3 fs_22"> Inspection Officer Info</h6>
            </div>
            <div class="col-md-6 mb-3">
                <label class="foncolor">Inspection Done By</label>
                <input type="texxt" class="form-control form-cs inp ps-3" name="InspectionDoneBy"
                    value="Michel Bay" readonly placeholder="Enter Staff Name" />
            </div>
            <div class="col-md-6 mb-3">
                <label class="foncolor">Date & Time</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                    <input type="text" class="btn-filters datetimepicker form-control form-cs inp text-lowercase"
                        readonly name="InspectionDateTime" placeholder="mm-dd-yyyy" />
                    <input type="text" class="form-control inp inputs text-center timeOnlyInput smallinput two"
                        readonly value="08:30 AM" name="InspectionDateTime">
                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="add-customer-btns text-end">
                    <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>
            </div>

        </div>
    </form>
    @section('script')
        <script>
            document.getElementById('signature_image').addEventListener('change', function(event) {
                const preview = document.getElementById('preview');
                preview.innerHTML = ''; // Clear previous previews
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%';
                        img.style.height = 'auto';
                        img.classList.add('mt-2', 'img-thumbnail');
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                    $('#upload_signature_image').hide();
                }
            });
        </script>

        <script>
            function previewMultipleUpload(event, containerId, textId) {
                const files = event.target.files;
                const container = document.getElementById(containerId);
                const placeholder = document.getElementById(textId);

                container.innerHTML = ''; // Clear previous previews
                placeholder.style.display = 'none';

                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function() {
                        const img = document.createElement('img');
                        img.src = reader.result;
                        img.className = 'preview-image m-1';
                        img.style.maxWidth = '100px';
                        img.style.borderRadius = '6px';
                        container.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        </script>
    @endsection
</x-app-layout>
