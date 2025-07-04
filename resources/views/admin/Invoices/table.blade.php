<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>S. No.</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Consignee</th>
                        <th>Invoice ID</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Container</th>
                        <th>User</th>
                        <th>Warehouse   </th>
                        {{-- <th>Items</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $index => $invoice)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $invoice->created_at->format('d/m/Y H:i') ?? '-' }}</td>
                        <td><a href="{{route('admin.invoices.edit',$invoice->id)}}" class="text-danger">
                                {{ $invoice->deliveryAddress->full_name ?? '-' }}</a>
                        </td>
                        <td>{{ $invoice->warehouse->address ?? '-' }}</td>
                        <td>{{ $invoice->pickupAddress ? $invoice->pickupAddress->full_name : '-' }}</td>
                        <!-- Trigger Link -->
                        <td>
                            <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#invoiceModal{{ $invoice->id }}">
                                <div>#{{ $invoice->invoice_no ?? 'INV-001' }}</div>
                            </a>
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="invoiceModal{{ $invoice->id }}" tabindex="-1"
                            aria-labelledby="invoiceModalLabel{{ $invoice->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="invoiceModalLabel{{ $invoice->id }}">Invoice Detail
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="font-size: 14px;">
                                        <div><strong>ID:</strong> {{ $invoice->invoice_no ?? 'INV-001' }}</div>
                                        <div><strong>Invoice No:</strong> {{ $invoice->invoice_no ?? 'INV-001' }}</div>
                                        <div><strong>Date:</strong> {{ $invoice->created_at?->format('d-m-Y') ?? '-' }}
                                        </div>
                                        <div><strong>Container:</strong> {{ $invoice->container_no ?? '02425' }}</div>
                                        <hr>
                                        <div class="row">
                                            @if(!empty($invoice->deliveryAddress))
                                            <div class="col-md-6">
                                                <div><strong>Customer:</strong> {{ $invoice->deliveryAddress->full_name
                                                    ?? '-' }} {{ $invoice->deliveryAddress->address ?? '-' }}</div>
                                                <div><strong>Cell:</strong> {{ $invoice->deliveryAddress->mobile_number
                                                    ?? '-' }}</div>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <div><strong>ShipTo:</strong> {{ $invoice->pickupAddress->full_name ??
                                                    '-' }} {{ $invoice->pickupAddress->address ?? '-' }}</div>
                                                <div><strong>Tel:</strong> {{ $invoice->pickupAddress->mobile_number ??
                                                    '-' }}</div>
                                            </div>
                                        </div>

                                        <hr>
                                        @if (!empty($invoice->invoce_item))
                                        @foreach ($invoice->invoce_item as $item)
                                        <div>
                                            <strong>Item:</strong> {{ $item['supply_name'] ?? '-' }}
                                            <strong>Qty:</strong> {{ $item['qty'] ?? '-' }}
                                            <strong>Price:</strong> {{ $item['price'] ?? '-' }}
                                            <strong>Total:</strong> {{ ($item['qty'] ?? 0) * ($item['price'] ?? 0) }}
                                        </div>
                                        @endforeach
                                        @else
                                        <div>No Items</div>
                                        @endif
                                        @if($invoice->individualPayment)
                                        <hr>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <p class="subhead fw-bold">Payment Receipts</p>
                                            </div>

                                            <div class="col-12">
                                                <div class="border p-2 rounded">
                                                    <div class="d-none d-md-flex fw-bold border-bottom py-2">
                                                        <div class="col-md-2">Invoice ID</div>
                                                        <div class="col-md-2">User</div>
                                                        <div class="col-md-2">Payment Type</div>
                                                        <div class="col-md-2">Payment Date</div>
                                                        <div class="col-md-1">Amt. $</div>
                                                        <div class="col-md-1">Local</div>
                                                        <div class="col-md-2">Currency</div>
                                                    </div>

                                                    @forelse($invoice->individualPayment as $payment)
                                                    <div class="row py-2 border-bottom align-items-center">
                                                        <div class="col-md-2"><small class="d-md-none fw-bold">Invoice
                                                                ID:</small> {{ $invoice->invoice_no ?? '' }}</div>
                                                        <div class="col-md-2">
                                                            <small class="d-md-none fw-bold">User:</small>
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="{{ $payment->createdByUser->name ?? '' }} {{ $payment->createdByUser->last_name ?? '' }}">
                                                                {{ $payment->createdByUser->name ?? '' }} {{
                                                                $payment->createdByUser->last_name ?? '' }}
                                                            </span>
                                                        </div>
                                                        <div class="col-md-2"><small
                                                                class="d-md-none fw-bold">Type:</small> {{
                                                            ucfirst($payment->payment_type ?? '-') }}</div>
                                                        <div class="col-md-2"><small
                                                                class="d-md-none fw-bold">Date:</small> {{
                                                            $payment->payment_date ?
                                                            \Carbon\Carbon::parse($payment->payment_date)->format('m/d/Y,
                                                            h:i a') : '-' }}</div>
                                                        <div class="col-md-1"><small class="d-md-none fw-bold">Amt.
                                                                $:</small> {{ number_format($payment->payment_amount ??
                                                            0, 2) }}</div>
                                                        <div class="col-md-1"><small
                                                                class="d-md-none fw-bold">Local:</small> {{
                                                            $payment->local_currency ?? '-' }}</div>
                                                        <div class="col-md-2"><small
                                                                class="d-md-none fw-bold">Currency:</small> {{
                                                            $payment->currency ?? '-' }}</div>
                                                        
                                                    </div>
                                                    @empty
                                                    <div class="text-center py-3 text-muted">No Payments Found</div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <hr>
                                        <div style="color: gray; font-weight: bold;">Invoice Amount: ${{
                                            number_format($invoice->grand_total, 2) }}</div>
                                        <div style="color: orangered; font-weight: bold;">Balance: {{
                                            number_format($invoice->balance, 2) }}</div>



                                        </td>

                                        <td>
                                            <span>${{ number_format($invoice->grand_total, 2) }}</span>
                                        </td>
                                        <td>
                                            <div>$ {{ number_format($invoice->balence, 2) }}</div>
                                        </td>
                                        <td>{{ $invoice->container->unique_id ?? '-' }}</td>
                                        <td>{{ $invoice->createdByUser->fullName ?? '-' }}</td>
                                        <td>{{ $invoice->warehouse->unique_id ?? '-' }}</td>
                                        {{-- <td>
                                            <div>
                                                @if (empty($invoice->invoce_item))
                                                <span class="text-danger">No Items</span>
                                                @else
                                                @foreach($invoice->invoce_item as $item)
                                                {{ $item['supply_name'] ?? '-' }} ({{ $item['qty'] ?? '-' }}),
                                                @endforeach
                                                @endif
                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon fas " data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" data-bs-placement="bottom"
                                                                title="Individual Payment" data-bs-toggle="modal"
                                                                data-bs-target="#individualPayment{{$invoice->id ?? ''}}">
                                                                <i class="ti ti-cash me-2"></i>Payment</a>
                                                        </li>
                                                        <li>
                                                            {{-- <a class="dropdown-item" data-bs-placement="bottom"
                                                                title="Invoice B" data-bs-toggle="modal"
                                                                data-bs-target="#printInvoice2{{$invoice->id ?? ''}}">
                                                                <i class="ti ti-file-invoice"></i>Invoice PDF</a> --}}
                                                            <a class="dropdown-item" title="Invoice PDF" target="_blank"
                                                                href="{{ route('invoices.invoicesdownload', encrypt($invoice->id)) }}">
                                                                <i class="ti ti-file-invoice"></i>Invoice PDF</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" data-bs-placement="bottom"
                                                                title="Send Invoice pdf" data-bs-toggle="modal"
                                                                data-bs-target="#sendinvoicepdf{{$invoice->id ?? ''}}">
                                                                <i class="ti ti-mail me-2"></i>Send Email</a>
                                                            @include('admin.Invoices.modals.send_invoice_pdf_modal')
                                                        </li>
                                                        <li>
                                                            {{-- <a class="dropdown-item" data-bs-placement="bottom"
                                                                title="Labels" data-bs-toggle="modal"
                                                                data-bs-target="#InvoiceLabel{{$invoice->id ?? ''}}">
                                                                <i class="ti ti-tag-starred me-2"></i>Labels</a> --}}

                                                            @if (!empty($invoice->barcodes) && $invoice->barcodes->where('ParcelInventory', '!=', null)->isNotEmpty())
                                                                <a class="dropdown-item" title="Labels" href="{{ route('invoices.invoicesdownload', encrypt($invoice->id)) }}?type=labels" target="_blank">
                                                                <i class="ti ti-tag-starred me-2"></i>Labels</a>
                                                            @else
                                                                <a class="dropdown-item" title="Labels" href="javascript:void(0)" onclick="alertMsg('No labels have been generated for this invoice yet.','error')">
                                                                <i class="ti ti-tag-starred me-2"></i>Labels</a>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" title="Edit Invoice"
                                                                href="{{route('admin.invoices.edit',$invoice->id)}}"><i
                                                                    class="far fa-edit me-2"></i>Edit Invoice</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" title="Delete Invoice"
                                                                href="javascript:void(0)"
                                                                onclick="deleteRaw('{{route('admin.invoices.destroy',$invoice->id)}}')"><i
                                                                    class="ti ti-trash me-2"></i>Delete Invoice</a>
                                                        </li>
                                                        {{-- <li>
                                                            <a class="dropdown-item"
                                                                href="{{route('admin.invoices.details',$invoice->id)}}"><i
                                                                    class="far fa-eye me-2"></i>View Invoice</a>
                                                        </li> --}}
                                                        {{-- <li>
                                                            <a class="dropdown-item"
                                                                href="{{route('admin.invoices.show',$invoice->id)}}"><i
                                                                    class="far fa-eye me-2"></i>View Delivery
                                                                Challans</a>
                                                        </li> --}}
                                                    </ul>
                                                </div>

                                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="15" class="px-4 py-4 text-center text-gray-500">No invoices found.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
            @foreach ($invoices as $invoice)
            @include('admin.Invoices.modals.individual_payment_modal')
            @endforeach
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
                {!! $invoices->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>