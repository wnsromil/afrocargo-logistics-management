document.addEventListener("DOMContentLoaded", function () {
    paginate({
        showLoader: showLoader,
        hideLoader: hideLoader,
    });

    const dataTable = document.getElementById("ajexTable");

    if (dataTable) {
        const pageSizeSelect = dataTable.querySelector("#pageSizeSelect");

        if (pageSizeSelect) {
            document.addEventListener("change", function (e) {
                if (e.target && e.target.id === "pageSizeSelect") {
                    let selectedNumber = e.target.value ?? null;
                    console.log(
                        "Page size select changed (delegated)",
                        selectedNumber
                    );
                    paginate({
                        showLoader: showLoader,
                        hideLoader: hideLoader,
                    });
                }
            });
        }
    }

    function paginate(obj = {}) {
        const {
            searchIn = "searchInput",
            ajexTable = "ajexTable",
            pageSizeSlt = "pageSizeSelect",
            type = null,
            showLoader = false,
            hideLoader = false,
        } = obj;
        const ajxtbl = document.getElementById(ajexTable);
        const searchInput = document.querySelector(`#${searchIn}`);
        let pageSizeSelect = null;

        if (ajxtbl) {
            pageSizeSelect = ajxtbl.querySelector(`#${pageSizeSlt}`);
        }

        // Debounce utility
        function debounce(fn, delay) {
            let timer;
            return function (...args) {
                clearTimeout(timer);
                timer = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        // Debounced updateTable
        const debouncedUpdateTable = debounce(function (url) {
            // ✅ Push new URL to browser history (without reloading)
            window.history.pushState({}, "", url);

            if (showLoader) {
                showLoader();
            }
            // ✅ Fetch updated data using AJAX
            fetch(url + "&isAjaxPagination=1", {
                headers: { "X-Requested-With": "XMLHttpRequest" },
            })
                .then((response) => response.text())
                .then((html) => {
                    ajxtbl.innerHTML = html;
                    if (hideLoader) {
                        hideLoader();
                    }
                    initializeSorting();
                    if ($('[data-bs-toggle="tooltip"]')) {
                        console.log("Initializing tooltips");
                        setTimeout(() => {
                            $("#" + ajexTable)
                                .find('[data-bs-toggle="tooltip"]')
                                .each(function () {
                                    const $el = $(this);
                                    console.log(
                                        "Initializing tooltips for",
                                        $el
                                    );
                                    // Pull HTML from the custom attribute, if present
                                    const htmlContent =
                                        $el.attr("data-tooltip-html");
                                    if (htmlContent) {
                                        console.log(
                                            "Initializing tooltips attr",
                                            htmlContent
                                        );
                                        $el.attr({
                                            "data-bs-title": htmlContent, // Bootstrap 5 looks here for title
                                            "data-bs-html": "true", // element‑level HTML flag
                                        });
                                    }
                                })
                                .tooltip({
                                    container: "body",
                                    html: true,
                                    trigger: "hover focus",
                                });
                        }, 1000);
                    }
                })
                .catch((error) => {
                    if (hideLoader) {
                        hideLoader();
                    }
                    console.error("Error fetching data:", error);
                });
        }, 300);

        // Use debouncedUpdateTable instead of updateTable
        function updateTable(url) {
            debouncedUpdateTable(url);
        }

        // 🔹 2. Handle Per-Page Change
        if (pageSizeSelect) {
            let selectedValue = pageSizeSelect.value;
            let url = new URL(window.location.href);

            url.searchParams.set("per_page", selectedValue);
            url.searchParams.set("page", 1); // Reset pagination
            if (type) {
                url.searchParams.set("type", type); // ✅ Add type if provided
            }
            updateTable(url);
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

        // 🔹 4. Handle Pagination Clicks (Event Delegation)
        if (ajxtbl) {
            ajxtbl.addEventListener("click", function (event) {
                if (event.target.closest(".pagination a")) {
                    event.preventDefault();
                    let url = event.target.getAttribute("href");
                    updateTable(url);
                }
            });
        }

        initializeSorting();

        // 🔹 5. Sorting Functionality
        function initializeSorting() {
            const headers = document.querySelectorAll(`#${ajexTable} table th`);
            if (headers) {
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

            table.querySelectorAll(".sort-icon").forEach((icon) => {
                icon.classList.remove("active-asc", "active-desc");
            });

            const icon = header.querySelector(".sort-icon");
            if (icon) {
                icon.classList.add(asc ? "active-asc" : "active-desc");
            }

            rows.forEach((row) => tbody.appendChild(row));

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
