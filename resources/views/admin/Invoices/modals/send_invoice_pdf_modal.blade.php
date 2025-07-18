<div class="modal custom-modal invoiceSModel fade" id="sendinvoicepdf{{$invoice->id ?? ''}}" role="dialog">
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
                <form action="" method="POST" enctype="multipart/form-data" id="sendInvoiceForm">
                    @csrf
                    <div class="row pb-2">
                        <div class="col-12">
                            <div class="input-block mb-1">
                                <label class="foncolor" for="templateTitle">Send Invoice from<i
                                        class="text-danger">*</i></label>
                            </div>
                        </div>
                        <input type="hidden" name="invoiceId" value="{{ $invoice->id ?? '' }}">
                        <div class="col-md-4 col-4">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Email</label> <input
                                    class="form-check-input mt-0" checked type="radio" value="email"
                                    name="sentInvoicePdf">
                            </div>
                        </div>
                        <div class="col-md-4 col-4">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Text/SMS</label> <input
                                    class="form-check-input mt-0" type="radio" value="sms" name="sentInvoicePdf">
                            </div>
                        </div>
                        <div class="col-md-4 col-4">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Whatsapp</label> <input
                                    class="form-check-input mt-0" type="radio" value="whatsapp" name="sentInvoicePdf">
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="emailDiv">
                                <div class="input-block mb-3">
                                    <label class="foncolor" for="email">Email Id<i class="text-danger">*</i></label>
                                    <input type="text" name="email" class="form-control inp"
                                        placeholder="Enter Email ID" value="{{ $invoice->pickupAddress && $invoice->pickupAddress->user ? $invoice->pickupAddress->user->email : '' }}">
                                </div>
                            </div>

                            <div id="textorsmsDiv" style="display:none;">
                                <div class="input-block mb-3">
                                    <label class="foncolor" for="alternate_mobile_no">Alternate Mobile No.</label>
                                    <input type="tel" id="alternate_mobile_no" name="alternate_mobile_no"
                                        class="form-control inp" placeholder="Enter Alternate Mobile No." value="{{ $invoice->pickupAddress && $invoice->pickupAddress->user ? $invoice->pickupAddress->mobile_number: '' }}">
                                </div>
                            </div>
                            <div id="whatsappDiv" style="display:none;">
                                <div class="input-block mb-3">
                                    <label class="foncolor" for="whatsapp_no">Whatsapp No.</label>
                                    <input type="tel" id="whatsapp_no" name="whatsapp_no"
                                        class="form-control inp" placeholder="Enter Whatsapp Mobile No." value="{{ $invoice->pickupAddress && $invoice->pickupAddress->user ? $invoice->pickupAddress->mobile_number: '' }}">
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