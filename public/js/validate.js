// example of a JavaScript validation function using jsValidator
// $("#services").on("submit", function (e) {
//     e.preventDefault();

//     const rules = {
//         invoce_type: 'required|in:services,supplies',
//         delivery_address_id: 'required',
//         pickup_address_id: 'required_if:invoce_type,services',
//         container_id: 'required_if:invoce_type,services|required_if:transport_type,cargo|numeric',
//         driver_id: 'numeric',
//         warehouse_id: 'numeric',
//         ins: 'numeric',
//         discount: 'numeric',
//         tax: 'numeric',
//         weight: 'numeric',
//         balance: 'numeric',
//         total_price: 'required|numeric',
//         total_qty: 'required|numeric',
//         duedaterange: '',
//         currentdate: 'date_format:m-d-Y',
//         currentTime: '',
//         invoice_no: 'max:255',
//         total_amount: 'required|numeric',
//         grand_total: 'required|numeric',
//         payment: 'required|numeric',
//         status: 'required',
//     };

//     if (!jsValidator(rules, $("#services"))) {
//         alert("Please fix the errors");
//         e.preventDefault();
//         return false;
//     }

//     // Now submit the form programmatically
//     this.submit();
// });


$("#addCustomReportForm").on("submit", function (e) {
    e.preventDefault();

    const rules = {
        report_date: 'required',
        report_type: 'required',
        warehouse_id: 'required|numeric',
        container_id: 'required|numeric',
    };

    if (!jsValidator(rules, $("#addCustomReportForm"),{
        getErrorMessages: function(errors) {
            console.log("Validation Errors:", errors);
        }
    })) {
        e.preventDefault();
        return false;
    }

    // Now submit the form programmatically
    this.submit();
});


function jsValidator(rules, form = null,config={}) {
    let isValid = true;
    $(".text-danger").remove();
    const errors = {};

    if (Array.isArray(rules)) {
        rules.forEach(function (name) {
            let input = null;
            if (form) {
                input = form.find(`[name="${name}"]`);
                errors[name] = input.val() ? null : `${name} is required.`;
                // Add error message span after the input
                // input.after(`<span class="text-danger">${name.replace(/_/g, ' ')} is required.</span>`);
            } else {
                input = $(`[name="${name}"]`);
                // Remove the specific error message span after the input
                // input.after('span.text-danger').remove();
            }

            if (!input.val()) {
                console.log(`Validation Error: Field '${name}' is required but empty.`);
                input.addClass("is-invalid");
                isValid = false;
            } else {
                input.removeClass("is-invalid");
            }
        });

        return isValid;
    }

    const getInput = (name) => form ? form.find(`[name="${name}"]`) : $(`[name="${name}"]`);

    for (const [field, ruleSet] of Object.entries(rules)) {
        const input = getInput(field);
        const value = input.val()?.trim();
        const rulesArray = ruleSet.split('|');
        

        let fieldValid = true;

        for (const rule of rulesArray) {
            if (rule === 'required' && !value) {
                console.log(`Validation Error: Field '${field}' failed 'required' rule.`);
                errors[field] = `${field.replace(/_/g, ' ')} is required.`;
                fieldValid = false;
                break;
            }

            if (rule.startsWith('required_if')) {
                const [, otherField, expectedValue] = rule.split(':')[1].split(',');
                const otherInput = getInput(otherField);
                if (otherInput.val() === expectedValue && !value) {
                    console.log(`Validation Error: Field '${field}' is required because '${otherField}' is '${expectedValue}', but it's empty.`);
                    errors[field] = `${field.replace(/_/g, ' ')} is required when ${otherField} is ${expectedValue}.`;
                    fieldValid = false;
                    break;
                }
            }

            if (rule.startsWith('in')) {
                const validValues = rule.split(':')[1].split(',');
                if (!validValues.includes(value)) {
                    console.log(`Validation Error: Field '${field}' value '${value}' is not in allowed values: [${validValues}].`);
                    errors[field] = `${field.replace(/_/g, ' ')} must be one of: ${validValues.join(', ')}.`;
                    fieldValid = false;
                    break;
                }
            }

            if (rule === 'numeric' && value && isNaN(value)) {
                console.log(`Validation Error: Field '${field}' should be numeric but got '${value}'.`);
                errors[field] = `${field.replace(/_/g, ' ')} must be a number.`;
                fieldValid = false;
                break;
            }

            if (rule.startsWith('date_format')) {
                const format = rule.split(':')[1];
                if (format === 'm-d-Y' && !/^\d{2}-\d{2}-\d{4}$/.test(value)) {
                    console.log(`Validation Error: Field '${field}' doesn't match the date format '${format}'.`);
                    errors[field] = `${field.replace(/_/g, ' ')} must be in the format ${format}.`;
                    fieldValid = false;
                    break;
                }
            }

            if (rule.startsWith('max')) {
                const maxLength = parseInt(rule.split(':')[1]);
                if (value.length > maxLength) {
                    console.log(`Validation Error: Field '${field}' exceeds maximum length of ${maxLength}.`);
                    errors[field] = `${field.replace(/_/g, ' ')} must not exceed ${maxLength} characters.`;
                    fieldValid = false;
                    break;
                }
            }
        }

        // Extra Custom JS logic (driver_id depending on container_id)
        if (field === 'driver_id') {
            const container_id = getInput('container_id').val();
            if (container_id && parseInt(container_id) > 0 && !value) {
                console.log(`Validation Error: Field 'driver_id' is required because 'container_id' is present.`);
                errors[field] = `${field.replace(/_/g, ' ')} is required when container_id is present.`;
                fieldValid = false;
            }
        }

        if (!fieldValid) {
            input.addClass("is-invalid");
            // if(config.showErrorMessages) {
            //     input.after(`<div><p class="text-danger">${field.replace(/_/g, ' ')} is required.</p></div>`);
            // }
            
            isValid = false;
            Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: `${field.replace(/_/g, ' ')} is required.`,
                });
        } else {
            input.removeClass("is-invalid");
            // if(config.showErrorMessages) {
            //     input.next('div').remove();
            // }
        }
    }
    if(config.ErrorMessagesPush) {
        // Show all errors at once if any
        config.getErrorMessages(errors);

    }
    console.log("Validation Errors:", errors);

    return isValid;
}