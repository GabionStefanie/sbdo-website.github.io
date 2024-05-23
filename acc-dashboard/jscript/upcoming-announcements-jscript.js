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
