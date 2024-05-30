<?php

if (empty($_POST["username"])) {
    die("Username is required");
    return;
}

else if (empty($_POST["fname"])) {
    die("Name is required");
    return;
}

else if (empty($_POST["lname"])) {
    die("Name is required");
    return;
}

else if (empty($_POST["email"])) {
    die("Email is required");
    return;
}

else if (empty($_POST["pnum"])) {
    die("Number is required");
    return;
}

else if (empty($_POST["gender"])) {
    die("Gender is required");
    return;
}

else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

    die("Valid email is required");

    return;

}

else if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
    return;
}

else if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
    return;

}

else if (!preg_match("/[0-9]/", $_POST["password"])) {

    die("Password must contain at least one number");
    return;

}

else if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Password must match");
    return;
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

echo $email;

$SelectEmailSQL = "SELECT * FROM account WHERE email = '$email'";


$query = mysqli_query($mysqli, $SelectEmailSQL);


$result = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) > 0) {
    die("mail already taken");
    return;
}

$sql = "INSERT INTO account (username, email, password, account_type, account_activation_hash, activation_expiry)
        VALUES (?, ?, ?, ?, ?,?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$Account_Type = 'Patient';
$stmt->bind_param(
    "ssssss",
    $username,
    $email, // Email should come before gender
    $password_hash,
    $Account_Type,
    $activation_token_hash,
    $activation_expiry
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
