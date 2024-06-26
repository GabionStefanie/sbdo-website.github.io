<?php

$errors = []; // array for error messages

if (empty($_POST["username"])) {
    die("Username is required");
}

if (empty($_POST["fname"])) {
    die("Name is required");
}

if (empty($_POST["lname"])) {
    die("Name is required");
}

if (empty($_POST["email"])) {
    die("Email is required");
}

if (empty($_POST["pnum"])) {
    die("Number is required");
}

if (empty($_POST["gender"])) {
    die("Gender is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    $errors['password'] = "Password must be at least 8 characters";
} elseif (!preg_match("/[a-z]/i", $_POST["password"])) {
    $errors['password'] = "Password must contain at least one letter";
} elseif (!preg_match("/[0-9]/", $_POST["password"])) {
    $errors['password'] = "Password must contain at least one number";
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    $errors['password_confirmation'] = "Password must match";
}

if (!empty($errors)) {
    // If there are errors, redirect back to the signup form with errors
    session_start();
    $_SESSION['errors'] = $errors;
    $_SESSION['post_data'] = $_POST; // Save the post data to repopulate the form
    header("Location: signup.php");
    exit;
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$activation_token = bin2hex(random_bytes(16));
$activation_token_hash = hash("sha256", $activation_token);
$activation_expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = new mysqli("localhost", "root", "", "sbdodatabase");

$name = $_POST["fname"] . " " . $_POST["lname"];
$username = $_POST["username"];
$email = $_POST["email"];
$pnum = $_POST["pnum"];
$gender = $_POST["gender"];

$SelectEmailSQL = "SELECT * FROM account WHERE email = '$email'";
$query = mysqli_query($mysqli, $SelectEmailSQL);
$result = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) > 0) {
    die("Email already taken");
}

$sql = "INSERT INTO account (username, email, password, account_type, account_activation_hash, activation_expiry, Name, Phone, Gender)
        VALUES (?, ?, ?, ?, ?,?,?,?,?)";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$Account_Type = 'Patient';
$stmt->bind_param(
    "sssssssss",
    $username,
    $email,
    $password_hash,
    $Account_Type,
    $activation_token_hash,
    $activation_expiry,
    $name,
    $pnum,
    $gender
);

if ($stmt->execute()) {
    $mail = require __DIR__ . "/mailer.php";
    $mail->setFrom("sulitbagasan.do1@gmail.com");
    $mail->addAddress($_POST["email"]);
    $mail->Subject = "Account Activation";
    $mail->Body = <<<END
    Click <a href="http://localhost/sbdo-website.github.io/integrated/sign-up/activate-account.php?token=$activation_token">here</a> 
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
