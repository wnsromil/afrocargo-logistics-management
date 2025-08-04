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
        {{ __('ShipTo Customer List') }}
    </x-slot>
    <x-slot name="cardTitle">
        <div class="d-flex topnavs justify-content-between">
            <p class="head">All ShipTo Customers</p>
        </div>
    </x-slot>

    @php
        $warehouseIdFromUrl = request()->query('warehouse_id');
        $customerIdFromUrl = request()->query('customer_id');
        $authUser = auth()->user();
    @endphp

    <form action="{{ route('admin.customer.shipToIndex') }}" method="GET" id="filterForm">
        <div class="row gx-3 inputheight40">
            {{-- ShipTo Search --}}
            <div class="col-md-3 mb-3">
                <label for="searchInput">ShipTo Customer</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" class="form-control height40 form-cs" placeholder="Search ShipTo Customer"
                        name="ShipTosearch" value="{{ request('ShipTosearch') }}">
                </div>
            </div>

            {{-- Warehouse --}}
            <div class="col-md-3 mb-3">
                <label>By Customer</label>
                <select class="js-example-basic-single select2 form-control" name="customer_id">
                    <option value="">Select Customer</option>
                    @foreach ($CustomerLists as $customer)
                        <option value="{{ $customer->id }}" {{ $customerIdFromUrl == $customer->id || old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name ?? '' }} {{ $customer->last_name ?? '' }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
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
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table tables table-stripped table-hover datatable ">
                        <thead class="thead-light">
                            <tr>
                                <th>Ship To ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>License ID</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Customer ID</th>
                                <th style="text-align: center;">Status</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $index => $customer)
                                <tr>
                                    <td> {{ $customer->unique_id ?? "--" }}</td>
                                    <td>{{ ucfirst($customer->name ?? '') }} {{$customer->last_name ?? ""}}</td>
                                    <td>{{ $customer->email ?? '-' }}</td>
                                    <td>{{ $customer->license_number ?? '-' }}</td>
                                    <td>+{{ $customer->phone_code->phonecode ?? '' }} {{ $customer->phone ?? '-' }}<br>
                                        +{{ $customer->phone_2_code->phonecode ?? '' }} {{ $customer->phone_2 ?? '-' }}
                                    </td>
                                    <td>{{ $customer->address ?? '-' }}<br>
                                        {{ $customer->address_2 ?? '-' }}
                                    </td>
                                    <td>
                                        @if($customer->parent_customer)
                                            <a href="{{ route('admin.customer.show', $customer->parent_customer_id) }}">
                                                {{ $customer->parent_customer->unique_id }}
                                            </a>
                                        @else
                                            -
                                        @endif

                                    </td>
                                    <td>
                                        @if ($customer->status == 'Active')
                                            <div class="container">
                                                <img src="{{ asset('assets/img/checkbox.png')}}" alt="Image" />
                                                <p>Active</p>
                                            </div>
                                        @else
                                            <div class="container">
                                                <img src="{{ asset('assets/img/inactive.png')}}" alt="Image" />
                                                <p>Inactive</p>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.customer.updateShipTo', $customer->id) }}"><i
                                                                class="ti ti-edit fs_18 me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('admin.customer.destroyShipTo', $customer->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="button" class="dropdown-item"
                                                                onclick="deleteData(this,'Wait! Are you sure you want to remove this ship to customer?')"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-center text-gray-500">No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>


                </div>
            </div>
        </div>
        <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
            <div class="col-md-6 d-flex p-2 align-items-center">
                <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
                <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example"
                    id="pageSizeSelect">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
            </div>
            <div class="col-md-6">
                <div class="float-end">
                    <div class="bottom-user-page mt-3">
                        {!! $customers->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
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
                window.location.href = "{{ route('admin.customer.shipToIndex') }}";
            }

        </script>

    @endsection
</x-app-layout>