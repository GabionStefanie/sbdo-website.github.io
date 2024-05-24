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

// Function to show the reschedule modal
function showRescheduleModal() {
    var overlay = document.getElementById('overlay');
    var modal = document.getElementById('rescheduleModal');

    // Close all modals first
    closeModal();

    // Display the overlay and modal
    overlay.style.display = 'block';
    modal.style.display = 'block';
}

// Function to show the cancel confirmation modal
function showCancelConfirmationModal() {
    var overlay = document.getElementById('overlay');
    var modal = document.getElementById('confirmationModal');

    // Close all modals first
    closeModal();

    // Display the overlay and modal
    overlay.style.display = 'block';
    modal.style.display = 'block';
}

// Get references to elements
const rescheduleBtn = document.getElementById('rescheduleBtn');
const cancelBtn = document.getElementById('cancelBtn');

// Event listener for reschedule button click
rescheduleBtn.addEventListener('click', function() {
    // Show the reschedule modal
    showRescheduleModal();
});

// Event listener for cancel button click
cancelBtn.addEventListener('click', function() {
    // Show the cancel confirmation modal
    showCancelConfirmationModal();
});

// Function to handle rescheduling of appointments
function rescheduleAppointment(newDate, newTime) {
    // Perform AJAX request to update appointment details
    // You need to implement this part using XMLHttpRequest or fetch
    // Example using fetch:
    fetch('reschedule.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            newDate: newDate,
            newTime: newTime
        }),
    })
    .then(response => {
        if (response.ok) {
            // Handle successful rescheduling
            alert('Appointment rescheduled successfully!');
        } else {
            // Handle rescheduling failure
            alert('Failed to reschedule appointment. Please try again later.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle error
        alert('An error occurred while processing your request. Please try again later.');
    });
}

// Function to handle canceling of appointments
function cancelAppointment() {
    // Perform AJAX request to cancel appointment
    // You need to implement this part using XMLHttpRequest or fetch
    // Example using fetch:
    fetch('cancel.php', {
        method: 'POST',
    })
    .then(response => {
        if (response.ok) {
            // Handle successful cancellation
            alert('Appointment canceled successfully!');
        } else {
            // Handle cancellation failure
            alert('Failed to cancel appointment. Please try again later.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle error
        alert('An error occurred while processing your request. Please try again later.');
    });
}

// Get references to elements
const rescheduleForm = document.getElementById('rescheduleForm');
const newDateInput = document.getElementById('newDate');
const newTimeInput = document.getElementById('newTime');
const cancelBtn = document.getElementById('cancelBtn');

// Event listener for reschedule form submission
rescheduleForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get new date and time values
    const newDate = newDateInput.value;
    const newTime = newTimeInput.value;

    // Call function to reschedule appointment
    rescheduleAppointment(newDate, newTime);
});

// Event listener for cancel button click
cancelBtn.addEventListener('click', function() {
    // Call function to cancel appointment
    cancelAppointment();
});
