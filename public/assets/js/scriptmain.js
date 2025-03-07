// // Initialize intl-tel-input for Contact No. 1
// var input1 = document.querySelector("#mobile_code1");
// window.intlTelInput(input1, {
//     initialCountry: "in", // Set the initial country
//     utilsScript: "path/to/utils.js" // Provide the path to the utils.js script
// });

// // Initialize intl-tel-input for Contact No. 2
// var input2 = document.querySelector("#mobile_code2");
// window.intlTelInput(input2, {
//     initialCountry: "in", // Set the initial country
//     utilsScript: "path/to/utils.js" // Provide the path to the utils.js script
// });



// Initialize the first phone number input
    if (document.getElementById('mobile_code1')) {
        window.intlTelInput(document.getElementById('mobile_code1'), {
            initialCountry: 'us',
            separateDialCode: true,
            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js'
        });
    }

    // Initialize the second phone number input
    if (document.getElementById('mobile_code2')) {
        window.intlTelInput(document.getElementById('mobile_code2'), {
            initialCountry: 'us',
            separateDialCode: true,
            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js'
        });
    }


    const activeText = document.getElementById('activeText');
    const inactiveText = document.getElementById('inactiveText');
    const rating_6 =document.getElementById('rating_6');
    rating_6.addEventListener("change", function(){
        activeText.classList.toggle("faded");
        inactiveText.classList.toggle("faded");
    })