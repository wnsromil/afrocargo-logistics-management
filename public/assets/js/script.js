/*
Author       : Dreamguys
Template Name: Kanakku - Bootstrap Admin Template
Version      : 1.0
*/

(function ($) {
    "use strict";

    // Variables declarations

    var $wrapper = $(".main-wrapper");
    var $pageWrapper = $(".page-wrapper");
    var $slimScrolls = $(".slimscroll");

    // Sidebar
    // var Sidemenu = function () {
    // 	this.$menuItem = $('#sidebar-menu a');
    // };

    // Sidebar
    var Sidemenu = () => {
        this.$menuItem = $("#sidebar-menu a");
    };

    function init() {
        var $this = Sidemenu;
        $("#sidebar-menu a").on("click", function (e) {
            if ($(this).parent().hasClass("submenu")) {
                e.preventDefault();
            }
            if (!$(this).hasClass("subdrop")) {
                $("ul", $(this).parents("ul:first")).slideUp(350);
                $("a", $(this).parents("ul:first")).removeClass("subdrop");
                $(this).next("ul").slideDown(350);
                $(this).addClass("subdrop");
            } else if ($(this).hasClass("subdrop")) {
                $(this).removeClass("subdrop");
                $(this).next("ul").slideUp(350);
            }
        });
        $("#sidebar-menu ul.sidebar-vertical li.submenu a.active")
            .parents("li:last")
            .children("a:first")
            .addClass("active")
            .trigger("click");
    }

    // image file upload cover-image image
    if ($("#cover-image").length > 0) {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#cover-image").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#cover_upload").change(function () {
            readURL(this);
        });
    }

    // Sidebar popup overlay

    if ($(".popup-toggle").length > 0) {
        $(".popup-toggle").click(function () {
            $(".toggle-sidebar").addClass("open-filter");
            $("body").addClass("filter-opened");
        });
        $(".sidebar-closes").click(function () {
            $(".toggle-sidebar").removeClass("open-filter");
            $("body").removeClass("filter-opened");
        });
    }

    if ($(".win-maximize").length > 0) {
        $(".win-maximize").on("click", function (e) {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });
    }

    //   View all Show hide One
    if ($(".viewall-One").length > 0) {
        $(document).ready(function () {
            $(".viewall-One").hide();
            $(".viewall-button-One").click(function () {
                $(this).text(
                    $(this).text() === "Close All" ? "View All" : "Close All"
                );
                $(".viewall-One").slideToggle(900);
            });
        });
    }

    //   View all Show hide Two
    if ($(".viewall-Two").length > 0) {
        $(document).ready(function () {
            $(".viewall-Two").hide();
            $(".viewall-button-Two").click(function () {
                $(this).text(
                    $(this).text() === "Close All" ? "View All" : "Close All"
                );
                $(".viewall-Two").slideToggle(900);
            });
        });
    }

    // image file upload image
    if ($("#blah").length > 0) {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#blah").attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#avatar_upload").change(function () {
            readURL(this);
        });
    }

    $(document).ready(function () {
        $("#image_sign").change(function () {
            $("#frames").html("");
            for (var i = 0; i < $(this)[0].files.length; i++) {
                $("#frames").append(
                    '<img src="' +
                        window.URL.createObjectURL(this.files[i]) +
                        '" width="100px" height="100px">'
                );
            }
        });
        $("#image_sign2").change(function () {
            $("#frames2").html("");
            for (var i = 0; i < $(this)[0].files.length; i++) {
                $("#frames2").append(
                    '<img src="' +
                        window.URL.createObjectURL(this.files[i]) +
                        '" width="100px" height="100px">'
                );
            }
        });
    });
    // Sidebar Initiate
    init();

    // Mobile menu sidebar overlay
    $("body").append('<div class="sidebar-overlay"></div>');
    $(document).on("click", "#mobile_btn", function () {
        $wrapper.toggleClass("slide-nav");
        $(".sidebar-overlay").toggleClass("opened");
        $("html").toggleClass("menu-opened");
        return false;
    });

    $(".invoice-star").on("click", function () {
        $(".invoice-blog").removeClass("active");
        $(this).parent().parent().addClass("active");
    });

    // Sidebar overlay
    $(".sidebar-overlay").on("click", function () {
        $wrapper.removeClass("slide-nav");
        $(".sidebar-overlay").removeClass("opened");
        $("html").removeClass("menu-opened");
    });

    // Page Content Height
    if ($(".page-wrapper").length > 0) {
        var height = $(window).height();
        $(".page-wrapper").css("min-height", height);
    }

    // Page Content Height Resize
    $(window).resize(function () {
        if ($(".page-wrapper").length > 0) {
            var height = $(window).height();
            $(".page-wrapper").css("min-height", height);
        }
    });

    // Select 2
    if ($(".select").length > 0) {
        $(".select").select2({
            minimumResultsForSearch: -1,
            width: "100%",
        });
    }

    // Datetimepicker

    if ($(".datetimepicker").length > 0) {
        $(".datetimepicker").datetimepicker({
            format: "MM-DD-YYYY",
            icons: {
                up: "fas fa-angle-up",
                down: "fas fa-angle-down",
                next: "fas fa-angle-right",
                previous: "fas fa-angle-left",
            },
        });
    }

    if ($(".summernote").length > 0) {
        //var editorheight = $('.editor-card').height()-100;
        $(".summernote").summernote({
            placeholder: "Description",
            focus: true,
            minHeight: 100,
            disableResizeEditor: false,
            toolbar: [
                ["fullscreen"],
                ["fontname", ["fontname"]],
                ["undo"],
                ["redo"],
                ["datetimepicker"],
                ["fontsize", ["fontsize"]],
                ["font", ["bold", "italic", "underline", "clear"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["insert", ["link", "picture"]],
            ],
            // set focus to editable area after initializing summernote
        });
    }

    // Date Range Picker

    if ($(".bookingrange").length > 0) {
        var start = moment().subtract(6, "days");
        var end = moment();

        function booking_range(start, end) {
            $(".bookingrange span").html(
                start.format("M/D/YYYY") + " - " + end.format("M/D/YYYY")
            );
        }

        $(".bookingrange").daterangepicker(
            {
                startDate: start,
                endDate: end,
                minDate: moment().startOf("day"), // Past Dates Disabled
                startDate: moment().startOf("day"), // Default Today Selected
                // ranges: {
                //     Today: [moment(), moment()],
                //     Yesterday: [
                //         moment().subtract(1, "days"),
                //         moment().subtract(1, "days"),
                //     ],
                //     "Last 7 Days": [moment().subtract(6, "days"), moment()],
                //     "Last 30 Days": [moment().subtract(29, "days"), moment()],
                //     "This Month": [
                //         moment().startOf("month"),
                //         moment().endOf("month"),
                //     ],
                //     "Last Month": [
                //         moment().subtract(1, "month").startOf("month"),
                //         moment().subtract(1, "month").endOf("month"),
                //     ],
                // },
                locale: {
                    format: "MM/DD/YYYY",
                },
            },
            booking_range
        );

        booking_range(start, end);
    }

    if ($(".Expensefillterdate").length > 0) {
        var start = moment().subtract(6, "days"); // 7 din pahle ka date
        var end = moment(); // Aaj ka date

        // Set input as readonly, placeholder, styles
        $(".Expensefillterdate")
            .attr("readonly", true)
            .attr(
                "placeholder",
                start.format("MM-DD-YYYY") + " - " + end.format("MM-DD-YYYY")
            )
            .css({
                cursor: "pointer",
                backgroundColor: "#ffffff",
            });

        function booking_range(start, end) {
            $(".Expensefillterdate").val(
                start.format("MM/DD/YYYY") + " - " + end.format("MM/DD/YYYY")
            );
        }

        $(".Expensefillterdate").daterangepicker(
            {
                autoUpdateInput: false,
                startDate: start,
                endDate: end,
                maxDate: moment().startOf("day"),
                locale: {
                    format: "MM/DD/YYYY",
                    cancelLabel: "Clear",
                },
            },
            function (start, end) {
                booking_range(start, end);
            }
        );

        $(".Expensefillterdate").on("cancel.daterangepicker", function () {
            $(this).val("");
        });
    }

    // Date Range Picker
    if ($('input[name="datetimes"]').length > 0) {
        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            startDate: moment().startOf("hour"),
            endDate: moment().startOf("hour").add(32, "hour"),
            locale: {
                format: "M/DD hh:mm A",
            },
        });
    }

    $(".onlyTimePicker").each(function () {
        const $this = $(this);

        $this.daterangepicker(
            {
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: false,
                timePickerSeconds: false,
                autoUpdateInput: false, // We'll handle it manually always
                locale: {
                    format: "hh:mm A",
                },
            },
            function (start) {
                // Always update value
                $this.val(start.format("hh:mm A"));
                $this.trigger("change"); // Optional: trigger change if needed
            }
        );

        // 🔁 Force update when Apply is clicked even without change
        $this.on("apply.daterangepicker", function (ev, picker) {
            $this.val(picker.startDate.format("hh:mm A"));
            $this.trigger("change");
        });

        // Optional: style
        $this.on("show.daterangepicker", function (ev, picker) {
            picker.container.addClass("myCustomPopup");
        });
    });

    $(".onlyTimePickerSchedule").each(function () {
        const $this = $(this);

        // ✅ Make input completely read-only (no typing)
        $this.attr("readonly", "readonly");
        $this.on("keydown paste", function (e) {
            e.preventDefault();
        });
        $this.attr("autocomplete", "off");
        $this.css({
            "background-color": "white",
            cursor: "pointer",
        });

        $this.daterangepicker(
            {
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: false,
                timePickerSeconds: false,
                autoUpdateInput: false,
                locale: {
                    format: "hh:mm A",
                },
                timePickerIncrement: 15,
            },
            function (start) {
                $this.val(start.format("hh:mm A"));
                $this.trigger("change");
            }
        );

        $this.on("apply.daterangepicker", function (ev, picker) {
            $this.val(picker.startDate.format("hh:mm A"));
            $this.trigger("change");
            validateTimeLogic($this);
        });

        $this.on("cancel.daterangepicker", function () {
            $this.val(""); // Clear input
        });

        $this.on("show.daterangepicker", function (ev, picker) {
            picker.container.addClass("myCustomPopup");
        });

        $this.val(""); // Default empty
    });

    // 🔐 Function to validate time logic between fields
    function validateTimeLogic($field) {
        const name = $field.attr("name");

        // Get time values of related fields
        const day = name.split("_")[0]; // Extract day name
        const timeType = name.split("_")[1]; // morning/afternoon/evening
        const startOrEnd = name.split("_")[2]; // start or end

        // Example: morning_start, morning_end logic
        const startField = $(`input[name="${day}_${timeType}_start"]`);
        const endField = $(`input[name="${day}_${timeType}_end"]`);

        const startTime = moment(startField.val(), "hh:mm A");
        const endTime = moment(endField.val(), "hh:mm A");

        // Validation logic
        if (startField.val() && endField.val()) {
            if (endTime.isBefore(startTime)) {
                Swal.fire({
                    title: "Oops...",
                    text: "End time can't be before start time!",
                    icon: "error",
                });
                endField.val(""); // Clear invalid input
            } else if (endTime.isSame(startTime)) {
                Swal.fire({
                    title: "Oops...",
                    text: "Start time and End time can't be same!",
                    icon: "error",
                });
                endField.val(""); // Clear invalid input
            }
        }
    }

    $(document).ready(function () {
        // Agar schedule data hai tabhi form ke andar values bharni hain
        if (Array.isArray(scheduleData) && scheduleData.length > 0) {
            scheduleData.forEach(function (entry) {
                const day = entry.day.toLowerCase();

                // Checkbox enable
                $("#" + day).prop("checked", true);
                $(`#${day}`).val("Inactive");
                $("." + day).removeClass("disablesection");

                // Set times if available
                if (entry.morning_start) {
                    $(`input[name="${day}_morning_start"]`).val(
                        moment(entry.morning_start, "HH:mm:ss").format(
                            "hh:mm A"
                        )
                    );
                }
                if (entry.morning_end) {
                    $(`input[name="${day}_morning_end"]`).val(
                        moment(entry.morning_end, "HH:mm:ss").format("hh:mm A")
                    );
                }
                if (entry.afternoon_start) {
                    $(`input[name="${day}_afternoon_start"]`).val(
                        moment(entry.afternoon_start, "HH:mm:ss").format(
                            "hh:mm A"
                        )
                    );
                }
                if (entry.afternoon_end) {
                    $(`input[name="${day}_afternoon_end"]`).val(
                        moment(entry.afternoon_end, "HH:mm:ss").format(
                            "hh:mm A"
                        )
                    );
                }
                if (entry.evening_start) {
                    $(`input[name="${day}_evening_start"]`).val(
                        moment(entry.evening_start, "HH:mm:ss").format(
                            "hh:mm A"
                        )
                    );
                }
                if (entry.evening_end) {
                    $(`input[name="${day}_evening_end"]`).val(
                        moment(entry.evening_end, "HH:mm:ss").format("hh:mm A")
                    );
                }
            });
        }

        // Checkbox change event to handle checked and unchecked actions
        $("input[type='checkbox']").on("change", function () {
            const day = $(this).attr("id");

            if (!$(this).prop("checked")) {
                // If unchecked, clear all fields and disable them
                $(`input[name="${day}_morning_start"]`)
                    .val("")
                    .prop("disabled", true);
                $(`input[name="${day}_morning_end"]`)
                    .val("")
                    .prop("disabled", true);
                $(`input[name="${day}_afternoon_start"]`)
                    .val("")
                    .prop("disabled", true);
                $(`input[name="${day}_afternoon_end"]`)
                    .val("")
                    .prop("disabled", true);
                $(`input[name="${day}_evening_start"]`)
                    .val("")
                    .prop("disabled", true);
                $(`input[name="${day}_evening_end"]`)
                    .val("")
                    .prop("disabled", true);

                // Disable day section and reset its value
                $("." + day).addClass("disablesection");
                $(`input[name="${day}_morning_start"]`).prop("readonly", true);
                $(`input[name="${day}_morning_end"]`).prop("readonly", true);
                $(`input[name="${day}_afternoon_start"]`).prop(
                    "readonly",
                    true
                );
                $(`input[name="${day}_afternoon_end"]`).prop("readonly", true);
                $(`input[name="${day}_evening_start"]`).prop("readonly", true);
                $(`input[name="${day}_evening_end"]`).prop("readonly", true);

                // Clear the value for day as well
                $(`#${day}`).val("");
            } else {
                // If checked, enable the day section and fields
                $("." + day).removeClass("disablesection");
                $(`input[name="${day}_morning_start"]`)
                    .prop("disabled", false)
                    .prop("readonly", false);
                $(`input[name="${day}_morning_end"]`)
                    .prop("disabled", false)
                    .prop("readonly", false);
                $(`input[name="${day}_afternoon_start"]`)
                    .prop("disabled", false)
                    .prop("readonly", false);
                $(`input[name="${day}_afternoon_end"]`)
                    .prop("disabled", false)
                    .prop("readonly", false);
                $(`input[name="${day}_evening_start"]`)
                    .prop("disabled", false)
                    .prop("readonly", false);
                $(`input[name="${day}_evening_end"]`)
                    .prop("disabled", false)
                    .prop("readonly", false);
            }
        });

        // Agar koi data nahi hai to default form hi dikhega (blank), jaisa abhi dikh raha hai
    });

    if ($(".daterangeInput").length > 0) {
        $(".daterangeInput").daterangepicker({
            timePicker: false,
            startDate: moment(),
            endDate: moment(),
            locale: {
                format: "DD/MM/YYYY",
            },
        });
    }
    // Expire Date Picker
    if ($('input[name="expire_date"]').length > 0) {
        $('input[name="expire_date"]').daterangepicker({
            singleDatePicker: true, // Single Date Picker Enable
            showDropdowns: true, // Month/Year Dropdown Enable
            minDate: moment().startOf("day"), // Past Dates Disabled
            startDate: moment().startOf("day"), // Default Today Selected
            autoUpdateInput: true, // Auto Update Input With Default Date
            locale: {
                format: "M/DD/YYYY", // Date Format
            },
        });

        // Date Select Hone Ke Baad Input Me Value Set Karo
        $('input[name="expire_date"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("M/DD/YYYY"));
            }
        );
    }

    if ($('input[name="signature_date"]').length > 0) {
        $('input[name="signature_date"]').daterangepicker({
            singleDatePicker: true, // Single Date Picker Enable
            showDropdowns: true, // Month/Year Dropdown Enable
            minDate: moment().startOf("day"), // Past Dates Disabled
            startDate: moment().startOf("day"), // Default Today Selected
            autoUpdateInput: true, // Auto Update Input With Default Date
            locale: {
                format: "M/DD/YYYY", // Date Format
            },
        });

        // Date Select Hone Ke Baad Input Me Value Set Karo
        $('input[name="signature_date"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("M/DD/YYYY"));
            }
        );
    }

    // Open Date Picker
    if ($('input[name="open_date"]').length > 0) {
        $('input[name="open_date"]').daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            maxDate: moment().endOf("day"),
            autoUpdateInput: false,
            locale: {
                format: "M/DD/YYYY",
            },
        });

        $('input[name="open_date"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(
                    picker.startDate.format("M/DD/YYYY") +
                        " - " +
                        picker.endDate.format("M/DD/YYYY")
                );
            }
        );
    }

    // Close Date Picker
    if ($('input[name="close_date"]').length > 0) {
        $('input[name="close_date"]').daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            maxDate: moment().endOf("day"),
            autoUpdateInput: false,
            locale: {
                format: "M/DD/YYYY",
            },
        });

        $('input[name="close_date"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(
                    picker.startDate.format("M/DD/YYYY") +
                        " - " +
                        picker.endDate.format("M/DD/YYYY")
                );
            }
        );
    }

    if ($('input[name="license_expiry_date"]').length > 0) {
        $('input[name="license_expiry_date"]').daterangepicker({
            singleDatePicker: true, // Single Date Picker Enable
            showDropdowns: true, // Month/Year Dropdown Enable
            minDate: moment().startOf("day"), // Past Dates Disabled
            startDate: moment().startOf("day"), // Default Today Selected
            autoUpdateInput: false, // Auto Update Input With Default Date
            locale: {
                format: "M/DD/YYYY", // Date Format
            },
        });

        // Date Select Hone Ke Baad Input Me Value Set Karo
        $('input[name="license_expiry_date"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("M/DD/YYYY"));
            }
        );
    }

    if ($('input[name="edit_signature_date"]').length > 0) {
        const input = $('input[name="edit_signature_date"]');
        const inputVal = input.val(); // Get value from input

        let defaultDate = moment().startOf("day"); // Default today's date

        // If input value exists, parse it as moment date
        if (inputVal) {
            defaultDate = moment(inputVal, "M/D/YYYY");
        }

        input.daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: moment().startOf("day"),
            startDate: defaultDate, // Use parsed date from input
            autoUpdateInput: false,
            locale: {
                format: "M/DD/YYYY",
            },
        });

        input.on("apply.daterangepicker", function (ev, picker) {
            $(this).val(picker.startDate.format("M/DD/YYYY"));
        });
    }

    if ($('input[name="edit_license_expiry_date"]').length > 0) {
        const input = $('input[name="edit_license_expiry_date"]');
        const inputVal = input.val(); // Get value from input

        let defaultDate = moment().startOf("day"); // Default today's date

        // If input value exists, parse it as moment date
        if (inputVal) {
            defaultDate = moment(inputVal, "M/D/YYYY");
        }

        input.daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: moment().startOf("day"),
            startDate: defaultDate, // Use parsed date from input
            autoUpdateInput: false,
            locale: {
                format: "M/DD/YYYY",
            },
        });

        input.on("apply.daterangepicker", function (ev, picker) {
            $(this).val(picker.startDate.format("M/DD/YYYY"));
        });
    }

    if ($('input[name="edit_license_expiry_date"]').length > 0) {
        $('input[name="edit_license_expiry_date"]').daterangepicker({
            singleDatePicker: true, // Single Date Picker Enable
            showDropdowns: true, // Month/Year Dropdown Enable
            minDate: moment().startOf("day"), // Past Dates Disabled
            // startDate: moment().startOf("day"), // Default Today Selected (COMMENTED)
            autoUpdateInput: true, // Auto Update Input With Default Date
            locale: {
                format: "M/DD/YYYY", // Date Format
            },
        });

        // Date Select Hone Ke Baad Input Me Value Set Karo
        $('input[name="edit_license_expiry_date"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("M/DD/YYYY"));
            }
        );
    }

    if ($('input[name="license_expiry_date"]').length > 0) {
        $('input[name="license_expiry_date"]').daterangepicker({
            singleDatePicker: true, // Single Date Picker Enable
            showDropdowns: true, // Month/Year Dropdown Enable
            minDate: moment().startOf("day"), // Past Dates Disabled
            autoUpdateInput: false, // Default Date Auto Set Na Ho
            locale: {
                format: "M/DD/YYYY", // Date Format
            },
        });

        // Date Select Hone Ke Baad Input Me Value Set Karo
        $('input[name="license_expiry_date"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("M/DD/YYYY"));
            }
        );

        // Placeholder Set Karne Ke Liye
        $('input[name="license_expiry_date"]').attr(
            "placeholder",
            "MM-DD-YYYY"
        );
    }

    if ($('input[name="expense_date"]').length > 0) {
        $('input[name="expense_date"]').daterangepicker({
            singleDatePicker: true, // Single Date Picker Enable
            showDropdowns: true, // Month/Year Dropdown Enable
            maxDate: moment().startOf("day"), // Past Dates Disabled
            startDate: moment().startOf("day"), // Default Today Selected
            autoUpdateInput: true, // Auto Update Input With Default Date
            locale: {
                format: "MM/DD/YYYY", // Date Format
            },
        });

        // Date Select Hone Ke Baad Input Me Value Set Karo
        $('input[name="expense_date"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("MM/DD/YYYY"));
            }
        );
    }

    if ($('input[name="edit_expense_date"]').length > 0) {
        $('input[name="edit_expense_date"]').daterangepicker({
            singleDatePicker: true, // Single Date Picker Enable
            showDropdowns: true, // Month/Year Dropdown Enable
            maxDate: moment().startOf("day"), // Past Dates Disabled
            startDate: moment().startOf("day"), // Default Today Selected
            autoUpdateInput: false, // Auto Update Input With Default Date
            locale: {
                format: "MM/DD/YYYY", // Date Format
            },
        });

        // Date Select Hone Ke Baad Input Me Value Set Karo
        $('input[name="edit_expense_date"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("MM/DD/YYYY"));
            }
        );
    }

    if ($('input[name="driverInventoryDate"]').length > 0) {
        $('input[name="driverInventoryDate"]').daterangepicker({
            singleDatePicker: true, // Single Date Picker Enable
            showDropdowns: true, // Month/Year Dropdown Enable
            maxDate: moment().startOf("day"), // Past Dates Disabled
            startDate: moment().startOf("day"), // Default Today Selected
            autoUpdateInput: true, // Auto Update Input With Default Date
            locale: {
                format: "MM/DD/YYYY", // Date Format
            },
        });

        // Date Select Hone Ke Baad Input Me Value Set Karo
        $('input[name="driverInventoryDate"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("MM/DD/YYYY"));
            }
        );
    }

    // Sidebar Slimscroll

    if ($slimScrolls.length > 0) {
        $slimScrolls.slimScroll({
            height: "auto",
            width: "100%",
            position: "right",
            size: "7px",
            color: "#7539FF",
            allowPageScroll: false,
            wheelStep: 10,
            touchScrollStep: 100,
            opacity: 1,
        });
        var wHeight = $(window).height() - 60;
        $slimScrolls.height(wHeight);
        $(".sidebar .slimScrollDiv").height(wHeight);
        $(window).resize(function () {
            var rHeight = $(window).height() - 60;
            $slimScrolls.height(rHeight);
            $(".sidebar .slimScrollDiv").height(rHeight);
        });
    }

    // Password Show

    if ($(".toggle-password").length > 0) {
        $(document).on("click", ".toggle-password", function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $(".pass-input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }

    if ($(".toggle-password-two").length > 0) {
        $(document).on("click", ".toggle-password-two", function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $(".pass-input-two");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }

    // Check all email

    $(document).on("click", "#check_all", function () {
        $(".checkmail").click();
        return false;
    });
    if ($(".checkmail").length > 0) {
        $(".checkmail").each(function () {
            $(this).on("click", function () {
                if ($(this).closest("tr").hasClass("checked")) {
                    $(this).closest("tr").removeClass("checked");
                } else {
                    $(this).closest("tr").addClass("checked");
                }
            });
        });
    }

    // Mail important

    $(document).on("click", ".mail-important", function () {
        $(this).find("i.fa").toggleClass("fa-star").toggleClass("fa-star-o");
    });

    // Small Sidebar
    $(document).on("click", "#toggle_btn", function () {
        console.log("check check");
        if ($("body").hasClass("mini-sidebar")) {
            $("body").removeClass("mini-sidebar");
            $(".subdrop + ul").slideDown();
        } else {
            $("body").addClass("mini-sidebar");
            $(".subdrop + ul").slideUp();
        }
        setTimeout(function () {
            // mA.redraw();
            // mL.redraw();
        }, 300);
        return false;
    });

    $(document).on("mouseover", function (e) {
        e.stopPropagation();
        if (
            $("body").hasClass("mini-sidebar") &&
            $("#toggle_btn").is(":visible")
        ) {
            var targ = $(e.target).closest(".sidebar").length;
            if (targ) {
                $("body").addClass("expand-menu");
                $(".subdrop + ul").slideDown();
            } else {
                $("body").removeClass("expand-menu");
                $(".subdrop + ul").slideUp();
            }
            return false;
        }
    });

    $(document).on("click", "#filter_search", function () {
        $("#filter_inputs").slideToggle("slow");
    });

    if ($(".custom-file-container").length > 0) {
        //First upload
        var firstUpload = new FileUploadWithPreview("myFirstImage");
        //Second upload
        var secondUpload = new FileUploadWithPreview("mySecondImage");
    }

    // Clipboard

    if ($(".clipboard").length > 0) {
        var clipboard = new Clipboard(".btn");
    }

    // Summernote

    if ($("#summernote").length > 0) {
        $("#summernote").summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true, // set focus to editable area after initializing summernote
        });
    }
    // editor
    if ($("#editor").length > 0) {
        ClassicEditor.create(document.querySelector("#editor"), {
            toolbar: {
                items: [
                    "heading",
                    "|",
                    "fontfamily",
                    "fontsize",
                    "|",
                    "alignment",
                    "|",
                    "fontColor",
                    "fontBackgroundColor",
                    "|",
                    "bold",
                    "italic",
                    "strikethrough",
                    "underline",
                    "subscript",
                    "superscript",
                    "|",
                    "link",
                    "|",
                    "outdent",
                    "indent",
                    "|",
                    "bulletedList",
                    "numberedList",
                    "todoList",
                    "|",
                    "code",
                    "codeBlock",
                    "|",
                    "insertTable",
                    "|",
                    "uploadImage",
                    "blockQuote",
                    "|",
                    "undo",
                    "redo",
                ],
                shouldNotGroupWhenFull: true,
            },
        })
            .then((editor) => {
                window.editor = editor;
            })
            .catch((err) => {
                console.error(err.stack);
            });
    }
    // Tooltip

    if ($('[data-bs-toggle="tooltip"]').length > 0) {
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Popover

    if ($(".popover-list").length > 0) {
        var popoverTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="popover"]')
        );
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    }

    // Counter

    if ($(".counter").length > 0) {
        $(".counter").counterUp({
            delay: 20,
            time: 2000,
        });
    }

    if ($("#timer-countdown").length > 0) {
        $("#timer-countdown").countdown({
            from: 180, // 3 minutes (3*60)
            to: 0, // stop at zero
            movingUnit: 1000, // 1000 for 1 second increment/decrements
            timerEnd: undefined,
            outputPattern: "$day Day $hour : $minute : $second",
            autostart: true,
        });
    }

    if ($("#timer-countup").length > 0) {
        $("#timer-countup").countdown({
            from: 0,
            to: 180,
        });
    }

    if ($("#timer-countinbetween").length > 0) {
        $("#timer-countinbetween").countdown({
            from: 30,
            to: 20,
        });
    }

    if ($("#timer-countercallback").length > 0) {
        $("#timer-countercallback").countdown({
            from: 10,
            to: 0,
            timerEnd: function () {
                this.css({ "text-decoration": "line-through" }).animate(
                    { opacity: 0.5 },
                    500
                );
            },
        });
    }

    if ($("#timer-outputpattern").length > 0) {
        $("#timer-outputpattern").countdown({
            outputPattern: "$day Days $hour Hour $minute Min $second Sec..",
            from: 60 * 60 * 24 * 3,
        });
    }

    // Chat

    var chatAppTarget = $(".chat-window");
    (function () {
        if ($(window).width() > 992) chatAppTarget.removeClass("chat-slide");

        $(document).on(
            "click",
            ".chat-window .chat-users-list a.chat-block",
            function () {
                if ($(window).width() <= 992) {
                    chatAppTarget.addClass("chat-slide");
                }
                return false;
            }
        );
        $(document).on("click", "#back_user_list", function () {
            if ($(window).width() <= 992) {
                chatAppTarget.removeClass("chat-slide");
            }
            return false;
        });
    })();

    // Checkbox Select

    $(".app-listing .selectbox").on("click", function () {
        $(this).parent().find("#checkboxes").fadeToggle();
        $(this).parent().parent().siblings().find("#checkboxes").fadeOut();
    });

    $(".invoices-main-form .selectbox").on("click", function () {
        $(this).parent().find("#checkboxes-one").fadeToggle();
        $(this).parent().parent().siblings().find("#checkboxes-one").fadeOut();
    });

    //Checkbox Select

    if ($(".sortby").length > 0) {
        var show = true;
        var checkbox1 = document.getElementById("checkbox");
        $(".selectboxes").on("click", function () {
            if (show) {
                checkbox1.style.display = "block";
                show = false;
            } else {
                checkbox1.style.display = "none";
                show = true;
            }
        });
    }

    // Invoices Checkbox Show

    $(function () {
        $("input[name='invoice']").click(function () {
            if ($("#chkYes").is(":checked")) {
                $("#show-invoices").show();
            } else {
                $("#show-invoices").hide();
            }
        });
    });

    // Invoices Add More

    $(".links-info-one").on("click", ".service-trash", function () {
        $(this).closest(".links-cont").remove();
        return false;
    });

    $(document).on("click", ".add-links", function () {
        var experiencecontent =
            '<div class="links-cont">' +
            '<div class="service-amount">' +
            '<a href="#" class="service-trash"><i class="fe fe-minus-circle me-1"></i>Service Charge</a> <span>$4</span' +
            "</div>" +
            "</div>";

        $(".links-info-one").append(experiencecontent);
        return false;
    });

    $(".links-info-discount").on("click", ".service-trash-one", function () {
        $(this).closest(".links-cont-discount").remove();
        return false;
    });

    $(document).on("click", ".add-links-one", function () {
        var experiencecontent =
            '<div class="links-cont-discount">' +
            '<div class="service-amount">' +
            '<a href="#" class="service-trash-one"><i class="fe fe-minus-circle me-1"></i>Offer new</a> <span>$4 %</span' +
            "</div>" +
            "</div>";

        $(".links-info-discount").append(experiencecontent);
        return false;
    });

    // Invoices Table Add More

    $(".add-table-items").on("click", ".remove-btn", function () {
        $(this).closest(".add-row").remove();
        return false;
    });

    $(document).on("click", ".add-btn", function () {
        var experiencecontent =
            '<tr class="add-row">' +
            "<td>" +
            '<input type="text" class="form-control">' +
            "</td>" +
            "<td>" +
            '<input type="text" class="form-control">' +
            "</td>" +
            "<td>" +
            '<input type="text" class="form-control">' +
            "</td>" +
            "<td>" +
            '<input type="text" class="form-control">' +
            "</td>" +
            "<td>" +
            '<input type="text" class="form-control">' +
            "</td>" +
            "<td>" +
            '<input type="text" class="form-control">' +
            "</td>" +
            '<td class="add-remove text-end">' +
            '<a href="javascript:void(0);" class="add-btn me-2"><i class="fas fa-plus-circle"></i></a> ' +
            '<a href="#" class="copy-btn me-2"><i class="fe fe-copy"></i></a>' +
            '<a href="javascript:void(0);" class="remove-btn"><i class="fe fe-trash-2"></i></a>' +
            "</td>" +
            "</tr>";

        $(".add-table-items").append(experiencecontent);
        return false;
    });

    //Primary Skin one

    $(document).on("change", ".primary-skin-one input", function () {
        if ($(this).is(":checked")) {
            $(".sidebar-menu").addClass("sidebar-menu-ten");
        } else {
            $(".sidebar-menu").removeClass("sidebar-menu-ten");
        }
    });

    //Primary Skin Two

    $(document).on("change", ".primary-skin-two input", function () {
        if ($(this).is(":checked")) {
            $(".sidebar-menu").addClass("sidebar-menu-eleven");
        } else {
            $(".sidebar-menu").removeClass("sidebar-menu-eleven");
        }
    });

    //Primary Skin Three

    $(document).on("change", ".primary-skin-three input", function () {
        if ($(this).is(":checked")) {
            $(".sidebar-menu").addClass("sidebar-menu-twelve");
        } else {
            $(".sidebar-menu").removeClass("sidebar-menu-twelve");
        }
    });

    // const inputSelectors = [
    //     { input: "#mobile_code", countryField: "#country_code" },
    //     { input: "#alternate_mobile_no", countryField: "#country_code_2" },
    //     // { input: ".flagInput" },
    //     { input: "#phone" },
    //     { input: "#phone_2" },
    // ];

    // const utilsURL =
    //     "https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js";

    // inputSelectors.forEach(({ input, countryField }) => {
    //     const inputElement = document.querySelector(input);
    //     if (inputElement) {
    //         const iti = window.intlTelInput(inputElement, {
    //             initialCountry: "us",
    //             separateDialCode: true,
    //             formatOnDisplay: false,
    //             loadUtils: () => import(utilsURL),
    //         });

    //         // Input filtering: allow only digits (and max 10 digits)
    //         inputElement.addEventListener("input", function () {
    //             this.value = this.value.replace(/\D/g, "").slice(0, 10);
    //         });

    //         // Set country if countryField exists
    //         if (countryField) {
    //             const countryInput = document.querySelector(countryField);
    //             if (countryInput) {
    //                 setTimeout(() => {
    //                     const code = countryInput.value;
    //                     if (code) {
    //                         iti.setCountry(code.toLowerCase());
    //                     }
    //                 }, 300);
    //             }
    //         }
    //     }
    // });

    // const editinputSelectors = [
    //     { selector: "#edit_mobile_code", countryCodeField: "#country_code" },
    //     { selector: "#edit_mobile", countryCodeField: "#country_code_2" },
    // ];

    // editinputSelectors.forEach(({ selector, countryCodeField }) => {
    //     const input = document.querySelector(selector);
    //     const countryCodeInput = document.querySelector(countryCodeField);

    //     if (input && countryCodeInput) {
    //         const iti = window.intlTelInput(input, {
    //             separateDialCode: true,
    //             formatOnDisplay: false,
    //             initialCountry: "auto",
    //             geoIpLookup: function (callback) {
    //                 callback("us");
    //             },
    //             utilsScript: utilsURL,
    //         });

    //         // Clean number input (only digits, max 10)
    //         input.addEventListener("input", function () {
    //             this.value = this.value.replace(/\D/g, "").slice(0, 10);
    //         });

    //         // Set initial country from stored `+code`
    //         const countryCode = countryCodeInput.value;
    //         if (countryCode && countryCode.startsWith("+")) {
    //             // Find and set country using dial code
    //             iti.promise.then(() => {
    //                 const countryDataList =
    //                     window.intlTelInputGlobals.getCountryData();
    //                 const found = countryDataList.find(
    //                     (c) => `+${c.dialCode}` === countryCode
    //                 );
    //                 if (found) {
    //                     iti.setCountry(found.iso2);
    //                 }
    //             });
    //         }

    //         // Update country code in hidden input on country change
    //         input.addEventListener("countrychange", function () {
    //             const selectedCountryData = iti.getSelectedCountryData();
    //             if (selectedCountryData && countryCodeInput) {
    //                 countryCodeInput.value = `+${selectedCountryData.dialCode}`;
    //             }
    //         });
    //     }
    // });

    // Summernote
    if ($(".summernote").length > 0) {
        $(".summernote").summernote({
            placeholder: "Description",
            focus: true,
            minHeight: 80,
            disableResizeEditor: false,
            toolbar: [["fontname", ["fontname"]], ["undo"], ["redo"]],
        });
    }
    // Toggle
    if ($(".toggle-password").length > 0) {
        $(document).on("click", ".toggle-password", function () {
            $(this).toggleClass("feather-eye feather-eye-off");
            var input = $(".pass-input");
            if (input.attr("type") == "password") {
                input.attr("type", "password");
            } else {
                input.attr("type", "text");
            }
        });
    }

    // Form Wizard step
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    //Advance Tabs
    $(".next").click(function () {
        const nextTabLinkEl = $(".nav-tabs .active")
            .closest("li")
            .next("li")
            .find("a")[0];
        const nextTab = new bootstrap.Tab(nextTabLinkEl);
        nextTab.show();
    });

    $(".previous").click(function () {
        const prevTabLinkEl = $(".nav-tabs .active")
            .closest("li")
            .prev("li")
            .find("a")[0];
        const prevTab = new bootstrap.Tab(prevTabLinkEl);
        prevTab.show();
    });

    // Kanban Sortable
    if ($(".kanban-ticket-list").length > 0) {
        $(".kanban-ticket-list").sortable({
            connectWith: ".kanban-ticket-list",
            handle: ".card-kanban",
            placeholder: "drag-placeholder",
        });
    }

    //Plan- Billing Slider Customization
    if ($("#plan-billing-slider").length > 0) {
        $("#plan-billing-slider").owlCarousel({
            loop: true,
            margin: 24,
            items: 2,
            nav: false,
            dots: true,
            autoplay: false,
            smartSpeed: 2000,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                1119: {
                    items: 1,
                },
                1200: {
                    items: 2,
                },
            },
        });
    }

    $(document).on("click", ".list-inline-item .submenu a", function () {
        $(".hidden-links").addClass("hidden");
    });
    $(document).on("click", ".two-col-bar .sub-menu a", function () {
        $(".two-col-bar .sub-menu ul").toggle(500);
    });
    $(document).on("click", ".sidebar-horizantal .viewmoremenu", function () {
        $(".sidebar-horizantal .list-inline-item .submenu ul").hide(500);
        $(".sidebar-horizantal .list-inline-item .submenu a").removeClass(
            "subdrop"
        );
    });

    if ($(window).width() < 991) {
        $("html").each(function () {
            var attributes = $.map(this.attributes, function (item) {
                return item.name;
            });

            var img = $(this);
            $.each(attributes, function (i, item) {
                img.removeAttr(item);
            });
        });
    }

    $(document).ready(function () {
        $(document).on("click", "#sidebar-size-compact", function () {
            $("html").attr("data-layout", "vertical");
        });
        $(document).on("click", "#sidebar-size-small-hover", function () {
            $("html").attr("data-layout", "vertical");
        });
        $(document).on(
            "click",
            "[data-layout=horizontal] #sidebar-size-compact",
            function () {
                $("html").attr("data-layout", "vertical");
            }
        );
        $(document).on(
            "click",
            "[data-layout=horizontal] #sidebar-size-small-hover",
            function () {
                $("html").attr("data-layout", "vertical");
            }
        );
        $(document).on(
            "click",
            ".colorscheme-cardradio input[type=radio]",
            function () {
                $("html").removeAttr("data-topbar");
            }
        );
        $(document).on("click", ".viewmoremenu", function () {
            $(".hidden-links").toggleClass("hidden");
        });
        $(document).on(
            "click",
            "[data-sidebar-size=sm-hover] #customizer-layout03",
            function () {
                $("html").removeAttr("data-layout-mode");
            }
        );
        $(document).on(
            "click",
            ".greedy .list-inline-item .submenu a",
            function () {
                $(".hidden-links").addClass("hidden");
            }
        );

        document.getElementsByClassName("main-wrapper")[0].style.visibility =
            "visible";
    });

    $("ul.user-menu li a.toggle-switch").parent().css("display", "none");

    $("#rtl[type='checkbox']").change(function () {
        var item = $(this);
        if (item.is(":checked")) {
            window.location.href = "../template-rtl/index.html";
        }
    });

    $("#customer-name").on("change", function () {
        var data = $("#customer-name option:selected").text();
        if (data != "") {
            $(".customer-address").show();
        }
    });

    // Custom Country Code Selector

    if ($("#phone").length > 0) {
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "assets/plugins/intltelinput/js/utils.js",
        });
    }

    if ($("#phone_2").length > 0) {
        var input = document.querySelector("#phone_2");
        window.intlTelInput(input, {
            utilsScript: "assets/plugins/intltelinput/js/utils.js",
        });
    }

    $(function () {
        $(".member-search-dropdown").on("click", function (a) {
            $(".search-dropdown-item").toggleClass("show");
            a.stopPropagation();
        });
        $(document).on("click", function (a) {
            if ($(a.target).is(".form-sorts") === false) {
                $(".search-dropdown-item").removeClass("show");
            }
        });
    });
    $(".search-dropdown-item").click(function (event) {
        event.stopPropagation();
    });

    // password toggle
    $(".toggle-password1").click(function () {
        $(this).toggleClass("ti-eye-off");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    // if ($(".datatable").length > 0) {
    //     $(".datatable").DataTable({
    //         bFilter: false,
    //         autoWidth: false,
    //         sDom: "fBtlpi",
    //         ordering: true,
    //         order: [],
    //         columnDefs: [
    //             {
    //                 targets: 0, // Yaha 0 index hai jahan Customer ID column hai
    //                 orderable: false,
    //             },
    //             {
    //                 targets: "no-sort", // jise aap manually class se disable karte ho
    //                 orderable: false,
    //             },
    //         ],
    //         language: {
    //             search: " ",
    //             sLengthMenu: "_MENU_",
    //             paginate: {
    //                 next: 'Next <i class=" fa fa-angle-double-right ms-2"></i>',
    //                 previous:
    //                     '<i class="fa fa-angle-double-left me-2"></i> Previous',
    //             },
    //         },
    //         initComplete: (settings, json) => {
    //             $(".dataTables_filter").appendTo("#tableSearch");
    //             $(".dataTables_filter").appendTo(".search-input");
    //         },
    //     });
    // }

    function updateCodeWithCountryPrefix(countryName) {
        if (!countryName) return;

        const url = `/api/country-by-name?name=${encodeURIComponent(
            countryName
        )}`;

        fetch(url, {
            method: "GET",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
        })
            .then((response) => {
                if (!response.ok)
                    throw new Error("Network response was not ok");
                return response.json();
            })
            .then((data) => {
                if (!data.success || !data.data?.iso2) return;

                const inputField = document.getElementById("unique_id");
                if (!inputField) return; // silently skip if not found

                const currentValue = inputField.value.trim();
                const dashIndex = currentValue.indexOf("-");

                if (dashIndex === -1 || dashIndex < 2) return;

                const iso2 = data.data.iso2.toUpperCase();
                const beforeDash = currentValue.slice(0, dashIndex);
                const keepRest = beforeDash.slice(0, -2); // remove last 2 letters
                const finalPrefix = keepRest + iso2;
                const suffix = currentValue.slice(dashIndex);

                const newCode = `${finalPrefix}${suffix}`;
                inputField.value = newCode;
            })
            .catch((error) => {
                console.error("Error fetching country data:", error);
            });
    }

    function initAutocomplete() {
        const input = document.getElementsByName("address_1")[0];
        if (!input) return; // Input not found, exit safely

        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"],
            // componentRestrictions: { country: "in" }
        });

        autocomplete.addListener("place_changed", function () {
            const place = autocomplete.getPlace();
            if (!place) return;

            console.log("Selected address:", place.formatted_address || "N/A");

            const addressComponents = place.address_components || [];

            let postalCode = "",
                country = "",
                state = "",
                city = "",
                lat = "",
                lng = "";

            addressComponents.forEach((component) => {
                const types = component.types || [];

                if (types.includes("postal_code")) {
                    postalCode = component.long_name || "";
                }
                if (types.includes("country")) {
                    country = component.long_name || "";
                    updateCodeWithCountryPrefix(country);
                }
                if (types.includes("administrative_area_level_1")) {
                    state = component.long_name || "";
                }
                if (types.includes("locality")) {
                    city = component.long_name || "";
                }
                if (types.includes("administrative_area_level_2") && !city) {
                    city = component.long_name || "";
                }
            });

            // Get Latitude and Longitude
            if (place.geometry && place.geometry.location) {
                lat = place.geometry.location.lat() || "";
                lng = place.geometry.location.lng() || "";
            }

            // Safely fill the fields (if they exist)
            const setField = (name, value) => {
                const field = document.getElementsByName(name)[0];
                if (field) field.value = value;
            };

            setField("Zip_code", postalCode);
            setField("country", country);
            setField("state", state);
            setField("city", city);
            setField("latitude", lat);
            setField("longitude", lng);
            setField("Pickup_latitude", lat);
            setField("Pickup_longitude", lng);
        });
    }

    function initAutocompleteById() {
        const input = document.querySelector(".address");
        if (!input) return; // Input not found, exit safely

        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"],
            // componentRestrictions: { country: "in" }
        });

        autocomplete.addListener("place_changed", function () {
            const place = autocomplete.getPlace();
            if (!place) return;

            console.log("Selected address:", place.formatted_address || "N/A");

            const addressComponents = place.address_components || [];

            let postalCode = "",
                country = "",
                state = "",
                city = "",
                lat = "",
                lng = "";

            addressComponents.forEach((component) => {
                const types = component.types || [];

                if (types.includes("postal_code")) {
                    postalCode = component.long_name || "";
                }
                if (types.includes("country")) {
                    country = component.long_name || "";
                }
                if (types.includes("administrative_area_level_1")) {
                    state = component.long_name || "";
                }
                if (types.includes("locality")) {
                    city = component.long_name || "";
                }
                if (types.includes("administrative_area_level_2") && !city) {
                    city = component.long_name || "";
                }
            });

            // Get Latitude and Longitude
            if (place.geometry && place.geometry.location) {
                lat = place.geometry.location.lat() || "";
                lng = place.geometry.location.lng() || "";
            }

            // Safely fill the fields (if they exist)
            const setField = (name, value) => {
                const field = document.getElementsByName(name)[0];
                if (field) field.value = value;
            };

            setField("Zip_code", postalCode);
            setField("country", country);
            setField("state", state);
            setField("city", city);
            setField("latitude", lat);
            setField("longitude", lng);
            setField("Shipto_latitude", lat);
            setField("Shipto_longitude", lng);
        });
    }

    function initAutocomplete_1() {
        const input = document.getElementsByName("Model_Pickup_address_1")[0];
        if (!input) return; // Input not found, exit safely

        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"],
            // componentRestrictions: { country: "in" }
        });

        autocomplete.addListener("place_changed", function () {
            const place = autocomplete.getPlace();
            if (!place) return;

            console.log("Selected address:", place.formatted_address || "N/A");

            const addressComponents = place.address_components || [];

            let postalCode = "",
                country = "",
                state = "",
                city = "",
                lat = "",
                lng = "";

            addressComponents.forEach((component) => {
                const types = component.types || [];

                if (types.includes("postal_code")) {
                    postalCode = component.long_name || "";
                }
                if (types.includes("country")) {
                    country = component.long_name || "";
                    updateCodeWithCountryPrefix(country);
                }
                if (types.includes("administrative_area_level_1")) {
                    state = component.long_name || "";
                }
                if (types.includes("locality")) {
                    city = component.long_name || "";
                }
                if (types.includes("administrative_area_level_2") && !city) {
                    city = component.long_name || "";
                }
            });

            // Get Latitude and Longitude
            if (place.geometry && place.geometry.location) {
                lat = place.geometry.location.lat() || "";
                lng = place.geometry.location.lng() || "";
            }

            // Safely fill the fields (if they exist)
            const setField = (name, value) => {
                const field = document.getElementsByName(name)[0];
                if (field) field.value = value;
            };

            setField("Zip_code", postalCode);
            setField("country", country);
            setField("state", state);
            setField("city", city);
            setField("latitude", lat);
            setField("longitude", lng);
        });
    }

    function initAutocomplete_2() {
        const input = document.getElementsByName("Model_ShipTo_address_1")[0];
        if (!input) return; // Input not found, exit safely

        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"],
            // componentRestrictions: { country: "in" }
        });

        autocomplete.addListener("place_changed", function () {
            const place = autocomplete.getPlace();
            if (!place) return;

            console.log("Selected address:", place.formatted_address || "N/A");

            const addressComponents = place.address_components || [];

            let lat = "",
                lng = "";

            // Get Latitude and Longitude
            if (place.geometry && place.geometry.location) {
                lat = place.geometry.location.lat() || "";
                lng = place.geometry.location.lng() || "";
            }

            // Safely fill the fields (if they exist)
            const setField = (name, value) => {
                const field = document.getElementsByName(name)[0];
                if (field) field.value = value;
            };

            setField("ship_to_latitude", lat);
            setField("ship_to_longitude", lng);
        });
    }

    function initAutocomplete_3() {
        const input = document.getElementsByName("shipto_address_1")[0];
        if (!input) return; // Input not found, exit safely

        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"],
            // componentRestrictions: { country: "in" }
        });

        autocomplete.addListener("place_changed", function () {
            const place = autocomplete.getPlace();
            if (!place) return;

            console.log("Selected address:", place.formatted_address || "N/A");

            const addressComponents = place.address_components || [];

            let lat = "",
                lng = "";

            // Get Latitude and Longitude
            if (place.geometry && place.geometry.location) {
                lat = place.geometry.location.lat() || "";
                lng = place.geometry.location.lng() || "";
            }

            // Safely fill the fields (if they exist)
            const setField = (name, value) => {
                const field = document.getElementsByName(name)[0];
                if (field) field.value = value;
            };

            setField("shipto_latitude", lat);
            setField("shipto_longitude", lng);
        });
    }

    window.addEventListener("load", function () {
        initAutocomplete();
        initAutocompleteById();
        initAutocomplete_1();
        initAutocomplete_2();
        initAutocomplete_3();
    });
})(jQuery);
