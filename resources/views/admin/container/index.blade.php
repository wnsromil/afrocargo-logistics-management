<x-app-layout>
    <x-slot name="header">
        {{ __('Container List') }}
    </x-slot>

    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.container.create') }}" class="btn btn-primary buttons">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Container
                    </div>
                </a>
            </div>
        </div>
    </div>

    <x-slot name="cardTitle">
        <p class="head">All Containers</p>

        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control forms" id="searchInput" placeholder="Search ">

                </form>
            </div>
            <div class="mt-2">
                <button type="button"
                    class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                    <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                        <span><i class="fe fe-refresh-ccw"></i></span>
                    </a>
                </button>
            </div>
        </div>
    </x-slot>

    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No.</th>
                                <th>Warehouse</th>
                                <th>Size</th>
                                <th>Container No. 1</th>
                                <th>Container No. 2</th>
                                <th>Booking Number</th>
                                <th>Seal No.</th>
                                <th>Bill Of Lading</th>
                                <th>Open Date</th>
                                <th>Close Date</th>
                                <th>Close Invoice</th>
                                <th>Close Warehouse</th>
                                <th>Driver Name</th>
                                <th>Transfer Date</th>
                                <th>Total Orders</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Status Change</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicles as $index => $vehicle)
                                <tr>
                                    <td>
                                        {{ ++$index }}
                                    </td>
                                    <td>{{ ucfirst($vehicle->warehouse->warehouse_name ?? '') }}</td>
                                    <td>{{ $vehicle->container_size ?? '-' }}</td>
                                    <td>{{ $vehicle->container_no_1 ?? '-' }}</td>
                                    <td>{{ $vehicle->container_no_2 ?? '-' }}</td>
                                    <td>{{ $vehicle->booking_number ?? '-' }}</td>
                                    <td>{{ $vehicle->seal_no ?? '-' }}</td>
                                    <td>{{ $vehicle->bill_of_lading ?? '-' }}</td>

                                    <td>{{ $vehicle->open_date ? \Carbon\Carbon::parse($vehicle->open_date)->format('m-d-Y') : '-' }}</td>
                                    <td>{{ $vehicle->close_date ? \Carbon\Carbon::parse($vehicle->close_date)->format('m-d-Y') : '-' }}</td>                                    
                                    <td class="tabletext"><input type="checkbox"></td>
                                    <td class="tabletext"><input type="checkbox"></td>
                                    <td>{{ ucfirst($vehicle->driver->name ?? '-') }}</td>
                                    <td>-</td>
                                    <td>{{$vehicle->parcelsCount->first()->count ?? 0}}</td>
                                    <td>
                                        <p><label class="amountfont">Recieved:</label> $0</p>
                                        <p><label class="amountfont">Due:</label> $0</p>
                                        <p><label class="amountfont">Total:</label> $0</p>
                                    </td>
                                    <td>
                                        <label
                                            class="labelstatus {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}"
                                            for="{{ $vehicle->status == 'Active' ? 'paid_status' : 'unpaid_status' }}">
                                            {{ $vehicle->status == 'Active' ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="status-toggle toggles togglep">
                                            <input
                                                onclick="handleContainerClick('{{ $vehicle->id }}', '{{ $vehicle->container_no_1 }}')"
                                                id="rating_{{$index}}" class="check" type="checkbox"
                                                value="{{$vehicle->status}}" {{$vehicle->status == 'Active' ? 'checked' : '' }}>
                                            <label for="rating_{{$index}}"
                                                class="checktoggle log checkbox-bg">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="btntext">
                                        <button class=orderbutton><img src="{{asset('assets/img/ordereye.png')}}"></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-4 text-center text-gray-500">No data found.</td>
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
                        {!! $vehicles->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        function handleContainerClick(containerId, containerNumber) {
            // Step 1: First fetch current active container
            axios.get('/api/vehicle/getAdminActiveContainer')
                .then(response => {
                    const activeContainer = response.data.container;

                    let message = '';  // To hold the message
                    let checkbox_status = '';

                    // Condition 1: If active container is the same as the one to open
                    if (activeContainer?.container_no_1 === containerNumber) {
                        message = `That you need to close this <b>${containerNumber}</b> container`;
                        checkbox_status = "only_close";
                    }
                    // Condition 2: If there's no active container
                    else if (!activeContainer?.container_no_1) {
                        message = `That you need to open this <b>${containerNumber}</b> container`;
                        checkbox_status = "only_open";
                    }
                    // Condition 3: If active container is different from the one to open
                    else {
                        message = `That you want to close this <b>${activeContainer?.container_no_1 ?? 'N/A'}</b> container and open this <b>${containerNumber}</b> container`;
                        checkbox_status = "both_open_close";
                    }

                    // Show the Swal message based on the conditions
                    Swal.fire({
                        title: 'Are you sure?',
                        html: message,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, confirm',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Step 3: Now call POST to toggle status
                            axios.post('/api/vehicle/toggle-status', {
                                open_id: containerId, // New container to open (Active)
                                close_id: activeContainer?.id, // Old container to close (Inactive)
                                checkbox_status:checkbox_status
                            })
                                .then((res) => {
                                    Swal.fire('Success', 'Container status updated.', 'success').then(() => {
                                        location.reload();
                                    });
                                })
                                .catch(error => {
                                    Swal.fire('Error', 'Failed to update container status.', 'error');
                                });
                        } else {
                            // User cancelled → reload the page
                            location.reload();
                        }
                    });
                })
                .catch(error => {
                    Swal.fire('Error', 'Failed to fetch current active container.', 'error');
                });
        }
    </script>

</x-app-layout>