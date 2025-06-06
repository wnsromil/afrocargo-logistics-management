<x-app-layout>

    <x-slot name="header">
        New Bill of Lading Detail
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Create New Bill of Lading Detail</p>
        </div>
    </x-slot>

    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 col-sm-12 col-lg-6 border border-secondary px-0">
                    <div class="responsiveness">
                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Shipper/Exporter
                                </th>
                            </tr>
                            <tr>
                                <td class="border-0">
                                    <select class="form-control inp select2">
                                        <option disabled hidden selected>Select Shipper</option>
                                        <option value="Sako">Sako</option>
                                        <option value="Peter">Peter</option>
                                    </select>
                                    <!-- <div class="border text-blue px-2">Company - <br>FullName - <br>Address -
                                        <br>City -
                                        <br>State -
                                    </div> -->

                                    <div class="border border-primary p-2 mt-2">
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">Company: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">FullName: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">Address: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">City: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">State: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Consignee</th>
                            </tr>
                            <tr>
                                <td class="border-0">
                                    <select class="form-control inp select2">
                                        <option disabled hidden selected>Select Consignee</option>
                                        <option value="Durano">Durano</option>
                                        <option value="Miyagi">Miyagi</option>
                                    </select>
                                    <!-- <div class="border text-blue px-2">Company - <br>FullName - <br>Address -
                                        <br>City -
                                        <br>State -
                                    </div> -->
                                    <div class="border border-primary p-2 mt-2">
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">Company: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">FullName: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">Address: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">City: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">State: </div>
                                            <div class="col-md-9 col-sm-6"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">NotifyParty</th>
                            </tr>
                            <tr>
                                <td><textarea class="form-control" rows="6"></textarea></td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Pier</th>
                            </tr>
                            <tr>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                        </table>


                        <table class="table">
                            <tr>
                                <td class="col-md-6 col-lg-6 col-sm-12 br-1 p-0">
                                    <table class="table form-section">

                                        <tr>
                                            <th class="thead-light thead_2">Vessel</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control inp" /></td>
                                        </tr>

                                        <tr>
                                            <th class="thead-light thead_2">Port of dischard</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control inp" /></td>
                                        </tr>
                                    </table>
                                </td>

                                <td class="col-md-6 col-lg-6 col-sm-12 bl-1 p-0">

                                    <table class="table form-section">

                                        <tr>
                                            <th class="thead-light thead_2">Port of loading</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control inp" /></td>
                                        </tr>

                                        <tr>
                                            <th class="thead-light thead_2">Place of delivery</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control inp" /></td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-lg-6 border border-secondary px-0">
                    <div class="form-section responsiveness">
                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Document No</th>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control inp" /></td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Expert Referent</th>
                            </tr>
                            <tr>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Forwarding Agent-Reference
                                </th>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control inp" /></td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Point and Country Of origin
                                </th>
                            </tr>
                            <tr>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Domestic Routing/Export
                                    Instruction</th>
                            </tr>
                            <tr>
                                <td><textarea class="form-control" rows="6"></textarea></td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Delivery agent</th>
                            </tr>
                            <tr>
                                <td><textarea class="form-control" rows="6"></textarea></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

            <div class="row border border-secondary border-top-0">
                <div class="form-section responsiveness px-0">
                    <table class="table form-section">
                        <tr>
                            <th colspan="3" class="thead-light thead_2">Particulars Furnished by Shipper</th>
                        </tr>
                        <tr>
                            <th class="thead-light thead_2">Mark and no</th>
                            <th class="thead-light thead_2 border border-secondary border-bottom-0">No of packages</th>
                            <th class="thead-light thead_2">Desc of packages</th>

                        </tr>
                        <tr>
                            <td><textarea class="form-control" rows="6"></textarea></td>
                            <td><textarea class="form-control" rows="6"></textarea></td>
                            <td><textarea class="form-control" rows="6"></textarea></td>

                        </tr>
                    </table>

                </div>
            </div>

            <div class="row">
                <div class="form-section responsiveness px-0">
                    <table class="table form-section">
                        <tr>
                            <th class="thead-light thead_2 border border-secondary border-bottom-0">DeliveryList</th>
                        </tr>
                        <tr>
                            <td><textarea class="form-control" rows="6"></textarea></td>
                        </tr>
                    </table>

                </div>
            </div>
        </form>
    </div>


    <hr>
    <div class="px-2">
        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary btn-sm">Save</button>
    </div>


    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function toggleContainerFields() {
                let selectedValue = $('#vehicle_type').val();

                if (selectedValue === 'Container') {
                    $('.seal-no-field').show();
                    $('.container-no-1-field').show();
                    $('.container-no-2-field').show();
                    $('.container-size-field').show();
                    $('.vehicle-number-field').hide();
                } else {
                    $('.seal-no-field').hide();
                    $('.container-no-1-field').hide();
                    $('.container-no-2-field').hide();
                    $('.container-size-field').hide();
                    $('.vehicle-number-field').show();
                }
            }

            toggleContainerFields(); // On page load
            $('#vehicle_type').on('change', toggleContainerFields); // On dropdown change
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let statusToggle = document.getElementById("status");
            let activeText = document.getElementById("activeText");
            let inactiveText = document.getElementById("inactiveText");

            function updateTextColor() {
                if (statusToggle.checked) {
                    activeText.classList.add("bold");
                    inactiveText.classList.remove("bold");
                } else {
                    activeText.classList.remove("bold");
                    inactiveText.classList.add("bold");
                }
            }
            updateTextColor();
            statusToggle.addEventListener("change", updateTextColor);
        });

    </script>

</x-app-layout>
