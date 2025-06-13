<x-app-layout>
    @section('style')
        <style>
            .page-wrapper .content {
                padding: 20px 15px;
            }
        </style>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CBM Calculator') }}
        </h2>
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Single Shipping Container</p>
    </x-slot>

    <form>
        <div class="row">
            <div class="col-12">
                <p class="fs_18 col3a">Single Shipping Container Loading Calculator</p>
            </div>
            <div class="col-md-9 col-lg-9 col-sm-9">
                <div class="row g-3 mt-0">
                    <div class="col-md-6">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Calculation #</label>
                            <input type="text" id="exampleCalculation" value="tss/1" class="form-control inp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Calculation
                                Date</label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input type="text" name="license_expiry_date" class="btn-filters form-cs inp "
                                    placeholder="mm-dd-yy" readonly />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Customer</label>
                            <input type="text" id="exampleCalculation" placeholder="Enter Customer Name"
                                class="form-control inp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">Container</label>
                            <select class="js-example-basic-single select2" id="containerSelect">
                                <option selected value="" disabled hidden>Select Container</option>
                                <option value="">Select Container</option>
                                @foreach ($containerSizes as $containerSize)
                                    <option value="{{ $containerSize->id }}" data-length="{{ $containerSize->length }}"
                                        data-breadth="{{ $containerSize->breadth }}"
                                        data-height="{{ $containerSize->height }}">
                                        {{ $containerSize->container_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Dimension</label>
                            <input type="text" id="dimensionCalculation" class="form-control inp" readonly
                                style="background: #ececec;">
                        </div>
                    </div>
                </div>

                <p class="profileUpdateFont fw-semibold text-dark-shade my-3">For Per-Unit Freight Calculation:</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">From Country</label>
                            <select id="from_country_select" name="from_country_select"
                                class="form-control inp select2">
                                <option selected disabled hidden>Select Country</option>
                                @foreach($countrys as $index => $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('from_country_select')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">From Port</label>
                            <select id="from_port" name="from_port" class="form-control inp select2">
                                <option selected disabled hidden>Select Port</option>
                            </select>
                            @error('from_port')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">To Country</label>
                            <select id="to_country_select" name="to_country_select" class="form-control inp select2">
                                <option selected disabled hidden>Select Country</option>
                                @foreach($countrys as $index => $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('to_country_select')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">To Port</label>
                            <select id="to_port" name="to_port" class="form-control inp select2">
                                <option selected disabled hidden>Select Port</option>
                            </select>
                            @error('to_port')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Container's Freight</label>
                            <input type="text" id="Container_Freight_price" placeholder="" class="form-control inp"
                                value="0.0000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block border-0 mb-2">
                            <label for="exampleCalculation" class="foncolor">Currency</label>
                            <select class="form-select select2 inp form-select-sm" id="freight_currency">
                                @foreach($viewCurrencys as $index => $currency)
                                    <option value="{{ $currency }}">{{ $currency }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-11 col-lg-11 col-sm-12">
                <p class="profileUpdateFont fw-semibold text-dark-shade my-2">Used Container Weight & Volume:</p>

                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Volumn (cu. mt)</label>
                            <input type="text" id="containerSize_volume" value="0/0" class="form-control inp" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row gx-2 input-block mb-2">
                            <div class="col-12">
                                <label for="exampleCalculation" class="foncolor">Used Volume</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="progress inp">
                                    <div id="progress-bar" class="progress-bar" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="">
                                    <input type="text" id="progress-input" class="form-control inp" value="0%"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Weight (Kg)</label>
                            <input type="text" id="containerSize_max_weight" value="0/0" class="form-control inp"
                                readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row gx-2 input-block mb-2">
                            <div class="col-12">
                                <label for="exampleCalculation" class="foncolor">Used Weight</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="progress inp">
                                    <div id="progress-bar" class="progress-bar" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="">
                                    <input type="text" id="progress-input" class="form-control inp" value="0%"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="table-responsive addProductsTables mt-3 px-0">
                <table class="table">
                    <thead>
                        <th class="border border-dark-subtle fw-normal text-start">#</th>
                        <th class="border border-dark-subtle fw-normal text-start">Product</th>
                        <th style="max-width: 76px;" class="border border-dark-subtle fw-normal text-start">Description
                        </th>
                        <th class="border border-dark-subtle fw-normal text-start">Quantity</th>
                        <th style="max-width: 65px;" class="border border-dark-subtle fw-normal text-start">Qty/Pack
                        </th>
                        <th class="border border-dark-subtle fw-normal text-start">No. of Cartons</th>
                        <th style="max-width: 80px;" class="border border-dark-subtle fw-normal text-end">Dimentions
                        </th>
                        <th class="border border-dark-subtle fw-normal text-end">One CBM</th>
                        <th class="border border-dark-subtle fw-normal text-end">All CBM</th>
                        <th class="border border-dark-subtle fw-normal text-end">Product Weight</th>
                        <th style="max-width: 65px;" class="border border-dark-subtle fw-normal text-end">Packging
                            Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end">Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end">All Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end">Per Unit Freight</th>
                        <th class="border border-dark-subtle fw-normal text-end ">Unit Freight By Volume
                        </th>
                        <th
                            class="border border-dark-subtle fw-normal text-end bg-transparent table-last-column lastchildth">
                            Unit
                            Freight By
                            Weight</th>
                    </thead>

                    <tbody id="update_data" class="border border-dark-subtle d-none">
                        <tr>
                            <td colspan="8">
                                <div class="my-2 row justify-content-between">
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Product</label>
                                    <div class="col-md-10 col-lg-10 col-sm-10 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Description</label>
                                    <div class="col-md-10 col-lg-10 col-sm-10 ps-4">
                                        <textarea type="text" class="form-control inp form-control-sm" id="inputProduct"
                                            rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Total
                                        Quantity</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Qty/Pack</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">
                                        Dimensions in</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Length</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Breadth</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Height</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Product
                                        Weight</label>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 pe-1 ps-4 border-0 sm">
                                        <select class="form-select form-select-sm select2">
                                            <option disabled hidden selected vlaue=""></option>
                                            <option vlaue="Kg">Kg</option>
                                            <option vlaue="G">G</option>
                                            <option vlaue="Lbs">Lbs</option>
                                            <option vlaue="Oz">Oz</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 ps-1">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Packing
                                        Weight</label>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 pe-1 ps-4 border-0 sm">
                                        <select class="form-select select2">
                                            <option disabled hidden selected vlaue=""></option>
                                            <option vlaue="Kg">Kg</option>
                                            <option vlaue="G">G</option>
                                            <option vlaue="Lbs">Lbs</option>
                                            <option vlaue="Oz">Oz</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 ps-1">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>

                            </td>
                            <td colspan="7">
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        Cartons</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Single
                                        CBM</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        CBM</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Net
                                        Weight
                                        (kg.)</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-2 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Gross
                                        weight
                                        (kg.)</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-2 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        Net
                                        weight
                                        (kg.)</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        Gross
                                        weight (kg.):
                                    </label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>

                                <div class="my-1 row">
                                    <button type="button" for="inputProduct" id="cancelUpdateBtn"
                                        class="col-md-4 col-lg-4 col-sm-4 btn bg-transparent btn-text-color text-start btn-sm">Update
                                        Cancel
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                    <tbody id="product_data" class="border productData border-dark-subtle">
                        <tr>
                            <td class="border-bottom border-dark-subtle text-middle fw-light">
                                <div class="d-block">
                                    <a href="#" class="decoration-text pe-2">Edit</a>
                                    <a href="#" class="decoration-text">Delete</a>
                                </div>
                            </td>
                            <td class="border border-dark-subtle fw-light">Product 1</td>
                            <td class="border border-dark-subtle fw-light">Product 1 Description</td>
                            <td class="border border-dark-subtle text-end fw-light">4000</td>
                            <td class="border border-dark-subtle text-end fw-light">10</td>
                            <td class="border border-dark-subtle text-end fw-light">400</td>
                            <td class="border border-dark-subtle text-end fw-light">30.00*25.00*20.00 Cm</td>
                            <td class="border border-dark-subtle text-end fw-light">400</td>
                            <td class="border border-dark-subtle text-end fw-light">7</td>
                            <td class="border border-dark-subtle text-end fw-light">1.00 Kg</td>
                            <td class="border border-dark-subtle text-end fw-light">0.20 Kg</td>
                            <td class="border border-dark-subtle text-end fw-light">10.2</td>
                            <td class="border border-dark-subtle text-end fw-light">4080</td>
                            <td class="border border-dark-subtle text-end fw-light">0.3000</td>
                            <td class="border border-dark-subtle text-end fw-light">0.3000</td>
                            <td class="border border-dark-subtle text-end fw-light">0.3</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="py-2">
                                <button type="button" id="addProductBtn" for="inputProduct" class="btn btn-primary">Add
                                    Product
                                </button>
                            </td>
                        </tr>
                    </tbody>

                </table>


            </div>

            <div class="col-12">
                <button type="button" id="addProductBtn" for="inputProduct" class="btn buttons btn-primary mt-3">
                    <i class="ti ti-printer me-1"></i>
                    Print Calculation
                </button>
            </div>

        </div>
    </form>
    @section('script')
        <script>
            $(document).ready(function () {
                function fetchData() {
                    let from_country = $('#from_country_select').val();
                    let from_port = $('#from_port').val();
                    let to_country = $('#to_country_select').val();
                    let to_port = $('#to_port').val();
                    let containerSelect = $('#containerSelect').val();

                    // Check if all fields are selected
                    if (from_country && from_port && to_country && to_port && containerSelect) {
                        $.ajax({
                            url: "/api/get-freight-data-shipping", // Make sure this route is defined
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                from_country: from_country,
                                from_port: from_port,
                                to_country: to_country,
                                to_port: to_port,
                                containerSelect: containerSelect
                            },
                            success: function (response) {
                                if (response.success) {

                                    // ✅ Freight Price
                                    $('#Container_Freight_price').val(response.container_data.freight_price);

                                    // ✅ Currency
                                    $('#freight_currency').val(response.container_data.currency).change();

                                    // ✅ Volume
                                    const volumeMax = parseFloat(response.containerSizeData.volume).toFixed(3);
                                    $('#containerSize_volume').val("0/" + volumeMax);

                                    // ✅ Weight
                                    const weightMax = parseFloat(response.containerSizeData.max_weight).toFixed(2);
                                    $('#containerSize_max_weight').val("0/" + weightMax);

                                    // ✅ Update Volume Progress Bar
                                    const volumePercent = 0;
                                    $('#progress-bar-volume')
                                        .css('width', volumePercent + '%')
                                        .attr('aria-valuenow', volumePercent);
                                    $('#progress-input-volume').val(volumePercent + '%');

                                    // ✅ Update Weight Progress Bar
                                    const weightPercent = 0;
                                    $('#progress-bar-weight')
                                        .css('width', weightPercent + '%')
                                        .attr('aria-valuenow', weightPercent);
                                    $('#progress-input-weight').val(weightPercent + '%');

                                } else {
                                    $('#freight-result').html('<div class="alert alert-danger">No matching record found.</div>');
                                }
                            },
                            error: function (xhr) {
                                $('#freight-result').html('<div class="alert alert-danger">An error occurred while fetching data.</div>');
                            }
                        });
                    }
                }

                // Trigger fetchData on change of any of the four fields
                $('#from_country_select, #from_port, #to_country_select, #to_port, #containerSelect').change(fetchData);

            });
        </script>
        <script>
            $(document).ready(function () {
                $('#from_country_select').on('change', function () {
                    let country = $(this).val();
                    console.log(country); // ← ye tabhi chalega jab upar sab sahi hai
                    getPorts(country, '#from_port');
                });

                $('#to_country_select').on('change', function () {
                    let country = $(this).val();
                    getPorts(country, '#to_port');
                });

                function getPorts(countryName, portSelectId) {
                    $.ajax({
                        url: '/api/get-ports/' + countryName,
                        type: 'GET',
                        success: function (response) {
                            if (response.status) {
                                let portSelect = $(portSelectId);
                                portSelect.empty(); // clear old options
                                if (response.data.length > 0) {
                                    portSelect.append('<option selected disabled hidden>Select Port</option>');

                                    response.data.forEach(function (port) {
                                        portSelect.append(`<option value="${port.id}">${port.port_name}</option>`);
                                    });
                                } else {
                                    portSelect.append('<option selected disabled>No port available</option>');
                                }
                            }
                        },
                        error: function () {
                            alert('Failed to load ports.');
                        }
                    });
                }
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#containerSelect').on('change', function () {
                    let selectedOption = $(this).find('option:selected');

                    let length = selectedOption.data('length');
                    let breadth = selectedOption.data('breadth');
                    let height = selectedOption.data('height');

                    if (length && breadth && height) {
                        $('#dimensionCalculation').val(`${length} X ${breadth} X ${height} cm`);
                    } else {
                        $('#dimensionCalculation').val('');
                    }
                });
            });
        </script>
        <script>
            document.getElementById("addProductBtn").addEventListener("click", function () {
                document.getElementById("update_data").classList.remove("d-none");
            });

            document.getElementById("cancelUpdateBtn").addEventListener("click", function () {
                document.getElementById("update_data").classList.add("d-none");
            });

        </script>
        <script>
            function updateProgress(percent) {
                percent = Math.min(100, Math.max(0, percent)); // limit between 0-100
                document.getElementById("progress-bar").style.width = percent + "%";
                document.getElementById("progress-bar").setAttribute("aria-valuenow", percent);
                document.getElementById("progress-input").value = percent + "%";
            }

            // Example: Dynamically set to 70%
           // updateProgress(20);

        </script>
    @endsection
</x-app-layout>