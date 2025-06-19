document.addEventListener("DOMContentLoaded", function () {
    async function fetchAndDisplayDetails(selectedId, detailsContainerId) {
        if (!selectedId) return;

        try {
            const response = await fetch(`/bill-of-ladings/${selectedId}`);
            const data = await response.json();

            const container = document.querySelector(`#${detailsContainerId}`);
            if (container) {
                container.querySelector("#company").textContent =
                    data.company || "N/A";
                container.querySelector("#fullname").textContent =
                    data.name || "N/A";
                container.querySelector("#address").textContent =
                    data.address || "N/A";
                container.querySelector("#city").textContent =
                    data.city || "N/A";
                container.querySelector("#state").textContent =
                    data.state || "N/A";
            }
        } catch (error) {
            console.error("Error fetching details:", error);
        }
    }

    // Shipper select
    // Shipper select
    $("#shipperDetails_id").on("change", function () {
        fetchAndDisplayDetails(this.value, "shipperDetails");
    });

    $("#consigneeDetails_id").on("change", function () {
        fetchAndDisplayDetails(this.value, "consigneeDetails");
    });

    $("#saveform").on("click", function (event) {
        event.preventDefault();
        $("#lading_details").submit();
    });
});
