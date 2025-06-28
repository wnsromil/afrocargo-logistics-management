var countryOptionsData = {};

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

    const volume = length * width * height;
    volumeInput.value = volume;
}

// Add event listeners for live calculation
lengthInput.addEventListener("input", calculateVolume);
widthInput.addEventListener("input", calculateVolume);
heightInput.addEventListener("input", calculateVolume);

const originalCountryOptions = $("#country option").clone();
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

    let countryOptions =
        '<option value="" disabled selected>Select Country</option>';

    if (selectedValue === "Ocean Cargo" || selectedValue === "Air Cargo") {
        countryOptions += countryOptionsData
            .map((country) => {
                return `<option value="${country.name}" data-id="${country.id}">${country.name}</option>`;
            })
            .join("");
        $("#country").html(countryOptions);
    } else {
        $("#country").html(
            countryOptions +
                '<option data-id="233" value="United States">United States</option>'
        );
    }

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
    var oldState = "{{ old('state') }}"; // Laravel old value for state (name)
    var oldCity = "{{ old('city') }}"; // Laravel old value for city (name)

    // Page load par selected country ka data-id le lo
    var countryId = $("#country").find("option:selected").data("id");

    // Agar oldState ho to uske basis par states aur cities load karo
    if (oldState) {
        $("#state").html("<option selected>Loading...</option>");
        $.ajax({
            url: "/api/get-states/" + countryId,
            type: "GET",
            success: function (states) {
                $("#state").html('<option value="">Select State</option>');
                $.each(states, function (key, state) {
                    var selected = state.name == oldState ? "selected" : "";
                    $("#state").append(
                        '<option data-id="' +
                            state.id +
                            '" value="' +
                            state.name +
                            '" ' +
                            selected +
                            ">" +
                            state.name +
                            "</option>"
                    );
                });

                if (oldCity) {
                    $("#city").html("<option selected>Loading...</option>");
                    $.ajax({
                        url: "/api/get-cities/" + oldState,
                        type: "GET",
                        success: function (cities) {
                            $("#city").html(
                                '<option value="">Select City</option>'
                            );
                            $.each(cities, function (key, city) {
                                var selected =
                                    city.name == oldCity ? "selected" : "";
                                $("#city").append(
                                    '<option data-id="' +
                                        city.id +
                                        '" value="' +
                                        city.name +
                                        '" ' +
                                        selected +
                                        ">" +
                                        city.name +
                                        "</option>"
                                );
                            });
                        },
                    });
                }
            },
        });
    }

    // Jab country select change ho
    $("#country, #country_supply").change(function () {
        var countryId = $(this).find("option:selected").data("id");
        $("#state").html("<option selected>Loading...</option>");
        $("#state_supply").html("<option selected>Loading...</option>");
        $.ajax({
            url: "/api/get-states/" + countryId,
            type: "GET",
            success: function (states) {
                $("#state").html('<option value="">Select State</option>');
                $("#state_supply").html(
                    '<option value="">Select State</option>'
                );
                $.each(states, function (key, state) {
                    const option =
                        '<option data-id="' +
                        state.id +
                        '" value="' +
                        state.name +
                        '">' +
                        state.name +
                        "</option>";
                    $("#state").append(option);
                    $("#state_supply").append(option);
                });
            },
        });
    });

    // Jab state select change ho
    $("#state, #state_supply").change(function () {
        var stateName = $(this).find("option:selected").data("id");
        $("#city").html("<option selected>Loading...</option>");
        $("#city_supply").html("<option selected>Loading...</option>");

        $.ajax({
            url: "/api/get-cities/" + stateName,
            type: "GET",
            success: function (cities) {
                $("#city").html('<option value="">Select City</option>');
                $.each(cities, function (key, city) {
                    $("#city").append(
                        '<option data-id="' +
                            city.id +
                            '" value="' +
                            city.name +
                            '">' +
                            city.name +
                            "</option>"
                    );
                });
                $("#city_supply").html('<option value="">Select City</option>');
                $.each(cities, function (key, city) {
                    $("#city_supply").append(
                        '<option data-id="' +
                            city.id +
                            '" value="' +
                            city.name +
                            '">' +
                            city.name +
                            "</option>"
                    );
                });
            },
        });
    });
});
