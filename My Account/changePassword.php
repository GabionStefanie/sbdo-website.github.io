<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdodatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random verification code
function generateVerificationCode() {
    return strval(rand(100000, 999999)); // Ensure the OTP is a string
}

// Function to send email for OTP
function sendEmailForOTP($to, $subject, $message) { 
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'no.reply.sulitandbagasan@gmail.com'; // Your Gmail email address
        $mail->Password = 'pkxnihmyrjsmfuwq'; // Your Gmail App Password
        $mail->SMTPSecure = 'tls'; // Use TLS encryption
        $mail->Port = 587; // Set the SMTP port to 587

        // Recipients
        $mail->setFrom('no.reply.sulitandbagasan@gmail.com', 'Sulit and Bagasan Dental Office');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false); // Set to false to send as plain text
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send the email
        $mail->send();

        return true; // Email sent successfully
    } catch (Exception $e) {
        // Log or display error message
        return false; // Failed to send email
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['otpResetPassword'])) {
        // OTP verification for password reset
        $otp = $_POST['otpResetPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];

        if (isset($_SESSION['otp']) && $otp == $_SESSION['otp']) {
            if ($newPassword === $confirmNewPassword) {
                // Update the password in the database
                $email = $_SESSION['email']; // Assuming email is stored in the session
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                $stmt = $conn->prepare("UPDATE ACCOUNT SET Password = ? WHERE Email = ?");
                $stmt->bind_param("ss", $hashedPassword, $email);

                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "message" => "Password updated successfully."]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
                }

                $stmt->close();
            } else {
                echo json_encode(["success" => false, "message" => "New password and confirm new password do not match."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid OTP."]);
        }
    } elseif (isset($_POST['resend'])) {
        // Resend OTP
        $otp = generateVerificationCode(); // Generate a new OTP
        $_SESSION['otp'] = $otp;
        $email = $_SESSION['email'];

        $subject = 'Resend OTP for password reset';
        $message = "Your OTP for password reset is: $otp";

        if (sendEmailForOTP($email, $subject, $message)) {
            echo json_encode(["success" => true, "message" => "An OTP has been sent to your email."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: Could not send OTP."]);
        }
    } else {
        // Initial request to change password
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];

        // Assuming the email is stored in the session for the logged-in user
        $email = $_SESSION['email'];

        // Echo email for debugging
        echo "Email from session: " . $email . "\n";

        $stmt = $conn->prepare("SELECT Password FROM ACCOUNT WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();
        
        // Echo hashed password for debugging
        echo "Hashed password from database: " . $hashedPassword . "\n";

        // Verify the old password
        $verified = password_verify($oldPassword, $hashedPassword);
        // Echo password verification result for debugging
        echo "Result of password_verify: " . ($verified ? "true" : "false") . "\n";

        if ($verified) {
            if ($newPassword === $confirmNewPassword) {
                // Generate OTP
                $otp = generateVerificationCode();
                $_SESSION['otp'] = $otp;
                $_SESSION['newPassword'] = $newPassword;

                $subject = 'Your OTP for password reset';
                $message = "Your OTP for password reset is: $otp";

                if (sendEmailForOTP($email, $subject, $message)) {
                    echo json_encode(["success" => true, "message" => "An OTP has been sent to your email."]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error: Could not send OTP."]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "New password and confirm new password do not match."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Old password is incorrect."]);
        }
    }
}

$conn->close();
?>
