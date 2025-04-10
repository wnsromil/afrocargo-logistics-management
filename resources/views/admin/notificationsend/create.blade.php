<x-app-layout>
    <x-slot name="header">
        Parcel Management
    </x-slot>

    <x-slot name="cardTitle">
        <p class="fw-semibold">Send Notification</p>

    </x-slot>
    <p class="text-dark fw-medium mb-2">Notification For</p>

    <div class="tabs">
        <!-- Radio buttons for tab control -->
        <input type="radio" id="tab1" name="tab" checked>
        <input type="radio" id="tab2" name="tab">
        <input type="radio" id="tab3" name="tab">
        <input type="radio" id="tab4" name="tab">

        <!-- Tab titles (labels) -->
        <!-- <div class="tab-titles">
            <label for="tab1" class="tab-title">All</label>
            <label for="tab2" class="tab-title">Warehouses</label>
            <label for="tab3" class="tab-title">Users</label>
            <label for="tab4" class="tab-title">Driver</label>
        </div> -->

        <div class="tab-titles">
            <label for="tab1" class="tab-title">All</label>
            <label for="tab2" class="tab-title">Warehouses</label>
            <label for="tab3" class="tab-title">Users</label>
            <label for="tab4" class="tab-title">Driver</label>
        </div>


        <!-- ------------------- All ------------------ -->

        <!-- Tab content sections -->
        <div class="tab-content" id="content1">
            <div class="col-lg-4 col-md-4 col-sm-4 pe-4">
                <div class="input-block mb-3">
                    <label class="col737 fw-medium mb-1">Notification Title<i class="text-danger">*</i></label>
                    <input type="text" name="notification_title" class="form-control inp"
                        placeholder="Enter Notification Title">
                </div>
            </div>
            <div class="col-lg-11 col-md-6 col-sm-12">
                <div class="input-block mb-3">
                    <label for="notification_message" class="col737 fw-medium mb-1">Notification Message<i
                            class="text-danger">*</i></label>
                    <textarea type="text" name="notification_message" class="form-control textarea-w"
                        id="notification_message" rows="4" placeholder="Enter Your Notification Message"></textarea>

                </div>
            </div>

            <div class="ptop ps-2 d-flex">
                <div class="input-block mb-3">
                    <label for="status1" class="col737 fw-medium">Status</label>
                    <div class="status-toggle d-flex align-items-center">
                        <span class="status-label active-label">Active</span>
                        <input id="status1" class="check status-toggle-input" type="checkbox" name="status1">
                        <label for="status1" class="checktoggle checkbox-bg togc"></label>
                        <span class="status-label inactive-label faded">Inactive</span>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-top:22px;">
                    <div class="add-customer-btns ">
                        <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----------------------------- Warehouses ---------------------------------- -->

        <div class="tab-content" id="content2" style="padding:0">
            <div class="col-lg-4 col-md-4 col-sm-4 pe-4">
                <div class="input-block mb-4">
                    <label for="warehouse_name mb" class="col737 mb-0">Warehouse <i class="text-danger">*</i></label>
                    <select name="warehouse_name" class="form-control inp select2">
                        <option value="">Select Warehouse </option>
                        <option></option>
                        <option></option>
                    </select>
                </div>
                <div class="input-block mb-4">
                    <p class="text-dark fw-medium my-2">Notification For</p>
                    <div class="tab-titles">
                        <button class="tab-title">Manager</button>
                        <button class="tab-title bg-dark text-light">Driver</button>
                    </div>
                </div>
                <div class="input-block mb-4">
                    <label for="warehouse_name" class="col737 mb-0">Driver <i class="text-danger">*</i></label>
                    <select name="warehouse_name" class="form-control inp select2">
                        <option value="">Select Drivers </option>
                        <option>All</option>
                        <option>John Snow</option>
                        <option>Tranity Scoop</option>
                    </select>
                </div>

                <div class="input-block mb-4">
                    <label class="col737 mb-1"> Notification Title<i class="text-danger">*</i></label>
                    <input type="text" name="notification_title" class="form-control inp"
                        placeholder="Enter Notification Title">
                </div>
                <div class="col-lg-11 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="notification_message" class="col737 mb-1">Notification Message<i
                                class="text-danger">*</i></label>
                        <textarea type="text" name="notification_message" class="form-control textarea-w"
                            id="notification_message" rows="4" placeholder="Enter Your Notification Message"></textarea>
                    </div>
                </div>
            </div>

            <div class="ptop ps-2 d-flex">
                <div class="input-block mb-3">
                    <label for="status1" class="col737 fw-medium">Status</label>
                    <div class="status-toggle d-flex align-items-center">
                        <span class="status-label active-label">Active</span>
                        <input id="status2" class="check status-toggle-input" type="checkbox" name="status1">
                        <label for="status2" class="checktoggle checkbox-bg togc"></label>
                        <span class="status-label inactive-label">Inactive</span>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <div class="add-customer-btns ">
                        <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ---------------------------- Users --------------------------- -->

        <div class="tab-content" id="content3">
            <div class="col-md-12 d-flex flex-wrap">
                <div class="col-lg-6 col-md-6 col-sm-6 pe-4">
                    <div class="input-block mb-4">
                        <label for="warehouse_name mb" class="col737 mb-0">Warehouse <i
                                class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse </option>
                            <option></option>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 pe-4">
                    <div class="input-block mb-4">
                        <label for="warehouse_name mb" class="col737 mb-0">Users <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Users </option>
                            <option>All</option>
                            <option>Awen Chirst</option>
                            <option>Megan Monie</option>
                            <option>Joisha Aboa</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 pe-4">
                <div class="input-block mb-4">
                    <label for="warehouse_name mb" class="col737 mb-0">Container <i class="text-danger">*</i></label>
                    <select name="warehouse_name" class="form-control inp select2 ps-3">
                        <option value="">Select Container </option>
                        <option>001-257</option>
                        <option>001-258</option>
                        <option>001-259</option>
                        <option>001-260</option>

                    </select>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 pe-4">
                <div class="input-block mb-4">
                    <label class="col737 mb-1"> Notification Title<i class="text-danger">*</i></label>
                    <input type="text" name="notification_title" class="form-control inp"
                        placeholder="Enter Notification Title">
                </div>
            </div>

            <div class="col-lg-11 col-md-6 col-sm-12">
                <div class="input-block mb-3">
                    <label for="notification_message" class="col737 mb-1">Notification Message<i
                            class="text-danger">*</i></label>
                    <textarea type="text" name="notification_message" class="form-control textarea-w"
                        id="notification_message" rows="4" placeholder="Enter Your Notification Message"></textarea>
                </div>
            </div>
            <div class="ptop ps-2 d-flex">
                <div class="input-block mb-3">
                    <label for="status1" class="col737 fw-medium">Status</label>
                    <div class="status-toggle d-flex align-items-center">
                        <span class="status-label active-label">Active</span>
                        <input id="status3" class="check status-toggle-input" type="checkbox" name="status1">
                        <label for="status3" class="checktoggle checkbox-bg togc"></label>
                        <span class="status-label inactive-label">Inactive</span>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-top:22px;">
                    <div class="add-customer-btns ">
                        <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ---------------------------- Driver --------------------------- -->
        <div class="tab-content" id="content4">
            <div class="col-md-12 d-flex flex-wrap">
                <div class="col-lg-6 col-md-6 col-sm-6 pe-4">
                    <div class="input-block mb-4">
                        <label for="warehouse_name mb" class="col737 mb-0">Warehouse <i
                                class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Warehouse </option>
                            <option></option>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 pe-4">
                    <div class="input-block mb-4">
                        <label for="warehouse_name mb" class="col737 mb-0">Users <i class="text-danger">*</i></label>
                        <select name="warehouse_name" class="form-control inp select2">
                            <option value="">Select Users </option>
                            <option>All</option>
                            <option>Awen Chirst</option>
                            <option>Megan Monie</option>
                            <option>Joisha Aboa</option>
                            <option>Mike Monty</option>
                            <option>Gerald Steve</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 pe-4">
                <div class="input-block mb-4">
                    <label class="col737 mb-1"> Notification Title<i class="text-danger">*</i></label>
                    <input type="text" name="notification_title" class="form-control inp"
                        placeholder="Enter Notification Title">
                </div>
            </div>

            <div class="col-lg-11 col-md-6 col-sm-12">
                <div class="input-block mb-3">
                    <label for="notification_message" class="col737 mb-1">Notification Message<i
                            class="text-danger">*</i></label>
                    <textarea type="text" name="notification_message" class="form-control textarea-w"
                        id="notification_message" rows="4" placeholder="Enter Your Notification Message"></textarea>
                </div>
            </div>
            <div class="ptop ps-2 d-flex">
                <div class="input-block mb-3">
                    <label for="status1" class="col737 fw-medium">Status</label>
                    <div class="status-toggle d-flex align-items-center">
                        <span class="status-label active-label">Active</span>
                        <input id="status4" class="check status-toggle-input" type="checkbox" name="status1">
                        <label for="status4" class="checktoggle checkbox-bg togc"></label>
                        <span class="status-label inactive-label faded">Inactive</span>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div style="margin-top:22px;">
                    <div class="add-customer-btns ">
                        <button type="button" class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggles = document.querySelectorAll(".status-toggle-input");

            toggles.forEach((toggle) => {
                toggle.addEventListener("change", function () {
                    const parent = toggle.closest(".status-toggle");
                    const activeLabel = parent.querySelector(".inactive-label");
                    const inactiveLabel = parent.querySelector(".active-label");

                    if (toggle.checked) {
                        activeLabel.classList.remove("faded");
                        inactiveLabel.classList.add("faded");
                    } else {
                        activeLabel.classList.add("faded");
                        inactiveLabel.classList.remove("faded");
                    }
                });
                toggle.dispatchEvent(new Event('change'));
            });
        });
    </script>

</x-app-layout>