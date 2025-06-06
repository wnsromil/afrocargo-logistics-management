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
                                <input type="text" name="license_expiry_date" class="btn-filters form-cs inp " placeholder="mm-dd-yy" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Customer</label>
                            <input type="text" id="exampleCalculation" placeholder="Enter Customer Name" class="form-control inp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">Container</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected" disabled hidden>Select Container</option>
                                <option value="">Select Container</option>
                                <option selected value="20_feet">Standard 20 Feet</option>
                                <option value="40_feet">Standard 40 Feet</option>
                                <option value="HC_40_feet">High Cube 40 Feet</option>
                                <option value="U_20_feet">Upgraded 20 Feet</option>
                                <option value="R_20_feet">Reefer 20 Feet</option>
                                <option value="R_40_feet">Reefer 40 Feet</option>
                                <option value="HR_40_feet">Reefer 40 Feet High Cube</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Dimension</label>
                            <input type="text" id="exampleCalculation" placeholder="Enter Customer Name" class="form-control inp" value="590 * 235 * 239 cm" readonly>
                        </div>
                    </div>

                </div>

                <p class="profileUpdateFont fw-semibold text-dark-shade my-3">For Per-Unit Freight Calculation:</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">From Country</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected" disabled hidden>Select Country</option>
                                <option value="United States">United States</option>
                                <option value="Canada">Canada</option>
                                <option value="Africa">Africa</option>
                                <option value="India">India</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">From Port</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected" disabled hidden>Select Port</option>
                                <option value="Aberdeen, Washington">Aberdeen, Washington</option>
                                <option value="Atlanta, Georgia">Atlanta, Georgia</option>
                                <option value="Baltimore, Maryland">Baltimore, Maryland</option>
                                <option value="Beaumont, Texas">Beaumont, Texas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">To Country</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected" disabled hidden>Select Country</option>
                                <option value="United States">United States</option>
                                <option value="Canada">Canada</option>
                                <option value="Africa">Africa</option>
                                <option value="India">India</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">To Port</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected" disabled hidden>Select Port</option>
                                <option value="Aberdeen, Washington">Aberdeen, Washington</option>
                                <option value="Atlanta, Georgia">Atlanta, Georgia</option>
                                <option value="Baltimore, Maryland">Baltimore, Maryland</option>
                                <option value="Beaumont, Texas">Beaumont, Texas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Container's Freight</label>
                            <input type="text" id="exampleCalculation" placeholder="" class="form-control inp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block border-0 mb-2">
                            <label for="exampleCalculation" class="foncolor">Currency</label>
                            <select class="form-select select2 inp form-select-sm" id="freight_currency">
                                <option selected hidden disabled></option>
                                <option value="USD">USD</option>
                                <option value="UAH">UAH</option>
                                <option value="UGX">UGX</option>
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
                            <input type="text" id="exampleCalculation" value="0/33.2000" class="form-control inp" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row gx-2 input-block mb-2">
                            <div class="col-12">
                                <label for="exampleCalculation" class="foncolor">Used Volume</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="progress inp">
                                    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="">
                                    <input type="text" id="progress-input" class="form-control inp" value="40%" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Weight (Kg)</label>
                            <input type="text" id="exampleCalculation" value="0/33.2000" class="form-control inp" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row gx-2 input-block mb-2">
                            <div class="col-12">
                                <label for="exampleCalculation" class="foncolor">Used Weight</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="progress inp">
                                    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="">
                                    <input type="text" id="progress-input" class="form-control inp" value="25%" readonly>
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
                        <th style="max-width: 76px;" class="border border-dark-subtle fw-normal text-start">Description</th>
                        <th class="border border-dark-subtle fw-normal text-start">Quantity</th>
                        <th style="max-width: 65px;" class="border border-dark-subtle fw-normal text-start">Qty/Pack</th>
                        <th class="border border-dark-subtle fw-normal text-start">No. of Cartons</th>
                        <th style="max-width: 80px;" class="border border-dark-subtle fw-normal text-end">Dimentions</th>
                        <th class="border border-dark-subtle fw-normal text-end">One CBM</th>
                        <th class="border border-dark-subtle fw-normal text-end">All CBM</th>
                        <th class="border border-dark-subtle fw-normal text-end">Product Weight</th>
                        <th style="max-width: 65px;" class="border border-dark-subtle fw-normal text-end">Packging Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end">Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end">All Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end">Per Unit Freight</th>
                        <th class="border border-dark-subtle fw-normal text-end ">Unit Freight By Volume
                        </th>
                        <th class="border border-dark-subtle fw-normal text-end bg-transparent table-last-column lastchildth">
                            Unit
                            Freight By
                            Weight</th>
                    </thead>

                    <tbody id="update_data" class="border border-dark-subtle d-none">
                        <tr>
                            <td colspan="8">
                                <div class="my-2 row justify-content-between">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Product</label>
                                    <div class="col-md-10 col-lg-10 col-sm-10 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Description</label>
                                    <div class="col-md-10 col-lg-10 col-sm-10 ps-4">
                                        <textarea type="text" class="form-control inp form-control-sm" id="inputProduct" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Total
                                        Quantity</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Qty/Pack</label>
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
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Length</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Breadth</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Height</label>
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
                                    <label for="inputProduct" class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        Cartons</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct" class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Single
                                        CBM</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct" class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        CBM</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct" class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Net Weight
                                        (kg.)</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-2 row">
                                    <label for="inputProduct" class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Gross
                                        weight
                                        (kg.)</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-2 row">
                                    <label for="inputProduct" class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total Net
                                        weight
                                        (kg.)</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct" class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        Gross
                                        weight (kg.):
                                    </label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>

                                <div class="my-1 row">
                                    <button type="button" for="inputProduct" id="cancelUpdateBtn" class="col-md-4 col-lg-4 col-sm-4 btn bg-transparent btn-text-color text-start btn-sm">Update
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
</x-app-layout>

<script>
    document.getElementById("addProductBtn").addEventListener("click", function() {
        document.getElementById("update_data").classList.remove("d-none");
    });

    document.getElementById("cancelUpdateBtn").addEventListener("click", function() {
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
    updateProgress(20);

</script>
