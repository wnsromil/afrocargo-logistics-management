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
            <a href="{{ route('admin.customer.create') }}" class="btn btn-primary buttons">
                <i class="ti ti-circle-plus me-2 text-white"></i>
                Add Customer
            </a>
        </div>
    </x-slot>

    <div>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.customer.index') }}" method="GET">
                    <div class="d-flex align-items-center">
                        <label class="foncolor m-0 p-0">Customer</label>
                        <div class="inputGroup w-50 position-relative customInputSearch mx-3">
                            <i class="ti ti-search"></i>
                            <input type="text" class="form-control form-cs" placeholder="Search" name="search"
                                value="{{ request('type') === 'customer' ? request('search') : '' }}"
                                id="customerSearch">
                            <input type="hidden" name="type" value="customer">
                        </div>
                        <button type="submit" class="btn px-3 btn-primary me-2">Search</button>
                        <button type="button" ="btn btn-danger icon-btn" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Refresh" onclick="resetForm()"> <i class="fe fe-refresh-ccw"></i> </button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="{{ route('admin.customer.index') }}" method="GET" id="shipToformSearch">
                    <div class="d-flex align-items-center justify-content-sm-end">
                        <label class="foncolor m-0 p-0">ShipTo</label>
                        <div class="inputGroup w-50 position-relative customInputSearch mx-3">
                            <i class="ti ti-search"></i>
                            <input type="text" class="form-control form-cs" placeholder="Search" name="search"
                                value="{{ request('type') === 'ShipTo' ? request('search') : '' }}">
                            <input type="hidden" name="type" value="ShipTo">
                        </div>
                        <button type="submit" class="btn px-3 btn-primary me-2">Search</button>
                        <button type="button" class="btn btn-danger icon-btn" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Refresh" onclick="resetForm()"> <i class="fe fe-refresh-ccw"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table tables table-stripped table-hover datatable ">
                        <thead class="thead-light">

                            <tr>
                                <th class="no-sort">Customer ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Warehouse</th>
                                <th>Group Container</th>
                                <th>License ID</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th style="text-align: center;">Status</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $index => $customer)
                                <tr>
                                    <td> {{ $customer->unique_id }}</td>
                                    <td>
                                        <h2 {{-- class="table-avatar" --}}>
                                            <a href="{{ route('admin.customer.show', $customer->id) }}"
                                                class="avatar avatar-sm me-2">
                                                @if ($customer->profile_pic)
                                                    <img class="avatar-img rounded-circle"
                                                        src="{{ asset($customer->profile_pic) }}" alt="license">
                                                @else
                                                    <p>No Image</p>
                                                @endif
                                            </a>
                                        </h2>
                                    </td>
                                    <td>{{ ucfirst($customer->name ?? '') }}</td>
                                    <td>{{ $customer->username ?? '' }}</td>
                                    <td>{{ $customer->email ?? '-' }}</td>
                                    <td>{{ $customer->warehouse->warehouse_name ?? '-' }}</td>
                                    <td>{{ $customer->vehicle->container_no_1 ?? '-' }}</td>
                                    <td>{{ $customer->license_number ?? '-' }}</td>
                                    <td>+{{ $customer->phone_code->phonecode ?? '' }} {{ $customer->phone ?? '-' }}<br>
                                        +{{ $customer->phone_2_code->phonecode ?? '' }} {{ $customer->phone_2 ?? '-' }}
                                    </td>
                                    <td data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true"
                                        title="{!! nl2br(e($customer->address ?? '-')) . '<br>' . nl2br(e($customer->address_2 ?? '-')) !!}">
                                        {{ Str::limit($customer->address ?? '-', 15) }}<br>
                                        {{ Str::limit($customer->address_2 ?? '-', 15) }}
                                    </td>
                                    <td>
                                        <label
                                            class="labelstatus {{ $customer->status == 'Active' ? 'Active' : 'Inactive' }}"
                                            for="{{ $customer->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                            {{ $customer->status == 'Active' ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.customer.edit', $customer->id) . '?page=' . request()->page ?? 1 }}"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.customer.show', $customer->id) }}"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>
                                                    @if($customer->status == 'Active')
                                                        <li>
                                                            <a class="dropdown-item deactivate" href="javascript:void(0)"
                                                                data-id="{{ $customer->id }}" data-status="Inactive">
                                                                <i class="far fa-bell-slash me-2"></i>Deactivate
                                                            </a>
                                                        </li>
                                                    @elseif($customer->status == 'Inactive')
                                                        <li>
                                                            <a class="dropdown-item activate" href="javascript:void(0)"
                                                                data-id="{{ $customer->id }}" data-status="Active">
                                                                <i class="fa-solid fa-power-off me-2"></i>Activate
                                                            </a>
                                                        </li>
                                                    @endif
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
                window.location.href = "{{ route('admin.customer.index') }}";
            }

        </script>

    @endsection
</x-app-layout>