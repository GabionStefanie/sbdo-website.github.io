<?php
// Process form submission
    $username = $_POST["user_Name"];
    $email = $_POST["email_address"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;
    $_SESSION["confirmPassword"] = $confirmPassword;

    // Validate form data (e.g., check if passwords match)

    // If form data is valid
    if ($password === $confirmPassword) {
        // Generate OTP (TBA)

        // Debugging
        echo "Redirecting to OTP page..."; // This message should appear if redirection is attempted

        // Redirect to OTP page
        header("Location: ../signup-OTP-page.php"); // Use a relative URL
        exit; // Make sure to exit after redirection
    } else {
        //Handle invalid form data (e.g., display error message)[TBA]
    }
?>