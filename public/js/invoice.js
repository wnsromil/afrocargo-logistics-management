// old

var supplyItems = {};
var pickupAddress = {};
var deliveryAddress = {};
var sipToAddress = [];
var currentRow = null;
var invoce_type = "services";
let exchangeRates = [];
var maxPaymentAmountValue = 0;

function toggleLoginForm(type) {
    if (type === "services") {
        // document.getElementById('services').style.display = 'block';
        // document.getElementById('supplies').style.display = 'none';
        document.getElementById("servicesBtn").classList.add("active3");
        document.getElementById("suppliesBtn").classList.remove("active3");
        $('#service_type').removeClass('d-none');

        $('input[name="invoce_type"]').val("services");
        invoce_type = "services";

        // $("#addShiptoAddress")
        //     .removeClass("disabled")
        //     .css("pointer-events", "auto")
        //     .css("opacity", "1");

        $("#ship_customer").prop("disabled", false);

        // $("#supplies_items").addClass("d-none");
        // $("#description_services_items").removeClass("d-none");//old code
        // $("#weight_services_items").removeClass("d-none");//old code
        if ($('input[name="transport_type"]').val() == "Air Cargo") {
            $('select[name="container_id"]').prop("disabled", true);
        } else {
            $('select[name="container_id"]').prop("disabled", false);
        }

    } else if (type === "supplies") {
        // document.getElementById('services').style.display = 'none';
        // document.getElementById('supplies').style.display = 'block';
        document.getElementById("servicesBtn").classList.remove("active3");
        document.getElementById("suppliesBtn").classList.add("active3");
        $('#service_type').addClass('d-none');

        $('input[name="invoce_type"]').val("supplies");
        invoce_type = "supplies";

        // $("#addShiptoAddress")
        //     .addClass("disabled") // Add a visual cue
        //     .css("pointer-events", "none") // Disable clicking
        //     .css("opacity", "0.6"); // Optional: faded look

        $("#ship_customer").prop("disabled", true);

        // $("#supplies_items").removeClass("d-none");
        // $("#description_services_items").addClass("d-none"); //old code

        // $("#weight_services_items").addClass("d-none");//old code


        $('select[name="container_id"]') // optional: if you use this class for styling
            .prop("disabled", true) // this is essential
            .css("pointer-events", "auto") // optional: restores interaction if previously styled with pointer-events
            .css("opacity", "1"); // optional: restores visual state
    }
}



$('input[name="transport_type"]').on("click", function () {
    const transportType = $(this).val();
    console.log("Transport Type:", transportType);
    if (transportType == "Air Cargo") {
        $('select[name="container_id"]')
            .prop("disabled", true) // this is essential
            .css("pointer-events", "auto") // optional: restores interaction if previously styled with pointer-events
            .css("opacity", "1"); // optional: restores visual state
    } else {
        $('select[name="container_id"]').prop("disabled", false);
    }
});

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
    // $("#add_location").removeClass("d-none");
});

$("#add_ship_cancel").on("click", function () {
    $(".newShipmentAddress").toggleClass("none");
    $("#add_ship_save_body").addClass("d-none");
    // $("#add_location").addClass("d-none");
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
    var address_type = "delivery";
    $(".middleDiv").on("click", (e) => {
        address_type =
            $(e.currentTarget).find('input[name="type"]').val() ?? "delivery";
        console.log("address_type", address_type);
    });



    $('#delevery_customer_id').select2({
        ajax: {
            transport: function (params, success, failure) {
                // Only make API call if address_type is 'pickup'
                if (address_type === "pickup") {
                    return $.ajax(params).then(success, failure);
                } else {
                    // Return empty results if not pickup
                    success({ results: [] });
                    return null;
                }
            },
            url: "/customerSearch",
            dataType: "json",
            delay: 250,
            data: function (params) {
                // Get the selected option and its data-shipcounty attribute
                let shipCountry = $('#ship_country option:selected').attr('data-shipcounty') ?? '';

                // console.log("shipCountry", shipCountry);
                return {
                    search: params.term,
                    ship_country:shipCountry ? JSON.parse(shipCountry):'',
                    address_type: address_type,
                    invoice_type: invoce_type,
                    invoice_custmore_id:
                        address_type == "delivery"
                            ? $('input[name="invoice_custmore_id"]').val()
                            : null,
                };
            },
            processResults: function (data) {
                return {
                    results: data.data
                        .map(function (customer) {
                            if (customer.address_type != "delivery") {
                                return {
                                    id: customer.pickup_address.id ?? "",
                                    text: customer.pickup_address.text ?? "",
                                    customer: customer ?? "", // Store the full customer object
                                    delivery_address:customer.delivery_address
                                };
                            }
                            else {
                                return false;
                            }
                        })
                        .filter((i) => i),

                };
            },
            cache: true,
        },
        placeholder: "Search Customer",
        minimumInputLength: 1,
    });

    $('#ship_country').on("select2:select", function (e) {
        $('#order_list').empty() // Clear existing options
        $('#order_list_div').addClass('d-none');

        let shipCountry = $('#ship_country option:selected').attr('data-shipcounty') ?? '';
        shipCountry = JSON.parse(shipCountry);
        console.log("shipCountry.id",shipCountry.id,shipCountry);
        if(shipCountry){
            console.log("shipCountry.id",shipCountry.id,shipCountry);
            $('select[name="warehouse_id"]').val(shipCountry.id ?? null).trigger('change');
        }


        $("#delivery_customer_inf_form")
            .find('select[name="alternative_mobile_number_code_id"]')
            .val(shipCountry.countryId ?? 1)
            .trigger("change");
        $("#delivery_customer_inf_form")
            .find('select[name="mobile_number_code_id"]')
            .val(shipCountry.countryId ?? 1)
            .trigger("change");

        $("#delivery_customer_inf_form")
            .find('input[name="mobile_number"]')
            .val(shipCountry.mobile_number ?? "");
        $("#delivery_customer_inf_form")
            .find('input[name="alternative_mobile_number"]');


        $("#ship_to_address").find('input[name="country"]').val(shipCountry.country_id ?? "");
        $("#delivery_customer_inf_form").find('input[name="zip_code"]').val(shipCountry.zip_code ?? "");
        $("#delivery_customer_inf_form").find('input[name="address"]').val(shipCountry.address ?? "");
        $("#delivery_customer_inf_form").find('input[name="state"]').val(shipCountry.state_id ?? "");
        $("#delivery_customer_inf_form").find('input[name="city"]').val(shipCountry.city_id ?? "");
        $("#delivery_customer_inf_form").find('input[name="address_1"]').val(shipCountry.address ?? "");

        setPickupDeleveryFormValue({
            alternative_mobile_number_code_id:shipCountry.countryId ?? 1,
            mobile_number_code_id:shipCountry.countryId ?? 1,
            country:shipCountry.country_id ?? "",
            state:shipCountry.state_id ?? "",
            city:shipCountry.city_id ?? "",
            pincode:shipCountry.zip_code ?? "",
            address1:"",
            address2:shipCountry.address ?? "",
        },"#CustomerCreate_Form")

    });


    $('#deleveryCountry').on("select2:select", function (e) {
        $('#order_list').empty() // Clear existing options
        $('#order_list_div').addClass('d-none');

        let deleveryCountry = $('#deleveryCountry option:selected').attr('data-shipcounty') ?? '';
        deleveryCountry = JSON.parse(deleveryCountry);
        if(deleveryCountry){
            $('input[name="arrived_warehouse_id"]').val(deleveryCountry.id ?? null);
            $('#countryForLocation').val(deleveryCountry.iso2 ?? null).trigger('change');
        }

        // --------------------------
        $('#order_list').empty() // Clear existing options
        $('#order_list_div').addClass('d-none');
        // Clear existing options
        $('#ship_customer').empty();
        // Add new options to the select element
        const sipToAdd = sipToAddress || [];
        sipToAdd.filter(function(addr) {
            return addr.country_id == deleveryCountry.name;
        })
        .forEach(function(addr) {
            let option = new Option(addr.text, addr.id, false, false);
            $('#ship_customer').append(option);
        });
        // Re-initialize Select2 to reflect the new options
        $('#ship_customer').val(null).trigger('change');
        $('#ship_customer').select2({
            placeholder: "Search Customer"
        });
        // ----------------------------------------------


        $("#ship_to_address")
            .find('select[name="alternative_mobile_number_code_id"]')
            .val(deleveryCountry.countryId ?? 1)
            .trigger("change");
        $("#ship_to_address")
            .find('select[name="mobile_number_code_id"]')
            .val(deleveryCountry.countryId ?? 1)
            .trigger("change");

        $("#ship_to_address")
            .find('input[name="mobile_number"]')
            .val(deleveryCountry.mobile_number ?? "");
        $("#ship_to_address")
            .find('input[name="alternative_mobile_number"]');
        $("#ship_to_address").find('input[name="zip_code"]').val(deleveryCountry.zip_code ?? "");
        $("#ship_to_address").find('input[name="address"]').val(deleveryCountry.address ?? "");
        $("#ship_to_address").find('input[name="country"]').val(deleveryCountry.country_id ?? "");
        $("#ship_to_address").find('input[name="state"]').val(deleveryCountry.state_id ?? "");
        $("#ship_to_address").find('input[name="city"]').val(deleveryCountry.city_id ?? "");



        setPickupDeleveryFormValue({
            alternative_mobile_number_code_id:deleveryCountry.countryId ?? 1,
            mobile_number_code_id:deleveryCountry.countryId ?? 1,
            country:deleveryCountry.country_id ?? "",
            state:deleveryCountry.state_id ?? "",
            city:deleveryCountry.city_id ?? "",
            pincode:deleveryCountry.zip_code ?? "",
            address1: "",
            address2:deleveryCountry.address ?? "",
        },"#model_shipto_Form")
    });

    $('#delevery_customer_id').on("select2:select", function (e) {
        var data = e.params.data;
        var customer = data.customer;
        sipToAddress = data.delivery_address ?? [];

        $('#order_list').empty() // Clear existing options
        $('#order_list_div').addClass('d-none');
        // Clear existing options
        $('#ship_customer').empty();
        // Add new options to the select element
        sipToAddress.forEach(function(addr) {
            let option = new Option(addr.text, addr.id, false, false);
            $('#ship_customer').append(option);
        });
        // Re-initialize Select2 to reflect the new options
        $('#ship_customer').val(null).trigger('change');
        $('#ship_customer').select2({
            placeholder: "Search Customer"
        });

        $('input[name="parcel_id"]').val(customer.id);

        // if (customer.invoice_type == "Supply" && customer.parcel_inventory) {
        $('input[name="invoce_item"]').val(customer.parcel_inventory);


        let inventoryItems = customer.parcel_inventory; // assuming this is an array of objects

        // Show table if hidden
        // $("#supplies_items").removeClass("d-none");

        // Clear existing rows
        dynamicInventoryTable(inventoryItems)

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

        if (customer.address_type == "delivery" && customer.delivery_address) {
            console.log("delivery pickup_address", customer.pickup_address);
            setPickupDeleveryFormValue(customer.delivery_address);
        }
        if (
            customer.invoice_type == "Service" &&
            inventoryItems &&
            inventoryItems.length > 0
        ) {
            console.log("service pickup_address", customer.pickup_address);
            setPickupDeleveryFormValue(customer.pickup_address);
        }
        if (
            customer.invoice_type == "Service" &&
            customer.address_type == "pickup"
        ) {
            console.log(
                "service pickup pickup_address",
                customer.pickup_address
            );
            setPickupDeleveryFormValue(customer.pickup_address);
        }
        if (customer.invoice_type != "Service" && customer.pickup_address) {
            setPickupDeleveryFormValue(customer.pickup_address);
            console.log("supply pickup_address", customer.pickup_address, data);
        }
    });

    $('#ship_customer').on("select2:select", function (e) {

        var data = e.params.data;
        console.log("ship_customer data:", e,data);
        // var customer = data.customer;
        var customer = sipToAddress.find(function (addr) {
            return addr.id == data.id;
        }) || {};
        // Add sipToAddress as a Select2 option to the ship_customer select box if present




        $('#order_list').empty() // Clear existing options
        $('#ship_customer').empty() // Clear existing options
        sipToAddress.forEach(function(addr) {
            let option = new Option(addr.text, addr.id, false, false);
            $('#ship_customer').append(option);
        });

        setPickupDeleveryFormValue(customer);

        setPickupDeleveryFormValue(customer,"#model_shipto_Form")


        if(customer){
            $.ajax({
                url: "/getOrderList",
                type: "GET",
                data: {
                    pickup_address_id: $('input[name="pickup_address_id"]').val() ?? null,
                    delivery_address_id: $('input[name="delivery_address_id"]').val() ?? null,
                    invoice_type: invoce_type
                },
                success: function (response) {
                    $('#order_list_div').removeClass('d-none');
                    response.data.forEach(function(addr) {
                        // Create option with text and tracking number as value
                        let option = new Option(
                            addr.tracking_number + ',' + addr.source_address,
                            addr.tracking_number, // Use a unique identifier as value
                            false,
                            false
                        );
                        // Store the entire object as a data attribute
                        $(option).data('object', addr);
                        $('#order_list').append(option);
                    });

                    $('#order_list').val(null).trigger('change');
                    $('#order_list').select2({
                        placeholder: "Search Order"
                    });
                },
                error: function (error) {
                    $('#order_list').empty()
                    $('#order_list_div').addClass('d-none');
                    console.error("Error fetching customer details:", error);
                },
            });
        }

        console.log("selected sipToAddress customer:", customer,sipToAddress);
    });

    $('#order_list').on("select2:select", function (e) {
        // Get the selected option's data
        var selectedOption = $(this).find('option:selected');
        var selectedObject = selectedOption.data('object');

        console.log("selectedObject",selectedObject);

        let inventoryItems = selectedObject.parcel_inventory;
        dynamicInventoryTable(inventoryItems);

        setTimeout(() => {
            $("#dynamicTable tbody tr").each(function () {
                const row = $(this);
                syncSummary(row);
            });
        }, 100); // Adjust the timeout as needed

        $('input[name="descriptions"]').val(selectedObject.descriptions);
        $('input[name="weight"]').val(selectedObject.weight ?? null);
        $('input[name="parcel_id"]').val(selectedObject.parcel_id ?? null);
        // Set the value and trigger change for Select2 to show the selected option
        $('select[name="container_id"]').val(selectedObject.container_id ?? null).trigger('change');
        $('select[name="driver_id"]').val(selectedObject.driver_id ?? null).trigger('change');

        if(selectedObject.warehouse_id!=null){
            $('select[name="warehouse_id"]').val(selectedObject.warehouse_id ?? null).trigger('change');
        }

        if(selectedObject.parcel_type == "Service"){
            // Set the transport_type checkboxes according to customer.transport_type
            $('input[name="transport_type"]').prop('checked', false); // Uncheck all first
            if (selectedObject.transport_type == 'Ocean Cargo') {
                console.log('Ocean Cargo');
                $('input[name="transport_type"]').each(function () {
                    if ($(this).val() === selectedObject.transport_type) {
                        $(this).prop('checked', true);
                    }
                });
            } else {
                console.log('Air Cargo');
                // Default to "Air Cargo" if not set
                $('input[name="transport_type"]').each(function () {

                    if ($(this).val() === "Air Cargo") {
                        console.log('Select Air Cargo');
                        $(this).prop('checked', true);
                    }
                });
            }
        }
    });

    function dynamicInventoryTable(inventoryItems) {
        // Clear existing rows
        $("#dynamicTable tbody").empty();
        if (inventoryItems && inventoryItems.length > 0) {
            // Loop through inventory items and create rows
            inventoryItems.forEach((item, index) => {
                let newRow = `
                <tr>
                    <td class="mwidth open-supply-modal">
                        <div class="d-flex align-items-center">
                            <input type="text" name="supply_name" value="${
                                item.supply_name || ""
                            }" class="selected-supply-name form-control tdbor inputcolor">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#supplyModal" class="btn iconbtn p-0">
                                <i class="ti ti-chevron-down"></i>
                            </button>
                        </div>
                        <input type="hidden" name="supply_id" value="${
                            item.supply_id || ""
                        }">
                        <input type="hidden" name="inventory_id" value="${
                            item.id || ""
                        }">
                    </td>
                    <td><input type="text" class="form-control tdbor inputcolor qty-input" name="qty" value="${
                        item.qty || 0
                    }"></td>
                    <td><input type="text" class="form-control tdbor inputcolor" name="label_qty" value="${
                        item.label_qty || 0
                    }"></td>
                    <td><input type="text" class="form-control tdbor inputcolor" placeholder="" name="volume" value="${
                        item.volume || 0
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
                    <td class="d-none"><input type="text" class="form-control tdbor inputcolor discount-input" name="discount" value="${
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
        } else {
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
                                        <input type="hidden" name="inventory_id">
                                    </td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="qty"></td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="label_qty"></td>
                                    <td> <input type="text" class="form-control tdbor inputcolor" placeholder=""
                                            name="volume"></td>
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
    }

});

function setPickupDeleveryFormValue(customer,setCustomerInfo = false) {
    console.log("customer=>", customer);
    // Fill the form fields with customer data
    let userAddress = "";
    if (customer) {
        if(setCustomerInfo){
            userAddress = $(setCustomerInfo);
        }else{
            userAddress =
            customer.address_type == "delivery"
                ? $("#ship_to_address"):$("#delivery_to_address");
        }

        // Split full name into first and last name
        // var names = customer.full_name.split(' ');
        // var firstName = names[0];
        // var lastName = names.length > 1 ? names.slice(1).join(' ') : '';
        let newOption = '';
        if(customer.text){
            newOption = new Option(customer.text, customer.id, true, true);
        }


        if (customer.address_type == "delivery") {
            if(!setCustomerInfo){
                $('input[name="pickup_address_id"]').val(customer.id ?? '');

                // Add new option if not already present
                $("#ship_customer").append(newOption).trigger("change");
            }
        } else {

            if(customer.user_id){
                $('input[name="invoice_custmore_id"]').val(customer.user_id ?? '');
                $('#model_shipto_Form').find('input[name="invoice_custmore_id"]').val(customer.user_id ?? '');
            }

            // delevery select box

            if(!setCustomerInfo){
                // Add new option if not already present
                $('input[name="delivery_address_id"]').val(customer.id ?? '');
                $("#delevery_customer_id").append(newOption).trigger("change");
            }

        }

        // Fill the form fields
        let nm = customer.full_name ? customer.full_name.trim().split(" ") : "";

        let last_name = nm.length > 1 ? nm[nm.length - 1] : null;
        let first_name =
            nm.length > 1 ? nm.slice(0, -1).join(" ") : customer.name ?? "";

        userAddress.find('input[name="first_name"]').val(first_name ?? "");
        userAddress.find('input[name="last_name"]').val(last_name ?? "");

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
            .val(customer.mobile_number ?? "");
        userAddress
            .find('input[name="alternative_mobile_number"]')
            .val(customer.alternative_mobile_number);

        userAddress.find('input[name="address_2"]').val(customer.address2 ?? "");
        userAddress.find('input[name="address_id"]').val(customer.id ?? "");

        userAddress.find('input[name="zip_code"]').val(customer.pincode ?? "");
        userAddress.find('input[name="address"]').val(customer.address1 ?? "");
        if(setCustomerInfo){
            const countryVal = customer.country ?? '';

            userAddress.find('select[name="country"]')
                .val(countryVal)
                .trigger("change")
                .prop('disabled', true); // disable the dropdown

            // add hidden input to submit country value
            if (userAddress.find('input[name="country"]').length === 0) {
                userAddress.append(`<input type="hidden" name="country" value="${countryVal}">`);
            } else {
                userAddress.find('input[name="country"]').val(countryVal);
            }
        }else{
            userAddress.find('input[name="country"]').val(customer.country ?? "");
        }


        userAddress.find('input[name="state"]').val(customer.state ?? "");
        userAddress.find('input[name="city"]').val(customer.city ?? "");
        userAddress.find('input[name="user_id"]').val(customer.user_id ?? "");
        // Address 2 can be left empty or filled with additional info if available


    }
}

$("#auto_invoice_gen").on("click", function () {
    if ($(this).text().trim() === "Auto") {
        $('input[name="invoice_no"]').prop("readonly", true);
        $('input[name="invoice_no"]').val(
            $('input[name="nextInvoiceNo"]').val()
        );
        $(this).text("Manual");
    } else {
        $('input[name="invoice_no"]').prop("readonly", false);
        $('input[name="invoice_no"]').val("");
        $(this).text("Auto");
    }
});

// Helper to parse supply data from option
function getSupplyData(option) {
    try {
        return JSON.parse(option.getAttribute("data-supply"));
    } catch (e) {
        return {};
    }
}

// total and grand total

$(document).on("click", ".open-supply-modal", function () {
    currentRow = $(this).closest("tr");
});

$(document).on("click", ".confirm-supply", function () {
    const selectedId = $("#supplySelector").val();
    let selectedItem = {};
    if(invoce_type == 'services') {
        selectedItem = serviceItems.find((item) => item.id == selectedId);
    }else{
        selectedItem = supplyItems.find((item) => item.id == selectedId);
    }

    if (selectedItem && currentRow) {
        currentRow.find('input[name="supply_id"]').val(selectedItem.id);
        currentRow.find(".selected-supply-name").val(selectedItem.name);
        currentRow.find('input[name="valume"]').val(selectedItem.valume ?? 0);

        currentRow.find('input[name="qty"]').val(1);
        currentRow.find('input[name="label_qty"]').val(selectedItem.label_qty ?? '-');
        currentRow.find('input[name="ins"]').val(selectedItem.ins ?? 0);
        currentRow.find('input[name="discount"]').val(selectedItem.discount ?? 0);
        currentRow.find('input[name="tax"]').val(selectedItem.tax ?? 0);
        currentRow.find('input[name="price"]').val(selectedItem.price ?? 1);
        currentRow
            .find('input[name="total"]')
            .val((selectedItem.price ?? 1) * 1);

        updateSummary();
    }
});

$("#supplySelector").on("change", function () {
    let selectedOption = this.options[this.selectedIndex];
    let selectedItem = getSupplyData(selectedOption);

    if (selectedItem) {
        $("#volume_total_display").text(selectedItem.volume_total ?? "N/A");
        $("#volume_price_display").text(selectedItem.volume_price ?? 0);
        $("#price_display").text(selectedItem.price ?? 0);
        $("#height_display").text(selectedItem.height ?? "N/A");
        $("#width_display").text(selectedItem.width ?? "N/A");
        $("#weight_display").text(selectedItem.weight ?? "N/A");
    } else {
        $("#volume_total_display").text("");
        $("#volume_price_display").text(0);
        $("#price_display").text(0);
        $("#height_display").text("");
        $("#width_display").text("");
        $("#weight_display").text("");
    }
});

// Open modal and set selected supply
document
    .querySelectorAll(
        '.open-supply-modal button[data-bs-target="#supplyModal"]'
    )
    .forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            currentRow = btn.closest("tr");
            // Get current supply_id and supply_name from hidden inputs in the row
            let supplyId = currentRow.querySelector(
                'input[name="supply_id"]'
            )?.value;
            let supplyName = currentRow.querySelector(
                'input[name="supply_name"]'
            )?.value;
            let selector = document.getElementById("supplySelector");
            // console.log("open modal", supplyId, supplyName, selector);
            if (selector) {
                if (supplyName) {
                    // Fallback: select by supply_name using data-selected attribute
                    let option = Array.from(selector.options).find(
                        (opt) =>
                            opt.getAttribute("data-selected") === supplyName
                    );
                    // console.log("open modal", supplyId, supplyName, selector,option,option.value);
                    if (option) {
                        selector.value = option.value;
                    }
                }
                selector.dispatchEvent(new Event("change"));
            }
        });
    });
// When modal opens, trigger change to update display fields
$("#supplyModal").on("shown.bs.modal", function () {
    let selector = document.getElementById("supplySelector");
    if (selector) {
        selector.dispatchEvent(new Event("change"));
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

$(document).on("input", 'input[name="discount"]', function () {
    console.log("Discount changed");
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
    let ins = 0;
    let totalItems = 0;
    let discount = 0;
    const service_fee = parseFloat($('input[name="service_fee"]').val()) || 0;
    const dis = parseFloat($('#dis').val()) || 0;

    $("#dynamicTable tbody tr").each(function () {
        const row = $(this);
        const qty = parseFloat(row.find('input[name="qty"]').val()) || 0;
        const price = parseFloat(row.find('input[name="price"]').val()) || 0;
        const BaseValue =
            parseFloat(row.find('input[name="value"]').val()) || 0;
        const rowTax = parseFloat(row.find('input[name="tax"]').val()) || 0;
        const rowDiscount = parseFloat(row.find('input[name="discount"]').val()) || 0;
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


    const grandTotal = totalPrice + tax + ins + service_fee - (dis ?? discount);
    const payment = parseFloat($('input[name="payment"]').val()) || 0;
    const balance = grandTotal - payment;

    // Update blueRibbon fields
    const ribbon = $(".blueRibbon");
    ribbon.find('input[name="total_item"]').val(totalItems);
    ribbon.find("input").eq(0).val(subtotal.toFixed(2)); // Subtotal
    ribbon.find("input").eq(1).val(value.toFixed(2)); // Value
    ribbon.find("input").eq(2).val(tax.toFixed(2)); // Tax
    // ribbon.find("input").eq(3).val(discount.toFixed(2)); // Discount
    ribbon.find("input").eq(3).val(ins.toFixed(2)); // Ins
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
            "alternative_mobile_number_code_id",
            "mobile_number_code_id",
        ];

        if (!jsValidator(requiredFields,$("#delivery_customer_inf_form"))) {
            return;
        }
        let formData = $("#delivery_customer_inf_form").serialize();
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
            "country",
        ];

        if (!jsValidator(requiredFields,$("#pick_up_customer_inf_form"))) {
            return;
        }

        let formData = $("#pick_up_customer_inf_form").serialize();
        // Submit via AJAX
        hendelAjex("/saveInvoceCustomer", formData);
    });

    $("#add_ship_modal_save").on("click", function (e) {
        e.preventDefault();

        const requiredFields = [
            "first_name",
            "last_name",
            "mobile_number",
            "address",
            "country",
        ];

        if (!jsValidator(requiredFields,$("#model_shipto_Form"))) {
            return;
        }

        let formData = $("#model_shipto_Form").serialize();
        // Submit via AJAX
        hendelAjex("/saveInvoceCustomer", formData);
    });

    $("#add_customer_modal_save").on("click", function (e) {
        e.preventDefault();

        const requiredFields = [
            "first_name",
            "last_name",
            "mobile_number",
            "address",
            "country",
            "email"
        ];

        if (!jsValidator(requiredFields,$("#CustomerCreate_Form"))) {
            return;
        }

        let formData = $("#CustomerCreate_Form").serialize();
        // Submit via AJAX
        hendelAjex("/saveInvoceCustomer", formData);
    });

    if (pickupAddress) {
        setPickupDeleveryFormValue(pickupAddress);
        setPickupDeleveryFormValue(pickupAddress,$("#CustomerCreate_Form"));
    }
    if (deliveryAddress) {
        setPickupDeleveryFormValue(deliveryAddress);
        setPickupDeleveryFormValue(deliveryAddress,$("#model_shipto_Form"));
    }

    $("#dynamicTable tbody tr:last").find(".addBtn").show();
});

function hendelAjex(url, formData) {
    // Submit via AJAX
    showLoader();
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        success: function (response) {
            setPickupDeleveryFormValue(response.data);
            $("#add_ship_cancel").click();
            $("#add_delevery_cancel").click();
            $("#add_ship_modal_cancel").click();
            $("#add_cutomer_modal_cancel").click();
            hideLoader();

            if (response.success) {
                // alert(response.message);

                Swal.fire({
                    icon: response.success ? "success" : "error",
                    title: response.success ? "Success" : "Error",
                    text:
                        response.message ||
                        (response.success
                            ? "Operation successful."
                            : "An error occurred."),
                });
                // optionally close modal or reset form
                // $('#pick_up_customer_inf_form')[0].reset();
                // $('.select2').val(null).trigger('change');
            }
        },
        error: function (xhr) {
            hideLoader();
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
            inventory_id: $(this).find('[name="inventory_id"]').val() ?? null,
            qty: parseFloat($(this).find('[name="qty"]').val()) || 0,
            label_qty:$(this).find('[name="label_qty"]').val() || '-',
            volume: parseFloat($(this).find('[name="volume"]').val()) || 0,
            price: parseFloat($(this).find('[name="price"]').val()) || 0,
            value: parseFloat($(this).find('[name="value"]').val()) || 0,
            ins: parseFloat($(this).find('[name="ins"]').val()) || 0,
            discount: parseFloat($(this).find('[name="discount"]').val()) || 0,
            tax: parseFloat($(this).find('[name="tax"]').val()) || 0,
            total: parseFloat($(this).find('[name="total"]').val()) || 0,
        };
        items.push(item);
    });

    return items;
}

$("#services").on("submit", function (e) {
    e.preventDefault();

    const rules = {
        invoce_type: "required|in:services,supplies",
        delivery_address_id: "required",
        // pickup_address_id: "required_if:invoce_type,services",
        // container_id:
        //     "required_if:invoce_type,services|required_if:transport_type,cargo|numeric",
        // driver_id: "nullable|numeric",
        warehouse_id: "required|numeric",
        ins: "nullable|numeric",
        discount: "nullable|numeric",
        tax: "numeric",
        weight: "nullable",
        balance: "numeric",
        total_price: "required|numeric",
        total_qty: "required|numeric",
        duedaterange: "",
        currentdate: "date_format:Y-m-d",
        currentTime: "",
        invoice_no: "max:255",
        total_amount: "required|numeric",
        grand_total: "required|numeric",
        payment: "required|numeric",
        status: "required",
    };

    if(invoce_type == "services") {
        rules.pickup_address_id = "required";
        // rules.transport_type = "required";
        // If transport_type is a checkbox group, check if any checked value is "Ocean Cargo"
        // Also check if transport_type is checked at all
        var $checkedTransport = $('input[name="transport_type"]:checked');
        if ($checkedTransport.length === 0) {
            Swal.fire({
            icon: "error",
            title: "Error",
            text: "Please select a transport type.",
            });
            e.preventDefault();
            return false;
        }
        if ($checkedTransport.length > 0 && $checkedTransport.filter(function() { return $(this).val() === "Ocean Cargo"; }).length > 0) {
            rules.container_id = "required|numeric";
        }
    }

    if (!jsValidator(rules, $("#services"))) {
        // alert("Please fix the errors");
        e.preventDefault();
        return false;
    }

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

//

// Exchange rates (mock - can be loaded from DB or API)

function calculateExchangeFields(form) {

    // Use the provided form or default to the whole document
    form = form || $(document);
    let maxPaymentAmountValue = 0;

    // Get values
    form.find('input[name="exchange_rate"]').prop("readonly", false);

    const payment = parseFloat($('input[name="payment_amount"]').val()) || 0;
    const totalBalance =
        parseFloat(form.find('input[name="total_balance"]').val()) || 0;
    let rate = form.find('input[name="exchange_rate"]').val() || 1;
    const currency = form.find('select[name="local_currency"]').val();
    if (currency === "USD") {
        rate = 1; // USD is the base currency, so exchange rate is 1
        form.find('input[name="exchange_rate"]').prop("readonly", true);
    }
    //  const currency = $('select[name="local_currency"]').val();
    // const rate = exchangeRates.find((cur) => cur.currency_code === currency)
    //     ?.exchange_rate || 1;
    // Set exchange rate field
    // $('input[name="exchange_rate"]').val(rate);

    // Calculate payment in USD (or base currency)
    const paymentInBase = payment/rate;
    maxPaymentAmountValue = totalBalance * rate;
    form.find('input[name="exchange_rate_balance"]').val(
        maxPaymentAmountValue.toFixed(2)
    );

    // Applied payments (for now, just current payment)
    form.find('input[name="applied_payments"]').val(payment.toFixed(2));
    form.find('input[name="applied_total_usd"]').val(paymentInBase.toFixed(2));

    // Balance after payment (in original currency)
    const balanceAfterPayment = totalBalance - payment / rate;
    form.find('input[name="current_balance"]').val(balanceAfterPayment.toFixed(2));

    // Balance after payment, converted to base currency
    const balanceAfterExchange = balanceAfterPayment * rate;
    form.find('input[name="balance_after_exchange_rate"]').val(
        balanceAfterExchange.toFixed(2)
    );
}

function maxPaymentAmount(selt) {

    const totalBalance =
        parseFloat($(selt).closest('form').find('input[name="total_balance"]').val()) || 0;
    let rate = $(selt).closest('form').find('input[name="exchange_rate"]').val() || 1;

    var maxPaymentAmountValue = totalBalance * rate;
    calculateExchangeFields($(selt).closest('form'));

    console.log('parseFloat',parseFloat(selt.value),totalBalance, rate);

    if (parseFloat(selt.value) > parseFloat(maxPaymentAmountValue)){
        return (selt.value = maxPaymentAmountValue);
    }
    if (parseFloat(selt.value) < parseFloat(0)) return (selt.value = 0);
}

// Use delegated event for select[name="local_currency"] to ensure handler works for dynamically loaded elements
$('input[name="payment_amount"], input[name="exchange_rate"]').on("input", function () {
    console.log("calculateExchangeFields called");
    const form = $(this).closest("form");
    calculateExchangeFields(form);
});

// Delegated event for select[name="local_currency"]
$(document).on("change", 'select[name="local_currency"]', function () {
    console.log("calculateExchangeFields called (currency changed)");
    const form = $(this).closest("form");
    calculateExchangeFields(form);
});

// Listen for form submission
$(document)
    .off("submit", "#sendInvoiceForm")
    .on("submit", "#sendInvoiceForm", function (e) {
        e.preventDefault();

        const form = $(this);
        const sendType = form
            .find('input[name="sentInvoicePdf"]:checked')
            .val();
        const email = form.find('input[name="email"]').val();
        const alternateMobile = form
            .find('input[name="alternate_mobile_no"]')
            .val();
        const invoiceId = form.find('input[name="invoiceId"]').val();

        // Basic validation
        if (sendType === "email" && !email) {
            alert("Please enter an email address.");
            return;
        }
        if (sendType === "sms" && !alternateMobile) {
            alert("Please enter an alternate mobile number.");
            return;
        }

        // Prepare data
        const data = {
            _token: form.find('input[name="_token"]').val(),
            invoice_id: invoiceId,
            send_type: sendType,
            email: email,
            alternate_mobile_no: alternateMobile,
        };

        showLoader();

        $.ajax({
            url: "/api/invoices/sendInvoice",
            method: "POST",
            data: data,
            success: function (res) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: res.message || "Invoice sent successfully.",
                });
                // Optionally close modal or reset form
                $("#sendinvoicepdf").closest(".modal").modal("hide");
                hideLoader();
            },
            error: function (xhr) {
                hideLoader();
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    Object.keys(errors).forEach((key) => {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: errors[key][0],
                        });
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "An unexpected error occurred.",
                    });
                }
            },
        });
    });

// Toggle between email and SMS fields
$(document)
    .off("change", 'input[name="sentInvoicePdf"]')
    .on("change", 'input[name="sentInvoicePdf"]', function () {
        if ($(this).val() === "email") {
            $("#emailDiv").show();
            $("#textorsmsDiv").hide();
            $("#whatsappDiv").hide();
        } else if ($(this).val() === "whatsapp") {
            $("#emailDiv").hide();
            $("#textorsmsDiv").hide();
            $("#whatsappDiv").show();
        } else {
            $("#emailDiv").hide();
            $("#textorsmsDiv").show();
            $("#whatsappDiv").hide();
        }
    });

$(document)
    .off("submit", "#AddnewLable")
    .on("submit", "#AddnewLable", function (e) {
        e.preventDefault();

        const form = $(this);

        const description = form.find('textarea[name="description"]').val();
        const qty = form.find('input[name="labelQuantity"]').val();
        const invoiceId = form.find('input[name="invoiceId"]').val();

        // Prepare data
        const data = {
            _token: form.find('input[name="_token"]').val(),
            invoice_id: invoiceId,
            description: description,
            qty: qty,
            action: "generate",
        };

        const requiredFields = ["invoiceId", "description", "labelQuantity"];

        if (!jsValidator(requiredFields, form)) {
            alert("Please fill all required fields.");
            return;
        }

        showLoader();

        $.ajax({
            url: "/api/barcode",
            method: "POST",
            data: data,
            success: function (res) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: res.message || "barcode sent successfully.",
                });
                // Optionally close modal or reset form
                $("#createLabel").closest(".modal").modal("hide");
                hideLoader();
                window.location.reload();
            },
            error: function (xhr) {
                hideLoader();
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    Object.keys(errors).forEach((key) => {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: errors[key][0],
                        });
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "An unexpected error occurred.",
                    });
                }
            },
        });
    });


    if ($(".datetimepickerDefault").length > 0) {
        $(".datetimepickerDefault").datetimepicker({
            format: "YYYY/MM/DD",
            icons: {
                up: "fas fa-angle-up",
                down: "fas fa-angle-down",
                next: "fas fa-angle-right",
                previous: "fas fa-angle-left",
            },
        });
    }

    // 🖼 Image Preview Function
    function previewImage(input, imageType) {
        if (input.files && input.files[0]) {
            let file = input.files[0];

            // ✅ Sirf PNG ya JPG Allow Hai
            if (file.type === "image/png" || file.type === "image/jpeg") {
                let reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview_' + imageType).src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert("Only PNG & JPG images are allowed!");
                input.value = ""; // Invalid file ko remove karna
            }
        }
    }

    // ❌ Remove Image Function
    function removeImage(imageType) {
        document.getElementById('preview_' + imageType).src = "{{ asset('../assets/img.png') }}";
        document.getElementById('file_' + imageType).value = "";
    }


    function phonevalidate(self){
        let length = $(self).select('option:selected').data('length');
        let phoneNumber = $(self).val();
    }
    showLoader();
    $(window).on('load', function () {
        setTimeout(() => {
            hideLoader();
        }, 900);
    });
