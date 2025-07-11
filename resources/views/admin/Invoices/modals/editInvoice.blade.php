
<!-- Invoice History Modal -->
<div class="modal custom-modal invoiceSModel fade" id="invoiceHistory{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Invoice History</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3 pb-0">
                <div class="row pb-2">
                    <div class="col-md-6 text-end">
                        <label class="col3A fw_500">User name: {{ $invoice->createdByUser->name ?? '' }} {{ $invoice->createdByUser->last_name ?? '' }}</label>
                    </div>
                    <div class="col-md-6">
                        <label class="col3A fw_500">Update Date: {{ $invoice->created_at->format('d/m/Y, H:i') ?? '02/28/2025, 17:36'}}</label>
                    </div>
                </div>
                <div class="row border-top gx-sm-4 border-bottom py-3">
                    <div class="col-md-3">
                        <label class="col3A fw_500 mb-0">I/D: {{$invoice->deliveryAddress && $invoice->deliveryAddress->user && $invoice->deliveryAddress->user->unique_id ? $invoice->deliveryAddress->user->unique_id :''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500 mb-0">Customer: {{$invoice->deliveryAddress && $invoice->deliveryAddress->user && $invoice->deliveryAddress->full_name ? $invoice->deliveryAddress->full_name :''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500 mb-0">Address: {{$invoice->deliveryAddress && $invoice->deliveryAddress->user && $invoice->deliveryAddress->address ? $invoice->deliveryAddress->address :''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500 mb-0">Ship To Name: {{$invoice->pickupAddress ? $invoice->pickupAddress->full_name :''}}</label>
                    </div>
                </div>
                <div class="row gx-sm-4 border-bottom py-2">
                    <div class="col-md-12 text-center">
                        <label class="col3A fs_20 mb-0">Invoice Details</label>
                    </div>
                </div>
                <div class="row gx-sm-4 border-bottom py-3">
                    <div class="col-md-3">
                        <label class="col3A fw_500">Date: {{$invoice->issue_date ?? ''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Invoice No: {{$invoice->invoice_no ?? ''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Driver: {{$invoice->driver && $invoice->driver->name ? $invoice->driver->name.' '.$invoice->driver->last_name:'' }}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Total: {{$invoice->grand_total ?? ''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Due Date: {{$invoice->duedaterange ?? ''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Address1: {{$invoice->duedaterange ?? ''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Payments: {{$invoice->is_paid ?? ''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">User: {{ $invoice->createdByUser->name ?? '' }} {{ $invoice->createdByUser->last_name ?? '' }}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Container: {{$invoice->container && $invoice->container->unique_id ? $invoice->container->unique_id:'' }}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Status: {{$invoice->status ?? 'pending'}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Balance: {{$invoice->balance ?? ''}}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col3A fw_500">Total Box: {{$invoice->total_qty ?? ''}}</label>
                    </div>
                </div>
                <div class="row gx-sm-4 py-3">
                    <div class="col-12">
                        <div class="table-responsive nopadding notMinheight nocolor">
                            <table class="table datatable">
                                <tbody>
                                    <tr>
                                        <td>Item</td>
                                        {{-- <td>Size</td> --}}
                                        <td>Qty</td>
                                        <td>Description</td>
                                        <td>Price</td>
                                        <td>Value</td>
                                        <td>Discount</td>
                                        <td>Ins</td>
                                        <td>Tax</td>
                                        <td>Total</td>
                                    </tr>
                                    @if($invoice->invoce_item && count($invoice->invoce_item) > 0)
                                    @foreach ($invoice->invoce_item as $key=>$item)
                                    <tr>
                                        <td>{{ $item['supply_name'] ?? '' }}</td>
                                        {{-- <td>xl</td> --}}
                                        <td>{{ $item['qty'] ?? 0 }}</td>
                                        <td>{{ $item['label_qty'] ?? 0 }}</td>
                                        <td>{{ $item['price'] ?? 0 }}</td>
                                        <td>{{ $item['value'] ?? 0 }}</td>
                                        <td>{{ $item['discount'] ?? 0 }}</td>
                                        <td>{{ $item['ins'] ?? 0 }}</td>
                                        <td>{{ $item['tax'] ?? 0 }}</td>
                                        <td>{{ $item['total'] ?? 0 }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="9" class="text-center">No Items Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Invoice History Modal -->

<!-- Individual Payment Modal -->
@include('admin.Invoices.modals.individual_payment_modal')
<!-- /Individual Payment Modal -->

<!-- Send Invoice Pdf Modal -->
@include('admin.Invoices.modals.send_invoice_pdf_modal')
<!--/Send Invoice Pdf Modal -->

<!-- Claim Modal -->
<div class="modal custom-modal invoiceSModel fade" id="addnewClaim{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Add New Claim</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3 pb-2">
                <form action="{{ route('admin.invoice.updateClaim') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <textarea name="description" class="form-control inp"
                                    placeholder="Write Comment"></textarea>
                            </div>
                            <input type="hidden" name="invoice_id" value="{{ $invoice->id ?? '' }}">
                        </div>

                        <div class="col-12">
                            <div class="custodis d-flex mt-0">
                                @foreach (['image1', 'image2', 'image3'] as $imageType)
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center justify-content-center  avtard">
                                        <label class="foncolor set me-sm-2">Image 1</label>
                                        <div class="avtarset" style="position: relative;">
                                            <!-- Image Preview -->
                                            <img id="preview_{{ $imageType }}" class="avtars avtarc"
                                                src="{{ asset('assets/img.png') }}" alt="avatar">

                                            <!-- File Input (Hidden by Default) -->
                                            <input type="file" id="file_{{ $imageType }}" name="{{ $imageType }}"
                                                accept="image/png, image/jpeg" style="display: none;"
                                                onchange="previewImage(this, '{{ $imageType }}')">

                                            <div class="divedit">
                                                <!-- Edit Button -->
                                                <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}"
                                                    alt="edit" style="cursor: pointer;"
                                                    onclick="document.getElementById('file_{{ $imageType }}').click();">

                                                <!-- Delete Button -->
                                                <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}"
                                                    alt="delete" style="cursor: pointer;"
                                                    onclick="removeImage('{{ $imageType }}')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="table-responsive lesspadding notMinheight border mt-3">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Write Claim</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($invoice->claims as $claim)
                                            <tr>
                                                <td>{{ $claim->user->name ?? '' }} {{ $claim->user->last_name ?? '' }}</td>
                                                <td>{{ $claim->description ?? '' }} - {{ $claim->created_at ? $claim->created_at->format('m/d/Y, h:i A') : '' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No claims found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="add-customer-btns text-end">
                                <button type="button" class="btn btn-outline-primary custom-btn" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button type="submit" class="btn btn-primary ">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/Claim Modal -->

<!-- print_Invoice1 Modal -->
@include('admin.Invoices.modals.print_Invoice1')
<!--/print_Invoice1 Modal -->

<!-- print_Invoice2 Modal -->
<div class="modal custom-modal invoiceSModel pdfModal fade" id="printInvoice2{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered mxWidth">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Reciept <a class="btn btn-primary" onclick="printLabel()">Print</a></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body p-2" >
                <table width="100%" cellpadding="0" cellspacing="0" 
                    style="border-collapse: collapse; max-width:400px; margin: 0 auto; background: #fff; border: 1px solid #ffffff; font-family: 'Poppins', sans-serif; margin: 0; padding: 0; font-size: 12px!important; color: #000!important;">
                    <tr id="printInvoice2Content">
                        <td>
                            <table aria-describedby="table-description" style="width: 100%; table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: baseline;">
                                            <table>
                                                <tr>
                                                    <td style="vertical-align: middle;">
                                                        <img style="width: 60px; margin-right: 10px;"
                                                            src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                                                    </td>
                                                    <td>
                                                        <strong >{{$invoice->warehouse->warehouse_name ?? ''}}</strong><br>
                                                        {{$invoice->warehouse->address ?? ''}}<br>
                                                        The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                                        {{$invoice->warehouse->country ?? ''}}<br>
                                                        Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td style="text-align: right;"> 
                                            @if($invoice->invoiceParcelData)
                                            <b style="font-size: 18px;">{{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_name
                                                ?? ''}}</b><br>
                                                {{$invoice->invoiceParcelData->arrivedWarehouse->address
                                                ?? ''}},<br>
                                            The {{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_code ?? ''}}<br>
                                            Tel-{{$invoice->invoiceParcelData->arrivedWarehouse->phone ?? ''}}<br>
                                            {{-- Tel 718-954-9093<br> --}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height: 5px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: baseline;">
                                            <b>Driver:</b>
                                            <br>
                                            {{ $invoice->driver->name ?? '' }} {{ $invoice->driver->last_name ?? '' }}
                                        </td>

                                        <td style="text-align: right;">

                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="height: 5px;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"
                                            style="font-weight: bold; font-size: 30px; color: #000; text-align: center;">
                                            {{ $invoice->invoice_no ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height: 5px;"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table aria-describedby="table-description"
                                style="width: 100%; table-layout: fixed; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
                                <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td
                                            style="padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 14px;">
                                            {{ $invoice->created_at ? $invoice->created_at->format('m/d/Y') : '' }}</td>
                                        <td
                                            style="padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 14px; text-align: right;">
                                            {{$invoice->warehouse->name ?? ''}}
                                            {{$invoice->warehouse->address ?? ''}} </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table aria-describedby="table-description"
                                style="width: 100%; table-layout: fixed; border-bottom: 1px solid #000;">
                                <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                    <tr>
                                        <td style="height: 5px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: baseline;">
                                            <b>Customer:</b><br>
                                            {{ $invoice->deliveryAddress->full_name ?? '' }}<br>
                                            {{ $invoice->deliveryAddress->address ?? '' }}<br>
                                            {{ $invoice->deliveryAddress->state_id ?? '' }} {{ $invoice->deliveryAddress->country_id ?? '' }}<br>
                                            {{ $invoice->deliveryAddress->mobile_number ?? '' }}
                                        </td>

                                        <td style="text-align: right;">
                                            <b>Ship To:</b><br>
                                            {{ $invoice->pickupAddress->full_name ?? '' }}<br>
                                            {{ $invoice->pickupAddress->address ?? '' }}<br>
                                            {{ $invoice->pickupAddress->mobile_number ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Cont : {{ $invoice->container->unique_id ?? '' }}</b></td>
                                    </tr>
                                    <tr>
                                        <td style="height: 5px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: 500; font-size: 14px;" colspan="2">
                                            <table aria-describedby="table-description"
                                                style="width: 100%; table-layout: fixed; border-top: 1px solid #000000">
                                                <tr>
                                                    <td colspan="4"><b>* {{ $invoice->invoce_item[0]['supply_name'] ?? '' }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Qty</td>
                                                    <td>Price</td>
                                                    <td>Discount</td>
                                                    <td>Total</td>
                                                </tr>
                                                @if(isset($invoice->invoce_item) && count($invoice->invoce_item))
                                                    @foreach($invoice->invoce_item as $item)
                                                    <tr>
                                                        <td>{{ $item['qty'] ?? 0 }}</td>
                                                        <td>${{ number_format($item['price'] ?? 0, 2) }}</td>
                                                        <td>${{ number_format($item['discount'] ?? 0, 2) }}</td>
                                                        <td>${{ number_format($item['total'] ?? 0, 2) }}</td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4">No Items</td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:5px;"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table aria-describedby="table-description"
                                style="width: 100%; border-radius: 0px; padding-bottom: 5px; margin-bottom: 10px;">
                                <thead>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2"><b>Total Items {{ $invoice->total_qty ?? count($invoice->invoce_item ?? []) }} : {{ $invoice->container->unique_id ?? '' }}</b></td>
                                    </tr>
                                    <tr>
                                        <td style="height: 120px!important; width: 50%; padding-bottom: 10px;">
                                            <table style="border: 1px solid #000; height: 120px;">
                                                <tr>
                                                    <td
                                                        style="vertical-align: baseline; height: auto!important; padding: 5px 3px;">
                                                        I have read and accepted the terms and conditions
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="vertical-align: baseline; font-size: 14px; text-align: right; height: 20px!important;">
                                                        <b>Signature</b>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="text-align: right; width: 50%; vertical-align: baseline;">
                                            <b>
                                                Sub-Total: ${{ number_format($invoice->sub_total ?? 0, 2) }}<br>
                                                Ins.: ${{ number_format($invoice->insurance ?? 0, 2) }}<br>
                                                Tax: ${{ number_format($invoice->tax ?? 0, 2) }}<br>
                                                Total: ${{ number_format($invoice->grand_total ?? 0, 2) }}<br>
                                                Payment: ${{ number_format($invoice->is_paid ?? 0, 2) }}<br>
                                                Balance: ${{ number_format($invoice->balance ?? 0, 2) }}<br>
                                            </b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!--/print_Invoice2 Modal -->

<!-- internal_Comment Modal -->
<div class="modal custom-modal invoiceSModel fade" id="internalComment{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Add New Comment</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3 pb-2">
                <form action="{{ route('admin.invoice.updateNote') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id ?? '' }}">
                                <input type="hidden" name="type" value="internalComment">
                                <textarea name="notes" class="form-control inp"
                                    placeholder="Write Comment"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="col3a">NOTE: [You can enter only 255 charcters in the above field.]</p>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive lesspadding notMinheight tableBody border mt-3">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>User Name</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($invoice->comments->count() > 0)
                                            @foreach($invoice->comments->where('type','internalComment')->values() as $comment)
                                                <tr>
                                                    <td>{{ $comment->createdByUser->name ?? '' }} {{ $comment->createdByUser->last_name ?? '' }}</td>
                                                    <td>{{ $comment->notes ?? '' }} - {{ $comment->created_at ? $comment->created_at->format('m/d/Y, h:i a') : '' }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="add-customer-btns text-end">
                                <button type="button" class="btn btn-outline-primary custom-btn" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button type="submit" class="btn btn-primary ">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/internal_Comment Modal -->

<!-- internal_2Comment Modal -->
<div class="modal custom-modal invoiceSModel fade" id="onlyComment{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Add New Comment</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3 pb-2">
                <form action="{{ route('admin.invoice.updateNote') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id ?? '' }}">
                                <input type="hidden" name="type" value="onlyComment">
                                @if($invoice->comments->count() > 0)
                                <input type="hidden" name="id"
                                    value="{{ $invoice->comments->where('type','onlyComment')->first()->id ?? ''}}">
                                @endif
                                <textarea name="notes" class="form-control inp"
                                    placeholder="Write Comment">@if($invoice->comments->where('type','onlyComment')->count() > 0){{ $invoice->comments->where('type','onlyComment')->first()->notes ?? ''}}@endif</textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="add-customer-btns text-end">
                                <button type="button" class="btn btn-outline-primary custom-btn" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button type="submit" class="btn btn-primary ">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/internal_2Comment Modal -->

<!-- custom_Invoice Modal -->
<div class="modal custom-modal invoiceSModel tableBody fade" id="customInvoice{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body p-2">
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="border-collapse: collapse; max-width: 900px; margin: 0 auto; background: #fff; border: 1px solid #ffffff; font-size: 14px; color: #000;">
                    <!-- Header -->
                    <tr>
                        <td colspan="2" style="padding: 0 20px 0px 20px;">
                            <table width="100%">
                                <tr>
                                    <td style="width: 40%; vertical-align: baseline;">
                                        <table>
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    <img style="width: 75px; margin-right: 5px;"
                                                        src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                                                </td>
                                                <td>
                                                    <strong >{{$invoice->warehouse->warehouse_name ?? ''}}</strong><br>
                                                        {{$invoice->warehouse->address ?? ''}}<br>
                                                        The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                                        {{$invoice->warehouse->country ?? ''}}<br>
                                                        Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 25%; text-align: center;">
                                    </td>
                                    <td style="width: 35%; text-align: right;">
                                        @if($invoice->invoiceParcelData)
                                        <b style="font-size: 18px;">{{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_name
                                            ?? ''}}</b><br>
                                            {{$invoice->invoiceParcelData->arrivedWarehouse->address
                                            ?? ''}},<br>
                                        The {{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_code ?? ''}}<br>
                                        Tel-{{$invoice->invoiceParcelData->arrivedWarehouse->phone ?? ''}}<br>
                                        {{-- Tel 718-954-9093<br> --}}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" style="padding: 20px 0 0;">
                            <table width="100%">
                                <tr>
                                    <td style="width: 100%;">
                                        <table width="100%">
                                            <tr>
                                                <td style="text-align: center; font-size: 21px; font-weight: 600;">
                                                    CUSTOM INVOICE REPORT
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table
                                style="width: 100%; border-collapse: collapse; border: 1px solid black; border-bottom: none; margin-top: 15px;">
                                <tr style="background-color: #f2f2f2; border: 1px solid black; ">
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                        Driver</td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                        Container</td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                        Date</td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                        Invoice</td>
                                </tr>
                                <tr style="background-color: #ffffff; border: 1px solid black; ">
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                        {{ $invoice->driver->name ?? '' }} {{ $invoice->driver->last_name ?? '' }}
                                    </td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                        {{ $invoice->container->unique_id ?? '' }}
                                    </td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                        {{ $invoice->created_at ? $invoice->created_at->format('m/d/Y h:i a') : '' }}
                                    </td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                        {{ $invoice->invoice_no ?? '' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%; border-spacing: collapse;">
                                <tr>
                                    <td style="width: 70%; padding-right: 8px;">
                                        <table
                                            style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-top: 15px;">
                                            <tr>
                                                <td style="padding: 10px;" colspan="2">
                                                    <table width="100%">
                                                        <tr>
                                                            <td style="width: 40%; vertical-align: baseline;">
                                                                <strong >{{$invoice->warehouse->warehouse_name ?? ''}}</strong><br>
                                                                {{$invoice->warehouse->address ?? ''}}<br>
                                                                The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                                                {{$invoice->warehouse->country ?? ''}}<br>
                                                                Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                                            </td>
                                                            <td style="width: 20; text-align: center;">
                                                            </td>
                                                            <td style="width: 40%; text-align: right;">
                                                                @if($invoice->invoiceParcelData)
                                                                <b style="font-size: 18px;">{{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_name
                                                                    ?? ''}}</b><br>
                                                                    {{$invoice->invoiceParcelData->arrivedWarehouse->address
                                                                    ?? ''}},<br>
                                                                The {{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_code ?? ''}}<br>
                                                                Tel-{{$invoice->invoiceParcelData->arrivedWarehouse->phone ?? ''}}<br>
                                                                {{-- Tel 718-954-9093<br> --}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;" colspan="2">
                                                    <table
                                                        style="width: 100%; border-collapse: collapse; border: 1px solid black; border-bottom: none; margin-top: 15px;">
                                                        <tr style="background-color: #f2f2f2; border: 1px solid black; ">
                                                            <td style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                                                Driver</td>
                                                            <td style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                                                Container</td>
                                                            <td style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                                                Date</td>
                                                            <td style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                                                Invoice</td>
                                                        </tr>
                                                        <tr style="background-color: #ffffff; border: 1px solid black; ">
                                                            <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                                                {{ $invoice->driver->name ?? '' }} {{ $invoice->driver->last_name ?? '' }}
                                                            </td>
                                                            <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                                                {{ $invoice->container->unique_id ?? '' }}
                                                            </td>
                                                            <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                                                {{ $invoice->created_at ? $invoice->created_at->format('m/d/Y h:i a') : '' }}
                                                            </td>
                                                            <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                                                {{ $invoice->invoice_no ?? '' }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%; padding:10px; padding-top: 5px;">
                                                    <table width="100%">
                                                        <tr>
                                                            <td>
                                                                <b style="font-size: 18px;">Customer</b><br>
                                                                {{ $invoice->deliveryAddress->full_name ?? '' }}<br>
                                                                {{ $invoice->deliveryAddress->address ?? '' }}<br>
                                                                {{ $invoice->deliveryAddress->state_id ?? '' }}<br>
                                                                {{ $invoice->deliveryAddress->country_id ?? '' }}<br>
                                                                {{ $invoice->deliveryAddress->mobile_number ?? '' }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="width: 50%; padding:10px; padding-top: 5px; text-align: right;">
                                                    <b style="font-size: 18px;">Ship To:</b><br>
                                                    {{ $invoice->pickupAddress->full_name ?? '' }}<br>
                                                    {{ $invoice->pickupAddress->address ?? '' }}<br>
                                                    {{ $invoice->pickupAddress->state_id ?? '' }}<br>
                                                    {{ $invoice->pickupAddress->country_id ?? '' }}<br>
                                                    {{ $invoice->pickupAddress->mobile_number ?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table aria-describedby="table-description"
                                                        style="width: 100%; padding: 0 10px; table-layout: fixed; border-top: 1px solid #000000; border-bottom: 1px solid #000000; margin-bottom: 20px;">
                                                        <tr>
                                                            <td colspan="6"><b>* {{ $invoice->invoce_item[0]['supply_name'] ?? '' }}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Qty</td>
                                                            <td>Price</td>
                                                            <td>Discount</td>
                                                            <td>Tax(%)</td>
                                                            <td>Ins</td>
                                                            <td>Total</td>
                                                        </tr>
                                                        @if(isset($invoice->invoce_item) && count($invoice->invoce_item))
                                                            @foreach($invoice->invoce_item as $item)
                                                            <tr>
                                                                <td>{{ $item['qty'] ?? 0 }}</td>
                                                                <td>${{ number_format($item['price'] ?? 0, 2) }}</td>
                                                                <td>${{ number_format($item['discount'] ?? 0, 2) }}</td>
                                                                <td>${{ number_format($item['tax'] ?? 0, 2) }}</td>
                                                                <td>${{ number_format($item['ins'] ?? 0, 2) }}</td>
                                                                <td>${{ number_format($item['total'] ?? 0, 2) }}</td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="6">No Items</td>
                                                            </tr>
                                                        @endif
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" style="padding: 10px;">
                                                        <tr>
                                                            <td>
                                                                Total Items: {{ $invoice->total_qty ?? count($invoice->invoce_item ?? []) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table
                                                                    style="width: 100%; border-collapse: collapse; border: 1px solid black;"
                                                                    cellpadding="8">
                                                                    <tr>
                                                                        <td>
                                                                            I have received the contract and
                                                                            accept the terms and condition
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right; padding: 0;">
                                                                            <img style="width: 80px;"
                                                                                src="https://www.morebusiness.com/wp-content/uploads/2020/09/handwritten-email-signature.jpg">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="text-align: right;">
                                                    <table style="width: 65%; margin-left: auto; padding: 10px;">
                                                        <tr>
                                                            <td>
                                                                <b>Sub-Total:</b> ${{ number_format($invoice->sub_total ?? 0, 2) }} <br>
                                                                <b>Ins:</b> ${{ number_format($invoice->insurance ?? 0, 2) }} <br>
                                                                <b>Tax:</b> ${{ number_format($invoice->tax ?? 0, 2) }} <br>
                                                                <b>Total:</b> ${{ number_format($invoice->grand_total ?? 0, 2) }} <br>
                                                                <b>Payment:</b> ${{ number_format($invoice->is_paid ?? 0, 2) }} <br>
                                                                <b>Balance:</b> ${{ number_format($invoice->balance ?? 0, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table
                                                                    style="width: 100%; border-collapse: collapse; border: 1px solid black;"
                                                                    cellpadding="5">
                                                                    <tr>
                                                                        <td style="font-size: 15px;">
                                                                            Invoice#: {{ $invoice->invoice_no ?? '' }}
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 30%;">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td>
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="font-weight: 600;">ShipTo Id :</td>
                                                        </tr>
                                                    </table>
                                                    <table
                                                        style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-top: 5px;">
                                                        <tr>
                                                            <td style="padding: 10px;">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: center;">
                                                                            @if(isset($invoice->pickupAddress->user->license_document))
                                                                                <img style="width: 200px;"
                                                                                    src="{{ $invoice->pickupAddress->user->license_document }}">
                                                                            @else
                                                                                <img style="width: 200px;"
                                                                                    src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="text-align: right;">(Lic Image)</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="font-weight: 600;">CustomerID:</td>
                                                        </tr>
                                                    </table>
                                                    <table
                                                        style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-top: 5px;">
                                                        <tr>
                                                            <td style="padding: 10px;">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="text-align: center;">
                                                                            @if(isset($invoice->deliveryAddress->user->license_document))
                                                                                <img style="width: 200px;"
                                                                                    src="{{ $invoice->deliveryAddress->user->license_document }}">
                                                                            @else
                                                                                <img style="width: 200px;"
                                                                                    src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="text-align: right;">(Lic Image)</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 20px 0 0;">
                            <table width="100%">
                                <tr>
                                    <td style="width: 100%;">
                                        <table width="100%">
                                            <tr>
                                                <td style="text-align: center; font-size: 21px; font-weight: 600;">
                                                    {{$invoice->warehouse->address ?? ''}}<br>
                                                    TERMS & CONDITIONS
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                            </tr>                                            
                            {{$invoice->warehouse->address ?? ''}}<br>
                            The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                            {{$invoice->warehouse->country ?? ''}}<br>
                            Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;">
                            {{ $invoice->terms_and_conditions ?? 'Terms & Condition' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;">
                            {{ $invoice->terms_and_conditions_2 ?? 'Terms & Condition' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <img style="width: 80px;"
                                src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!--/custom_Invoice Modal -->

<!-- labels Modal -->
<div class="modal custom-modal invoiceSModel pdfModal fade" id="InvoiceLabel{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered mxWidth">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Labels <a href="javascript::void(0)" onclick="printLabel()" class="btn btn-primary ms-2">Print</a> </h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body p-2">
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="border-collapse: collapse; max-width:100%; margin: 0 auto; background: #fff; border: 1px solid #ffffff; font-family: 'Poppins', sans-serif; margin: 0; padding: 0; font-size: 12px; color: #000;">
                    @if(!empty($invoice->barcodes) && count($invoice->barcodes)>0)
                        @foreach ($invoice->barcodes as $barcode)
                        <tr>
                            <td>
                                <table aria-describedby="table-description" style="width: 100%; table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align: baseline;">
                                                <table>
                                                    <tr>
                                                        <td style=" vertical-align: middle;">
                                                            <img style="width: 60px; margin-right: 5px;"
                                                                src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                                                        </td>
                                                        <td>
                                                            <strong >{{$invoice->warehouse->warehouse_name ?? ''}}</strong><br>
                                                            {{$invoice->warehouse->address ?? ''}}<br>
                                                            The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                                            {{$invoice->warehouse->country ?? ''}}<br>
                                                            Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                                        </td>
                                                    </tr>
                                                </table>
                                            <td style="text-align: right;"> 
                                                @if($invoice->invoiceParcelData)
                                                <b style="font-size: 18px;">{{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_name
                                                    ?? ''}}</b><br>
                                                    {{$invoice->invoiceParcelData->arrivedWarehouse->address
                                                    ?? ''}},<br>
                                                The {{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_code ?? ''}}<br>
                                                Tel-{{$invoice->invoiceParcelData->arrivedWarehouse->phone ?? ''}}<br>
                                                {{-- Tel 718-954-9093<br> --}}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 5px;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"
                                                style="font-weight: bold; font-size: 30px; color: #000; text-align: center;">
                                                {{ $invoice->invoice_no ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 5px;"></td>
                                        </tr>
                                    </tbody>
                                </table>                                            
                                {{$invoice->warehouse->address ?? ''}}<br>
                                The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                {{$invoice->warehouse->country ?? ''}}<br>
                                Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                <table aria-describedby="table-description"
                                    style="width: 100%; table-layout: fixed; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td
                                                style="padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 14px;">
                                                {{ $invoice->created_at ? $invoice->created_at->format('m/d/Y') : '' }}</td>
                                            <td
                                                style="padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 14px; text-align: right;">
                                                {{$invoice->warehouse->name ?? ''}}
                                                {{$invoice->warehouse->address ?? ''}} </td>
                                        </tr>
                                    </tbody>
                                </table>                                            {{$invoice->warehouse->address ?? ''}}<br>
                                                            The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                                            {{$invoice->warehouse->country ?? ''}}<br>
                                                            Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                <table aria-describedby="table-description"
                                    style="width: 100%; table-layout: fixed; border-bottom: 1px solid #000;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr></tr>
                                        <tr>
                                            <td>
                                                <b style="font-size: 13px;">Ship To:</b><br>
                                                {{ $invoice->deliveryAddress->full_name ?? '' }} <br>
                                                {{ $invoice->deliveryAddress->address ?? '' }}<br>
                                                {{ $invoice->deliveryAddress->state_id ?? '' }} {{ $invoice->deliveryAddress->country_id ?? '' }} <br>
                                            </td>
                                            <td style="text-align: right; font-size: 15px; font-weight: 700;">
                                                Tracking Items: {{count($invoice->barcodes??[])}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:0px;"></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>
                                                {{ $invoice->pickupAddress->full_name ?? '' }} <br>
                                                {{ $invoice->pickupAddress->address ?? '' }}<br>
                                                {{ $invoice->pickupAddress->state_id ?? '' }} {{ $invoice->pickupAddress->country_id ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="height: 5px;"></td>
                                        </tr>
                                        {{-- <tr>
                                            <td style="text-align: left; font-weight: 500; font-size: 14px;">
                                                {{ $invoice->invoce_item[0]['supply_name'] ?? '' }}
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td style="height:5px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            
                                <table aria-describedby="table-description"
                                    style="width: 100%; border-radius: 4px; border-bottom: 1px solid #000000;">
                                    <thead>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="">
                                                @if ($barcode->ParcelInventory)
                                                    {{ $barcode->ParcelInventory->supply_name ?? '' }}
                                                @else
                                                    {{ $barcode->description ?? '' }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div>
                                                    <div style="display: flex; justify-content: center; align-items: center;">
                                                        {!! $barcode->barcode ?? '' !!}
                                                    </div>
                                                    <span style="display: block; font-weight: bold; font-size: 16px; text-align: center;">
                                                        {!! $barcode->barcode_code ?? '' !!}
                                                    </span>
                                                </div>
                                                <br>
                                                <strong>
                                                    {{ $invoice->pickupAddress->address ?? '' }}
                                                </strong>
                                                <br>
                                                <strong>
                                                    {{ $invoice->pickupAddress->state_id ?? '' }} {{ $invoice->pickupAddress->country_id ?? '' }}
                                                </strong>
                                                <br>
                                                {{url('/')}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                    
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
<!--/labels Modal -->

<!-- AddnewLable Modal -->
@include('admin.Invoices.modals.AddnewLable')
<!--/AddnewLable Modal -->

<!-- Tracking Details Modal -->
<div class="modal custom-modal invoiceSModel fade" id="trackingDetails{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Tracking Details</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive onlyxpadding notMinheight border">
                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Date</th>
                                        <th>Package Type</th>
                                        <th>Img1</th>
                                        <th>Img2</th>
                                        <th>Package Status</th>
                                        <th>Warehouse</th>
                                        <th>Container</th>
                                        <th>User</th>
                                        <th>Driver</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse (($invoice->barcodes->whereNotNull('ParcelInventory')->values()??[]) as $key=>$item)
                                    <tr>
                                        <td>{{$item->barcode_code ?? ''}}</td>
                                        <td>{{$item->created_at->format('m/d/Y H:i') ?? ''}}</td>
                                        <td>{{$item->pacage_type ?? 'Imported'}}</td>
                                        <td>
                                            <img class="smImg" data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-placement="bottom" data-bs-html="true"
                                                data-bs-content="<img style='max-width: 200px;' src='{{ asset('assets/img.png') }}'>"
                                                src="{{ asset('assets/img.png') }}">
                                        </td>
                                        <td>
                                            <img class="smImg" data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-placement="bottom" data-bs-html="true"
                                                data-bs-content="<img style='max-width: 200px;' src='{{ asset('assets/img.png') }}'>"
                                                src="{{ asset('assets/img.png') }}">
                                        </td>
                                        <td>
                                            <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Out For Delivery(it is for batch creation only.)"> Out For
                                                Delivery(it is for batch creation only.)</p>
                                        </td>
                                        <td>{{ $invoice->warehouse->unique_id ?? '' }}</td>
                                        <td>{{ $invoice->container->unique_id ?? '' }}</td>
                                        <td>{{ $item->createdByUser->name ?? '' }} {{ $item->createdByUser->last_name ?? '' }}</td>
                                        <td>{{ $invoice->driver->name ?? '' }} {{ $invoice->driver->last_name ?? '' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No Tracking Details Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Tracking Details Modal -->

<!-- Note Modal -->
<div class="modal custom-modal invoiceSModel fade" id="addnewNote{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Add New Note</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3 pb-2">
                <form action="{{ route('admin.invoice.updateNote') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="hidden" name="type" value="notes">
                                <textarea name="notes" class="form-control inp"
                                    placeholder="Write Comment"></textarea>
                                <label class="col_000 fw-600 mb-0 mt-2">NOTE: [You can enter only 255 charcters in the
                                    above field.]</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive lesspadding notMinheight border mt-2">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($invoice->comments->count() > 0)
                                            @foreach($invoice->comments->where('type','notes')->values() as $comment)
                                                <tr>
                                                    <td>{{ $comment->createdByUser->name ?? '' }} {{ $comment->createdByUser->last_name ?? '' }}</td>
                                                    <td>{{ $comment->notes ?? '' }} - {{ $comment->created_at ? $comment->created_at->format('m/d/Y, h:i a') : '' }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="add-customer-btns text-end">
                                <button type="button" class="btn btn-outline-primary custom-btn" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button type="submit" class="btn btn-primary ">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/Note Modal -->

<!-- signature_Image Modal -->
<div class="modal custom-modal invoiceSModel fade" id="signatureImage{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom justify-content-between py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Signature Image</h4>
                </div>
                <p class="col3a text-center">
                    {{ $invoice->deliveryAddress && $invoice->deliveryAddress->user && $invoice->deliveryAddress->user->signature_date ? \Carbon\Carbon::parse($invoice->deliveryAddress->user->signature_date)->format('m-d-Y, h:i A') : '' }}
                </p>
                <button type="button" class="btn-close m-0 mt-n2" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3 pb-2">
                <div class="row">
                    <div class="col-12 text-center">
                        <img class="w-100 mx_150 p-4"
                            src="{{ $invoice->deliveryAddress &&  $invoice->deliveryAddress->user && $invoice->deliveryAddress->user->signature_img ? $invoice->deliveryAddress->user->signature_img : 'https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg'}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/signature_Image Modal -->

<!-- Contract_Image Modal -->
<div class="modal custom-modal invoiceSModel fade" id="ContractImage{{$invoice->id ?? ''}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom justify-content-between py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Contract Image</h4>
                </div>
                <p class="col3a text-center">
                    {{ $invoice->deliveryAddress && $invoice->deliveryAddress->user && $invoice->deliveryAddress->user->license_expiry_date ? \Carbon\Carbon::parse($invoice->deliveryAddress->user->license_expiry_date)->format('m-d-Y, h:i A') : '' }}
                </p>
                <button type="button" class="btn-close m-0 mt-n2" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3 pb-2">
                <div class="row">
                    <div class="col-12 text-center">
                        <img class="w-100 mx_150 p-4"
                            src="{{ $invoice->deliveryAddress &&  $invoice->deliveryAddress->user && $invoice->deliveryAddress->user->contract_signature_img ? $invoice->deliveryAddress->user->contract_signature_img : 'https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg'}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Contract_Image Modal -->