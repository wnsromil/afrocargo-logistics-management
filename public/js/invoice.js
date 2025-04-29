// plus minus adding row
document.addEventListener('DOMContentLoaded', function() {
    // Add new row
    $(document).on('click', '.addBtn', function() {
        var row = $(this).closest('tr');
        var newRow = row.clone();
        
        // Clear input values in new row
        newRow.find('input').val('');
        newRow.find('select').val('');
        newRow.find('.qty-input').val('1');
        
        // Hide add button in current row and show in new row
        row.find('.addBtn').hide();
        newRow.find('.addBtn').show();
        
        row.after(newRow);
        initializeRowEvents(newRow);
    });
    
    // Delete row - Modified version
    $(document).on('click', '.dltBtn:not(.detele)', function() {
        if($('#dynamicTable tbody tr').length > 1) {
            var $row = $(this).closest('tr');
            $row.remove();
            
            // Ensure the new last row shows the add button
            $('#dynamicTable tbody tr:last').find('.addBtn').show();
        } else {
            alert("You must keep at least one row!");
        }
    });
    
    // Quantity plus/minus
    $(document).on('click', '.qty-plus', function() {
        var input = $(this).siblings('.qty-input');
        var value = parseInt(input.val()) || 0;
        input.val(value + 1);
        calculateRow($(this).closest('tr'));
    });
    
    $(document).on('click', '.qty-minus', function() {
        var input = $(this).siblings('.qty-input');
        var value = parseInt(input.val()) || 0;
        if(value > 1) {
            input.val(value - 1);
            calculateRow($(this).closest('tr'));
        }
    });
    
    // Edit button functionality
    $(document).on('click', '.editBtn', function() {
        var row = $(this).closest('tr');
        row.find('input, select').prop('readonly', function(i, readonly) {
            return !readonly;
        });
        $(this).toggleClass('btn-secondary btn-success');
    });
    
    // Calculate row when inputs change
    $(document).on('input', '.price-input, .qty-input, .discount-input, .tax-input', function() {
        calculateRow($(this).closest('tr'));
    });
    
    // Initialize events for first row
    initializeRowEvents($('#dynamicTable tbody tr:first'));
    
    function initializeRowEvents(row) {
        // Initialize select2 if needed
        // row.find('.select2').select2();
        
        // Hide add button if it's not the last row
        if(row.next('tr').length > 0) {
            row.find('.addBtn').hide();
        }
    }
    
    function calculateRow(row) {
        var qty = parseFloat(row.find('.qty-input').val()) || 0;
        var price = parseFloat(row.find('.price-input').val()) || 0;
        var discount = parseFloat(row.find('.discount-input').val()) || 0;
        var tax = parseFloat(row.find('.tax-input').val()) || 0;
        
        // Calculate value (qty * price)
        var value = qty * price;
        row.find('.value-input').val(value.toFixed(2));
        
        // Calculate total (value - discount + tax)
        var total = value - discount;
        total = total + (total * (tax / 100));
        row.find('.total-input').val(total.toFixed(2));
    }
});


// old
function toggleLoginForm(type) {
    if (type === 'services') {
        document.getElementById('services').style.display = 'block';
        document.getElementById('supplies').style.display = 'none';
        document.getElementById('servicesBtn').classList.add('active3');
        document.getElementById('suppliesBtn').classList.remove('active3');

    } else if (type === 'supplies') {
        document.getElementById('services').style.display = 'none';
        document.getElementById('supplies').style.display = 'block';
        document.getElementById('servicesBtn').classList.remove('active3');
        document.getElementById('suppliesBtn').classList.add('active3');

    }
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const formType = urlParams.get('id') || 'services';
    toggleLoginForm(formType);
};


document.getElementById('addCustomer').onclick = () => document.querySelector('.newCustomerAdd').classList.toggle('none');

document.getElementById('addShiptoAddress').onclick = () => document.querySelector('.newShipmentAddress').classList.toggle('none');