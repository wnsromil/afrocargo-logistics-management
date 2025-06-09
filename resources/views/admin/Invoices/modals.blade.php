<div class="d-flex align-items-center tooltipSections">
    <a class="circleIconBtn" data-bs-placement="bottom" title="Invoice History" data-bs-toggle="modal"
        data-bs-target="#invoiceHistory">
        <i class="ti ti-history-toggle"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Individual Payment" data-bs-toggle="modal"
        data-bs-target="#individualPayment">
        <i class="ti ti-cash"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Send Invoice pdf" data-bs-toggle="modal"
        data-bs-target="#sendinvoicepdf">
        <i class="ti ti-mail"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Claim" data-bs-toggle="modal"
        data-bs-target="#addnewClaim">
        <i class="ti ti-report-money"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Print" data-bs-toggle="modal"
        data-bs-target="#printInvoice1">
        <i class="ti ti-printer"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Invoice B" data-bs-toggle="modal"
        data-bs-target="#printInvoice2">
        <i class="ti ti-file-invoice"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Internal Comment" data-bs-toggle="modal"
        data-bs-target="#internalComment">
        <i class="ti ti-message"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Comment" data-bs-toggle="modal"
        data-bs-target="#onlyComment">
        <i class="ti ti-message text-warning"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Print Custom Invoice" data-bs-toggle="modal"
        data-bs-target="#customInvoice">
        <label class="fs_20 fw-bold">C</label>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Labels" data-bs-toggle="modal"
        data-bs-target="#InvoiceLabel">
        <i class="ti ti-tag-starred"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Add Labels" data-bs-toggle="modal"
        data-bs-target="#createLabel">
        <i class="ti ti-tag-plus"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Tracking" data-bs-toggle="modal"
        data-bs-target="#trackingDetails">
        <i class="ti ti-route"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Notes" data-bs-toggle="modal"
        data-bs-target="#addnewNote">
        <i class="ti ti-notebook"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Signature Image" data-bs-toggle="modal"
        data-bs-target="#signatureImage">
        <i class="ti ti-ballpen"></i>
    </a>

    <a class="circleIconBtn" data-bs-placement="bottom" title="Contract Image" data-bs-toggle="modal"
        data-bs-target="#ContractImage">
        <i class="ti ti-contract"></i>
    </a>
</div>



<!-- Invoice History Modal -->
<div class="modal custom-modal invoiceSModel fade" id="invoiceHistory" role="dialog">
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
                        <label class="col3A fw_500 mb-0">Ship To Name: {{$invoice->deliveryAddress && $invoice->pickupAddress->user && $invoice->pickupAddress ? $invoice->pickupAddress->full_name :''}}</label>
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
                                    @forelse ($invoice->invoce_item as $key=>$item)
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
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Items Found</td>
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
<!-- /Invoice History Modal -->

<!-- Individual Payment Modal -->
<div class="modal custom-modal invoiceSModel fade" id="individualPayment" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">individual Payment</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3">
                <form action="{{route('admin.saveIndividualPayment')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row pb-2">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Date<i class="text-danger">*</i></label>
                                <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                    <input type="text" name="payment_date" class="btn-filters  form-cs inp"
                                        placeholder="MM/DD/YYYY" />
                                    <input type="text"
                                        class="form-control inp inputs text-center timeOnlyInput inputbackground"
                                        readonly value="09:20 AM" name="currentTime">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label for="driver_id">Personal</label>
                                <select class="js-example-basic-single select2  form-cs">
                                    <option selected="selected">Select Drive</option>
                                    @foreach($drivers as $driver)
                                    <option {{ old('driver_id',$invoice->driver_id )==$driver->id ? 'selected' : '' }}
                                        value="{{ $driver->id
                                        }}">{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>User<i class="text-danger">*</i></label>
                                <input type="hidden" name="created_by" value="{{auth()->user()->id ?? ''}}">
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id ?? '' }}">
                                <input type="text"  class="form-control inp inputbackground" readonly
                                    value="{{auth()->user()->name ?? ''}} {{auth()->user()->last_name ?? ''}}" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label for="driver_id">Currency<i class="text-danger">*</i></label>
                                <select class="js-example-basic-single select2  form-cs" name="currency">
                                    <option selected="selected" disabled hidden>Select Currency</option>
                                    <option value="USD">United States - USD</option>
                                    <option value="DKK">Greenland - DKK</option>
                                    <option value="EUR">European Union - EUR</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label for="driver_id">Payment Type<i class="text-danger">*</i></label>
                                <select class="js-example-basic-single select2  form-cs" name="payment_type">
                                    <option selected="selected" disabled hidden>Select Type</option>
                                    <option value="boxcredit">Box Credit</option>
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="CreditCard">Credit Card</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Payment Amount<i class="text-danger">*</i></label>
                                <input type="text" name="payment_amount" class="form-control inp"
                                    placeholder="Enter Payment Amount" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Reference</label>
                                <input type="text" name="reference" class="form-control inp"
                                    placeholder="Enter Reference" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Comment</label>
                                <textarea name="comment" class="form-control inp"
                                    placeholder="Enter Comment"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Invoice Amount<i class="text-danger">*</i></label>
                                <input type="text" name="invoice_amount" class="form-control inp inputbackground" readonly
                                    value="600.00" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Total Balance<i class="text-danger">*</i></label>
                                <input type="text" name="total_balance" class="form-control inp inputbackground" readonly
                                    value="300.00" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Exchange Rate Balance<i class="text-danger">*</i></label>
                                <input type="text" name="exchange_rate_balance" class="form-control inp inputbackground" readonly
                                    placeholder="Exchange Rate Balance" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Applied Payments<i class="text-danger">*</i></label>
                                <input type="text" name="applied_payments" class="form-control inp inputbackground" readonly
                                    placeholder="Applied Payments" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Applied Payment Total In USD<i class="text-danger">*</i></label>
                                <input type="text" name="applied_total_usd" class="form-control inp inputbackground" readonly
                                    placeholder="Applied Payment Total In USD" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Current Balance<i class="text-danger">*</i></label>
                                <input type="text" name="current_balance" class="form-control inp inputbackground" readonly
                                    placeholder="Current Balance" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Exchange Rate<i class="text-danger">*</i></label>
                                <input type="text" name="exchange_rate" class="form-control inp inputbackground" readonly
                                    placeholder="Exchange Rate" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Current Balance After Ex.Rate<i class="text-danger">*</i></label>
                                <input type="text" name="balance_after_exchange_rate" class="form-control inp inputbackground" readonly
                                    placeholder="Current Balance After Ex.Rate" />
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <p class="subhead">Payment Receipts</p>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive lesspadding border mt-3">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Invoice ID</th>
                                            <th>User</th>
                                            <th>Payment Type</th>
                                            <th>Payment Date</th>
                                            <th>Amt. In Dollar</th>
                                            <th>Local Currency</th>
                                            <th>Currency</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>TIP-000710</td>
                                            <td>
                                                <p class="overflow-ellpise" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Abijan Cargo Sacko">Abijan Cargo
                                                    Sacko</p>
                                            </td>
                                            <td>Cash</td>
                                            <td>04/28/2025, 03:21</td>
                                            <td>200.00</td>
                                            <td>-</td>
                                            <td>USD</td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i
                                                                        class="ti ti-file-type-pdf me-2"></i>PDF</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i
                                                                        class="ti ti-trash me-2"></i>Delete</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
<!-- /Individual Payment Modal -->

<!-- Send Invoice Pdf Modal -->
<div class="modal custom-modal invoiceSModel fade" id="sendinvoicepdf" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Send Invoice Pdf</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3 pb-2">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row pb-2">
                        <div class="col-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="templateTitle">Send Invoice from<i
                                        class="text-danger">*</i></label>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Email</label> <input
                                    class="form-check-input mt-0" checked type="radio" value="email"
                                    name="sentInvoicePdf">
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Text/SMS</label> <input
                                    class="form-check-input mt-0" type="radio" value="sms" name="sentInvoicePdf">
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="emailDiv">
                                <div class="input-block mb-3">
                                    <label class="foncolor" for="email">Email Id<i class="text-danger">*</i></label>
                                    <input type="text" name="email" class="form-control inp"
                                        placeholder="Enter Email ID">
                                </div>
                            </div>

                            <div id="textorsmsDiv" style="display:none;">
                                <div class="input-block mb-3">
                                    <label class="foncolor" for="alternate_mobile_no">Alternate Mobile No.</label>
                                    <input type="tel" id="alternate_mobile_no" name="alternate_mobile_no"
                                        class="form-control inp" placeholder="Enter Alternate Mobile No.">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
<!--/Send Invoice Pdf Modal -->

<!-- Claim Modal -->
<div class="modal custom-modal invoiceSModel fade" id="addnewClaim" role="dialog">
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
                <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <textarea name="PaymentAmount" class="form-control inp"
                                    placeholder="Write Comment"></textarea>
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
                                        <tr>
                                            <td>Fode Sacko</td>
                                            <td>Lorem Ipsum - 04/28/2025, 08:09 am </td>
                                        </tr>
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
<div class="modal custom-modal invoiceSModel fade" id="printInvoice1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body p-2">
                <!-- Wrapper Table -->
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="border-collapse: collapse; max-width: 900px; margin: 0 auto; background: #fff; border: 1px solid #ffffff; font-family: 'Poppins', sans-serif; padding: 0; font-size: 14px; color: #000;">

                    <!-- Header -->
                    <tr>
                        <td colspan="2" style="padding: 20px 0 0;">
                            <table width="100%">
                                <tr>
                                    <td style="width: 100%;">
                                        <table width="100%">
                                            <tr>
                                                <td style="text-align: center; font-size: 21px; font-weight: 600;">
                                                    CARGO INVOICE
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 0 20px 0px 20px;">
                            <table width="100%">
                                <tr>
                                    <td style="width: 40%;">
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <img style="width: 75px; margin-right: 5px;"
                                                                    src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                                                            </td>
                                                            <td>
                                                                <b style="font-size: 18px;">Afro Cargo Express Llc
                                                                    NY</b><br>
                                                                The Bronx10454<br>
                                                                Tel-646-468-4135<br>
                                                                Tel 718-954-9093<br>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 25%; text-align: center;">
                                        <span
                                            style="background-color: white; padding: 10px 20px; border-radius: 8px; font-size: 21px; font-weight: 600; border: 1px solid red; color: red;">Due
                                            Balance</span>
                                    </td>
                                    <td style="width: 35%;">
                                        <b style="font-size: 18px;">Afro Cargo Express Llc Abidjan</b><br> Abidjan
                                        Autonomous District
                                        Abidjan,<br>
                                        Tel-07 09 04 1250<br>
                                        Tel-07 89 49 2486<br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 0 20px 20px 20px;">
                            <table width="100%">
                                <tr>
                                    <td style="width: 35%;">
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <b style="font-size: 18px;">Customer</b><br>
                                                    @if(isset($invoice->deliveryAddress))
                                                    {{$invoice->deliveryAddress->full_name ?? ''}}<br>
                                                    {{$invoice->deliveryAddress->address ?? ''}}<br>
                                                    {{$invoice->deliveryAddress->state_id ?? ''}}<br>
                                                    {{$invoice->deliveryAddress->country_id ?? ''}}<br>
                                                    {{$invoice->deliveryAddress->mobile_number ?? ''}}
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 30%; text-align: center;">
                                    </td>
                                    <td style="width: 35%;">
                                        <b style="font-size: 18px;">Ship To:</b><br>
                                        @if(isset($invoice->pickupAddress))
                                            {{$invoice->pickupAddress->full_name ?? ''}}<br>
                                            {{$invoice->pickupAddress->address ?? ''}}<br>
                                            {{$invoice->pickupAddress->state_id ?? ''}}<br>
                                            {{$invoice->pickupAddress->country_id ?? ''}}<br>
                                            {{$invoice->pickupAddress->mobile_number ?? ''}}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 10px 20px; border-top: 3px solid #EFEFEF;">
                            <table width="100%">
                                <tr>
                                    <td style="width: 40%; color: #3a3a3a;">Date & Time Printed: 
                                        <b style="color: #000000;">
                                            {{ $invoice->created_at ? $invoice->created_at->format('M.d.Y') . ' ---' : '' }}
                                            <br>
                                            {{ $invoice->created_at ? $invoice->created_at->format('H:i:s') : '' }}
                                        </b>
                                    </td>
                                    <td style="width: 40%; color: #3a3a3a; font-size: 20px; text-align: center;">Inv
                                        No.: <b style="color: #000000;">{{$invoice->invoice_no ?? ''}}</b></td>
                                    <td style="width: 20%; color: #3a3a3a; font-size: 20px;">Cont: <b
                                            style="color: #000000;">{{$invoice->container && $invoice->container->unique_id ? $invoice->container->unique_id:'' }}</b></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table
                                style="width: 100%; border-collapse: collapse; border: 1px solid black; border-bottom: none;">
                                <tr style="background-color: #f2f2f2; border: 1px solid black; ">
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">P.:
                                        AbidjaM</td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">M.:
                                        Abidjam</td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">S.:
                                        Abidjan</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; padding: 10px 20px;">
                                        <span style="font-size: 17px;">
                                            Invoice Date: <b>{{$invoice->created_at->format('d/m/Y') ?? ''}}</b><br>
                                            Pay Terms: <b>United States</b><br>
                                            Ship Via: <b>{{$invoice->created_at ?? ''}}</b>
                                        </span>
                                    </td>
                                    <td style="width: 50%; padding: 10px 20px;" colspan="2">
                                        <span style="font-size: 17px;">
                                            Driver: <b>{{ $invoice->driver->name ?? '' }} {{ $invoice->driver->last_name ?? '' }}</b><br>
                                            Branch: <b>{{ $invoice->createdByUser && $invoice->createdByUser->warehouse ? $invoice->createdByUser->warehouse->name : '' }}</b><br>
                                            User: <b>{{ $invoice->createdByUser->name ?? '' }} {{ $invoice->createdByUser->last_name ?? '' }}</b>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">

                                <tr style="background-color: #203A5F; color:white; border: 1px solid black;">
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px; width: 30px;">#
                                    </th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Item</th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Qty.</th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Unit</th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px; width: 200px;">
                                        Product / Service</th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Value</th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Price</th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Disc.</th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Ins.</th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Tax%</th>
                                    <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Total</th>
                                </tr>
                                @forelse (($invoice->invoiceParcelData->parcelInventory??[]) as $key=>$item)
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{$key+1}}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">00{{ $item['supply_id'] ?? 0 }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['qty'] ?? 0 }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['label_qty'] ?? 0 }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['supply_name'] ?? '' }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['value'] ?? 0 }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['price'] ?? 0 }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['discount'] ?? 0 }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['ins'] ?? 0 }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['tax'] ?? 0 }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['total'] ?? 0 }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No Items Found</td>
                                </tr>
                                @endforelse
                                <tr>
                                    <td style="padding: 10px 20px;">
                                        <strong>Notes:</strong><br>
                                        ----
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <!-- Subtotal and Balance Section -->
                            <table
                                style="width: 100%; border-collapse: collapse; border: 1px solid black;border-top:unset;">
                                <tr style="background-color: #f2f2f2; border: 1px solid black; border-top:unset;;">
                                    <td style="text-align: start; padding: 5px 20px; width: 20%;">Subtotal</td>
                                    <td style="text-align: center; padding: 5px; width: 20%;">Discount</td>
                                    <td style="text-align: center; padding: 5px; width: 20%;">Insurance</td>
                                    <td style="text-align: center; padding: 5px; width: 20%;">Tax</td>
                                    <td style="text-align: center; padding: 5px; width: 20%;">Items</td>
                                    <td style="text-align: center; padding: 5px; width: 20%;">Amount</td>
                                    <td style="text-align: center; padding: 5px; width: 20%;">Payments</td>
                                    <td style="text-align: center; padding: 5px 20px; width: 20%;">
                                        <strong>Balance</strong></td>
                                </tr>
                                <tr style="border: 1px solid black;">
                                    <td style=" text-align: start; padding: 5px 20px;">${{$invoice->grand_total ?? 0}}</td>
                                    <td style=" text-align: center; padding: 5px;">${{$invoice->discount ?? 0}}</td>
                                    <td style=" text-align: center; padding: 5px;">${{$invoice->ins ?? 0}}</td>
                                    <td style=" text-align: center; padding: 5px;">${{$invoice->tax ?? 0}}0</td>
                                    <td style=" text-align: center; padding: 5px;">{{$invoice->total_qty ?? 0}}</td>
                                    <td style=" text-align: center; padding: 5px;">${{$invoice->grand_total ?? 0}}</td>
                                    <td style=" text-align: center; padding: 5px;">${{$invoice->payment ?? 0}}</td>
                                    <td style=" text-align: center; padding: 5px 20px;"><strong>${{$invoice->balance ?? 0}}</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table
                                style="width: 100%; border-collapse: collapse; margin-bottom: 20px;  border: 1px solid black; border-top:unset;">
                                <tr>
                                    <td style="padding: 5px 20px;">
                                        <p style="font-size: smaller; line-height: 1.2;">
                                            DECLARO que no estoy enviando:DROGA, DINERO, ARMAS DE FUEGO Y EXPLOSIVOS,
                                            QUÍMICOS Y NINGÚN
                                            ARTÍCULOS PROHIBIDO POR LEY. Entiendo que he pagado por lo que he declarado
                                            y si llegase a omitir
                                            cualquier artículo me comprometo a pagar los Impuestos y Multa por mala
                                            declaración. Tengo 30 días
                                            para realizar el pago, caso contrario autorizo a la Empresa A SUBASTAR MIS
                                            CAJAS. También entiendo
                                            que mi carga ha sido asegurada en un 100% del valor declarado y que en la
                                            eventualidad de que ocurra
                                            pérdida parcial total, la empresa se compromete a reembolsarme al 100% del
                                            valor declarado y si hay
                                            pérdida parcial el reembolso será proporcional al faltante de las libras.
                                            También conozco que la
                                            empresa no es responsable durante el transporte por ROTURAS o DAÑOS.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 40%; padding: 0px 20px;">
                                        <span>I have Received the Contract and Accept the Terms and
                                            Condition.</span><br>
                                        <span style="font-size: 18px; font-weight: 600; line-height: 40px;">Authorized
                                            Sign</span><br>
                                        <img src="https://www.morebusiness.com/wp-content/uploads/2020/09/handwritten-email-signature.jpg"
                                            style="max-width: 100px;">
                                    </td>
                                    <td style="width: 40%; "> </td>
                                    <td
                                        style="width: 20%; text-align: end; font-size: 16px; vertical-align: top; padding: 0px 20px;">
                                        <span style="color: #737B8B;">Sub-Total: <b
                                                style="color: #000;">${{$invoice->grand_total ?? 0}}</b></span><br>
                                        <span style="color: #737B8B; line-height: 50px;">Paid: <b
                                                style="color: #000;">${{$invoice->payment ?? 0}}</b></span><br>
                                        <span style="color: #000;"><b>Total Amount:</b> ${{$invoice->balance ?? 0}} </span><br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="padding: 10px 20px; border-top: 3px solid #EFEFEF;">
                        <td colspan="2" style="padding: 10px 20px 0px 20px;">
                            <table width="100%">
                                <tr>
                                    <td style="width: 35%;">
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <b style="font-size: 18px;">Afro Cargo Express Llc NY</b><br>
                                                    The Bronx10454<br>
                                                    Tel-646-468-4135<br>
                                                    Tel 718-954-9093<br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 30%; text-align: center;"> </td>
                                    <td style="width: 35%;">
                                        <b style="font-size: 18px;">Afro Cargo Express Llc Abidjan</b><br> Abidjan
                                        Autonomous District
                                        Abidjan,<br>
                                        Tel-07 09 04 1250<br>
                                        Tel-07 89 49 2486<br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>



                </table>
            </div>
        </div>
    </div>
</div>
<!--/print_Invoice1 Modal -->

<!-- print_Invoice2 Modal -->
<div class="modal custom-modal invoiceSModel pdfModal fade" id="printInvoice2" role="dialog">
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
                                                        Afro Cargo Express Llc NY<br> 366 Concord Ave<br>
                                                        NY The Bronx<br>
                                                        646-468-4135<br> 718-954-9093
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td style="text-align: right;"> Afro Cargo Express Llc Abidjan<br> Avenue
                                            21<br>
                                            Rue 15 Treichville<br>
                                            Abidjan Autonomous District Abidjan <br> 07 09 04
                                            1250<br> 07 89 49 2486
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
                                            Afro Cargo
                                            Express Llc NY </td>
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
<div class="modal custom-modal invoiceSModel fade" id="internalComment" role="dialog">
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
<div class="modal custom-modal invoiceSModel fade" id="onlyComment" role="dialog">
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
<div class="modal custom-modal invoiceSModel tableBody fade" id="customInvoice" role="dialog">
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
                                                    <b style="font-size: 18px;">Afro Cargo Express Llc NY</b><br>
                                                    366 Concord Ave<br>
                                                    NY, The Bronx, 10454<br>
                                                    United States - 646-468-4135<br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 25%; text-align: center;">
                                    </td>
                                    <td style="width: 35%; text-align: right;">
                                        <b style="font-size: 18px;">Afro Cargo Abidjan</b><br> Avenue 21<br>
                                        Rue 15 Treichville Abidjan <br>Autonomous District, Abidjan<br>
                                        Côte d'Ivoire - 07 09 04 1251
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
                                    <td
                                        style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                        Driver</td>
                                    <td
                                        style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                        Container</td>
                                    <td
                                        style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                        Date</td>
                                    <td
                                        style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                        Invoice</td>
                                </tr>
                                <tr style="background-color: #ffffff; border: 1px solid black; ">
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">Bouba
                                        Fofana</td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">02225
                                    </td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                        05/30/2025 9:09 pm</td>
                                    <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                        TIV-001492</td>
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
                                                                <b style="font-size: 16px;">Afro Cargo Express Llc
                                                                    NY</b><br>
                                                                366 Concord Ave<br>
                                                                NY, The Bronx, 10454<br>
                                                                United States - 646-468-4135<br>
                                                            </td>
                                                            <td style="width: 20; text-align: center;">
                                                            </td>
                                                            <td style="width: 40%; text-align: right;">
                                                                <b style="font-size: 16px;">Afro Cargo Abidjan</b><br>
                                                                Avenue 21<br>
                                                                Rue 15 Treichville Abidjan <br>Autonomous District,
                                                                Abidjan<br>
                                                                Côte d'Ivoire - 07 09 04 1250
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;" colspan="2">
                                                    <table
                                                        style="width: 100%; border-collapse: collapse; border: 1px solid black; border-bottom: none; margin-top: 15px;">
                                                        <tr
                                                            style="background-color: #f2f2f2; border: 1px solid black; ">
                                                            <td
                                                                style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                                                Driver</td>
                                                            <td
                                                                style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                                                Container</td>
                                                            <td
                                                                style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                                                Date</td>
                                                            <td
                                                                style="border: 1px solid black; padding: 10px 20px;text-align: start; font-weight: 500;">
                                                                Invoice</td>
                                                        </tr>
                                                        <tr
                                                            style="background-color: #ffffff; border: 1px solid black; ">
                                                            <td
                                                                style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                                                Bouba Fofana</td>
                                                            <td
                                                                style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                                                02225</td>
                                                            <td
                                                                style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                                                05/30/2025 9:09 pm
                                                            </td>
                                                            <td
                                                                style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                                                                TIV-001492</td>
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
                                                                John Williams<br>
                                                                15 Hodges Mews, High Wycombe<br>
                                                                HP12 3JL<br>
                                                                United Kingdom<br>
                                                                829-457-9638
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td
                                                    style="width: 50%; padding:10px; padding-top: 5px; text-align: right;">
                                                    <b style="font-size: 18px;">Ship To:</b><br>
                                                    Walter Roberson<br>
                                                    299 Star Trek Drive, Panama City,<br>
                                                    Florida, 32405,<br>
                                                    USA<br>
                                                    07 07 50 8448
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table aria-describedby="table-description"
                                                        style="width: 100%; padding: 0 10px; table-layout: fixed; border-top: 1px solid #000000; border-bottom: 1px solid #000000; margin-bottom: 20px;">
                                                        <tr>
                                                            <td colspan="4"><b>* Barrel large</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Qty</td>
                                                            <td>Price</td>
                                                            <td>Discount</td>
                                                            <td>Tax(%)</td>
                                                            <td>Ins</td>
                                                            <td>Total</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>$250.00</td>
                                                            <td>$0.00</td>
                                                            <td>$0.00</td>
                                                            <td>$0.00</td>
                                                            <td>$250.00</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" style="padding: 10px;">
                                                        <tr>
                                                            <td>
                                                                Total Items: 1
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table
                                                                    style="width: 100%; border-collapse: collapse; border: 1px solid black;"
                                                                    cellpadding="8" ;>
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
                                                                <b>Sub-Total:</b> $250.00 <br>
                                                                <b>Ins:</b> $0.00 <br>
                                                                <b>Tax:</b> $0.00 <br>
                                                                <b>Total:</b> $250.00 <br>
                                                                <b>Payment:</b> $0.00 <br>
                                                                <b>Balance:</b> $250.00
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table
                                                                    style="width: 100%; border-collapse: collapse; border: 1px solid black;"
                                                                    cellpadding="5" ;>
                                                                    <tr>
                                                                        <td style="font-size: 15px;">
                                                                            Invoice#: TIV-001492
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
                                                                            <img style="width: 200px;"
                                                                                src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
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
                                                                            <img style="width: 200px;"
                                                                                src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
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
                                                    ABIJAN CARGO<br>
                                                    TERMS & CONDITIONS
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;">
                            Terms & Condition
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;">
                            Terms & Condition
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
<div class="modal custom-modal invoiceSModel pdfModal fade" id="InvoiceLabel" role="dialog">
    <div class="modal-dialog modal-dialog-centered mxWidth">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Labels <a href="#" class="btn btn-primary ms-2">Print</a> </h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body p-2">
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="border-collapse: collapse; max-width:100%; margin: 0 auto; background: #fff; border: 1px solid #ffffff; font-family: 'Poppins', sans-serif; margin: 0; padding: 0; font-size: 12px; color: #000;">
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
                                                        Afro Cargo Express Llc NY<br> 366 Concord Ave<br>
                                                        <!----> NY The Bronx
                                                        <br>
                                                        646-468-4135<br> 718-954-9093
                                                    </td>
                                                </tr>
                                            </table>

                                        <td style="text-align: right;"> Afro Cargo Express Llc Abidjan<br> Avenue
                                            21<br>
                                            Rue 15 Treichville<br>
                                            <!----> Abidjan Autonomous District Abidjan <br> 07 09 04
                                            1250<br> 07 89 49 2486
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height: 5px;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"
                                            style="font-weight: bold; font-size: 30px; color: #000; text-align: center;">
                                            TIV-000982
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
                                            04/11/2025</td>
                                        <td
                                            style="padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 14px; text-align: right;">
                                            Afro Cargo
                                            Express Llc NY </td>
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
                                        <td><b style="font-size: 13px;">Ship To:</b><br> Fatoumata <br> 1042 Oaks Dr<br>
                                            <!----> Ohio Columbus 42228 <br>
                                        </td>
                                        <td style="text-align: right; font-size: 15px; font-weight: 700;"> Tracking
                                            Items: 2 </td>
                                    </tr>
                                    <tr>
                                        <td style="height:0px;"></td>
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        <td> Zeinabou <br> Abidjan<br>
                                            <!---->
                                            <!---->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="height: 5px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: 500; font-size: 14px;"> Barrel large
                                        </td>
                                    </tr>
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
                                        <td style="text-align: center;"><img width="300px" alt="Logo"
                                                src="https://d9wi98su9qvhp.cloudfront.net/production/kroC02.png"><span
                                                style="display: block; padding-top: 5px; font-weight: bold; font-size: 16px; text-align: center;">
                                                Abidjam
                                            </span><span
                                                style="display: block; font-weight: bold; font-size: 16px; text-align: center;">
                                                AbidjaM
                                            </span></td>
                                    </tr>
                                    <tr>
                                        <td style="height: 20px;"></td>
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
<!--/labels Modal -->

<!-- AddnewLable Modal -->
<div class="modal custom-modal invoiceSModel fade" id="createLabel" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 border-bottom py-3">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Create Label</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body pt-3 pb-2">
                <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <label>Quantity<i class="text-danger">*</i></label>
                                <input name="labelQuantity" class="form-control inp" placeholder="Enter Quantity">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <label>Description<i class="text-danger">*</i></label>
                                <textarea name="description" class="form-control inp"
                                    placeholder="Enter Description"></textarea>
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
<!--/AddnewLable Modal -->

<!-- Tracking Details Modal -->
<div class="modal custom-modal invoiceSModel fade" id="trackingDetails" role="dialog">
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
                                    <tr>
                                        <td>060000529I1001</td>
                                        <td>02/28/2025, 17:36</td>
                                        <td>Imported</td>
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
                                        <td>Afro Cargo Bronx NYC</td>
                                        <td>-</td>
                                        <td>Fode Sacko</td>
                                        <td>Fode Sacko</td>
                                    </tr>
                                    <tr>
                                        <td>060000529I1002</td>
                                        <td>03/18/2025, 11:36</td>
                                        <td>Imported</td>
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
                                                title="Out For Delivery(it is for batch creation only.)"> WH</p>
                                        </td>
                                        <td>Afro Cargo Bronx NYC</td>
                                        <td>-</td>
                                        <td>Fode Sacko</td>
                                        <td>Fode Sacko</td>
                                    </tr>
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
<div class="modal custom-modal invoiceSModel fade" id="addnewNote" role="dialog">
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
<div class="modal custom-modal invoiceSModel fade" id="signatureImage" role="dialog">
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
<div class="modal custom-modal invoiceSModel fade" id="ContractImage" role="dialog">
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