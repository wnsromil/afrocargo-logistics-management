<x-app-layout>
    <x-slot name="header">
        Container Management - View Container
    </x-slot>

    @section('style')
        <style>
            @media print {
                .not-for-print {
                    display: none !important;
                }
            }
        </style>
    @endsection

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav w-100 justify-content-between">
            <p class="head">Container ID - {{ $vehicle->unique_id ?? '--'}}</p>
            <div class="btnwrapper">
                <button id="printBtn" class="btn btn-primary buttons me-1">Print</button>
                <button id="exportBtn" class="btn btn-primary buttons">Export</button>
            </div>
        </div>
    </x-slot>

    <div class="card" id="cardToExportPrint">
        <div class="card-body">
            <div class="row">
                <!-- Container ID -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Container ID</label>
                        <p>{{ $vehicle->unique_id ?? '--' }}</p>
                    </div>
                </div>

                <!-- Warehouse Name -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Warehouse Name</label>
                        <p>{{ $vehicle->warehouse->warehouse_name ?? '--'}}</p>
                    </div>
                </div>

                <!-- Size -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Size</label>
                        <p>{{ $vehicle->ContainerSize->container_name ?? '--'}}</p>
                    </div>
                </div>

                <!-- Booking Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_number">Booking Number </label>
                        <p>{{ $vehicle->booking_number ?? '--'}}</p>
                    </div>
                </div>

                <!-- Container No -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Container No</label>
                        <p>{{ $vehicle->container_no_1 ?? '--'}}</p>
                    </div>
                </div>

                <!-- Seal Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_model">Seal Number</label>
                        <p>{{ $vehicle->seal_no ?? '--'}}</p>
                    </div>
                </div>

                <!-- Bill Of Lading -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_year">Bill Of Lading</label>
                        <p>{{ $vehicle->bill_of_lading ?? '--'}}</p>
                    </div>
                </div>

                <!-- Shipping line -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Shipping line </label>
                        <p>{{ $vehicle->containerCompany->name ?? '--'}}</p>
                    </div>
                </div>

                <!-- Broker -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Broker</label>
                        <p>{{ $vehicle->brokerData->name ?? '--'}}</p>
                    </div>
                </div>

                <!-- Trucking company -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Trucking company</label>
                        <p>{{ $vehicle->trucking_company ?? '--'}}</p>
                    </div>
                </div>


                <!-- In Date & Time -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Container In Date & Time</label>
                        <p>
                            @if ($vehicle->container_in_date && $vehicle->container_in_time)
                                {{ \Carbon\Carbon::parse($vehicle->container_in_date . ' ' . $vehicle->container_in_time)->format('m/d/Y h:i A') }}
                            @else
                                --
                            @endif
                        </p>

                    </div>
                </div>

                <!-- Out Date & Time -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Container Out Date & Time</label>
                        <p>
                            @if ($vehicle->container_out_date && $vehicle->container_out_time)
                                {{ \Carbon\Carbon::parse($vehicle->container_out_date . ' ' . $vehicle->container_out_time)->format('m/d/Y h:i A') }}
                            @else
                                --
                            @endif
                        </p>

                    </div>
                </div>

                <!-- Gate In Driver -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Gate In Driver</label>
                        <p>{{ $vehicle->gateInDriver->name ?? '--'}}</p>
                    </div>
                </div>

                <!-- Gate Out Driver -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Gate Out Driver</label>
                        <p>{{ $vehicle->gateOutDriver->name ?? '--'}}</p>
                    </div>
                </div>

                <!-- Port Of Loading -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Port Of Loading</label>
                        <p>{{ $vehicle->port_of_loading ?? '--'}}</p>
                    </div>
                </div>


                <!-- Port Of Discharge -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Port Of Discharge</label>
                        <p>{{ $vehicle->port_of_discharge ?? '--'}}</p>
                    </div>
                </div>

                <!-- Celliling Date -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Celliling Date</label>
                        <p>
                            @if ($vehicle->celliling_date && $vehicle->celliling_date)
                                {{ optional($vehicle->celliling_date ? \Carbon\Carbon::parse($vehicle->celliling_date) : null)->format('m/d/Y') }}
                            @else
                                --
                            @endif
                        </p>
                    </div>
                </div>

                <!-- ETA Date -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">ETA Date</label>
                        <p>
                            @if ($vehicle->eta_date && $vehicle->eta_date)
                                {{ \Carbon\Carbon::parse($vehicle->eta_date)->format('m/d/Y') }}
                            @else
                                --
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Transit -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Transit</label>
                        <p>{{ $vehicle->transit_country ?? '--'}}</p>
                    </div>
                </div>

                <!-- Chassis Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Chassis Number</label>
                        <p>{{ $vehicle->chassis_number ?? '--'}}</p>
                    </div>
                </div>


                <!-- Vessel/Voyage -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Vessel/Voyage</label>
                        <p>{{ $vehicle->vessel_voyage ?? '--'}}</p>
                    </div>
                </div>

                <!-- TIR Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">TIR Number</label>
                        <p>{{ $vehicle->tir_number ?? '--'}}</p>
                    </div>
                </div>

                <!-- Ship To Country -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Ship To Country</label>
                        <p>{{ $vehicle->ship_to_country ?? '--'}}</p>
                    </div>
                </div>

                <!-- Doc Id -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Doc Id</label>
                        <p>{{ $vehicle->doc_id ?? '--'}}</p>
                    </div>
                </div>

                <!-- Volume -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Volume</label>
                        <p>{{ $vehicle->volume ?? '--'}}</p>
                    </div>
                </div>

                <!-- Warehouse Location -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_id">Warehouse Location</label>
                        <p>{{ $vehicle->warehouse ? $vehicle->warehouse->warehouse_name : 'N/A' }}</p>
                        <!-- Display additional Warehouse info -->
                        @if($vehicle->warehouse)
                            <p><strong>Address:</strong> {{ $vehicle->warehouse->address ?? '--'}}</p>
                            <p><strong>Contact:</strong> {{ $vehicle->warehouse->phone ?? '--'}}</p>
                        @endif
                    </div>
                </div>

                <!-- Driver Information (from User table) -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="driver_id">Driver Information</label>
                        @if($vehicle->driver)
                            <p><strong>Name:</strong> {{ $vehicle->driver->name ?? '--'}}</p>
                            <p><strong>Email:</strong> {{ $vehicle->driver->email ?? '--'}}</p>
                            <p><strong>Phone:</strong> {{ $vehicle->driver->phone ?? '--'}}</p>
                        @else
                            <p>No driver assigned.</p>
                        @endif
                    </div>
                </div>

                <!-- Status -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <p for="status">Status</p>
                        <div
                            class="mt-2 badge  {{$vehicle->status == 'Active' ? 'bg-success-light' : 'bg-danger-light'}}">
                            <p>{{ $vehicle->status }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-end not-for-print">
                    <a href="{{ route('admin.container.edit', $vehicle->id) }}" class="btn btn-primary me-2">Edit</a>
                </div>
            </div>
        </div>
    </div>
    <table id="exportTable" style="display:none;">
        <thead>
            <tr>
                <th>Container ID</th>
                <th>Warehouse Name</th>
                <th>Size</th>
                <th>Booking Number</th>
                <th>Container No</th>
                <th>Seal Number</th>
                <th>Bill Of Lading</th>
                <th>Company For Container</th>
                <th>Broker</th>
                <th>Trucking company</th>
                <th>Container In Date & Time</th>
                <th>Gate In Driver</th>
                <th>Gate Out Driver</th>
                <th>Port Of Loading</th>
                <th>Port Of Discharge</th>
                <th>Celliling Date</th>
                <th>ETA Date</th>
                <th>Transit</th>
                <th>Chassis Number</th>
                <th>Vessel/Voyage</th>
                <th>TIR Number</th>
                <th>Ship To Country</th>
                <th>Doc Id</th>
                <th>Volume</th>
                <th>Warehouse Location</th>
                <th>Driver Information</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $vehicle->unique_id ?? '--' }}</td>
                <td>{{ $vehicle->warehouse->warehouse_name ?? '--' }}</td>
                <td>{{ $vehicle->container_size ?? '--' }}</td>
                <td>{{ $vehicle->booking_number ?? '--' }}</td>
                <td>{{ $vehicle->container_no_1 ?? '--' }}</td>
                <td>{{ $vehicle->seal_no ?? '--' }}</td>
                <td>{{ $vehicle->bill_of_lading ?? '--' }}</td>
                <td>{{ $vehicle->containerCompany->name ?? '--' }}</td>
                <td>{{ $broker->name ?? '--' }}</td>
                <td>{{ $vehicle->trucking_company ?? '--' }}</td>
                <td>
                    @if ($vehicle->container_in_date && $vehicle->container_in_time)
                        {{ \Carbon\Carbon::parse($vehicle->container_in_date . ' ' . $vehicle->container_in_time)->format('m/d/Y h:i A') }}
                    @else
                        --
                    @endif
                </td>
                <td>{{ $vehicle->gateInDriver->name ?? '--' }}</td>
                <td>{{ $vehicle->gateOutDriver->name ?? '--' }}</td>
                <td>{{ $vehicle->port_of_loading ?? '--' }}</td>
                <td>{{ $vehicle->port_of_discharge ?? '--' }}</td>
                <td> @if ($vehicle->celliling_date && $vehicle->celliling_date)
                    {{ optional($vehicle->celliling_date ? \Carbon\Carbon::parse($vehicle->celliling_date) : null)->format('m/d/Y') }}
                @else
                        --
                    @endif
                </td>
                <td>
                    @if ($vehicle->eta_date && $vehicle->eta_date)
                        {{ optional($vehicle->eta_date ? \Carbon\Carbon::parse($vehicle->eta_date) : null)->format('m/d/Y') }}
                    @else
                        --
                    @endif
                </td>
                <td>{{ $vehicle->transit_country ?? '--' }}</td>
                <td>{{ $vehicle->chassis_number ?? '--' }}</td>
                <td>{{ $vehicle->vessel_voyage ?? '--' }}</td>
                <td>{{ $vehicle->tir_number ?? '--' }}</td>
                <td>{{ $vehicle->ship_to_country ?? '--' }}</td>
                <td>{{ $vehicle->doc_id ?? '--' }}</td>
                <td>{{ $vehicle->volume ?? '--' }}</td>
                <td>
                    @if($vehicle->warehouse)
                        <p><strong>Address:</strong> {{ $vehicle->warehouse->address ?? '--'}}</p>
                        <p><strong>Contact:</strong> {{ $vehicle->warehouse->phone ?? '--'}}</p>
                    @endif
                </td>
                <td>{{ $vehicle->driverInfo ?? '--' }}</td> {{-- Agar driver info alag se defined ho --}}
                <td>{{ $vehicle->status ?? '--' }}</td>
            </tr>
        </tbody>
    </table>
    @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

        <script>
            // PRINT Button
            document.getElementById('printBtn').addEventListener('click', function () {
                const card = document.getElementById('cardToExportPrint');
                const editBtnDiv = card.querySelector('.not-for-print'); // Edit button wali div

                // Edit button hide karo
                if (editBtnDiv) editBtnDiv.style.display = 'none';

                html2canvas(card).then(canvas => {
                    // Edit button wapas dikhao
                    if (editBtnDiv) editBtnDiv.style.display = '';

                    const dataUrl = canvas.toDataURL();
                    const win = window.open('', '_blank');

                    // Time generate karo
                    const now = new Date();
                    const timeString = now.toLocaleTimeString();

                    win.document.write(`
                                                                    <html>
                                                                    <head>
                                                                        <title>Container Print</title>
                                                                        <style>
                                                                            body {
                                                                                margin: 0;
                                                                                padding: 10px;
                                                                                font-family: Arial, sans-serif;
                                                                            }
                                                                            h1 {
                                                                                text-align: center;
                                                                                margin-bottom: 20px;
                                                                            }
                                                                            #printTime {
                                                                                position: fixed;
                                                                                bottom: 10px;
                                                                                left: 0;
                                                                                right: 0;
                                                                                text-align: center;
                                                                                font-size: 12px;
                                                                                color: #555;
                                                                            }
                                                                        </style>
                                                                    </head>
                                                                    <body>
                                                                        <img src="${dataUrl}" style="width:100%" />
                                                                        <div id="printTime">${timeString}</div>
                                                                    </body>
                                                                    </html>
                                                                `);

                    win.document.close();
                    win.focus();

                    setTimeout(() => {
                        win.print();
                        win.close();
                    }, 500);
                });
            });

            // EXPORT Button
            document.getElementById('exportBtn').addEventListener('click', function () {
                const table = document.getElementById('exportTable');
                if (!table) {
                    alert('Export table not found!');
                    return;
                }

                // Convert table to workbook
                const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
                const ws = wb.Sheets["Sheet1"];

                // Center align all cells in worksheet
                for (let cell in ws) {
                    if (cell[0] === '!') continue; // Skip special keys like !ref
                    if (!ws[cell].s) ws[cell].s = {};
                    ws[cell].s.alignment = { horizontal: "center", vertical: "center" };
                }

                // Manually set column widths to avoid hidden text (adjust widths as per your need)
                // Example: 20 characters width for all columns
                const colCount = XLSX.utils.decode_range(ws['!ref']).e.c + 1;
                ws['!cols'] = [];
                for (let i = 0; i < colCount; i++) {
                    ws['!cols'][i] = { wch: 20 }; // 20 character width
                }

                XLSX.writeFile(wb, 'container_data.xlsx', { bookSST: false });
            });

        </script>


        <script>
            function deleteData(self, msg) {
                Swal.fire({
                    title: msg,
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(self).closest('form').submit();
                    }
                });
            }
        </script>
    @endsection
</x-app-layout>