// old

var supplyItems = {};
var pickupAddress = {};
var deliveryAddress = {};
var currentRow = null;
var invoce_type = "services";

function toggleLoginForm(type) {
    if (type === "services") {
        // document.getElementById('services').style.display = 'block';
        // document.getElementById('supplies').style.display = 'none';
        document.getElementById("servicesBtn").classList.add("active3");
        document.getElementById("suppliesBtn").classList.remove("active3");

        $('input[name="invoce_type"]').val("services");
        invoce_type = "services";

        $("#addShiptoAddress")
            .removeClass("disabled")
            .css("pointer-events", "auto")
            .css("opacity", "1");

        $("#ship_customer").prop("disabled", false);

        // $("#supplies_items").addClass("d-none");
        $("#description_services_items").removeClass("d-none");
        $("#weight_services_items").removeClass("d-none");
        if($('input[name="transport_type"]').val() =='air'){
            $('select[name="container_id"]').prop("disabled", true);
        }else{
            $('select[name="container_id"]').prop("disabled", false);
        }
    } else if (type === "supplies") {
        // document.getElementById('services').style.display = 'none';
        // document.getElementById('supplies').style.display = 'block';
        document.getElementById("servicesBtn").classList.remove("active3");
        document.getElementById("suppliesBtn").classList.add("active3");

        $('input[name="invoce_type"]').val("supplies");
        invoce_type = "supplies";

        $("#addShiptoAddress")
            .addClass("disabled") // Add a visual cue
            .css("pointer-events", "none") // Disable clicking
            .css("opacity", "0.6"); // Optional: faded look

        $("#ship_customer").prop("disabled", true);

        // $("#supplies_items").removeClass("d-none");
        $("#description_services_items").addClass("d-none");
        $("#weight_services_items").addClass("d-none");
        $('select[name="container_id"]') // optional: if you use this class for styling
            .prop("disabled", true) // this is essential
            .css("pointer-events", "auto") // optional: restores interaction if previously styled with pointer-events
            .css("opacity", "1"); // optional: restores visual state
    }
}

$('input[name="transport_type"]').on("click", function () {
    const transportType = $(this).val();
    console.log("Transport Type:", transportType);
    if (transportType == "air") {
        $('select[name="container_id"]')
        .prop("disabled", true) // this is essential
            .css("pointer-events", "auto") // optional: restores interaction if previously styled with pointer-events
            .css("opacity", "1"); // optional: restores visual state
    }
    else {
        $('select[name="container_id"]').prop("disabled", false);
    }
});

window.onload = function () {
    // const urlParams = new URLSearchParams(window.location.search);
    // const formType = urlParams.get('id') || 'services';
    // toggleLoginForm(formType);
    setTimeout(() => {
        console.log("invoce_typ", invoce_type);
        toggleLoginForm(invoce_type);
        if($('input[name="transport_type"]').val()!='air'){
            $('select[name="container_id"]')
            .prop("disabled", true) // this is essential
            .css("pointer-events", "auto") // optional: restores interaction if previously styled with pointer-events
            .css("opacity", "1"); // optional: restores visual state
        }else{
            $('select[name="container_id"]').prop("disabled", false);
        }
    }, 600);
};

document.getElementById("addCustomer").onclick = () => {
    // it's deliver address code
    document.querySelector(".newCustomerAdd").classList.toggle("none");
};

$("#addCustomer").on("click", function () {
    $(".newCustomerAdd").toggleClass("none");
    $(this).addClass("d-none");
    $("#add_delevery_save_body").removeClass("d-none");
});

$("#add_delevery_cancel").on("click", function () {
    $(".newCustomerAdd").toggleClass("none");
    $("#add_delevery_save_body").addClass("d-none");
    $("#addCustomer").removeClass("d-none");
});

$("#addShiptoAddress").on("click", function () {
    $(".newShipmentAddress").toggleClass("none");
    $(this).addClass("d-none");
    $("#add_ship_save_body").removeClass("d-none");
});

$("#add_ship_cancel").on("click", function () {
    $(".newShipmentAddress").toggleClass("none");
    $("#add_ship_save_body").addClass("d-none");
    $("#addShiptoAddress").removeClass("d-none");
});

// plus minus adding row
document.addEventListener("DOMContentLoaded", function () {
    // Add new row
    $(document).on("click", ".addBtn", function () {
        var row = $(this).closest("tr");
        var newRow = row.clone();

        // Clear input values in new row
        newRow.find("input").val("");
        newRow.find("select").val("");
        newRow.find(".qty-input").val("1");

        // Hide add button in current row and show in new row
        row.find(".addBtn").hide();
        newRow.find(".addBtn").show();

        row.after(newRow);
        initializeRowEvents(newRow);
    });

    // Delete row - Modified version
    $(document).on("click", ".dltBtn:not(.detele)", function () {
        if ($("#dynamicTable tbody tr").length > 1) {
            var $row = $(this).closest("tr");
            $row.remove();
            updateSummary();
            // Ensure the new last row shows the add button
            $("#dynamicTable tbody tr:last").find(".addBtn").show();
        } else {
            alert("You must keep at least one row!");
        }
    });

    // Quantity plus/minus
    $(document).on("click", ".qty-plus", function () {
        var input = $(this).siblings(".qty-input");
        var value = parseInt(input.val()) || 0;
        input.val(value + 1);
        calculateRow($(this).closest("tr"));
    });

    $(document).on("click", ".qty-minus", function () {
        var input = $(this).siblings(".qty-input");
        var value = parseInt(input.val()) || 0;
        if (value > 1) {
            input.val(value - 1);
            calculateRow($(this).closest("tr"));
        }
    });

    // Edit button functionality
    $(document).on("click", ".editBtn", function () {
        var row = $(this).closest("tr");
        row.find("input, select").prop("readonly", function (i, readonly) {
            return !readonly;
        });
        $(this).toggleClass("btn-secondary btn-success");
    });

    // Calculate row when inputs change
    $(document).on(
        "input",
        ".price-input, .qty-input, .discount-input, .tax-input",
        function () {
            calculateRow($(this).closest("tr"));
        }
    );

    // Initialize events for first row
    initializeRowEvents($("#dynamicTable tbody tr:first"));

    function initializeRowEvents(row) {
        // Initialize select2 if needed
        // row.find('.select2').select2();

        // Hide add button if it's not the last row
        if (row.next("tr").length > 0) {
            row.find(".addBtn").hide();
        }
    }

    function calculateRow(row) {
        var qty = parseFloat(row.find(".qty-input").val()) || 0;
        var price = parseFloat(row.find(".price-input").val()) || 0;
        var discount = parseFloat(row.find(".discount-input").val()) || 0;
        var tax = parseFloat(row.find(".tax-input").val()) || 0;

        // Calculate value (qty * price)
        var value = qty * price;
        row.find(".value-input").val(value.toFixed(2));

        // Calculate total (value - discount + tax)
        var total = value - discount;
        total = total + total * (tax / 100);
        row.find(".total-input").val(total.toFixed(2));
    }
});

$(document).ready(function () {
    // Initialize Select2 for customer search
    var address_type = "pickup";
    $(".middleDiv").on("click", (e) => {
        address_type =
            $(e.currentTarget).find('input[name="type"]').val() ?? "pickup";
        console.log("address_type", address_type);
    });

    $('select[name="customer_id"]').select2({
        ajax: {
            url: "/customerSearch",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                    address_type: address_type,
                    invoice_type: invoce_type,
                };
            },
            processResults: function (data) {
                return {
                    results: data.data.map(function (customer) {
                        if (customer.address_type == "pickup") {
                            return {
                                id: customer.pickup_address.id ?? '',
                                text: customer.pickup_address.text ?? '',
                                customer: customer ?? '', // Store the full customer object
                            };
                        } else  if (customer.delivery_address){
                            return {
                                id: customer.delivery_address.id ?? '',
                                text: customer.delivery_address.text ?? '',
                                customer: customer ?? '', // Store the full customer object
                            };
                        }else{
                            return false;
                        }
                         // Return false if no address type matches
                    }).filter((i) => i), // Filter out any empty results
                };
            },
            cache: true,
        },
        placeholder: "Search Customer",
        minimumInputLength: 1,
    });

    $('select[name="customer_id"]').on("select2:select", function (e) {
        var data = e.params.data;
        var customer = data.customer;
         $('input[name="parcel_id"]').val(customer.id);

        // if (customer.invoice_type == "Supply" && customer.parcel_inventory) {
            $('input[name="invoce_item"]').val(customer.parcel_inventory);
            $('input[name="transport_type"]').val(customer.transport_type);

            let inventoryItems = customer.parcel_inventory; // assuming this is an array of objects

            // Show table if hidden
            // $("#supplies_items").removeClass("d-none");

            // Clear existing rows
            $("#dynamicTable tbody").empty();
            if(inventoryItems && inventoryItems.length > 0){
                // Loop through inventory items and create rows
            inventoryItems.forEach((item, index) => {
                let newRow = `
                <tr>
                    <td class="mwidth open-supply-modal">
                        <div class="d-flex align-items-center">
                            <input type="text" name="supply_name" value="${
                                item.inventory_name || ""
                            }" class="selected-supply-name form-control tdbor inputcolor">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#supplyModal" class="btn iconbtn p-0">
                                <i class="ti ti-chevron-down"></i>
                            </button>
                        </div>
                        <input type="hidden" name="supply_id" value="${
                            item.id || ""
                        }">
                    </td>
                    <td><input type="text" class="form-control tdbor inputcolor qty-input" name="qty" value="${
                        item.inventorie_item_quantity || 0
                    }"></td>
                    <td><input type="text" class="form-control tdbor inputcolor" name="label_qty" value="${
                        item.label_qty || 0
                    }"></td>
                    <td>
                        <div class="d-flex align-items-center priceInput">
                            <input type="text" class="form-control inputcolor price-input" name="price" value="${
                                item.price || 0
                            }">
                            <button type="button" class="btn btn-secondary p-0 flat-btn"><i class="ti ti-circle-plus col737"></i></button>
                        </div>
                    </td>
                    <td><input type="text" class="form-control tdbor inputcolor value-input" name="value" value="${
                        item.value || 0
                    }"></td>
                    <td><input type="text" class="form-control tdbor inputcolor" name="ins" value="${
                        item.ins || 0
                    }"></td>
                    <td><input type="text" class="form-control tdbor inputcolor discount-input" name="discount" value="${
                        item.discount || 0
                    }"></td>
                    <td><input type="text" class="form-control tdbor inputcolor tax-input" name="tax" value="${
                        item.tax || 0
                    }"></td>
                    <td><input type="text" class="form-control tdbor inputcolor total-input" name="total" value="${
                        item.total || 0
                    }"></td>
                    <td>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger iconBtn dltBtn"><i class="ti ti-minus"></i></button>
                            <button type="button" class="btn btn-primary iconBtn addBtn ${
                                index !== inventoryItems.length - 1
                                    ? "d-none"
                                    : ""
                            }"><i class="ti ti-plus"></i></button>
                            <button type="button" class="btn btn-secondary iconBtn editBtn"><i class="ti ti-edit"></i></button>
                        </div>
                    </td>
                </tr>
            `;

                $("#dynamicTable tbody").append(newRow);
            });
            }else{
                $("#dynamicTable tbody").append(`<tr>
                                    <td class="mwidth open-supply-modal">
                                        <div class="d-flex align-items-center">
                                            <input type="text" name="supply_name"
                                                class="selected-supply-name form-control tdbor inputcolor">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#supplyModal"
                                                class="btn iconbtn p-0">
                                                <i class="ti ti-chevron-down"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="supply_id">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="qty"></td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="label_qty"></td>
                                    <td>
                                        <div class="d-flex align-items-center priceInput"><input type="text"
                                                class="form-control inputcolor" placeholder="" name="price"><button
                                                type="button" class="btn btn-secondary p-0 flat-btn"><i
                                                    class="ti ti-circle-plus col737"></i></button></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="value">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="ins"></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="discount"></td>
                                    <td><input type="text" class="form-control tdbor inputcolor " placeholder=""
                                            name="tax"></td>
                                    <td><input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="total"></td>
                                    <td>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-danger iconBtn dltBtn"><i
                                                    class="ti ti-minus"></i></button>
                                            <button type="button" class="btn btn-primary iconBtn addBtn"><i
                                                    class="ti ti-plus"></i></button>
                                            <button type="button" class="btn btn-secondary iconBtn editBtn"><i
                                                    class="ti ti-edit"></i></button>
                                        </div>
                                    </td>

                                </tr>`);
            }

            // Recalculate totals
            setTimeout(() => {
                $("#dynamicTable tbody tr").each(function () {
                    const row = $(this);
                    syncSummary(row);
                });
            }, 100); // Adjust the timeout as needed
        // }else{
            $('input[name="descriptions"]').val(customer.descriptions);
            $('input[name="weight"]').val(customer.weight);
            $('input[name="parcel_id"]').val(customer.parcel_id);
        // }

        if (customer.delivery_address) {
            setPickupDeleveryFormValue(customer.delivery_address);
        }

        if (customer.pickup_address) {
            setPickupDeleveryFormValue(customer.pickup_address);
        }
    });

    // Toggle new customer form
    $("#addCustomer").click(function () {
        $(".newCustomerAdd").toggleClass("disablesectionnew");
    });
});

function setPickupDeleveryFormValue(customer) {
    console.log("customer=>", customer);
    // Fill the form fields with customer data
    let userAddress = "";
    if (customer) {
        userAddress =
            customer.address_type == "pickup"
                ? $("#ship_to_address")
                : $("#pick_up");
        // Split full name into first and last name
        // var names = customer.full_name.split(' ');
        // var firstName = names[0];
        // var lastName = names.length > 1 ? names.slice(1).join(' ') : '';
        let newOption = new Option(customer.text, customer.id, true, true);

        if (customer.address_type == "pickup") {
            $('input[name="pickup_address_id"]').val(customer.id);

            // Add new option if not already present
            $("#ship_customer").append(newOption).trigger("change");
        } else {
            $('input[name="delivery_address_id"]').val(customer.id);
            // delevery select box
            // Add new option if not already present
            $("#delevery_customer_id").append(newOption).trigger("change");
        }

        // Fill the form fields
        let nm = customer.full_name ? customer.full_name.trim().split(" ") : "";

        let last_name = nm.length > 1 ? nm[nm.length - 1] : null;
        let first_name =
            nm.length > 1 ? nm.slice(0, -1).join(" ") : customer.name;

        userAddress.find('input[name="first_name"]').val(first_name);
        userAddress.find('input[name="last_name"]').val(last_name);

        // For country/state/city, you'll need to have options preloaded or make additional AJAX calls
        // userAddress.find('select[name="country_id"]').val(customer.country_id).trigger('change');
        userAddress
            .find('select[name="alternative_mobile_number_code_id"]')
            .val(customer.alternative_mobile_number_code_id ?? 1)
            .trigger("change");
        userAddress
            .find('select[name="mobile_number_code_id"]')
            .val(customer.mobile_number_code_id ?? 1)
            .trigger("change");

        userAddress
            .find('input[name="mobile_number"]')
            .val(customer.mobile_number);
        userAddress
            .find('input[name="alternative_mobile_number"]')
            .val(customer.alternative_mobile_number);
        userAddress.find('input[name="zip_code"]').val(customer.pincode);
        userAddress.find('input[name="address"]').val(customer.address1);
        userAddress.find('input[name="address_2"]').val(customer.address2);
        userAddress.find('input[name="address_id"]').val(customer.id);

        userAddress.find('input[name="country"]').val(customer.country);
        userAddress.find('input[name="state"]').val(customer.state);
        userAddress.find('input[name="city"]').val(customer.city);
        userAddress.find('input[name="user_id"]').val(customer.user_id);
        // Address 2 can be left empty or filled with additional info if available
    }
}

$("#auto_invoice_gen").on("click", () => {
    $('input[name="invoice_no"]').val($('input[name="nextInvoiceNo"]').val());
});

// total and grand total

$(document).on("click", ".open-supply-modal", function () {
    currentRow = $(this).closest("tr");
});

$(document).on("click", ".confirm-supply", function () {
    const selectedId = $("#supplySelector").val();
    const selectedItem = supplyItems.find((item) => item.id == selectedId);

    if (selectedItem && currentRow) {
        currentRow.find('input[name="supply_id"]').val(selectedItem.id);
        currentRow.find(".selected-supply-name").val(selectedItem.name);

        currentRow.find('input[name="qty"]').val(1);
        currentRow.find('input[name="label_qty"]').val(1);
        currentRow.find('input[name="ins"]').val(0);
        currentRow.find('input[name="discount"]').val(0);
        currentRow.find('input[name="tax"]').val(0);
        currentRow.find('input[name="price"]').val(selectedItem.price ?? 1);
        currentRow
            .find('input[name="total"]')
            .val((selectedItem.price ?? 1) * 1);

        updateSummary();
    }
});

$(document).on(
    "input",
    'input[name="qty"], input[name="price"], input[name="discount"], input[name="tax"], input[name="ins"], input[name="service_fee"]',
    function () {
        updateSummary();
    }
);

$(document).on("input", 'input[name="payment"]', function () {
    updateSummary(); // recalculate balance
});

// Recalculate row total and update blueRibbon on quantity, price, tax, discount, ins change
$(document).on(
    "input",
    'input[name="qty"], input[name="price"], input[name="value"], input[name="tax"], input[name="discount"], input[name="payment"], input[name="ins"], input[name="service_fee"]',
    function () {
        const row = $(this).closest("tr");
        syncSummary(row);
    }
);

function syncSummary(row) {
    const qty = parseFloat(row.find('input[name="qty"]').val()) || 0;
    const price = parseFloat(row.find('input[name="price"]').val()) || 0;
    const discount = parseFloat(row.find('input[name="discount"]').val()) || 0;
    const tax = parseFloat(row.find('input[name="tax"]').val()) || 0;
    const ins = parseFloat(row.find('input[name="ins"]').val()) || 0;
    const payment = parseFloat($('input[name="payment"]').val()) || 0;
    const service_fee = parseFloat($('input[name="service_fee"]').val()) || 0;

    const totalBeforeTax = qty * price;
    const taxAmount = (totalBeforeTax * tax) / 100;
    const total = totalBeforeTax + taxAmount - discount + ins;

    row.find('input[name="total"]').val(total.toFixed(2));

    const balance = total - payment;
    const grand_total = total + service_fee;
    $('input[name="balance"]').val(balance.toFixed(2));
    $('input[name="total_amount"]').val(total.toFixed(2));
    $("#grand_total").val(parseFloat(grand_total).toFixed(2));
    updateSummary();
}

// Recalculate blue ribbon section
function updateSummary() {
    let subtotal = 0;
    let value = 0;
    let totalPrice = 0;
    let tax = 0;
    let discount = 0;
    let ins = 0;
    let totalItems = 0;
    const service_fee = parseFloat($('input[name="service_fee"]').val()) || 0;

    $("#dynamicTable tbody tr").each(function () {
        const row = $(this);
        const qty = parseFloat(row.find('input[name="qty"]').val()) || 0;
        const price = parseFloat(row.find('input[name="price"]').val()) || 0;
        const BaseValue =
            parseFloat(row.find('input[name="value"]').val()) || 0;
        const rowTax = parseFloat(row.find('input[name="tax"]').val()) || 0;
        const rowDiscount =
            parseFloat(row.find('input[name="discount"]').val()) || 0;
        const rowIns = parseFloat(row.find('input[name="ins"]').val()) || 0;

        const base = qty * price;
        const rowTaxAmount = (base * rowTax) / 100;
        const rowTotal = base + rowTaxAmount - rowDiscount + rowIns;

        subtotal += base;
        value += BaseValue;
        tax += rowTaxAmount;
        discount += rowDiscount;
        ins += rowIns;
        totalPrice += base;

        if (qty > 0) totalItems += 1;
    });

    const grandTotal = totalPrice + tax + ins + service_fee - discount;
    const payment = parseFloat($('input[name="payment"]').val()) || 0;
    const balance = grandTotal - payment;

    // Update blueRibbon fields
    const ribbon = $(".blueRibbon");
    ribbon.find('input[name="total_item"]').val(totalItems);
    ribbon.find("input").eq(0).val(subtotal.toFixed(2)); // Subtotal
    ribbon.find("input").eq(1).val(value.toFixed(2)); // Value
    ribbon.find("input").eq(2).val(tax.toFixed(2)); // Tax
    ribbon.find("input").eq(3).val(discount.toFixed(2)); // Discount
    ribbon.find("input").eq(4).val(ins.toFixed(2)); // Ins
    $("#grand_total").val(grandTotal.toFixed(2));
    $("#payment").val(payment.toFixed(2));
    $("#balance").val(balance.toFixed(2));
    $("#total_qty").val(totalItems.toFixed(2));
    $('input[name="total_amount"]').val(grandTotal.toFixed(2));
    $('input[name="balance"]').val(balance.toFixed(2));
    $('input[name="total_qty"]').val(totalItems.toFixed(2));
    let status = "pending";
    if (balance > 0 && payment > 0) {
        status = "partially paid";
    } else if (balance <= 0 && payment > 0) {
        status = "paid";
    }
    $('input[name="status"]').val(status);
}

// customer save

$(document).ready(function () {
    $("#add_delevery_save").on("click", function (e) {
        e.preventDefault();

        const requiredFields = [
            "first_name",
            "last_name",
            "mobile_number",
            "address",
            "country",
            "state",
            "city",
            "zip_code",
            "alternative_mobile_number_code_id",
            "mobile_number_code_id",
        ];

        if (!jsValidator(requiredFields)) {
            alert("Please fill all required fields.");
            return;
        }
        let formData = $("#pick_up_customer_inf_form").serialize();
        // Submit via AJAX
        hendelAjex("/saveInvoceCustomer", formData);
    });

    $("#add_ship_save").on("click", function (e) {
        e.preventDefault();

        const requiredFields = [
            "first_name",
            "last_name",
            "mobile_number",
            "address",
            "country",
        ];

        if (!jsValidator(requiredFields)) {
            alert("Please fill all required fields.");
            return;
        }

        let formData = $("#pick_up_customer_inf_form").serialize();
        // Submit via AJAX
        hendelAjex("/saveInvoceCustomer", formData);
    });

    if (pickupAddress) {
        setPickupDeleveryFormValue(pickupAddress);
    }
    if (deliveryAddress) {
        setPickupDeleveryFormValue(deliveryAddress);
    }

    $("#dynamicTable tbody tr:last").find(".addBtn").show();
});

function hendelAjex(url, formData) {
    // Submit via AJAX
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        success: function (response) {
            setPickupDeleveryFormValue(response.data);
            if (response.data.address_type == "pickup") {
                $("#add_ship_cancel").click();
            } else {
                $("#add_delevery_cancel").click();
            }
            if (response.success) {
                alert(response.message);
                // optionally close modal or reset form
                // $('#pick_up_customer_inf_form')[0].reset();
                // $('.select2').val(null).trigger('change');
            }
        },
        error: function (xhr) {
            let errors = xhr.responseJSON?.errors;
            if (errors) {
                Object.keys(errors).forEach((key) => {
                    alert(errors[key][0]);
                });
            } else {
                alert("An unexpected error occurred.");
            }
        },
    });
}
function jsValidator(requiredFields) {
    // Validate required fields manually
    let isValid = true;
    // Remove all previous error messages before validating
    $('.danger').remove();

    requiredFields.forEach(function (name) {
        const input = $(`[name="${name}"]`);
        if (!input.val()) {
            input.addClass("is-invalid");
            // Add error message span after the input
            // input.after(`<span class="danger">${name.replace(/_/g, ' ')} is required.</span>`);
            isValid = false;
        } else {
            input.removeClass("is-invalid");
            // Remove the specific error message span after the input
            // input.after('span.danger').remove();
        }
    });

    return isValid;
}

$(".datetimepicker").datetimepicker({
    format: "YYYY-MM-DD", // This enforces yyyy-mm-dd
});

// ganrate innvoice form submit

function getInvoiceItemsJSON() {
    const items = [];

    $("#dynamicTable tbody tr").each(function () {
        const item = {
            supply_name: $(this).find('[name="supply_name"]').val(),
            supply_id: $(this).find('[name="supply_id"]').val(),
            qty: parseFloat($(this).find('[name="qty"]').val()) || 0,
            label_qty:
                parseFloat($(this).find('[name="label_qty"]').val()) || 0,
            price: parseFloat($(this).find('[name="price"]').val()) || 0,
            value:
                parseFloat($(this).find('[name="label_qty"]').val()) *
                    parseFloat($(this).find('[name="price"]').val()) || 0,
            ins: parseFloat($(this).find('[name="ins"]').val()) || 0,
            tax: parseFloat($(this).find('[name="tax"]').val()) || 0,
            total: parseFloat($(this).find('[name="total"]').val()) || 0,
        };
        items.push(item);
    });

    return items;
}

$("#services").on("submit", function (e) {
    e.preventDefault();

    const items = getInvoiceItemsJSON();
    const jsonData = JSON.stringify(items); // convert to JSON string

    $('input[name="invoce_item"]').val(jsonData);

    // Now submit the form programmatically
    this.submit();
});

$("#pickup_country").on("change", function () {
    var stateID = $(this).val();
    if (stateID) {
        $.ajax({
            url: "/api/get-cities/" + stateID + "?type=country",
            type: "GET",
            success: function (data) {
                $("#pickup_city").html('<option value="">Select City</option>');
                $.each(data, function (index, city) {
                    $("#pickup_city").append(
                        '<option value="' +
                            city.id +
                            '">' +
                            city.name +
                            "</option>"
                    );
                });
            },
        });
    }
});

//

function printLabel() {
    $("#printInvoice2Content").print({
        globalStyles: true,
        mediaPrint: false,
        stylesheet: null,
        iframe: true,
        noPrintSelector: ".avoid-this",
        prepend: null,
        append: null,
        deferred: $.Deferred(),
    });
}

flatpickr('input[name="payment_date"]', {
    dateFormat: "Y-m-d",
    defaultDate: new Date(),
});

flatpickr('input[name="currentTime"]', {
    enableTime: true,
    noCalendar: true,
    dateFormat: "h:i K",
    defaultDate: new Date(),
});
