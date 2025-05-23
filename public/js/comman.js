$(document).ready(function() {
    $('#country').on('change', function() {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                url: '/api/get-states/' + countryID,
                type: 'GET',
                success: function(data) {
                    $('#state').html('<option value="">Select State</option>');
                    $('#city').html('<option value="">Select City</option>');
                    $.each(data, function(index, state) {
                        $('#state').append('<option value="' + state.id + '">' + state.name + '</option>');
                    });
                }
            });
        }
    });

    $('#state').on('change', function() {
        var stateID = $(this).val();
        if (stateID) {
            $.ajax({
                url: '/api/get-cities/' + stateID,
                type: 'GET',
                success: function(data) {
                    if (data.length === 0) {
                        $('.hidden_City').addClass('d-none'); // Bootstrap hidden class
                        $('#city').html('<option value="">No cities available</option>');
                    } else {
                        $('.hidden_City').removeClass('d-none');
                        $('#city').html('<option value="">Select City</option>');
                        $.each(data, function(index, city) {
                            $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                        });
                    }
                }
            });
        }
    });
});


// 

function deleteAllUser(){
    if(confirm("Are you sure you. want to delete all users?")){
        $.get(
            "/super/users/deleteUser",
            {
                action:"all"
            },
            function (response) {
                let message = response?.message;
                toastr.success(message);
                // $("#usersTable").DataTable().ajax.reload();
            },
            "JSON"
        );
    }
}

function deleteUser(id){
    
    if(confirm("Are you sure you. want to delete users?")){
        $.get(
            "/super/users/deleteUser",
            {
                ids:id
            },
            function (response) {
                let message = response?.message;
                toastr.success(message);
                // $("#usersTable").DataTable().ajax.reload();
            },
            "JSON"
        );
    }
}

// Select All Checkbox
$('#selectAll').on('click', function () {

    selectCheckbox(this.checked);
    $('.selectCheckbox').prop('checked', this.checked);
});

$('#state').on('click', function () {

    selectCheckbox(this.checked);
    $('.selectCheckbox').prop('checked', this.checked);
});

// Uncheck "Select All" if any individual checkbox is unchecked
$(document).on('click', '.selectCheckbox', function () {
    selectCheckbox($(this).prop("checked"));
    if (!$(this).prop("checked")) {
        $('#selectAll').prop("checked", false);
    }
});

$('#deleteUser').on('click',function(){
    let selectedUsers = [];
    $(".selectCheckbox:checked").each(function () {
        selectedUsers.push($(this).val());
    });
    if(selectedUsers.length > 0){
        deleteUser(selectedUsers);
    }else{
        toastr.error("Please select at least one user to delete");
    }
})

function selectCheckbox(selectedAny,isSelected=".isSelected"){
    if(selectedAny){
       $(isSelected).removeClass('d-none'); 
    }else{
        $(isSelected).addClass('d-none'); 
    }
}