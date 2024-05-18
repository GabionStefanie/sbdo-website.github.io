
function toggleContent() {
    var content = document.getElementById('content');
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
    } else {
        content.style.display = 'none';
    }
}

function showModal(modalType) {
    var overlay = document.getElementById('overlay');
    var modal = document.getElementById('modal' + modalType.charAt(0).toUpperCase() + modalType.slice(1)); // Capitalize first letter

    // Close all modals first
    closeModal();

    // Display the overlay and modal
    overlay.style.display = 'block';
    modal.style.display = 'block';
}

function closeModal() {
    var overlay = document.getElementById('overlay');
    var modals = document.querySelectorAll('.modal');

    // Hide the overlay and all modals
    overlay.style.display = 'none';
    modals.forEach(function(modal) {
        modal.style.display = 'none';
    });
}

// Function to handle submission of the profile picture change form
function submitProfilePicture(event) {
event.preventDefault(); // Prevent default form submission

// Add your logic here to handle the form submission
// For example, you can upload the selected profile picture to the server

// After the profile picture is uploaded successfully, close the modal
closeModal();
}



// Function to show the change profile picture modal
function showChangeProfilePictureModal() {
var overlay = document.getElementById('overlay');
var modal = document.getElementById('modalChangeProfilePicture');

// Close all modals first
closeModal();

// Display the overlay and modal
overlay.style.display = 'block';
modal.style.display = 'block';
}

// Inside your form, add an event listener to handle form submission 
function submitUsername(event) {
    event.preventDefault(); // Prevent default form submission

    // Show the additional modal after form submission
    showModal('additionalUsername');
}

// Inside your form, add an event listener to handle form submission 
function submitPassword(event) {
    event.preventDefault(); // Prevent default form submission

    // Show the additional modal after form submission
    showModal('additionalPassword');
}

function showForgotPasswordModal() {
var overlay = document.getElementById('overlay');
var modal = document.getElementById('modalForgotPassword');

// Close all modals first
closeModal();

// Display the overlay and modal
overlay.style.display = 'block';
modal.style.display = 'block';
}

// Inside your form, add an event listener to handle form submission 
function submitEmail(event) {
    event.preventDefault(); // Prevent default form submission

    // Show the additional modal after form submission
    showModal('additionalEmail');
}

// Additional modal for OTP verification after changing the username
function submitOTPUsername(event) {
    event.preventDefault(); // Prevent default form submission

    // Add your OTP verification logic here
}

// Additional modal for OTP verification after changing the password
function submitOTPPassword(event) {
    event.preventDefault(); // Prevent default form submission

    // Add your OTP verification logic here
}

// Function to handle submission of the reset password form
function submitForgotPassword(event) {
event.preventDefault(); // Prevent default form submission

// Add your logic here to handle the form submission
// For example, you can send a request to the server to reset the password

// After the password reset request is successful, show the reset password modal
showModal('resetPassword');
}

// Function to show the reset password modal
function showModal(modalType) {
var overlay = document.getElementById('overlay');
var modal = document.getElementById('modal' + modalType.charAt(0).toUpperCase() + modalType.slice(1)); // Capitalize first letter

// Close all modals first
closeModal();

// Display the overlay and modal
overlay.style.display = 'block';
modal.style.display = 'block';
}


// Additional modal for OTP verification after changing the email address
function submitOTPEmail(event) {
    event.preventDefault(); // Prevent default form submission

    // Add your OTP verification logic here
}

function logout() {
    // Add your logout logic here
    // For example, you can redirect the user to the login page
    window.location.href = "logout.html";
}
