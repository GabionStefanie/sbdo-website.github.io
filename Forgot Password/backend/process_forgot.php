<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

// Function to generate a random verification code
function generateVerificationCode()
{
    return strval(rand(100000, 999999)); // Ensure the OTP is a string
}

// Function to send email for OTP
function sendEmailForOTP($to, $subject, $message, $isResend = false)
{
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

        // Change recipient based on whether it's a resend or initial email
        if ($isResend) {
            $subject = $subject .  "(Resend)"; // Add "Resend" indication to subject
            $mail->addAddress($to); // Set recipient to the original recipient
        } else {
            $mail->addAddress($to);
        }

        // Content
        $mail->isHTML(false); // Set to false to send as plain text
        $mail->Subject = $subject;

        // If it's a resend, append it to the existing message
        if ($isResend) {
            $message .= "\n\n[This is a resend.]\n";
        }

        $mail->Body = $message;

        // Send the email
        $mail->send();

        return true; // Email sent successfully
    } catch (Exception $e) {
        // Log or display error message
        return false; // Failed to send email
    }
}

// Main script starts here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["otp"])) {
        // Validate OTP
        $otp = $_POST["otp"];

        // Check if OTP matches
        if ($otp === $_SESSION["verification_code"]) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid OTP.']);
        }
    } elseif (isset($_POST["resend"])) {
        // Resend OTP logic
        $to = $_SESSION["email"]; // Retrieve email from session
        $verificationCode = generateVerificationCode(); // Generate new verification code
        $subject = "Password Reset Verification Code";
        $message = 
        "We have received your request for a single-use code to use to reset your password for your account.
        
        Your single use code is: $verificationCode
        If you didn't request this code, you can safely ignore this email. Someone else might have typed your email address by mistake.
        
        Cordially yours,
        Sulit and Bagasan Dental Office
        [This is an automated email. Do not reply.] ";

        // Send email
        $emailSent = sendEmailForOTP($to, $subject, $message, true); // Pass true to indicate it's a resend

        // Check if email was sent successfully
        if ($emailSent) {
            // Update the session with the new verification code
            $_SESSION["verification_code"] = $verificationCode;
            echo "OTP resend request has been sent to your email.";
        } else {
            echo "Failed to resend OTP. Please try again later.";
        }
    } else {
        // Handle email/username input
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            echo json_encode(['success' => false, 'message' => 'Connection failed: ' . mysqli_connect_error()]);
            exit;
        }

        // Retrieve form data (email address or username)
        $email_or_username = $_POST["email_or_username"];

        // Prepare SQL statement to prevent SQL injection
        $sql = "SELECT Email FROM ACCOUNT WHERE Email = ? OR Username = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Preparation failed: ' . $conn->error]);
            exit;
        }

        // Bind parameters to the SQL query
        $stmt->bind_param("ss", $email_or_username, $email_or_username);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Generate verification code
            $verificationCode = generateVerificationCode();

            // Send verification code email
            $to = $user["Email"];
            $subject = "Password Reset Verification Code";
            $message = 
            "We have received your request for a single-use code to use to reset your password for your account.
        
            Your single use code is: $verificationCode
            If you didn't request this code, you can safely ignore this email. Someone else might have typed your email address by mistake.
            
            Cordially yours,
            Sulit and Bagasan Dental Office
            [This is an automated email. Do not reply.] ";

            // Send email
            $emailSent = sendEmailForOTP($to, $subject, $message);

            // Check if email was sent successfully
            if ($emailSent) {
                // Store verification code and email in session
                $_SESSION["verification_code"] = $verificationCode;
                $_SESSION["email"] = $to;

                // Respond with success
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send verification code email']);
            }
        } else {
            // User not found
            echo json_encode(['success' => false, 'message' => 'Email address or username not found']);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
