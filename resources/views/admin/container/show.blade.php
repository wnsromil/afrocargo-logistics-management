<x-app-layout>
    <x-slot name="header">
        Container Management - View Container
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Container ID - {{ $vehicle->unique_id ?? '--'}}</p>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
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
                        <p>{{ $vehicle->container_size ?? '--'}}</p>
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

                <!-- Company For Container -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Company For Container </label>
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

                <!-- Action Buttons -->
                <div class="text-end">
                    <a href="{{ route('admin.container.edit', $vehicle->id) }}" class="btn btn-primary me-2">Edit</a>

                    <!-- Delete Button (with confirmation) -->
                    {{-- <form action="{{ route('admin.vehicle.destroy', $vehicle->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger"
                            onclick="deleteData(this, 'Wait! 🤔 Are you sure you want to remove this manager? This action can’t be undone! 🚀')">Delete</button>
                    </form> --}}
                </div>
            </div>
        </div>

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
</x-app-layout>