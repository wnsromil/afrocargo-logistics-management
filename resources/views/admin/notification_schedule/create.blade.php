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
            <label for="tab2" class="tab-title">Warehouse Managers</label>
            <label for="tab3" class="tab-title">Drivers</label>
            <label for="tab4" class="tab-title">Customer</label>
            <label for="tab5" class="tab-title">Invoice</label>
        </div>


        <!-- Tab content sections -->

        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content1">
            <form action="{{route('admin.notification_schedule.store')}}" method="post" id="AllnotificationForm">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
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

        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content2">
            <form action="{{route('admin.notification_schedule.warehouseManagerStore')}}" method="post"
                id="Warehouse_manager_notificationForm">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="warehouse_id" class="foncolor">Warehouse <i class="text-danger">*</i></label>
                            <select name="warehouse_id" id="warehousemanagerSelect" class="form-control inp select2">
                                <option value="">Select Warehouse Name</option>
                                @foreach($warehouses as $warehouse)
                                    <option {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                        value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger d-none" id="warehouse_manager_Error">Warehouse is
                                required.</small>
                            @error('warehouse_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="warehouse_manager_id" class="foncolor">Warehouse Manager <i
                                    class="text-danger">*</i></label>
                            <select name="warehouse_manager_id" id="warehouse_manager" class="form-control inp select2">
                                <option value="" disabled hidden selected>Select Warehouse Manager</option>
                                <option value="All Warehouse Managers">All Warehouse Managers</option>
                            </select>
                            <small class="text-danger d-none" id="managerError">Warehouse manager is required.</small>
                            @error('warehouse_manager_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="container" class="foncolor">Container</label>
                            <select name="container" class="form-control inp select2">
                                <option value="" disabled hidden selected>Select Container </option>
                                <option>All</option>
                                <option>CNUS00125</option>
                                <option>CNFR00225</option>
                                <option>CNCA00325</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="EndoftheDay_name" class="foncolor">End of the Day</label>
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
                            <label for="Invoice_name" class="foncolor">Invoice</label>
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
                            <label for="bill" class="foncolor">Bill</label>
                            <select name="bill" class="form-control inp select2">
                                <option value="" disabled hidden selected>Select Bill </option>
                                <option>All</option>
                                <option>Paid</option>
                                <option>Balance</option>
                                <option>Due</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <div class="tabs m-0 mw-100">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label class="col737 fw-medium mb-1">Notification Title<i
                                                class="text-danger">*</i></label>
                                        <input type="text" name="notification_title" class="form-control inp"
                                            id="manager_notification_title" placeholder="Enter Notification Title">
                                        <small class="text-danger d-none" id="warehousemanager_titleError">Title is
                                            required.</small>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label for="notification_message" class="col737 fw-medium mb-1">Notification
                                            Message<i class="text-danger">*</i></label>
                                        <textarea type="text" name="notification_message"
                                            class="form-control textarea-w" id="manager_notification_message" rows="4"
                                            placeholder="Enter Your Notification Message"></textarea>
                                        <small class="text-danger d-none" id="warehousemanager_messageError">Message is
                                            required.</small>
                                    </div>
                                </div>
                            </div>
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

        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content3">
            <form action="{{route('admin.notification_schedule.DriverStore')}}" method="post"
                id="Warehouse_driver_notificationForm">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="Warehouse_id" class="foncolor">Warehouse <i class="text-danger">*</i></label>
                            <select name="warehouse_id" id="warehouseDriverSelect" class="form-control inp select2">
                                <option value="">Select Warehouse Name</option>
                                @foreach($warehouses as $warehouse)
                                    <option {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                        value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger d-none" id="driver_warehouse_Error">Warehouse is required.</small>
                            @error('warehouse_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="driver_id" class="foncolor">Driver <i class="text-danger">*</i></label>
                            <select name="driver_id" id="warehouseDriver" class="form-control inp select2">
                                <option value="" disabled hidden selected>Select Warehouse Driver</option>
                                <option value="All Warehouse Drivers">All Warehouse Drivers</option>
                            </select>
                            <small class="text-danger d-none" id="warehouse_driver_Error">Warehouse driver is
                                required.</small>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="Container_name" class="foncolor">Container</label>
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
                            <label for="EndoftheDay_name" class="foncolor">End of the Day</label>
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
                            <label for="Invoice_name" class="foncolor">Invoice</label>
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
                            <label for="bill" class="foncolor">Bill</label>
                            <select name="bill" class="form-control inp select2">
                                <option value="" disabled hidden selected>Select Bill </option>
                                <option>All</option>
                                <option>Paid</option>
                                <option>Balance</option>
                                <option>Due</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label class="foncolor"> Notification Title<i class="text-danger">*</i></label>
                            <input type="text" name="notification_title" id="driver_notification_title"
                                class="form-control inp" placeholder="Enter Notification Title">
                            <small class="text-danger d-none" id="driver_notification_title_Error">Title is
                                required.</small>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="input-block mb-3">
                            <label class="foncolor"> Notification Message<i class="text-danger">*</i></label>
                            <textarea type="text" name="notification_message" id="driver_notification_message"
                                class="form-control textarea-w" rows="4"
                                placeholder="Enter Your Notification Message"></textarea>
                            <small class="text-danger d-none" id="driver_notification_message_Error">Message is
                                required.</small>
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

        <div class="tab-content ps-sm-0 pt-2 pb-0 bg-white" id="content4">
            <form action="{{route('admin.notification_schedule.CustomerStore')}}" method="post"
                id="Warehouse_customer_notificationForm">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="Warehouse_id" class="foncolor">Warehouse <i class="text-danger">*</i></label>
                            <select name="warehouse_id" id="warehouseCustomerSelect" class="form-control inp select2">
                                <option value="">Select Warehouse Name</option>
                                @foreach($warehouses as $warehouse)
                                    <option {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                        value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger d-none" id="customer_warehouse_Error">Warehouse is
                                required.</small>
                            @error('warehouse_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="customer_id" class="foncolor">Customer <i class="text-danger">*</i></label>
                            <select name="customer_id" id="warehouseCustomer" class="form-control inp select2">
                                <option value="" disabled hidden selected>Select Warehouse Customer</option>
                                <option value="All Warehouse Customers">All Warehouse Customers</option>
                            </select>
                            <small class="text-danger d-none" id="warehouse_customer_Error">Customer is
                                required.</small>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="Container_name" class="foncolor">Container</label>
                            <select name="Container_name" class="form-control inp select2">
                                <option value="" disabled hidden selected>Select Container </option>
                                <option>CTN0000125 </option>
                                <option>CTN0000225</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label for="Invoice_name" class="foncolor">Invoice</label>
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
                            <label for="bill" class="foncolor">Bill</label>
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
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label class="foncolor"> Notification Title<i class="text-danger">*</i></label>
                            <input type="text" name="notification_title" id="customer_notification_title"
                                class="form-control inp" placeholder="Enter Notification Title">
                            <small class="text-danger d-none" id="customer_notification_title_Error">Title is
                                required.</small>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="input-block mb-3">
                            <label class="foncolor"> Notification Message<i class="text-danger">*</i></label>
                            <textarea type="text" name="notification_message" id="customer_notification_message"
                                class="form-control textarea-w" rows="4"
                                placeholder="Enter Your Notification Message"></textarea>
                            <small class="text-danger d-none" id="customer_notification_message_Error">Message is
                                required.</small>
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
                <div class="col-lg-6 col-md-6 col-sm-12">
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
            document.getElementById("AllnotificationForm").addEventListener("submit", function (e) {
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

        <script>
            document.getElementById("Warehouse_manager_notificationForm").addEventListener("submit", function (e) {
                let isValid = true;

                const title = document.getElementById("manager_notification_title").value.trim();
                const message = document.getElementById("manager_notification_message").value.trim();
                const warehouseId = document.getElementById("warehousemanagerSelect").value;
                const managerId = document.getElementById("warehouse_manager").value;

                // Warehouse validation
                if (warehouseId === "") {
                    isValid = false;
                    document.getElementById("warehouse_manager_Error").classList.remove("d-none");
                } else {
                    document.getElementById("warehouse_manager_Error").classList.add("d-none");
                }

                // Manager validation
                if (managerId === "") {
                    isValid = false;
                    document.getElementById("managerError").classList.remove("d-none");
                } else {
                    document.getElementById("managerError").classList.add("d-none");
                }

                // Title validation
                if (title === "") {
                    isValid = false;
                    document.getElementById("warehousemanager_titleError").classList.remove("d-none");
                } else {
                    document.getElementById("warehousemanager_titleError").classList.add("d-none");
                }

                // Message validation
                if (message === "") {
                    isValid = false;
                    document.getElementById("warehousemanager_messageError").classList.remove("d-none");
                } else {
                    document.getElementById("warehousemanager_messageError").classList.add("d-none");
                }

                // Stop form submission if validation fails
                if (!isValid) {
                    e.preventDefault();
                }
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#warehousemanagerSelect').on('change', function () {
                    var warehouseId = $(this).val();

                    if (warehouseId) {
                        $.ajax({
                            url: '/api/warehouse-managers/' + warehouseId,
                            type: 'GET',
                            success: function (data) {
                                $('#warehouse_manager').empty();
                                // Clear existing options
                                // Add new driver options

                                $('#warehouse_manager').append('<option value="" disabled hidden selected>Select  Warehouse Manager</option>');
                                $('#warehouse_manager').append('<option value="All Warehouse Managers">All Warehouse Managers</option>');

                                $.each(data.data, function (key, manager) {
                                    var option = '<option value="' + manager.id + '">' + manager.name + '</option>';
                                    $('#warehouse_manager').append(option);
                                });
                                // Refresh Select2 if needed
                                $('#warehouse_manager').trigger('change.select2');
                            }
                        });
                    } else {
                        // Reset if no warehouse selected
                        $('#warehouse_manager').empty().append('<option value="">Select Driver</option>');
                    }
                });
            });
        </script>

        <script>
            document.getElementById("Warehouse_driver_notificationForm").addEventListener("submit", function (e) {
                let isValid = true;

                const title = document.getElementById("driver_notification_title").value.trim();
                const message = document.getElementById("driver_notification_message").value.trim();
                const warehouseId = document.getElementById("warehouseDriverSelect").value;
                const driverId = document.getElementById("warehouseDriver").value;

                // Warehouse validation
                if (warehouseId === "") {
                    isValid = false;
                    document.getElementById("driver_warehouse_Error").classList.remove("d-none");
                } else {
                    document.getElementById("driver_warehouse_Error").classList.add("d-none");
                }

                // Driver validation
                if (driverId === "") {
                    isValid = false;
                    document.getElementById("warehouse_driver_Error").classList.remove("d-none");
                } else {
                    document.getElementById("warehouse_driver_Error").classList.add("d-none");
                }

                // Title validation
                if (title === "") {
                    isValid = false;
                    document.getElementById("driver_notification_title_Error").classList.remove("d-none");
                } else {
                    document.getElementById("driver_notification_title_Error").classList.add("d-none");
                }

                // Message validation
                if (message === "") {
                    isValid = false;
                    document.getElementById("driver_notification_message_Error").classList.remove("d-none");
                } else {
                    document.getElementById("driver_notification_message_Error").classList.add("d-none");
                }

                // Stop form submission if validation fails
                if (!isValid) {
                    e.preventDefault();
                }
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#warehouseDriverSelect').on('change', function () {
                    var warehouseId = $(this).val();

                    if (warehouseId) {
                        $.ajax({
                            url: '/api/warehouse-drivers/' + warehouseId,
                            type: 'GET',
                            success: function (data) {
                                $('#warehouseDriver').empty();
                                // Clear existing options
                                // Add new driver options

                                $('#warehouseDriver').append('<option value="" disabled hidden selected>Select Warehouse Driver</option>');
                                $('#warehouseDriver').append('<option value="All Warehouse Drivers">All Warehouse Drivers</option>');

                                $.each(data.data, function (key, driver) {
                                    var option = '<option value="' + driver.id + '">' + driver.name + '</option>';
                                    $('#warehouseDriver').append(option);
                                });
                                // Refresh Select2 if needed
                                $('#warehouseDriver').trigger('change.select2');
                            }
                        });
                    } else {
                        // Reset if no warehouse selected
                        $('#warehouseDriver').empty().append('<option value="">Select Driver</option>');
                    }
                });
            });
        </script>

        <script>
            document.getElementById("Warehouse_customer_notificationForm").addEventListener("submit", function (e) {
                let isValid = true;

                const title = document.getElementById("customer_notification_title").value.trim();
                const message = document.getElementById("customer_notification_message").value.trim();
                const warehouseId = document.getElementById("warehouseCustomerSelect").value;
                const driverId = document.getElementById("warehouseCustomer").value;

                // Warehouse validation
                if (warehouseId === "") {
                    isValid = false;
                    document.getElementById("customer_warehouse_Error").classList.remove("d-none");
                } else {
                    document.getElementById("customer_warehouse_Error").classList.add("d-none");
                }

                // Driver validation
                if (driverId === "") {
                    isValid = false;
                    document.getElementById("warehouse_customer_Error").classList.remove("d-none");
                } else {
                    document.getElementById("warehouse_customer_Error").classList.add("d-none");
                }

                // Title validation
                if (title === "") {
                    isValid = false;
                    document.getElementById("customer_notification_title_Error").classList.remove("d-none");
                } else {
                    document.getElementById("customer_notification_title_Error").classList.add("d-none");
                }

                // Message validation
                if (message === "") {
                    isValid = false;
                    document.getElementById("customer_notification_message_Error").classList.remove("d-none");
                } else {
                    document.getElementById("customer_notification_message_Error").classList.add("d-none");
                }

                // Stop form submission if validation fails
                if (!isValid) {
                    e.preventDefault();
                }
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#warehouseCustomerSelect').on('change', function () {
                    var warehouseId = $(this).val();

                    if (warehouseId) {
                        $.ajax({
                            url: '/api/warehouse-customers/' + warehouseId,
                            type: 'GET',
                            success: function (data) {
                                $('#warehouseCustomer').empty();
                                // Clear existing options
                                // Add new customer options

                                $('#warehouseCustomer').append('<option value="" disabled hidden selected>Select Warehouse Customer</option>');
                                $('#warehouseCustomer').append('<option value="All Warehouse Customers">All Warehouse Customers</option>');

                                $.each(data.data, function (key, customer) {
                                    var option = '<option value="' + customer.id + '">' + customer.name + " " + customer.last_name + '</option>';
                                    $('#warehouseCustomer').append(option);
                                });
                                // Refresh Select2 if needed
                                $('#warehouseCustomer').trigger('change.select2');
                            }
                        });
                    } else {
                        // Reset if no warehouse selected
                        $('#warehouseCustomer').empty().append('<option value="">Select Customer</option>');
                    }
                });
            });
        </script>

    @endsection
</x-app-layout>