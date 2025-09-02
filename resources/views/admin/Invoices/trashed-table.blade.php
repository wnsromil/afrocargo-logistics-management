<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>S. No.</th>
                        <th>Date</th>
                        <th>Invoice Type</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Consignee</th>
                        <th>Invoice ID</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Container</th>
                        <th>User</th>
                        <th>Warehouse </th>
                        <th>Deleted By</th>
                        <th>Deleted At</th>
                        {{-- <th>Items</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $index => $invoice)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $invoice->created_at->format('d/m/Y H:i') ?? '-' }}</td>
                                        <td>{{ $invoice->transport_type ?? 'Supply' }}</td>
                                        <td><a href="{{route('admin.invoices.edit', $invoice->id)}}" class="text-danger">
                                                @if($invoice->pickupAddress)
                                                    {{ $invoice->pickupAddress->full_name ?? '-' }}
                                                @else
                                                    {{ $invoice->deliveryAddress ? $invoice->deliveryAddress->full_name : '-' }}
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            @if($invoice->pickupAddress)
                                                {{ $invoice->pickupAddress->address ?? '-' }}
                                            @else
                                                {{ $invoice->deliveryAddress ? $invoice->deliveryAddress->address : '-' }}
                                            @endif

                                        </td>
                                        <td>{{ $invoice->deliveryAddress ? $invoice->deliveryAddress->full_name : '-' }}</td>
                                        <!-- Trigger Link -->
                                        <td>
                                            <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal"
                                                data-bs-target="#invoiceModal{{ $invoice->id }}">
                                                <div>#{{ $invoice->invoice_no ?? 'INV-001' }}</div>
                                            </a>
                                        </td>
                                        <td>
                                            <span>${{ number_format($invoice->grand_total ?? 0, 2) }}</span>
                                        </td>
                                        <td>
                                            <div>$ {{ number_format($invoice->balance ?? 0, 2) }}</div>
                                        </td>
                                        <td>{{ $invoice->container->unique_id ?? '-' }}</td>
                                        <td>{{ $invoice->user->fullName ?? '-' }}</td>
                                        <td>{{ $invoice->warehouse->warehouse_code ?? '-' }}, {{ $invoice->warehouse->address ?? '-' }}
                                        </td>
                                        <td>{{ $invoice->deletedByUser->fullName ?? '-' }}</td>
                                        <td>{{ $invoice->deleted_at->format('d/m/Y H:i') ?? '-' }}</td>

                                        <td>

                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon fas " data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        @can('has-dynamic-permission', 'invoice_trash_list.restore')
                                                            <li>
                                                                <a class="dropdown-item" title="Restore Invoice"
                                                                    href="{{route('admin.invoice.restore', $invoice->id)}}">
                                                                    <i class="fas fa-undo me-2"></i>Restore Invoice
                                                                </a>
                                                            </li>
                                                        @endcan
                                                        @can('has-dynamic-permission', 'invoice_trash_list.PDF_print')
                                                            <li>
                                                                <a class="dropdown-item" title="Invoice PDF" target="_blank"
                                                                    href="{{ route('invoices.invoicesdownload', encrypt($invoice->id)) }}">
                                                                    <i class="ti ti-file-invoice"></i>Invoice PDF</a>
                                                            </li>
                                                        @endcan
                                                        @can('has-dynamic-permission', 'invoice_trash_list.delete')
                                                            <li>
                                                                <a class="dropdown-item" title="Delete Invoice" href="javascript:void(0)"
                                                                    onclick="deleteRaw('{{route('admin.invoice.delete', $invoice->id)}}')">
                                                                    <i class="ti ti-trash me-2"></i>Delete Invoice
                                                                </a>
                                                            </li>
                                                        @endcan
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="invoiceModal{{ $invoice->id }}" tabindex="-1"
                                            aria-labelledby="invoiceModalLabel{{ $invoice->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="invoiceModalLabel{{ $invoice->id }}">Invoice Detail
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="font-size: 14px;">
                                                        <div>
                                                            <strong>ID:</strong> {{ $invoice->invoice_no ?? 'INV-001' }}
                                                        </div>
                                                        <div>
                                                            <strong>Invoice No:</strong> {{ $invoice->invoice_no ?? 'INV-001' }}
                                                        </div>
                                                        <div>
                                                            <strong>Date:</strong> {{ $invoice->created_at?->format('d-m-Y') ?? '-' }}
                                                        </div>
                                                        <div>
                                                            <strong>Container:</strong> {{ $invoice->container_no ?? '02425' }}
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            @if(!empty($invoice->pickupAddress))
                                                                                                <div class="col-md-6">
                                                                                                    <div><strong>Customer:</strong> {{ $invoice->pickupAddress->full_name
                                                                ?? '-' }} {{ $invoice->pickupAddress->address ?? '-' }}</div>
                                                                                                    <div><strong>Cell:</strong> {{ $invoice->pickupAddress->mobile_number
                                                                ?? '-' }}</div>
                                                                                                </div>

                                                            @else
                                                                                                <div class="col-md-6">
                                                                                                    <div><strong>Customer:</strong> {{ $invoice->deliveryAddress->full_name
                                                                ?? '-' }} {{ $invoice->deliveryAddress->address ?? '-' }}</div>
                                                                                                    <div><strong>Cell:</strong> {{ $invoice->deliveryAddress->mobile_number
                                                                ?? '-' }}</div>
                                                                                                </div>
                                                            @endif
                                                            @if(!empty($invoice->deliveryAddress))
                                                                                                <div class="col-md-6">
                                                                                                    <div><strong>ShipTo:</strong> {{ $invoice->deliveryAddress->full_name ??
                                                                '-' }} {{ $invoice->deliveryAddress->address ?? '-' }}</div>
                                                                                                    <div><strong>Tel:</strong> {{ $invoice->deliveryAddress->mobile_number ??
                                                                '-' }}</div>
                                                                                                </div>
                                                            @endif
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
                                                                            <div class="col-md-1">Local</div>
                                                                            <div class="col-md-1">Local Amount</div>
                                                                            <div class="col-md-1">Currency</div>
                                                                            <div class="col-md-1">Amt. $</div>
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
                                                                                                                    <div class="col-md-1"><small
                                                                                                                            class="d-md-none fw-bold">Local:</small> {{
                                                                            $payment->local_currency ?? '-' }}</div>

                                                                                                                    <div class="col-md-1">
                                                                                                                        <small class="d-md-none fw-bold">Local
                                                                                                                            Amount:</small>{{ number_format($payment->applied_payments ?? 0, 2) }}
                                                                                                                    </div>
                                                                                                                    <div class="col-md-1"><small
                                                                                                                            class="d-md-none fw-bold">Currency:</small> {{
                                                                            $payment->currency ?? '-' }}</div>
                                                                                                                    <div class="col-md-1"><small class="d-md-none fw-bold">Amt.
                                                                                                                            $:</small> {{ number_format($payment->payment_amount ??
                                                                            0, 2) }}</div>
                                                                                                                </div>
                                                                        @empty
                                                                            <div class="text-center py-3 text-muted">No Payments Found</div>
                                                                        @endforelse
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <hr>
                                                        <div style="color: gray; font-weight: bold;">
                                                            Invoice Amount: ${{
                        number_format($invoice->grand_total ?? 0, 2) }}
                                                        </div>
                                                        <div style="color: orangered; font-weight: bold;">
                                                            Balance: {{
                        number_format($invoice->balance ?? 0, 2) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>

                    @empty
                        <tr>
                            <td colspan="15" class="px-4 py-4 text-center text-gray-500">No invoices found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            @foreach ($invoices as $invoice)
                @include('admin.Invoices.modals.send_invoice_pdf_modal')
                @include('admin.Invoices.modals.AddnewLable')
                @include('admin.Invoices.modals.individual_payment_modal')
            @endforeach
        </div>
    </div>
</div>

<x-pagination-toolbar :pagination="$invoices" defaultPerPage="10" queryKey="per_page" />