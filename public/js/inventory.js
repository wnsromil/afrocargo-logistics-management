$('input[name="retail_vaule_price"], input[name="retail_shipping_price"]').on(
    "input",
    function (e) {
        const input = $(e.target).val();
        $('input[name="price"]').val(input);
    }
);
const insuranceRadios = document.querySelectorAll(
    'input[name="insurance_have"]'
);
const insuranceInput = document.getElementById("insurance");

insuranceRadios.forEach((radio) => {
    radio.addEventListener("change", function () {
        if (this.value.toLowerCase() === "yes") {
            insuranceInput.removeAttribute("readonly");
            insuranceInput.removeAttribute("style"); // style remove kar diya
        } else {
            insuranceInput.setAttribute("readonly", true);
            insuranceInput.value = ""; // Optional: clear field on No
            insuranceInput.style.backgroundColor = "#ececec"; // Example style for readonly
        }
    });
});

const lengthInput = document.getElementById("length");
const widthInput = document.getElementById("width");
const heightInput = document.getElementById("height");
const volumeInput = document.getElementById("volume");

function calculateVolume() {
    const length = parseFloat(lengthInput.value) || 0;
    const width = parseFloat(widthInput.value) || 0;
    const height = parseFloat(heightInput.value) || 0;

    const volume = ((length * width * height) / 1000000).toFixed(0);

    volumeInput.value = volume;
}

// Add event listeners for live calculation
lengthInput.addEventListener("input", calculateVolume);
widthInput.addEventListener("input", calculateVolume);
heightInput.addEventListener("input", calculateVolume);

const originalCountryOptions = $("#country_inventory option").clone();
function updateInventoryDivs(selectedValue) {
    // === Existing UI Visibility Logic ===
    if (selectedValue === "Ocean Cargo" || selectedValue === "Air Cargo") {
        document.getElementById("cargoDiv").style.display = "block";
        document.getElementById("low_stock_warning").style.display = "none";
        document.getElementById("minimum_order_limit").style.display = "none";
        document.getElementById("retail_vaule_price").style.display = "none";
        document.getElementById("retail_shipping_price").style.display =
            "block";
        document.getElementById("CargoTagDiv").style.display = "block";
        document.getElementById("SupplyTagDiv").style.display = "none";
        document.getElementById("capacityDiv").style.display = "none";
        document.getElementById("weightPriceDiv").style.display = "block";
    } else {
        document.getElementById("cargoDiv").style.display = "none";
        document.getElementById("low_stock_warning").style.display = "block";
        document.getElementById("minimum_order_limit").style.display = "block";
        document.getElementById("retail_vaule_price").style.display = "block";
        document.getElementById("retail_shipping_price").style.display = "none";
        document.getElementById("SupplyTagDiv").style.display = "block";
        document.getElementById("CargoTagDiv").style.display = "none";
        document.getElementById("capacityDiv").style.display = "block";
        document.getElementById("weightPriceDiv").style.display = "none";
    }

    document.getElementById("supplyDiv").style.display =
        selectedValue === "Supply" ? "block" : "none";

    // === Country Select Box Logic ===
}

document
    .querySelectorAll('input[name="inventary_sub_type"]')
    .forEach(function (radio) {
        radio.addEventListener("change", function () {
            updateInventoryDivs(this.value);
        });
    });

// ✅ Page load par bhi selected radio check karo
window.addEventListener("DOMContentLoaded", function () {
    const checkedRadio = document.querySelector(
        'input[name="inventary_sub_type"]:checked'
    );
    if (checkedRadio) {
        updateInventoryDivs(checkedRadio.value);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    let statusToggle = document.getElementById("status");
    let activeText = document.getElementById("activeText");
    let inactiveText = document.getElementById("inactiveText");
    function updateTextColor() {
        if (statusToggle.checked) {
            activeText.classList.add("bold");
            inactiveText.classList.remove("bold");
        } else {
            activeText.classList.remove("bold");
            inactiveText.classList.add("bold");
        }
    }
    // updateTextColor();
    statusToggle.addEventListener("change", updateTextColor);
});

document
    .getElementById("inventory_image")
    .addEventListener("change", function (event) {
        const preview = document.getElementById("preview");
        preview.innerHTML = ""; // Clear previous previews
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.style.maxWidth = "100%";
                img.style.height = "auto";
                img.classList.add("mt-2", "img-thumbnail");
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
            $("#upload_inventory_image").hide();
        }
    });

$(document).ready(function () {
    const oldStateName = "{{ old('state') }}";
    const oldCityName = "{{ old('city') }}";

    // ✅ Load cities based on state ID and selected city name
    function loadCities(stateId, selectedCityName = null) {
        if (!stateId) return;

        $("#city_inventory").html("<option selected>Loading...</option>");
        $("#city_inventory_supply").html(
            "<option selected>Loading...</option>"
        );

        $.ajax({
            url: "/api/get-cities/" + stateId,
            type: "GET",
            success: function (cities) {
                $("#city_inventory").html(
                    '<option value="">Select City</option>'
                );
                $("#city_inventory_supply").html(
                    '<option value="">Select City</option>'
                );

                $.each(cities, function (key, city) {
                    const selected =
                        city.name === selectedCityName ? "selected" : "";
                    const option = `<option data-id="${city.id}" value="${city.name}" ${selected}>${city.name}</option>`;
                    $("#city_inventory").append(option);
                    $("#city_inventory_supply").append(option);
                });
            },
        });
    }

    // ✅ Load states based on country ID and selected state name
    function loadStates(
        countryId,
        selectedStateName = null,
        selectedCityName = null
    ) {
        if (!countryId) return;

        $("#state_inventory").html("<option selected>Loading...</option>");
        $("#state_inventory_supply").html(
            "<option selected>Loading...</option>"
        );

        $.ajax({
            url: "/api/get-states/" + countryId,
            type: "GET",
            success: function (states) {
                $("#state_inventory").html(
                    '<option value="">Select State</option>'
                );
                $("#state_inventory_supply").html(
                    '<option value="">Select State</option>'
                );

                let matchedStateId = null;

                $.each(states, function (key, state) {
                    const selected =
                        state.name === selectedStateName ? "selected" : "";
                    const option = `<option data-id="${state.id}" value="${state.name}" ${selected}>${state.name}</option>`;
                    $("#state_inventory").append(option);
                    $("#state_inventory_supply").append(option);

                    if (state.name === selectedStateName) {
                        matchedStateId = state.id;
                    }
                });

                // ✅ Call city loader only when matched state is found
                if (matchedStateId && selectedCityName) {
                    loadCities(matchedStateId, selectedCityName);
                }
            },
        });
    }

    // ✅ Page load: handle old state & city
    const selectedCountry = $("#country_inventory").find("option:selected");
    const countryId = selectedCountry.data("id");

    if (countryId && oldStateName) {
        loadStates(countryId, oldStateName, oldCityName);
    }

    // ✅ Country change → load states (no old value in this case)
    $("#country_inventory, #country_inventory_supply").on(
        "change",
        function () {
            const countryId = $(this).find("option:selected").data("id");
            loadStates(countryId); // No old values here
        }
    );

    // ✅ State change → debounce city load
    let debounceTimer;
    $("#state_inventory, #state_inventory_supply").on("change", function () {
        clearTimeout(debounceTimer);
        const stateId = $(this).find("option:selected").data("id");
        if (!stateId) return;

        debounceTimer = setTimeout(() => {
            loadCities(stateId);
        }, 300);
    });
});
