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
    if (isset($_POST['otp'])) {
        // OTP verification
        $otp = $_POST['otp'];

        if (isset($_SESSION['otp']) && $otp == $_SESSION['otp']) {
            // Update the username in the database
            $newUsername = $_SESSION["newUsername"];
            $oldUsername = $_SESSION["oldUsername"]; // Assuming you have the old username stored in the session

            // Prepare an SQL statement for execution
            $stmt = $conn->prepare("UPDATE ACCOUNT SET Username = ? WHERE Username = ?");
            $stmt->bind_param("ss", $newUsername, $oldUsername);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Username updated successfully."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
            }

            // Close statement
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Invalid OTP."]);
        }
    } elseif (isset($_POST['resend'])) {
        // Resend OTP
        $otp = generateVerificationCode(); // Generate a new OTP

        // Store the OTP in the session
        $_SESSION['otp'] = $otp;

        // Fetch the user's email from the session
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Send the OTP email
            $subject = 'Resend OTP for username change';
            $message = "Your OTP for username change is: $otp";

            if (sendEmailForOTP($email, $subject, $message)) {
                echo json_encode(["success" => true, "message" => "An OTP has been sent to your email."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error: Could not send OTP."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Error: Email not found in session."]);
        }
    } else {
        // Check if all required parameters are set in the POST request
        if (isset($_POST['newUsername']) && isset($_POST['oldUsername']) && isset($_POST['confirmNewUsername'])) {
            // Username change
            $newUsername = $_POST['newUsername'];
            $oldUsername = $_POST['oldUsername']; // Assuming you have the old username in the request
            $confirmNewUsername = $_POST['confirmNewUsername'];

            // Check if new username and confirm new username match
            if ($newUsername !== $confirmNewUsername) {
                echo json_encode(["success" => false, "message" => "New username and confirm new username do not match."]);
                exit; // Terminate execution
            }

            // Store the new and old usernames in the session
            $_SESSION["newUsername"] = $newUsername;
            $_SESSION["oldUsername"] = $oldUsername;

            // Fetch the user's email from the database
            $stmt = $conn->prepare("SELECT Email FROM ACCOUNT WHERE Username = ?");
            $stmt->bind_param("s", $oldUsername);
            $stmt->execute();
            $stmt->bind_result($email);
            $stmt->fetch();
            $stmt->close();

            if ($email) {
                // Generate OTP
                $otp = generateVerificationCode();

                // Store the OTP and email in the session
                $_SESSION['otp'] = $otp;
                $_SESSION['email'] = $email;

                // Send the OTP email
                $subject = 'Your OTP for username change';
                $message = "Your OTP for username change is: $otp";

                if (sendEmailForOTP($email, $subject, $message)) {
                    echo json_encode(["success" => true, "message" => "An OTP has been sent to your email.", "confirmNewUsername" => $confirmNewUsername]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error: Could not send OTP."]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Error: Could not find email address."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Error: Missing required parameters."]);
        }
    }
}

// Close connection
$conn->close();
?>
