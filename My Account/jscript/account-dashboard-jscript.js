
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

// Handle submission of the profile picture change form
function submitProfilePicture(event) {
    event.preventDefault(); // Prevent default form submission

    // Get the form element
    const form = document.getElementById('formChangeProfilePicture');
    
    // Create a FormData object from the form
    const formData = new FormData(form);
    
    // Send the form data to the server using fetch
    fetch('upload_profile_picture.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Profile picture uploaded successfully
            console.log('Profile picture uploaded successfully:', data.message);
            closeModal();
            // Optionally, update the profile picture displayed on the page
        } else {
            // Handle upload error
            console.error('Error uploading profile picture:', data.message);
        }
    })
    .catch(error => {
        console.error('Error uploading profile picture:', error);
    });
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
