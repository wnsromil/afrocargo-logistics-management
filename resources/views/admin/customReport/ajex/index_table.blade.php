<div class="card-table">
    <div class="table-body">
        <div class="table-responsive table-height mt-3">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light text-start">
                    <tr>
                        <th>Date</th>
                        <th>Branch</th>
                        <th>Container</th>
                        <th>Report Type</th>
                        <th>Doc Id</th>
                        <th>Invoice</th>
                        <th>Expense</th>
                        <th>Exp</th>
                        <th class="bg-transparent table-last-column">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($customReports as $customReport)
                    <tr>
                        <td>{{$customReport->report_date->format('m/d/Y') ?? ''}}</td>
                        <td>{{$customReport->warehouse->warehouse_name ?? ''}},
                            {{$customReport->warehouse->warehouse_code ?? ''}}</td>
                        <td><a data-bs-toggle="modal"
                                data-bs-target="#editContainerModal{{$customReport->id}}">{{$customReport->container->unique_id
                                ?? ''}}</a></td>
                        <td>{{$customReport->report_type ?? ''}}</td>
                        <td>{{$customReport->container->doc_id ?? ''}}</td>
                        <td>{{$customReport->invoiced ?? 0 }}</td>
                        <td class="text-danger">{{$customReport->expense ?? ''}}</td>

                        <td class="text-success">{{ sum($customReport->expense ?? 0,
                            $customReport->invoiced ?? 0) }}
                        </td>
                        <td>
                            <i class="fa-regular fa-envelope me-1" data-bs-toggle="modal"
                                data-bs-target="#trackingReportModal"></i>
                            <i class="far fa-edit mx-1"
                                onclick="redirectTo('{{route('admin.custom-reports.show',$customReport->id)}}')"></i>
                            <i class="far fa-trash-alt mx-1"
                                onclick="deleteRaw('{{route('admin.custom-reports.destroy',$customReport->id)}}')"></i>
                            <button type="button" class="btn bg-transparent fw-semibold p-0" data-bs-toggle="modal"
                                data-bs-target="#expensePopupModal">Expense</button>
                        </td>


                        <!-- Edit Container -->
                        <div class="modal custom-modal fade" id="editContainerModal{{$customReport->id}}" tabindex="-1"
                            aria-labelledby="editContainerModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editContainerModalLabel">Edit
                                            Container</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body noBorder">
                                        <form action="{{route('admin.custom-reports.updateCustomReportContainer')}}"
                                            method="post">
                                            @csrf
                                            <div class="mt-3">
                                                <label for="exampleFormControlInput1" class="form-label mb-0">Branch<i
                                                        class="text-danger">*</i>:</label>
                                                <select class="form-select select2" aria-label="Default select example"
                                                    name="warehouse_id" disabled>
                                                    <option selected>Search Branch</option>
                                                    @foreach ($warehouses as $warehouse)
                                                    <option {{$customReport->warehouse_id ==
                                                        $warehouse->id ? 'selected' :'' }}
                                                        value="{{$warehouse->id ??
                                                        ''}}">{{$warehouse->warehouse_name ?? ''}},
                                                        {{$warehouse->warehouse_code ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mt-3">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label mb-0">Container<i
                                                        class="text-danger">*</i>:</label>
                                                <select class="form-select select2" aria-label="Default select example"
                                                    disabled>
                                                    @foreach ($containers as $item)
                                                    <option {{$customReport->container_id == $item->id ?
                                                        'selected' :'' }}
                                                        value="{{$item->id}}">{{$item->unique_id}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="container_id"
                                                    value="{{$customReport->container_id}}">
                                            </div>

                                            <div class="mt-3">
                                                <label for="doc_id" class="form-label mb-0">Doc Id<i
                                                        class="text-danger">*</i>:</label>
                                                <input type="text" id="doc_id" name="doc_id" class="form-control"
                                                    value="{{$customReport->container->doc_id ?? '' }}">
                                            </div>

                                            <div class="mt-3">
                                                <label for="lading_bill" class="form-label mb-0">Bill Of
                                                    Lading<i class="text-danger">*</i>:</label>
                                                <input type="text" id="lading_bill" name="bill_of_lading"
                                                    class="form-control"
                                                    value="{{$customReport->container->bill_of_lading ?? 0 }}">
                                            </div>

                                            <div class="modal-footer p-0 pt-3 mt-3">
                                                <button type="submit" class="btn btn-primary change-color">Save
                                                    changes</button>
                                                <button type="button" class="btn btn-secondary ms-2"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No custom reports found.</td>
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
                {!! $customReports->appends(['per_page' =>
                request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>