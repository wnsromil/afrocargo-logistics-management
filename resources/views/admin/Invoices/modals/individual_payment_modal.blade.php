<div class="modal custom-modal invoiceSModel modalNew fade" id="individualPayment{{$invoice->id ?? ''}}" role="dialog">
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
                                        placeholder="MM/DD/YYYY"
                                        value="{{ old('payment_date', \Carbon\Carbon::now()->format('Y-m-d')) }}" />
                                    <input type="text"
                                        class="form-control inp inputs text-center timeOnlyInput inputbackground"
                                        readonly
                                        value="{{ old('currentTime', \Carbon\Carbon::now()->format('h:i A')) }}"
                                        name="currentTime">
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
                                <input type="text" class="form-control inp inputbackground" readonly
                                    value="{{auth()->user()->name ?? ''}} {{auth()->user()->last_name ?? ''}}" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label for="driver_id">Currency<i class="text-danger">*</i></label>
                                <select class="js-example-basic-single select2  form-cs" name="local_currency">
                                    <option value="United State">United State - USD</option>
                                    @foreach (setting()->warehouseContries()->whereNotIn('name',['United State'])->values() as $currency)
                                        <option value="{{ $currency->currency}}">{{ $currency->name }} - {{ $currency->currency}}</option>
                                    @endforeach
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
                                <input type="number" name="payment_amount" class="form-control inp" min="0.1"
                                    step="0.01" placeholder="Enter Payment Amount"
                                    required
                                    oninput="maxPaymentAmount(this)">
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
                                <input type="text" name="invoice_amount" class="form-control inp inputbackground"
                                    readonly value="{{$invoice->grand_total ?? 0}}" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Total Balance<i class="text-danger">*</i></label>
                                <input type="text" name="total_balance" class="form-control inp inputbackground"
                                    readonly value="{{$invoice->balance ?? 0}}" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Exchange Rate Balance<i class="text-danger">*</i></label>
                                <input type="text" name="exchange_rate_balance" class="form-control inp inputbackground"
                                    readonly placeholder="Exchange Rate Balance" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Applied Payments<i class="text-danger">*</i></label>
                                <input type="text" name="applied_payments" class="form-control inp inputbackground"
                                    readonly placeholder="Applied Payments" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Applied Payment Total In USD<i class="text-danger">*</i></label>
                                <input type="text" name="applied_total_usd" class="form-control inp inputbackground"
                                    readonly placeholder="Applied Payment Total In USD" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Current Balance<i class="text-danger">*</i></label>
                                <input type="text" name="current_balance" class="form-control inp inputbackground"
                                    readonly placeholder="Current Balance" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Exchange Rate<i class="text-danger">*</i></label>
                                <input type="text" name="exchange_rate" class="form-control inp inputbackground"
                                    readonly placeholder="Exchange Rate" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-block flexblockInput mb-3">
                                <label>Current Balance After Ex.Rate<i class="text-danger">*</i></label>
                                <input type="text" name="balance_after_exchange_rate"
                                    class="form-control inp inputbackground" readonly
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
                                        @forelse($invoice->individualPayment as $payment)
                                        <tr>
                                            <td>{{ $invoice->invoice_no ?? '' }}</td>
                                            <td>
                                                <p class="overflow-ellpise" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{ $payment->createdByUser->name ?? '' }} {{ $payment->createdByUser->last_name ?? '' }}">
                                                    {{ $payment->createdByUser->name ?? '' }} {{
                                                    $payment->createdByUser->last_name ?? '' }}
                                                </p>
                                            </td>
                                            <td>{{ ucfirst($payment->payment_type ?? '-') }}</td>
                                            <td>{{ $payment->payment_date ?
                                                \Carbon\Carbon::parse($payment->payment_date)->format('m/d/Y, h:i a') :
                                                '-' }}</td>
                                            <td>{{ number_format($payment->payment_amount ?? 0, 2) }}</td>
                                            <td>{{ $payment->local_currency ?? '-' }}</td>
                                            <td>{{ $payment->currency ?? '-' }}</td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{route('invoices.invoicesdownload',encrypt($invoice->id))}}"><i
                                                                        class="ti ti-file-type-pdf me-2"></i>PDF</a>
                                                            </li>
                                                            {{-- <li>
                                                                <a class="dropdown-item" href="#"><i
                                                                        class="ti ti-trash me-2"></i>Delete</a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No Payments Found</td>
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