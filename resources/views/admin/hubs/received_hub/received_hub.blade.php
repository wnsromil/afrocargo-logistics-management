<x-app-layout>
    <x-slot name="header">
        {{ __('Container Received by Warehouse') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Container Received by Warehouse</p>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $fromWarehouseIdFromUrl = request()->query('from_warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.received.hub.list') }}" method="GET">
        <div class="row gx-3 mb-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search" value="{{ request('search') }}">
                </div>
            </div>
            {{-- ✅ Select Dropdown for Multiple Warehouses --}}
            <div class="col-md-3 mb-3">
                <label>To Warehouse</label>
                @if ($authUser->role_id == 1)
                    <select class="js-example-basic-single select2 form-control" name="warehouse_id">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $warehouseIdFromUrl == $warehouse->id || old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                @else
                    @php
                        $singleWarehouse = $warehouses->first();
                    @endphp

                    <input type="text" class="form-control" value="{{ $singleWarehouse->warehouse_name }}" readonly
                        style="background-color: #e9ecef; color: #6c757d;">
                    <input type="hidden" name="warehouse_id" value="{{ $singleWarehouse->id }}">
                @endif
                @error('warehouse_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>From Warehouse</label>
                @if ($authUser->role_id == 1)
                    <select class="js-example-basic-single select2 form-control" name="from_warehouse_id">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $fromWarehouseIdFromUrl == $warehouse->id || old('from_warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                @else
                    @php
                        $singleWarehouse = $warehouses->first();
                    @endphp

                    <input type="text" class="form-control" value="{{ $singleWarehouse->warehouse_name }}" readonly
                        style="background-color: #e9ecef; color: #6c757d;">
                    <input type="hidden" name="from_warehouse_id" value="{{ $singleWarehouse->id }}">
                @endif
                @error('from_warehouse_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
    </form>


    <div id="ajexTable">
        @include('admin.hubs.received_hub.received_hub_table')
    </div>
    <input type="hidden" id="vehicle_id_input_hidden" name="vehicle_id_input_hidden" class="form-control" readonly>

    <div class="modal custom-modal signature-add-modal fade" id="received_to_hub" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Container Received by Hub</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                    </button>
                </div>
                <form method="POST" id="received_to_hub_form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="note" id="Note" class="form-control inp Note"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal custom-modal signature-add-modal fade" id="fullydischargecontainer" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body confirmationpopup">
                    <div class="form-header">

                        <p class="popupc"> Has the container been fully discharged?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button data-bs-dismiss="modal" type="button"
                                    onclick="updatestatusfullydischargecontainer()"
                                    class="w-100 btn btn-primary paid-continue-btn customerpopup">
                                    Yes
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" data-bs-dismiss="modal"
                                    class=" w-100 btn btn-outline-primary custom-btn">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updatestatusfullydischargecontainer() {
            let vehicleId = $("#vehicle_id_input_hidden").val();

            if (!vehicleId) {
                alert("Parcel ID is required.");
                return;
            }
            // Show Loading Indicator
            $(".btn-primary").html("Processing...").prop("disabled", true);

            // Make AJAX POST Request
            $.ajax({
                url: "/api/update-status-fully-discharge-container", // API endpoint
                type: "POST",
                data: {
                    vehicleId: vehicleId,
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                },
                success: function (response) {
                    document
                        .querySelector("#fullydischargecontainer .custom-btn")
                        .click();
                    Swal.fire({
                        title: "Good job!",
                        text: "Status changed successfully!",
                        icon: "success",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Handle Server-Side Validation Errors
                    let errors = xhr.responseJSON?.errors || {};
                },
                complete: function () {
                    // Re-enable Save Button
                    $(".btn-primary").html("Save").prop("disabled", false);
                },
            });
        }
    </script>
    <script>
        function resetForm() {
            window.location.href = "{{ route('admin.received.hub.list') }}";
        }
    </script>


</x-app-layout>