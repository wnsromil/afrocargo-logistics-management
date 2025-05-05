(function ($) {
    "use strict";
    $(document).ready(function () {
        // Initialize Select2 Plugin
        //$(".js-example-basic-single").select2();

        // Handle Form Submission via AJAX
        $("#pickupForm").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            // Clear previous error messages
            $("#driverError").text("");

            // Get Form Data
            let parcelId = $("#parcel_id_input").val();
            let warehouse_id = $("#warehouse_id_input").val();
            let created_user_id = $("#created_user_id_input").val();
            let driverId = $("#driverDropdown").val();
            let notes = $('input[name="notes"]').val();

            // Client-Side Validation
            let hasError = false;

            if (!parcelId) {
                alert("Parcel ID is required.");
                return;
            }
            if (!driverId) {
                $("#driverError").text("Please select a Pickup Man.");
                hasError = true;
            }

            // If there are validation errors, stop further execution
            if (hasError) {
                return;
            }

            // Show Loading Indicator
            $(".btn-primary").html("Processing...").prop("disabled", true);

            // Make AJAX POST Request
            $.ajax({
                url: "/api/update-status-pick-up-with-driver", // API endpoint
                type: "POST",
                data: {
                    parcel_id: parcelId,
                    driver_id: driverId,
                    warehouse_id: warehouse_id,
                    created_user_id: created_user_id,
                    notes: notes,
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                },
                success: function (response) {
                    document
                        .querySelector("#Pick_up_with_driver .custom-btn")
                        .click();
                    Swal.fire({
                        title: "Good job!",
                        text: "Status changed successfully!",
                        icon: "success",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Handle Server-Side Validation Errors
                    let errors = xhr.responseJSON?.errors || {};
                    if (errors.driver_id) {
                        $("#driverError").text(errors.driver_id[0]);
                    }
                },
                complete: function () {
                    // Re-enable Save Button
                    $(".btn-primary").html("Save").prop("disabled", false);
                },
            });
        });
    });

    $(document).ready(function () {
        // Handle Form Submission via AJAX
        $("#transfer_to_hub_form").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            // Clear previous error messages
            $("#to_warehouse_idError").text("");
            $("#delivery_manError").text("");

            // Get Form Data
            let from_warehouse_id = $("#from_warehouse_id").val();
            let to_warehouse_id = $("#to_warehouse_id").val();
            let delivery_man = $("#delivery_man").val();
            let note = $("#Note").val();
            let vehicle_id_hidden = $("#vehicle_id_input_hidden").val();
            let partial_payment_sum_input_hidden = $(
                "#partial_payment_sum_input_hidden"
            ).val();
            let remaining_payment_sum_input_hidden = $(
                "#remaining_payment_sum_input_hidden"
            ).val();
            let total_amount_sum_input_hidden = $(
                "#total_amount_sum_input_hidden"
            ).val();
            let no_of_orders_input_hidden = $(
                "#no_of_orders_input_hidden"
            ).val();

            // Client-Side Validation
            let hasError = false;

            if (!to_warehouse_id) {
                $("#to_warehouse_idError").text(
                    "Please select a to warehouse."
                );
                hasError = true;
            }
            if (!delivery_man) {
                $("#delivery_manError").text("Please select a delivery man.");
                hasError = true;
            }

            // If there are validation errors, stop further execution
            if (hasError) {
                return;
            }

            // Show Loading Indicator
            $(".btn-primary").html("Processing...").prop("disabled", true);

            // Make AJAX POST Request
            $.ajax({
                url: "/api/update-status-transfer-to-hub", // API endpoint
                type: "POST",
                data: {
                    from_warehouse_id: from_warehouse_id,
                    to_warehouse_id: to_warehouse_id,
                    delivery_man: delivery_man,
                    note: note,
                    vehicle_id_hidden: vehicle_id_hidden,
                    partial_payment_sum_input_hidden:
                        partial_payment_sum_input_hidden,
                    remaining_payment_sum_input_hidden:
                        remaining_payment_sum_input_hidden,
                    total_amount_sum_input_hidden:
                        total_amount_sum_input_hidden,
                    no_of_orders_input_hidden: no_of_orders_input_hidden,
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                },
                success: function (response) {
                    // Close the modal manually after success
                    $("#transfer_to_hub").modal("hide");

                    // Show success message
                    Swal.fire({
                        title: "Good job!",
                        text: "Status changed successfully!",
                        icon: "success",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Handle Server-Side Validation Errors
                    let errors = xhr.responseJSON?.errors || {};
                },
                complete: function () {
                    // Re-enable Save Button
                    $(".btn-primary").html("Save").prop("disabled", false);
                },
            });
        });
    });

    $(document).ready(function () {
        // Handle Form Submission via AJAX
        $("#received_to_hub_form").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            // Clear previous error messages
            $("#to_warehouse_idError").text("");
            $("#delivery_manError").text("");

            // Get Form Data
            let note = $("#Note").val();
            let vehicle_id_hidden = $("#vehicle_id_input_hidden").val();

            // Show Loading Indicator
            $(".btn-primary").html("Processing...").prop("disabled", true);

            // Make AJAX POST Request
            $.ajax({
                url: "/api/update-status-received-to-hub", // API endpoint
                type: "POST",
                data: {
                    note: note,
                    vehicle_id_hidden: vehicle_id_hidden,
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                },
                success: function (response) {
                    // Close the modal manually after success
                    $("#received_to_hub").modal("hide");

                    // Show success message
                    Swal.fire({
                        title: "Good job!",
                        text: "Status changed successfully!",
                        icon: "success",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Handle Server-Side Validation Errors
                    let errors = xhr.responseJSON?.errors || {};
                },
                complete: function () {
                    // Re-enable Save Button
                    $(".btn-primary").html("Save").prop("disabled", false);
                },
            });
        });
    });

    $(document).ready(function () {
        // Initialize Select2 Plugin
        //$(".js-example-basic-single").select2();

        // Handle Form Submission via AJAX
        $("#deliveryForm").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            // Clear previous error messages
            $("#deliverydriverError").text("");

            // Get Form Data
            let parcelId = $("#parcel_id_input").val();
            let warehouse_id = $("#warehouse_id_input").val();
            let created_user_id = $("#created_user_id_input").val();
            let driverId = $("#deliverydriverDropdown").val();
            let notes = $('input[name="notes"]').val();

            // Client-Side Validation
            let hasError = false;

            if (!parcelId) {
                alert("Parcel ID is required.");
                return;
            }
            if (!driverId) {
                $("#deliverydriverError").text("Please select a Pickup Man.");
                hasError = true;
            }

            // If there are validation errors, stop further execution
            if (hasError) {
                return;
            }

            // Show Loading Indicator
            $(".btn-primary").html("Processing...").prop("disabled", true);

            // Make AJAX POST Request
            $.ajax({
                url: "/api/update-status-delivery-with-driver", // API endpoint
                type: "POST",
                data: {
                    parcel_id: parcelId,
                    driver_id: driverId,
                    warehouse_id: warehouse_id,
                    created_user_id: created_user_id,
                    notes: notes,
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                },
                success: function (response) {
                    document
                        .querySelector("#delivery_with_driver .custom-btn")
                        .click();
                    Swal.fire({
                        title: "Good job!",
                        text: "Status changed successfully!",
                        icon: "success",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Handle Server-Side Validation Errors
                    let errors = xhr.responseJSON?.errors || {};
                    if (errors.driver_id) {
                        $("#deliverydriverError").text(errors.driver_id[0]);
                    }
                },
                complete: function () {
                    // Re-enable Save Button
                    $(".btn-primary").html("Save").prop("disabled", false);
                },
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Listen for all modal trigger clicks
        document
            .querySelectorAll('[data-bs-toggle="modal"]')
            .forEach(function (button) {
                button.addEventListener("click", function () {
                    // Get the ID from the clicked button's data-id attribute
                    const parcelId = this.getAttribute("data-id");

                    // Store the ID in the hidden input field
                    if (parcelId) {
                        document.getElementById(
                            "parcel_id_input_hidden"
                        ).value = parcelId;
                    }
                });
            });
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Listen for all modal trigger clicks
        document
            .querySelectorAll('[data-bs-toggle="modal"]')
            .forEach(function (button) {
                button.addEventListener("click", function () {
                    // Get the ID from the clicked button's data-id attribute
                    const vehiclelId = this.getAttribute("vehicle-id");

                    // Store the ID in the hidden input field
                    if (vehiclelId) {
                        document.getElementById(
                            "vehicle_id_input_hidden"
                        ).value = vehiclelId;
                    }
                });
            });
    });
})(jQuery);
