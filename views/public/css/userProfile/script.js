// $("#menu-toggle").click(function(e) {
//     e.preventDefault();
//     $("#wrapper").toggleClass("toggled");
// });
// $("#menu-toggle-2").click(function(e) {
//     e.preventDefault();
//     $("#wrapper").toggleClass("toggled-2");
//     $('#menu ul').hide();
// });
//
// function initMenu() {
//     $('#menu ul').hide();
//     $('#menu ul').children('.current').parent().show();
//     //$('#menu ul:first').show();
//     $('#menu li a').click(
//         function() {
//             var checkElement = $(this).next();
//             if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
//                 return false;
//             }
//             if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
//                 $('#menu ul:visible').slideUp('normal');
//                 checkElement.slideDown('normal');
//                 return false;
//             }
//         }
//     );
// }
// $(document).ready(function() {
//     initMenu();
// });$("#menu-toggle").click(function(e) {
//     e.preventDefault();
//     $("#wrapper").toggleClass("toggled");
// });
// $("#menu-toggle-2").click(function(e) {
//     e.preventDefault();
//     $("#wrapper").toggleClass("toggled-2");
//     $('#menu ul').hide();
// });
//
// function initMenu() {
//     $('#menu ul').hide();
//     $('#menu ul').children('.current').parent().show();
//     //$('#menu ul:first').show();
//     $('#menu li a').click(
//         function() {
//             var checkElement = $(this).next();
//             if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
//                 return false;
//             }
//             if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
//                 $('#menu ul:visible').slideUp('normal');
//                 checkElement.slideDown('normal');
//                 return false;
//             }
//         }
//     );
// }
// $(document).ready(function() {
//     initMenu();
// });
jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
                .parent()
                .hasClass("active")
        ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });

    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
    });




});

function appear() {
    var editForm = document.getElementById('edit');
    editForm.style.display = 'inline-block';
}

function hide(){
    var editForm = document.getElementById('edit');
    editForm.style.display = 'none';
}
function toggleTooltip() {
    const tooltip = document.getElementById('emailTooltip');
    const isVisible = tooltip.getAttribute('aria-hidden') === 'false';
    tooltip.setAttribute('aria-hidden', !isVisible);
}

function theme(){
    var slide = document.getElementById('sidebar');
    slide.style.backgroundColor = '#282c33';
}
/////////////////////////////////////////////////////////////////////
function showToast(icon, title, buttonId) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    Toast.fire({
        icon: icon,
        title: title
    }).then(() => {
        // Hide the submit button after the toast is shown

    });
}
/////////////////////////////////////
function validateForm(event) {
    event.preventDefault(); // Prevent form submission

    const firstName = document.querySelector('input[name="firstName"]').value.trim();
    const lastName = document.querySelector('input[name="lastName"]').value.trim();
    const email = document.querySelector('input[name="email"]').value.trim();
    const phone = document.querySelector('input[name="phone"]').value.trim();
    const city = document.querySelector('input[name="city"]').value.trim();
    const district = document.querySelector('input[name="district"]').value.trim();
    const street = document.querySelector('input[name="street"]').value.trim();
    const buildingNum = document.querySelector('input[name="b_number"]').value.trim();
    const imageInput = document.querySelector('input[name="image"]');

    let errors = [];

    // Check for empty fields
    if (!firstName) errors.push("First Name is required.");
    if (!lastName) errors.push("Last Name is required.");
    if (!email) errors.push("Email is required.");
    if (!phone) errors.push("Phone number is required.");
    if (!city) errors.push("City is required.");
    if (!district) errors.push("District is required.");
    if (!street) errors.push("Street is required.");
    if (!buildingNum) errors.push("Building number is required.");

    // Check for numeric characters in First Name, Last Name, and City
    const nameCityRegex = /[0-9]/;
    if (nameCityRegex.test(firstName)) errors.push("First Name cannot contain numbers.");
    if (nameCityRegex.test(lastName)) errors.push("Last Name cannot contain numbers.");
    if (nameCityRegex.test(city)) errors.push("City cannot contain numbers.");

    // Validate phone number: must start with '07' and have a total of 10 digits
    const phoneRegex = /^07\d{8}$/; // Matches '07' followed by exactly 8 digits
    if (!phoneRegex.test(phone)) {
        errors.push("Phone number must start with '07' and contain exactly 10 digits.");
    }

    // Validate email: should end with specified domains
    const emailDomainRegex = /^(.*?@(?:gmail\.com|outlook\.com|hotmail\.com|yahoo\.com))$/; // List of allowed domains
    if (!emailDomainRegex.test(email)) {
        errors.push("Email must be a valid address from Gmail, Outlook, Hotmail, or Yahoo.");
    }

    // Check for optional image file
    if (imageInput.files.length > 0) {
        const file = imageInput.files[0];
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validImageTypes.includes(file.type)) {
            errors.push("Image must be a JPEG, PNG, or GIF.");
        }
    }

    // If there are errors, display them; otherwise, submit the form
    if (errors.length > 0) {
        // Display errors using SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Validation Errors',
            html: errors.map(err => `<p>${err}</p>`).join(''), // Display errors in a list
            confirmButtonText: 'OK'
        });
    } else {
        // If no errors, submit the form
        document.querySelector('form').submit();
    }
}

// Attach the validation function to the form
document.querySelector('form').addEventListener('submit', validateForm);
