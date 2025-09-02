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

    <form id="singleShippingContainerForm" method="POST">
        <div class="row">

            <div class="col-12">
                <p class="fs_18 col3a">Single Shipping Container Loading Calculator</p>
            </div>
            <div class="col-md-9 col-lg-9 col-sm-9">
                <div class="row g-3 mt-0">
                    <div class="col-md-6">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Calculation #</label>
                            <input name="calculation" type="text" id="exampleCalculation" value="tss/1"
                                class="form-control inp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Calculation
                                Date</label>
                            <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                <input name="calculation_date" type="text" class="btn-filters form-cs inp " readonly
                                    style="background: #ffffff" placeholder="MM/DD/YYYY" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="input-block mb-2">
                            <label for="exampleCalculation" class="foncolor">Customer</label>
                            <input name="customer_name" type="text" id="exampleCalculation"
                                placeholder="Enter Customer Name" class="form-control inp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-2 border-0">
                            <label for="exampleCalculation" class="foncolor">Container</label>
                            <select name="container_size_id" class="js-example-basic-single select2"
                                id="containerSelect">
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
                            <select name="from_country" id="from_country_select" class="form-control inp select2">
                                <option selected disabled hidden>Select Country</option>
                                @foreach($countrys as $index => $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('from_country')
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
                            <select id="to_country_select" name="to_country" class="form-control inp select2">
                                <option selected disabled hidden>Select Country</option>
                                @foreach($countrys as $index => $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('to_country')
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
                            <input name="freight_price" type="text" id="Container_Freight_price" placeholder=""
                                class="form-control inp" value="0.0000">
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

                    <input name="port_wise_freights_id" type="hidden" id="port_wise_freights_id" placeholder=""
                        class="form-control inp" value="0.0000">
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
                                    <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="">
                                    <input name="used_volume" type="text" id="progress-input" class="form-control inp"
                                        value="0%" readonly>
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
                                    <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="">
                                    <input name="used_weight" type="text" id="progress-input" class="form-control inp"
                                        value="0%" readonly>
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

                    <tbody id="product_data" class="border productData border-dark-subtle">
                    </tbody>

                    <tbody id="update_data" class="border border-dark-subtle d-none">
                        <tr>
                            <td colspan="8">
                                <div class="my-2 row justify-content-between">
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Product</label>
                                    <div class="col-md-10 col-lg-10 col-sm-10 ps-4">
                                        <input name="product_name" id="product_name" type="text"
                                            class="form-control inp form-control-sm" id="inputProduct">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Description</label>
                                    <div class="col-md-10 col-lg-10 col-sm-10 ps-4">
                                        <textarea name="description" id="description" type="text"
                                            class="form-control inp form-control-sm" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Total
                                        Quantity</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input name="total_quantity" type="number"
                                            class="form-control inp form-control-sm" id="total_quantity"
                                            placeholder="0">
                                    </div>
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Qty/Pack</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input name="qty_pack" type="text" class="form-control inp form-control-sm"
                                            id="qty_pack" placeholder="0">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">
                                        Dimensions in</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <select name="dimensions_in" class="form-select form-select-sm select2"
                                            id="dimensions_in">
                                            <option disabled hidden selected value=""></option>
                                            <option value="cm">Cm</option>
                                            <option value="meter">Meter</option>
                                            <option value="inch">Inch</option>
                                        </select>
                                    </div>
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Length</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input name="length" type="text" class="form-control inp form-control-sm"
                                            id="length" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Breadth</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input name="breadth" type="text" class="form-control inp form-control-sm"
                                            id="breadth" placeholder="0.00">
                                    </div>
                                    <label for="inputProduct"
                                        class="col-sm-2 col-form-label fw-light font13">Height</label>
                                    <div class="col-md-4 col-lg-4 col-sm-4 ps-4">
                                        <input name="height" type="text" class="form-control inp form-control-sm"
                                            id="height" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Product
                                        Weight</label>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 pe-1 ps-4 border-0 sm">
                                        <select name="product_weight_type" class="form-select form-select-sm select2"
                                            id="product_weight_type">
                                            <option disabled hidden selected value=""></option>
                                            <option value="Kg">Kg</option>
                                            <option value="G">G</option>
                                            <option value="Lbs">Lbs</option>
                                            <option value="Oz">Oz</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 ps-1">
                                        <input name="product_weight" type="text"
                                            class="form-control inp form-control-sm" id="product_weight"
                                            placeholder="0.00">
                                    </div>
                                    <label for="inputProduct" class="col-sm-2 col-form-label fw-light font13">Packing
                                        Weight</label>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 pe-1 ps-4 border-0 sm">
                                        <select name="packing_weight_type" class="form-select select2"
                                            id="packing_weight_type">
                                            <option disabled hidden selected value=""></option>
                                            <option value="Kg">Kg</option>
                                            <option value="G">G</option>
                                            <option value="Lbs">Lbs</option>
                                            <option value="Oz">Oz</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-sm-6 mt-1 ps-1">
                                        <input name="packing_weight" type="text"
                                            class="form-control inp form-control-sm" id="packing_weight"
                                            placeholder="0.00">
                                    </div>
                                </div>

                            </td>
                            <td colspan="7">
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        Cartons</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input name="total_cartons" type="text" class="form-control inp form-control-sm"
                                            id="total_cartons" placeholder="0">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Single
                                        CBM</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input name="single_CBM" type="text" class="form-control inp form-control-sm"
                                            id="single_CBM" placeholder="0">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        CBM</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input name="total_CBM" type="text" class="form-control inp form-control-sm"
                                            id="total_CBM_id" placeholder="0">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Net
                                        Weight
                                        (kg.)</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input name="net_weight_kg" type="text" class="form-control inp form-control-sm"
                                            id="net_weight_kg" placeholder="0">
                                    </div>
                                </div>
                                <div class="my-2 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Gross
                                        weight
                                        (kg.)</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input name="gross_weight_kg" type="text"
                                            class="form-control inp form-control-sm" id="gross_weight_kg"
                                            placeholder="0">
                                    </div>
                                </div>
                                <div class="my-2 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        Net
                                        weight
                                        (kg.)</label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input name="total_net_weight_kg" type="text"
                                            class="form-control inp form-control-sm" id="total_net_weight_kg"
                                            placeholder="0">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <label for="inputProduct"
                                        class="col-lg-4 col-md-4 col-sm-4 col-form-label fw-light font13 me-sm-3">Total
                                        Gross
                                        weight (kg.):
                                    </label>
                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                        <input name="total_gross_weight_kg" type="text"
                                            class="form-control inp form-control-sm" id="total_gross_weight_kg_id"
                                            placeholder="0">
                                    </div>
                                </div>
                                <div class="my-1 row">
                                    <button type="submit" for="inputProduct" id="UpdateBtn"
                                        class="col-md-4 col-lg-4 col-sm-4 btn bg-transparent btn-text-color text-start btn-sm">Update
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-3 mt-3">
                <button type="button" id="addProductBtn" for="inputProduct" class="btn btn-primary">Add
                    Product
                </button>
                <button type="button" id="addProductBtn" for="inputProduct" class="btn buttons btn-primary mt-1">
                    <i class="ti ti-printer me-1"></i>
                    Print Calculation
                </button>
            </div>

        </div>
    </form>
    @section('script')
        <script>
            function deleteProduct(productId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This product will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/api/delete-container-product/' + productId,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                $('#product-row-' + productId).remove(); // Remove row from DOM

                                decreaseVolumeAndWeightBar(response.total_CBM, response.total_gross_weight_kg);
                            },
                            error: function (xhr) {
                                Swal.fire(
                                    'Error!',
                                    xhr.responseJSON?.message || 'Something went wrong!',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }
        </script>
        <script>
            function updateVolumeAndWeightBar(addedCBM, maxCBM, addedWeight, maxWeight) {
                // Get existing used CBM from input like "0.60 / 6.00"
                let existingCBMText = document.getElementById("containerSize_volume").value;
                let existingCBM = parseFloat(existingCBMText.split('/')[0]?.trim()) || 0;

                // Get existing used Weight from input like "2.30 / 20.00"
                let existingWeightText = document.getElementById("containerSize_max_weight").value;
                let existingWeight = parseFloat(existingWeightText.split('/')[0]?.trim()) || 0;

                // Add new CBM and Weight
                let usedCBM = existingCBM + parseFloat(addedCBM);
                let usedWeight = existingWeight + parseFloat(addedWeight);

                // Parse max values
                maxCBM = parseFloat(maxCBM);
                maxWeight = parseFloat(maxWeight);

                // Volume
                const volumePercent = maxCBM > 0 ? (usedCBM / maxCBM) * 100 : 0;
                document.getElementById("containerSize_volume").value = `${usedCBM.toFixed(2)} / ${maxCBM.toFixed(2)}`;
                document.querySelector('[name="used_volume"]').value = `${volumePercent.toFixed(0)}%`;
                document.querySelectorAll('#progress-bar')[0].style.width = `${volumePercent.toFixed(0)}%`;
                document.querySelectorAll('#progress-bar')[0].setAttribute('aria-valuenow', volumePercent.toFixed(0));

                // Weight
                const weightPercent = maxWeight > 0 ? (usedWeight / maxWeight) * 100 : 0;
                document.getElementById("containerSize_max_weight").value = `${usedWeight.toFixed(2)} / ${maxWeight.toFixed(2)}`;
                document.querySelector('[name="used_weight"]').value = `${weightPercent.toFixed(0)}%`;
                document.querySelectorAll('#progress-bar')[1].style.width = `${weightPercent.toFixed(0)}%`;
                document.querySelectorAll('#progress-bar')[1].setAttribute('aria-valuenow', weightPercent.toFixed(0));
            }
            function decreaseVolumeAndWeightBar(removedCBM, removedWeight) {
                // Get existing used CBM & Weight from inputs (e.g. "1.20 / 6.00")
                let existingCBMText = document.getElementById("containerSize_volume").value;
                let existingWeightText = document.getElementById("containerSize_max_weight").value;

                let [usedCBM, maxCBM] = existingCBMText.split('/').map(val => parseFloat(val.trim()) || 0);
                let [usedWeight, maxWeight] = existingWeightText.split('/').map(val => parseFloat(val.trim()) || 0);

                // Subtract the removed values
                usedCBM = Math.max(0, usedCBM - parseFloat(removedCBM));
                usedWeight = Math.max(0, usedWeight - parseFloat(removedWeight));

                // Volume
                const volumePercent = maxCBM > 0 ? (usedCBM / maxCBM) * 100 : 0;
                document.getElementById("containerSize_volume").value = `${usedCBM.toFixed(2)} / ${maxCBM.toFixed(2)}`;
                document.querySelector('[name="used_volume"]').value = `${volumePercent.toFixed(0)}%`;
                document.querySelectorAll('#progress-bar')[0].style.width = `${volumePercent.toFixed(0)}%`;
                document.querySelectorAll('#progress-bar')[0].setAttribute('aria-valuenow', volumePercent.toFixed(0));

                // Weight
                const weightPercent = maxWeight > 0 ? (usedWeight / maxWeight) * 100 : 0;
                document.getElementById("containerSize_max_weight").value = `${usedWeight.toFixed(2)} / ${maxWeight.toFixed(2)}`;
                document.querySelector('[name="used_weight"]').value = `${weightPercent.toFixed(0)}%`;
                document.querySelectorAll('#progress-bar')[1].style.width = `${weightPercent.toFixed(0)}%`;
                document.querySelectorAll('#progress-bar')[1].setAttribute('aria-valuenow', weightPercent.toFixed(0));
            }

        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const getVal = name => parseFloat(document.querySelector(`[name="${name}"]`).value) || 0;

                const calculate = () => {
                    const totalQty = getVal('total_quantity');
                    const qtyPack = getVal('qty_pack');
                    const length = getVal('length');
                    const breadth = getVal('breadth');
                    const height = getVal('height');
                    const productWeight = getVal('product_weight');
                    const packingWeight = getVal('packing_weight');

                    // Total Cartons
                    const totalCartons = qtyPack ? totalQty / qtyPack : 0;
                    document.querySelector('[name="total_cartons"]').value = totalCartons.toFixed(0);

                    // Single CBM in m³
                    const singleCBM = (length * breadth * height) / 1000000;
                    document.querySelector('[name="single_CBM"]').value = singleCBM.toFixed(4);

                    // Total CBM
                    const totalCBM = singleCBM * totalCartons;
                    document.querySelector('[name="total_CBM"]').value = totalCBM.toFixed(2);

                    // Net Weight per Carton
                    const netWeightPerCarton = productWeight * qtyPack;
                    document.querySelector('[name="net_weight_kg"]').value = netWeightPerCarton.toFixed(2);

                    // Gross Weight per Carton
                    const grossWeightPerCarton = (productWeight * qtyPack) + packingWeight ;
                    console.log("grossWeightPerCarton", grossWeightPerCarton);
                    console.log("productWeight", productWeight);
                    console.log("packingWeight", packingWeight);
                    console.log("qtyPack", qtyPack);
                    document.querySelector('[name="gross_weight_kg"]').value = grossWeightPerCarton.toFixed(2);

                    // Total Net Weight (accurate)
                    const totalNetWeight = productWeight * totalQty;
                    document.querySelector('[name="total_net_weight_kg"]').value = totalNetWeight.toFixed(2);

                    // Total Gross Weight (accurate)
                    const totalGrossWeight = totalQty + (packingWeight * totalCartons);
                    document.querySelector('[name="total_gross_weight_kg"]').value = totalGrossWeight.toFixed(2);
                };

                // Bind calculation to all inputs/selects
                document.querySelectorAll('input').forEach(input => {
                    input.addEventListener('input', calculate);
                });
                document.querySelectorAll('select').forEach(select => {
                    select.addEventListener('change', calculate);
                });

            });
        </script>
        <script>
            $(document).ready(function () {
                $('#singleShippingContainerForm').on('submit', function (e) {
                    e.preventDefault(); // Prevent default form submit

                    let formData = new FormData(this);

                    $.ajax({
                        url: '/api/store-single-shipping-container-product',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token if needed
                        },
                        success: function (response) {
                            let p = response.product_data;

                            let newRow = `
                                            <tr id="product-row-${p.id}">
                                                    <td class="border-bottom border-dark-subtle text-middle fw-light">
                                                        <div class="d-block">
                                                            <a href="#" class="decoration-text pe-2">Edit</a>
                                                            <a href="#" class="decoration-text" onclick="deleteProduct(${p.id})">Delete</a>
                                                        </div>
                                                    </td>
                                                    <td class="border border-dark-subtle fw-light">${p.product_name}</td>
                                                    <td class="border border-dark-subtle fw-light">${p.description}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.total_quantity}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.qty_pack}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.packing_weight}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.length}*${p.breadth}*${p.height} ${p.dimensions_in}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.total_cartons}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.length}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.product_weight} ${p.product_weight_type}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.packing_weight} ${p.packing_weight_type}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.total_net_weight_kg}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.total_gross_weight_kg}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.single_CBM}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.total_CBM}</td>
                                                    <td class="border border-dark-subtle text-end fw-light">${p.product_weight_type}</td>
                                                </tr>
                                                `;

                            let containerSize_volume = $('#containerSize_volume').val().split('/')[1]?.trim() || '';
                            let containerSize_max_weight = $('#containerSize_max_weight').val().split('/')[1]?.trim() || '';

                            let total_CBM_id = $('#total_CBM_id').val();
                            let total_gross_weight_kg_id = $('#total_gross_weight_kg_id').val();

                            updateVolumeAndWeightBar(total_CBM_id, containerSize_volume, total_gross_weight_kg_id, containerSize_max_weight);

                            // Remove "No data to display" row if exists
                            $('#product_data tr:contains("No data to display")').remove();

                            // Insert before the Add Product button row
                            $('#product_data').append(newRow);

                            $('#product_name').val('');
                            $('#description').val('');
                            $('#qty_pack').val('');
                            $('#product_weight').val('');
                            $('#packing_weight').val('');
                            $('#length').val('');
                            $('#breadth').val('');
                            $('#height').val('');
                            $('#total_quantity').val('');
                            $('#total_cartons').val('');
                            $('#total_CBM_id').val('');
                            $('#single_CBM').val('');
                            $('#net_weight_kg').val('');
                            $('#gross_weight_kg').val('');
                            $('#total_net_weight_kg').val('');
                            $('#total_gross_weight_kg_id').val('');

                            $('#dimensions_in').val('').trigger('change'); // for Select2
                            $('#product_weight_type').val('').trigger('change'); // for Select2
                            $('#packing_weight_type').val('').trigger('change'); // for Select2


                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                            alert(xhr.responseText);
                        }
                    });
                });
            });
        </script>
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
                                    $('#port_wise_freights_id').val(response.freight_data.id);
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