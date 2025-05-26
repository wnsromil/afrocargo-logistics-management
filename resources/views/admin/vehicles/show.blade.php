<x-app-layout>
    <x-slot name="header">
        Vehicle Management - View Vehicle
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Vehicle ID - {{ $vehicle->unique_id ?? '--'}}</p>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Warehouse Name</label>
                        <p>{{ $vehicle->warehouse->warehouse_name ?? '--'}}</p>
                    </div>
                </div>

                <!-- Vehicle Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Vehicle Type</label>
                        <p>{{ $vehicle->vehicle_type ?? '--'}}</p>
                    </div>
                </div>

                <!-- Vehicle Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Vehicle Model</label>
                        <p>{{ $vehicle->vehicle_model ?? '--'}}</p>
                    </div>
                </div>

                <!-- Vehicle Type -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_type">Vehicle Model</label>
                        <p>{{ $vehicle->vehicle_model ?? '--'}}</p>
                    </div>
                </div>

                <!-- Vehicle Number -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_number">Vehicle Manufactured year</label>
                        <p>{{ $vehicle->vehicle_year ?? '--'}}</p>
                    </div>
                </div>

                <!-- Vehicle Model -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_model">Vehicle Number (Plate No.)</label>
                        <p>{{ $vehicle->vehicle_number ?? '--'}}</p>
                    </div>
                </div>

                <!-- Vehicle Manufactured Year -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_year">Licence Plate Number</label>
                        <p>{{ $vehicle->licence_plate_number ?? '--'}}</p>
                    </div>
                </div>

                <!-- Vehicle Capacity -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="vehicle_capacity">Licence Plate Expire Date</label>
                        <p>{{ $vehicle->licence_plate_exp_date ?? '--'}}</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <p for="status">Status</p>
                        <div
                            class="mt-2 badge  {{$vehicle->status == 'Active' ? 'bg-success-light' : 'bg-danger-light'}}">
                            <p>{{ $vehicle->status }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class=" input-block mb-3 align-items-center">
                        <p for="status">Vehicle Registration Document </p>
                        @if ($vehicle->vehicle_registration_doc)
                            <img src="{{ asset('storage/' . $vehicle->vehicle_registration_doc) }}" alt="license"
                                style="margin-left: 15px; max-width: 150px;">
                        @else
                            <p> - No Image</p>
                        @endif
                    </div>
                </div>

                 <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-block mb-3 align-items-center">
                        <p for="status">Vehicle Insurance Document </p>
                        @if ($vehicle->vehicle_insurance_doc)
                            <img src="{{ asset('storage/' . $vehicle->vehicle_insurance_doc) }}" alt="license"
                                style="margin-left: 15px; max-width: 150px;">
                        @else
                            <p> - No Image</p>
                        @endif
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

            </div>

            <!-- Action Buttons -->
            <div class="text-end">
                <a href="{{ route('admin.vehicle.edit', $vehicle->id) }}" class="btn btn-primary me-2">Edit</a>

                <!-- Delete Button (with confirmation) -->
                {{-- <form action="{{ route('admin.vehicle.destroy', $vehicle->id) }}" method="POST" class="d-inline">
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