<x-app-layout>
    <x-slot name="header">
        {{ __('car Shipping Leads') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head mtop-20">car Shipping Leads</p>
    </x-slot>
    @section('style')
        <style>
            .content-page-header:has(.mtop-20) {
                margin-top: -10px;
            }
        </style>
    @endsection

    <form id="expenseFilterForm">
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search">
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>Inspection Status</label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Status</option>
                    <option value="Not Scheduled">Not Scheduled</option>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Done">Done</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Status</label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Status</option>
                    <option value="New">New</option>
                    <option value="In-Progress">In Progress</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Date Range</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info height40">
                    <input type="text" class="btn-filters daterangeInput form-control form-cs height40"
                        name="orderDate" placeholder="From Date - To Date" />
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>Assigned Staff</label>
                <select class="js-example-basic-single select2" name="main_type">
                    <option hidden selected disabled value="">Select Staff</option>
                    <option value="Alex Serpent">Alex Serpent</option>
                    <option value="Lauren Pitbull">Lauren Pitbull</option>
                    <option value="Christofer Durreno">Christofer Durreno</option>
                    <option value="Vernonica vemola">Vernonica vemola</option>
                </select>
            </div>
            <div class="col mb-3 d-flex justify-content-end align-items-end">
                <a href="{{ route('admin.advance_reports.index') }}"
                    class="btn btn-outline-danger btnr me-sm-2">Reset</a>
                <button type="submit" class="btn btn-primary btnf">Filter</button>
            </div>
        </div>
    </form>




    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Lead ID</th>
                                <th>Customer Name</th>
                                <th>Contact</th>
                                <th>Vehicle</th>
                                <th>Value</th>
                                <th>Insurance</th>
                                <th>Date Requested</th>
                                <th>Assigned To</th>
                                <th>Inspection Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>SHL-00001</td>
                                <td>Brian Bordina</td>
                                <td>
                                    +1 2213211212</br>
                                    brianbordina@gmail.com
                                </td>
                                <td>2015 Toyota Camry</td>
                                <td>$35000</td>
                                <td>$5000</td>
                                <td>06-25-2025
                                </td>
                                <td>-</td>
                                <td>
                                    <span class="badge bg-danger-light fs_13 py-2">
                                        Not Scheduled
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-soft-secondary fs_13 py-2">
                                        New
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#InspectingScheduel">
                                                        <i class="ti ti-calendar-clock me-2 fs_16"></i>
                                                        Schedule</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.carShippingLeads.show', 1) }}"><i
                                                            class="far fa-eye me-2"></i>Show</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>SHL-00002</td>
                                <td>Karen Luna</td>
                                <td>
                                    +1 2548574585</br>
                                    karenLuna@gmail.com
                                </td>
                                <td>2019 Toyota Camry</td>
                                <td>$55000</td>
                                <td>$9000</td>
                                <td>06-24-2025
                                </td>
                                <td>Frido Kamado</td>
                                <td>
                                    <span class="badge badge-soft-success fs_13 py-2">
                                        Scheduled
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-soft-warning fs_13 py-2">
                                        In Progress
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#InspectingScheduel">
                                                        <i class="ti ti-calendar-clock me-2 fs_16"></i>
                                                        Schedule</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.carShippingLeads.show', 1) }}"><i
                                                            class="far fa-eye me-2"></i>Show</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>SHL-00003</td>
                                <td>Michel Nobara</td>
                                <td>
                                    +27 1745554545</br>
                                    nobaramichel@gmail.com
                                </td>
                                <td>2016 Tesla 360</td>
                                <td>$30000</td>
                                <td>$12000</td>
                                <td>06-25-2025
                                </td>
                                <td>Lauren Pitbull</td>
                                <td>
                                    <span class="badge bg-danger-light fs_13 py-2">
                                        Done
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-soft-success fs_13 py-2">
                                        Approved
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#InspectingScheduel">
                                                        <i class="ti ti-calendar-clock me-2 fs_16"></i>
                                                        Schedule</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.carShippingLeads.show', 1) }}"><i
                                                            class="far fa-eye me-2"></i>Show</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>SHL-00004</td>
                                <td>Bruno Mars</td>
                                <td>
                                    +27 2136452525</br>
                                    brunomars1@gmail.com
                                </td>
                                <td>2020 Comet MG</td>
                                <td>$45000</td>
                                <td>$20000</td>
                                <td>06-22-2025
                                </td>
                                <td>Glenn Maxnes</td>
                                <td>
                                    <span class="badge badge-soft-warning fs_13 py-2">
                                        In Progress
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-soft-danger fs_13 py-2">
                                        Rejected
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#InspectingScheduel">
                                                        <i class="ti ti-calendar-clock me-2 fs_16"></i>
                                                        Schedule</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.carShippingLeads.show', 1) }}"><i
                                                            class="far fa-eye me-2"></i>Show</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="InspectingScheduel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Inspection Scheduling</h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
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
                            <input type="text" class="form-control form-cs inp ps-3" name="InspectionLocation"
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
    <div class="modal fade" id="AddRequestForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Add Request/Lead Shipment</h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="foncolor">Lead Source</label>
                                <select class="js-example-basic-single select2" name="main_type">
                                    <option hidden selected disabled value="">Select Source</option>
                                    <option value="Walk-in">Walk-in</option>
                                    <option value="Phone">Phone</option>
                                    <option value="WhatsApp">WhatsApp</option>
                                    <option value="Website">Website</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="foncolor">Request Date</label>
                                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                    <input type="text"
                                        class="btn-filters datetimepicker form-control form-cs inp text-lowercase"
                                        name="currentdate" placeholder="mm-dd-yyyy" />
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="foncolor">Shipper Name</label>
                                <input type="text" class="form-control form-cs inp ps-3" name="ShipperName"
                                    placeholder="Enter Shipper Name" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="foncolor">Company Name (Optional)</label>
                                <input type="text" class="form-control form-cs inp ps-3" name="CompanyName"
                                    placeholder="Enter Company Name" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="foncolor">Shipper Address</label>
                                <input type="text" class="form-control form-cs inp ps-3" name="ShipperAddress"
                                    placeholder="Enter Shipper Address" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="foncolor">Email</label>
                                <input type="email" class="form-control form-cs inp ps-3" name="email"
                                    placeholder="Enter Email" />
                            </div>
                            <div class="col-md-3 mb-3 ">
                                <label class="foncolor" for="alternate_mobile_no">Mobile No.</label>
                                <div class="flaginputwrap">
                                    <div class="customflagselect">
                                        <select class="flag-select" name="mobile_number_code_id">
                                            @foreach ($coutry as $key => $item)
                                                <option value="{{ $item->id }}" data-image="{{ $item->flag_url }}"
                                                    data-name="{{ $item->name }}"
                                                    data-code="{{ $item->phonecode }}">
                                                    {{ $item->name }} +{{ $item->phonecode }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="number" class="form-control flagInput inp"
                                        placeholder="Enter Mobile No" name="mobile_number" value=""
                                        oninput="this.value = this.value.slice(0, 10)">
                                </div>
                                @error('mobile_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div id="itemQuantityWrapper2" class="col-sm-12">
                                <div class="row row-cols-sm-5 itemRow align-items-end">
                                    <!-- Vehicle Details -->
                                    <div class="col mb-3">
                                        <label class="foncolor" for="vehicleDetails">Vehicle Details <i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="vehicleDetails[]"
                                            class="form-control form-cs inp ps-3" placeholder="Enter Vehicle Details">
                                    </div>

                                    <!-- Quantity -->
                                    <div class="col mb-3">
                                        <label class="foncolor" for="vehicleQuantity">Quantity <i
                                                class="text-danger">*</i></label>
                                        <input type="number" name="vehicleQuantity[]"
                                            class="form-control form-cs inp ps-3" placeholder="Enter Quantity">
                                    </div>
                                    <!-- Value -->
                                    <div class="col mb-3">
                                        <label class="foncolor" for="vehicleValue">Vehicle Value <i
                                                class="text-danger">*</i></label>
                                        <input type="number" name="vehicleValue[]"
                                            class="form-control form-cs inp ps-3" placeholder="Enter Vehicle Value">
                                    </div>
                                    <div class="col mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <label class="foncolor" for="vehicleInsuerance">Vehicle Insuerance <i
                                                        class="text-danger">*</i></label>
                                                <input type="number" name="vehicleInsuerance[]"
                                                    class="form-control form-cs inp ps-3"
                                                    placeholder="Enter Insuerance">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Buttons -->
                                    <div class="col mb-3">

                                        <div class="btnWrapperWidth">
                                            <button type="button" class="btn btn-danger iconBtn deletebutton2">
                                                <i class="ti ti-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary iconBtn addbutton2">
                                                <i class="ti ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <label class="foncolor">Internal Notes</label>
                                <textarea type="text" class="form-control" name="notes" placeholder="Enter Your Notes"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary confirm-supply me-2"
                        data-bs-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.activate, .deactivate').on('click', function() {
            let id = $(this).data('id');
            let status = $(this).data('status');

            $.ajax({
                url: "{{ route('admin.vehicle.status', '') }}/" + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Status Updated',
                            text: response.success
                        });

                        location.reload();
                    }
                }
            });
        });
    </script>

    @section('script')
        <script>
            // 🖼 Image Preview Function
            function previewImage(input, imageType) {
                if (input.files && input.files[0]) {
                    let file = input.files[0];

                    // ✅ Sirf PNG ya JPG Allow Hai
                    if (file.type === "image/png" || file.type === "image/jpeg") {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('preview_' + imageType).src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert("Only PNG & JPG images are allowed!");
                        input.value = ""; // Invalid file ko remove karna
                    }
                }
            }

            // ❌ Remove Image Function
            function removeImage(imageType) {
                document.getElementById('preview_' + imageType).src = "{{ asset('../assets/img.png') }}";
                document.getElementById('file_' + imageType).value = "";
            }
            $('#country_code').val($('.mobile_code').find('.iti__selected-dial-code').text());
            $('.col-md-12').on('click', () => {
                $('#country_code').val($('.mobile_code').find('.iti__selected-dial-code').text());
            })

            $('#country_code_2').val($('.alternate_mobile_no').find('.iti__selected-dial-code').text());
            $('.col-md-12').on('click', () => {
                $('#country_code_2').val($('.alternate_mobile_no').find('.iti__selected-dial-code').text());
            })
        </script>
        <script>
            $(document).ready(function() {
                var oldState = "{{ old('state') }}"; // Laravel old value
                var oldCity = "{{ old('city') }}";

                // ✅ Agar old state available hai toh state ke cities load kare
                if (oldState) {
                    $('#state').html('<option selected="selected">Loading...</option>');
                    $.ajax({
                        url: '/api/get-states/' + $('#country').val(),
                        type: 'GET',
                        success: function(states) {
                            $('#state').html('<option selected="selected">Select State</option>');
                            $.each(states, function(key, state) {
                                var selected = (state.id == oldState) ? 'selected' :
                                    ''; // ✅ Old value match kare
                                $('#state').append('<option value="' + state.id + '" ' + selected +
                                    '>' + state.name + '</option>');
                            });

                            // ✅ Agar old city available hai, toh cities load kare
                            if (oldCity) {
                                $('#city').html('<option selected="selected">Loading...</option>');
                                $.ajax({
                                    url: '/api/get-cities/' + oldState,
                                    type: 'GET',
                                    success: function(cities) {
                                        $('#city').html(
                                            '<option selected="selected">Select City</option>'
                                        );
                                        $.each(cities, function(key, city) {
                                            var selected = (city.id == oldCity) ?
                                                'selected' :
                                                ''; // ✅ Old value match kare
                                            $('#city').append('<option value="' + city
                                                .id + '" ' + selected + '>' + city
                                                .name + '</option>');
                                        });
                                    }
                                });
                            }
                        }
                    });
                }
                // Country Change Event
                $('#country').change(function() {
                    var country_id = $(this).val();
                    $('#state').html('<option selected="selected">Loading...</option>');
                    $('#city').html('<option selected="selected">Select City</option>');

                    $.ajax({
                        url: '/api/get-states/' + country_id,
                        type: 'GET',
                        success: function(states) {
                            $('#state').html(
                                '<option selected="selected" value="">Select State</option>');
                            $.each(states, function(key, state) {
                                $('#state').append('<option value="' + state.id + '">' +
                                    state.name + '</option>');
                            });
                        }
                    });
                });

                // State Change Event
                $('#state').change(function() {
                    var state_id = $(this).val();
                    $('#city').html('<option selected="selected">Loading...</option>');

                    $.ajax({
                        url: '/api/get-cities/' + state_id,
                        type: 'GET',
                        success: function(cities) {
                            $('#city').html(
                                '<option selected="selected" value="">Select City</option>');
                            $.each(cities, function(key, city) {
                                $('#city').append('<option value="' + city.id + '">' + city
                                    .name + '</option>');
                            });
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                function updateButtons() {
                    // Always show all plus buttons
                    $('.addbutton2').show();

                    // Hide minus button for the first row only
                    $('.deletebutton2').show();
                    $('.itemRow').first().find('.deletebutton2').hide();
                }

                $('#itemQuantityWrapper2').on('click', '.addbutton2', function() {
                    let newRow = $(this).closest('.itemRow').clone();
                    newRow.find('input').val(''); // Clear inputs
                    $('#itemQuantityWrapper2').append(newRow);
                    updateButtons();
                });

                $('#itemQuantityWrapper2').on('click', '.deletebutton2', function() {
                    $(this).closest('.itemRow').remove();
                    updateButtons();
                });

                updateButtons(); // Initial call
            });
        </script>
    @endsection
</x-app-layout>
