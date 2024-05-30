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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

$mysqli = new mysqli($servername, $username, $password, $dbname);

$stmt = $mysqli->stmt_init();

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

$account = "Admin";
$sql = "INSERT INTO account (username, email, password, account_type)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $username,
                  $email, // Email should come before gender
                  $password_hash,
                  $account);

if ($stmt->execute()) {

    header("Location: ../addaccount-success.php");
    exit;
    
} 