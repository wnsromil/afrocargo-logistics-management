<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">Supply Order Management</p>
    </x-slot>
    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form id="expenseFilterForm" action="{{ route('admin.supply_orders.index') }}" method="GET">
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label>By Warehouse</label>
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
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search" value="{{ request('search') }}">
                </div>
            </div>
            {{-- ✅ Select Dropdown for Multiple Warehouses --}}
            <div class="col-md-3 mb-3">
                <label>Driver</label>
                <select class="js-example-basic-single select2 form-control" name="driver_id" id="driver_id_sreach">
                    <option value="">Select Driver</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ request()->input('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>

                    @endforeach
                </select>
                @error('driver_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>Status</label>
                <select class="js-example-basic-single select2" name="status_search" id="status_search">
                    <option value="">Select Status</option>
                    @foreach ($viewSupplyParcelStatus as $ParcelStatus)
                        <option value="{{ $ParcelStatus->id }}" {{ request()->input('status_search') == $ParcelStatus->id ? 'selected' : '' }}>
                            {{ $ParcelStatus->status }}
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="col-12 mb-3">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <div id='ajexTable'>
       @include("admin.supply_orders.table")
    </div>
    <input type="hidden" id="parcel_id_input_hidden" name="parcel_id_hidden" class="form-control" readonly>
    <!-- delivery_with_driver -->
    <div class="modal custom-modal signature-add-modal fade" id="delivery_with_driver" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class=" modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Assign delivery with driver</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="deliveryForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class=" col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                        readonly>
                                    <input type="hidden" id="warehouse_id_input" name="warehouse_id"
                                        class="form-control" readonly>
                                    <input type="hidden" id="created_user_id_input" name="created_user_id"
                                        class="form-control" readonly value="{{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class=" col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Warehouse<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" name="warehouse_id"
                                        onchange="fetchDeliveryDriversBywarehouse(this.value)">
                                        <option selected="selected" value="">Select Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="deliverywarehouseError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Delivery Man<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" id="deliverywarehousedriverDropdown"
                                        name="driver_id">
                                        <option selected="selected" value="">Select delivery Man</option>
                                    </select>
                                    <div id="deliverydriverError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Note</label>
                                    <input type="text" name="notes" class="form-control inp Note"
                                        placeholder="Enter note">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- status change --}}
    <div class="modal custom-modal signature-add-modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="updateStatusModalLabel">Update Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.statusUpdate_self') }}" method="POST">
                @csrf
                <input type="hidden" name="parcel_id" id="modalParcelId">
                <input type="hidden" name="status" id="modalStatus">

                <div class="modal-body">
                <p>Are you sure you want to update the status to <b id="modalStatusLabel"></b>?</p>
                </div>

                <div class="modal-footer py-2">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary custom-btn ml-2">Cancel</button>
                    <button type="submit" class="btn btn-primary ml-2">Yes, Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    @section('script')
        <script>
            function resetForm() {
                window.location.href = "{{ route('admin.supply_orders.index') }}";
            }
            function fetchDeliveryDriversBywarehouse(warehouseId) {
                if (!warehouseId) {
                    // If nothing selected, clear dropdown
                    $('#warehousedriverDropdown').html('<option value="">Select Pickup Man</option>');
                    return;
                }

                $.ajax({
                    url: "/api/user-by-warehouse/" + warehouseId,
                    data: { role_id: 4 },
                    method: "GET",
                    success: function (response) {
                        // Clear existing options
                        let options = '<option value="">Select Pickup Man</option>';

                        // Loop through response (assuming it's an array of users)
                        response.users.forEach(function (driver) {
                            options += `<option value="${driver.id}">${driver.name}</option>`;
                        });

                        $('#deliverywarehousedriverDropdown').html(options);
                    },
                    error: function () {
                        alert("No driver found for the warehouse.");
                    }
                });
            }


            document.addEventListener('DOMContentLoaded', function () {
                var updateStatusModal = document.getElementById('updateStatusModal');

                updateStatusModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;

                    var parcelId = button.getAttribute('data-parcel_id');
                    var status = button.getAttribute('data-status');
                    var statusLabel = button.getAttribute('data-status_label');

                    updateStatusModal.querySelector('#modalParcelId').value = parcelId;
                    updateStatusModal.querySelector('#modalStatus').value = status;
                    updateStatusModal.querySelector('#modalStatusLabel').textContent = statusLabel;
                });
            });
        </script>
    @endsection
</x-app-layout>
