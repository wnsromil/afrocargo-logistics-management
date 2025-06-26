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
                        <th>Branch</th>
                        <th>Items</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $index => $invoice)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $invoice->created_at->format('d/m/Y H:i') ?? '-' }}</td>
                        <td><a href="{{route('admin.invoices.edit',$invoice->id)}}"class="text-danger">
                            {{ $invoice->deliveryAddress->full_name ?? '-' }}</a>
                        </td>
                        <td>{{ $invoice->warehouse->address ?? '-' }}</td>
                        <td>{{ $invoice->pickupAddress ? $invoice->pickupAddress->full_name :  '-' }}</td>
                        <td>
                            <a href="javascript:void(0);"
                                class="text-danger invoice-hover"
                                tabindex="0"
                                data-bs-toggle="popover"
                                data-bs-html="true"
                                data-bs-placement="right"
                                data-bs-trigger="hover focus"
                                title="Invoice Detail"
                                data-bs-content="
                                    <div>
                                        <strong>ID:</strong> #{{ $invoice->invoice_no ?? "INV-001" }}<br>
                                        <strong>Date:</strong> {{ $invoice->created_at ? $invoice->created_at->format("m-d-Y") : "-" }}<br>
                                        <strong>Customer:</strong> {{ $invoice->pickup_address->full_name ?? "-" }}, {{ $invoice->pickup_address->address ?? "-" }}<br>
                                        <strong>Tel:</strong> {{ $invoice->pickup_address->mobile_number ?? "-" }}<br>
                                        <strong>ShipTo:</strong> {{ $invoice->delivery_address->full_name ?? "-" }}, {{ $invoice->delivery_address->address ?? "-" }}<br>
                                        <strong>Cell:</strong> {{ $invoice->delivery_address->mobile_number ?? "-" }}<br>
                                        <strong>Item:</strong>
                                        @if (!empty($invoice->invoce_item))
                                            @foreach($invoice->invoce_item as $item)
                                                {{ $item["supply_name"] ?? "-" }}@if(!$loop->last), @endif
                                            @endforeach
                                        @else
                                            -
                                        @endif<br>
                                        <strong>Qty:</strong>
                                        @if (!empty($invoice->invoce_item))
                                            @foreach($invoice->invoce_item as $item)
                                                {{ $item["qty"] ?? "-" }}@if(!$loop->last), @endif
                                            @endforeach
                                        @else
                                            -
                                        @endif<br>
                                        <strong>Price:</strong>
                                        @if (!empty($invoice->invoce_item))
                                            @foreach($invoice->invoce_item as $item)
                                                {{ $item["price"] ?? "-" }}@if(!$loop->last), @endif
                                            @endforeach
                                        @else
                                            -
                                        @endif<br>
                                        <strong>Total:</strong> ${{ number_format($invoice->grand_total, 2) }}<br>
                                        <strong>Balance:</strong> ${{ number_format($invoice->balance, 2) }}
                                    </div>">
                                <div>#{{ $invoice->invoice_no ?? 'INV-001' }}</div>
                            </a>
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
                        <td>
                            <div>
                                @if (empty($invoice->invoce_item))
                                <span class="text-danger">No Items</span>
                                @else
                                @foreach($invoice->invoce_item as $item)
                                {{ $item['supply_name'] ?? '-' }} ({{ $item['qty'] ?? '-' }}),
                                @endforeach
                                @endif
                            </div>
                        </td> 
                        <td>
                            <div class="dropdown dropdown-action">
                                <a href="#" class=" btn-action-icon fas " data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul>
                                        <li>
                                            <a class="dropdown-item"
                                                data-bs-placement="bottom" title="Individual Payment" data-bs-toggle="modal" data-bs-target="#individualPayment{{$invoice->id ?? ''}}">
                                                <i class="ti ti-cash me-2"></i>Payment</a>
                                        </li>
                                        <li>
                                            {{-- <a class="dropdown-item"
                                                data-bs-placement="bottom" title="Invoice B" data-bs-toggle="modal" data-bs-target="#printInvoice2{{$invoice->id ?? ''}}">
                                                <i class="ti ti-file-invoice"></i>Invoice PDF</a> --}}
                                            <a class="dropdown-item" title="Invoice PDF"  target="_blank"
                                                href="{{ route('invoices.invoicesdownload', encrypt($invoice->id)) }}">
                                                <i class="ti ti-file-invoice"></i>Invoice PDF</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                data-bs-placement="bottom" title="Send Invoice pdf" data-bs-toggle="modal" data-bs-target="#sendinvoicepdf{{$invoice->id ?? ''}}">
                                                <i class="ti ti-mail me-2"></i>Send Email</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                data-bs-placement="bottom" title="Labels" data-bs-toggle="modal" data-bs-target="#InvoiceLabel{{$invoice->id ?? ''}}">
                                                <i class="ti ti-tag-starred me-2"></i>Labels</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" title="Edit Invoice"
                                                href="{{route('admin.invoices.edit',$invoice->id)}}"><i
                                                    class="far fa-edit me-2"></i>Edit Invoice</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" title="Delete Invoice"
                                        href="javascript:void(0)" onclick="deleteRaw('{{route('admin.invoices.destroy',$invoice->id)}}')"><i
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
                                                    class="far fa-eye me-2"></i>View Delivery Challans</a>
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
                @include('admin.Invoices.modals.editInvoice')
            @endforeach
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
                {!! $invoices->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>