<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CBM Calculator') }}
        </h2>
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Port-wise Freight</p>
    </x-slot>

    <div class="row">
        <div class="col-md-8 col-sm-12 col-lg-8">
            <div class="input_group">
                <p for="selectPort" class="form-label text-dark">Create New Or Select Existing Port-wise
                    Freight Information</p>

                <select class="form-select inp text-secondary" id="selectPort" aria-label="Default select example">
                    <option value="add" selected>Add new freight information</option>
                    <option value="1" data-from="India: Chennai" data-to="United States: New York" data-freight="2500"
                        data-currency="USD">
                        India: Chennai - United States: New York
                    </option>
                    <option value="2" data-from="India: Chennai" data-to="United States: San Diego, California"
                        data-freight="2200" data-currency="USD">
                        India: Chennai - United States: San Diego, California
                    </option>
                </select>
            </div>

            <form action="{{ route('admin.cbm_calculator.store-port-freight') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group-customer">
                    <div id="existingFreight" class="row mt-3" style="display: none;">
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

                    <div id="newFreightForm" class="row mt-3" >
                        <div class="col-md-6 col-lg-6 col-sm-12 border-0 mb-3">
                            <label for="from_country" class="form-label text-dark">From Country</label>
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
                        <div class="col-md-6 col-lg-6 col-sm-12 border-0 mb-3">
                            <label for="new_from_country" class="form-label text-dark">From Port</label>
                            <select id="from_port" name="from_port" class="form-control inp select2">
                                <option selected disabled hidden>Select Port</option>
                            </select>
                            @error('from_port')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 border-0 mb-3">
                            <label for="new_to_country" class="form-label text-dark">To Country:</label>
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
                        <div class="col-md-6 col-lg-6 col-sm-12 border-0 mb-3">
                            <label for="to_country" class="form-label text-dark">To Port:</label>
                            <select id="to_port" name="to_port" class="form-control inp select2">
                                <option selected disabled hidden>Select Port</option>
                            </select>
                            @error('to_port')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                                <select class="form-control inp select2" id="freight_currency" name="currency[]">
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
            </form>
        </div>
    </div>

    @section('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    currencySelect.value = null;
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