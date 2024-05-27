account-dashboard-jscript.js
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

    console.log(modal);
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

function submitProfilePicture(event) {
    event.preventDefault(); // Prevent default form submission

    // Fetch the form data
    var form = document.getElementById('formProfilePicture');
    var formData = new FormData(form);

    // Send an AJAX request to the server
    fetch('uploadPFP.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response data
        console.log(data);

        // Show the additional modal after form submission
        showModal('modalAdditionalProfilePicture');
    })
    .catch(error => {
        // Handle the error
        console.error('Error:', error);
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
function submitProfilePicture(event) {
    event.preventDefault();

var fileInput = document.getElementById('profilePicture');
if (fileInput.files.length === 0) {
    // No file selected
    alert('Please select a file');
    return;
}

var formData = new FormData();
formData.append('profilePicture', fileInput.files[0]);
formData.append('formName', 'uploadForm');

var xhr = new XMLHttpRequest();
xhr.open('POST', 'uploadPFP.php', true); // Changed the URL to 'uploadPFP.php'
xhr.onload = function () {
    if (xhr.status === 200) {
        // File uploaded successfully
        // Close the modal
        var modal = document.getElementById('modalChangeProfilePicture');
        var overlay = document.getElementById('overlay');
        if(modal) {
            modal.style.display = 'none';
            modal.style.visibility = 'hidden';
            modal.style.pointerEvents = 'none';
        }
        if(overlay) {
            overlay.style.display = 'none';
        }
        // Update the profile picture
        var profilePictureDiv = document.querySelector('.profile-picture img');
        if(profilePictureDiv) {
            profilePictureDiv.src = URL.createObjectURL(fileInput.files[0]);
        }
    } else {
        // An error occurred while uploading the file
        alert('An error occurred while uploading the file');
    }
};
xhr.send(formData);
}

function submitPassword(event) {
    // event.preventDefault();    
    const changePasswordForm = document.getElementById('formPassword');

    const newPasswordData = new FormData(changePasswordForm);

    // Send an AJAX request to the server
    fetch('changePassword.php', {
        method: 'POST',
        body: newPasswordData
    })
    .then(response => {
        // console.log(response.text());   
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Hide the first modal
            const firstModal = document.getElementById('modalPassword');
            const secondModal = document.getElementById('modalAdditionalPassword');

            firstModal.style.display = 'none';
            secondModal.style.display = 'block'; 
        } else {
            // Handle error
            console.error(data.message);
        }
    });
}

const submitPasswordOtpForm = document.getElementById('formOTPPassword');
function submitOTPPassword(event) {
    event.preventDefault();

    let newPasswordOtpData = new FormData(submitPasswordOtpForm);

    fetch('changePassword.php', {
        method: 'POST',
        body: newPasswordOtpData
    })
    .then(response => {
        console.log(response.text());
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('An error occurred while making the HTTP request.');
        }
    })
    .then(data => {
        if (data.success) {
            // OTP validated and password updated successfully
            // Display a success message
            const otpPasswordMessage = document.getElementById('otpPasswordMessage');
            otpPasswordMessage.textContent = data.message;
            otpPasswordMessage.style.color = 'green';
        } else {
            // An error occurred while validating the OTP or updating the password
            const otpPasswordMessage = document.getElementById('otpPasswordMessage');
            // handleErrorMessage(otpPasswordMessage, data.message);
        }
    })
    .catch(error => {
        // An error occurred during the HTTP request
        var otpPasswordMessage = document.getElementById('otpPasswordMessage');
        // handleErrorMessage(otpPasswordMessage, error.message);
    });
}



// Function to handle submission of the forgot password form
function submitForgotPassword(event) {
    event.preventDefault(); // Prevent default form submission

    // Fetch the form data
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    let forgotPasswordData = new FormData(forgotPasswordForm);
    // console.log(forgotPasswordForm)

    // Send an AJAX request to the server
    fetch('changePassword.php', {
        method: 'POST',
        body: forgotPasswordData
    })
    .then(response => response.json())
    .then(data => {
        // Show the additional modal after form submission
        showModal('resetPassword');
    })
    .catch(error => {
        // Handle the error
        console.error('Error:', error);
    });
}
// Function to handle submission of the username change form
function submitUsername(event) {
    event.preventDefault(); // Prevent default form submission

    // Fetch the form data
    var form = document.getElementById('formUsername');
    var formData = new FormData(form);
    
    // Send an AJAX request to the server
    fetch('changeUsername.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Hide the first modal
            var firstModal = document.getElementById('modalUsername');
            if (firstModal) {
                firstModal.style.display = 'none'; // Changed from visibility: hidden
            } else {
                console.error('First modal not found');
            }
    
            // Show the OTP verification modal
            var secondModal = document.getElementById('modalAdditionalUsername');
            if (secondModal) {
                secondModal.style.display = 'block'; // Changed from visibility: visible
            } else {
                console.error('Second modal not found');
            }
        } else {
            // Handle error
            console.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
// Function to handle submission of the OTP for username change
function submitOTPUsername(event) {
    event.preventDefault();

    var otpInput = document.getElementById('otpUsername');
    var usernameInput = document.getElementById('newUsername');
    if (!otpInput.value || !usernameInput.value) {
        // OTP or new username not entered
        alert('Please enter the OTP and new username');
        return;
    }

    var formData = new FormData();
    formData.append('otp', otpInput.value);
    formData.append('newUsername', usernameInput.value);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'changeUsername.php', true); // Replace with the URL of your server script
    xhr.onload = function () {
        var otpUsernameMessage = document.getElementById('otpUsernameMessage');
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // OTP validated and username updated successfully
                // Display a success message
                if (otpUsernameMessage) {
                    otpUsernameMessage.textContent = response.message;
                    otpUsernameMessage.style.color = 'green';
                }

                // Update the username on the page immediately
                var profileNameElement = document.querySelector('.profile-name');
                var usernameElement = document.querySelector('.username');
                if (profileNameElement && usernameElement) {
                    // Update profile name
                    profileNameElement.textContent = 'USERNAME: ' + usernameInput.value;
                    
                    // Update username in account settings
                    usernameElement.textContent = 'Username: ' + usernameInput.value;
                } else {
                    console.error('Username elements not found');
                }

                // Close the modal
                closeModal();
            } else {
                // An error occurred while validating the OTP or updating the username
                if (otpUsernameMessage) {
                    otpUsernameMessage.textContent = response.message;
                    otpUsernameMessage.style.color = 'red';
                }
            }
        } else {
            // An error occurred while making the HTTP request
            if (otpUsernameMessage) {
                otpUsernameMessage.textContent = 'An error occurred while making the HTTP request.';
                otpUsernameMessage.style.color = 'red';
            }
        }
    };
    xhr.send(formData);
}


// Function to handle submission of the forgot password form

function submitEmail(event) {
    event.preventDefault(); // Prevent default form submission

    // Fetch the form data
    var form = document.getElementById('formEmail');
    var formData = new FormData(form);
    
    // Send an AJAX request to the server
    fetch('changeEmail.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Hide the first modal
            var firstModal = document.getElementById('modalEmail');
            if (firstModal) {
                firstModal.style.display = 'none'; // Changed from visibility: hidden
            } else {
                console.error('First modal not found');
            }
    
            // Show the OTP verification modal
            var secondModal = document.getElementById('modalAdditionalEmail');
            if (secondModal) {
                secondModal.style.display = 'block'; // Changed from visibility: visible
            } else {
                console.error('Second modal not found');
            }
        } else {
            // Handle error
            console.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Function to handle submission of the OTP for email change
function submitOTPEmail(event) {
    event.preventDefault();

    var otpInput = document.getElementById('otpEmail');
    if (!otpInput.value) {
        // OTP not entered
        alert('Please enter the OTP');
        return;
    }

    var formData = new FormData();
    formData.append('otp', otpInput.value);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'changeEmail.php', true); // Replace with the URL of your server script
    xhr.onload = function () {
        var otpEmailMessage = document.getElementById('otpEmailMessage');
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // OTP validated successfully
                // Display a success message
                if (otpEmailMessage) {
                    otpEmailMessage.textContent = response.message;
                    otpEmailMessage.style.color = 'green';
                }
                // Update the email address on the page immediately
                var emailElement = document.querySelector('.emailadd');
                if (emailElement) {
                    // Update email address
                    emailElement.textContent = 'Email Address: ' + response.email;
                } else {
                    console.error('Email address element not found');
                }

                // Close the modal
                closeModal();
            } else {
                // An error occurred while validating the OTP
                if (otpEmailMessage) {
                    otpEmailMessage.textContent = response.message;
                    otpEmailMessage.style.color = 'red';
                }
            }
        } else {
            // An error occurred while making the HTTP request
            if (otpEmailMessage) {
                otpEmailMessage.textContent = 'An error occurred while making the HTTP request.';
                otpEmailMessage.style.color = 'red';
            }
        }
    };
    xhr.send(formData);
}

function resendPasswordOtp(event) {
    event.preventDefault(); // Prevent default form submission
    let resendPasswordData = new FormData();
    resendPasswordData.append('resend', true);
    
    fetch('changePassword.php', {
        method: 'POST',
        body: resendPasswordData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // OTP sent successfully
            console.log('OTP sent successfully');
        } else {
            // Handle error
            console.error(data.message);
        }
    })
}

function resendOTP(event) {
    event.preventDefault(); // Prevent default form submission

    // Prepare form data
    let formData = new FormData();
    formData.append('resend', true);

    // Send an AJAX request to the server
    fetch('changeUsername.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // OTP sent successfully
            console.log('OTP sent successfully');
        } else {
            // Handle error
            console.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function showForgotPasswordModal() {
    // Hide the first modal
    const changePasswordModal = document.getElementById('modalPassword');
    const forgotPasswordModal = document.getElementById('modalForgotPassword');

    changePasswordModal.style.display = 'none';
    forgotPasswordModal.style.display = 'block'; 
}

function submitResetPassword(event) {
    event.preventDefault();

    const resetPasswordForm = document.getElementById('resetPasswordForm');
    const resetPasswordData = new FormData(resetPasswordForm);

    fetch('changePassword.php', {
        method: 'POST',
        body: resetPasswordData
    })
    .then(response => {
        console.log(response.text());   
        response.json()
    })
    .then(data => {
        if (data.success) {
            // Password reset successfully
            console.log('Password reset successfully');
        } else {
            // Handle error
            console.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}