<?php
// Process form submission
// $userOrEmail = $_POST['user'] ?? '';

// Validate form data
if (isset($$_POST['user'])) {
    // Handle the case where the user field is empty
    echo "Please provide a username or an email address.";
} else {
    // Generate OTP (TBA)
    
    // Debugging
    echo "Redirecting to OTP page..."; // This message should appear if redirection is attempted

    // Redirect to OTP page
    header("Location: ../enter-otp-page.php"); // Use a relative URL
    exit; // Make sure to exit after redirection
}

// Additional error handling or processing can be done here if needed
?>
