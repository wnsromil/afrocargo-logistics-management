<x-app-layout>
    <x-slot name="header">
        Send Notification
    </x-slot>

    <x-slot name="cardTitle">
        <p>Send Notification</p>

    </x-slot>
    <p>Notification For</p>

    <div class="tabs mw-100">
        <input type="radio" id="tab1" name="tab" checked>
        <input type="radio" id="tab2" name="tab">
        <input type="radio" id="tab3" name="tab">
        <input type="radio" id="tab4" name="tab">
        <input type="radio" id="tab5" name="tab">
        <div class="tab-titles mt-1">
            <label for="tab1" class="tab-title">All</label>
            <label for="tab2" class="tab-title">Warehouses</label>
            <label for="tab3" class="tab-title">Customer</label>
            <label for="tab4" class="tab-title">Drivers</label>
            <label for="tab5" class="tab-title">Invoice</label>
        </div>


        <!-- Tab content sections -->

        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content1">
            <form action="{{route('admin.notification_schedule.store')}}" method="post" id="notificationForm">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label class="foncolor"> Notification Title <i class="text-danger">*</i></label>
                            <input type="text" name="notification_title" id="notification_title"
                                class="form-control inp" placeholder="Enter Notification Title">
                            <small class="text-danger d-none" id="titleError">Title is required.</small>
                        </div>
                    </div>
                    <div class="col-lg-9 me-lg-5 col-md-12 col-sm-12">
                        <div class="input-block mb-3">
                            <label class="foncolor"> Notification Message <i class="text-danger">*</i></label>
                            <textarea name="notification_message" id="notification_message" class="form-control inp"
                                placeholder="Enter Your Notification Message"></textarea>
                            <small class="text-danger d-none" id="messageError">Message is required.</small>
                        </div>
                    </div>
                </div>
                <div class="ptop d-flex" style="justify-self: right;">
                    <div>
                        <div class="add-customer-btns">
                            <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content2" style="padding:0">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="warehouse_name" class="foncolor">Warehouse <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                                <option {{ old('warehouse_name') == $warehouse->id ? 'selected' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="container" class="foncolor">Container <i class="text-danger">*</i></label>
                        <select name="container" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Containers </option>
                            <option>All</option>
                            <option>CNUS00125</option>
                            <option>CNFR00225</option>
                            <option>CNCA00325</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Customer_name" class="foncolor">Customer <i class="text-danger">*</i></label>
                        <select name="Customer_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Customer </option>
                            <option>All</option>
                            <option>Lucas</option>
                            <option>Kiran</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="EndoftheDay_name" class="foncolor">End of the Day <i
                                class="text-danger">*</i></label>
                        <select name="EndoftheDay_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select End of the Days </option>
                            <option>All</option>
                            <option>000128</option>
                            <option>000129</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Invoice_name" class="foncolor">Invoice <i class="text-danger">*</i></label>
                        <select name="Invoice_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Invoice </option>
                            <option>All</option>
                            <option>INV000012</option>
                            <option>INV000013</option>
                            <option>INV000014</option>
                            <option>INV000015</option>
                            <option>INV000016</option>
                            <option>INV000017</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="bill" class="foncolor">Bill <i class="text-danger">*</i></label>
                        <select name="bill" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Bill </option>
                            <option>All</option>
                            <option>Paid</option>
                            <option>Balance</option>
                            <option>Due</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 mt-3 col-sm-12">
                    <div class="tabs m-0 mw-100">
                        <input type="radio" id="tab6" name="tabs" checked>
                        <input type="radio" id="tab7" name="tabs">
                        <div class="tab-titles">
                            <label for="tab6" class="tab-title">Manager</label>
                            <label for="tab7" class="tab-title">Driver</label>
                        </div>
                        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content6">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12 pe-sm-0">
                                    <div class="input-block mb-3">
                                        <label for="Manager_name" class="foncolor">Manager <i
                                                class="text-danger">*</i></label>
                                        <select name="Manager_name" class="form-control inp select2">
                                            <option value="">Select Managers </option>
                                            <option>Peter </option>
                                            <option>Markus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 me-sm-5 col-md-6 col-sm-12 pe-sm-0">
                                    <div class="input-block mb-3">
                                        <label class="foncolor">Notification Title<i class="text-danger">*</i></label>
                                        <input type="text" name="notification_title" class="form-control inp"
                                            placeholder="Enter Notification Title">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label for="notification_message" class="foncolor">Notification Message<i
                                                class="text-danger">*</i></label>
                                        <textarea type="text" name="notification_message"
                                            class="form-control textarea-w" id="notification_message" rows="4"
                                            placeholder="Enter Your Notification Message"></textarea>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content7">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12 pe-sm-0">
                                    <div class="input-block mb-3">
                                        <label for="Driver_name" class="foncolor">Driver <i
                                                class="text-danger">*</i></label>
                                        <select name="Driver_name" class="form-control inp select2">
                                            <option value="">Select Drivers </option>
                                            <option>Peter </option>
                                            <option>Markus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 me-sm-5 col-md-6 col-sm-12 pe-sm-0">
                                    <div class="input-block mb-3">
                                        <label class="col737 fw-medium mb-1">Notification Title<i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="notification_title" class="form-control inp"
                                            placeholder="Enter Notification Title">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label for="notification_message" class="col737 fw-medium mb-1">Notification
                                            Message<i class="text-danger">*</i></label>
                                        <textarea type="text" name="notification_message"
                                            class="form-control textarea-w" id="notification_message" rows="4"
                                            placeholder="Enter Your Notification Message"></textarea>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content3">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Container_name" class="foncolor">Container <i class="text-danger">*</i></label>
                        <select name="Container_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Container </option>
                            <option>All</option>
                            <option>CTN0000125 </option>
                            <option>CTN0000225</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Customer_name" class="foncolor">Customer <i class="text-danger">*</i></label>
                        <select name="Customer_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Customer </option>
                            <option>All</option>
                            <option>Lucas</option>
                            <option>Kiran</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="EndoftheDay_name" class="foncolor">End of the Day <i
                                class="text-danger">*</i></label>
                        <select name="EndoftheDay_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select End of the Days </option>
                            <option>All</option>
                            <option>000128</option>
                            <option>000129</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Invoice_name" class="foncolor">Invoice <i class="text-danger">*</i></label>
                        <select name="Invoice_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Invoice </option>
                            <option>All</option>
                            <option>INV000012</option>
                            <option>INV000013</option>
                            <option>INV000014</option>
                            <option>INV000015</option>
                            <option>INV000016</option>
                            <option>INV000017</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="bill" class="foncolor">Bill <i class="text-danger">*</i></label>
                        <select name="bill" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Bill </option>
                            <option>All</option>
                            <option>Paid</option>
                            <option>Balance</option>
                            <option>Due</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 me-lg-5">
                    <div class="input-block mb-3">
                        <label class="foncolor"> Notification Title<i class="text-danger">*</i></label>
                        <input type="text" name="notification_title" class="form-control inp"
                            placeholder="Enter Notification Title">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor"> Notification Message<i class="text-danger">*</i></label>
                        <textarea type="text" name="notification_message" class="form-control textarea-w"
                            id="notification_message" rows="4" placeholder="Enter Your Notification Message"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content4">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Warehouse_name" class="foncolor">Warehouse <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse Name</option>
                            @foreach($warehouses as $warehouse)
                                <option {{ old('warehouse_name') == $warehouse->id ? 'selected' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Container_name" class="foncolor">Container <i class="text-danger">*</i></label>
                        <select name="Container_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Container </option>
                            <option>All</option>
                            <option>CTN0000125 </option>
                            <option>CTN0000225</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Driver_name" class="foncolor">Driver <i class="text-danger">*</i></label>
                        <select name="Driver_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Drivers </option>
                            <option>Lucas</option>
                            <option>Kiran</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="EndoftheDay_name" class="foncolor">End of the Day <i
                                class="text-danger">*</i></label>
                        <select name="EndoftheDay_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select End of the Days </option>
                            <option>All</option>
                            <option>000128</option>
                            <option>000129</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Invoice_name" class="foncolor">Invoice <i class="text-danger">*</i></label>
                        <select name="Invoice_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Invoice </option>
                            <option>All</option>
                            <option>INV000012</option>
                            <option>INV000013</option>
                            <option>INV000014</option>
                            <option>INV000015</option>
                            <option>INV000016</option>
                            <option>INV000017</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="bill" class="foncolor">Bill <i class="text-danger">*</i></label>
                        <select name="bill" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Bill </option>
                            <option>All</option>
                            <option>Paid</option>
                            <option>Balance</option>
                            <option>Due</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 me-lg-5">
                    <div class="input-block mb-3">
                        <label class="foncolor"> Notification Title<i class="text-danger">*</i></label>
                        <input type="text" name="notification_title" class="form-control inp"
                            placeholder="Enter Notification Title">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor"> Notification Message<i class="text-danger">*</i></label>
                        <textarea type="text" name="notification_message" class="form-control textarea-w"
                            id="notification_message" rows="4" placeholder="Enter Your Notification Message"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content5">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Container_name" class="foncolor">Container <i class="text-danger">*</i></label>
                        <select name="Container_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Container </option>
                            <option>All</option>
                            <option>CTN0000125 </option>
                            <option>CTN0000225</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Invoice_name" class="foncolor">Invoice <i class="text-danger">*</i></label>
                        <select name="Invoice_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Invoice </option>
                            <option>All</option>
                            <option>INV000012</option>
                            <option>INV000013</option>
                            <option>INV000014</option>
                            <option>INV000015</option>
                            <option>INV000016</option>
                            <option>INV000017</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Driver_name" class="foncolor">Driver <i class="text-danger">*</i></label>
                        <select name="Driver_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Drivers </option>
                            <option>Lucas</option>
                            <option>Kiran</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="Customer_name" class="foncolor">Customer <i class="text-danger">*</i></label>
                        <select name="Customer_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Customer </option>
                            <option>All</option>
                            <option>Lucas</option>
                            <option>Kiran</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="EndoftheDay_name" class="foncolor">End of the Day <i
                                class="text-danger">*</i></label>
                        <select name="EndoftheDay_name" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select End of the Days </option>
                            <option>All</option>
                            <option>000128</option>
                            <option>000129</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="bill" class="foncolor">Bill <i class="text-danger">*</i></label>
                        <select name="bill" class="form-control inp select2">
                            <option value="" disabled hidden selected>Select Bill </option>
                            <option>All</option>
                            <option>Paid</option>
                            <option>Balance</option>
                            <option>Due</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 me-lg-5">
                    <div class="input-block mb-3">
                        <label class="foncolor"> Notification Title<i class="text-danger">*</i></label>
                        <input type="text" name="notification_title" class="form-control inp"
                            placeholder="Enter Notification Title">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor"> Notification Message<i class="text-danger">*</i></label>
                        <textarea type="text" name="notification_message" class="form-control textarea-w"
                            id="notification_message" rows="4" placeholder="Enter Your Notification Message"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            document.getElementById("notificationForm").addEventListener("submit", function (e) {
                let isValid = true;

                const title = document.getElementById("notification_title").value.trim();
                const message = document.getElementById("notification_message").value.trim();

                // Title validation
                if (title === "") {
                    isValid = false;
                    document.getElementById("titleError").classList.remove("d-none");
                } else {
                    document.getElementById("titleError").classList.add("d-none");
                }

                // Message validation
                if (message === "") {
                    isValid = false;
                    document.getElementById("messageError").classList.remove("d-none");
                } else {
                    document.getElementById("messageError").classList.add("d-none");
                }

                // Stop form submission if validation fails
                if (!isValid) {
                    e.preventDefault();
                }
            });
        </script>

    @endsection
</x-app-layout>