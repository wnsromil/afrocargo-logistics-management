<x-app-layout>
    @section('style')
        <link rel='stylesheet' href='./css/admin/select2.css' />

    @endsection
    @section('style')
        <style>
            .content-page-header {
                margin-top: -9px;
                justify-content: space-between;
            }

            .page-header {
                margin-bottom: -.5rem;
            }
        </style>
    @endsection
    <x-slot name="header">
        {{ __('Customer List') }}
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex topnavs justify-content-between">
            <p class="head">All Customers</p>
            @can('has-dynamic-permission', 'customers_list.create')
                <a href="{{ route('admin.customer.create') }}" class="btn btn-primary buttons">
                    <i class="ti ti-circle-plus me-2 text-white"></i>
                    Add Customer
                </a>
            @endcan
        </div>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $authUser = auth()->user();
    @endphp

    <form action="{{ route('admin.customer.index') }}" method="GET" id="filterForm">
        <div class="row gx-3 inputheight40">
            {{-- Customer Search --}}
            <div class="col-md-3 mb-3">
                <label for="searchInput">Customer</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" class="form-control height40 form-cs" placeholder="Search Customer" name="search"
                        value="{{ request('search') }}">
                </div>
            </div>

            {{-- Warehouse --}}
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

            {{-- Buttons --}}
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
            </div>
        </div>
    </form>

    <div id='ajexTable'>
         @include('admin.customer.table')
    </div>
    
    <!-- Delete Items Modal -->
    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body confirmationpopup">
                    <div class="form-header">
                        <p class="popupc">Do you want to delete this customer?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" data-bs-dismiss="modal"
                                    class="w-100 btn btn-outline-primary custom-btn">Cancel</button>
                            </div>
                            <div class="col-6">
                                <!-- 🛑 Delete Button - API Call Karega -->
                                <button type="button" class="w-100 btn btn-primary paid-continue-btn customerpopup"
                                    id="confirmDelete">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- -------------------- Configuration Modal ----------------------------- -->

    <div class="modal fade" id="configurationButton" tabindex="-1" aria-labelledby="configurationButtonLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-size">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 px-3" id="configurationButtonLabel">Configuration</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 px-3">
                    <div class="row px-4">
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="basic-info-detail">
                                <h6 class="fw-normal mb-2">Contract</h6>
                                <div class="form-check form-check-inline text-dark">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_1"
                                        id="inlineRadio11" value="option1">
                                    <label class="form-check-label" for="inlineRadio11">Yes</label>
                                </div>
                                <div class="form-check form-check-inline text-dark">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_2"
                                        id="inlineRadio12" value="option2" checked>
                                    <label class="form-check-label" for="inlineRadio12">No</label>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="basic-info-detail">
                                <h6 class="fw-normal mb-2">Text Cust</h6>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_3"
                                        id="inlineRadio13" value="option1" checked>
                                    <label class="form-check-label" for="inlineRadio13">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_4"
                                        id="inlineRadio14" value="option2">
                                    <label class="form-check-label" for="inlineRadio14">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="basic-info-detail">
                                <h6 class="fw-normal mb-2">Voice Call</h6>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_5"
                                        id="inlineRadio15" value="option1" checked>
                                    <label class="form-check-label" for="inlineRadio15">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_6"
                                        id="inlineRadio16" value="option2">
                                    <label class="form-check-label" for="inlineRadio16">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="basic-info-detail">
                                <h6 class="fw-normal mb-2">Cash Cust</h6>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_7"
                                        id="inlineRadio17" value="option1">
                                    <label class="form-check-label" for="inlineRadio17">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_8"
                                        id="inlineRadio18" value="option2" checked>
                                    <label class="form-check-label" for="inlineRadio18">No</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row px-4">
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="basic-info-detail">
                                <h6 class="fw-normal mb-2">Is License Pic</h6>

                                <div class="form-check form-check-inline text-dark">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_9"
                                        id="inlineRadio19" value="option1">
                                    <label class="form-check-label" for="inlineRadio19">Yes</label>
                                </div>
                                <div class="form-check form-check-inline text-dark">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_10"
                                        id="inlineRadio20" value="option2" checked>
                                    <label class="form-check-label" for="inlineRadio20">No</label>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="basic-info-detail">
                                <h6 class="fw-normal mb-2">Active</h6>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_11"
                                        id="inlineRadio21" value="option1" checked>
                                    <label class="form-check-label" for="inlineRadio21">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_12"
                                        id="inlineRadio22" value="option2">
                                    <label class="form-check-label" for="inlineRadio22">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="basic-info-detail">
                                <h6 class="fw-normal mb-2">No Service</h6>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_13"
                                        id="inlineRadio23" value="option1">
                                    <label class="form-check-label" for="inlineRadio23">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_14"
                                        id="inlineRadio24" value="option2" checked>
                                    <label class="form-check-label" for="inlineRadio24">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="basic-info-detail">
                                <h6 class="fw-normal mb-2">Call</h6>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_15"
                                        id="inlineRadio25" value="option1" checked>
                                    <label class="form-check-label" for="inlineRadio25">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_16"
                                        id="inlineRadio26" value="option2">
                                    <label class="form-check-label" for="inlineRadio26">No</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row px-4">
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="basic-info-detail">
                                <h6 class="fw-normal mb-2">Sales Call</h6>

                                <div class="form-check form-check-inline text-dark">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_17"
                                        id="inlineRadio27" value="option1" checked>
                                    <label class="form-check-label" for="inlineRadio27">Yes</label>
                                </div>
                                <div class="form-check form-check-inline text-dark">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_18"
                                        id="inlineRadio28" value="option2">
                                    <label class="form-check-label" for="inlineRadio28">No</label>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary mx-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary mx-1">Save</button>
                </div>
            </div>
        </div>
    </div>



    <!-- /Delete Items Modal -->
    @section('script')
        <script>
            $(document).ready(function () {
                // Delegate click on dynamically updated table
                $('#ajexTable').on('click', '.activate, .deactivate', function () {
                    let id = $(this).data('id');
                    let status = $(this).data('status');

                    $.ajax({
                        url: "{{ route('admin.customer.status', '') }}/" + id
                        , type: 'POST'
                        , data: {
                            _token: '{{ csrf_token() }}'
                            , status: status
                        }
                        , success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success'
                                    , title: 'Status Updated'
                                    , text: response.success
                                });

                                // ✅ You can reload just the table here if needed:
                                // reloadTable();
                                location.reload();
                            }
                        }
                    });
                });
            });

        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let deleteId = null;

                // 🔹 Delete button click par modal open hone se pehle ID store kare
                document.querySelectorAll('[data-bs-target="#delete_modal"]').forEach(button => {
                    button.addEventListener('click', function () {
                        deleteId = this.getAttribute('data-id'); // User ID ko store kare
                        console.log("Selected ID:", deleteId); // Debug ke liye
                    });
                });

                // 🔹 Delete Confirm Button par API call kare
                document.getElementById('confirmDelete').addEventListener('click', function () {
                    if (deleteId) {
                        fetch(`/delete-customers/${deleteId}`, {
                            method: 'GET'
                            , headers: {
                                'Content-Type': 'application/json'
                                , 'Accept': 'application/json'
                                , 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: "Good job!"
                                        , text: "Customer deleted successfully"
                                        , icon: "success"
                                    });

                                    setTimeout(function () {
                                        location.reload(); // 2 second ke baad page refresh karega
                                    }, 2000);

                                } else {
                                    alert('Error: ' + data.message);
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });

        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl, {
                        html: true
                    });
                });
            });

            $('#shipToformSearch').submit(function (e) {
                e.preventDefault(); // Prevent default form submission

                const form = $(this);
                const url = form.attr('action') + '?' + form.serialize(); // Construct URL with query params

                fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
                    .then((response) => response.text())
                    .then((html) => {
                        document.getElementById('ajexTable').innerHTML = html;
                        $('#customerSearch').val('');
                        initializeSorting(); // Optional: If you have sorting logic
                    })
                    .catch((error) => console.error("Error fetching data:", error));
            });

            function resetForm() {
                window.location.href = "{{ route('admin.customer.index') }}";
            }

        </script>

    @endsection
</x-app-layout>