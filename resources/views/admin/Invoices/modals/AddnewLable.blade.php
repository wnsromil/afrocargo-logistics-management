<div class="modal custom-modal invoiceSModel fade" id="createLabel{{$invoice->id ?? ''}}" role="dialog">
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
                <form method="POST" enctype="multipart/form-data" id="AddnewLable">
                    @csrf
                    <input type="hidden" name="invoiceId" value="{{$invoice->id ?? ''}}">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <label>Quantity<i class="text-danger">*</i></label>
                                <input type="number" name="labelQuantity" class="form-control inp" placeholder="Enter Quantity">
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