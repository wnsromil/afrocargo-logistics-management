(function ($) {
    "use strict";
    $(document).ready(function () {
        $("#pickupForm").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            // Clear previous error messages
            $("#driverError").text("");
            $("#warehouseError").text("");
            // Get Form Data
            let parcelId = $("#parcel_id_input_hidden").val();
            let warehouse_id = $(this)
                .find('select[name="warehouse_id"]')
                .val();
            let created_user_id = $("#created_user_id_input").val();
            let driverId = $(this).find('select[name="driver_id"]').val();
            let notes = $(this).find('input[name="notes"]').val();

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
            if (!warehouse_id) {
                $("#warehouseError").text("Please select a warehouse.");
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
            let container_history_id_input_hidden = $(
                "#container_history_id_input_hidden"
            ).val();
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
            // if (!delivery_man) {
            //     $("#delivery_manError").text("Please select a delivery man.");
            //     hasError = true;
            // }

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
                    from_warehouse_id: from_warehouse_id || null,
                    to_warehouse_id: to_warehouse_id || null,
                    delivery_man: delivery_man || null,
                    note: note || null,
                    vehicle_id_hidden: vehicle_id_hidden || null,
                    partial_payment_sum_input_hidden:
                        partial_payment_sum_input_hidden || null,
                    remaining_payment_sum_input_hidden:
                        remaining_payment_sum_input_hidden || null,
                    total_amount_sum_input_hidden:
                        total_amount_sum_input_hidden || null,
                    no_of_orders_input_hidden:
                        no_of_orders_input_hidden || null,
                    containerHistoryId:
                        container_history_id_input_hidden || null,
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
                    let errorMessages = [];
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessages.push(errors[key][0]);
                        }
                    }
                    if (errorMessages.length > 0) {
                        Swal.fire({
                            title: "Validation Error",
                            text: errorMessages.join("\n"),
                            icon: "error",
                        });
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
            $("#deliverywarehouseError").text("");
            // Get Form Data
            let parcelId = $("#parcel_id_input_hidden").val();
            let warehouse_id = $(this)
                .find('select[name="warehouse_id"]')
                .val();
            let created_user_id = $("#created_user_id_input").val();
            let driverId = $(this).find('select[name="driver_id"]').val();
            let notes = $(this).find('input[name="notes"]').val();

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
            if (!warehouse_id) {
                $("#deliverywarehouseError").text("Please select a warehouse.");
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

    $(document).ready(function () {
        $("#signaturedeliveryForm").on("submit", function (e) {
            e.preventDefault();

            // Clear previous errors
            $("#amountError").text("");
            let hasError = false;
            // Prepare FormData object
            let formData = new FormData();
            let amount = $(this).find('input[name="amount"]').val();

            if (!amount) {
                $("#amountError").text("Amount is required.");
                hasError = true;
            }

            // Add fields
            formData.append("parcel_id", $("#parcel_id_input_hidden").val());
            formData.append(
                "amount",
                $(this).find('input[name="amount"]').val()
            );
            formData.append("notes", $(this).find('input[name="notes"]').val());

            // Add hidden fields
            formData.append("warehouse_id", $("#warehouse_id_input").val());
            formData.append(
                "created_user_id",
                $("#created_user_id_input").val()
            );

            // Add image file
            let imgFile = $("#self_pickup_img")[0].files[0]; // Make sure input has id="self_pickup_img"
            if (imgFile) {
                formData.append("img", imgFile);
            }

            // CSRF token
            let csrfToken = $('meta[name="csrf-token"]').attr("content");

            // Disable button
            $(".btn-primary").html("Processing...").prop("disabled", true);

            if (hasError) {
                return;
            }

            // AJAX request
            $.ajax({
                url: "/api/update-status-signature-self-delivery",
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                data: formData,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                success: function (response) {
                    $("#delivery_with_driver .custom-btn").click();
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
                error: function (xhr) {
                    let errors = xhr.responseJSON?.errors || {};
                    if (errors.driver_id) {
                        $("#deliverydriverError").text(errors.driver_id[0]);
                    }
                },
                complete: function () {
                    $(".btn-primary").html("Save").prop("disabled", false);
                },
            });
        });
    });

    $(document).ready(function () {
        $("#cancelledForm").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            // Clear previous error messages
            // Get Form Data
            let parcelId = $("#parcel_id_input_hidden").val();
            let created_user_id = $("#created_user_id_input").val();
            let notes = $(this).find('input[name="notes"]').val();

            // Client-Side Validation
            let hasError = false;

            if (!parcelId) {
                alert("Parcel ID is required.");
                return;
            }

            // If there are validation errors, stop further execution
            if (hasError) {
                return;
            }

            // Show Loading Indicator
            $(".btn-primary").html("Processing...").prop("disabled", true);

            // Make AJAX POST Request
            $.ajax({
                url: "/api/update-status-admin-cancel", // API endpoint
                type: "POST",
                data: {
                    parcel_id: parcelId,
                    created_user_id: created_user_id,
                    notes: notes,
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                },
                success: function (response) {
                    document
                        .querySelector("#cancelledForm .custom-btn")
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
                },
                complete: function () {
                    // Re-enable Save Button
                    $(".btn-primary").html("Save").prop("disabled", false);
                },
            });
        });
    });

    $(document).ready(function () {
        $("#Re_schedule_pickupForm, #Re_schedule_deliveryForm").on(
            "submit",
            function (e) {
                e.preventDefault(); // Prevent default form submission

                // Clear previous error messages
                // Get Form Data
                let parcelId = $("#parcel_id_input_hidden").val();
                let created_user_id = $("#created_user_id_input").val().trim();
                let notes = $(this).find('input[name="notes"]').val();
                let date = $(this).find('input[name="percel_date"]').val();
                let Re_schedule_type = $(this)
                    .find('input[name="Re_schedule_type"]')
                    .val();
                // Client-Side Validation

                let hasError = false;

                if (!parcelId) {
                    alert("Parcel ID is required.");
                    return;
                }

                // If there are validation errors, stop further execution
                if (hasError) {
                    return;
                }

                // Show Loading Indicator
                $(".btn-primary").html("Processing...").prop("disabled", true);

                // Make AJAX POST Request
                $.ajax({
                    url: "/api/update-status-admin-reschedule", // API endpoint
                    type: "POST",
                    data: {
                        parcel_id: parcelId,
                        created_user_id: created_user_id,
                        notes: notes,
                        date: date,
                        Re_schedule_type: Re_schedule_type,
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                    },
                    success: function (response) {
                        document
                            .querySelector("#cancelledForm .custom-btn")
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
                    },
                    complete: function () {
                        // Re-enable Save Button
                        $(".btn-primary").html("Save").prop("disabled", false);
                    },
                });
            }
        );
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Listen for all modal trigger clicks
        let ajexTable = document.getElementById("ajexTable");
        if (ajexTable) {
            ajexTable.addEventListener("click", function (e) {
                const button = e.target.closest('[data-bs-toggle="modal"]');
                if (button) {
                    const parcelId = button.getAttribute("data-id");
                    if (parcelId) {
                        document.getElementById(
                            "parcel_id_input_hidden"
                        ).value = parcelId;
                    }
                }
            });
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Listen for all modal trigger clicks
        document
            .querySelectorAll('[data-bs-toggle="modal"]')
            .forEach(function (button) {
                button.addEventListener("click", function () {
                    // Get the ID from the clicked button's data-id attribute
                    const vehiclelId = this.getAttribute("vehicle-id");
                    const containerhistoryid = this.getAttribute(
                        "container-history-id"
                    );

                    // Store the ID in the hidden input field
                    if (vehiclelId) {
                        document.getElementById(
                            "vehicle_id_input_hidden"
                        ).value = vehiclelId;

                        document.getElementById(
                            "container_history_id_input_hidden"
                        ).value = containerhistoryid;
                    }
                });
            });
    });

    document.addEventListener("DOMContentLoaded", function () {
        console.log("DOMContentLoaded fired");
        setTimeout(() => {
            document.querySelectorAll(".pickup-tooltip").forEach(function (el) {
                const tooltipHTML = el.getAttribute("data-tooltip-html");
                if (tooltipHTML) {
                    tippy(el, {
                        content: tooltipHTML,
                        allowHTML: true,
                        theme: "light-border",
                        placement: "top",
                        animation: "shift-away-subtle",
                        delay: [0, 0], // ⏱ instantly open and close
                    });
                }
            });
        }, 1000); // 1 second delay for DOM stability
    });
})(jQuery);
