<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CBM Calculator') }}
        </h2>
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Port-wise Freight</p>
    </x-slot>
    <form>
        <div class="row">
            <div class="col-md-8 col-sm-12 col-lg-8">
                <div class="input_group">
                    <p for="selectPort" class="form-label text-dark">Create New Or Select Existing Port-wise
                        Freight Information</p>

                    <select class="form-select inp text-secondary" id="selectPort" aria-label="Default select example">
                        <option selected disabled hidden value="">Select Option</option>
                        <option value="add">Add new freight information</option>
                        <option value="1" data-from="India: Chennai" data-to="United States: New York"
                            data-freight="2500" data-currency="USD">
                            India: Chennai - United States: New York
                        </option>
                        <option value="2" data-from="India: Chennai" data-to="United States: San Diego, California"
                            data-freight="2200" data-currency="USD">
                            India: Chennai - United States: San Diego, California
                        </option>
                    </select>
                </div>
                <div class="form-group-customer">
                    <div id="existingFreight" class="row mt-3">
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <label for="from_country" class="form-label text-dark">From (Country, Port):</label>
                            <input type="text" class="form-control inp" id="from_country" placeholder="Country/Port"
                                readonly>
                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <label for="to_country" class="form-label text-dark">To (Country, Port):</label>
                            <input type="text" class="form-control inp" id="to_country" placeholder="Country/Port"
                                readonly>
                        </div>
                    </div>

                    <div id="newFreightForm" class="row mt-3" style="display: none;">
                        <div class="col-md-6 col-lg-6 col-sm-12 border-0 mb-3">
                            <label for="from_country" class="form-label text-dark">From Country</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected" disabled hidden>Select Country</option>
                                <option value="United States">United States</option>
                                <option value="Canada">Canada</option>
                                <option value="Africa">Africa</option>
                                <option value="India">India</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 border-0 mb-3">
                            <label for="new_from_country" class="form-label text-dark">From Port</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected" disabled hidden>Select Port</option>
                                <option value="Aberdeen, Washington">Aberdeen, Washington</option>
                                <option value="Atlanta, Georgia">Atlanta, Georgia</option>
                                <option value="Baltimore, Maryland">Baltimore, Maryland</option>
                                <option value="Beaumont, Texas">Beaumont, Texas</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 border-0 mb-3">
                            <label for="new_to_country" class="form-label text-dark">To Country:</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected" disabled hidden>Select Country</option>
                                <option value="United States">United States</option>
                                <option value="Canada">Canada</option>
                                <option value="Africa">Africa</option>
                                <option value="India">India</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 border-0 mb-3">
                            <label for="to_country" class="form-label text-dark">To Port:</label>
                            <select class="js-example-basic-single select2 ">
                                <option selected="selected" disabled hidden>Select Port</option>
                                <option value="Chennai">Chennai</option>
                                <option value="Cochin">Cochin</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Port Blair">Port Blair</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 col-lg-6 col-sm-3">
                            <p for="from_country" class="form-label text-dark ps-1">Container</p>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3 text-end">
                            <label for="to_country" class="form-label text-dark">Freight</label>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <label for="to_country" class="form-label text-dark text-start">Currency</label>
                        </div>
                    </div>
                    @foreach($containerSizes as $index => $container)
                        <div class="row mt-2">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <input type="text" class="form-control inp" id="container_list" name="container_name[]"
                                    value="{{ $container->container_name }}" placeholder="Country/Port" readonly>
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-3">
                                <input type="text" class="form-control inp text-end" id="freight_price_selected"
                                    name="freight_price[]" placeholder="">
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-3 border-0">
                                <select class="form-control inp select2" id="freight_currency"
                                    name="currency[]">
                                    @foreach($viewCurrencys as $index => $currency)
                                        <option value="{{ $currency }}">{{ $currency }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="text-end">

                            <button type="button" class="btn btn-outline-primary custom-btn">Delete Freight</button>

                            <button type="submit" class="btn btn-primary ">Update Freight</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @section('script')
        <script>
            document.getElementById('selectPort').addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];

                const from = selectedOption.getAttribute('data-from');
                const to = selectedOption.getAttribute('data-to');
                const freight = selectedOption.getAttribute('data-freight');
                const currency = selectedOption.getAttribute('data-currency');

                const fromInput = document.getElementById('from_country');
                const toInput = document.getElementById('to_country');
                const newFreightForm = document.getElementById('newFreightForm');
                const existingFreight = document.getElementById('existingFreight');

                // For standard 20 feet
                const freightPriceInput = document.getElementById('freight_price_selected');
                const currencySelect = document.getElementById('freight_currency_checked');

                if (this.value === 'add') {
                    fromInput.value = '';
                    toInput.value = '';
                    newFreightForm.style.display = 'flex';
                    existingFreight.style.display = 'none';

                    freightPriceInput.value = '';
                    currencySelect.value = '';
                } else {
                    fromInput.value = from || '';
                    toInput.value = to || '';
                    newFreightForm.style.display = 'none';
                    existingFreight.style.display = 'flex';

                    // Set the freight & currency values
                    freightPriceInput.value = freight || '';
                    currencySelect.value = currency || '';
                }
            });
        </script>
    @endsection

</x-app-layout>

{{--
<script>
    document.getElementById('selectPort').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const from = selectedOption.getAttribute('data-from');
        const to = selectedOption.getAttribute('data-to');

        const fromInput = document.getElementById('from_country');
        const toInput = document.getElementById('to_country');
        const newFreightForm = document.getElementById('newFreightForm');
        const existingFreightValue = document.getElementById('existingFreight');
        // const containerListValue = document.getElementById('container_list');

        if (this.value === 'add') {
            fromInput.value = '';
            toInput.value = '';
            newFreightForm.style.display = 'flex';
            existingFreight.style.display = 'none';
            // containerListValue.value= '';
        } else {
            fromInput.value = from || '';
            toInput.value = to || '';
            newFreightForm.style.display = 'none';
            existingFreight.style.display = 'flex';
        }
    });

</script> --}}