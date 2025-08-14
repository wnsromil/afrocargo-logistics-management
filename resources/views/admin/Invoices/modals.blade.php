<div class="d-flex align-items-center tooltipSections">
    @can('has-dynamic-permission', 'invoice_list.invoice_history')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Invoice History" data-bs-toggle="modal"
        data-bs-target="#invoiceHistory{{$invoice->id ?? ''}}">
        <i class="ti ti-history-toggle"></i>
    </a>
    @endcan

    @can('has-dynamic-permission', 'invoice_list.individuel_payment')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Individual Payment" data-bs-toggle="modal"
        data-bs-target="#individualPayment{{$invoice->id ?? ''}}">
        <i class="ti ti-cash"></i>
    </a>
    @endcan

    @can('has-dynamic-permission', 'invoice_list.send_invoice')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Send Invoice pdf" data-bs-toggle="modal"
        data-bs-target="#sendinvoicepdf{{$invoice->id ?? ''}}">
        <i class="ti ti-mail"></i>
    </a>
    @endcan

    @can('has-dynamic-permission', 'invoice_list.claim')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Claim" data-bs-toggle="modal"
        data-bs-target="#addnewClaim{{$invoice->id ?? ''}}">
        <i class="ti ti-report-money"></i>
    </a>
    @endcan

    {{-- <a class="circleIconBtn" data-bs-placement="bottom" title="Print" data-bs-toggle="modal"
        data-bs-target="#printInvoice1{{$invoice->id ?? ''}}">
        <i class="ti ti-printer"></i>
    </a> --}}
    @can('has-dynamic-permission', 'invoice_list.invoice_pdf')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Print" target="_blank" href="{{ route('invoices.invoicesdownload', encrypt($invoice->id)) }}">
      <i class="ti ti-printer"></i>
    </a>
    @endcan
    @can('has-dynamic-permission', 'invoice_list.invoice_pdf')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Invoice B" data-bs-toggle="modal"
        data-bs-target="#printInvoice2{{$invoice->id ?? ''}}">
        <i class="ti ti-file-invoice"></i>
    </a>
    @endcan
    @can('has-dynamic-permission', 'invoice_list.internal_camment')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Internal Comment" data-bs-toggle="modal"
        data-bs-target="#internalComment{{$invoice->id ?? ''}}">
        <i class="ti ti-message"></i>
    </a>
    @endcan
    @can('has-dynamic-permission', 'invoice_list.comment')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Comment" data-bs-toggle="modal"
        data-bs-target="#onlyComment{{$invoice->id ?? ''}}">
        <i class="ti ti-message text-warning"></i>
    </a>
    @endcan
    @can('has-dynamic-permission', 'invoice_list.print_custom_invoice')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Print Custom Invoice" data-bs-toggle="modal"
        data-bs-target="#customInvoice{{$invoice->id ?? ''}}">
        <label class="fs_20 fw-bold">C</label>
    </a>
    @endcan

    {{-- <a class="circleIconBtn" data-bs-placement="bottom" title="Labels" data-bs-toggle="modal"
        data-bs-target="#InvoiceLabel{{$invoice->id ?? ''}}">
        <i class="ti ti-tag-starred"></i>
    </a> --}}
    @if(!empty($invoice->transport_type))
        @can('has-dynamic-permission', 'invoice_list.label_pdf')
        @if (!empty($invoice->barcodes) && count($invoice->barcodes) > 0)

            <a class="circleIconBtn" data-bs-placement="bottom" title="Labels"
                href="{{ route('invoices.invoicesdownload', encrypt($invoice->id)) }}?type=labels"
                target="_blank">
                <i class="ti ti-tag-starred"></i>
            </a>
        @else
            <a class="circleIconBtn" data-bs-placement="bottom" title="Labels"
                href="javascript:void(0)"
                onclick="alertMsg('Please generated labels, No labels have been generated for this invoice yet.','error')"
                data-bs-placement="bottom" title="Add Labels" data-bs-toggle="modal"
                data-bs-target="#createLabel{{$invoice->id ?? ''}}">
                <i class="ti ti-tag-starred"></i>
            </a>
        @endif
        @endcan

        @can('has-dynamic-permission', 'invoice_list.create_label')
        <a class="circleIconBtn" data-bs-placement="bottom" title="Add Labels" data-bs-toggle="modal"
            data-bs-target="#createLabel{{$invoice->id ?? ''}}">
            <i class="ti ti-tag-plus"></i>
        </a>
        @endcan
    @endif
    @can('has-dynamic-permission', 'invoice_list.tracking')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Tracking" data-bs-toggle="modal"
        data-bs-target="#trackingDetails{{$invoice->id ?? ''}}">
        <i class="ti ti-route"></i>
    </a>
    @endcan

    @can('has-dynamic-permission', 'invoice_list.notes')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Notes" data-bs-toggle="modal"
        data-bs-target="#addnewNote{{$invoice->id ?? ''}}">
        <i class="ti ti-notebook"></i>
    </a>
    @endcan

    @can('has-dynamic-permission', 'invoice_list.signature_image')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Signature Image" data-bs-toggle="modal"
        data-bs-target="#signatureImage{{$invoice->id ?? ''}}">
        <i class="ti ti-ballpen"></i>
    </a>
    @endcan

    @can('has-dynamic-permission', 'invoice_list.contract_image')
    <a class="circleIconBtn" data-bs-placement="bottom" title="Contract Image" data-bs-toggle="modal"
        data-bs-target="#ContractImage{{$invoice->id ?? ''}}">
        <i class="ti ti-contract"></i>
    </a>
    @endcan
</div>
@include('admin.Invoices.modals.editInvoice')
