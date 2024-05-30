<?php

session_start();

if (empty($_POST["fname"])) {
    header("Location: ../appstep1.php?error=First Name is required");
    return;
} else if (empty($_POST["lname"])) {
    header("Location: ../appstep1.php?error=Last Name is required");
    return;
} else if (empty($_POST["pnum"])) {
    header("Location: ../appstep1.php?error=Phone Number is required");
    return;
} else if (empty($_POST["email"])) {
    header("Location: ../appstep1.php?error=Email is required");
    return;
} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    header("Location: ../appstep1.php?error=Enter a Valid Email");
    return;
} else if (empty($_POST["gender"])) {
    header("Location: ../appstep1.php?error=Gender is required");
    return;
} else if (empty($_POST["apptype"])) {
    header("Location: ../appstep1.php?error=Appointment type is required");
    return;
} else if (empty($_POST["date"])) {
    header("Location: ../appstep1.php?error=Enter a date");
    return;
} else if (empty($_POST["time"])) {
    header("Location: ../appstep1.php?error=Select a time");
    return;
} else if (!isset($_POST["checkbox_name"])) {
    header("Location: ../appstep1.php?error=Please select at least one checkbox");
    return;
}

$mysqli = new mysqli("localhost", "root", "", "sbdoDatabase");

// Handle database connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare and bind SQL statement
$stmt = $mysqli->prepare("INSERT INTO your_table (fname, lname, pnum, email, gender, apptype, date, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssssssss", $fname, $lname, $pnum, $email, $gender, $apptype, $date, $time);

// Set parameters and execute
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$pnum = $_POST["pnum"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$apptype = $_POST["apptype"];
$date = $_POST["date"];
$time = $_POST["time"];

$stmt->execute();
$stmt->close();

// Store selected checkboxes in session
if (isset($_POST["checkbox_name"])) {
    $_SESSION["checkbox_values"] = $_POST["checkbox_name"];
}

// Redirect to next step of the form
header('Location: ../appstep2.php');
?>
