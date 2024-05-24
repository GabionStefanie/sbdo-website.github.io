<?php

if (empty($_POST["username"])) {
    die("Username is required");
}

if (empty($_POST["email"])) {
    die("Email is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$activation_token = bin2hex(random_bytes(16));

$activation_token_hash = hash("sha256", $activation_token);

$activation_expiry = date("Y-m-d H:i:s", time()+ 60 * 30);

$mysqli = require __DIR__ . "/database.php";

$username = $_POST["username"];
$email = $_POST["email"];

$sql = "SELECT * FROM account WHERE email = ?";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Email already taken"); 
}

$sql = "INSERT INTO account (username, email, password, account_activation_hash, activation_expiry)
        VALUES (?, ?, ?, ?,?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssss",
                  $username,
                  $email, // Email should come before gender
                  $password_hash,
                  $activation_token_hash,
                  $activation_expiry);

if ($stmt->execute()) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("sulitbagasan.do1@gmail.com");
    $mail->addAddress($_POST["email"]);
    $mail->Subject = "Account Activation";
    $mail->Body = <<<END

    Click <a href="http://localhost/DENTAL/activate-account.php?token=$activation_token">here</a> 
    to activate your account.

    END;

    try {

        $mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        exit;
    }

    header("Location: signup-success.php");
    exit;
    
} 