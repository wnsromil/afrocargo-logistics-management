<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Container Wise Freight') }}
        </h2>
    </x-slot>

    <div class="container px-5 pb-5">
        <div class="col-md-1 col-sm-1 col-lg-1"></div>
        <div class="col-md-8 col-sm-12 col-lg-8">

            <!-- <div class="row">
                <label for="selectPort" class="text-dark-shade freight-size">Create New Or Select Existing Port-wise
                    Freight Information</label>

                <select class="form-select text-secondary" id="selectPort" aria-label="Default select example">
                    <option selected>Add new freight information</option>
                    <option value="1">India: Chennai - United States: New York</option>
                    <option value="2">India: Chennai - United States: San Diego, California</option>
                </select>
            </div> -->
            <div class="row">
                <label for="selectPort" class="text-dark-shade freight-size">Create New Or Select Existing Port-wise
                    Freight Information</label>

                <select class="form-select text-secondary" id="selectPort" aria-label="Default select example">
                    <option selected value="">Select Option</option>
                    <option value="add">Add new freight information</option>
                    <option value="1" data-from="India: Chennai" data-to="United States: New York">
                        India: Chennai - United States: New York
                    </option>
                    <option value="2" data-from="India: Chennai" data-to="United States: San Diego, California">
                        India: Chennai - United States: San Diego, California
                    </option>
                </select>
            </div>

            <div id="existingFreight" class="row mt-3">
                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                    <label for="from_country" class="form-label text-dark">From (Country, Port):</label>
                    <input type="text" class="form-control" id="from_country" placeholder="" readonly>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                    <label for="to_country" class="form-label text-dark">To (Country, Port):</label>
                    <input type="text" class="form-control" id="to_country" placeholder="Country/Port" readonly>
                </div>
            </div>


            <div id="newFreightForm" class="row mt-3" style="display: none;">
                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                    <label for="from_country" class="form-label text-dark">From Country:</label>
                    <input type="text" class="form-control" id="from_country" placeholder="Country/Port">
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                    <label for="new_from_country" class="form-label text-dark">From Port:</label>
                    <input type="text" class="form-control" id="new_from_country" placeholder="Enter from country/port">
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                    <label for="new_to_country" class="form-label text-dark">To Country:</label>
                    <input type="text" class="form-control" id="new_to_country" placeholder="Enter to country/port">
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                    <label for="to_country" class="form-label text-dark">To Port:</label>
                    <input type="text" class="form-control" id="to_country" placeholder="Country/Port">
                </div>
            </div>

            <!-- <div class="row mt-3">
                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                    <label for="from_country" class="form-label text-dark">From (Country, Port):</label>
                    <input type="text" class="form-control" id="from_country" placeholder="Country/Port" readonly>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                    <label for="to_country" class="form-label text-dark">To (Country, Port):</label>
                    <input type="text" class="form-control" id="to_country" placeholder="Country/Port" readonly>
                </div>
            </div> -->

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

            <div class="row mt-2">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="text" class="form-control" id="container_list" value="Standard 20 Feet"
                        placeholder="Country/Port" readonly>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <input type="text" class="form-control" id="freight_list" placeholder="">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected></option>
                        <option value="1">USD</option>
                        <option value="2">Ruppes</option>
                        <option value="3">Euro</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="text" class="form-control" id="container_list" value="Standard 40 Feet"
                        placeholder="Country/Port" readonly>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <input type="text" class="form-control" id="freight_list" placeholder="">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected></option>
                        <option value="1">USD</option>
                        <option value="2">Ruppes</option>
                        <option value="3">Euro</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="text" class="form-control" value="High Cube 40 Feet" id="container_list"
                        readonly>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <input type="text" class="form-control" id="freight_list" placeholder="">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected></option>
                        <option value="1">USD</option>
                        <option value="2">Ruppes</option>
                        <option value="3">Euro</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="text" class="form-control" value="Upgraded 20 Feet" id="container_list"
                        readonly>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <input type="text" class="form-control" id="freight_list" placeholder="">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected></option>
                        <option value="1">USD</option>
                        <option value="2">Ruppes</option>
                        <option value="3">Euro</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="text" class="form-control" value="Reefer 20 Feet" id="container_list"
                        readonly>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <input type="text" class="form-control" id="freight_list" placeholder="">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected></option>
                        <option value="1">USD</option>
                        <option value="2">Ruppes</option>
                        <option value="3">Euro</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="text" class="form-control" value="Reefer 40 Feet" id="container_list"
                        readonly>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <input type="text" class="form-control" id="freight_list" placeholder="">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected></option>
                        <option value="1">USD</option>
                        <option value="2">Ruppes</option>
                        <option value="3">Euro</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="text" class="form-control" value="Reefer 40 Feet High Cube" id="container_list"
                       readonly>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <input type="text" class="form-control" id="freight_list" placeholder="">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected></option>
                        <option value="1">USD</option>
                        <option value="2">Ruppes</option>
                        <option value="3">Euro</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 col-lg-6 col-sm-12"></div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1 pe-3">
                    <button type="button" class="btn btn-dark button-width">Delete</button>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 px-1 ps-3">
                    <button type="submit" class="btn btn-dark button-width">Update</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

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
</script>