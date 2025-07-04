<x-app-layout>
    <x-slot name="header">
        {{ __('Container List') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">All Containers</p>
       <div class="">
                <a href="{{ route('admin.container.create') }}" class="btn btn-primary buttons">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Container
                    </div>
                </a>
            </div>
    </x-slot>

      <form id="expenseFilterForm" action="{{ route('admin.container.index') }}" method="GET">
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search" value="{{ request('search') }}">
                </div>
            </div>
            @php
                $isSingleWarehouse = count($warehouses) === 1;
                $warehouseIdFromUrl = request()->query('warehouse_id');
            @endphp

            @if($isSingleWarehouse)
                {{-- ✅ Readonly Input for Single Warehouse --}}
                <div class="col-md-3 mb-3">
                    <label>By Warehouse</label>
                    <input type="text" class="form-control" value="{{ $warehouses[0]->warehouse_name }}" readonly
                        style="background-color: #e9ecef; color: #6c757d;">
                    <input type="hidden" name="warehouse_id" value="{{ $warehouses[0]->id }}">
                </div>
            @else
                {{-- ✅ Select Dropdown for Multiple Warehouses --}}
                <div class="col-md-3 mb-3">
                    <label>By Warehouse</label>
                    <select class="js-example-basic-single select2 form-control" name="warehouse_id">
                        <option value="">Select Warehouse</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $warehouseIdFromUrl == $warehouse->id || old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('warehouse_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endif


            <div class="col-md-3 mb-3">
                <label>Open Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info bordered">
                    <input type="text" name="open_date" class="btn-filters form-cs inp Expensefillterdate"
                        value="{{ old('open_date', request()->query('open_date')) }}" />
                </div>
            </div>

              <div class="col-md-3 mb-3">
                <label>Close Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info bordered">
                    <input type="text" name="close_date" class="btn-filters form-cs inp Expensefillterdate"
                        value="{{ old('close_date', request()->query('close_date')) }}" />
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <button type="button" class="btn btn-outline-danger btnr" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </div>
      </form>

        <div class="usersearch d-flex align-items-center justify-content-between">
            <div class="lablewrap d-flex text-dark">
                <label class="me-sm-4 me-2 mb-0">Total Billed: <b>328913.5</b></label>
                <label class="me-sm-4 me-2 mb-0">Total Collected: <b>103311.5</b></label>
                <label class="me-sm-4 me-2 mb-0">Total Balance: <b>227389</b></label>
            </div>
       </div>


    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Container ID</th>
                                <th>Warehouse</th>                            
                                <th>Container</th>
                                <th>Open Date</th>
                                <th>Close Date</th>
                                <th>Close Invoice</th>
                                <th>Close Warehouse</th>
                                <th>Volume</th>
                                <th>Status</th>
                                <th>Status Change</th>
                                <th Class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicles as $index => $vehicle)
                            <tr>
                                <td>
                                    {{ $vehicle->unique_id ?? '-' }}
                                </td>
                                <td>{{ ucfirst($vehicle->warehouse->warehouse_name ?? '') }}</td>
                                <td>{{ $vehicle->container_no_1 ?? '-' }}</td>             
                                    <td>{{ $vehicle->open_date ? \Carbon\Carbon::parse($vehicle->open_date)->format('m-d-Y') : '-' }}</td>
                                    <td>{{ $vehicle->close_date ? \Carbon\Carbon::parse($vehicle->close_date)->format('m-d-Y') : '-' }}</td>                                    
                                    <td class="tabletext"><input type="checkbox"></td>
                                    <td class="tabletext"><input type="checkbox"></td>
                                    <td>{{ ucfirst($vehicle->volume ?? '-') }}</td>                                
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
                                                onclick="handleContainerClick('{{ $vehicle->id }}', '{{ $vehicle->container_no_1 }}' , '{{ $vehicle->warehouse_id }}')"
                                                id="rating_{{$index}}" class="check" type="checkbox"
                                                value="{{$vehicle->status}}" {{$vehicle->status == 'Active' ? 'checked' : '' }}>
                                            <label for="rating_{{$index}}"
                                                class="checktoggle log checkbox-bg">checkbox</label>
                                        </div>
                                    </td>
                                   <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.container.edit', $vehicle->id)}}"><i
                                                                class="far fa-edit me-2"></i>Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.container.show', $vehicle->id) }}"><i
                                                                class="far fa-eye me-2"></i>View</a>
                                                    </li>
                                                   
                                                </ul>
                                            </div>
                                        </div>
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
                <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example" id="pageSizeSelect">
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

@section('script')
<!-- Axios CDN -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    function handleContainerClick(containerId, containerNumber, warehouseId) {
        // Step 1: First fetch current active container
        axios.post('/api/vehicle/getAdminActiveContainer', {
          warehouse_id: warehouseId // जो भी warehouse ID यूज़र ने चुना है
          }).then(response => {
                const activeContainer = response.data.container;

                let message = '';
                let checkbox_status = '';

                if (activeContainer?.container_no_1 === containerNumber) {
                    message = `That you need to close this <b>${containerNumber}</b> container`;
                    checkbox_status = "only_close";
                } else if (!activeContainer?.container_no_1) {
                    message = `That you need to open this <b>${containerNumber}</b> container`;
                    checkbox_status = "only_open";
                } else {
                    message = `That you want to close this <b>${activeContainer?.container_no_1 ?? 'N/A'}</b> container and open this <b>${containerNumber}</b> container`;
                    checkbox_status = "both_open_close";
                }

                Swal.fire({
                    title: 'Are you sure?',
                    html: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, confirm',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('/api/vehicle/toggle-status', {
                            open_id: containerId,
                            close_id: activeContainer?.id,
                            checkbox_status: checkbox_status,
                             warehouseId: warehouseId,
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
                        location.reload();
                    }
                });
            })
            .catch(error => {
                Swal.fire('Error', 'Failed to fetch current active container.', 'error');
            });
    }

    function resetForm() {
        window.location.href = "{{ route('admin.container.index') }}";
    }
</script>
@endsection


</x-app-layout>
