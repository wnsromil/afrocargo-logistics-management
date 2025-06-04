<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Container Wise Freight') }}
        </h2>
    </x-slot>

    <div class="container">
        <h6 class="fw-light">Single Shipping Container Loading Calculator</h6>
        <form>
            <div class="col-md-9 col-lg-9 col-sm-9">
                <div class="row g-3 mt-3">
                    <div class="col-md-2 col-sm-2 col-lg-2 pe-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade ">Calculation #:</label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <input type="text" id="exampleCalculation" value="tss/1" class="form-control rounded-0">
                    </div>

                    <div class="col-md-2 col-sm-2 col-lg-2 px-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade ">Calculation
                            Date:</label>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <input type="date" id="exampleCalculationDate" value="30/Jan/2021"
                            class="form-control rounded-0">
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-2 col-sm-2 col-lg-2">
                        <label for="exampleCustomer" class="col-form-label text-dark-shade">Customer:</label>
                    </div>

                    <div class="col-md-10 col-lg-10 col-sm-12">
                        <input type="text" id="exampleCustomer" value="tss" class="form-control rounded-0">
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-2 col-sm-2 col-lg-2 pe-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade ">Container:</label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <!-- <input type="text" id="exampleCalculation" class="form-control rounded-0"> -->
                        <select class="form-select rounded-0">
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

                    <div class="col-md-2 col-sm-2 col-lg-2 px-0">
                        <label for="exampleDimention" class="col-form-label text-dark-shade ">Dimension:</label>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <input type="text" id="exampleDimention" class="form-control rounded-0"
                            value="590 * 235 * 239 cm" readonly>
                    </div>
                </div>

                <p class="profileUpdateFont fw-semibold text-dark-shade my-3">For Per-Unit Freight Calculation:</p>
                <div class="row g-3">
                    <div class="col-md-2 col-sm-2 col-lg-2 pe-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade">From Country:</label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <select class="form-select rounded-0">
                            <option selected value="india">India</option>
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-2 col-lg-2 px-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade">From Port:</label>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <select class="form-select rounded-0">
                            <option selected value="cochin">Cochin</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-2 col-sm-2 col-lg-2 pe-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade">To Country:</label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <select class="form-select rounded-0">
                            <option selected value="us">United States</option>
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-2 col-lg-2 px-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade">To Port:</label>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <select class="form-select rounded-0">
                            <option selected value="texas">Houston, Texas</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-2 col-sm-2 col-lg-2 pe-0">
                        <label class="form-label text-dark-shade">Container's Freight</label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <input type="text" id="exampleDimention" class="form-control rounded-0" value="1200.0000">
                    </div>
                    <div class="col-md-2 col-sm-2 col-lg-2 pe-0">
                        <label class="form-label text-dark-shade">Currency</label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <select class="form-select rounded-0">
                            <option selected value="usd">USD</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-lg-10 col-sm-10">
                <p class="profileUpdateFont fw-semibold text-dark-shade my-2">Used Container Weight & Volume:</p>

                <div class="row g-3">
                    <div class="col-md-2 col-sm-2 col-lg-2 pe-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade">Volumn (cu. mt):</label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 ps-0 input-size">
                        <input type="text" id="exampleCalculation" value="0/33.2000" class="form-control rounded-0"
                            readonly>
                    </div>

                    <div class="col-md-2 col-sm-2 col-lg-2 px-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade">Used Volumn:</label>
                    </div>
                    <div class="col-md-2 col-sm-12 col-lg-2 px-0 input-size">
                        <input type="text" id="exampleCalculationDate" value="" class="form-control rounded-0" readonly>
                        </label>
                    </div>

                    <div class="col-md-1 col-lg-1 col-sm-1 px-1">
                        <input type="text" id="exampleCalculationDate" value="0%" class="form-control rounded-0"
                            readonly>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-2 col-sm-2 col-lg-2 pe-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade ">Weight (Kg):</label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 ps-0 input-size">
                        <input type="text" id="exampleCalculation" value="0/21770.00" class="form-control rounded-0 "
                            readonly>
                    </div>

                    <div class="col-md-2 col-sm-2 col-lg-2 px-0">
                        <label for="exampleCalculation" class="col-form-label text-dark-shade ">Used Weight:</label>
                    </div>
                    <div class="col-md-2 col-sm-2 col-lg-2 px-0 input-size">
                        <input type="text" id="exampleCalculationDate" value="" class="form-control rounded-0" readonly>
                        </label>
                    </div>

                    <div class="col-md-1 col-lg-1 col-sm-1 px-1">
                        <input type="text" id="exampleCalculationDate" value="0%" class="form-control rounded-0"
                            readonly>
                    </div>
                </div>
            </div>


            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <th class="border border-dark-subtle fw-normal text-start p-5 py-4 ps-1">#</th>
                        <th class="border border-dark-subtle fw-normal text-start p-5 py-4 ps-1">Product</th>
                        <th class="border border-dark-subtle fw-normal text-start p-5 py-4 ps-1">Description</th>
                        <th class="border border-dark-subtle fw-normal text-start p-2 py-4 ps-1">Quantity</th>
                        <th class="border border-dark-subtle fw-normal text-start p-2 py-4 ps-1">Qty/Pack</th>
                        <th class="border border-dark-subtle fw-normal text-start p-2 py-4 ps-1">No. of Cartons</th>
                        <th class="border border-dark-subtle fw-normal text-end p-4 py-4 pe-1">Dimentions</th>
                        <th class="border border-dark-subtle fw-normal text-end p-2 py-4 pe-1">One CBM</th>
                        <th class="border border-dark-subtle fw-normal text-end p-2 py-4 pe-1">All CBM</th>
                        <th class="border border-dark-subtle fw-normal text-end p-2 py-4 pe-1">Product Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end p-2 py-4 pe-1">Packging Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end p-2 py-4 pe-1">Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end p-2 py-4 pe-1">All Weight</th>
                        <th class="border border-dark-subtle fw-normal text-end p-2 py-4 pe-1">Per Unit Freight</th>
                        <th class="border border-dark-subtle fw-normal text-end p-2 py-4 pe-1 ">Unit Freight By Volume
                        </th>
                        <th
                            class="border border-dark-subtle fw-normal text-end p-2 py-4 pe-1 bg-transparent table-last-column ">
                            Unit
                            Freight By
                            Weight</th>
                    </thead>

                    <tbody id="update_data" class="border border-dark-subtle d-none">
                        <tr>
                            <td colspan="6">
                                <div class="my-2 row justify-content-between">
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Product:</label>
                                    <div class="col-md-10 col-lg-10 col-sm-10 ps-4">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Description:</label>
                                    <div class="col-md-10 col-lg-10 col-sm-10 ps-4">
                                        <textarea type="text" class="form-control rounded-0" id="inputProduct"
                                            rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Total
                                        Quantity:</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Qty/Pack:</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">
                                        Dimensions in:</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Length:</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Breadth:</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Height:</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Product
                                        Weight:</label>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 pe-1 ps-4">
                                        <select class="form-select form-control-sm rounded-0">
                                            <option vlaue=""></option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 ps-1">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Packing
                                        Weight:</label>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 pe-1 ps-4">
                                        <select class="form-select form-control-sm rounded-0">
                                            <option vlaue=""></option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 ps-1">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>

                            </td>
                            <td colspan="6">
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-md-4 col-lg-4 col-sm-4 col-form-label fw-light font13">Total
                                        Cartons:</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-md-4 col-lg-4 col-sm-4 col-form-label fw-light font13">Single
                                        CBM:</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-md-4 col-lg-4 col-sm-4 col-form-label fw-light font13">Total
                                        CBM:</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-md-4 col-lg-4 col-sm-4 col-form-label fw-light font13">Net Weight
                                        (kg.):</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-2 row">
                                    <label for="inputProduct"
                                        class="col-md-4 col-lg-4 col-sm-4 col-form-label fw-light font13">Gross
                                        weight
                                        (kg.):</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-2 row">
                                    <label for="inputProduct"
                                        class="col-md-4 col-lg-4 col-sm-4 col-form-label fw-light font13">Total Net
                                        weight
                                        (kg.):</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-md-4 col-lg-4 col-sm-4 col-form-label fw-light font13">Total
                                        Gross
                                        weight (kg.):
                                    </label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input type="text" class="form-control form-control-sm rounded-0"
                                            id="inputProduct">
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

                    <tbody id="product_data" class="border border-dark-subtle">
                        <tr>
                            <td class="d-flex border-bottom border-dark-subtle text-middle fw-light">
                                <a href="#" class="decoration-text pe-1">Edit</a>
                                <a href="#" class="decoration-text ps-1 pt-1">Delete</a>
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
                            <td>
                                <button type="button" id="addProductBtn" for="inputProduct"
                                    class="btn bg-transparent border-secondary rounded-0 text-dark btn-sm">Add
                                    Product
                                </button>
                            </td>
                        </tr>
                    </tbody>

                </table>
                <button type="button" id="addProductBtn" for="inputProduct"
                    class="btn bg-transparent border-secondary rounded-0 text-dark btn-sm mt-3">
                    <img src="https://4.imimg.com/data4/WK/WC/MY-7572932/1.jpeg" alt="" class="img-size me-0">
                    Print Calculation
                </button>

            </div>
        </form>
    </div>
</x-app-layout>

<script>
    document.getElementById("addProductBtn").addEventListener("click", function () {
        document.getElementById("update_data").classList.remove("d-none");
    });

    document.getElementById("cancelUpdateBtn").addEventListener("click", function () {
        document.getElementById("update_data").classList.add("d-none");
    });
</script>