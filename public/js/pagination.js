document.addEventListener("DOMContentLoaded", function () {
    paginate();

    function paginate(obj = {}) {
        const {
            searchIn = 'searchInput',
            ajexTable = 'ajexTable',
            pageSizeSlt = 'pageSizeSelect',
            type = null
        } = obj;

        const searchInput = document.getElementById(searchIn);
        const pageSizeSelect = document.getElementById(pageSizeSlt);

        function updateTable(url) {
            // ✅ Push new URL to browser history (without reloading)
            window.history.pushState({}, "", url);

            // ✅ Fetch updated data using AJAX
            fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
                .then((response) => response.text())
                .then((html) => {
                    document.getElementById(ajexTable).innerHTML = html;
                    initializeSorting();
                })
                .catch((error) => console.error("Error fetching data:", error));
        }

        // 🔹 2. Handle Per-Page Change
        if (pageSizeSelect) {
            pageSizeSelect.addEventListener("change", function (event) {
                if (event.target.closest(".form-select")) {
                    let selectedValue = pageSizeSelect.value;
                    let url = new URL(window.location.href);

                    url.searchParams.set("per_page", selectedValue);
                    url.searchParams.set("page", 1); // Reset pagination
                    if (type) {
                        url.searchParams.set("type", type); // ✅ Add type if provided
                    }
                    updateTable(url);
                }
            });
        }

        // 🔹 3. Handle Search Input
        if (searchInput) {
            searchInput.addEventListener("input", function () {
                let query = searchInput.value.trim();
                let url = new URL(window.location.href);

                if (query) {
                    url.searchParams.set("search", query);
                } else {
                    url.searchParams.delete("search");
                }
                url.searchParams.set("page", 1); // Reset pagination
                if (type) {
                    url.searchParams.set("type", type); // ✅ Add type if provided
                }
                updateTable(url);
            });
        }

        // 🔹 4. Handle Pagination Clicks (if needed)
        document.addEventListener("click", function (event) {
            if (event.target.closest(".pagination a")) {
                // You can implement pagination click logic here
            }
        });

        initializeSorting();

        // 🔹 5. Sorting Functionality
        function initializeSorting() {
<<<<<<< HEAD
            const headers = document.querySelectorAll(`#${ajexTable} table th`);
            if(headers){
=======
            const headers = document.querySelectorAll("#" + ajexTable + " table th");
            if (headers) {
>>>>>>> 15f21d67ec2709acbe1448c436ba2f2d62d961b1
                headers.forEach((header, index) => {
                    let iconSpan = header.querySelector(".sort-icon");
                    if (!iconSpan) {
                        iconSpan = document.createElement("span");
                        iconSpan.classList.add("sort-icon");

                        const upArrow = document.createElement("span");
                        upArrow.classList.add("up");
                        upArrow.textContent = "▲";

                        const downArrow = document.createElement("span");
                        downArrow.classList.add("down");
                        downArrow.textContent = "▼";

                        iconSpan.appendChild(upArrow);
                        iconSpan.appendChild(downArrow);

                        header.appendChild(iconSpan);
                    }

                    header.dataset.asc = "true";

                    header.addEventListener("click", () => {
                        sortTable(header, index);
                    });
                });

                const firstHeader = headers[0];
                if (firstHeader) {
                    // Optional: default sort
                    // sortTable(firstHeader, 0);
                }
            }
        }

        function sortTable(header, index) {
            const table = header.closest("table");
            const tbody = table.querySelector("tbody");
            const rows = Array.from(tbody.querySelectorAll("tr"));
            const asc = header.dataset.asc === "true";
            rows.sort((a, b) => {
                const cellA = a.children[index].textContent.trim();
                const cellB = b.children[index].textContent.trim();
                const valA = isNaN(cellA) ? cellA.toLowerCase() : Number(cellA);
                const valB = isNaN(cellB) ? cellB.toLowerCase() : Number(cellB);
                if (valA < valB) return asc ? -1 : 1;
                if (valA > valB) return asc ? 1 : -1;
                return 0;
            });

            table.querySelectorAll(".sort-icon").forEach(icon => {
                icon.classList.remove("active-asc", "active-desc");
            });

            const icon = header.querySelector(".sort-icon");
            if (icon) {
                icon.classList.add(asc ? "active-asc" : "active-desc");
            }

            rows.forEach(row => tbody.appendChild(row));

            header.dataset.asc = (!asc).toString();
        }
    }

    // 🔹 6. Sort Icon Styles
    const style = document.createElement("style");
    style.textContent = `
    .sort-icon {
        margin-left: 6px;
        font-size: 0.8em;
    }
    .sort-icon .up, .sort-icon .down {
        color: #ccc;
    }
    .sort-icon.active-asc .up {
        color: black;
    }
    .sort-icon.active-desc .down {
        color: black;
    }
    `;
    document.head.appendChild(style);
});
