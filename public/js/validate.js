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


/**
 * Lightweight client‑side validator that supports:
 *   • text / number / date inputs
 *   • <select> (single or multiple)
 *   • checkbox and radio groups
 *
 * @param {object|array} rules   Either an object of Laravel‑style rules (field => rule string)
 *                               or an array of field names that are simply "required".
 * @param {jQuery|null}  form    Optional jQuery form object to scope the search.
 * @param {object}       config  Extra flags: { showErrorMessages, ErrorMessagesPush, getErrorMessages }
 *
 * @returns {boolean}            true if the form passes validation, false otherwise.
 */
function jsValidator(rules, form = null, config = {}) {
    // ------------------------------------------
    // Helper Functions
    // ------------------------------------------
    const $scope = form || $(document);

    const getInput = (name) => $scope.find(`[name="${name}"]`);

    // Retrieve the *logical* value for any field type.
    const getInputValue = (input) => {
        const type = input.attr('type');
        const tag  = (input.prop('tagName') || '').toLowerCase();

        if (type === 'checkbox') {
            // Return array of checked values or '' if none.
            const checked = $(`[name="${input.attr('name')}"]:checked`, $scope)
                            .map((_, el) => $(el).val())
                            .get();
            return checked.length ? checked : '';
        }

        if (type === 'radio') {
            const checked = $(`[name="${input.attr('name')}"]:checked`, $scope).val();
            return checked ?? '';
        }

        if (tag === 'select') {
            // For <select multiple> jquery returns an array; for single select a string.
            const val = input.val();
            return (val !== null && val !== '') ? val : '';
        }

        // Text-like inputs
        return (input.val() ?? '').trim();
    };

    // Is the field considered "filled"?
    const isFilled = (input) => {
        const val = getInputValue(input);
        if (Array.isArray(val)) {
            return val.length > 0;
        }
        return val !== '';
    };

    const addErrorClass = (input)   => input.addClass('is-invalid');
    const removeErrorClass = (input) => input.removeClass('is-invalid');

    const errors      = {};
    let   isValidForm = true;

    // ------------------------------------------
    // Simple "required only" array syntax
    // ------------------------------------------
    if (Array.isArray(rules)) {
        rules.forEach((name) => {
            const $input = getInput(name);

            if (!isFilled($input)) {
                addErrorClass($input);
                errors[name] = `${name.replace(/_/g, ' ')} is required.`;
                isValidForm = false;
            } else {
                removeErrorClass($input);
            }
        });

        if (!isValidForm && config.ErrorMessagesPush && typeof config.getErrorMessages === 'function') {
            config.getErrorMessages(errors);
        }

        return isValidForm;
    }

    // ------------------------------------------
    // Object syntax: field => rule string
    // ------------------------------------------
    for (const [field, ruleSet] of Object.entries(rules)) {
        const $input     = getInput(field);
        const rawValue   = getInputValue($input);
        const rulesArray = ruleSet.split('|');

        let fieldValid = true;

        for (const rule of rulesArray) {
            //------------------------------------------------------------------
            // 1) required
            //------------------------------------------------------------------
            if (rule === 'required' && !isFilled($input)) {
                errors[field] = `${field.replace(/_/g, ' ')} is required.`;
                fieldValid = false;
                break;
            }

            //------------------------------------------------------------------
            // 2) required_if:otherField,value
            //------------------------------------------------------------------
            if (rule.startsWith('required_if')) {
                const [, otherField, expected] = rule.split(':')[1].split(',');
                const otherVal = getInputValue(getInput(otherField));

                const conditionMet = (Array.isArray(otherVal))
                    ? otherVal.includes(expected)
                    : otherVal === expected;

                if (conditionMet && !isFilled($input)) {
                    errors[field] = `${field.replace(/_/g, ' ')} is required when ${otherField} is ${expected}.`;
                    fieldValid = false;
                    break;
                }
            }

            //------------------------------------------------------------------
            // 3) in:foo,bar,baz
            //------------------------------------------------------------------
            if (rule.startsWith('in')) {
                const allowed = rule.split(':')[1].split(',');
                if (Array.isArray(rawValue)) {
                    const allValid = rawValue.every(v => allowed.includes(v));
                    if (!allValid) {
                        errors[field] = `${field.replace(/_/g, ' ')} must be one of: ${allowed.join(', ')}.`;
                        fieldValid = false;
                        break;
                    }
                } else if (!allowed.includes(rawValue)) {
                    errors[field] = `${field.replace(/_/g, ' ')} must be one of: ${allowed.join(', ')}.`;
                    fieldValid = false;
                    break;
                }
            }

            //------------------------------------------------------------------
            // 4) numeric
            //------------------------------------------------------------------
            if (rule === 'numeric') {
                const numericCheck = Array.isArray(rawValue)
                    ? rawValue.every(v => v !== '' && !isNaN(v))
                    : (!isNaN(rawValue) && rawValue !== '');

                if (!numericCheck) {
                    errors[field] = `${field.replace(/_/g, ' ')} must be numeric.`;
                    fieldValid = false;
                    break;
                }
            }

            //------------------------------------------------------------------
            // 5) date_format:m-d-Y (simple regex check)
            //------------------------------------------------------------------
            if (rule.startsWith('date_format')) {
                const fmt = rule.split(':')[1];
                if (fmt === 'm-d-Y' && !/^\d{2}-\d{2}-\d{4}$/.test(rawValue)) {
                    errors[field] = `${field.replace(/_/g, ' ')} must match ${fmt}.`;
                    fieldValid = false;
                    break;
                }
            }

            //------------------------------------------------------------------
            // 6) max:NN
            //------------------------------------------------------------------
            if (rule.startsWith('max')) {
                const maxLen = parseInt(rule.split(':')[1], 10);
                const length = Array.isArray(rawValue) ? rawValue.length : rawValue.length;
                if (length > maxLen) {
                    errors[field] = `${field.replace(/_/g, ' ')} must not exceed ${maxLen} characters.`;
                    fieldValid = false;
                    break;
                }
            }
        }

        //----------------------------------------------------------------------
        // Custom logic example: driver_id depends on container_id
        //----------------------------------------------------------------------
        if (field === 'driver_id') {
            const containerId = getInputValue(getInput('container_id'));
            if (containerId && !isFilled($input)) {
                errors[field] = 'driver id is required when container_id is present.';
                fieldValid = false;
            }
        }

        // Handle UI feedback
        if (!fieldValid) {
            addErrorClass($input);
            if (config.showErrorMessages) {
                $input.after(`<small class="text-danger">${errors[field]}</small>`);
            }
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'error', title: 'Error', text: errors[field] });
            }
            isValidForm = false;
        } else {
            removeErrorClass($input);
            if (config.showErrorMessages) {
                $input.next('.text-danger').remove();
            }
        }
    }

    // Push collected errors if caller wants them
    if (!isValidForm && config.ErrorMessagesPush && typeof config.getErrorMessages === 'function') {
        config.getErrorMessages(errors);
    }

    return isValidForm;
}
