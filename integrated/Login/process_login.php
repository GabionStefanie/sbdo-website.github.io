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
$dbname = "sbdoDatabase";

try {
    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = $_POST["user_Name"];
        $password = $_POST["password"];
        
        // Prepare SQL statement to prevent SQL injection
        $sql = "SELECT User_ID, Account_Type, Email, `Password` FROM ACCOUNT WHERE BINARY Username = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Preparation failed: " . $conn->error);
        }

        // Bind parameters to the SQL query
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verify the password
            if (password_verify($password, $user["Password"])) {
                // Set the session variable
                $_SESSION["userID"] = $user['User_ID'];

                // Set cookies for User_ID and Account_Type
                setcookie("User_ID", $user["User_ID"], time() + (86400 * 30), "/"); // 86400 = 1 day
                setcookie("Account_Type", $user["Account_Type"], time() + (86400 * 30), "/");
                
                // Generate verification code
                $verificationCode = generateVerificationCode();
                
                // Send verification code email
                $to = $user["Email"]; // Send verification code email to the email associated with the username
                $subject = "Login Verification Code";
                $message = "We have received your request for a single-use code to log in to your Sulit and Bagasan Dental Office Patient account.\n\nYour single-use code is: $verificationCode\n\nIf you didn't request this code, please contact us immediately.\n\nCordially yours,\n\nSulit and Bagasan Dental Office\n\n[This is an automated email. Do not reply. For inquiries, contact: email]";

                // Create a new PHPMailer instance
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
                    
                    // Store verification code in session
                    $_SESSION["verification_code"] = $verificationCode;
                    
                    // Redirect to verification page
                    header("Location: ../My Account/account-dashboard.php");
                    exit;
                } catch (Exception $e) {
                    // Display error message if email sending fails
                    echo "<div class='error'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
                }
            } else {
                // Incorrect password
                echo "<div class='error'>Incorrect password</div>";
            }
        } else {
            // User not found
            echo "<div class='error'>User not found</div>";
        }
        
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// Function to generate a random verification code
function generateVerificationCode() {
    return rand(100000, 999999); // Generate a random 6-digit number
}
?>
