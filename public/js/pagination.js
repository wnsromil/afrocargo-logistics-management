document.addEventListener("DOMContentLoaded", function () {
    paginate()
    function paginate(obj={}){
        const { searchIn='searchInput', ajexTable='ajexTable',pageSizeSlt='pageSizeSelect' } =obj;
        const searchInput = document.getElementById(searchIn);
        const pageSizeSelect = document.getElementById(ajexTable);

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
        if(pageSizeSelect){
            pageSizeSelect.addEventListener("change", function (event) {
                console.log("Page size changed");
                if (event.target.closest(".form-select")) {
                    // let selectedValue = this.value;
                    let selectedValue = document.getElementById(pageSizeSlt).value;
                    let url = new URL(window.location.href);
        
                    url.searchParams.set("per_page", selectedValue);
                    url.searchParams.set("page", 1); // Reset pagination on page size change
                    updateTable(url);
                }
            });
        }

        // 🔹 3. Handle Pagination Clicks (Event Delegation)
        document.addEventListener("click", function (event) {
            if (event.target.closest(".pagination a")) {
                event.preventDefault();
                let url = event.target.getAttribute("href");
                updateTable(url);
            }
        });

        // 🔹 1. Handle Search Input
        if(searchInput){
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
        }
        initializeSorting();
        //sort icon code function sort  trigger
        function initializeSorting() {
            const headers = document.querySelectorAll("#"+ajexTable+" table th");
            if(headers){
                headers.forEach((header, index) => {
                    // Add sort-icon span if not present
                    let iconSpan = header.querySelector(".sort-icon");
                    if (!iconSpan) {
                        // Create the sort-icon container
                        iconSpan = document.createElement("span");
                        iconSpan.classList.add("sort-icon");
            
                        // Create up and down arrows
                        const upArrow = document.createElement("span");
                        upArrow.classList.add("up");
                        upArrow.textContent = "▲";
            
                        const downArrow = document.createElement("span");
                        downArrow.classList.add("down");
                        downArrow.textContent = "▼";
            
                        // Append arrows
                        iconSpan.appendChild(upArrow);
                        iconSpan.appendChild(downArrow);
            
                        header.appendChild(iconSpan);
                    }
            
                    header.dataset.asc = "true"; // Default to ascending
            
                    header.addEventListener("click", () => {
                        sortTable(header, index);
                    });
                });
            
                // Optional: Default sort first column
                const firstHeader = headers[0];
                if (firstHeader) {
                    // sortTable(firstHeader, 0);
                }
            }
        }
        
        // sort data by 

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

            // Clear all icons
            table.querySelectorAll(".sort-icon").forEach(icon => {
                icon.classList.remove("active-asc", "active-desc");
            });

            // Set active icon
            const icon = header.querySelector(".sort-icon");
            if (icon) {
                icon.classList.add(asc ? "active-asc" : "active-desc");
            }

            // Append sorted rows
            rows.forEach(row => tbody.appendChild(row));

            // Toggle sort direction
            header.dataset.asc = (!asc).toString();
        }

    }
    
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

