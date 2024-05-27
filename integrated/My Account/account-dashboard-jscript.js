// Helper function to reload the page
function reloadPage() {
    location.reload();
}

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

            reloadPage(); // Reload the page
        } else {
            // An error occurred while uploading the file
            alert('An error occurred while uploading the file');
        }
    };
    xhr.send(formData);
}

function submitPassword(event) {
    event.preventDefault();
    const changePasswordForm = document.getElementById('formPassword');
    const newPasswordData = new FormData(changePasswordForm);

    fetch('changePassword.php', {
        method: 'POST',
        body: newPasswordData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const firstModal = document.getElementById('modalPassword');
            const secondModal = document.getElementById('modalAdditionalPassword');

            firstModal.style.display = 'none';
            secondModal.style.display = 'block'; 

            reloadPage(); // Reload the page
        } else {
            console.error(data.message);
        }
    });
}

function submitOTPPassword(event) {
    event.preventDefault();

    let newPasswordOtpData = new FormData(submitPasswordOtpForm);

    fetch('changePassword.php', {
        method: 'POST',
        body: newPasswordOtpData
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('An error occurred while making the HTTP request.');
        }
    })
    .then(data => {
        if (data.success) {
            const otpPasswordMessage = document.getElementById('otpPasswordMessage');
            otpPasswordMessage.textContent = data.message;
            otpPasswordMessage.style.color = 'green';

            reloadPage(); // Reload the page
        } else {
            const otpPasswordMessage = document.getElementById('otpPasswordMessage');
            otpPasswordMessage.textContent = data.message;
            otpPasswordMessage.style.color = 'red';
        }
    })
    .catch(error => {
        var otpPasswordMessage = document.getElementById('otpPasswordMessage');
        otpPasswordMessage.textContent = error.message;
        otpPasswordMessage.style.color = 'red';
    });
}

function submitForgotPassword(event) {
    event.preventDefault();

    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    let forgotPasswordData = new FormData(forgotPasswordForm);

    fetch('changePassword.php', {
        method: 'POST',
        body: forgotPasswordData
    })
    .then(response => response.json())
    .then(data => {
        showModal('resetPassword');
        reloadPage(); // Reload the page
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function submitUsername(event) {
    event.preventDefault();

    var form = document.getElementById('formUsername');
    var formData = new FormData(form);
    
    fetch('changeUsername.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            var firstModal = document.getElementById('modalUsername');
            if (firstModal) {
                firstModal.style.display = 'none';
            } else {
                console.error('First modal not found');
            }
    
            var secondModal = document.getElementById('modalAdditionalUsername');
            if (secondModal) {
                secondModal.style.display = 'block';
            } else {
                console.error('Second modal not found');
            }

            reloadPage(); // Reload the page
        } else {
            console.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function submitOTPUsername(event) {
    event.preventDefault();

    var otpInput = document.getElementById('otpUsername');
    var usernameInput = document.getElementById('newUsername');
    if (!otpInput.value || !usernameInput.value) {
        alert('Please enter the OTP and new username');
        return;
    }

    var formData = new FormData();
    formData.append('otp', otpInput.value);
    formData.append('newUsername', usernameInput.value);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'changeUsername.php', true);
    xhr.onload = function () {
        var otpUsernameMessage = document.getElementById('otpUsernameMessage');
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                if (otpUsernameMessage) {
                    otpUsernameMessage.textContent = response.message;
                    otpUsernameMessage.style.color = 'green';
                }

                var profileNameElement = document.querySelector('.profile-name');
                var usernameElement = document.querySelector('.username');
                if (profileNameElement && usernameElement) {
                    profileNameElement.textContent = 'USERNAME: ' + usernameInput.value;
                    usernameElement.textContent = 'Username: ' + usernameInput.value;
                } else {
                    console.error('Username elements not found');
                }

                closeModal();

                reloadPage(); // Reload the page
            } else {
                if (otpUsernameMessage) {
                    otpUsernameMessage.textContent = response.message;
                    otpUsernameMessage.style.color = 'red';
                }
            }
        } else {
            if (otpUsernameMessage) {
                otpUsernameMessage.textContent = 'An error occurred while making the HTTP request.';
                otpUsernameMessage.style.color = 'red';
            }
        }
    };
    xhr.send(formData);
}

function submitEmail(event) {
    event.preventDefault();

    var form = document.getElementById('formEmail');
    var formData = new FormData(form);
    
    fetch('changeEmail.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            var firstModal = document.getElementById('modalEmail');
            if (firstModal) {
                firstModal.style.display = 'none';
            } else {
                console.error('First modal not found');
            }
    
            var secondModal = document.getElementById('modalAdditionalEmail');
            if (secondModal) {
                secondModal.style.display = 'block';
            } else {
                console.error('Second modal not found');
            }

            reloadPage(); // Reload the page
        } else {
            console.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function submitOTPEmail(event) {
    event.preventDefault();

    var otpInput = document.getElementById('otpEmail');
    if (!otpInput.value) {
        alert('Please enter the OTP');
        return;
    }

    var formData = new FormData();
    formData.append('otp', otpInput.value);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'changeEmail.php', true);
    xhr.onload = function () {
        var otpEmailMessage = document.getElementById('otpEmailMessage');
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                if (otpEmailMessage) {
                    otpEmailMessage.textContent = response.message;
                    otpEmailMessage.style.color = 'green';
                }

                var emailElement = document.querySelector('.emailadd');
                if (emailElement) {
                    emailElement.textContent = 'Email Address: ' + response.email;
                } else {
                    console.error('Email address element not found');
                }

                closeModal();

                reloadPage(); // Reload the page
            } else {
                if (otpEmailMessage) {
                    otpEmailMessage.textContent = response.message;
                    otpEmailMessage.style.color = 'red';
                }
            }
        } else {
            if (otpEmailMessage) {
                otpEmailMessage.textContent = 'An error occurred while making the HTTP request.';
                otpEmailMessage.style.color = 'red';
            }
        }
    };
    xhr.send(formData);
}

function resendPasswordOtp(event) {
    event.preventDefault();
    let resendPasswordData = new FormData();
    resendPasswordData.append('resend', true);
    
    fetch('changePassword.php', {
        method: 'POST',
        body: resendPasswordData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('OTP sent successfully');
            reloadPage(); // Reload the page
        } else {
            console.error(data.message);
        }
    });
}

function resendOTP(event) {
    event.preventDefault();

    let formData = new FormData();
    formData.append('resend', true);

    fetch('changeUsername.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('OTP sent successfully');
            reloadPage(); // Reload the page
        } else {
            console.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function showForgotPasswordModal() {
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
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Password reset successfully');
            reloadPage(); // Reload the page
        } else {
            console.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
