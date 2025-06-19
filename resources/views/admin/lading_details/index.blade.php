<x-app-layout>
    <x-slot name="header">
        {{ __('Bill of Lading Detail') }}
    </x-slot>


    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.lading_details.create') }}" class="btn btn-primary buttons">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add New Bill
                    </div>
                </a>
            </div>
        </div>
    </div>


    <x-slot name="cardTitle">
        <p class="head">Bill of Lading Detail</p>
        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control forms" placeholder="Search" id="searchInput"
                            name="search" value="">
                        {{-- <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button> --}}
                    </div>
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
                                <th>Bill Id </th>
                                <th>Consignee Name </th>
                                <th>Consignee Address</th>
                                <th>Consignee Telephone</th>
                                <th>Shipper Name </th>
                                <th>Shipper Address </th>
                                <th>Shipper Telephone</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($billOfLadingDetails as $bill)
                            <tr>
                                <td>{{ $bill->unique_id ?? '' }}</td>
                                <td>{{ $bill->consigneeDetails->name ?? '' }}</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $bill->consigneeDetails->address ?? '' }}">{{
                                        $bill->consigneeDetails->address ?? '' }}</p>
                                </td>
                                <td>{{ $bill->consigneeDetails->phone ?? '' }}</td>
                                <td>{{ $bill->shipperDetails->name ?? '' }}</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $bill->shipperDetails->address ?? '' }}">{{
                                        $bill->shipperDetails->address ?? '' }}</p>
                                </td>
                                <td>{{ $bill->shipperDetails->phone ?? '' }}</td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.lading_details.edit', $bill->id) }}">
                                                        <i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="deleteRaw('{{ route('admin.lading_details.destroy', $bill->id) }}')">
                                                        <i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
                    <option value="10" {{ request('per_page', 10)==10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page')==20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page')==100 ? 'selected' : '' }}>100</option>
                </select>
                <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
            </div>
            <div class="col-md-6">
                <div class="float-end">
                    <div class="bottom-user-page mt-3">
                        {!! $billOfLadingDetails->appends(['per_page' =>
                        request('per_page')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>