<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Container Wise Freight') }}
        </h2>
    </x-slot>


    <div class="container">
        <h3 class="mb-4">Container Sizes</h3>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="text-left">
                    <tr>
                        <th class="col-3 fw-light text-start">Container</th>
                        <th class="col-1 fw-light text-start">Dimensions</th>
                        <th class="fw-light text-start">Length</th>
                        <th class="fw-light text-start">Breadth</th>
                        <th class="fw-light text-start">Height</th>
                        <th class="fw-light text-start">Volume</th>
                        <th class="fw-light text-start">Tare Wt (Kg)</th>
                        <th class="fw-light text-start bg-transparent table-last-column">Max Wt (Kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" value="Standard 20 Feet" readonly></td>
                        <td><input type="text" class=" form-control" value="cm" readonly></td>
                        <td><input type="number" class="form-control" value="590" disabled></td>
                        <td><input type="number" class="form-control" value="235" disabled></td>
                        <td><input type="number" class="form-control" value="239" disabled></td>
                        <td><input type="number" class="form-control" value="33.2000" disabled></td>
                        <td><input type="number" class="form-control" value="2230.00" disabled></td>
                        <td><input type="number" class="form-control" value="21770.00" disabled></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" value="Standard 40 Feet" readonly></td>
                        <td><input type="text" class=" form-control" value="cm" readonly></td>
                        <td><input type="number" class="form-control" value="1203" disabled></td>
                        <td><input type="number" class="form-control" value="235" disabled></td>
                        <td><input type="number" class="form-control" value="239" disabled></td>
                        <td><input type="number" class="form-control" value="67.7000" disabled></td>
                        <td><input type="number" class="form-control" value="3700.00" disabled></td>
                        <td><input type="number" class="form-control" value="26780.00" disabled></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" value="High Cube 40 Feet" readonly></td>
                        <td><input type="text" class=" form-control" value="cm" readonly></td>
                        <td><input type="number" class="form-control" value="1204" disabled></td>
                        <td><input type="number" class="form-control" value="235" disabled></td>
                        <td><input type="number" class="form-control" value="269" disabled></td>
                        <td><input type="number" class="form-control" value="76.3000" disabled></td>
                        <td><input type="number" class="form-control" value="3970.00" disabled></td>
                        <td><input type="number" class="form-control" value="26510.00" disabled></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" value="Upgraded 20 Feet" readonly></td>
                        <td><input type="text" class=" form-control" value="cm" readonly></td>
                        <td><input type="number" class="form-control" value="590" disabled></td>
                        <td><input type="number" class="form-control" value="231" disabled></td>
                        <td><input type="number" class="form-control" value="239" disabled></td>
                        <td><input type="number" class="form-control" value="32.6300" disabled></td>
                        <td><input type="number" class="form-control" value="2300.00" disabled></td>
                        <td><input type="number" class="form-control" value="28180.00" disabled></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" value="Reefer 20 Feet" aria-controls="" readonly>
                        </td>
                        <td><input type="text" class=" form-control" value="cm" readonly></td>
                        <td><input type="number" class="form-control" value="542" disabled></td>
                        <td><input type="number" class="form-control" value="227" disabled></td>
                        <td><input type="number" class="form-control" value="226" disabled></td>
                        <td><input type="number" class="form-control" value="28.3000" disabled></td>
                        <td><input type="number" class="form-control" value="3200.00" disabled></td>
                        <td><input type="number" class="form-control" value="20800.00" disabled></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" value="Reefer 40 Feet" readonly></td>
                        <td><input type="text" class=" form-control" value="cm" readonly></td>
                        <td><input type="number" class="form-control" value="1149" disabled></td>
                        <td><input type="number" class="form-control" value="227" disabled></td>
                        <td><input type="number" class="form-control" value="219" disabled></td>
                        <td><input type="number" class="form-control" value="57.8000" disabled></td>
                        <td><input type="number" class="form-control" value="4900.00" disabled></td>
                        <td><input type="number" class="form-control" value="25580.00" disabled></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" value="Reefer 40 Feet High Cube" readonly></td>
                        <td><input type="text" class=" form-control" value="cm" readonly></td>
                        <td><input type="number" class="form-control" value="1155" disabled></td>
                        <td><input type="number" class="form-control" value="229" disabled></td>
                        <td><input type="number" class="form-control" value="250" disabled></td>
                        <td><input type="number" class="form-control" value="66.6000" disabled></td>
                        <td><input type="number" class="form-control" value="4500.00" disabled></td>
                        <td><input type="number" class="form-control" value="25980.00" disabled></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end gap-3 mt-3">
            <button class="btn btn-secondary bg-button-color ">Default Values</button>
            <button class="btn btn-secondary bg-button-color ">Update Containers</button>
        </div>
    </div>




</x-app-layout>