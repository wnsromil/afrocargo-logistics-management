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
                    $('#city').html('<option value="">Select City</option>');
                    $.each(data, function(index, city) {
                        $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                    });
                }
            });
        }
    });
});