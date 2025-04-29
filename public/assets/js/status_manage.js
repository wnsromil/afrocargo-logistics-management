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

    document.addEventListener("DOMContentLoaded", function () {
        // Listen for all modal trigger clicks
        document
            .querySelectorAll('[data-bs-toggle="modal"]')
            .forEach(function (button) {
                button.addEventListener("click", function () {
                    // Get the ID from the clicked button's data-id attribute
                    const parcelId = this.getAttribute("data-id");

                    // Store the ID in the hidden input field
                    document.getElementById("parcel_id_input_hidden").value =
                        parcelId;
                });
            });
    });
   
})(jQuery);
