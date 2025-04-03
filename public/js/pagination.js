document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const pageSizeSelect = document.getElementById("ajexTable");

    function updateTable(url) {
        // ✅ Push new URL to browser history (without reloading)
        window.history.pushState({}, "", url);

        // ✅ Fetch updated data using AJAX
        fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
            .then(response => response.text())
            .then(html => {
                document.getElementById("ajexTable").innerHTML = html;
            })
            .catch(error => console.error("Error fetching data:", error));
    }

    // 🔹 1. Handle Search Input
    searchInput.addEventListener("input", function () {
        let query = searchInput.value.trim();
        let url = new URL(window.location.href);

        if (query) {
            url.searchParams.set("search", query);
        } else {
            url.searchParams.delete("search");
        }
        url.searchParams.set("page", 1); // Reset pagination on new search
        updateTable(url);
    });

    // 🔹 2. Handle Per-Page Change
    pageSizeSelect.addEventListener("change", function () {
        // let selectedValue = this.value;
        let selectedValue = document.getElementById("pageSizeSelect").value;
        let url = new URL(window.location.href);

        url.searchParams.set("per_page", selectedValue);
        url.searchParams.set("page", 1); // Reset pagination on page size change
        updateTable(url);
    });

    // 🔹 3. Handle Pagination Clicks (Event Delegation)
    document.addEventListener("click", function (event) {
        if (event.target.closest(".pagination a")) {
            event.preventDefault();
            let url = event.target.getAttribute("href");
            updateTable(url);
        }
    });
});